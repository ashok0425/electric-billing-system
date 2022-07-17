
 <div id="piechart_3d" class="shadow" style="width: 100%; height: 400px;"></div>
 @php
    use carbon\carbon;

     $M1=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now())->sum('unit');
     $M2=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(1))->sum('unit');
     $M3=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(2))->sum('unit');
     $M4=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(3))->sum('unit');
     $M5=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(4))->sum('unit');
     $M6=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(5))->sum('unit');
     $M7=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(6))->sum('unit');
     $M8=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(7))->sum('unit');
     $M9=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(8))->sum('unit');
 
 
     $M10=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(9))->sum('unit');
 
     $M11=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(10))->sum('unit');
     $M12=DB::table('consume_units')->whereYear('created_at',date('Y'))->whereMonth('created_at',Carbon::now()->subMonth(11))->sum('unit');
 
 
 
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
       google.charts.load("current", {packages:["corechart"]});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
         var data = google.visualization.arrayToDataTable([
           ['Month', 'Unit consumption'],
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
           title: 'Total jobsheet created per month',
           is3D: true,
         };
 
         var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
         chart.draw(data, options);
       }
     </script>
 
 