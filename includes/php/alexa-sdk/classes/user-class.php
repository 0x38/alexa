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
	 * User ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $user_id;

	/**
	 * User constructor.
	 *
	 * @param \stdClass $user_data Session from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct( \stdClass $user_data ) {
		$this->user_id = $user_data->userId;
	}

	/**
	 * Getting User ID
	 *
	 * @since 1.0.0
	 *
	 * @return string $user_id
	 */
	public function get_user_id() {
		return $this->user_id;
	}
}