<?php
session_start();
require_once('session.php');

$id=$_GET['id'];
?>
<script>
  var base_url = window.location.origin;
  var pathparts = location.pathname.split('/');
  var url = location.origin+'/'+pathparts[1].trim('/')+'/';
</script>
<?php
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
foreach ($data['msg'] as $key => $value) {
    if ($value['id'] == $id) {
?>

<script>

         var macroCode = '';
         var success=escape("Send successfully");
        var notsend=escape("Not Sent Yet");
         function launchMacro()
            {
              var ph="<?php echo $value['to_number'];?>";
              var cont=escape("<?php echo $value['message'];?>");
                macroCode+= 'TAB T=1\n';
               macroCode+='TAB OPEN\n';
               macroCode+= 'TAB T=2\n';
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
               macroCode+= 'updatestatus.php?id=<?php echo $value['id'];?>&status=';
                
               macroCode+=success;
               macroCode+='\n';
                macroCode+='TAB CLOSE\n';
               macroCode+='TAB T=1\n';
                macroCode+= 'URL GOTO=';
                macroCode+= url;
               macroCode+= 'viewmessages.php\n';
              
            try
               {
                  if(!/^(?:chrome|https?|file)/.test(location))
                  {
                     alert('iMacros: Open webpage to run a macro.');
                     return;
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
      <?php
}}
      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <title></title>
      </head>
      <body onload="window.setTimeout('document.getElementById(\'criimlaunch\').click();', 100);">
      <a id="criimlaunch" href="javascript:launchMacro();"></a>

      </body>
      </html>