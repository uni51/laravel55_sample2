<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * ユーザー一覧
     */
    public function index(Request $request)
    {
        $users = User::latest()->withCount('messages')->get();

        return view('admin.user.index')->with(compact('users'));
    }

    /**
     * ユーザーの削除
     */
    public function destroy(User $user)
    {
        $user->delete();

        return ['success' => true];
    }
}
