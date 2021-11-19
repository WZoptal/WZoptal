
    <main>
      <div class="container-fluid px-0">
        <div class="mx-auto tm-content-container">          
          <div class="row mt-3 mb-5 pb-3">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title tm-text-primary">Subscription Plans</h2> 
                  <?php if($userData['plan_status'] == 'active'){?>
                   <button type="button" class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit" data-toggle="modal" data-target="#exampleModalCenter">
                      Cancle Your Subscription
                    </button>

                  <?php } ?>
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
          </div>
          <div class="mx-auto pb-3 tm-about-text-container px-3 subscription-styl">
                <div class="row">
                    <?php  foreach ($resultset as $key => $value) {  ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
                        <div class="position-relative tm-thumbnail-container">
                            <img src="<?=base_url()?>pics/plans/<?=$value['image']?>" alt="Image" class="img-fluid tm-catalog-item-img">    
                            <a href="#" class="position-absolute tm-img-overlay">
                                <i class="fas fa-play tm-overlay-icon"></i>
                            </a>
                        </div>
                        <div class="p-4 tm-bg-gray tm-catalog-item-description" id="plan_div">
                            <h3 class="tm-text-primary mb-3 tm-catalog-item-title"><?=$value['name']?></h3>
                            <p class="tm-catalog-item-text"><?=$value['title']?> 
                                <span class="tm-text-secondary"><?=$value['description']?></span></p>
                               
                                <?php if($value['amount'] !=''){  ?>
                                  
                                   <?php if($userData['planId'] == $value['id']){  ?>
                                     <button  class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">
                                      You are at now
                                    </button>
                                  <?php } else{ ?>

                                    <button id="planId_<?=$value['id']?>_<?=$value['is_free']?>" <?php $value['is_free']== 1 ? 'disabled=""' : ""?> class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">
                                   <?=$value['currency_symble'].' '.$value['amount'] ?>
                                   </button>
                                   <?php  } ?>
                                  
                                <?php } else{?>
                                  <button class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"> 
                                    Free Plan
                                  </button>
                                <?php }?>
                        </div>
                    </div>
                    <?php }  ?>
                 </div>
                <ul class="nav tm-paging-links">
                        <?php echo $this->pagination->create_links(); ?>
                </ul>

            </div>  
          </div>    
        </div>
        <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="<?=base_url()?>website/img/contact-2.jpg"></div>
      </div>
    </main>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         You want to cancle your subscription.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-primary" id="cancle-subscription">Yes</button>
        </div>
      </div>
    </div>
  </div>
  
<style type="text/css">
  
.modal-header-panel {
    display: -ms-flexbox;
    /* display: flex; */
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
}


</style>


<!-- Modal -->
  <div class="modal fade" id="freeSubscription" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-panel">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display:;">Subscription</h4>
        </div>
        <div class="modal-body">
          <p>This is the free subscription. You don't need to buy.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


