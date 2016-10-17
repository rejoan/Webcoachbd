<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * utility library
 */
class Nuts_lib {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * view loader
     * @param string $dirn directory name from where header, footer & leftbar load
     * @param string $view_name name of the view file
     * @param string $view_from name of the directory from where view file load
     * @param array $data data to pass to view files
     * @param type $leftbar left sidebar
     */
    public function view_loader($dirn = NULL, $view_name = 'index', $view_from = NULL, $data = array(), $leftbar = NULL) {
        if (!empty($dirn)) {
            $dirn = $dirn . '/';
        }
        if (!empty($view_from)) {
            $view_from = $view_from . '/';
        }

        $this->CI->load->view($dirn . 'header', $data);
        if (!empty($leftbar)) {
            $this->CI->load->view($dirn . $leftbar);
        }
        $this->CI->load->view($view_from . $view_name);

        $this->CI->load->view($dirn . 'footer');
    }

    /**
     * is menu will be selected
     * @param string $strngs
     * @return type
     */
    public function is_selected($strngs) {
        $chk_str = explode(',', $strngs);
        for ($s = 0; $s < count($chk_str); $s++) {
            $segm = str_replace('/', '\/', trim($chk_str[$s]));
            $pattern = "/$segm/";
            $is_exist = preg_match($pattern, $_SERVER['REQUEST_URI']);
            if ($is_exist) {
                return 'active';
            }
        }
        //return FALSE;
    }

