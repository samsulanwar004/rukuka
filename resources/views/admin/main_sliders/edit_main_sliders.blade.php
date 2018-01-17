<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <p><a title="Return" href="{{ $return_url }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data SLiders</a></p>
  <div class='panel panel-default'>
    <div class='panel-heading'><strong><i class="fa fa-circle-o"></i> Add Sliders</strong></div>
    <form method='post' action='{{ route('edit.slider', ['id' => $row->id]) }}' enctype='multipart/form-data'>

      {{ csrf_field() }}
      <div class='panel-body'>

        <div class='form-group'>
          <input type="hidden" name="return_url" value="{{ $return_url }}">
          <label>Group Setting</label>
          <select class="form-control" name="group_setting" required>
            <option value="homepage" {{ $row->group_setting == 'homepage' ? 'selected' : null }}>Homepage</option>
            <option value="women" {{ $row->group_setting == 'women' ? 'selected' : null }}>Women</option>
            <option value="men" {{ $row->group_setting == 'men' ? 'selected' : null }}>Men</option>
            <option value="kids" {{ $row->group_setting == 'kids' ? 'selected' : null }}>Kids</option>
          </select>
        </div>

        <div class="form-group">
          <label>Banner</label>
          <label>
          @if($row->banner)
            <a data-lightbox="roadtrip" href="{{ uploadCDN($row->banner) }}">
              <img style="max-height:100px" src="{{ uploadCDN($row->banner) }}">
            </a>
          @endif
          </label>
          <input type='file' name='banner' required class='form-control'/>
        </div>

        <div class="form-group">
          <label>URL</label>
          <input type='text' name='url' class='form-control' value="{{$row->url}}"/>
        </div>

        <div class="form-group">
          <label>Order</label>
          <input type='number' name='order' class='form-control' value="{{$row->order}}"/>
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