<?php

namespace blitz\app\models;

use stdClass;

/**
 * Account model
 *
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Conta extends \blitz\vendor\core\ModelDatabase
{
	public function validateCredentials() {
		$stmt = $this->getConn()
			->select('a.id, a.pessoa_id, a.hierarchy, b.first_name, b.last_name, b.email, b.empresa_id, c.nome as empresa_nome, c.cnpj')
			->from('usuario a')
			->join('join pessoa b on a.pessoa_id = b.id')
			->join('join empresa c on b.empresa_id = c.id')
			->where('a.login = ?', $this->login)
			->where('a.pwd = ?', $this->pwd)
			->where('a.is_deleted is null')
			->execute()
			->fetchInto($this);

		return $stmt;
	}

	public function validateNewCredentials() {
		$stmt = new stdClass;
		$stmt->login = $this->getConn()
			->select('id')
			->from('usuario a')
			->where('a.login = ?', $this->email)
			->execute()
			->fetchInto($this);

		$stmt->cnpj = $this->getConn()
			->select('id')
			->from('empresa a')
			->where('a.cnpj = ?', $this->cnpj)
			->execute()
			->fetchInto($this);

		return $stmt;
	}

	public function cadastro() {
		$this->saveAux('empresa', [
			'nome' => $this->empresa,
			'cnpj' => $this->cnpj
		]);

		$empresa_id = $this->getConn()
			->select('LAST_INSERT_ID() as id')
			->from('empresa')
			->execute()
			->fetchInto($this);

		$this->saveAux('pessoa', [
			'first_name' => $this->nome,
			'last_name' => $this->sobrenome,
			'email' => $this->email,
			'empresa_id' => $empresa_id->id
		]);

		$pessoa_id = $this->getConn()
			->select('LAST_INSERT_ID() as id')
			->from('pessoa')
			->execute()
			->fetchInto($this);

		return $this->saveAux('usuario', [
			'login' => $this->email,
			'pwd' => $this->pwd,
			'pessoa_id' => $pessoa_id->id
		]);
	}

	public function infos() {
		return $this->getConn()
			->select('id, title, content')
			->from('post')
			->where('id = ?', [$this->id])
			->execute()
			->fetchInto($this);
	}
}
