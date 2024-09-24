<?php

namespace App\Controllers;
use App\Models\BookModel;

class Books extends BaseController
{
    public function index()
    {
        $model = model(BookModel::class);

        $data = [
            'books' => $model->getBook(),
            'title'     => 'Books archive',
        ];

        return view('templates/header', $data)
            . view('books/index')
            . view('templates/footer');
    }

    public function show(?string $slug = null)
    {
        $model = model(BookModel::class);

        $data['books'] = $model->getBook($slug);

        if ($data['books'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['books']['book'];

        return view('templates/header', $data)
            . view('books/view')
            . view('templates/footer');
    }
    public function new()
    {
        helper('form');

        return view('templates/header', ['books' => 'Create a news item'])
            . view('books/create')
            . view('templates/footer');
    }
    public function create()
    {
        helper('form');

        $post = $this->request->getPost(['book', 'author','summary']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'book' => 'required|max_length[255]|min_length[3]',
            'author'  => 'required|max_length[5000]|min_length[10]',
            'summary'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();
        $book_cover = $this->upload('book_cover');
     
        $model = model(BookModel::class);
        $slug =  url_title($post['book'], '-', true);
        $model->save([
            'book' => $post['book'],
            'slug'=> $slug,
            'author'  => $post['author'],
            'summary' => $post['summary'],
            'book_cover' => $book_cover,
        ]);
        // return view('templates/header')
        // . view('books/success')
        // . view('templates/footer');

       return redirect()->to(base_url('books'.'/'.$slug));
    }
    public function edit(string $slug)
    {
        helper('form');
        $model = model(BookModel::class);
        $data['edit'] = $model->getBook($slug);
        $data['title'] = "Update book";
        return view('templates/header',$data)
            . view('books/update')
            . view('templates/footer');
    }
    public function update()
    {
        helper('form');

        $post = $this->request->getPost(['book', 'author','summary','slug']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'book' => 'required|max_length[255]|min_length[3]',
            'author'  => 'required|max_length[5000]|min_length[10]',
            'summary'  => 'required|max_length[5000]|min_length[10]',
            'slug'  => 'required',
        ])) {
            // The validation fails, so returns the form.
            return $this->edit($post['slug']);
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(BookModel::class);
        $model->where('slug', $post['slug']);

        $model->set([
            'book' => $post['book'],
            'author'  => $post['author'],
            'summary' => $post['summary'],
        ]);
        $model->update();

        return $this->show($post['slug']);
    
    }
    public function delete(string $slug)
    {
        $model = model(BookModel::class);
        $model->where('slug', $slug);
        $model->delete();   
        return redirect()->to(base_url('books'));
    }
    public function upload(string $file)
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => 
                    ['uploaded['.$file.']',
                    'is_image['.$file.']',
                    'mime_in['.$file.',image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size['.$file.',5000]'],
                
            ],
        ];
        if (! $this->validate($validationRule)) {
            
            return redirect()->back()->withinput()->with('error');
        }

        $img = $this->request->getFile($file);
      //  echo $img;die;

        if (! $img->hasMoved()) {
            $newName = $img->getRandomName();
         
          $img->move(WRITEPATH.'../public/uploads/',$newName);
            return $newName;
        }

      //  $data = ['errors' => 'The file has already been moved.'];

      return redirect()->back()->with('error','Failed to upload error');
        }
    }
  

