<?php
            // Header
            include "partials/header.php";
            ?>
<?php
$_GET['id'] = (integer) htmlspecialchars($_GET['id']);
#$_GET['id'] = (integer) $_GET['id'];
// biblio/record detail
// output the buffer
ob_start(); /* <- DONT REMOVE THIS COMMAND */
?>
<style>
   .drift-detail {
        position: fixed;
        width: 40%;
        height: 60%;
        left:25%;
        bottom:20%;        
      }
</style>
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
                      <div class="span2">
      <div class="cover">
      {image}
      </div>
      <div class="drift-detail">&nbsp</div>
      <br/>
    <a target="_blank" href="index.php?p=show_detail&inXML=true&id=<?php echo $_GET['id'];?>" class="btn btn-mini btn-danger">XML</a>
  </div>
            </aside>        
            <div class="col-sm-8 col-sm-pull-4">
                <div class="blog">
                    <div class="blog-item">

                        <img class="img-responsive img-blog" src="<?php echo $sysconf['template']['dir']; ?>/yoga/img/blog/blog2.jpg" width="100%" alt="" />
                        <div class="blog-content">
                            <h3>{title}</h3>
                            <div class="entry-meta">
                                <span><i class="icon-user"></i> <a>{authors}</a></span>
                                <span><i class="icon-book"></i> <a href="#">{gmd_name}</a></span>
                                <span><i class="icon-flag"></i> {language_name}</span>
                                <span><i class="icon-location-arrow"></i> <a href="blog-item.html#comments">{publish_year}</a></span>
                                <span><i class="icon-map-marker"></i> <a href="blog-item.html#comments">{publish_place} : {publisher_name}</a></span>
                <table>
                <tr>
                <td><?php print __('File Attachment'); ?></td>
                <td>{file_att}</td>
                </tr>
                </table>
                            </div>
                            <div>{social_shares}</div>
                            <span>
                            <hr/>
                            <p>{notes}</p>
                            <hr/>
                            </span>
                                  <div class="control-group">
                                    <label class="control-label key"><?php print __('Availability'); ?></label>
                                    <div class="controls">{availability}</div>
                                  </div>
                            <hr>
  <h3><i class="fa fa-circle-o"></i> <?php echo __('Detail Information'); ?></h3>
  <div class="row">
      <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Bagian</th>
                <th>Informasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php print __('Statement of Responsibility'); ?></td>
                <td>{sor}</td>
              </tr>
              <tr>
                <td><?php print __('Author(s)'); ?></td>
                <td>{authors}</td>
              </tr>
              <tr>
                <td><?php print __('Edition'); ?></td>
                <td>{edition}</td>
              </tr>
              <tr>
                <td><?php print __('Call Number'); ?></td>
                <td>{call_number}</td>
              </tr>
              
              <tr>
                <td><?php print __('Subject(s)'); ?></td>
                <td>{subjects}</td>
              </tr>
              <tr>
                <td><?php print __('Classification'); ?></td>
                <td>{classification}</td>
              </tr>
              <tr>
                <td><?php print __('Series Title'); ?></td>
                <td>{series_title}</td>
              </tr>
              <tr>
                <td><?php print __('GMD'); ?></td>
                <td>{gmd_name}</td>
              </tr>
              <tr>
                <td><?php print __('Language'); ?></td>
                <td>{language_name}</td>
              </tr>
              <tr>
                <td><?php print __('Publisher'); ?></td>
                <td>{publisher_name}</td>
              </tr>
              <tr>
                <td><?php print __('Publishing Year'); ?></td>
                <td>{publish_year}</td>
              </tr>
              <tr>
                <td><?php print __('Publishing Place'); ?></td>
                <td>{publish_place}</td>
              </tr>
              <tr>
                <td><?php print __('Collation'); ?></td>
                <td>{collation}</td>
              </tr>
              <tr>
                <td><?php print __('Specific Detail Info'); ?></td>
                <td>{spec_detail_info}</td>
              </tr>
              
            </tbody>
        </table>
      </div>
  </div>
    <hr/>
        <div class="tags">
            <span>&nbsp</span><i class="icon-tags"></i> Tags : </br>
            <a>{subjects} </a> 
        </div>
        <hr/>
        <div class="span11" style="row"> 
  <h3><i class="fa fa-circle-o"></i> <?php echo __('Citation'); ?></h3>
  <div class="col-lg-12">{authors_single}. ({publish_year}).<i>{title}</i>.(Electronic Thesis or Dissertation). Retrieved from https://localhost/etd</div>

</div>
        <p>&nbsp;</p>
        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
  <div class="clearfix"></div>
  <?php echo showComment($detail_id); ?>


    <!-- Footer Start -->
    
    <!-- Footer End -->

<?php
// put the buffer to template var
$detail_template = ob_get_clean();
