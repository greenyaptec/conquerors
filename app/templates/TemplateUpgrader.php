<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Object,
	Nette\Templating\Template;

/**
 *
 *
 * @author greeny
 */
class TemplateUpgrader extends Object
{
	public static function upgrade(Template $template)
	{
		$template->registerHelper('formatTime', function($text)
		{
			return Date("j.n.Y G:i", (int) $text);
		});
	}
}
