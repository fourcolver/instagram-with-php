<?php
require_once 'header_posts.php';
require 'functions.php';
?>

<body>
<div id="load"></div>

<div class="jumbotron jumbotron-billboard">
    <div class="img"></div>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <h1>Companions Directory</h1>
                <p>The Best Worldwide Companions Link Directory.</p>
                <!--<a href="https://tiny.cc/escorts"><img width="200px" src="//suite.social/images/btn/app_chrome.png"></a>-->
                <a href="#submit" data-toggle="collapse" class="btn btn-success btn-lg">Submit Link</a>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
   
  <!-- Full Width Column -->
  <div class="content-wrapper">  
  
    <div style="width:100%" class="container">

      <!-- Main content -->
      <section class="content">
	
<div class="col-md-12">	
<div class="row">

<!------------------------------ FORM ------------------------------>

<form method="POST" action="" class="form" onsubmit="return false;">
	<input class="approve" type="hidden" value="0">
	<div class="row">
		<div class="col-md-9">
			<div class="form-group">
				<h3>Choose Category</h3>
				<select class="form-control input-lg js-example-basic-single" id="selectOFCategories" style="width:100%;" onChange="getTableContents()"></select>
			</div>
			<!--<a href="#Category" data-toggle="modal" class="btn btn-success">Create</a>
			<button class="btn btn-primary" id="filterLinksButton" onclick="filterLinks()" type="button">Filter</button>
			<button class="btn btn-primary" id="showLinksButton" onclick="showLinks()" type="button">Show All</button>
			<button class="btn btn-danger" id="deleteCategoryButton" onclick="deleteCategory()" type="button">Delete</button>-->

		</div>
		<div class="col-md-3">
			<h3>More bookings? Get Listed!</h3>
			<p><a href="#submit" data-toggle="collapse" class="btn btn-success btn-lg btn-block"><i class="fa fa-link"></i> Submit Link Now</a></p>
		</div>

		<div class="col-md-12">

			<div id="submit" class="collapse">

				<br>
				<div class="alert alert-danger fade in alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>PLEASE NOTE!</strong> Before you submit, make sure you choose a category above (besides all).
				</div>

				<h3>1. Enter your URL (website or profile)</h3>
				<div class="form-group">
					<!--<textarea required name="links" class="form-control input-lg" id="links" rows="3"></textarea>-->
					<input required name="links" class="form-control input-lg"
						   placeholder="Enter valid URL" type="text" id="links"/>
					<br>
					<h3>2. Choose contact method </h3>
					<script type="text/javascript">
						function CheckColors(val) {
							var element = document.getElementById(val);
							var s = "";
							for (var i = 0; i < 1; i++) {
								if (val == 'addLinksButton') {

								} else {
									s += '<br><input class="contact form-control input-lg" type="text" placeholder="Enter ' + val + '"  name=' + val + '>'; //Create one textbox as HTML
								}
							}
							document.getElementById("screens").innerHTML = s;
						}
					</script>
					<select id="type" class="form-control input-lg" name="color" onchange='CheckColors(this.value);'>
						<option value="addLinksButton">Choose contact method</option>
						<option value="WhatsApp">WhatsApp</option>
						<option value="Phone">Phone</option>
						<option value="Messenger">Messenger</option>
						<option value="Skype">Skype</option>
						<option value="Email">Email</option>
					</select>
					<h4><b>WhatsApp</b> - Enter number without + <span class="text-muted">/</span> <b>Messenger</b> - Enter facebook username only <span class="text-muted">/</span> <b>Skype</b> - Enter username only</h4>
					<div id="screens"></div>
					<br/>
					<p><button class="btn btn-success btn-lg" id="addLinksButtonuser" onclick="addLinks(this)">Submit Now</button></p>
					<div class="progress" style="margin-bottom: 5px; background-color: transparent;">
						<div class="progress-bar progress-bar-success" role="progressbar" style="width: 0%; display: none;">
							<span class="progress-text"></span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<h3 style="text-align:center" id="waiting-img" class="waiting" hidden>The screenshot is refreshing. Please wait.</h3>

	<!--div class="row" style="margin-bottom: 10px; margin-left: 8px;">
		<div class="col-md-12">
			<label style="margin-right: 10px;" >
				<input type="checkbox" class="multi-link-delete" onclick="selectMultiLinksForDelete(this)" />
			</label>
			<button class="btn btn-danger" id="deleteLinksButton" onclick="deleteLinks(this)" type="button">Delete Link</button>
			<label class="delete-loader" style="visibility: hidden"><img src="images/loader.gif" width="20" height="20"></label>
		</div>
	</div-->
	
	<?php
	$currentData = file_get_contents('message.json');
	$messageData = json_decode($currentData, true);

	$msgDspl = "";
	if(!empty($messageData)) {
		foreach ($messageData as $msgData) {
			if ($msgData['IP'] == $_SERVER['REMOTE_ADDR']) {
				$msgDspl = "Your listing is pending. Admin will approve it soon!";
			}
		}
	}
	?>

	<div id="messageDiv">
		<?php if ($msgDspl) { ?>
			<div class="alert alert-danger fade in alert-dismissable" id="flash-msg">
				<!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
				<strong>Success!</strong> <?= $msgDspl ?>
			</div>
		<?php } ?>
	</div>
	<div id='alert_message'></div>
	<div class="row">
		<div class="col-md-12">
			<div class="contentDataTable" id="tbodyOfLinks" data-value="frontEnd">
			</div>
		</div>
	</div>
</form>

<!------------------------------ /FORM ------------------------------>
					
        </div>	
	</div>		
		
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
 <!-- Category Modal -->
<div class="modal fade" id="Category">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Enter Categories (single lines)</h3>
			</div>
			<div align="center" class="modal-body">
			<textarea name="categories" class="form-control input-lg" rows="3"
					  id="saveCategoriesTextarea"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success pull-right" data-dismiss="modal"
						id="saveCategoriesButton"
						onclick="saveCategories()">
					Save
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- Share Modal -->
<div class="modal fade" id="ShareModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
						aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h3 style="color:#fff">Share the URL on social media</h3>
			</div>
			<div align="center" class="modal-body">

				<!--******************** SHARE BUTTONS ********************--->

				<div class="row" id="shareModalContent">

				</div>

			</div>
			<!--<div class="modal-footer">
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>-->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  
<!-- =================FOOTER====================== -->

<?php
require_once 'alert.php';
include 'footer_posts.php';
?>