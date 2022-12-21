<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function index()
    {
        $authors = Author::all();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $authors
        ]);
    }

    function detail($id)
    {
        $author = Author::find($id);

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
        if (!isset($payload["name"])) {
            return response()->json([
                "status" => false,
                "message" => "Nama tidak boleh kosong",
                "data" => null
            ]);
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
}
