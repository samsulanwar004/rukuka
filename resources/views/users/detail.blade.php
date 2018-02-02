@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top uk-margin-bottom" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <h4 class="uk-text-uppercase uk-margin-small">{{ trans('app.edit_personal_info') }}</h4>
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

                <label class="uk-text-uppercase">{{ trans('app.full_name') }}</label>
              <div class="uk-margin-small uk-grid-small uk-child-width-1-2" uk-grid>
                  <div>
                      <input class="uk-input {{ $errors->has('first_name') ? ' uk-form-danger' : '' }}" name="first_name" value="{{ $user->first_name }}" type="text" placeholder="*{{ trans('app.first_name') }}" required="required">
                  </div>
                  <div>
                      <input class="uk-input {{ $errors->has('last_name') ? ' uk-form-danger' : '' }}" name="last_name" value="{{ $user->last_name }}" type="text" placeholder="*{{ trans('app.last_name') }}" required="required">
                  </div>
              </div>
                <label class="uk-text-uppercase">{{ trans('app.phone') }}</label>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>
                      <input class="uk-input {{ $errors->has('phone_number') ? ' uk-form-danger' : '' }}" name="phone_number" id="form-s-tel" type="tel" placeholder="*{{ trans('app.phone') }}" value="{{ $user->phone_number }}" required="required">
                  </div>
              </div>
                <label class="uk-text-uppercase">{{ trans('app.dob') }}</label>
              <div class="uk-margin-small uk-grid-small" uk-grid>
                  <div>

                        <select class="uk-select uk-form-width-small" id="form-h-select" name="day">
                            <option value="">* DD </option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option {{ old('day', $day) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                  </div>
                  <div>

                        <select class="uk-select uk-form-width-small" id="form-h-select" name="month">
                            <option value="">* MM</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option {{ old('month', $month) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                  </div>
                  <div>

                        <select  class="uk-select uk-form-width-small" id="form-h-select" name="year" required="required">
                            <option value="">* YYYY</option>
                            @php
                                $yearNow = date('Y');
                                $start = $yearNow - 80;
                            @endphp
                            @for ($i = $start; $i <= $yearNow; $i++)
                                <option {{ old('year', $year) == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>


                  </div>
              </div>
                <label class="uk-text-uppercase">{{ trans('app.gender') }}</label>
                <div class="uk-margin-small uk-grid-small uk-margin-bottom" uk-grid>
                  <div>
                      <input class="uk-radio" type="radio" name="gender" value="m" required="required" {{ old('gender', $user->gender) == 'm' ? 'checked' : '' }}> {{ trans('app.men') }}
                      <input class="uk-radio" type="radio" name="gender" value="f" required="required" {{ old('gender', $user->gender) == 'f' ? 'checked' : '' }}> {{ trans('app.women') }}
                  </div>
              </div>
            </div>
            <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">{{ trans('app.save') }}</button>

            </form>
          </div>


      </div>
    </div>
</div>
</div>
@endsection
