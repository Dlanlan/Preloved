<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/auth');
    }

    public function loginPost()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Ambil user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/login')->withInput()->with('error', 'Username atau password salah.')
                ->with('form_mode', 'login');
        }

        // Verifikasi password hash
        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Username atau password salah.')
                ->with('form_mode', 'login');
        }

        // Simpan session login
        $session->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/');
    }

    public function registerPost()
    {
        $userModel = new UserModel();

        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        // Validasi awal
        if (!$username || !$password) {
            return redirect()->to('/auth')->withInput()->with('error', 'Semua field harus diisi.')
                ->with('form_mode', 'register');
        }

        // Cek jika username sudah ada
        if ($userModel->where('username', $username)->first()) {
            return redirect()->to('/auth')->withInput()->with('error', 'Username sudah terdaftar.')
                ->with('form_mode', 'register');
        }

        // Hash password sebelum simpan
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel->save([
            'username' => $username,
            'password' => $hashPassword,
            'role' => 'user',
        ]);

        return redirect()->to('/auth')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
