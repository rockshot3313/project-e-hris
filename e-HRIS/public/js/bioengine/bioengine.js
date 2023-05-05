class BioEngine {

	MAIN = this;

	BASEPATH = '';

	API_KEY = '';

	TOKEN = '';

	READY = false;

	URL_BASE = '';
	URL_CHECK = '';
	URL_FP_GET = '';
	URL_FP_SYNC_LOCAL = '';

	CONN_TIMEOUT = 1000;
	COM_INTERVAL = 1000;

	ENABLE_AUTO_FP_GETDATA = false;

	ON_FP_DATA_GET = false;

	TMR_1 = null;

	CALLBACK_FP_GETDATA = null;

	constructor(token, basepath = '') {

		this.MAIN = this;

		this.TOKEN = token;
		this.BASEPATH = basepath;

		this.load_settings();

		

	}

	isReady() {
		return this.READY;
	}

	setupFPGetDataInterval() {
		this.TMR_1 = setInterval(function () {
			if(this.ENABLE_AUTO_FP_GETDATA) {
				this.fpGetData(this.CALLBACK_FP_GETDATA);
				//console.log(1);
			}
		}.bind(this), this.COM_INTERVAL);
	}


	load_settings() {
		try{
			/***/
	        /***/
	        var cs = this.BASEPATH + '/bioengine/settings/get';
	        /***/
	        $.post(cs,
	            {
                	_token: this.TOKEN,
	            },
	            function(response) {
	                try{
	                	/*console.log(response);*/
	                    /***/
	                    var data = (response);
	                    /***/
	                    this.API_KEY = data['api_key'];
	                    /***/
	                    this.URL_BASE = data['url_base'];
	                    this.URL_CHECK = data['url_check'];
	                    this.URL_FP_GET = data['url_fp_get'];
	                    this.URL_FP_SYNC_LOCAL = data['url_fp_sync_local'];
	                    /***/
	                    this.CONN_TIMEOUT = parseInt(data['conn_timeout']);
	                    /***/
	                    this.COM_INTERVAL = parseInt(data['com_interval']);
	                    /***/
	                    /***/
	                    try{
	                    	let val = parseInt(data['auto_fp_data_get']);
	                    	if(val > 0) {
	                    		this.ENABLE_AUTO_FP_GETDATA = true;
	                    		this.setupFPGetDataInterval();
	                    	}else{
	                    		this.ENABLE_AUTO_FP_GETDATA = false;
	                    		this.TMR_1 = null;
	                    	}
	                    }catch(err){}
	                    /***/
	                    /***/
	                    this.READY = true;
	                    /***/
	                    /***/
	                }catch(err){  }
	        }.bind(this))
	        .done(function() {

	        })
	        .fail(function(response) {
	        	/*console.log(response);*/
	        })
	        .always(function() {

	        });
			/***/
			/***/
		}catch(err){}
	}


	setAutoFPGetData(value) {
		this.ENABLE_AUTO_FP_GETDATA = value;
	}

	setCallbackFPGetData(callback) {
		this.CALLBACK_FP_GETDATA = callback;
	}

	deviceFPCheck(callback) {
		try{
			if(this.READY) {
				/***/
		        /***/
		        var params = "";
		        var cs = this.URL_CHECK + params;
		        /***/
				$.ajax({
					url: cs,
					type: "GET",
					timeout: this.CONN_TIMEOUT,
					data: {
		            	api_key:this.API_KEY,
					},
					success: function(response) {
						try{
		                	/*console.log(response);*/
		                    /***/
		                    var data = (response);
		                    /***/
		                    callback(data);
		                    /***/
						}catch(err){}
					},
					error: function(response) {
						try{
		                	/*console.log(response);*/
				        	var data = { code: "-1", message: "Error.", content: "Error." };
				            callback(data);
						}catch(err){}
					}
				});
		        /***/
				/***/
				/***/
			}
		}catch(err){}
	}
	
	fpGetData(callback) {
		try{
			if(this.READY && !this.ON_FP_DATA_GET) {
				/***/
		        /***/
		        var params = "";
		        var cs = this.URL_CHECK + params;
		        /***/
				$.ajax({
					url: cs,
					type: "GET",
					timeout: this.CONN_TIMEOUT,
					data: {
		            	api_key:this.API_KEY,
					},
					success: function(response) {
						try{
		                	/*console.log(response);*/
		                    /***/
		                    this.ON_FP_DATA_GET = false;
		                    /***/
		                    /***/
		                    var data = (response);
		                    /***/
		                    if(callback !== null && callback !== undefined) {
		                    	callback(data);
		                    }
		                    /***/
						}catch(err){}
					},
					error: function(response) {
						try{
		                	/*console.log(response);*/
		                    /***/
		                    this.ON_FP_DATA_GET = false;
		                    /***/
		                    if(callback !== null && callback !== undefined) {
					        	var data = { code: "-1", message: "Error.", content: "Error." };
					            callback(data);
					        }
		                    /***/
						}catch(err){}
					},
					fail: function(response) {
						try{
		                    /***/
		                    /***/
						}catch(err){}
					}
				});
		        /***/
				/***/
				/***/
			}
		}catch(err){}
	}
	
}