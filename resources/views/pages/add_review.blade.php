@extends('app')

@section('content')
<div class="uk-container uk-container-small">
  <div class="uk-grid-small uk-margin-top">
    @include('partials.alert')
  </div>
<div class="uk-text-center uk-padding-small">
  <h3>TELL ME WHAT YOU THINK!</h3>
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
      <h4>* OVERALL RATING</h4>
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
    </div>
  </div>
  <hr>
  <div class="uk-grid uk-margin-top" uk-grid>
    <div class="uk-width-2-5@m">
      <h4>REVIEW YOUR PURCHASE</h4>
    </div>
    <div class="uk-width-3-5@m">
      <div class="uk-card uk-card-small uk-card-border">
        <div class="uk-card-body">
          <h5><b>WRITING GUIDLINES</b></h5>
          We want to publish your review, so please keep our guidelines in mind:
          <ul>
            <li>Do keep your review focused on the item you recently purchased (without sharing the price you paid for it)</li>
            <li>Don't write about customer service—just contact us here if something needs our attention</li>
            <li>Don't mention other brands</li>
            <li>Don't include your full name or anything else that might identify you</li>
          </ul>
        </div>
      </div>

      <div class="uk-panel uk-margin-top">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>*Title your review:</b></h4>
          <i>Example: Perfect spring transition piece</i>
        </div>
        <input type="text" class="uk-input uk-form {{ $errors->has('title') ? ' uk-form-danger' : '' }}" name="title" value="">
      </div>
      <div class="uk-panel">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>*Write your review:</b></h4>
          <i>You must enter at least 50 characters in this field and no more than 1,000.</i>
        </div>
        <textarea name="review" rows="8" cols="80" class="uk-textarea"></textarea>
      </div>
      <div class="uk-panel">
        <div class="uk-padding-small">
          <h4 class="uk-margin-remove"> <b>*Your location:</b></h4>
        </div>
        <input type="text" class="uk-input uk-form" name="location" value="">
      </div>
      <div class="uk-margin-top uk-margin-bottom">
        <button type="submit" class="uk-button uk-button-secondary">PREVIEW AND SUBMIT</button>
      </div>


    </div>
  </div>
{{ Form::close() }}
</div>
@endsection
