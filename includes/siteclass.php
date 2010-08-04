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

require_once dirname(__file__).'/framework.php';


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


class byrdSiteExperts extends byrdPropertiesExperts {

	/**
	 * acts as a controller
	 * @return none
	 */
	function __construct(){
		//get all of the options
		$this->getOptions();
		
	}
	
	/**
	 * <!-- sportscapping() -->
	 * 
	 * @param $content
	 * @return unknown_type
	 */
	function contentFilters( $content = '' ) {
		
		while(1==1){
			preg_match('/<\!-- sportscapping\((\d+)\) -->/', $content, $form);
			if (!isset($form[1])) break;
			$content = str_replace("<!-- sportscapping(".$form[1].") -->", $this->getcode($form[1]), $content);
		}
		
		return $content;
	}
	
	/**
	 * Translates the copy paste into legitamite output
	 * 
	 * @param $code
	 * @return string
	 */
	function getcode($code){
		
		switch ( str_replace(' ','',strtolower($code)) ) {
			case 'plaintextlink': return '<a href="http://sportscapping.com/new/welcome/AF35_44/">Sportscapping.com</a>'; break;
			
		}
		
	}
	
} 
