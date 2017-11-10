<?php
class SynoDLMSearchSukebei {
	private $qurl = "https://sukebei.nyaa.si/?page=rss&q=";

	public function __construct() {
	}

	public function prepare($curl, $query) {
		$url = $this->qurl . urlencode($query);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    }

	public function parse($plugin, $response) {
        $response = preg_replace("/nyaa:/i", "", $response);
		$response = preg_replace("/seeders/i", "seeds", $response);
		$response = preg_replace("/leechers/i", "leechs", $response);
		$response = preg_replace("/infoHash/i", "hash", $response);
		if ($plugin == null) {
			return $response;
		} else {
			return $plugin->addRSSResults($response);
		}
	}
}
?>