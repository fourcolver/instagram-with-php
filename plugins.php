<?php 
if( !session_id() ){
	session_start();
}

require_once 'header-admin.php'; 
?>	

<!-- ================== CONTENT ======================== -->

<!-- Main content -->

<section class="content">

    <div class="row">

        <div class="box box-default">
            <div class="box-body">
                
                <div class="col-md-6">		
                    <h4>Upload new plugin and click "USE PLUGIN" button. Use the plugin link generated for "Promo URL".</h4>
                </div>
                
                <div class="col-md-6">

                    <a href="//suite.social/local/shopping" target="_blank" class="btn btn-success btn-lg btn-block"><i class="fa fa-plug"></i> Buy Plugins!</a>
                    <a href="#upload" data-toggle="collapse" class="btn btn-primary btn-lg btn-block"><i class="fa fa-upload"></i> Upload Plugin</a>


                    <div id="upload" class="collapse">

                        <form action="plugins.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Plugin</label>
                                <input type="file" id="exampleInputFile" name="zip_file">
                                <p class="help-block">Choose a valid plugin zip file to upload.</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>	

                    </div>
                </div>

            </div>
        </div>

        <?php if(isset($reader->message)) echo "<p class='message'>".$reader->message."</p>"; ?>
        <h3>Plugins</h3>

        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="100px">Title</th>
                        <th width="250px">Image</th>
                        <th>Network</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(sizeof($plugins) > 0): ?>
                    <?php foreach($plugins as $pluginInfo): ?>
                    <tr id="plg_<?= $pluginInfo['pluginname']; ?>">
                        <td><?= @$pluginInfo['headline']; ?></td>
                        <td><img width="100%" style="border:3px solid #999;" src="<?= $reader->url().'/plugins/'.$pluginInfo['pluginname'].'/'.$pluginInfo['image']; ?>"></td>
                        <td><?= @$pluginInfo['network']; ?></td>
                        <td><?= @$pluginInfo['description']; ?></td>
                        <td>
                            <p><a href="#" data-url="<?php echo $reader->url().'/plugins.php?action=getcontent&plgname='.$pluginInfo['pluginname']; ?>" data-plgname="<?= $pluginInfo['pluginname']; ?>" class="showplgcontent"><button class="btn btn-sm btn-primary"><span class="fa fa-cogs"></span> USE PLUGIN</button></a></p>
                            <p><a href="#" data-url="<?php echo $reader->url().'/plugins.php?action=delete&plgname='.$pluginInfo['pluginname']; ?>" data-plgname="<?= $pluginInfo['pluginname']; ?>" class="deleteplg"><button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> DELETE PLUGIN</button></a>
                        </td>				  
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php endif; ?>
         
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Network</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.row -->

    <!-- Edit Modal -->
    <div id="Plugin" class="modal" role="dialog">
        <div class="modal-dialog" role="document">                                                                                                                                                        
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>							
                    <h3 class="modal-title">Plugin name</h3>
                </div>
                <div class="modal-body">

                    CONTENT HERE										

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>	  

</section>
<!-- /.content -->

<!-- ================== /CONTENT ======================== -->	 	  

<?php require_once 'footer-admin.php'; ?> 