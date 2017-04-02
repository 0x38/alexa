<?php
/**
 * We are testing the Alexa SDK
 */

namespace Alexa_Test;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/traits/logger-trait.php';

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/application-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/exception-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/intent-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/request-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/response-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/session-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/slot-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/user-class.php';
require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/classes/skill-class.php';


use Alexa;
use Alexa\Application;
use Alexa\Exception;
use Alexa\Intent;
use Alexa\Request;
use Alexa\Response;
use Alexa\Session;
use Alexa\Slot;
use Alexa\User;
use Alexa\Skill;
use Alexa\Logger;

class My_Skill extends Skill {
	protected $text_launch = 'Geh sterben!';
	public function interact( $intent ) {
		return $this->response_speak( 'Geh sterben!' );
	}
}

try {
	$skill = new My_Skill( 'amzn1.ask.skill.f66f9cb9-c632-42bb-be50-210f1d6164b6' );
	$skill->run();
} catch ( Exception $exception ) {
	echo $exception->getMessage();
}