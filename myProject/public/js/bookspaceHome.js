$(function () {
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
});