<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("MOD_SETTINGS_AVCHECK_ALERT_WIDTH", 949);
define("CURRENT_AVCHECK_FILE", "current.dat");
define("SCAN4YOU_ADDY", "http://scan4you.net/remote.php");
define("SCAN4YOU_CLEAN_RESULT_STRING", "OK");
$scan_results = "";
$scan_results_num_detections = 0;
$scan_results_last_check = 0;
$was_info_modify_submit = false;
if (!empty($_POST) && !((int) $Session->Rights() & USER_PRIVILEGES_EDIT_SETTINGS)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to view or perform AV scans", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
} else {
    if (isset($_POST["avcheck_submit"])) {
        if (!isset($_FILES["file_newbuild"]["tmp_name"]) || strlen($_FILES["file_newbuild"]["name"]) == 0 || strlen($_FILES["file_newbuild"]["tmp_name"]) == 0) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to set new current build because a corresponding file form field could not be found.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
        } else {
            if (move_uploaded_file($_FILES["file_newbuild"]["tmp_name"], CURRENT_AVCHECK_FILE)) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "New current build has been set.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "An error occured while replacing the old build file. Please try again.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
            }
        }
    } else {
        if (isset($_POST["avcheck_checkdetections_submit"])) {
            if (strlen($sqlSettings->AVCheck_API_ID) == 0 || strlen($sqlSettings->AVCheck_API_Token) == 0) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Cannot perform file check. No valid API information was provided.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, SCAN4YOU_ADDY);
                curl_setopt($ch, CURLOPT_POST, true);
                $post = array("id" => $sqlSettings->AVCheck_API_ID, "token" => $sqlSettings->AVCheck_API_Token, "action" => "file", "uppload" => "@" . realpath(CURRENT_AVCHECK_FILE), "frmt" => "txt", "link" => "0");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $scan_results = curl_exec($ch);
                if ($scan_results === false || curl_errno($ch) || curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "CURL Encountered an error while checking with remote server.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                } else {
                    if (5 < strlen($scan_results)) {
                        $scan_results_num_detections = _obfuscated_0D1019150D2403075B125C05185B31191E082212321322_($scan_results);
                        $sqlSettings->AVCheck_SetLastResults($scan_results, $scan_results_num_detections);
                        $scan_results_last_check = time();
                    }
                }
            }
        } else {
            if (isset($_POST["avcheck_updateapi_submit"])) {
                $was_info_modify_submit = true;
                if (isset($_POST["avcheck_api_id"]) && isset($_POST["avcheck_api_token"]) && 0 < strlen($_POST["avcheck_api_id"]) && 0 < strlen($_POST["avcheck_api_token"])) {
                    if (32 < strlen($_POST["avcheck_api_id"]) || 256 < strlen($_POST["avcheck_api_token"]) || !ctype_alnum($_POST["avcheck_api_id"]) || !ctype_alnum($_POST["avcheck_api_token"])) {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "API ID and/or token was either NULL or invalid. Please try again.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                    } else {
                        if ($sqlSettings->AVCheck_SetUserInfo($_POST["avcheck_api_id"], $_POST["avcheck_api_token"])) {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "New API information was set", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                        } else {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "An error occured while setting new API information. Please try again.", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                        }
                    }
                } else {
                    if (!isset($_POST["avcheck_api_id"]) && !isset($_POST["avcheck_api_token"]) || strlen($_POST["avcheck_api_id"]) == 0 || strlen($_POST["avcheck_api_token"]) == 0) {
                        if ($sqlSettings->AVCheck_SetUserInfo("", "")) {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Current stored API information was cleared", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                        } else {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Error clearing API information", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
                        }
                    }
                }
            }
        }
    }
}
if (strlen($scan_results) < 5) {
    $scan_results = $sqlSettings->AVCheck_LastResult;
}
if ($scan_results_last_check == 0) {
    $scan_results_last_check = $sqlSettings->AVCheck_LastScanDate;
}
if ($scan_results_num_detections == 0) {
    $scan_results_num_detections = $sqlSettings->AVCheck_NumDetections;
}
if ($was_info_modify_submit == false && (strlen($sqlSettings->AVCheck_API_ID) == 0 || strlen($sqlSettings->AVCheck_API_Token) == 0)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_INFO, "You need to enter your S4Y API details in order to use this feature", true, MOD_SETTINGS_AVCHECK_ALERT_WIDTH);
}
$sqlSettings->GetSettings();
$current_file_exists = @file_exists(CURRENT_AVCHECK_FILE);
$current_file_size = 0;
$current_file_size = @filesize(CURRENT_AVCHECK_FILE);
echo "\r\n<!-- AV Check -->\r\n<div class=\"tabbable\" align=\"center\" style=\"margin-left:auto; margin-right:auto; width: 1050px;\">\r\n\t<ul class=\"nav nav-tabs\">\r\n\t\t<li class=\"active\"><a href=\"#pane1\" data-toggle=\"tab\">Scanner</a></li>\r\n\t\t<li><a href=\"#pane2\" data-toggle=\"tab\">API Account Information</a></li>\r\n\t</ul>\r\n\t<div class=\"tab-content\">\r\n\t<div id=\"pane1\" class=\"tab-pane active\">\r\n\t\t\r\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"1000\">\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t<br><strong>Current build information:</strong><br /><br><table class=\"table-condensed\" cellpadding=\"5\" valign=\"top\" align=\"left\" width=\"950\"><thead><tr><th width=\"20%\"></th><th width=\"80%\"></th></tr></thead><tbody>";
$current_file_size_string = $current_file_exists == true ? $current_file_size : "<i>N/A</i>";
echo "<tr><td style=\"border: hidden;\">Current file size:</td><td>";
echo $current_file_size_string . " byte(s)";
echo "</td></tr><tr><td style=\"border: hidden;\">Current detection count:</td><td>";
if (0 < $scan_results_num_detections) {
    echo "<font color=\"#E80000\">" . $scan_results_num_detections . "</font>";
} else {
    echo "<font color=\"#339900\">0</font>";
}
echo "</td></tr><tr><td style=\"border: hidden;\">Last scan date:</td><td>";
if ($scan_results_last_check == 0) {
    echo "<i>N/A</i>";
} else {
    echo date("m/d/Y h:i:s a", $scan_results_last_check);
}
echo "</td></tr></tbody></table>\t\t\t\t\t<br />\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t<br />\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t<form name=\"new_scan\" enctype=\"multipart/form-data\" style=\"display:inline;\" method=\"post\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\r\n\t\t\t\t\t<input id=\"ncheck\" name=\"file_newbuild\" type=\"file\" style=\"display:none\">\r\n\t\t\t\t\t<div class=\"input-append\">\r\n\t\t\t\t\t\t<span style=\"position: relative; top: -4px;\">New obfuscated bot build:&nbsp;&nbsp;</span><br />\r\n\t\t\t\t\t\t<input id=\"photoCover\" class=\"input-large\" type=\"text\" style=\"width: 300px;\">\r\n\t\t\t\t\t\t<a class=\"btn\" onclick=\"\$('input[id=ncheck]').click();\">Browse</a>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<script type=\"text/javascript\">\r\n\t\t\t\t\t\t\$('input[id=ncheck]').change(function() {\r\n\t\t\t\t\t\t\t\$('#photoCover').val(\$(this).val());}\r\n\t\t\t\t\t\t);\r\n\t\t\t\t\t</script>\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<input type=\"submit\" class=\"btn btn-success\" name=\"avcheck_submit\" value=\"Upload new distribution build\">\r\n\t\t\t\t\t<input type=\"submit\" class=\"btn\" name=\"avcheck_checkdetections_submit\" value=\"Check current build for detections\">\r\n\t\t\t\t\t</form>\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t\t\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t<br /><strong>Last scan result:</strong><br /><br />";
if (5 < strlen($scan_results)) {
    echo _obfuscated_0D3B12090F100E3740401032262C150D0C2A062D1B0B22_(htmlspecialchars($scan_results));
} else {
    echo "<i>N/A</i>";
}
echo "\t\t\t\t\t<br />\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t</table>\r\n\t</div>\r\n\t<div id=\"pane2\" class=\"tab-pane\">\r\n\t\t<form name=\"new_scan\" enctype=\"multipart/form-data\" style=\"display:inline;\" method=\"post\" action=\"";
echo $_SERVER["REQUEST_URI"];
echo "\">\r\n\t\t<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"1000\">\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t";
global $sqlSettings;
echo "<br /><strong>Scan4you API details:</strong><br /><br />API User ID: &nbsp;";
echo "<input name=\"avcheck_api_id\" class=\"input-large\" type=\"text\" value=\"" . htmlspecialchars($sqlSettings->AVCheck_API_ID) . "\" style=\"width: 220px;\">";
echo "<br />API Token: &nbsp;";
echo "<input name=\"avcheck_api_token\" class=\"input-large\" type=\"text\" value=\"" . htmlspecialchars($sqlSettings->AVCheck_API_Token) . "\" style=\"width: 220px;\">";
echo "<br /><br /><input type=\"submit\" class=\"btn\" name=\"avcheck_updateapi_submit\" value=\"Update user api information\">\t\t\t\t\t<br />\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t</table>\r\n\t\t</form>\r\n\t</div>\r\n</div>\r\n";
function _obfuscated_0D1019150D2403075B125C05185B31191E082212321322_($avresults)
{
    if (strlen($avresults) < 5) {
        return 0;
    }
    $_obfuscated_0D2B2A1636380121383D1816370D1A1A0B384008282801_ = 0;
    $_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_ = explode("\n", $avresults);
    if ($_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_) {
        foreach ($_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_ as $_obfuscated_0D012D1424211A333B2F4011213B22312F280D2F2F0732_) {
            $_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_ = explode(":", $_obfuscated_0D012D1424211A333B2F4011213B22312F280D2F2F0732_);
            if ($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_ && isset($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[0]) && isset($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[1]) && $_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[1] != SCAN4YOU_CLEAN_RESULT_STRING) {
                $_obfuscated_0D2B2A1636380121383D1816370D1A1A0B384008282801_++;
            }
        }
    }
    return $_obfuscated_0D2B2A1636380121383D1816370D1A1A0B384008282801_;
}
function _obfuscated_0D3B12090F100E3740401032262C150D0C2A062D1B0B22_($avresults)
{
    if (strlen($avresults) < 5) {
        return "<i>N/A</i>";
    }
    $_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_ = explode("\n", $avresults);
    if ($_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_) {
        echo "<table class=\"table-condensed\" cellpadding=\"5\" valign=\"top\" align=\"left\" width=\"950\"><thead><tr><th width=\"35%\"></th><th width=\"65%\"></th></tr></thead><tbody>";
        foreach ($_obfuscated_0D023C33153C3B3F3939223D270A14213F3F1114111922_ as $_obfuscated_0D012D1424211A333B2F4011213B22312F280D2F2F0732_) {
            $_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_ = explode(":", $_obfuscated_0D012D1424211A333B2F4011213B22312F280D2F2F0732_);
            if ($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_ && isset($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[0]) && isset($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[1])) {
                echo "<tr><td style=\"border: hidden;\">";
                echo $_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[0];
                echo "</td><td>";
                if ($_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[1] != SCAN4YOU_CLEAN_RESULT_STRING) {
                    echo "<font color=\"#E80000\">" . $_obfuscated_0D3429073C3C34300B243B06382A0A1E33030E3E1D0D32_[1] . "</font>";
                } else {
                    echo "<font color=\"#339900\">Clean</font>";
                }
                echo "</td></tr>";
            }
        }
        echo "</tbody></table>";
    }
}

?>