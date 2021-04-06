<?php
use \blitz\vendor\core\helpers\Url as Url;

$this->layout('logged', [
	'title' => 'Pessoas'
]);
use blitz\app\helpers\Format as Format;
use blitz\app\helpers\Alerts as alertas;

$this->start('conteudo');
?>
<div class="row">
	<div class="col-sm-12 offset-sm-0 col-md-8 offset-md-2">
		<?= alertas::botoesTable('Novo Usuário', 'u/usuarios/cadastro', $numMs); ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#id</th>
					<th>Login</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Hierarquia</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($usuarios as $row) {
						$role = $row->hierarchy <= 1 ? 'Admin' : 'Colaborador';
						echo '<tr>';
						echo " <td>#{$row->userid}</td>";
						echo " <td>{$row->login}</td>";
						echo '<td><a href="' . Url::to('u/pessoa/cadastro?id=') . $row->id . '">' . $row->first_name . ' ' . $row->last_name . '</a></td>';
						echo " <td>{$row->email}</td>";
						echo " <td>{$role}</td>";
						echo alertas::botoesRow($row->userid, 'u/usuarios/cadastro', 'u/usuarios/remover');
						echo '</tr>';
					}

				?>

			</tbody>

		</table>
	</div>
</div>
