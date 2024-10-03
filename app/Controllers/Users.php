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
        //echo"<pre>";print_r($user);die;
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
    public function profile()
    {
        $data = [
            'user' => session()->get('userdata'),
            'title'     => 'User Profile',
        ];

        return view('templates/header', $data)
            . view('users/profile')
            . view('templates/footer');

    }
        public function edit()
        {
            helper('form');
            // $model = model(UserModel::class);
            $data['edit'] = session()->get('userdata');
            $data['title'] = "Update User Profile";
            return view('templates/header',$data)
                . view('users/update')
                . view('templates/footer');
        }

        public function update()
        {
            helper('form');
           // $post =  session()->get('userdata');
          // echo "<pre>";print_r($post);die;
            $post = $this->request->getPost(['full_name','bio']);
            if (! $this->validateData($post, [
                'full_name' => 'required|max_length[255]|min_length[3]',
                'bio' => 'required|max_length[255]|min_length[10]',
            ])) {
                return $this->index();
            }
            // Gets the validated data.
            $post = $this->validator->getValidated();
            $profile_picture= $this->upload('profile_picture');
            // echo "<pre>";print_r($profile_picture);die;
            $model = model(UserModel::class);
             $model->where('user_id',session()->get('userdata')['user_id']);
    
            $model->set([
                'full_name' => $post['full_name'],
                'bio'  => $post['bio'],
                'profile_picture' => $profile_picture, 
            ]);
              $model->update();

              $userSessionData = session()->get('userdata');
              $userSessionData['full_name'] = $post['full_name'];
              $userSessionData['bio'] = $post['bio'];
              $userSessionData['profile_picture'] = $profile_picture;

              session()->set(['userdata'=>$userSessionData]);
              return redirect()->to(base_url('users'));

        }

        public function edit_password()
        {
            helper('form');
            // $model = model(UserModel::class);
            $data['edit_password'] = session()->get('userdata');
            $data['title'] = "Change Password";
            return view('templates/header',$data)
                . view('users/change_password')
                . view('templates/footer');
        }

        public function change_password()
        {   
            helper('form');
            //    $model = model(UserModel::class);
            //    $user = $model->getUser(session()->get('userdata')['user_id']);
            //   echo "<pre>";print_r($user);die;

            $post = $this->request->getPost(['old_password','password','confirm_password']);
          //  echo "<pre>";print_r($post);die;
            if (! $this->validateData($post, [
                'old_password' => 'required|max_length[255]|min_length[6]',
                'password' => 'required|max_length[255]|min_length[6]',
                'confirm_password' => 'required|max_length[255]|min_length[6]',
            ])) {
                return $this->index();
            } 
            $post = $this->validator->getValidated();

            $model = model(UserModel::class);
            $user = $model->getUser(session()->get('userdata')['user_id']);
            if($user){
                if(password_verify($post['old_password'],$user['password'])){
                    if(empty($post['password']) && $post['password'] != $post['confirm_password'] ){
                        if(isset($post['password'])){
                            //     $password = password_hash($post['password'], PASSWORD_BCRYPT);
                               }
                        return redirect()->back()->withinput()->with('errors','password not match');
                    } 
                   // $session->set(['userdata'=>$user]);
                    // return redirect()->to(base_url('users'));
                } else{
                    return redirect()->back()->withinput()->with('errors','entered wrong password');
                }
            // Gets the validated data.
            // if(empty($post['password']) && $post['password'] != $post['confirm_password'] ){
            //     return redirect()->back()->withinput()->with('errors','password not match');
            // } 
            //  if(isset($post['password'])){
            //     $password = password_hash($post['password'], PASSWORD_BCRYPT);
               }
              $model->where('user_id',session()->get('userdata')['user_id']);
           // }
              $model->set([
                 'password' =>password_hash($post['password'],PASSWORD_BCRYPT),
              ]);
                $model->update();
  
                $userSession = session()->get('userdata');

                $userSession['password'] = $post['password'];
                session()->set(['userdata'=>$userSession]);
               
                return redirect()->to(base_url('users'));
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
   
        public function logout()
        {
            $session = session();
            $session->destroy();
            return redirect()->to('/');
        }
  }
// $this->session->get('name'); //outp
