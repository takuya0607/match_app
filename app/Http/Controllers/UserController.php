<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; //この行を追記

use Intervention\Image\Facades\Image; //追加

use App\Services\CheckExtensionServices; //追加
use App\Services\FileUploadServices; //追加

use App\Http\Requests\ProfileRequest;
class UserController extends Controller
{
    //
    public function show($id)
    {
        // findOrFail = userテーブル内に、指定のidがあれば
        $user = User::findOrFail($id); // 追記

        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        // compactで上記の$userを'user.edit'に渡す
        return view('users.edit', compact('user'));
    }

    public function update($id, ProfileRequest $request)
    {
        // findOrFail = userテーブル内に、指定のidがあれば
        $user = User::findOrFail($id);

        // !is_null = img_nameが空でなければ
        if(!is_null($request['img_name'])){

            // $imageFileにリクエストで送られた'img_name'を代入
            $imageFile = $request['img_name'];

            // FileUploadServicesクラスのfileUploadメソッドを使用する
            // ①まずは拡張子を含んだファイル名を取得
            // ②次に拡張子を除いたファイル名を取得
            // ③拡張子を取得
            // ④ファイル名_時間_拡張子として設定
            // ⑤ファイルの存在自体を取得
            // ⑥拡張子、ファイル名、ファイル本体の3つの変数を配列として$listに代入
            $list = FileUploadServices::fileUpload($imageFile);

            // list関数を使い、3つの変数に分割
            list($extension, $fileNameToStore, $fileData) = $list;

            //拡張子ごとに base64エンコード実施
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);

            //画像アップロード(Imageクラス makeメソッドを使用)
            $image = Image::make($data_url);

            //画像を横400px, 縦400pxにリサイズし保存
            $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

            // DBの'img_name'に＄fileNameToStore＝ファイル名_時間_拡張子として保存
            $user->img_name = $fileNameToStore;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->self_introduction = $request->self_introduction;
        $user->age = $request->age;

        $user->save();

        return redirect('home');
    }

        public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect('/');
    }



}
