<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'last_name'    => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'gender'       => 'required',
            'email'        => 'required|email',
            'tel'          => 'required|string',
            'address'      => 'required|string|max:255',
            'building'     => 'nullable|string|max:255',
            'category_id'  => 'required',
            'detail'      => 'required|string|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel.required'         => '電話番号を入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
 
    public function confirm(ContactRequest $request)
    {
        // バリデーション済みの入力値を取得
        $inputs = $request->all();

        // カテゴリ名を取得（IDから名前に変換）
        $category = Category::find($inputs['category_id']);
        $inputs['category_name'] = $category ? $category->content : '不明';

        // 確認画面に表示するビューに入力値を渡す
        return view('contacts.confirm', compact('inputs'));
    }

    public function send(ContactRequest $request)
    {
        $inputs = $request->all();

        // CSRF対策：戻る→再送信のセッションをリセット
        $request->session()->regenerateToken();

        // データベースに保存
        Contact::create($inputs);

        // 完了画面へ
        return redirect()->route('contacts.thanks');
    }
}
