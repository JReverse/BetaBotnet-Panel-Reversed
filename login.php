<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("IN_LOGIN_FORM", 1);
require "include/core.inc";
define("LOGIN_NO_FORM", 0);
define("LOGIN_SUCCESSFUL", 1);
define("LOGIN_FAILED", 2);
define("LOGIN_NEEDS_DATA", 3);
$sqlLoginAttempts = new CLoginTries();
$sqlLoginAttempts->SetInternalLink($main_sql_link);
$login_ok = LOGIN_NO_FORM;
$login_invalid_characters = false;
$login_attempts = $sqlLoginAttempts->CountTriesWithin10();
$sqlPanelSettings = new CPanelSettings();
$sqlPanelSettings->SetInternalLink($main_sql_link);
$sqlPanelSettings->GetSettings(true);
if (isset($sqlPanelSettings->SecureCode) && 0 < strlen($sqlPanelSettings->SecureCode) && (!isset($_GET["sc"]) || $_GET["sc"] != $sqlPanelSettings->SecureCode)) {
    header("HTTP/1.0 404 Not Found");
    exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
}
if (isset($_POST["username"]) && $sqlBlacklist->CheckStringForAttackString($_POST["username"]) == true) {
    $sqlBlacklist->AddBlacklistedIP(ip2long($_SERVER["REMOTE_ADDR"]), BLACKLIST_REASON_SQLI);
    header("HTTP/1.0 404 Not Found");
    exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
}
if (isset($_POST["password"]) && $sqlBlacklist->CheckStringForAttackString($_POST["password"]) == true) {
    $sqlBlacklist->AddBlacklistedIP(ip2long($_SERVER["REMOTE_ADDR"]), BLACKLIST_REASON_SQLI);
    header("HTTP/1.0 404 Not Found");
    exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
}
if ($login_attempts < SESSION_ETC_MAX_FAILED_LOGINS) {
    $sqlLoginAttempts->ClearOldEntries();
    if ($Session->Exists() == true && $Session->ValidateSessionLoginInformation() == true) {
        header("Location: index.php?ref=lg");
        exit;
    }
    if (isset($_POST["login_b"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        if (strlen($_POST["username"]) == 0 || strlen($_POST["password"]) == 0) {
            $login_ok = LOGIN_NEEDS_DATA;
        } else {
            if (!strstr($_POST["username"], "'") && !strstr($_POST["username"], ";") && !strstr($_POST["username"], "\"")) {
                $usern = $_POST["username"];
                $passw = $_POST["password"];
                if (isset($_POST["kmart"]) && $_POST["kmart"] == $usern) {
                    if ($Session->CreateNewSession($usern, $passw, true) == true) {
                        $Session->Set(SESSION_INFO_FAILED_LOGIN_ATTEMPTS, 0);
                        $login_attempts = 0;
                        $login_ok = LOGIN_SUCCESSFUL;
                        $sqlLoginAttempts->DeleteByIP(@ip2long($_SERVER["REMOTE_ADDR"]));
                        $elogs = new CLogs();
                        $elogs->SetInternalLink($main_sql_link);
                        $elogs->AddEvent($usern, EVENT_TYPE_LOGIN, "");
                    } else {
                        $Session->Set(SESSION_INFO_FAILED_LOGIN_ATTEMPTS, (int) $login_attempts + 1);
                        $login_ok = LOGIN_FAILED;
                        $sqlPanelSettings->Update_FailedLogins();
                        $sqlLoginAttempts->AddAttempt(@ip2long($_SERVER["REMOTE_ADDR"]));
                    }
                } else {
                    $login_ok = LOGIN_FAILED;
                    $Session->Set(SESSION_INFO_FAILED_LOGIN_ATTEMPTS, (int) $login_attempts + 1);
                    $sqlLoginAttempts->AddAttempt(@ip2long($_SERVER["REMOTE_ADDR"]));
                }
            } else {
                $login_invalid_characters = true;
                $login_ok = LOGIN_FAILED;
            }
        }
    }
}
echo "\r\n";
if ($login_ok == LOGIN_SUCCESSFUL || $Session->IsLoggedIn() == true) {
    echo "<html>\r\n<head></head>\r\n<body>\r\n<script>\r\n\tdocument.location = '";
    echo PAGE_INDEX;
    echo "';\r\n</script>\r\n</body>\r\n</html>\r\n";
    exit;
}
echo "\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n  <head>\r\n    <meta charset=\"utf-8\">\r\n    <title></title>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"\">\r\n    <meta name=\"author\" content=\"\">\r\n\r\n    <!-- Le styles -->\r\n    <link href=\"css/bootstrap.css\" rel=\"stylesheet\">\r\n    <style>\r\n      body {\r\n        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */\r\n      }\r\n    </style>\r\n    <link href=\"css/bootstrap-responsive.css\" rel=\"stylesheet\">\r\n\r\n    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->\r\n    <!--[if lt IE 9]>\r\n      <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n\r\n    <!-- Le fav and touch icons -->\r\n    <link rel=\"shortcut icon\" href=\"../ico/favicon.ico\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"../ico/apple-touch-icon-144-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"../ico/apple-touch-icon-114-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"../ico/apple-touch-icon-72-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" href=\"../ico/apple-touch-icon-57-precomposed.png\">\r\n  </head>\r\n\r\n  <body>\r\n\t<div style=\"margin: auto; margin-top: ";
echo $login_ok == LOGIN_FAILED || SESSION_ETC_MAX_FAILED_LOGINS <= $login_attempts ? "8" : "14";
echo "%; width: 280px;\">\r\n\t\t";
if ($login_attempts < SESSION_ETC_MAX_FAILED_LOGINS) {
    echo "\t\t<div class=\"well\">\r\n\t\t<label class=\"label\"><center>myBlog Content Manager</center></label>\r\n\t\t<br />\r\n\t\t\r\n\t\t<script>\r\n\t\t\tfunction changePass() {\r\n\t\t\t\tif ( document.login.option_unmask.value == '1' ) {\r\n\t\t\t\t\tdocument.login.password.type = 'text';\r\n\t\t\t\t\tdocument.login.option_unmask.value = '0';\r\n\t\t\t\t} else {\r\n\t\t\t\t\tdocument.login.password.type = 'password';\r\n\t\t\t\t\tdocument.login.option_unmask.value = '1';\r\n\t\t\t\t}\r\n\t\t\t}\r\n\t\t</script>\r\n\t\t\r\n\t\t<form name=\"login\" method=\"post\" action=\"";
    echo $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"];
    echo "\">\r\n\t\t\t<label for=\"username\" style=\"font-size: 12px; face: font-family: Tahoma;\">Username:</label>\r\n\t\t\t<input type=\"text\" name=\"username\" id=\"yoyoma\" value=\"\" style=\"font-size: 12px; face: font-family: Tahoma; width: 230px;\">\r\n\t\t\t<label for=\"password\" style=\"font-size: 12px; face: font-family: Tahoma;\">Password:</label>\r\n\t\t\t<input type=\"password\" name=\"password\" style=\"font-size: 12px; face: font-family: Tahoma; width: 230px;\">\r\n\t\t\t<input type=\"hidden\" name=\"kmart\" id=\"kmart\" value=\"\">\r\n\t\t\t<div>\r\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 12px; face: font-family: Tahoma; position: relative; top: 10px; width: 111px;\">\r\n\t\t\t\t\t<input type=\"checkbox\" name=\"option_unmask\" value=\"1\" style=\"position: relative; top: -3px;\" onchange=\"changePass()\">\r\n\t\t\t\t\tShow password\r\n\t\t\t\t</label>\r\n\t\t\t\t<button class=\"btn\" style=\"font-size: 12px; face: font-family: Tahoma; width: 65px; position: relative; left: 174px; top: -20px;\" name=\"login_b\" onclick=\"nou()\">Login</button>\r\n\t\t\t</div>\r\n\t\t</form>\r\n\t\t";
    if ($login_ok == LOGIN_FAILED && $login_attempts < SESSION_ETC_MAX_FAILED_LOGINS) {
        $err_msg = "Login failed! Please try again. (#" . $Session->Get(SESSION_INFO_FAILED_LOGIN_ATTEMPTS) . ")";
        if ($login_invalid_characters == true) {
            $err_msg = "Invalid characters specified in input.";
        } else {
            if (SESSION_ETC_MAX_FAILED_LOGINS <= $login_attempts) {
                $err_msg = "Leave me alone!";
            }
        }
        echo "<font style=\"font-size: 12px; face: font-family: Tahoma;\" color=\"#E80000\">" . $err_msg . "</font><br /><br />\r\n";
        echo "<img src=\"img/bp/5.jpg\"><br />";
    } else {
        if ($login_ok == LOGIN_NEEDS_DATA) {
            echo "<font style=\"font-size: 12px; face: font-family: Tahoma;\" color=\"#E80000\">You did not provide a username and/or password. Please enter valid login information and try again.</font><br /><br />\r\n";
        }
    }
    echo "\t\t</div>\r\n  \t\t<script type=\"text/javascript\">function nou(){document.getElementById('kmart').value=document.getElementById('yoyoma').value;}</script>\r\n\t\t";
} else {
    $Session->Set(SESSION_INFO_FAILED_LOGIN_ATTEMPTS, 0);
    echo "<img src=\"img/bp/5.jpg\"><br /><font color=\"#E80000\">You have entered too many invalid login combinations within a short period of time. Please wait 10-15 minutes and try again.</font><br /><br />\r\n";
}
echo "\t</div>\r\n\r\n\r\n    <!-- Le javascript\r\n    ================================================== -->\r\n    <!-- Placed at the end of the document so the pages load faster -->\r\n    <script src=\"js/jquery.js\"></script>\r\n    <script src=\"js/bootstrap-transition.js\"></script>\r\n    <script src=\"js/bootstrap-alert.js\"></script>\r\n    <script src=\"js/bootstrap-modal.js\"></script>\r\n    <script src=\"js/bootstrap-dropdown.js\"></script>\r\n    <script src=\"js/bootstrap-scrollspy.js\"></script>\r\n    <script src=\"js/bootstrap-tab.js\"></script>\r\n    <script src=\"js/bootstrap-tooltip.js\"></script>\r\n    <script src=\"js/bootstrap-popover.js\"></script>\r\n    <script src=\"js/bootstrap-button.js\"></script>\r\n    <script src=\"js/bootstrap-collapse.js\"></script>\r\n    <script src=\"js/bootstrap-carousel.js\"></script>\r\n    <script src=\"js/bootstrap-typeahead.js\"></script>\r\n\r\n  </body>\r\n</html>";
function _obfuscated_0D3D3D100F1D0C1C340639142F262524320A0A285C1932_()
{
    $_obfuscated_0D14180E133C0F011A1315321C39092332263B04051101_ = mt_rand(0, 1);
    $_obfuscated_0D0F35293E2F240B3D390D221F051938053B3F1A1B5B11_ = "5";
    if ($_obfuscated_0D14180E133C0F011A1315321C39092332263B04051101_ == 1) {
        $_obfuscated_0D0F35293E2F240B3D390D221F051938053B3F1A1B5B11_ = "11";
    }
    return $_obfuscated_0D0F35293E2F240B3D390D221F051938053B3F1A1B5B11_;
}

?>