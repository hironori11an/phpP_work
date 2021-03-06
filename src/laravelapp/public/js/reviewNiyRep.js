$(function () {
  var connecting;
  //いいね登録時
  $(document).on('click', '.iine-on', function () {
    var $this = $(this);
    var review_id = $this.closest('table').prev('table').find('.reviewId').val();
    if (connecting) {
      return;
    }
    connecting = true;
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
      url: '/like',
      type: 'POST',
      data: {
        'review_id': review_id
      }
    })

      .done(function () {
        $this.attr({
          'src': '/images/iineZumi.png',
          'class': 'iine-off'
        });
        $this.closest('table').find('.iine-word').text('いいね済み');
      })

      .fail(function () {
      })
      .always(function () {
        connecting = false;
      })

  });


  //いいね取り消し時

  $(document).on('click', '.iine-off', function () {
    var $this = $(this);
    var review_id = $this.closest('table').prev('table').find('.reviewId').val();

    if (connecting) {
      return;
    }
    connecting = true;
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
      url: '/delLike',
      type: 'POST',
      data: {
        'review_id': review_id
      }
    })

      .done(function () {
        $this.attr({
          'src': '/images/iine.png',
          'class': 'iine-on'
        });
        $this.closest('table').find('.iine-word').text('いいね');
      })

      .fail(function () {
      })

      .always(function () {
        connecting = false;
      })
  });

  $(document).on('click', '.iine-btn', function () {
    $(this).find('img').click();
  });


  //いいねしたユーザリンク押下
  $(document).on('click', '#likedUser', function () {
    // 適当に高さを指定してwindow.openでポップアップ画面を開く
    var $this = $(this);
    var review_id = $this.closest('table').prev('table').find('.reviewId').val();
    var openWindow = window.open('/search/results/userLiked/' + review_id, 'sub', 'width=400, height=300,top=300,left=450');
    // 親画面にシェードをかける処理を実施
    var fadeLayer = $("#fadeLayer").get(0);
    fadeLayer.style.visibility = "visible";

    // １秒間隔で子画面の状態を監視
    var interval = setInterval(function () {
      // 子画面が閉じていたら
      if (!openWindow || openWindow.closed) {
        // 親画面のシェードを外す処理
        fadeLayer.style.visibility = "hidden";

        // Intervalを破棄
        clearInterval(interval);
        // 画面が起動していたら
      }
      else {
        // 子画面にフォーカスを当てる
        if (!openWindow.document.hasFocus()) {
          openWindow.focus();
        }
      }
    }, 500);
  });

  // レビュー内容行をクリック時
  $(document).on('click', '.tdReviwNiy, .tag_td', function () {
    var review_id = $(this).closest('table').prev('table').find('.reviewId').val();
    $('form').append('<input type="hidden" name="reviewNiyClick" value="X">');
    $('form').append('<input type="hidden" name="selectedReviewId" value=' + review_id + '>');
    $('form').attr('action', '/search/results');
    $('form').submit();
  });

  $('.tdReviwNiy, .tag_td').hover(function () {
    $(this).closest('table').find('.tdReviwNiy').css("background-color", "#C0C0C0");
    $(this).closest('table').find('.tag_td').css("background-color", "#C0C0C0");

  }, function () {
    $(this).closest('table').find('.tdReviwNiy').css("background-color", "#dedade");
    $(this).closest('table').find('.tag_td').css("background-color", "#dedade");
  }
  );

  // 削除ボタンクリック時
  $(document).on('click', "[name=comDelBtn]", function () {
    var com_id = $(this).closest('tr').find('.comId').val();
    $('form').append('<input type="hidden" name="delComId" value=' + com_id + '>');
    $('form').submit();
  });

  // コメント登録ボタンクリック時
  $(document).on('click', "[name=commentBtn]", function () {
    var comment = $('textarea[name="reviewNiyRep"]').val();
    // スペースのみは入力不可、0のみは入力可
    if (!$.trim(comment) && comment !== "0") {
      alert('コメントが未入力です');
      return false;
    }

  });

});