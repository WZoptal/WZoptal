

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dd.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.0.0/cropper.min.js"></script>
<!-- BEGIN PAGE HEADER-->
<style type="text/css">
  #files {
    margin-bottom: 20px;
  }
  .errormsg {
    color: red;
  }
  .imageThumb {
      max-height: 75px;
      border: 2px solid;
      padding: 1px;
      cursor: pointer;
    }
    .pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }
    .remove {
      display: block;
      background: #444;
      border: 1px solid black;
      color: white;
      text-align: center;
      cursor: pointer;
    }
    .remove:hover {
      background: white;
      color: black;
    }

    .btn{
      background:white;
      color:black;
      border:1px solid black;
      padding: 0.5em 1em;
      text-decoration:none;
      margin:0.8em 0.3em;
      display:inline-block;
      cursor:pointer;
    }
    .hide {
      display: none;
    }

</style>
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"><?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></h3>
    <ul class="page-breadcrumb breadcrumb">
       <li class="btn-group"> <a href="<?php echo base_url(); ?>episode" class="btn green dropdown-toggle "> <i class="fa fa-arrow-left" aria-hidden="true"></i> <span> Back </span></a> </li>
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="#"> <?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<div class="row profile">
  <div class="col-md-12"> 
    <!--BEGIN TABS-->
    <div class="tabbable tabbable-custom tabbable-full-width">
      <ul class="nav nav-tabs">
        <li class="active"> <a href="#tab_1_1" data-toggle="tab">
          <?php if($do=="edit"){ ?> Edit <?php } else{ ?> Add <?php } ?>  <?php echo $item; ?></a> </li>
      </ul>
     <!-- BEGIN ALERT MESSAGE --> 
