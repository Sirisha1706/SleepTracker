<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Sleep Tracker || Datewise Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Datewise Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Datewise Report</div>
					<div class="panel-body">

						<div class="col-md-12">

					
<?php
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<h5 align="center" style="color:blue">Datewise Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <tr>
              <th>Date</th>
              <th>Sleep time</th>
              <th>Wakeup time</th>
              <th>Duration</th>
                </tr>
                                        </tr>
                                        </thead>
 <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"SELECT SleepDate,SleepTime,WakeTime,DurFloat,Duration as totaldaily FROM `tblexpense`  where (SleepDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') order by SleepDate");
$cnt=0;
$cnt1=0;
$slpDt = array();
$slpDur = array();
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $row['SleepDate']; array_push($slpDt,$row['SleepDate']); ?></td>
            
                  <td><?php  echo $row['SleepTime']; ?></td>
                  <td><?php  echo $row['WakeTime']; ?></td>
                  <td><?php  echo $ttlsl=$row['totaldaily']; array_push($slpDur,$row['DurFloat']); if($row['totaldaily']==NULL) $cnt1++;?></td>
           
           
                </tr>
                <?php
                $totalsexp+=$row['DurFloat']; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="3" style="text-align:center">Average sleep hours per day</th>     
  <td><?php $hrs = $totalsexp/($cnt-$cnt1);
        echo floor($hrs);
        echo " hrs ";
        echo floor(($hrs-round($hrs))*60);
        echo " mins";
        ?></td>
 </tr>     

                                    </table>




						</div>
					</div>
				</div><!-- /.panel-->

				<canvas id="myChart" width="400" height="200"></canvas>
<script>

<?php
    $php_array1 = $slpDt;
	$php_array2 = $slpDur;
    ?>
    var js_array1 = [<?php echo '"'.implode('","', $php_array1).'"' ?>];
	var js_array2 = [<?php echo '"'.implode('","', $php_array2).'"' ?>];



var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: js_array1,
        datasets: [{
            label: 'Sleep Hours',
            data: js_array2,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php } ?>