<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        helper(['form']);
    }

    public function index()
    {
        $data['categories'] = $this->categoryModel->findAll();
        return view('admin/categories', $data);
    }

    public function addCategory()
    {
        $validation = \Config\Services::validation();
        $rules = ['name' => 'required|min_length[2]|is_unique[categories.name]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->categoryModel->insert([
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/admin/categories');
    }

    public function deleteCategory($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/admin/categories');
    }
}
