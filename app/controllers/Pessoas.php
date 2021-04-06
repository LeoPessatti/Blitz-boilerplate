<?php

namespace blitz\app\controllers;

\blitz\vendor\core\Model::import('Conta');
use \blitz\app\models\Conta as Conta;

\blitz\vendor\core\Model::import('Pessoa');
use \blitz\app\models\Pessoa as Pessoa;

/**
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Pessoas extends \blitz\vendor\core\Controller {
	// Show the home page.
	public function actionIndex() {
		$pessoa = new Pessoa();
		$pessoa->empresa_id = $this->sessionGet('user')->empresa_id;

		$this->outputPage('pessoas::listar', [
			'pessoas' => $pessoa->getPessoas()
		]);
	}

	public function actionWrite() {
		$this->inputStart($_POST);
		$this->inputAddValidation([
			'id' => 'required|alpha_numeric|min_len,1',
			'first_name' => 'required|alpha_numeric|min_len,1',
			'last_name' => 'required|alpha_numeric|min_len,1',
			'email' => 'required|valid_email|min_len,1',
		]);
		$data = $this->getInputData();

		if (empty($data)) {
			$this->redirect('u/pessoa');
		} else {
			$pessoa = new Pessoa();
			$data['id'] == 'Novo' ? $pessoa->id = null : $pessoa->id = $data['id'];
			$pessoa->first_name = $data['first_name'];
			$pessoa->last_name = $data['last_name'];
			$pessoa->email = $data['email'];
			$pessoa->empresa_id = $this->sessionGet('user')->empresa_id;
			$pessoa->save();

			$this->redirect('u/pessoa');
		}
	}

	public function actionNew() {
		$this->inputStart($_GET);
		$this->inputAddValidation([
			'id' => 'required|integer|min_len,1'
		]);
		$data = $this->getInputData();

		if (empty($data)) {
			$this->outputPage('pessoas::cadastro');
		} else {
			$pessoa = new Pessoa();
			$pessoa->id = $data['id'];
			$pessoa->empresa_id = $this->sessionGet('user')->empresa_id;
			$dados = $pessoa->getPersonalData();

			$this->outputPage('pessoas::cadastro', [
				'pessoa' => $dados
			]);
		}
	}

	public function actionDelete() {
		$this->inputStart($_GET);
		$this->inputAddValidation([
			'id' => 'required|integer|min_len,1'
		]);
		$data = $this->getInputData();

		if (empty($data)) {
			$this->redirect('u/pessoa');
		} else {
			$pessoa = new Pessoa();
			$pessoa->id = $data['id'];
			$pessoa->empresa_id = $this->sessionGet('user')->empresa_id;
			$pessoa->delete();

			$this->redirect('u/pessoa');
		}
	}
}
