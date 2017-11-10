<?php
    require 'search.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $test = new SynoDLMSearchSukebei;
    $test->prepare($ch, "sw-517");
    echo $test->parse(null, curl_exec($ch));

    curl_close($ch);
?>