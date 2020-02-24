$(function () {
  var connecting;
  //いいね登録時
  // $('.iine-on').click(function (e) {
  $(document).on('click', '.iine-on', function () {
    var $this = $(this);
    // var user_name = $this.closest('table').find('a').text();
    var review_id = $this.closest('table').find('.reviewId').val();
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
        // 'user_name': user_name,
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
  // $('.iine-off').click(function (e) {
  $(document).on('click', '.iine-off', function () {
    var $this = $(this);
    // var user_name = $this.closest('table').find('a').text();
    var review_id = $this.closest('table').find('.reviewId').val();

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
        // 'user_name': user_name,
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
});