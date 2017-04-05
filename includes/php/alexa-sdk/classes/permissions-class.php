<?php

namespace Alexa;

/**
 * Class Permissuins
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Permissions {
	/**
	 * Permissions Data
	 *
	 * @since 1.0.0
	 *
	 * @var \stdClass
	 */
	protected $permissions_data;

	/**
	 * Consent token
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $consent_token = false;

	/**
	 * Permissions constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $permission_data Permission data from Alexa JSON String
	 */
	public function __construct( \stdClass $permissions_data ) {
		$this->permissions_data = $permissions_data;

		if( property_exists( $permissions_data, 'consent_token' ) ) {
			$this->consent_token = $permissions_data->consent_token;
		}
	}

	/**
	 * Get consent token
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_consent_token() {
		return $this->consent_token;
	}
}