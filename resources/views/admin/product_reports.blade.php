<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
<!-- Your custom  HTML goes here -->
<div class="box">
  <div class="box-body">
    <div class="progress" style="display: none">
      <div class="progress-bar progress-bar-striped active" role="progressbar"
        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:0%">
        <span id="persent"></span>
      </div>
    </div>
    <form action="{{CRUDbooster::adminPath('product-reports')}}" method="get">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" value="report-product-{{date('YmdHIs')}}" name="name" required="required">
      </div>
      <div class="form-group">
        <label for="designer">Designer Name</label>
        <select name="designer" id="designer" class="form-control">
          <option value="">--Select Designer--</option>
          @foreach($designers as $value)
            <option value="{{$value['id']}}" @if($designer==$value['id']) selected="selected" @endif>{{ $value['name'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
          <label for="date_range" class="control-label">Select Date Range</label>
          <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-calendar-o"></i> </div>
              <input type="text" name="date_create" value="{{$date_create}}" class="form-control datepicker">
          </div>
      </div>
      <div class="form-group">
        <label for="designer">Column</label>
        <div class="checkbox">
          @foreach($keys as $key => $value)
            <label>
              <input type="checkbox" name="attr[{{$key}}]" value="{{$value}}" @if(in_array($value, $attribute)) checked="checked" @endif>  
              {{strtoupper(str_replace('_', ' ', $value))}}
            </label>
          @endforeach
        </div>
      </div>
      <button type="submit" class="btn btn-default">Search</button>
      <button type="button" id="export" class="btn btn-primary">Export</button>
    </form>
  </div>
</div>
<div class="box">
  <div class="box-body table-responsive no-padding">
    <table class='table table-striped table-bordered'>
      <thead>
          <tr>
            @foreach($attribute as $value)
              <th>{{strtoupper(str_replace('_', ' ', $value))}}</th>
            @endforeach
           </tr>
      </thead>
      <tbody>
        @foreach($result as $row)
          <tr>
            @foreach($attribute as $value)
              <td>{{$row->$value}}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- ADD A PAGINATION -->
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
@endsection
@push('bottom')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {  

  $('#designer').select2();

  var start = moment().subtract(29, 'days');
  var end = moment();

  $('.datepicker').daterangepicker({
      startDate: start,
      endDate: end,
      timePicker: false,
      timePicker24Hour: false,
      format: 'YYYY-MM-DD'
  });

  $('#export').on('click', function() {
    var _link = window.location.href;
    var _linkArray = _link.split("?");
    var data = _linkArray[1];
    var type_request = 'new';
    var page = 1;
    var filename = document.getElementById('name').value+'.csv';

    requestCsv(data, type_request, page, filename);

    $('.progress').show();
  });

  function requestCsv(data, type_request, page, filename, no = null) {
      $.get( "{{ route('export.product') }}"+'?'+data, {
          type_request : type_request,
          filename : filename,
          page : page,
          no : no,
      }).success(function( response ) {
          var type_request = response.message.type_request;
          if (type_request == 'next') {
              var type_request = response.message.type_request;
              var filename = response.message.filename;
              var page = response.message.page;
              var no = response.message.no;
              var last = response.message.last;
              requestCsv(data, type_request, page, filename, no);

              var progress = Math.round(page/last*100);
              $('.progress-bar').css("width", function(){
                  return progress+'%';
              });
              $('#persent').text(progress+'% Please wait...');
          } else {
              $('.progress-bar').css("width", function(){
                  return 100+'%';
              });
              $('#persent').text('100% Please wait...');
              setTimeout(function(){
                  $('.progress').hide();
              }, 3000);
              window.location.href = '/export-product?download='+response.message.filename;
          }
      });
  }

});
</script>
@endpush