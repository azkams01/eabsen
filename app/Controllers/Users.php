<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\AkunSiswaModel;

class Users extends BaseController
{
    protected $akunSiswaModel;
    public function __construct()
    {
        $this->akunSiswaModel = new AkunSiswaModel();
    }
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard'
        ];
        return view('/users/dashboard/dashboard', $data);
    }
    public function dataHadir()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard | Data Kehadiran'
        ];
        return view('/users/dashboard/dataHadir', $data);
    }
    public function dataRiwayat()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard | Riwayat Absensi'
        ];
        return view('/users/dashboard/dataRiwayat', $data);
    }
    public function absen()
    {
        $data = [
            'title' => 'Absen | Eabsen',
            'header' => 'Absen'
        ];
        return view('/users/absen/absen', $data);
    }
    public function profil()
    {
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Profil'
        ];
        return view('/users/profil/profil', $data);
    }
    public function pengaturan()
    {
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Profil | Pengaturan'
        ];
        return view('/users/profil/pengaturan', $data);
    }
    public function faq()
    {
        $faqModel = new FaqModel();
        $faq = $faqModel->findAll();

        $data = [
            'title' => 'FAQ | Eabsen',
            'header' => 'FAQ',
            'faq' => $faq
        ];
        return view('/users/faq', $data);
    }
    public function logout()
    {
        $data = [
            'title' => 'Login | Eabsen'
        ];
        return view('/auth/login', $data);
    }
    public function ubahPassword($id)
    {
        $this->akunSiswaModel->save([
            'id' => $id,
            'Password' => $this->request->getVar('Password')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(site_url('users'));
    }
    public function profilProses($id)
    {
        $this->akunSiswaModel->save([
            'id' => $id,
            'JenisKelamin' => $this->request->getVar('JenisKelamin'),
            'Email' => $this->request->getVar('Email'),
            'NomorHp' => $this->request->getVar('NomorHp'),
            'Alamat' => $this->request->getVar('Alamat')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(site_url('/users/profil'));
    }
}
