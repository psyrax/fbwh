<html>

<head>

<script type="text/javascript" src="<?= base_url(); ?>statics/js/FacebookConnect-1.5.js"></script>

</head>

<body>
<input type="button" value="Mensaje" onclick="sendMessage()" />

<script type="text/javascript">
function sendMessage(){

	var fb = new FacebookConnect(false, function(response){
		var uid = "<?= $this->session->userdata('id') ?>";
		var message = "MEnsaje";
		var desc = "Descripcion";
		var link = "http://www.github.com";
		var img = "https://a248.e.akamai.net/assets.github.com/images/modules/header/logo_white.png";
		fb.sendMensage(message, uid, link, img, desc, function(response){
			for(r in response){
				console.log(response[r]);
			}
		});
	});

	console.log($this->session->userdata('id'));
	
}

</script>
</body>
</html>