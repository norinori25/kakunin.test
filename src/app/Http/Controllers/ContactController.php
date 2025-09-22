<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    

    public function showForm()
    {
        $categories = Category::all();
        return view('contacts.form', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();

        $category = Category::find($inputs['category_id']);
        $inputs['category_name'] = $category ? $category->content : '';
        
        return view('contacts.confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
        // 他のバリデーションルール
    ]);

    // 保存処理
    Contact::create($validated);

    return view('contacts.thanks');
    }

}
