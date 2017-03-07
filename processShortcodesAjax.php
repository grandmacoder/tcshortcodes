<?php
if(!isset($wpdb))
{
    require_once('../../../wp-config.php');
    require_once('../../../wp-load.php');
    require_once('../../../wp-includes/wp-db.php');
	require_once( '../../../wp-admin/includes/image.php' );
	require_once('../../../wp-admin/includes/file.php' );
	require_once( '../../../wp-admin/includes/media.php' );
}
global $wpdb;
$activityid = $_GET['activityid'];
$activitytext = $_GET['activitytext'];
$description = $_GET['description'];
$userid = $_GET['userid'];
$postid = $_GET['postid'];
$pageorder =  $_GET['formorder'];

$districtaction=$_POST['districtaction'];
$current_user = wp_get_current_user();
$action= $_POST['action'];
//use a get on file attachment downloads 
if ($_GET['action'] =='zipattachments'){
$postid = $_GET['postid'];
$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => -1,
			'post_parent' => $postid,
			'exclude'     => get_post_thumbnail_id()
		) );
$i=0;
foreach($attachments as $attached){
$aFileIDs[$i] = $attached->ID;
$i++;
}	
$files = array();
for ($i=0; $i<count($aFileIDs); $i++){
$filepath =get_attached_file( $aFileIDs[$i] );	
$files[$i]=  $filepath;
}
# create new zip opbject
$zip = new ZipArchive();
$filename = "attachments_".time().".zip";
$filepath = "/home/transcoalition/webapps/transitioncoalition_wp/wp-content/uploads/attachment_zip/";
# create a temp file & open it
$res = $zip->open($filepath.$filename, ZipArchive::CREATE);
if ($res === TRUE) {
# loop through each file
foreach($files as $file){
    # download file
    $download_file = file_get_contents($file);
    #add it to the zip
   $zip->addFromString(basename($file),$download_file);
}
}
# close zip
$zip->close();
$filesize=filesize($filepath.$filename);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$filename."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$filesize);
ob_end_flush();
@readfile($filepath.$filename);
//now delete the file
unlink($filepath.$filename);
}

