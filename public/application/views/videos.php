<script type="text/javascript" src="<?= base_url(); ?>statics/js/FacebookConnect-1.5.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>statics/js/jquery.masonry.min.js"></script>

<div id="container">
  <?php if(is_array($videos) && count($videos))   foreach($videos as $video):?>

    <div class="img">
       <?php $video_normal=str_replace("_s.", "_n.", $video['attachment']['media']['0']['src']);?>
       <img src="<?= $video_normal; ?>" alt="" />
       <div class="info">
        <p class="text_ver"><?= $video['attachment']['caption']  ?></p>
        <p class="btns" align="right">
            <a href="<?= $video['attachment']['media']['0']['href']; ?>" class="btn btn-mini btn-info" target="_blank">Ver en Facebook</a>
            <button data-fav="<?= $video['post_id']; ?>" class="btn btn-success btn-mini faver">Agregar a favoritos</button>
            <button data-img="" data-desc="<?= $video['attachment']['caption']; ?>"  data-href="<?= $video['attachment']['media']['0']['href']; ?>" class="btn btn-inverse btn-mini sharer">Compartir</button> 
        </p>
      </div>
    </div> 
  <?php endforeach;
  else{?>
      <li>No se encontraron resultados.</li>
  <?php } ?>
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
