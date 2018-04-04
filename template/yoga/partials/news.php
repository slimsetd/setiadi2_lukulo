<?php

// image slideshow
$img_1 = '1.jpg';
$img_2 = '2.jpg';
$img_3 = '3.jpg';
$img_4 = '4.jpg';

// tooltip image slideshow
//query content 1
//query content 2
$query_content = $dbs->query("SELECT content_title,content_desc,content_path, last_update FROM content ORDER BY content.input_date DESC LIMIT 0,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 250){
    $contDesc = substr($contDesc, 0, 250);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'"><i>Read more.</i></a>';
    $tooltip_1 = '<h4><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h4><h5><small>'.$_content[3].'</small></h5><p>'.$contDesc.'</p>';
}else{
    $tooltip_1 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 2
$query_content = $dbs->query("SELECT content_title,content_desc,content_path, last_update FROM content ORDER BY content.input_date DESC LIMIT 1,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 250){
    $contDesc = substr($contDesc, 0, 250);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_2 = '<h4><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h4><h5><small>'.$_content[3].'</small></h5><p>'.$contDesc.'</p>';
}else{
    $tooltip_2 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 3
$query_content = $dbs->query("SELECT content_title,content_desc,content_path, last_update FROM content ORDER BY content.input_date DESC LIMIT 2,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 250){
    $contDesc = substr($contDesc, 0, 250);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_3 = '<h4><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h4><h5><small>'.$_content[3].'</small></h5><p>'.$contDesc.'</p>';
}else{
    $tooltip_3 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

//query content 4
$query_content = $dbs->query("SELECT content_title,content_desc,content_path, last_update FROM content ORDER BY content.input_date DESC LIMIT 3,1");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 250){
    $contDesc = substr($contDesc, 0, 250);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'">Read more.</a>';
    $tooltip_4 = '<h4><a href="index.php?p='.$_content[2].'">'.$_content[0].'</a></h4><h5><small>'.$_content[3].'</small></h5><p>'.$contDesc.'</p>';
}else{
    $tooltip_4 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}


?>
<section id="privacy-policy" class="container">
            <div class="row">
                <div id="meet-the-team" class="row">
            <div class="col-md-3 col-xs-6">
                <div class="center">
                   <p><img class="img-responsive img-thumbnail img-box" src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/berita1.jpg" alt=""></p>
                   <?php echo $tooltip_1; ?> 
                </div>
            </div>

            <div class="col-md-3 col-xs-6">
                <div class="center">
                <p><img class="img-responsive img-thumbnail img-box" src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/berita2.jpg" alt=""></p>
                <?php echo $tooltip_2; ?> 
                </div>
            </div>        
            <div class="col-md-3 col-xs-6">
                <div class="center">
                    <p><img class="img-responsive img-thumbnail img-box" src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/berita3.jpg" alt=""></p>
                    <?php echo $tooltip_3; ?> 
                </div>
            </div>        
            <div class="col-md-3 col-xs-6">
                <div class="center">
                <p><img class="img-responsive img-thumbnail img-box" src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/berita4.jpg" alt=""></p>
                    <?php echo $tooltip_4; ?> 
                </div>
            </div>
        </div>
            </div>
    </section> 