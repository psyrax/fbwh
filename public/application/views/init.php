<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="#" class="brand">Galeria FB</a>
			<ul class="nav pull-right">
				<li>
			 		<a href="https://github.com/psyrax/fbwh">Forkeame!</a>
			 	</li>
				<li>
			 		<a href="logout">Salir</a>
			 	</li>
			</ul>
		</div>	
	</div>
</div>
<div class="container" style="margin-top:2em;">
	<div class="row">
		<div class="span2">
			<ul class="nav nav-list">
			  <li class="nav-header">Mis cosas</li>
			  <li class="imagenes"><a href="#" data-dest="imagenes" class="jlink">Im&aacute;genes</a></li>
			  <li class="videos"><a href="#" data-dest="videos" class="jlink">Videos</a></li>
			  <li class="links"><a href="#" data-dest="links" class="jlink">Enlaces</a></li>
			  <li class="favoritos"><a href="#" data-dest="favoritos" class="jlink">Favoritos</a></li>
			</ul>
		</div>
		<div class="span10 contenido">
			<div class="page-header">
				<h1>Hola  <?= $user_data['name']; ?></h1>
			</div>
			<p>Esta es la galer&iacute;a de cosas que has compartido o te gustan en Facebook.</p>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.jlink').on('click',function(){
			var dest=$(this).data('dest');
			$.ajax({
			  url: '<?= site_url("welcome"); ?>/'+dest,
			  beforeSend: function(){
			  	$('.contenido').html('<div style="text-align:center;"><img src="<?= base_url(); ?>statics/img/loader.gif" /><br />Cargando... brb</div>');
			  },
			  success: function(data) {
			  	$('.nav li').removeClass('active');
			  	$('.'+dest).addClass('active');
			    $('.contenido').html(data);
			  }
			});
		});
	});
</script>