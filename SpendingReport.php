<!--/Retreve expence info from db and display it-->
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['newsession']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Spending Tracker</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	

</head>
<body>
	
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Spending Tracker</h1>
			</div>
		</div>
		
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Expenses from Today
$userid=$_SESSION['newsession'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(Spent)  as today from tblexpense where (Date)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_spent=$result['today'];
 ?> 

						<h4>Today</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_today_spent;?>" >
						<span class="percent">
<?php if($sum_today_spent==""){
	echo "N/A";
} 
else {
	echo $sum_today_spent;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Expenses from yesterday
$userid=$_SESSION['newsession'];
$ydate=date('Y-m-d',strtotime("-1 days"));
$query1=mysqli_query($con,"select sum(Spent)  as yesterday from tblexpense where (Date)='$ydate' && (UserId='$userid');");
$result1=mysqli_fetch_array($query1);
$sum_yesterday_spent=$result1['yesterday'];
 ?> 
					<div class="panel-body easypiechart-panel">
						<h4>Yesterday</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_spent;?>" >
						<span class="percent">
<?php if($sum_yesterday_spent==""){
	echo "N/A";
}
else {
	echo $sum_yesterday_spent;
}
?>
	


	</span>
		</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Weekly
$userid=$_SESSION['newsession'];
 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
$crrntdte=date("Y-m-d");
$query2=mysqli_query($con,"select sum(Spent)  as weekly from tblexpense where ((Date) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
$result2=mysqli_fetch_array($query2);
$sum_weekly_spent=$result2['weekly'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last Week</h4>
						<div class="easypiechart" id="easypiechart-yellow" data-percent="<?php echo $sum_weekly_spent;?>">
						<span class="percent">
<?php if($sum_weekly_spent==""){
	echo "N/A";
} 
else {
	echo $sum_weekly_spent;
}?>


	</span>
		</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly
$userid=$_SESSION['newsession'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(Spent)  as monthly from tblexpense where ((Date) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_spent=$result3['monthly'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30 Days</h4>
						<div class="easypiechart" id="easypiechart-green" data-percent="<?php echo $sum_monthly_spent;?>" >
						<span class="percent">	
<?php if($sum_monthly_spent==""){
	echo "N/A";
} else {
	echo $sum_monthly_spent;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		</div>
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly
$userid=$_SESSION['newsession'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(Spent)  as yearly from tblexpense where (year(Date)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_spent=$result4['yearly'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>This Year</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_yearly_spent;?>">
						<span class="percent">
							
<?php if($sum_yearly_spent==""){
	echo "N/A";
} 
else {
	echo $sum_yearly_spent;
}
?>


	</span>
		</div>

					</div>
				
				</div>

			</div>

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Expense
$userid=$_SESSION['newsession'];
$query5=mysqli_query($con,"select sum(Spent)  as total from tblexpense where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_spent=$result5['total'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total</h4>
						<div class="easypiechart" id="easypiechart-purple" data-percent="<?php echo $sum_total_spent;?>">
						<span class="percent">
<?php if($sum_total_spent==""){
	echo "N/A";
} 
else {
	echo $sum_total_spent;
}
?>

	</span>
		</div>

					</div>
				
				</div>

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
</body>
</html>
<?php } ?>
