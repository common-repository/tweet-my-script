<?php

if($_POST['tmscript_options_hidden'] == 'Y') 
{

$feed = $_POST['tmscript_feed'];  
$lc = $_POST['tmscript_lc'];  
$script_url = $_POST['tmscript_script_url'];  
$offset_value = $_POST['tmscript_offset_value'];  

update_option('tmscript_feed', $feed);
update_option('tmscript_lc', $lc);
update_option('tmscript_script_url', $script_url);
update_option('tmscript_offset_value', $offset_value);
update_option('tmscript_offset_counter', 0);

echo "Updated!";

}

?> 
		<div class="wrap">
			<?php    echo "<h2>" . __( 'Tweet My Script', 'tweet_my_script' ) . "</h2>"; ?>
			
			<form name="tmscript_options_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="tmscript_options_hidden" value="Y">
				<?php    echo "<h4>" . __( 'Tweet My Script Options', 'tweet_my_script' ) . "</h4>"; ?>
				<p><?php _e("Twitter Feed: " ); ?><input type="text" name="tmscript_feed" value="<?php echo get_option('tmscript_feed'); ?>" size="20"></p>
				<p><?php _e("Launch Code: " ); ?><input type="text" name="tmscript_lc" value="<?php echo get_option('tmscript_lc'); ?>" size="20"></p>
				<p><?php _e("Script URL: " ); ?><input type="text" name="tmscript_script_url" value="<?php echo get_option('tmscript_script_url'); ?>" size="20"></p>
				
				<?php
				
				if(get_option('tmscript_offset_value') == "")
				{
				$display_offset = 0;
				}
				else
				{
				$display_offset = get_option('tmscript_offset_value');
				}
				
				?>
				
				<p><?php _e("Run Offset: " ); ?><input type="text" name="tmscript_offset_value" value="<?php echo $display_offset; ?>" size="20"></p>
				<?php 
				echo "<b>Twitter API Remaining Count: </b>";
				echo tmscript_get_twitter_remaining_count();
				echo "/150<br>";
				?>
				<hr />
				<p class="submit">
				<input type="submit" name="Submit" value="<?php _e('Update Options', 'tweet_my_script' ) ?>" />
				</p>
			</form>	
		</div>
<?php


?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="EUQJVAKZAJFCJ">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<br>