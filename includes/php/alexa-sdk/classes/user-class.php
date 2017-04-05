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
	use Id;

	/**
	 * User constructor.
	 *
	 * @param \stdClass $user_data Session from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct( \stdClass $user_data ) {
		$this->id = $user_data->userId;
	}
}