<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    //two methods, one to view all news items, and one for a specific news item
    // public function index()
    // {
    //     $model = model(NewsModel::class);

    //     $data['news'] = $model->getNews();
    // }

    // public function view($slug = null)
    // {
    //     $model = model(NewsModel::class);

    //     $data['news'] = $model->getNews($slug);
    // }

    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

   public function view($slug = null)
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

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }

    public function deleteData($idnya = null) {
        print_r($idnya);
        $model = model(NewsModel::class);
        $model->delete($idnya);
        // return view('templates/header', ['title' => 'Success Delete'])
        //     . view('news/success')
        //     . view('templates/footer');
        return redirect()->route('news');
    }

    public function editData($idnya = null) {
        helper('form');

        $model = model(NewsModel::class);
        if (! $this->request->is('post')) {
            $data['news'] = $model->where(['id' => $idnya])->first();
            // print_r($data);
            return view('templates/header', ['title' => 'Edit a news item'])
                . view('news/edit', ['data' => $data['news']])
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);
        $model->update($idnya, [
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);
        // $model = model(NewsModel::class);
        // $model->update($idnya);
        return redirect()->route('news');

    }
}
