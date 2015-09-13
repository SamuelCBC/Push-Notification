var util = require('util');
var https = require('https');

// google developers console: Project -> APIs & auth -> Credentials
var API_KEY = 'Server-key-of-your-project' // e.g 'AIzaSyDY0fRvUVfK1XjbqFMnbhwF08ML4Sj7j5s'

var android_push = function(dev_token, message, count){

	var jData = {
		"to" : dev_token,
		"data" : {"message" : message,
		"count" : count}
	}
	var postData = JSON.stringify(jData);
	var options = {
		hostname: 'android.googleapis.com',
		port: 443,
		path: '/gcm/send',
		method: 'POST',
		headers: {
			'Content-Type'  : 'application/json',
			'Authorization' : 'key=' + API_KEY,
			'Content-Length': postData.length
		}
	};

	var req = https.request(options, function(res) {
		
		//console.log("statusCode: ", res.statusCode);
		//console.log("headers: ", res.headers);
	    if (res.statusCode == 200) { // request ok.
	      res.on('data', function(d) {
	          var str = d.toString('utf8');
        	  var j = JSON.parse(str);
    	      //console.log(util.inspect(j));
	          if (j["success"] == 1){
        	    console.info("Push message ok. id:"+j["results"][0].message_id);
    	      }else{
	            console.error("Failed to push message. error:" + util.inspect(j["results"]));
        	 }
    	  });

	    }else{
    	  console.log("Error sending message dev:"+dev_token);
	    }

	});
	// write data to request body
	req.write(postData);
	req.end();
	req.on('error', function(e) { console.error(e); });
}

// ------------------------------------------------------------------- //
// Test Example 
// ------------------------------------------------------------------- //
var dev_token = "c7k8kau-OpQ:APC94EflEU9oCndJQ-5Dwo2Tbk93pFDByHjptJA3vhv0SfIXAruuIibiUjcXr_RkdG0rMKaQIo9lqe1dfsettA_2AndG0rMK-QEflEU9CnldP0dJQ-5#6Dwo24_GdjTLfefsefsefycA";
android_push(dev_token, "Android Push Message: 123456789 ABC...XYZ", 3);
