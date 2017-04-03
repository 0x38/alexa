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
		$this->slots = get_object_vars( $intent_data->slots );
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
		return $this->slots;
	}

	public function get_slot_names(){
		return array_keys( $this->slots );
	}

	public function get_slot_value( $name ) {
		if( ! array_key_exists( $name, $this->slots ) ) {
			throw new Exception( 'Slot name does not exist in ' . $this->name );
		}
		return $this->slots[ $name ]->value;
	}
}