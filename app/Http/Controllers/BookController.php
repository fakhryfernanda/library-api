<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index()
    {
        $books = Book::orderBy('id', 'ASC')->get();

        foreach ($books as $book) {
            $book['author'] = Author::find($book['author_id']);
            $book['category'] = Category::find($book['category_id']);
            unset($book['author_id']);
            unset($book['category_id']);
        }

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $books
        ]);
    }

    function detail($id)
    {
        $book = Book::find($id);
        $author = Author::find($book['author_id']);
        $category = Category::find($book['category_id']);

        if (!isset($book) or !isset($author) or !isset($category)) {
            return response()->json([
                "status" => false,
                "message" => "Data tidak ditemukan",
                "data" => null
            ]);
        }

        unset($book['author_id']);
        unset($book['category_id']);
        $book['author'] = $author;
        $book['category'] = $category;
        
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $book
        ]);
    }

    function store(Request $request)
    {
        $payload = $request->all();

        $columns = ["isbn", "title", "author_id", "category_id", "publisher", "publication_date", "language", "cover_image"];
        foreach($columns as $col) {
            if (!isset($payload[$col])) {
                $message = "{$col} tidak boleh kosong";
                return response()->json([
                    "status" => false,
                    "message" => $message,
                    "data" => null
                ]);
            }
        }

        $author = Author::find($payload['author_id']);
        $category = Category::find($payload['category_id']);

        if (!isset($author) or !isset($category)) {
            return response()->json([
                "status" => false,
                "message" => "Author atau kategori tidak ditemukan",
                "data" => null
            ]);
        }

        $book = Book::create($payload);
        return response()->json([
            "status" => true,
            "message" => "Buku berhasil ditambahkan",
            "data" => $book->makeHidden([
                "id",
                "created_at",
                "updated_at"
            ])
        ]);
    }

    function edit(Request $request, $id){

        $book = Book::find($id);

        if (!isset($book)) {
            return response()->json([
                "status" => false,
                "message" => "Buku tidak ditemukan",
                "data" => null
            ]);
        }

        $book->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "Data buku berhasil diubah",
            "data" => $book
        ]);
    }

    function delete($id){
        $book = Book::find($id);

        if (!isset($book)) {
            return response()->json([
                "status" => false,
                "message" => "Buku tidak ditemukan",
                "data" => null
            ]);
        }

        Book::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "Buku berhasil dihapus"
        ]);
    }
}
