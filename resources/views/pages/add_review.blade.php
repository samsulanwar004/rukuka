@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
    @include('partials.alert')
  </div>
<div class="uk-text-center uk-padding-small">
  <h3 class="uk-text-uppercase">{{ trans('app.tell_text') }}</h3>
</div>

{{ Form::open(array('url' => '/review', 'method' =>'post','files' => true,'class' => '')) }}
  <input type="hidden" name="slug" value="{{$product->slug}}">
  <input type="hidden" name="products_id" value="{{$product->id}}">
  <div class="uk-grid uk-margin-top" uk-grid>
    <div class="uk-width-2-5@m">
    <img src="/{{ $product->images[0]['photo'] }}" alt="" width="450"></a>
      <p class="uk-text-lead">
        {{$product->name}}
      </p>
    </div>

    <div class="uk-width-3-5@m">
      <h4 class="uk-text-uppercase"><b>{{ trans('app.overall_rating') }}</b></h4>
      <div class="stars uk-margin-left">
        <input type="radio" name="star" class="star-1" id="star-1" value="1"/>
        <label class="star-1" for="star-1">1</label>
        <input type="radio" name="star" class="star-2" id="star-2" value="2"/>
        <label class="star-2" for="star-2">2</label>
        <input type="radio" name="star" class="star-3" id="star-3" value="3"/>
        <label class="star-3" for="star-3">3</label>
        <input type="radio" name="star" class="star-4" id="star-4" value="4"/>
        <label class="star-4" for="star-4">4</label>
        <input type="radio" name="star" class="star-5" id="star-5" value="5" checked/>
        <label class="star-5" for="star-5">5</label>
        <span></span>
      </div>
      <h4 class="uk-text-uppercase">{{ trans('app.review_purchase') }}</h4>
      <div class="uk-card uk-card-small uk-card-border">
        <div class="uk-card-body">
          <h5 class="uk-text-uppercase"><b>{{ trans('app.writing_guide') }}</b></h5>
          {{ trans('app.writing_text_1') }}
          <ul>
            <li>{{ trans('app.writing_text_2') }}</li>
            <li>{{ trans('app.writing_text_3') }}</li>
            <li>{{ trans('app.writing_text_4') }}</li>
            <li>{{ trans('app.writing_text_5') }}</li>
          </ul>
        </div>
      </div>
      <div class="uk-panel uk-margin-top">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>{{ trans('app.title_review') }}</b></h4>
          <i>{{ trans('app.title_help') }}</i>
        </div>
        <input type="text" class="uk-input uk-form {{ $errors->has('title') ? ' uk-form-danger' : '' }}" name="title" value="">
      </div>
      <div class="uk-panel">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>{{ trans('app.write_your_review') }}</b></h4>
          <i>{{ trans('app.write_your_help') }}</i>
        </div>
        <textarea name="review" rows="8" cols="80" class="uk-textarea"></textarea>
      </div>
      <div class="uk-panel">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>{{ trans('app.location_review') }}</b></h4>
        </div>
        <input type="text" class="uk-input uk-form" name="location" value="">
      </div>
      <div class="uk-margin-top uk-margin-bottom">
        <button type="submit" class="uk-button uk-button-secondary uk-text-uppercase">{{ trans('app.submit') }}</button>
      </div>
    </div>
  </div>
  <hr>
{{ Form::close() }}
</div>
@endsection
