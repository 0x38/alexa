<?php

namespace WP_Sofa;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-sdk/alexa-class.php';

class WP_Sofa_Pocast extends \Alexa\Alexa {

	public function __construct() {
		$this->text_launch = 'Setz Dich hin, nimm Dir einen Keks und sag uns einfach welche Folge Du hören willst.';
		$this->text_end = 'Ach mensch hier ist doch so gemütlich! Naja, dann bis bald!';
		$this->text_dont_understood = 'Ich habe Dich leider nicht verstanden.';

		parent::__construct();
	}

	public function interact( $intent ) {
		// TODO: Implement interact() method.
		parent::interact( $intent );
	}
}