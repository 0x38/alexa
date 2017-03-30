<?php

namespace WP_Sofa;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-podcast/alexa-podcast-class.php';

class WP_Sofa_Pocast extends \Alexa_Podcast\Alexa_Podcast {

	public function __construct() {
		$this->app_id = 'amzn1.ask.skill.fa771ea4-38ac-4030-81d7-77c5c61d4f76';

		$this->text_launch = 'Setz Dich hin, nimm Dir einen Keks oder sag uns einfach welche Folge Du hören willst.';
		$this->text_end = 'Ach mensch hier ist doch so gemütlich! Naja, dann bis bald!';
		$this->text_dont_understood = 'Ich habe Dich leider nicht verstanden.';
		$this->text_starting_podcast = 'Spiele Podcast Folge %d';

		$this->podcast_feed_url = 'https://m4a.wp-sofa.de/';

		parent::__construct();
	}
}