<div class="row">
    <div class="col-md-12">
        <?php $successmsg = $this->session->flashdata('successmsg'); ?>
        <?php if(!empty($successmsg)) : ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                <strong>Success!</strong> <?= $successmsg; ?>
            </div>
        <?php endif; ?>
        <?php $infomsg = $this->session->flashdata('infomsg'); ?>
        <?php if(!empty($infomsg)) : ?>
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                <strong>Info!</strong> <?= $infomsg; ?>
            </div>
        <?php endif; ?>
        <?php $errormsg = $this->session->flashdata('errormsg'); ?>
        <?php if(!empty($errormsg)) : ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                <strong>Error!</strong> <?= $errormsg; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- END ALERT MESSAGE -->
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">
          <div class="row">
            <div class="col-md-9">
              <div class="row"> 
                <!--end col-md-8--> 
                <!--end col-md-4--> 
              </div>
              <!--end row-->
              <div class="tab-pane active" id="tab1">
                <form name="frm" id="frm" action="<?php echo base_url();?>episode/add_episode_to_database" method="post" enctype="multipart/form-data">
                  <?php if($do=="edit"){ ?>
                  <input type="hidden" name="id" value="<?php echo $categorydata['id'];?>">
                  <?php } ?>
                  <div class="form-group">
                    <label class="control-label col-md-4">Title <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="title" name="title" value="<?php echo !empty($categorydata['title']) ? $categorydata['title']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Sub Title <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo !empty($categorydata['subtitle']) ? $categorydata['subtitle']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Amount </label>
                    <div class="col-md-8">
                      <input type="number" class="form-control" id="amount" name="amount" value="<?php echo !empty($categorydata['amount']) ? $categorydata['amount']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-4">Sub Title 2 <span class="required"> * </span></label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="subtitle2" name="subtitle2" value="<?php echo !empty($categorydata['subtitle2']) ? $categorydata['subtitle2']: ""; ?>">
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-4">Matthew 4:9<span class="required"> * </span></label>
                    <div class="col-md-8">
                      <textarea class="form-control ckeditor" rows = "6" name="matthew" id="matthew" ><?php echo !empty($categorydata['matthew']) ? $categorydata['matthew']: ""; ?></textarea>
                    <!--   <input type="text" class="form-control" id="matthew" name="matthew" value="<?php echo !empty($categorydata['matthew']) ? $categorydata['matthew']: ""; ?>"> -->
                      <span class="help-block" id="matthew_error"> </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Subal Stearns<span class="required"> * </span></label>
                    <div class="col-md-8">
                       <textarea class="form-control ckeditor" rows = "6" name="subal_stearns" id="subal_stearns" ><?php echo !empty($categorydata['matthew']) ? $categorydata['subal_stearns']: ""; ?></textarea>
                     <!--  <input type="text" class="form-control" id="subal_stearns" name="subal_stearns" value="<?php echo !empty($categorydata['subal_stearns']) ? $categorydata['subal_stearns']: ""; ?>"> -->
                      <span class="help-block" id="subal_stearns_error"> </span> </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4">Visible for </label>
                    <div class="col-md-8" id="visible_plans">
                 
                    <?php 
                      $plans =  explode(",",$categorydata['bhps_planId']); 
                    foreach ($bhpsplans as $key => $value) {   

                       if (in_array($value['id'], $plans)) { ?>
                        <input type="checkbox" checked="" id="bhpsplanId_<?=$value['id']?>" name="bhps_planId[]" value="<?=$value['id']?>">
                      <label for="subscription_plan"> <?=$value['name']?></label><br>
                         <?php  } else { ?>
                          <input type="checkbox"  id="bhpsplanId_<?=$value['id']?>" name="bhps_planId[]" value="<?=$value['id']?>">
                      <label for="subscription_plan"> <?=$value['name']?></label><br>
                         <?php  }
                      
                    }   ?>
                      <span class="help-block" id="title_error"> </span> </div>
                  </div>


                 <div class="form-group">
                  <label class="control-label col-md-4" >Image <span class="required">*</span></label>
                  <div class="col-md-8">
                    <span class="error_"> </span>
                   <?php if($do=="edit"){ ?>
                    <!-- <input type="file" class="form-control" name="image[]" multiple accept="image/*" > -->

                   



                  <!--   <img src="<?php echo !empty($categorydata['image']) ? base_url().'../pics/episode/'.$categorydata['image']: ""; ?>"> -->

                    
                    <input class="form-control" type="file" id="files" multiple accept="image/*"/ required="required">
                    <?php 
                      $count = 1;
                      $existed_img = [];
                     foreach (array_filter(explode(",",$categorydata['image'])) as $key => $value) { 
                      $class = ''; 
                      if($count == 1){
                        $class = 'img_selected_crop'; 
                      }
                      if(!empty($categorydata['image']) ){
                        $img_path = base_url().'../pics/episode/'.$value;
                        $img_type = pathinfo($img_path, PATHINFO_EXTENSION);
                        $img_result = file_get_contents($img_path);
                        $img_base64 = 'data:image/' . $img_type . ';base64,' . base64_encode($img_result);
                        $existed_img[] = $img_base64;
                      }
                    ?>
                      <span class="pip">
                        <img class="imageThumb <?php echo $class;?>" title="undefined" src="<?php echo !empty($categorydata['image']) ? $img_base64: ""; ?>" old-img="<?php echo !empty($categorydata['image']) ? $img_base64: ""; ?>"><br>
                        <span class="remove">Remove image</span>
                        <div></div>
                      </span>
                        <!--  <img src="<?php echo !empty($categorydata['image']) ? base_url().'../pics/episode/'.$value: ""; ?>"> -->
                   <?php   $count++; }   ?>
                    <input type="hidden" name="images" id="crop_im_data" value="<?php echo '|,|'.implode('|,|', $existed_img);?>">
                    <div class="field" align="left">
                      <?php 
                        $copy_text = "hide";
                        $copy_css = "";
                        if( !empty( str_replace('|,|','', $existed_img) ) ) { 
                          $copy_text = "";
                          $copy_css = "width:300px;";
                        } 
                       ?>
                      <div id="crop_im" style="width: 300px; <?php echo $copy_css;?>"></div>
                      <button class="btn save crop_btn <?php echo $copy_text;?>">Copy</button>
                    </div>

                    <!-- <input type="file" class="form-control" name="image[]" multiple accept="image/*" required=""> 
                    <span class="required" style="color:red">*please upload image</span> -->


                   <?php }else{?>                      
                      <input type="hidden" name="images" id="crop_im_data">
                      <div class="field" align="left">
                        <input class="form-control" type="file" id="files"  accept="image/*" multiple required="required"/>
                        <div id="crop_im" style="width: 300px; height: 300px;"></div>
                        <button class="btn save hide crop_btn">Crop</button>
                      </div>
                      <!-- <input type="file" class="form-control" name="image[]" multiple accept="image/*" required=""> 
                      <span class="required" style="color:red">*please upload image</span> -->
                   <?php }?>
                  </div>
                 </div>
                 <div class="form-group">
                  <label class="control-label col-md-4" >Audio <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="audio[]" multiple accept="audio/*" >
                    <span class="required" style="color:red">*please upload audio</span>

                     <!-- <audio controls>
                        <source src="horse.ogg" type="audio/ogg">
                        <source src="<?php echo !empty($categorydata['audio']) ? base_url().'../pics/episode/'.$categorydata['audio']: ""; ?>" type="audio/mpeg">
                      Your browser does not support the audio element.
                      </audio> -->

                       <?php foreach (array_filter(explode(",",$categorydata['audio'])) as $key => $value) { ?>


                        <audio controls playsinline>
                          <source src="horse.ogg" type="audio/ogg">
                          <source src="<?php echo !empty($categorydata['audio']) ? base_url().'../pics/episode/'.$value: ""; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio>



                     <?php  }   ?>


                   <?php }else{?>
                    <input type="file" class="form-control" name="audio[]" multiple accept="audio/*" required=""> 
                    <span class="required" style="color:red">*please upload audio</span>
                   <?php }?>
                  </div>
                 </div>

                 <div class="form-group">
                  <label class="control-label col-md-4" >Video <span class="required">*</span></label>
                  <div class="col-md-8">
                   <?php if($do=="edit"){ ?>
                    <input type="file" class="form-control" name="video[]" multiple accept="video/*" >
                    <span class="required" style="color:red">*please upload video</span>
                   <!--  <video width="320" height="240" controls>
                      <source src="<?php echo !empty($categorydata['video']) ? base_url().'../pics/episode/'.$categorydata['video']: ""; ?>" type="video/mp4">
                      <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                    </video> -->

                     <?php foreach (array_filter(explode(",",$categorydata['video'])) as $key => $value) { ?>
                      <video width="320" height="240" controls playsinline>
                        <source src="<?php echo !empty($categorydata['video']) ? base_url().'../pics/episode/'.$value: ""; ?>" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                      Your browser does not support the video tag.
                      </video>

                      

                   <?php  }   ?>
                    
                   <?php }else{?>
                    <input type="file" class="form-control" name="video[]" multiple accept="video/*" required=""> 
                    <span class="required" style="color:red">*please upload video</span>



                   <?php }?>
                  </div>
                 </div>

                   <div class="form-group"><br><br>
                    <label class="control-label col-md-4">&nbsp; </label>
                    <div class="col-md-8" style="margin-top: 7px;">
                      <input type="submit" value="Save" class="btn theme-btn green pull-left" onclick="return validate_form();">
                      <a href="<?php echo base_url();?>episode"  class="btn theme-btn grey pull-left margd">Cancel</a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--tab_1_2--> 
    </div>
  </div>
  <!--END TABS--> 
