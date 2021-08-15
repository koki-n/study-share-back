<?php

namespace App\Http\Controllers;

use App\Models\post;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $items = post::where('uid', $request->uid)->get();
        return response()->json([
            'data' => $items
        ], 200);
    }
    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $username = $request->username;

        $items = post::where('username', 'like', "%$username%");

        if (!empty($title) == true) {
            $items = $items->where('title', 'like', "%$title%");
            // dd($name);
        }
        if (!empty($content) == true) {
            $items = $items->where('content', 'like', "%$content%");

            // dd($name);
        }
        $items = $items->get();



        // $item = post::create($request->all());
        return response()->json([
            'data' => $items
        ], 201);
    }
}
