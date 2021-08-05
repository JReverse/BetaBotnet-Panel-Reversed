<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("IN_CORE_INC", 1);
require_once "include/sql.inc";
define("IN_SETUP_FORM", 1);
define("SETTINGS_FILE_NAME", "settings.php");
if (file_exists(SETTINGS_FILE_NAME) == true && 64 < filesize(SETTINGS_FILE_NAME)) {
    require_once SETTINGS_FILE_NAME;
    $t_check_link = mysql_connect(SQL_SERVER . ":" . SQL_PORT, SQL_USERNAME, SQL_PASSWORD);
    if (!$t_check_link) {
        exit("&nbsp;Unable to connect to database. If you need to correct database name / login details, you can edit settings.php directly.<br /><br />Last error: " . mysql_error());
    }
    mysql_select_db(SQL_DATABASE);
    if (0 < @mysql_num_rows(@mysql_query("SELECT * FROM settings LIMIT 1"))) {
        exit("&nbsp;Panel already appears to be setup. You should probably delete this file.");
    }
    @mysql_close($t_check_link);
}
$setup_proceed = false;
$setup_worked = false;
$err_notify = "";
$err_notify_type = "error";
$t_db_user = "";
$t_db_pass = "";
$t_db_name = "";
$t_db_host = "localhost";
$t_db_port = 3306;
$t_link = NULL;
$sql_pass_salt = mt_rand(10000, 9999999) . mt_rand(10000, 9999999);
$t_is_finish = false;
if (isset($_POST["setup_install"])) {
    $setup_proceed = true;
}
$tor_ips_added = 0;
$should_add_torips = false;
if ($setup_proceed == true) {
    if (!isset($_POST["setup_db_name"]) || !isset($_POST["setup_db_user"]) || !isset($_POST["setup_db_pass"]) || !isset($_POST["setup_admin_user"]) || !isset($_POST["setup_admin_pass"]) || !isset($_POST["setup_panel_key1"]) || !isset($_POST["setup_panel_key2"])) {
        $err_notify = "You did not fill in a required field. Please specify all database and initial user information. (#1)";
    } else {
        if (!@strlen($_POST["setup_db_name"]) || !@strlen($_POST["setup_db_user"]) || !@strlen($_POST["setup_db_pass"]) || !@strlen($_POST["setup_admin_user"]) || !@strlen($_POST["setup_admin_pass"]) || @strlen($_POST["setup_panel_key1"]) != 16 || @strlen($_POST["setup_panel_key2"]) != 16) {
            $err_notify = "You did not fill in a required field. Please specify all database and initial user information. (#2)";
        } else {
            if (isset($_POST["setup_load_geoip"]) && (!isset($_POST["setup_db_geoipfile"]) || @strlen($_POST["setup_db_geoipfile"]) == 0)) {
                $err_notify = "You specified to load the GeoIP data but provided no file.";
            } else {
                $t_db_user = $_POST["setup_db_user"];
                $t_db_pass = $_POST["setup_db_pass"];
                $t_db_name = $_POST["setup_db_name"];
                if (isset($_POST["setup_finish"]) || !isset($_POST["setup_finish"]) && _obfuscated_0D40273302021C300B150211192E3B1228382E3F3C3001_($sql_pass_salt, $t_db_name, $t_db_user, $t_db_pass, $t_db_host, $t_db_port, $_POST["setup_panel_key1"], $_POST["setup_panel_key2"]) == true) {
                    $db_hostport = $t_db_host . ":" . $t_db_port;
                    $t_link = mysql_connect($db_hostport, $t_db_user, $t_db_pass);
                    if ($t_link) {
                        if (isset($_POST["setup_create_db_if"]) && !isset($_POST["setup_finish"])) {
                            mysql_query("CREATE DATABASE IF NOT EXISTS " . $t_db_name);
                        }
                        if (@mysql_select_db($t_db_name)) {
                            if (file_exists("setup.sql")) {
                                $mq_result = NULL;
                                if (isset($_POST["setup_finish"]) || _obfuscated_0D1108050C23231E353B060405123501103D173D091D22_("setup.sql") == true) {
                                    mysql_close($t_link);
                                    $t_link = mysql_connect($db_hostport, $t_db_user, $t_db_pass);
                                    mysql_select_db($t_db_name);
                                    if (isset($_POST["setup_finish"]) || _obfuscated_0D2A191A111712070E0E0B29163B3734251834073B1532_($sql_pass_salt, $_POST["setup_admin_user"], $_POST["setup_admin_pass"])) {
                                        if (isset($_POST["setup_finish"])) {
                                            if (_obfuscated_0D3012271134022219323F0B110F17302D5C2A3B261E11_()) {
                                                if (isset($_POST["setup_load_torblacklist"])) {
                                                    $should_add_torips = true;
                                                    $tor_ips_added = (int) _obfuscated_0D3D28253C303C0A085B01342B07350A401A1B3D2F3F32_();
                                                }
                                                if (isset($_POST["setup_load_geoip"])) {
                                                    $fcn = fopen($_POST["setup_db_geoipfile"], "r");
                                                    if ($fcn) {
                                                        while ($csventry = fgetcsv($fcn, 1024, ",", "\"")) {
                                                            $sql = "INSERT INTO geoip VALUES('" . $csventry[0] . "', '" . $csventry[1] . "', '" . $csventry[2] . "', '" . $csventry[3] . "', '" . $csventry[4] . "', '" . $csventry[5] . "')";
                                                            mysql_query($sql);
                                                        }
                                                        fclose($fcn);
                                                        $err_notify = "Setup finished. Delete setup.php and setup.sql from panel directory!";
                                                        $err_notify_type = "success";
                                                        $setup_worked = true;
                                                        if ($should_add_torips == true && $tor_ips_added == 0) {
                                                            $err_notify .= "<br />Note: It appears no TOR ips were added to database.";
                                                        }
                                                    } else {
                                                        $err_notify = "Unable to open GeoIP CSV file.";
                                                    }
                                                } else {
                                                    $err_notify = "Setup finished.";
                                                    $err_notify_type = "success";
                                                    $setup_worked = true;
                                                    if ($should_add_torips == true && $tor_ips_added == 0) {
                                                        $err_notify .= "<br />Note: It appears no TOR ips were added to database.";
                                                    }
                                                }
                                            } else {
                                                $err_notify = "Failed to add initial panel settings.<br /><strong>SQL Error:</strong> " . @mysql_error();
                                            }
                                        } else {
                                            $t_is_finish = true;
                                            $err_notify_type = "info";
                                            $err_notify = "Setup almost finished. Please click 'Finish installation' to wrap it up.";
                                        }
                                    } else {
                                        $err_notify = "Failed to add initial panel user.<br /><strong>SQL Error:</strong> " . @mysql_error();
                                    }
                                } else {
                                    $err_notify = "One or more queries from setup.sql failed.<br /><strong>SQL Error:</strong> " . @mysql_error();
                                }
                            } else {
                                $err_notify = "setup.sql does not appear to exist. Required to create database structure.";
                            }
                        } else {
                            $err_notify = "Unable to create and/or select specified database: '" . $t_db_name . "'<br /><strong>SQL Error:</strong> " . @mysql_error();
                        }
                    } else {
                        $err_notify = "Unable to connect to database with specified login details.";
                    }
                } else {
                    $err_notify = "Unable to create/write to settings file. Proper CHMOD on main directory may be necessary";
                }
            }
        }
    }
    if ($setup_worked == false) {
    }
}
echo "\n<!DOCTYPE html>\n<html lang=\"en\">\n  <head>\n    <meta charset=\"utf-8\">\n    <title></title>\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <meta name=\"description\" content=\"\">\n    <meta name=\"author\" content=\"\">\n\n    <!-- Le styles -->\n    <link href=\"css/bootstrap.css\" rel=\"stylesheet\">\n    <style>\n      body {\n        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */\n      }\n    </style>\n    <link href=\"css/bootstrap-responsive.css\" rel=\"stylesheet\">\n\n    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->\n    <!--[if lt IE 9]>\n      <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\n    <![endif]-->\n\n    <!-- Le fav and touch icons -->\n    <link rel=\"shortcut icon\" href=\"../ico/favicon.ico\">\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"../ico/apple-touch-icon-144-precomposed.png\">\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"../ico/apple-touch-icon-114-precomposed.png\">\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"../ico/apple-touch-icon-72-precomposed.png\">\n    <link rel=\"apple-touch-icon-precomposed\" href=\"../ico/apple-touch-icon-57-precomposed.png\">\n  </head>\n\n  <body>\n\t";
$file_ptr = @fopen("exports/test.txt", "w");
if ($file_ptr == NULL) {
    echo "<center><div class=\"alert alert-error\" style=\"width: 560px;\"><a class=\"close\" data-dismiss=\"alert\">x</a>It appears the panel does not have write access to the /exports/ folder. Please CHMOD said folder to allow the panel files to write data to this folder.</div></center>";
} else {
    @fclose($file_ptr);
    unlink("exports/test.txt");
}
if (strlen($err_notify)) {
    echo "<center><div class=\"alert alert-" . $err_notify_type . "\" style=\"width: 560px;\">";
    echo "<a class=\"close\" data-dismiss=\"alert\">x</a>";
    echo $err_notify;
    echo "</div></center>";
}
if ($setup_worked == false) {
    echo "\t<div style=\"margin: auto; margin-top: 3%; width: 480px;\">\n\t<table>\n\t\t<thead>\n\t\t\t<th width=\"250\"></th>\n\t\t\t<th width=\"150\"></td>\n\t\t</thead>\n\t\t<tbody>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<form name=\"setup\" method=\"post\" action=\"";
    echo $_SERVER["SCRIPT_NAME"];
    echo "\">\n\t\t\t\t\t\t<label>Database name:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_db_name\" value=\"";
    echo $t_db_name;
    echo "\">\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"setup_create_db_if\" value=\"yes\" checked> &nbsp;Create database if it does not exist\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<label>Database user:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_db_user\" value=\"";
    echo $t_db_user;
    echo "\">\n\t\t\t\t\t\t<label>Database user password:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_db_pass\" value=\"";
    echo $t_db_pass;
    echo "\">\n\t\t\t\t\t\t<label>GeoIP Data CSV filename:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_db_geoipfile\" value=\"geoip.csv\">\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t";
    $submit_face = "Install";
    if ($t_is_finish == true) {
        $submit_face = "Finish installation ...";
        echo "<input type=\"hidden\" name=\"setup_finish\" value=\"yes\">\r\n";
    }
    echo "\t\t\t\t\t\t<input type=\"checkbox\" name=\"setup_load_geoip\" value=\"yes\"> &nbsp;Load GeoIP data\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"setup_load_torblacklist\" value=\"yes\" checked> &nbsp;Load TOR Blacklist (This may cause a 1-2 min script exec. delay)\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<div>\n\t\t\t\t\t\t\t<button class=\"btn\" style=\"font-size: 12px; face: font-family: Tahoma\" name=\"setup_install\">";
    echo $submit_face;
    echo "</button>\n\t\t\t\t\t\t</div>\n\t\t\t\t</td>\n\t\t\t\t<td valign=\"top\">\n\t\t\t\t\t\t<label>Admin username:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_admin_user\" value=\"";
    echo isset($_POST["setup_admin_user"]) ? $_POST["setup_admin_user"] : "";
    echo "\">\n\t\t\t\t\t\t<label>Admin password:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_admin_pass\" value=\"";
    echo isset($_POST["setup_admin_pass"]) ? $_POST["setup_admin_pass"] : "";
    echo "\">\n\t\t\t\t\t\t<label>Comm. Encryption key 1:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_panel_key1\" value=\"";
    echo isset($_POST["setup_panel_key1"]) ? $_POST["setup_panel_key1"] : "";
    echo "\">\n\t\t\t\t\t\t<label>Comm. Encryption key 2:</label>\n\t\t\t\t\t\t<input type=\"text\" name=\"setup_panel_key2\" value=\"";
    echo isset($_POST["setup_panel_key2"]) ? $_POST["setup_panel_key2"] : "";
    echo "\">\n\t\t\t\t\t\t</form>\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</tbody>\n\t</table>\n\t</div>\n\t\n\t<br />\n\t&nbsp;&nbsp;&nbsp;&nbsp;<strong>Important notes:</strong>\n\t<br />\n\t&nbsp;&nbsp;&nbsp;&nbsp;1. If loading GeoIP CSV file, script maximum execution time should be at least 120~ seconds. Depending on the server, it can take a minute or two to fully load the data into the database, so do not sit around clicking refresh.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>It is recommended you import CSV database via phpMyAdmin</strong>\n\t<br />\n\t&nbsp;&nbsp;&nbsp;&nbsp;2. Once setup is finished and you can login, tweak panel settings first before you start utilizing the software.\n\t<br />\n\t\n\t";
}
echo "\n    <!-- Le javascript\n    ================================================== -->\n    <!-- Placed at the end of the document so the pages load faster -->\n    <script src=\"js/jquery.js\"></script>\n    <script src=\"js/bootstrap-transition.js\"></script>\n    <script src=\"js/bootstrap-alert.js\"></script>\n    <script src=\"js/bootstrap-modal.js\"></script>\n    <script src=\"js/bootstrap-dropdown.js\"></script>\n    <script src=\"js/bootstrap-scrollspy.js\"></script>\n    <script src=\"js/bootstrap-tab.js\"></script>\n    <script src=\"js/bootstrap-tooltip.js\"></script>\n    <script src=\"js/bootstrap-popover.js\"></script>\n    <script src=\"js/bootstrap-button.js\"></script>\n    <script src=\"js/bootstrap-collapse.js\"></script>\n    <script src=\"js/bootstrap-carousel.js\"></script>\n    <script src=\"js/bootstrap-typeahead.js\"></script>\n\n  </body>\n</html>";
function _obfuscated_0D1D2311361C34383C1D24031C29310F142A1E27353322_($itext = "")
{
    if (strlen($itext) != 16) {
        return "";
    }
    if (!@ctype_alnum($itext)) {
        return "";
    }
    $_obfuscated_0D04022D40265C0A2F2D2E2F3235061A093916253F2232_ = "";
    $i = 0;
    while ($i < 16) {
        $_obfuscated_0D04022D40265C0A2F2D2E2F3235061A093916253F2232_ .= "\\x" . substr($itext, $i, 2);
        $i += 2;
    }
    return $_obfuscated_0D04022D40265C0A2F2D2E2F3235061A093916253F2232_;
}
function _obfuscated_0D40273302021C300B150211192E3B1228382E3F3C3001_($sql_salt, $db_name, $db_user, $db_pass, $db_host, $db_port, $cryptcode1, $cryptcode2)
{
    $_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_ = fopen(SETTINGS_FILE_NAME, "w");
    $cryptcode1 = _obfuscated_0D1D2311361C34383C1D24031C29310F142A1E27353322_($cryptcode1);
    $cryptcode2 = _obfuscated_0D1D2311361C34383C1D24031C29310F142A1E27353322_($cryptcode2);
    if ($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_) {
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "<?php\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "// INSTALL-GENERATED FILE\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "// DO NOT EDIT THIS FILE UNLESS YOU KNOW WHAT YOU ARE DOING\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "if ( !defined(\"IN_SETUP_FORM\") && !defined(\"IN_CORE_INC\") )\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "\tdie();\r\n\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"IN_SETTINGS\", 1);\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_USERNAME\",      \"" . $db_user . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_PASSWORD\",      \"" . $db_pass . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_DATABASE\",      \"" . $db_name . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_SERVER\",        \"" . $db_host . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_PORT\",           " . $db_port . ");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"SQL_PASSWORD_SALT\", \"" . $sql_salt . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"PANEL_CRYPT_CODE1\", \"" . $cryptcode1 . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "DEFINE(\"PANEL_CRYPT_CODE2\", \"" . $cryptcode2 . "\");\r\n");
        @fwrite($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_, "?>\r\n");
        @fclose($_obfuscated_0D09352F3729211134051D273802251E093001173B5C32_);
        return true;
    }
    return false;
}
function _obfuscated_0D1108050C23231E353B060405123501103D173D091D22_($sqlfilename)
{
    $_obfuscated_0D1C0325155C5C09150E2B022D262A092C02233B331422_ = file_get_contents($sqlfilename);
    if (0 < strlen($_obfuscated_0D1C0325155C5C09150E2B022D262A092C02233B331422_)) {
        $_obfuscated_0D350D11161C222D1311331B26162D242E182F3D3F1D01_ = explode(";", $_obfuscated_0D1C0325155C5C09150E2B022D262A092C02233B331422_);
        foreach ($_obfuscated_0D350D11161C222D1311331B26162D242E182F3D3F1D01_ as $_obfuscated_0D0130323C1F1B390D29375B23231C38161425320B3111_) {
            if (3 < strlen($_obfuscated_0D0130323C1F1B390D29375B23231C38161425320B3111_) && !mysql_query($_obfuscated_0D0130323C1F1B390D29375B23231C38161425320B3111_)) {
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}
function _obfuscated_0D3D28253C303C0A085B01342B07350A401A1B3D2F3F32_()
{
    $_obfuscated_0D0E0A352A0D0430011B0F09340129072E1014092B0A22_ = file_get_contents("utility/tor_ips.txt");
    $_obfuscated_0D0A1E3D3B19081D06130D08130E29192F340533301E22_ = 0;
    if ($_obfuscated_0D0E0A352A0D0430011B0F09340129072E1014092B0A22_ && 2048 < strlen($_obfuscated_0D0E0A352A0D0430011B0F09340129072E1014092B0A22_)) {
        $_obfuscated_0D022612241D1C312B1C331724115B24332F2805312301_ = explode("\n", $_obfuscated_0D0E0A352A0D0430011B0F09340129072E1014092B0A22_);
        if ($_obfuscated_0D022612241D1C312B1C331724115B24332F2805312301_) {
            global $sqlDefault;
            $_obfuscated_0D173D101B2B1B2D062D10255C2826021D5C331E0B2F11_ = 0;
            mysql_query("TRUNCATE TABLE tor_ips");
            foreach ($_obfuscated_0D022612241D1C312B1C331724115B24332F2805312301_ as $_obfuscated_0D06240C0E30142F240C3D09335B051F11101F151E3122_) {
                $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_ = str_replace("\r", "", $_obfuscated_0D06240C0E30142F240C3D09335B051F11101F151E3122_);
                $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_ = str_replace("\n", "", $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_);
                $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_ = str_replace("\t", "", $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_);
                $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_ = str_replace(" ", "", $_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_);
                $_obfuscated_0D173D101B2B1B2D062D10255C2826021D5C331E0B2F11_ = 0;
                if (ip2long($_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_) != 0) {
                    $_obfuscated_0D2E3B3635321A391C3D2B2C1C2306240B281E2E0C0C22_ = sprintf("%u", ip2long($_obfuscated_0D320828182A5B33231A5B272E36325B0F190D33112B32_));
                    if (mysql_query("INSERT INTO tor_ips VALUES('" . $_obfuscated_0D2E3B3635321A391C3D2B2C1C2306240B281E2E0C0C22_ . "', '0')")) {
                        $_obfuscated_0D0A1E3D3B19081D06130D08130E29192F340533301E22_++;
                        if (250 <= $_obfuscated_0D173D101B2B1B2D062D10255C2826021D5C331E0B2F11_++) {
                            $_obfuscated_0D173D101B2B1B2D062D10255C2826021D5C331E0B2F11_ = 0;
                        }
                    }
                }
            }
            return $_obfuscated_0D0A1E3D3B19081D06130D08130E29192F340533301E22_;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
function _obfuscated_0D2A191A111712070E0E0B29163B3734251834073B1532_($sqlsalt, $username, $password)
{
    $_obfuscated_0D080A1D2C3C06302933171228161A31033C1E170B1601_ = sha1($sqlsalt . $password);
    $username = mysql_real_escape_string($username);
    return mysql_query("INSERT INTO admins VALUES(NULL, '" . $username . "', '" . $_obfuscated_0D080A1D2C3C06302933171228161A31033C1E170B1601_ . "', '" . USER_PRIVILEGES_ALL . "', '0', '0', 'sortie_status', 'ASC', '25')");
}
function _obfuscated_0D3012271134022219323F0B110F17302D5C2A3B261E11_()
{
    return mysql_query("INSERT INTO settings VALUES('bbset', '1.8.0.11', 'MyNet', 'english', '', '', UNIX_TIMESTAMP(NOW()), '7', '10', '0', '176', '0', '3', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '', '0', '0', '', '0', '', '0', '')");
}

?>