if(isset($_FILES["tc_file_upload"])){
	$postid = $_POST['post_id'];
    $attachment_id = media_handle_upload("tc_file_upload", $postid); 
	if(is_wp_error($attachment_id)){
	    return print(0);
	}else{
	return print(1);
	}
}
if(isset($_FILES["share-file-upload"])){
    $userid = $_POST['userid'];
	$postid = $_POST['postid'];
	$resourcedescription = $_POST['file-description'];
	$resourcetitle = $_POST['file-title'];
	$simple_link_category=$_POST['simple_link_category'];
    $attachment_id = media_handle_upload("share-file-upload", $postid); 
	if(is_wp_error($attachment_id)){
	$returnvars=array('attachment_id'=>0);
	print json_encode($returnvars);	
	}else{
	$attachmentposturl=get_the_guid($attachment_id);
	$endStr=substr($attachmentposturl,(strlen($attachmentposturl)-5), strlen($attachmentposturl));
    if(strpos($endStr,'doc')){$link_style="doc-ico";}
		elseif(strpos($endStr,'pdf')){$link_style="pdf-ico";}
			elseif(strpos($endStr,'pps')){$link_style="pps-ico";}
		//		else{$link_style="web-ico";}      
	//create a simple link with 
	// Create post object
    $simplelink_post = array(
    'post_title'    => wp_strip_all_tags( $resourcetitle ),
    'post_content'  => wp_strip_all_tags($resourcedescription),
    'post_status'   => 'publish',
    'post_author'   => $userid,
    'post_type'     =>'simple_link',
    'comment_status' =>'closed',
   );
	 // Insert the post into the database
	$simplelinkpostid= wp_insert_post( $simplelink_post );
	add_post_meta( $simplelinkpostid, 'description', wp_strip_all_tags($resourcedescription) );
	add_post_meta( $simplelinkpostid, 'web_address',  $attachmentposturl);
	$categories=array((int)$simple_link_category);	
	wp_set_object_terms($simplelinkpostid,$categories, 'simple_link_category' );
	$category=get_term($simple_link_category,'simple_link_category');
	$category_name =$category->name;
	$userfirstname = get_user_meta( $userid,'first_name', true );   
	$userlastname = get_user_meta( $userid,'last_name', true );
	//get the avatar
	$user_avatar=get_user_meta ($userid, 'wp_user_avatar', true);
	if ($user_avatar > 0){
	$avatarpath = get_the_guid($user_avatar);
	}
	 else{
	 $avatarpath ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
	}
	$resourcedescription =stripslashes($resourcedescription);
	$returnvars = array(
	    'attachment_id'=>$attachment_id,
		'resourcecategory' =>$category_name,
		'resourcelink' => $attachmentposturl,
		'resourcetitle' =>wp_strip_all_tags($resourcetitle),
		'resourcedescription' =>wp_strip_all_tags($resourcedescription),
		'resourcepostid' =>$postid,
		'userfirstname' =>$userfirstname,
		'userlastname' => $userlastname,
		'avatarpath' => $avatarpath,
		'linkstyle'=>$link_style,
		);
		print json_encode($returnvars);
		exit();
	}
}
if (isset($_FILES["file-upload"])){
    $userid = $_POST['userid'];
	$postid = $_POST['postid'];
	$name1 = $_POST['name1'];
	$name2 = $_POST['name2'];
	$application =  $_POST['application'];
	$name1=str_replace(" ","",$name1);
	$name2=str_replace(" ","",$name2);
	if ($application=="selfstudy"){
	$userdistrict = get_user_meta( $userid,'school_district', true );
	$userdistrict=str_replace(" ", "",$userdistrict);
    $changename	= $userdistrict."_". $name1 ."_".$name2."_".date('Y-m-d-hms');	
	}
	else{
	 $changename=$name1 ."_".$name2."_".date('Y-m-d-hms');	
	}	
      $file_name = $_FILES['file-upload']['name'];
      $file_size =$_FILES['file-upload']['size'];
      $file_tmp =$_FILES['file-upload']['tmp_name'];
      $file_type=$_FILES['file-upload']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file-upload']['name'])));
	  $expensions= array("jpeg","jpg","png","doc","docx","pdf","xls","xlsx");
	if(in_array($file_ext,$expensions)=== false){
        $error="Sorry we only accept jpeg,jpg,png,doc, docx, pdf,xls, and xlsx files.";
      }
	if($file_size > 4097152){
         $error.='<br>Sorrym, your file is greater than 40MB. Please reduce the size and try again.';
      }
    if($error <> ""){
	$returnvars=array('attachment_id' => 0,'errormsg'=>$error,);
	print json_encode($returnvars);		
	}else{
	$uploads = wp_upload_dir();
    $uploadpath = $uploads['path'];
	$uploadurl=$uploads['url'];
	$filenamepath=$uploadpath."/".$changename.".".$file_ext;
	$filenameurl=$uploadurl."/".$changename.".".$file_ext;
    $moved = move_uploaded_file($file_tmp,$filenamepath);
	//create an attachment post
	$attachment = array(
	'guid'           => $filenameurl, 
	'post_mime_type' => $file_type,
	'post_title'     => preg_replace( '/\.[^.]+$/', '', $changename ),
	'post_content'   => '',
	'post_status'    => 'inherit'
    );
	$attachment_id=wp_insert_attachment( $attachment, $filenamepath, $postid );
	//get return variables
	$attachmentposturl=get_the_guid($attachment_id);
	$attachmentpost=get_post($attachment_id);
	$attachmenttitle=$attachmentpost->post_title;
	$attachmentdate=$attachmentpost->post_date;
    $userfirstname = get_user_meta( $userid,'first_name', true );   
	$userlastname = get_user_meta( $userid,'last_name', true );
	//get the avatar
	$user_avatar=get_user_meta ($userid, 'wp_user_avatar', true);
	if ($user_avatar > 0){
	$avatarpath = get_the_guid($user_avatar);
	}
	 else{
	 $avatarpath ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
	}
	//create html for appending and return to jquery
	$returnvars = array(
	    'attachment_id'=>$attachment_id,
		'resourcelink' => $attachmentposturl,
		'resourcetitle' => $attachmenttitle,
		'resourcedate' => $attachmentdate,
		'resourcepostid' =>$postid,
		'userfirstname' =>$userfirstname,
		'userlastname' => $userlastname,
		'avatarpath' => $avatarpath,
		);
	print json_encode($returnvars);
    }

}
elseif ($_POST['action']=='deleteUploadedFile'){
$attachmentid= $_POST['attachmentid'];
if ( false === wp_delete_attachment( $attachmentid,true ) ){ 
	$returnvars=array('deletemessage'=>"There was a problem deleting the file.");
	print json_encode($returnvars);	
}
	$returnvars=array('deletemessage'=>"Your file was deleted.", 'attachmentid'=>$attachmentid);
	print json_encode($returnvars);	
}
//this is called from js in the courseware plugin to check for if there are activity answers and if so, did they complete all the 
//answers for the course unit
else if ($_POST['action'] =='checkValidCompletion'){
$post_id=$_POST['post_id'];
$userID =$current_user->ID;
$numactivitiesonscreen = $_POST['numactivitiesonscreen'];
//check for acitvities completed
if ($numactivitiesonscreen > 0){
//if the num matches the num saved all is good
$numactivitiescompleted = $wpdb->get_var($wpdb->prepare("Select count(*) from wp_course_activities where post_id = %d and user_id = %d and page_order > %d and description <> ''", $post_id, $userID, 0));
//$sql= $wpdb->last_query;
			if ($numactivitiescompleted < $numactivitiesonscreen ){
			$valid= 0;
			}
			else{
			$valid =1;	
			}
}
$returnvars = array(
	"valid" =>$valid,
	);
print json_encode($returnvars);
}
//identity web activity is different than regular activity text questions
else if ($action == 'identityWebAnswer'){
$postID =7609;
$userID =$current_user->ID;
$order= $_POST['order'];
$answer = $_POST['answer'];
$description= $_POST['description'];
$activityID = $wpdb->get_var($wpdb->prepare("select activity_id from wp_course_activities where page_order=%d and post_id=%d and user_id = %d",$order,$postID,$userID));
if ($activityID > 0){ //update

$rows = $wpdb->update ( 
	'wp_course_activities', 
	array( 
		'post_id' =>  $postID,	// string
		'user_id' => $userID,	// integer (number) 
		'page_order'=>$order,
		'activity_value'=>$answer,
		'updated_dt'=> date("Y-m-d H:i:s"),
		'description'=>$description
	), 
	array( 'activity_id' => $activityID ), 
	array( 
		'%d','%d', '%d','%s','%s','%s'
	), 
	array( '%d' ) 
);
}
else{//insert
$rows=$wpdb->query( $wpdb->prepare( 
	"INSERT INTO wp_course_activities
	( post_id, user_id, page_order, activity_value, entry_dt, updated_dt, description)
	VALUES ( %d, %d, %d, %s, %s, %s, %s)
	", 
        array(
		7609,
		$userID,
		$order,
		$answer,
		date("Y-m-d H:i:s"),
		'0000-00-00 00:00:00',
		$description,
	) 
) );
}
if ($rows > 0){
echo "success";
}
else{
echo "fail";
}
}
//user likes a resource on LERN
else if ($_POST['action'] == 'like_a_resource'){
$post_id = $_POST['post_id'];
$numlikes = get_post_meta($post_id, 'resource_likes', true);
if ($numlikes == ""){
	$numlikes=1;
	add_post_meta($post_id, 'resource_likes', $numlikes, true);
}
else{
	//get a cookie
	$alreadyvoted=$_COOKIE[$post_id];
	if ($alreadyvoted <> 1){
	$numlikes++;
	update_post_meta($post_id, 'resource_likes', $numlikes, $numlikes-1); 
	$cookie_name = $post_id ;
	$cookie_value = 1;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 360), "/"); 
}
}
$returnvars = array(
	"numlikes" => $numlikes, 
    "post_id" => $post_id,
    "alreadyvoted"	=> $alreadyvoted,
	);
