<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\BookModel;
use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    public function getBooks()
    {
        
        $model = model(BookModel::class);

        $allbooks = $model->getBook();

        if (empty($allbooks)) {
                // Return all books
                return $this->respond([
                    'message'=>'No books found in records',
                    'status'=>1
                ]); // Replace with actual data

        } else{

            for($i =0;$i<count($allbooks);$i++){

                if (!empty($allbooks[$i]['book_cover'])) {
                    $allbooks[$i]['book_cover'] =  base_url('uploads/'.esc($allbooks[$i]['book_cover']));
                }

            }

            // Return all books
            return $this->respond([
                'message'=>'Books data fetched',
                'data' =>$allbooks,
                'status'=>1
            ]); // Replace with actual data
        }
    }

     public function viewBook(int $book_id)
        {
            $model = model(BookModel::class);

            $book = $model->getBookById($book_id);

            if (empty($book)) {
                return $this->respond([
                    'message'=>'No books found in records',
                    'status'=>0
                ]);
         } else{
            return $this->respond([
                'message'=>'View book data',
                'data' =>$book,
                'status'=>1
            ]);
        }
          
        }
        public function createBook()
        {
            helper('form');
             $post = $this->request->getPost(['user_id','book','author','summary']);
             if (! $this->validateData($post, [
                'book' => 'required|max_length[255]|min_length[3]',
                'author'  => 'required|max_length[5000]|min_length[3]',
                'summary'  => 'required|max_length[5000]|min_length[10]',
            ])) {
                return $this->respondCreated(['message' => $this->validator->getErrors(), 'status' =>0]);

            }
           // $book_cover = $this->upload('book_cover');
            $post = $this->validator->getValidated();
             $model = model(BookModel::class);
             $slug =  url_title($post['book'], '-', true);
             $model->save([
                'book' => $post['book'],
                'slug'=> $slug,
                'author'  => $post['author'],
                'summary' => $post['summary'],
                //'book_cover' => $book_cover,
            ]);
            return $this->respondCreated(['message' => 'Book created successfully', 'status' =>1 ]);
        }

        public function updateBook()
        {
            helper('form');
            $post = $this->request->getPost(['slug','book','author','summary']);
            if (! $this->validateData($post, [
               'book' => 'required|max_length[255]|min_length[3]',
               'author'  => 'required|max_length[5000]|min_length[3]',
               'summary'  => 'required|max_length[5000]|min_length[10]',
               'slug' => 'required',
           ])) {
               return $this->respond(['message' => $this->validator->getErrors(), 'status' =>0]);

           }
           $post = $this->validator->getValidated();
           $model = model(BookModel::class);
           $model->where('slug', $post['slug']);
           $model->set([
            'book' => $post['book'],
            'author'  => $post['author'],
            'summary' => $post['summary'],
        ]);
        $model->update();
        return $this->respond(['message' => 'Book updated successfully', 'status' =>1 ]);
      }

        public function deleteBook(string $slug)
        {
            $model = model(BookModel::class);
            $model->where('slug', $slug);
            $model->delete();   
            return $this->respondDeleted(['message' => 'Book deleted successfully', 'status' =>1 ]);

        }
    
}
