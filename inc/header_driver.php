<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

	<link type="text/css" rel="stylesheet" href="sponsorcomp.css">
	<title>Driving App</title>
</head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Driving Web App</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active"><a class="nav-link" href="sponsorlist.php">Sponsor List</a></li>
          <li class="nav-item active"><a class="nav-link" href="drivercomp.php">Join Sponsor</a></li>
          <li class="nav-item active"><a class="nav-link" href="driversettings.php">Manage Profile</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <ul class="navbar-nav mr-auto">
		  <?php
		  if($user->is_logged_in()){
			  $email_address = $user->email;
			  echo "
          <li class='nav-item active'>
            <a class='nav-link' href='#'>Hello $email_address!</a>
          </li>
	  <li class='nav-item active'>
            <a class='nav-link' href='checkout.php'>View Cart</a>
          </li>
	  <li class='nav-item active'>
            <a class='nav-link' href='logout.php'>Logout</a>
          </li>
		  ";
		  }
		  else
		  {
			  echo "<li class='nav-item active'>
            <a class='nav-link' href='/login.php'>Login</a>
          </li>";
		  }
		?>
        </ul>
        </form>
      </div>
    </nav>
<br><br><br><br>
</body>
