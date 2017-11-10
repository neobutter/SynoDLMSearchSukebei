<?php
class SynoDLMSearchSukebei {
	private $qurl = "https://sukebei.nyaa.si/?page=rss&q=";

	public function __construct() {
	}

	public function prepare($curl, $query) {
		$url = $this->qurl . urlencode($query);
		curl_setopt($curl, CURLOPT_URL, $url);
    }
    
    private function size_format($sizestr) {
		$size_map = array(
			"KiB" => 1024,
			"MiB" => 1048576,
			"GiB" => 1073741824,
        );
		foreach ($size_map as $n => $mux) {
			if( strstr($sizestr,$n) ){
				$sizestr=floatval($sizestr)*$mux;
				break;
			}
		}
		return $sizestr;
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