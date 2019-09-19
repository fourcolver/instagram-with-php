<?php
error_reporting(0);
session_start();
require_once('session.php');
require_once 'header-admin.php';
?>

<script>
    if (document.readyState == 'loading') {
        var script = document.createElement('script');
        script.onload = function () {
        };
        document.head.appendChild(script);
    }
</script>

<?php
$file = getSession();
if ($file != '0') {
    $filename = $file;
} else {
    $filename = "results";
}
if (file_exists('data/' . $filename . '.json')) {
    $jsonString = file_get_contents('data/' . $filename . '.json');
} else {
    $jsonString = '';
}
$data = json_decode($jsonString, true);
$re = array();
$date = date("m-d-Y");
if (!empty($data)) {
    foreach ($data['msg'] as $key => $value) {
        if ($value['status'] == "Send Later!") {
            $pos = strpos($value['publishdate'], $date);
            if ($pos === false) {
                
            } else {
                $re[] = $value;
            }
        }
    }

    if ((count($re)) > 0) {
        if (isset($_SESSION["sec"])) {
            
        } else {
            echo "<script>window.open('setimacros.php');</script>";
        }
    } else {
        // session_destroy();
    }
}
?>

<link type="text/css" rel="stylesheet" href="//suite.social/src/css/jquery.simple-dtpicker.css"  />
<style>

/**************************************** DATEPICKER ****************************************/


.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item {
	color: #000;
}

.datetimepicker td, .datetimepicker th {
	color: #333;
}

/**************************************** ADMIN UI ****************************************/

.input-group .input-group-addon {
    color: #fff;
}

.main-footer {
    display: none;
}

.content-wrapper {
    padding-top: 0px !important;
}

.nav-tabs-custom {
    border-radius: 20px 20px 0px 0px;
}

/**************************************** CHECKBOX ****************************************/

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

<!-- FOR DATE PICKER -->
<script src="//suite.social/src/js/jquery-1.12.0.min.js"></script>
<script src="//suite.social/src/js/jquery.simple-dtpicker.js"></script>
<script type="text/javascript">

function test() {
  var value = '<?php echo $val = getSession(); ?>';
  if (value == null || value == "null" || value == 0) {
      var gip = "";
      $.get("https://api.ipdata.co?api-key=8705b56ff5920952268a8d4ed5ec8883ae91d185c46e685ac17e74bc", function (response) {
          $("#response").val(response.ip);
      }, "jsonp")
      .fail(function() {
      	$.get('https://api.db-ip.com/v2/free/8.8.8.8', function(response) {
			$("#response").val(response.ipAddress);
      	}).fail(function() {
      		$.get('https://ip-api.com/json/', function(response) {
      			$("#response").val(response.query);
      		}).fail(function() {
      			$.get('https://ipapi.co/json/', function(response) {
      				$("#response").val(response.ip);
      			}).fail(function() {
      				$.get('https://ipvigilante.com/', function() {
      					$("#response").val(response.ipv4);
      				})
      			})
      		})
      	});
      });
      value = $("#response").val();

      $.post("ajax_session.php", {val: value}, function (data) {});

  }
  setTimeout(test, 4000);
}

</script>

<script>
$(document).ready(function ()
{
	test();
	$('#publishdate').appendDtpicker(
			{
				"minuteInterval": 5,
				"dateFormat": "MM-DD-YYYY hh:mm"
			});
	$('#repeatUntil').appendDtpicker(
			{
				"minuteInterval": 5,
				"dateFormat": "MM-DD-YYYY hh:mm"
			});

});
</script>

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

      <!-- Main content -->
      <section class="content">
	  
<div class="row">

<script>
var edate = 0;
var macroCode = '';
var sdate;
$(function () {

	$("#publishdate").on("change", function () {
		edate = $(this).val();
		$('#submit').val("Publish Later");
		$('#frequencyContainer').removeClass("hide");

	});
});

$(document).ready(function () {
	sdate = $('#publishdate').val();

});


