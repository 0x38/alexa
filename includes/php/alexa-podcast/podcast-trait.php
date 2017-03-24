<?php

namespace Alexa_Podcast;

trait Podcast {
	private function parse_rss_feed( $feed_url ) {
		$rss = new \DOMDocument();
		$rss->load( $feed_url );

		$feed = array();
		foreach ( $rss->getElementsByTagName( 'item' ) as $node ) {
			$url = str_replace( 'http://', 'https://', $node->getElementsByTagName( 'enclosure' )->item( 0 )->getAttribute( 'url' ) );
			logger( $url );

			$item = array(
				'url' => $url
			);

			array_push( $feed, $item );
		}

		return $feed;
	}
}