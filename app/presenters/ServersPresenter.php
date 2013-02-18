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
class ServersPresenter extends ProtectedPresenter
{
	/** @var \Servers */
	protected $servers;

	public function inject(\Servers $servers)
	{
		$this->servers = $servers;
	}

	public function renderDefault()
	{
		$this->template->servers = $this->servers->findAll()->where('playable', 1)->order('created DESC');
	}
}
