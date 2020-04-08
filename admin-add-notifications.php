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
		<link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
		<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet" media="screen">
        <link href="assets/css/style.css" rel="stylesheet" media="screen">

		<!-- Fonts -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">
		<style>
			
			.admin-submit{
				color: #fff;
				background: #27AE60;
				display: inline-block;
				font-size: 13px;
				font-weight: 700;
				margin-top: 25px;
				padding: 10px 50px;
				text-decoration: none;
				border: 1px solid transparent;
				
			}
			.admin-submit:hover {
				color: #27AE60;
				background: transparent;
				border: 1px solid #27AE60;
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
					<div class="row">
						<div class="col-lg-12 clear-padding-xs">
							<h5 class="page-title"><i class="fa fa-bullhorn"></i>ALL NOTIFICATIONS</h5>
							<div class="section-divider"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 clear-padding-xs">
							<div class="col-sm-4">
								<div class="dash-item first-dash-item">
									<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD NOTIFICATIONS</h6>
									<div class="inner-item">
									<form action="admin_insert_notifications.php" method="post" enctype="multipart/form-data"> 
										<div class="dash-form">
											<label class="clear-top-margin"><i class="fa fa-cogs"></i>TITLE</label>
											<input type="text" name="title" placeholder="title">
											<label><i class="fa fa-info-circle"></i>CONTENT</label>
											<textarea placeholder="Enter Description Here" name="content"></textarea>
											<label><i class="fa fa-photo"></i>PHOTO</label>
											<input type="file" name="photourl">
											
										<div class="clearfix"></div>
											<div>
												<input type="submit" value="CREATE" class="admin-submit">
												<input type="hidden" value="<?php echo $user['name']?>" name="added_by">
											</div>
										</div>
										</form>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="dash-item first-dash-item">
									<h6 class="item-title"><i class="fa fa-bullhorn"></i>ALL NOTIFICATIONS</h6>
									<div class="inner-item">
										<table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th><i class="fa fa-cogs"></i>TITLE</th>
													<th><i class="fa fa-user-secret"></i>AUTHOR</th>
													<th><i class="fa fa-user"></i>DATE</th>
													
													<th><i class="fa fa-plus"></i>MORE</th>
													<th><i class="fa fa-sliders"></i>ACTION</th>
												</tr>
											</thead>
											<tbody>
											<?php 												
												$qu = "SELECT * FROM notification ";
												$res = mysqli_query($conn,$qu);
												
											while($val =  mysqli_fetch_assoc($res))
											{  ?>
												
												<tr>
													<td><?php echo $val['title'] ?></td>
													<td><?php echo $val['author'] ?></td>
													<td><?php echo date("h:i a,d-M-Y", substr($val['date'], 0, 10)); ?></td>
													<td><a href="view-notifications.php?id=<?php echo $val['id'] ?>">View more</a></td>
													<td class="action-link">
														<a class="delete" href="#" title="Delete" onclick="deletenoti('<?php echo $val['id'] ?>')" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
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
				
				<!-- Delete Modal -->
				<div id="deleteDetailModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-trash"></i>DELETE NOTIFICATIONS</h4>
							</div>
							<div class="modal-body">
							<form method='post' action='admin-delete-notifications.php'>
								<div class="table-action-box">
												<input type="submit" value='YES' class="admin-submit">
												<input type='hidden' name='id' id='deletenotifi'>
									<a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
								</div>
							</form>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				
				<!--Edit details modal-->
				
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
		<script type='text/javascript'>
		function deletenoti(id){
			document.getElementById("deletenotifi").value=id;
		}
		</script>
    </body>
</html>