<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $items = post::all();
        return response()->json([
            'data' => $items
        ], 200);
    }
    public function store(Request $request)
    {
        $this->validate($request, post::$rules);
        $item = post::create($request->all());
        $test = UserInfo::where('uid', $request->uid)->get();
        foreach ($test as $a) {
            $path = $a->path;
        };

        if (!empty($path) == true) {
            Post::where('uid', $request->uid)->update(['path' => $path]);
        }

        return response()->json([
            'data' => $item
        ], 201);
    }
    public function show(Post $post)
    {
        // dd($post);
        // $item = post::where('uid',);
        return response()->json([
            'data' => 'seikou'
        ], 201);
    }
}
