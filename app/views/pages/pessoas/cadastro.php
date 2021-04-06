<?php

use blitz\app\helpers\Format as Format;
use blitz\app\helpers\alerts as alertas;

$this->layout('logged', [
	'title' => isset($pessoa) ? "Pessoa #{$pessoa->id} - Editar" : 'Nova pessoa'
]);
$this->start('conteudo');
alertas::errors($numMs);
?>

<div class="row">
	<div class="col-sm-12 offset-sm-0 col-md-8 offset-md-2">
		<form method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="form-group col-md-2 col-sm-1">
					<label for="id">#id</label>
					<input type="text" class="form-control" id="id" name="id" value="<?= isset($pessoa) ? $pessoa->id : 'Novo' ?>" readonly="true" />
					<input type="hidden" name="id" value="<?= isset($pessoa) ? $pessoa->id : 'Novo' ?>" />
				</div>
				</div>
			<div class="row">
				<div class="form-group col-md-6 col-sm-12">
					<label for="first_name">Nome</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="<?= $pessoa->first_name ?>" required="true" />
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="last_name">Sobrenome</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="<?= $pessoa->last_name ?>" required="true" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12 col-sm-12">
					<label for="email">email</label>
					<input type="email" class="form-control" id="email" name="email" value="<?= $pessoa->email ?>"
					 required="true" />
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-2">
					<button type="submit" class="btn btn-success">Gravar</button>
				</div>
			</div>
		</form>
	</div>
</div>