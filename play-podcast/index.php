<?php

$input = json_decode( file_get_contents( 'php://input' ) );
$output = alexa_response( $input );
$size = strlen ( $output );

header('Content-Type: application/json');
header("Content-length: $size");

echo $output;


function alexa_response( $input ) {
	switch ( $input->request->type ) {
		case "LaunchRequest":
			$response = alexa_speak( "Das ist das Podcast Universum. Starte es mit Alexa öffne 'Podcast Universe' und gebe Deinen Podcast Titel an. Leider kann ich nur bekannte Titel verstehen. Willst Du Deinen Podcast auch auf 'Podcast Universe' haben, schreibe uns eine kurze Email an meinpodcast@podcastuniverse.de mit Deinem gewünschtem Podcast. Wir fügen Deinen Podcast dann in Kürze in usere Liste ein." );
			break;
		case "SessionEndedRequest":
			$response = alexa_speak( "Ende des Universums." );
			break;
		case "IntentRequest":
			$response = alexa_intent( $input->request->intent );

			$file = fopen( 'alexa-response.txt', 'a');
			fputs( $file, print_r( $input, true ) );
			fputs( $file, print_r( $response, true ) );
			fputs( $file, print_r( json_encode( $response ), true ) );
			fclose( $file );

			break;
		default:
			$response = alexa_speak( "Wenn ich jetzt noch verstanden hättest was Du willst. Versuchs noch einmal!" );
			break;
	}

	return json_encode( $response );
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
	sprintf( 'Ich spiele jetzt den Podcast %s', $podcast_name );

	return alexa_play( $podcast_name );
}

	function alexa_play( $podcast_name, $should_end_session = true  ) {
	$response = array(
		'version'   => '1.0',
		'sessionAttributes' => array(),
		'response' => array(
			'outputSpeech' => array(
				'type' => 'PlainText',
				'text' => 'Podcast wird gespielt.'
			)
			,
			'card' => array(
				'type' => 'Simple',
				'title' => 'Spiele Podcast',
				'content' => 'Spiele den gesuchten Podcast.'
			),
			'reprompt' => array(
				'outputSpeech' => array (
					'type' => 'PlainText',
					'text' => null
				)
			),
			'directives' => array(
				'type' => 'AudioPlayer.Play',
				'playBehavior' => 'ENQUEUE',
				'audioItem' => array(
					'stream' => array(
						'token' => 'we-play-the-podcast',
						'url' => 'http://tracking.feedpress.it/link/14543/5147867/wp-sofa-29.mp3',
						'offsetInMilliseconds' => 0
					)
				)
			),
			'shouldEndSession' => true
		)
	);

	return $response;
}