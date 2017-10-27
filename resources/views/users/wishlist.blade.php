@extends('app')

@section('content')
<div class="uk-container uk-container-small">
<div class="uk-grid-small uk-margin-top">
	@include('partials.alert')
</div>
<div class="uk-grid uk-margin-top" uk-grid>
	@include('partials.user_menu')
	<div class="uk-width-3-4@m">
      <div class="uk-grid-small uk-child-width-1-3@m uk-flex-left" uk-grid>

        @forelse($wishlists as $wish)
          <div class="uk-panel uk-visible-toggle">

            <!-- start product -->
            <div class="uk-card uk-card-small uk-padding-remove">
                <div class="uk-card-media-top">
                    <img src="/{{ $wish['photo'] }}" alt="">

                </div>
                <div class="uk-card-body uk-padding-remove uk-margin-small-top">

                </div>
                <!-- <div class="uk-card-footer">
                  <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
                </div> -->
            </div>
            <!-- end product single -->
            <div class="uk-panel uk-position-cover-card uk-invisible-hover">
              <!-- start product -->
                <div class="uk-box-shadow-large uk-padding-remove">
                    <div class="uk-card-media-top uk-inline">
                      <div class="uk-position-small uk-position-top-right">
                        <a href="#" class="uk-icon-button"  uk-icon="icon: triangle-down" title="Manage Your Cart" uk-tooltip="pos: right"></a>
                        <div id="parent-drop-click" uk-drop="mode: click">
                            <div id="parent-drop-card-click">
                              <ul class="uk-list">
                                <li><a href="/account/wishlist" class="uk-icon-button"  uk-icon="icon: pencil"></a></li>
                                <li>
                                  <a href="#destroy-{{ $wish['id'] }}" class="uk-icon-button"  uk-icon="icon: trash" uk-toggle></a>
                                  <!-- This is the modal -->
                                  <div id="destroy-{{ $wish['id'] }}" uk-modal>
                                      <div class="uk-modal-dialog uk-modal-body">
                                          <h2 class="uk-modal-title">Confirmation</h2>
                                          <p>Delete your wishlist {{ $wish['name'] }} ?</p>
                                          <form action="{{ route('user.wishlist.destroy', ['id' => $wish['id'] ]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <p class="uk-text-right">
                                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                                <button class="uk-button uk-button-primary" type="submit">Save</button>
                                            </p>
                                          </form>

                                      </div>
                                  </div>
                                </li>

                              </ul>
                            </div>
                        </div>
                      </div>
                        <img src="/{{ $wish['photo'] }}" alt="">
                    </div>
                    <div class="uk-card-body uk-background-default uk-padding-small uk-margin-small-top">
                        <a href="/product/{{ $wish['slug'] }}">{{ $wish['name'] }}</a>
                        <br>
                        <span>{{ $wish['currency'] }} {{ $wish['price'] }}</span>
                        <br>
                        <form action="{{ route('bag') }}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="size" value="{{ $wish['sku'] }}">
                          <input type="hidden" name="qty" value="{{ $wish['qty'] }}">
                          <input type="hidden" name="move" value="{{ $wish['id'] }}">
                          <button type="submit" class="uk-button uk-button-secondary uk-button-small uk-width-1-1">Add to cart</button>
                        </form>
                    </div>
                    <hr class="uk-margin-remove">
                    <div class="uk-card-footer uk-background-default uk-remove-padding-vertical uk-text-meta uk-padding-small">
                        <div class="uk-child-width-1-3" uk-grid>
                          <div class="">
                            color: <br> {{ $wish['color'] }}
                          </div>
                          <div class="">
                            size: <br> {{ $wish['size'] }}
                          </div>
                          <div class="">
                            Qty: <br> {{ $wish['qty'] }}
                          </div>
                        </div>
                    </div>
                    <!-- <div class="uk-card-footer">
                      <span class="uk-text-meta">Shirt<h4 class="uk-card-price">$400</h4></span>
                    </div> -->
                </div>

              <!-- end product single -->
            </div>
        </div>
        @empty
         <center>wishlist not found</center>
        @endforelse
      </div>
  </div>
</div>
</div>
@endsection
