<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // ここを追加
use Auth; // ここを追加

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // authorizeメソッドは、ユーザーがデータを更新するための権限を持っているかどうかを確認するために使います。
    public function authorize()
    {
        return true; // trueに変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      // ユニークなメールアドレスがすでに登録されている状態なので、自分のメールアドレスはチェック対象外にする必要がある。
      // この記述がないと、自分のメールアドレスをアップデートした時に、もうDBにあるよ！となる
        $myEmail = Auth::user()->email; // 追加

        return [
            // ここから追加
            'name' => 'required|string|max:15',
            'email' => ['required',
                        'string',
                        'email',
                        'max:255',
                        // whereNot = 含まない
                        // 今回で例えると自分のメールアドレスは含まない
                        Rule::unique('users', 'email')->whereNot('email', $myEmail)],
            // ここまで追加
            'self_introduction' => 'string|max:30',
            ];
    }
}
