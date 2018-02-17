@extends('app')
@section('title', trans('app.title_lookbook') )
@section('content')
    <div class="uk-container uk-container-small">
      <div uk-slideshow="animation: push; autoplay:true">
                <div class="uk-position-relative uk-visible-toggle uk-light">

                    <ul class="uk-slideshow-items">
                        <li>
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                                <img src="images/photo.jpg" alt="" uk-cover>
                            </div>
                            <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                            <div class="uk-position-center uk-position-medium uk-text-center">
                                <div uk-slideshow-parallax="scale: 1,1,0.8">
                                    <h1 class="uk-heading-primary" uk-slideshow-parallax="x: 200,0,0">AMAZON FASHION WEEK</h1>
                                    <p class="uk-text-lead" uk-slideshow-parallax="x: 400,0,0;">The best from indonesian designer come to the best event</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1.2,1.2,1">
                                <img src="images/dark.jpg" alt="" uk-cover>
                            </div>
                            <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0,0,0.2; background-color: #000,#000"></div>
                            <div class="uk-position-center uk-position-medium uk-text-center">
                                <div uk-slideshow-parallax="scale: 1,1,0.8">
                                    <h1 class="uk-heading-primary" uk-slideshow-parallax="x: 200,0,0">LET'S GET STARTED</h1>
                                    <p class="uk-text-lead" uk-slideshow-parallax="x: 400,0,0;">Shop our best fashion</p>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                </div>

                <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>

            </div>

          <h3 class="uk-text-center">AMAZON FASHION WEEK COLLECTION</h3>
          <div class="uk-margin">
            <div class="uk-inline">
                <img src="images/photo3.jpg" alt=""  >
                <div class="uk-position-top-left uk-position-medium uk-text-center">
                    <div uk-slideshow-parallax="scale: 1,1,0.8">
                        {{-- <h1 class="uk-heading-primary" uk-slideshow-parallax="x: 200,0,0">AMAZON FASHION WEEK</h1> --}}
                        <p class="uk-text-lead" uk-slideshow-parallax="x: 400,0,0;">The best from indonesian designer come to the best event</p>
                    </div>
                </div>
            </div>
            <h4 class="uk-margin-small">Lookbook Name</h4>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-center" uk-grid>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                  </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>

            </div>
          </div>
          <div class="uk-margin">
            <div class="uk-inline">
                <img src="images/photo3.jpg" alt=""  >
                <div class="uk-position-top-left uk-position-medium uk-text-center">
                    <div uk-slideshow-parallax="scale: 1,1,0.8">
                        {{-- <h1 class="uk-heading-primary" uk-slideshow-parallax="x: 200,0,0">AMAZON FASHION WEEK</h1> --}}
                        <p class="uk-text-lead" uk-slideshow-parallax="x: 400,0,0;">The best from indonesian designer come to the best event</p>
                    </div>
                </div>
            </div>
            <h4 class="uk-margin-small">Lookbook Name</h4>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-center" uk-grid>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                  </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>
              <div class="uk-width-1-3">
              <div class="uk-card uk-card-small">
                <div class="uk-card-media-top">
                  <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                    <a href="#">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/dorothy-jumpsuit.jpg" alt="">
                    </a>
                  </div>

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">
                  <a href="#" class="uk-link-reset">
                  <h6 class="uk-margin-remove">Amazon Fashion Week Dress
                  </h6>
                  <span>$25.00</span>
                  </a>
                </div>
              </div>
              </div>

            </div>
          </div>
    </div>
@endsection
