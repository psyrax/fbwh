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
          <button data-fav="<?= $imagen['post_id']; ?>" class="btn btn-inverse btn-mini sharer">Compartir</button>
      </p>
    </div>
    </li>
  <?php endforeach;?>
</ul>
<script type="text/javascript" src="<?= base_url(); ?>statics/js/FacebookConnect-1.5.js"></script>
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
    $('.sharer').on('click', function(){
      new sendMessage();
    })
  })
  function sendMessage(){

  var fb = new FacebookConnect(false, function(response){
    var uid = "<?= $user; ?>";
    var message = "Mensaje";
    var desc = "Descripcion";
    var link = "http://www.github.com";
    var img = "https://a248.e.akamai.net/assets.github.com/images/modules/header/logo_white.png";
    fb.sendMensage(message, uid, link, img, desc, function(response){
      for(r in response){
        console.log(response[r]);
      }
    });
  });
);
  
  }
</script>