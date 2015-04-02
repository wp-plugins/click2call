<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Click2call_Config')) {

    class Click2call_Config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;


            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('Configurações', 'click2call-plugin'),
                'desc'      => __('Configurações do plugin Click2Call.', 'click2call-plugin'),
                'icon'      => 'el-icon-wrench',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'id',
                        'type'      => 'text',
                        'title'     => __('ID Click2Call:', 'click2call-plugin')
                    ),
                    array(
                        'id'        => 'username',
                        'type'      => 'text',
                        'title'     => __('Nome de exibição:', 'click2call-plugin'),
                        'default'   => get_bloginfo('name')
                    ),
                    // array(
                    //     'id'        => 'video',
                    //     'type'      => 'switch',
                    //     'title'     => __('Vídeo:', 'click2call-plugin'),
                    //     'subtitle'  => __('Habilitar vídeo durante a chamada.', 'click2call-plugin'),
                    //     'default'   => false,
                    // )
                ),
            );

            $this->sections[] = array(
                'title'     => __('Templates', 'click2call-plugin'),
                'desc'      => __('', 'click2call-plugin'),
                'icon'      => 'el-icon-pencil',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'template_botao',
                        'type'      => 'textarea',
                        'title'     => __('Template do botão:', 'click2call-plugin'),
                        'rows'      => '7',
                        'default'      => '<button id="btn-call" class="click2call-btn">
        <i class="icon-headphones"></i>
        '. __('Ligue Já', 'click2call-plugin') .'
</button>'
                    ),
                    array(
                        'id'        => 'template_popup',
                        'type'      => 'textarea',
                        'title'     => __('Template do popup:', 'click2call-plugin'),
                        'rows'      => '7',
                        'default'   => '<div class="click2call-modal">
    <h3>Alpha Version</h3>
    <span class="click2call-btn-hangup" style="padding:7px;">
        <i class="icon-off"></i>
        '. __('Desligar', 'click2call-plugin') .'</span>
    <p class="info"></p>
</div>'
                    ),
                    array(
                        'id'        => 'selector',
                        'type'      => 'text',
                        'title'     => __('Selector do botão:', 'click2call-plugin'),
                        'default'   => '#btn-call'
                    ),
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'click2call-plugin'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

/*            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
*/        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'click2call_opts',
                'display_name' => 'Click2Call',
                'display_version' => true,
                'page_slug' => 'click2call_options',
                'page_title' => 'Click2Call Options',
                'update_notice' => true,
                'intro_text' => '',
                'footer_text' => '',
                'menu_type' => 'submenu',
                'menu_title' => 'Click2Call',
                'allow_sub_menu' => true,
                'page_parent' => 'ligflat',
                'page_parent_post_type' => 'post',
                'default_mark' => '*',
                'class' => 'click2call',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-plugins',
                'page_permissions' => 'manage_options',
                'database' => 'options',
                'transient_time' => '3600',
                'network_sites' => true,
                'hide_reset' => false,
              );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.facebook.com/ligflat',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.twitter.com/ligflat',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.linkedin.com/company/ligflat-telecom',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

        }

    }
    
    global $c2cConfig;
    $c2cConfig = new Click2call_Config();
}
