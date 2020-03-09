$(function () {

  //パスワード（見える）押下時
  $(document).on('click', '.passwordEyeOn', function () {
    $(this).prev('#password').attr("type", "text");
    $(this).attr({
      'src': '/images/eye-off.svg',
      'class': 'passwordEyeOff'
    });
  });

  //パスワード（隠す）押下時
  $(document).on('click', '.passwordEyeOff', function () {
    $(this).prev('#password').attr("type", "password");
    $(this).attr({
      'src': '/images/eye.svg',
      'class': 'passwordEyeOn'
    });
  });

});