<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('bootstrap/bootstrap5.css');?>"rel="stylesheet">
    <script src="<?php echo base_url('bootstrap/bootstrap.bundle.min.js');?>"></script>
    <title>My Project</title>
    <style>
        .fakeimg{
            height:200px;
            background:#aaa;
        }
    </style>
</head>
<body>
    <div class="p-5 bg-primary text-white text-center">
        <h1>Archive</h1>
        <p>We have all record</p>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid col-11">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class='nav-link active' href="<?php echo base_url('books'); ?>">Books</a>
                    </li>

                </ul>
            </div>
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="btn btn-sm btn-danger" href="<?php echo base_url('logout'); ?>">Logout</a>
                    </li>

                </ul>
            </div>

    </nav>
            <div class="container mt-5">
                <div class="row mb-5">

    