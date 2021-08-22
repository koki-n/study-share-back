<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\UserInfo;



class ImageController extends Controller
{
    public function index()
    {
        return Image::all();
    }

    public function store(Request $request)
    {
        if ($request->file) {
            $file_name = time() . '.' . $request->file->getClientOriginalName();
            $request->file->storeAs('public', $file_name);

            $info = new UserInfo();
            $info->path = 'storage/' . $file_name;
            $info->name = $request->name;
            $info->uid = $request->uid;
            $info->goal = $request->goal;
            $info->save();
            return response()->json([
                'data' => $request->all()
            ], 200);
        }
    }
}
