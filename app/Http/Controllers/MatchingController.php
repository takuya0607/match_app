<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Reaction;
use App\User;
use Auth;

use App\Constants\Status;
// ここまで追加

class MatchingController extends Controller
{
    // ここから追加
    public static function index(){

      // $got_reaction_ids変数に、Reactionテーブルから値をwhereで取得して代入する
      $got_reaction_ids = Reaction::where([
      //to_user_idが自分になる。
      // この二行で、自分へのリアクションがLIKE状態を指定
      ['to_user_id', Auth::id()],
      ['status', Status::LIKE]
      // pluckを使うことで、自分へLIKEしてくれた人(from_user_id)のID情報のみを取得
      ])->pluck('from_user_id');

      // whereInメソッドは指定した配列の中にカラムの値が含まれている条件を加える
      // LIKEしてくれた人の中で、'to_user_id'カラムから、自分がLIKEした人だけを抽出
      $matching_ids = Reaction::whereIn('to_user_id', $got_reaction_ids)
      ->where('status', Status::LIKE)
      ->where('from_user_id', Auth::id())
      ->pluck('to_user_id');

      $matching_users = User::whereIn('id', $matching_ids)->get();

      $match_users_count = count($matching_users);

      return view('users.index', compact('matching_users', 'match_users_count'));
    }
    // ここまで追加
}
