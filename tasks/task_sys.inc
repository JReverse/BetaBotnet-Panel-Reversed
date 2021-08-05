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
$task_system_runelevated = "";
if (!isset($_TASK_FILE_UI_ONLY)) {
    define("TASKS_PLUGIN_ERROR_COMMAND_REQUIRED", "A valid ANSI command string is required.");
    define("TASKS_PLUGIN_ERROR_COMMAND_INVALID", "Invalid command string specified. Must be ANSI only!");
    define("TASKS_PLUGIN_ERROR_COMMAND_TOO_LONG", "The command data you entered is too long. Please enter no more than 460 characters (ANSI).");
    define("TASKS_PLUGIN_ERROR_STRANGE_COMMAND", "What a strange command you have there.");
    if (!isset($_POST["cmd_system_command"]) || strlen($_POST["cmd_system_command"]) < 1) {
        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_PLUGIN_ERROR_COMMAND_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
    } else {
        $b_is_invalid = false;
        $url_array = @str_split($_POST["cmd_system_command"]);
        for ($i = 0; $i < strlen($_POST["cmd_system_command"]); $i++) {
            if (ord($url_array[$i]) < 32 || 168 < ord($url_array[$i])) {
                $b_is_invalid = true;
                break;
            }
        }
        if ($b_is_invalid == true) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_PLUGIN_ERROR_COMMAND_INVALID, true, MOD_TASKS_ALERT_WIDTH);
        } else {
            if (460 < strlen($_POST["cmd_system_command"])) {
                $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_PLUGIN_ERROR_COMMAND_TOO_LONG, true, MOD_TASKS_ALERT_WIDTH);
            } else {
                $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
                if (isset($_POST["cmd_check_runelevated"])) {
                    $e_cmd_switches .= COMMAND_SYSTEM_SWITCH_RUN_ELEVATED;
                }
                $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_SYSTEM_COMMAND;
                $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_SYSTEM, COMMAND_STRING_SYSTEM, $e_cmd_switches, $_POST["cmd_system_command"]);
            }
        }
    }
} else {
    if (0 < strlen($e_task_cmd_string)) {
        $task_system_splits = @explode(" ", $e_task_cmd_string);
        $task_system_edit__switches = $task_system_splits[1];
        $CmdBegin = strlen($task_system_splits[0]) + strlen($task_system_splits[1]) + 2;
        $task_system_edit__command = substr($e_task_cmd_string, $CmdBegin, strlen($e_task_cmd_string) - $CmdBegin);
    } else {
        $task_system_edit__switches = "";
        $task_system_edit__command = isset($_POST["cmd_system_command"]) ? $_POST["cmd_system_command"] : "";
    }
    if (isset($_POST["cmd_check_runelevated"]) || strstr($task_system_edit__switches, COMMAND_SYSTEM_SWITCH_RUN_ELEVATED)) {
        $task_system_runelevated = "checked";
    }
    echo "\t\t\t\t\n\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("System shell (cmd.exe) Command", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"plugin\">\n\t\t\t\t<table>\n\t\t\t\t\t<tbody>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<br /><br />\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -24px;\">Command data: &nbsp;&nbsp;&nbsp;</span>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\n\t\t\t\t\t\t\t\t<div style=\"position: relative; top: 12px;\">\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_system_command\" value=\"";
    echo $task_system_edit__command;
    echo "\" style=\"position: relative; top: -1px; width: 900px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
    echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
    echo "\">\n\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 170px;\">\n\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_check_runelevated\" value=\"yes\" style=\"position: relative; top: -2px\" ";
    echo $task_system_runelevated;
    echo ">\n\t\t\t\t\t\t\t\t\tRun command prompt as admin\n\t\t\t\t\t\t\t\t\t</label>\n\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</tbody>\n\t\t\t\t</table>\n\t\t\t  \n\t\t\t  <br />\n\t\t\t  <br />\n\t\t\t  \n\t\t\t\t<div style=\"font-size: 11px; face: font-family: Tahoma; position: relative; left: 97px;\">\n\t\t\t\t  <div class=\"accordion\" id=\"accordion2\">\n\t\t\t\t\t<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">\n\t\t\t\t\tClick here for examples of useful commands\n\t\t\t\t\t</a>\n\t\t\t\t  </div>\n\t\t\t\t  <div id=\"collapseOne\" class=\"accordion-body collapse\" style=\"height: 0px;\">\n\t\t\t\t\t<fieldset>\n\t\t\t\t\t  <div class=\"control-group\">\n\t\t\t\t\t\t<div class=\"controls\">\n\t\t\t\t\t\t<table>\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td style=\"width: 150px;\"><strong>shutdown.exe /r</strong></td>\n\t\t\t\t\t\t\t\t<td>Restart the computer</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td style=\"width: 150px;\"><strong>net stop <i>service-name</i></strong></td>\n\t\t\t\t\t\t\t\t<td>Stop a service (Such as \"WinDefend\", so: <i>net stop WinDefend</i>)</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td style=\"width: 150px;\"><strong>del \"c:\\*.txt\"</strong></td>\n\t\t\t\t\t\t\t\t<td>Delete all TXT files in c:\\</td>\n\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\tPlease consult Google search for more commands and/or Windows programs that support command line parameters\n\t\t\t\t\t\t</div>\n\t\t\t\t\t  </div>\n\t\t\t\t   </fieldset>\n\t\t\t\t  </div>\n\t\t\t\t</div>\n\t\t\t  ";
}

?>