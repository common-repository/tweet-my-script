<?php
/**
 * @package Tweet My Script
 * @author Matt Kendrick
 * @version 0.75
 */
/*
Plugin Name: Tweet My Script
Plugin URI: http://mattkendrick.com/?p=1496
Donate link: http://mattkendrick.com/?p=1496
Description: This plugin watches your Twitter RSS Feed for user-defined "launch codes" to trigger user-defined script URLs.
Author: Matt Kendrick
Version: 0.75
Author URI: http://mattkendrick.com
*/

function tmscript_get_xml_as_array($url)
{
//use curl to grab the xml data
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,$url);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

//setup parser
$parser=xml_parser_create();

//convert dump xml to struct
xml_parse_into_struct($parser,$buffer,$values);

//clear up parser and buffer
xml_parser_free($parser);
unset($buffer);

//return array of values
return $values;
}

function tmscript_get_twitter_remaining_count()
{
//use curl to grab the xml data
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'https://twitter.com/account/rate_limit_status.xml');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

//setup parser
$parser=xml_parser_create();

//convert dump xml to struct
xml_parse_into_struct($parser,$buffer,$values);

//clear up parser and buffer
xml_parser_free($parser);
unset($buffer);

//get count from array
$count = $values[1]['value'];

//clear up array
unset($values);

//return api count
return $count;
}

function tweet_my_script()
{

/* OLD METHOD (PHP5 ONLY)
$xmlDoc = new DOMDocument();
$xmlDoc->load(get_option('tmscript_feed'));

$items = $xmlDoc->getElementsByTagName("item");
 
$title = $items->item(0)->getElementsByTagName("title")->item(0)->nodeValue;
*/

//update version .75 -  offset
if(get_option('tmscript_offset_value') == "" OR get_option('tmscript_offset_counter') == "")
{
update_option('tmscript_offset_counter',0);
update_option('tmscript_offset_value',0);
}

$offset_value = get_option('tmscript_offset_value');
$offset_counter = get_option('tmscript_offset_counter');


//check to see if offset  value  is set and if counter is met
if($offset_value == $offset_counter)
{

	//check to see if we're maxed out on twitter requests
	if(tmscript_get_twitter_remaining_count() > 0)
	{
	   $feed = tmscript_get_xml_as_array(get_option('tmscript_feed'));
	  
		$title = $feed[15]['value'];
	 
	   //if launch code is found in the twitter and not the same as the last tweet then launch the script
		if(strpos($title,get_option('tmscript_lc')) > 0 AND get_option('tmscript_lt') != $title )
		{
		//run script
		file_get_contents(get_option('tmscript_script_url'));
		
		//update last tweet
		update_option('tmscript_lt', $title);
		}
	}
	
	update_option('tmscript_offset_counter',0);

}
else
{
	//if counter is not met then increase offset counter
	if(get_option('tmscript_offset_value') != 0)
	{
	update_option('tmscript_offset_counter',get_option('tmscript_offset_counter')+1);
	}
}

}

function tweet_my_script_options()
{
include "tweet_my_script_options.php";
}

function tweet_my_script_actions()
{
  add_options_page('Tweet My Script Options', 'Tweet My Script', 1, 'Tweet My Script', 'tweet_my_script_options');
}

add_action('wp_footer', 'tweet_my_script');

add_action('admin_menu', 'tweet_my_script_actions'); 

?>