@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-text-center uk-padding-small">
  <h3>TELL ME WHAT YOU THINK!</h3>
</div>

<div class="uk-grid uk-margin-top" uk-grid>
  <div class="uk-width-2-5@m">
    <img src="/images/2-sq.jpg" alt="">
    <p class="uk-text-lead">
      Flowy Kimono
    </p>
  </div>
  <div class="uk-width-3-5@m">
    <h4>* OVERALL RATING</h4>
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
      <input type="text" class="uk-input uk-form" name="" value="">
    </div>
    <div class="uk-panel">
      <div class="uk-padding-small">
        <h4 class="uk-margin-remove"> <b>*Write your review:</b></h4>
        <i>You must enter at least 50 characters in this field and no more than 1,000.</i>
      </div>
      <textarea name="name" rows="8" cols="80" class="uk-textarea"></textarea>
    </div>
    <div class="uk-panel">
      <div class="uk-padding-small">
        <h4 class="uk-margin-remove"> <b>*Your nickname:</b></h4>
      </div>
      <input type="text" class="uk-input uk-form" name="" value="">
    </div>
    <div class="uk-panel">
      <div class="uk-padding-small">
        <h4 class="uk-margin-remove"> <b>*Your location:</b></h4>
      </div>
      <input type="text" class="uk-input uk-form" name="" value="">
    </div>
    <div class="uk-panel">
      <div class="uk-padding-small">
        <h4 class="uk-margin-remove"> <b>*Your email:</b></h4>
        <span class="uk-text-muted"><i>We need this information to authenticate your submission.</i></span>
      </div>
      <input type="text" class="uk-input uk-form" name="" value="">
    </div>
    <div class="uk-margin-top uk-margin-bottom">
      <input type="checkbox" name="" value="" class="uk-checkbox" > Email me if my feedback is published or if the J.Crew team comments on it.
    </div>
    <div class="uk-margin-top uk-margin-bottom">
      <input type="submit" name="" value="PREVIEW AND SUBMIT" class="uk-button uk-button-secondary">
    </div>

  </div>
</div>

</div>
@endsection
