<?php

namespace blitz\app\models;

use stdClass;

/**
 * Account model
 *
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Usuario extends \blitz\vendor\core\ModelDatabase
{
	public function getUsuarios() {
		$stmt = $this->getConn()
			->select('a.id as userid, a.*, b.*')
			->from('usuario a')
			->join('join pessoa b on a.pessoa_id = b.id')
			->where('b.empresa_id = ?', [$this->empresa_id])
			->where('a.is_deleted is null')
			->execute()
			->fetchCollection($this);
		return $stmt;
	}

	public function getUsuario() {
		$stmt = $this->getConn()
			->select('a.id as userid, a.*, b.*')
			->from('usuario a')
			->join('join pessoa b on a.pessoa_id = b.id')
			->where('a.id = ?', [$this->id])
			->where('b.empresa_id = ?', [$this->empresa_id])
			->where('a.is_deleted is null')
			->execute()
			->fetchInto($this);
		return $stmt;
	}

	public function save() {
		if (empty($this->id)) {
			$this->getConn()
				->executeQuery('INSERT INTO usuario (login, pwd, hierarchy, pessoa_id)VALUES(?,?,?,?)', [
					$this->login, $this->pwd, $this->hierarquia, $this->pessoa
				]);
		} else {
			if (empty($this->pwd)) {
				$this->getConn()
					->executeQuery('UPDATE usuario a
					INNER JOIN pessoa b on a.pessoa_id = b.id
					SET login =?, hierarchy =?, pessoa_id =? WHERE a.id = ? and b.empresa_id=?;', [
						$this->login, $this->hierarquia, $this->pessoa, $this->id, $this->empresa_id
					]);
			} else {
				$this->getConn()
					->executeQuery('UPDATE usuario a
					INNER JOIN pessoa b on a.pessoa_id = b.id
					SET pwd = ?, login =?, hierarchy =?, pessoa_id =? WHERE a.id = ? and b.empresa_id=?;', [
						$this->pwd, $this->login, $this->hierarquia, $this->pessoa, $this->id, $this->empresa_id
					]);
			}
		}
		return true;
	}

	public function delete() {
		$this->getConn()
			->executeQuery('UPDATE usuario a
			INNER JOIN pessoa b on a.pessoa_id = b.id
			SET a.is_deleted= NOW()
			WHERE a.id=? and b.empresa_id=? and a.is_deleted is null', [$this->id, $this->empresa_id]);
	}
}
