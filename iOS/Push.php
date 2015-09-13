function pushNotification($deviceToken, $ctx, $push_server, $message, $badgeNum) {

	// Open APNS server connection
	$fp = stream_socket_client($push_server, $err, $errstr, 
		60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	if (!$fp) {
		echo ("Failed to connect: $err $errstr" . PHP_EOL);
		return false;
	}

	// echo 'APNS Connected' . PHP_EOL;
	// Connected to APNS, create Payload body
	$body['aps'] = array(
		'alert' => $message,
		'sound' => 'default',
		'badge' =>  $badgeNum
	);
	// Encode the payload as JSON
	$payload = json_encode($body);

	// Build the binary notification
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

	// Send it to the server
	$result = fwrite($fp, $msg, strlen($msg));


	if (!$result) {
		echo 'ERROR - cannot deliver message.' . PHP_EOL;
	} else {
		echo 'Message was delivered successfully' . PHP_EOL;
		
	}

	// Close Connection
	fclose($fp);
	return $result;
}
