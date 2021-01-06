<!DOCTYPE html>

<html>

<head>
	<title><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{url}/app/views/assets/style.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</script>
</head>
<script src="{url}/app/views/assets/js/scripts.js"></script>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?= \blitz\vendor\Bootstrap::$settings['app']['url'] ?>"><?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	<div class="navbar-nav">
		<a class="nav-item nav-link active" href="{url}/home">Home<span class="sr-only">(current)</span></a>
		<a class="nav-item nav-link" href="{url}/posts">Posts</a>
		<a class="nav-item nav-link" href="{url}/admin/posts">Go to admin</a>
	</div>
  </div>
</nav>
<br>
	<?= $this->section('content') ?>
	<script src="{url}/app/views/assets/js/scripts.js"></script>
</body>

</html>