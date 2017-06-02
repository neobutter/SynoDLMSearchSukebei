<?php
class SynoDLMSearchNyaa {
	private $qurl = "https://sukebei.nyaa.si/?page=rss&term=";

	public function __construct() {
	}

	public function prepare($curl, $query) {
		$url = $this->qurl . urlencode($query);
		curl_setopt($curl, CURLOPT_URL, $url);
	}

	public function parse($plugin, $response) {
		return $plugin->addRSSResults($response);
	}
}
?>