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
	use Id;

	/**
	 * Application Data
	 *
	 * @since 1.0.0
	 *
	 * @var \stdClass
	 */
	protected $application_data;

	/**
	 * Application constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $application_data Application from Alexa JSON String
	 */
	public function __construct( \stdClass $application_data ) {
		$this->application_data = $application_data;

		$this->id = $application_data->applicationId;
	}
}