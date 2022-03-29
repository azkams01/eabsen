<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\AkunSiswaModel;
use App\Models\AbsensiModel;
use App\Models\PemberitahuanModel;
use App\Models\TanggalLiburModel;
use App\Models\TenggatAbsenModel;
use App\Models\LogAktivitasModel;
use CodeIgniter\Debug\Toolbar\Collectors\History;

class Users extends BaseController
{
    protected $akunSiswaModel;
    protected $absensiModel;
    protected $pemberitahuanModel;
    protected $tanggalLiburModel;
    protected $tenggatAbsenModel;
    public function __construct()
    {
        $this->akunSiswaModel = new AkunSiswaModel();
        $this->logAktivitasModel = new LogAktivitasModel();
        $this->absensiModel = new AbsensiModel();
        $this->faqModel = new FaqModel();
        $this->pemberitahuanModel = new PemberitahuanModel();
        $this->tanggalLiburModel = new TanggalLiburModel();
        $this->tenggatAbsenModel = new TenggatAbsenModel();
    }
    // 1. Dashboard
    public function dashboard()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $builder = $this->absensiModel;
        $builder->like('NIS', akunSiswa()->NIS);
        $pemberitahuan = $this->pemberitahuanModel->orderBy('id_pemberitahuan', 'DESC')->findAll();
        $ambil_data_baris = $builder->countAllResults();
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard',
            'ambil_data_baris' => $ambil_data_baris,
            'pemberitahuan' => $pemberitahuan,
            'tanggal' => $tanggal
        ];
        return view('/users/dashboard/dashboard', $data);
    }
    // 1.1 Paksa ubah password
    public function ubahPassword($id)
    {
        $this->akunSiswaModel->save([
            'NIS' => $id,
            'Password_siswa' => md5($this->request->getVar('Password'))
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(site_url('users'));
    }
    // 1.2 Data Riwayat
    public function dataRiwayat($NIS)
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $absen = $this->absensiModel->search($keyword);
        } else {
            $absen = $this->absensiModel->join('siswa', 'siswa.NIS = absensi.NIS');
        }
        $currentPage = $this->request->getVar('page_absensi') ? $this->request->getVar('page_absensi') : 1;
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Riwayat',
            'absen' => $absen->where('siswa.NIS', $NIS)->orderBy('absensi.tgl_absen', 'DESC')->paginate(7, 'absensi'),
            'pager' => $this->absensiModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/users/dashboard/dataRiwayat', $data);
    }
    public function pesanKeteranganLampiranRiwayat()
    {
        $id = akunSiswa()->NIS;
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('keterangan');
        $pesanKeterangan = $this->absensiModel->where('NIS', $id)->where('tgl_absen', $tgl_absen)->get()->getRow();
        session()->setFlashdata('pesanKeteranganLampiranRiwayat', $keterangan);
        session()->setFlashdata('pesanSebab', $pesanKeterangan->keterangan_desc);
        return redirect()->back();
    }

    // 2. Absen
    public function absen()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        $id = akunSiswa()->NIS;
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $builder = $this->absensiModel;
        $builder->like('NIS', akunSiswa()->NIS);
        $ambil_data_baris = $builder->countAllResults();
        $builder_absen = $this->absensiModel;
        $builder_absen->join('siswa', 'siswa.NIS = absensi.NIS');
        $builder_absen->where('siswa.NIS', akunSiswa()->NIS);
        $builder_absen->where('absensi.tgl_absen', $tanggal);
        $dataAbsen = $builder_absen->countAllResults();
        $absen = $this->absensiModel->where('NIS', $id)->orderBy('tgl_absen', 'DESC')->paginate(7);
        $data = [
            'title' => 'Absen | Eabsen',
            'header' => 'Absen',
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'absen' => $absen,
            'ambil_data_baris' => $ambil_data_baris,
            'validation' => \Config\Services::validation(),
            'dataAbsen' => $dataAbsen
        ];
        return view('/users/absen/absen', $data);
    }
    // 2.2 Fitur qr scan menggunakan library instascan.js
    public function qrscan()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $keteranganAbsen =  $this->request->getVar('keterangan');
        $data = [
            'title' => 'Absen | QR-Scan',
            'header' => 'Absen',
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'keteranganAbsen' => $keteranganAbsen
        ];
        return view('/users/absen/qr-scan', $data);
    }
    // 2.3 Logika proses absen
    public function absenProses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $tgl_libur = tgl_libur();
        $tenggat_absen = tenggat_absen();
        $waktu = date("H:i:s");
        $awal = date_create($waktu);
        $akhir = date_create("10:00:00");
        $selisih = date_diff($awal, $akhir);
        $builder_absen = $this->absensiModel;
        $builder_absen->join('siswa', 'siswa.NIS = absensi.NIS');
        $builder_absen->where('siswa.NIS', akunSiswa()->NIS);
        $builder_absen->where('absensi.tgl_absen', $tanggal);
        $dataAbsen = $builder_absen->countAllResults();
        $keteranganAbsen =  $this->request->getVar('keterangan');
        if ($dataAbsen <= "1") {
            if ($tgl_libur) {
                session()->setFlashdata('error', 'Hari ini libur ' . tgl_libur()->keterangan_libur);
                return redirect()->to(site_url('/users/absen'));
            } elseif (hari_ini() == "Sabtu" or hari_ini() == "Minggu") {
                session()->setFlashdata('error', 'Hari ini libur gaes');
                return redirect()->to(site_url('/users/absen'));
            } elseif ($tenggat_absen) {
                $batas_masuk_awal = tenggat_absen()->bm_awal;
                $batas_masuk_akhir = tenggat_absen()->bm_akhir;
                $batas_pulang_awal = tenggat_absen()->bp_awal;
                $batas_pulang_akhir = tenggat_absen()->bp_akhir;
                if ($keteranganAbsen == "Masuk" and $waktu >= $batas_masuk_awal and $waktu <= $batas_masuk_akhir) {
                    $this->absensiModel->insert([
                        'id_absensi' =>  id_absen_hadir(),
                        'NIS' => akunSiswa()->NIS,
                        'id_user' => userSiswa()->id_user,
                        'hari_absen' => hari_ini(),
                        'tgl_absen' => $tanggal,
                        'jam_masuk' => $waktu,
                        'keterangan_absen' => 'Hadir|Masuk',
                        'keterangan_desc' => 'Tenggat dirubah , masuk : ' . $batas_masuk_awal . " - " . $batas_masuk_akhir . " , pulang : " . $batas_pulang_awal . " - " . $batas_pulang_akhir
                    ]);
                    // Trigger Absen Masuk
                    $this->logAktivitasModel->insert([
                        'id_la' => id_log(),
                        'id_user' => '1',
                        'username' => akunSiswa()->NIS,
                        'aktivitas' => '2',
                        'deskripsi' => 'Absen Masuk',
                        'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                    ]);
                    session()->setFlashdata('pesan', 'Absen Berhasil');
                    return redirect()->to(site_url('/users/absen'));
                } elseif ($keteranganAbsen == "Pulang" and $waktu >= $batas_pulang_awal and $waktu <= $batas_pulang_akhir) {
                    $this->absensiModel->save([
                        'id_absensi' => absenMasuk()->id_absensi,
                        'jam_pulang' => $waktu,
                        'keterangan_absen' => 'Hadir'
                    ]);
                    // Trigger Absen Pulang
                    $this->logAktivitasModel->insert([
                        'id_la' => id_log(),
                        'id_user' => '1',
                        'username' => akunSiswa()->NIS,
                        'aktivitas' => '3',
                        'deskripsi' => 'Absen Pulang',
                        'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                    ]);
                    session()->setFlashdata('pesan', 'Absen berhasill :)');
                    return redirect()->to(site_url('/users/absen'));
                } else {
                    session()->setFlashdata('error', 'Absen di jam yang telah ditentukan');
                    return redirect()->to(site_url('/users/absen'));
                }
            } else {
                if ($keteranganAbsen == "Masuk") {
                    if ($waktu >= "05:00:00" and $waktu <= "07:15:00") {
                        $this->absensiModel->insert([
                            'id_absensi' =>  id_absen_hadir(),
                            'NIS' => akunSiswa()->NIS,
                            'id_user' => userSiswa()->id_user,
                            'hari_absen' => hari_ini(),
                            'tgl_absen' => $tanggal,
                            'jam_masuk' => $waktu,
                            'keterangan_absen' => 'Hadir|Masuk',
                            'keterangan_desc' => 'Masuk : Tepat waktu '
                        ]);
                        // Trigger Absen Masuk
                        $this->logAktivitasModel->insert([
                            'id_la' => id_log(),
                            'id_user' => '1',
                            'username' => akunSiswa()->NIS,
                            'aktivitas' => '2',
                            'deskripsi' => 'Absen Masuk',
                            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                        ]);
                        session()->setFlashdata('pesan', 'Absen Berhasil');
                        return redirect()->to(site_url('/users/absen'));
                    } elseif ($waktu >= "07:15:00" and $waktu <= "10:00:00") {
                        $session = session()->get('terlambat');
                        if (!$session) {
                            session()->set('terlambat', 'keterangan terlambat');
                            return redirect()->to(site_url('/users/qrscan'));
                        } else {
                            session()->remove('terlambat');
                            $deskripsi = $this->request->getVar('deskripsi');
                        }
                        $this->absensiModel->insert([
                            'id_absensi' =>  id_absen_hadir(),
                            'NIS' => akunSiswa()->NIS,
                            'id_user' => userSiswa()->id_user,
                            'hari_absen' => hari_ini(),
                            'tgl_absen' => $tanggal,
                            'jam_masuk' => $waktu,
                            'keterangan_absen' => 'Hadir|Masuk',
                            'keterangan_desc' => 'Masuk : Terlambat ' . $selisih->h . ' jam ' . $selisih->i . ' menit ' . $selisih->s . ' detik , dengan alasan ' . $deskripsi
                        ]);
                        // Trigger Absen Masuk Terlambat
                        $this->logAktivitasModel->insert([
                            'id_la' => id_log(),
                            'id_user' => '1',
                            'username' => akunSiswa()->NIS,
                            'aktivitas' => '2',
                            'deskripsi' => 'Absen Masuk Terlambat',
                            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                        ]);
                        session()->setFlashdata('pesan', 'Absen Berhasil');
                        return redirect()->to(site_url('/users/absen'));
                    } else {
                        session()->setFlashdata('error', 'Absen Gagal');
                        return redirect()->to(site_url('/users/absen'));
                    }
                } elseif ($keteranganAbsen == "Pulang") {
                    if ($waktu >= "10:00:00" and $waktu <= "15:00:00") {
                        if ($waktu >= "10:00:00" and $waktu <= "12:00:00") {
                            $keteranganPulang = "Pulang sebelum dzuhur";
                        } elseif ($waktu >= "12:00:00" and $waktu <= "14:00:00") {
                            $keteranganPulang = "Pulang setelah dzuhur";
                        } else {
                            $keteranganPulang = "Pulang larut ( lebih dari jam 2 sore )";
                        }
                        $this->absensiModel->save([
                            'id_absensi' => absenMasuk()->id,
                            'jam_pulang' => $waktu,
                            'keterangan_absen' => 'Hadir',
                            'keterangan_desc' => absenMasuk()->keterangan_desc . ' , Pulang : ' . $keteranganPulang
                        ]);
                        // Trigger Absen Pulang
                        $this->logAktivitasModel->insert([
                            'id_la' => id_log(),
                            'id_user' => '1',
                            'username' => akunSiswa()->NIS,
                            'aktivitas' => '3',
                            'deskripsi' => 'Absen Pulang',
                            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                        ]);
                        session()->setFlashdata('pesan', 'Absen Berhasil');
                        return redirect()->to(site_url('/users/absen'));
                    } else {
                        session()->setFlashdata('error', 'Absen Gagal');
                        return redirect()->to(site_url('/users/absen'));
                    }
                } else {
                    session()->setFlashdata('error', 'Tidak dapat absen di luar jam absen');
                    return redirect()->to(site_url('/users/absen'));
                }
            }
        } else {
            session()->setFlashdata('error', 'Absen Gagal :(');
            return redirect()->to(site_url('/users/absen'));
        }
    }
    public function absenGagal()
    {
        $keterangan = $this->request->getVar('keterangan');
        session()->setFlashdata('pesan', 'QR-Code Tidak Valid');
        return redirect()->to(site_url('/users/qrscan?keterangan=' . $keterangan));
    }
    // 2.4 Logika proses absen keterangan
    public function absenKeteranganProses()
    {
        if (!$this->validate([
            'lampiran' => [
                'rules' => 'max_size[lampiran,5120]|mime_in[lampiran,image/jpg,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'mime_in' => 'Format yang diizinkan hanya gambar dan dokumen berbentuk pdf'
                ]
            ]
        ])) {
            session()->setFlashdata('errorKeterangan', 'error');
            return redirect()->to(site_url('/users/absen'))->withInput();
        }
        $file = $this->request->getFile('lampiran');
        $newName = $file->getRandomName();
        $file->move('doc', $newName);

        date_default_timezone_set("Asia/Jakarta");
        $tgl_libur = tgl_libur();
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $keterangan = $this->request->getVar('keterangan');
        if ($tgl_libur) {
            session()->setFlashdata('error', 'Hari ini libur ' . tgl_libur()->keterangan_libur);
            return redirect()->to(site_url('/users/absen'));
        } elseif (hari_ini() == "Sabtu" or hari_ini() == "Minggu") {
            session()->setFlashdata('error', 'Hari ini libur gaes');
            return redirect()->to(site_url('/users/absen'));
        } else {
            if ($waktu <= "10:00:00" and $waktu >= "06:00:00") {
                $this->absensiModel->insert([
                    'id_absensi' =>  id_absen_keterangan($keterangan),
                    'NIS' => akunSiswa()->NIS,
                    'id_user' => userSiswa()->id_user,
                    'hari_absen' => hari_ini(),
                    'tgl_absen' => $tanggal,
                    'keterangan_absen' => $this->request->getVar('keterangan'),
                    'keterangan_desc' => $newName
                ]);
                // Trigger Absen Keterangan
                $this->logAktivitasModel->insert([
                    'id_la' => id_log(),
                    'id_user' => '1',
                    'username' => akunSiswa()->NIS,
                    'aktivitas' => '2',
                    'deskripsi' => $this->request->getVar('keterangan'),
                    'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                ]);
                session()->setFlashdata('pesan', 'Absen berhasill :)');
                return redirect()->to(site_url('/users/absen'));
            } else {
                session()->setFlashdata('error', 'Maaf , absen keterangan hanya dibuka dari jam 06:00 - 10:00');
                return redirect()->to(site_url('/users/absen'));
            }
        }
    }
    public function absenKeterangan()
    {
        if (!isset(siswaAbsen()->NIS)) {
            session()->setFlashdata('keterangan', 'keterangan');
            return redirect()->to(site_url('/users/absen'));
        } else {
            session()->setFlashdata('error', 'Tidak bisa absen dengan keterangan jika sebelumnya anda telah absen masuk');
            return redirect()->to(site_url('/users/absen'));
        }
    }
    public function pesanKeteranganLampiran()
    {
        $id = akunSiswa()->NIS;
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('keterangan');
        $pesanKeterangan = $this->absensiModel->where('NIS', $id)->where('tgl_absen', $tgl_absen)->get()->getRow();
        session()->setFlashdata('pesanKeteranganLampiran', $keterangan);
        session()->setFlashdata('pesanSebab', $pesanKeterangan->keterangan_desc);
        return redirect()->to(site_url('/users/absen'));
    }
    public function pesanKeteranganHadir()
    {
        $id = akunSiswa()->NIS;
        $absen_id = $this->request->getVar('id');
        $tgl_absen = $this->request->getVar('tgl_absen');
        $pesanKeterangan = $this->absensiModel->where('NIS', $id)->where('tgl_absen', $tgl_absen)->get()->getRow();
        session()->setFlashdata('pesanKeteranganHadir', $pesanKeterangan->keterangan_desc);
        return redirect()->back();
    }

    // 3. Profil
    public function profil()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Profil'
        ];
        return view('/users/profil/profil', $data);
    }
    // 3.1 fitur pengaturan ( form data profil )
    public function pengaturan()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Pengaturan',
            'validation' => \Config\Services::validation()
        ];
        return view('/users/profil/pengaturan', $data);
    }
    // 3.2 Proses crud profil
    public function profilProses($id)
    {
        if (!$this->validate([
            'Foto' => [
                'rules' => 'max_size[Foto,5120]|is_image[Foto]|mime_in[Foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/users/pengaturan')->withInput();
        }
        //ambil gambar
        $fileFoto = $this->request->getFile('Foto');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } elseif ($this->request->getVar('fotoLama') == 'profile.png') {
            //generate nama sampul random
            $namaFoto = $fileFoto->getRandomName();
            //pimdahkan file ke folder img
            $fileFoto->move('img', $namaFoto);
        } else {
            //generate nama sampul random
            $namaFoto = $fileFoto->getRandomName();
            //pimdahkan file ke folder img
            $fileFoto->move('img', $namaFoto);
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $this->akunSiswaModel->save([
            'NIS' => $id,
            'Foto_siswa' => $namaFoto,
            'JenisKelamin_siswa' => $this->request->getVar('JenisKelamin'),
            'Email_siswa' => $this->request->getVar('Email'),
            'NomorHp_siswa' => $this->request->getVar('NomorHp'),
            'Alamat_siswa' => $this->request->getVar('Alamat')
        ]);
        // Trigger Profil
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '1',
            'username' => akunSiswa()->NIS,
            'aktivitas' => '3',
            'deskripsi' => 'Update Profil',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(site_url('/users/profil'));
    }

    // 4. faq
    public function faq()
    {
        if (!session('NIS')) {
            return redirect()->back();
        }
        $faq = $this->faqModel->findAll();

        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/users/faq', $data);
    }

    public function logout()
    {
        // Trigger logout siswa 
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '1',
            'username' => akunSiswa()->NIS,
            'aktivitas' => '0',
            'deskripsi' => 'Logout',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        return redirect()->to(site_url('/auth/logout'));
    }
}
