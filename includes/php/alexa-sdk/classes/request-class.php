<?php

namespace Alexa;

/**
 * Class Request
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Request {
	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var Session
	 */
	protected $type;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var Session
	 */
	protected $session;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $input_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $input_data ) {
		$this->type = $input_data->request->type;

		$this->session = new Session( $input_data->session );
	}

	/**
	 * Get or set Version
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function get_version() {
		return $this->type;
	}

	/**
	 * Get or set Request Type
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Get or set Session
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function session() {
		return $this->session;
	}
}