<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\AkunGuruModel;

class Guru extends BaseController
{
    public function dashboard()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $pemberitahuan = $this->pemberitahuanModel->orderBy('id_pemberitahuan', 'DESC')->findAll();
        $gabung_hadir = ['Hadir|Masuk', 'Hadir'];
        $data_hadir = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS',)->whereIn('absensi.keterangan_absen', $gabung_hadir)->where('absensi.tgl_absen', $tanggal)->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $data_sakit = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS',)->where('absensi.keterangan_absen', 'Sakit')->where('absensi.tgl_absen', $tanggal)->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $data_izin = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS',)->where('absensi.keterangan_absen', 'Izin')->where('absensi.tgl_absen', $tanggal)->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $data_sakit_pending = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS',)->where('absensi.keterangan_absen', 'Sakit|Pending')->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $data_izin_pending = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS',)->where('absensi.keterangan_absen', 'Izin|Pending')->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $databa = $this->akunSiswaModel->join('absensi', 'absensi.NIS = siswa.NIS', 'left')->where('absensi.tgl_absen', $tanggal)->where('siswa.Kelas', akunGuru()->walikelas)->countAllResults();
        $datasemua = $this->akunSiswaModel->where('Kelas', akunGuru()->walikelas)->countAllResults();
        $datasemuapending = $data_izin_pending + $data_sakit_pending;
        $data_belum_absen = $datasemua - $databa;
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard',
            'ambil_data_baris' => $data_hadir,
            'pemberitahuan' => $pemberitahuan,
            'data_hadir' => $data_hadir,
            'data_sakit' => $data_sakit,
            'data_izin' => $data_izin,
            'tanggal' => $tanggal,
            'data_belum_absen' => $data_belum_absen,
            'data_pending' => $datasemuapending
        ];
        return view('/guru/dashboard/dashboard', $data);
    }
    public function keteranganAbsen()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $keterangan = $this->request->getVar('keterangan');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            if ($keterangan == "Hadir") {
                $absen = $this->absensiModel->searchGuruHadir($keyword);
            } else if ($keterangan == "Sakit") {
                $absen = $this->absensiModel->searchGuruSakit($keyword);
            } else if ($keterangan == "Izin") {
                $absen = $this->absensiModel->searchGuruIzin($keyword);
            } else {
                return redirect()->back()->with('gagal', 'Kesalahan Entry , Coba Kembali');
            }
        } else {
            $absen = $this->absensiModel->join('siswa', 'absensi.NIS = siswa.NIS');
        }
        if ($keterangan == "Hadir") {
            $data = ['Hadir|Masuk', 'Hadir'];
            $dataKeterangan = $absen->where('Kelas', akunGuru()->walikelas)->whereIn('keterangan_absen', $data)->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
            $header = 'Data Hadir';
        } else if ($keterangan == "Sakit") {
            $dataKeterangan = $absen->where('Kelas', akunGuru()->walikelas)->where('keterangan_absen', 'Sakit')->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
            $header = 'Data Sakit';
        } else if ($keterangan == "Izin") {
            $dataKeterangan = $absen->where('Kelas', akunGuru()->walikelas)->where('keterangan_absen', 'Izin')->where('tgl_absen', $tanggal)->paginate(50, 'absensi');
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
        return view('/guru/dashboard/keteranganabsen', $data);
    }
    public function tabelPersetujuan()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $kelas = akunGuru()->walikelas;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $absen = $this->akunSiswaModel->searchPersetujuan($keyword);
        } else {
            $absen = $this->akunSiswaModel->join('absensi', 'siswa.NIS = absensi.NIS');
        }
        $currentPage = $this->request->getVar('page_absensi') ? $this->request->getVar('page_absensi') : 1;
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Acc Keterangan',
            'data' => $absen->where('siswa.Kelas', $kelas)->like('absensi.keterangan_absen', 'Pending')->orderBy('absensi.tgl_absen', 'DESC')->paginate(7, 'absensi'),
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/guru/dashboard/tabelpersetujuan', $data);
    }
    public function setujuKeterangan()
    {
        $id = $this->request->getVar('id');
        $keterangan = $this->request->getVar('keterangan');
        if ($keterangan == "Sakit|Pending") {
            $keterangan_absen = "Sakit";
        } else {
            $keterangan_absen = "Izin";
        }
        $this->absensiModel->save([
            'id_absensi' => $id,
            'keterangan_absen' => $keterangan_absen
        ]);
        // Trigger Setuju Keterangan
        $this->logAktivitasModel->save([
            'id_la' => id_log(),
            'user_id' => '2',
            'username' => akunGuru()->NIP,
            'aktivitas' => '3',
            'deskripsi' => 'Meng acc permohonan ' . $keterangan_absen,
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Permohonan berhasil di setujui');
        return redirect()->to(site_url('/guru/tabelPersetujuan'));
    }
    public function tolakPersetujuan()
    {
        $id = $this->request->getVar('id');
        $this->absensiModel->where('id_absensi', $id)->delete();
        // Trigger Tolak Keterangan
        $this->logAktivitasModel->save([
            'id_la' => id_log(),
            'user_id' => '2',
            'username' => akunGuru()->NIP,
            'aktivitas' => '3',
            'deskripsi' => 'Menolak permohonan absen keterangan',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Permohonan berhasil di tolak ( Data yang ditolak otomatis dihapus )');
        return redirect()->to(site_url('/guru/tabelPersetujuan'));
    }
    public function setujuCheck()
    {
        $data = $this->request->getVar('pilihan_akun[]');
        $jumlahbaris = 0;
        if ($data == null) {
            session()->setFlashdata('gagal', 'Tidak ada baris yang terdeteksi');
            return redirect()->to(site_url('/guru/tabelPersetujuan'));
        } else {
            foreach ($data as $dt) {
                $pisah = explode("|", $dt);
                if ($pisah[1] == "Sakit|Pending") {
                    $keterangan_absen = "Sakit";
                } else {
                    $keterangan_absen = "Izin";
                }
                $this->absensiModel->save([
                    'id_absensi' => $pisah[0],
                    'keterangan_absen' => $keterangan_absen
                ]);
                $jumlahbaris++;
            }
            // Trigger After Update Absen Keterangan
            $this->logAktivitasModel->save([
                'id_la' => id_log(),
                'user_id' => '2',
                'username' => akunGuru()->NIP,
                'aktivitas' => '3',
                'deskripsi' => 'Meng acc absen keterangan',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', $jumlahbaris . ' siswa berhasil di acc permohonannya');
            return redirect()->to(site_url('/guru/tabelPersetujuan'));
        }
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
    public function datasiswa()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data_siswa = $this->akunSiswaModel->searchSiswaGuru($keyword);
        } else {
            $data_siswa = $this->akunSiswaModel;
        }
        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
        $data = [
            'title' => 'Data Siswa | Eabsen',
            'header' => 'Data Siswa ' . akunGuru()->walikelas,
            'akun_siswa' => $data_siswa->where('Kelas', akunGuru()->walikelas)->orderBy('Kelas', 'ASC')->paginate(32, 'siswa'),
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/guru/datasiswa/datasiswa', $data);
    }
    public function Details()
    {
        $id = $this->request->getVar('id');
        $data = $this->akunSiswaModel->where('NIS', $id)->find();
        session()->setFlashdata('Details', $data[0]['Nama_siswa']);
        session()->setFlashdata('NIS', $data[0]['NIS']);
        session()->setFlashdata('Kelas', $data[0]['Kelas']);
        session()->setFlashdata('JenisKelamin', $data[0]['JenisKelamin_siswa']);
        session()->setFlashdata('Foto', $data[0]['Foto_siswa']);
        session()->setFlashdata('Alamat', $data[0]['Alamat_siswa']);
        session()->setFlashdata('Email', $data[0]['Email_siswa']);
        session()->setFlashdata('NomorHp', $data[0]['NomorHp_siswa']);
        return redirect()->to(site_url('/guru/datasiswa'));
    }
    public function profil()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Profil'
        ];
        return view('/guru/profil/profil', $data);
    }
    public function pengaturan()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Pengaturan',
            'validation' => \Config\Services::validation()
        ];
        return view('/guru/profil/pengaturan', $data);
    }
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

        $this->akunGuruModel->save([
            'NIP' => $id,
            'Foto_guru' => $namaFoto,
            'JenisKelamin_guru' => $this->request->getVar('JenisKelamin'),
            'Email_guru' => $this->request->getVar('Email'),
            'NomorHp_guru' => $this->request->getVar('NomorHp'),
            'Alamat_guru' => $this->request->getVar('Alamat')
        ]);
        // Trigger After Update Profil Guru
        $this->logAktivitasModel->save([
            'id_la' => id_log(),
            'user_id' => '2',
            'username' => akunGuru()->NIP,
            'aktivitas' => '3',
            'deskripsi' => 'Update Profil',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(site_url('/guru/profil'));
    }
    public function faq()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $faq = $this->faqModel->findAll();
        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/guru/faq', $data);
    }
    // Report Guru

    public function report()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggalSet = date("Y-m-d");
        // $tanggal = $this->request->getVar('tanggal');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $absen = $this->akunSiswaModel->searchGuruReport($keyword);
        } else {
            $absen = $this->akunSiswaModel;
        }
        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
        $data = [
            'title' => 'Report | Eabsen',
            'header' => 'Report',
            'history' => $absen->where('Kelas', akunGuru()->walikelas)->paginate(50, 'siswa'),
            'pager' => $this->akunSiswaModel->pager,
            'currentPage' => $currentPage,
            'tanggal' => $tanggalSet,
            'keyword' => $keyword
        ];
        return view('/guru/report/report', $data);
    }
    public function export_excel()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $keyword = $this->request->getVar('keyword');
        $absen = $this->akunSiswaModel->where('Kelas', akunGuru()->walikelas)->like('Nama_siswa', $keyword)->orlike('NIS', $keyword)->orlike('Kelas', $keyword)->findAll();
        $data = [
            'history' => $absen
        ];
        return view('/guru/report/export_excel', $data);
    }
    public function export_excel_rekap()
    {
        if (!session('NIP')) {
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
        $absen = $absen->where('siswa.NIS', $NIS)->where('siswa.Kelas', akunGuru()->walikelas)->orderBy('absensi.tgl_absen', 'DESC')->findAll();
        $data = [
            'absen' => $absen,
            'NIS' => $NIS,
            'Nama' => $Nama,
            'Kelas' => $Kelas,
            'Hadir' => $Hadir,
            'Izin' => $Izin,
            'Sakit' => $Sakit
        ];
        return view('/guru/report/export_excel_rekap', $data);
    }
    public function export_excel_filter()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $Kelas = akunGuru()->walikelas;
        $tgl_absen = $this->request->getVar('tgl_absen');
        $keterangan = $this->request->getVar('Keterangan');
        $isi = [$Kelas, $tgl_absen, $keterangan];
        $absen = $this->akunSiswaModel->filterReport($isi)->findAll();
        $data = [
            'history' => $absen
        ];
        return view('/guru/report/export_excel_filter', $data);
    }
    public function rekapsiswa()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $NIS = $this->request->getVar('NIS');
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $isi = [$keyword, $NIS];
            $absen = $this->akunSiswaModel->searchRekapGuru($isi);
        } else {
            $absen = $this->akunSiswaModel->join('absensi', 'siswa.NIS = absensi.NIS');
        }
        $data_absen = $absen->where('siswa.NIS', $NIS)->orderBy('absensi.tgl_absen', 'DESC')->paginate(30, 'absensi');
        $data_siswa = $this->akunSiswaModel->where('NIS', $NIS)->where('Kelas', akunGuru()->walikelas)->get()->getRow();
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
        return view('/guru/report/rekapsiswa', $data);
    }
    public function aturFilterReport()
    {
        session()->setFlashdata('formFilter', 'Atur Libur');
        return redirect()->to(site_url('/guru/report'));
    }
    public function filterReport()
    {
        if (!session('NIP')) {
            return redirect()->back();
        }
        $Kelas = akunGuru()->walikelas;
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
        return view('/guru/report/filterreport', $data);
    }
    public function logout()
    {
        // Trigger logout guru 
        $this->logAktivitasModel->save([
            'id_la' => id_log(),
            'user_id' => '2',
            'username' => akunGuru()->NIP,
            'aktivitas' => '0',
            'deskripsi' => 'Logout dengan NIP ' . akunGuru()->NIP,
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        return redirect()->to(site_url('/auth/logout'));
    }
}
