<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("CACHE_PANEL_SETTINGS", "panelsettings" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_DNS_MODIFIERS", "cfg_dns" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_URL_TRACK_LIST", "cfg_urltrack" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_DYNAMIC_CONFIG", "cfg_dynconfig" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_FILE_SEARCH", "cfg_filesearch" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_PLUGINS", "cfg_plugins" . SQL_PASSWORD_SALT);
define("CACHE_CONFIG_WEB", "cfg_web" . SQL_PASSWORD_SALT);
class CMemoryCache
{
    private $bIsEnabled = false;
    public function Initialize()
    {
        $this->bIsEnabled = extension_loaded("apc");
        return $this->bIsEnabled;
    }
    public function IsInitialized()
    {
        return $this->bIsEnabled;
    }
    public function Set($szKeyName, $mValue)
    {
        if ($this->bIsEnabled == false) {
            return NULL;
        }
        return _obfuscated_0D14163D293E1E0803012D3B1D120E18261622100A3232_($szKeyName, $mValue, 86400);
    }
    public function Get($szKeyName)
    {
        if ($this->bIsEnabled == false) {
            return NULL;
        }
        $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_ = false;
        $_obfuscated_0D1D242A32153E0F2425193F372B330C38101F0F112611_ = _obfuscated_0D2A215C1317271130180B18231229101F3F35085C1701_($szKeyName, $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_);
        return $_obfuscated_0D18313835321F1524210722370A030325220E0D3D3811_ == true ? $_obfuscated_0D1D242A32153E0F2425193F372B330C38101F0F112611_ : NULL;
    }
    public function Delete($szKeyName)
    {
        if ($this->bIsEnabled == false) {
            return NULL;
        }
        return _obfuscated_0D271B071E3B0C37182537113D093B1E343726360F3432_($szKeyName);
    }
    public function ValueExists($szKeyName)
    {
        if ($this->bIsEnabled == false) {
            return NULL;
        }
        return _obfuscated_0D111024183B12391902380A221B1731312E321F303732_($szKeyName);
    }
}

?>