
    <main>
      <div class="container-fluid px-0">
        <div class="mx-auto tm-content-container">          
          <div class="row mt-3 mb-5 pb-3">
            <div class="col-12">
              <div class="mx-auto tm-about-text-container px-3">
                <h2 class="tm-page-title tm-text-primary">Terms & Conditions</h2> 
                 
              </div>              
            </div>            
          </div>
          <div class="mx-auto pb-3 tm-about-text-container px-3 subscription-styl">
                <div class="row">
                    <?=$resultset['page_content']?>

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
  
