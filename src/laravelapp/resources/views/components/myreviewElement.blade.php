<div class="oneArea">
  @foreach ($reviews as $review)
    <div class="onebox">
      <input type="hidden" name="reviewId" class="reviewId" value="{{$review->id}}">
      <b>『{{$review->title}}』</b><br>
      <div class="line2">
        {{$review->chysh}}
      </div>
      <div class="line3">
        <img src="{{ asset('/images/hyk_level/ico_grade_'.$review->hyk.'.gif')}}" width="80" height="15">
        &nbsp;&nbsp;再読回数:{{$review->reread_times}}
      </div>
      <div class="line4">
        最新読了日:
        @if(isset($review->read_end_date_for_fourth))
          {{$review->read_end_date_for_fourth}}
        @elseif(isset($review->read_end_date_for_third))
          {{$review->read_end_date_for_third}}
        @elseif(@isset($review->read_end_date_for_second))
          {{$review->read_end_date_for_second}}
        @elseif(@isset($review->read_end_date_for_first))
          {{$review->read_end_date_for_first}}
        @endif
      </div>
      
      <p><div class="picture">
        @isset($review->photo_path)
          <img src="{{$review->photo_path}}" width="150" height="100">
        @else
          <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
        @endisset
      </div>
      </p>
    </div>
  @endforeach
</div>