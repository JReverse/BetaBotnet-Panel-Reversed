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
define("SETTINGS_MAIN_RECORD_ROW_NAME", "bbset");
define("DEFAULT_ABSENT_VERSION", "1.8.0.11");
define("DEFAULT_ABSENT_LANGUAGE", "english");
define("DEFAULT_ABSENT_LIMIT", 7);
define("DEFAULT_KNOCK_TIME", 10);
define("DEFAULT_FLAGS_GENERAL", 25);
define("DEFAULT_FLAGS_MINOR", 0);
define("DEFAULT_FLAGS_CUSTOM", 0);
define("DEFAULT_FLAGS_SECURITY", 25);
define("DEFAULT_FLAGS_BLOBS", 1 | 2 | 4);
define("GENERAL_OPTION_DISABLE_MAINPAGE_INDV_GRABS_STATS", 1);
define("GENERAL_OPTION_MAIN_PAGE_VIEW_MINIMUM_STATS", 2);
define("GENERAL_OPTION_MAIN_PAGE_NO_CHARTS", 4);
define("GENERAL_OPTION_SEND_UPDATE_TASK_ONLY_ON_CHECKIN", 8);
define("GENERAL_OPTION_GATE_DEBUG_OUTPUT_ENABLED", 16);
define("GENERAL_OPTION_FORM_PAGE_VIEW_MINIMUM_INFO", 32);
define("GENERAL_FLAGS_PROACTIVE_DEFENSE_ENABLED", 1);
define("GENERAL_FLAGS_FORMGRAB_DISABLED", 2);
define("GENERAL_FLAGS_DNS_MODIFY_DISABLED", 4);
define("GENERAL_FLAGS_USB_SPREAD_ENABLED", 8);
define("GENERAL_FLAGS_AGGRESSIVE_PROACTIVE_DEFENSE_ENABLED", 16);
define("GENERAL_FLAGS_DYNAMIC_CONFIG_DISABLED", 32);
define("GENERAL_FLAGS_LOGIN_GRAB_DISABLED", 64);
define("GENERAL_FLAGS_USERKIT_DISABLED", 128);
define("GENERAL_FLAGS_SYS_INJECTIONS_DISABLED", 256);
define("GENERAL_FLAGS_SYS_INJECTIONS_XBROWSER_DISABLED", 512);
define("GENERAL_FLAGS_ANTI_EXPLOIT_KIT_ENABLED", 1024);
define("GENERAL_FLAGS_ANTI_BOOTKIT_ENABLED", 2048);
define("GENERAL_FLAGS_FORCE_IE_ENABLED", 4096);
define("GENERAL_FLAGS_PRIVILEGE_ESCALATION_EXPLOITS_ENABLED", 8192);
define("GENERAL_FLAGS_PROACTIVE_MINER_DEFENSE_ENABLED", 16384);
define("GENERAL_FLAGS_PROACTIVE_LOCKER_DEFENSE_ENABLED", 32768);
define("GENERAL_FLAGS_PROACTIVE_ANTI_OLDER_BETABOT_ENABLED", 65536);
define("MINOR_FLAGS_DISABLE_IMAGE_EXECUTION_OPTIONS_FUNC", 1);
define("MINOR_FLAGS_DISABLE_UAC_FAKE_WINDOW", 2);
define("MINOR_FLAGS_DO_NOT_DISABLE_WINDOWS_SEC_SERVICES", 4);
define("MINOR_FLAGS_DISABLE_LUA", 8);
define("MINOR_FLAGS_DISABLE_AUTOUPDATES_ADDONS", 16);
define("MINOR_FLAGS_DISABLE_USERKIT_64BIT", 32);
define("MINOR_FLAGS_INSTALL_USE_HKLM_RUNONCE", 128);
define("MINOR_FLAGS_INSTALL_ENABLE_SHELL_FOLDER", 256);
define("MINOR_FLAGS_ENABLE_DEBUG_MSG_SYSTEM", 512);
define("MINOR_FLAGS_ENABLE_DEBUG_ATTRIBUTES", 1024);
define("MINOR_FLAGS_DEBUG_RESERVED_FOR_FUTURE_USE", 2048);
define("MINOR_FLAGS_FORMGRAB_FILTER_USELESS_GRABS", 4096);
define("MINOR_FLAGS_FORMGRAB_RESERVED_R1", 8192);
define("MINOR_FLAGS_FORMGRAB_RESERVED_R2", 16384);
define("MINOR_FLAGS_DISABLE_INJECT_INTO_LOADERS", 32768);
define("MINOR_FLAGS_INJECT_RESERVED_R1", 65536);
define("MINOR_FLAGS_INJECT_RESERVED_R2", 131072);
define("MINOR_FLAGS_DISABLE_SSL_CERTIFICATE_WARNINGS", 262144);
define("CUSTOM_FLAGS_DISABLE_WEB", 1);
define("CUSTOM_FLAGS_DISABLE_META_TAG_MODIFIER", 2);
define("CUSTOM_FLAGS_DISABLE_DOCTYPE_MODIFIER", 4);
define("CUSTOM_FLAGS_DISABLE_WEB_FOR_VM", 8);
define("CUSTOM_FLAGS_DISABLE_X_FRAME_OPTIONS_REMOVER", 16);
define("CUSTOM_FLAGS_INVALID_FLAGS", 4294967295.0);
define("INFOBLOB_FLAGS_NO_BLOBS_SPECIFIED", 0);
define("INFOBLOB_FLAGS_PROCESS_LIST", 1);
define("INFOBLOB_FLAGS_INSTALLED_SOFTWARE_LIST", 2);
define("INFOBLOB_FLAGS_AUTOSTART_LIST", 4);
define("INFOBLOB_FLAGS_GENERIC_INFO", 8);
define("INFOBLOB_FLAGS_DEBUG_INFO", 16);
define("INFOBLOB_FLAGS_INVALID_FLAGS", 4294967295.0);
define("SECURITY_FLAGS_BLACKLIST_ENABLED", 1);
define("SECURITY_FLAGS_BLACKLIST_PROACTIVE_ENABLED", 2);
define("SECURITY_FLAGS_PANEL_GATEWAY_DISABLED", 4);
define("SECURITY_FLAGS_PANEL_BLACKLIST_TOR", 8);
define("SECURITY_FLAGS_PANEL_IGNORE_COMMS_VM", 16);
define("NOTICE_OPTION_ALLOW_REMOVE", 1);
define("NOTICE_OPTION_VIEW_AS_RED", 2);
define("NOTICE_OPTION_DISPLAY_IMPORTANT_PAGES", 4);
define("FILTER_OPTIONS_STATE_DISABLED", 1);
class CPanelSettings extends CSqlWrap
{
    public $IsLoaded = false;
    public $Version = DEFAULT_ABSENT_VERSION;
    public $Name = "";
    public $Language = DEFAULT_ABSENT_LANGUAGE;
    public $SecureCode = "";
    public $CryptKey = "";
    public $Created = 0;
    public $AbsentLimit = DEFAULT_ABSENT_LIMIT;
    public $KnockInterval = DEFAULT_KNOCK_TIME;
    public $Flags_General = DEFAULT_FLAGS_GENERAL;
    public $Flags_Minor = DEFAULT_FLAGS_MINOR;
    public $Flags_Custom = DEFAULT_FLAGS_CUSTOM;
    public $Flags_Security = DEFAULT_FLAGS_SECURITY;
    public $Flags_Blobs = DEFAULT_FLAGS_BLOBS;
    public $DnsList_Version = 0;
    public $UrlTrack_Version = 0;
    public $DynamicConfig_Version = 0;
    public $FileSearch_Version = 0;
    public $Plugins_Version = 0;
    public $Web_Version = 0;
    public $FailedLogins = 0;
    public $AVCheck_API_ID = "";
    public $AVCheck_API_Token = "";
    public $AVCheck_LastResult = "";
    public $AVCheck_NumDetections = 0;
    public $AVCheck_LastScanDate = 0;
    public $ExConfig_Data = "";
    public $LogOptions = 0;
    public $LastTasksRevisionHash = "";
    public $General_Options = 0;
    public $Ignored_Locales = "";
    public function GetSettingsFromCache()
    {
        $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_ = new CMemoryCache();
        $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->Initialize();
        $_obfuscated_0D332428192A1C5B1B0C3E072B1F1914141D072D010311_ = $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->IsInitialized();
        if ($_obfuscated_0D332428192A1C5B1B0C3E072B1F1914141D072D010311_ == true) {
            $row = $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->Get(CACHE_PANEL_SETTINGS);
            if ($row != NULL && !isset($row["name"])) {
                $row = NULL;
            } else {
                if ($row != NULL) {
                    $this->IsLoaded = true;
                    $this->Version = DEFAULT_ABSENT_VERSION;
                    $this->Name = $row["name"];
                    $this->Language = $row["language"];
                    $this->SecureCode = $row["securecode"];
                    $this->CryptKey = $row["crypt_key"];
                    $this->Created = $row["created"];
                    $this->AbsentLimit = $row["absent_limit"];
                    $this->KnockInterval = $row["knock_interval"];
                    $this->Flags_General = $row["general_flags"];
                    $this->Flags_Security = $row["security_flags"];
                    $this->DnsList_Version = $row["dnslist_version"];
                    $this->UrlTrack_Version = $row["urltrack_version"];
                    $this->DynamicConfig_Version = $row["dynconfig_version"];
                    $this->FileSearch_Version = $row["filesearch_version"];
                    $this->Plugins_Version = $row["plugins_version"];
                    $this->Web_Version = $row["web_version"];
                    $this->FailedLogins = $row["peak_clients"];
                    if (!defined("IN_BOT_GATEWAY")) {
                        $this->AVCheck_API_ID = $row["avcheck_api_id"];
                        $this->AVCheck_API_Token = $row["avcheck_api_token"];
                        $this->AVCheck_LastResult = $row["avcheck_last_result"];
                        $this->AVCheck_NumDetections = $row["avcheck_num_detections"];
                        $this->AVCheck_LastScanDate = $row["avcheck_last_check"];
                    }
                    $this->ExConfig_Data = $row["exconfig_data"];
                    $this->LogOptions = $row["log_options"];
                    if (isset($row["last_tasks_hash"])) {
                        $this->LastTasksRevisionHash = $row["last_tasks_hash"];
                    }
                    if (isset($row["option_flags"])) {
                        $this->General_Options = $row["option_flags"];
                    }
                    if (isset($row["ignored_locales"])) {
                        $this->Ignored_Locales = $row["ignored_locales"];
                    }
                    if (isset($row["minor_flags"])) {
                        $this->Flags_Minor = $row["minor_flags"];
                    }
                    if (isset($row["custom_flags"])) {
                        $this->Flags_Custom = $row["custom_flags"];
                    }
                    return true;
                }
            }
            return false;
        }
        return false;
    }
    public function GetSettings($bIgnoreCache = false)
    {
        $row = NULL;
        $_obfuscated_0D15150B240E24113D37370F403F14270B231D2F110201_ = false;
        $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_ = new CMemoryCache();
        $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->Initialize();
        $_obfuscated_0D332428192A1C5B1B0C3E072B1F1914141D072D010311_ = $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->IsInitialized();
        if ((!isset($bIgnoreCache) || $bIgnoreCache === false) && $_obfuscated_0D332428192A1C5B1B0C3E072B1F1914141D072D010311_ == true) {
            $row = $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->Get(CACHE_PANEL_SETTINGS);
            if ($row != NULL && !isset($row["name"])) {
                $row = NULL;
            } else {
                if ($row != NULL) {
                    $_obfuscated_0D15150B240E24113D37370F403F14270B231D2F110201_ = true;
                }
            }
        }
        if ($row == NULL) {
            $_obfuscated_0D0B5C09383D04243B06180C253123143B2619232C1E11_ = parent::Query("SELECT * FROM " . $this->pdbname . ".settings WHERE strid = '" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
            if ($_obfuscated_0D0B5C09383D04243B06180C253123143B2619232C1E11_) {
                $row = mysql_fetch_assoc($_obfuscated_0D0B5C09383D04243B06180C253123143B2619232C1E11_);
            }
        }
        if ($row) {
            $this->IsLoaded = true;
            $this->Version = DEFAULT_ABSENT_VERSION;
            $this->Name = $row["name"];
            $this->Language = $row["language"];
            $this->SecureCode = $row["securecode"];
            $this->CryptKey = $row["crypt_key"];
            $this->Created = $row["created"];
            $this->AbsentLimit = $row["absent_limit"];
            $this->KnockInterval = $row["knock_interval"];
            $this->Flags_General = $row["general_flags"];
            $this->Flags_Security = $row["security_flags"];
            $this->DnsList_Version = $row["dnslist_version"];
            $this->UrlTrack_Version = $row["urltrack_version"];
            $this->DynamicConfig_Version = $row["dynconfig_version"];
            $this->FileSearch_Version = $row["filesearch_version"];
            $this->Plugins_Version = $row["plugins_version"];
            $this->Web_Version = $row["web_version"];
            $this->FailedLogins = $row["peak_clients"];
            if (!defined("IN_BOT_GATEWAY")) {
                $this->AVCheck_API_ID = $row["avcheck_api_id"];
                $this->AVCheck_API_Token = $row["avcheck_api_token"];
                $this->AVCheck_LastResult = $row["avcheck_last_result"];
                $this->AVCheck_NumDetections = $row["avcheck_num_detections"];
                $this->AVCheck_LastScanDate = $row["avcheck_last_check"];
            }
            $this->ExConfig_Data = $row["exconfig_data"];
            $this->LogOptions = $row["log_options"];
            if (isset($row["last_tasks_hash"])) {
                $this->LastTasksRevisionHash = $row["last_tasks_hash"];
            }
            if (isset($row["option_flags"])) {
                $this->General_Options = $row["option_flags"];
            }
            if (isset($row["ignored_locales"])) {
                $this->Ignored_Locales = $row["ignored_locales"];
            }
            if (isset($row["minor_flags"])) {
                $this->Flags_Minor = $row["minor_flags"];
            }
            if (isset($row["custom_flags"])) {
                $this->Flags_Custom = $row["custom_flags"];
            }
            if (isset($row["infoblob_flags"])) {
                $this->Flags_Blobs = $row["infoblob_flags"];
            }
            if ($_obfuscated_0D332428192A1C5B1B0C3E072B1F1914141D072D010311_ == true && $_obfuscated_0D15150B240E24113D37370F403F14270B231D2F110201_ == false) {
                $_obfuscated_0D05092138401D1309103C240F5C0B1412110E10103511_->Set(CACHE_PANEL_SETTINGS, $row);
            }
            return 1;
        }
        return 0;
    }
    public function UpdateSettings_Default()
    {
    }
    public function SetLogOptions($new_options)
    {
        if (!is_numeric($new_options)) {
            return NULL;
        }
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET log_options=" . $new_options . " LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && 0 < mysql_affected_rows()) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function UpdateGeneralFlags($new_flags)
    {
        if (!is_numeric($new_flags)) {
            return NULL;
        }
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET general_flags='" . $new_flags . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && 0 < mysql_affected_rows()) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function GetCustomStatusFlags()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("SELECT custom_flags FROM " . $this->pdbname . ".settings");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $row = mysql_fetch_assoc($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_);
            if (isset($row["custom_flags"])) {
                return (int) $row["custom_flags"];
            }
        }
    }
    public function UpdateCustomStatusFlags($new_flags)
    {
        if (!is_numeric($new_flags)) {
            return NULL;
        }
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET custom_flags='" . $new_flags . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
            return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
        }
        return NULL;
    }
    public function GetInfoBlobStatusFlags()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("SELECT infoblob_flags FROM " . $this->pdbname . ".settings");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $row = mysql_fetch_assoc($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_);
            if (isset($row["infoblob_flags"])) {
                return (int) $row["infoblob_flags"];
            }
        }
    }
    public function UpdateInfoBlobStatusFlags($new_flags)
    {
        if (!is_numeric($new_flags)) {
            return NULL;
        }
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET infoblob_flags='" . $new_flags . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
            return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
        }
        return NULL;
    }
    public function UpdateSettings($settingsObj)
    {
        global $Session;
        $_obfuscated_0D2B0F0A353B1B08142C40030734311D1C06291D351011_ = bin2hex($settingsObj->Name);
        $_obfuscated_0D0C18111A2702212325323B3F2A2A241B05060B080522_ = bin2hex($settingsObj->SecureCode);
        $_obfuscated_0D270F0C191C0711132D2A142C40393B01330A5C113432_ = bin2hex($settingsObj->Ignored_Locales);
        $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ = "";
        if ((int) $Session->Rights() & USER_PRIVILEGES_VIEW_LOGS) {
            $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ = "UPDATE " . $this->pdbname . ".settings SET securecode=UNHEX('" . $_obfuscated_0D0C18111A2702212325323B3F2A2A241B05060B080522_ . "'), name=UNHEX('" . $_obfuscated_0D2B0F0A353B1B08142C40030734311D1C06291D351011_ . "'), language='" . $settingsObj->Language . "', crypt_key='" . $settingsObj->CryptKey . "', absent_limit='" . $settingsObj->AbsentLimit . "', knock_interval='" . $settingsObj->KnockInterval . "', general_flags='" . $settingsObj->Flags_General . "', minor_flags='" . $settingsObj->Flags_Minor . "', security_flags='" . $settingsObj->Flags_Security . "', log_options='" . $settingsObj->LogOptions . "', option_flags='" . $settingsObj->General_Options . "', ignored_locales=UNHEX('" . $_obfuscated_0D270F0C191C0711132D2A142C40393B01330A5C113432_ . "')";
        } else {
            $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ = "UPDATE " . $this->pdbname . ".settings SET securecode=UNHEX('" . $_obfuscated_0D0C18111A2702212325323B3F2A2A241B05060B080522_ . "'), name=UNHEX('" . $_obfuscated_0D2B0F0A353B1B08142C40030734311D1C06291D351011_ . "'), language='" . $settingsObj->Language . "', crypt_key='" . $settingsObj->CryptKey . "', absent_limit='" . $settingsObj->AbsentLimit . "', knock_interval='" . $settingsObj->KnockInterval . "', general_flags='" . $settingsObj->Flags_General . "', minor_flags='" . $settingsObj->Flags_Minor . "', security_flags='" . $settingsObj->Flags_Security . "', option_flags='" . $settingsObj->General_Options . "', ignored_locales=UNHEX('" . $_obfuscated_0D270F0C191C0711132D2A142C40393B01330A5C113432_ . "')";
        }
        if (strlen($_obfuscated_0D032919102C36291201173F2904250A15040123341211_)) {
            if ($settingsObj->Flags_Custom != CUSTOM_FLAGS_INVALID_FLAGS) {
                $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ .= ", custom_flags='" . $settingsObj->Flags_Custom . "'";
            }
            if ($settingsObj->Flags_Blobs != INFOBLOB_FLAGS_INVALID_FLAGS) {
                $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ .= ", infoblob_flags='" . $settingsObj->Flags_Blobs . "'";
            }
        }
        $_obfuscated_0D032919102C36291201173F2904250A15040123341211_ .= " WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1";
        $_obfuscated_0D2A340D191F3D1B1B1A02020E1E0C1A173230373E3301_ = parent::Query($_obfuscated_0D032919102C36291201173F2904250A15040123341211_);
        if (!mysql_errno()) {
            global $Session;
            global $main_sql_link;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_SETTINGS_CHANGE, "");
            $this->GetSettings(true);
        }
    }
    public function Update_LastTasksHash($new_hash)
    {
        return parent::Query("UPDATE " . $this->pdbname . ".settings SET last_tasks_hash = '" . $new_hash . "' WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
    }
    public function Update_LastTasksHashEx()
    {
        $_obfuscated_0D0E3907393E402D1228083E0602085C132D5C10343D01_ = strlen($this->Name) ? $this->Name : "hijklmnop";
        $new_hash = sha1("abcdefg_" . $_obfuscated_0D0E3907393E402D1228083E0602085C132D5C10343D01_ . mt_rand(111, 99999) . mt_rand(555, 999999) . mt_rand(893, 99999999) . mt_rand(3331, 9992299));
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = $this->Update_LastTasksHash($new_hash);
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_DnsModify_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET dnslist_version = dnslist_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_UrlTrack_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET urltrack_version = urltrack_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_DynConfig_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET dynconfig_version = dynconfig_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_FileSearch_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET filesearch_version = filesearch_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_Plugins_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET plugins_version = plugins_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_Web_Revision()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET web_version = web_version + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Update_FailedLogins()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET peak_clients = peak_clients + 1 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Clear_FailedLogins()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET peak_clients = 0 WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function Get_FailedLogins()
    {
        $query = parent::Query("SELECT peak_clients FROM " . $this->pdbname . ".settings WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($query) {
            $row = mysql_fetch_assoc($query);
            if ($row) {
                return (int) $row["peak_clients"];
            }
        }
        return 0;
    }
    public function AVCheck_SetUserInfo($api_id, $api_token)
    {
        $_obfuscated_0D2C262119340E17330A1E133428130137115B22082C32_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($api_id);
        $_obfuscated_0D1A3738223C12051C3723031B071F3E3D293517333801_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($api_token);
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET avcheck_api_id = '" . $api_id . "', avcheck_api_token = '" . $_obfuscated_0D1A3738223C12051C3723031B071F3E3D293517333801_ . "' WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function AVCheck_SetLastResults($last_results, $num_detections)
    {
        $_obfuscated_0D1C0D1A3136375C02235B1E2931021A2F1F402B351A32_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($last_results);
        $num_detections = (int) $num_detections;
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".settings SET avcheck_last_result = '" . $_obfuscated_0D1C0D1A3136375C02235B1E2931021A2F1F402B351A32_ . "', avcheck_num_detections = '" . $num_detections . "', avcheck_last_check = UNIX_TIMESTAMP(NOW()) WHERE strid='" . SETTINGS_MAIN_RECORD_ROW_NAME . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            $this->GetSettings(true);
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
}

?>