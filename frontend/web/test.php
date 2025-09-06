<?php

$keyword = filter_input(INPUT_GET,'keyword');
$url = 'https://airlabs.co/api/v9/suggest?q=' . urlencode($keyword) . '&api_key=4a758c12-39af-453c-87f5-5ac58aa3ce37';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
curl_close($ch);

echo '<pre>' . print_r($content, 1) . '</pre>';