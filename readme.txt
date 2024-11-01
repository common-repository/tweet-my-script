=== Tweet My Script ===
Contributors: Matt Kendrick
Tags: twitter, automation, reporting, script
Plugin URI: http://mattkendrick.com/?p=1496
Donate link: http://mattkendrick.com/?p=1496
Requires at least: 2.6
Tested up to: 2.9
Stable tag: 0.75

This plugin watches your Twitter RSS Feed for user-defined "launch codes" to trigger user-defined script URLs.

== Description ==

Have you ever needed a script or task run on your blog and you were not near a computer with internet 
access? Well look no further than "Tweet My Script." This plugin allows you to simply use your cell-phone
to text a short tweet to Twitter with a "launch code." When someone accesses your Word Press blog,
Tweet My Script will check to see if you've left any new launch codes to activate. After each successful launch,
the plugin records the previous tweet. This insures that the script being launched will only be launched once, 
unless the launch code is used again in a new tweet. This plugin can be used to launch any public accessible script. 

== Installation ==

1. Upload `tweet_my_script.php` and `tweet_my_script_options.php` to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Configure plugin settings from the dashboard settings option `Tweet My Script`

== Changelog ==

= 0.5 =

* First version released

= 0.75 =

* Offset feature added. Allows for bloggers to set an offset on the number of times your blog checks Twitter to 
keep from exceeding API limits. This is ideal for blogs with high traffic or blogs hosted on high traffic 
shared hosting. Default offset is set to 0.

