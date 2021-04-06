<?php

/*
 * This file is part of the Blitz package.
 *
 * (c) 2016 Fernando Batels
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace blitz\app\helpers;

use \blitz\vendor\core\helpers\Url as Url;

/**
 * Helper contendo formatações.
 *
 * @author Fernando Batels <luisfbatels@gmail.com>
 */
class alerts extends \blitz\vendor\core\Helpers {
	/**
	 * Gera o html do topo de uma tela para apresnetação das mensagens padrões de erro/sucesso
	 */
	public static function errors($numMs = 0) {
		if ($numMs > 0) {
			$r = '';
			$r .= '<div class="alert alert-' . ($numMs == 3 ? 'danger' : 'success') . '" role="alert">';
			$r .= '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			$r .= '   <span aria-hidden="true">&times;</span>';
			$r .= '  </button>';

			if ($numMs == 1) {
				$r .= '  <h4>Gravação realizada com sucesso</h4>';
			} elseif ($numMs == 2) {
				$r .= '  <h4>Exclusão realizada com sucesso</h4>';
			} else {
				$r .= '  <h4>Não foi possível realizar a operação</h4>';
			}

			return $r . '</div>';
		}

		return '';
	}

	/**
	 * Gera o html do topo de uma lista do CRUD padrão da aplicação
	 */
	public static function botoesTable($novoTitle, $novoUrl, $numMs = 0) {
		$r = self::errors($numMs);

		$r .= '<a class="btn btn-sm btn-info" href="' . Url::to($novoUrl) . '">' . $novoTitle . '</a>';
		$r .= '<br/>';
		$r .= '<br/>';

		return $r;
	}

	/**
	 * Gera o html dos botões de ações da lista do CRUD
	 */
	public static function botoesRow($id, $urlEditar, $urlExcluir) {
		if ($urlEditar != null) {
			return '<td>
                        <a class="btn btn-xs btn-success" href="' . Url::to($urlEditar, is_array($id) ? $id : ['id' => $id]) . '">Editar</a>
                        <a class="deletebtn btn btn-xs btn-danger" href="' . Url::to($urlExcluir, is_array($id) ? $id : ['id' => $id]) . '">Excluir</a>
                    </td>';
		} else {
			return '<td>
                        <a class="deletebtn btn btn-xs btn-danger" href="' . Url::to($urlExcluir, is_array($id) ? $id : ['id' => $id]) . '">Excluir</a>
                    </td>';
		}
	}
}
