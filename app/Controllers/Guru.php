<?php

namespace App\Controllers;

use App\Models\FaqModel;

class Guru extends BaseController
{
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard'
        ];
        return view('/guru/dashboard/dashboard', $data);
    }
    public function tabelBelumAbsen()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard | Siswa Belum Absen'
        ];
        return view('/guru/dashboard/tabelBelumAbsen', $data);
    }
    public function tabelKeterangan()
    {
        $data = [
            'title' => 'Dashboard | Eabsen',
            'header' => 'Dashboard | Siswa Izin'
        ];
        return view('/guru/dashboard/tabelKeterangan', $data);
    }
    public function dataAbsen()
    {
        $data = [
            'title' => 'Data Absen | Eabsen',
            'header' => 'Data Absen'
        ];
        return view('/guru/absen/dataAbsen', $data);
    }
    public function dataSiswa()
    {
        $data = [
            'title' => 'Data Siswa | Eabsen',
            'header' => 'Data Siswa XII RPL 1'
        ];
        return view('/guru/dataSiswa', $data);
    }
    public function profil()
    {
        $data = [
            'title' => 'Profil | Eabsen',
            'header' => 'Profil'
        ];
        return view('/guru/profil/profilGuru', $data);
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
        return view('/guru/faq', $data);
    }
    public function report()
    {
        $data = [
            'title' => 'Report | Eabsen',
            'header' => 'Report'
        ];
        return view('/guru/report/report', $data);
    }
    public function logout()
    {
        $data = [
            'title' => 'Login | Eabsen'
        ];
        return view('/auth/login', $data);
    }
}
