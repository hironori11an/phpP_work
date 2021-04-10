$(function () {

  // ページ読み込み時（DOMの構築が完了時）
  $(document).ready(function () {
    reread_time_make_disabled();
  });

  // 再読回数変更時
  $('select[name="reread_times"]').change(function () {
    reread_time_make_disabled();
  });


  /**
   * reread_time_make_disabled
   * 再読回数に応じて読了日を非活性にする
   */
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
  /**
   * Afeterdisabled
   * 「reread_time_make_disabled」から呼び出される
   * 
   */
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