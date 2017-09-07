@extends('app')

@section('content')
	
<div class="uk-grid-small uk-margin-top" uk-grid>
    <div class="uk-text-center">
      <div class="uk-inline-clip uk-transition-toggle uk-dark">
          <img src="images/baner-home.png" alt="">
          <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
          <!-- <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right">HOT DEALS THIS WEEKEND, WITH 50% DISCOUNT, <br>
            SIGN UP NOW, ON KUKAINDONESIA.COM
          </div> -->
      </div>
    </div>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-3@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="images/2_2.jpg" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-left">
                  <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW FOR WOMEN</button>
                </div>
            </div>
            <h3 class="uk-margin-remove">2017: Women in Style</h3>
            <a href="#" class="uk-text-muted">Shop all this amazing outfit now<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-width-1-3@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="images/Batik_Merah.jpg" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-left">
                <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW FOR MEN</button>
              </div>
          </div>
          <h3 class="uk-margin-remove">2017: Men Perfect Outfit</h3>
          <a href="#" class="uk-text-muted">Shop all this amazing outfit now<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-3@m uk-inline">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="images/06.jpg" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-remove uk-position-medium uk-position-bottom-left">
                <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW FOR KIDS</button>
              </div>
          </div>
          <h3 class="uk-margin-remove">2017: Cute and Beauty Everywhere</h3>
          <a href="#" class="uk-text-muted">Shop all this amazing outfit now<span uk-icon="icon: triangle-right"></span></a>

      </div>
  </div>
  <hr>
  <!-- <div class="uk-text-left">
  <h2><span><b>Shop New Arrivals</b></span></h2>
  </div> -->
  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-1-5@m">

            <h5 class="uk-margin-remove">New Arrival</h5>
            <h3 class="uk-margin-remove">For Women</h3>
            <a href="#" class="uk-text-muted">Shop Now<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-width-1-5@m uk-inline">

          <h5 class="uk-margin-remove">New Arrival</h5>
          <h3 class="uk-margin-remove">For Men</h3>
          <a href="#" class="uk-text-muted">Shop Now<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-1-5@m uk-inline">
          <h5 class="uk-margin-remove">New Arrival</h5>
          <h3 class="uk-margin-remove">For Kids</h3>
          <a href="#" class="uk-text-muted">Shop NOw<span uk-icon="icon: triangle-right"></span></a>

      </div>
      <div class="uk-width-2-5@m uk-inline">

          <h3 class="uk-margin-remove uk-text-danger">Lets See On The Blog</h3>
          <a href="#" class="uk-text-muted">Inspiration and Interesting People Out There,<span uk-icon="icon: triangle-right"></span></a>

      </div>
  </div>
  <hr>
  <div class="uk-text-left">
  <h2><span><b>Shop & Collection</b></span></h2>
  </div>
  <div class="uk-grid-small uk-margin-top uk-margin-bottom uk-child-width-1-2@m" uk-grid>
      <div class="uk-panel">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="images/coll-women.jpg" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-left"><b>FOR WOMEN</b> <br>Our Clothes, Your Style
                </div>

            </div>
            <h3 class="uk-margin-remove">Classic with a twist: colorful espadrilles</h3>
            <a href="#" class="uk-text-muted">Shop them now<span uk-icon="icon: triangle-right"></span></a>
      </div>
      <div class="uk-panel">

          <div class="uk-inline-clip uk-transition-toggle uk-dark">
              <img src="images/coll-men.jpg" alt="">
              <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
              <div class="uk-overlay uk-overlay-default uk-padding-small uk-position-medium uk-position-bottom-right"><b>FOR MEN</b> <br>Our broken-in tees
              </div>
          </div>
          <h3 class="uk-margin-remove">What to wear when you’re sweating on purpose</h3>
          <a href="#" class="uk-text-muted">New Balance® X J.Crew<span uk-icon="icon: triangle-right"></span></a>
      </div>
  </div>
  <hr>
  <div class="uk-text-left">
  <h2><span>Most Popular</span></h2>
  </div>
  <div class="uk-grid-small uk-child-width-1-4@m uk-margin-large-bottom" uk-grid>
    <!-- start product -->
    <div class="uk-panel uk-text-left">
      <div class="uk-card uk-card-small uk-padding-remove">
          <div class="uk-card-media-top">
              <img src="images/2_2.jpg" alt="">

          </div>
          <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
          </div>
          <!-- <div class="uk-card-footer">
            <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
          </div> -->
      </div>
    </div>
    <!-- end product single -->
    <!-- start product -->
    <div class="uk-panel uk-text-left">
      <div class="uk-card uk-card-small uk-padding-remove">
          <div class="uk-card-media-top">
              <img src="images/6_2.jpg" alt="">
          </div>
          <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
          </div>
          <!-- <div class="uk-card-footer">
            <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
          </div> -->
      </div>
    </div>
    <!-- end product single -->
    <!-- start product -->
    <div class="uk-panel uk-text-left">
      <div class="uk-card uk-card-small uk-padding-remove">
          <div class="uk-card-media-top">
              <img src="images/10_1.jpg" alt="">
          </div>
          <div class="uk-card-body uk-padding-remove uk-margin-small-top">
            <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
            <br>
            <span class="uk-text-bold">$333</span>
          </div>
          <!-- <div class="uk-card-footer">
            <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
          </div> -->
      </div>
    </div>
    <!-- end product single -->
    <!-- start product -->
    <div class="uk-panel uk-text-left">
      <div class="uk-card uk-card-small uk-padding-remove">
          <div class="uk-card-media-top">
              <img src="images/2_2.jpg" alt="">
          </div>
          <div class="uk-card-body uk-padding-remove uk-margin-small-top">
              <a href="#" class="uk-text-muted">Slim-Fit Stretch-Cotton Twill Bermuda</a>
              <br>
              <span class="uk-text-bold">$333</span>
          </div>
          <!-- <div class="uk-card-footer">
            <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
          </div> -->
      </div>
    </div>
    <!-- end product single -->

  </div>
  <hr>
  <div class="uk-text-left">
  <h2><span><b>KuKa <i>Stories</i>: The Blog</b></span></h2>
  </div>

  <div class="uk-grid-small uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-3-4@m">

            <div class="uk-inline-clip uk-transition-toggle uk-dark">
                <img src="images/pak_denny_jpeg.jpg" alt="">
                <div class="uk-transition-fade uk-overlay-default uk-position-cover"></div>
                <div class="uk-overlay uk-overlay-default uk-position-medium uk-position-bottom-left">
                  <h2><a href="#">What are the rules of party dressing?</a></h2>
                  <a href="#">See all the Story from KuKa Blog<span uk-icon="icon: triangle-right" class="uk-icon"></span></a>
                  <!-- <button class="uk-button uk-button-small uk-button-default uk-padding-small-right">SHOP NOW FOR WOMEN</button> -->
                </div>
            </div>
            <!-- <h3 class="uk-margin-remove">2017: Women in Style</h3>
            <a href="#" class="uk-text-muted">Shop all this amazing outfit now<span uk-icon="icon: triangle-right"></span></a> -->
      </div>
      <div class="uk-width-1-4@m uk-inline">

          <h3 class="uk-margin-remove">How can we help?</h3>
          <ul class="uk-list">
            <li><a href="#">Find my nearest store</a></li>
            <li><a href="#">Track my order </a></li>
            <li><a href="#">See the latest Style Guide on Pinterest </a></li>
            <li><a href="#">Sign in to My Account </a></li>
            <li><a href="#">Share how great our product </a></li>
          </ul>

      </div>
  </div>
@endsection