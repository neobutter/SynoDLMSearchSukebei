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
        $seeds = preg_match("[0-9]+(?=<\/seeders>)", $response);
        $leechs = preg_match("[0-9]+(?=<\/leechers>)", $response);

        $response = preg_replace("/nyaa:/i", "", $response);
        $response = preg_replace("/]]>/i", "| Ratio: " . $seeds . " seeds, " . $leechs . " leechers]]>", $response);
        $response = preg_replace("/infoHash/i", "hash", $response);
        if ($plugin == null) {
            return $response;
        } else {
            return $plugin->addRSSResults($response);
        }
    }
}
?>