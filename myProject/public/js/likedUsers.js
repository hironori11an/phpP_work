$(function () {
  $(document).ready(function () {
    window.onblur = function () { window.close(); }
  });
  //親画面に戻す値をオブジェクトとして準備
  $('.buttonLink').on('click', function () {

    var $this = $(this);
    var userName = $this.val();
    // alert(userName);
    var url = "/search/results/" + userName;
    window.opener.location.href = url;


    // 親画面の存在確認
    // 存在しなかったら次画面（子画面）を閉じる
    if (!window.opener || window.opener.closed) {
      window.close();
    }
    else {
      // 親画面を取得
      // var parentWindowObject = window.opener;
      // 親画面のelement1を取得
      // var element1 = parentWindowObject.document.getElementById('hoge1');
      // element1に値を設定
      // element1.value = '値１';
      // 親画面のelement2を取得
      // var element2 = parentWindowObject.document.getElementById('hoge2');
      // element1に値を設定
      // element2.value = '値２';
      // 子画面の終了
      window.close();
    }
  });

  $(document).ready(function () {
    $(window).on("beforeunload", function (e) {
      window.opener.focus();
    });
  });
});