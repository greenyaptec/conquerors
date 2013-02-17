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
class LoginForm extends FormControl
{
	protected function initializeForm(\BaseForm $form)
	{
		$form->addText('nick', 'Nick')
			->setRequired("Please enter your nick.");

		$form->addPassword('password', 'Password')
			->setRequired("Please enter your password.");

		$form->addCheckbox('stay_logged_in', 'Stay logged in.');

		$form->addPrimarySubmit("login", 'Login');
	}
}
