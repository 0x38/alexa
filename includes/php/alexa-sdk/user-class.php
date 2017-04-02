<?php

namespace Alexa;

/**
 * Class User
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class User {
	/**
	 * User constructor.
	 *
	 * @param \stdClass $session_data Session from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct( \stdClass $user_data ) {
		$this->type = $user_data->type;
	}
}