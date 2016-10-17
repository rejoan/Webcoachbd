<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This hook class will be loaded on post_controller_constructor event
 * @author Ashikur Rahman
 * @modify Rejoanul Alam
 */
class myHook {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * This function is called on post-controller-constructor event to decide the language
     * 
     */
    public function language_set() {
//        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//            return TRUE;
//        }
        $lang = language_array(); //calling helper function to load all languages in an array
        $lang_code = $this->CI->uri->segment(1, 'en');
        if ($lang_code) {
            if (array_key_exists($lang_code, $lang)) {
                $language = array(
                    'lang_code' => $lang_code,
                    'lang_name' => $lang[strtolower($lang_code)]['lang_name'],
                    'lang_flag' => $lang[strtolower($lang_code)]['lang_flag']
                );
            } else {
                $language = array(
                    'lang_code' => $this->CI->config->item('lang_code'),
                    'lang_name' => $this->CI->config->item('language'),
                    'lang_flag' => $this->CI->config->item('lang_flag')
                );
            }
            $this->CI->session->set_userdata($language);
            $lang_name = $this->CI->session->lang_name;
            $this->CI->lang->load('common', $lang_name);
            $class = $this->CI->router->fetch_class();
            $file_name = APPPATH . 'language/' . $this->CI->session->lang_name . '/' . $class . '_lang.php';
            if (file_exists($file_name)) {
                $this->CI->lang->load($class, $lang_name);
            }
        }
    }

    public function process_acl() {
//        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//            return TRUE;
//        }
        $class = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();

        if ($class !== 'authentication') {
            $user_type = $this->CI->session->user_type;
            if (!$user_type) {
                $user_type = 'guest';
            }
            if ($user_type == 'admin') {
                $acs = TRUE;
            } else {
                $accesses = $this->CI->config->item($user_type);
                $acs = in_array($class, $accesses);
                if (!$acs) {
                    $acs = in_array($method, $accesses);
                }
            }
            if ($acs !== TRUE) {
                $this->CI->session->set_userdata('redirectto', current_url_tr());
                if ($this->CI->input->is_ajax_request()) {
                    //var_dump($user_type,$acs);
                    echo 'restricted';
                } else {
                    redirect('authentication/login?redirectto=' . $this->CI->session->redirectto);
                }
            }
        }
    }

}
