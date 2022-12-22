<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index()
    {
        $authors = Author::orderBy('id', 'ASC')->get();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $authors
        ]);
    }

    function detail($id)
    {
        $author = Author::find($id);

        // memeriksa apakah terdapat author dengan id sesuai yang diberikan
        if (!isset($author)) {
            return response()->json([
                "status" => false,
                "message" => "Author tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $author
        ]);
    }

    function store(Request $request)
    {
        $payload = $request->all();
        
        $columns = ["name", "real_name", "gender", "birthdate", "image"];
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
        
        $author = Author::create($payload);
        return response()->json([
            "status" => true,
            "message" => "Author berhasil ditambahkan",
            "data" => $author->makeHidden([
                "id",
                "created_at",
                "updated_at"
            ])
        ]);
    }

    function edit(Request $request, $id){

        $author = Author::find($id);
        
        // memeriksa apakah terdapat author dengan id sesuai yang diberikan
        if (!isset($author)) {
            return response()->json([
                "status" => false,
                "message" => "Author tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();
        $columns = ["name", "real_name", "gender", "birthdate", "image"];
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

        $author->update($payload);

        return response()->json([
            "status" => true,
            "message" => "Data author berhasil diubah",
            "data" => $author
        ]);
    }

    function delete($id){
        $author = Author::find($id);

        if (!isset($author)) {
            return response()->json([
                "status" => false,
                "message" => "Author tidak ditemukan",
                "data" => null
            ]);
        }

        Author::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "Author berhasil dihapus"
        ]);
    }
}
