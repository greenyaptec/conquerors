<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use \Fabik\Database\Table,
	\Nette\ArrayHash,
	\Fabik\Database\DuplicateEntryException;

/**
 *
 *
 * @author greeny
 */
class Servers extends Table
{
	protected $name = 'servers';

	public function add(ArrayHash $data)
	{
		$this->validate($data);
		$this->servers->create(array(
			'name' => $v->name,
			'shortcut' => $v->shortcut,
			'created' => Time()
		));
	}

	protected function validate(ArrayHash $data)
	{
		if($this->findOneBy('name', $data->name))
		{
			throw new DuplicateEntryException("Server with name '".$data->name."' already exists.");
		}

		if($this->findOneBy('shortcut', $data->shortcut))
		{
			throw new DuplicateEntryException("Server with shortcut '".$data->shortcut."' already exists.");
		}
	}
}
