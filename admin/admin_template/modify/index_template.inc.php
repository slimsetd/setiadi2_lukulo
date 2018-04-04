<?php
/**
 * Template for Backend
 *
 * Copyright (C) 2015 Arie Nugraha (dicarve@gmail.com), Eddy Subratha (eddy.subratha@slims.web.id)
 * 
 * Slims 8 (Akasia)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Need to modified script to adaptive new theme
include 'modify_function.php';

// Reload Dashboard 
if (isset($_GET['dashboard'])) {
  include 'modify_dashboard.php';
  exit();
}

if (isset($_GET['about'])) {
  echo 'hai';
  exit();
}
?>
<!-- =====================================================================
 ___  __    ____  __  __  ___      __    _  _    __    ___  ____    __
/ __)(  )  (_  _)(  \/  )/ __)    /__\  ( )/ )  /__\  / __)(_  _)  /__\
\__ \ )(__  _)(_  )    ( \__ \   /(__)\  )  (  /(__)\ \__ \ _)(_  /(__)\
(___/(____)(____)(_/\/\_)(___/  (__)(__)(_)\_)(__)(__)(___/(____)(__)(__)
            
                          with Modify Template
                                  v 2.0

========================================================================== -->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
  <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />

  <link rel="icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
  <link href="<?php echo SWB; ?>template/core.style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>colorbox/colorbox.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>chosen/chosen.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo JWB; ?>jquery.imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo AWB; ?>admin_template/<?php echo $sysconf['admin_template']['theme']?>/assets/css/modify.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $sysconf['admin_template']['css']; ?>" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>updater.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>gui.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>form.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>calendar.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>keyboard.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>chosen/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>chosen/ajax-chosen.min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>tooltipsy.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>webcam.js"></script>
  <script type="text/javascript" src="<?php echo JWB; ?>scanner.js"></script>
  <script type="text/javascript" src="<?php echo AWB; ?>admin_template/<?php echo $sysconf['admin_template']['theme']?>/assets/vendor/slimscroll/jquery.slimscroll.min.js"></script>
  <?php if($sysconf['chat_system']['enabled']) : ?>
  <script src="<?php echo JWB; ?>fancywebsocket.js"></script>
  <?php endif; ?>
  <style type="text/css">
    .per_title h2:before {
        content: none !important;
    }
    .per_title h2 { 
      color: white;
    }
    .per_title {
      color: white; background: #3c8dbc !important;border: none;
    }

    .s-help-content {
          background-color: #222d32 !important;
          color: white;
    }

    .s-help-header {
        padding: 15px 20px;
        font-size: 16px;
        border: none !important;
        background: #367fa9;
        color: white;
    }

    .btn {
        font-family: 'Roboto' !important;
        font-weight: bold;
    }

    .alert {
       padding: 13px !important;
    }

    .alert-danger {
      background-color: #dd4b39 !important;
      color: white;
      width: 98%;
      margin-left: 8px;
      margin-top: 10px;
    }

    .alert h5 {
      padding: 0px;
      margin: 0px;
      font-size: 15pt;
      padding-bottom: 10px;
    }

    .alert span {
      display: block;
    }
    
    .alert h5::before {
        font-family: FontAwesome;
        content:"\f071";
        padding-right: 5px;
    }

    .s-menu i, .s-submenu i {
      color: #b8c7ce;;
    }
    
    .errorBox, .message {
          position: relative;
          background-color: #D9534F;
          color: #fff;
          padding: 15px;
          /*margin: px 10px;*/
          margin-top: 54px;
      }

      #doSearch {
        color: #fff ;
        background-color: #00c0ef !important;
        border-color: #00acd6 !important;
        font-weight: bolder !important;
      }

      input[type="text"], select {
        width: 250px;
      }

      .col-lg-3 {
        width: 24%; 
      }

      .panel-body {
       padding: 0px !important; 
      }

      .row {
          margin-right: -15px;
          margin-left: 16px;
      }

      .s-widget-icon {
          width: 66px;
          float: left;
          margin: 0;
          padding-left: 0px; 
          padding-right: 0px; 
          margin-right: 20px;
          color: #eee;
          font-size: 50px;
          
          text-align: center;
      }

      .biblio {
        background-color: #00c0ef !important;
      }

      .item {
        background-color: #dd4b39 !important;
      }

      .lent {
        background-color: #00a65a !important;
      }

      .avail {
        background-color: #f39c12 !important;
      }
      .s-content {
        background-color: #ecf0f5;
      }

      .col-lg-4 .panel, .col-lg-4 .panel-heading {
          background-color: #fff;
          margin-right: 45px;
      }

      .s-dashboard {
        min-height: 423px;
      }
  </style>
