@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <b>EDIT MY PERSONAL INFORMATION</b>
			<hr class="uk-margin-small">
      <div class="uk-grid-small" uk-grid>
          <div class="uk-panel">
          <!-- <h3>SIGN IN</h3> -->
          <form class="uk-form-stacked" action="{{ route('user.update') }}" method="post">
          	{{ csrf_field() }}
          	@php
          		$dob = explode('-', $user->dob);
          		$day = $dob[2];
          		$month = $dob[1];
          		$year = $dob[0];
          	@endphp
            <div class="uk-margin">
              <!-- <legend class="uk-legend">PERSONAL INFORMATION</legend> -->
              FULL NAME
              <div class="uk-margin-small uk-grid-small uk-child-width-1-2" uk-grid>
                  <div>
                      <input class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" name="first_name" value="{{ $user->first_name }}" type="text" placeholder="*FIRST NAME" required="required">
                  </div>
                  <div>
                      <input class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" name="last_name" value="{{ $user->last_name }}" type="text" placeholder="*LAST NAME" required="required">
                  </div>
              </div>
              PHONE NUMBER
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                      <input class="uk-input {{ $errors->has('phone_number') ? ' uk-form-danger' : '' }}" name="phone_number" id="form-s-tel" type="tel" placeholder="*PHONE NUMBER" value="{{ $user->phone_number }}" required="required">
                  </div>
              </div>
              DATE OF BIRTH
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select class="uk-select uk-form-width-large" id="form-h-select" name="day">
                            <option value="">* DD </option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option {{ old('day', $day) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select class="uk-select uk-form-width-large" id="form-h-select" name="month">
                            <option value="">* MM</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option {{ old('month', $month) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>
                  <div>
                    <div uk-form-custom="target: > * > span:first">
                        <select  class="uk-select uk-form-width-large" id="form-h-select" name="year" required="required">
                            <option value="">* YYYY</option>
                            @php
                                $yearNow = date('Y');
                                $start = $yearNow - 80;
                            @endphp
                            @for ($i = $start; $i <= $yearNow; $i++)
                                <option {{ old('year', $year) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <span></span>
                            <span uk-icon="icon: chevron-down"></span>
                        </button>
                    </div>
                  </div>
              </div>
              GENDER
              <div class="uk-margin-small uk-grid-small uk-margin-bottom" uk-grid>
                  <div>
                      <input class="uk-radio" type="radio" name="gender" value="m" required="required" {{ old('gender', $user->gender) == 'm' ? 'checked' : '' }}> Men
                      <input class="uk-radio" type="radio" name="gender" value="f" required="required" {{ old('gender', $user->gender) == 'f' ? 'checked' : '' }}> Women
                  </div>
              </div>
            </div>
            <button class="uk-button uk-button-secondary" type="submit">SAVE</button>

            </form>
          </div>


      </div>
    </div>
</div>
</div>
@endsection
