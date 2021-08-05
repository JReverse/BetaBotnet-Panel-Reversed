<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

if (!defined("IN_CORE_INC") && !defined("BYPASS_CORE_INC_REQUIREMENT")) {
    exit("..");
}
define("NO_ANTIVIRUS", 0);
define("NORTON", 1);
define("KASPERSKY", 2);
define("AVG_AV", 4);
define("AVIRA_AV", 8);
define("ESET_AV", 16);
define("MCAFEE_AV", 32);
define("TREND_MICRO", 64);
define("AVAST_AV", 128);
define("MS_ESSENTIALS", 256);
define("BITDEFENDER_AV", 512);
define("BULLGUARD_AV", 1024);
define("RISING_IS", 2048);
define("ARCAVIR_AV", 4096);
define("WEBROOT_AV", 8192);
define("EMSISOFT_AV", 16384);
define("FSECURE_AV", 32768);
define("PANDA_AV", 65536);
define("PCTOOLS_AV", 131072);
define("GDATA_IS", 262144);
define("ZONEALARM", 524288);
define("BKAV_IS", 1048576);
define("GBUSTER_AV", 2097152);
define("DR_WEB", 4194304);
define("SOPHOS_ENDPOINT", 8388608);
define("COMODO_AV", 16777216);
define("AHNLAB_FREE", 33554432);
define("BAIDU_FREE", 67108864);
define("MALWAREBYTES_PRO", 134217728);
class RC4Crypt
{
    public static function encrypt($pwd, $data, $ispwdHex = 0)
    {
        if ($ispwdHex) {
            $pwd = @pack("H*", $pwd);
        }
        $key[] = "";
        $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[] = "";
        $_obfuscated_0D0C22321D0F2B0738353E031715032B0A3301351F3422_ = "";
        $_obfuscated_0D192B1E33381E25182F10052C2F2A3601291711123111_ = strlen($pwd);
        $_obfuscated_0D08180826220A1D310E0E30111E171A09251008272A32_ = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($pwd[$i % $_obfuscated_0D192B1E33381E25182F10052C2F2A3601291711123111_]);
            $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$i] + $key[$i]) % 256;
            $_obfuscated_0D070324105C1B302C292218010C19183E28273B342622_ = $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$i];
            $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$i] = $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$j];
            $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$j] = $_obfuscated_0D070324105C1B302C292218010C19183E28273B342622_;
        }
        for ($a = $j = $i = 0; $i < $_obfuscated_0D08180826220A1D310E0E30111E171A09251008272A32_; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$a]) % 256;
            $_obfuscated_0D070324105C1B302C292218010C19183E28273B342622_ = $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$a];
            $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$a] = $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$j];
            $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$j] = $_obfuscated_0D070324105C1B302C292218010C19183E28273B342622_;
            $k = $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[($_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$a] + $_obfuscated_0D18142C2C38163F3C402F28311F3C323711381E121B11_[$j]) % 256];
            $_obfuscated_0D0C22321D0F2B0738353E031715032B0A3301351F3422_ .= chr(ord($data[$i]) ^ $k);
        }
        return $_obfuscated_0D0C22321D0F2B0738353E031715032B0A3301351F3422_;
    }
    public static function decrypt($pwd, $data, $ispwdHex = 0)
    {
        return RC4Crypt::encrypt($pwd, $data, $ispwdHex);
    }
}
function _obfuscated_0D0F1C3E3E150C5B2B32150B1F5B1030362B383D0E3422_($av_product = 0)
{
    if ($av_product & NORTON) {
        return "Norton";
    }
    if ($av_product & KASPERSKY) {
        return "Kaspersky";
    }
    if ($av_product & AVG_AV) {
        return "AVG";
    }
    if ($av_product & AVIRA_AV) {
        return "Avira";
    }
    if ($av_product & ESET_AV) {
        return "ESET";
    }
    if ($av_product & MCAFEE_AV) {
        return "McAfee";
    }
    if ($av_product & TREND_MICRO) {
        return "Trend Micro";
    }
    if ($av_product & AVAST_AV) {
        return "Avast";
    }
    if ($av_product & MS_ESSENTIALS) {
        return "Microsoft Security Essentials";
    }
    if ($av_product & BITDEFENDER_AV) {
        return "BitDefender";
    }
    if ($av_product & BULLGUARD_AV) {
        return "BullGuard";
    }
    if ($av_product & RISING_IS) {
        return "Rising IS";
    }
    if ($av_product & ARCAVIR_AV) {
        return "ArcaVir";
    }
    if ($av_product & WEBROOT_AV) {
        return "Webroot SecureAnywhere";
    }
    if ($av_product & EMSISOFT_AV) {
        return "Emsisoft";
    }
    if ($av_product & FSECURE_AV) {
        return "F-Secure";
    }
    if ($av_product & PANDA_AV) {
        return "Panda";
    }
    if ($av_product & PCTOOLS_AV) {
        return "PC Tools";
    }
    if ($av_product & GDATA_IS) {
        return "GData IS";
    }
    if ($av_product & ZONEALARM) {
        return "ZoneAlarm";
    }
    if ($av_product & BKAV_IS) {
        return "Bkav IS";
    }
    if ($av_product & DR_WEB) {
        return "Dr Web";
    }
    if ($av_product & SOPHOS_ENDPOINT) {
        return "Sophos Endpoint";
    }
    if ($av_product & COMODO_AV) {
        return "Comodo";
    }
    if ($av_product & AHNLAB_FREE) {
        return "Ahnlab Free";
    }
    if ($av_product & BAIDU_FREE) {
        return "Baidu Free";
    }
    if ($av_product & MALWAREBYTES_PRO) {
        return "Malwarebytes Pro";
    }
    if ($av_product & GBUSTER_AV) {
        return "GBuster AV";
    }
    return "N/A";
}
function _obfuscated_0D3E0A1130181635162E3526020C0F1B342E031A221011_($av_product = 0)
{
    if ($av_product & NORTON) {
        return "Norton";
    }
    if ($av_product & KASPERSKY) {
        return "Kaspersky";
    }
    if ($av_product & AVG_AV) {
        return "AVG";
    }
    if ($av_product & AVIRA_AV) {
        return "Avira";
    }
    if ($av_product & ESET_AV) {
        return "ESET";
    }
    if ($av_product & MCAFEE_AV) {
        return "McAfee";
    }
    if ($av_product & TREND_MICRO) {
        return "TrendMicro";
    }
    if ($av_product & AVAST_AV) {
        return "Avast";
    }
    if ($av_product & MS_ESSENTIALS) {
        return "MSE";
    }
    if ($av_product & BITDEFENDER_AV) {
        return "BitDefender";
    }
    if ($av_product & BULLGUARD_AV) {
        return "BullGuard";
    }
    if ($av_product & RISING_IS) {
        return "Rising";
    }
    if ($av_product & ARCAVIR_AV) {
        return "ArcaVir";
    }
    if ($av_product & WEBROOT_AV) {
        return "Webroot";
    }
    if ($av_product & EMSISOFT_AV) {
        return "Emsisoft";
    }
    if ($av_product & FSECURE_AV) {
        return "F-Secure";
    }
    if ($av_product & PANDA_AV) {
        return "Panda";
    }
    if ($av_product & PCTOOLS_AV) {
        return "PC Tools";
    }
    if ($av_product & GDATA_IS) {
        return "GData IS";
    }
    if ($av_product & ZONEALARM) {
        return "ZoneAlarm";
    }
    if ($av_product & BKAV_IS) {
        return "Bkav IS";
    }
    if ($av_product & DR_WEB) {
        return "Dr Web";
    }
    if ($av_product & SOPHOS_ENDPOINT) {
        return "Sophos";
    }
    if ($av_product & COMODO_AV) {
        return "Comodo";
    }
    if ($av_product & AHNLAB_FREE) {
        return "Ahnlab Free";
    }
    if ($av_product & BAIDU_FREE) {
        return "Baidu Free";
    }
    if ($av_product & MALWAREBYTES_PRO) {
        return "Malwarebytes";
    }
    if ($av_product & GBUSTER_AV) {
        return "GBuster AV";
    }
    return "N/A";
}
function _obfuscated_0D0A110C2D041029091F3828123D36173638131F0B2632_($dword_version = 0)
{
    $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ = $dword_version & 65535;
    $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ = $dword_version >> 16 & 65535;
    $_obfuscated_0D37192E182C0E0D07293710193D2613022C260C1D5C11_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ & 255;
    $_obfuscated_0D040B331916232D370D383F072524151A100F060F2A11_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ >> 8 & 255;
    $_obfuscated_0D153B0A3D083512151E3713061B1A333C1F5B0A041522_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ & 255;
    $_obfuscated_0D1611172F351B133F152108070D320A382937380E3601_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ >> 8 & 255;
    $_obfuscated_0D1F212F063828051A335C250E3C1E170E140D06250D11_ = $_obfuscated_0D37192E182C0E0D07293710193D2613022C260C1D5C11_ . "." . $_obfuscated_0D040B331916232D370D383F072524151A100F060F2A11_ . "." . $_obfuscated_0D153B0A3D083512151E3713061B1A333C1F5B0A041522_ . "." . $_obfuscated_0D1611172F351B133F152108070D320A382937380E3601_;
    return $_obfuscated_0D1F212F063828051A335C250E3C1E170E140D06250D11_;
}
function _obfuscated_0D5C1C162637013135161F331C1F090D280429392F1701_($dword_version, &$ver_major, &$ver_minor = 0, &$ver_revision = 0, &$ver_build = 0)
{
    $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ = $dword_version & 65535;
    $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ = $dword_version >> 16 & 65535;
    $_obfuscated_0D37192E182C0E0D07293710193D2613022C260C1D5C11_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ & 255;
    $_obfuscated_0D040B331916232D370D383F072524151A100F060F2A11_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ >> 8 & 255;
    $_obfuscated_0D153B0A3D083512151E3713061B1A333C1F5B0A041522_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ & 255;
    $_obfuscated_0D1611172F351B133F152108070D320A382937380E3601_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ >> 8 & 255;
    $ver_major = $_obfuscated_0D37192E182C0E0D07293710193D2613022C260C1D5C11_;
    if (isset($ver_minor)) {
        $ver_minor = $_obfuscated_0D040B331916232D370D383F072524151A100F060F2A11_;
    }
    if (isset($ver_revision)) {
        $ver_revision = $_obfuscated_0D153B0A3D083512151E3713061B1A333C1F5B0A041522_;
    }
    if (isset($ver_build)) {
        $ver_build = $_obfuscated_0D1611172F351B133F152108070D320A382937380E3601_;
    }
    $_obfuscated_0D1F212F063828051A335C250E3C1E170E140D06250D11_ = $_obfuscated_0D37192E182C0E0D07293710193D2613022C260C1D5C11_ . "." . $_obfuscated_0D040B331916232D370D383F072524151A100F060F2A11_ . "." . $_obfuscated_0D153B0A3D083512151E3713061B1A333C1F5B0A041522_ . "." . $_obfuscated_0D1611172F351B133F152108070D320A382937380E3601_;
    return $_obfuscated_0D1F212F063828051A335C250E3C1E170E140D06250D11_;
}
function _obfuscated_0D3D05300B27300F1E0215180A325B0F5B40170C1E1411_($xor_key)
{
    $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ = $xor_key & 65535;
    $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ = $xor_key >> 16 & 65535;
    $_obfuscated_0D0A0A351518321B10133F322310140D383B2601353211_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ & 255;
    $_obfuscated_0D391806101F103B1226162C0D2B30304034072D230A01_ = $_obfuscated_0D1A1D06131F05211825015C3D5C3D3818191604050A01_ >> 8 & 255;
    $_obfuscated_0D0D3D280B1304015C2C331D171106401E361D0A342A22_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ & 255;
    $_obfuscated_0D063F071B13260829343C3F10020D32270607291C0E22_ = $_obfuscated_0D10112C21110E24041337402A072F12025B2515214001_ >> 8 & 255;
    return array($_obfuscated_0D0A0A351518321B10133F322310140D383B2601353211_, $_obfuscated_0D391806101F103B1226162C0D2B30304034072D230A01_, $_obfuscated_0D0D3D280B1304015C2C331D171106401E361D0A342A22_, $_obfuscated_0D063F071B13260829343C3F10020D32270607291C0E22_);
}
function _obfuscated_0D5C0A3B01170C22303723373F1C2C013C313223220511_()
{
    $_obfuscated_0D3F1D2A0F1237120A35323919110F271F192C07071301_ = "";
    if (stripos($_SERVER["SERVER_SOFTWARE"], "Apache") === false) {
        $_obfuscated_0D3F1D2A0F1237120A35323919110F271F192C07071301_ = "<html>\r\n\t<head><title>404 Not Found</title></head>\r\n\t<body bgcolor=\"white\">\r\n\t<center><h1>404 Not Found</h1></center>\r\n\t<hr><center>nginx</center>\r\n\t</body>\r\n\t</html>";
    } else {
        $_obfuscated_0D3F1D2A0F1237120A35323919110F271F192C07071301_ = "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n\t<html><head>\r\n\t<title>404 Not Found</title>\r\n\t</head><body>\r\n\t<h1>Not Found</h1>\r\n\t<p>The requested URL " . $_SERVER["REQUEST_URI"] . " was not found on this server.</p>\r\n\t</body></html>";
    }
    return $_obfuscated_0D3F1D2A0F1237120A35323919110F271F192C07071301_;
}
function _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($stripdata)
{
    $stripdata = str_replace("'", "?", $stripdata);
    $stripdata = str_replace("\"", "?", $stripdata);
    $stripdata = str_replace(";", "?", $stripdata);
    $stripdata = str_replace("\32", "?", $stripdata);
    $stripdata = str_replace("\r", "?", $stripdata);
    $stripdata = str_replace("\n", "?", $stripdata);
    return $stripdata;
}
function _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($squery)
{
    if (get_magic_quotes_gpc()) {
        $squery = stripslashes($squery);
    }
    return mysql_real_escape_string($squery);
}
function _obfuscated_0D2B1E2A5C3F1B375C12340E381006281D3E02122E3811_($squery)
{
    if (strlen($squery) < 2) {
        return $squery;
    }
    $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = $squery;
    $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ = strlen($squery);
    if (@substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 3, 3) == "AND") {
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = @substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, 0, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 3);
    }
    if (@substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 2, 2) == "OR") {
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = @substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, 0, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 2);
    }
    if (@substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 5, 5) == "WHERE") {
        $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_ = @substr($_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_, 0, $_obfuscated_0D111A2F2C241F160C26221B1A040B2D2A315C3F0D3211_ - 5);
    }
    return $_obfuscated_0D131B15383B34031F4030251E033D2E3D022C0D1A2E01_;
}
function _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($cc_data = "", $cc_key = NULL)
{
    $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_ = @strlen($cc_data);
    if ($_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_ == 0) {
        return "";
    }
    $_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_ = @str_split($cc_data);
    for ($i = 0; $i < $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_; $i++) {
        $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ = (int) @ord($_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_[$i]);
        $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ ^= $cc_key[$i % 4];
        $_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_[$i] = @chr($_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_);
    }
    $_obfuscated_0D24032709381139341522183B3C1B143E12150E320A32_ = @implode($_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_);
    return $_obfuscated_0D24032709381139341522183B3C1B143E12150E320A32_;
}
function _obfuscated_0D11160D1D0C2E251D35310A151714250C1A330A161301_($cc_data, $cc_key)
{
    $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_ = @strlen($cc_data);
    if ($_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_ == 0) {
        return "";
    }
    $_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_ = @str_split($cc_data);
    for ($i = 0; $i < $_obfuscated_0D0C1C1A1C28291E053C3540102B033C1A1D0B192F0222_; $i++) {
        $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ = (int) @ord($_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_[$i]);
        $_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_ ^= (int) $cc_key;
        $_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_[$i] = @chr($_obfuscated_0D1C291127371F0B2228252F101F1E0804400B14371A11_);
    }
    $_obfuscated_0D24032709381139341522183B3C1B143E12150E320A32_ = @implode($_obfuscated_0D2B1C1E2605262D2D322E123214161D08323B0D1B3122_);
    return $_obfuscated_0D24032709381139341522183B3C1B143E12150E320A32_;
}
function _obfuscated_0D2E023F02263521180730191E042B0A16182A04240701_($a_bytes)
{
    if ($a_bytes < 1024) {
        return $a_bytes . " bytes";
    }
    if ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 2) . " KiB";
    }
    if ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 2) . " MiB";
    }
    if ($a_bytes < 1099511627776.0) {
        return round($a_bytes / 1073741824, 2) . " GiB";
    }
    if ($a_bytes < 1125899906842620.0) {
        return round($a_bytes / 1099511627776.0, 2) . " TiB";
    }
    if ($a_bytes < 1.15292150460685E+18) {
        return round($a_bytes / 1125899906842620.0, 2) . " PiB";
    }
    if ($a_bytes < 1.18059162071741E+21) {
        return round($a_bytes / 1.15292150460685E+18, 2) . " EiB";
    }
    if ($a_bytes < 1.20892581961463E+24) {
        return round($a_bytes / 1.18059162071741E+21, 2) . " ZiB";
    }
    return round($a_bytes / 1.20892581961463E+24, 2) . " YiB";
}
function _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($num_amount, $num_total, $rp = 2)
{
    if ($num_total == 0) {
        return (double) 0;
    }
    settype($num_amount, "float");
    settype($num_total, "float");
    $_obfuscated_0D2D1D2532052205370C1F0532271A3E0C37302B0F5B11_ = $num_amount / $num_total;
    $_obfuscated_0D131F083611240C295B0D1A1D011D2806082821183732_ = $_obfuscated_0D2D1D2532052205370C1F0532271A3E0C37302B0F5B11_ * 100;
    return (double) number_format($_obfuscated_0D131F083611240C295B0D1A1D011D2806082821183732_, $rp);
}
function _obfuscated_0D21062D170109343714073340281F30273128043B2C22_($conv_string)
{
    $_obfuscated_0D5B233E11101E23073D1223171E033C0F3704160B0211_ = "";
    $_obfuscated_0D353C273F15230D0539183C1F5B1439360C132B362B22_ = strlen($conv_string);
    if (8 < $_obfuscated_0D353C273F15230D0539183C1F5B1439360C132B362B22_) {
        $_obfuscated_0D353C273F15230D0539183C1F5B1439360C132B362B22_ = 8;
    }
    for ($i = 0; $i < $_obfuscated_0D353C273F15230D0539183C1F5B1439360C132B362B22_; $i++) {
        if (substr($conv_string, $i, 1) == "\\0") {
            $_obfuscated_0D1B141640403204102E0B320E1C393B1D2E3D31314011_ = true;
            break;
        }
    }
    if ($_obfuscated_0D1B141640403204102E0B320E1C393B1D2E3D31314011_ == true) {
        $_obfuscated_0D5B233E11101E23073D1223171E033C0F3704160B0211_ = _obfuscated_0D3202060B2F19172402352926160129350C1717181501_($conv_string);
    } else {
        $_obfuscated_0D5B233E11101E23073D1223171E033C0F3704160B0211_ = $conv_string;
    }
    return $_obfuscated_0D5B233E11101E23073D1223171E033C0F3704160B0211_;
}
function _obfuscated_0D042F1F10363535032E052907353F0C111E5B5C283F32_($field_var)
{
    $field_var = str_replace("\n", "", $field_var);
    $field_var = str_replace("\r", "", $field_var);
    $field_var = str_replace("\1", "", $field_var);
    $field_var = str_replace("\2", "", $field_var);
    $field_var = str_replace("\3", "", $field_var);
    $field_var = str_replace("\4", "", $field_var);
    $field_var = str_replace("\5", "", $field_var);
    $field_var = str_replace("\6", "", $field_var);
    $field_var = str_replace("\7", "", $field_var);
    $field_var = str_replace("\10", "", $field_var);
    $field_var = str_replace("\t", "", $field_var);
    $field_var = str_replace("\20", "", $field_var);
    return $field_var;
}
function _obfuscated_0D1D251037150E3F3D0C0838215B5B1115402135392E01_($strtocheck = "")
{
    return (bool) ctype_alnum($strtocheck);
}
function _obfuscated_0D39380D261501220C211A2B11123C2F0614010F360732_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_LOGS_FORMS;
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D40242237350D0D1B2A07332116102A1B292C06260422_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_SETTINGS_PANEL;
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D401B24222C1B21181D1806300315353F132612351A01_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_SETTINGS_ALERTS;
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D2E100C0E5C0C222B12232906321E2D26380404135C01_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_LOGS_LOGINS;
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_($uri_module, $uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . $uri_module;
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D361335101B2F261B0F053626220415152F332F083222_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_TASKS;
    if (isset($_GET["task_page"])) {
        $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "&task_page=" . $_GET["task_page"];
    }
    if (isset($_GET["task_porder"])) {
        $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "&task_porder=" . $_GET["task_porder"];
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D095B10152B111B39392E5C04180E10343B270D323601_($uri_append_components)
{
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = $_SERVER["REQUEST_URI"];
    $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strpos($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, "?");
    if (!$_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_) {
        $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_ = strlen($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_);
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ = substr($_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_, 0, $_obfuscated_0D38271B13191E24132E213D1A2234062E322B03090511_);
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "?mod=" . MOD_MAIN;
    if (isset($_GET["s_attrib"])) {
        $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "&s_attrib=" . $_GET["s_attrib"];
    }
    if (isset($_GET["s_orderby"])) {
        $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "&s_orderby=" . $_GET["s_orderby"];
    }
    if (isset($_GET["s_os"])) {
        $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= "&s_os=" . $_GET["s_os"];
    }
    $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_ .= $uri_append_components;
    return $_obfuscated_0D280A1F393D331D102C182E060B06281B073B37082C32_;
}
function _obfuscated_0D2618320734310426341211042E2D09365B2718072522_($p_url = "")
{
    if (@strstr($p_url, "://")) {
        $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_ = (int) @strpos($p_url, "//") + 2;
        $_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_ = @substr($p_url, $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_, @strlen($p_url) - $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_);
        if (@strpos($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_, "/")) {
            $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_ = @strpos($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_, "/");
        } else {
            $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_ = @strlen($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_);
        }
        global $_TASK_FILE_UI_FIELD_ERRORS;
        $_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_ = @substr($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_, 0, $_obfuscated_0D260C03230203383E2E150914311E32022E39182A2F22_);
        if (@ip2long($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_) != 0) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "IPs within the URL are not supported. Please specify only the IP and not the rest of the URL string.", true, MOD_TASKS_ALERT_WIDTH);
            return true;
        }
        if (!@strpos($_obfuscated_0D5C0E1A1317380E0F3709340E3C2108341D3C22363011_, ".")) {
            $_TASK_FILE_UI_FIELD_ERRORS["field_1"] = TASKS_FIX_VALUE_BACKGROUND_COLOR_STYLE_CODE;
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Invalid host specified. Must be a valid domain name.", true, MOD_TASKS_ALERT_WIDTH);
            return true;
        }
    }
    return false;
}
function _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($hex_string)
{
    return pack("H*", $hex_string);
}
function _obfuscated_0D3202060B2F19172402352926160129350C1717181501_($str)
{
    $_obfuscated_0D24013D1A351B042726255C0B21101307215C19273532_ = false;
    $len = strlen($str);
    $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ = "";
    $i = 0;
    while ($i < $len) {
        if (ord($str[$i]) == 0 && ord($str[$i + 1]) == 0) {
            break;
        }
        $c = $_obfuscated_0D24013D1A351B042726255C0B21101307215C19273532_ ? ord($str[$i]) << 8 | ord($str[$i + 1]) : ord($str[$i + 1]) << 8 | ord($str[$i]);
        if (1 <= $c && $c <= 127) {
            $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr($c);
        } else {
            if (2047 < $c) {
                $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr(224 | $c >> 12 & 15);
                $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr(128 | $c >> 6 & 63);
                $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr(128 | $c >> 0 & 63);
            } else {
                $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr(192 | $c >> 6 & 31);
                $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_ .= chr(128 | $c >> 0 & 63);
            }
        }
        $i += 2;
    }
    return $_obfuscated_0D1B30103B360D245B21402E1D31050A36315B151C3C01_;
}

?>