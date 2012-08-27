<ul class="thumbnails">	
  <?php foreach($links as $link):?>
	<li class="span3">
    <div class="thumbnail imagenes_lista">
        <div class="imagen_ver">
      	   <img src="<?= $link['attachment']['media']['0']['src'] ?>" alt="" />
        </div>
      <p class="text_ver"><?= $link['attachment']['caption']; ?></p>
      
        <p>
          <a href="<?= $link['attachment']['media']['0']['href']; ?>" class="btn btn-info" target="_blank">Ver en Facebook</a>
          <?php if(isset($link['attachment']['href'])):?>
          	<a href="<?= $link['attachment']['href']; ?>" class="btn btn-primary" target="_blank">Ver link</a>
          <?php endif;?>
      </p>
    </div>
    </li>
  <?php endforeach;?>
</ul>