<?php 
/**
 * @subpackage	: Wordpress
 * @author		: Jonathon Byrd
 * @copyright	: All Rights Reserved, Byrd Inc. 2009
 * @link		: http://www.jonathonbyrd.com
 * 
 * Jonathon Byrd is a freelance developer for hire. Jonathon has owned many companies and
 * understands the importance of website credibility. Contact Jonathon Today.
 * 
 */ 



// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


//Defining base path
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

define('EXP', str_replace(DS.'includes','', dirname(__file__) ));

//defining all paths
define('EXP_INCLUDES', 	EXP.DS.'includes');
define('EXP_SUPPORT', 	EXP.DS.'support');
define('EXP_DATABASE', 	EXP.DS.'database');
define('EXP_TABLES', 	EXP_DATABASE.DS.'tables');

