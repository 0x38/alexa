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
	 * Application Object
	 *
	 * @since 1.0.0
	 *
	 * @var User
	 */
	private $application;

	/**
	 * Session constructor.
	 *
	 * @param \stdClass $session_data Session from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct( \stdClass $session_data ) {
		$this->session_id = $session_data->sessionId;
		$this->user = new User( $session_data->user );
		$this->application = new Application( $session_data->application );
	}
}