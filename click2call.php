<?php
/*
Plugin Name: Click2Call
Description:  Shortcode e Widget para o Click2Call
Plugin URI: http://click2call.us
Version: v1
Author: LigFlat
*/

require_once(dirname(__FILE__).'/core.php');
require_once(dirname(__FILE__).'/admin/admin-init.php');

class WP_Click2Call {
    static $c2c;

    static function init() {
        global $click2call_opts;

        self::$c2c = new Click2Call(
                $click2call_opts['id'],
                $click2call_opts['username'],
                $click2call_opts['video'],
                $click2call_opts['template_botao'],
                $click2call_opts['template_popup'],
                $click2call_opts['selector']
            );

        self::actions();

        load_plugin_textdomain('click2call-plugin', false, basename( dirname( __FILE__ ) ) . '/lang' );
    }

    static function actions() {
        add_action('wp_enqueue_scripts', array('WP_Click2call', 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array('WP_Click2call', 'enqueue_scripts'));
        add_action('wp_footer', array('WP_Click2call', 'button_script'));
        add_action( 'admin_menu', array('WP_Click2call', 'admin_menu'), 9 );

        add_shortcode('click2call', array('WP_Click2call', 'shortcode'));
    }

    /**
     * Adds top level Ligflat menu
     */
    static function admin_menu() {
        add_menu_page( 'Ligflat', 'LigFlat', 'manage_options',
                        'ligflat', null, 'dashicons-phone', 66 );

        /*global $c2cConfig;
        add_submenu_page( 'ligflat', 'Click2Call', 'Click2Call', 'manage_options',
                            'click2call-plugin',  array(&$c2cConfig, '_options_page_html'));*/

        // fix for redux submenu add
        global $submenu;
        if (!isset($submenu['ligflat']))
            $submenu['ligflat'] = [];
    }

    // Enqueue the JS Api and Admin Css
    static function enqueue_scripts() {
        if (!is_admin()) {
            // if (isset(self::$c2c->$config['id']) && !empty(self::$c2c->$config['id']))
                wp_enqueue_script( 'click2call', 'http://api.ligflat.com.br/click2call/click2call.min.js', array('jquery'), 1, true );
        }
        else {
            // admin stylesheet
            wp_enqueue_style( 'click2call', plugin_dir_url( __FILE__ ) .'assets/css/style.css' );
        }
    }
    static function button_script() {
        echo self::$c2c->button_script();
    }

    static function shortcode()
    {
        echo self::$c2c->button();
    }

}
add_action('plugins_loaded', array('WP_Click2call', 'init'));

class WP_Click2Call_Widget extends WP_Widget
{
	public function widget($args, $instance)
    {
		echo $args['before_widget'];

        global $click2call_opts;
        $c2c = new Click2Call(
                $click2call_opts['id'],
                $click2call_opts['username'],
                $click2call_opts['video'],
                $click2call_opts['template_botao'],
                $click2call_opts['template_popup'],
                $click2call_opts['selector']
            );
        echo $c2c->button();

		echo $args['after_widget'];
	}

	function __construct() {
		parent::__construct(
			'click2call_widget', // Base ID
			__('Click2Call', 'text_domain' ), // Name
			array( 'description' => __( 'Click2Call Widget', 'text_domain' ), ) // Args
		);
	}
}
add_action('widgets_init', function(){
     register_widget( 'WP_Click2Call_Widget');
});