function launchMacro()
{
	var base_url = window.location.origin;
	var pathparts = location.pathname.split('/');
	var url = location.origin + '/' + pathparts[1].trim('/') + '/';
	var pr;
	var ph = document.getElementById("ph").value;
	var repeat = escape(document.getElementById("repeat").value);
	var repeatFrequency = escape(document.getElementById("repeatFrequency").value);
	var repeatUntil = escape(document.getElementById("repeatUntil").value);
	var len;

	if (ph.includes("\n")) {
		p = ph.split("\n");
		len = p.length;
	} else {
		p = ph;
		len = 1;
	}

	macroCode += 'SET !ERRORIGNORE YES\n';
	var dt = escape(document.getElementById("publishdate").value);
	var cont = document.getElementById("content").value;
	var send = escape("Send Later!");
	var send1 = escape("Sent successfully");
	var j = 1;
	var o = 0;
	for (var i = 0; i < len; i++) {
		if (edate == 0) {

			macroCode += 'URL GOTO=https://api.whatsapp.com/send?phone=';
			if (len == 1) {
				if (p.includes(",")) {
					nob = p.split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p;
					name = "";
				}
				macroCode += pnob.trim();
			} else {
				if (p[i].includes(",")) {
					nob = p[i].split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p[i];
					name = "";
				}
				macroCode += pnob.trim();
			}
			macroCode += '&text=';
			if (cont.includes("{name}")) {
				content = escape(cont.replace("{name}", name));

			} else {
				content = escape(cont);
			}
			macroCode += content;
			macroCode += '\n';
			macroCode += 'WAIT SECONDS=2\n';
			macroCode += 'TAG POS=1 TYPE=A ATTR=ID:action-button\n';
			macroCode += 'WAIT SECONDS=25\n';
			macroCode += 'TAG POS=1 TYPE=SPAN ATTR=DATA-ICON:send&&CLASS:&&TXT:\n';
			macroCode += 'WAIT SECONDS=3\n';
			macroCode += 'URL GOTO=';
			macroCode += url;
			macroCode += 'message_action.php?phone=';
			if (len == 1) {
				if (p.includes(",")) {
					nob = p.split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p;
					name = "";
				}
				macroCode += pnob.trim();
			} else {
				if (p[i].includes(",")) {
					nob = p[i].split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p[i];
					name = "";
				}
				macroCode += pnob.trim();
			}
			macroCode += '&name=';
			macroCode += name;
			macroCode += '&text=';
			if (cont.includes("{name}")) {
				content = escape(cont.replace("{name}", name));

			} else {
				content = escape(cont);
			}
			macroCode += content;
			macroCode += '&publishdate=';
			macroCode += dt;
			macroCode += '&status=';
			macroCode += send1;
			macroCode += '\n';
			macroCode += 'WAIT SECONDS=3\n';
		} else {
			macroCode += 'TAB T=';
			macroCode += j;
			macroCode += '\n';
			macroCode += 'URL GOTO=';
			macroCode += url;
			macroCode += 'message_action.php?phone=';
			if (len == 1) {
				if (p.includes(",")) {
					nob = p.split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p;
					name = "";
				}
				macroCode += pnob.trim();
			} else {
				if (p[i].includes(",")) {
					nob = p[i].split(",");
					name = nob[0];
					pnob = nob[1];
				} else {
					pnob = p[i];
					name = "";
				}
				macroCode += pnob.trim();
			}
			macroCode += '&name=';
			macroCode += name;
			macroCode += '&text=';
			if (cont.includes("{name}")) {
				content = escape(cont.replace("{name}", name));

			} else {
				content = cont;
			}
			//Code fix
			macroCode += escape(content);
			macroCode += '&publishdate=';
			macroCode += dt;
			macroCode += '&repeat=';
			macroCode += repeat;
			macroCode += '&repeatFrequency=';
			macroCode += repeatFrequency;
			macroCode += '&repeatUntil=';
			macroCode += repeatUntil;
			macroCode += '&status=';
			macroCode += send;
			macroCode += '\n';

			j++;
		}

	}
	macroCode += 'TAB T=1';
	macroCode += '\n';

	try
	{
		if (!/^(?:chrome|https?|file)/.test(location))
		{
			alert('iMacros: Open webpage to run a macro.');
			return;
		}
		console.log(macroCode);
		var macro = {};
		macro.source = macroCode;
		macro.name = 'EmbeddedMacro';

		var evt = document.createEvent('CustomEvent');
		evt.initCustomEvent('iMacrosRunMacro', true, true, macro);
		window.dispatchEvent(evt);
	} catch (e)
	{
		alert('iMacros Bookmarklet error: ' + e.toString());
	}
	;
}

