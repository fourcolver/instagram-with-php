<?php 

session_start(); 
$LinkedinUrl = isset($_SESSION['LinkedinUrl']) ? $_SESSION['LinkedinUrl'] : "https://www.linkedin.com/company/suitesocial";

?>
<div class="social-button">
  <script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
  <script type="IN/FollowCompany" data-id="<?php echo $LinkedinUrl; ?>"></script>
  <img style="cursor: pointer" src="/promo/img/linkedin-follow.jpg" onclick="PopupCenter('<?php echo $LinkedinUrl; ?>', 'LinkedIn','640','480')">
</div>

<script>
function PopupCenter(url, title, w, h) 
{
    // Fixes dual-screen position                         
    // Most browsers      
    // Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var systemZoom = width / window.screen.availWidth;
    var left = (width - w) / 2 / systemZoom + dualScreenLeft
    var top = (height - h) / 2 / systemZoom + dualScreenTop
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) newWindow.focus();
    
    $('.onp-sl').hide();
    $('.onp-sl-content').show();
}
</script>