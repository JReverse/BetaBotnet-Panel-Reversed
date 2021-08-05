<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

echo "\t";
define("FILESEARCH_CONFIG_FILE", "filesearch.dat");
if (!((int) $Session->Rights() & USER_PRIVILEGES_MANAGE_NOTICES)) {
    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Your account is not allowed to view or manage notices.", true, 1000);
} else {
    if (isset($_POST["fs_content_submit"])) {
        if (!isset($_POST["fs_add_content"])) {
            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Missing form fields.", true, 1000);
        } else {
            $old_data = @str_replace("\r", "", @file_get_contents(FILESEARCH_CONFIG_FILE));
            $old_data_checksum = 0;
            if ($old_data) {
                $old_data_checksum = (int) crc32($old_data);
            }
            $new_data = trim(str_replace("\r", "", $_POST["fs_add_content"]));
            $new_data = str_replace("\\\\", "\\", $new_data);
            $new_data_checksum = (int) crc32($new_data);
            $objMemCache = new CMemoryCache();
            $objMemCache->Initialize();
            $MemCacheInitialized = $objMemCache->IsInitialized();
            if (0 < strlen(str_replace("\n", "", $new_data))) {
                $new_data_elements = explode("\n", $new_data);
                $any_error = 0;
                $current_term = 0;
                $was_an_error = false;
                if ($new_data_elements) {
                    foreach ($new_data_elements as $dt_element) {
                        $element_len = strlen($dt_element);
                        $num_errors = 0;
                        if ($element_len == 0) {
                            continue;
                        }
                        if (stripos($dt_element, "#") === 0) {
                            $any_error = 0;
                            continue;
                        }
                        if (stripos($dt_element, "ext=") === 0) {
                            if (_obfuscated_0D28062E3F12192C310402271A1A372A2D31061D3D0522_(substr($dt_element, 4, $element_len - 4)) == false) {
                                $any_error = 1;
                            }
                        } else {
                            if (stripos($dt_element, "term=") === 0) {
                                $current_term++;
                                if (_obfuscated_0D3131011C0B5B0623062F0933391B0E2A3C093E162611_(substr($dt_element, 5, $element_len - 5)) == false) {
                                    $any_error = 2;
                                }
                            } else {
                                if (stripos($dt_element, "filename=") === 0) {
                                    $current_term++;
                                    if (_obfuscated_0D3131011C0B5B0623062F0933391B0E2A3C093E162611_(substr($dt_element, 5, $element_len - 5)) == false) {
                                        $any_error = 2;
                                    }
                                } else {
                                    if (stripos($dt_element, "exclude=") === 0) {
                                        if (_obfuscated_0D3131011C0B5B0623062F0933391B0E2A3C093E162611_(substr($dt_element, 5, $element_len - 5)) == false) {
                                            $any_error = 2;
                                        }
                                    } else {
                                        if (stripos($dt_element, "nocache=") === 0) {
                                            if (_obfuscated_0D3131011C0B5B0623062F0933391B0E2A3C093E162611_(substr($dt_element, 5, $element_len - 5)) == false) {
                                                $any_error = 2;
                                            }
                                        } else {
                                            $any_error = 3;
                                        }
                                    }
                                }
                            }
                        }
                        if ($any_error != 0) {
                            $was_an_error = true;
                            if ($any_error == 1) {
                                _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "The extensions parameter is invalid. It is either too small, or contains invalid characters. Please only use ANSI alphanumeric characters.", true, 1000);
                            } else {
                                if ($any_error == 2) {
                                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Term #" . $current_term . " is invalid. It may be too short or too long, and must also only contain only ANSI keyboard characters. No control codes are allowed.", true, 1000);
                                } else {
                                    if ($any_error == 3) {
                                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "A line with unknown phrases was encountered. Please follow the config file format.", true, 100);
                                    }
                                }
                            }
                            $any_error = 0;
                            if (1 < $num_errors++) {
                                break;
                            }
                        }
                    }
                }
                if ($was_an_error == false) {
                    if (file_put_contents(FILESEARCH_CONFIG_FILE, $new_data) !== false) {
                        if ($old_data_checksum != $new_data_checksum) {
                            global $sqlSettings;
                            if ($MemCacheInitialized == true) {
                                $objMemCache->Set(CACHE_CONFIG_FILE_SEARCH, $new_data);
                            }
                            $sqlSettings->Update_FileSearch_Revision();
                            global $sqlSettings;
                            global $main_sql_link;
                            global $Session;
                            $elogs = new CLogs();
                            $elogs->SetInternalLink($main_sql_link);
                            $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FILE_SEARCH_UPDATED, "File Search configuration updated");
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully set new file search parameters", true, 1000);
                        } else {
                            _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "No changes were made because the data entered matched the previous data.", true, 1000);
                        }
                    } else {
                        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to set new file search parameters. Check access rights on file '" . FILESEARCH_CONFIG_FILE . "'", true, 1000);
                    }
                }
            } else {
                if (file_put_contents(FILESEARCH_CONFIG_FILE, "") !== false) {
                    if ($MemCacheInitialized == true) {
                        $objMemCache->Set(CACHE_CONFIG_FILE_SEARCH, "clr");
                    }
                    $sqlSettings->Update_FileSearch_Revision();
                    global $sqlSettings;
                    global $main_sql_link;
                    global $Session;
                    $elogs = new CLogs();
                    $elogs->SetInternalLink($main_sql_link);
                    $elogs->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_FILE_SEARCH_UPDATED, "File Search configuration cleared");
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_SUCCESS, "Successfully cleared file search parameters.", true, 1000);
                } else {
                    _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to clear file search parameters. Check access rights on file '" . FILESEARCH_CONFIG_FILE . "'", true, 1000);
                }
            }
        }
    }
    $fs_data_form = "";
    $fs_data = @file_get_contents(FILESEARCH_CONFIG_FILE);
    if ($fs_data) {
        $fs_data_form = $fs_data;
    }
    echo "\t\t\r\n\t\t<font size=\"1\" face=\"Tahoma\">\r\n\t\t<table class=\"table table-bordered table-condensed table-striped\" align=\"center\" valign=\"top\" style=\" width: 1000px;\">\r\n\t\t\t<tr>\r\n\t\t\t\t<td>\r\n\t\t\t\t\t<form name=\"fs_manage\" method=\"post\" action=\"";
    echo $_SERVER["REQUEST_URI"];
    echo "\">\r\n\t\t\t\t\t\tSearch terms & extensions configuration data:\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<textarea name=\"fs_add_content\" type=\"text\" class=\"span3\" style=\"position: relative; top: 8px; font-size: 10px; face: font-family: Tahoma; height: 360px; width: 800px;\">";
    echo @htmlspecialchars($fs_data_form);
    echo "</textarea>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<input name=\"fs_content_submit\" value=\"Save configuration\" type=\"submit\" class=\"btn\" style=\"position: relative; top: 3px; font-size: 10px; face: font-family: Tahoma; height: 26px; width: 160px;\">\r\n\t\t\t\t\t</form>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\t<br />\r\n\t\t\t\t\tNumber of <strong>zip</strong> files in upload directory <i>(/files/)</i> : ";
    echo count(glob(DIR_FILES . "/*.zip"));
    echo "<br />\r\n\t\t\t\t</td>\r\n\t\t\t</tr>\r\n\t\t</table>\r\n\t\t</font>\r\n\t\t\r\n\t";
}

?>