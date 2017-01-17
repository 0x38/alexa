<?php

include( dirname( __FILE__ ) . '/includes/Requests.php');
Requests::register_autoloader();

$input = json_decode( file_get_contents( 'php://input' ) );
$output = alexa_response( $input );
$size = strlen ( $output );

header('Content-Type: application/json');
header("Content-length: $size");

echo $output;

function alexa_response( $input ) {
	switch ( $input->request->type ) {
		case "LaunchRequest":
			$response = alexa_speak( "Das ist das Podcast Universum. Starte es mit Alexa öffne 'Podcatcher' und gebe Deinen Podcast Titel an. Leider kann ich nur bekannte Titel verstehen. Willst Du Deinen Podcast auch auf 'Podcast Universe' haben, schreibe uns eine kurze Email an meinpodcast@podcastuniverse.de mit Deinem gewünschtem Podcast. Wir fügen Deinen Podcast dann in Kürze in usere Liste ein." );
			break;
		case "SessionEndedRequest":
			$response = alexa_speak( "Ende des Universums." );
			break;
		case "IntentRequest":
			$response = alexa_intent( $input->request->intent );
			break;
		default:
			$response = alexa_speak( "Wenn ich jetzt noch verstanden hättest was Du willst. Versuchs noch einmal!" );
			break;
	}

	return json_encode( $response, JSON_UNESCAPED_SLASHES );
}

function alexa_speak( $text, $session_attributes = array(), $should_end_session = true ) {
	$response = array(
		'version'   => '1.0',
		'sessionAttributes' => $session_attributes,
		'response' => array(
			'outputSpeech' => array(
				'type'  => 'PlainText',
				'text'  => $text
			),
			'shouldEndSession' => $should_end_session
		)
	);

	return $response;
}

function alexa_intent( $intent ){
	switch( $intent->name ) {
		case 'PlayPodcast':
			return alexa_slots( $intent->slots );
			break;
		default:
			return alexa_speak( "Ich weis nicht was ich machen soll. Versuche es noch einmal.");
			break;
	}
}

function alexa_slots ( $slots ) {
	$podcast_name = $slots->PodcastName->value;
	$podcast_number = 1;

	if( property_exists( $slots, 'PodcastNumber' ) ) {
		$podcast_number = (int) $slots->PodcastNumber->value;
	}
	return alexa_play( $podcast_name, $podcast_number );
}

function alexa_play( $podcast_name, $podcast_number = 1, $session_attributes = array(), $should_end_session = true  ) {
	$episodes = search_itunes_podcast( $podcast_name );

	$directives = array();
	$i = 1;
	foreach( $episodes AS $episode ) {
		if( $i == $podcast_number ) {
			$directives[] = array(
				'type' => 'AudioPlayer.Play',
				'playBehavior' => 'REPLACE_ALL',
				'audioItem' => array(
					'stream' => array(
						'token' => 'podcast-universe-podcast',
						'url' => $episode['url'],
						'offsetInMilliseconds' => 0
					)
				)
			);

			break;
		}
		$i++;
	}

	$response = array(
		'version' => '1.0',
		'sessionAttributes' => $session_attributes,
		'response' => array(
			'outputSpeech' => array(
				'type'  => 'PlainText',
				'text'  => 'Starte Podcast ' . $podcast_name
			),
			'directives' => $directives,
			'shouldEndSession' => $should_end_session
		)
	);

	return $response;
}

function search_itunes_podcast( $string ) {
	$url = 'https://itunes.apple.com/search?term=' . $string . '&entity=podcast&country=de&media=podcast';

	$request = Requests::get( $url, array('Accept' => 'application/json') );
	$body = json_decode( $request->body );

	if( 0 === $body->resultCount ) {
		return false;
	}

	$podcasts = array();
	foreach ( $body->results AS $result ) {
		$podcasts = array_merge( $podcasts, parse_rss_feed( $result->feedUrl ) );
	}

	return $podcasts;
}

function parse_rss_feed( $feed_url ) {
	$rss = new DOMDocument();
	$rss->load( $feed_url );

	$feed = array();
	foreach ( $rss->getElementsByTagName( 'item' ) as $node ) {
		$url = str_replace( 'http://', 'https://', $node->getElementsByTagName( 'enclosure' )->item(0)->getAttribute( 'url' ) );

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


function logger( $value ) {
	$file = fopen( 'log.txt', 'a' );
	fputs( $file, print_r( $value, true ) );
	fclose( $file );
}
