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
    <h3 class="page-title"> <?php echo $item; ?> Management </h3>
    <ul class="page-breadcrumb breadcrumb">
      <li class="btn-group"> <!--<a href="<?php echo base_url(); ?>users/add_user" class="btn blue dropdown-toggle"> <span style="color:#FFF"> Add Hotel </span></a>--> </li>
      <li> <i class="fa fa-home"></i> <a href="<?php echo base_url(); ?>"> Home </a> <i class="fa fa-angle-right"></i> </li>
      <li> <a href="javascript:void(0);"> <?php echo $item; ?> Management </a> </li>
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
        <li class="active"> <a data-toggle="tab" href="#tab_1_5"> <?php echo $item; ?> Management </a> </li>
      </ul>
      <div class="tab-content"> 
        
        <!--end tab-pane-->
        <div id="tab_1_5" >
          <div class="row search-form-default">
            <?php $search=$this->input->get("search"); ?>
            <div class="col-md-12">
              <form class="form-inline" action="<?php echo base_url();?>posts/manage_posts?" id="search">
                <div class="input-group">
                  <div class="input-cont">
                    <input type="text" title="Search by Restaurant" placeholder="Search by Restaurant/address" class="form-control"  name="search"  value="<?php echo ($search!='' && $search!='search' )?$search:''; ?>"/>
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
                  <th> S. No </th>
                  <th> Posted By </th>
                  <th> Restaurant Name </th>
                  <th> Address </th>
                  <th> Comment </th>
                  <th> Tags </th>
  				  <th> Registration Date</th>
                  <th> Status </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; if(count($resultset) > 0){ foreach($resultset as $key=>$val){ ?>
                <tr>
                  <td><?php echo $i; ?></td>
				  <?php $user_data=$this->posts_model->get_user_data($val['user_id']); ?>
                  <td><?php echo $user_data['username']; ?></td>
                  <td><?php echo $val['restaurant_name']; ?></td>
                  <td><?php echo $val['address'];?></td>
                  <td><?php echo $val['comment'];?></td>
                  <td><?php echo $val['tags'];?></td>
  				  <td><?php echo date('d/m/Y',  $val['time']); ?></td>
                  <td><?php if($val['status'] == '1'){ ?>
                    <span class="label label-sm "> 
                    	<a href="<?php echo base_url();?>posts/enable_disable_posts/<?php echo $val['id'];?>/2/<?php echo $page; ?>" onclick="return dis_fun('<?php echo $item; ?>');"><i class="fa fa-check fonta" aria-hidden="true" style="color:#090"></i></a> </span>
                    <?php }
					else{ ?>
                    <span class="label label-sm"> <a href="<?php echo base_url();?>posts/enable_disable_posts/<?php echo $val['id'];?>/1/<?php echo $page; ?>" onclick="return enb_fun('<?php echo $item; ?>');"><i class="fa fa-times fonta" aria-hidden="true" style="color:red"></i></a> </span>
                    <?php } ?></td>  
                   <td>
                   		<a class="javascript:void(0)" href="<?php echo base_url(); ?>posts/view_posts/<?php echo $val['id'];?>"> <i class="fa fa-search fonta"></i> </a> 
                        <a class="javascript:void(0)" href="<?php echo base_url();?>posts/archive_posts/<?php echo $val['id'];?>" onclick="return archive_fun('<?php echo $item; ?>');"><i class="fa fa-trash fonta"></i></a>
                        <!--<a class="javascript:void(0)" href="<?php echo base_url(); ?>posts/edit_user/<?php echo $val['id'];?>"><i class="fa fa-edit fonta"></i></a>--></td>
                </tr>
                <?php $i++; }}else{ ?>
                <tr class="scndrow">
                  <td colspan="12" align="center">No record found</td>
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
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo base_url(); ?>assets/scripts/core/app.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/index.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/scripts/custom/tasks.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL SCRIPTS --> 
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   initMap();
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initDashboardDaterange();
   Index.initIntro();
   Tasks.initDashboardWidget();
});
</script> 
<!-- END JAVASCRIPTS --> 
