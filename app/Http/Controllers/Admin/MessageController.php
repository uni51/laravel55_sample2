<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMessage;

class MessageController extends Controller
{
    /**
     * メッセージ一覧
     */
    public function index()
    {
        // latest()は、orderby('careated_at', 'desc')と同じ
        $messages = Message::latest()->with('user')->get();

        return view('admin.message.index')->with(compact('messages'));
    }

    /**
     * 新規作成画面
     */
    public function create(Message $message)
    {
        $userlist = User::getUserList();

        return view('admin.message.create')->with(compact('message', 'userlist'));
    }

    /**
     * 新規登録処理
     * SaveMessageをタイプヒントして、$requestオブジェクトを取得している。
     * Form Requestは、インスタンス化される時点で、バリデーション処理も自動で呼び出される。
     */
    public function store(SaveMessage $request, Message $message)
    {
        $data = $request->getData();

        $message->forceFill($data)->save();

        return redirect(route('admin.message.edit', $message))->with('_flash_msg', '登録が完了しました');
    }

    /**
     * 変更画面
     */
    public function edit(Message $message)
    {
        $userlist = User::getUserList();

        return view('admin.message.create')->with(compact('message', 'userlist'));
    }

    /**
     * 変更処理
     */
    public function update(SaveMessage $request, Message $message)
    {
        $data = $request->getData();

        $message->forceFill($data)->save();

        return redirect(route('admin.message.edit', $message))->with('_flash_msg', '変更が完了しました');
    }
}
