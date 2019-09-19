    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  

<!-- Main Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
            <a href="https://www.facebook.com/www.suite.social" class="text-muted" target="_blank"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
            <a href="https://instagram.com/socialgrower" class="text-muted" target="_blank"><i class="fab fa-instagram"></i></a>&nbsp;&nbsp;
            <a href="https://twitter.com/socialsuite" class="text-muted" target="_blank"><i class="fab fa-twitter"></i></a>&nbsp;&nbsp;
			<a href="skype:socialgrower?chat" class="text-muted" target="_blank"><i class="fab fa-skype"></i></a>&nbsp;&nbsp;
			<a href="https://api.whatsapp.com/send?phone=447876806121&text=I%20need%20help" class="text-muted" target="_blank"><i class="fab fa-whatsapp"></i></a>&nbsp;&nbsp;
      </div>

	  <strong>&copy; <?php echo date('Y'); ?> - <a href="//suite.social">Social Suite.</a></strong> All Rights Reserved. <a href="index.php#contact">Contact</a> I <a href="legal.php#privacy">Privacy Policy</a> I <a href="legal.php#terms">Terms & Conditions</a> I <a href="legal.php#agreement">User Agreement</a>

    </div>
    <!-- /.container -->
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Flip -->
<script src="//suite.social/src/flip/flip.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="//suite.social/src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<!-- SlimScroll -->
<script src="//suite.social/src/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="//suite.social/src/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="//suite.social/src/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="//suite.social/src/dist/js/demo.js"></script>-->
<!-- Plugins -->
<script src="src/js/plugins.js"></script>
<script>
    var pluginInfo = <?=  isset($pluginInfo)?json_encode($pluginInfo):FALSE;  ?>

  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  
$('.targetinput').keyup(function(event) {
  newText = event.target.value;
  $('.targetbox').text(newText);
});  

$('.headlineinput').keyup(function(event) {
  newText = event.target.value;
  $('.headlinebox').text(newText);
});  

$('.captioninput').keyup(function(event) {
  newText = event.target.value;
  $('.captionbox').text(newText);
});

$('.actioninput').keyup(function(event) {
  newText = event.target.value;
  $('.actionbox').text(newText);
});

$('.backgroundinput').keyup(function() {
    $('#backgroundbox').html($(this).val());
});

// DataTables

            $(document).ready(function () {
                var ids = [];
                var table = $('#example').DataTable(
                        {
                            dom: 'Bfrtip',
                            buttons: [
                                {
									extend: 'csvHtml5',
                                    className: 'btn btn-success',									
                                    text: 'Export CSV',
                                    filename: 'export_data',
                                    exportOptions: {
                                        stripHtml: false,
//                                        columns: [':not(:last-child)',':not(:first-child)']                                        
                                        columns: [1, 2, 3, 4, 5, 6, 7]
                                    }

                                },
                                {
									extend: 'excelHtml5',
                                    className: 'btn btn-primary',									
                                    text: 'Export Excel',
                                    exportOptions: {
                                        stripHtml: false
                                    }
                                }
                                ,
                                {
                                    className : 'btn btn-danger delete-all',
                                    text: 'Delete',
                                    action: function ( e, dt, node, config ) 
                                    {
                                        if (!confirm("Are you sure want to delete this selected users?")) {
                                            return false;
                                        }
                                          
                                        $('.checkbox').each(function()
                                        {
                                          if($(this).prop('checked') == true)	
                                          {
                                            var elementval = $(this);
                                            var number = elementval.data('number');
                                            var promoid = elementval.data('promoid');
                                            
                                            $.ajax({
                                                method: "POST",
                                                url: "users.php",
                                                data: {ajax: "delete", number: number, promoid: promoid}
                                            })
                                              .done(function (msg) {
                                                  table
                                                          .row(elementval.parents("tr"))
                                                          .remove()
                                                          .draw();
                                              });
                                          }
                                        })
                                    }
                                }
                            ]

                        });
                        
                $(document).on("click", ".delete", function ()
                {
                    if (!confirm("Delete item?")) {
                      return false;
                    }

                    var elementval = $(this);
                    var number = elementval.data('number');
                    var promoid = elementval.data('promoid');
                    
                    $.ajax({
                        method: "POST",
                        url: "users.php",
                        data: {ajax: "delete", number: number, promoid: promoid}
                    })
                            .done(function (msg) {
                                table
                                        .row(elementval.parents("tr"))
                                        .remove()
                                        .draw();
                            });
                });
                
                $(document).on("click", ".export_contacts", function ()
                {
                    var elementval = $(this);
                    var indicator = 0;
                    indicator = elementval.attr("no_data");
                    if (indicator > 0) {
                        elementval.parent("form").submit();
                    }
                });
                
                /* 
                  select all functionality
                  select all functionality
                  select all functionality
                */
                $('#select-all').click(function()
                {
                  if($('#select-all').prop('checked') == true)
                  {
                    $('.checkbox').prop('checked', true)
                  }
                  else
                  {
                    $('.checkbox').prop('checked', false)
                  }
                })
            });


</script>
</body>
</html>