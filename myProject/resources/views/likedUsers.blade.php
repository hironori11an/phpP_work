<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/likedUsers.js"></script>

  <title>いいねしたユーザ</title>
</head>

<body>

  <div id="page">
    <div id="pageBody">
      <section class="mainVisual">
        <div id="pageBodyMain">
          @foreach ($items as $item)
          <h1>いいねしたユーザ</h1>
          @if(count($item->users)===0)
          いいねしたユーザはいません
          @else
          <table>
            @foreach ($item->users as $user)
            <tr>
              <td>
                <button class="buttonLink" value="{{$user->name}}">
                  {{$user->name}}
                </button>
              </td>
            </tr>
            @endforeach
            @endif

            @endforeach
          </table>
        </div>
      </section>
    </div>
  </div>
</body>

</html>