<script type="text/javascript" src="<?= base_url(); ?>statics/js/FacebookConnect-1.5.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>statics/js/jquery.masonry.min.js"></script>

<div id="container">
  <?php if(is_array($posts) && count($posts))   foreach($posts as $imagen):?>

    <div class="img">
       <?php $imagen_normal=str_replace("_s.", "_n.", $imagen['attachment']['media']['0']['src']);?>
       <img src="<?= $imagen_normal; ?>" alt="" />
       <div class="info">
        <p class="text_ver"><?= $imagen['attachment']['caption']  ?></p>
        <p class="btns" align="right">
          
        </p>
      </div>
    </div> 
  <?php endforeach;
  else{?>
      <li>Tus amigo no ha agregado favoritos.</li>
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