print json_encode($returnvars);
}
//user adds a website as a simple link (LERN)
else if ($_POST['action'] =='createwebsiteresource'){
$website=$_POST['website'];
$resourcetitle=$_POST['resource-title'];
$simple_link_category = $_POST['simple_link_category'];
$resourcedescription=$_POST['resource-description'];
$userid=$_POST['userid'];
$googletracking=$_POST['googletracking'];
$endStr=substr($website,(strlen($website)-5), strlen($website));
    if(strpos($endStr,'doc')){$link_style="doc-ico";}
		elseif(strpos($endStr,'pdf')){$link_style="pdf-ico";}
			elseif(strpos($endStr,'pps')){$link_style="pps-ico";}
				else{$link_style="web-ico";}      
// Create post object
$simplelink_post = array(
  'post_title'    => wp_strip_all_tags( $resourcetitle ),
  'post_content'  => wp_strip_all_tags($resourcedescription),
  'post_status'   => 'publish',
  'post_author'   => $userid,
  'post_type'     =>'simple_link',
  'comment_status' =>'closed',
);
 // Insert the post into the database
$postid= wp_insert_post( $simplelink_post );
add_post_meta( $postid, 'description', wp_strip_all_tags($resourcedescription) );
add_post_meta( $postid, 'web_address',  $website);
$categories=array((int)$simple_link_category);	
wp_set_object_terms($postid,$categories, 'simple_link_category' );
$category=get_term($simple_link_category,'simple_link_category');
$category_name =$category->name;
$userfirstname = get_user_meta( $userid,'first_name', true );   
$userlastname = get_user_meta( $userid,'last_name', true );
//get the avatar
$user_avatar=get_user_meta ($userid, 'wp_user_avatar', true);
if ($user_avatar > 0){
$avatarpath = get_the_guid($user_avatar);
}
 else{
 $avatarpath ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
}

//create html for appending and return to jquery
$returnvars = array(
	'resourcecategory' =>$category_name,
    'linkstyle' => $link_style,
    'resourcelink' => $website,
    'resourcetitle' =>wp_strip_all_tags($resourcetitle),
    'resourcedescription' =>wp_strip_all_tags($resourcedescription),
    'resourcepostid' =>$postid,
	'userfirstname' =>$userfirstname,
	'userlastname' => $userlastname,
	'avatarpath' => $avatarpath,
    'numlikes' => 0,	
	);
print json_encode($returnvars);
}
else if ($_POST['action'] == 'get_num_activities'){
$postid=$_POST['postid'];
$userid=$_POST['userid'];
$num_completed=0;
if ($userid > 0){
$num_completed = $wpdb->get_var($wpdb->prepare("Select count(*) from wp_course_activities where post_id=%d and user_id=%d", $postid,$userid));
}
$num_activities = $wpdb->get_var($wpdb->prepare("select meta_value from wp_postmeta where meta_key='%s' and post_id=%d",'number_of_activities',$postid));
$returnvars = array(
	"num_activities" => $num_activities, 
    "num_completed"=>$num_completed,	
	);
print json_encode($returnvars);
}
elseif ($_POST['action'] == 'checkTextboxAnswers'){
$postID=$_POST['post_id'];
//get the number of activities for this post and loop through the corresponding text area on the screen.
$num_items = get_post_meta( $postID, 'number_of_activities',true);
if ($num_items > 0){
	$activities=$wpdb->get_results($wpdb->prepare("Select * from wp_course_activities where post_id =%d and user_id =%d", $postID, $current_user->ID, OBJECT));
	$numCompletedActivities = $wpdb->num_rows;
	if ($numCompletedActivities < $num_items){
	$bNotValid = 1;
	}
	foreach ($activities as $row){
        if ( strlen($row->activity_value) == 0){
		$bNotValid = 1;
		}
	}
	if ($bNotValid  > 0){
	$returnvars = array(
		   "message" => '0',	   
	);
	}
	else{
	$returnvars = array(
     "message" => '1',	   
	);
	}
}
else{ //return true because this does not apply to this post.

$returnvars = array(
	"message" => '1',	   
	);
}
print json_encode($returnvars);
}
//save checked items
elseif ($_POST['action'] == 'save_checklist'){
$selectedItems = $_POST['selected_items'];
$post_id = $_POST['post_id'];
$activity_id = $_POST['activity_id'];
$num_checklist_items = $_POST['num_checklist_items'];
if ($activity_id > 0){ //update
//$sql = "Update wp_course_activities set activity_value='". $selectedItems ."',updated_dt=now() where activity_id =". $activity_id;
//$wpdb->query($sql);
$rows = $wpdb->update ( 
	'wp_course_activities', 
	array( 
        'activity_value'=>$selectedItems,
		'updated_dt'=> date("Y-m-d H:i:s"),
	), 
	array( 'activity_id' => $activity_id ), 
	array( 
		'%s','%s'
	), 
	array( '%d' ) 
);
}
else{ //insert
$sql = "Insert into wp_course_activities (post_id, user_id,page_order,activity_value,entry_dt, updated_dt) 
VALUES (".$post_id.",". $current_user->ID.",0,'". $selectedItems."',CURRENT_TIMESTAMP, now())";
$wpdb->query($sql);	
$activity_id = $wpdb->insert_id;
$rows=$wpdb->query( $wpdb->prepare( 
	"INSERT INTO wp_course_activities
	( post_id, user_id, page_order, activity_value, entry_dt, updated_dt)
	VALUES ( %d, %d, %d, %s, %s, %s)
	", 
        array(
		$post_id,
		$current_user->ID,
		0,
		$selectedItems,
		date("Y-m-d H:i:s"),
		'0000-00-00 00:00:00',
	) 
) );
}
$returnvars = array(
	   "message" => 'The checked items on your list were saved.',
	   "activity_id" => $activity_id,
           "selected_items"=>$selectedItems,
           "num_choices" => $num_choices,
           "num_checklist_items" =>$num_checklist_items,	   
);
print json_encode($returnvars);
}
//compare checked items with correct items
else if ($_POST['action'] == 'compare_checkbox_items'){
$selectedItems = $_POST['selected_items'];
$matrix_name =$_POST['matrix_name'];

$aCompareFrom= array();
$CompareFromString="";
$sReturnStr="";
//get the correct items from the database
$correctMatrixRows = $wpdb->get_results($wpdb->prepare("Select * from wp_course_matrix  where matrix_name ='%s' and heading = '%s'",$matrix_name, 'Correct', OBJECT));
$aCompareFrom=explode(",",$selectedItems);

foreach ($correctMatrixRows as $row){
$sCorrectItems .= $row->item_id .",";	
}
$aCompareTo= explode(",", $sCorrectItems);
$aDifference = array_diff($aCompareFrom  , $aCompareTo);
if (count($aDifference) > 0){
$sReturnStr.="It looks like you selected some items that were not correct.<br><strong>Please take note!</strong> <br>Incorrect items are highlighted with red and should not be checked. Items highlighted with green are correct.";
} 
else{
$sReturnStr.="Each of your selections was correct. Way to go.";
}
$incorrectMatrixRows= $wpdb->get_results($wpdb->prepare("Select * from wp_course_matrix  where matrix_name ='%s' and heading = '%s'", $matrix_name,'Incorrect',OBJECT));
foreach ($incorrectMatrixRows as $row){
$sIncorrectItems.= $row->item_id .",";
}
$returnvars = array(
	   "message" => $sReturnStr,
	   "correctIDs" =>$sCorrectItems,
       "incorrectIDs" =>$sIncorrectItems,	  
);
print json_encode($returnvars);
}
//get the matrix data for a sorting matrix
elseif ($_POST['action']  == 'get_vertical_matrix_data'){
$matrix_name =$_POST['matrix_name'];
$col1=array();
$col2=array();
$totalDraggable =0;

$col_rows = $wpdb->get_results($wpdb->prepare("Select * from wp_course_matrix where matrix_name ='%s' order by item_id",$matrix_name, OBJECT));
$totalDraggable = $wpdb->num_rows;
$i =1;
$col1Items = "";
$col2Items ="";
foreach ($col_rows as $row){
if ($row->column_number == 1){ 
$col1Items .="draggable-" . $i .",";
}
else{
$col2Items .="draggable-" . $i .",";
}
$i++;
}
$col1Items =substr($col1Items,0,-1);
$col2Items =substr($col2Items,0,-1);
$returnvars = array(
	  "col1items" => $col1Items,
	  "col2items" => $col2Items,
	  "totalDraggable" => $totalDraggable,
);
print json_encode($returnvars);
}
//get the matrix data for a sorting matrix
elseif ($action  == 'get_matrix_data'){
$matrix_name =$_POST['matrix_name'];
$num_cols= $wpdb->get_var($wpdb->prepare("SELECT max(column_number) from wp_course_matrix where matrix_name ='%s'",$matrix_name ));
$matrix_rows = $wpdb->get_results($wpdb->prepare("Select * from wp_course_matrix where matrix_name ='%s' order by column",$matrix_name, OBJECT));
}
//set qi role
elseif ($action == 'set_qi_role_meta'){
update_user_meta($current_user->ID, 'qi_survey_role', $_POST['qi_role']);
if ($_POST['qi_role'] =='Other'){
update_user_meta($current_user->ID, 'qi_other_val', '');
}
else{
delete_user_meta( $current_user->ID, 'qi_other_val');
}
echo "success";
}
//set the qi other role desription
elseif ($action =='set_qi_otherrole_meta'){
update_user_meta($current_user->ID, 'qi_other_val', $_POST['other_val']);
}
//set school district KS MO GA
elseif ($districtaction == 'set_district_meta'){
$returnval ="";
$district = $_POST['district'];
$state = $_POST['state'];
if ($state == 'KS'){ $meta_key='ks_school_district';}
elseif ($state =='MO'){ $meta_key='mo_school_district'; }
elseif ($state == 'GA'){$meta_key='ga_school_district';};
$rows = $wpdb->update ( 
	'wp_usermeta', 
	array( 
		'meta_value' =>  $district,	// string
	), 
	array( 'user_id' => $activityID,'meta_key'=> $meta_key), 
	array( 
		'%s'
	), 
	array( '%d', '%s') 
);

$returnvars = array(
	  "updated" => $returnval,
);
print json_encode($returnvars);
}

