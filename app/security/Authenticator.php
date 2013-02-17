<?php

class Authenticator extends Nette\Object implements Nette\Security\IAuthenticator
{
	/** @var Users */
	private $users;

	private static $constants = array(
		'nick' => 'nick',
		'password' => 'password',
		'role' => 'role',
		'id' => 'id',
		'salt' => 'salt',
		'hash' => 'sha512',
		'hashCount' => 5
	);

	public function __construct(Users $users)
	{
		$this->users = $users;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->users->findOneBy(self::$constants['nick'], $username);

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		}

		if (self::passwordHash($password, $row[self::$constants['salt']]) !== $row[self::$constants['password']]) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		unset($row[self::$constants['password']]);
		unset($row[self::$constants['salt']]);

		return new Nette\Security\Identity($row[self::$constants['id']], $row[self::$constants['role']], $row);
	}

	public static function passwordHash($password, $salt = "")
	{
		return self::multiHash($password, self::$constants['hashCount'], $salt);
	}

	private static function multiHash($password, $count, $salt)
	{
		return $count > 1 ? self::multiHash(self::hash($password, $salt, self::$constants['hash']), $count - 1, $salt) : self::hash($password, $salt, self::$constants['hash']);
	}

	private static function hash($password, $salt, $hashMethod = 'sha1')
	{
		return hash($hashMethod, $salt.$password);
	}
}
