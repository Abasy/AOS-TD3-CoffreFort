<?php
require_once('../PageWeb/header.php');
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">Se connecter</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Connectez<span> Vous</span></h3>
			
		</div>
		<div class="widget-shadow">
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form action="../PageWeb/signin.php" method="get">
					<input type="text" class="user" name="username" value="nabasy" placeholder="Username" required="">
					<input type="password" class="lock" name="user_password" value="test" placeholder="Mot de passe">
					<input type="submit" name="login" value="Se connecter">
					<!--
					<div class="forgot-grid">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</label>
						<div class="forgot">
							<a href="#">Forgot Password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>-->
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
	<div>
		<?php
			if(isset($_GET['login'])){
				$crl = curl_init("http://localhost:4321/api/auth?username=".$_GET['username']."&password=".$_GET['user_password']);
				curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($crl, CURLINFO_HEADER_OUT, true);
				$result = curl_exec($crl);
				echo $result;
				print_r($result);
			}
		?>
	</div>
<?php
require_once('../PageWeb/footer.php');
?>
