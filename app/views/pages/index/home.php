<?php $this->layout('logged');?>

<div class="row justify-content-md-center">
	<div class="card col-md-4 col-sm-12">
		<div class="card-body text-center">
			<h3 class="card-title">Bem-Vindo ao <?= \blitz\vendor\Bootstrap::$settings['app']['name'] ?>, <?= $user->first_name?>!</h3>
		</div>
	</div>
</div>
