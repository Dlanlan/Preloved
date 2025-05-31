<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;

class Index extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['items'] = $productModel->findAll();

        if (session()->get('isLoggedIn')) {
            $userModel = new UserModel();
            $user = $userModel->find(session()->get('user_id'));
            $data['user'] = $user;
        }

        return view('home/index', $data);
    }
}
