<ul class="thumbnails">	
  <?php foreach($videos as $video):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
           <?php $imagen_normal=str_replace("_s.", "_n.", $video['attachment']['media']['0']['src']);?>
           <img src="<?= $imagen_normal; ?>" alt="" />
        </div>
      <p class="text_ver"><?= $video['attachment']['caption']; ?></p>
      
        <p>
          <a href="<?= $video['attachment']['media']['0']['href']; ?>" class="btn btn-info btn-mini" target="_blank">Ver en Facebook</a>
          <button data-fav="<?= $video['post_id']; ?>" class="btn btn-success btn-mini faver">Agregar a favoritos</button>
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
        }
      });
      $(this).remove();
    })
  })
</script>