<?php

namespace App\Controllers;

use App\Models\FaqModel;
use CodeIgniter\Exceptions\AlertError;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Admin extends BaseController
{
    // 1. Dashboard

    public function dashboard()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        // fitur hapus log per minggu
        $awal = date_create(id_min_log());
        $akhir = date_create(id_max_log());
        $selisih = date_diff($awal, $akhir);
        $hasil_selisih = $selisih->d;
        if ($hasil_selisih >= 7) {
            $this->logAktivitasModel->like('id_la', 'LA')->delete();
            // Trigger After Delete otomatis log
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '4',
                'deskripsi' => 'Sistem menghapus log secara otomatis',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', 'Log aktivitas berhasi dihapus , karena sudah lebih dari seminggu');
            return redirect()->to(site_url('/admin/dashboard'));
        }
        $tanggalLibur = $this->tanggalLiburModel->orderBy('id_libur', 'DESC')->findAll();
        $tenggatAbsen = $this->tenggatAbsenModel->orderBy('id_ta', 'DESC')->findAll();
        $pemberitahuan = $this->pemberitahuanModel->orderBy('id_pemberitahuan', 'DESC')->findAll();
        $pesanSaran = $this->akunSiswaModel->join('pesan_saran', 'siswa.NIS = pesan_saran.NIS')->orderBy('pesan_saran.id_ps', 'DESC')->findAll();
        $gabung_hadir = ['Hadir|Masuk', 'Hadir'];
        $data_hadir = $this->absensiModel->whereIn('keterangan_absen', $gabung_hadir)->where('tgl_absen', $tanggal)->countAllResults();
        $data_sakit = $this->absensiModel->where('keterangan_absen', 'Sakit')->where('tgl_absen', $tanggal)->countAllResults();
        $data_izin = $this->absensiModel->where('keterangan_absen', 'Izin')->where('tgl_absen', $tanggal)->countAllResults();
        $databa = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS', 'left')->where('absensi.tgl_absen', $tanggal)->countAllResults();
        $datasemua = $this->akunSiswaModel->countAllResults();
        $data_belum_absen = $datasemua - $databa;
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard',
            'ambil_data_baris' => $data_hadir,
            'pemberitahuan' => $pemberitahuan,
            'pesanSaran' => $pesanSaran,
            'tanggalLibur' => $tanggalLibur,
            'tenggatAbsen' => $tenggatAbsen,
            'data_hadir' => $data_hadir,
            'data_sakit' => $data_sakit,
            'data_izin' => $data_izin,
            'data_belum_absen' => $data_belum_absen
        ];
        return view("/admin/dashboard/dashboard", $data);
    }

    // 1.1 CRUD Pemberitahuan di admin

    public function pemberitahuanTambah()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'dashboard',
            'tanggal' => $tanggal
        ];
        return view('/admin/dashboard/pemberitahuanTambah', $data);
    }
    public function pemberitahuanEdit($id)
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $pemberitahuan = $this->pemberitahuanModel->find($id);
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'dashboard',
            'tanggal' => $tanggal,
            'pemberitahuan' => $pemberitahuan
        ];
        return view('/admin/dashboard/pemberitahuanEdit', $data);
    }
    public function pemberitahuanTambahProses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->pemberitahuanModel->insert([
            'id_pemberitahuan' => id_pemberitahuan(),
            'id_user' => akunUser()->id_user,
            'informasi' => $this->request->getVar('informasi'),
            'tgl_info' => $tanggal,
            'narasumber' => $this->request->getVar('narasumber')
        ]);
        // Trigger After Insert Pemberitahuan
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '2',
            'deskripsi' => 'Tambah pemberitahuan , dengan narasumber ' .  $this->request->getVar('narasumber'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di publish');
        return redirect()->to(site_url('/admin/pemberitahuanTambah'));
    }
    public function pemberitahuanEditProses($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->pemberitahuanModel->save([
            'id_pemberitahuan' => $id,
            'informasi' => $this->request->getVar('informasi'),
            'narasumber' => $this->request->getVar('narasumber')
        ]);
        // Trigger After Update Pemberitahuan
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '3',
            'deskripsi' => 'Update pemberitahuan dari informasi yang ditulis ' .  $this->request->getVar('narasumber'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di update');
        return redirect()->to(site_url('/admin/pemberitahuanTambah'));
    }
    public function pemberitahuanHapus($id)
    {
        $this->pemberitahuanModel->delete($id);
        // Trigger After Delete Pemberitahuan
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus Pemberitahuan',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di hapus');
        return redirect()->to(site_url('/admin/dashboard'));
    }

    // 1.2 Tentang Log Aktivitas 

    public function logAktivitas()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_aktivitas = $this->logAktivitasModel->search($keyword);
        } else {
            $data_aktivitas = $this->logAktivitasModel;
        }
        $currentPage = $this->request->getVar('page_log_aktivitas') ? $this->request->getVar('page_log_aktivitas') : 1;
        $data = [
            'title' => 'Log Aktivitas | Eabsen',
            'header' => 'Log Aktivitas ',
            'log' => $data_aktivitas->orderBy('id_la', 'DESC')->paginate(50, 'log_aktivitas'),
            'pager' => $this->logAktivitasModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/admin/dashboard/logaktivitas', $data);
    }
    public function sessionBookmark()
    {
        session()->setFlashdata('bookmarkOn', 'on');
        return redirect()->to(site_url('/admin/logAktivitas'));
    }

    // 1.3 Fitur restart absen 

    public function restartAbsen()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->absensiModel->where('tgl_absen', $tanggal)->delete();
        // Trigger After Delete absensi
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Restart Absen',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Absen berhasil di restart');
        return redirect()->to(site_url('/admin/dashboard'));
    }
    public function konfirmasiRestart()
    {
        session()->setFlashdata('konfirmasi', 'Yakin Mau di restart ?');
        return redirect()->to(site_url('/admin/dashboard'));
    }

    // 1.4 Fitur mengatur tenggat absen

    public function aturTenggatProses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $tgl_absen = $this->request->getVar('tgl_absen');
        $batas_masuk_awal = $this->request->getVar('batas_masuk_awal');
        $batas_masuk_akhir = $this->request->getVar('batas_masuk_akhir');
        $batas_pulang_awal = $this->request->getVar('batas_pulang_awal');
        $batas_pulang_akhir = $this->request->getVar('batas_pulang_akhir');
        $tgl_sudah_ada = $this->tenggatAbsenModel->where('tgl_tenggat', $tgl_absen)->get()->getRow();
        if ($tgl_sudah_ada) {
            return redirect()->back()->with('gagal', 'Anda sudah menginput tanggal tersebut');
        } elseif ($tgl_absen < $tanggal) {
            return redirect()->back()->with('gagal', 'Tidak bisa memasukkan tanggal yang sudah berlalu');
        } elseif ($batas_masuk_awal < "05:00:00" or $batas_masuk_akhir < $batas_masuk_awal or $batas_pulang_akhir < $batas_pulang_awal or $batas_masuk_akhir > $batas_pulang_awal or $batas_pulang_awal < $batas_masuk_akhir) {
            return redirect()->back()->with('gagal', 'Batas waktu yang anda masukan tidak benar');
        } else {
            // restart absen hari ini
            date_default_timezone_set("Asia/Jakarta");
            $tanggal = date("Y-m-d");
            if ($tanggal == $tgl_absen) {
                $this->absensiModel->where('tgl_absen', $tanggal)->delete();
            }
            // masukan tenggat
            $this->tenggatAbsenModel->insert([
                'id_ta' => id_ta(),
                'id_user' => akunUser()->id_user,
                'tgl_tenggat' => $this->request->getVar('tgl_absen'),
                'bm_awal' => $this->request->getVar('batas_masuk_awal'),
                'bm_akhir' => $this->request->getVar('batas_masuk_akhir'),
                'bp_awal' => $this->request->getVar('batas_pulang_awal'),
                'bp_akhir' => $this->request->getVar('batas_pulang_akhir')
            ]);
            // Trigger After Insert tenggat_absen
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '2',
                'deskripsi' => 'Tambah tenggat absen',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', 'Tenggat absen berhasil di set');
            return redirect()->to(site_url('/admin/dashboard'));
        }
    }
    public function aturTenggatHapus($id)
    {
        $this->tenggatAbsenModel->where('id_ta', $id)->delete();
        // Trigger After Delete tenggat_absen
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus tenggat absen',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Tenggat absen telah terhapus');
        return redirect()->to(site_url('/admin/dashboard'));
    }
    public function aturTenggatTambah()
    {
        session()->setFlashdata('formTenggat', 'Atur Tenggat');
        return redirect()->to(site_url('/admin/dashboard'));
    }

    // 1.5 Fitur atur tanggal libur dan tanggal merah (belum bisa membaca kalender)

    public function aturLiburProses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $tgl_libur = $this->request->getVar('tgl_libur');
        $tgl_sudah_ada = $this->tanggalLiburModel->where('tgl_libur', $tgl_libur)->get()->getRow();
        if ($tgl_sudah_ada) {
            return redirect()->back()->with('gagal', 'Anda sudah menginput tanggal tersebut');
        } else if ($tgl_libur < $tanggal) {
            return redirect()->back()->with('gagal', 'Tidak bisa memasukkan tanggal yang sudah berlalu');
        } else {
            $this->tanggalLiburModel->insert([
                'id_libur' => id_libur(),
                'id_user' => akunUser()->id_user,
                'keterangan_libur' => $this->request->getVar('keterangan'),
                'tgl_libur' => $this->request->getVar('tgl_libur')
            ]);
            // Trigger After Insert libur
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '2',
                'deskripsi' => 'Tambah tanggal libur pada ' . $this->request->getVar('tgl_libur') . ' dengan keterangan ' . $this->request->getVar('keterangan'),
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', 'Hari libur berhasil di set');
            return redirect()->to(site_url('/admin/dashboard'));
        }
    }
    public function aturLiburHapus($id)
    {
        $this->tanggalLiburModel->where('id_libur', $id)->delete();
        // Trigger After Delete libur
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus tanggal libur',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Tenggat absen telah terhapus');
        return redirect()->to(site_url('/admin/dashboard'));
    }
    public function aturLiburTambah()
    {
        session()->setFlashdata('formLibur', 'Atur Libur');
        return redirect()->to(site_url('/admin/dashboard'));
    }

    // 1.6 Fitur pesan saran

    public function pesanSaranHapus($id)
    {
        $this->pesanSaranModel->where('id_ps', $id)->delete();
        // Trigger After Delete pesan_saran
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus pesan saran',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pesan telah terhapus');
        return redirect()->to(site_url('/admin/dashboard'));
    }
    public function pesanSaranHapusSemua()
    {
        $data = $this->request->getVar('pilihan_akun[]');
        $jumlahbaris = 0;
        if ($data == null) {
            session()->setFlashdata('gagal', 'Tidak ada baris yang terdeteksi');
            return redirect()->to(site_url('/admin/dashboard'));
        } else {
            foreach ($data as $dt) {
                $this->pesanSaranModel->where('id_ps', $dt)->delete();
                $jumlahbaris++;
            }
            // Trigger After Delete 
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '4',
                'deskripsi' => 'Hapus pesan saran',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahbaris . ' Data berhasil di hapus');
            return redirect()->to(site_url('/admin/dashboard'));
        }
    }

    // 1.7 Fitur keterangan absen , untuk melihat jumlah data absen hari ini

    public function keteranganAbsen()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $keterangan = $this->request->getVar('keterangan');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            if ($keterangan == "Hadir") {
                $absen = $this->absensiModel->searchAdminHadir($keyword);
            } else if ($keterangan == "Sakit") {
                $absen = $this->absensiModel->searchAdminSakit($keyword);
            } else if ($keterangan == "Izin") {
                $absen = $this->absensiModel->searchAdminIzin($keyword);
            } else {
                return redirect()->back()->with('gagal', 'Kesalahan Entry , Coba Kembali');
            }
        } else {
            $absen = $this->absensiModel->join('siswa', 'absensi.NIS = siswa.NIS');
        }
        if ($keterangan == "Hadir") {
            $data = ['Hadir|Masuk', 'Hadir'];
            $dataKeterangan = $absen->whereIn('keterangan_absen', $data)->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
            $header = 'Data Hadir';
        } else if ($keterangan == "Sakit") {
            $dataKeterangan = $absen->where('keterangan_absen', 'Sakit')->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
            $header = 'Data Sakit';
        } else if ($keterangan == "Izin") {
            $dataKeterangan = $absen->where('keterangan_absen', 'Izin')->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
            $header = 'Data Izin';
        } else {
            return redirect()->back()->with('gagal', 'Kesalahan Entry , Coba Kembali');
        }
        $currentPage = $this->request->getVar('page_absensi') ? $this->request->getVar('page_absensi') : 1;
        $data = [
            'title' => 'Data Kehadiran | Eabsen',
            'header' => $header,
            'keterangan' => $keterangan,
            'data' => $dataKeterangan,
            'pager' => $this->absensiModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/admin/dashboard/keteranganabsen', $data);
    }
    public function pesanKeteranganLampiran()
    {
        $id = $this->request->getVar('id');
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('keterangan');
        $pesanKeterangan = $this->absensiModel->where('id_absensi', $id)->where('tgl_absen', $tgl_absen)->get()->getRow();
        session()->setFlashdata('pesanKeteranganLampiran', $keterangan);
        session()->setFlashdata('pesanSebab', $pesanKeterangan->keterangan_desc);
        return redirect()->back();
    }

    // 2. Data Siswa 

    public function datasiswa()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_siswa = $this->akunSiswaModel->search($keyword);
        } else {
            $data_siswa = $this->akunSiswaModel;
        }
        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
        $data = [
            'title' => 'Data Siswa | Eabsen',
            'header' => 'Data Siswa ',
            'akun_siswa' => $data_siswa->orderBy('Kelas', 'ASC')->paginate(32, 'siswa'),
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/admin/datasiswa/datasiswa', $data);
    }
    public function resetPassword()
    {
        $NIS = $this->request->getVar('NIS');
        $password = md5('12345678');
        // Fitur reset password
        $this->akunSiswaModel->save([
            'NIS' => $NIS,
            'Password_siswa' => $password
        ]);
        // Trigger After Update 
        $this->logAktivitasModel->save([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '3',
            'deskripsi' => 'Mereset password dengan NIS ' . $NIS,
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Password dengan NIS ' . $NIS . ' berhasil di reset');
        return redirect()->to(site_url('/admin/datasiswa'));
    }

    // 2.1 Fitur impor data akun 

    public function formImpor()
    {
        session()->setFlashdata('formImpor', 'Silahkan Impor Data');
        return redirect()->to(site_url('/admin/datasiswa'));
    }
    public function prosesExcel()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'fileimport' => [
                'rules' => 'uploaded[fileimport]|ext_in[fileimport,xls,xlsx]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ]);
        if (!$valid) {
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->to(site_url('/admin/datasiswa'));
        } else {
            $file_excel = $this->request->getFile('fileimport');

            $ext = $file_excel->getClientExtension();

            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $jumlahsukses = 0;
            $datasama = 0;

            foreach ($data as $x => $row) {
                if ($data[0][0] == 'NIS' and $data[0][1] == 'Nama' and $data[0][2] == 'Password' and $data[0][3] == 'Kelas') {
                    if ($x == 0) {
                        continue;
                    }

                    $ceknis = $this->akunSiswaModel->cekdata($row[0]);
                    if ($ceknis) {
                        if ($row[0] == $ceknis['NIS']) {
                            $datasama++;
                            continue;
                        }
                    } else if ($row[0] == NULL) {
                        continue;
                    }

                    $NIS = $row[0];
                    $Nama = $row[1];
                    $Password = $row[2];
                    $Kelas = $row[3];


                    $this->akunSiswaModel->insert([
                        'id_user' => '1',
                        'NIS' => $NIS,
                        'Nama_siswa' => $Nama,
                        'Kelas' => $Kelas,
                        'Password_siswa' => md5($Password)
                    ]);
                    $jumlahsukses++;
                } else {
                    session()->setFlashdata('error', 'Apakah anda memasukan data yang benar ?');
                    return redirect()->to(site_url('/admin/datasiswa'));
                }
            }
            // Trigger After Insert siswa
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '2',
                'deskripsi' => 'Impor ' . $jumlahsukses . ' data ke tabel siswa',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahsukses . ' Data Berhasil Di Impor , ' . $datasama . ' Data yang sama.');
            return redirect()->to(site_url('/admin/datasiswa'));
        }
    }

    // 2.2 Fitur Aksi Pada tabel datasiswa

    public function konfirmasiHapusAkun()
    {
        session()->setFlashdata('konfirmasiHapusAkun', 'Yakin Mau di hapus ?');
        return redirect()->to(site_url('/admin/datasiswa'));
    }
    public function Details()
    {
        $NIS = $this->request->getVar('id');
        $data = $this->akunSiswaModel->where('NIS', $NIS)->find();
        session()->setFlashdata('Details', $data[0]['Nama_siswa']);
        session()->setFlashdata('NIS', $data[0]['NIS']);
        session()->setFlashdata('Kelas', $data[0]['Kelas']);
        session()->setFlashdata('JenisKelamin', $data[0]['JenisKelamin_siswa']);
        session()->setFlashdata('Foto', $data[0]['Foto_siswa']);
        session()->setFlashdata('Alamat', $data[0]['Alamat_siswa']);
        session()->setFlashdata('Email', $data[0]['Email_siswa']);
        session()->setFlashdata('NomorHp', $data[0]['NomorHp_siswa']);
        return redirect()->to(site_url('/admin/datasiswa'));
    }
    public function editAkunSiswa()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $id = $this->request->getVar('id');
        $data = [
            'title' => 'Data Siswa | Eabsen',
            'header' => '',
            'id' => $id,
            'validation' => \Config\Services::validation(),
            'akunSiswa' => $this->akunSiswaModel->where('NIS', $id)->get()->getRow()
        ];

        return view('/admin/datasiswa/edit', $data);
    }
    public function editAkunSiswaProses($id)
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
            return redirect()->to('/admin/datasiswa/editAkunSiswa')->withInput();
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
            'Nama_siswa' => $this->request->getVar('Nama'),
            'Kelas' => $this->request->getVar('Kelas'),
            'Foto_siswa' => $namaFoto,
            'JenisKelamin_siswa' => $this->request->getVar('JenisKelamin'),
            'Email_siswa' => $this->request->getVar('Email'),
            'NomorHp_siswa' => $this->request->getVar('NomorHp'),
            'Alamat_siswa' => $this->request->getVar('Alamat')
        ]);
        // Trigger After Update siswa
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '3',
            'deskripsi' => 'Update data siswa dengan nama ' . strtolower($this->request->getVar('Nama')),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil diedit');
        return redirect()->to(site_url('/admin/datasiswa'));
    }
    public function hapusAkunSiswa()
    {
        $id = $this->request->getVar('id');
        $nama = strtolower($this->request->getVar('nama'));
        $this->akunSiswaModel->where('NIS', $id)->delete();
        // Trigger After Delete siswa
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus akun ' . $nama,
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Akun ' . $nama . ' berhasil dihapus');
        return redirect()->to(site_url('/admin/datasiswa'));
    }

    // 2.3 Fitur tambah data siswa dan hapus akun check

    public function tambahAkunSiswa()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $data = [
            'title' => 'Data Siswa | Eabsen',
            'header' => '',
        ];
        return view('/admin/datasiswa/tambah', $data);
    }
    public function tambahAkunSiswaProses()
    {
        $nis = $this->request->getVar('NIS');
        $nama = strtoupper($this->request->getVar('Nama'));
        $kelas = strtoupper($this->request->getVar('Kelas'));
        $password = md5($this->request->getVar('Password'));

        $ceknis = $this->akunSiswaModel->cekdata($nis);
        if ($ceknis) {
            session()->setFlashdata('error', 'Akun dengan NIS ' . $nis . ' sudah ada');
            return redirect()->to(site_url('/admin/datasiswa'));
        } else {
            $this->akunSiswaModel->insert([
                'id_user' => '1',
                'NIS' => $nis,
                'Nama_siswa' => $nama,
                'Kelas' => $kelas,
                'Password_siswa' => md5($password)
            ]);
        }
        // Trigger After Insert siswa
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '2',
            'deskripsi' => 'Tambah data akun siswa dengan nama ' . strtolower($this->request->getVar('Nama')),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);

        session()->setFlashdata('pesan', 'Akun ' . $nama . ' berhasil ditambah');
        return redirect()->to(site_url('/admin/datasiswa'));
    }
    public function hapusAkunCheck()
    {
        $data = $this->request->getVar('pilihan_akun[]');
        $jumlahbaris = 0;
        if ($data == null) {
            session()->setFlashdata('error', 'Tidak ada baris yang terdeteksi');
            return redirect()->to(site_url('/admin/datasiswa'));
        } else {
            foreach ($data as $dt) {
                $this->akunSiswaModel->where('NIS', $dt)->delete();
                $jumlahbaris++;
            }
            // Trigger After Delete siswa
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '4',
                'deskripsi' => 'Hapus akun check',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahbaris . ' Data berhasil di hapus');
            return redirect()->to(site_url('/admin/datasiswa'));
        }
    }

    // 3. Data Guru 

    public function dataguru()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_guru = $this->akunGuruModel->search($keyword);
        } else {
            $data_guru = $this->akunGuruModel;
        }
        $currentPage = $this->request->getVar('page_akun_guru') ? $this->request->getVar('page_akun_guru') : 1;
        $data = [
            'title' => 'Data Guru | Eabsen',
            'header' => 'Data Guru ',
            'guru' => $data_guru->orderBy('walikelas', 'ASC')->paginate(32, 'guru'),
            'pager' => $this->akunGuruModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/admin/dataguru/dataguru', $data);
    }

    // 3.1 Fitur impor data akun 

    public function formImporGuru()
    {
        session()->setFlashdata('formImpor', 'Silahkan Impor Data');
        return redirect()->to(site_url('/admin/dataguru'));
    }
    public function prosesExcelGuru()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'fileimport' => [
                'rules' => 'uploaded[fileimport]|ext_in[fileimport,xls,xlsx]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ]);
        if (!$valid) {
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->to(site_url('/admin/dataguru'));
        } else {
            $file_excel = $this->request->getFile('fileimport');

            $ext = $file_excel->getClientExtension();

            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $jumlahsukses = 0;
            $datasama = 0;

            foreach ($data as $x => $row) {
                if ($data[0][0] == 'NIP' and $data[0][1] == 'Nama' and $data[0][2] == 'Password' and $data[0][3] == 'Kelas') {
                    if ($x == 0) {
                        continue;
                    }

                    $ceknip = $this->akunGuruModel->cekdata($row[0]);
                    if ($ceknip) {
                        if ($row[0] == $ceknip['NIP']) {
                            $datasama++;
                            continue;
                        }
                    } else if ($row[0] == NULL) {
                        continue;
                    }

                    $NIP = $row[0];
                    $Nama = $row[1];
                    $Password = $row[2];
                    $Kelas = $row[3];

                    $this->akunGuruModel->insert([
                        'id_user' => '2',
                        'NIP' => $NIP,
                        'Nama_guru' => $Nama,
                        'walikelas' => $Kelas,
                        'Password_guru' => $Password
                    ]);
                    $jumlahsukses++;
                } else {
                    session()->setFlashdata('error', 'Apakah anda memasukan data yang benar ?');
                    return redirect()->to(site_url('/admin/dataguru'));
                }
            }
            // Trigger After Insert guru
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '2',
                'deskripsi' => 'Impor ' . $jumlahsukses . ' data ke tabel guru',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahsukses . ' Data Berhasil Di Impor , ' . $datasama . ' Data yang sama.');
            return redirect()->to(site_url('/admin/dataguru'));
        }
    }

    // 3.2 Fitur Aksi Pada tabel dataguru

    public function konfirmasiHapusAkunGuru()
    {
        session()->setFlashdata('konfirmasiHapusAkun', 'Yakin Mau di hapus ?');
        return redirect()->to(site_url('/admin/dataguru'));
    }
    public function DetailsGuru()
    {
        $NIP = $this->request->getVar('id');
        $data = $this->akunGuruModel->where('NIP', $NIP)->find();
        session()->setFlashdata('Details', $data[0]['Nama_guru']);
        session()->setFlashdata('NIP', $data[0]['NIP']);
        session()->setFlashdata('Kelas', $data[0]['walikelas']);
        session()->setFlashdata('JenisKelamin', $data[0]['JenisKelamin_guru']);
        session()->setFlashdata('Foto', $data[0]['Foto_guru']);
        session()->setFlashdata('Alamat', $data[0]['Alamat_guru']);
        session()->setFlashdata('Email', $data[0]['Email_guru']);
        session()->setFlashdata('NomorHp', $data[0]['NomorHp_guru']);
        return redirect()->to(site_url('/admin/dataguru'));
    }
    public function editAkunGuru()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $NIP = $this->request->getVar('id');
        $data = [
            'title' => 'Data Guru | Eabsen',
            'header' => '',
            'id' => $NIP,
            'validation' => \Config\Services::validation(),
            'akunGuru' => $this->akunGuruModel->where('NIP', $NIP)->get()->getRow()
        ];

        return view('/admin/dataguru/edit', $data);
    }
    public function editAkunGuruProses($id)
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
            return redirect()->to('/admin/dataguru/editAkunGuru')->withInput();
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

        $this->akunGuruModel->save([
            'NIP' => $id,
            'Nama_guru' => $this->request->getVar('Nama'),
            'walikelas' => $this->request->getVar('Kelas'),
            'Password_guru' => $this->request->getVar('Password'),
            'Foto_guru' => $namaFoto,
            'JenisKelamin_guru' => $this->request->getVar('JenisKelamin'),
            'Email_guru' => $this->request->getVar('Email'),
            'NomorHp_guru' => $this->request->getVar('NomorHp'),
            'Alamat_guru' => $this->request->getVar('Alamat')
        ]);
        // Trigger After Update guru
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '3',
            'deskripsi' => 'Update data guru dengan nama ' . strtolower($this->request->getVar('Nama')),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil diedit');
        return redirect()->to(site_url('/admin/dataguru'));
    }
    public function hapusAkunGuru()
    {
        $NIP = $this->request->getVar('id');
        $nama = strtolower($this->request->getVar('nama'));
        $this->akunGuruModel->where('NIP', $NIP)->delete();
        // Trigger After Delete guru
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus akun Guru ' . $nama,
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Akun ' . $nama . ' berhasil dihapus');
        return redirect()->to(site_url('/admin/dataguru'));
    }

    // 3.3 Fitur tambah data guru dan hapus akun check

    public function tambahAkunGuru()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $data = [
            'title' => 'Data Guru | Eabsen',
            'header' => '',
        ];
        return view('/admin/dataguru/tambah', $data);
    }
    public function tambahAkunGuruProses()
    {
        $nip = $this->request->getVar('NIP');
        $nama = strtoupper($this->request->getVar('Nama'));
        $kelas = strtoupper($this->request->getVar('Kelas'));
        $password = $this->request->getVar('Password');

        $ceknip = $this->akunGuruModel->cekdata($nip);
        if ($ceknip) {
            session()->setFlashdata('error', 'Akun dengan NIP ' . $nip . ' sudah ada');
            return redirect()->to(site_url('/admin/dataguru'));
        } else {
            $this->akunGuruModel->insert([
                'id_user' => '2',
                'NIP' => $nip,
                'Nama_guru' => $nama,
                'walikelas' => $kelas,
                'Password_guru' => $password
            ]);
        }
        // Trigger After Insert guru
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '2',
            'deskripsi' => 'Tambah data akun guru dengan nama ' . strtolower($this->request->getVar('Nama')),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);

        session()->setFlashdata('pesan', 'Akun ' . $nama . ' berhasil ditambah');
        return redirect()->to(site_url('/admin/dataguru'));
    }
    public function hapusAkunCheckGuru()
    {
        $data = $this->request->getVar('pilihan_akun[]');
        $jumlahbaris = 0;
        if ($data == null) {
            session()->setFlashdata('error', 'Tidak ada baris yang terdeteksi');
            return redirect()->to(site_url('/admin/dataguru'));
        } else {
            foreach ($data as $dt) {
                $this->akunGuruModel->where('NIP', $dt)->delete();
                $jumlahbaris++;
            }
            // Trigger After Delete guru
            $this->logAktivitasModel->insert([
                'id_la' => id_log(),
                'id_user' => '4',
                'username' => 'Admin',
                'aktivitas' => '4',
                'deskripsi' => 'Hapus akun guru check',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahbaris . ' Data berhasil di hapus');
            return redirect()->to(site_url('/admin/dataguru'));
        }
    }

    // 4. FAQ

    public function faq()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $faqModel = new FaqModel();
        $faq = $faqModel->findAll();

        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/admin/faq/faq', $data);
    }
    public function tambahFaq()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
        ];
        return view('/admin/faq/tambah', $data);
    }
    public function tambahFaqProses()
    {
        $this->faqModel->insert([
            'id_faq' => id_faq(),
            'id_user' => '4',
            'faq' => $this->request->getVar('faq'),
            'isi_faq' => $this->request->getVar('isi_faq')
        ]);
        // Trigger After Insert faq
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '2',
            'deskripsi' => 'Tambah faq tentang ' . $this->request->getVar('faq'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', ' Faq berhasil di tambah');
        return redirect()->to(site_url('/admin/faq'));
    }
    public function editFaq()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $id = $this->request->getVar('id');
        $faq = $this->faqModel->where('id_faq', $id)->get()->getRow();
        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/admin/faq/edit', $data);
    }
    public function editFaqProses()
    {
        $id = $this->request->getVar('id');
        $this->faqModel->save([
            'id_faq' => $id,
            'id_user' => '4',
            'faq' => $this->request->getVar('faq'),
            'isi_faq' => $this->request->getVar('isi_faq')
        ]);
        // Trigger After Update faq
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '3',
            'deskripsi' => 'Update faq tentang ' . $this->request->getVar('faq'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', ' Faq berhasil di ubah');
        return redirect()->to(site_url('/admin/faq'));
    }
    public function hapusFaq()
    {
        $id = $this->request->getVar('id');
        $this->faqModel->where('id_faq', $id)->delete();
        // Trigger After Delete 
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus faq',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', ' Faq berhasil di hapus');
        return redirect()->to(site_url('/admin/faq'));
    }

    // Report

    public function report()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggalSet = date("Y-m-d");
        // $tanggal = $this->request->getVar('tanggal');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $absen = $this->akunSiswaModel->searchAdminReport($keyword);
        } else {
            $absen = $this->akunSiswaModel;
        }
        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
        $data = [
            'title' => 'Report | Eabsen',
            'header' => 'Report',
            'history' => $absen->paginate(50, 'siswa'),
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage,
            'tanggal' => $tanggalSet,
            'keyword' => $keyword
        ];
        return view('/admin/report/report', $data);
    }
    public function export_excel()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        $absen = $this->akunSiswaModel->like('Nama_siswa', $keyword)->orlike('NIS', $keyword)->orlike('Kelas', $keyword)->findAll();
        $data = [
            'history' => $absen
        ];
        return view('/admin/report/export_excel', $data);
    }
    public function export_excel_rekap()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        $NIS = $this->request->getVar('NIS');
        if ($keyword) {
            $isi = [$keyword, $NIS];
            $absen = $this->akunSiswaModel->searchRekapAdmin($isi);
        } else {
            $absen = $this->akunSiswaModel->join('absensi', 'siswa.NIS = absensi.NIS');
        }
        $Nama = $this->request->getVar('Nama');
        $Kelas = $this->request->getVar('Kelas');
        $Hadir = $this->request->getVar('Hadir');
        $Izin = $this->request->getVar('Izin');
        $Sakit = $this->request->getVar('Sakit');
        $absen = $absen->where('siswa.NIS', $NIS)->orderBy('absensi.tgl_absen', 'DESC')->findAll();
        $data = [
            'absen' => $absen,
            'NIS' => $NIS,
            'Nama' => $Nama,
            'Kelas' => $Kelas,
            'Hadir' => $Hadir,
            'Izin' => $Izin,
            'Sakit' => $Sakit
        ];
        return view('/admin/report/export_excel_rekap', $data);
    }
    public function export_excel_filter()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $Kelas = $this->request->getVar('Kelas');
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('Keterangan');
        $isi = [$Kelas, $tgl_absen, $keterangan];
        $absen = $this->akunSiswaModel->filterReport($isi)->findAll();
        $data = [
            'history' => $absen
        ];
        return view('/admin/report/export_excel_filter', $data);
    }
    public function rekapsiswa()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $NIS = $this->request->getVar('NIS');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $isi = [$keyword, $NIS];
            $absen = $this->akunSiswaModel->searchRekapAdmin($isi);
        } else {
            $absen = $this->akunSiswaModel->join('absensi', 'siswa.NIS = absensi.NIS');
        }
        $data_absen = $absen->where('siswa.NIS', $NIS)->orderBy('absensi.tgl_absen', 'DESC')->paginate(30, 'absensi');
        $data_siswa = $this->akunSiswaModel->where('NIS', $NIS)->get()->getRow();
        $currentPage = $this->request->getVar('page_absensi') ? $this->request->getVar('page_absensi') : 1;
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Rekap Data',
            'absen' => $data_absen,
            'data_siswa' => $data_siswa,
            'NIS' => $NIS,
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];
        return view('/admin/report/rekapsiswa', $data);
    }
    public function aturFilterReport()
    {
        session()->setFlashdata('formFilter', 'Atur Libur');
        return redirect()->to(site_url('/admin/report'));
    }
    public function filterReport()
    {
        if (session('username') != 'admin') {
            return redirect()->back();
        }
        $Kelas = $this->request->getVar('Kelas');
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('Keterangan');
        $isi = [$Kelas, $tgl_absen, $keterangan];
        $absen = $this->akunSiswaModel->filterReport($isi)->findAll();
        $data = [
            'title' => 'Report | Eabsen',
            'header' => 'Report',
            'history' => $absen,
            'Kelas' => $Kelas,
            'tgl_absen' => $tgl_absen,
            'keterangan' => $keterangan
        ];
        return view('/admin/report/filterreport', $data);
    }
    public function logout()
    {
        // Trigger After logout 
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '4',
            'username' => 'Admin',
            'aktivitas' => '0',
            'deskripsi' => 'Logout admin',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        return redirect()->to(site_url('/auth/logout'));
    }
}
