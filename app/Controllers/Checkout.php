<?php

namespace App\Controllers;

use App\Models\OrderHeaderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class Checkout extends Controller
{
    public function index()
    {
        return redirect()->to('/');
    }

    public function tambah($id)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $productModel = new ProductModel();
        $product = $productModel->getByIdWithCategory($id); // menggunakan metode baru

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        return view('checkout/checkout', [
            'product' => $product
        ]);
    }

    public function proses()
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request = service('request');

        $productId = $request->getPost('product_id');
        $size = $request->getPost('size');
        $qty = (int) $request->getPost('qty');
        $price = (int) $request->getPost('price');

        if (!$productId || !$size || $qty < 1 || $price < 1) {
            return redirect()->back()->withInput()->with('error', 'Data checkout tidak lengkap atau tidak valid.');
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan.');
        }

        $total = $qty * $price;

        $orderModel = new OrderHeaderModel();
        $orderItemModel = new OrderItemModel();

        $orderId = $orderModel->insert([
            'buyer_id' => session()->get('user_id'),
            'total_amount' => $total,
            'nama_penerima' => $request->getPost('nama_penerima') ?? 'Pembeli',
            'alamat' => $request->getPost('alamat') ?? 'Alamat belum diisi',
            'telepon' => $request->getPost('telepon') ?? 'N/A',
            'status' => 'pending'
        ]);

        $orderItemModel->insert([
            'order_id' => $orderId,
            'product_id' => $productId,
            'qty' => $qty,
            'price' => $price,
            'subtotal' => $total,
            'size' => $size
        ]);

        return redirect()->to('/pesanan')->with('success', 'Checkout berhasil!');
    }

    public function pesanan()
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderHeaderModel();
        $userId = session()->get('user_id');

        $orders = $orderModel->where('buyer_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('checkout/checkout_riwayat', [
            'orders' => $orders
        ]);
    }

    public function detail($id)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $orderModel = new OrderHeaderModel();
        $itemModel = new OrderItemModel();
        $productModel = new ProductModel();

        $order = $orderModel->find($id);
        if (!$order || $order['buyer_id'] != session()->get('user_id')) {
            return redirect()->to('/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $items = $itemModel->where('order_id', $id)->findAll();

        // Tambahkan detail produk untuk setiap item
        foreach ($items as &$item) {
            $item['product'] = $productModel->getByIdWithCategory($item['product_id']);
        }

        return view('checkout/checkout_detail', [
            'order' => $order,
            'items' => $items
        ]);
    }
}
