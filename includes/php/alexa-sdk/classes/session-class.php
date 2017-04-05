<?php

namespace Alexa;

/**
 * Class Session
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Session {
	use Id;

	/**
	 * Session Data
	 *
	 * @since 1.0.0
	 *
	 * @var \stdClass
	 */
	protected $session_data;

	/**
	 * Is Session new
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	protected $new;

	/**
	 * Attributes array
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $attributes = array();

	/**
	 * Application Object
	 *
	 * @since 1.0.0
	 *
	 * @var Application
	 */
	protected $application;

	/**
	 * User Object
	 *
	 * @since 1.0.0
	 *
	 * @var User
	 */
	protected $user;

	/**
	 * Session constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $session_data Session from Alexa JSON String
	 */
	public function __construct( \stdClass $session_data ) {
		$this->session_data = $session_data;

		$this->new = $session_data->new;
		$this->id = $session_data->sessionId;
	}

	/**
	 * Getting all Attributes
	 *
	 * @since 1.0.0
	 *
	 * @return array|bool
	 */
	public function get_attributes() {
		if ( empty( $this->attributes ) ) {
			if ( property_exists( $this->session_data, 'attributes') ) {
				$attributes = get_object_vars( $this->session_data->attributes );

				if( empty( $attributes ) ) {
					return false;
				}

				$this->attributes = $attributes;
			}
		}

		return $this->attributes;
	}

	/**
	 * Getting Attribute Value
	 *
	 * @since 1.0.0
	 *
	 * @param string $name
	 *
	 * @return string $value
	 */
	public function get_attribute( $name ) {
		if ( empty( $this->get_attributes() ) ) {
			return false;
		}

		if( ! array_key_exists( $name, $this->attributes ) ) {
			return false;
		}

		return $this->attributes;
	}

	/**
	 * Returns Application Object
	 *
	 * @since 1.0.0
	 *
	 * @return Application $application
	 */
	public function application() {
		if( empty( $this->application ) ) {
			$this->application = new Application( $this->session_data->application );
		}
		return $this->application;
	}

	/**
	 * Returns User Object
	 *
	 * @since 1.0.0
	 *
	 * @return User $user
	 */
	public function user() {
		if( empty( $this->user ) ) {
			$this->user = new User( $this->session_data->user );
		}

		return $this->user;
	}
}