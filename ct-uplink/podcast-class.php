<?php

namespace Podcast;

require_once dirname( dirname( __FILE__ ) ) . '/includes/php/alexa-podcast/alexa-podcast-class.php';

class Podcast extends \Alexa_Podcast\Alexa_Podcast {

	public function __construct() {
		$this->podcast_feed_url = 'https://www.heise.de/ct/uplink/ctuplink.rss';

		parent::__construct();

		$this->app_id = 'amzn1.ask.skill.83b2acd2-da0f-468c-ad4e-22c24e86759c';

		$this->text_launch = 'Willkommen beim CT Uplink Podcast! Welche Folge willst Du hören?';
		$this->text_end = 'Einen schönen Tag noch!';
		$this->text_dont_understood = 'Ich habe Dich leider nicht verstanden';
		$this->text_starting_podcast = 'Spiele Folge %d';

		// $this->revert_episode_numbers();
	}
}