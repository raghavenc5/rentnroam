<?php
$this->load->view("page_elements/header");
?> 

<script type="text/javascript">
            var BASE_URL = '<?php echo base_url().index_page();?>';
        </script>
        <div class="container">
            <div class="row">
                <div class="content-box">
                    <h1>Got a spare room or an entire house?</h1>
                    <h4>Rent and Roam lets you make money renting out your place.</h4>
                </div>
            </div>
        </div>
        <!---<form name ="userinput" action="index.php/form_reader/save_userinput" method="post"> -->
		<?php
                $property_type =''; $roomtype=''; $city=''; $accommodates='';
                
                    if ($this->session->flashdata('errors'))
                    { //change!
                        //echo "<div class='message'>";
                        $data11 = array();
                        $data11[] =  $this->session->flashdata('errors');
                        //print_r($data11);
                        foreach ($data11 as $data)
                        {
                         $property_type = $data['property_type_id'];
						 
                         $roomtype =  $data['room_type_id'];
                         $accommodates = $data['accommodates'];
                         $city =  $data['city'];
                         
                        }
						
                                                                 
                    } 
        ?>
											
									<?php
                                        $user='';
                                        
                                            if ($this->session->flashdata('user_error')){ //change!
                                                //echo "<div class='message'>";
                                                $data11 = array();
                                                $data11[] =  $this->session->flashdata('user_error');
                                                //print_r($data11);
                                                foreach ($data11 as $data)
                                                {
                                                 $user = $data['message'];
												 
                                                                                                
                                                }
												
                                                                                         
                                            }
												if($user)
												{
													echo $user;
												}
                                            ?>		

									<?php
                                        $cityE='';
                                        
                                            if ($this->session->flashdata('city_error')){ //change!
                                                //echo "<div class='message'>";
                                                $data11 = array();
                                                $data11[] =  $this->session->flashdata('city_error');
                                                //print_r($data11);
                                                foreach ($data11 as $data)
                                                {
                                                 $cityE = $data['message'];
												 
                                                
                                                 
                                                }
												
                                                                                         
                                            }
												if($cityE)
												{
													echo $cityE;
												}
                                            ?>
        <style>
            .help-block {
                color: #EA1B64 !important;
                font-weight: bold !important;
            }
        </style>

        <?php $text_a='';
              $text_b='';
        
            if ($this->session->flashdata('auth_text'))
            { 
                $data11 = array();
                $data11[] =  $this->session->flashdata('auth_text');
                //print_r($data11);
                foreach ($data11 as $data)
                {
                 $text_a = $data['status'];   
                 $text_b = $data['message'];             
                }
                if($text_a == 400)
                {


                ?>
                <script>
                window.load_login_popup()
                
                </script>
                                                         
        <?php

                } 
                echo $text_b;   
            }
            
        ?>

        <form ng-controller="frmCreateYourPropertyCtrl" class="form-horizontal" method="post" action="<?php echo base_url();?>host/Createhostproperty" name="create_property_form" id="create_property_form">
            <div class="sec-01">
                <div class="container">
                    <br/>
                    <div class="errorHandler alert alert-danger" style="display:none;">
                        <strong>You have some form errors. Please check below.</strong>
                    </div>
                    <div class="row bor-bottom padding-bot-20">
                        <h3 class="heading-small">Property Type</h3>
						<?php if($property_type){ echo $property_type;} ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group relative-pos">
                                <div ng-hide="PropertyTypeDescVisibility" ng-click="togglePropertyTypeDesc()">
                                    <div class="PropertyTypeDesc arrow_box col-md-2 col-xs-4">
                                        <img class="desc-icon" alt="Image Error" 
                                        ng-src="{{ selectedPropertyIcon }}" 
                                        src="<?php echo base_url();?>public/images/home.png">
                                        {{ selectedProperty }}
                                    </div>
                                    <div class="col-md-6 PropertyTypeDesc text-center">
                                        <p class="text-center">Room type is one of the most important criteria for RNR guests.</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div ng-hide="PropertyTypeVisibility">
                                    <div ng-click="togglePropertyType(button)" ng-repeat="button in buttonsArray" id="{{ button.property_type }}" class="col-md-2 col-xs-12 col-sm-12 custom-radio">
                                        {{ button.property_type }}
                                        <img class="pull-right" alt="Image Error" ng-src="{{ button.images }}"></img>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <select ng-change="togglePropertyTypeOption()" 
                                                ng-model="selectedOption" 
                                                id="other_property_type" 
                                                name="property_type_id" 
                                                class="form-control cup">
                                            <option ng-repeat="option in optionsArray" value="{{ option.property_type_id }}">
                                                {{ option.property_type }}
                                            </option>
                                        </select> -->
                                        <div class="styled-select" style="width: 195px;">     
                                            <select class="form-control"  style="width: 195px;">
                                                <option>Other</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="property_type_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="property_type_container"></div>
                        <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <div class="form-group relative-pos"> <img class="cup-img" src="images/building.png" alt="cup" >
                                   <input type="email" placeholder="Apartment" id="exampleInputEmail2" class="form-control cup">
                                 </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <div class="form-group relative-pos"> <img class="cup-img" src="images/home.png" alt="cup" >
                                   <input type="email" placeholder="House" id="exampleInputEmail2" class="form-control cup">
                                 </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <select class="form-control m-bot15">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="row bor-bottom padding-top-10">
                        <h3 class="heading-small">Room Type</h3>
						<?php if($roomtype == ''){} else{
						echo $roomtype;
						} ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group relative-pos">
                                <div ng-hide="RoomTypeDescVisibility" ng-click="toggleRoomTypeDesc()">
                                    <div class="PropertyTypeDesc arrow_box col-md-2 col-xs-4">
                                        <img class="desc-icon" alt="Image Error" 
                                        ng-src="{{ selectedRoomIcon }}" 
                                        src="<?php echo base_url();?>public/images/home.png">
                                        {{ selectedRoom }}
                                    </div>
                                    <div class="col-md-6 PropertyTypeDesc text-center">
                                        <p class="text-center">Room type is one of the most important criteria for RNR guests.</p>
                                    </div>
                                </div>
                                <div ng-hide="RoomTypeVisibility" 
                                    ng-click="toggleRoomType(dataArray)"
                                    ng-repeat="dataArray in roomData" class="col-md-2 col-xs-12 col-sm-12 custom-radio-room"
                                    tooltip="{{dataArray.title}}"
                                    tooltip-placement="bottom">
                                    {{ dataArray.roomtype }}
                                    <img class="pull-right" alt="Image Error" ng-src="{{ dataArray.images }}">
                                </div>
                                <div id="room_type_error" style="padding-left:640px;"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <!--    <div class="form-group relative-pos"> <img class="cup-img" src="images/door.png" alt="cup" >
                                <input type="email" placeholder="Private Room" id="exampleInputEmail2" class="form-control cup">
                                </div> -->
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <!--<div class="form-group relative-pos"> <img class="cup-img" src="images/bed.png" alt="cup" >
                                <input type="email" placeholder="Shared Room" id="exampleInputEmail2" class="form-control cup">
                                </div>-->
                        </div>
                        <div class="clearfix"></div>
                        <!--
                            <h4 class="position-center private-room padding-bot-20" id="demo2"> You’re renting a private room within a home. <script>
                            function myFunction()
                            {
                            var x1 = document.getElementById("po1").options[po1.selectedIndex].innerHTML;
                            document.getElementById("demo2").innerHTML="You are renting " + x1 +" room";
                            }
                            </script>
                            
                            </h4> -->
                    </div>
                    
                    <div class="row bor-bottom padding-bot-20" id="no_of_rooms_container" style="display:none;">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <h3 class="heading-small">No. of Rooms</h3>
                            <select name="no_of_rooms" id="no_of_rooms" class="form-control m-bot15" disabled = "disabled">
                                <option value="">-Select One-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <div id="no_of_rooms_error"></div>
                        </div>
                    </div>
                    
                    <div class="row bor-bottom padding-bot-20">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4" style="width: 195px;">
                            <h3 id="guestLabel" class="heading-small">No. of Guests</h3>
                                <?php if($accommodates ==''){} else {echo $accommodates;}?>
                            <!-- <select name="accommodates" id="accommodates" class="form-control" >
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10+</option>
                            </select> -->
                            <div class="styled-select" style="width: 195px;">     
                                <select name="accommodates" id="accommodates" class="form-control" style="width: 195px;">
                                    <option value="">-Select One-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10+">10+</option>
                                </select>
                            </div>
                            <div id="accommodates_error"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <h3 id="cityLabel" class="heading-small">Enter location</h3>
							<?php if($city ==''){} else {echo $city;}?>
                            <div class="form-group relative-pos">
                                <!--  <input type="text" placeholder="City" id="exampleInputEmail2" name="city" class="form-control cup"> -->
								
								<?php 
                                        /*    $baseUrl = 'http://104.215.198.240/rentnroam/host/extractMasterCity';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                            
                                            echo  '<select name="city" class="form-control">';    
                                            foreach($jsonDataObject as $common)
                                            {
                                                echo  '<option value='.$common->city_id.'>'.$common->city_name.'</option>';                                            
                                        
                                            } 
                                            echo '</select>';                                      
										*/
                                      ?>  
							
                                <input type="text" 
                                    name="city" 									
                                    ng-model="asyncSelected" 
                                    typeahead="city for city in cities | filter:$viewValue | limitTo:8" 
                                    class="form-control" 
                                    id="citiesInput"
                                    autocomplete="off"
                                    onchange="javascript:$('#city_error').html('');"
                                    style="width: 195px;" />
                                    <?php
                                            $host_id ="";
                                            $userDataFromSession = $this->session->userdata('user');
                                            if ($userDataFromSession)
                                                $host_id = $userDataFromSession['user_id'];
											else
												$host_id = '';
                                     ?>
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $host_id; ?>">
                            </div>
                            <div id="city_error" style="margin-left:10px;"></div>
                        </div>
                    </div>
                    <!-- <a href="#" class="button-pink btn btn-default"> Continue</a> -->
                    <input type="hidden" name="property_type_id" id="property_type_id" value="{{ finalPropertyType }}">
                    <input type="hidden" name="room_type_id" id="room_type_id" value="{{ finalRoomType }}">
					 
                    <input 
                        class="button-pink btn btn-default"
                        type="submit" 
                        id="ctnBtn" 
                        value="Continue" 
                        onclick="return registerUser('<?php echo ($host_id) ? $host_id : null; ?>');" />
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="sec-02 padding-bot-20">
            <div class="container">
                <div class="row padding-top-10">
                    <div class="big-text-outer">
                        <h1 class="jumbo-txt text-center">A Safe & Pleasurable Journey! </h1>
                        <p class="position-center text-center font-16" > Your trip ought to be filled with the peace of mind that you seek, that’s what we believe. <br/>We want to help make this a trip where all you need to focus on is the journey at hand. </p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="sec-02 padding-top-10 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="box-img-outer">
                            <img src="<?php echo base_url()?>public/images/icon-01.png" alt=" ">
                            <h2 class="round-text-heading">Indian<br />Hospitality</h2>
                            <h4 class="color-pink"><a href="#">Know more</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="box-img-outer">
                            <img src="<?php echo base_url()?>public/images/shield.png" alt=" ">
                            <h2 class="round-text-heading">Rentnroam <br />Benefits</h2>
                            <h4 class="color-pink"><a href="#">Know more</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="box-img-outer">
                            <img src="<?php echo base_url()?>public/images/pad.png" alt=" ">
                            <h2 class="round-text-heading">Rentnroam <br />Guarantee</h2>
                            <h4 class="color-pink"><a href="#">Know more</a></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="box-img-outer">
                            <img src="<?php echo base_url()?>public/images/thumb.png" alt=" ">
                            <h2 class="round-text-heading">Home <br />Safety</h2>
                            <h4 class="color-pink"><a href="#">Know more</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
                            
