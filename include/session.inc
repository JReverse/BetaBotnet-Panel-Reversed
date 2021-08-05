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
define("SESSION_INFO_USERID", "i");
define("SESSION_INFO_USERNAME", "u");
define("SESSION_INFO_PW_HASH", "p");
define("SESSION_INFO_PW_HASH_SEC", "sec");
define("SESSION_INFO_PRIVILEGE_MASK", "pm");
define("SESSION_INFO_OPTION_MASK", "opt");
define("SESSION_INFO_DATE_LOGGED_IN", "dt");
define("SESSION_INFO_DATE_LAST_VISIT", "dtv");
define("SESSION_INFO_FAILED_LOGIN_ATTEMPTS", "fla");
define("SESSION_INFO_SORT_TYPE", "sb_t");
define("SESSION_INFO_SORT_TYPE_ORDER", "sb_o");
define("SESSION_INFO_SORT_MAX_VIEW_PER_PAGE", "sb_mx");
define("SESSION_ETC_MAX_FAILED_LOGINS", 5);
class CPanelSession
{
    protected $sql_link = NULL;
    protected $LoggedIn = NULL;
    public function __construct($new_sql_link)
    {
        $this->sql_link = $new_sql_link;
        $this->LoggedIn = false;
    }
    public function SetInternalLink($new_sql_link)
    {
        $this->sql_link = $new_sql_link;
        $this->LoggedIn = false;
    }
    public function GetInternalLink()
    {
        return $this->sql_link;
    }
    public function Start()
    {
        session_start();
        if (!isset($_SESSION[SESSION_INFO_FAILED_LOGIN_ATTEMPTS])) {
            $this->Set(SESSION_INFO_FAILED_LOGIN_ATTEMPTS, 0);
        }
    }
    public function Stop()
    {
        session_destroy();
    }
    public function Get($var_name)
    {
        if ($var_name && isset($_SESSION[$var_name])) {
            return $_SESSION[$var_name];
        }
    }
    public function Set($var_name, $var_value)
    {
        if ($var_name) {
            $_SESSION[$var_name] = $var_value;
        }
    }
    public function Remove($var_name)
    {
        if ($var_name) {
            unset($_SESSION[$var_name]);
        }
    }
    public function Exists()
    {
        if (isset($_SESSION[SESSION_INFO_USERNAME])) {
            return true;
        }
        return false;
    }
    public function IsLoggedIn()
    {
        return (bool) $this->LoggedIn;
    }
    public function Rights()
    {
        return (int) $this->Get(SESSION_INFO_PRIVILEGE_MASK);
    }
    public function Options()
    {
        return (int) $this->Get(SESSION_INFO_OPTION_MASK);
    }
    public function CreateNewSession($username, $passw_hash, $update_lastlogin)
    {
        $_obfuscated_0D0D2401262B323622402C33305C0F26011B3426371D11_ = new CPanelAdmins();
        $_obfuscated_0D0D2401262B323622402C33305C0F26011B3426371D11_->SetInternalLink($this->sql_link);
        $row = $_obfuscated_0D0D2401262B323622402C33305C0F26011B3426371D11_->GetUserIfLoginIsOK($username, $passw_hash);
        if ($row && ($row = mysql_fetch_assoc($row))) {
            $_obfuscated_0D210831222F12230A143E2A1607092611032A05222511_ = sha1($passw_hash . ":" . SQL_PASSWORD_SALT);
            $_obfuscated_0D2F0C1F23290827030A0C40030530233E261C152E1C32_ = (int) ((int) $row["lastlogin"] != 0) ? $row["lastlogin"] : time();
            $this->Set(SESSION_INFO_USERID, (int) $row["id"]);
            $this->Set(SESSION_INFO_USERNAME, $username);
            $this->Set(SESSION_INFO_PW_HASH, $passw_hash);
            $this->Set(SESSION_INFO_PW_HASH_SEC, $_obfuscated_0D210831222F12230A143E2A1607092611032A05222511_);
            $this->Set(SESSION_INFO_PRIVILEGE_MASK, (int) $row["priv_mask"]);
            $this->Set(SESSION_INFO_OPTION_MASK, (int) $row["options"]);
            $this->Set(SESSION_INFO_DATE_LOGGED_IN, time());
            $this->Set(SESSION_INFO_DATE_LAST_VISIT, $_obfuscated_0D2F0C1F23290827030A0C40030530233E261C152E1C32_);
            $this->Set(SESSION_INFO_SORT_TYPE, $row["sort_type"]);
            $this->Set(SESSION_INFO_SORT_TYPE_ORDER, $row["sort_order"]);
            $this->Set(SESSION_INFO_SORT_MAX_VIEW_PER_PAGE, $row["sort_max_per_page"]);
            if ($update_lastlogin == true) {
                $_obfuscated_0D0D2401262B323622402C33305C0F26011B3426371D11_->UpdateLastLogin($username);
            }
            $this->LoggedIn = true;
            return true;
        }
        return false;
    }
    public function EndSession()
    {
        unset($_SESSION[SESSION_INFO_USERID]);
        unset($_SESSION[SESSION_INFO_USERNAME]);
        unset($_SESSION[SESSION_INFO_PW_HASH]);
        unset($_SESSION[SESSION_INFO_PW_HASH_SEC]);
        unset($_SESSION[SESSION_INFO_PRIVILEGE_MASK]);
        unset($_SESSION[SESSION_INFO_OPTION_MASK]);
        unset($_SESSION[SESSION_INFO_FAILED_LOGIN_ATTEMPTS]);
        unset($_SESSION[SESSION_INFO_DATE_LOGGED_IN]);
        unset($_SESSION[SESSION_INFO_DATE_LAST_VISIT]);
        unset($_SESSION[SESSION_INFO_SORT_TYPE]);
        unset($_SESSION[SESSION_INFO_SORT_TYPE_ORDER]);
        unset($_SESSION[SESSION_INFO_SORT_MAX_VIEW_PER_PAGE]);
    }
    public function ValidateSessionLoginInformation()
    {
        if ($this->sql_link && strlen($this->Get(SESSION_INFO_USERNAME)) && strlen($this->Get(SESSION_INFO_PW_HASH)) && strlen($this->Get(SESSION_INFO_PW_HASH_SEC))) {
            $_obfuscated_0D3D3125293231062308090A27061B2D3C0E1D22350432_ = new CPanelAdmins();
            $_obfuscated_0D3D3125293231062308090A27061B2D3C0E1D22350432_->SetInternalLink($this->sql_link);
            $_obfuscated_0D210831222F12230A143E2A1607092611032A05222511_ = sha1($this->Get(SESSION_INFO_PW_HASH) . ":" . SQL_PASSWORD_SALT);
            if (strcasecmp($this->Get(SESSION_INFO_PW_HASH_SEC), $_obfuscated_0D210831222F12230A143E2A1607092611032A05222511_) != 0) {
                return false;
            }
            $row = $_obfuscated_0D3D3125293231062308090A27061B2D3C0E1D22350432_->GetUserIfLoginIsOK($this->Get(SESSION_INFO_USERNAME), $this->Get(SESSION_INFO_PW_HASH));
            if ($row) {
                if ($row = mysql_fetch_assoc($row)) {
                    $this->Set(SESSION_INFO_PRIVILEGE_MASK, $row["priv_mask"]);
                    $this->LoggedIn = true;
                    return true;
                }
            } else {
                $this->EndSession();
            }
        }
        return false;
    }
    public function SetSessionSortParameters($sort_type, $sort_order, $sort_max_view)
    {
        $this->Set(SESSION_INFO_SORT_TYPE, $sort_type);
        $this->Set(SESSION_INFO_SORT_TYPE_ORDER, $sort_order);
        $this->Set(SESSION_INFO_SORT_MAX_VIEW_PER_PAGE, $sort_max_view);
    }
    public function UpdateLastVisitTime()
    {
        if ($this->Exists() == false) {
            return NULL;
        }
        $this->Set(SESSION_INFO_DATE_LAST_VISIT, time());
    }
}

?>