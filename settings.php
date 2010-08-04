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


?>
<h2>Affiliate Settings</h2>

<p></p>
	
<table>
	<tr>
		<td width="200px"><label for="default_tracking_code">Affiliate Code</label></td>
		<td>
		<input id="default_tracking_code" name="default_tracking_code" type="text" size="50" value="<?php echo $this->default_tracking_code; ?>" />
		</td>
		</tr><tr><td colspan="2" class="paypalinfo">
		You can specify other tracking codes in your individual pages, but if one is not specified, this default will be used.
		</td>
	</tr>
	<tr>
		<td width="200px"><label for="sportscapping_sitepath">Sports Capping Site Path</label></td>
		<td>
		<input id="sportscapping_sitepath" name="sportscapping_sitepath" type="text" size="50" value="<?php echo $this->sportscapping_sitepath; ?>" />
		</td>
		</tr><tr><td colspan="2" class="paypalinfo">
		This should never need to be changed. But in the event that Jimmy get's a new URL, you'll need to update that here.
		</td>
	</tr>
	
	

</table>