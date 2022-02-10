<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
	if(isset($_POST['submit']))
	{
	   $userid=$_SESSION['detsuid'];
	   $sleepdate=$_POST['sleepdate'];
	   $sleeptime=$_POST['sleeptime'];
	   $waketime=$_POST['waketime'];

	   $hr=floatval((strtotime($waketime)-strtotime($sleeptime))/3600);
		if($hr<0){$hr=$hr+24;}
		$mi=($hr-floor($hr))*60;
		$dur= (floor($hr)."hr  ". $mi. "min");

	   $duration=$dur;

	  $query=mysqli_query($con, "insert into tblexpense(UserId,SleepDate,SleepTime,WakeTime,Duration,DurFloat) value('$userid','$sleepdate','$sleeptime','$waketime','$duration','$hr')");
  if($query){
  echo "<script>alert('Data has been added');</script>";
  echo "<script>window.location.href='dashboard.php'</script>";
  } else {
  echo "<script>alert('Something went wrong. Please try again');</script>";
  
  }
	
  }
//code deletion
  if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblexpense where ID='$rowid'");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='dashboard.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}
  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Sleep Tracker - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body >
	
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
	<div id='outer' align="right">
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
		<div class="row" >
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		<?php
              $userid=$_SESSION['detsuid'];
			  $tdate = date("Y-m-d");
			  $fdate = date("Y-m-d", strtotime("-7 days", strtotime($tdate)));
			$ret=mysqli_query($con,"select * from tblexpense where (SleepDate BETWEEN '$fdate' and '$tdate') && UserId='$userid'order by SleepDate");
			$cnt=1;
			$slpDt = array();
			$slpDur = array();
			if($row=mysqli_fetch_array($ret)){ 
		?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header" align='center'>Dashboard (Last week's report)</h1>
			</div>
		</div><!--/.row-->
		
	
		<!-- entries of last week -->
		<div class="row">
		<div class="col-md-10">
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>Date (yy-mm-dd) </th>
                  <th>Sleep Time (24hrs)</th>
                  <th>Wakeup Time (24hrs)</th>
                  <th>Duration</th>
                  <th>Action</th>
                </tr>
              </thead>
			   <?php
			   $userid=$_SESSION['detsuid'];
			   $tdate = date("Y-m-d");
		$fdate = date("Y-m-d", strtotime("-7 days", strtotime($tdate)));
		$ret=mysqli_query($con,"select * from tblexpense where (SleepDate BETWEEN '$fdate' and '$tdate') && UserId='$userid'order by SleepDate");
		$cnt=1;
		$slpDt = array();
		$slpDur = array();
		while ($row=mysqli_fetch_array($ret)) {

			?>
              <tbody>
                <tr>              
                  <td><?php  echo $row['SleepDate']; array_push($slpDt,$row['SleepDate']);?></td>
                  <td><?php  echo $row['SleepTime'];?></td>
                  <td><?php  echo $row['WakeTime'];?></td>
				  <td><?php  echo $row['Duration']; array_push($slpDur,$row['DurFloat']);?></td>
                  <td><a href="dashboard.php?delid=<?php echo $row['ID'];?>">Delete</a>  </td>
                </tr>
                <?php 
			$cnt=$cnt+1;
			}?>
               
              </tbody>
            </table>
          </div>
		</div>
	
	
		


	</div>
	<div class="row">
	<div class="col-md-12">
	<div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
  </div>
</div>
</div>

	<div class="row">
	<div class="col-md-10">
	<canvas id="myChart" width="600" height="200"></canvas>
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
</div>
	</div>
	<div class="row">
	<div class="col-md-12">
	<div class="progress">
  <div class="progress-bar" style="width:100%"></div>
</div>
  </div>
</div>
</div>

<?php }?>


	<!-- new entry button -->
	<div class="col-sm-12">
	 <p class="back-link"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add a new entry</button></p>
	 
	</div>

	<!-- The Modal -->
	<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add the sleep schedule</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
							<form role="form" method="post" action="">

								<div class="form-group">
									<label>Date:</label>
									<input class="form-control" type="date" value="" name="sleepdate" required="true">
								</div>

								<div class="form-group">
									<label>Sleep time: </label>
									<input class="form-control" type="time" value="" required="true" name="sleeptime">
								</div>

								<div class="form-group">
									<label>Wakeup time:</label>
									<input class="form-control" type="time" value="" required="true" name="waketime">
								</div>
								
																
								<div class="form-group has-success modal-footer">
									<button type="submit" class="btn btn-primary" name="submit">Submit</button>
									<button type="reset" class="btn btn-warning" name="submit">Reset</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								</div>
								
								
								</div>
								
							</form>
        </div>
        
      </div>
    </div>
  

	<?php include_once('includes/footer.php');?>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
	</div>	
</body>
</html>
<?php } ?>