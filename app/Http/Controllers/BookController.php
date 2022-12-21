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
        $books = Book::all();

        $authors = [];
        $categories = [];

        foreach ($books as $book) {
            $book['author'] = Author::find($book['author_id']);
            $book['category'] = Category::find($book['category_id']);
            unset($book['author_id']);
            unset($book['category_id']);
        }
        
        // $books = Book::join('authors', 'books.author_id', '=', 'authors.id')
        //     ->join('categories', 'books.category_id', '=', 'categories.id')
        //     ->select(
        //                 'books.title', 
        //                 'authors.id as id_author', 
        //                 'authors.name AS author',
        //                 'categories.id as id_category', 
        //                 'categories.name AS category'
        //             )
        //     ->get();

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
        if (!isset($payload["title"])) {
            return response()->json([
                "status" => false,
                "message" => "Nama tidak boleh kosong",
                "data" => null
            ]);
        }

        $payload = $request->all();
        if (!isset($payload["author_id"])) {
            return response()->json([
                "status" => false,
                "message" => "Author tidak boleh kosong",
                "data" => null
            ]);
        }

        $payload = $request->all();
        if (!isset($payload["category_id"])) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak boleh kosong",
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
