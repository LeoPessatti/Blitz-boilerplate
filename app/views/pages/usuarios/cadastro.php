<?php

use blitz\app\helpers\Format as Format;
use blitz\app\helpers\alerts as alertas;

$this->layout('logged', [
	'title' => isset($usuario) ? "usuario #{$usuario->id} - Editar" : 'Nova usuario'
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
					<input type="text" class="form-control" id="id" name="id" value="<?= isset($usuario) ? $usuario->userid : 'Novo' ?>" readonly="true" />
					<input type="hidden" name="id" value="<?= isset($usuario) ? $usuario->userid : 'Novo' ?>" />
				</div>
				</div>
			<div class="row">
				<div class="form-group col-md-6 col-sm-12">
					<label for="first_name">Login</label>
					<input type="text" class="form-control" id="login" name="login" value="<?= $usuario->login ?>" required="true" />
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for="last_name">Senha</label>
					<input type="password" class="form-control" id="pwd" name="pwd" <?= empty($usuario->pwd) ? 'required="true"' : '' ?>" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12 col-sm-12">
					<label for="email">Hierarquia</label>
					<select class="form-select" aria-label="Escolha o tipo de Usuário" id="hierarquia" name="hierarquia">
						<option value="1" <?=$usuario->hierarchy <= 1 ? 'selected' : '' ?>>Administrador</option>
						<option value="2" <?=$usuario->hierarchy == 2 ? 'selected' : '' ?>>Colaborador</option>
					</select>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label for="email">Responsável pela conta</label>
					<select class="form-select" aria-label="Escolha o responsável" id="pessoa" name="pessoa">
						<?php
							foreach ($pessoas as $key => $pessoa) {
								echo '<option value="' . $pessoa->id . '" ';
								if ($pessoa->id == $usuario->pessoa_id) {
									echo 'selected';
								}

								echo '>' . $pessoa->first_name . ' ' . $pessoa->last_name . '</option>';
							}
						?>
					</select>
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