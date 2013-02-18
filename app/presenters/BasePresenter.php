<?php

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	public function handleLogout()
	{
		if($this->user->loggedIn)
		{
			$this->user->logout(TRUE);
			$this->flashMessage("Logout succesfull.", 'success');
		}
		$this->redirect("Homepage:default");
	}

	public function refresh()
	{
		$this->redirect('this');
	}

	public function beforeRender()
	{
		parent::beforeRender();
		TemplateUpgrader::upgrade($this->template);
	}

	public function formatTemplateFiles()
	{
		$name = $this->getName();
		$presenter = substr($name, strrpos(':' . $name, ':'));
		return array(
			TEMPLATE_DIR."/$presenter/$this->view.latte",
			TEMPLATE_DIR."/$presenter.$this->view.latte",
			TEMPLATE_DIR."/$presenter/$this->view.phtml",
			TEMPLATE_DIR."/$presenter.$this->view.phtml",
		);
	}

	/**
	 * Saves the message to template, that can be displayed after redirect.
	 * @param  string
	 * @param  string
	 * @return \stdClass
	 */
	public function flashMessage($message, $type = 'success')
	{
		return parent::flashMessage($message, $type);
	}
}
