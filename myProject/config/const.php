<?php

return [
    // バリデーションチェック
    'validation' => [
        'USERID_LIMIT_CHARACTER_NUMBER' => 'ユーザIDは４桁から８桁で入力してください',
        'PASSWORD_LIMIT_CHARACTER_NUMBER' => 'パスワードは４桁から８桁で入力してください',
        'PASSWORD_AVAILABLE_CHARACTER' => '半角英数字・「_」・「-」の組み合せで入力してください',
    ],
    //ログイン認証エラー
    'login' => [
      'CERTIFICATION_ERROR' => 'ユーザ ID または パスワードが誤っています',
  ],
  //ユーザ登録
  'userRegist' => [
    'MAX_REGIST_USERS' => '最大５名、ユーザ登録できます。',
    'WARN_MAX_REGIST_USERS' => '一度に登録できるのは５名までです',
],
];
