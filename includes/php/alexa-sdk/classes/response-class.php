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
	use Singleton;

	private $version = '1.0';

	private $output_speech;

	protected function init() {
		$this->output_speech = new Output_Speech();
	}

	/**
	 * @return Output_Speech
	 */
	public function output_speech() {
		return $this->output_speech;
	}

	public function add_session_attribute( $name, $value ) {

	}

	public function get_session_attribute( $name ) {

	}


	public function get() {

	}
}