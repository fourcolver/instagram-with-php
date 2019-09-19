<!-- Share -->

        <div class="modal fade" id="Share">

          <div class="modal-dialog">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span></button>

                <h2 class="modal-title text-center"><b>Scan the QR code with your smartphone to share on WhatsApp</b></h2>

              </div>

              <div align="center" class="modal-body">				

		

		<img width="50%" src="https://chart.apis.google.com/chart?cht=qr&chs=500x500&chl=<?php echo $current_url; ?>" alt="WHATSAPP" />

		

		<h4 style="color:#999">For free code reader for your mobile, visit: http://www.i-nigma.mobi<h4>			

					  

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

              </div>

            </div>

            <!-- /.modal-content -->

          </div>

          <!-- /.modal-dialog -->

        </div>

        <!-- /.modal -->



<script>

	// click to reveal

$('#showMe').hide(0).delay(15000).show(0);



$(document).ready(function() {

  /*$("#hide-button").click(function () {

   //$("#show-button").show()

   $("#hide-button").hide()
  // $('.click-to-reveal-block').hide(0).delay(15000).show(0);

  });*/

  $(".ctm-share-promo").click(function () {

   //$("#show-button").show()

   $("#hide-button").hide()
   $('.click-to-reveal-block').hide(0).delay(5000).show(0);

  });

 }); 



jQuery(function() {

  jQuery(".click-to-reveal").click(function() {

    jQuery(this)

      .children()

      .toggleClass("rotate");

    jQuery(this)

      .next("div.click-to-reveal-block")

      .toggle();

  });

});



jQuery(function() {

  jQuery(".faqs h3").click(function() {

    jQuery(this)

      .next("div")

      .toggle();

  });

});



</script>

		

<script>

document.getElementById('countshare').addEventListener('click', function(){

    var xmlhttp;

    if (window.XMLHttpRequest)

    {// code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();

    }

    else

    {// code for IE6, IE5

    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }

    xmlhttp.open("POST","share.php",true);

    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    xmlhttp.send("doit=true");

});

</script>



<script>

  function popupSmall(url)

  {

  var w = 800;

  var h = 600;

  var title = 'Social Promo';

  var left = (screen.width / 2) - (w / 2);

  var top = (screen.height / 2) - (h / 2);

  window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  }

  

  function popup(url)

  {

  var w = 1250;

  var h = 700;

  var title = 'Social Promo';

  var left = (screen.width / 2) - (w / 2);

  var top = (screen.height / 2) - (h / 2);

  window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  }



</script>



<!-- Flip -->

<script src="//suite.social/src/flip/flip.min.js"></script>



<!-- jQuery 3 -->

<script src="//suite.social/src/bower_components/jquery/dist/jquery.min.js"></script>



<!-- Bootstrap 3.3.7 -->

<script src="//suite.social/src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



</body>

</html>