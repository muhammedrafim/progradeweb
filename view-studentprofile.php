<?php 
require_once('functions.php');
if(!sessionCheck('logged_in'))
{
    header("Location: ./loginpage.php");
    die();
}
include 'db_connect.php';
$userid = $_SESSION['uName'];
$tablename = "user_admin";
//update database
$query = "SELECT * FROM $tablename where id='$userid'";
$result = mysqli_query($conn,$query);
$user =  mysqli_fetch_assoc($result);


 ?>
<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="">
        <title>PROGRADE - Responsive Education Template</title>

        <!-- Styles -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		 <link href="assets/css/chartist.min.css" rel="stylesheet" media="screen">
		<link href="assets/css/owl.carousel.min.css" rel="stylesheet" media="screen">
		<link href="assets/css/owl.theme.default.min.css" rel="stylesheet" media="screen">
        <link href="assets/css/style.css" rel="stylesheet" media="screen">

		<!-- Fonts -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">
 <style>
	 
.profile-details .detail-row {
	padding: 0px 15px 15px;
	border-top: 1px solid #afafaf;
}
.profile-details .detail-row span{
	font-size: 13px;
	color: #81878C;
	margin-top: 15px;
}
.profile-details .detail-row p {
	font-size: 16px;
	font-weight: 600;
	margin-bottom: 15px;
}

.profile-intro img {
	min-width:300px;
	min-height:300px;
	margin : 10px;
}

