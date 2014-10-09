<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cookiemonster Class
 *
 * @package     ExpressionEngine
 * @category    Plugin
 * @author      Ciprian Popescu
 * @copyright   Copyright (c) 2013, Ciprian Popescu
 * @link        http://getbutterfly.com/expressionengine/
 */

$plugin_info = array(
    'pi_name'         => 'Cookie Monster',
    'pi_version'      => '0.3',
    'pi_author'       => 'Ciprian Popescu',
    'pi_author_url'   => 'http://getbutterfly.com/expressionengine/',
    'pi_description'  => 'This plugin outputs a cookie compliance consent bar.',
    'pi_usage'        => Cookiemonster::usage()
);

class Cookiemonster {
    public $return_data = '';

    public function __construct() {
        $link = ee()->TMPL->fetch_param('link');

        $consent = ee()->TMPL->tagdata;
        
        // $plugin_path = PATH_THIRD; // not working with local ports
        $plugin_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', PATH_THIRD);

        $out = '';
        // setcookie('cookiemonster', 'true'); // manually set the cookie

        if(isset($_COOKIE['cookiemonster']) && $_COOKIE['cookiemonster'] == 'true') {
        }
        else {
            $out .= '
            <style type="text/css">
            #cookie-consent-container { width: 100%; background-color: #161616; color: #ffffff; position: fixed; top: 0; left: 0; z-index: 9999; border-left: 4px solid #ff6677; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.1); box-shadow: 0 1px 2px rgba(0,0,0,0.1); }
            #cookie-consent-wrapper { margin: 0 auto; text-align: center; text-align: left; padding: 8px 16px; position: relative; }
            #cookie-consent-container p { font-size: 13px; margin: 0; }
            #cookie-consent-container a { color: #ffffff; }
            </style>
            <div id="overlay-wrapper"><div id="cookie-consent-container" style="display: block;"><div id="cookie-consent-wrapper"><p>' . $consent . ' <a href="" onclick="document.cookie=\'cookiemonster=true\';">' . $link . '</a></p></div></div></div>';
        }

        $this->return_data .= $out;
    }

    public static function usage() {
        ob_start();  ?>
{exp:cookiemonster link="Agree and close this notice."}By continuing to use this site you consent to the use of cookies on your device as described in our cookie policy unless you have disabled them. You can change your cookie settings at any time but parts of our site will not function correctly without them.{/exp:cookiemonster}

Place this tag inside your header template, right after the opening BODY tag. You may modify or translate both the link text and the consent as you see fit.
    <?php
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }


    // END
}
/* End of file pi.cookiemonster.php */
/* Location: ./system/expressionengine/third_party/cookiemonster/pi.cookiemonster.php */