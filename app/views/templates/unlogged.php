<!DOCTYPE html>

<html>

<head>
	<title><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="{url}/app/views/assets/style.min.css" /> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script src="{url}/app/views/assets/js/scripts.js"></script> -->

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLoginScreen" aria-controls="navbarLoginScreen" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="<?= \blitz\vendor\Bootstrap::$settings['app']['url'] ?>"><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></a>
		<button class="d-flex btn btn-outline-primary">
			<a aria-current="page" href="{url}/cadastro">Sign Up</a>
		</button>
	</div>
</nav>

<br>
	<?= $this->section('content') ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{url}/app/views/assets/js/scripts.js"></script>
</body>

</html>