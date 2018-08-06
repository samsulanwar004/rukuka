<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
<!-- Your custom  HTML goes here -->
<div class="box">
  <div class="box-body table-responsive no-padding">
    <div id="loading-chart" class="overlay">
      <center><h2>Catch data from exchange rates live, Please wait...</h2></center>
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
  </div>
</div>
<div class="box">
  <div class="box-body table-responsive no-padding">
    <table class='table table-striped table-bordered'>
      <thead>
          <tr>
            <th>Created By</th>
            <th>Currency Code From</th>
            <th>Conversion Value</th>
            <th>Currency Code To</th>
            <th>Conversion Value</th>
            <th>Created At</th>
           </tr>
      </thead>
      <tbody>
        @foreach($result as $row)
          <tr>
            <td>{{$row->admin_name}}</td>
            <td>{{strtoupper($row->currency_code_from)}}</td>
            <td>Rp. {{number_format($row->conversion_value, 2)}}</td>
            <td>{{strtoupper($row->currency_code_to)}}</td>
            <td>{{$row->inverse_conversion_value}}</td>
            <td>{{$row->created_at}}</td>
           </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- ADD A PAGINATION -->
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
@endsection
@push('head')
<style type="text/css">
canvas{
  width:1100px !important;
  height:300px !important;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
@endpush
@push('bottom')
<script type="text/javascript">
$(document).ready(function() {                      
  var ctx = document.getElementById("myChart");

  var jsonData = $.ajax({
    url: 'http://local.rukuka.com/api/v1/exchange-rate',
    dataType: 'json',
  }).done(function (results) {
      document.getElementById('loading-chart').style = 'display: none;';
      var labels = [];
      var datas = [];
      results.data.forEach(function(entry) {
          labels.push(entry.base);
          datas.push(entry.idr);
      });
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'IDR',
                data: datas,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
      });
  });

});
</script>
@endpush