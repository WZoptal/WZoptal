    <main>
      <div class="container-fluid px-0">
        <div class="mx-auto tm-content-container">          
          <div class="row mt-3 mb-5 pb-3">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title mb-4 tm-text-primary">Forgot Form</h2>
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
          <div class="mx-auto pb-3 tm-about-text-container px-3">
              <div class="row">
                
                  <div class="col-lg-6 mb-5">
                    <div id="messgae"></div>
                      <form id="SignIn-form" action="<?=base_url()?>forgot/forgot_password" method="POST" class="tm-contact-form">
                        

                        <div class="form-group">
                          <input type="email" name="email" class="form-control rounded-0" placeholder="Email" required="" />
                        </div>
                        <div class="form-group mb-0">
                          <button type="submit"  class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"><span>Submit</span></button>
                        </div>
                      </form>    
                     <a href="login">Login now</a>
                  </div>
              </div>  
          </div>    
        </div>
        <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="<?=base_url()?>website/img/contact-2.jpg"></div>
      </div>
    </main>



   