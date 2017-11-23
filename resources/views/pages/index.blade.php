@extends('app')

@section('content')

{{-- <div class="uk-grid-small uk-margin-top" uk-grid> --}}

    @php
      $leftTitle = explode('|', $home['left_title']);
      $rightTitle = explode('|', $home['right_title']);
      $womenTitle = explode('|', $home['women_title']);
      $menTitle = explode('|', $home['men_title']);
      $kidTitle = explode('|', $home['kid_title']);
    @endphp
    <div class="uk-text-center">
      <div class="uk-container uk-container-small">
        <div class="uk-panel uk-padding-small uk-visible@m">
          <span class="uk-text-lead">Now Open Ku Ka Indonesia, which serve many various style cloth and stuff.</span>
        </div>
        <div class="uk-panel uk-padding-small uk-hidden@m">
          <h4>Now Open Ku Ka Indonesia, which serve many various style cloth and stuff.</h4>
        </div>
      </div>
      <div class="uk-inline">
        <div class="uk-inline-clip uk-transition-toggle uk-light">
        <a href="#/{{ $home['women_link'] }}" class="uk-link-reset">
        <img src="/{{ $home['main_banner'] }}" alt="">
        <div class="uk-width-2-6@m" uk-grid>

          <div class="uk-card uk-position-center uk-position-medium uk-card-small uk-visible@m">
            <div class="uk-card-body">
            <div class="uk-transition-slide-left-small"><h2 class="uk-margin-remove">Prepare for your summer season</h2></div>
            <div class="uk-transition-slide-right-small"><h4 class="uk-margin-remove"><a href="/{{ $home['women_link'] }}">{{ $womenTitle[1] }}<span uk-icon="icon: triangle-right"></span></a></h4></div>
            </div>
          </div>
          <div class="uk-card uk-position-center uk-position-medium uk-card-small uk-hidden@m">
            <div class="uk-card-body">
            <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove">Prepare for your summer season</h3></div>
            <div class="uk-transition-slide-right-small"><h4 class="uk-margin-remove"><a href="/{{ $home['women_link'] }}">{{ $womenTitle[1] }}<span uk-icon="icon: triangle-right"></span></a></h4></div>
            </div>
          </div>
        </div>
      </a>
      </div>
      </div>
    </div>
  {{-- </div> --}}
  <div class="uk-container uk-container-small">
    <div class="uk-card-border uk-card-small uk-margin-top">
    <div class="uk-card-body">
    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-1-5@m uk-width-1-3 uk-flex uk-flex-middle">
          <div class="uk-visible@m">
            <span class="uk-text-lead">New Arrival</span>
          </div>
          <div class="uk-hidden@m">
            <h5>New Arrival</h5>
          </div>
        </div>
        <div class="uk-width-2-5@m uk-width-2-3 uk-inline uk-flex uk-flex-middle">
          <div class="uk-visible@m">
            <span class="uk-text-lead"><a href="#">Men,</a> <a href="#">Women,</a> <a href="#">Kids</a></span>
          </div>
          <div class="uk-hidden@m">
            <h4><a href="#">Men,</a> <a href="#">Women,</a> <a href="#">Kids</a></h4>
          </div>
        </div>
        <div class="uk-width-2-5@m uk-inline">
          <div class="uk-visible@m">
            <h3 class="uk-margin-remove uk-text-danger">Lets See On The Blog</h3>
            <a href="#" class="uk-text-muted">Inspiration and Interesting People Out There,<span uk-icon="icon: triangle-right"></span></a>
          </div>
          <div class="uk-hidden@m">
            <h4 class="uk-margin-remove uk-text-danger">Lets See On The Blog</h4>
            <a href="#" class="uk-text-muted">Inspiration and Interesting People Out There,<span uk-icon="icon: triangle-right"></span></a>
          </div>


        </div>
    </div>
    </div>
  </div>

  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-3">

            <div class="uk-inline uk-visible@m">
              <div class="uk-inline-clip uk-transition-toggle uk-light">
                <a href="#/{{ $home['women_link'] }}" class="uk-link-reset">
                <img src="/{{ $home['women_banner'] }}" alt="">
                  <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                    <div class="uk-card-body">
                      <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove">{{ $womenTitle[0] }}</h3></div>
                      <div class="uk-transition-slide-right-small"><h4 class="uk-margin-remove"><a href="/{{ $home['women_link'] }}">{{ $womenTitle[1] }}<span uk-icon="icon: triangle-right"></span></a></h4></div>
                    </div>
                </div>
                </a>
              </div>
            </div>
            <div class="uk-inline uk-hidden@m">
              <a href="#/{{ $home['women_link'] }}" class="uk-link-reset">
              <img src="/{{ $home['women_banner'] }}" alt="">
              <h5 class="uk-margin-remove">{{ $womenTitle[0] }}</h5>
              </a>
            </div>

      </div>
      <div class="uk-width-1-3 uk-inline">

          <div class="uk-inline uk-visible@m">
            <div class="uk-inline-clip uk-transition-toggle uk-light">
              <a href="#/{{ $home['men_link'] }}" class="uk-link-reset">
              <img src="/{{ $home['men_banner'] }}" alt="">
                <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                  <div class="uk-card-body">
                    <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove">{{ $menTitle[0] }}</h3></div>
                    <div class="uk-transition-slide-right-small"><h4 class="uk-margin-remove"><a href="/{{ $home['men_link'] }}">{{ $menTitle[1] }}<span uk-icon="icon: triangle-right"></span></a></h4></div>
                  </div>
                </div>
              </div>
          </div>
          <div class="uk-inline uk-hidden@m">
            <a href="#/{{ $home['men_link'] }}" class="uk-link-reset">
            <img src="/{{ $home['men_banner'] }}" alt="">
            <h5 class="uk-margin-remove">{{ $menTitle[0] }}</h5>
            </a>
          </div>
      </div>
      <div class="uk-width-1-3 uk-inline">
          <div class="uk-inline uk-visible@m">
            <div class="uk-inline-clip uk-transition-toggle uk-light">
              <a href="#/{{ $home['kid_link'] }}" class="uk-link-reset">
              <img src="/{{ $home['kid_banner'] }}" alt="">
              <div class="uk-card uk-position-bottom center uk-position-medium uk-card-small uk-card-border-light">
                <div class="uk-card-body">
                  <div class="uk-transition-slide-left-small"><h3 class="uk-margin-remove"><h3 class="uk-margin-remove">{{ $kidTitle[0] }}</h3></div>
                  <div class="uk-transition-slide-right-small"><h4 class="uk-margin-remove"><a href="/{{ $home['kid_link'] }}">{{ $kidTitle[1] }}<span uk-icon="icon: triangle-right"></span></a></h4></div>
                </div>
              </div>
          </div>
      </div>
      <div class="uk-inline uk-hidden@m">
        <a href="#/{{ $home['kid_link'] }}" class="uk-link-reset">
        <img src="/{{ $home['kid_banner'] }}" alt="">
        <h5 class="uk-margin-remove">{{ $kidTitle[0] }}</h5>
        </a>
      </div>
    </div>
  </div>
  <hr>
  <div class="uk-text-left">
  	<span class="uk-text-lead">MOST POPULAR</span>

  </div>
  	<popular
      api="{{ route('populer')}}"
      product_api="{{ route('product.api') }}"
      bag_api="{{ route('persist.bag') }}"
      wishlist_api="{{ route('persist.wishlist') }}"
      auth="{{ Auth::check() ? 1 : 0 }}"
    ></popular>


    </div>
@endsection
