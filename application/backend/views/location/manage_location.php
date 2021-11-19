<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url(); ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <h3 class="page-title"> Location Management </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li class="btn-group"> <a href="<?php echo base_url(); ?>location/add_location" class="btn green dropdown-toggle "> <i class="fa fa-plus-circle" aria-hidden="true"></i> <span> Add <?php echo $item; ?> </span></a> </li>
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="javascript:void(0);"> Location Management </a> </li>
    </ul>
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER--> 
<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <div class="col-md-12">
    <div class="tabbable tabbable-custom tabbable-full-width">
      <ul class="nav nav-tabs">
        <li class="active"> <a data-toggle="tab" href="#tab_1_5"> Location Management </a> </li>
      </ul>
      <div class="tab-content"> 
        
        <!--end tab-pane-->
        <div id="tab_1_5" >
          <div class="row search-form-default">
            <?php $search=$this->input->get("search"); ?>
            <div class="col-md-12">
              <form class="form-inline" action="<?php echo base_url();?>location/manage_location?" id="search">
                <div class="input-group">
                  <div class="input-cont">
                    <input type="text" placeholder="Search by Title" class="form-control"  name="search"  value="<?php echo ($search!='' && $search!='search' )?$search:''; ?>"/>
                  </div>
                  <span class="input-group-btn">
                  <button type="button" class="btn green" onclick="document.getElementById('search').submit();"> Search &nbsp; <i class="m-icon-swapright m-icon-white"></i> </button>
                  </span> </div>
              </form>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-advance table-hover">
              <thead>
                <tr>
                  <th> Title </th>
  				        <th> Posted</th>
                  <th> Status </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php  if(count($resultset) > 0){ foreach($resultset as $key=>$val){
  				?>
                <tr>
                  <td><?php echo $val['title'];?></td>
          				  <td><?php echo date('M d, Y',  $val['created_at']); ?></td>
                          <td><?php if($val['status'] == '1'){ ?>
                            <span class="label label-sm"> <a href="<?php echo base_url();?>location/enable_disable_location/<?php echo $val['id'];?>/0/<?php echo $page; ?>" onclick="return dis_fun('<?php echo $item; ?>');" title="Disable"><i class="fa fa-check fonta" aria-hidden="true"></i></a> </span>
                      <?php }
        					else{ 
        			  ?>
                    <span class="label label-sm"> <a href="<?php echo base_url();?>location/enable_disable_location/<?php echo $val['id'];?>/1/<?php echo $page; ?>" onclick="return enb_fun('<?php echo $item; ?>');" title="Enable"><i class="fa fa-times fonta" style="color:red"></i></a> </span>
                    <?php } ?></td>  
                   <td>
                   		<a href="<?php echo base_url(); ?>location/view_location/<?php echo $val['id'];?>"> <i class="fa fa-search fonta"></i> </a> 
                        <a href="<?php echo base_url();?>location/archive_location/<?php echo $val['id'];?>" onclick="return archive_fun('<?php echo $item?>');"><i class="fa fa-trash-o fonta"></i></a>
                         <a href="<?php echo base_url(); ?>location/edit_location/<?php echo $val['id'];?>"><i class="fa fa-edit fonta"></i></a></td>
                </tr>
                <?php }}else{ ?>
                <tr class="scndrow">
                  <td colspan="6" align="center">No record found</td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <div class="margin-top-20">
            <ul class="pagination">
              <?php echo $this->pagination->create_links(); ?>
            </ul>
          </div>
        </div>
        <!--end tab-pane--> 
      </div>
    </div>
  </div>
  <!--end tabbable--> 
</div>
<!-- END PAGE CONTENT--> 

<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/search.js"></script> 
<script>
jQuery(document).ready(function() {    
   App.init();
   Search.init();
});
</script>