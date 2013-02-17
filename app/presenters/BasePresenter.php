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
