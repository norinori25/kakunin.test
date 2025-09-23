<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

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

    public function store(ContactRequest $request)
    {
        $inputs = $request->validated();

        Contact::create($inputs);

        return redirect()->route('contacts.thanks');
    }

    // 修正ボタンを押したときにフォームへ戻す
    public function back(Request $request)
    {
        return redirect()->route('contacts.form')->withInput();
    }

    public function thanks()
    {
    return view('contacts.thanks');
    }

}
