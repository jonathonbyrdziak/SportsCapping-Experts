<?php 
/**
 * Plugin Name: Byrds SportsCapping Easy Integration
 * Plugin URI: http://www.jonathonbyrd.com
 * Description: Making it easier for you to control your sportscapping data.
 * Version: 1.0.0
 * Date: January 18th, 2010
 * Author: Jonathon Byrd
 * Author URI: http://www.jonathonbyrd.com
 * 
 * @subpackage	: Wordpress
 * @author		: Jonathon Byrd
 * @copyright	: All Rights Reserved, Byrd Inc. 2009
 * @link		: http://www.jonathonbyrd.com
 * 
 * Jonathon Byrd is a freelance developer for hire. Jonathon has owned many companies and
 * understands the importance of website credibility. Contact Jonathon Today.
 * 
 */ 

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php';


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();

if ( class_exists('byrdSiteExperts') ){
	global $byrdExperts;
	$byrdExperts = new byrdSiteExperts();
	
	//adding admin menu options
	if ( function_exists('add_action') ) add_action('admin_menu', 'plugin_config_Experts');
	function plugin_config_Experts(){
		if ( function_exists('add_submenu_page') ){
			add_submenu_page('options-general.php',__('Sportscapping Feeds'),__('Sports Capping'),'manage_options',dirname(__file__).DS.'config_index.php','');
		}
		
	}
	
	//adding the menu items
	add_filter('the_content', array(&$byrdExperts, 'contentFilters'));
	
	//php method of loading the contact form
	if (!function_exists('getExperts')){ 
		function getExperts(){
			global $byrdExperts;
			$byrdExperts->getExperts();
		}
	}
	
	
}

