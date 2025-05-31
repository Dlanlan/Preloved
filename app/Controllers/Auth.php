<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/auth'); // satu view gabungan untuk login dan register
    }

    public function loginPost()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        if (!$username || !$password || !in_array($role, ['penjual', 'pembeli'])) {
            return redirect()->to('/auth')->withInput()->with('error', 'Semua field harus diisi dengan benar.')
                ->with('form_mode', 'login');
        }

        $user = $userModel
            ->where('username', $username)
            ->where('role', $role)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/');
        }

        return redirect()->to('/auth')->withInput()->with('error', 'Username, password, atau role salah.')
            ->with('form_mode', 'login');
    }

    public function registerPost()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        if (!$username || !$password || !in_array($role, ['penjual', 'pembeli'])) {
            return redirect()->to('/auth')->withInput()->with('error', 'Data tidak valid.')
                ->with('form_mode', 'register');
        }

        if ($userModel->where('username', $username)->first()) {
            return redirect()->to('/auth')->withInput()->with('error', 'Username sudah terdaftar.')
                ->with('form_mode', 'register');
        }

        $userModel->save([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
        ]);

        return redirect()->to('/auth')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

