<?php

namespace blitz\app\models;

/**
 * Person model
 *
 * @author Leonardo Pessatti <lpessatti@gmail.com>
 */
class Pessoa extends \blitz\vendor\core\ModelDatabase
{
	public function getPersonalData() {
		$stmt = $this->getConn()
			->select('*')
			->from('pessoa a')
			->where('a.id = ?', [$this->id])
			->where('a.empresa_id = ?', [$this->empresa_id])
			->execute()
			->fetchInto($this);

		return $stmt;
	}

	public function getPessoas() {
		$stmt = $this->getConn()
			->select('*')
			->from('pessoa a')
			->where('a.empresa_id = ?', [$this->empresa_id])
			->where('a.is_deleted is null')
			->execute()
			->fetchCollection($this);
		return $stmt;
	}

	public function save() {
		if (empty($this->id)) {
			$this->getConn()
				->executeQuery('INSERT INTO pessoa (first_name, last_name, email, empresa_id)VALUES(?,?,?,?)', [
					$this->first_name, $this->last_name, $this->email, $this->empresa_id
				]);
		} else {
			$this->getConn()
				->executeQuery('UPDATE pessoa SET first_name =?, last_name =?,email =? WHERE id = ?;', [
					$this->first_name, $this->last_name, $this->email, $this->id
				]);
		}
		return true;
	}

	public function delete() {
		$this->getConn()
			->executeQuery('UPDATE pessoa
			SET is_deleted= NOW()
			WHERE id=? and empresa_id=? and is_deleted is null', [$this->id, $this->empresa_id]);
	}
}
