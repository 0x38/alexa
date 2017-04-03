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
	/**
	 * Is Session new
	 *
	 * @since 1.0.0
	 *
	 * @var bool
	 */
	private $new;

	/**
	 * Session ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $session_id;

	/**
	 * User Object
	 *
	 * @since 1.0.0
	 *
	 * @var User
	 */
	private $user;

	/**
	 * Attributes Object
	 *
	 * @since 1.0.0
	 *
	 * @var Attributes
	 */
	private $attributes;

	/**
	 * Application Object
	 *
	 * @since 1.0.0
	 *
	 * @var Application
	 */
	private $application;

	/**
	 * Session constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $session_data Session from Alexa JSON String
	 */
	public function __construct( \stdClass $session_data ) {
		$this->new = $session_data->new;
		$this->session_id = $session_data->sessionId;

		$this->user = new User( $session_data->user );
		$this->application = new Application( $session_data->application );
	}

	/**
	 * Returns Application Object
	 *
	 * @since 1.0.0
	 *
	 * @return Application $application
	 */
	public function application() {
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
		return $this->user;
	}

	/**
	 * Getting Session ID
	 *
	 * @since 1.0.0
	 *
	 * @return string $session_id
	 */
	public function get_session_id() {
		return $this->session_id;
	}
}