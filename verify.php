<?php
$access_token = 'HiBgQUHNzlFE4VhnTZgLJA8ALH83YQWBamWNyyyR0r4rrQ4yszVG3yrzLk9G/9+CWdgvdWzuHob1pRzU51GiEVpCn+t1Ka1gYrUHmgH3g8k5gEZkwyZfB8DZ2Gglg6uB4KFYe3yeOzVzk6BdS5eQxQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;