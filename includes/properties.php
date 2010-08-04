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

class byrdPropertiesExperts {
	
	public $default_tracking_code = null;
	public $sportscapping_site_path = 'http://sportscapping.com';
	
	
	
	/**
	 * A hack to support __construct() on PHP 4
	 *
	 * Hint: descendant classes have no PHP4 class_name() constructors,
	 * so this constructor gets called first and calls the top-layer __construct()
	 * which (if present) should call parent::__construct()
	 *
	 * @access	public
	 * @return	Object
	 */
	function byrdPropertiesExperts()
	{
		$args = func_get_args();
		call_user_func_array(array(&$this, '__construct'), $args);
	}
	
	/**
	 * loads the proper functions
	 * 
	 * @return none
	 */
	function __construct(){
		$this->getOptions();
	}
	
	/**
	 * loops through the properties and binds them to this class
	 * 
	 */
	function getOptions(){
		foreach ($this->getProperties() as $property => $value)
			if (get_option($property)) 
				$this->$property = get_option($property);
	}
	
	/**
	 * loops through and stores theres properties
	 * 
	 */
	function setOptions(){
		if (empty($_POST)) return false;
		foreach ($this->getProperties() as $property => $value) 
			update_option($property, $value);
	}

	/* 
	 * catch all function
	 */
	function __call($method,$arguments) {
		switch (substr($method,0,3)){
			case 'get': echo $this->loadTheme($method,$arguments); break;
			case 'scr': echo $this->javaScript($method,$arguments); break;
			case 'css': echo $this->cssLink($method,$arguments); break;
			
		}
		
	}
	
	/**
	 *
	 */
	function byrd_loadfile($file = __file__){
		if (is_file($file)){
			ob_start();
			include $file;
			$get = ob_get_clean();
			return $get;
		}
		return false;
	}
	
	/**
	 * gets the javascript files
	 */
	function javaScript($method,$arguments){
		$page = strtolower( substr($method,6) );
		$file = str_replace(DS.'includes','', dirname(__file__)).DS.'media'.DS.$page.'.js';
		
		return "<script type='text/javascript'>".byrd_optimize($this->byrd_loadfile($file), __file__)."</script>";
	}
	
	/**
	 * gets the css files
	 */
	function cssLink($method,$arguments){
		$page = strtolower( substr($method,3) );
		$file = str_replace(DS.'includes','', dirname(__file__)).DS.'media'.DS.$page.'.css';
		
		return "<style>".byrd_optimize($this->byrd_loadfile($file), __file__)."</style>";
	}
	
	/**
	 * requires the php file for inclusion
	 */
	function loadTheme($method,$arguments){
		$page = strtolower( substr($method,3) );
		
		//loading the wordpress themes
		if (!defined('WP_USE_THEMES')) define('WP_USE_THEMES', false); 
		$wpblogheader = byrd_rootfolder().DS.'wp-blog-header.php';
		if (is_file($wpblogheader)) require_once $wpblogheader;
		
		//loading the requested file
		return $this->byrd_loadfile
		(
			str_replace(DS.'includes','', dirname(__file__)).DS.$page.'.php'
		);
	}
	
	/**
	 * Set the object properties based on a named array/hash
	 *
	 * @access	protected
	 * @param	$array  mixed Either and associative array or another object
	 * @return	boolean
	 * @see		set()
	 * @since	1.5
	 */
	function setProperties( $properties )
	{
		$properties = (array) $properties; //cast to an array

		if (is_array($properties))
		{
			foreach ($properties as $k => $v) {
				$this->$k = $v;
			}

			return true;
		}

		return false;
	}
	
	/**
	 * Returns an associative array of object properties
	 *
	 * @access	public
	 * @param	boolean $public If true, returns only the public properties
	 * @return	array
	 * @see		get()
	 * @since	1.5
 	 */
	function getProperties( $public = true )
	{
		$vars  = get_object_vars($this);

        if($public)
		{
			foreach ($vars as $key => $value)
			{
				if ('_' == substr($key, 0, 1)) {
					unset($vars[$key]);
				}
			}
		}

        return $vars;
	}
	
	
	
}
