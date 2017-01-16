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
			$response = alexa_speak( "Dies ist Dein Intent Request." );
			break;
		default:
			$response = alexa_speak( "Man Junge was willst Du?" );
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