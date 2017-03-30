<?php

namespace Alexa_Podcast;
use Alexa\Alexa;
use Alexa\Alexa_Exception;

require_once dirname( dirname( __FILE__ ) ) . '/alexa-sdk/alexa-class.php';

abstract class Alexa_Podcast extends Alexa {
	protected $podcast_name;

	protected $podcast_feed_url;

	protected $text_starting_podcast = 'Playing Podcast episode %d';

	protected $episodes;

	protected $total_episodes;

	protected $current_episode;

	public function __construct() {
		parent::__construct();

		$this->episodes = $this->get_episodes();
		$this->total_episodes = count( $this->episodes );
	}

	protected function revert_episode_numbers() {
		$this->episodes = array_reverse( $this->episodes );
	}

	public function interact( $intent ) {
		switch( $intent->name ) {
			case 'PlayPodcast':
				$response = $this->dont_understood();

				if( property_exists( $intent, 'slots' ) ) {
					if( property_exists( $intent->slots, 'PodcastNumber' ) ) {
						if ( property_exists( $intent->slots->PodcastNumber, 'value' ) ) {
							$episode_number = $intent->slots->PodcastNumber->value;
							$response = $this->play_podcast( $episode_number );
						}
					}
				}
				break;

			default:
				$response = $this->dont_understood();
		}

		return $response;
	}

	public function play_podcast( $episode_number, $session_attributes = array(), $should_end_session = true ) {
		try{
			$this->current_episode = $episode_number;

			$episode_url = $this->get_episode_url( $episode_number );

			$this->log( $episode_url );

			$directives[] = array(
				'type' => 'AudioPlayer.Play',
				'playBehavior' => 'REPLACE_ALL',
				'audioItem' => array(
					'stream' => array(
						'token' => 'alexa-podcast',
						'url' => $episode_url,
						'offsetInMilliseconds' => 0
					)
				)
			);

			$response = array(
				'version' => '1.0',
				'sessionAttributes' => $session_attributes,
				'response' => array(
					'outputSpeech' => array(
						'type'  => 'PlainText',
						'text'  => sprintf( $this->text_starting_podcast, $episode_number )
					),
					'directives' => $directives,
					'shouldEndSession' => $should_end_session
				)
			);

			return $response;

		} catch ( Alexa_Exception $exception ) {
			return $this->dont_understood();
		}
	}

	protected function get_episode_url( $episode_number ) {
		$i = 1;
		foreach( $this->episodes AS $episode ) {
			if( $i == $episode_number ) {
				return $episode['url'];
			}
			$i++;
		}

		return false;
	}

	public function launch() {
		return $this->speak( $this->text_launch, array(), false );
	}

	protected function get_episodes() {
		if( empty( $this->podcast_feed_url ) ) {
			throw new Alexa_Exception( 'Podcast Feed URL is empty', 'podcast_feed_url_empty' );
		}

		$rss = new \DOMDocument();
		$rss->load( $this->podcast_feed_url );

		$feed = array();
		foreach ( $rss->getElementsByTagName( 'item' ) as $node ) {
			$url = $node->getElementsByTagName( 'enclosure' )->item(0)->getAttribute( 'url' );

			$item = array (
				/*
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
				'enclosure' => $node->getElementsByTagName('enclosure')->item(0)->nodeValue,
				'image' => $node->getElementsByTagName( 'image' )->item(0)->getAttribute( 'href' ),
				*/
				'url' => $url
			);

			array_push( $feed, $item );
		}

		return $feed;
	}
}