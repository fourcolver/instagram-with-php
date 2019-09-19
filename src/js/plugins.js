$(document).ready(function () {
    $('.showplgcontent').on('click', function (e) {
        e.preventDefault();
        $('#Plugin').modal();
        $('#Plugin').find('.modal-body').html('Fetching Content...');
        var plugin_name = $(this).data('plgname');
        if (typeof plugin_name != 'undefined') {
            $.ajax({
                type: 'GET',
                url: $(this).data('url'),
                dataType: 'html',
                success: function (data) {
                    $('#Plugin').find('.modal-body').html(data);
                },
                error: function () {
                    alert('Please configure the BASE_URL constant in plugins.php file in line 4.');
                }
            });
        }
    });
    
    $('.deleteplg').on('click', function (e) {
        var plg_name = $(this).data('plgname');
        e.preventDefault();
        if (confirm('Are you sure you want to delete the plugin?')) {
            $.ajax({
                type: 'GET',
                url: $(this).data('url'),
                dataType: 'html',
                success: function (data) {
                    var table = $('#example').DataTable();
                    table.destroy();
                    
                    $('#example tr#plg_'+plg_name).remove();
                    
                    var size = $('#example tbody tr').length;
                    $('.total_plugins').html(size);
                    
                    $('#example').dataTable();
                    
                    $('.message').html('Plugin deleted successfully.');
                },
                error: function () {
                    alert('Please configure the BASE_URL constant in plugins.php file in line 4.');
                }
            });
        }
    });

});