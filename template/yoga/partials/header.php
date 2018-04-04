<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="<?php echo SWB; ?>template/yoga/img/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="index.php?p=help"><?php echo __('Help on Search'); ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Collections'); ?><i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
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
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Login'); ?><i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?p=login"><?php echo __('Librarian LOGIN'); ?></a></li>
                            <li><a href="index.php?p=member"><?php echo __('Member Area'); ?></a></li>
                            <li><a href="index.php?p=visitor"><?php echo __('Visitor Counter'); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header><!--/header-->