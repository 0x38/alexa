<?php

namespace Alexa;

/**
 * Class Slot
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Slot{

	/**
	 * Name of the Slot
	 *
	 * @since 1.0.0
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Value of the Slot
	 *
	 * @since 1.0.0
	 *
	 * @var string $value
	 */
	private $value;

	/**
	 * Slot constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $slot_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $slot_data ) {
		$this->name = $slot_data->name;
		$this->value = $slot_data->value;
	}

	/**
	 * Getting name of the slot
	 *
	 * @since 1.0.0
	 *
	 * @return string $name
	 */
	public function get_name() {
		return $this->name;
	}



	/**
	 * Getting value of the slot
	 *
	 * @since 1.0.0
	 *
	 * @return string $value
	 */
	public function get_value() {
		return $this->value;
	}
}