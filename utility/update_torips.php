<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

define("IN_UPDATETORIPS", 1);
require "../include/core.inc";
if (!defined("IN_CORE_INC")) {
    exit;
}
$num_added = 0;
if (isset($_GET["do_update"])) {
    $tor_file_data = file_get_contents("./utility/tor_ips.txt");
    if ($tor_file_data && 2048 < strlen($tor_file_data)) {
        $torip_array = explode("\n", $tor_file_data);
        if ($torip_array) {
            global $sqlDefault;
            $countalong = 0;
            echo "Truncating existing `tor_ip` table ...<br />\r\n";
            $sqlDefault->Query("TRUNCATE TABLE " . $sqlDefault->pdbname . ".tor_ips");
            foreach ($torip_array as $torip) {
                $torip2 = str_replace("\r", "", $torip);
                $torip2 = str_replace("\n", "", $torip2);
                $torip2 = str_replace("\t", "", $torip2);
                $torip2 = str_replace(" ", "", $torip2);
                $countalong = 0;
                if (ip2long($torip2) != 0) {
                    $ip_ulong = sprintf("%u", ip2long($torip2));
                    if (!$sqlDefault->Query("INSERT INTO " . $sqlDefault->pdbname . ".tor_ips VALUES('" . $ip_ulong . "', '0')")) {
                        echo "Error: " . mysql_error() . "<br />\r\n";
                    } else {
                        $num_added++;
                        if (250 <= $countalong++) {
                            echo "Progress - " . $num_added . " IP(s) added since script began ...<br />\r\n";
                            $countalong = 0;
                        }
                    }
                }
            }
        } else {
            exit("Error parsing IPs into array");
        }
    } else {
        exit("Unable to get TOR IPs file data");
    }
}
if (0 < $num_added) {
    exit("Added " . $num_added . " IP(s) to blacklist");
}
echo "\n<HTML>\n\n<a href=\"";
echo $_SERVER["REQUEST_URI"] . "&do_update=true";
echo "\">Click here to read /tor_ips.txt and insert those IPs into DB!tor_ips table</a>\n\n</HTML>";

?>