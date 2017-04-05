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
	 * User Data
	 *
	 * @since 1.0.0
	 *
	 * @var \stdClass
	 */
	protected $user_data;

	/**
	 * Access token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $access_token = false;

	/**
	 * Permissions
	 *
	 * @since 1.0.0
	 *
	 * @var Permissions
	 */
	protected $permissions;

	/**
	 * User constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $user_data User Data from Alexa JSON String
	 */
	public function __construct( \stdClass $user_data ) {
		$this->user_data = $user_data;

		$this->id = $user_data->userId;

		if( property_exists( $user_data, 'accessToken') ) {
			$this->access_token = $user_data->accessToken;
		}
	}

	/**
	 * Get access token
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_access_token() {
		return $this->access_token;
	}

	/**
	 * Are there permissions
	 *
	 * @return bool
	 */
	public function has_permissions() {
		if( ! property_exists( $this->user_data, 'permissions ' ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns User Object
	 *
	 * @since 1.0.0
	 *
	 * @return Permissions $permissions
	 */
	public function permissions() {
		if( empty( $this->permissions ) ) {
			$this->permissions = new Permissions( $this->user_data->permissions );
		}

		return $this->permissions;
	}
}