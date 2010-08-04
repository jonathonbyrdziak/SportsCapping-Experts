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


#######################################################
# SETTINGS - you can modify these setting to your needs

$mode = 'standard';		# please select mode: standard, fopen, curl, iframe
$frame_height = 1400;	# applied to iframe type only

#######################################################
# SPORTSCAPPING content STARTS here 
# Do not modify unless you 100% about what you're doing

$sportscapping_site_path = $this->sportscapping_site_path;
$your_partner_code = $this->your_partner_code;

$params_string = getenv('QUERY_STRING');
$params_array = explode('/', $params_string);

if (is_array($params_array))
foreach ($params_array as $one_param) {
	unset($temp_params_array);
	$temp_params_array = explode(',', $one_param);
	$named_param[$temp_params_array[0]] = $temp_params_array[1];
}

if (!$params_array[0])	$params_array[0] = 'premium_picks';

if ($params_array[0] == 'schedule') 		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/schedule/' . $named_param['league_id'] . '/' . $named_param['event_date'] . '/' . $named_param['game_id'] . '/' . $named_param['picks_type'];
if ($params_array[0] == 'premium_picks')	$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/premium_picks/menu/' . $named_param['leg'] . '/' . $params_array[1];
if ($params_array[0] == 'free_picks')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/free_picks';
if ($params_array[0] == 'leaderboard')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/leaderboard/menu/5/' . $named_param['leg'];
if ($params_array[0] == 'capper')			$url = $sportscapping_site_path . '/new/export/?' . $params_array[4] . '/export/capper/' . $params_array[2] . '/overall';
if ($params_array[0] == 'top_trends')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/top_trends/menu/' . $named_param['leg'] . '/10';
if ($params_array[0] == 'top_cappers')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/top_cappers/full/menu/' . $named_param['leg'];

if ( $mode == 'standard' ) 		echo file_get_contents( $url );
if ( $mode == 'fopen' ) 		echo get_file( $url );
if ( $mode == 'curl' ) 			echo get_file_curl( $url );

if ( $mode == 'iframe' ) 		
{
if ($params_array[0] == 'premium_picks')	$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/premium_picks/menu/' . $named_param['leg'] . '/' . $params_array[1];
if ($params_array[0] == 'free_picks')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/free_picks';
if ($params_array[0] == 'leaderboard')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/leaderboard/menu/5/' . $named_param['leg'];
if ($params_array[0] == 'capper')			$url = $sportscapping_site_path . '/new/export/?' . $params_array[4] . '/export/capper/' . $params_array[2] . '/overall';
if ($params_array[0] == 'top_trends')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/top_trends/menu/' . $named_param['leg'] . '/10';
if ($params_array[0] == 'top_cappers')		$url = $sportscapping_site_path . '/new/export/?' . $your_partner_code . '/export/top_cappers/full/menu/' . $named_param['leg'];

echo 
'<script language="javascript" type="text/javascript">

function iFrameHeight() {
	var h = 0;
	if ( !document.all ) {
		h = document.getElementById(\'blockrandom\').contentDocument.height;
		document.getElementById(\'blockrandom\').style.height = h + 60 + \'px\';
	} else if( document.all ) {
		h = document.frames(\'blockrandom\').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + \'px\';
	}
}
</script>

<iframe onload="iFrameHeight()"	id="blockrandom" name="iframe" src="' . $url . '" width="100%" height="' . $frame_height . '" scrolling="auto" align="top" frameborder="0"
class="wrapper">This option will not work correctly.  Unfortunately, your browser does not support Inline Frames</iframe>';
}

function get_file_curl($url)
{
	$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)';
	
    # start CURL
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);					// base page
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);		// user agent
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 			// return result to variable
    # get actual result to variable
	$content = curl_exec ($ch);
    # close CURL
	curl_close ($ch);
	
	return $content;
}

function get_file($url)
{
   $data = fopen($url,"rb");
   $content = '';
   if ($data)
   {
      while (!feof($data))
      {
         $content .= @fread($data, 100000);
      }
      @fclose($data);
   }
   return($content);
}

# SPORTSCAPPING content ENDS here
##################################################

?>