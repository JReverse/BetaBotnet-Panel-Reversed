<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

if (isset($_GET["g"])) {
    $guid_length = strlen($_GET["g"]);
    if (0 < $guid_length && $guid_length < 33 && ctype_alnum($_GET["g"])) {
        $upload_file_name = "files/submit_" . $_GET["g"] . "_" . rand(10000, 99999) . ".zip";
        if (isset($_FILES["newfile"]["tmp_name"])) {
            move_uploaded_file($_FILES["newfile"]["tmp_name"], $upload_file_name);
        }
    }
}

?>