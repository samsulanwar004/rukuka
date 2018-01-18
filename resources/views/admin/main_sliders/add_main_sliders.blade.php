<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data SLiders</a></p>
  <div class='panel panel-default'>
    <div class='panel-heading'><strong><i class="fa fa-circle-o"></i> Add Sliders</strong></div>
    <form method='post' action='{{ route('add.slider') }}' enctype='multipart/form-data'>
      {{ csrf_field() }}
      <div class='panel-body'>

        <div class='form-group'>
          <input type="hidden" name="return_url" value="{{ $return_url }}">
          <label>Group Setting</label>
          <select class="form-control" name="group_setting" required>
            <option value="">** please select a group setting</option>
            <option value="Homepage">Homepage</option>
            <option value="Women">Women</option>
            <option value="Men">Men</option>
            <option value="Kids">Kids</option>
          </select>
        </div>

        <div class="form-group">
          <label>Banner</label>
          <input type='file' name='banner' required class='form-control'/>
        </div>

        <div class="form-group">
          <label>URL</label>
          <input type='text' name='url' class='form-control'/>
        </div>

        <div class="form-group">
          <label>Order</label>
          <input type='number' name='order' class='form-control'/>
        </div>

      </div>
      <div class='panel-footer'>
        <a href="{{ $return_url }}" class="btn btn-default">
          <i class="fa fa-chevron-circle-left"></i> Back
        </a>
        <input type="submit" name="submit" value="Save" class="btn btn-success">
      </div>
    </form>
  </div>
@endsection