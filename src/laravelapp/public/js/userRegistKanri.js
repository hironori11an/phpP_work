$(function () {
  var count_row; //行数
  var v_user_id; //ユーザIDの値
  //バリデーションチェック
  $('#form').submit(function (e) {
    //初期化
    array_user_id = [];
    $("#tyfk_userid").empty();
    $('.all_errormessage').empty();

    for (var i = 0; i < 5; i++) {
      v_user_id = $('input[name="name[' + i + ']"]').val();
      if (v_user_id !== "") {
        //ユーザIDに重複がない場合は、配列に追加していく
        if (array_user_id.indexOf(v_user_id) == -1) {
          array_user_id.push(v_user_id);
        } else {
          //ユーザIDに重複がある場合は、メッセージを設定する
          $('#tyfk_userid').append($('<li>ユーザID「' + v_user_id + '」が重複しています</li>'));

        }
      }
    }
    //ユーザIDに重複がある場合は、falseを返す
    if ($('#tyfk_userid').has('li').length > 0) {
      return false;
    }
  });

  //全削除チェック押下時
  $('#del_all_check').change(function (e) {
    $('.clear_row_check').prop("checked", this.checked);
  });

  //削除ボタン押下時
  $('#btn_clear').click(function (e) {
    $('#regist_user_tbl tr').has('input[type=checkbox]:checked').find($("input[type='text']")).val('');

  });

  //パスワード（見える）押下時
  $(document).on('click', '.passwordEyeOn', function () {
    $(this).closest('table').find('[name^="password"]').attr("type", "text");
    $(this).attr({
      'src': '/images/eye-off.svg',
      'class': 'passwordEyeOff'
    });
  });

  //パスワード（隠す）押下時
  $(document).on('click', '.passwordEyeOff', function () {
    $(this).closest('table').find('[name^="password"]').attr("type", "password");
    $(this).attr({
      'src': '/images/eye.svg',
      'class': 'passwordEyeOn'
    });
  });



});
