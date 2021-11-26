<div class="position-relative">
    <div class="position-absolute tm-site-header">
        <div class="container-fluid position-relative">
            <div class="row">
                <div class="col-7 col-md-4">
                    <!-- <a href="home" class="tm-bg-black text-center tm-logo-container">
                        <i class="fas fa-video tm-site-logo mb-3"></i>
                        <h1 class="tm-site-name">BHPS</h1>
                    </a> -->
                    <a href="home" class="tm-bg-black text-center tm-logo-container">
                        <img src="<?=base_url()?>img/BHPS Logo_Final - White.svg" width="300">
                    </a>
                </div>
                <div class="col-5 col-md-8 ml-auto mr-0">
                    <div class="tm-site-nav">
                        <nav class="navbar navbar-expand-lg mr-0 ml-auto" id="tm-main-nav">
                            <button class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed" type="button"
                                data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span>
                                    <i class="fas fa-bars tm-menu-closed-icon"></i>
                                    <i class="fas fa-times tm-menu-opened-icon"></i>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                                <ul class="navbar-nav text-uppercase">
                                    <!-- <li class="nav-item <?=$this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                                        <a class="nav-link tm-nav-link" href="<?=base_url()?>home">Episodes  <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item <?=$this->uri->segment(1) == 'about' ? 'active' : '' ?>">
                                        <a class="nav-link tm-nav-link" href="<?=base_url()?>about">About</a>
                                    </li> -->
                                 

                                        <li class="nav-item <?=$this->uri->segment(1) == 'subscription' ? 'active' : '' ?>">
                                            <a class="nav-link tm-nav-link" href="<?=base_url()?>subscription">subscription </a>
                                        </li>

                                 
                                    <?php if($this->session->userdata('logged_in') == 1){?>
                                    <li class="nav-item <?=$this->uri->segment(1) == 'profile' ? 'active' : '' ?>">
                                        <a class="nav-link tm-nav-link" href="<?=base_url()?>profile">Profile</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('logged_in') != 1){?>
                                    <li class="nav-item <?=$this->uri->segment(1) == 'signup' ? 'active' : '' ?>">
                                        <a class="nav-link tm-nav-link" href="<?=base_url()?>login">Login/Signup <span class="sr-only">(current)</span></a>
                                    </li>
                                    <?php }else{ ?>
                                    <li class="nav-item">
                                        <a class="nav-link tm-nav-link" href="<?=base_url()?>login/logout">Logout <span class="sr-only">(current)</span></a>
                                    </li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tm-welcome-container text-center text-white">
        <div class="tm-welcome-container-inner">
          
            <?php if($this->uri->segment(1)== 'subscription' ){?>
                <p class="tm-welcome-text mb-1 text-white">Choose a plan to explore the paid episode and enjoy.</p>
                <p class="tm-welcome-text mb-5 text-white">This page show the avaliable plans.</p>

            <?php }else if($this->uri->segment(1)== 'home' ){?>
                <p class="tm-welcome-text mb-1 text-white">All latest and previous episodes.</p>
                <p class="tm-welcome-text mb-5 text-white">This page show all the avaliable episodes .</p>
            <?php }else{?>
                <p class="tm-welcome-text mb-1 text-white">Video Catalog is brought to you by TemplateMo.</p>
                <p class="tm-welcome-text mb-5 text-white">This is a full-width video banner.</p>
            <?php } ?>
            <a href="#content" class="btn tm-btn-animate tm-btn-cta tm-icon-down">
                <span>Discover</span>
            </a>
        </div>
    </div>

    <div id="tm-video-container">
        <img  id="tm-video" src="<?= base_url().'/img/hero-image.jpg'; ?>">
        <!-- <video autoplay muted loop id="tm-video">
                <source src="<?= base_url(); ?>website/video/wheat-field.mp4" type="video/mp4">
        </video>     -->
    </div>
    
    <!-- <i id="tm-video-control-button" class="fas fa-pause"></i> -->
</div>