function clearsession() {
	$.post("ajax_session.php", {"can_clear": true}, function (data) {

		if (data.can_clear)
			window.location.reload();
	}, "json");
}
</script>

                <div class="box box-default">
			<div class="box-header with-border text-center">
				<h2><b>WhatsApp Bulk Sender</b></h2>
				<p>Allows sending or scheduling bulk WhatsApp messages to unlimited numbers via your browser! Before you start sending or scheduling bulk messages, there are 3 steps you need to take.</p>
			</div>
			<!-- /.box-header -->			
				
                    <div class="box-body">


      <!---------- TABS ---------->
	  
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">			  
        		<li class="active"><a href="#tab_1" data-toggle="tab">Send Messages <i class="fa fa-arrow-circle-right"></i></a></li>
        		<li><a href="#tab_2" data-toggle="tab">View Reports <i class="fa fa-arrow-circle-right"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
			  
<div class="row">								
                        <div class="col-md-6">
						<img width="100%" src="//suite.social/images/mockup/whatsapp.jpg" alt="WhatsApp">


			<h5 class="text-center" style="color:#DD4B39"><i class="icon fa fa-warning"></i> <b>Alert!</b> Follow all steps below before sending messages or this tool won't work!</h5>               

<hr>
						
<!------ STEP 1------>		

<h3 class="text-muted"><i>Have you...(tick boxes)</i></h3>				
	
 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox1">             
          <span class="checkbox-placeholder"></span>           
          <b>1.</b> Logged into WhatsApp web?
      </label>
 </div>
 
<div id="autoUpdate1" class="autoUpdate1">
<p><a href="https://web.whatsapp.com/" target="_blank" class="btn btn-success btn-lg"><i class="fab fa-whatsapp"></i> LOGIN NOW!</a></p>
</div>	

<!------ STEP 2------>	

 <div class="checkbox">
      <label class="checkbox-bootstrap checkbox-lg">                           
          <input type="checkbox" id="checkbox2">             
          <span class="checkbox-placeholder"></span>           
          <b>2.</b> Installed our extension & restarted browser?
      </label>
 </div>
 
<div id="autoUpdate2" class="autoUpdate2">
<p><a href="https://chrome.google.com/webstore/detail/social-sender-bulk-whatsa/opiddfjfhlgbfpipllgflkcgmdgklbak" target="_blank" class="btn btn-success btn-lg"><i class="fab fa-chrome"></i> INSTALL NOW!</a></p>
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
<p><a href="#Cleaner" data-toggle="modal"  class="btn btn-success btn-lg"><i class="fas fa-users"></i> CONVERT NOW!</a></p>
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
<h3>Good! Now you can start sending!</h3>
</div>						

<!------ /STEPS ------>											
						
                        </div>

                        <div class="col-md-6">

<!------------------------------- WHATSAPP FORM ------------------------------->

		<div class="box box-default">
			<!-- /.box-header -->
			<div class="box-body">

