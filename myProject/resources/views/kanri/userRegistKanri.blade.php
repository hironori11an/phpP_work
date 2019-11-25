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
  {{--
  <div id="app">
    <example-component></example-component>
  </div>
  --}}


  <input type="button" id="btn_add_row" value="行追加">
  <input type="button" id="btn_del_row" value="行削除">
  <table border="1">
    <tr>
      <td>
        <table border="1" id="first_table">
          <tr>
            <td><input type="checkbox" id="del_all_check"></td>
            <td>ユーザID</td>
            <td>PASSWORD</td>
            <td>権限</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="del_row_check" class="del_row_check" disabled='disabled'></td>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="password"></td>
            <td><input type="radio" name="authority" value="0"> 一般
              <input type="radio" name="authority" value="1"> 管理</td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <table id="add_table_row" border="1">
          <tbody>
          </tbody>
        </table>
      </td>
    </tr>

    <center><input type="submit"></center>
  </table>

  <script src="{{mix('js/app.js')}}"></script>
  <script>
    $(function() {
      var copy_row = $('#first_table tr:last').clone();
      var count_row = 0;
      //行追加した行数
      function count_table_row() {
        return $("#add_table_row tbody").children().length;
      }
      //行追加
      $('#btn_add_row').click(function(e) {
        count_row = count_table_row();
        //合計１０行になるまで行追加できる
        //追加した行の削除チェックボタンを活性化
        if (count_row < 9) {

          $(copy_row).clone().appendTo("#add_table_row");
          $('#add_table_row .del_row_check').prop("disabled", false);
        } else {
          alert('一度に登録できるのは１０件までです');
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