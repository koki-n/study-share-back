<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Comment;
use App\Models\UserInfo;


class CommentController extends Controller
{
    public function show(Request $request)
    {
        $items = post::find('request->comment');
        return response()->json([
            'data' => $request->comment
        ], 200);
    }

    public function store(Request $request)
    {
        Comment::create($request->all());
        $test = UserInfo::where('uid', $request->uid)->get();
        foreach ($test as $a) {
            if (!empty($a) == true) {
                $path = $a->path;
            }
        };

        if (!empty($path) == true) {
            Comment::where('uid', $request->uid)->update(['path' => $path]);
        } else {
            $path = 'none';
            Comment::where('uid', $request->uid)->update(['path' => $path]);
        }
        return response()->json([
            'data' => $path
        ], 200);
    }
}
