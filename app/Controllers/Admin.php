<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\OrderHeaderModel;
use App\Models\OrderItemModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;
use App\Models\MessageModel;

class Admin extends Controller
{
    public function dashboard()
    {
        $userModel = new UserModel();
        $productModel = new ProductModel();
        $orderModel = new OrderHeaderModel();
        $categoryModel = new CategoryModel();

        $data = [
            'totalUsers' => $userModel->countAll(),
            'totalProducts' => $productModel->countAll(),
            'totalOrders' => $orderModel->countAll(),
            'totalCategories' => $categoryModel->countAll()
        ];

        return view('admin/dashboard', $data);
    }

    public function users()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('admin/users', $data);
    }

    public function products()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getAllWithSeller();
        return view('admin/products', $data);
    }

    public function orders()
    {
        $orderModel = new OrderHeaderModel();
        $data['orders'] = $orderModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/orders', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        $orderModel = new OrderHeaderModel();
        $orderModel->update($id, ['status' => $status]);
        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    public function categories()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->findAll();
        return view('admin/categories', $data);
    }

    public function addCategory()
    {
        $model = new CategoryModel();
        $name = $this->request->getPost('name');

        if ($name) {
            $model->save(['name' => $name]);
        }

        return redirect()->to('/admin/categories');
    }

    public function deleteCategory($id)
    {
        $model = new CategoryModel();
        $model->delete($id);
        return redirect()->to('/admin/categories');
    }

    public function messages()
    {
        $model = new MessageModel();

        $data['messages'] = $model
            ->select('messages.*, users.username')
            ->join('users', 'users.id = messages.user_id', 'left')
            ->orderBy('messages.created_at', 'DESC')
            ->findAll();

        return view('admin/messages', $data);
    }
}