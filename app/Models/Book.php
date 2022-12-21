<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    
    // menghubungkan tabel post dengan tabel kategori
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // menggunakan nama fungsi author
    public function author() {
        return $this->belongsTo(Author::class);
    }
}