</div>
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/msdropdown/jquery.dd.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<?php /*?><script type="text/javascript" src="<?php echo BASEURL; ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<!-- BEGIN PAGE LEVEL SCRIPTS -->  <?php */?>
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/components-pickers.js"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
  jQuery(document).ready(function() {       
   // initiate layout and plugins
  // App.init();
  //ComponentsPickers.init();
  });   
</script> 


<?php 
  if(isset($categorydata['image'] ) && !empty($categorydata['image'])){
    $category_data =  array_filter(explode(",",$categorydata['image']) );
    $img_path = base_url().'../pics/episode/'.$category_data[0];
    $img_type = pathinfo($img_path, PATHINFO_EXTENSION);
    $img_result = file_get_contents($img_path);
    $img_base64 = 'data:image/' . $img_type . ';base64,' . base64_encode($img_result);

?>
  
  <script type="text/javascript">
    $("#crop_btn").show();
  /*  let img = document.createElement('img');
        img.id = 'image';
        img.src = '<?php echo $img_path;?>';
        cropper = new Cropper(img);
        $("#crop_im").html(img);*/
  </script>
<?php } ?>
<script>
  var planLab = '';
function validate_form(){
  var title = $('#title').val();
     if(title == ""){
    $('.help-block').html('');
    $('#title_error').html('Error : Please Provide Title').css({'color':'red'});
    $('#title').focus(); 
    return false;
   } 
     else{
     return true;
   }
}

