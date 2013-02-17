<?php

use \Nette\Security\Permission;

/**
 *
 *
 * @author greeny
 */
class Authorizator extends Permission
{
	public function __construct()
	{
		$this->addRole('quest');
		$this->addRole('member', 'quest');
		$this->addRole('gm', 'member');
		$this->addRole('admin', 'gm');
		$this->addRole('owner');

		$this->addResource('server');
		$this->addResource('user');
		$this->addResource('account');
		$this->addResource('log');

		$this->allow('admin');
		$this->deny('admin', 'server');
		$this->allow('owner');
	}
}
