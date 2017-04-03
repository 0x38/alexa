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
	 * Request ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $request_id;

	/**
	 * Locale
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $locale;

	/**
	 * Timestamp
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $timestamp;

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
	 * Intent Data
	 *
	 * @since 1.0.0
	 *
	 * @var Intent
	 */
	protected $intent;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $input_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $input_data ) {
		$this->request_id = $input_data->request->requestId;
		$this->type = $input_data->request->type;
		$this->locale = $input_data->request->locale;
		$this->timestamp = $input_data->request->timestamp;
		$this->version = $input_data->version;

		$this->session = new Session( $input_data->session );

		if( 'IntentRequest' === $this->type ) {
			$this->intent = new Intent( $input_data->request->intent );
		}
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

	/**
	 * Get intent
	 *
	 * @since 1.0.0
	 *
	 * @return Intent $intent
	 */
	public function intent() {
		return $this->intent;
	}
}