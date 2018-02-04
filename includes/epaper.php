<?php if(isset($_POST['paper_date'])){
	$date = $_POST['paper_name'];
	$ddate = get_option('amicritas');
	if($date != $ddate){
		paper_error();
	}
	else{
		if(!get_option('epaper_saved')){add_option('epaper_saved',$date,'','yes');}
		echo 'Saved successfully';
	}
}?>
<form action="" method="post">
	<div style="margin-top:50px;" class="row">
			<div class="col-sm-6">
				<div class="row">
					<lebel for="key" class="control-lebel col-sm-6"><b>Lisence Key:</b></lebel>
					<div class="col-sm-6">
						<input type="text" value="<?php echo get_option('epaper_saved');?>" name="paper_name" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<input type="submit" name="paper_date" value="submit" class="btn btn-primary">
			</div>
	</div>
</form>
<?php if($ddate != get_option('epaper_saved')) : ?>
<form action="" enctype="multipart/form-data" method="post">
	<div class="row" style="margin-top: 50px;">
		<div class="col-sm-6">
			<div class="row input-group">
				<label for="datepicker" class="control-label col-sm-6">Select E-paper date here<font color="red">*</font></label>
	    		<div class="col-sm-6">
	    			<input type="text" id="datepicker" name="datepicker" class="form-control">
	    		</div>
    		</div>
		</div>
		<div class="col-sm-6">
			<div class="row input-group">
	    		<label for='upload' class="control-label col-sm-6">Select E-paper image(s)<font color="red">*</font></label>
	    		<div class="col-sm-6" style="padding-left: 0px;">
	    			<input id='upload' type="file" name="upload[]" multiple="multiple">
	    		</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 50px;">
		<div class="col-sm-12">
			<input type="submit" name="submit" value="Create" class="btn btn-success">
		</div>
	</div>
</form>
<?php endif;?>
<?php
if(isset($_POST['submit'])){
	$date = $_POST['datepicker'];
	$upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/epaperimg/';
	if (!file_exists($upload_dir . $date)) {
    mkdir($upload_dir. $date, 0777, true);
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = $upload_dir . $date . '/' . $_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file
                    //show success message
    				echo "<h1>Uploaded</h1>";  

                }
              }
        }
    }
  }
  else{
  	echo 'Epaper of this date is already exist!';
  }  
}

function paper_error(){
	echo 'Your lisence key is not valid!';
}

?>