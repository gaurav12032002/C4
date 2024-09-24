<?php

namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function login()
    {
        helper('form');
        $session = session();
        // echo 'jhjkhjkh'; die;

        $post = $this->request->getPost(['email','password']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'email'  => 'required',
            'password'  => 'required|max_length[5000]|min_length[6]',
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }
        $post = $this->validator->getValidated();
        $model = model(UserModel::class);
        $user = $model->getUserByEmail($post['email']);
        if($user){
            if(password_verify($post['password'],$user['password'])){
                unset($user['password']);
                $session->set(['userdata'=>$user]);
                return redirect()->to(base_url('books'));
            } else {
                return redirect()->back()->withinput()->with('errors','entered wrong password');
            }
           
        }
        return redirect()->back()->withinput()->with('errors','the email you have provided not match');
    }



    public function signup()
    {
        helper('form');
        // echo 'jhjkhjkh'; die;

        $post = $this->request->getPost(['full_name', 'bio','email','password','confirm_password']);
        //echo "<pre>"; print_r($post);die();
        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'full_name' => 'required|max_length[255]|min_length[3]',
            'email'  => 'required',
            'bio'  => 'required|max_length[5000]|min_length[10]',
            'password'  => 'required|max_length[50]|min_length[6]',
            'confirm_password'  => 'required|max_length[50]|min_length[6]',
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();
        if(empty($post['password']) || $post['password'] != $post['confirm_password'])
        {
            return redirect()->back()->withinput()->with('error');
        }
     
        $model = model(UserModel::class);
        
        $model->save([ 
            'full_name' => $post['full_name'],
            'email'=> $post['email'],
            'password' => password_hash($post['password'],PASSWORD_BCRYPT),
            'bio'  => $post['bio'],
           
          
        ]);
        return $this->index();
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
