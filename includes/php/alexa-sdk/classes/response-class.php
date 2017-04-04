<?php

namespace Alexa;

/**
 * Class Response
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Response {
	private $version = '1.0';

	private $speech_type;

	/**
	 * Response constructor.
	 *
	 * @param \stdClass $response Response from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct() {}

	public function output_speech( $speech_type, $content ) {
		if( 'text' !== $speech_type && 'ssml' !== $speech_type ) {
			throw new Exception( sprintf( 'Speech Type %s does not exist', $speech_type ) );
		}

		if( empty( $content ) ) {
			throw new Exception( sprintf( 'Content is empty', $speech_type ) );
		}

		$this->speech_type = $speech_type;

		if( 'text' === $speech_type ) {
			$this->text = $content;
		} else {
			$this->ssml = $content;
		}
	}

	public function add_session_attribute( $name, $value ) {

	}

	public function get_session_attribute( $name ) {

	}


	public function get() {

	}
}