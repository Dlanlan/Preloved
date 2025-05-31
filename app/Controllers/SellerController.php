public function dashboard()
{
    $userId = session()->get('user_id');
    $productModel = new \App\Models\ProductModel();

    $totalProducts = $productModel->where('user_id', $userId)->countAllResults();

    return view('seller/dashboard', [
        'totalProducts' => $totalProducts,
    ]);
}
