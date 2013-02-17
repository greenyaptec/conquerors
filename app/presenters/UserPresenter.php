<?php

class UserPresenter extends BasePresenter
{
	/** @var Users */
	protected $users;

	public function inject(Users $users)
	{
		$this->users = $users;
	}

	public function actionRegister()
	{
		$this->goToDefault();
	}

	public function actionLogin()
	{
		$this->goToDefault();
	}

	public function actionDefault()
	{
		$this->goToLogin();
	}

	protected function goToLogin()
	{
		if(!$this->user->loggedIn)
		{
			$this->redirect("User:login");
		}
	}

	protected function goToDefault()
	{
		if($this->user->loggedIn)
		{
			$this->redirect("User:default");
		}
	}

	public function createComponentRegisterForm()
	{
		//
	}

	public function registerFormSubmitted($form)
	{
		$v = $form->values;
		try
		{
			$this->users->register($v);
			$this->user->login($v->nick, $v->password);
			$this->flashMessage("Registration completed succesfully, login sucessfull.");

		}
		catch(RegisterException $e)
		{
			$this->flashMessage($e->getMessage(), 'error');
			$this->redirect('this');
		}
	}

	public function createComponentLoginForm()
	{
		//
	}

	public function loginFormSubmitted($form)
	{
		$v = $form->values;
	}
}