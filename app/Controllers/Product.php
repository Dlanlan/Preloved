<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransaksiModel;
use App\Models\UlasanModel;

class Product extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        helper(['form', 'url']);
    }

    // 1. Daftar Produk Seller
    public function index()
    {
        if (!session()->get('isLoggedIn'))
            return redirect()->to('/login');

        $userId = session()->get('user_id');
        $products = $this->productModel->where('user_id', $userId)->findAll();

        return view('product/index', ['products' => $products]);
    }

    // 2. Tambah Produk
    public function create()
    {
        if (!session()->get('isLoggedIn'))
            return redirect()->to('/login');
        return view('product/create');
    }

    public function store()
    {
        if (!session()->get('isLoggedIn'))
            return redirect()->to('/login');

        $validation = \Config\Services::validation();
        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'price' => 'required|numeric',
            'condition' => 'required',
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
            'condition' => $this->request->getPost('condition'),
            'status' => 'tersedia'
        ]);

        return redirect()->to('/product');
    }

    // 3. Edit & Update Produk
    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product')->with('error', 'Akses ditolak.');
        }
        return view('product/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product')->with('error', 'Akses ditolak.');
        }

        $photo = $this->request->getFile('photo');
        $photoName = $product['photo'];

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $photoName = $photo->getRandomName();
            $photo->move('uploads', $photoName);
        }

        $this->productModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'photo' => $photoName,
            'price' => $this->request->getPost('price'),
            'condition' => $this->request->getPost('condition'),
        ]);

        return redirect()->to('/product');
    }

    // 4. Hapus Produk
    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!$product || $product['user_id'] != session()->get('user_id')) {
            return redirect()->to('/product')->with('error', 'Akses ditolak.');
        }

        $this->productModel->delete($id);
        return redirect()->to('/product');
    }

    // 5. Lihat Daftar Transaksi
    public function transaksi()
    {
        $transaksiModel = new TransaksiModel();
        $userId = session()->get('user_id');

        $data['transaksis'] = $transaksiModel
            ->where('seller_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('product/transaksi_index', $data);
    }

    // 6. Update Status Transaksi
    public function updateStatusTransaksi($id)
    {
        $transaksiModel = new TransaksiModel();
        $status = $this->request->getPost('status');

        $transaksiModel->update($id, [
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Status transaksi diperbarui.');
    }

    // 7. Lihat Ulasan
    public function ulasan()
    {
        $ulasanModel = new UlasanModel();
        $userId = session()->get('user_id');

        $data['ulasans'] = $ulasanModel
            ->join('products', 'products.id = ulasan.product_id')
            ->where('products.user_id', $userId)
            ->select('ulasan.*, products.title')
            ->orderBy('ulasan.created_at', 'DESC')
            ->findAll();

        return view('product/ulasan_index', $data);
    }

    // ============================================
    // 🔥 8. TAMBAHAN: Katalog Umum untuk Semua User
    // ============================================
    public function katalog()
    {
        $items = $this->productModel->where('status', 'tersedia')->findAll();

        $data = [
            'items' => $items,
            'user' => [
                'role' => session()->get('role'),
                'id' => session()->get('user_id')
            ]
        ];

        return view('katalog_view', $data); // GANTI dengan nama view kamu
    }
}
