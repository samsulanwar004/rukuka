<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
<div>

  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Orders</a></p>

  <div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class="fa fa-circle-o"></i> {{ $page_title }}</strong>
    </div>

      <div class="panel-body" style="padding:20px 0px 0px 0px">
        <div class="box-body" id="parent-form-area">
          <div class="col-md-6">
            Order Number <hr>
            {{ $row->order_code }} <br>
            @php
              if ($row->payment_status == '0') {
                  echo '<span class="label label-warning">Payment Pending</span>';
              } else {
                  echo '<span class="label label-success">Payment Success</span>';
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
                  echo '<span class="label label-warning">Sent Pending</span>';
              } else {
                  echo '<span class="label label-success">Sent Success</span>';
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
          <label class="control-label col-sm-2"></label>
          <div class="col-sm-10">

          </div>
        </div>
      </div>
        <!-- /.box-footer-->
    </div>
  </div>
</div>
@endsection