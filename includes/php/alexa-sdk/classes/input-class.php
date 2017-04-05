<?php

namespace Alexa;

/**
 * Class Response
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Input {
	/**
	 * Input data from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @var \StdClass
	 */
	private $input_data;

	/**
	 * Version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var Session
	 */
	private $session;

	/**
	 * Context Data
	 *
	 * @since 1.0.0
	 *
	 * @var Context
	 */
	private $context;

	/**
	 * Request Data
	 *
	 * @since 1.0.0
	 *
	 * @var Request
	 */
	private $request;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $input_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $input_data ) {
		$this->input_data = $input_data;

		$this->version = $input_data->version;

		if( 'IntentRequest' === $this->type ) {
			$this->intent = new Intent( $input_data->request->intent );
		}
	}

	/**
	 * Get Version
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get Session
	 *
	 * @since 1.0.0
	 *
	 * @return Session $session
	 */
	public function session() {
		if( empty( $this->session ) ) {
			$this->session = new Session( $this->input_data->session );
		}

		return $this->session;
	}

	/**
	 * Get Context
	 *
	 * @since 1.0.0
	 *
	 * @return bool|Context $context
	 */
	public function context() {
		if( empty( $this->context ) ) {
			if( ! property_exists( $this->input_data, 'context' ) ) {
				return false;
			}

			$this->context = new Context( $this->input_data->context );
		}

		return $this->context;
	}

	/**
	 * Get Request
	 *
	 * @since 1.0.0
	 *
	 * @return Request $request
	 */
	public function request() {
		if( empty( $this->request ) ) {
			$this->request = new Request( $this->input_data->request );
		}

		return $this->request;
	}
}