.dash-item .inner-item  img{
	border-radius: 15%;
}
</style>
    </head>
    <body>
		<div class="row dashboard-top-nav">
			<div class="col-sm-3 logo">
				<h5><i class="fa fa-book"></i>PROGRADE</h5>
			</div>
			<div class="col-sm-4 top-search">
				<div class="search">
					<i class="fa fa-search"></i>
					<input type="text" placeholder="Search">
				</div>
			</div>
			<div class="col-sm-5 notification-area">
				<ul class="top-nav-list">
					<li class="notification dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="badge nav-badge">3</span>
						</a>
						<ul class="dropdown-menu notification-list">
						
						<?php $q = "select * from notification order by date desc limit 3";
							$r=mysqli_query($conn,$q);
							while($noti = mysqli_fetch_assoc($r))
							{
								?>
							<li>							
								<div class="list-msg">
									<div class="col-xs-2 icon clear-padding">
									<i class="fa fa-bell-o"></i>
									</div>
									<div class="col-sm-10 desc">
										<h5><a href="view-notifications.php?id=<?php echo $noti['id'] ?>"><?php echo $noti['title'] ?></a> </h5>
										<h6><i class="fa fa-clock-o"></i>posted on :<?php echo date("h:i a,d-M", substr($noti['date'], 0, 10)); ?></h6>
									</div>
									<div class="clearfix"></div>
								</div>
							</li>
							<?php } ?>
							<li>
								<div class="all-notifications">
									<a href="admin-add-notifications.php">VIEW ALL NOTIFICATIONS</a>
								</div>
							</li>
						</ul>
					</li>
					<li class="user dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span><img src="<?php echo $user['photourl'] ?>" alt="user"><?php echo $user['name'] ?></span>
						</a>
					</li>
					
					<li>
								<div class="all-notifications">
								<a href="logout.php"><i class="fa fa-sign-out"></i>LOGOUT</a>
								</div>
							</li>
				</ul>
			</div>
		</div>
        	
		<div class="parent-wrapper" id="outer-wrapper">
			<!-- SIDE MENU -->
			<div class="sidebar-nav-wrapper" id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li>
						<a href="index.php"><i class="fa fa-home menu-icon"></i> HOME</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users menu-icon"></i> STUDENTS <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>							
								<a href="admin-add-student.php"><i class="fa fa-caret-right"></i>ADD</a>
							</li>
							<li>
								<a href="admin-student-list.php"><i class="fa fa-caret-right"></i>ALL STUDENT  </a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</li>
					
					<li>
						<a href="admin-add-notifications.php"><i class="fa fa-bullhorn menu-icon"></i> NOTIFICATIONS</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-book menu-icon"></i> LIBRARY <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>							
								<a href="admin-add-books.php"><i class="fa fa-caret-right"></i>ADD BOOKS</a>
							</li>
							<li>
								<a href="admin-view-books.php"><i class="fa fa-caret-right"></i>VIEW BOOKS</a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-book menu-icon"></i> FEES PENDING<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>							
								<a href="view-fees-pending.php?term=all"><i class="fa fa-caret-right"></i>ALL TERMS</a>
							</li>
							<li>
								<a href="view-fees-pending.php?term=f1"><i class="fa fa-caret-right"></i>TERM 1</a>
							</li>
							
							<li>
								<a href="view-fees-pending.php?term=f2"><i class="fa fa-caret-right"></i>TERM 2</a>
							</li>
							
							<li>
								<a href="view-fees-pending.php?term=f3"><i class="fa fa-caret-right"></i>TERM 3</a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</li>

                    <li>
                        <a href="admin-add-study-material.php"><i class="fa fa-book menu-icon"></i>ADD STUDY MATERIAL</a>
                    </li>
				</ul>
			</div>
			
			<!-- MAIN CONTENT -->
			<div class="main-content" id="content-wrapper">
				<div class="container-fluid">
			<!--<div class="row">
						<div class="col-sm-4 dash-item">
							<div class="col-xs-12">
								<div class="user-details">
									<div class="user-img">
										<img src="assets/img/parent/parent2.jpg" alt="user" />
									</div>
								</div>
							</div>
						</div>
					</div>-->
					<?php $id=$_GET['id'];
											
						$tablename = "user_student";
						//update database
						$query = "SELECT * FROM $tablename where id='$id'";
						$res = mysqli_query($conn,$query);
						$student =  mysqli_fetch_assoc($res);
						  ?>
					<div class="row">
						<div class="col-lg-12 clear-padding-xs">
							<div class="col-sm-12 col-md-8">
								<div class="my-msg dash-item">
									<h6 class="item-title"><i class="fa fa-user"></i>STUDENT PROFILE</h6>
									<div class="inner-item">
										<div class="profile-intro">
											<div class=" col-sm-12 col-md-5  clear-padding">
												<img src="<?php echo $student['photourl'] ?>"  alt="user" />
											</div>
											<div class="col-sm-12 col-md-6">
													<div class="profile-details">
														<div class="detail-row">
														
														<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
																<span>NAME</span>
																<p><?php echo $student['name'] ?></p>
															</div>
														</div>
														
														<div class="clearfix"></div>
														<div class="detail-row">
															
															<div class="clearfix"></div>
															<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
																<span>ID #</span>
																<p><?php echo $student['id'] ?></p>
															</div>
														</div>
														<div class="clearfix"></div>
														<div class="detail-row">
															
															<div class="col-md-6 col-sm-12 col-xs-12 clear-padding">
																<span>CLASS</span>
																<p><?php echo $student['class'] ?></p>
															</div>
																
															<div class="col-md-6 col-sm-12 col-xs-12 clear-padding">
																<span>BATCH</span> 
																<p><?php echo $student['batch'] ?></p>
															</div>
														</div>
														
														<div class="clearfix"></div>
														<div class="detail-row">
															
															<div class="clearfix"></div>
															<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
																<span style='display:block;'>FEES DETAILS</span>
																<p style='display:inline;'>FIRST TERM : <?php if($student['f1'] != 'true' ){
																	echo "<p style='color:red; display:inline'>Not paid</p>";
																} else { echo "<p style='color:green;margin:3px; display:inline'>Paid </p>"; }  ?> </p>
																<p style='display:inline;'>SECOND TERM: <?php if($student['f2'] != 'true' ){
																	echo "<p style='color:red; display:inline'>Not paid</p>";
																} else { echo "<p style='color:green;margin:3px; display:inline'>Paid </p>"; }  ?> </p> 
																<p style='display:inline;'>THIRD TERM: <?php if($student['f3'] != 'true' ){
																	echo "<p style='color:red; display:inline'>Not paid</p>";
																} else { echo "<p style='color:green;margin:3px; display:inline'>Paid </p>"; }  ?></p>
															</div>
														</div>
														
														<div class="clearfix"></div>
														<div class="detail-row">	
															<div class="clearfix"></div>
															<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
																<span>PARENT EMAIL</span>
																<p><?php echo $student['parentemail'] ?></p>
															</div>
														</div>
													</div>
												</div>
												
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							
								<div class="col-md-4">
								<div>
									<div class="my-msg dash-item">
										<h6 class="item-title"><i class="fa fa-bar-chart"></i>STUDENT MARKS</h6>
										<div class="chart-item">
											<?php			
											$q = "select * from gradecard";
											$grade = mysqli_query($conn,$q);
											while($xamid = mysqli_fetch_assoc($grade))
											{
												
											$columnname = "exam_".$xamid["id"];
												$userid = $_GET["id"];
												$tablename = "gradecard_data";
												$query = "SELECT $columnname FROM $tablename WHERE id='$userid' ";
												$result = mysqli_query($conn,$query);
												$gradeca = mysqli_fetch_assoc($result);
												?>				<div style="word-wrap:break-word">
																<span>EXAM : <?php echo $xamid["exam"] ?> </span>
																<p><strong> <?php echo clean($gradeca[$columnname]) ?> </strong></p>
																<hr style="color:#e8d6cf;border:1px solid;">
											</div>
													
											<?php } ?>
											<div class="chart-legends">
											<!--	<span class="red"><60%</span>
												<span class="orange"><75%</span>
												<span class="green">>75%</span> -->
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="menu-togggle-btn">
					<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
				</div>
				<div class="dash-footer col-lg-12">
					<p>Copyright Prograde</p>
				</div>
			</div>
		</div>
	
		<!-- Scripts -->
        <script src="assets/js/jQuery_v3_2_0.min.js"></script>
		<script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/plugins/owl.carousel.min.js"></script>
		<script src="assets/plugins/Chart.min.js"></script>
		<script src="assets/plugins/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/dataTables.responsive.min.js"></script>
        <script src="assets/js/js.js"></script>
		
    </body>
</html>