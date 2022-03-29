<?php

namespace App\Controllers;

use App\Models\PesanSaranModel;

class Auth extends BaseController
{
    protected $pesanSaranModel;
    public function __construct()
    {
        $this->pesanSaranModel = new PesanSaranModel();
    }
    public function login()
    {
        if (session('NIS')) {
            return redirect()->to(site_url('users'));
        } elseif (session('NIP')) {
            return redirect()->to(site_url('guru'));
        } elseif (session('username') == "admin") {
            return redirect()->to(site_url('admin'));
        } elseif (session('username') == "piket") {
            return redirect()->to(site_url('piket'));
        }

        $data = [
            'title' => 'Login | Eabsen'
        ];
        return view('/auth/login', $data);
    }
    public function loginProcess()
    {
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('Password'));
        $password_user = $this->request->getVar('Password');
        $siswa = $this->db->table('user')
            ->join('siswa', 'user.id_user = siswa.id_user')
            ->where('NIS', $username)
            ->get()
            ->getRow();
        $guru = $this->db->table('user')
            ->join('guru', 'user.id_user = guru.id_user')
            ->where('NIP', $username)
            ->get()
            ->getRow();
        $user = $this->db->table('user')
            ->where('username', $username)
            ->get()
            ->getRow();
        if ($siswa) {
            if ($password == $siswa->Password_siswa and $siswa->NIS == $username and $siswa->id_user == "1") {
                $params = ['NIS' => $siswa->NIS];
                // Trigger After login siswa 
                $this->logAktivitasModel->insert([
                    'id_la' => id_log(),
                    'id_user' => '1',
                    'username' => $siswa->NIS,
                    'aktivitas' => '1',
                    'deskripsi' => 'Login sebagai siswa',
                    'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                ]);
                session()->set($params);
                return redirect()->to(site_url('users'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else if ($guru) {
            if ($password_user == $guru->Password_guru and $guru->NIP == $username and $guru->id_user == "2") {
                $params = ['NIP' => $guru->NIP];
                // Trigger After login guru 
                $this->logAktivitasModel->insert([
                    'id_la' => id_log(),
                    'id_user' => '2',
                    'username' => $guru->NIP,
                    'aktivitas' => '1',
                    'deskripsi' => 'Login sebagai guru',
                    'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                ]);
                session()->set($params);
                return redirect()->to(site_url('guru'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else if ($user) {
            if ($password_user == $user->password and $user->username == $username and $user->id_user == "3") {
                $params = ['username' => $user->username];
                // Trigger After login piket
                $this->logAktivitasModel->insert([
                    'id_la' => id_log(),
                    'id_user' => '3',
                    'username' => 'Piket',
                    'aktivitas' => '1',
                    'deskripsi' => 'Login piket',
                    'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                ]);
                session()->set($params);
                return redirect()->to(site_url('piket'));
            } elseif ($password_user == $user->password and $user->username == $username and $user->id_user == "4") {
                $params = ['username' => $user->username];
                // Trigger After login Admin
                $this->logAktivitasModel->insert([
                    'id_la' => id_log(),
                    'id_user' => '4',
                    'username' => 'Admin',
                    'aktivitas' => '1',
                    'deskripsi' => 'Login admin',
                    'alamat_akses' => $this->request->getIPAddress() . ' , ' . $this->agent->getPlatform() . ' , ' . $this->agent->getBrowser() . " " . $this->agent->getVersion()
                ]);
                session()->set($params);
                return redirect()->to(site_url('admin'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Data tidak valid');
        }
    }
    public function onepage()
    {
        if (session('NIS')) {
            return redirect()->to(site_url('users'));
        } elseif (session('NIP')) {
            return redirect()->to(site_url('guru'));
        } elseif (session('username') == "admin") {
            return redirect()->to(site_url('admin'));
        } elseif (session('username') == "piket") {
            return redirect()->to(site_url('piket'));
        }
        // Membuat kode otomatis 4 digit angka
        $data_kode = $this->pesanSaranModel->selectMax('id_ps')->get()->getRow();
        $nourut = substr($data_kode->id_ps, 2, 4);
        $kode_sekarang = $nourut + 1;
        $kode = "PS" . sprintf("%04s", $kode_sekarang);

        $data = [
            'title' => 'Welcome | Eabsen',
            'kode' => $kode
        ];
        return view('/auth/onepage', $data);
    }
    public function pesan()
    {
        // Membuat kode otomatis
        $data_kode = $this->pesanSaranModel->selectMax('id_ps')->get()->getRow();
        $nourut = (int)substr($data_kode->id_ps, 2, 4);
        $kode_sekarang = $nourut + 1;
        $kode = "PS" . sprintf("%04s", $kode_sekarang);


        $NIS = $this->request->getVar('NIS');
        $post = $this->request->getPost();
        $query = $this->db->table('siswa')->where(['NIS' => $post['NIS']]);
        $user = $query->get()->getRow();

        if (!isset($user)) {
            return redirect()->back()->with('error', 'NIS yang anda masukan tidak terdaftar');
        } elseif ($NIS == $user->NIS) {
            $builder = $this->pesanSaranModel;
            $builder->like('NIS', $user->NIS);
            $ambil_data_baris = $builder->countAllResults();
            if ($ambil_data_baris == 3) {
                return redirect()->back()->with('error', 'Anda sudah 3 kali memberi saran');
            } else {
                $this->pesanSaranModel->insert([
                    'id_ps' => $kode,
                    'NIS' => $user->NIS,
                    'pesan' => $this->request->getVar('pesan')
                ]);
                return redirect()->back()->with('success', 'Saran anda telah terkirim');
            }
            return redirect()->to(site_url('/auth/onepage'));
        }
    }
    public function logout()
    {
        session()->remove('NIS');
        session()->remove('NIP');
        session()->remove('username');
        return redirect()->to(site_url('/auth/login'));
    }
}
