<ul class="thumbnails">	
  <?php foreach($imagenes as $imagen):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
      	   <img src="<?= $imagen['attachment']['media']['0']['src'] ?>" alt="" />
        </div>
      <p class="text_ver"><?= $imagen['attachment']['caption']  ?></p>

        <p>
          <a href="<?= $imagen['attachment']['media']['0']['href']; ?>" class="btn btn-mini btn-info" target="_blank">Ver en Facebook</a>
          <button data-fav="<?= $imagen['post_id']; ?>" class="btn btn-success btn-mini faver">Agregar a favoritos</button>
      </p>
    </div>
    </li>
  <?php endforeach;?>
</ul>
<script>
  $(document).ready(function(){
    $('.faver').on('click', function(){
      var fid=$(this).data('fav');
      $.ajax({
        url: '<?= site_url("stream/mark"); ?>/'+fid,
        success: function(data) {
          //$('.nav li').removeClass('active');
          //$('.'+dest).addClass('active');
          $(this).html('Guardado');
          console.log('saved');
        }
      });
    })
  })
</script>