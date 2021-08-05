<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

function _obfuscated_0D0A1B251B251F2C1036213E1B065B24010C1F3B042911_($bIsCentered, $max_width = 0, $table_align = "")
{
    $_obfuscated_0D263C2E222B3D1A110E2B17260B2C1111252E32140332_ = "";
    $_obfuscated_0D142710222B2717112219065B321B032B19343E3B2C11_ = "align=\"center\"";
    if (isset($table_align) && strlen($table_align)) {
        $_obfuscated_0D142710222B2717112219065B321B032B19343E3B2C11_ = "align=\"" . $table_align . "\"";
    }
    if (isset($max_width) && 0 < $max_width) {
        $_obfuscated_0D263C2E222B3D1A110E2B17260B2C1111252E32140332_ = "style=\"width: " . $max_width . "px;\"";
        $_obfuscated_0D142710222B2717112219065B321B032B19343E3B2C11_ = "";
    }
    echo "<table class=\"table table-bordered table-condensed table-striped\" " . $_obfuscated_0D142710222B2717112219065B321B032B19343E3B2C11_ . " valign=\"top\" " . $_obfuscated_0D263C2E222B3D1A110E2B17260B2C1111252E32140332_ . ">\r\n";
    echo "<tr>\r\n<td>\r\n";
    if ($bIsCentered) {
        echo "<center>\r\n";
    }
}
function _obfuscated_0D1D13360F190502082F110F39373B390B5B2F14252601_($bIsCentered)
{
    echo "</td>\r\n</tr>\r\n</table>\r\n";
    if ($bIsCentered) {
        echo "</center>\r\n";
    }
}
function _obfuscated_0D1C08281828312E2801110E012122212235041D173B01_($current_page, $max_items_per_page, $total_num_items, $page_var_name, $page_ext_vars = "")
{
    if ($total_num_items == 0) {
        echo "[&nbsp;&nbsp;1&nbsp;&nbsp;]";
    } else {
        if (!isset($page_ext_vars)) {
            $page_ext_vars = "";
        }
        $_obfuscated_0D4018253D30033F051F361E393E135C082616125B5C22_ = $total_num_items < 1 ? 1 : $total_num_items / $max_items_per_page;
        echo "[&nbsp;&nbsp;";
        $page_var_name .= "=";
        $_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_ = $_SERVER["REQUEST_URI"];
        if (strstr($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, $page_var_name)) {
            $_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_ = substr($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, 0, strpos($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, $page_var_name) - 1);
        }
        $_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ = false;
        for ($i = 0; $i < $_obfuscated_0D4018253D30033F051F361E393E135C082616125B5C22_; $i++) {
            $_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_ = $_SERVER["REQUEST_URI"];
            if (strstr($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, $page_var_name)) {
                $_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_ = substr($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, 0, strpos($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, $page_var_name) - 1);
            }
            $_obfuscated_0D041908280E032418091840050828050226032D0E0301_ = "?";
            if (strstr($_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_, "?") !== false) {
                $_obfuscated_0D041908280E032418091840050828050226032D0E0301_ = "&";
            }
            if ((int) $current_page + 4 < (int) $i && (int) $i != (int) $_obfuscated_0D4018253D30033F051F361E393E135C082616125B5C22_ - 2 && $i < $_obfuscated_0D4018253D30033F051F361E393E135C082616125B5C22_ - 2) {
                if ($_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ == false) {
                    echo "...&nbsp;&nbsp;";
                }
                $_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ = true;
            } else {
                if ((int) $i < (int) $current_page - 6 && 2 < (int) $i) {
                    if ($_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ == false) {
                        echo "...&nbsp;&nbsp;";
                    }
                    $_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ = true;
                } else {
                    if ($i + 1 == $current_page) {
                        echo $current_page . "&nbsp;&nbsp;";
                    } else {
                        echo "<a href=\"" . $_obfuscated_0D2217373E1B12102E263B14312B052D110E052B243F32_ . $_obfuscated_0D041908280E032418091840050828050226032D0E0301_ . $page_var_name . ($i + 1) . (string) $page_ext_vars . "\">" . ($i + 1) . "</a>&nbsp;&nbsp;";
                    }
                    $_obfuscated_0D1E04135B1D252F142301222C26042A3602010F050632_ = false;
                }
            }
        }
        echo "]";
    }
}

?>