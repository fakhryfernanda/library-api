<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $categories
        ]);
    }

    function detail($id)
    {
        $category = Category::find($id);

        if (!isset($category)) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $category
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

        $category = Category::create($payload);
        return response()->json([
            "status" => true,
            "message" => "Kategori berhasil ditambahkan",
            "data" => $category->makeHidden([
                "id",
                "created_at",
                "updated_at"
            ])
        ]);
    }

    function edit(Request $request, $id){

        $category = Category::find($id);
        
        if (!isset($category)) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak ditemukan",
                "data" => null
            ]);
        }

        $category->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "Data kategori berhasil diubah",
            "data" => $category
        ]);
    }

    function delete($id){
        $category = Category::find($id);

        if (!isset($category)) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak ditemukan",
                "data" => null
            ]);
        }

        Category::destroy($id);

        return response()->json([
            "status" => true,
            "message" => "Kategori berhasil dihapus"
        ]);
    }
}
