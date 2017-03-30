<?php

namespace Podcast;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-podcast/alexa-podcast-class.php';

class Podcast extends \Alexa_Podcast\Alexa_Podcast {

	public function __construct() {
		$this->podcast_feed_url = 'http://ubuntufun.de/feed/podcast/';

		parent::__construct();

		$this->app_id = 'amzn1.ask.skill.85676083-3acd-465f-afc8-9cb4f0997ae7';

		$this->text_launch = 'Linux ist das beste!';
		$this->text_end = 'Ach mensch hier ist doch so gemütlich! Naja, dann geh doch!';
		$this->text_dont_understood = 'Man man man, Du musst schon deutlicher sprechen';
		$this->text_starting_podcast = 'Dann gibts jetzt Folge %d auf die Ohren!';

		$this->revert_episode_numbers();
	}
}