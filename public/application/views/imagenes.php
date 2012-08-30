<div id="fb-root"></div>
<script type="text/javascript" src="<?= base_url(); ?>statics/js/FacebookConnect-1.5.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>statics/js/jquery.masonry.min.js"></script>

<div id="container">
  <?php if(is_array($imagenes) && count($imagenes)){   foreach($imagenes as $imagen):?>

    <div class="img">
       <?php $imagen_normal=str_replace("_s.", "_n.", $imagen['attachment']['media']['0']['src']);?>
       <img src="<?= $imagen_normal; ?>" alt="" />
       <div class="info">
        <p class="text_ver"><?= $imagen['attachment']['caption']  ?></p>
        <p class="btns pull-right">
            <button class="btn btn-primary btn-mini zoomer" data-zoomed="<?= $imagen_normal; ?>"><i class="icon-zoom-in icon-white"></i></button>
            <a href="<?= $imagen['attachment']['media']['0']['href']; ?>" class="btn  btn-info btn-mini" target="_blank"><i class="icon-circle-arrow-right icon-white"></i> </a>
            <button data-fav="<?= $imagen['post_id']; ?>" class="btn btn-success btn-mini faver"><i class="icon-star icon-white"></i> </button>
            <button data-img="" data-desc="<?= $imagen['attachment']['caption']; ?>"  data-href="<?= $imagen['attachment']['media']['0']['href']; ?>" class="btn btn-inverse btn-mini sharer"><i class="icon-share icon-white"></i> </button>
        </p>
      </div>
    </div>

  <?php endforeach;?>
  <?php }else{?>
      <li>No se encontraron resultados.</li>
  <?php } ?>
</div>
<div class="modal hide fade" id="zoom_imagen">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="zoom_header">Modal header</h3>
  </div>
  <div class="modal-body">
    <p id="zoom-body"><img id="zoom-img"></img></p>
  </div>
  <div class="modal-footer">

  </div>
</div>
<script>

  var fb;
  $(document).ready(function(){

      fb = new FacebookConnect(false, function(response){
    });



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
    });
    $('.zoomer').on('click', function(){
      var zoomed=$(this).data('zoomed');
      $('#zoom-img').attr('src',zoomed);
      $('#zoom_imagen').modal('show');

    });
    $('#zoom_imagen').on('shown', function(){
      
    })
    $('.sharer').on('click', function(){

      var uid = "<?= $user; ?>";
      var message = "Ve esto:";
      var desc = $(this).data('caption');
      var link =$(this).data('href');
      var img = $(this).data('img');
      new sendMessage(uid,message,desc,link,img);
    });

    $(".img").mouseover(function(e){
        
        
        $(".info",$(e.currentTarget)).show();

    });

        $(".img").mouseout(function(e){

            $(".info",$(e.currentTarget)).hide();


        });


    var $container = $('#container');

    $container.imagesLoaded( function(){
      $container.masonry({
        itemSelector : '.img'
      });
    });

  });

  function sendMessage(uid,message,desc,link,img){

     fb.sendMensage(message, uid, link, img, desc, function(response){
      for(r in response){
        console.log(response[r]);
      }
   

  });
   
  }
</script>