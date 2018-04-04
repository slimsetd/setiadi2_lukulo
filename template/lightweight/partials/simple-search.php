<div class="details">
  <div class="container">
  </br>
    <div class="widget search">
                    <form role="form" action="index.php" method="get" autocomplete="off">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="<?php echo __('Keyword'); ?>"  id="keyword" name="keywords" value="" lang="<?php echo $sysconf['default_lang']; ?>" aria-hidden="true" autocomplete="off">   
                            <span class="input-group-btn">
                                <button name="search" value="<?php echo __('Search'); ?>" class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><?php echo __('Advance Search'); ?></button>

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
      </div>
    </div>
  </div>


    <?php
    // Promoted titles - Only show at the homepage
    if(  !( isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p']) ) ) :
      // query top book
      $topbook = $dbs->query('SELECT biblio_id, title, image FROM biblio  ORDER BY input_date DESC LIMIT 30');
      if ($num_rows = $topbook->num_rows) :
    ?>
      <ul id="flexiselDemo4">
      <?php
            while ($book = $topbook->fetch_assoc()) :
              $title = explode(" ", $book['title']);
              if (!empty($book['image'])) : ?>
              <li class="book">
                <a itemprop="name" property="name" href="./index.php?p=show_detail&amp;id=<?php echo $book['biblio_id'] ?>" >
                  <img itemprop="image" width="60px" height="90px" src="images/docs/<?php echo $book['image'] ?>" title="<?php echo $book['title'] ?>" alt="<?php echo $book['title'] ?>" />
                </a>
              </li>
              <?php else: ?>
              <li class="book">
                <a itemprop="name" property="name" href="./index.php?p=show_detail&amp;id=<?php echo $book['biblio_id'] ?>" >
                  
                  <img itemprop="image" width="60px" height="90px" src="./template/default/img/book.png" title="<?php echo $book['title'] ?>" alt="<?php echo $book['title'] ?>" />
                </a>
              </li>
              <?php endif; endwhile; ?>                                                
      </ul>
    
    <?php endif; ?>
    <?php endif; ?>
</div> 
</div> 

