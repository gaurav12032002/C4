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
            helper('image');
             $post = $this->request->getPost(['user_id','book','author','summary']);
             if (! $this->validateData($post, [
                'book' => 'required|max_length[255]|min_length[3]',
                'author'  => 'required|max_length[5000]|min_length[3]',
                'summary'  => 'required|max_length[5000]|min_length[10]',
            ])) {
                return $this->respondCreated(['message' => $this->validator->getErrors(), 'status' =>0]);

            }
           // $book_cover = $this->upload('book_cover');
           $book_cover = upload_image('book_cover');
           if (isset($book_cover['error'])) {
               // Handle error
               return redirect()->back()->with('error', $book_cover['error']);
           } else {
               $book_cover =  $book_cover['file_name'];
           }
            $post = $this->validator->getValidated();
             $model = model(BookModel::class);
             $slug =  url_title($post['book'], '-', true);
             $model->save([
                'book' => $post['book'],
                'slug'=> $slug,
                'author'  => $post['author'],
                'summary' => $post['summary'],
                'book_cover' => $book_cover,
            ]);
            return $this->respondCreated(['message' => 'Book created successfully', 'status' =>1 ]);
        }

        public function updateBook()
        {
            helper('form');
            helper('image');
            $post = $this->request->getPost(['slug','book','author','summary']);
            if (! $this->validateData($post, [
               'book' => 'required|max_length[255]|min_length[3]',
               'author'  => 'required|max_length[5000]|min_length[3]',
               'summary'  => 'required|max_length[5000]|min_length[10]',
               'slug' => 'required',
           ])) {
               return $this->respond(['message' => $this->validator->getErrors(), 'status' =>0]);

           }
           $book_cover = upload_image('book_cover');
           if (isset($book_cover['error'])) {
               // Handle error
               return redirect()->back()->with('error', $book_cover['error']);
           } else {
               $book_cover =  $book_cover['file_name'];
           }
           $post = $this->validator->getValidated();
           $model = model(BookModel::class);
           $model->where('slug', $post['slug']);
           $model->set([
            'book' => $post['book'],
            'author'  => $post['author'],
            'summary' => $post['summary'],
            'book_cover' => $book_cover,
        ]);
        $model->update();
        return $this->respond(['message' => 'Book updated successfully', 'status' =>1 ]);
      }

        public function deleteBook(int $book_id)
        {
            $model = model(BookModel::class);
            $model->where('book_id', $book_id);
            $model->delete(); 
            return $this->respond(['message' => 'Book Deleted successfully', 'status' =>1 ]);  
           
    }
    
    public function userSignup()
    {
        helper('form');
        $post = $this->request->getPost(['full_name', 'bio','email','password','confirm_password']);
        if (! $this->validateData($post, [
            'full_name' => 'required|max_length[255]|min_length[3]',
            'email'  => 'required',
            'bio'  => 'required|max_length[5000]|min_length[10]',
            'password'  => 'required|max_length[50]|min_length[6]',
            'confirm_password'  => 'required|max_length[50]|min_length[6]',
        ])) {
            return $this->respondCreated(['message' => $this->validator->getErrors(), 'status' =>0]);
        }

        $post = $this->validator->getValidated();
        if(empty($post['password']) || $post['password'] != $post['confirm_password'])
        {
            return $this->respond(['message' => 'Password not matched', 'status' =>2 ]);
        }
     
        $model = model(UserModel::class);
        
        $model->save([ 
            'full_name' => $post['full_name'],
            'email'=> $post['email'],
            'password' => password_hash($post['password'],PASSWORD_BCRYPT),
            'bio'  => $post['bio'],
           
          
        ]);
        return $this->respond(['message' => 'User signup successfully', 'status' =>1 ]);
    }

    public function updateUser()
        {
            helper('form');
            $post = $this->request->getPost(['full_name','bio','user_id']);
            if (! $this->validateData($post, [
                'full_name' => 'required|max_length[255]|min_length[3]',
                'bio'  => 'required|max_length[5000]|min_length[10]',
                'user_id' => 'required',
           ])) {
               return $this->respond(['message' => $this->validator->getErrors(), 'status' =>0]);

           }
           $post = $this->validator->getValidated();
           $model = model(UserModel::class);
           $model->where('user_id', $post['user_id']);
           $model->set([
            'full_name' => $post['full_name'],
            'bio'  => $post['bio'],
        ]);
        $model->update();
        return $this->respond(['message' => 'User updated successfully', 'status' =>1 ]);
      }


      public function changeUserPassword()
      {   
          helper('form');
          $post = $this->request->getPost(['old_password','password','confirm_password','user_id']);
          if (! $this->validateData($post, [
              'old_password' => 'required|max_length[255]|min_length[6]',
              'password' => 'required|max_length[255]|min_length[6]',
              'confirm_password' => 'required|max_length[255]|min_length[6]',
              'user_id' => 'required',
          ])) {
             return $this->respond(['message' => $this->validator->getErrors(), 'status' =>0]);
          } 
          $post = $this->validator->getValidated();

          $model = model(UserModel::class);
          $user = $model->getUser($post['user_id']);
          if($user){
              if(password_verify($post['old_password'],$user['password'])){
                  if(empty($post['password']) && $post['password'] != $post['confirm_password'] ){
                      if(isset($post['password'])){
                             }
                             return $this->respond(['message' => 'User Password not matched', 'status' =>2 ]);
                  } 
                
              } else{
                return $this->respond(['message' => 'You have entered wrong password', 'status' => 3]);
              }
        
             }
             $model->where('user_id', $post['user_id']);
            $model->set([
               'password' =>password_hash($post['password'],PASSWORD_BCRYPT),
            ]);
              $model->update();
              return $this->respond(['message' => 'User password changed successfully', 'status' =>1 ]);
            
      }

      public function userLogin()
    {
        helper('form');
        $session = session();
        $post = $this->request->getPost(['email','password']);
        if (! $this->validateData($post, [
            'email'  => 'required',
            'password'  => 'required|max_length[5000]|min_length[6]',
        ])) {
            return $this->respond(['message' => $this->validator->getErrors(), 'status' =>0]);
        }
        $post = $this->validator->getValidated();
        $model = model(UserModel::class);
        $user = $model->getUserByEmail($post['email']);
        if($user){
            if(password_verify($post['password'],$user['password'])){
                unset($user['password']);
                return $this->respond(['message' => 'User login successfully', 'status' =>1 ]);
            } else {
                return $this->respond(['message' => 'You have entered wrong password', 'status' =>2]);
            }
           
        }
        return $this->respond(['message' => 'User provided email has not matched', 'status' =>3]);
    }

}
