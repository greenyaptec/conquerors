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

	public function actionAdd()
	{
		if(!$this->user->isAllowed('server', 'add'))
		{
			$this->redirect('Server:list');
		}
	}

	public function createComponentAddServerForm()
	{
		$form = new AddServerForm();
		$form->onSuccess[] = $this->addServerFormSubmitted;
		return $form;
	}

	public function addServerFormSubmitted(BaseForm $form)
	{
		$v = $form->values;

		try
		{
			$this->servers->create(array(
				'name' => $v->name,
				'shortcut' => $v->shortcut,
				'created' => Time()
			));
		}
		catch(\Fabik\Database\DuplicateEntryException $e)
		{
			$this->flashMessage($e->getMessage(), 'error');
			$this->refresh();
		}

		$this->flashMessage('Server added.');
		$this->redirect('Servers:default');
	}
}
