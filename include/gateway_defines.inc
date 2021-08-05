<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

if (!defined("IN_CORE_INC")) {
    exit("..");
}
define("BB_JPEG_HEADER", "SSSCCCC");
define("BOT_REQUEST_HEADER_MAGIC", 49637);
define("BOT_REQUEST_HEADER_SIZE_INFO", "a8ignored/vheader_size");
define("BOT_REQUEST_HEADER", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vrequest_type/Vbot_version/Vbot_os/Vbot_attributes/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vavs_installed/Vsoftware_installed/Vexceptions_info/Vlast_error/Vex_param_4/Vex_param_5/Vex_param_6/Vex_param_7/a8reserved_space");
define("BOT_REQUEST_HEADERv15", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vrequest_type/Vbot_version/Vbot_os/Vbot_attributes/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vtaskid_error_1/Vtaskid_error_2/Vtaskid_error_3/Vtaskid_error_4/Vavs_installed/Vsoftware_installed/Vexceptions_info/Vlast_error/Vex_param_4/Vex_param_5/Vex_param_6/Vex_param_7/a12group_name");
define("BOT_REQUEST_HEADERv17", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vrequest_type/Vbot_version/Vbot_os/Vbot_attributes/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vcfg_versions_plugins/Vcfg_versions_web/Vtaskid_error_1/Vtaskid_error_2/Vtaskid_error_3/Vtaskid_error_4/Vtaskid_error_5/Vtaskid_error_6/Vavs_installed/Vsoftware_installed/Vexceptions_info/Vlast_error/Vex_param_4/Vex_param_5/Vex_param_6/Vex_param_7/a12group_name");
define("BOT_REQUEST_HEADERv1801", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vbot_version/Vrequest_type/Vbot_os/Vbot_attributes/Vbot_custom_attributes/a8reserved_space/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vcfg_versions_plugins/Vcfg_versions_web/Vtaskid_error_1/Vtaskid_error_2/Vtaskid_error_3/Vtaskid_error_4/Vtaskid_error_5/Vtaskid_error_6/Vavs_installed/Vsoftware_installed/Vexceptions_info/Vlast_error/Vweb_attributes/Vex_param_5/Vex_param_6/Vex_param_7/Vex_param_8/Vex_param_9/a12group_name");
define("BOT_REQUEST_HEADERv1802", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vbot_version/Vrequest_type/Vbot_os/Vbot_attributes/Vbot_custom_attributes/Vdebug_attributes/a8reserved_space/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vcfg_versions_plugins/Vcfg_versions_web/Vtaskid_error_1/Vtaskid_error_2/Vtaskid_error_3/Vtaskid_error_4/Vtaskid_error_5/Vtaskid_error_6/Vavs_installed/Vsoftware_installed/Vexceptions_info/Vlast_error/Vweb_attributes/Vex_param_5/Vex_param_6/Vex_param_7/Vex_param_8/Vex_param_9/a12group_name/a20bot_process_name");
define("BOT_REQUEST_HEADERv1803", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vbot_version/Vrequest_type/Vbot_os/Vbot_attributes/Vbot_custom_attributes/Vdebug_attributes/a8reserved_space/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vcfg_versions_plugins/Vcfg_versions_web/Vcfg_versions_reserved_1/Vcfg_versions_reserved_2/Vtaskid_error_1/Vtaskid_error_2/Vtaskid_error_3/Vtaskid_error_4/Vtaskid_error_5/Vtaskid_error_6/Vtaskid_error_7/Vtaskid_error_8/Vavs_installed/Vsoftware_installed/Vsecurity_tools_installed/Vavs_killed/Vweb_attributes/Vex_param_5/Vex_param_6/Vex_param_7/Vex_param_8/Vex_param_9/Vex_param_10/Vex_param_11/vexception_access_violation/vexception_priv_instruction/vexception_illegal_instruction/vexception_stack_overflow/vexception_in_page_error/vexception_unused_1/vexception_unused_2/vexception_unused_3/vexception_unused_4/vexception_unused_5/vexception_unused_6/vexception_unused_7/vpersist_num_file_restores/vnum_crash_restarts/vlow_ex_param_unused_3/vlow_ex_param_unused_4/vlow_ex_param_unused_5/vlow_ex_param_unused_6/vlow_ex_param_unused_7/vlow_ex_param_unused_8/vlow_ex_param_unused_9/vlow_ex_param_unused_10/vlow_ex_param_unused_11/vlow_ex_param_unused_12/a12group_name/a20bot_process_name");
define("BOT_REQUEST_HEADERv1805", "Vcrypt_reserved1/Vcrypted_reserved2/vheader_size/vmagic/Vheader_crc32/Vstrings_count/Vexdata_key/Vbot_version/Vrequest_type/Vbot_os/Vbot_attributes/Vbot_custom_attributes/Vdebug_attributes/a8reserved_space/Vbot_time_current/Vbot_time_uptime/Vbot_time_gmt/Vlocale/vbots_killed/vsocks_port/a16machine_id/Vcfg_versions_config/Vcfg_versions_dns_blocklist/Vcfg_versions_url_tracklist/Vcfg_versions_filesearch/Vcfg_versions_plugins/Vcfg_versions_web/Vcfg_versions_reserved_1/Vcfg_versions_reserved_2/Vtaskid_info_1/Ctaskid_flags_1/Vtaskid_info_2/Ctaskid_flags_2/Vtaskid_info_3/Ctaskid_flags_3/Vtaskid_info_4/Ctaskid_flags_4/Vtaskid_info_5/Ctaskid_flags_5/Vtaskid_info_6/Ctaskid_flags_6/Vtaskid_info_7/Ctaskid_flags_7/Vtaskid_info_8/Ctaskid_flags_8/Vavs_installed/Vsoftware_installed/Vsecurity_tools_installed/Vavs_killed/Vweb_attributes/Vmonitor_resolution/Vexploit_info/Vex_param_7/Vex_param_8/Vex_param_9/Vex_param_10/Vex_param_11/vexception_access_violation/vexception_priv_instruction/vexception_illegal_instruction/vexception_stack_overflow/vexception_in_page_error/vexception_unused_1/vexception_unused_2/vexception_unused_3/vexception_unused_4/vexception_unused_5/vexception_unused_6/vexception_unused_7/vpersist_num_file_restores/vnum_crash_restarts/vlow_ex_param_unused_3/vlow_ex_param_unused_4/vlow_ex_param_unused_5/vlow_ex_param_unused_6/vlow_ex_param_unused_7/vlow_ex_param_unused_8/vlow_ex_param_unused_9/vlow_ex_param_unused_10/vlow_ex_param_unused_11/vlow_ex_param_unused_12/a12group_name/a20bot_process_name");
define("BOT_RESPONSE_HEADER", "VVVVVVVVVVVVVVVVVVVVVVV");
define("BOT_RESPONSE_HEADERv1801", "VVVVVVVVVVVVVVVVVVVVVVVVVV");
define("BOT_RESPONSE_HEADERv1806", "VVVVVVVVVVVVVVVVVVVVVVVVVVV");
define("BOT_RESPONSE_CMD_HEADER", "vVVa12");
define("BOT_RESPONSE_CMD_HEADERv1806", "VVVa12");
define("BOT_TASKS_EXTENDED_COMMAND_DATA_MAX_SIZE", 65536);
define("BOT_REQUEST_HEADER_SIZE", 128);
define("BOT_REQUEST_HEADER_SIZEv15", 148);
define("BOT_REQUEST_HEADER_SIZEv17", 164);
define("BOT_REQUEST_HEADER_SIZEv1801", 184);
define("BOT_REQUEST_HEADER_SIZEv1802", 208);
define("BOT_REQUEST_HEADER_SIZEv1803", 280);
define("BOT_REQUEST_HEADER_SIZEv1805", 292);
define("BOT_RESPONSE_HEADER_SIZE", 92);
define("BOT_RESPONSE_HEADER_SIZEv1801", 104);
define("BOT_RESPONSE_HEADER_SIZEv1806", 108);
define("HDR_RESERVED", 0);
define("VER_RESERVED", 0);
define("BOT_REQUEST_TYPE_CHECK_IN", 1);
define("BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN", 2);
define("BOT_REQUEST_TYPE_UPDATE_STATISTICS", 4);
define("BOT_REQUEST_TYPE_UPDATE_INFOBLOBS", 256);
define("BOT_REQUEST_TYPE_FORMGRAB_DATA", 8);
define("BOT_REQUEST_TYPE_STEALER_DATA", 16);
define("BOT_REQUEST_STRING_DEFAULT", "cs");
define("BOT_REQUEST_STRING_INSTALL_PATH", "cs1");
define("BOT_REQUEST_STRING_DEFAULT_BROWSER", "cs2");
define("BOT_REQUEST_STRING_COMPUSER_NAME", "cs3");
define("BOT_REQUEST_POST_FORMGRAB_HOST", "fsh");
define("BOT_REQUEST_POST_FORMGRAB_FORM_DATA", "fsb");
define("BOT_REQUEST_POST_FORMGRAB_FORM_HEADER_DATA", "fsd");
define("BOT_REQUEST_POST_FORMGRAB_HOST_PROCESS", "fsp");
define("BOT_RESPONSE_FAILED", 0);
define("BOT_RESPONSE_OK", 1);
define("BOT_RESPONSE_WAIT_ON_NEXT_CHECKIN", 257);
define("BOT_RESPONSE_STEALER_DATA_RECEIVED", 258);
define("BOT_RESPONSE_NOT_FOUND_RESUBMIT", 259);
define("BOT_RESPONSE_OK_PROCESS_DISPOSITION", 260);
define("BOT_REQUEST_LOGINS_COUNT_XOR_KEY", 436796987);
define("BOT_REQUEST_LOGINS_COUNT_XOR_KEY_V17", 2365390869.0);
define("BOT_REQUEST_LOGINS_COUNT_XOR_KEY_V1801", 32387014);
define("BOT_RESPONSE_HEADER_RC4_SALT", PANEL_CRYPT_CODE1);
define("BOT_RESPONSE_EXDATA_RC4_SALT", PANEL_CRYPT_CODE2);
define("BOT_RESPONSE_HEADER_RC4_SALT_8BIT", 203);
define("BOT_RESPONSE_EXDATA_RC4_SALT_8BIT", 31);
define("BOT_RESPONSE_HEADER_RC4_SALT_8BIT_v1801", 226);
define("BOT_RESPONSE_EXDATA_RC4_SALT_8BIT_v1801", 59);
define("BOT_REQUEST_POST_VAR_CRYPTKEY", "ps0");
define("BOT_REQUEST_POST_VAR_HEADER", "ps1");
define("BOT_DISPOSITION_UNINSTALL_SELF", 68117);
define("GRAB_LOGIN_TYPE_INTERNET_EXPLORER", 15);
define("GRAB_LOGIN_TYPE_FIREFOX", 16);
define("GRAB_LOGIN_TYPE_CHROME", 17);
define("GRAB_LOGIN_TYPE_FTP_MIN_TYPE_VALUE", 1);
define("GRAB_LOGIN_TYPE_FTP_MAX_TYPE_VALUE", 14);
define("GRAB_LOGIN_TYPE_FTP_NETWORK_CAPTURE", 14);
define("GRAB_LOGIN_TYPE_PUTTY_CAPTURE", 1);
define("GRAB_LOGIN_TYPE_POP3", 18);
define("GRAB_LOGIN_TYPE_POP3_SSL", 19);
define("GRAB_LOGIN_TYPE_FTP_NETWORK_CAPTURE_SSL", 20);

?>