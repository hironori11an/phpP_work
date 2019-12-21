<?php
 function validationData_check($data)
 {
     foreach ($data['name'] as $key => $value) {
         //ユーザIDとパスワードが両方とも未入力の場合のみ、バリデーションチェック対象から除外する
         //片方でも入力のある場合、両方ともチェックを実施する
         $user_id= $data['name'][$key];
         $password= $data['password'][$key];
         if (is_null($user_id) && is_null($password)) {
             unset($data['name'][$key],$data['password'][$key]);
         }
     }
     return $data;
 }
