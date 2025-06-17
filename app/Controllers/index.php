<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\MessageModel;

class Index extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        // Ambil produk dengan status 'tersedia' dan urutkan terbaru
        $items = $productModel
            ->where('status', 'tersedia')
            ->orderBy('created_at', 'DESC')
            ->findAll(); // Bisa juga pakai ->limit(20)->find();

        $data = ['items' => $items];

        // Jika user login, ambil datanya
        if (session()->get('isLoggedIn')) {
            $userModel = new UserModel();
            $user = $userModel->find(session()->get('user_id'));
            $data['user'] = $user;
        }

        return view('home/index', $data);
    }

    public function about()
    {
        return view('about/index');
    }

    public function contact()
    {
        return view('contact/index');
    }

    public function sendContact()
    {
        helper(['form']);

        $rules = [
            'message' => 'required|min_length[5]',
            'subject' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', \Config\Services::validation()->getErrors());
        }

        $model = new MessageModel();

        $model->insert([
            'user_id' => session()->get('user_id'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message')
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }
}