<input type="hidden" name="response" id="response">

                  <div id="login">

                  	<!-- <h2 class="text-center" style="color: #5cb85c;"> <strong> Send Message  </strong></h2><hr /> -->
                  	<form action="" method="post" id="form_id">

							  <!----- NUMBERS ----->

                                    <div class="form-group">
									
            <div class="box-header with-border">
              <i class="fa fa-phone"></i>
              <h3 class="box-title">Enter WhatsApp Numbers</h3>
            </div>
			
									<h5><p class="text-muted">Name , Number (no zeroes, brackets or dashes). Only international format. Use: 15551234567. Do not use: +001-(555)1234567). <span style="color:#DD4B39">No spaces</span></p></h5>
									
                                          <textarea rows="4" type="text" name="phone" id="ph" placeholder="John Doe,447779001234,Custom Message (optional)&#10;447778004321" class="form-control input-lg"></textarea>

                                    </div>
									
							  <!----- MESSAGE ----->							  

                                    <div class="form-group">

            <div class="box-header with-border">
              <i class="fa fa-envelope"></i>
              <h3 class="box-title">Enter Message</h3>
            </div>
			
									<h5><p class="text-muted">{name} - will be replaced by the contacts name. Spintax supported.</p></h5>			

                                          <textarea rows="4" type="text" placeholder="{name}, how are you?" name="msg" id="content" class="form-control input-lg" ></textarea>

                                    </div>

							  <!----- CALENDAR ----->

                                    <div class="form-group">
									
            <div class="box-header with-border">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Choose Date</h3>
            </div>
			
									<h5><p class="text-muted">This is optional. If you want to send messages now, skip this and click send now.</p></h5>									
									

                                          <input type="text" id="publishdate" name="publishdate"  class="form-control input-lg" value='<?php echo date("d-m-Y hh:mm:ss"); ?>'>

                                    </div>
									
                                    <!----- REPEAT -->									
                                    <div style="display:none" class="hide" id="frequencyContainer">  

                                    	<div class="box-header with-border">
                                    		<i class="fa fa-repeat"></i>
                                    		<h3 class="box-title">Repeat</h3>
                                    	</div>

                                    	<h5><p class="text-muted">This experimental so use at your own risk.</p></h5>								 

                                    	<div class="form-group">
                                    		<input type="number" placeholder="Repeat every..." id="repeat" name="repeat"  class="form-control input-lg" value=''>
                                    	</div>

                                    	<div class="form-group">
                                    		<select class="form-control input-lg" name="repeatFrequency" id="repeatFrequency">
                                    			<!--<option value="seconds">Seconds</option>
                                    			<option value="minute">Minute</option>-->
                                    			<option value="hour">Hour</option>
                                    			<option value="day">Day</option>
                                    			<option value="week">Week</option>
                                    		</select>
                                    	</div>

                                    	<div class="form-group">
                                    		<input class="form-control input-lg" type="text" placeholder="Until" name="repeatUntil" id="repeatUntil" value="">
                                    	</div>
                                    </div>															

                                    <!----- SEND --> 
                                    <hr />
									
									   <p class="alert alert-danger">Remember, follow the steps on left first otherwise sending won't work.</p>

                                    	<a id="criimlaunch" href="javascript:launchMacro();">
                                    		<input type="button" id="submit" class="btn btn-success btn-block btn-lg" name="submit" value="Send Now" />  
                                    	</a>
                                    	<!--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">Remember, install imacros chrome extension first and make sure you have logged into WhatsApp web otherwise it won't work.</p>-->
						  
                                </form>
                                <!--<a style="padding-left: 400px" href="viewmessages.php">View Messages</a>-->


                            </div>
			
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
		
<!------------------------------- /WHATSAPP FORM ------------------------------->	
					
                        </div>				
									
        </div>			  
			  
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">

	<a href="clear_reports.php" class="btn btn-success" style="float:right">Clear Reports</a><br><br>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>SL No</th>
				<th>Phone Number</th>
				<th>Name</th>
				<th>Msg Content</th>
				<th>Publshdate</th>
				<th>Status</th>
				<th>Created At</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$i=0;
			if(count($data['msg'])>0){
				foreach ($data['msg'] as $key => $value) {
					$i++;
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $value['to_number'];?></td>
						<td><?php echo $value['name'];?></td>
						<td><?php echo $value['message'];?></td>
						<td><?php echo $value['publishdate'];?></td>
						<td><?php echo $value['status'];?></td>
						<td><?php echo $value['created_at'];?></td>
						<td>
							<?php //if($value['status']!="Sent Successfully"){?><a href="send_message.php?id=<?php echo $value['id'];?>" class="btn btn-success btn-sm" >
								<span class="fa fa-paper-plane"></span> Send 
							</a><?php //}?></td>
						</tr>
						<?php
					}}
					?>
				</tbody>
			</table>
			  
              </div>
              <!-- /.tab-pane -->			  
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
		  
                    </div>
                </div>		  
		  		  		 			
<div align="center" class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">
					
					This tool is in no way affiliated with, authorized, maintained, sponsored or endorsed by WhatsApp or any of its affiliates or subsidiaries.

                    </div>
                </div>
            </div>
						
        </div>	

        </div>	  	
	  <!-- /.row -->
	  
      </section>
      <!-- /.content -->

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

<?php require_once 'footer-admin.php'; ?> 