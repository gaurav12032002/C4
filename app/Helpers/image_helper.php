<?php

use CodeIgniter\Files\File;

if (!function_exists('upload_image')) {
    function upload_image($fileInput, $uploadPath = 'uploads/', $allowedTypes = 'image/png,image/jpg,image/jpeg', $maxSize = 2048)
    {
        // Load the request object
        $request = \Config\Services::request();
        $file = $request->getFile($fileInput);

        // Check if the file is valid
        if ($file->isValid() && !$file->hasMoved()) {
            // Configure upload settings
            $newFileName = $file->getRandomName(); // Generate a random name for the file
            $file->move($uploadPath, $newFileName, true); // Move the file to the upload directory

            // Return file data
            return [
                'file_name' => $newFileName,
                'file_path' => $uploadPath . $newFileName,
                'file_size' => $file->getSize(),
            ];
        } else {
            // Return errors if upload fails
            return ['error' => $file->getErrorString()];
        }
    }
}
