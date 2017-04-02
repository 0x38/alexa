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
	use Logger;
	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $version;

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
		$this->log( $input_data );

		$this->type = $input_data->request->type;
		$this->version = $input_data->version;

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
		return $this->version;
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
	 * Get Session
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function session() {
		return $this->session;
	}
}