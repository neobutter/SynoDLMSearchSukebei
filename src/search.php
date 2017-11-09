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
		preg_replace("/nyaa:/ig", "", $response);
		preg_replace("/seeders/ig", "seeds", $response);
		preg_replace("/leechers/ig", "leechs", $response);
		preg_replace("/infoHash/ig", "hash", $response);
		return $plugin->addRSSResults($response);
	}
}
?>