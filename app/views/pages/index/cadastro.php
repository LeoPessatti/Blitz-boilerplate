<?php $this->layout('unlogged');?>

<div class="row">
	<div class="col-md-10 offset-md-1 text-center">
			<?php if ($showErroLogin->email) : ?>
				<div class="alert alert-danger" role="alert">
					<b>Ops, email já em uso.</b><br/>
					Tente novamete.
				</div>
			<?php endif; ?>
			<?php if ($showErroLogin->cnpj) : ?>
				<div class="alert alert-danger" role="alert">
					<b>Ops, CNPJ já em uso.</b><br/>
					Tente novamete.
				</div>
			<?php endif; ?>
			<?php if ($showErroLogin == 'db') : ?>
				<div class="alert alert-danger" role="alert">
					<b>Ops, caracteres proibidos.</b><br/>
					Tente novamete.
				</div>
			<?php endif; ?>


	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Cadastro</h5>
			<form id="Login" method="POST">
				<div class="row">
					<div class="col-lg-6 col-sm-12">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email">
					</div>
					<div class="col-lg-6 col-sm-12">
						<label for="pwd" class="form-label">Senha</label>
						<input type="password" class="form-control" id="pwd" name="pwd">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-12">
						<label for="nome" class="form-label">Nome</label>
						<input type="text" class="form-control" id="nome" name="nome">
					</div>
					<div class="col-lg-6 col-sm-12">
						<label for="sobrenome" class="form-label">Sobrenome</label>
						<input type="text" class="form-control" id="sobrenome" name="sobrenome">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-12">
						<label for="empresa" class="form-label">Organização</label>
						<input type="text" class="form-control" id="empresa" name="empresa">
					</div>
					<div class="col-lg-6 col-sm-12">
						<label for="cnpj" class="form-label">CNPJ</label>
						<input type="text" class="form-control" id="cnpj" name="cnpj">
					</div>
				</div>
				<br>
				<button type="submit" class="btn btn-primary card-link">Criar Cadastro!</button>
			</form>
		</div>
	</div>


		</div>
	</div>
</div>