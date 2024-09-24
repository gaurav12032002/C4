<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $allowedFields = ['book', 'slug', 'author','summary','book_cover'];
       /**
     * @param false|string $slug
     *
     * @return array|null
     */
    public function getBook($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}