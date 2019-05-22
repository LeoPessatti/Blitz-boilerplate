<?php

namespace blitz\vendor\core\helpers;

/**
 * Helper for logs.
 *
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Logs extends \blitz\vendor\core\Helpers {
	/*
	 *  Se estiver usando CloudFlare:
	 $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];

	 * Se estiver usando Incapsula:
	 $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_INCAP_CLIENT_IP'];

	 * Se estiver usando o Sucuri:
	 $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
	 */

	public function log($content, $src = 'log.txt') {
		$ip = $_SERVER['REMOTE_ADDR'] == '::1' ? 'localhost' : $_SERVER['REMOTE_ADDR'];
		$value = self::data() . ' - ' . $ip . ' - ' . $content;
		file_put_contents(\blitz\vendor\Bootstrap::$settings['storage_src'] . '/private/' . $src, $value . PHP_EOL, FILE_APPEND);
	}

	/**
	 * Formata números para obedecer o padrão de data escolhido.
	 * O segundo parâmetro é opcional e serve para escolher o tipo de data. Se deixado vazio,
	 * exibirá no padrão brasileiro dia/mes/ano hr:min:seg.
	 *
	 * @param type $data
	 * @param type $formato
	 * @return string
	 */
	public static function data($data = null, $formato = 'd/m/Y H:i:s') {
		if (!empty($data)) {
			$data = new \DateTime($data);
			$data = $data->format($formato);
		} else {
			$data = Date($formato);
		}
		return $data;
	}
}
