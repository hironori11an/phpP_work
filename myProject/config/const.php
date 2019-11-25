<?php

return [
    // バリデーションで使う定数
    'validation' => [
        'USERID_LIMIT_CHARACTER_NUMBER' => 'ユーザIDは４桁から８桁で入力してください',
        'PASSWORD_LIMIT_CHARACTER_NUMBER' => 'ユーザIDは４桁から８桁で入力してください',
        'PASSWORD_AVAILABLE_CHARACTER' => '半角英数字・「_」・「-」の組み合せで入力してください',
    ],
    'login' => [
      'CERTIFICATION_ERROR' => 'ユーザ ID 又はパスワードが不正です',
  ],
];
