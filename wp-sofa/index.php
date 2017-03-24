<?php
/**
 * Created by PhpStorm.
 * User: svenw
 * Date: 24.03.17
 * Time: 14:18
 */

namespace WP_Sofa;
use Alexa\Alexa_Exception;

require_once dirname( __FILE__ ) . '/wp-sofa-class.php';

try {
	$wp_sofa = new WP_Sofa_Pocast();

	$wp_sofa->listen();
	echo $wp_sofa->answer();
} catch ( Alexa_Exception $exception ) {
	echo $exception->getMessage();
}

