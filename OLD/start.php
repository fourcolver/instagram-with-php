<?php require_once '../header.php'; ?> 

<style type="text/css">

.input-group .input-group-addon {
    color: #fff;
}

.main-footer {
    display: none;
}

.content-wrapper {
    padding-top: 0px !important;
}

:root label.checkbox-bootstrap input[type=checkbox] {
  /* hide original check box */
  opacity: 0;
  position: absolute;
  /* find the nearest span with checkbox-placeholder class and draw custom checkbox */
  /* draw checkmark before the span placeholder when original hidden input is checked */
  /* disabled checkbox style */
  /* disabled and checked checkbox style */
  /* when the checkbox is focused with tab key show dots arround */
}
:root label.checkbox-bootstrap input[type=checkbox] + span.checkbox-placeholder {
  width: 14px;
  height: 14px;
  border: 1px solid;
  border-radius: 3px;
  /*checkbox border color*/
  border-color: #737373;
  display: inline-block;
  cursor: pointer;
  margin: 0 7px 0 -20px;
  vertical-align: middle;
  text-align: center;
}
:root label.checkbox-bootstrap input[type=checkbox]:checked + span.checkbox-placeholder {
  background: #8ec657;
}
:root label.checkbox-bootstrap input[type=checkbox]:checked + span.checkbox-placeholder:before {
  display: inline-block;
  position: relative;
  vertical-align: text-top;
  width: 5px;
  height: 9px;
  /*checkmark arrow color*/
  border: solid white;
  border-width: 0 2px 2px 0;
  /*can be done with post css autoprefixer*/
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  content: "";
}
:root label.checkbox-bootstrap input[type=checkbox]:disabled + span.checkbox-placeholder {
  background: #ececec;
  border-color: #c3c2c2;
}
:root label.checkbox-bootstrap.checkbox-lg input[type=checkbox] + span.checkbox-placeholder {
  width: 26px;
  height: 26px;
  border: 2px solid;
  border-radius: 5px;
  /*checkbox border color*/
  border-color: #737373;
}
:root label.checkbox-bootstrap.checkbox-lg input[type=checkbox]:checked + span.checkbox-placeholder:before {
  width: 9px;
  height: 15px;
  /*checkmark arrow color*/
  border: solid white;
  border-width: 0 3px 3px 0;
}

.checkbox label, .radio label {
    font-size: 24px;
}

#autoUpdate4{
    display:none;
}

</style>

<script type="text/javascript" src="src/jquery-1.9.1.js"></script>
<link rel="stylesheet" type="text/css" href="src/result-light.css">
<script type="text/javascript">

    $(window).load(function(){
      
$(document).ready(function () {
	
	// STEP 1
    $('#checkbox1').change(function () {
        if (!this.checked) 
        //  ^
           $('#autoUpdate1').fadeIn('slow');
        else 
            $('#autoUpdate1').fadeOut('slow');
    });
	
	// STEP 2
    $('#checkbox2').change(function () {
        if (!this.checked) 
        //  ^
           $('#autoUpdate2').fadeIn('slow');
        else 
            $('#autoUpdate2').fadeOut('slow');
    });	
	
	// STEP 3
    $('#checkbox3').change(function () {
        if (!this.checked) 
        //  ^
           $('#autoUpdate3').fadeIn('slow');
        else 
            $('#autoUpdate3').fadeOut('slow');
    });	
	
	// STEP 4
    $('#checkbox4').change(function () {
      $('#autoUpdate4').fadeToggle();
    });
		
});

    });

</script>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
   
  <!-- Full Width Column -->
  <div class="content-wrapper">  
  
    <div style="width:100%" class="container">

      <!-- Main content -->
      <section class="content">
	  
<div class="row">

                <div class="box box-default">
			<div class="box-header with-border text-center">
				<h2><b>WhatsApp Bulk Sender</b></h2>
				<p>Before you start sending or scheduling bulk messages, there are 3 steps you need to take.</p>
			</div>
			<!-- /.box-header -->			
				
                    <div class="box-body">
					
                        <div class="col-md-6">
						<img width="100%" src="//suite.social/images/mockup/whatsapp.jpg" alt="WhatsApp">
                        </div>					

                        <div class="col-md-6">

<!------ STEP 1------>		

<h3 class="text-muted"><i>Have you...(tick box)</i></h3>				
	
 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox1">             
          <span class="checkbox-placeholder"></span>           
          <b>1.</b> Login into WhatsApp web?
      </label>
 </div>
 
<div id="autoUpdate1" class="autoUpdate1">
<p><a href="https://web.whatsapp.com/" target="_blank" class="btn btn-success btn-lg"><i class="fa fa-whatsapp"></i> LOGIN NOW!</a></p>
</div>	

<!------ STEP 2------>	

 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox2">             
          <span class="checkbox-placeholder"></span>           
          <b>2.</b> Installed imacros extension?
      </label>
 </div>
 
<div id="autoUpdate2" class="autoUpdate2">
<p><a href="https://chrome.google.com/webstore/detail/imacros-for-chrome/cplklnmnlbnpmjogncfgfijoopmnlemp?hl=en" target="_blank" class="btn btn-success btn-lg"><i class="fa fa-chrome"></i> INSTALL NOW!</a></p>
</div>	

<!------ STEP 3------>	

 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox3">             
          <span class="checkbox-placeholder"></span>           
          <b>3.</b> Converted numbers into WhatsApp format?
      </label>
 </div>
 
<div id="autoUpdate3" class="autoUpdate3">
<p><a href="#Cleaner" data-toggle="modal"  class="btn btn-success btn-lg"><i class="fa fa-users"></i> CONVERT NOW!</a></p>
</div>	

<!------ STEP 4------>	

 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox4">             
          <span class="checkbox-placeholder"></span>           
          <b>Yes, I have completed all steps</b>
      </label>
 </div>
 
<div id="autoUpdate4" class="autoUpdate4">
<p><a href="index.php" class="btn btn-success btn-lg"><i class="fa fa-send"></i> START SENDING!</a></p>
</div>	
					
                        </div>

                    </div>
                </div>
				
<div align="center" class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">

This tool is in no way affiliated with, authorized, maintained, sponsored or endorsed by WhatsApp, Imacros or any of its affiliates or subsidiaries.


                    </div>
                </div>
            </div>
						
        </div>
					
        </div>	  	
		
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<!--==================== CLEANER ==================== -->

<div class="modal fade" id="Cleaner">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><b>WhatsApp Contact Cleaner</b> <span class="text-muted">- Choose country and paste numbers to convert to proper WhatsApp format.</span></h4>
				</div>
				<div class="modal-body">

					<p><iframe src="cleaner.php" style="border: 0" width="100%" height="500px" scrolling="no" frameborder="0">Your browser does not support iFrame</iframe></p>			  			  

				</div>			  
				<div class="modal-footer">
					<button type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- /Cleaner Modal -->	
  
<!-- =================FOOTER====================== -->

<?php require_once '../footer-home.php'; ?> 
