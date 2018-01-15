<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Images</a></p>
  <div class='panel panel-default'>
    <form method='post' action='{{ route('upload.product') }}' enctype='multipart/form-data'>
    {{ csrf_field() }}
    <div class='panel-body'>
        <div class='form-group'>
          <label>Image Product</label>
          <input type="hidden" name="return_url" value="{{ $return_url }}">
          <input type="hidden" name="parent_id" value="{{ $parent_id }}">
          <input type='text' name='name' required class='form-control'/>
          <input type='file' name='image' required class='form-control'/>
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