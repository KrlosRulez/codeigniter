<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $allowedFields = ['title', 'slug', 'body', 'id_category'];

    public function getNews($slug = false)
    {
        if ($slug === false) {
            $sql = $this->select('news.*,category.category');
            $sql = $this->join('category', 'news.id_category=category.id');
            $sql = $this->findAll();
            return $sql;
        }
        $sql = $this->select('news.*,category.category');
        $sql = $this->join('category', 'news.id_category=category.id');
        $sql = $this->where(['slug' => $slug]);
        $sql = $this->first();
        return $sql;
    }

    public function getById($id)
    {

        return $this->where(['id' => $id])->first();

    }

}