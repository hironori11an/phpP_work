$(function () {
  var connecting;
  //編集ボタン押下時
  $('.btn').click(function (e) {
    var reviewId = $(this).closest('tr').find('.reviewId').val();
    var form = $(this).parents('form');
    $('<input>').attr({
      'type': 'hidden',
      'name': 'selectedReviewId',
      'value': reviewId
    }).appendTo(form);
    form.submit();

  });

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
      url: '/search/results/delLike',
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
});