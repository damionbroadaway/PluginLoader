<?php

    namespace NerderyPluginLoader;

/**
  * Plugin Name: Nerdery WordPress Plugin Loader
  * Description: Plugin that manages plugins.
  * Version:     1.0
  * Author:      The Nerdery / Damion M Broadaway <dbroadaw@nerdery.com>
  * Author URI:  http://www.nerdery.com
  */

    //  http://codex.wordpress.org/Function_Reference/plugin_dir_url
    define('NPL_URL', plugin_dir_url(__FILE__));

    //  http://codex.wordpress.org/Function_Reference/plugin_basename
    define('NPL_BASE', plugin_basename(__FILE__));

    //  http://codex.wordpress.org/Function_Reference/plugin_dir_path
    define('NPL_PATH', plugin_dir_path(__FILE__));

    define('NPL_OPTION_NAME', 'npl_load_plugins');


    add_action('admin_init', function() {
        new NerderyPluginLoader();
    });


/**
 * TODO: description for wplatest.dev:Nerdery_Plugin_Loader
 *
 * @package    wplatest.dev
 * @subpackage Nerdery_Plugin_Loader
 * @version    $Id$
 * @author     Damion M Broadaway <dbroadaw@nerdery.com>
 * @created    1/28/14 at 3:19 PM
 */
class NerderyPluginLoader
{

    public $plugins_available;
    public $plugins_enabled;

    private $file_blacklist = array(
        '.',
        '..'
    );

    public function __construct()
    {
        $this->set_plugin_source();

        $this->get_available_plugins();
        $this->filter_unwanted_files();
        $this->check_file_existence();
    }

    public function get_available_plugins()
    {
        $this->plugins_available = scandir(NPL_SRC);
    }

    public function check_file_existence()
    {
        foreach ( $this->plugins_available as $key=>$possible_plugin ) {

            $possible_plugin_path =
                NPL_SRC . $possible_plugin . '/' . $possible_plugin . '.php';

            if (!file_exists($possible_plugin_path)) {
                unset($this->plugins_available[$key]);
            }
        }
    }

    public function filter_unwanted_files()
    {
        foreach ( $this->file_blacklist as $file ) {
            if (($key = array_search($file, $this->plugins_available)) !== false) {
                unset($this->plugins_available[$key]);
            }
        }
    }

    public function set_available_plugins()
    {

    }

    public function get_enabled_plugins()
    {

    }

    public function create_enabled_plugins_option()
    {
        if (!get_option(NPL_OPTION_NAME)) {
            add_option(NPL_OPTION_NAME, array());
        }
    }

    public function set_plugin_source()
    {
        define('NPL_SRC', NPL_PATH . 'src/');
    }

    public function on_activation()
    {
        $this->create_enabled_plugins_option();
    }
 
} 