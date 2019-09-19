<?php
error_reporting(0);
$valueno=array();
$pfx='';
$clientname=array();
$clientnmber=array();

if(isset($_POST['convertnumber'])){
	
	$country=$_POST['country'];
	
	$mobilenumbers = trim($_POST['mobno']);
	//$mobilenumbers=str_ireplace(';',',',$mobilenumbers);
	$mobilenumbers = explode("\n",$mobilenumbers);
	$mobilenumbers = array_filter($mobilenumbers, 'trim');
	
	$pfx = $country;
	$firstelement = '';
	$clientname = array();
	foreach ($mobilenumbers as $c => $n )
	{
		$name_num = explode(",", $n);
		if (count($name_num) > 1) {
			$name = $name_num[0];
			$num = $name_num[1];
		}else{
			$name = "";
			$num = $name_num[0];
		}
        //Remove any parentheses and the numbers they contain:
		$n = preg_replace("/\([0-9]+?\)/", "", $num);

        //Strip spaces and non-numeric characters:
		$n=preg_replace( "/[^a-z0-9]/i", "", $n );

        //Strip out leading zeros:
		$n = ltrim($n, '0');
		
		
		if ( !preg_match('/^'.$pfx.'/', $n)  ) {
			$n = $pfx.$n;
		}
		
		if (!empty($name)) {
			$valueno[] = $name.",".$n;
		}else{
			$valueno[] = $n;
		}
		 
        //Outputs: 17123456781 447123456782 447123456783 447123456784 447123456785 17123456786
	}

	echo"<script>alert('Done! Copy WhatsApp Numbers')</script>";
}

?>

<?php require_once '../header.php'; ?>