    /**
     * get all country list
     * @return array
     */
    public function get_countries() {
        $countries = array(
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia, Plurinational State of',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, the Democratic Republic of the',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => "Côte d'Ivoire",
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => "Korea, Democratic People's Republic of",
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => "Lao People's Democratic Republic",
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, the former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Réunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthélemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin (French part)',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and the South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan, Province of China',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela, Bolivarian Republic of',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        );
        return $countries;
    }

    /**
     * check is authorized user or logged in
     * @param string $redirect_url
     * @param int $user_type
     * @return boolean
     */
    public function is_logged($redirect_url = 'authentication/login') {
        if ($this->CI->session->user_type) {
            return TRUE;
        } else {
            redirect_tr($redirect_url);
        }
    }

    /**
     * 
     * @return string
     */
    public function get_timezones() {
        $timezones = array(
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Europe/Moscow' => "(GMT+03:00) Moscow",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );
        return $timezones;
    }

    /**
     * check if super admin
     * @return boolean
     */
    public function is_admin($redirect_url = 'authentication/login', $is_view = TRUE) {
        $level = $this->CI->session->user_type;
        if ($level == 'admin') {
            return TRUE;
        } else {
            if ($is_view) {
                return FALSE;
            }
            redirect($redirect_url);
        }
    }

    /**
     * 
     * @param type $redirect_url
     * @param type $access
     * @param type $is_view
     * @return boolean
     */
    public function is_authorized($redirect_url = 'authentication/login', $access = NULL, $is_view = TRUE) {
        $level = $this->CI->session->user_type;
        if ($level == 'admin') {
            return TRUE;
        } else {

            $accesses = $this->CI->config->item($level);
            $acs = in_array($access, $accesses);

            if ($acs !== TRUE) {
                if ($is_view) {
                    return FALSE;
                }
                redirect($redirect_url);
            }
        }
    }

    /**
     * generate breadcrumb based on controller & method
     */
    public function breadcrumb() {
        $controller = $this->CI->router->fetch_class();
        $cn = str_replace('_', ' ', $controller);
        $method_name = $this->CI->router->fetch_method();
        $mn = str_replace('_', ' ', $method_name);
        if ($controller != '') {
            $action_name = '<li><a href="' . site_url($controller . "/index") . '">' . ucwords($cn) . '<i class="fa fa-angle-right"></i></a></li>';
        } else {
            $action_name = '';
        }
        if ($mn != '') {
            $method = '<li class="active">' . ucwords($mn) . '</li>';
        } else {
            $method = '';
        }
        $crumb = '<ul class="page-breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home<i class="fa fa-angle-right"></i></a></li>' . $action_name . $method . '</ul>';
        echo $crumb;
    }

    /**
     * get comma separated column name from array
     * @param array $results
     * @param string $id name of colum need comma separated data
     * @return string
     */
    public function get_all_ids($results, $id = 'id') {
        $all_id = '';
        foreach ($results as $key => $val) {
            if ($key == 0) {
                $all_id .= $val[$id];
            } else {
                $all_id .= ',' . $val[$id];
            }
        }
        return $all_id;
    }

    /**
     * get config object
     * @return \SimpleXMLElement
     */
    public function get_config() {
        $this->CI->load->helper('file');
        $xml = read_file('./application/config/bksh_config.xml');
        $obj = new SimpleXMLElement($xml);
        return $obj;
        //return json_decode(json_encode($obj), TRUE);
    }

    /**
     * check if a datetime valid
     * @param datetime $date
     * @param string $format
     * @return bool
     */
    public function valid_date($date, $format = 'd/m/Y g:i A') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * check current time is between two datetime
     * @param datetime $from
     * @param datetime $to
     * @param datetime $date
     * @return bool
     */
    public function date_is_between($from, $to, $date = 'now') {
        $date = is_int($date) ? $date : strtotime($date);
        $from = is_int($from) ? $from : strtotime($from);
        $to = is_int($to) ? $to : strtotime($to);
        return ($date > $from) && ($date < $to);
    }

    /**
     * tab action
     */
    public function new_tab() {
        if ($this->CI->router->fetch_class() == 'bkash') {
            return 'target="_blank"';
        }
    }

    /**
     * convert seconds to d:m:y:h:i:s
     * @param int $ss
     * @return string
     */
    public function seconds_to_time($ss) {
        $s = $ss % 60;
        $m = floor(($ss % 3600) / 60);
        $h = floor(($ss % 86400) / 3600);
        $d = floor(($ss % 2592000) / 86400);
        $M = floor($ss / 2592000);

        $s = $s < 10 ? '0' . $s : $s;
        $m = $m < 10 ? '0' . $m : $m;
        $h = $h < 10 ? '0' . $h : $h;
        $d = $d < 10 ? '0' . $d : $d;
        $M = $M < 10 ? '0' . $M : $M;
        $month = $M < 1 ? '' : $M . ' mon ';
        $day = $d < 1 ? '' : $d . ' day ';
        return $month . $day . $h . ':' . $m . ':' . $s;
    }

    /**
     * get duration of two datetime in H:m:s
     * @param datetime $start
     * @param datetime $end
     * @return string
     */
    public function duration($start, $end) {
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);
        $duration = '';
        if ($interval->h > 0) {
            $duration .= $interval->h . ' Hour ';
        }
        if ($interval->i > 0) {
            $duration .= $interval->i . ' Min ';
        }
        $duration .= $interval->s . ' Sec';
        return $duration;
    }

    /**
     * encrypt data
     * @param string $string
     * @param magic $key
     * @return string
     */
    public function process_xor($string, $key = 'spbkxt') {
        $result = '';
        $str = (string) $string;
        for ($i = 0; $i < strlen($str); $i++) {
            $tmp = $str[$i];
            for ($j = 0; $j < strlen($key); $j++) {
                $tmp = chr(ord($tmp) ^ ord($key[$j]));
            }
            $result .= $tmp;
        }
        return $result;
    }

    /**
     * get start and endtime from url when search
     * @param string $redirect
     * @return array
     */
    public function start_end_time($redirect) {
        $settings = $this->get_config();
        $db_zone = $settings->db_timezone;
        $client_zone = $settings->client_timezone;
        if ($this->CI->input->get('ts')) {
            $time_span = $this->CI->input->get('ts');
            if ($time_span === '') {
                redirect($redirect);
            }
            $parsed = explode('-', $time_span);
            $start = trim($parsed[0]);

            if (!$this->valid_date($start) || !isset($parsed[1])) {
                redirect($redirect);
            }
            $end = trim($parsed[1]);
            if (!$this->valid_date($end)) {
                redirect($redirect);
            }

            $d_start = DateTime::createFromFormat('d/m/Y g:i A', $start, new DateTimeZone($client_zone));
            $d_start->setTimezone(new DateTimeZone($db_zone));
            $start_time = $d_start->format('Y-m-d H:i:s');
            $d_end = DateTime::createFromFormat('d/m/Y g:i A', $end, new DateTimeZone($client_zone));
            $d_end->setTimezone(new DateTimeZone($db_zone));
            $end_time = $d_end->format('Y-m-d H:i:s');
        } else {
            $d_start = new DateTime('today midnight', new DateTimeZone($client_zone));
            $d_start->setTimezone(new DateTimeZone($db_zone));
            $start_time = $d_start->format('Y-m-d H:i:s');
            $d_end = new DateTime('now', new DateTimeZone($client_zone));
            $d_end->setTimezone(new DateTimeZone($db_zone));
            $end_time = $d_end->format('Y-m-d H:i:s');
        }
        return array($start_time, $end_time);
    }

    /**
     * 
     * @param type $client_zone
     * @return type
     */
    public function date_ranger($client_zone) {
        $now = new DateTime('now', new DateTimeZone($client_zone));
        $curr_date = $now->format('d/m/Y g:i A');
        $prev_7 = new DateTime('today midnight', new DateTimeZone($client_zone));
        $last_7days = $prev_7->format('d/m/Y g:i A');
        return $last_7days . ' - ' . $curr_date;
    }

    /**
     * format datetime as client timezone
     * @param string $format_from from which format
     * @param string $d date to format
     * @param string $db_zone server/database timezone
     * @param string $client_zone client timezone
     * @param string $to_format expected format
     * @return string
     * @author rejoanul alam <rejoan.er@gmail.com>
     */
    public function date_formation($format_from, $d, $db_zone = 'America/New_York', $client_zone = 'Asia/Dhaka', $to_format = 'd M Y, h:i:s A') {
        $to_time = DateTime::createFromFormat(
                        $format_from, $d, new DateTimeZone($db_zone));
        $date = $to_time->setTimeZone(new DateTimeZone($client_zone));
        return $date->format($to_format);
    }

    /**
     * 
     * @param string $format date format from which to convert
     * @param string $d date
     * @param string $to_format desired date format
     * @return string
     */
    public function date_formatter($format, $d, $to_format = 'Y-m-d H:i:s') {
        //var_dump($format,$d,$to_format);return;
        $date = DateTime::createFromFormat(
                        $format, $d);
        $final_date = $date->format($to_format);
        return $final_date;
    }

    public function strpos_offset($search, $string, $offset) {
        $arr = explode($search, $string);
        switch ($offset) {
            case $offset == 0:
                return false;
                break;

            case $offset > max(array_keys($arr)):
                return false;
                break;

            default:
                return strlen(implode($search, array_slice($arr, 0, $offset)));
        }
    }

    /**
     * generate pagination configuration settings
     * @param int $page_query total number of rows
     * @param int $total_rows per page row number to show
     * @param int $num_links number of links to show as links
     * @param string $url pagination URL
     * @return string
     */
    public function get_paginate($total_rows, $per_page, $url) {
        //var_dump(ceil($total_rows / $per_page));
        $this->CI->load->library('pagination');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['num_links'] = ceil($total_rows / $per_page);
        $config['enable_query_strings'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        $config['base_url'] = $url;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['next_link'] = 'Next >';
        $config['prev_link'] = '< Prev';
        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }

    /**
     * get lat long by address
     * @param string $address
     * @param string $country
     * @return array
     */
    public function get_lat_long($address, $country) {
        $adds = str_replace(' ', '+', trim($address));
        $lat_long = array();
        $json = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $adds . '&sensor=false&region=' . $country);

        $json = json_decode($json);
        //var_dump($json->results);return;
        if (!empty($json) && !empty($json->results)) {
            $lat = $json->results[0]->geometry->location->lat;
            $long = $json->results[0]->geometry->location->lng;
            $lat_long['lat'] = $lat;
            $lat_long['long'] = $long;
        }
        return $lat_long;
    }
    
    public function getPackageStatusText($status){
        switch ($status) {
            case 1:
                return lang('waiting');
                break;
            case 2:
                return lang('returned').' / '.lang('back_in_stock');
                break;
            case 3:
                return lang('in_tour');
                break;
            case 4:
                return lang('delivered');
                break;
            default:
                break;
        }
    }
    
    

}
