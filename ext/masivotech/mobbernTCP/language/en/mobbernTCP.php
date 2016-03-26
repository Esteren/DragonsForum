<?php

/**
*
* MobbernTCP [British English]
*
* @package Masivotech MobbernTCP
* @version $Id$
* @copyright (c) 2014 masivotech
* @license PRIVATE
*
*/

if (!defined('IN_PHPBB'))
{
  exit;
}
if (empty($lang) || !is_array($lang))
{
  $lang = array();
}

$lang = array_merge($lang, array(
  'MBRN_TCP'  => 'Theme Control Panel',
  'MBRN_SETTINGS_SAVED'  => 'Your settings have been saved. Redirecting...',
  'MBRN_INVALID_LOGIN'  => 'You must log-in as administrator to access the Theme Control Panel. <br> Redirecting back to the index page...',
  'MBRN_INVALID_FORM'  => 'Invalid form data.',

));
