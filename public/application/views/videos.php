<ul class="thumbnails">	
  <?php foreach($videos as $video):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
      	   <img src="<?= $video['attachment']['media']['0']['src'] ?>" alt="" />
        </div>
      <p class="text_ver"><?= $video['attachment']['caption']; ?></p>
      
        <p>
          <a href="<?= $video['attachment']['media']['0']['href']; ?>" class="btn btn-info" target="_blank">Ver en Facebook</a>
      </p>
    </div>
    </li>
  <?php endforeach;?>
</ul>