</head>

<body>
  <aside class="s-sidebar">
    <nav class="s-menu" role="navigation">
        <div style="float: left; dipslay: block;">
          <a href="<?php echo MWB.'system/app_user.php?changecurrent=true&action=detail'; ?>" class="s-user-photo">
            <img style="display: inline-block;" src="<?php echo '../lib/minigalnano/createthumb.php?filename=../../'.IMG.'/persons/'.urlencode(urlencode($_SESSION['upict'])).'&width=200'?>" alt="Photo <?php echo $_SESSION['realname']?>">
          </a>
        </div>
        <div style="float: left; display: block; margin-left: 10px;">
          <p style="color: white; padding-top: 10px; font-weight: 600px; font-size: 14pt;"><?php echo ucfirst($_SESSION['uname']);?><br><small style="color: white; font-size: 10pt;"><?php echo $sysconf['system_user_type'][getUType($_SESSION['uid'])];?></small></p>
          <!-- <small style="color: white;"><?php echo $sysconf['system_user_type'][getUType($_SESSION['uid'])];?></small> -->
        </div>
      <div id="mainMenu"><?php modify_menu(); ?>
      </div>
    </nav>
  </aside>
  <main class="s-content" role="main">
    <a href="#" name="top" class="s-help" style="color: white; background: #3c8dbc !important;border: none;"><i class="fa fa-question-circle"></i></a>
    <div id="main">
      <div class="left">
        <div class="s-help-header"><?php echo __('Help'); ?></div>
        <div class="s-help-content">
          <!-- Place to put documentation -->
        </div>
      </div>
      <div class="right">
        <div id="mainContent">
          <?php
            if(isset($_GET['mod']) && ($_GET['mod'] == 'system')) {
              include "modules/system/index.php";
              echo "<script>$('#mainForm').attr('action','".AWB."modules/system/index.php');</script>";
            } else {
              include 'modify_dashboard.php';
            }
          ?>
          </div>
        </div>
    </div>
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <div style="display: block; width: 100%;margin-right: auto; margin-left: auto;">
          <i style="display: block; margin-left: auto; margin-right: auto; text-align: center; font-size: 100px; color: #333;" class="fa fa-question"></i>
        </div>
        <div style="display: block;width: 100%;margin-right: auto;margin-left: auto;margin-top: 10px;font-size: 20pt;text-align: center;">
          <strong>Apakah anda yakin ingin keluar?</strong>
        </div>
        <div class="btn-group" style="display: block;margin-top: 20px;margin-left: auto;margin-right: auto;text-align:  center;">
          <button class="log_out btn btn-default btn-danger btn-delete" href="logout.php"><i style="color: white;" class="fa fa-sign-out"></i>&nbsp;Keluar</a>
          <button class="btn btn-warning cls" style="margin-left: 10px; color: #343a40!important;"><i style="#343a40!important;" class="fa fa-times"></i>&nbsp;Batal</a>
        </div>
      </div>
    </div>
    <footer class="s-footer">
      <div class="s-footer-about"><a href="http://www.slims.web.id/" target="_blank"><?php echo SENAYAN_VERSION; ?></a></div>
      <div class="s-footer-brand"><?php echo $sysconf['library_name'].' - '.$sysconf['library_subname']?> </div>
    </footer>
  </main>

  <!-- fake submit iframe for search form, DONT REMOVE THIS! -->
  <iframe name="blindSubmit" style="visibility: hidden; width: 0; height: 0;"></iframe>
  <!-- fake submit iframe -->
  <script>
    //
    // Action for dashboard
    $('ul.main_menu label.dashboard').click(function(){
        // var href = $(this).attr('href');
        // $("#mainContent").load(href);
        window.location = 'index.php';
    });

    // Action for logout
    $('.log_out').click(function(){
        var href = $(this).attr('href');
        window.location = href;
    });

    // Make A collapse
    $('ul.main_menu label.click').click(function(){
        var tab_id = $(this).attr('data-id');
        var status = $(this).attr('status');
        if (status == 0) {
          $('ul.main_menu label').attr('status', 0);
          $('ul.main_menu label').removeAttr('style');
          $(this).attr('status', 1);
          $(this).attr('style', 'background: #105E7C; border-left: 3px solid #007bff;');
          $('ul.sub_menu').slideUp();
          $("#sb"+tab_id).slideDown();
        } else {
          $(this).removeAttr('style');
          $(this).attr('status', 0);
          $('ul.sub_menu').slideUp();
        }
      });

    var toggleMainMenu = function() {
      $('.per_title').bind('click',function(){
        $('.s-content').toggleClass('active');
        $('.s-sidebar').toggleClass('active');
        $('.s-user-frame').toggleClass('active');
        $('.s-menu').toggleClass('active');
      });
    }

    //trigger to hide the current sidebar
    $('.s-current-child').click(function(){
      $('.s-current').trigger('click');
    });

    //create a help anchor by current menu
    $('.s-current-child').click(function(){
      $('.left, .right, .loader').removeClass('active');
      $('.s-help > i').removeClass('fa-times').addClass('fa-question-circle');
      $('.s-help-content').html();
      $('.s-help').removeClass('active');
      var get_url       = $(this).attr('href');
      var path_array    = get_url.split('/');
      var clean_path    = path_array[path_array.length-1].split('.');
      var new_pathname  = '<?php echo AWB?>help.php?url='+path_array[path_array.length-2]+'/'+clean_path[0]+'.md';
      $('.s-help').attr('href', new_pathname);
    });

    //generate help file
    $('.s-help').click(function(e){
      e.preventDefault();
      if($(this).attr('href') != '#') {
        // load active style
        $('.left, .right, .loader').toggleClass('active');
        $(this).toggleClass('active');
        $.ajax({
          type: 'GET',
          url: $(this).attr('href')
        }).done(function( data ) {
          $('.s-help-content').html(data);
          $('.s-help > i').toggleClass('fa-question-circle fa-times');
        });
      }else{
        alert('Help content will show according to available menu.')
      }
    });

    $('.s-menu img').bind('click', function(e) {
      e.preventDefault();
      $('a.u-profil').trigger('click');
    });

    // toggle main menu event register
    // toggleMainMenu();
    // $('body').on('simbioAJAXloaded', function(evt) {
    //   toggleMainMenu();
    // })

    // Opac
    $('ul.main_menu label.opac').bind('click', function(evt) {
    	evt.preventDefault();
    	top.jQuery.colorbox({iframe:true,
    	  href: $(this).attr('href'),
          width: function() { return parseInt($(window).width())-50; },
          height: function() { return parseInt($(window).height())-50; },
          title: function() { return 'Online Public Access Catalog'; } }
        );
    });

    // About
    $('ul.main_menu label.about').bind('click', function(evt) {
      evt.preventDefault();
      top.jQuery.colorbox({iframe:true,
        href: $(this).attr('href'),
          width: function() { return parseInt($(window).width())-600; },
          height: function() { return parseInt($(window).height())-50; },
          title: function() { return 'About Modify Template'; } }
        );
    });

    // Modal logout
    // Get the modal
    var modal = $("#myModal");
    // Get the button that opens the modal
    var btn = $(".logout");
    // Get the <span> element that closes the modal
    var span = $(".cls");

    // When the user clicks the button, open the modal 
    btn.click(function() {
        modal.attr("style", "display: block");
    });

    // When the user clicks on <span> (x), close the modal
    span.click(function() {
        modal.attr("style", 'display:none;');
    });


    // hide menu if click on main content
    $('.s-content').click(function(){
      $('#mainMenu input[type=radio]').each(function(){
        $(this).removeAttr('checked');
      });
    })
  </script>
  <?php include "chat.php" ?>
</body>
</html>