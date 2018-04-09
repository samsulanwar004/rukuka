@extends('app')
@section('title', trans('app.title_confirm') )
@section('content')

<div class="uk-container">
  	<div class="uk-grid-small uk-margin-top uk-margin-bottom uk-flex uk-flex-center">
      	<div class="uk-width-1-1@m ">
			<div class="uk-card">
        		<div class="uk-card-body">
				<h3 class="uk-card-title uk-text-center uk-text-uppercase">
				{{ trans('app.confirm_title') }}
				</h3>
			{{ trans('app.confirm_subtitle') }}
				{{ trans('app.please') }} <a href="/help/contact-us" class="uk-text-primary">{{ trans('app.contact_us') }} </a> {{ trans('app.confirm_contact_us') }}
				<hr>
					<div class="uk-grid-small uk-margin-top">
						@include('partials.alert')
					</div>
				<div class="uk-overflow-auto">
					<form class="form-horizontal" method="post" action="{{ route('payment.confirm') }}">
		            	{{ csrf_field() }}
						<div class="uk-grid-divider uk-child-width-expand@s" uk-grid>
							<div>
								<ul class="uk-list uk-text-left">
									<label class="text-underline">{{ trans('app.customer_detail') }}</label>
									<li>
										<label class="">{{ trans('app.order_number_label') }}</label>
										<input class="uk-input {{ ($errors->has('order_code')?'uk-text-danger':'' ) }}" id="order_code" type="text" maxlength="15" placeholder="{{ trans('app.order_number_placeholder') }}" required="required" name="order_code" value="{{ old('order_code') }}">
									</li>
									<li>
										<label class="">{{ trans('app.customer_bank') }}</label>
										<input class="uk-input" type="text" maxlength="30" placeholder="{{ trans('app.customer_bank_placeholder') }}" required="required" name="customer_bank" value="{{ old('customer_bank') }}">
									</li>
									<li>
										<label class="">{{ trans('app.account_owner') }}</label>
										<input class="uk-input" type="text" maxlength="30" placeholder="{{ trans('app.account_owner_placeholder') }}" required="required" name="account_owner" value="{{ old('account_owner') }}">
									</li>
								</ul>
							</div>
							<div>
								<ul class="uk-list uk-text-left">
									<label class="text-underline">{{ trans('app.store_detail') }}</label>
									<li>
										<label class="">{{ trans('app.store_bank') }}</label>
										<select name="store_bank" required class="uk-select">
											<option disabled selected value> {{trans('app.store_bank_placeholder')}} </option>
											<option @if (old('store_bank')=='BCA') selected @endif value="BCA">{{ trans('app.bca') }} - {{ trans('app.no-bca') }} - {{ trans('app.name-bca') }}</option>
											<option @if (old('store_bank')=='MANDIRI') selected @endif value="MANDIRI">{{ trans('app.mandiri') }} - {{ trans('app.no-mandiri') }} - {{ trans('app.name-mandiri') }}</option>
											<option @if (old('store_bank')=='BNI') selected @endif value="BNI">{{ trans('app.bni') }} - {{ trans('app.no-bni') }} - {{ trans('app.name-bni') }}</option>
										</select>
									</li>
									<li>
										<label class="">{{ trans('app.transfer_amount') }}</label>
										<input class="uk-input" type="number" min="0" placeholder="{{ trans('app.transfer_amount_placeholder') }}" required="required" name="transfer_amount" value="{{ old('transfer_amount') }}">
									</li>
									<li class="uk-text-right">
										<br>
										<button class="uk-button uk-button-medium uk-button-secondary" type="submit">{{ trans('app.confirm_label') }}</button>
									</li>
								</ul>

							</div>
						</div>

	                </form>
				</div>
        </div>
				<div class="uk-card-footer">
					<div class="uk-panel uk-text-center">
						<a href="{{ route('index') }}" class="uk-button-text uk-button"><span class="uk-icon" uk-icon="icon: chevron-left"></span>{{ trans('app.back_to_home') }}</a>
					</div>
				</div>
			</div>
		</div>
  	</div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#order_code").click(function(){
            $("#order_code").removeClass( "uk-text-danger" );
        });
    });
</script>
@endsection
