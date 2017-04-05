<?php

namespace Alexa;

/**
 * Class Context
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
class Context {
	/**
	 * Request data from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @var \stdClass
	 */
	protected $context_data;

	/**
	 * System Data
	 *
	 * @since 1.0.0
	 *
	 * @var System
	 */
	protected $system;

	/**
	 * Audio Player Data
	 *
	 * @since 1.0.0
	 *
	 * @var Audio_Player
	 */
	protected $audio_player;

	/**
	 * Request constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param \stdClass $context_data Input from Alexa JSON String
	 */
	public function __construct( \stdClass $context_data ) {
		$this->context_data = $context_data;
	}

	/**
	 * Get System
	 *
	 * @since 1.0.0
	 *
	 * @return System $system
	 *
	 * @throws Exception
	 */
	public function system() {
		if( empty( $this->system ) ) {
			$this->system = new System( $this->context_data->System );
		}

		return $this->system;
	}

	/**
	 * Get Audio Player
	 *
	 * @since 1.0.0
	 *
	 * @return Audio_Player $audio_player
	 *
	 * @throws Exception
	 */
	public function audio_player() {
		if( empty( $this->audio_player ) ) {
			$this->audio_player = new System( $this->context_data->AudioPlayer );
		}

		return $this->audio_player;
	}
}