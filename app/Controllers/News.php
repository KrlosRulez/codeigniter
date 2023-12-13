<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{

    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function new()
    {

        helper('form');

        $model = model(CategoryModel::class);

        if ($data['category'] = $model->findAll()) {

            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create', $data)
                . view('templates/footer');

        }

    }

    public function create()
    {
        helper('form');

        // Checks whether the submitted data passed the validation rules.
        if (
            !$this->validate([
                'title' => 'required|max_length[255]|min_length[3]',
                'body' => 'required|max_length[5000]|min_length[10]',
                'id_category' => 'required',
            ])
        ) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        // print_r($post);
        print_r($post['id_category']);


        $model->save([
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body' => $post['body'],
            'id_category' => $post['id_category'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }

    public function delete($id)
    {

        if ($id == null) {
            throw new PageNotFoundException('Cannot delete the item');
        }

        $model = model(NewsModel::class);

        /*if ($model->where('id', $id)->find()) {
            $model->where('id', $id)->delete();
        } else { lol
            throw new PageNotFoundException('Selected item does not exist in database');
        }*/

        if ($model->getById($id)) {
            $model->delete($id);
        } else {
            throw new PageNotFoundException('Selected item does not exist in the database');
        }

        return view('templates/header', ['title' => 'Delete item'])
            . view('news/success_delete')
            . view('templates/footer');

    }

    public function update($id)
    {

        helper('form');

        if ($id == null) {
            throw new PageNotFoundException('Cannot update the item');
        }

        $model = model(NewsModel::class);

        if ($model->where('id', $id)->find()) {
            $data = [
                'news' => $model->getById($id),
                'title' => 'Update item'
            ];
        } else {
            throw new PageNotFoundException('Selected item does not exist in database');
        }

        return view('templates/header', $data)
            . view('news/update')
            . view('templates/footer');

    }

    public function updatedItem($id)
    {

        helper('form');

        if (
            !$this->validate([
                'title' => 'required|max_length[255]|min_length[3]',
                'body' => 'required|max_length[5000]|min_length[10]'
            ])
        ) {
            return $this->update($id);
        }

        $post = $this->validator->getValidated();

        $data = [
            'id' => $id,
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body' => $post['body']
        ];

        $model = model(NewsModel::class);
        $model->save($data);

        return view('templates/header', ['title' => 'Item updated'])
            . view('news/success_update')
            . view('templates/footer');

    }

    public function show($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
}