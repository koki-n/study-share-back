<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Comment;
use App\Models\post;




class UserController extends Controller
{
    public function index(Request $request)
    {
        $item = $request->all();
        return response()->json([
            'data' => $item
        ], 200);
    }
    public function show(Request $request)
    {
        $item = UserInfo::where('uid', $request->user)->first();
        return response()->json([
            'data' => $item
        ], 200);
    }
    public function store(Request $request)
    {
        $test = UserInfo::where('uid', $request->uid)->get();
        if (!empty($test) == true) {
            UserInfo::where('uid', $request->uid)->delete();
        }
        $info = new UserInfo();
        $image = $request->file;
        $disk = Storage::disk('s3');
        $path = $disk->putFile('/', $image, 'public');
        $path = Storage::disk('s3')->url($path);
        $info->path = $path;
        $info->name = $request->name;
        $info->uid = $request->uid;
        $info->goal = $request->goal;
        $info->save();
        $test = UserInfo::all();
        Comment::where('uid', $request->uid)->update(['path' => $path]);
        post::where('uid', $request->uid)->update(['path' => $path]);


        return response()->json([
            'data' => $request->all()
        ], 200);
    }
}
