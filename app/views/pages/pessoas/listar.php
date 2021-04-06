<?php

/**
 * LISTAGEM DE PESSOAS
 */

$this->layout('logged', [
	'title' => 'Pessoas'
]);

use blitz\app\helpers\Format as Format;
use blitz\app\helpers\Alerts as alertas;

$this->start('conteudo');
?>
<div class="row">
	<div class="col-sm-12 offset-sm-0 col-md-8 offset-md-2">
		<?= alertas::botoesTable('Nova Pessoa', 'u/pessoa/cadastro', $numMs); ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#id</th>
					<th>Nome</th>
					<th>Email</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($pessoas as $row) {
						echo '<tr>';
						echo " <td>#{$row->id}</td>";
						echo " <td>{$row->first_name} {$row->last_name}</td>";
						// echo ' <td>' . Format::data($row->nascimento, 'd/m/Y') . '</td>';
						echo " <td>{$row->email}</td>";

						echo alertas::botoesRow($row->id, 'u/pessoa/cadastro', 'u/pessoa/remover');
						echo '</tr>';
					}

				?>

			</tbody>

		</table>
	</div>
</div>