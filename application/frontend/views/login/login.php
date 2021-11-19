        
<style>
 .form-group.required .control-label:after {
  content:"*";
  color:red;
}
.form-group.required .control-label {
  position: relative;
}


/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>
    <main>
      <div class="container px-0">
        <div class="mx-auto tm-content-container">          
          <div class="row mt-3 mb-3">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title tm-text-primary">Login Form</h2>
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
                      <form id="SignIn-form" action="<?=base_url()?>login/verifyUser" method="POST" class="tm-contact-form">
                        

                        <div class="form-group required">
                           <label class="control-label">Email</label>
                          <input type="email" name="email" class="form-control rounded-0" placeholder="Email" required="" />
                        </div>
                       

                        
                        <div class="form-group required">
                           <label class="control-label">Password</label>
                          <input type="password" name="password" class="form-control rounded-0" placeholder="Password" required="" />
                        </div>

                      
                        <input type="hidden" name="user_type" value="2" />
                        <input type="hidden" name="device_type" value="1234" />
                        <input type="hidden" name="device_token" value="1234" />

                        <div class="form-group mb-0">
                          <button type="submit"  class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"><span>Sign In</span></button>
                        </div>
                      </form>    
                     <a class="singup" href="signup">Sign Up</a>
                    <a class="forgt-p" href="forgot">Forgot password</a>
                  </div>
              </div>  
          </div>    
        </div>
        <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="<?=base_url()?>website/img/contact-2.jpg"></div>
      </div>
    </main>



   