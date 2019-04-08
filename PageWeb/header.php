<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Accueil</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
        <style>
		    /* Remove the navbar's default margin-bottom and rounded borders */ 
		    .navbar {
		      margin-bottom: 0;
		      border-radius: 0;
		      background-color:  #555;
		      color: white;
		    }
		    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		    .row.content {
		        overflow:auto; width:100%;
		    }
		    /* Set gray background color and 100% height */
		    .sidenav {
		      padding-top: 20px;
		      background-color: #f1f1f1;
		      height: 100%;
		      overflow:auto;
		    }
		    /* Set black background color, white text and some padding */
		    footer {
		    	position: fixed;
		      	bottom: 0;
    			background-color:  #555;
		      	color: white;
		      	padding: 15px;
		      	width: 100%;
		    }
		    /* On small screens, set height to 'auto' for sidenav and grid */
		    @media screen and (max-width: 767px) {
		      .sidenav {
		        height: auto;
		        padding: 15px;
		      }
		      .row.content {height:auto;} 
		    }
		  </style>
     </head>
<body>
	<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		        <a class="navbar-brand" href="index.php"><img src="images/logo_ensibs.png" height="30px" width="100" /></a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		    	<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Accueil</a></li>
				</ul>
		    	<?php if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
							echo '<ul class="nav navbar-nav">
								<li class="active"><a href="../PageWeb/accountUser.php">Mon Compte ['.$_SESSION['username'].']</a></li>
		      				</ul>
						    <ul class="nav navbar-nav navbar-right">
						        <li><a href="../PageWeb/signout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
						    </ul>';
					}else{
							echo '<ul class="nav navbar-nav">
		        					<li class="active"><a href="../PageWeb/register.php">s\'inscrire</a></li>
		      					</ul>
						    <ul class="nav navbar-nav navbar-right">
						        <li><a href="../PageWeb/signin.php"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
						    </ul>';
					}?>
		    </div>
		  </div>
	</nav>