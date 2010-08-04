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



class byrdConfigExperts extends byrdPropertiesExperts {

	/**
	 * routing the config page
	 * 
	 */
	function __construct(){
		//Check user rights
		if ( !current_user_can('manage_options') ) die(__('Sorry, but you don\'t have the rights.'));
		
		if (!empty($_POST)){
			//update the posted options
			$this->setProperties( $_POST );
			$this->setOptions();
		}
		
		//get all of the options
		$this->getOptions();
	}
	
	
	
}
