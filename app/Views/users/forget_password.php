<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   
    <title>User Login form</title>
    <style>
 {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html, body{
    display: grid;
    height: 100%;
    width: 100%;
    place-items: center;
    background: -webkit-linear-gradient(left, #a445b2, #fa4299);
}

.wrapper{
    max-width: 490px;
    background-color: #fff;
    padding: 100px;
    border-radius: 10px;
    box-shadow: 0 15px 20px rgba(0, 0, 0, .1);
    overflow: hidden;
}

.wrapper .title-text{
    display: flex;
    width: 200%;
}

.wrapper .title-text .title{
    width: 50%;
    font-size: 35px;
    font-weight: 600;
    text-align: center;
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    color: #555;
}

.wrapper .form-container{
    width: 100%;
    overflow: hidden;
}

.form-container .slide-controls{
    display: flex;
    justify-content: space-between;
    height: 50px;
    width: 100%;
    border: 1px solid lightgrey;
    overflow: hidden;
    margin: 30px 0 10px 0;
    border-radius: 10px;
    position: relative;
}

.slide-controls .slide{
    width: 100%;
    height: 100%;
    font-size: 18px;
    font-weight: 500;
    line-height: 48px;
    text-align: center;
    cursor: pointer;
    color: #fff;
    z-index: 1;
    transition: all .6s ease;        
}

.slide-controls .signup{
    color: #212121;
}

.slide-controls .slide-tab{
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 0;
    background: -webkit-linear-gradient(left, #a445b2, #fa4299);
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

input[type="radio"]{
    display: none;
}

#signup:checked ~ .slide-tab{
    left: 50%;
}

#signup:checked ~ .signup{
    color: #fff;
}

#signup:checked ~ .login{
    color: #212121;
}

.form-container .form-inner{
    display: flex;
    width: 200%;
}

.form-container .form-inner form{
    width: 50%;
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);;
}

.form-inner form .field{
    height: 50px;
    width: 100%;
    margin-top: 20px;
}

.form-inner form .field input{
    width: 100%;
    height: 100%;
    outline: none;
    font-size: 17px;
    padding-left: 15px;
    border-radius: 10px;
    border: 1px solid lightgray;
    border-bottom-width: 2px;
    transition: all 0.4s ease;
}

.form-inner form .field input:focus{
    border-color: #fc83bb;
}

.form-inner form .pass-link{
    margin-top: 5px;
}

.form-inner form .pass-link a,
a{
    color: #fa4299;
    text-decoration: none;
}

.form-inner form .signup-link{
    color: #212121;
    text-align: center;
    margin-top: 30px;
}

.form-inner form .pass-link a:hover,
.form-inner form .signup-link a:hover{
    text-decoration: underline;
}

form .field input[type="submit"]{
    background: -webkit-linear-gradient(left, #a445b2, #fa4299);
    color: #fff;
    font-size: 20px;
    font-weight: 500;
    padding-left: 0;
    border: none;
    cursor: pointer;
}

    </style>
    </head>
    <body>
       
    <div class="wrapper">
    
    <div class="form-container">
    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>
        <h2 class="text-center"><?= esc($title) ?></h2>
        <form action="<?php echo base_url('users/reset_password'); ?>" method="post">
            <?= csrf_field() ?>
            <div class="col-6">
            <label for="title">Email</label>
            <input type="input" name="email" id="email" class="form-control" value="<?= set_value('email') ?>">
            </div>
            <br>
            <div class="form-group">
        <button type="submit" class="btn btn-sm btn-primary" name="submit">Reset Password</button>
        <a href="<?php echo base_url('/'); ?>" class="btn btn-sm btn-success">Cancel</a>
            </div>

</form>



            </div>
        </div>
    </div>
</body>
</html>

