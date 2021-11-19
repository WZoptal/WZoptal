                <main>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-page-title mb-4">All Episodes</h2>
                            <!-- <div class="tm-categories-container mb-5">
                                <h3 class="tm-text-primary tm-categories-text">Categories:</h3>
                                <ul class="nav tm-category-list">
                                    <li class="nav-item tm-category-item"><a href="#" class="nav-link tm-category-link active">All</a></li>
                                    <li class="nav-item tm-category-item"><a href="#" class="nav-link tm-category-link">Drone Shots</a></li>
                                    <li class="nav-item tm-category-item"><a href="#" class="nav-link tm-category-link">Nature</a></li>
                                    <li class="nav-item tm-category-item"><a href="#" class="nav-link tm-category-link">Actions</a></li>
                                    <li class="nav-item tm-category-item"><a href="#" class="nav-link tm-category-link">Featured</a></li>
                                </ul>
                            </div>    -->     
                        </div>
                    </div>
                    
                    <div class="row tm-catalog-item-list">
                        <?php  foreach ($resultset as $key => $value) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
                                <div class="position-relative tm-thumbnail-container">
                                    <img src="<?= base_url(); ?>pics/episode/<?=$value['image']?>" alt="Image" class="img-fluid tm-catalog-item-img">    
                                    <a href="#" class="position-absolute tm-img-overlay">
                                       <!--  <i class="fas fa-search tm-overlay-icon"></i> -->
                                    </a>
                                </div>    
                                <div class="p-4 tm-bg-gray tm-catalog-item-description">
                                    <h3 class="tm-text-primary mb-3 tm-catalog-item-title"><?=$value['title']?></h3>
                                    <p class="tm-catalog-item-text"><?=$value['subtitle']?> <span class="tm-text-secondary"><?=$value['subtitle2']?></span><?=$value['matthew']?></p>
                                   <!--  <button class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">  -->
                                      <?php if($value['amount'] > 0 ){?>
                                        <?php if($userData['plan_status'] == 'active'){?>
                                            <a href="home/episode/<?=$value['id']?>" class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">
                                                $ <?=$value['amount']?>
                                            </a>

                                        <?php }else{?>

                                            <a href="subscription" class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">
                                                $ <?=$value['amount']?>
                                            </a>
                                        <?php } ?>
                                      <?php }else{?>
                                        <a href="home/episode/<?=$value['id']?>" class="btn btn-primary rounded-0 d-block ml-auto mr-0 tm-btn-animate tm-btn-submit tm-icon-submit">
                                            Free Episode
                                        </a>
                                      <?php } ?>
                                             
                                <!-- </button> -->
                                </div>
                            </div>
                        <?php }  ?>
                    </div>
                     <!-- Catalog Paging Buttons -->
                    <div>
                        <ul class="nav tm-paging-links">
                                <?php echo $this->pagination->create_links(); ?>
                        </ul>
                    </div>
                </main>

                
               