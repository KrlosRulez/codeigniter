<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model {

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category'];

    public function getCategories() {

        return $this->findAll();

    }

    public function getById($id = false) {

        if ($id === false) {

            return $this->findAll();

        } else {

            return $this->where(['id' => $id])->first();

        }

    }

}