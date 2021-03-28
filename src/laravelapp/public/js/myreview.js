$(function () {
  // マイレビューのレビュー内容行押下時
  $(document).on('click', '.onebox', function () {
    var i = $('.onebox').index(this);
    var reviewId = $('.onebox').eq(i).find('.reviewId').val();
    var form = $(this).parents('form');
    $('<input>').attr({
      'type': 'hidden',
      'name': 'selectedReviewId',
      'value': reviewId
    }).appendTo(form);
    form.submit();

  });

  // マイレビュー、オンマウス時
  $('.onebox').hover(function () {
    var i = $('.onebox').index(this);
    $('.onebox').eq(i).css("background-color", "#0000CD");
  }, function () {
    var i = $('.onebox').index(this);
    $('.onebox').eq(i).css("background-color", "#c6e4ff");
  }
  );

});