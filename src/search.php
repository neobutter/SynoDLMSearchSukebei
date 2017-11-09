<?php
class SynoDLMSearchNyaa {
	private $qurl = "https://sukebei.nyaa.si/?page=rss&q=";

	public function __construct() {
	}

	public function prepare($curl, $query) {
		$url = $this->qurl . urlencode($query);
		curl_setopt($curl, CURLOPT_URL, $url);
	}

	public function parse($plugin, $response) {
		$response = preg_replace("/nyaa:/i", "", $response);
		$response = preg_replace("/seeders/i", "seed", $response);
		$response = preg_replace("/leechers/i", "leech", $response);
		$response = preg_replace("/infoHash/i", "hash", $response);
		if ($plugin == null) {
			return $response;
		} else {
			return $plugin->addRSSResults($response);
		}
	}
}
?>