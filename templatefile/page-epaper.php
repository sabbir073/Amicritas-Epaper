<?php get_header(); ?>
<?php
$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
$path = $upload_dir . '/epaperimg/';
$baseurl = $upload['baseurl'];
$latest_ctime = 0;
$latest_filename = '';

$d = dir($path);
$condition  = true;
while (false !== ($entry = $d->read()) && $condition == true) :
$filepath = "{$path}/{$entry}"; 
if (is_dir($filepath) && filectime($filepath) > $latest_ctime) :
$latest_ctime = filectime($filepath);
$latest_filename = $entry;
$main_img = '1';
$urll = $baseurl.'/epaperimg/';
?>

 <div class="container" style="background: #ffffff;">
  <div class="row">
    <div class="col-sm-3" style="padding-left: 0px;">
      <div class="left-head">
        <h1>আজকের সকল পাতা</h1>
      </div>
      <div class="row" align="center">
        <div class="col-xs-6" style="padding-right: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/1.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=1"><h2>Page 1</h2></a>
          </div>
        </div>
        <div class="col-xs-6" style="padding-left: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/2.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=2"><h2>Page 2</h2></a>
          </div>
        </div>
      </div>
      <div class="row" align="center">
        <div class="col-xs-6" style="padding-right: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/3.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=3"><h2>Page 3</h2></a>
          </div>
        </div>
        <div class="col-xs-6" style="padding-left: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/4.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=4"><h2>Page 4</h2></a>
          </div>
        </div>
      </div>
      <div class="row" align="center">
        <div class="col-xs-6" style="padding-right: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/5.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=5"><h2>Page 5</h2></a>
          </div>
        </div>
        <div class="col-xs-6" style="padding-left: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/6.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=6"><h2>Page 6</h2></a>
          </div>
        </div>
      </div>
      <div class="row" align="center">
        <div class="col-xs-6" style="padding-right: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/7.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=7"><h2>Page 7</h2></a>
          </div>
        </div>
        <div class="col-xs-6" style="padding-left: 2px;">
          <div class="left-img">
          <img src="<?php echo $urll.$latest_filename.'/8.jpg'; ?>" class="img-responsive">
          <a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=8"><h2>Page 8</h2></a>
          </div>
        </div>
      </div>
     </div>
    <div id="fancyimgp" class="col-sm-6" style="margin-bottom: 10px;">
		<center>
				<ul class="pagination">
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=1">&larr; প্রথম পাতা</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=2">2</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=3">3</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=4">4</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=5">5</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=6">6</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=7">7</a></li>
					<li><a href="<?php bloginfo('url');?>/index.php?post_type=page&name=epaper&epaperpage=8">শেষ পাতা &rarr;</a></li>
				</ul>
		</center>
        <?php  if(isset($_GET['epaperpage'])) {
                $main_img = $_GET['epaperpage'];
            } 
            else {
            $main_img = '1';
            }?>

        <a href="<?php echo $urll.$latest_filename.'/'.$main_img.'.jpg'; ?>" data-fancybox="images">
            	<img class="center-img img-responsive" src="<?php echo $urll.$latest_filename.'/'.$main_img.'.jpg'; ?>" alt="Epaper" />
            </a>
         
		
      <!--<img src="<?php echo $todaydir.'/'.$main_img.'.jpg'; ?>" height="100%" width="100%" class="center-img img-responsive">-->
    </div>
    <div class="col-sm-3" style="padding-right: 0px;">
      <img src="http://test.amicritas.com/wp-content/uploads/2018/01/advertise.png">
    </div>
  </div>
 </div>
<?php $condition = false;?>
<?php endif; endwhile; ?>

<?php get_footer(); ?>