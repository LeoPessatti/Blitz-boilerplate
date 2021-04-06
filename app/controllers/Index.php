<?php

namespace blitz\app\controllers;

class Index extends \blitz\vendor\core\Controller {
	public function actionIndex() {
		$this->log('Mais um acesso bem sucedido ʘ‿ʘ', 'views.txt');
		$this->outputPage('index::home', ['user' => $this->sessionGet('user')]);
	}
}
