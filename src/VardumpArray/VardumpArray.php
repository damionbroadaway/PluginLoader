<?php

    namespace NerderyPluginLoader\VardumpArray;
    use WPSettingsBuilder\WPSettingsBuilder;


/**
 * TODO: description for VardumpArray.php
 *
 * @package    wplatest.dev
 * @subpackage VardumpArray.php
 * @version    $Id$
 * @created    1/29/14 at 12:53 PM
 */

    add_action('the_post', array('VardumpArray', 'genesis'));

/**
 * TODO: description for wplatest.dev:VardumpArray
 *
 * @package    wplatest.dev
 * @subpackage VardumpArray
 * @version    $Id$
 * @author     Damion M Broadaway <dbroadaw@nerdery.com>
 * @created    1/29/14 at 12:53 PM
 */
class VardumpArray
{

    public $wpsb;

    public function __construct()
    {
        $this->wpsb = new WPSettingsBuilder();
        var_dump(__CLASS__);
    }

    public function genesis()
    {
        new VardumpArray();
    }
 
} 