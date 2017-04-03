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
	public function __construct( $application_id ) {
		$this->text_launch = $this->rand_text();

		parent::__construct( $application_id );
	}

	private function rand_text() {
		$text = array(
			'Geh sterben',
			'Helene Fischer, die singende Sagrotanflasche? Vergiss es!',
			'Ich bin doch nicht blöd!',
			'Du Vollpfosten!',
			'Du hast doch einen an der Matte!',
			'Willst Du einen Flug Buchen zum Ballermann? Da spielen die so einen Schrott!',
			'Mir wird schlecht...',
			'Leidest Du unter Geschmacksverkalkung?',
			'Atemlos, Durch die Nacht... Das reicht...',
			'Der Selbstzerstörungsmodus wurde aktiviert. 10, 9, 8, 7, 6, 5, 4, 3, 2, 1... Boom!',
			'Ich kann nichts trinken und ohne Alkohol tu ich mir das nicht an!',
			'Ich kann diese Bratze nicht ausstehen!',
			'Hast Du Lack gesoffen?',
			'Guck mal da, ein Eichhörnchen!'
		);

		$array_key = array_rand( $text, 1 );

		return $text[ $array_key ];
	}

	protected function interact( $intent ) {
		return $this->response_speak( 'Geh sterben!' );
	}
}

try {
	$skill = new My_Skill( 'amzn1.ask.skill.f66f9cb9-c632-42bb-be50-210f1d6164b6' );
	$skill->log( $skill->request()->intent()->get_slots() );
	$skill->log( $skill->request()->intent()->get_slot_names() );
	$skill->log( $skill->request()->intent()->get_slot_names() );
	$skill->run();
} catch ( Exception $exception ) {
	echo $exception->getMessage();
}