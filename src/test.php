<?php
    require 'search.php';

    function size_format($matches) {
    	$formattedText = "";
		$size_map = array(
			"KiB" => 1024,
			"MiB" => 1048576,
			"GiB" => 1073741824,
        );
		foreach ($size_map as $n => $mux) {
			if(strstr($matches[2], $n) ){
				$formattedText = floatval($matches[2]) * $mux;
				break;
			}
		}
		return $matches[1] . $formattedText . $matches[3];	
	}

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $test = new SynoDLMSearchNyaa;
    $test->prepare($ch, "sw-517");
    echo $test->parse(null, curl_exec($ch));
    
    //echo preg_replace_callback('/(<size[^>]*>)(.*?)(<\/size>)/i', "size_format", '<size>1.8 GiB</size>');

    curl_close($ch);
?>