<style>
.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
	background-color: #609450;
}
</style>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-body">

				<form action="" method="post">

					<div class="box box-solid">
						<div class="box-header with-border">
							<i class="fa fa-flag"></i>

							<h3 class="box-title">Choose Country</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">

							<div class="form-group">
								<select class="selectpicker" data-show-subtext="true" name="country" data-live-search="true" data-style="btn-success">

									<option value="">--- SELECT ---</option>
									<option data-subtext="" value="93">Afghanistan (+93)</option>
									<option data-subtext="" value="355">Albania (+355)</option>
									<option data-subtext="" value="213">Algeria (+213)</option>
									<option data-subtext=" " value="1684">American Samoa (+1684)</option>
									<option data-subtext=" " value="376">Andorra (+376)</option>
									<option data-subtext=" " value="244">Angola (+244)</option>
									<option data-subtext=" " value="1264">Anguilla (+1264)</option>
									<option data-subtext=" " value="0">Antarctica (+0)</option>
									<option data-subtext=" " value="1268">Antigua and Barbuda (+1268)</option>
									<option data-subtext=" " value="54">Argentina (+54)</option>
									<option data-subtext=" " value="374">Armenia (+374)</option>
									<option data-subtext=" " value="297">Aruba (+297)</option>
									<option data-subtext=" " value="61">Australia (+61)</option>
									<option data-subtext=" " value="43">Austria (+43)</option>
									<option data-subtext=" " value="994">Azerbaijan (+994)</option>
									<option data-subtext=" " value="1242">Bahamas (+1242)</option>
									<option data-subtext=" " value="973">Bahrain (+973)</option>
									<option data-subtext=" " value="880">Bangladesh (+880)</option>
									<option data-subtext=" " value="1246">Barbados (+1246)</option>
									<option data-subtext=" " value="375">Belarus (+375)</option>
									<option data-subtext=" " value="32">Belgium (+32)</option>
									<option data-subtext=" " value="501">Belize (+501)</option>
									<option data-subtext=" " value="229">Benin (+229)</option>
									<option data-subtext=" " value="1441">Bermuda (+1441)</option>
									<option data-subtext=" " value="975">Bhutan (+975)</option>
									<option data-subtext=" " value="591">Bolivia (+591)</option>
									<option data-subtext=" " value="387">Bosnia and Herzegovina (+387)</option>
									<option data-subtext=" " value="267">Botswana (+267)</option>
									<option data-subtext=" " value="0">Bouvet Island (+0)</option>
									<option data-subtext=" " value="55">Brazil (+55)</option>
									<option data-subtext=" " value="246">British Indian Ocean Territory (+246)</option>
									<option data-subtext=" " value="673">Brunei Darussalam (+673)</option>
									<option data-subtext=" " value="359">Bulgaria (+359)</option>
									<option data-subtext=" " value="226">Burkina Faso (+226)</option>
									<option data-subtext=" " value="257">Burundi (+257)</option>
									<option data-subtext=" " value="855">Cambodia (+855)</option>
									<option data-subtext=" " value="237">Cameroon (+237)</option>
									<option data-subtext=" " value="1">Canada (+1)</option>
									<option data-subtext=" " value="238">Cape Verde (+238)</option>
									<option data-subtext=" " value="1345">Cayman Islands (+1345)</option>
									<option data-subtext=" " value="236">Central African Republic (+236)</option>
									<option data-subtext=" " value="235">Chad (+235)</option>
									<option data-subtext=" " value="56">Chile (+56)</option>
									<option data-subtext=" " value="86">China (+86)</option>
									<option data-subtext=" " value="61">Christmas Island (+61)</option>
									<option data-subtext=" " value="672">Cocos (Keeling) Islands (+672)</option>
									<option data-subtext=" " value="57">Colombia (+57)</option>
									<option data-subtext=" " value="269">Comoros (+269)</option>
									<option data-subtext=" " value="242">Congo (+242)</option>
									<option data-subtext=" " value="242">Congo, the Democratic Republic of the (+242)</option>
									<option data-subtext=" " value="682">Cook Islands (+682)</option>
									<option data-subtext=" " value="506">Costa Rica (+506)</option>
									<option data-subtext=" " value="225">Cote D'Ivoire (+225)</option>
									<option data-subtext=" " value="385">Croatia (+385)</option>
									<option data-subtext=" " value="53">Cuba (+53)</option>
									<option data-subtext=" " value="357">Cyprus (+357)</option>
									<option data-subtext=" " value="420">Czech Republic (+420)</option>
									<option data-subtext=" " value="45">Denmark (+45)</option>
									<option data-subtext=" " value="253">Djibouti (+253)</option>
									<option data-subtext=" " value="1767">Dominica (+1767)</option>
									<option data-subtext=" " value="1809">Dominican Republic (+1809)</option>
									<option data-subtext=" " value="593">Ecuador (+593)</option>
									<option data-subtext=" " value="20">Egypt (+20)</option>
									<option data-subtext=" " value="503">El Salvador (+503)</option>
									<option data-subtext=" " value="240">Equatorial Guinea (+240)</option>
									<option data-subtext=" " value="291">Eritrea (+291)</option>
									<option data-subtext=" " value="372">Estonia (+372)</option>
									<option data-subtext=" " value="251">Ethiopia (+251)</option>
									<option data-subtext=" " value="500">Falkland Islands (Malvinas) (+500)</option>
									<option data-subtext=" " value="298">Faroe Islands (+298)</option>
									<option data-subtext=" " value="679">Fiji (+679)</option>
									<option data-subtext=" " value="358">Finland (+358)</option>
									<option data-subtext=" " value="33">France (+33)</option>
									<option data-subtext=" " value="594">French Guiana (+594)</option>
									<option data-subtext=" " value="689">French Polynesia (+689)</option>
									<option data-subtext=" " value="0">French Southern Territories (+0)</option>
									<option data-subtext=" " value="241">Gabon (+241)</option>
									<option data-subtext=" " value="220">Gambia (+220)</option>
									<option data-subtext=" " value="995">Georgia (+995)</option>
									<option data-subtext=" " value="49">Germany (+49)</option>
									<option data-subtext=" " value="233">Ghana (+233)</option>
									<option data-subtext=" " value="350">Gibraltar (+350)</option>
									<option data-subtext=" " value="30">Greece (+30)</option>
									<option data-subtext=" " value="299">Greenland (+299)</option>
									<option data-subtext=" " value="1473">Grenada (+1473)</option>
									<option data-subtext=" " value="590">Guadeloupe (+590)</option>
									<option data-subtext=" " value="1671">Guam (+1671)</option>
									<option data-subtext=" " value="502">Guatemala (+502)</option>
									<option data-subtext=" " value="224">Guinea (+224)</option>
									<option data-subtext=" " value="245">Guinea-Bissau (+245)</option>
									<option data-subtext=" " value="592">Guyana (+592)</option>
									<option data-subtext=" " value="509">Haiti (+509)</option>
									<option data-subtext=" " value="0">Heard Island and Mcdonald Islands (+0)</option>
									<option data-subtext=" " value="39">Holy See (Vatican City State) (+39)</option>
									<option data-subtext=" " value="504">Honduras (+504)</option>
									<option data-subtext=" " value="852">Hong Kong (+852)</option>
									<option data-subtext=" " value="36">Hungary (+36)</option>
									<option data-subtext=" " value="354">Iceland (+354)</option>
									<option data-subtext=" " value="91">India (+91)</option>
									<option data-subtext=" " value="62">Indonesia (+62)</option>
									<option data-subtext=" " value="98">Iran, Islamic Republic of (+98)</option>
									<option data-subtext=" " value="964">Iraq (+964)</option>
									<option data-subtext=" " value="353">Ireland (+353)</option>
									<option data-subtext=" " value="972">Israel (+972)</option>
									<option data-subtext=" " value="39">Italy (+39)</option>
									<option data-subtext=" " value="1876">Jamaica (+1876)</option>
									<option data-subtext=" " value="81">Japan (+81)</option>
									<option data-subtext=" " value="962">Jordan (+962)</option>
									<option data-subtext=" " value="7">Kazakhstan (+7)</option>
									<option data-subtext=" " value="254">Kenya (+254)</option>
									<option data-subtext=" " value="686">Kiribati (+686)</option>
									<option data-subtext=" " value="850">Korea, Democratic People's Republic of (+850)</option>
									<option data-subtext=" " value="82">Korea, Republic of (+82)</option>
									<option data-subtext=" " value="965">Kuwait (+965)</option>
									<option data-subtext=" " value="996">Kyrgyzstan (+996)</option>
									<option data-subtext=" " value="856">Lao People's Democratic Republic (+856)</option>
									<option data-subtext=" " value="371">Latvia (+371)</option>
									<option data-subtext=" " value="961">Lebanon (+961)</option>
									<option data-subtext=" " value="266">Lesotho (+266)</option>
									<option data-subtext=" " value="231">Liberia (+231)</option>
									<option data-subtext=" " value="218">Libyan Arab Jamahiriya (+218)</option>
									<option data-subtext=" " value="423">Liechtenstein (+423)</option>
									<option data-subtext=" " value="370">Lithuania (+370)</option>
									<option data-subtext=" " value="352">Luxembourg (+352)</option>
									<option data-subtext=" " value="853">Macao (+853)</option>
									<option data-subtext=" " value="389">Macedonia, the Former Yugoslav Republic of (+389)</option>
									<option data-subtext=" " value="261">Madagascar (+261)</option>
									<option data-subtext=" " value="265">Malawi (+265)</option>
									<option data-subtext=" " value="60">Malaysia (+60)</option>
									<option data-subtext=" " value="960">Maldives (+960)</option>
									<option data-subtext=" " value="223">Mali (+223)</option>
									<option data-subtext=" " value="356">Malta (+356)</option>
									<option data-subtext=" " value="692">Marshall Islands (+692)</option>
									<option data-subtext=" " value="596">Martinique (+596)</option>
									<option data-subtext=" " value="222">Mauritania (+222)</option>
									<option data-subtext=" " value="230">Mauritius (+230)</option>
									<option data-subtext=" " value="269">Mayotte (+269)</option>
									<option data-subtext=" " value="52">Mexico (+52)</option>
									<option data-subtext=" " value="691">Micronesia, Federated States of (+691)</option>
									<option data-subtext=" " value="373">Moldova, Republic of (+373)</option>
									<option data-subtext=" " value="377">Monaco (+377)</option>
									<option data-subtext=" " value="976">Mongolia (+976)</option>
									<option data-subtext=" " value="1664">Montserrat (+1664)</option>
									<option data-subtext=" " value="212">Morocco (+212)</option>
									<option data-subtext=" " value="258">Mozambique (+258)</option>
									<option data-subtext=" " value="95">Myanmar (+95)</option>
									<option data-subtext=" " value="264">Namibia (+264)</option>
									<option data-subtext=" " value="674">Nauru (+674)</option>
									<option data-subtext=" " value="977">Nepal (+977)</option>
									<option data-subtext=" " value="31">Netherlands (+31)</option>
									<option data-subtext=" " value="599">Netherlands Antilles (+599)</option>
									<option data-subtext=" " value="687">New Caledonia (+687)</option>
									<option data-subtext=" " value="64">New Zealand (+64)</option>
									<option data-subtext=" " value="505">Nicaragua (+505)</option>
									<option data-subtext=" " value="227">Niger (+227)</option>
									<option data-subtext=" " value="234">Nigeria (+234)</option>
									<option data-subtext=" " value="683">Niue (+683)</option>
									<option data-subtext=" " value="672">Norfolk Island (+672)</option>
									<option data-subtext=" " value="1670">Northern Mariana Islands (+1670)</option>
									<option data-subtext=" " value="47">Norway (+47)</option>
									<option data-subtext=" " value="968">Oman (+968)</option>
									<option data-subtext=" " value="92">Pakistan (+92)</option>
									<option data-subtext=" " value="680">Palau (+680)</option>
									<option data-subtext=" " value="970">Palestinian Territory, Occupied (+970)</option>
									<option data-subtext=" " value="507">Panama (+507)</option>
									<option data-subtext=" " value="675">Papua New Guinea (+675)</option>
									<option data-subtext=" " value="595">Paraguay (+595)</option>
									<option data-subtext=" " value="51">Peru (+51)</option>
									<option data-subtext=" " value="63">Philippines (+63)</option>
									<option data-subtext=" " value="0">Pitcairn (+0)</option>
									<option data-subtext=" " value="48">Poland (+48)</option>
									<option data-subtext=" " value="351">Portugal (+351)</option>
									<option data-subtext=" " value="1787">Puerto Rico (+1787)</option>
									<option data-subtext=" " value="974">Qatar (+974)</option>
									<option data-subtext=" " value="262">Reunion (+262)</option>
									<option data-subtext=" " value="40">Romania (+40)</option>
									<option data-subtext=" " value="70">Russian Federation (+70)</option>
									<option data-subtext=" " value="250">Rwanda (+250)</option>
									<option data-subtext=" " value="290">Saint Helena (+290)</option>
									<option data-subtext=" " value="1869">Saint Kitts and Nevis (+1869)</option>
									<option data-subtext=" " value="1758">Saint Lucia (+1758)</option>
									<option data-subtext=" " value="508">Saint Pierre and Miquelon (+508)</option>
									<option data-subtext=" " value="1784">Saint Vincent and the Grenadines (+1784)</option>
									<option data-subtext=" " value="684">Samoa (+684)</option>
									<option data-subtext=" " value="378">San Marino (+378)</option>
									<option data-subtext=" " value="239">Sao Tome and Principe (+239)</option>
									<option data-subtext=" " value="966">Saudi Arabia (+966)</option>
									<option data-subtext=" " value="221">Senegal (+221)</option>
									<option data-subtext=" " value="381">Serbia and Montenegro (+381)</option>
									<option data-subtext=" " value="248">Seychelles (+248)</option>
									<option data-subtext=" " value="232">Sierra Leone (+232)</option>
									<option data-subtext=" " value="65">Singapore (+65)</option>
									<option data-subtext=" " value="421">Slovakia (+421)</option>
									<option data-subtext=" " value="386">Slovenia (+386)</option>
									<option data-subtext=" " value="677">Solomon Islands (+677)</option>
									<option data-subtext=" " value="252">Somalia (+252)</option>
									<option data-subtext=" " value="27">South Africa (+27)</option>
									<option data-subtext=" " value="0">South Georgia and the South Sandwich Islands (+0)</option>
									<option data-subtext=" " value="34">Spain (+34)</option>
									<option data-subtext=" " value="94">Sri Lanka (+94)</option>
									<option data-subtext=" " value="249">Sudan (+249)</option>
									<option data-subtext=" " value="597">Suriname (+597)</option>
									<option data-subtext=" " value="47">Svalbard and Jan Mayen (+47)</option>
									<option data-subtext=" " value="268">Swaziland (+268)</option>
									<option data-subtext=" " value="46">Sweden (+46)</option>
									<option data-subtext=" " value="41">Switzerland (+41)</option>
									<option data-subtext=" " value="963">Syrian Arab Republic (+963)</option>
									<option data-subtext=" " value="886">Taiwan, Province of China (+886)</option>
									<option data-subtext=" " value="992">Tajikistan (+992)</option>
									<option data-subtext=" " value="255">Tanzania, United Republic of (+255)</option>
									<option data-subtext=" " value="66">Thailand (+66)</option>
									<option data-subtext=" " value="670">Timor-Leste (+670)</option>
									<option data-subtext=" " value="228">Togo (+228)</option>
									<option data-subtext=" " value="690">Tokelau (+690)</option>
									<option data-subtext=" " value="676">Tonga (+676)</option>
									<option data-subtext=" " value="1868">Trinidad and Tobago (+1868)</option>
									<option data-subtext=" " value="216">Tunisia (+216)</option>
									<option data-subtext=" " value="90">Turkey (+90)</option>
									<option data-subtext=" " value="7370">Turkmenistan (+7370)</option>
									<option data-subtext=" " value="1649">Turks and Caicos Islands (+1649)</option>
									<option data-subtext=" " value="688">Tuvalu (+688)</option>
									<option data-subtext=" " value="256">Uganda (+256)</option>
									<option data-subtext=" " value="380">Ukraine (+380)</option>
									<option data-subtext=" " value="971">United Arab Emirates (+971)</option>
									<option data-subtext=" " value="44">United Kingdom (+44)</option>
									<option data-subtext=" " value="1">United States (+1)</option>
									<option data-subtext=" " value="1">United States Minor Outlying Islands (+1)</option>
									<option data-subtext=" " value="598">Uruguay (+598)</option>
									<option data-subtext=" " value="998">Uzbekistan (+998)</option>
									<option data-subtext=" " value="678">Vanuatu (+678)</option>
									<option data-subtext=" " value="58">Venezuela (+58)</option>
									<option data-subtext=" " value="84">Viet Nam (+84)</option>
									<option data-subtext=" " value="1284">Virgin Islands, British (+1284)</option>
									<option data-subtext=" " value="1340">Virgin Islands, U.s. (+1340)</option>
									<option data-subtext=" " value="681">Wallis and Futuna (+681)</option>
									<option data-subtext=" " value="212">Western Sahara (+212)</option>
									<option data-subtext=" " value="967">Yemen (+967)</option>
									<option data-subtext=" " value="260">Zambia (+260)</option>
									<option data-subtext=" " value="263">Zimbabwe (+263)</option> 
								</select>
							</div>			

						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->


					<div class="box box-solid">
						<div class="box-header with-border">
							<i class="fa fa-whatsapp"></i>

							<h3 class="box-title">Name , WhatsApp Number (one line at a time)</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">

							<div class="form-group">
								<textarea rows="10" class="form-control" name="mobno" placeholder="Enter Mobile Numbers (on separate lines)"><?php if(isset($valueno)){$len=count($valueno); for($i=0;$i<$len;$i++){echo $valueno[$i].'&#13;&#10;';}}?></textarea>
							</div>			

						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box --> 

					<button type="submit" value="NumberConvert" name="convertnumber" class="btn btn-success pull-right">Submit</button>
				</form>

			</div>
		</div>
	</div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><br><input type="text" class="form-control" maxlength="13" name="mobilenumbers[]" placeholder="Enter Mobile Numbers"><a href="javascript:void(0);" class="remove_button" title="Remove Input Box">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

</script>
</body>
</html>