$('#visible_plans input[type="checkbox"]').click(function() { 

  var id = $(this).attr('id');
  planLab = $('input:checkbox:checked').map(function() {
          return $.trim($(this).next('label').text());
        }).get();
  var str = $.trim(planLab);//JSON.stringify(planLab).replace(/"([^"]*)"/g, '$1').replaceAll("[", "").replaceAll("]", '');
  if(str === 'Free'){ 
    $('#visible_plans input[type=checkbox]').attr("disabled", true);
    $('#'+id).attr("disabled", false);
  }else{
    $('#visible_plans input[type=checkbox]').attr("disabled", false);
    $('#'+id).attr("disabled", false);
  }
});
</script>

 <script type="text/javascript">
  $(document).ready(function() {
      var images = $('.pip').length;
      // console.log("images");
      // console.log(images);
      // console.log("images");
      if(images > 0){
        $('#files').removeAttr('required');
      }
      var do_ = '<?php echo $do; ?>';
      if(do_ == 'edit'){
        let img = document.createElement('img');
          img.id = 'image';
          img.src = '<?php echo $img_path;?>';
          cropper = new Cropper(img);
          $("#crop_im").html(img);
      }

     $(document).on("click", ".remove",function(){
        this_d = $(this);
        var crop_im_data = $("#crop_im_data").val();
        var splited = crop_im_data.split('|,|');
        

        var split = splited.filter(function (e) { 
          var new_splited = $(this_d).parent(".pip").find('img').attr('src');
          if( e != "" && new_splited != e ){ return e; } 
        });
        var res = split.join('|,|');
        $("#crop_im_data").val(res);


        $(this).parent(".pip").remove();
        if($('.pip').length == 0){
          $("#files").attr('required', 'required');
          $("#crop_im").css('display', 'none');
          $(".crop_btn").addClass('hide');
        }else{
          $("#files").removeAttr('required')
          $("#crop_im").show();
          $("#crop_im").css('display', 'block');
        }

        $("#files").next().find('img').addClass('img_selected_crop');
      //  $(thisD).parent().parent().closest('.pip').addClass('img_selected_crop');
        var src = $("#files").next().find('img').attr('src');
        $('.cropper-canvas img').attr('src', src);
        $('.cropper-view-box img').attr('src', src);
      });



    $('#files').val('');
    let  save = document.querySelector('.save');
    if (window.File && window.FileList && window.FileReader) {
      $("#files").on("change", function(e) {
        thisd = $(this);
        var files = e.target.files,
        filesLength = files.length;
        var a = 1;
        var images = $('.pip').length;

        var final_lenght = images+filesLength; 
        console.log(typeof final_lenght, final_lenght);
        if(final_lenght > 5){
          $('.error_').html('<span class="errormsg"> You Can upload maximum 5 Images</span>');
          return;
        }else{
          $("#crop_im").css('display', 'block');
          $("#crop_im").css({'height':'300px'});
        }

        for (var i = 0; i < filesLength; i++) {
          var f = files[i];
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            // show save btn and options
            save.classList.remove('hide');
            let img = document.createElement('img');
            img.id = 'image';
            img.src = e.target.result
            cropper = new Cropper(img);
            $("#crop_im").html(img);
            var crop_im_data = $("#crop_im_data").val();
            $("#crop_im_data").val(crop_im_data+'|,|'+e.target.result);

            var class_ = "imageThumb";
            $("<span class=\"pip\">" +
              "<img class=\""+ class_ +"\" old-img=\"" + e.target.result + "\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
              "<br/><span class=\"remove\">Remove image</span>" +
              "</span>").insertAfter("#files");
           
          });
          fileReader.readAsDataURL(f);
          a++;
        }
        setTimeout(function(){ $('.imageThumb').removeClass('img_selected_crop'); thisd.next().find('img').addClass('img_selected_crop'); console.log(files);  }, 500);
      });

    } else {
      alert("Your browser doesn't support to File API")
    }
  });

  $(document).on("click", ".imageThumb", function(){
    $(".imageThumb").removeClass("img_selected_crop");
    $(this).addClass("img_selected_crop");
    var cropper = '';
    var src = $(this).attr('old-img');
    $('.cropper-canvas img').attr('src', src);
    $('.cropper-view-box img').attr('src', src);
    //$("#crop_im").html(img);
  });

  let result = document.querySelector('.result'),
  img_result = document.querySelector('.img-result'),
  img_h = document.querySelector('.img-h'),

  cropped = document.querySelector('.cropped'),
  upload = document.querySelector('#file-input'),
  cropper = '';
  save = document.querySelector('.save');

  $(document).on('click', '.save', function(e){
    e.preventDefault();
      var crop_im_data = $("#crop_im_data").val();
      var splited = crop_im_data.split('|,|');

      var split = splited.filter(function (e) { 
        var selected_src = $('.img_selected_crop').attr('src');
        if( e != "" && selected_src != e ){ return e; } 
      });

      let imgSrc = cropper.getCroppedCanvas({
        width: 300 // input value
      }).toDataURL();
      
      $(".img_selected_crop").attr('src',imgSrc);
      split.push(imgSrc);
      var res= split.join('|,|');
      $("#crop_im_data").val(res);

  });


</script>