<?php
/**
 * Template for Login
 *
 * Copyright (C) 2015 Arie Nugraha (dicarve@gmail.com)
 * Create by Eddy Subratha (eddy.subratha@slims.web.id)
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

// be sure that this file not accessed directly
if (!defined('INDEX_AUTH')) {
    die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
    die("can not access this file directly");
}
?>
<!--
==========================================================================
   ___  __    ____  __  __  ___      __    _  _    __    ___  ____    __
  / __)(  )  (_  _)(  \/  )/ __)    /__\  ( )/ )  /__\  / __)(_  _)  /__\
  \__ \ )(__  _)(_  )    ( \__ \   /(__)\  )  (  /(__)\ \__ \ _)(_  /(__)\
  (___/(____)(____)(_/\/\_)(___/  (__)(__)(_)\_)(__)(__)(___/(____)(__)(__)

==========================================================================
-->
<!DOCTYPE html>
<html lang="<?php echo substr($sysconf['default_lang'], 0, 2); ?>" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
<head>
<?php
// Meta
// =============================================
include "partials/meta.php"; ?>
</head>

<body itemscope itemtype="http://schema.org/WebPage" id="login-page" style="background: whitesmoke;">
  <?php
// Meta
// =============================================
include "partials/header.php"; ?>

 <section id="title" class="myemerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1><?php echo __('Librarian LOGIN'); ?></h1>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.php"><?php echo __('Home'); ?></a></li>
                        <li><a href="index.php?p=help"><?php echo __('Help'); ?></a></li>
                        <li><a href="javascript: history.back();" ><i class="icon icon-white icon-circle-arrow-left"></i><?php echo __('Back'); ?> </a></li>

                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->  

  <!-- Login
  ============================================= -->
  
  <main id="content" class="s-main s-login" role="main">
    <div class="s-login-content animated flipInY delay9">
      <?php echo $main_content; ?>
    </div>
  </main>

  <?php
  // Footer
  // =============================================
  include "partials/footer.php"; ?>


  <script>
    $("form, input").attr({
      autocomplete    : "off",
      autocorrect     : "off",
      autocapitalize  : "off",
      spellcheck      : "off"
    });

    $('.homeButton').val('<?php echo __('Back To Home'); ?>');

    //If captcha available
    $('.captchaAdmin').parent().parent().attr('style','padding: 25px 20px;');
    $('.captchaAdmin').parent().parent().parent().attr('style','top: -40px;');

  </script>
</body>
</html>
