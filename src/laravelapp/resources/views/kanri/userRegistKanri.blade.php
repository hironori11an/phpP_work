@extends('layouts.kanri.kanri')
@section('head')
<script src="{{mix('js/app.js')}}"></script>
<script src="/js/userRegistKanri.js"></script>
@endsection

@section('titleHeader','BookSpace')
@section('title','ユーザ登録')
@section('headerRight')
<a href="/kanri">ホーム</a>
@endsection

@section('work')

<form id="form" method="POST" action="{{ route('userRegistKanri.regist') }}">
  {{ csrf_field()}}
  <table border="0" align="center" width="400">
    <tr>
      <td colspan="2">{{Config::get('const.userRegist.MAX_REGIST_USERS')}}</td>
    </tr>
    <tr>
      <td width="65">
        <input type="button" id="btn_clear" value="クリア" class="btn">
      </td>
    </tr>

  </table>
  <div id="tyfk_userid">
    {!!session('err_m')!!}
  </div>
  @if ($errors->any())
  <!-- バリデーションエラー  userRegistRequest-->
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
  <!-- バリデーションエラー  既存ユーザチェック、空入力チェック-->
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

          <table border="1" margin="0" id="regist_user_tbl" style="border-collapse:collapse;border:none;">
            <!-- 項目 -->
            <tr width="400" class="input_item">
              <td width="20"><input type="checkbox" id="del_all_check"></td>
              <td width="120">ユーザID</td>
              <td width="120">パスワード
                <img src="{{ asset('/images/eye.svg')}}" class="passwordEyeOn">
              </td>
              <td width="120">権限</td>
            </tr>
            <!-- １行目 -->
            <tr>
              <td><input type="checkbox" name="clear_row_check" class="clear_row_check"></td>
              <td><input type="text" name="name[0]" value="{{ old('name.0') }}"></td>
              <td><input type="password" name="password[0]"></td>
              <td><input type="radio" name="authority[0]" value="0" checked="checked">一般<input type="radio"
                  name="authority[0]" value="1">管理
              </td>
            </tr>
            <!-- ２行目 -->
            <tr class="even_number_row">
              <td><input type="checkbox" name="clear_row_check" class="clear_row_check"></td>
              <td><input type="text" name="name[1]" value="{{ old('name.1') }}"></td>
              <td><input type="password" name="password[1]"></td>
              <td><input type="radio" name="authority[1]" value="0" checked="checked">一般<input type="radio"
                  name="authority[1]" value="1">管理
              </td>
            </tr>
            <!-- ３行目 -->
            <tr>
              <td><input type="checkbox" name="clear_row_check" class="clear_row_check"></td>
              <td><input type="text" name="name[2]" value="{{ old('name.2') }}"></td>
              <td><input type="password" name="password[2]"></td>
              <td><input type="radio" name="authority[2]" value="0" checked="checked">一般<input type="radio"
                  name="authority[2]" value="1">管理
              </td>
            </tr>
            <!-- ４行目 -->
            <tr class="even_number_row">
              <td><input type="checkbox" name="clear_row_check" class="clear_row_check"></td>
              <td><input type="text" name="name[3]" value="{{ old('name.3') }}"></td>
              <td><input type="password" name="password[3]"></td>
              <td><input type="radio" name="authority[3]" value="0" checked="checked">一般<input type="radio"
                  name="authority[3]" value="1">管理
              </td>
            </tr>

            <!-- ５行目 -->
            <tr>
              <td><input type="checkbox" name="clear_row_check" class="clear_row_check"></td>
              <td><input type="text" name="name[4]" value="{{ old('name.4') }}"></td>
              <td><input type="password" name="password[4]"></td>
              <td><input type="radio" name="authority[4]" value="0" checked="checked">一般<input type="radio"
                  name="authority[4]" value="1">管理
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
    <br>
  </div>
  <center>
    <input type="submit" class="btn">
  </center>
</form>
@endsection