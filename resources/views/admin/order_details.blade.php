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
          <div class="col-md-3">
            Order Number <hr>
            <b>{{ $row->order_code }} </b>
            <br>
            Air Waybill
            <span class="label label-info"> {{ $row->airwaybill }} </span> <br><br>
            <b>Order Date</b> <br>
            {{ $row->order_date }} <br>

          </div>
          <div class="col-md-3">
            Payment<hr>
            <b style="text-transform: capitalize;">{{ $row->payment_method }} </b>
            <br>
            @php
              if ($row->payment_status == '0') {
                  echo '<span class="label label-primary">Payment Unpaid</span>';
              } else if ($row->payment_status == '1') {
                  echo '<span class="label label-success">Payment Success</span>';
              } else {
                  echo '<span class="label label-danger">Payment Expired</span>';
              }
            @endphp
            <br>
            @if($row->payment_status != '1')
            <br>
            <b>Expired Date</b> <br>
            {{ $row->expired_date }} <br>
            @endif
          </div>
          <div class="col-md-3">
            Customer Detail <hr>
            <b>User Account:</b> <br>
            {{ $row->email }} <br><br>
            <b>Address:</b> <br>
            {{ $row->first_name }} {{ $row->last_name }} ({{ $row->phone_number }}) <br>
            {{ $row->company != null ?  $row->company.', ' : ''}}<br>
            {{ $row->address_line }}, {{ $row->city }}, {{ $row->province }}, {{ $row->postal }}, {{ $row->country }} <br>
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
          <div class="col-md-3">
            Shipping Detail <hr>
            <b>Service</b> <br>
            {{ $row->shipping_name }}
            <br>
            {{ $row->shipping_service }}
          </div>
          <div class="col-md-12" style="padding: 20px">
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
                  @foreach($orderDetail as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td><a href="javascript:void(0);" data-href="{{ route('get.product', ['sku' => $detail->sku ])}}" class="openPopup">{{ $detail->sku }}</a></td>
                        <td>Rp. {{ number_format($detail->price) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp. {{ number_format($detail->subtotal) }}</td>
                    </tr>
                    @php                                
                      $total += $detail->subtotal;
                    @endphp
                  @endforeach
                    <tr>
                      <td colspan="4">Shipping Cost</td><td>Rp. {{ number_format($row->shipping_cost) }}</td></tr>
                      <td colspan="4"><b>Total</b></td><td><b>Rp. {{ number_format($total + $row->shipping_cost) }}</b></td></tr>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Product Detail</h4>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
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
            <br>
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
            <br>
            <label class="control-label">Air Waybill</label>
            <input type='text' name='airwaybill' class='form-control' value="{{ $row->airwaybill }}" style="width: 300px"/>
          </div>
          <div class="col-sm-12" align="right">
            <br>
            <a href="{{ $return_url }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
            <input type="submit" name="save" class="btn btn-success">
          </div>
        </div>
      </div>
      </div>
        <!-- /.box-footer-->
    </form>
    </div>
  </div>
</div>
@endsection