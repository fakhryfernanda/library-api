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
}
