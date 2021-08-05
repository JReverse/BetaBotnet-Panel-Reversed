<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "\n\t";
define("MAX_NOTICE_MESSAGE_SIZE", 512);
define("NOTICES_ALERT_WIDTH", 949);
$notice_content_length = 0;
$notice_reduce_by = 0;
if (!((int) $Session->Rights() & USER_PRIVILEGES_MANAGE_NOTICES)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to view or manage notices.", true, NOTICES_ALERT_WIDTH);
} else {
    $default_allow_removal_check = "checked";
    $default_notice_appears_as_red_check = "";
    $default_notice_display_more_pages_check = "";
    $notice_content_length = (int) isset($_POST["notice_add_content"]) ? (int) strlen($_POST["notice_add_content"]) : 0;
    if (isset($_POST["notice_add_content_submit"]) && isset($_POST["notice_add_content"])) {
        if (0 < $notice_content_length && $notice_content_length <= (int) MAX_NOTICE_MESSAGE_SIZE) {
            if (substr_count($_POST["notice_add_content"], "\n") < 6) {
                $notice_content = @bin2hex($_POST["notice_add_content"]);
                $notice_author = @bin2hex(@$Session->Get(SESSION_INFO_USERNAME));
                $notice_target = @bin2hex($_POST["notice_add_target_user"]);
                $notice_options = 0;
                if (isset($_POST["notice_add_allow_remove_on_display"])) {
                    $notice_options |= NOTICE_OPTION_ALLOW_REMOVE;
                    $default_allow_removal_check = "checked";
                } else {
                    $default_allow_removal_check = "";
                }
                if (isset($_POST["notice_add_as_red"])) {
                    $notice_options |= NOTICE_OPTION_VIEW_AS_RED;
                    $default_notice_appears_as_red_check = "checked";
                } else {
                    $default_notice_appears_as_red_check = "";
                }
                if (isset($_POST["notice_add_display_more_pages"])) {
                    $notice_options |= NOTICE_OPTION_DISPLAY_IMPORTANT_PAGES;
                    $default_notice_display_more_pages_check = "checked";
                } else {
                    $default_notice_display_more_pages_check = "";
                }
                if ($sqlDefault->Query("INSERT INTO " . $sqlDefault->pdbname . ".notices VALUES(NULL, UNHEX('" . $notice_target . "'), UNHEX('" . $notice_author . "'), UNHEX('" . $notice_content . "'), '" . $notice_options . "')")) {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Notice was successfully added.", true, NOTICES_ALERT_WIDTH);
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to add notice to database.", true, NOTICES_ALERT_WIDTH);
                }
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Please do not use more than 5 line breaks in your notice.", true, NOTICES_ALERT_WIDTH);
            }
        } else {
            if ((int) MAX_NOTICE_MESSAGE_SIZE < $notice_content_length) {
                $notice_reduce_by = (int) ((int) $notice_content_length - (int) MAX_NOTICE_MESSAGE_SIZE);
                $notice_size_invalid_msg = "Notice appears to be an invalid size (" . $notice_content_length . "). Must not be greater than " . MAX_NOTICE_MESSAGE_SIZE . " character(s). Please reduce your message by " . $notice_reduce_by . " character(s) and try again.";
            } else {
                $notice_size_invalid_msg = "The notice message you supplied appears to be empty. Please add content (up to " . MAX_NOTICE_MESSAGE_SIZE . " characters(s)) and try again.";
            }
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $notice_size_invalid_msg, true, NOTICES_ALERT_WIDTH);
        }
    } else {
        if (isset($_GET["delete_notice"])) {
            $delete_id = (int) $_GET["delete_notice"];
            if ($sqlDefault->Query("DELETE FROM " . $sqlDefault->pdbname . ".notices WHERE id = '" . $delete_id . "' LIMIT 1")) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Notice was successfully removed.", true, NOTICES_ALERT_WIDTH);
            } else {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed remove notice from database.", true, NOTICES_ALERT_WIDTH);
            }
        }
    }
    $total_num_notices = 0;
    $all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices");
    if ($all_notices) {
        $total_num_notices = (int) mysql_num_rows($all_notices);
    }
    echo "\t\t\n\t\t<font size=\"1\" face=\"Tahoma\">\n\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\" width: 1000px;\">\n\t\t\t<tr>\n\t\t\t\t<td>\n\t\t\t\t\t<form name=\"notice_manage\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\">\n\t\t\t\t\t\t<span style=\"position: relative; top: 7px;\">Enter notice text:</span><br />\n\t\t\t\t\t\t<textarea name=\"notice_add_content\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 90px; width: 780px;\">";
    echo isset($_POST["notice_add_content"]) ? @htmlspecialchars($_POST["notice_add_content"]) : "";
    echo "</textarea>\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<span style=\"position: relative; top: 15px;\">Enter target user for notice <i>(Leave blank to display for all users) </i>:</span><br />\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input type=\"text\" class=\"span3\" name=\"notice_add_target_user\" value=\"";
    echo isset($_POST["notice_add_target_user"]) ? @htmlspecialchars($_POST["notice_add_target_user"]) : "";
    echo "\" style=\"width: 190px; font-size: 10px; face: font-family: Tahoma;\">\n\t\t\t\t\t    <br />\n\t\t\t\t\t\t\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 260px; position: relative; top: 8px;\">\n\t\t\t\t\t\t  <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"notice_add_allow_remove_on_display\" style=\"position: relative; top: -1px\" ";
    echo $default_allow_removal_check;
    echo ">\n\t\t\t\t\t\t  Allow users to remove notice after seeing it\n\t\t\t\t\t    </label>\n\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 270px; position: relative; top: 9px;\">\n\t\t\t\t\t\t  <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"notice_add_as_red\" style=\"position: relative; top: -1px\" ";
    echo $default_notice_appears_as_red_check;
    echo ">\n\t\t\t\t\t\t  Make this notice appear as red (Color of error notices)\n\t\t\t\t\t    </label>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<label class=\"checkbox\" style=\"font-size: 10px; face: font-family: Tahoma; width: 440px; position: relative; top: 9px;\">\n\t\t\t\t\t\t  <input type=\"checkbox\" id=\"optionsCheckbox\" name=\"notice_add_display_more_pages\" style=\"position: relative; top: -1px\" ";
    echo $default_notice_display_more_pages_check;
    echo ">\n\t\t\t\t\t\t  Force notice to appear on several other important pages (tasks / statistics / panel settings)\n\t\t\t\t\t    </label>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<br />\n\t\t\t\t\t\t<input name=\"notice_add_content_submit\" value=\"Add Notice\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 3px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 80px;\">\n\t\t\t\t\t</form>\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t</table>\n\t\t</font>\n\t\t\n\t\t<font size=\"1\" face=\"Tahoma\">\n\t\t<!-- Filter list table -->\n\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\" width: 1000px;\">\n\t\t\t<thead>\n\t\t\t\t<tr>\n\t\t\t\t\t<th width=\"20\">ID</th>\n\t\t\t\t\t<th width=\"65\">Author</th>\n\t\t\t\t\t<th width=\"65\">Target user</th>\n\t\t\t\t\t<th width=\"500\">Notice</th>\n\t\t\t\t\t<th width=\"25\">Options</th>\n\t\t\t\t</tr>\n\t\t\t</thead>\n\t\t\t<tbody>\n\t\t\t";
    if (0 < $total_num_notices) {
        while ($current_row = @mysql_fetch_assoc($all_notices)) {
            _obfuscated_0D243E0238241A21073B210B05350514352C3829310511_($current_row["id"], $current_row["notice_author"], $current_row["notice_target"], $current_row["notice_content"], $current_row["notice_options"]);
        }
    } else {
        echo "<tr><td></td><td></td><td></td><td>No notices have been created ...</td><td></td></tr>";
    }
    echo "\t\t\t</tbody>\n\t\t</table>\n\t\t<br />\n\t\t<center><i>* Rows that appear as the color orange are notices set to appear on all important panel pages</i></center>\n\t\t</font>\n\t\n\t";
}
echo "\t\t\t\t\t";

?>