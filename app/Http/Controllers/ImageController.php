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
        // $this->validate($request, [
        //     'title' => 'required|max:7',
        //     'file' => 'required|image'
        // ], [
        //     'title.required' => 'タイトルを入力して下さい',
        //     'title.max' => '7文字以内で入力して下さい',
        //     'file.required' => '画像が選択されていません',
        //     'file.image' => '画像ファイルではありません',
        // ]);
        // return response()->json([
        //     'data' => $request->all()
        // ], 200);


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


            // return ['success' => '登録しました!'];
        }
    }
}
