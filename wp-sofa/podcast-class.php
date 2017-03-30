<?php

namespace Podcast;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-podcast/alexa-podcast-class.php';

class Podcast extends \Alexa_Podcast\Alexa_Podcast {

	public function __construct() {
		$this->podcast_feed_url = 'https://m4a.wp-sofa.de/';

		parent::__construct();

		$this->app_id = 'amzn1.ask.skill.fa771ea4-38ac-4030-81d7-77c5c61d4f76';

		$this->text_launch = 'Auch ich setze mich aufs WP Sofa und höre mit Dir! Welche Folge soll ich abspielen?';
		$this->text_end = 'Ach mensch hier ist doch so gemütlich! Naja, dann geh doch!';
		$this->text_dont_understood = 'Man man man, Du musst schon deutlicher sprechen';
		$this->text_starting_podcast = 'Dann gibts jetzt Folge %d auf die Ohren!';

		$this->revert_episode_numbers();
	}
}