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
class AddServerForm extends \FormControl
{
	protected function initializeForm(\BaseForm $form)
	{
		$form->addText('name', 'Name')
			->setRequired('Name is required.');

		$form->addText('shortcut', 'Shortcut')
			->setRequired("Shortcut is required.")
			->addRule(\Nette\Forms\Form::PATTERN, "Shortuct must be 2 to 6 chars long, can contain only letters and numbers.", '[0-9a-zA-Z]{2,6}');

		$form->addPrimarySubmit('add', 'Add server');
	}
}