function load_login_popup()
{
	$.post(BASE_URL+'host/load_login_popup',
	  {},
	  function(data)
	  {
		$('#modal_placeholder').html(data);     
		$('#modal_placeholder').modal('show');
	  }); 

	  return this;    
}

function load_registration_popup()
{
	$.post(BASE_URL+'host/load_registration_popup',
	  {},
	  function(data)
	  {
		$('#modal_placeholder').html(data);     
		$('#modal_placeholder').modal('show');
	  });     
}

/***
  * Function to validte the email-id
  **/ 

function validate_email(email_id)
{
  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  if(reg.test(email_id) == false)
	return false;
  else
	return true;    
}
/***
* Function to add the error class to the input fields parent
**/
function add_error_class(input_id,error_text)
{  
	$('#'+input_id).parent().addClass('error');
	if (error_text == undefined) 
	error_text = 'Required field : Please enter value.';
	$('#error_'+input_id).remove();
	var error_html = '<div id="error_'+input_id+'" class="validationError">'+error_text+'</div>';
	$('#'+input_id).parent().append(error_html);
	$('.validationError').on('click',function()
	{
		var id = this.id;
		$('#'+id).parent().removeClass('error');  
		$('#'+id).parent().find('.validationError').fadeOut(1000);
		$('#validation_error').fadeOut(2000);
	});
}
/***
* Function to add the error class to the input fields parent
**/
function remove_error_class(input_id)
{
	$('#'+input_id).parent().removeClass('error');  
	$('#'+input_id).parent().find('.validationError').fadeOut(1000);
	//Hide the error message
	$('#validation_error').fadeOut(2000);
}
/****
* Function to check the login creds
**/
function check_login()
{  
	var email_id = $('#email_id').val();
	var password = $('#password').val();
	var error_flag = 0; 
	//Check the validation
	if (email_id == '')
	{
	add_error_class('email_id','Please enter the <strong>Email-Id</strong>.');
	error_flag = 1; 
	}
	else if(email_id != '' && validate_email(email_id) == false)
	{
	add_error_class('email_id','Please enter the valid <strong>Email-Id</strong>.');
	error_flag = 1; 
	}
	if (password == '')
	{
	add_error_class('password','Please enter the <strong>Password</strong>.');
	error_flag = 1; 
	}

	if(error_flag != 1) 
	{
	$.post(BASE_URL+'host/doLogin',
	{
		'email_id' : email_id,
		'password' : password
	},
	function(data)
	{
	error_msg = '';
	if (data == 'error') {
	  error_msg = "Login failed. Please try again.";
	  $('#validation_error_text').html(error_msg);
	  $('#validation_error').show();
	}
	else if(data == 'loginSuccess') {     
	  //window.location.reload(); //Refersh The page to set the session and update the task accordigly
			$('#modal_placeholder').modal('hide');
		 window.location = BASE_URL;
	}
	});
	}
}//end of the function
/***
 * Function to register
 **/
