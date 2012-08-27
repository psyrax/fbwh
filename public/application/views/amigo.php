<ul class="thumbnails">	
  <?php if(is_array($posts) && count($posts)) foreach($posts as $post):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
      	   <img src="<?= $post['attachment']['media']['0']['src'] ?>" alt="" />
        </div>
      <p class="text_ver"><?= $post['attachment']['caption']  ?></p>

        <p>
          <a href="<?= $post['attachment']['media']['0']['href']; ?>" class="btn btn-mini btn-info" target="_blank">Ver en Facebook</a>
      </p>
    </div>
    </li>
  <?php endforeach;?>
</ul>