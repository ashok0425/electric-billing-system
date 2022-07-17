<div id="columnpuchase_material" class="shadow-sm" style="width: 100%; height: 400px;"></div>


@php
    use carbon\carbon;

$M1=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->sum('amount');
$M2=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->sum('amount');
$M3=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->sum('amount');
$M4=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(3))->sum('amount');

$M5=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(4))->sum('amount');

$M6=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(5))->sum('amount');

$M7=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(6))->sum('amount');
$M8=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(7))->sum('amount');

$M9=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(8))->sum('amount');

$M10=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(9))->sum('amount');

$M11=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(10))->sum('amount');

$M12=DB::table('accounts')->whereYear('created_at',carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(11))->sum('amount');
    $m1=date('M');
    $m2=date('M',strtotime('-1 month'));
    $m3=date('M',strtotime('-2 month'));
    $m4=date('M',strtotime('-3 month'));
    $m5=date('M',strtotime('-4 month'));
    $m6=date('M',strtotime('-5 month'));
    $m7=date('M',strtotime('-6 month'));
    $m8=date('M',strtotime('-7 month'));
    $m9=date('M',strtotime('-8 month'));
    $m10=date('M',strtotime('-9 month'));
    $m11=date('M',strtotime('-10 month'));
    $m12=date('M',strtotime('-11 month'));

    

@endphp
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Month', 'Payment Recevied per month',],
      ["{{ $m1}}",     {{ $M1 }}],
      ["{{ $m2}}",     {{ $M2 }}],
      ["{{ $m3}}",     {{ $M3 }}],
      ["{{ $m4}}",     {{ $M4 }}],
      ["{{ $m5}}",     {{ $M5 }}],
      ["{{ $m6}}",     {{ $M6 }}],
      ["{{ $m7}}",     {{ $M7 }}],
      ["{{ $m8}}",     {{ $M8 }}],
      ["{{ $m9}}",     {{ $M9 }}],
      ["{{ $m10}}",     {{ $M10 }}],
      ["{{ $m11}}",     {{ $M11 }}],
      ["{{ $m12}}",     {{ $M12 }}]

       


    ]);

    var options = {
      chart: {
        title: 'Monthly order of current Year',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnpuchase_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>














    