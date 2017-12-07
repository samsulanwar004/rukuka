<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
<div>

  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Orders</a></p>

  <div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class="fa fa-circle-o"></i> {{ $page_title }}</strong>
    </div>
    <form method='post' action='{{CRUDBooster::mainpath('edit-save/'.$row->id)}}'>
      {{ csrf_field() }}
      <input type="hidden" name="users_id" value="{{ $row->users_id }}">
      <input type="hidden" name="order_code" value="{{ $row->order_code }}">
      <input type="hidden" name="payment_method" value="{{ $row->payment_method }}">
      <input type="hidden" name="payment_name" value="{{ $row->payment_name }}">
      <input type="hidden" name="payment_validation_status" value="{{ $row->payment_validation_status }}">
      <input type="hidden" name="order_subtotal" value="{{ $row->order_subtotal }}">
      <input type="hidden" name="order_subtotal_after_discount" value="{{ $row->order_subtotal_after_discount }}">
      <input type="hidden" name="order_subtotal_after_coupon" value="{{ $row->order_subtotal_after_coupon }}">
      <input type="hidden" name="shipping_cost" value="{{ $row->shipping_cost }}">
      <input type="hidden" name="order_date" value="{{ $row->order_date }}">
      <input type="hidden" name="expired_date" value="{{ $row->expired_date }}">
      <div class="panel-body" style="padding:20px 0px 0px 0px">
        <div class="box-body" id="parent-form-area">
          <div class="col-md-6">
            Order Number <hr>
            {{ $row->order_code }} <br>
            @php
              if ($row->payment_status == '0') {
                  echo '<span class="label label-primary">Payment Pending</span>';
              } else if ($row->payment_status == '1') {
                  echo '<span class="label label-success">Payment Success</span>';
              } else {
                  echo '<span class="label label-danger">Payment Expired</span>';
              }
            @endphp
          </div>
          <div class="col-md-6">
            Shipping Address <hr>
            {{ $row->address->first_name }} {{ $row->address->last_name }} ({{ $row->address->phone_number }}) <br>
            {{ $row->address->company != null ?  $row->address->company.', ' : ''}}
            {{ $row->address->address_line }}, {{ $row->address->city }}, {{ $row->address->province }}, {{ $row->address->postal }}, {{ $row->address->country }} <br>
            Shipping : EMC<br>
            @php
              if ($row->order_status == '0') {
                  echo '<span class="label label-primary">Sent Pending</span>';
              } else if ($row->order_status == '1') {
                  echo '<span class="label label-info">Sent Process</span>';
              } else if ($row->order_status == '2') {
                  echo '<span class="label label-success">Sent Done</span>';
              } else {
                  echo '<span class="label label-danger">Cancel</span>';
              }
            @endphp
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="table-detail" class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Product Price</th>
                    <th>QTY</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $total = null;
                  @endphp
                  @foreach($row->details as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->sku }}</td>
                        <td>{{ $detail->price }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ $detail->subtotal }}</td>
                    </tr>
                    @php                                
                      $total += $detail->subtotal;
                    @endphp
                  @endforeach
                    <tr>
                      <td colspan="4">Shipping Cost</td><td>{{ $row->shipping_cost }}</td></tr>
                      <td colspan="4">Subtotal</td><td>{{ $total }}</td></tr>
                      <td colspan="4">Total</td><td>{{ $total + $row->shipping_cost }}</td></tr>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer" style="background: #F5F5F5">

        <div class="form-group">
          <div class="col-md-12" align="right">
            <label class="control-label">Payment Status</label>
            <select class="form-control" name="payment_status" style="width: 300px">
              <option value="0" {{ $row->payment_status == 0 ? 'selected' : ''}}>
                Payment Pending
              </option>
              <option value="1" {{ $row->payment_status == 1 ? 'selected' : ''}}>
                Payment Success
              </option>
              <option value="2" {{ $row->payment_status == 2 ? 'selected' : ''}}>
                Payment Expired
              </option>
            </select>
            <label class="control-label">Order Status</label>
            <select class="form-control" name="order_status" style="width: 300px">
              <option value="0" {{ $row->order_status == 0 ? 'selected' : ''}}>
                Sent Pending
              </option>
              <option value="1" {{ $row->order_status == 1 ? 'selected' : ''}}>
                Sent Process
              </option>
              <option value="2" {{ $row->order_status == 2 ? 'selected' : ''}}>
                Sent Done
              </option>
              <option value="3" {{ $row->order_status == 3 ? 'selected' : ''}}>
                Cancel
              </option>
            </select>
          </div>
          <div class="col-sm-12" align="right">
            <a href="{{ $return_url }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"> Back</i></a>
            <input type="submit" name="save" class="btn btn-success">
          </div>
        </div>
      </div>
        <!-- /.box-footer-->
    </form>
    </div>
  </div>
</div>
@endsection