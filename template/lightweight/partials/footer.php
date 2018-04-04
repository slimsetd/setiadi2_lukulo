<?php
// tooltip image slideshow
//query content 1
//query content 2
$query_content = $dbs->query("SELECT content_title,content_desc,content_path, last_update FROM content WHERE content_path='headerinfo'");
$_content = $query_content->fetch_row();
$contDesc = $_content[1];
if (strlen($contDesc) > 250){
    $contDesc = substr($contDesc, 0, 250);
    while (substr($contDesc, -1)!=' ') $contDesc = substr($contDesc, 0, -1);
    $contDesc = trim($contDesc).' ... <a href="index.php?p='.$_content[2].'"><i>Read more.</i></a>';
    $tooltip_1 = '<p>'.$contDesc.'</p>';
}else{
    $tooltip_1 = '<h4>'.$_content[0].'</h4><p>'.$_content[1].'</p>';
}

?>

<section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <?php echo $tooltip_1; ?> 
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4><?php echo __('Collections'); ?></h4>
                    <div>
                        <ul class="arrow">
                            <?php
                              // query librarian data

                              $coll_q = $dbs->query('
                              SELECT mc.coll_type_name, COUNT(b.biblio_id) AS hasil FROM mst_coll_type AS mc
                              LEFT JOIN item AS i ON mc.coll_type_id= i.coll_type_id
                              LEFT JOIN biblio AS b ON i.biblio_id= b.biblio_id
                              GROUP BY mc.coll_type_name ASC');
                              if ($coll_q->num_rows > 0) {
                                while ($colltype = $coll_q->fetch_assoc()) {
                                  $aut = $colltype['coll_type_name'];
                                  $r_aut = str_replace(',',' ',$aut);
                                  
                                  $value = 3;
                                  $last_name = implode(" ", array_slice(explode(" ", $r_aut),0,$value));
                                  
                                echo '<li><a href="index.php?title=&author=&subject=&isbn=&colltype='.$last_name.'&location=0&gmd=0&searchtype=advance&search=search"> <i class="ti ti-bookmark">'.$last_name.'&nbsp&nbsp<span class="badge">'.$colltype['hasil'].'</span></a></i>';

                               }
                              } else {
                                echo '<p>No Librarian data yet</p>';
                                echo '</div>';
                              }
                              ?>

                        </ul>
                        <?php
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                                $startpoint = ($page - 1)*10;
                                // $startpoint = $page + 9;
                                // echo $page;
                                $cihuy = $dbs->query('SELECT b.biblio_id, b.title, ma.author_name 
                                FROM biblio AS b 
                                LEFT JOIN biblio_author AS ba ON b.biblio_id=ba.biblio_id
                                LEFT JOIN mst_author AS ma ON ba.author_id=ma.author_id ORDER by b.last_update DESC LIMIT '.$startpoint.',10');
                                $rowc = $dbs->query('SELECT COUNT(biblio_id) AS row FROM biblio');
                                $iuh = $rowc->fetch_row();
                                $aa = floor($iuh['0']/10)+1;
                                $rowcount = 0;
                            ?>
                        </br>
                            <small><a href="index.php?keywords=&search=Pencarian">Total ETDs : <?php echo $iuh['0'];?></a></small>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Media Sosial / Kanal</h4>
                    <div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/fb.png" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="https://www.facebook.com/groups/senayan.slims">Facebook</a></span>
                                <small class="muted"><?php echo $sysconf['library_name']; ?> Official</small>
                            </div>
                        </div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/yt.png" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="https://www.youtube.com/channel/UCMR2hQDqDZmoVbE7i4dEjTA">Youtube</a></span>
                                <small class="muted"><?php echo $sysconf['library_name']; ?> Official</small>
                            </div>
                        </div>
                        <div class="media">
                            <div class="pull-left">
                                <img src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/is.png" alt="">
                            </div>
                            <div class="media-body">
                                <span class="media-heading"><a href="https://www.instagram.com/erwansetyobudi/">Instagram</a></span>
                                <small class="muted"><?php echo $sysconf['library_name']; ?> Official</small>
                            </div>
                        </div>
                    </div>  
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <h4>Address</h4>
                    <address>
                        <strong>Developer SETIADI Basecamp</strong><br>
                        Kp Kebon Kopi Kav 37 Rt 8 Rw 4<br>
                        Kelurahan Pondok Betung, Kecamatan Pondok Aren, Kota Tangerang Selatan<br>
                        <abbr title="Email">E:</abbr> admin@slimsetd.id
                    </address>
                </div> <!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Please Don't Remove This ! -->
                    Powered By <a target="_blank" href="http://slimsetd.id/" title="Senayan Sistem Elektronik Tesis dan Disertasi">SETIADI</a> and <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="index.php">Home</a></li>
                       
                        <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->