function sign_up()
{
  var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
  var reg_email_id  = $('#reg_email_id').val();
  var reg_password  = $('#reg_password').val();
	var phone_number = $('#phone_number').val();
  var confirm_password = $('#confirm_password').val();
  var error_flag = 0; 
  
  if(first_name == '')
  {
	add_error_class('first_name','Please enter the  <strong>First name </strong>.');
	error_flag = 1; 
  }
  if(last_name == '')
  {
	add_error_class('last_name','Please enter the  <strong>Last name </strong>.');
	error_flag = 1; 
  }
  if(reg_email_id == '')
  {
	add_error_class('reg_email_id','Please enter the  <strong>Email-Id</strong>.');
	error_flag = 1; 
  }
	else if(reg_email_id != '' && validate_email(reg_email_id) == false)
  {
	add_error_class('reg_email_id','Please enter the <strong> valid Email-Id </strong>.');
	error_flag = 1; 
  }
  
  if(reg_password == '') 
	{
	add_error_class('reg_password','Please enter the  <strong>Password</strong>.');
	error_flag = 1;   
  }
	if(confirm_password == '') 
	{
	add_error_class('confirm_password','Please enter the  <strong>Password</strong>.');
	error_flag = 1;   
  }
	if(reg_password != confirm_password )
	{
	  add_error_class('reg_password','Please enter the  <strong>  Password </strong>.');
	   add_error_class('confirm_password','Please retype the  <strong> Password </strong>.');
	  error_flag = 1;
	}
  
  if(error_flag != 1)
  {
  $.post(BASE_URL+'host/signupUser',
  {
	'first_name':first_name,
		'last_name':last_name,
	'reg_email_id' : reg_email_id,  
	'password' : reg_password
  },
  function(data)
  {
	error_msg = '';
	if (data == 'duplicate_error') {
	  error_msg = "Email-Id already present.";
	  $('#reg_validation_error_text').html(error_msg);
	  $('#reg_validation_error').show();
	}
	else if(data == 'success') {
	 
	 $('#modal_placeholder').modal('hide');
		 window.location = BASE_URL;
	}
  });
 }
}
</script>
           
<div class="modal fade registrationModal" id="modal_placeholder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  
</div>
<?php
echo $this->load->view('page_elements/footer');
?>