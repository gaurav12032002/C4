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
    max-width: 390px;
    background-color: #fff;
    padding: 30px;
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
    width: 50%;
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
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
      
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slide-tab"></div>
            </div>
            <?= session()->getFlashdata('error') ?>
            <?= validation_list_errors() ?>
            <div class="form-inner">
           
                <form action="<?php echo base_url('login'); ?>" method="post"  class="login">
                <?= csrf_field() ?>
                    <div class="field">
                        <input type="text" name="email" id="email" placeholder="Email Address" required>
                    </div>

                    <div class="field">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="pass-link">
                        <a href="<?php echo base_url('forget_password'); ?>">Forgot Password</a>
                    </div>
                    <div class="field">
                        <input type="submit" value="Login">
                    </div>
                    <div class="signup-link">Not a member?<br>
                        <a href="#">Signup Now</a>
                    </div>
                </form>               
                <?= session()->getFlashdata('error') ?>
                <?= validation_list_errors() ?>
                <form action="<?php echo base_url('signup'); ?>" method="post"  class="signup">
                <?= csrf_field() ?>
                    <div class="field">
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="field">
                        <input type="text" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="field">
                       <textarea name="bio" class="form-control"  id="bio" placeholder="Bio" required></textarea>
                    </div>
                    <div class="field">
                        <input type="submit" value="Signup" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
 const loginForm = document.querySelector("form.login");
const signupForm = document.querySelector("form.signup");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector(".signup-link a");
const loginText = document.querySelector(".title-text .login");
const signupText = document.querySelector(".title-text .signup");

signupBtn.addEventListener("click", () => {
    loginForm.style.marginLeft = "-50%";
    loginText.style.marginLeft = "-50%";
});

loginBtn.addEventListener("click", () => {
    loginForm.style.marginLeft = "0%";
    loginText.style.marginLeft = "0%";
});

signupLink.addEventListener("click", () => {
    signupBtn.click();
    return false;
})
    </script>
</body>
</html>

