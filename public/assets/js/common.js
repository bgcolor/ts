function log(msg) {
  return console.log(msg);
}

(function(w){
	var getBaseUrl = function() {
		// pathArray = location.href.split( '/' );
		// protocol = pathArray[0];
		// host = pathArray[2];
		// return protocol + '//' + host;
		return 'http://localhost/ts/public/'
	}
	
	w.baseUrl = getBaseUrl();
})(window);