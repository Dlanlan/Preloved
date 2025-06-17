<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\OrderItemModel;

class Profile extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('user/profile', ['user' => $user]);
    }

    public function penjualan()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $model = new OrderItemModel();

        $penjualan = $model->select('order_items.*, 
                                 order_headers.created_at, 
                                 users.username as buyer_username, 
                                 products.title, 
                                 categories.name as category_name')
            ->join('products', 'products.id = order_items.product_id')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->join('order_headers', 'order_headers.id = order_items.order_id')
            ->join('users', 'users.id = order_headers.buyer_id')
            ->where('products.user_id', $userId)
            ->orderBy('order_headers.created_at', 'DESC')
            ->findAll();

        return view('user/penjualan', ['penjualan' => $penjualan]);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $newUsername = $this->request->getPost('username');
        $data = [];

        // Cek apakah username berubah
        if ($newUsername !== $user['username']) {
            // Cek ke database apakah sudah ada
            if ($userModel->where('username', $newUsername)->where('id !=', $userId)->first()) {
                return redirect()->back()->with('error', 'Username sudah terdaftar.');
            }

            // Validasi panjang minimal
            if (strlen($newUsername) < 3) {
                return redirect()->back()->with('error', 'Username minimal 3 karakter.');
            }

            $data['username'] = $newUsername;
        }

        // Validasi password jika diisi
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                return redirect()->back()->with('error', 'Password minimal 6 karakter.');
            }
            $data['password'] = $password; // akan di-hash oleh model
        }

        // Validasi dan upload avatar
        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $mimeType = $avatar->getMimeType();
            $maxSize = 2 * 1024 * 1024;

            if (!in_array($mimeType, ['image/jpeg', 'image/png'])) {
                return redirect()->back()->with('error', 'File harus berupa JPG atau PNG.');
            }

            if ($avatar->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file maksimal 2MB.');
            }

            $newName = $avatar->getRandomName();
            $avatar->move('uploads/avatar/', $newName);

            if (!empty($user['photo']) && file_exists('uploads/avatar/' . $user['photo'])) {
                unlink('uploads/avatar/' . $user['photo']);
            }

            $data['photo'] = $newName;
            session()->set('photo', $newName);
        }

        if (!empty($data) && $userModel->update($userId, $data)) {
            if (isset($data['username'])) {
                session()->set('username', $data['username']);
            }
            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui profil atau tidak ada perubahan.');
        }
    }

}
