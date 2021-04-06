<?php

namespace blitz\app\controllers;

\blitz\vendor\core\Model::import('Usuario');
use \blitz\app\models\Usuario as Usuario;

\blitz\vendor\core\Model::import('Pessoa');
use \blitz\app\models\Pessoa as Pessoa;

/**
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Usuarios extends \blitz\vendor\core\Controller
{
	public function actionIndex() {
		$usuario = new Usuario();
		$usuario->empresa_id = $this->sessionGet('user')->empresa_id;
		$this->outputPage('usuarios::listar', [
			'usuarios' => $usuario->getUsuarios()
		]);
	}

	public function actionWrite() {
		$this->inputStart($_POST);
		var_dump($this->getInputData());
		$this->inputAddValidation([
			'id' => 'required|alpha_numeric|min_len,1',
			'login' => 'required|min_len,1',
			'pwd' => 'alpha_numeric',
			'hierarquia' => 'required|alpha_numeric|min_len,1',
			'pessoa' => 'required|integer|min_len,1',
		]);
		$data = $this->getInputData();

		if (empty($data)) {
			$this->redirect('u/usuarios');
		} else {
			$usuario = new Usuario();
			$data['id'] == 'Novo' ? $usuario->id = null : $usuario->id = $data['id'];
			$usuario->login = $data['login'];
			empty($data['pwd']) ? $usuario->pwd = null : $usuario->pwd = $data['pwd'];
			$usuario->hierarquia = $data['hierarquia'];
			$usuario->pessoa = $data['pessoa'];
			$usuario->empresa_id = $this->sessionGet('user')->empresa_id;
			$usuario->save();

			$this->redirect('u/usuarios');
		}
	}

	public function actionNew() {
		$this->inputStart($_GET);
		$this->inputAddValidation([
			'id' => 'required|integer|min_len,1'
		]);
		$data = $this->getInputData();

		if (empty($data)) {
			$pessoas = new Pessoa();
			$pessoas->empresa_id = $this->sessionGet('user')->empresa_id;

			$this->outputPage('usuarios::cadastro', [
				'pessoas' => $pessoas->getPessoas(),
			]);
		} else {
			$usuario = new Usuario();
			$pessoas = new Pessoa();
			$usuario->id = $data['id'];
			$usuario->empresa_id = $this->sessionGet('user')->empresa_id;
			$pessoas->empresa_id = $this->sessionGet('user')->empresa_id;

			$this->outputPage('usuarios::cadastro', [
				'usuario' => $usuario->getUsuario(),
				'pessoas' => $pessoas->getPessoas(),
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
			$this->redirect('u/usuarios');
		} else {
			$usuario = new Usuario();
			$usuario->id = $data['id'];
			$usuario->empresa_id = $this->sessionGet('user')->empresa_id;
			$usuario->delete();

			$this->redirect('u/usuarios');
		}
	}
}
