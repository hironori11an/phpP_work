$(function () {

  // ページ読み込み時（DOMの構築が完了時）
  $(document).ready(function () {
    reread_time_make_disabled();
  });

  // 再読回数変更時
  $('select[name="reread_times"]').change(function () {
    reread_time_make_disabled();
  });

  // 更新ボタン押下寺
  $(document).on('click', '.btn', function () {
    return checkReadEndDate();
  });

  /**
   * checkReadEndDate
   * 
   */
  function checkReadEndDate() {
    let reread_times = $('select[name="reread_times"]').val();
    // 再読回数に応じて読了日の入力チェックをする
    let chckReadEndDateNum = parseInt(reread_times);
    let errFlg = false;
    let errMsg = "";
    for (let i = 1; i < chckReadEndDateNum + 1; i++) {
      if (i === 1) {
        if ($('input[name="read_end_date_for_first"]').val() === "") {
          errFlg = true;
          errMsg += '初回の読了日が未入力です\n';
        }
      } else if (i === 2) {
        if ($('input[name="read_end_date_for_second"]').val() === "") {
          errFlg = true;
          errMsg += '２回目の読了日が未入力です\n';
        }
      } else if (i === 3) {
        if ($('input[name="read_end_date_for_third"]').val() === "") {
          errFlg = true;
          errMsg += "３回目の読了日が未入力です\n";
        }
      } else if (i === 4) {
        if ($('input[name="read_end_date_for_fourth"]').val() === "") {
          errFlg = true;
          errMsg += "４回目以降の読了日が未入力です\n";
        }
      }
    }
    // エラーがある場合はアラート、FALSEを読み出し元に返却
    if (errFlg) {
      alert(errMsg);
      return false;
    }
    return true;
  }

  // 再読回数に応じて読了日を非活性にする
  function reread_time_make_disabled(reread_times) {
    var reread_times = $('select[name="reread_times"]').val();
    switch (reread_times) {
      case "1":
        Afeterdisabled(reread_times);
        break;
      case "2":
        Afeterdisabled(reread_times);
        break;
      case "3":
        Afeterdisabled(reread_times);
        break;
      case "4":
        Afeterdisabled(reread_times);
        break;
      default:
        break;//何もしない

    }
  }

  function Afeterdisabled(reread_times) {
    // 一旦全ての読了日を活性化
    $('input[name="read_end_date_for_second"]').prop('disabled', false);
    $('input[name="read_end_date_for_third"]').prop('disabled', false);
    $('input[name="read_end_date_for_fourth"]').prop('disabled', false);

    // 再読回数に応じて非活性にする
    // 再読回数を数値型(整数）に変換
    afterNum = parseInt(reread_times);
    afterNum = afterNum + 1;
    for (let i = afterNum; i < 5; i++) {
      if (i === 2) {
        $('input[name="read_end_date_for_second"]').prop('disabled', true);
      } else if (i === 3) {
        $('input[name="read_end_date_for_third"]').prop('disabled', true);
      } else if (i === 4) {
        $('input[name="read_end_date_for_fourth"]').prop('disabled', true);
      }
    }
  }

});