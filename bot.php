<?php
$access_token = 'HiBgQUHNzlFE4VhnTZgLJA8ALH83YQWBamWNyyyR0r4rrQ4yszVG3yrzLk9G/9+CWdgvdWzuHob1pRzU51GiEVpCn+t1Ka1gYrUHmgH3g8k5gEZkwyZfB8DZ2Gglg6uB4KFYe3yeOzVzk6BdS5eQxQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			if($text == 'ทำอะไรได้บ้าง'){
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => 'คำถามพื้นฐานตอนนี้ที่สามารถถามได้คือ 
							1.พิมชื่อระบบที่คุณต้องการทราบละเอียด 
							2.พิมคำว่า "Deploy Urgent DXC" เมื่อต้องการทราบ Process
							'
				];
			}else{
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
				];	
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";