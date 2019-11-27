@extends('layouts.kanri.kanri')
{{--@section('head')
<link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
@endsection
--}}

@section('titleHeader','BookSpace')
@section('title','ユーザ登録')
@section('work')
<form method="POST" action="{{ route('userRegistKanri.validation') }}">
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
  <br>
  <div id="form">
    <table border="0" align="center" margin="0" style="border-collapse:collapse;border:none;">
      <tr>
        <td>
          <table border="1" margin="0" id="first_table" width="400" style="border-collapse:collapse;border:none;">
            <tr class="input_item">
              <td width="20"><input type="checkbox" id="del_all_check"></td>
              <td width="120">ユーザID</td>
              <td width="120">パスワード</td>
              <td>権限</td>
            </tr>
            <tr>
              <td><input type="checkbox" name="del_row_check" class="del_row_check" disabled='disabled'></td>
              <td><input type="text" name="name"></td>
              <td><input type="text" name="password"></td>
              <td><input type="radio" name="authority" value="0">一般<input type="radio" name="authority" value="1">管理
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td>
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
      // var copy_row = $('#first_table tr:last').clone();
      var count_row;
      // var add_tr[];
      //行追加前の行数
      function count_table_row() {
        return $('#add_table_row tr').length;
      }
      //行追加
      $('#btn_add_row').click(function(e) {
        //
        count_row = count_table_row() + 1;
        //合計１０行になるまで行追加できる
        //追加した行の削除チェックボタンを活性化
        if (count_row < 5) {

          $('#add_table_row')
            .append(
              $('<tr></tr>')
              // $('<tr class="add_tr"> </tr>')
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
          if (count_row % 2 == 1) {
            $('#add_table_row tr:last').css('background-color', '#c7d3e4');
            // $('.' + "add_tr[" + count_row + "]").css('background-color', 'orange');
            // $('".add_tr[ ' + count_row + ' ]"').css('background-color', 'orange');
            // $(".add_tr").css('background-color', 'orange');
          }
          // $(copy_row).clone().appendTo("#add_table_row");
          // $('#add_table_row .del_row_check').prop("disabled", false);
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