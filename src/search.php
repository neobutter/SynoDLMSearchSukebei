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
	    $response = preg_replace_callback("/([0-9]+)(?=<\/nyaa:seeders>).+([0-9]+)(?=<\/nyaa:leechers>).+([0-9a-zA-Z]+]]>)/sU", create_function('$matches', 'return str_replace($matches[3], sprintf("Ratio : %s seeders %s leechers | %s", $matches[1], $matches[2], $matches[3]), $matches[0]);'), $response);
        $response = preg_replace("/nyaa:/i", "", $response);
        //$response = preg_replace("/infoHash/i", "hash", $response);
        if ($plugin == null) {
            return $response;
        } else {
            return $plugin->addRSSResults($response);
        }
    }
}
?>