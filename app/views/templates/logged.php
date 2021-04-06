<!DOCTYPE html>

<html>
<head>
	<title><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{url}/app/views/assets/style.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</script>
</head>
<script src="{url}/app/views/assets/js/scripts.js"></script>

<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= \blitz\vendor\Bootstrap::$settings['app']['url'] ?>/u/home"><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="{url}/u/home">Home</a>
				</li>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pessoas</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="{url}/u/pessoa">Lista de Pessoas</a></li>
					<li><a class="dropdown-item" href="{url}/u/pessoa/cadastro">Nova Pessoa</a></li>
				</ul>
				</li>
				<?php
				/**
				 * ORGANIZATION ADMIN AREA
				 */
					if ($_SESSION['user']->hierarchy <= 1) {
						?>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuários</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="{url}/u/usuarios">Lista de Usuários</a></li>
					<li><a class="dropdown-item" href="{url}/u/usuarios/cadastro">Novo Usuário</a></li>
				</ul>
				</li>
				<?php
					}
				?>
			</ul>
			<button class="d-flex btn btn-outline-primary">
				<a aria-current="page" href="{url}/logoff">logoff</a>
			</button>
			</div>
		</div>
	</nav>

<br>
	<?= $this->section('content') ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{url}/app/views/assets/js/scripts.js"></script>
</body>

</html>