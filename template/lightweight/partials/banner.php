  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<?php

// image slideshow
$img_1 = '1.jpg';
$img_2 = '2.jpg';
$img_3 = '3.jpg';
$img_4 = '4.jpg';

// tooltip image slideshow
//query content 1
//query content 2
$query_content = $dbs->query("SELECT content_title,content_desc,content_path FROM content ORDER BY content.input_date DESC LIMIT 0,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 150){
    $contDesc = substr($contDesc, 0, 150);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_1 = '<h1><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h1><p>'.$contDesc.'</p>';
}else{
    $tooltip_1 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 2
$query_content = $dbs->query("SELECT content_title,content_desc,content_path FROM content ORDER BY content.input_date DESC LIMIT 1,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 150){
    $contDesc = substr($contDesc, 0, 150);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_2 = '<h1><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h1><p>'.$contDesc.'</p>';
}else{
    $tooltip_2 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 3
$query_content = $dbs->query("SELECT content_title,content_desc,content_path FROM content ORDER BY content.input_date DESC LIMIT 2,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 150){
    $contDesc = substr($contDesc, 0, 150);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_3 = '<h1><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h1><p>'.$contDesc.'</p>';
}else{
    $tooltip_3 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 4
$query_content = $dbs->query("SELECT content_title,content_desc,content_path FROM content ORDER BY content.input_date DESC LIMIT 3,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 150){
    $contDesc = substr($contDesc, 0, 150);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_4 = '<h1><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h1><p>'.$contDesc.'</p>';
}else{
    $tooltip_4 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}


?>
</div>
<div class="jquery-script-clear"></div>
</div>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active"> <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/slider/bg1.jpg" style="width:100%" alt="First slide">
      <div class="container">
        <div class="carousel-caption">
          <?php echo $tooltip_1; ?>
        </div>
      </div>
    </div>
    <div class="item"> <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/slider/bg2.jpg" style="width:100%" data-src="" alt="Second    slide">
      <div class="container">
        <div class="carousel-caption">
          <?php echo $tooltip_2; ?>
        </div>
      </div>
    </div>
    <div class="item"> <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/slider/bg3.jpg" style="width:100%" data-src="" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <?php echo $tooltip_3; ?>
        </div>
      </div>
    </div>
    <div class="item"> <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/slider/bg4.jpg" style="width:100%" data-src="" alt="Fourth slide">
      <div class="container">
        <div class="carousel-caption">
        <?php echo $tooltip_4; ?>
          <!-- <h1>Slide 4</h1>
          <p>Donec sit amet mi imperdiet mauris viverra accumsan ut at libero.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p> -->
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</a> </div>

