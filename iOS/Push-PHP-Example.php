
// Device token (without spaces):
$deviceToken = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';

// Private key's passphrase
$passphrase = 'YOUR_PASSPHRASE';

// Test alert message
$message = 'Test: Push notification!';

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'Your-Cert-Key.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

$server_dev  = 'ssl://gateway.sandbox.push.apple.com:2195';
$server_prod = 'ssl://gateway.push.apple.com:2195';
$push_server = $server_dev;  // * Note: or $server_prod 

$badge = rand(0,5);
echo 'Random badge = ' . $badge . "\n";

// Example 
$r = pushNotification($deviceToken, $ctx, $push_server, $message, $badge);
echo 'pushNotification return : [' . $r . ']'. PHP_EOL;
