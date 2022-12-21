<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    function index()
    {
        // $books = Book::all();
        $books = DB::table('books')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.title', 'authors.name AS author', 'categories.name AS category')
            ->get();

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $books
        ]);
    }

    function detail($id)
    {
        $book = Book::find($id);
        
        if (!isset($book)) {
            return response()->json([
                "status" => false,
                "message" => "Buku tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $book
        ]);
    }

    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload["name"])) {
            return response()->json([
                "status" => false,
                "message" => "Nama tidak boleh kosong",
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
