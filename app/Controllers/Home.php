<?php

namespace App\Controllers;
use App\Models\ItemModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $items = $model->where('status', 'approved')->findAll();

        return view('home/index', ['items' => $items]);
    }
}
