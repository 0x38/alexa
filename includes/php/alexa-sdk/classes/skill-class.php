<?php

namespace Alexa;

/**
 * Class Skill
 *
 * @since 1.0.0
 *
 * @package Alexa
 */
abstract class Skill {
	/**
	 * Logging functionality
	 *
	 * @since 1.0.0
	 */
	use Logger;

	/**
	 * Application ID
	 *
	 * @var string
	 */
	private $application_id;

	/**
	 * Rare input data from Alexa as JSON String
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $input;

	/**
	 * Interpreted input data as Alexa SDK object model
	 *
	 * @since 1.0.0
	 *
	 * @var Request
	 */
	private $request;

	/**
	 * Text which Alexa says if the skill starts
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_launch = 'Hello! I am an Alexa Skill.';

	/**
	 * Text which Alexa says if the skill ends
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_end = 'Good bye!';

	/**
	 * Text which Alexa says if she did not understood
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $text_dont_understood = 'I did not understood you.';


	/**
	 * Skill constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $application_id Skill Application ID
	 */
	public function __construct( $application_id ) {
		$this->application_id = $application_id;
	}

	/**
	 * Running the Skill
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->request();
		$this->response();
	}

	/**
	 * Interpreting data, getting from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return Request
	 *
	 * @throws Exception
	 */
	public function request() {
		$this->request = new Request( $this->input() );

		if( ! $this->request->session()->application()->id_equals( $this->application_id ) ) {
			throw new Exception( 'Wrong Application ID' );
		}

		return $this->request;
	}

	/**
	 * Outputting data to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @var bool $echo True if data should be outputted direct
	 *
	 * @return array $response
	 */
	public function response( $echo = true ) {
		switch ( $this->request->get_type() ) {
			case "LaunchRequest":
				$response = $this->response_launch();
				break;
			case "SessionEndedRequest":
				$response = $this->response_end();
				break;
			case "IntentRequest":
				$response = $this->interact( $this->request()->intent() );
				break;
			default:
				$response = $this->response_dont_understood();
				break;
		}

		if( $echo ) {
			$this->output( $response );
		}

		return $response;
	}

	/**
	 * Preparing data for output to Alexa
	 *
	 * @since 1.0.0
	 *
	 * @param $response
	 *
	 * @return mixed
	 */
	private function output( $response ) {
		$response = json_encode( $response );
		$size = strlen ( $response );

		header( 'Content-Type: application/json' );
		header( 'Content-length: ' . $size );

		echo $response;
	}

	/**
	 * Getting input from Alexa
	 *
	 * @since 1.0.0
	 *
	 * @return \StdClass
	 *
	 * @throws Exception
	 */
	private function input() {
		$input = file_get_contents( 'php://input' );

		if( empty( $input ) ) {
			throw new Exception( 'No input from Alexa' );
		}

		$this->input = json_decode( $input );

		return $this->input;
	}

	/**
	 * Response
	 *
	 * @return array
	 */
	public function response_launch() {
		return $this->response_speak( $this->text_launch );
	}

	public function response_end() {
		return $this->response_speak( $this->text_end );
	}

	public function response_dont_understood() {
		return $this->response_speak( $this->text_dont_understood );
	}

	abstract protected function interact( $intent );

	public function response_speak( $text, $session_attributes = array(), $should_end_session = true ) {
		$response = array(
			'version'   => '1.0',
			'sessionAttributes' => $session_attributes,
			'response' => array(
				'outputSpeech' => array(
					'type'  => 'PlainText',
					'text'  => $text
				),
				'shouldEndSession' => $should_end_session
			)
		);

		return $response;
	}
}