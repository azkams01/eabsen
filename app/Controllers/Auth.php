<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        if (session('NIS')) {
            return redirect()->to(site_url('users'));
        } elseif (session('NIP')) {
            return redirect()->to(site_url('guru'));
        }
        $data = [
            'title' => 'Login | Eabsen'
        ];
        return view('/auth/login', $data);
    }
    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('akun_siswa')->getWhere(['NIS' => $post['NIS/NIP']]);
        $query_guru = $this->db->table('akun_guru')->getWhere(['NIP' => $post['NIS/NIP']]);
        $user = $query->getRow();
        $guru = $query_guru->getRow();
        if ($user) {
            if ($post['Password'] == $user->Password) {
                $params = ['NIS' => $user->NIS];
                session()->set($params);
                return redirect()->to(site_url('users'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else if ($guru) {
            if ($post['Password'] == $guru->Password) {
                $params = ['NIP' => $guru->NIP];
                session()->set($params);
                return redirect()->to(site_url('guru'));
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Email gaada');
        }
    }
    public function onepage()
    {
        $data = [
            'title' => 'Welcome | Eabsen'
        ];
        return view('/auth/onepage', $data);
    }
    public function logout()
    {
        session()->remove('NIS');
        session()->remove('NIP');
        return redirect()->to(site_url('/auth/login'));
    }
}
