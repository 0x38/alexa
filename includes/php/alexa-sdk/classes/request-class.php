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
	 * Request data from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @var \StdClass
	 */
	private $request_data;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Request ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $request_id;

	/**
	 * Timestamp
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $timestamp;

	/**
	 * Locale
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $locale;

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
	public function __construct( \stdClass $request_data ) {
		$this->request_data = $request_data;

		$this->request_id = $request_data->requestId;
		$this->type = $request_data->type;
		$this->locale = $request_data->locale;
		$this->timestamp = $request_data->timestamp;
	}

	/**
	 * Get Request Type
	 *
	 * @since 1.0.0
	 *
	 * @return string $type
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Get Request ID
	 *
	 * @since 1.0.0
	 *
	 * @return string $request_id
	 */
	public function get_id() {
		return $this->request_id;
	}

	/**
	 * Get Locale
	 *
	 * @since 1.0.0
	 *
	 * @return string $locale
	 */
	public function get_locale() {
		return $this->locale;
	}

	/**
	 * Get Timestamp
	 *
	 * @since 1.0.0
	 *
	 * @return string $timestamp
	 */
	public function get_timestamp() {
		return $this->timestamp;
	}

	/**
	 * Get intent
	 *
	 * @since 1.0.0
	 *
	 * @return Intent $intent
	 *
	 * @throws Exception
	 */
	public function intent() {
		if( 'IntentRequest' !== $this->type ) {
			throw new Exception( 'Intent is not existing in this request' );
		}

		if( empty( $this->intent ) ) {
			$this->intent = new Intent( $this->request_data->intent );
		}

		return $this->intent;
	}

	/**
	 * Checks if Request has an Intent
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function has_intent() {
		return 'IntentRequest' === $this->type ? false : true;
	}
}