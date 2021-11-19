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
        <div class="profile-style mx-auto tm-content-container">          
          <div class="row">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title tm-text-primary">Manage your profile</h2>

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
                    <form id="update-form" action="<?php echo base_url();?>profile/add_profile_to_database" method="POST" class="tm-contact-form" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $resultset['id'];?>">
                      <div class="form-group required">
                        <label class="control-label">Full Name</label>
                        <input type="text" name="name" class="form-control rounded-0" placeholder="Full Name" required="" value="<?php echo !empty($resultset['name']) ? $resultset['name']: ""; ?>" />
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control rounded-0" placeholder="User name" required="" value="<?php echo !empty($resultset['username']) ? $resultset['username']: ""; ?>"/>
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Email Address</label>
                        <input type="email" name="email" class="form-control rounded-0" placeholder="Email Address" required="" value="<?php echo !empty($resultset['email']) ? $resultset['email']: ""; ?>" />
                      </div>
                      <div class="form-group required">
                        <label class="control-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control rounded-0" placeholder="Phone Number" required="" value="<?php echo !empty($resultset['phone']) ? $resultset['phone']: ""; ?>"/>
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Country</label>
                        <select class="form-control" id="contact-select" name="country">
                          

                          <?php foreach ($country as $key => $value) {?>
                            <option value="<?=$value['id']?>" <?=$resultset['country']== $value['id'] ? "selected" : ""?> ><?=$value['nicename']?></option>
                          <?php  } ?>

                         
                        </select>
                      </div>

                      <div class="form-group required">
                        <label class="control-label">Gender</label>
                        <select class="form-control" id="contact-select" name="gender">
                          <option value="1" <?=$resultset['gender']==1 ? "selected" : ""?>>Male</option>
                          <option value="2" <?=$resultset['gender']==2 ? "selected" : ""?>>Female</option>
                        </select>
                      </div>
                      <div class="form-group required">
                        <label class="control-label">Pin code</label>
                        <input type="text" name="pincode" class="form-control rounded-0" placeholder="Pin code" required="" value="<?php echo !empty($resultset['pincode']) ? $resultset['pincode']: ""; ?>"/>
                      </div>
                       <div class="form-group required profile">
                         <label class="control-label col-md-4" >Profile</label>
                        <div class="col-md-8">
                         <?php if(!empty($resultset['profile_pic'])){ ?>
                          <input type="file" class="form-control" name="image" accept="image/*" >
                          <img width="200"  src="<?php echo !empty($resultset['profile_pic']) ? base_url().'./pics/profile_pics/'.$resultset['profile_pic']: ""; ?>">
                        
                         <?php }else{?>
                          <input type="file" class="form-control" name="image" accept="image/*" > 
                          
                         <?php }?>
                        </div>
                       </div>
                      <div class="form-group mb-0">
                        <button type="submit"  class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit"><span>Update</span></button>
                      </div>
                    </form>    
                </div>
            </div>  
          </div>    
        </div>
        <div class="parallax-window parallax-window-2" data-parallax="scroll" data-image-src="<?=base_url()?>website/img/contact-2.jpg"></div>
      </div>
    </main>


  