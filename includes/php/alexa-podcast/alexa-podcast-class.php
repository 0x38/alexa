<?php

namespace Alexa_Podcast;
use Alexa\Alexa;

require_once dirname( dirname( __FILE__ ) ) . '/alexa-sdk/alexa-class.php';

abstract class Alexa_Podcast extends Alexa {
	use Podcast;

	protected $podcast_name;

	protected $podcast_feed_url;

	public function interact( $intent ) {
		// TODO: Implement interact() method.
	}
}