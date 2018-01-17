<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Edit Form</div>
    <form method='post' action='{{ route('upload.update', ['id' => $row->id]) }}' enctype='multipart/form-data'>
      {{ csrf_field() }}
      <div class='panel-body'>
          <div class='form-group'>
            <label>Name Photo</label>
            <input type="hidden" name="return_url" value="{{ $return_url }}">
            <input type='text' name='name' required class='form-control' value='{{ $row->name }}'/>
            <label>Image</label> <br>
            @if($row->photo)
            <a data-lightbox="roadtrip" href="{{ uploadCDN($row->photo) }}">
              <img style="max-width:160px" src="{{ uploadCDN($row->photo) }}">
            </a>
            @endif
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