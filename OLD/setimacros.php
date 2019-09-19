<?php
session_start();
require_once('session.php');
require_once '../header.php';

 $file=getSession();
if($file!='0'){
  $filename=$file;
}else{
  $filename="results";
}
if (file_exists('data/'.$filename.'.json')) {
   $jsonString = file_get_contents('data/'.$filename.'.json');
} else {
   $jsonString = '';
}
$data = json_decode($jsonString, true);

$re=array();
$date=date("m-d-Y");
foreach ($data['msg'] as $key => $value) {
if($value['status'] == "Send Later!"){

  $pos = strpos($value['publishdate'], $date);
  if ($pos === false) {
  
} else {
  $re[]=$value;
    
  }
}

}
if(!empty($re)){
    $result['msg']=$re;
    $newJsonString = json_encode($result);

    $arr = json_decode($newJsonString);
    usort($arr->msg, function ($a, $b) {
    return ($dA = new DateTime( date("Y-m-d H:i", strtotime(str_replace('-','/', $a->publishdate))))) > ($dB = new DateTime( date("Y-m-d H:i", strtotime(str_replace('-','/', $b->publishdate))))) ? -1 : 1;
   
  });

  $newarr = json_encode($arr);
}

?>


<script>
    var macroCode = '';
    var success=escape("Send successfully");
    var notsend=escape("Not Sent Yet");
    var base_url = window.location.origin;
    var pathparts = location.pathname.split('/');
    var url = location.origin+'/'+pathparts[1].trim('/')+'/';
</script>
    <?php
    if(!empty($arr)){

    foreach ($arr->msg as $key => $value) {
         
         ?>
<script type="text/javascript">
          var ph="<?php echo $value->to_number;?>";
          var dte="<?php echo $value->publishdate;?>";
          var dt=escape("<?php echo $value->publishdate;?>");
          var cont=escape("<?php echo $value->message;?>");
          var now = new Date().getTime();
          var countDownDate = new Date(dte).getTime();
          var distance = countDownDate - now;
if(distance>0){
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        mseconds=(hours * 60 * 60) + (minutes * 60) + seconds;
        
        macroCode+= 'TAB T=1\n';
        macroCode+='TAB CLOSE\n';
        macroCode+='WAIT SECONDS=';
        macroCode+=mseconds;
        macroCode+='\n';
       // macroCode+='TAB OPEN\n';
        macroCode+= 'TAB T=1\n';
        macroCode += 'URL GOTO=https://api.whatsapp.com/send?phone=';
        macroCode += ph;
        macroCode +=  '&text=';
        macroCode += cont;
        macroCode+='\n';
        macroCode +='TAG POS=1 TYPE=A ATTR=ID:action-button\n';
        macroCode +='WAIT SECONDS=20\n';
        macroCode +='TAG POS=1 TYPE=SPAN ATTR=DATA-ICON:send&&CLASS:&&TXT:\n';
        macroCode+= 'URL GOTO=';
        macroCode+= url;
        macroCode+= 'updatestatus.php?id=<?php echo $value->id;?>&status=';
        macroCode+=success;
        macroCode+='\n';
                       }
        else{
            macroCode+= 'URL GOTO=';
            macroCode+= url;
            macroCode+= 'updatestatus.php?id=<?php echo $value->id;?>&status=';
            macroCode+=notsend;
            macroCode+='\n';
          
         }
                       function launchMacro()
            {
           
            
            try
               {
                  if(!/^(?:chrome|https?|file)/.test(location))
                  {
                     alert('iMacros: Open webpage to run a macro.');
                     // return;
                  }
            
                  var macro = {}; 
                  macro.source = macroCode;
                  macro.name = 'EmbeddedMacro';
            
                  var evt = document.createEvent('CustomEvent');
                  evt.initCustomEvent('iMacrosRunMacro', true, true, macro);
                  window.dispatchEvent(evt);
               }
            catch(e)
            {
               alert('iMacros Bookmarklet error: '+e.toString());
            };
       
        }

      </script>
	  
 <style>

.main-footer {
    display: none;
}

.content-wrapper {
    padding-top: 0px !important;
}

</style>	  
	  
      <body onload="window.setTimeout('document.getElementById(\'criimlaunch\').click();', 1000);" class="hold-transition skin-green layout-top-nav">
      <a id="criimlaunch" href="javascript:launchMacro();"></a>
	  
  <!-- =================CONTENT====================== -->  
   
  <!-- Full Width Column -->
  <div class="content-wrapper">
  
    <div style="width:100%" class="container">

      <!-- Main content -->
      <section class="content">

<div class="row">
                <div class="box box-default">
                    <div class="box-body">

                        <div class="col-md-6">
						<br>	
						<img width="100%" src="//suite.social/images/screen/whatsappweb.jpg" alt="WhatsApp Web">																								
                        </div>

                        <div class="col-md-6">		
                            <h2 align="center"><b><i class="fa fa-clock-o fa-2x"></i> <br>Your message is scheduled!</b></h2>
							<hr>
							<p><h4><label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Connect your phone to WhatsApp</label></p> 
							<p><label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Keep this window open</label></p>
							<p><label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Sit back and relax </label></p>
							
							<p>...while this tool sends single or bulk messages (news, reminders or promotions etc) to unlimited numbers.</p></h4>
							<!--<p><a href="#UpgradeWhatsApp" data-toggle="modal" data-dismiss="modal" class="btn btn-primary btn-lg btn-block"><i class="fa fa-money"></i> UPGRADE NOW!</a></p>-->
                        </div>

                    </div>
                </div>
						
        </div> 		  
		  
<!-- =================/CONTENT====================== -->		
		
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- =================FOOTER====================== -->
	 	  
	  
      </body>
      </html>
 
         <?php
    }
  }

?>