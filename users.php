<?php 
session_start();
//session_status();
require_once 'header-admin.php'; 
require_once ('src/class.database.php');
$dbobj = new database();

if (isset($_POST['ajax']) && $_POST['ajax'] == "delete") {
   
    $dbobj->deletevalue($_POST);
    echo "success";
    exit;
} elseif (isset($_POST['ajax']) && $_POST['ajax'] == "export") {

    $contacts = array();
    $user_key = $_POST['key']; //"111913759580444214966"; //$_POST['key'];
    $infos = $dbobj->gettabledata();
    if (isset($_POST['list_id'])) {
        $list_id = $_POST['list_id'];
    }
    $user_data = array();
    foreach ($infos as $key => $values) {
        if ($key == $user_key) {
            $user_data = $values;
        }
    }
    if (isset($_POST['list_id']) && !empty($_POST['list_id'])) {
        $contacts = $user_data->records->$list_id;
    } else {
        $contacts = $user_data->records;
    }
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="contacts.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    $output = fopen("php://output", "w");
    fputcsv($output, array('title', 'phoneNumber', 'Email'));
    $data = array();

    if(is_array($contacts)) {
	    foreach ($contacts as $contact) {
		    $data = array(
			    $contact->title,
			    $contact->number,
			    $contact->email,
		    );
		    fputcsv($output, $data);
	    }
    }
    exit;
}
?>	

    <?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ ?>
        <script type="text/javascript">
            alert("Please login first.");
            window.location.replace("http://suite.social/promo/index.php");
        </script>
    <?php } ?>
    <!-- ================== CONTENT ======================== -->
	  
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <h3>Verified Users</h3>
            <div class="table-responsive">
                <table data-page-length='100' id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td style="width: 5px;"><input type="checkbox" id="select-all"></td>
                            <th>Profile</th>
                            <th>Name</th>                        
                            <th>Profile URL</th>
                            <th style="display:none;">Birthday</th>
                            <th>WhatsApp</th>
                            <th>Location</th>
                            <th>Campaign Name</th>
                            <th style="display:none;">Records</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($_SESSION['dashboard_uid']) && isset($_SESSION['dashboard_uid_admin'])){ ?>
                            <?php
                            $data = file_get_contents('promouserdata.json');
                            // decode json to associative array
                            $infos = json_decode($data, true);
                            
                            if(!empty($infos)) {

                                //remove duplicate phone number
                                $new_infos = array();
                                foreach ($infos as $key => $info) 
                                {
                                  $new_infos[$info['user']['promoid'].$info['user']['number']] = $info;
                                }
                                
                                $infos = $new_infos;
                                
                                foreach ($infos as $key => $info) 
                                {
                                  
                                    $user_list = (isset($info->list_info) ? $info->list_info : array());
                                    $service = (isset($info->service) ? $info->service : 'Unknown');
                                    
                                    if($info['user']['referadminid'] == $_SESSION['dashboard_uid']) 
                                    {
                                        ?>
                                        <tr>                           
                                            <td>
                                              <input type="checkbox" class="checkbox" 
                                                data-number="<?php echo $info['user']['number']; ?>" 
                                                data-promoid="<?php echo $info['user']['promoid']; ?>">
                                            </td>
                                            <td>
                                              <img class="thumbnail" src="<?php echo isset($info['user']['profile_picture']) ? 'uploads/'.$info['user']['profile_picture'] : "img/default.jpg"; ?>" width="50px" />
                                            </td>
                                            <td><?php echo $info['user']['displayName']; ?></td>                            
                                            <td align="center">
                                              <?php echo isset($info['user']['profile_url']) ? '<a target="_blank" href="'.$info['user']['profile_url'].'">click here</a>' : ""; ?>
                                            </td>
                                            <td style="display:none;"><?php echo isset($info['user']['birthday'])?$info['user']['birthday']:''; ?></td>
                                            <td data-email="<?php echo $info['user']['number']; ?>"><?php echo $info['user']['number']; ?></td>
                                            <td><?php echo $info['user']['location']; //isset($info['user']['address']) ? $info['user']['address'] : '' ; ?></td>
                                            <td><?php echo $info['user']['campaignName']; //isset($info['user']['interest']) ? $info['user']['interest'] : '' ; ?></td>
                                            <td style="display:none;"><?php echo $info['user']['record_count']; ?></td> 
                                            <td>
                                              <a style="cursor: pointer;" onclick="contact(<?php echo $info['user']['number']; ?>, '<?php echo $info['user']['displayName']; ?>')">
                                                <img src="<?php echo !empty($info['user']['image']) ? $info['user']['image'] : "img/whatsapp.png"; ?>" width="30px" height="30px" />
                                              </a>
                                            </td>
                                            <td><?php echo isset($info['user']['service']) ? $info['user']['service'] : '' ; ?></td>
                                            <td>
                                                <ul class="action_box">
                                                    <button 
                                                      data-number="<?php echo $info['user']['number']; ?>" 
                                                      data-promoid="<?php echo $info['user']['promoid']; ?>" 
                                                      class="delete btn btn-sm btn-danger">
                                                      <span class="fa fa-trash" aria-hidden="true"></span>
                                                    </button>
                                                    <?php
                                                    if (isset($user_list) && !empty($user_list)) {
                                                        if (empty($user_list)) {
                                                            echo "<li>No List Found</li>";
                                                        }

                                                        foreach ($user_list as $list) {
                                                            ?>
                                                            <li>
                                                                <form class="frm-export" method="post" >
                                                                    <input type="hidden" name="ajax" value="export" />
                                                                    <input type="hidden" name="key" value="<?php echo $key; ?>" />
                                                                    <input type="hidden" name="list_id" value="<?php echo $list->listid; ?>" />
                                                                    <a class="export_contacts" dataval="<?php echo $key; ?>" style="cursor: pointer;" no_data="<?php echo $list->list_count; ?>" ><?php echo $list->list_name; ?></a>
                                                                </form>

                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        if((int)$info['user']['record_count']>0){
                                                        ?>
                                                        <li>
                                                            <form class="frm-export" method="post" >
                                                                <input type="hidden" name="ajax" value="export" />
                                                                <input type="hidden" name="key" value="<?php echo $key; ?>" />
                                                                <a class="export_contacts" dataval="<?php echo $key; ?>" no_data="1" style="cursor: pointer;" >export contacts</a>
                                                            </form>

                                                        </li>                                       

                                                        <?php }} ?>
                                                </ul>
                                            </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                            }
                            ?>
                        <?php }
                        /*else{ ?>
                            <?php
                                $infos = $dbobj->gettabledata();
                                foreach ($infos as $key => $info) {
                                    $user_list = (isset($info->list_info) ? $info->list_info : array());
                                    $service = (isset($info->service) ? $info->service : 'Unknown');
                                    $info = (isset($info->user) ? (array) $info->user : array());

                                    if(count($info)>0){
                                    ?>
                                    <tr>                           
                                        <td><input type="checkbox"></td>
                                        <td><img src="<?php echo !empty($info['image']) ? $info['image'] : "img/default.jpg"; ?>" width="50px" height="50px" /></td>
                                        <td><?php echo $info['displayName']; ?></td>                            
                                        <td><?php echo $info['gender']; ?></td>
                                        <td style="display:none;"><?php echo isset($info['birthday'])?$info['birthday']:''; ?></td>
                                        <td><?php echo $info['email']; ?></td>
                                        <td><?php echo isset($info['address']) ? $info['address'] : '' ; ?></td>
                                        <td><?php echo isset($info['interest']) ? $info['interest'] : '' ; ?></td>
                                        <td style="display:none;"><?php echo $info['record_count']; ?></td> 
                                        <td><a style="cursor: pointer;" onclick="contact()"><img src="<?php echo !empty($info['image']) ? $info['image'] : "img/whatsapp.png"; ?>" width="30px" height="30px" /></a></td>
                                        <td><?php echo isset($info['service']) ? $info['service'] : '' ; ?></td>
                                        <td>
                                            <ul class="action_box">
                                                    <button dataval="<?php echo $key; ?>" class="delete btn btn-sm btn-danger"><span class="fa fa-trash" aria-hidden="true"></span></button>
                                                <?php
                                                if (isset($user_list) && !empty($user_list)) {
                                                    if (empty($user_list)) {
                                                        echo "<li>No List Found</li>";
                                                    }

                                                    foreach ($user_list as $list) {
                                                        ?>
                                                        <li>
                                                            <form class="frm-export" method="post" >
                                                                <input type="hidden" name="ajax" value="export" />
                                                                <input type="hidden" name="key" value="<?php echo $key; ?>" />
                                                                <input type="hidden" name="list_id" value="<?php echo $list->listid; ?>" />
                                                                <a class="export_contacts" dataval="<?php echo $key; ?>" style="cursor: pointer;" no_data="<?php echo $list->list_count; ?>" ><?php echo $list->list_name; ?></a>
                                                            </form>

                                                        </li>
                                                        <?php
                                                    }
                                                } else {
                                                    if((int)$info['record_count']>0){
                                                    ?>
                                                    <li>
                                                        <form class="frm-export" method="post" >
                                                            <input type="hidden" name="ajax" value="export" />
                                                            <input type="hidden" name="key" value="<?php echo $key; ?>" />
                                                            <a class="export_contacts" dataval="<?php echo $key; ?>" no_data="1" style="cursor: pointer;" >export contacts</a>
                                                        </form>

                                                    </li>                                       

                                                    <?php }} ?>
                                            </ul>
                                        </td>
                                    </tr> 
                                     <?php } ?>    
                                <?php } ?>
                        <?php }*/ ?>
                    </tbody>                                
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
		  
  <!-- ================== /CONTENT ======================== -->	

  <script type="text/javascript">
  
    function contact(number, name) 
    {
        var w = 800;
        var h = 600;						
        var title = 'WhatsApp';
        var url = 'https://api.whatsapp.com/send?phone='+number+'&text=Hi%20'+name;
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        newwindow = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }		
    
  </script> 	  	

<?php require_once 'footer-admin.php'; ?> 