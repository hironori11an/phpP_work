<link href="{{ asset('css/kanri/kanri.css') }}" rel="stylesheet">

<input type="button" value="{{$value}}" class="btn" id="btn_modoru">

<script src="{{mix('js/app.js')}}"></script>
<script>
  $("#btn_modoru").on("click", function() {
    window.location.href = "{{$url}}";
  });
</script>