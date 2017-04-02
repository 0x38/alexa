<?php

namespace Alexa;

/**
 * Class Intent
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Intent {
	/**
	 * Intent name
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Slots
	 *
	 * @since 1.0.0
	 *
	 * @var array $slots
	 */
	private $slots;

	/**
	 * Intent constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $intent_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $intent_data ) {
		$this->name = $intent_data->name;
		$this->slots = $intent_data->slots;
	}

	/**
	 * Getting name of Intent
	 *
	 * @since 1.0.0
	 *
	 * @return string $name
	 */
	public function get_name() {
		return $this->name;
	}

	public function get_slots() {
		return get_class_vars( $this->slots );
	}

	public function get_slot_names(){
	}

	public function get_slot_value( $slot_name ) {
	}
}