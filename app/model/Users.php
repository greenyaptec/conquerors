<?php

use \Nette\ArrayHash,
	\Fabik\Database\Table,
	\Conquerors\RegisterException,
	\Nette\Utils\Strings;

/**
 * Represents user table
 *
 * @author greeny
 */
class Users extends Table
{
    protected $name = 'users';

	/**
	 * Registers user.
	 *
	 * @param \Nette\ArrayHash $data data from form
	 * @throws RegisterException on duplicate entry (nick or email)
	 */
	public function register(ArrayHash $data)
	{
		if($this->findOneBy('nick', $data->nick))
		{
			throw new RegisterException("User with nick '".$data->nick."' already exists.");
		}

		if($this->findOneBy('email', $data->email))
		{
			throw new RegisterException("User with email '".$data->email."' already exists.");
		}

		$salt = Strings::random(5, '0-9a-zA-Z');

		$this->insert(array(
			'nick' => $data->nick,
			'password' => Authenticator::passwordHash($data->password, $salt),
			'email' => $data->email,
			'salt' => $salt,
			'role' => 'member',
			'registered' => Time(),
			'last_login' => Time()
		));
	}
}
