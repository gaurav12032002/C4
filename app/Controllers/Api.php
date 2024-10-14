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

        if (empty( $allbooks)) {
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

    public function show($id = null)
    {
        // Return a single user
        return $this->respond(['user' => []]); // Replace with actual data
    }
    
    // Add other methods (create, update, delete) as needed
}
