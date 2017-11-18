<?php
class SynoDLMSearchSukebei {
	private $qurl = "https://sukebei.nyaa.si/?page=rss&q=";

	public function __construct() {
	}

	public function prepare($curl, $query) {
		$url = $this->qurl . urlencode($query);
        curl_setopt($curl, CURLOPT_URL, $url);
    }

	public function parse($plugin, $response) {
        $response = preg_replace("/nyaa:/i", "", $response);
        $response = preg_replace("/]]>/i", "| Ratio: 1 seeds, 1 leechers]]>", $response);
        //$response = preg_replace("/]]>/i", "leechers: 1", $response);
        $response = preg_replace("/infoHash/i", "hash", $response);
        if ($plugin == null) {
            return $response;
        } else {
            return $plugin->addRSSResults($response);
        }
    }
}
?>