$(function () {
  $(document).ready(function () {
    window.onblur = function () { window.close(); }
  });
  //親画面に戻す値をオブジェクトとして準備
  $('.buttonLink').on('click', function () {

    var $this = $(this);
    var userName = $this.val();
    var url = "/search/results/" + userName;
    window.opener.location.href = url;


    // 親画面の存在確認
    // 存在しなかったら次画面（子画面）を閉じる
    if (!window.opener || window.opener.closed) {
      window.close();
    }
    else {
      window.close();
    }
  });

  $(document).ready(function () {
    $(window).on("beforeunload", function (e) {
      window.opener.focus();
    });
  });
});