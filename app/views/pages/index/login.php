<?php $this->layout('unlogged');?>

<div class="row">
	<div class="col-md-6 offset-md-3 text-center">
			<?php if ($showErroLogin == 'credentials') : ?>
				<div class="alert alert-danger" role="alert">
					<b>Ops, credenciais inválidas.</b><br/>
					Tente novamete.
				</div>
			<?php endif; ?>


	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Login</h5>
			<!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
			<form id="Login" method="POST">
				<div class="mb-3">
					<label for="login" class="form-label">Login</label>
					<input type="email" class="form-control" id="login" name="login">
				</div>
				<div class="mb-3">
					<label for="pwd" class="form-label">Password</label>
					<input type="password" class="form-control" id="pwd" name="pwd">
				</div>
				<button type="submit" class="btn btn-primary card-link">Sign in</button>
			</form>
			<a href="{url}/cadastro" class="card-link">Sign Up</a>
			<!-- <a href="#" class="card-link">Another link</a> -->
		</div>
	</div>


		</div>
	</div>
</div>