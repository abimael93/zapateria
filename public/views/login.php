<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Plantilla</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/mis-estilos.css">
</head>
<body>
	
	<div class="container well" id="sha">

		<div class="row">
				<div class="col-xs-12">
					<img src="img/avatar.png" class="img-responsive" id="avatar">
				</div>
		</div>	
				
		<form class="login" action="check.php" method="POST">
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Correo electronico" name="email" required autofocus>
			</div>

			<div class="form-group">
				<input type="password" class="form-control" placeholder="Contraseña" name="password" required>
			</div>

			<button class="btn btn-primary btn-lag btn-block" type="submit">Iniciar sesión</button>

			<div class="checkbox">

				<label class="checkbox">
					<input type="checkbox" value="1" name="remember">No cerrar sesión
				</label>
				
				<p class="help-block"><a href="#">No puedes acceder a tu cuenta?</a></p>
			</div >
			
		</form>
	</div>

	<script src="js/jquery.js"></script>	
	<script src="js/bootstrap.js"></script>	
</body>
</html>