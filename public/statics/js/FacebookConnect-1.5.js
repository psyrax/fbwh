/*********************
 * 
 * Class Name: FacebookConnect
 * 
 * Description: 
 * 
 * Version: 1.5
 * 
 * @param autologin
 * @param initCallback
 * @returns {FacebookConnect}
 */


function FacebookConnect(autologin, initCallback) {

	this.inviteFriends = inviteFriends;
	this.addLikeEvent = addLikeEvent;	
	this.getMe = getMe;
	this.oauth = oauth;
	this.query = query;
	this.sendMensage = sendMensage;
	this.publish = publish;
	this.login = login;
	this.AppId = AppId;
	this.share = share;
	this.feed = feed;
    this.getAlbums = getAlbums;
    this.getPhotoSrc = getPhotoSrc;
    this.getPhotoAlbums = getPhotoAlbums;
    this.getFriends = getFriends;
    this.getUser = getUser;
    this.createEvent = createEvent;
    	
	this.autologin = autologin;

	this.fbStatus = fbStatus;
	
	/******** Config Params ********/

	var AppId = '403383003054246'; // App ID/API Key
	var perms = ''; // Scope to access data 
	var Channel = 'http://tequiladigitalmexico.com/march2012/channel.html'; // custom channel
	var AppUrl = 'http://local.oglabs.info';
	
	var fbStatus = false;

	window.fbAsyncInit = function() {

		FB.init({
			appId : AppId,
			xfbml: true,
			status : true,
			cookie : true,
			oauth : true,
			channelUrl : Channel
		});

		/* All the events registered */
		FB.Event.subscribe('auth.login', function(response) {
			// do something with response
		});
		FB.Event.subscribe('auth.logout', function(response) {
			this.fbStatus = false;
		});

		FB.getLoginStatus(function(response) {	
		
	
			if (response.status === 'connected') {			

				fbStatus = true;
				initCallback(fbStatus);	
				
			 } else if (response.status === 'not_authorized') {

				fbStatus = false;

				if (autologin != false) {
					login(initCallback);
				}else{					
					initCallback(fbStatus);	
				}
			 } else {
			 	
			 	fbStatus = false;

				if (autologin != false) {
					login(initCallback);
				}else{					
					initCallback(fbStatus);	
				}
			 }
		});

	};
	 (function(d){
	     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
	     js = d.createElement('script'); js.id = id; js.async = true;
	     js.src = "//connect.facebook.net/en_US/all.js";
	     d.getElementsByTagName('head')[0].appendChild(js);
	 }(document));
	
	function addLikeEvent(event,callback){
		
		if(event == "like"){
			
			FB.Event.subscribe('edge.create', function(response, widget) {
				callback(response);
			});	
		}
	}


	function login(callback) {
		if (fbStatus == true) {
			callback(true);
		} else {
			try {
				FB.login(function(response) {
					if (response.authResponse) {
						/* User is login */
						fbStatus = true;
						callback(true);
					} else {
						/* User cancelled login or did not fully authorize. */
						fbStatus = false;
						callback(false);
					}
				}, {
					scope : perms
				});
			} catch (e) {

			}
		}

	}

	function oauth() {
		try{
			FB.ui({
				method : 'oauth',
				client_id : AppId,
				redirect_uri : AppUrl,
				scope : perms,
				display : 'page'
			}, function(response) {
				if (callback) {
					callback(response);
				}
			});
		} catch(e) {
			console.log(e);
		}
	}

	function getMe(callback) {

		login(function(response) {
			if (response == true) {
				FB.api('/me', function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}

	function inviteFriends(msg,callback) {

		login(function(response) {
		
				if (response == true) {
					FB.ui({
							method : 'apprequests',
						message : msg
					},function(response) {
					if (response && response.request_ids) {
						if (callback) {
							callback(response.request_ids);
						}
					}
				});
			}
		});

	}

	function sendMensage(message, to, link, picture, description, callback) {

		login(function(response) {
			if (response == true) {
				FB.ui({
					method : 'send',
					name : message,
					to : to,
					link : link,
					picture : picture,
					description : description
				}, function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}

	function getFriends(callback) {
		

		var friendIds = new Array();
		

		login(function(response) {
			if (response == true) {
				FB.api({
					method : 'friends.get'
				}, function(response) {
					
					
					friendIds = response;
					
					
					var fql = "SELECT uid,pic_square,pic_big,name FROM user WHERE uid in("+friendIds+") ORDER BY name ASC";
			    	FB.api(
							{
								method: 'fql.query',
								query: fql
							},
							function(response) {
								
								
								callback(response);
								
								
								
							}
					);
				});
			}
		});

	}

	function getAlbums(callback) {

		login(function(response) {
			if (response == true) {
				FB.api('/me/albums', function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}


	function publish(attachment, action, message, callback) {

		login(function(response) {
			if (response == true) {
				FB.ui({
					method : 'stream.publish',
					message : message,
					attachment : attachment,
					action_links : action,
					user_prompt_message : ''
				}, function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}

	function feed(name, link, img, caption, description, callback) {

		login(function(response) {
			if (response == true) {
				FB.ui({
					    method: 'feed',
					    name: name,
					    link: link,
					    picture: img,
					    caption: caption,
					    description: description
					}, function(response) {
					    if (callback) {
							callback(response);
						}
					});
			}
		});

	}
	
	function share(link, message, callback){
		  
		  var share = {
				  method: 'stream.publish',
				  link: link,
				  message: message
		  };

	 
	        FB.ui(share, function(response) {
				if (callback) {
					callback(response);
				}
	        });
	    }

	function friendsAdd(idUser, callback) {

		login(function(response) {
			if (response == true) {
				FB.ui({
					method : 'friends.add',
					id : idUser
				}, function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}

	function query(queryString, callback) {

		login(function(response) {
			if (response == true) {
				FB.api({
					method : 'fql.query',
					query : queryString
				}, function(response) {
					if (callback) {
						callback(response);
					}
				});
			}
		});

	}

	function getUser(idUser,callback) {
		login(function(response) {
			if (response == true) {
		
		    	var fql = 'SELECT uid,name,pic_square,email FROM user WHERE uid ='+idUser;
		    	FB.api(
						{
							method: 'fql.query',
							query: fql
						},
						function(response) {
							callback(response);
						}
				);	
			}
		});	
	}

	function getAlbums(idUser,callback){


		login(function(response) {
			if (response == true) {
		
		    	var fql = 'SELECT aid,owner,cover_pid,name,size FROM album WHERE owner ='+idUser;
		    	FB.api(
						{
							method: 'fql.query',
							query: fql
						},
						function(response) {
							callback(response);
						}
				);	
			}
		});	

    		 
    }
    function getPhotoAlbums(idAlbum,callback){
    	

		login(function(response) {
			if (response == true) {

		    	var fql = "SELECT pid FROM photo WHERE aid="+idAlbum;
		    	FB.api(
						{
							method: 'fql.query',
							query: fql
						},
						function(response) {
							callback(response);
						}
				);
			}
		});		
    	
    }
    function getPhotoSrc(idPhoto,callback){


		login(function(response) {
				if (response == true) {    	
	    	
			    	var fql = "SELECT src_small,src,src_big FROM photo WHERE pid="+idPhoto;
			    	FB.api(
							{
								method: 'fql.query',
								query: fql
							},
							function(response) {
								callback(response);
							}
				);
			}
		});	    	
    	
    }

    function createEvent(name, startTime, endTime, location, description, callback) {
	    /*"access_token": fbtoken,*/
	    FB.api("/me/events",'post',{ 
		    	start_time:startTime,
		    	end_time:endTime,
		    	location:location,
		    	name:name,
		    	description:description,
		    	privacy:'OPEN'
		    },
		    function(response){
		        callback(response);
	    	}
	    );
	}


	

}