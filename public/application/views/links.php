<?php if(is_array($links) && count($links))  foreach($links as $link):if(isset($link['attachment']['href'])):?>
  <div class="row">
    <div class="span1">
      <?php $imagen_normal=str_replace("_s.", "_n.", $link['attachment']['media']['0']['src']);?>
      <img src="<?= $imagen_normal; ?>" alt="" class="img-polaroid"/>
    </div>
    <div class="span6">
      <p class="lead"><?= $link['message'];?></p>
      <p><a href="<?= $link['attachment']['href']; ?>" target="_blank"><?= $link['attachment']['name'] ?></p>
      <p>
        <a href="<?= $link['attachment']['media']['0']['href']; ?>" class="btn  btn-info btn-mini" target="_blank"><i class="icon-circle-arrow-right icon-white"></i> </a>
        <button data-fav="<?= $link['post_id']; ?>" class="btn btn-success btn-mini faver"><i class="icon-star icon-white"></i> </button>
    </p>
    </div>
  </div>
  <hr />
  <?php endif;endforeach;else{?>
    No se encontraron resultados.
<?php } ?>
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