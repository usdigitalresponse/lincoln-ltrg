<?php
/**
 * Plugin Name: Automatic Translate Addon For TranslatePress
 * Description: Auto language translator add-on for TranslatePress official plugin to translate website into any language via fully automatic machine translations via Yandex Translate Widget.
 * Author: Cool Plugins
 * Author URI: https://coolplugins.net/
 * Plugin URI:
 * Version: 0.7
 * License: GPL2
 * Text Domain:TPA
 * Domain Path: languages
 */
if (!defined('ABSPATH')) {
    exit;
}
if (defined('TPA_VERSION')) {
    return;
}
define('TPA_VERSION', '0.7');
define('TPA_FILE', __FILE__);
define('TPA_PATH', plugin_dir_path(TPA_FILE));
define('TPA_URL', plugin_dir_url(TPA_FILE));
if (!class_exists('TranslatePressAddon')) {
    class TranslatePressAddon
    {
        /**
         *  Construct the plugin object
         */
        public function __construct(){
            register_activation_hook(__FILE__, array($this, 'tpa_activate'));
            add_filter('trp_string_groups',array($this,'tpa_string_groups'));
            add_action('plugins_loaded', array($this, 'tpa_check_required_plugin'));
            if(!is_admin()){
              add_action('trp_translation_manager_footer',array($this,'tpa_register_assets') );
            }  
            add_action('wp_ajax_tpa_get_strings',array($this,'tpa_getstrings'));
            add_action( 'wp_ajax_tpa_save_translations',array($this, 'tpa_save_translations') );
        }
        // set settings on plugin activation
  		 public function tpa_activate() {
            update_option("tpa-v",TPA_VERSION);
            update_option("tpa-type","FREE");
            update_option("tpa-installDate",date('Y-m-d h:i:s') );
            update_option("tpa-ratingDiv","no");
        }
        /**
        * Change string groups
        */
        public function tpa_string_groups()
        {
            $string_groups = array(
                'slugs' => 'Slugs',
                'metainformation' => 'Meta Information', 
                'stringlist' =>'String List',
                'gettextstrings' =>'Gettext Strings', 
                'images' => 'Images',
                'dynamicstrings' =>'Dynamically Added Strings',
            );
            return $string_groups;
        }
        /*
        |----------------------------------------------------------------------
        | check if required "TranslatePress - Multilingual" plugin is active
        | also register the plugin text domain
        |----------------------------------------------------------------------
        */
        public function tpa_check_required_plugin(){
            if (!function_exists('trp_enable_translatepress')) {
                add_action('admin_notices', array($this, 'tpa_plugin_required_admin_notice'));
            }
            
			if( is_admin() ){
            /** Feedback form after deactivation */
            require_once __DIR__ . "/admin/feedback/admin-feedback-form.php";
            /*** Plugin review notice file */ 
			require_once(TPA_PATH.'admin/tpa-feedback-notice.php');
            new TPAFeedbackNotice();
            }
            load_plugin_textdomain('TPA', false, basename(dirname(TPA_FILE)) . '/languages/');
        }
        /*
        |----------------------------------------------------------------------
        | Notice to 'Admin' if "TranslatePress - Multilingual" is not active
        |----------------------------------------------------------------------
        */
        public function tpa_plugin_required_admin_notice(){
            if ( current_user_can( 'activate_plugins' ) ) {
            $url = 'plugin-install.php?tab=plugin-information&plugin=TranslatePress - Multilingual&TB_iframe=true';
            $title = "TranslatePress - Multilingual";
            $plugin_info = get_plugin_data(TPA_FILE, true, true);
            echo '<div class="error"><p>' . 
            sprintf(__('In order to use <strong>%s</strong> plugin, please install and activate the latest version  of <a href="%s" class="thickbox" title="%s">%s</a>', 
            'automatic-translator-addon-for-loco-translate'),
            $plugin_info['Name'], esc_url($url),
            esc_attr($title), esc_attr($title)) . '.</p></div>';
            }
        }
        /**
        *  Register Assets
        * Hooked to trp_translation_manager_footer.
        */
        public function tpa_register_assets(){
            wp_register_script('tpscript',TPA_URL.'assets/js/tpa-custom-script.js',array('jquery','jquery-ui-dialog'), TPA_VERSION);
            wp_register_script( 'tpa-yandex-widget', TPA_URL.'assets/js/widget.js?widgetId=ytWidget&pageLang=en&widgetTheme=light&autoMode=false',array(),TPA_VERSION, true);
            wp_register_style('tpa-editor-styles', TPA_URL . 'assets/css/tpa-custom.css', null, TPA_VERSION,'all');
            $extraData['preloader_path']=TPA_URL.'/assets/images/preloader.gif';
            $extraData['gt_preview']=TPA_URL.'/assets/images/powered-by-google.png';
            $extraData['dpl_preview']=TPA_URL.'/assets/images/powered-by-deepl.png';
            $extraData['yt_preview']=TPA_URL.'/assets/images/powered-by-yandex.png';
            $extraData['ajax_url']=admin_url( 'admin-ajax.php' );
            $extraData['nonce']=wp_create_nonce('auto-translate-press-nonces');
            $extraData['plugin_url']=plugins_url();
            wp_enqueue_script('tpscript');
            wp_localize_script('tpscript', 'extradata', $extraData);
            wp_enqueue_script('tpa-yandex-widget');
            wp_print_styles('tpa-editor-styles');
        }
        /**
         * Get Data From Database
         * Hooked to wp_ajax_get_strings.
        */
        public function tpa_getstrings(){
            // Ready for the magic to protect our code
            check_ajax_referer('auto-translate-press-nonces');
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            global $wpdb;
            $result =array();
            $data = array();
            $default_code = isset($_POST['data'])?sanitize_text_field($_POST['data']):'';
            $default_language = isset($_POST['default_lang'])?sanitize_text_field($_POST['default_lang']):''; 
            $current_page_id = isset($_POST['dictionary_id'])?sanitize_text_field($_POST['dictionary_id']):'';
            $gettxt_id = isset($_POST['gettxt_id'])?sanitize_text_field($_POST['gettxt_id']):'';
            $strings_ID = explode(",",$current_page_id);
            $get_txt_ids = explode(",",$gettxt_id);
            $in_str_arrs = array_fill( 0, count($get_txt_ids), '%d' );
            $in_strs = join( ',', $in_str_arrs );
            $in_str_arr = array_fill( 0, count($strings_ID), '%d' );
            $in_str = join( ',', $in_str_arr );
            $def_lang = strtolower($default_language);
            $table2 =  $wpdb->get_blog_prefix() . 'trp_gettext_' . strtolower( $default_code );
            $table1 = $wpdb->get_blog_prefix() . 'trp_dictionary_'.$def_lang.'_' . strtolower( $default_code );
            $results_gettxt = $wpdb->get_results($wpdb->prepare(
                "SELECT id,original_id,original FROM $table1 WHERE id IN ($in_str) AND  status!='2'",$strings_ID)
            );
            $results = $wpdb->get_results($wpdb->prepare(
                "SELECT id,original FROM $table2 WHERE id IN ($in_strs) AND status!='2'",$get_txt_ids)
            );
            $final_res = array_merge($results_gettxt,$results);
            if(is_array($final_res)&& count($final_res)>0){
                foreach ( $final_res as $row ){
                    $original_id = isset($row->original_id)?absint($row->original_id):'';
                    $original = isset($row->original)?$row->original:'';
                    $string = htmlspecialchars_decode($original);
                    if($string != strip_tags($string)) {
                        continue;
                    }
                    else if (preg_match($reg_exUrl, $string)) {
                      continue;
                    }
                    if($original_id==""){
                        $group = 'Gettext';
                    }
                    else{
                        $group = 'String'; 
                    }
                    $data['strings'] = $string;
                    $data['database_ids'] = isset($row->id)?absint($row->id):'';
                    $data['data_group'] = $group;;   
                    $result[] = $data;
                }
            }
            echo json_encode($result);
            wp_die();
        }
        /**
         *  save translation from ajax post
         * Hooked to wp_ajax_save_translations.
        */
        public function tpa_save_translations(){
            // Ready for the magic to protect our code
            check_ajax_referer('auto-translate-press-nonces');
            global $wpdb;
            $strings=filter_var_array(json_decode(stripslashes($_POST['data']),true),FILTER_SANITIZE_STRING);
            if(is_array($strings)&& count($strings)>0){
                $table1_query = array();
                $table2_query = array();
                $table1 = null;
                $table2 = null;
                foreach ( $strings as $languages => $string ) {
                    $types = isset($string['data_group'])?sanitize_text_field($string['data_group']):'';
                    $default_code = isset($string['language_code'])?sanitize_text_field($string['language_code']):'';
                    $default_language = isset($string['default_lang'])?sanitize_text_field($string['default_lang']):'';
                    $def_lang = strtolower($default_language);
                    $table2 =  $wpdb->get_blog_prefix() . 'trp_gettext_' . strtolower( $default_code );
                    $table1 = $wpdb->get_blog_prefix() . 'trp_dictionary_'.$def_lang.'_' . strtolower( $default_code );
                        if($types=="String"){
                            $table_name = sanitize_text_field($table1);
                            $table1_query[] = $string;
                        }
                        else{
                            $table_name =sanitize_text_field($table2);
                            $table2_query[] = $string;
                        }
                }
                if($table1!=null && $table2!=null){
                    $this->wp_insert_rows($table1, true, 'id', $table1_query);
                    $this->wp_insert_rows($table2, true, 'id', $table2_query);
                }
                wp_die();
            }
        }
        /**
        *  A method for inserting multiple rows into the specified table
        *  Updated to include the ability to Update existing rows by primary key
        */
        public function wp_insert_rows($wp_table_name,$update = false, $primary_key = 'id',$row_arrays = array()){
            global $wpdb;
            $wp_table_name = esc_sql($wp_table_name);
            // Setup arrays for Actual Values, and Placeholders
            $values = array();
            $place_holders = array();
            $query = "";
            $query_columns = "";
            $query .= "INSERT INTO `{$wp_table_name}` (";
            foreach ($row_arrays as $count => $row_array) {
                foreach ($row_array as $key => $value) {
                    if(in_array($key,array('data_group','original','language_code','database_id','default_lang'))){
                        continue;
                    }
                    if ($count == 0) {
                        if ($query_columns) {
                            $query_columns .= ", `" . $key . "`";
                        } else {
                            $query_columns .= "`" . $key . "`";
                        }
                    }
                    $values[] = $value;
                    $symbol = "%s";
                    if (is_numeric($value)) {
                        $symbol = "%d";
                    }
                    if (isset($place_holders[$count])) {
                        $place_holders[$count] .= ", '$symbol'";
                    } else {
                        $place_holders[$count] = "( '$symbol'";
                    }
                }
                // mind closing the GAP
                $place_holders[$count] .= ")";
            }
            $query .= " $query_columns ) VALUES ";
            $query .= implode(', ', $place_holders);
            if ($update) {
                $update = " ON DUPLICATE KEY UPDATE `$primary_key`=VALUES( `$primary_key` ),";
                $cnt = 0;
                foreach ($row_arrays[0] as $key => $value) {
                    if(in_array($key,array('data_group','original','language_code','database_id','default_lang'))){
                        continue;
                    }
                    if ($cnt == 0) {
                        $update .= "`$key`=VALUES(`$key`)";
                        $cnt = 1;
                    } else {
                        $update .= ", `$key`=VALUES(`$key`)";
                    }
                }
                $query .= $update;
            }
            $sql = $wpdb->prepare($query, $values);
            if ($wpdb->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    /**
    * TranslatePressAddon Class Close
    */
    }
}
new TranslatePressAddon();