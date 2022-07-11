<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'email', 'session' , 'form_validation');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'file');


$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('Login_model', 'Admin_model', 'Whatsapp_model', 'Cron_model');