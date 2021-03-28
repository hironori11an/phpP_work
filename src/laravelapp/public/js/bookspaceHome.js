$(function () {
  var connecting;
  //編集ボタン押下時
  // $('.btn').click(function (e) {
  //   var reviewId = $(this).closest('tr').find('.reviewId').val();
  //   var form = $(this).parents('form');
  //   $('<input>').attr({
  //     'type': 'hidden',
  //     'name': 'selectedReviewId',
  //     'value': reviewId
  //   }).appendTo(form);
  //   form.submit();

  // });

  //取消押下時
  $(document).on('click', '.btn-strong', function () {
    var $this = $(this);
    var review_id = $this.closest('table').find('.reviewLike_review_id').val();

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
        $this.closest('table').remove();
      })

      .fail(function () {
      })

      .always(function () {
        connecting = false;
      })
  });

  //いいねしたユーザリンク押下
  $(document).on('click', '#likedUser', function () {
    // 適当に高さを指定してwindow.openでポップアップ画面を開く
    var $this = $(this);
    // 「いいねしたレビュー」か「マイレビュー」どちらの側のボタンを押したかを判定する
    var review_id = $this.closest('table').parents('#reviewLikeTable').find('.reviewLike_review_id').val();
    if (review_id === undefined) {
      var review_id = $this.closest('table').parents('#myReviewTable').find('.reviewId').val();
    }
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

  // マイレビューのレビュー内容行押下時
  $(document).on('click', '.tdReviwNiy, .tag_td', function () {
    var review_id = $(this).closest('#myReviewTable').find('.reviewId').val();
    $('form').append('<input type="hidden" name="reviewNiyClick" value="X">');
    $('form').append('<input type="hidden" name="selectedReviewId" value=' + review_id + '>');
    $('form').attr('action', '/search/results');
    $('form').submit();
  });

  // いいねしたレビューのレビュー内容行押下時
  $(document).on('click', '.tdReviwNiy_iine, .tag_td_iine', function () {
    var review_id = $(this).closest('#reviewLikeTable').find('.reviewLike_review_id').val();
    $('form').append('<input type="hidden" name="reviewNiyClick" value="X">');
    $('form').append('<input type="hidden" name="selectedReviewId" value=' + review_id + '>');
    $('form').attr('action', '/search/results');
    $('form').submit();
  });

  // レビュー内容行（マイレビュー）、オンマウス時
  $('.tdReviwNiy, .tag_td').hover(function () {
    $(this).closest('table').find('.tdReviwNiy').css("background-color", "#C0C0C0");
    $(this).closest('table').find('.tag_td').css("background-color", "#C0C0C0");

  }, function () {
    $(this).closest('table').find('.tdReviwNiy').css("background-color", "#dedade");
    $(this).closest('table').find('.tag_td').css("background-color", "#dedade");
  }
  );

  // レビュー内容行（いいねしたレビュー）、オンマウス時
  $('.tdReviwNiy_iine, .tag_td_iine').hover(function () {
    $(this).closest('table').find('.tdReviwNiy_iine').css("background-color", "#C0C0C0");
    $(this).closest('table').find('.tag_td_iine').css("background-color", "#C0C0C0");

  }, function () {
    $(this).closest('table').find('.tdReviwNiy_iine').css("background-color", "#dedade");
    $(this).closest('table').find('.tag_td_iine').css("background-color", "#dedade");
  }
  );


});