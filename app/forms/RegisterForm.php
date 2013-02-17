<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Forms\Form;

/**
 *
 *
 * @author greeny
 */
class RegisterForm extends FormControl
{
	protected function initializeForm(BaseForm $form)
	{
		$form->addText('nick', 'Nick')
			->setRequired("Please enter your nick.")
			->addRule(Form::PATTERN, 'Nick must be at least 5 characters long and can contain only letters, numbers or underscore.', '[a-zA-Z0-9_]{5,}');

		$form->addPassword('password', 'Password')
			->setRequired("Please enter your password.")
			->addRule(Form::PATTERN, 'Password must be at least 5 characters long.', '.{5,}');

		$form->addPassword('password_check', 'Password again')
			->setRequired("Please enter your password again.")
			->addRule(Form::EQUAL, "Passwords must match.", $form['password']);

		$form->addText('email', 'Email')
			->setRequired("Please enter your email.")
			->addRule(Form::PATTERN, 'Email must be valid.', "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");

		$form->addPrimarySubmit('register', 'Register');
	}
}
