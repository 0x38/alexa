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
			$response = alexa_speak( "Dies ist Dein Launch Request" );
			break;
		case "SessionEndedRequest":
			$response = alexa_speak( "Dies ist Dein Session ended Request." );
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