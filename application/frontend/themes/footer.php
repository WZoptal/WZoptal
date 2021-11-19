
<script src="<?=base_url()?>website/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>website/js/parallax.min.js"></script>  
<script type="text/javascript">
    var base_url = '<?=base_url().'api'?>';
        function setVideoSize() {
            const vidWidth = 1920;
            const vidHeight = 1080;
            let windowWidth = window.innerWidth;
            let newVidWidth = windowWidth;
            let newVidHeight = windowWidth * vidHeight / vidWidth;
            let marginLeft = 0;
            let marginTop = 0;

            if (newVidHeight < 500) {
                newVidHeight = 500;
                newVidWidth = newVidHeight * vidWidth / vidHeight;
            }

            if(newVidWidth > windowWidth) {
                marginLeft = -((newVidWidth - windowWidth) / 2);
            }

            if(newVidHeight > 720) {
                marginTop = -((newVidHeight - $('#tm-video-container').height()) / 2);
            }

            const tmVideo = $('#tm-video');

            tmVideo.css('width', newVidWidth);
            tmVideo.css('height', newVidHeight);
            tmVideo.css('margin-left', marginLeft);
            tmVideo.css('margin-top', marginTop);
        }

        $(document).ready(function () {
            /************** Video background *********/

            setVideoSize();

            // Set video background size based on window size
            let timeout;
            window.onresize = function () {
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            // Play/Pause button for video background      
            const btn = $("#tm-video-control-button");

            btn.on("click", function (e) {
                const video = document.getElementById("tm-video");
                $(this).removeClass();

                if (video.paused) {
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        })
    
      $(function() {
          //hang on event of form with id=myform
          $("#signup-form").submit(function(e) {  
              //prevent Default functionality
              e.preventDefault();
              //do your own request an handle the results
              $.ajax({
                      url: base_url+'/signup',
                      type: 'POST',
                      data: $('#signup-form').serialize(),

                      beforeSend:function(){
                          //launchpreloader();
                          console.log("loder start ")
                      },
                      complete:function(){
                          //stopPreloader();
                             console.log("stop loder start ")
                      },
                      success: function(data) {  
                        var obj = jQuery.parseJSON( data);
                        if(obj.code == 200){
                          $("#messgae").html('<p style="color:green">'+obj.message+'</p>')
                           $('#signup-form')[0].reset();
                           setTimeout(function(){ location.href = 'login'; }, 3000);
                        }else{

                          $("#messgae").html('<p style="color:red">'+obj.message+'</p>')
                        }
                         // ... do something with the data...
                      }
              });

          });

          //hang on event of form with id=myform
          $("#login-form").submit(function(e) {  
              //prevent Default functionality
              e.preventDefault();
              //do your own request an handle the results
              $.ajax({
                      url: base_url+'/login',
                      type: 'POST',
                      data: $('#login-form').serialize(),

                      beforeSend:function(){
                          //launchpreloader();
                          console.log("loder start ")
                      },
                      complete:function(){
                          //stopPreloader();
                             console.log("stop loder start ")
                      },
                      success: function(data) {  
                        var obj = jQuery.parseJSON( data);
                        if(obj.code == 200){
                          $("#messgae").html('<p style="color:green">'+obj.message+'</p>')
                           $('#login-form')[0].reset();
                        }else{

                          $("#messgae").html('<p style="color:red">'+obj.message+'</p>')
                        }
                         // ... do something with the data...
                      }
              });

          });


      });
      $(function(){
          $("button[id^='planId_'").click(function() {

              var plan = $(this).attr('id');
              var id = plan.split("_"); 
              var id = id[1];
              var userId = '<?=$this->session->userdata('id')?>'; 
              var planId = '<?=$this->session->userdata('plan_status')?>'; 
              if(userId){  
                if(plan.split("_")[2] > 0){
                    $('#freeSubscription').modal("show");
                }else{

                  if(planId =='Free'){
                     window.location.href = '<?=base_url()?>paypal/buy_Subscription/'+id+'/<?=$this->session->userdata('id')?>';
                  }else{
                     window.location.href = '<?=base_url()?>paypal/revise_subscription/'+id+'/<?=$this->session->userdata('id')?>';
                  }
                }
               
              }else{
                 window.location.href = '<?=base_url()?>login';

              }
          });
      });
      $(function(){
          $("button[id^='cancle-subscription'").click(function() {
              
              var userId = '<?=$this->session->userdata('id')?>';
           
              if(userId){
                window.location.href = '<?=base_url()?>paypal/cancel_subscription_Agreement/<?=$this->session->userdata('id')?>';
              }
          });
      });
    </script>
</body>

</html>