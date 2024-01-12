<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categories extends BaseController
{

    public function index()
    {
        $model = model(CategoryModel::class);

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'Categories archive',
        ];

        return view('templates/header', $data)
            . view('categories/index')
            . view('templates/footer');
    }
}