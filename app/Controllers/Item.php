<?php

namespace App\Controllers;
use App\Models\ItemModel;

class Item extends BaseController
{
    public function requestForm()
    {
        return view('item/request');
    }

    public function submitRequest()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $img = $this->request->getFile('image');
        $imgName = $img->getRandomName();
        $img->move('uploads', $imgName);

        $model = new ItemModel();
        $items = $model->where('status', 'approved')->findAll();


        return redirect()->to('/')->with('message', 'Permintaan jual dikirim!');
    }
}