//set the activity answer from modules
elseif ($activityid > 0 && !is_null($activityid)){
//update the db  
	$currentText=$wpdb->get_var($wpdb->prepare("Select activity_value from wp_course_activities where  activity_id =%d",$activityid));
	if ($currentText <> $activitytext){
	$rowsAffected = $wpdb->update ( 
	'wp_course_activities', 
	array( 
		'page_order'=>$pageorder,
		'activity_value'=>$activitytext,
		'updated_dt'=> date("Y-m-d H:i:s"),
		'description'=>$description,
	), 
	array( 'activity_id' => $activityid ), 
	array( 
		'%d','%s','%s','%s'
	), 
	array( '%d' ) 
);
	
//get the total user activities that have beens saved
$numCompletedActivities = $wpdb->get_var($wpdb->prepare("Select count(*) from wp_course_activities where post_id=%d and user_id=%d", $post_id,$userid));
	$returnvars = array(
				 "formorder" => $pageorder,
				  "activityid" => $activityid,
				  "postid" => $postid,
				  "userid" => $userid,
				  "activitytext"=> stripslashes($activitytext),
				  "activitytextbreaks"=>nl2br($activitytext),
				  "rowsaffected" => $rowsAffected ,
				  "numanswers" => $numCompletedActivities,
	);
	print json_encode($returnvars);
	}
}
elseif ($activityid <= 0){ 
if (strlen($activitytext) > 3){ 
$rows=$wpdb->query( $wpdb->prepare( 
	"INSERT INTO wp_course_activities
	( post_id, user_id, page_order, activity_value, entry_dt, updated_dt, description)
	VALUES ( %d, %d, %d, %s, %s, %s, %s)
	", 
        array(
		$postid,
		$userid,
		$pageorder,
		$activitytext,
		date("Y-m-d H:i:s"),
		'0000-00-00 00:00:00',
		$description,
	) 
) );

$activityid = $wpdb->insert_id;
$rowsAffected =  $wpdb->rows_affected;
//get the total user activities that have beens saved
$numCompletedActivities = $wpdb->get_var($wpdb->prepare("Select count(*) from wp_course_activities where post_id=%d and user_id =%d", $postid, $userid));
$returnvars = array(
      "formorder" => $pageorder,
      "activityid" => $activityid,
      "postid" => $postid,
      "userid" => $userid,
      "activitytext"=> stripslashes($activitytext),
	  "activitytextbreaks"=>nl2br($activitytext),
      "rowsaffected" => $rowsAffected ,
	  "numanswers" => $numCompletedActivities,
);
}
else{
//get the total user activities that have beens saved
$numCompletedActivities = $wpdb->get_var($wpdb->prepare("Select count(*) from wp_course_activities where post_id=%d and user_id=%d", $postid, $userid));
$returnvars = array(
      "formorder" => $pageorder,
      "activityid" => $activityid,
      "postid" => $postid,
      "userid" => $userid,
      "activitytext"=> stripslashes($activitytext),
	  "activitytextbreaks"=>nl2br($activitytext),
      "rowsaffected" => 0,
	  "numanswers" => $numCompletedActivities,
);
}
print json_encode($returnvars);
}
?>