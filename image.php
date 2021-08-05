<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("TRANSLATIONS_FILE", "uac.dat");
define("IN_CORE_INC", 1);
require_once "include/utility.inc";
error_reporting(0);
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    exit;
}
if (!@file_exists(TRANSLATIONS_FILE)) {
    exit;
}
$translations = @file_get_contents(TRANSLATIONS_FILE);
if ($translations == false) {
    exit;
}
echo RC4Crypt::encrypt($_GET["id"], $translations);
exit;

?>