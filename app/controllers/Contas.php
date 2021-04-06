<?php

namespace blitz\app\controllers;

\blitz\vendor\core\Model::import('Conta');
use \blitz\app\models\Conta as Conta;

\blitz\vendor\core\Model::import('Pessoa');
use \blitz\app\models\Pessoa as Pessoa;

/**
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Contas extends \blitz\vendor\core\Controller
{
	// Show the login page.
	public function actionloginPage() {
		$this->outputPage('index::login', [
		]);
	}

	// Show the signup page.
	public function actionCadastroPage() {
		$this->outputPage('index::cadastro', [
		]);
	}

	// Performs the login
	public function login($login) {
		$this->sessionSet('user', $login);
		$this->sessionSet('discard_after', time());
		$this->log('Another succesful login by #' . $login->id, 'views.txt');
		$this->redirect('u/home');
	}

	// Performs the login
	public function actionlogin() {
		$this->inputStart($_POST);
		$this->inputAddFilter([
			'login' => 'trim|sanitize_string',
			'pwd' => 'trim|sanitize_string',
		]);
		$data = $this->getInputData();

		$user = new Conta();
		if (!empty($data['login'])) {
			$user->login = $data['login'];
			$user->pwd = $data['pwd'];
			$login = $user->validateCredentials();

			if ($login !== false) {
				$this->login($login);
			} else {
				$this->outputPage('index::login', [
					'showErroLogin' => 'credentials'
				]);
			}
		}
	}

	// Performs the signup
	public function actionCadastro() {
		$this->inputStart($_POST);
		$this->inputAddFilter([
			'email' => 'trim|sanitize_email',
			'pwd' => 'trim|sanitize_string',
			'nome' => 'trim|sanitize_string',
			'sobrenome' => 'trim|sanitize_string',
			'empresa' => 'trim|sanitize_string',
			'cnpj' => 'trim|sanitize_string',
		]);
		$data = $this->getInputData();

		$user = new Conta();
		if (!empty($data['email'])) {
			$user->login = $data['email'];
			$user->email = $data['email'];
			$user->pwd = $data['pwd'];
			$user->nome = $data['nome'];
			$user->sobrenome = $data['sobrenome'];
			$user->empresa = $data['empresa'];
			$user->cnpj = $data['cnpj'];
			$isValid = $user->validateNewCredentials();

			if (!$isValid->login->id and !$isValid->cnpj->id) {
				if ($user->cadastro()) {
					$this->login($user->validateCredentials());
				} else {
					$this->outputPage('index::cadastro', [
						'showErroLogin' => 'db'
					]);
				}
			} else {
				$this->outputPage('index::cadastro', [
					'showErroLogin' => $isValid
				]);
			}
		}
	}

	// Validates every request to see whos logged in
	public function actionloginValidate() {
		if (!$this->sessionHas('user') or time() > $this->sessionGet('discard_after')) {
			$this->actionlogoff();
		} else {
			$this->sessionSet('discard_after', time() + 3600);
		}
	}

	public function actionlogoff() {
		$this->sessionDestroy();
		$this->redirect('login');
	}
}
