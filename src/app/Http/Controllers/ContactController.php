<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //フォーム入力ページを呼び出す
    public function index()
    {
        return view('index');
    }

    //値を受け取る
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'detail']);
        return view('confirm', ['contact' => $contact]);
    }

    //値をデータベースに渡す
    public function store(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
}