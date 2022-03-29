<?php

namespace App\Controllers;

use App\Models\PemberitahuanModel;

class Piket extends BaseController
{
    public function absen()
    {
        if (session('username') != 'piket') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $data = [
            'title' => 'Absen | QR-Generator',
            'header' => 'Absen',
            'tanggal' => $tanggal,
            'waktu' => $waktu
        ];
        return view('/piket/absen/absen', $data);
    }
    public function pengaturan()
    {
        if (session('username') != 'piket') {
            return redirect()->back();
        }
        $tanggalLibur = $this->tanggalLiburModel->orderBy('id_libur', 'DESC')->findAll();
        $tenggatAbsen = $this->tenggatAbsenModel->orderBy('id_ta', 'DESC')->findAll();
        $pemberitahuan = $this->pemberitahuanModel->orderBy('id_pemberitahuan', 'DESC')->findAll();
        $data = [
            'title' => 'Pengaturan | Eabsen',
            'header' => 'Pengaturan',
            'pemberitahuan' => $pemberitahuan,
            'tanggalLibur' => $tanggalLibur,
            'tenggatAbsen' => $tenggatAbsen
        ];
        return view('/piket/absen/pengaturan', $data);
    }
    public function pemberitahuanTambah()
    {
        if (session('username') != 'piket') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Pengaturan',
            'tanggal' => $tanggal
        ];
        return view('/piket/absen/pemberitahuanTambah', $data);
    }
    public function pemberitahuanEdit($id)
    {
        if (session('username') != 'piket') {
            return redirect()->back();
        }
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $pemberitahuan = $this->pemberitahuanModel->find($id);
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Pengaturan',
            'tanggal' => $tanggal,
            'pemberitahuan' => $pemberitahuan
        ];
        return view('/piket/absen/pemberitahuanEdit', $data);
    }
    public function pemberitahuanHapus($id)
    {
        $this->pemberitahuanModel->delete($id);
        // Trigger After Delete Pemberitahuan
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus Pemberitahuan',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di hapus');
        return redirect()->to(site_url('/piket/pengaturan'));
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
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '2',
            'deskripsi' => 'Tambah pemberitahuan , dengan narasumber ' .  $this->request->getVar('narasumber'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di publish');
        return redirect()->to(site_url('/piket/pemberitahuanTambah'));
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
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '3',
            'deskripsi' => 'Update pemberitahuan dari informasi yang ditulis ' .  $this->request->getVar('narasumber'),
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Pemberitahuan berhasil di update');
        return redirect()->to(site_url('/piket/pemberitahuanTambah'));
    }
    public function restartAbsen()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $this->absensiModel->where('tgl_absen', $tanggal)->delete();
        // Trigger After Delete absensi
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '4',
            'deskripsi' => 'Restart Absen',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Absen berhasil di restart');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
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
                'id_user' => '3',
                'username' => 'Piket',
                'aktivitas' => '2',
                'deskripsi' => 'Tambah tanggal libur pada ' . $this->request->getVar('tgl_libur') . ' dengan keterangan ' . $this->request->getVar('keterangan'),
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', 'Hari libur berhasil di set');
            return redirect()->to(site_url('/piket/pengaturan'));
        }
    }
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
                'id_user' => '3',
                'username' => 'Piket',
                'aktivitas' => '2',
                'deskripsi' => 'Tambah tenggat absen',
                'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
            ]);
            session()->setFlashdata('pesan', 'Tenggat absen berhasil di set');
            return redirect()->to(site_url('/piket/pengaturan'));
        }
    }
    public function aturLiburHapus($id)
    {
        $this->tanggalLiburModel->where('id_libur', $id)->delete();
        // Trigger After Delete libur
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus tanggal libur',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Tenggat absen telah terhapus');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
    public function aturTenggatHapus($id)
    {
        $this->tenggatAbsenModel->where('id_ta', $id)->delete();
        // Trigger After Delete tenggat_absen
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '4',
            'deskripsi' => 'Hapus tenggat absen',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        session()->setFlashdata('pesan', 'Tenggat absen telah terhapus');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
    public function konfirmasiRestart()
    {
        session()->setFlashdata('konfirmasi', 'Yakin Mau di restart ?');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
    public function aturLiburTambah()
    {
        session()->setFlashdata('formLibur', 'Atur Libur');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
    public function aturTenggatTambah()
    {
        session()->setFlashdata('formTenggat', 'Atur Tenggat');
        return redirect()->to(site_url('/piket/pengaturan'));
    }
    public function matikanQr()
    {
        session()->set('matikan', 'QR Code Generator dimatikan');
        return redirect()->to(site_url('/piket/absen'));
    }
    public function nyalakanQr()
    {
        session()->remove('matikan');
        return redirect()->to(site_url('/piket/absen'));
    }
    public function faq()
    {
        if (session('username') != 'piket') {
            return redirect()->back();
        }
        $faq = $this->faqModel->findAll();

        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/piket/faq', $data);
    }
    public function logout()
    {
        // Trigger After logout 
        $this->logAktivitasModel->insert([
            'id_la' => id_log(),
            'id_user' => '3',
            'username' => 'Piket',
            'aktivitas' => '0',
            'deskripsi' => 'Logout piket',
            'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
        ]);
        return redirect()->to(site_url('/auth/logout'));
    }
}
