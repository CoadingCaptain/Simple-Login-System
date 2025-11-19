<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function category_list(Request $request)
    {
        $user_id = $request->header("id");
        return category::where("user_id", $user_id)->get();
    }

    function category_create(Request $request)
    {
        $user_id = $request->header("id");
        return category::create([
            "name" => $request->input("name"),
            "user_id" => $user_id
        ]);
    }

    function category_delete(Request $request)
    {
        $category_id = $request->input("id");
        $user_id = $request->header("id");
        return category::where("id", $category_id)->where("user_id", $user_id)->delete();
    }

    function category_update(Request $request)
    {
        $category_id = $request->input("id");
        $user_id = $request->header("id");
        return category::where("id", $category_id)->where("user_id", $user_id)->update([
            "name" => $request->input("name")
        ]);
    }
}
