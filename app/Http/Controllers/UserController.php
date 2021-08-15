<?php

namespace App\Http\Controllers;

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
    public function show(Request $request, $id)
    {
        // $item = UserInfo::create($request->all());
        // $item = UserInfo::where('uid', $request->uid);
        $item = UserInfo::all();
        return response()->json([
            'data' => $id
        ], 200);
    }
    // public function store(Request $request)
    // {
    //     $test = UserInfo::where('uid', $request->uid)->get();
    //     if (!empty($test) == true) {
    //         UserInfo::where('uid', $request->uid)->delete();
    //     }
    // $file = Comment::find(1);

    // $item = UserInfo::create($request->all());
    // return response()->json([
    //     'data' => $file
    // ], 200);
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

        $test = UserInfo::where('uid', $request->uid)->get();
        if (!empty($test) == true) {
            UserInfo::where('uid', $request->uid)->delete();
        }



        // if ($request->file) {
        $file_name = time() . '.' . $request->file->getClientOriginalName();
        $request->file->storeAs('public', $file_name);
        $info = new UserInfo();
        $info->path = 'storage/' . $file_name;
        $info->name = $request->name;
        $info->uid = $request->uid;
        $info->goal = $request->goal;
        $info->save();
        // それぞれのテーブルに保存
        $path = 'storage/' . $file_name;
        Comment::where('uid', $request->uid)->update(['path' => $path]);
        post::where('uid', $request->uid)->update(['path' => $path]);


        return response()->json([
            'data' => $request->all()
        ], 200);


        // return ['success' => '登録しました!'];
        // }
    }
}
