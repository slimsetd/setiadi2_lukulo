<?php
/*------------------------------------------------------------

Template          : Slims Cendana Template
Create Date       : March 2, 2017
Author      	  : Eddy Subratha (eddy.subratha{at}gmail.com)
Modified By       : Erwan Setyo Budi (erwans818{at}gmail.com)


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

-------------------------------------------------------------*/
// be sure that this file not accessed directly

if (!defined('INDEX_AUTH')) {
  die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
  die("can not access this file directly");
}
//set default index page
$p = 'home';

if (isset($_GET['p']))
{
 if ($_GET['p'] == 'libinfo') {
  $p = 'libinfo';
} elseif ($_GET['p'] == 'help') {
  $p = 'help';
} elseif ($_GET['p'] == 'member') {
  $p = 'member';
} elseif ($_GET['p'] == 'login') {
  $p = 'login';
} else {
  $p = strtolower(trim($_GET['p']));
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Meta
    include "partials/meta.php";
    ?>
    </head><!--/head-->
<body>
<!-- Template Modified By       : Erwan Setyo Budi (erwans818{at}gmail.com) -->
<!-- added magnifier js -->
<link type="text/css" rel="stylesheet"  href="<?php echo JWB; ?>magnifier/magnifier.css"/>
<script type="text/javascript" src="<?php echo JWB; ?>magnifier/Event.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>magnifier/Magnifier.js"></script>
<script type="text/javascript" src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme']; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo SWB; ?>template/default/js/jquery.jcarousel.min.js"></script>

<style>
#preview-book{
        width: 400px; 
        height: 400px;
        position :fixed; 
        top:25%;               
        bottom: 25%;
        left:25%;
        z-index: 9000;
        border-radius: 5px;        
    }  
</style>	
<!--// Content Ouput //-->
<div class="content">
  <div class="container">
    <div class="row">
      <!--// Check For No Query //-->
      <?php if(isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p'])) { ?>
        <!-- Main Content -->
            <section id="title" class="emerald">
                <div class="container">
                    <div class="row">
                      <?php
                      // Header
                      include "partials/header.php";
                      ?>

                        <div class="col-sm-6">
                            <?php if(@$_GET['p'] != 'member') { ?>
                            <h1>
                                <?php if(!isset($_GET['p'])) { ?>
                                <?php echo __('Collections'); ?>
                                <?php } elseif ($_GET['p'] == 'show_detail') { ?>
                                <?php echo __("Record Detail"); ?>
                                <?php } else { ?>
                                <?php echo $page_title; ?>
                                <?php } ?>
                            </h1>
                            <p><?php echo $page_title; ?></p>
                        </div>
                        <?php } ?>
                        <div class="col-sm-6">
                            <ul class="breadcrumb pull-right">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="javascript: history.back();" ><i class="icon icon-white icon-circle-arrow-left"></i><?php echo __('Back'); ?> </a></li>

                            </ul>
                        </div>
                        
                    </div>

                </div>

            </section><!--/#title--> 

          <?php if(!isset($_GET['p'])) { ?>
            <?php
            // Header
            include "partials/header.php";
            ?>
    <div class="page">
    <section id="blog" class="container">
        <div class="row">
            <aside class="col-sm-4 col-sm-push-8">
                <div id="simply-search" class="widget search">
                <form role="form" action="index.php" method="get" autocomplete="off">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="<?php echo __('Keyword'); ?>"  id="keyword" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" aria-hidden="true" autocomplete="off">   
                            <span class="input-group-btn">
                                <button name="search" value="<?php echo __('Search'); ?>" class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="icon-cog"></i></button>
                            </span>
                        </div>
                    </form>
                </div><!--/.search-->

  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2>Advance Search</h2>
        </div>
        <div class="modal-body">
          <div class="row">
  <form action="index.php" method="get" class="form-horizontal form-search">

    <div class="col-sm-6">
      <div class="control-group">
        <h4><?php echo __('Title'); ?></h4>
        <div class="controls">
          <input type="text" name="title" class="form-control" />
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="control-group">
        <h4><?php echo __('Author(s)'); ?></h4>
        <div class="controls">
          <input type="text" name="author" class="form-control" />
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-sm-6">
      <div class="control-group">
        <h4><?php echo __('Subject(s)'); ?></h4>
        <div class="controls">
          <input type="text" name="subject" class="form-control" />
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-sm-6">
      <div class="control-group">
        <h4><?php echo __('Collection Type'); ?></h4>
        <div class="controls">
          <select name="colltype" class="form-control"><?php echo $colltype_list; ?></select>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="control-group">
        <h4><?php echo __('Location'); ?></h4>
        <div class="controls">
          <select name="location" class="form-control"> <?php echo $location_list; ?></select>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-sm-6">
      <div class="control-group">
      <h4><?php echo __('GMD'); ?></h4>
      <div class="controls">
        <select name="gmd" class="form-control"><?php echo $gmd_list; ?></select>
      </div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-sm-6">
      <div class="control-group">
        <label></h4>
        <div class="controls">
          <input type="hidden" name="searchtype" value="advance" />
          <button type="submit" name="search" value="search" class="btn btn-primary"><?php echo __('Search'); ?></button>
        </div>
      </div>
    </div>

  </form>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div></div>
    
                </div><!--/.search-->

                <div class="widget ads">
                  <div class="tagline">
              <?php echo __('Information'); ?>
            </div>
            <div class="info">
              <?php echo $info; ?>
            </div>
            <div class="tagline">
              <?php echo __('Search Cluster'); ?>
            </div>
            <div class="info">
              <div id="search-cluster"><div class="cluster-loading"><?php echo __('Generating search cluster...');  ?></div></div>
              <script type="text/javascript">
              $('document').ready( function() {
                $.ajax({
                  url: 'index.php?p=clustering&q=<?php echo urlencode($criteria); ?>',
                  type: 'GET',
                  success: function(data, status, jqXHR) {
                    $('#search-cluster').html(data);
                  }
                });
              });
              </script>
            </div>
            </aside>          
            <div class="col-sm-8 col-sm-pull-4">
                <div class="row">
                    <div class="blog-item">
                          <div class="blog-content">
                                <div class="info">
                                  <?php echo $search_result_info; ?>
                                </div>
                            <?php } ?>
                            <?php if(isset($_GET['p'])) { ?>
                              <?php if($_GET['p'] == 'member') { ?>
                                <?php echo $main_content; ?>
                              <?php } else { ?>
                                <div class="page"><?php echo $main_content; ?></div>
                              <?php } ?>
                            <?php } else { ?>
                              <?php echo $main_content; ?>
                            <?php } ?>
                            <?php if(@$_GET['p'] != 'member') { ?>
                          </div>
                      <?php } elseif(utility::isMemberLogin()) { ?>
                    </div>
                </div>
				<?php } ?>
        <div id="preview-book" class="magnifier-preview" style=""></div>

        <!-- End Main Content -->

        <div class="row">
          
          <!--// If Member Logged //-->
          <?php if (utility::isMemberLogin()) { ?>
          <div class="sidebar">
            <div class="tagline">
              <?php echo __('Information'); ?>
            </div>
            <div class="info">
              <?php echo $header_info; ?>
            </div>
          </div>
          <?php } else { ?>
          
          <?php } ?>
          <!--// End Member Logged //-->
          <br/>

          <!--// Show if clustering search is enabled //-->
          <?php if(!isset($_GET['p'])) { ?>
          <?php if ($sysconf['enable_search_clustering']) { ?>
          
          <?php } ?>
          <!--// End Show if clustering search is enabled //-->
          <?php } ?>

        </div>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
            <?php
            // Footer
            include "partials/footer.php";
            ?>
      <?php } else { ?>
    
    <!--/#main-slider-->
    
    <?php
    include "partials/header.php";
    include "partials/banner.php";
    include "partials/simple-search.php";
    ?>
    <!--/#main-slider-->

    <!-- New and Promoted Book Start -->
    <section id="blog" class="container">
        <div class="row">
            <?php
            // Header
            include "slidebook.php";
            ?>
        </div>
    </section>
    <!-- New and Promoted Book End -->

    <!-- Section Start -->
    
    <!-- Section End -->
    
    <!-- Footer Start -->
    <?php
    // Footer
    include "partials/footer.php";
    ?>
    <!-- Footer End -->
      <?php } ?>
    </div>
  </div>
</div>  <!--// End Content Ouput //-->
<script src="<?php echo SWB; ?>template/yoga/js/jquery.js"></script>
<script src="<?php echo SWB; ?>template/yoga/js/bootstrap.min.js"></script>

<script src="<?php echo SWB; ?>template/yoga/js/main.js"></script>

<script type="text/javascript" src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme']; ?>/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="./js/highlight.js"></script>
<script type="text/javascript">
jQuery(function($){

$(document).ready(function()
{
  $('#keyword').keyup(function(){
    $('#title').val();
    $('#title').val($('#keyword').val());
  });

  $('#title').keyup(function(){
    $('#keyword').val();
    $('#keyword').val($('#title').val());
  });

  $('#advSearchForm input').attr('autocomplete','off');
  $('#title').attr('style','');

  $('#show_advance').click(function(){
    if ($("#advance-search").is(":hidden"))
    {
      $("#advance-search").slideDown('normal');
      $('#simply-search').slideUp('normal');
    } else {
      $("#advance-search").slideUp('normal');
      $('#simply-search').slideDown('normal');
    }
  });

  $('#title').keypress(function(e){
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
      this.form.submit();
    }
  });

  $(window).load(function () {
    $('#keyword').focus();
  });

  function mycarousel_initCallback(carousel)
  {
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
      carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
      carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
      carousel.stopAuto();
    }, function() {
      carousel.startAuto();
    });
  };

  jQuery('#topbook').jcarousel({
      auto: 5,
      wrap: 'last',
      initCallback: mycarousel_initCallback
  });

  jQuery('.container .item .detail-list, .coll-detail .title, .abstract, .coll-detail .controls').highlight(<?php echo $searched_words_js_array; ?>);

});
</script>


</body>
</html>