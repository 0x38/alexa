<?php

namespace Alexa;

trait Logger {
	protected $logfile = 'log.txt';

	protected function log( $value ) {
		$file = fopen( $this->logfile, 'a' );
		fputs( $file, print_r( $value, true ) . chr( 13 ) );
		fclose( $file );
	}

	protected function delete_logfile() {
		if( ! file_exists( $this->logfile ) ) {
			return false;
		}

		return unlink( $this->logfile );
	}
}