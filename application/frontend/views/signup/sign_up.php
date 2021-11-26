    
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
      <div class="container-fluid px-0">
        <div class="mx-auto tm-content-container">          
          <div class="row mt-3 mb-2 pb-3">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title tm-text-primary">Sign Up Form</h2>

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
                <div class="col-lg-6">
                  <div id="messgae"></div>
                    <form id="signup-form" method="POST" class="tm-contact-form" enctype="multipart/form-data">
                      <div class="form-group required">
                        <label class="control-label">Full Name</label>
                        <input type="text" name="name" class="form-control rounded-0" placeholder="Full Name" required="" />
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control rounded-0" placeholder="Username" required="" />
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Email Address</label>
                        <input type="email" name="email" class="form-control rounded-0" placeholder="Email Address" required="" />
                      </div>
                      
                </div>
                <div class="col-lg-6 ">
                  <div class="form-group required">
                        <label class="control-label">Phone Number</label>
                        <input type="number" name="phone" class="form-control rounded-0" placeholder="Phone Number" required="" />
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Country</label>
                        <select class="form-control" id="contact-select" name="country">
                          <?php 
                          foreach ($country as $key => $value) { ?>
                            <option value="<?=$value['id']?>"><?=$value['nicename']?></option>
                          <?php  } ?>
                        </select>
                      </div>
                      <div class="form-group required">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-0" placeholder="Password" required="" />
                      </div>
                      <input type="hidden" name="user_type" value="1" />
                     
                      
                   
                   
                </div>
            </div>  
            <div class="row sinup-btm">
              <div class="col-12">
                <div class="form-group mb-0 signup-b">
                        <button type="submit"  class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"><span>Sign Up</span></button>
                      </div>
                       <div class="if-already">If already account <a href="login">Login</a></div>
              </div>
            </div>
             </form>    
          </div>    
        </div>
        <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="<?=base_url()?>website/img/contact-2.jpg"></div>
      </div>
    </main>
