<main>
					<div class="row mb-5 pb-4">
						<div class="col-12">
							<!-- Video player 1422x800 -->
							<video width="1422" height="800" controls autoplay="false">
							  <source src="<?=base_url().'pics/episode/'.$resultset['video']?>" type="video/mp4">							  
							Your browser does not support the video tag.
							</video>
						</div>
					</div>
					<div class="row mb-5 pb-5">
						<div class="col-xl-8 col-lg-7">
							<!-- Video description -->
							<div class="tm-video-description-box">
								<h2 class="mb-5 tm-video-title"><?=$resultset['title']?></h2>
								<p class="mb-4"><?=$resultset['subtitle2']?></p>
								<p class="mb-4"><?=$resultset['matthew']?></p>	
							</div>							
						</div>
						<div class="col-xl-4 col-lg-5">
							<!-- Share box -->
							<div class="tm-bg-gray tm-share-box">
								<h6 class="tm-share-box-title mb-4"><?=$resultset['subtitle']?></h6>
								<div class="mb-5 d-flex">
									<img src="<?=base_url().'pics/episode/'.$resultset['image']?>" width="400">
								</div>
								<p class="mb-4">Amount: <a href="https://templatemo.com" class="tm-text-link">$<?=$resultset['amount']?></a></p>
								<!-- <a href="#" class="tm-bg-white px-5 mb-4 d-inline-block tm-text-primary tm-likes-box tm-liked">
									<i class="fas fa-heart mr-3 tm-liked-icon"></i>
									<i class="far fa-heart mr-3 tm-not-liked-icon"></i>
									<span id="tm-likes-count">486 likes</span>
								</a> -->

								<audio class="tm-bg-white px-5 mb-4 d-inline-block tm-text-primary tm-likes-box tm-liked" controls>
								  <source src="horse.ogg" type="audio/ogg">
								  <source src="<?=base_url().'pics/episode/'.$resultset['audio']?>" type="audio/mpeg">
								Your browser does not support the audio element.
								</audio>

								<!-- <a href="#" class="tm-bg-white px-5 mb-4 d-inline-block tm-text-primary tm-likes-box tm-liked">
									<i class="fas fa-heart mr-3 tm-liked-icon"></i>
									<i class="far fa-heart mr-3 tm-not-liked-icon"></i>
									<span id="tm-likes-count">486 likes</span>
								</a> -->
								<!-- <div>
									<button class="btn btn-primary p-0 tm-btn-animate tm-btn-download tm-icon-download"><span>Download Video</span></button>	
								</div> -->								
							</div>
						</div>
					</div>
					<!-- <div class="row pt-4 pb-5">
						<div class="col-12">
							<h2 class="mb-5 tm-text-primary">Related Videos for You</h2>
							<div class="row tm-catalog-item-list">
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-01.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>    
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Nam tincidunt consectetur</h3>		                                
		                            </div>
		                        </div>
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-02.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Praesent posuere rhoncus</h3>		                                
		                            </div>
		                        </div>
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-03.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>                            
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Turpis massa aliquam</h3>		                                
		                            </div>
		                        </div>
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-04.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>    
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Nam tincidunt consectetur</h3>		                                
		                            </div>
		                        </div>
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-05.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Praesent posuere rhoncus</h3>		                                
		                            </div>
		                        </div>
		                        <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
		                            <div class="position-relative tm-thumbnail-container">
		                                <img src="img/tn-06.jpg" alt="Image" class="img-fluid tm-catalog-item-img">    
		                                <a href="video-page.html" class="position-absolute tm-img-overlay">
		                                    <i class="fas fa-play tm-overlay-icon"></i>
		                                </a>
		                            </div>                            
		                            <div class="p-3 tm-catalog-item-description">
		                                <h3 class="tm-text-gray text-center tm-catalog-item-title">Turpis massa aliquam</h3>		                                
		                            </div>
		                        </div>
		                    </div>
						</div>
					</div> -->
				</main>