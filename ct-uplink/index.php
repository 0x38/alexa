<?php
/**
 * Created by PhpStorm.
 * User: svenw
 * Date: 24.03.17
 * Time: 14:18
 */

namespace Podcast;
use Alexa\Alexa_Exception;

require_once dirname( __FILE__ ) . '/podcast-class.php';

try {
	$podcast = new Podcast();

	$podcast->listen();
	echo $podcast->answer();
} catch ( Alexa_Exception $exception ) {
	echo $exception->getMessage();
}