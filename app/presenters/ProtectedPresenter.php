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
abstract class ProtectedPresenter extends BasePresenter
{
	public function startup() {
		if(!$this->user->loggedIn) // TODO or if banned
		{
			$this->flashMessage("You must be logged in.", 'error');
			$this->redirect("User:login");
		}

		parent::startup();
	}
}
