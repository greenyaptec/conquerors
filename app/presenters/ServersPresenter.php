<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 *
 * @author greeny
 */
class ServersPresenter extends BasePresenter
{
	/** @var \Servers */
	protected $servers;

	public function inject(\Servers $servers)
	{
		$this->servers = $servers;
	}
}
