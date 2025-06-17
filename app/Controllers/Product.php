<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        helper(['form', 'url']);
    }

    // Default redirect
    public function index()
    {
        return redirect()->to('/product/my');
    }

    // 1. Produk milik user login
    public function my()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $products = $this->productModel
            ->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('product/my_products', ['products' => $products]);
    }

    // 2. Form tambah produk
    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $categories = (new CategoryModel())->findAll();

        // PERBAIKAN: arahkan ke folder user/create.php
        return view('user/create', ['categories' => $categories]);
    }

    // 3. Simpan produk baru
    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'price' => 'required|numeric',
            'product_condition' => 'required|in_list[baru,bekas]',
            'category_id' => 'required|is_natural_no_zero',
            'photo' => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $photo = $this->request->getFile('photo');
        $photoName = $photo->getRandomName();
        $photo->move('uploads', $photoName);

        $this->productModel->save([
            'user_id' => session()->get('user_id'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'photo' => $photoName,
            'price' => $this->request->getPost('price'),
            'product_condition' => $this->request->getPost('product_condition'),
            'category_id' => $this->request->getPost('category_id'),
            'status' => 'tersedia'
        ]);

        return redirect()->to('/product/my');
    }

    // 4. Form edit produk
    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product/my')->with('error', 'Akses ditolak.');
        }

        $categories = (new CategoryModel())->findAll();

        return view('product/edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // 5. Update produk
    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product/my')->with('error', 'Akses ditolak.');
        }

        $photo = $this->request->getFile('photo');
        $photoName = $product['photo'];

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $photoName = $photo->getRandomName();
            $photo->move('uploads', $photoName);
            if (is_file('uploads/' . $product['photo'])) {
                unlink('uploads/' . $product['photo']);
            }
        }

        $this->productModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'photo' => $photoName,
            'price' => $this->request->getPost('price'),
            'product_condition' => $this->request->getPost('product_condition'),
            'category_id' => $this->request->getPost('category_id')
        ]);

        return redirect()->to('/product/my');
    }

    // 6. Hapus produk
    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product/my')->with('error', 'Akses ditolak.');
        }

        if (is_file('uploads/' . $product['photo'])) {
            unlink('uploads/' . $product['photo']);
        }

        $this->productModel->delete($id);
        return redirect()->to('/product/my');
    }

    // 7. Katalog umum
    public function katalog()
    {
        $keyword = $this->request->getGet('search');

        $builder = $this->productModel
            ->where('status', 'tersedia')
            ->orderBy('created_at', 'DESC');

        if ($keyword) {
            $builder->like('title', $keyword);
        }

        $items = $builder->findAll();

        $user = session()->get('isLoggedIn') ? [
            'role' => session()->get('role'),
            'id' => session()->get('user_id')
        ] : null;

        return view('katalog_view', [
            'items' => $items,
            'user' => $user,
            'kategori' => $keyword ? "Hasil Pencarian: $keyword" : 'Semua Produk'
        ]);
    }

    // 8. Produk berdasarkan kategori (by name)
    public function kategori($name)
    {
        $category = (new CategoryModel())->where('name', $name)->first();

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kategori tidak ditemukan.");
        }

        $items = $this->productModel
            ->where('category_id', $category['id'])
            ->where('status', 'tersedia')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $user = session()->get('isLoggedIn') ? [
            'role' => session()->get('role'),
            'id' => session()->get('user_id')
        ] : null;

        return view('katalog/kategori', [
            'items' => $items,
            'kategori' => ucfirst($category['name']),
            'user' => $user
        ]);
    }
}
