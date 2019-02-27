<?php
		if (isset($_GET['status'])) {
        $sta = $_GET['status'];
        echo "<script type='text/javascript'>alert('$sta');</script>";
		}
?>
<div class="header-menu">

	<div class="col-sm-7">
		<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
		<div class="header-left">
			<!--<button class="search-trigger"><i class="fa fa-search"></i></button>-->
			<div class="form-inline">
				<form class="search-form">
					<input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
					<button class="search-close" type="submit"><i class="fa fa-close"></i></button>
				</form>
			</div>

			<div class="dropdown for-notification">
			  <!--<button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-bell"></i>
				<span class="count bg-danger"> 0</span>     
			  </button>-->
			 <!-- <div class="dropdown-menu" aria-labelledby="notification">
				<p class="red">You have 3 Notifications</p>
				<a class="dropdown-item media bg-flat-color-1" href="#">
					<i class="fa fa-check"></i>
					<p>Not1</p>
				</a>
				<a class="dropdown-item media bg-flat-color-4" href="#">
					<i class="fa fa-info"></i>
					<p>NOT2</p>
				</a>
				<a class="dropdown-item media bg-flat-color-5" href="#">
					<i class="fa fa-warning"></i>
					<p>Not3</p>
				</a>
			  </div>-->
			</div>

			<div class="dropdown for-message">
			 <!-- <button class="btn btn-secondary dropdown-toggle" type="button"
					id="message"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="ti-email"></i>
				<span class="count bg-primary">0</span>
			  </button>-->
			  <!--<div class="dropdown-menu" aria-labelledby="message">
				<p class="red">You have 4 Mails</p>
				<a class="dropdown-item media bg-flat-color-1" href="#">
					<span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
					<span class="message media-body">
						<span class="name float-left">Sam Sawant</span>
						<span class="time float-right">Just now</span>
							<p>Hello, this is me</p>
					</span>
				</a>
				<a class="dropdown-item media bg-flat-color-4" href="#">
					<span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
					<span class="message media-body">
						<span class="name float-left">Hardik Kharpude</span>
						<span class="time float-right">5 minutes ago</span>
							<p>Lol XD</p>
					</span>
				</a>
				<a class="dropdown-item media bg-flat-color-5" href="#">
					<span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
					<span class="message media-body">
						<span class="name float-left">Chiranjeev Jena</span>
						<span class="time float-right">10 minutes ago</span>
							<p>Hello</p>
					</span>
				</a>
				<a class="dropdown-item media bg-flat-color-3" href="#">
					<span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
					<span class="message media-body">
						<span class="name float-left">Aditya Chaurasiya</span>
						<span class="time float-right">15 minutes ago</span>
							<p>Hi Bhai</p>
					</span>
				</a>
			  </div>-->
			</div>
		</div>
	</div>

	<div class="col-sm-5">
		<div class="user-area dropdown float-right">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="user-avatar rounded-circle" src="images/ABC.png" alt="User Avatar">
			</a>

			<div class="user-menu dropdown-menu">
				   <a class="nav-link" href="update_traffic_profile.php"><i class="fa fa- user"></i>My Profile</a>

						<!--<a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">0</span></a> 

					<a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>-->

					<a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Log out</a>
			</div>
		</div>            
	</div>
</div>	