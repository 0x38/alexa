<?php

namespace Alexa;

/**
 * Class User
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Device {
	use Id;
	use Raw_Object;

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
	 * @param \stdClass $object Data from Alexa JSON String
	 */
	public function __construct( \stdClass $object ) {
		$this->object = $object;

		$this->id = $object->deviceId;

		if( property_exists( $object, 'accessToken') ) {
			$this->access_token = $object->accessToken;
		}
	}
}