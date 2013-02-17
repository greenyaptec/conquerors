<?php

use \Conquerors\RegisterException,
	\Nette\Security\AuthenticationException;

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
		$form = new RegisterForm();
		$form->onSuccess[] = $this->registerFormSubmitted;
		return $form;
	}

	public function registerFormSubmitted($form)
	{
		$v = $form->values;
		try
		{
			$this->users->register($v);
			$this->user->login($v->nick, $v->password);
			$this->flashMessage("Registration completed succesfully, automatically logged in.");

		}
		catch(RegisterException $e)
		{
			$this->flashMessage($e->getMessage(), 'error');
			$this->refresh();
		}
	}

	public function createComponentLoginForm()
	{
		$form = new LoginForm();
		$form->onSuccess[] = $this->loginFormSubmitted;
		return $form;
	}

	public function loginFormSubmitted($form)
	{
		$v = $form->values;
		try
		{
			$this->user->login($v->nick, $v->password);
			if($v->stay_logged_in)
			{
				$this->user->setExpiration('+14 days');
			}
			$this->flashMessage('Login successfull.');
			$this->redirect("User:default");
		}
		catch(AuthenticationException $e)
		{
			$this->flashMessage($e->getMessage(), 'error');
			$this->refresh();
		}
	}
}