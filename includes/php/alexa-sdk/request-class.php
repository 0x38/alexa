<?php

namespace Alexa;

/**
 * Class Request
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Request {
	/**
	 * Request Type
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Request constructor.
	 *
	 * @param \stdClass $request Response from Alexa JSON String
	 *
	 * @since 1.0.0
	 */
	public function __construct( \stdClass $request ) {
		$this->type = $request->type;
	}
}