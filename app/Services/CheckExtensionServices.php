<?php

namespace App\Services;

class CheckExtensionServices
{

  public static function checkExtension($fileData, $extension){

    // 拡張子が大文字の可能性もあるので、mb_strtolower関数で小文字に変更
    $extension = mb_strtolower($extension);

    if ($extension === 'jpg'){
      $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
    }

    if ($extension === 'jpeg'){
      $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
    }

    if ($extension === 'png'){
      $data_url = '/storage/images/'. base64_encode($fileData);
    }

    if ($extension === 'gif'){
      $data_url = 'data:image/gif;base64,'. base64_encode($fileData);
    }

    return $data_url;
  }
}
