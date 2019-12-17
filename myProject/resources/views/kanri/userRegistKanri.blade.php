@extends('layouts.kanri.kanri')
{{--@section('head')
<link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
@endsection
--}}

@section('titleHeader','BookSpace')
@section('title','ユーザ登録')
@section('work')

<form id="form" method="POST" action="{{ route('userRegistKanri.regist') }}">
  {{ csrf_field()}}
  <table border="0" align="center" width="400">
    <tr>
      <td colspan="2">{{Config::get('const.userRegist.MAX_REGIST_USERS')}}</td>
    </tr>
    <tr>
      <td width="65">
        <input type="button" id="btn_add_row" value="行追加">
      </td>
      <td>
        <input type="button" id="btn_del_row" value="行削除">
      </td>
    </tr>
  </table>

  @if ($errors->any())
  <table border="0" class="all_errormessage">
    <tr>
      <td>
        <div class="error">
          @for ($i = 0; $i < 5; $i++) @if ($errors->has('name.'.$i))
            <li align="left">{{ $errors->first("name.".$i) }}</li>
            @endif
            @if ($errors->has('password.'.$i))
            <li align="left">{{ $errors->first("password.".$i) }}</li>
            @endif
            @endfor
        </div>
    </tr>
    </td>
  </table>
  @else
  <!-- バリデーションエラー  -->
  <table border="0" class="all_errormessage" id="error_client_tbl" style="visibility:hidden;">
    <tr>
      <td>
        <div class="error_client">
        </div>
      </td>
    </tr>
  </table>
  @endif
  <br>
  <div id="form">
    <table border="0" align="center" margin="0" style="border-collapse:collapse;border:none;">
      <tr>
        <td>
          <!-- 固定行 -->
          <table border="1" margin="0" id="first_table" width="400" style="border-collapse:collapse;border:none;">
            <tr class="input_item">
              <td width="20"><input type="checkbox" id="del_all_check"></td>
              <td width="120">ユーザID</td>
              <td width="120">パスワード</td>
              <td>権限</td>
            </tr>
            <tr>
              <td><input type="checkbox" name="del_row_check" class="del_row_check" disabled='disabled'></td>
              <td><input type="text" name="name[0]" value="{{ old('name.0') }}"></td>
              <td><input type="text" name="password[0]"></td>
              <td><input type="radio" name="authority[0]" value="0">一般<input type="radio" name="authority[0]"
                  value="1">管理
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td>
          <!-- 動的に行追加を行うテーブル -->
          <table id="add_table_row" border="1" margin="0" width="400" style="border-collapse:collapse;border:none;">
          </table>
        </td>
      </tr>
    </table>
  </div>
  <center><input type="submit"></center>


  <script src="{{mix('js/app.js')}}"></script>
  <script>
    $(function() {
      var count_row; //行数
      var v_user_id; //ユーザIDの値
      //バリデーションチェック
      $('#form').submit(function(e) {
        //ユーザID配列の初期化
        array_user_id = [];
        count_row = count_table_row();
        //エラーメッセージの初期化
        $('.error_client').empty();
        $('#error_client_tbl').css('visibility', 'hidden');
        for (var i = 0; i < count_row + 1; i++) {
          v_user_id = $('input[name="name[' + i + ']"]').val();
          //ユーザIDに重複がない場合は、配列に追加していく
          if (array_user_id.indexOf(v_user_id) == -1) {
            array_user_id.push(v_user_id);
          } else {
            //ユーザIDに重複がある場合は、falseを返す
            $('.error_client').append($('<li>ユーザID「' + v_user_id + '」が重複しています</li>'));
            $('#error_client_tbl').css('visibility', 'visible');


            return false;
          }

        }
        // alert(array_user_id); //test用
        // return false; //test用


      });

      //行追加前の行数
      function count_table_row() {
        return $('#add_table_row tr').length;
      }

      //行追加ボタン押下
      $('#btn_add_row').click(function(e) {
        //追加前の行数を取得、初期表示時から１行（削除不可）があるため +1 して取得
        count_row = count_table_row() + 1;
        //合計５行になるまで行追加できる
        //追加した行の削除チェックボタンを活性化（固定行の削除チェックボタンは常に非活性）
        if (count_row < 5) {

          $('#add_table_row')
            .append(
              $('<tr></tr>')
              .append($('<td width="20"></td>').html(
                '<input type="checkbox" name="del_row_check" class="del_row_check">'))
              .append($('<td width="120"></td>').html('<input type="text" name="name[' + count_row + ']">'))
              .append($('<td width="120"></td>').html('<input type="text" name="password[' + count_row +
                ']">'))
              .append($('<td></td>').html('<input type="radio" name="authority[' + count_row +
                ']" value="0">一般' +
                '<input type="radio" name="authority[' + count_row +
                ']" value="1">管理'))
            );
          //上下の行で背景色を変えるように設定
          if (count_row % 2 == 1) {
            $('#add_table_row tr:last').css('background-color', '#c7d3e4');
          }

        } else {
          //const.phpをjsonで取得
          alert(@json(config('const.userRegist.WARN_MAX_REGIST_USERS')));
        }
      });

      //削除ボタン押下時
      $('#btn_del_row').click(function(e) {
        $('#add_table_row tr').has('input[type=checkbox]:checked').remove();
      });

      //全削除チェック押下時
      $('#del_all_check').change(function(e) {
        $('#add_table_row .del_row_check').prop("checked", this.checked);
      });
    });
  </script>
</form>
@endsection