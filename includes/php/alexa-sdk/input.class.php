<?php

namespace Alexa;

/**
 * Class Input
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Input {
	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var Session
	 */
	protected $session;

	/**
	 * Request Data
	 *
	 * @since 1.0.0
	 *
	 * @var Request
	 */
	protected $request;

	/**
	 * Input constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $input Input from Alexa JSON String
	 */
	public function __construct( \stdClass $input_data ) {
		$this->set_session( $input_data->session );
		$this->set_request( $input_data->session );
	}

	/**
	 * Setting Session
	 *
	 * @since 1.0.0
	 *
	 * @param $session_data
	 */
	public function set_session( $session_data ) {
		$this->session = new Session( $session_data );
	}

	/**
	 * Getting Session
	 *
	 * @since 1.0.0
	 *
	 * @return Session
	 */
	public function session() {
		return $this->session;
	}

	/**
	 * Setting Request
	 *
	 * @since 1.0.0
	 *
	 * @param $session_data
	 */
	public function set_request( $session_data ) {
		$this->session = new Request( $session_data );
	}

	/**
	 * Getting Request
	 *
	 * @since 1.0.0
	 *
	 * @return Request
	 */
	public function request() {
		return $this->request;
	}
}