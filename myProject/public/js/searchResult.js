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

});