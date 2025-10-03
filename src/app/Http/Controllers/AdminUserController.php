<?php

namespace App\Http\Controllers;


use App\Actions\Fortify\CreateNewUser; // カスタマイズしたアクションをインポート
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;


class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request, CreateNewUser $creator)
    {
        try {
            // デフォルトのFortifyアクションを使用しつつ、is_adminをtrueにする
            $user = $creator->create(array_merge($request->all(), ['is_admin' => true]));
            event(new Registered($user));
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('admin.users.index')->with('status', '新しい管理者ユーザーを作成しました。');
    }
}
