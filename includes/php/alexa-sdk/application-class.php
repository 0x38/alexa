<?php

namespace Alexa;

/**
 * Class Application
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Application {
	/**
	 * Application ID
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $application_id;

	/**
	 * Application constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $application_data Application from Alexa JSON String
	 */
	public function __construct( \stdClass $application_data ) {
		$this->application_id = $application_data->applicationID;
	}

	/**
	 * Comparing string with actual application_id
	 *
	 * @since 1.0.0
	 *
	 * @param string $string
	 *
	 * @return bool
	 */
	public function id_equals( $string ) {
		return $this->application_id === $string;
	}
}