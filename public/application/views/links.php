<ul class="thumbnails">	
  <?php foreach($links as $link):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
      	   <?php $imagen_normal=str_replace("_s.", "_n.", $link['attachment']['media']['0']['src']);?>
            <img src="<?= $imagen_normal; ?>" alt="" />
        </div>
      <p class="text_ver"><?= $link['attachment']['caption']; ?></p>
      
        <p>
          <a href="<?= $link['attachment']['media']['0']['href']; ?>" class="btn btn-info btn-mini" target="_blank">Ver en Facebook</a>
          <?php if(isset($link['attachment']['href'])):?>
          	<a href="<?= $link['attachment']['href']; ?>" class="btn btn-primary btn-mini" target="_blank">Ver link</a>
          <?php endif;?>
          <button data-fav="<?= $link['post_id']; ?>" class="btn btn-success btn-mini faver">Agregar a favoritos</button>
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