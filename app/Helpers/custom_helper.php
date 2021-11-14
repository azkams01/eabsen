<?php
function akunSiswa()
{
    $db = \config\Database::connect();
    return $db->table('akun_siswa')->where('NIS', session('NIS'))->get()->getRow();
}
function akunGuru()
{
    $db = \config\Database::connect();
    return $db->table('akun_guru')->where('NIP', session('NIP'))->get()->getRow();
}
