<?php

namespace App\Services;

class FileUploadServices
{
  public static function fileUpload($imageFile){

    //$imageFileからファイル名を取得(拡張子あり)
    $fileNameWithExt = $imageFile->getClientOriginalName();

    //拡張子を除いたファイル名を取得
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

    //拡張子を取得
    $extension = $imageFile->getClientOriginalExtension();

    // ファイル名_時間_拡張子 として設定
    // ファイル名を取得後、ファイル名に時刻を追加することで、ファイル名の重複を避ける
    // $fileNameToStoreは、ファイル名を取得している変数
    $fileNameToStore = $fileName.'_'.time().'.'.$extension;

    //画像ファイル取得
    // $fileDataは、ファイル自体を取得している変数
    $fileData = file_get_contents($imageFile->getRealPath());

    // 3つの変数を配列として$list変数に設定
    $list = [$extension, $fileNameToStore, $fileData];

    return $list;

  }

}