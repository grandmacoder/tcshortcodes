<?php
   /*
   Plugin Name: TC shortcodes
   Plugin URI: http://www.amyjocarlson.com
   Description: a plugin that adds shortcodes for Transition Learning modules
   Version: 1.2
   Author: Amy Carlson
   Author URI: http://www.amyjocarlson.com
   License: GPL2
   */
 //enqueue scripts and css
 
 
function tcshortcodes_scripts_with_jquery(){
    // Register the script like this for a plugin:
    wp_register_script( 'tcshortcode-custom-script', plugins_url( '/js/jquery.customshortcode.js', __FILE__ ), array( 'jquery' ) );
   // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'tcshortcode-custom-script' );
 // Register the script like this for a plugin:
    wp_register_script( 'tcshortcode-textarea-script', plugins_url( '/js/jquerycustomtextareas.js', __FILE__ ), array( 'jquery' ) );
   // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'tcshortcode-textarea-script' );	 
}
add_action( 'wp_enqueue_scripts', 'tcshortcodes_scripts_with_jquery' );

function tcshortcodes_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'tcshortcodecustom-style', plugins_url( '/css/tcshortcodestyle.css', __FILE__ ), array(), '20120208', 'all' );
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'tcshortcodecustom-style' );
}
add_action( 'wp_enqueue_scripts', 'tcshortcodes_styles' );

//**************************************************************************************************
//add the shortcodes
/* this shortcode allows for up to 8 text area forms on a post or page that toggles with the user's 
answer that has been saved or creates a new record
*/

add_shortcode('createJSContact', 'tcs_create_JC_contact');
add_shortcode('embedGAvideoTracking','tcs_embed_GAvideoTracking');
add_shortcode('createActivityText', 'tcs_create_text_form');
add_shortcode('createCustomPopup', 'tcs_create_custom_popup');
add_shortcode('createBasicCustomPopup', 'tcs_create_basic_custom_popup');
add_shortcode('createLinkPopup','tcs_create_link_popup');
add_shortcode('createImagePopup','tcs_create_image_popup');
add_shortcode('createChecklist','tcs_create_checklist');
add_shortcode('getActivityAnswer','tcs_get_activity_answer');
add_shortcode('createTimer', 'tcs_create_timer');

//these shortcodes are basically widget like items for interactive components used on learning modules
add_shortcode('createMatchingMatrix', 'tcs_create_matching_matrix');
add_shortcode('createVerticalMatrix', 'tcs_create_vertical_matrix');
add_shortcode('createHorizontalMatrix', 'tcs_create_horizontal_matrix');
add_shortcode('createCheckboxMatrix', 'tcs_create_checkbox_matrix');
add_shortcode('createMatchingQuiz','tcs_create_matching_quiz');
add_shortcode('toggleReadMore', 'tcs_toggle_read_more_content');
add_shortcode('clickAndReveal','tcs_click_and_reveal');
add_shortcode('clickTextReveal','tcs_click_text_reveal');
add_shortcode('yesno','tcs_yes_no');
add_shortcode('clickPicReveal', 'tcs_click_pic_reveal');
add_shortcode('toggleOpen','tcs_toggle_open');
add_shortcode('createFamilyAsMobile', 'tcs_create_family_mobile');
//LERN module 
add_shortcode('getDiscussionLinks','tcs_get_dc_links');
add_shortcode('createhiddenroster','tcs_create_hidden_roster');
add_shortcode('createhiddenchecklistresults','tcs_create_hidden_checklist_results');
add_shortcode('createhiddentextactivity', 'tcs_create_hidden_activity_text');
add_shortcode('shareuploadresources','tcs_share_upload_resource');
add_shortcode('addcomments','tcs_add_comments');


//js includes for a particular page
add_shortcode('addjsprint', 'tcs_addjsprint');
add_shortcode('getReflectionAndImplementationPlan', 'tcs_get_reflection_and_plan');
add_shortcode('createWebMap','tcs_create_webmap');
add_shortcode('createWebMapComplete','tcs_create_webmap_complete');
add_shortcode('createContactLink', 'tcs_create_contact_link');

add_shortcode('getCurrentCourses', 'tcs_get_user_courses');
//shortocodes used by admin
add_shortcode('getUsersGroup','tcs_get_users_group');
add_shortcode('privateCommentSection','tcs_private_comment_section');
add_shortcode('processError', 'tcs_process_error');
add_shortcode('getQiRoleList','tcs_get_qi_role_list');
add_shortcode('getQiDistrictList','tcs_get_qi_district_list');
add_shortcode('showUploadedFiles','tcs_show_uploaded_files');


add_shortcode('insertFileUploader', 'tcs_file_uploader');
//uploader with file rename
add_shortcode('addafile', 'tcs_add_a_file');
//show the table with the uploaded files in it
add_shortcode('showfiletable','tcs_show_file_table');
//download attached files
add_shortcode('downloadattachments', 'tcs_download_attachments');
//add Google Analytics video tracking with wid and entry id
function tcs_embed_GAvideoTracking($atts,$content=null){
$entry_id = $atts['entry_id'];
$wid=$atts['wid'];
$content ='<script src="https://cdnapisec.kaltura.com/p/368641/sp/36864100/embedIframeJs/uiconf_id/36818192/partner_id/368641?entry_id='.$entry_id.'&playerId=kaltura_player_1469023199"></script>
<div style="width: 75%; height: auto; display: inline-block;position: relative;"> 
<div id="dummy" style="margin-top: 56.25%;"></div>
<div id="kaltura_player_1469023199" style="width:100%; height: 95%; position:absolute;top:0;left:0;left: 0;right: 0;" itemprop="video" itemscope itemtype="http://schema.org/VideoObject" >
</div>
</div>	
<script>
	kWidget.embed({
        "autoPlay": true,
        "autoMute": true,
		targetId: "kaltura_player_1469023199",
		wid: "'.$wid.'",
		uiconf_id: "36818192",
		entry_id: "'.$entry_id.'",
		flashvars: {
            "autoPlay": true,
            "autoMute": true,
			"googleAnalytics": {
				"plugin" : true,
				"position" : "before",
				"urchinCode" : "UA-1678035-1",
				"anonymizeIp" : false,
				"customEvent" : "doPlay",
                "doPlayCategory" : "Webinar",
                "doPlayAction" : "playing",
       			"doPlayLabel" : "Label for event",
				"doPlayValue" : "",
				"relativeTo" : "video"
                			}
		}
})
</script>';
return $content;	
}
//add a button to facilitate downloading of attachments to a post
function tcs_download_attachments($content){
$ID = get_the_ID();
if (current_user_can( 'manage_options' )){ 
$content='<input  type="button" class='.$ID.' id="zipattachments" name="btnDownloadAttachmentsZip" value="Download zip file">';
}
return $content;
}
//shows the attachments for this post in a table.
function tcs_show_file_table($atts,$content=null){
$current_userID = get_current_user_id();
$ID = get_the_ID();	
$userhasaccess = 0;
//if the user is an administrator
if (current_user_can( 'manage_options' )){ $userhasaccess=1; }
$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => -1,
			'post_parent' => $ID ,
			'exclude'     => get_post_thumbnail_id()
) );

if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
	        $user_firstname = get_user_meta( $attachment->post_author,'first_name', true );  
			$user_lastname = get_user_meta( $attachment->post_author,'last_name', true );
			$user_avatar=get_user_meta ($attachment->post_author, 'wp_user_avatar', true);
			$file_owner = $attachment->post_author;
		    if ($user_avatar > 0){
		      $avatar_post=get_post($user_avatar);
		      $avatar_path = $avatar_post->guid;
		     }
		   else{
		     $avatar_path ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
		    }
			$resourcepostid = $attachment->ID;
		    $resourcelink =get_the_guid($attachment->ID);
			$resourcetitle=$attachment->post_title;
			$resourcedate=$attachment->post_date;
			//create a table row if the user is the owner of the attachment or if the user is admin or if the user has access as facilitator (post group and user group are the same term id)
			if($file_owner == $current_userID || $userhasaccess == 1){
			$attachmentrows .= "<tr id='row-".$resourcepostid."'><td><abbr title='". $user_firstname . " ". $user_lastname."' rel='tooltip'><img src='".$avatar_path."' height=30 width=30></abbr></td><td><a href='".$resourcelink ."' title='".$resourcetitle."' target=_blank >". $resourcetitle."</a></td><td>". $resourcedate ."</td><td><a href='#' class='deleteafile' id=". $resourcepostid .">Delete</a></tr>";
	        }
		 }
}
$content.='<br><br>
<div id=uploadedfilelist></div>
 <div id="resourcescontainer">
  <table id="uploadrenamedfiles" class="basic_table">
    <thead>
      <tr>
	    <th>Name</th>
        <th>File</th>
        <th>Date</th>
		<th>Action</th>
		 </tr>
    </thead>
    <tbody>'.$attachmentrows.'</tbody>
  </table>
</div>';
return $content;
}
//adds a file with two options for renaming the file upon uploading it
function tcs_add_a_file($atts,$content=null){
global $wpdb;
$current_userID = get_current_user_id();
$ID = get_the_ID();
$name1=$atts['name1'];
$name2=$atts['name2'];
$order=$atts['order'];
$application = $atts['application'];

$content.='
<style>
#filevalidatearea{color:red;}
#filesdisplaymessage #filedisplayarea{color:red;}
#upload-file-form{display:none;}
</style>';
$content.='<button id="upload-rename-file'.$order.'">Add my '.$name2.' file</button>';
$content.='<div id="upload-file-form" title="Upload a file">
<div id="uploadfile'.$order.'" >
<div id="filevalidatearea">Your file will appear in the table below once it is uploaded.</div>
<form id="uploadfileform'.$order.'" method="post" enctype="multipart/form-data">
    <fieldset>
	  <label for="website">Upload a File</label><br>
      <input type="file" name="file-upload" id="file-upload" /><br>
	  <input type=hidden  name="userid" id="userid" value='.$current_userID.' /><br>
	  <input type=hidden  name="postid" id="postid" value='.$ID.' /><br>
	  <input type=hidden  name="name1" id="name1" value='.$name1.' /><br>
	  <input type=hidden  name="name2" id="name2" value='.$name2.' /><br>
      <input type=hidden  name="application" id="application" value='.$application.' /><br>
     <input type="submit" id="submitsharedfile" value="Upload file"><br>
    </fieldset>
  </form>
</div>
</div>';
return $content;
}

function tcs_add_comments($atts,$content=null){
 ob_start();
comments_template();
$contents= ob_get_clean();
return $contents;
}
function tcs_share_upload_resource($atts,$content=null){
global $wpdb;
$usesimplelinks = $atts['simple_links'];
$simplelinkparent=$atts['parent_category'];
$googletracking=$atts['google_tracking'];
$current_userID = get_current_user_id();
$ID = get_the_ID();
if ($usesimplelinks=='yes'){
$termcategory="simple_link_category";
$categoryselect= '<select name="simple_link_category" id="simple_link_category">';
	$termchildren= get_term_children( $simplelinkparent, $termcategory); 
    for($i=0; $i< count($termchildren); $i++){
	$term = get_term_by( 'id', $termchildren[$i], $termcategory  );
	$categoryselect.="<option name='". $term->name ."' value=". $termchildren[$i] .">".$term->name."</option>";
}
$categoryselect.= '</select>';

//now get the simple links already uploaded for the category
$resources = $wpdb->get_results($wpdb->prepare("select post_author, ID,post_title, m.name from wp_posts p, wp_term_relationships r, wp_term_taxonomy t , wp_terms m where r.object_id=p.ID and t.term_taxonomy_id =r.term_taxonomy_id AND t.term_id = m.term_id and parent = %d order by m.name", $simplelinkparent, OBJECT));
	if ($wpdb->num_rows > 0){
	foreach ($resources as $resource){
	$user_firstname = get_user_meta( $resource->post_author,'first_name', true );   
	$user_lastname = get_user_meta( $resource->post_author,'last_name', true );
	//get the avatar
	 $user_avatar=get_user_meta ($resource->post_author, 'wp_user_avatar', true);
		if ($user_avatar > 0){
		 $avatar_post=get_post($user_avatar);
		 $avatar_path = $avatar_post->guid;
		}
		else{
		$avatar_path ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
		}
	$resourcepostid = $resource->ID;
	$resourcelink = get_post_meta($resource->ID, 'web_address', true);
	$resourcedescription= get_post_meta($resource->ID, 'description', true);
	$numlikes= get_post_meta($resource->ID, 'resource_likes', true);
	$resourcecategory= $resource->name;
	$resourcetitle=$resource->post_title;
    if($numlikes == ""){$numlikes=0;}
	$endStr=substr($resourcelink,(strlen($resourcelink)-5), strlen($resourcelink));
    if(strpos($endStr,'doc')){$link_style="doc-ico";}
		elseif(strpos($endStr,'pdf')){$link_style="pdf-ico";}
			elseif(strpos($endStr,'pps')){$link_style="pps-ico";}
				else{$link_style="web-ico";}      
	$sharedwebsites .= "<tr><td><abbr title='". $user_firstname . " ". $user_lastname."' rel='tooltip'><img src='".$avatar_path."' height=30 width=30></abbr></td><td><p>". $resourcecategory."</p></td><td><li class='". $link_style."'><a href='".$resourcelink ."' title='".$resourcetitle."' target=_blank >". $resourcetitle."</a></li></td><td><p>".$resourcedescription."</p></td><td><div class='resource-vote-result'><span class=".$resourcepostid.">". $numlikes."</span></div><span class='resource-vote-link' data-resourceid=". $resourcepostid ."><i class='fa fa-thumbs-up fa-flip-horizontal resource-thumbs-up' ></i></span></td></tr>";
	}
	}
	else{
	$sharedwebsites .= "<tr><td><p>Currently there are no items available.</p></td><td><p></p></td><td></td><td><p></p></td><td><p></p></td></tr>";	
	}	
}
$content.='
<style>
#resource-form{display:none;}
#file-form{display:none;}
#resourcescontainer{display:none;}
#track_with_google{display:none;}
#userid{display:none;}
#fileuserid{display:none;}
#validatearea{color:red;}
#filevalidatearea{color:red;}
.resource-thumbs-up{padding:0px;margin:0;vertical-align: baseline!important; display:inline-block; float: none; border:none;}
.resource-vote-link i{font-size:18px; line-height:13px; color:#666666; cursor: pointer; font-size: 13px; font-weight: bold}
.resource-vote-result{padding: 2px 6px 2px 5px;color: #FFF; font-size: 12px;font-weight: bold;display: inline;margin-right: 7px; background-color: #666666;}
</style>
<div id="resource-form" title="Add a resource">
<div id="sharewebsite">
  <div id="validatearea">All fields are required.</div>
<form id="shareresourceform" >
    <fieldset>
	  <label for="website">Website URL</label><br>
      <input type="text" name="website" id="website" value="" size=40><br>
      <label for="title">Give it a title</label><br>
      <input  name="resource-title" id="resource-title" value="" size=40><br>
	   <label for="category">Choose a category</label><br>'.$categoryselect.'<br>
	  <label for="description">Briefly describe why this is a useful website.</label><br>
      <textarea name="resource-description" id="resource-description" value="" cols=40 ></textarea><br>
      <input type="button" id="submitsharedwebsite" value="Share website"><br>
    </fieldset>
  </form>
   <div id="track_with_google">'.$googletracking.'</div>
   <div id="userid">'.$current_userID.'</div>
</div>
</div>
<div id="file-form" title="Upload a file">
<div id="sharefile">
<div id="filevalidatearea">All fields are required.</div>
<form id="sharefileform" method="post" enctype="multipart/form-data">
    <fieldset>
	  <label for="website">File</label><br>
      <input type="file" name="share-file-upload" id="share-file-upload" /><br>
	  <label for="title">Give the file a title</label><br>
      <input  name="file-title" id="file-title" value="" size=40><br>
	   <label for="category">Choose a category</label><br>'.$categoryselect.'<br>
	  <label for="file-description">Briefly describe why the file is useful.</label><br>
      <textarea name="file-description" id="file-description" value="" cols=40 ></textarea><br>
	  <input type=hidden  name="userid" id="userid" value='.$current_userID.' /><br>
	  <input type=hidden  name="postid" id="postid" value='.$ID.' /><br>
      <input type="submit" id="submitsharedfile" value="Share file"><br>
    </fieldset>
  </form>
</div>
</div>

<div class=fancybox-hidden><div id=fancypopup1 style="width:800px; height: 900px;">
<h4>Useful Resources</h4>
  <table id="sharedresourcestable" class="basic_table">
    <thead>
      <tr>
	    <th>Shared by</th>
        <th>Category</th>
        <th>Resource</th>
		<th>Description</th>
		<th>Like it!</th>
      </tr>
    </thead>
    <tbody>'.$sharedwebsites.'</tbody>
  </table>
</div></div>';

return $content;	
}
function tcs_create_hidden_activity_text($atts, $content=null){
global $wpdb;
    $ID = get_the_ID();
	$postid = $atts['postid'];
	$title=$atts['title'];
	$divname=strtolower($title);
	$divname=str_replace(" ","",$divname);
	$activitydesc=$atts['activitydesc'];
    $content.="<div style='display:none;';><div id='". $divname."'>";
	$content.="<style>
		#img_cont {
		   width: auto;
		  margin: 10px auto;
		  overflow: scoll-x;
		   overflow-y: hidden;
			white-space: nowrap;
		}
		#img_cont p {
		  display: inline-block;
		  text-align: left;
		  font-size: 11px;
		  float:left;
		  padding-right: 12px;
		  vertical-align: middle;
		}
		#img_cont img {
		  width: 100%;
		  max-width: 40px;
		  
		}
		.resizablep{
		position: relative;
		word-break: break-word; 
		white-space: normal; 
		}
		</style>";
	$content.="<h5>". $title."</h5>";
    $content.="<div id='img_cont'>";
	$usertextactivity = $wpdb->get_results($wpdb->prepare("Select user_id, activity_value from wp_course_activities where post_id =%d and description = '%s' ", $postid,$activitydesc,OBJECT));
	//get the users that have this item chosen
        foreach ($usertextactivity as $useractivity) {
          $user_avatar=0;
                         $user_firstname = get_user_meta( $useractivity->user_id,'first_name', true );   
						  $user_lastname = get_user_meta( $useractivity->user_id,'last_name', true );
						  $user_avatar=get_user_meta ($useractivity->user_id, 'wp_user_avatar', true);
							  if ($user_avatar > 0){
							  $avatar_post=get_post($user_avatar);
							  $avatar_path = $avatar_post->guid;
							  }
							  else{
							 $avatar_path ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
							  }
						     $content.="<p class=resizablep><a href='#'><img src='". $avatar_path."'><br>". $user_firstname ." " . $user_lastname ."</a><br>" .stripslashes($useractivity->activity_value) ."</p><div style='clear:both;'></div>" ;
             }
			 $content.="</div>";
	$content.="</div></div>";
return $content;	
}

function tcs_create_hidden_checklist_results($atts, $content=null){
global $wpdb;
    $ID = get_the_ID();
	$checklistpostID = $atts['checklistpostid'];
	$content.="<div style='display:none;';><div id='lernchecklistresults'>";
	$content.="<style>
#img_cont {
  width: auto;
  margin: 10px auto;
  overflow: scoll-x;
  overflow-y: hidden;
  white-space: nowrap;

}
#img_cont p {
  display: inline-block;
  text-align: center;
  font-size: 11px;
  float:left;
  padding-right: 12px;
  vertical-align: middle;
}
#img_cont img {
  width: 100%;
  max-width: 40px;
  
}
</style>";
	$courseid=$wpdb->get_var($wpdb->prepare("select parent_course_id from wp_wpcw_units_meta where unit_id = %d", $ID));
    $choices=$wpdb->get_results($wpdb->prepare("Select item_text from wp_course_matrix where post_id =%d and matrix_type=%s", $checklistpostID, 'checklist',OBJECT));
	$i=0;
	$content.="<h5>Checklist choices from your LERN group</h5>";
    foreach ($choices as $choice){
	   $content.="<span style='font-weight:bold; font-size:14px;'>These LERNers need " . strtolower($choice->item_text)."</span>";
	   $content.="<div id='img_cont'>";
	    $userselected = $wpdb->get_results($wpdb->prepare("Select user_id, activity_value from wp_course_activities where post_id =%d and description=''  ORDER BY RAND() LIMIT 18", $checklistpostID,OBJECT));

	  
      //get the users that have this item chosen
$matches=0;
	   foreach ($userselected as $userselect) {
	    $user_avatar=0;
		     $aChoices=explode(',',$userselect->activity_value);
	             if (in_array($i,$aChoices)){
					      $matches++;
				          $user_firstname = get_user_meta( $userselect->user_id,'first_name', true );   
						  $user_lastname = get_user_meta( $userselect->user_id,'last_name', true );
						  $user_avatar=get_user_meta ($userselect->user_id, 'wp_user_avatar', true);
							  if ($user_avatar > 0){
							  $avatar_post=get_post($user_avatar);
							  $avatar_path = $avatar_post->guid;
							  }
							  else{
							 $avatar_path ='http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=32&amp;d=mm&amp;r=g&amp;forcedefault=1';
							  }
						     $content.="<p><img src='". $avatar_path."'><br>". $user_firstname ." " . $user_lastname ."</a></p>";
		          }
             }
		    $content.="</div>";
			$content.="<div style='clear:both;'></div>";
	$i++;
	}
$content.="</div></div>";
return $content;	
}
function tcs_create_hidden_roster($atts, $content=null){
	global $wpdb;
	$ID = get_the_ID();
	$content.="<div style='display:none; width:900px; height:auto;';><div id='lerncourseroster'>";
	$courseid=$wpdb->get_var($wpdb->prepare("select parent_course_id from wp_wpcw_units_meta where unit_id = %d", $ID));
	$coach_id = $wpdb->get_var("select coach_id from wp_wpcw_course_extras where course_id=".$courseid); 
     $users = $wpdb->get_results("select user_id from wp_wpcw_user_courses where user_id not in (". $coach_id .")  and course_id =" . $courseid, OBJECT);
  if ($wpdb->num_rows >= 1){
	foreach ($users as $user){
//get the avatar and the tiny bio from usermeta
  $user_firstname = get_user_meta( $user->user_id,'first_name', true );   
  $user_lastname = get_user_meta( $user->user_id,'last_name', true ); 
  $user_avatar=get_avatar($user->user_id, 25);
  $state = get_user_meta( $user->user_id,'state', true );
  $PQ_knowledge=get_user_meta( $user->user_id, $courseid.'_currentknowledge', true );
  $PQ_currentwork=get_user_meta( $user->user_id, $courseid.'_currentwork', true );
  $PQ_whoserve =get_user_meta( $user->user_id, $courseid.'_whoserve', true );
  if ($PQ_knowledge==""){$PQ_knowledge="N/A";}
  if ($PQ_currentwork==""){$PQ_currentwork="N/A";}
  if ( $PQ_whoserve==""){ $PQ_whoserve="N/A";}
  $tc_role = get_user_meta( $user->user_id,'transition_profile_role', true );
   if ($tc_role ==""){$tc_role="Other";}
    $content.=$user_avatar;
    $content.= "<br><strong>".$user_firstname. " " . $user_lastname ."</strong> from " . $state .", Transition role: " . $tc_role."<BR><strong>Current knowledge of the topic: </strong>".  $PQ_knowledge."<BR><strong>Current work:</strong>".  $PQ_currentwork ."<br><strong>Currently serving:</strong>" .$PQ_whoserve ;
    $content.= "<hr>";
	}
  }
  else{
	$content.="No one has enrolled or added their information yet. Please check again later.";  
  }
$content.="</div></div>";
return $content;	
}

function tcs_get_dc_links($content=null){
global $wpdb;
$ID = get_the_ID();
$linkposts=$wpdb->get_results("select meta_value from wp_postmeta where meta_key='course_unit_discussion_topics' and post_id=" . $ID ." order by meta_id",OBJECT);
foreach ($linkposts as $post){
	$thepost=get_post($post->meta_value);
	$content.='<span style="font-size:18px; color: #3b8dbd; padding-right: 5px;"><i class="fa fa-comments" aria-hidden="true"></i></span><a class="dicussiframe" href="#" data-postid="'. $post->meta_value.'">'.$thepost->post_title .'</a><br>';
}
return $content;
}	
	
function tcs_get_user_courses($atts, $content=null){
$current_userID = get_current_user_id();
$categoryName = $atts["category_name"];
$term = get_term_by('name', $categoryName, 'category');
$category_ID = $term->term_id;
		     $args = array(
			'posts_per_page'   => -1,
			'category'         => $category_ID,
			'orderby'          => 'id',
			'order'            => 'ASC',
			'post_type'        => 'page',
			'post_status'      => 'publish'
			 );	 
		     $posts = get_posts( $args );
		     foreach ($posts as $post){
		     if ($post->post_type =='page'){
		        //see if this page has a group restriction
			$group_id = get_post_meta( $post->ID,'user-group-content', true );
			if ($group_id){
				//see if this user is in the group
			        $users_groups = wp_get_object_terms( $current_userID, 'user-group'); 
			          foreach ($users_groups as $user_group){
				  if ($user_group->term_id == $group_id){
				  $title = the_title();
				  $content.= "<a href='".get_site_url()."/?p=".$post->ID ."&cat_ID=".$category_ID."'>".$post->post_title ."</a><BR>";
				  }
				  }
			//output the link to the page
			}
			}
		}
		      
             
if ($content ==""){
$content="You are not enrolled in any courses at the moment.";
}		
return $content;
}

function tcs_create_contact_link($atts, $content=null){
$linkText=$atts['text'];
$content="<a href='javascript: usernoise.window.show();'>".$linkText."</a>";
return $content;
}

function tcs_show_uploaded_files($atts, $content=null){
global $wpdb;
$aAuthors=array();
$postID = get_the_ID();
//get all the authors for posts that have the same categorization as the post we are on
$categories = get_the_category($postID);
$bShowFiles = 0;
if($categories){
$termID =$categories[0]->term_id;
}

//get all the author ids on posts that have been submitted to the category
$authorRows = $wpdb->get_results("select post_author from  wp_posts p, wp_term_relationships r,  wp_term_taxonomy t,  wp_terms s where 
s.term_id = t.term_id
and
r.term_taxonomy_id=t.term_taxonomy_id
and
p.ID = r.object_id
and
s.term_id=" . $termID, OBJECT);

if ($wpdb->num_rows  > 0){
$current_userID = get_current_user_id();
   if (in_array($current_userID, $authorRows) > 0){
   $bShowFiles=1;
   }
}
if ($bShowFiles == 1){
$uploadedFilePosts=$wpdb->get_results("Select display_name, post_title, guid, post_modified from wp_posts p, wp_users u where p.post_author = u.id and post_parent =  ". $postID ." and post_type='attachment' order by post_author, p.ID", OBJECT);
if ($wpdb->num_rows  > 0){
$content.="<table class=basic_table>";
foreach ($uploadedFilePosts as $row){
	$content.="<tr><td><strong>Name: </strong>".  $row->display_name . "</td><td><strong> Uploaded File: </strong><a href='". $row->guid ."'>". $row->post_title ."</a></td><td> <strong>Updated on: </strong>". $row->post_modified ."</td></tr>";
	}
}// end if rows returned
$content.="</table>";
}
return $content;
}


function tcs_file_uploader($atts, $content=null){
    $postID = get_the_ID();

	$content .= '<div id ="fileUploadSuccess"></div>';
	$content.='<form id="featured_upload" name="featured_upload" method=post enctype=multipart/form-data>
	<input type="file" name="tc_file_upload" id="tc_file_upload"  multiple="false" />
	<input type="hidden" name="post_id" id="post_id" value="'.$postID.'" />
	<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
</form>';
return $content;
}


function tcs_get_reflection_and_plan($atts, $content=null){
global $wpdb;
$courseID = 15;
$current_userID = get_current_user_id();
$user_info = get_userdata($current_userID);
$displayName = $user_info->first_name . " " . $user_info->last_name;
$displayEmail = $user_info->user_email;
$logoPath="<img src='/wp-content/uploads/2014/12/tc_logo.png'>";
$modelCourseIDs=array('2','8192','1','8205','2','8260','2','8216','1','8225','1','8239');
$otherCourseIDs=array('2','8255','1','8365','2','8365');
//header and logo
$heading="<p style='text-align: center;'><span style='font-size: 12px;'>Report generated by ". $displayName." (". 

$displayEmail.") on" .date('y-m-d hh:mm:ss')."</span></p>
<p style='text-align: center;'><img class='aligncenter size-full wp-image-8389' src='/wp-

content/uploads/2014/12/tc_logo.png' alt='tc_logo' width='195' height='85' /></p>
<p style='text-align: center;'><span style='font-size: 16px;'><strong>The <em>Essentials of Self-

Determination</em> Training Module</strong></span></p>
<p style='text-align: center;'>www.transitioncoalition.org</p>
<p style='text-align: center;'></p>";

$table="<table class=basic_table><tr><td><strong>Key Element from <i>Model of Self-Determination</i> Field & 

Hoffman (2005)</strong> </td><td>Your responses in Session 2 identifying additional content you need to address 

with your students in each element</td></tr>";

for ($i = 0; $i < count($modelCourseIDs); $i+=2){
$order= $modelCourseIDs[$i];
$postTitle =  get_the_title( $modelCourseIDs[$i+1] );
$answer= $wpdb->get_var("Select activity_value from wp_course_activities where user_id=". $current_userID ." and 

page_order=". $order ." and  post_id = ". $modelCourseIDs[$i+1]);
if ($answer ==""){
$answer="<i>NOT ANSWERED YET</i>";
}
$table .="<tr><td><strong>". $postTitle."</strong></td><td>". $answer."</td></tr>";
}
$table .="</table>";

for ($i = 0; $i < count($otherCourseIDs); $i+=2){
$order=$otherCourseIDs[$i];
$rows= $wpdb->get_results("Select activity_value, post_id, description from wp_course_activities where user_id=". $current_userID ." and page_order =". $order ." and post_id =" .$otherCourseIDs[$i+1], OBJECT); 
	foreach ($rows as $row){
	$summaryAnswer= $row->activity_value;
	$summaryQuestion= "Your response to: " . $row->description;
	$final .="<p><strong>". $summaryQuestion ."</strong></p><p>". $summaryAnswer ."</p>";
	}
}

$content = "<div style='width:100%'>". $heading . $table . $final ."</div>";
return $content;
}


function tcs_create_webmap_complete($atts, $content=null){
global $wpdb;
$postID = 7609;
$current_userID = get_current_user_id();
$listText="<strong>Your identity web </strong></br >";
$aIdentityWebItems=array('Gender','Nationality','Religion','Ethnicity','Age','Social Class','Education','Occupation','Exceptionality');
for ($i=1; $i< (count($aIdentityWebItems) + 1); $i++){
$rows=$wpdb->get_results("Select * from wp_course_activities where post_id = " . $postID. " and user_id=" . $current_userID ." and page_order=" . $i ." order by page_order",OBJECT);
	if ($wpdb->num_rows  > 0){
		foreach ($rows as $activity){
		$listText.="<p><strong>". $aIdentityWebItems[$i-1] ."- </strong>" . $activity->activity_value .".</p>";
		}
	}
	else{
	$listText.="<p><strong>".$aIdentityWebItems[$i-1]." - </strong>please <a href='/?p=". $postID."/'>complete your identity web</a> for " .strtolower($aIdentityWebItems[$i-1]) .".</p>"; 
	}
}
$rows=$wpdb->get_results("Select * from wp_course_activities where post_id = " . $postID. " and user_id=" . $current_userID ." order by page_order",OBJECT);
$content="<script src=". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.identitywebcomplete.js></script>";
$content.="<div id='listIdentityWebItems'>". $listText."</div>";
$content.="<div style='margin-top: 30px;'><img id=\"mapimage\" src=\"/wp-content/originalSiteAssets/images/modules/identWeb_1.png\" alt=\"map tool\" usemap=\"#evpmap\" border=\"0\" /></div>
<map id=\"evpmap\" style=\"display: block;\" name=\"evpmap\">";
$content1="<area id=\"area1\" style=\"outline: none;\" title=\"\" coords=\"166,21,266,106\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content2=" <area id=\"area2\" style=\"outline: none;\" title=\"\" coords=\"275,39,372,134\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" /> ";
$content3="<area id=\"area3\" style=\"outline: none;\" title=\"\" coords=\"322,139,424,242\" shape=\"rect\" target=\"_self\"  rel=\"tooltip\" />";
$content4="<area id=\"area4\" style=\"outline: none;\" title=\"\" coords=\"317,246,428,326\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content5="<area id=\"area5\" style=\"outline: none;\" title=\"\" coords=\"241,329,347,411\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content6=" <area id=\"area6\" style=\"outline: none;\" title=\"\" coords=\"130,320,214,408\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content7=" <area id=\"area7\" style=\"outline: none;\" title=\"\" coords=\"38,251,122,339\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content8=" <area id=\"area8\" style=\"outline: none;\" title=\"\" coords=\"31,143,115,231\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content9="<area id=\"area9\" style=\"outline: none;\" title=\"\" coords=\"67,46,151,134\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" /> </map>";
//if there are answers for any of the items, replace the title and data-activityid with it in the strings
if ($wpdb->num_rows  > 0){
foreach ($rows as $activity){
$activityTitle=$activity->activity_value;
if ($activity->page_order == 1){
$content1=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content1 );
}
else if ($activity->page_order == 2){
$content2=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content2 );
}
else if ($activity->page_order == 3){
$content3=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content3 );
}
else if ($activity->page_order == 4){
$content4=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content4 );
}
else if ($activity->page_order == 5){
$content5=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content5 );
}
else if ($activity->page_order == 6){
$content6=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content6 );
}
else if ($activity->page_order == 7){
$content7=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content7 );
}
else if ($activity->page_order == 8){
$content8=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content8 );}
else if ($activity->page_order == 9){
$content9=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content9 );
}
}
}//end if there are records
//chain the content togethrt and return it
$content .=$content1 .$content2.$content3.$content4.$content5.$content6.$content7.$content8.$content9;
return $content;
}

function tcs_create_webmap($atts, $content=null){
global $wpdb;
$postID = get_the_ID();
$current_userID = get_current_user_id();
$rows=$wpdb->get_results("Select * from wp_course_activities where post_id = " . $postID. " and user_id=" . $current_userID ." order by page_order",OBJECT);
$content="<script src=". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.identityweb.js></script>";
$content.="<div id='statusDiv'></div>";
$content.="<div id='inputIdentityWebItems'></div><div style='clear: both;'></div>";
$content.="<div style='margin-top: 30px;'><img id=\"mapimage\" src=\"/wp-content/originalSiteAssets/images/modules/identWeb_1.png\" alt=\"hexagon tool\" usemap=\"#evpmap\" border=\"0\" /></div>
<map id=\"evpmap\" style=\"display: block;\" name=\"evpmap\">";
$content1="<area id=\"area1\" style=\"outline: none;\" title=\"\" coords=\"166,21,266,106\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content2=" <area id=\"area2\" style=\"outline: none;\" title=\"\" coords=\"275,39,372,134\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" /> ";
$content3="<area id=\"area3\" style=\"outline: none;\" title=\"\" coords=\"322,139,424,242\" shape=\"rect\" target=\"_self\"  rel=\"tooltip\" />";
$content4="<area id=\"area4\" style=\"outline: none;\" title=\"\" coords=\"317,246,428,326\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content5="<area id=\"area5\" style=\"outline: none;\" title=\"\" coords=\"241,329,347,411\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content6=" <area id=\"area6\" style=\"outline: none;\" title=\"\" coords=\"130,320,214,408\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content7=" <area id=\"area7\" style=\"outline: none;\" title=\"\" coords=\"38,251,122,339\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content8=" <area id=\"area8\" style=\"outline: none;\" title=\"\" coords=\"31,143,115,231\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" />";
$content9="<area id=\"area9\" style=\"outline: none;\" title=\"\" coords=\"67,46,151,134\" shape=\"rect\" target=\"_self\" rel=\"tooltip\" /></map>";
//if there are answers for any of the items, replace the title and data-activityid with it in the strings
if ($wpdb->num_rows  > 0){
foreach ($rows as $activity){
$activityTitle=$activity->activity_value;
if ($activity->page_order == 1){
$content1=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content1 );
}
else if ($activity->page_order == 2){
$content2=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content2 );
}
else if ($activity->page_order == 3){
$content3=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content3 );
}
else if ($activity->page_order == 4){
$content4=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content4 );
}
else if ($activity->page_order == 5){
$content5=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content5 );
}
else if ($activity->page_order == 6){
$content6=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content6 );
}
else if ($activity->page_order == 7){
$content7=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content7 );
}
else if ($activity->page_order == 8){
$content8=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content8 );}
else if ($activity->page_order == 9){
$content9=str_replace('title=""','data-thetitle="' . $activityTitle .'" title="'.$activityTitle .'"', $content9 );
}
}
}//end if there are records
//chain the content togethrt and return it

$content .=$content1 .$content2.$content3.$content4.$content5.$content6.$content7.$content8.$content9;
return $content;
}

function tcs_create_basic_custom_popup( $atts, $content = null ){
global $wpdb;
$linkText = $atts['link_text'];
$order = $atts['order'];
$setheight = 200;
$postID = get_the_ID();
$metakey ="pop_up_text_content_1";
$sql = "SELECT meta_value FROM wp_postmeta WHERE meta_key = '". $metakey."'  AND post_id = ". $postID;
$popuprows= $wpdb->get_results($sql);
$i = 1;
$returnString = "";
foreach ( $popuprows as $row ) {
$linkcontent =  $row->meta_value;
}
$returnString .="<div class=fancybox-hidden><div id=fancypopup". $order." style=\"width: 800px; height: ". $setheight ."px;\">" . $linkcontent  ."</div></div>";
$returnString .="<span style='font-size: 14px;'><a class=fancybox href=\"#fancypopup". $order."\">". $linkText ."</a></span>";
return $returnString;
}

function tcs_create_JC_contact($atts, $content=null){
$content.="<p><a href='#' onclick='javascript: usernoise.window.show(); return false;'><span style='color: #7e56a6; align: left;'><strong><span style='font-size: 16px;'>Click here to suggest an assessment.<br class='none' /></span><br class='none' /></strong></span></a></p>";
return $content;
}
function tcs_addjsprint($atts, $content=null){
$content="<script type='text/javascript'>
window.print();
window.close();
</script>";
return $content;
}

function tcs_create_timer($atts, $content=null){
$seconds=$atts['seconds'];
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/TimeCircles.css'>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/TimeCircles.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquerytimer.js'></script>";
$content.="<div style='width: 180px; height:180px;'><div class='example_stopwatch' data-timer='".$seconds."'></div> <button class='btn btn-success start'>Start</button> <button class='btn btn-danger stop'>Stop</button> <button class='btn btn-info restart'>Restart</button></div>";
return $content;
}

function tcs_get_activity_answer($atts, $content=null){
global $wpdb;
$pageOrder = $atts['order'];
$postID= $atts['pageid'];
$answer=$wpdb->get_var("select activity_value from wp_course_activities where page_order=" . $pageOrder . " and post_id =" . $postID ." and user_id =".  get_current_user_id());
if ($answer == '' || $wpdb->num_rows = 0){
$answer="<p style='font-weight:bold; color:#f66455'>You have not yet completed the answer for the question fromt he page, '" . get_the_title( $postID) ."'. Please <a href='/?p=".$postID ."'>go back</a> and complete it before going to the next activity.
</p>";
}
$content="<div class=activityReveal>Your response was: <br>" . $answer ."</div>";
return $content;
}
function tcs_create_family_mobile($atts, $content=null){
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/familymobile.css'>";
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.familymobile.js'></script>";
$content.="
<div id='mobile'>
	<div id='mobiletop' class='mobilepiece'>
	<img id='mobiletop_image' src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_top.png' width='617px' height='93px'/>
	</div>
	<div id='mobilemain'>
		<div id='mobile_characteristics' class='mobilepiece'>
		<div class='mobile_characteristics_weight'></div>
		</div>
		
		<div id='mobile_interactions' class='mobilepiece'>
		<div class='mobile_interactions_weight'></div>
		</div>
	
		<div id='mobile_functions' class='mobilepiece'>
		<div class='mobile_functions_weight'></div>
		</div>
		
		<div id='mobile_lifecycle' class='mobilepiece'>
		<div class='mobile_lifestyle_weight'></div>
		</div>
    </div>
</div>
<div style='top: 850px; width: 750px; position:absolute;'>
<div style='width: 150px; padding-left:10px; display:inline'><a href='#' title='Car troubles'><img src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_w1.png' id=imgWeight1></a></div>
<div style='width: 150px; padding-left:10px; display:inline'><a href='#' title='Money problems'><img src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_w2.png' id=imgWeight2></a></div>
<div style='width: 150px; padding-left:10px; display:inline'><a href='#' title='Relationship issues'><img src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_w3.png' id=imgWeight3></a></div>
<div style='width: 150px; padding-left:10px; display:inline'><a href='#' title='Substance Abuse'><img src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_w4.png' id=imgWeight4></a></div>
<div style='width: 150px; padding-left:10px; display:inline'><a href='#' title='Slipping Grades'><img src='/wp-content/originalSiteAssets/images/modules/familymobile/mobile5_w5.png' id=imgWeight5></a></div>
</div>";
return $content;
}


function tcs_create_image_popup($atts, $content=null){
global $wpdb;
$pageOrder = $atts['order'];
$linkPic = $atts['link_image'];
$align = $atts['align'];
$postID = get_the_ID();
$top = $atts['top'];
$metakey = "pop_up_text_content_". $pageOrder;
$sql = "SELECT meta_value FROM wp_postmeta WHERE meta_key = '". $metakey."'  AND post_id = ". $postID;
$popuprows= $wpdb->get_results($sql);

$returnString = "";
foreach ( $popuprows as $row ) {
$content =  $row ->meta_value;
}
if ($top > 0){
$returnString.="<style type='text/css'> #fancybox-wrap {
                         top: ". $top. "px !important;
                         left: 5px !important;
                          }
</style>";
}
if ($top> 0){
$returnString .="<div class=fancybox-hidden><div id=fancypopup".$pageOrder." style=\"width: 520px; height: 500px; \">" . $content ."</div></div>";
}
else{
$returnString .="<div class=fancybox-hidden><div id=fancypopup".$pageOrder." style=\"width: 750px; height: 800px; \"><div style='width:700px;'>" . $content ."</div></div></div>";
}
$returnString .="<a data-order=" . $pageOrder ." class=fancyboxorder href=\"#fancypopup".$pageOrder."\"><img src='" . $linkPic."' align=" .$align ." title='clicktoshow'></a>";
return $returnString;
}

function tcs_create_checklist($atts, $content=null){
global $wpdb;
$userID = get_current_user_id();
$postID = get_the_ID();
$checklistToGet=$atts['checklist'];

//get the content from the module_activities table if there is one
$activityRow = $wpdb->get_row("SELECT * FROM wp_course_activities  WHERE post_id =" . $postID . " and user_id = ". $userID. " and page_order=0");
//if there are rows then use a css class that shows the form + saved
if ($activityRow->activity_id > 0){
$selectedValues = $activityRow->activity_value;
$selectedValues=substr($selectedValues,0,-1); //remove trailing comma
$aSelectedValues = explode(',',$selectedValues);
$activity_id = $activityRow->activity_id;
}
else{
$activity_id = 0;	
}
$checklistitle=$wpdb->get_var($wpdb->prepare("Select distinct(heading) as listheading from wp_course_matrix where  post_id = %d",$postID ));
//get the saved ids of the items this user has selected in the past if it exists
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/checkboxCompareStyle.css'>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.checkboxlist.js'></script>";
$content.="<div id='messageArea'></div>
 <div id=checklist>Checklist choices for ". $checklistitle. "<form id=frmMakeChoices>";


$i =0;
$checklistItems=$wpdb->get_results("Select * from wp_course_matrix where matrix_name='" . $checklistToGet ."'", OBJECT);
	if ($activity_id == 0){
		foreach($checklistItems as $item){
		$content.="<p><input type='checkbox' id='". $i . "' name='compare' /><label id='label_" . $item->item_text . "' for='". $i . "'><span></span>". $item->item_text ."</label>";
		 $i++;
		 }
	 }
	 else{   //output the prechecked values
	    foreach($checklistItems as $item){
		if (in_array($i,$aSelectedValues)){$bChecked='checked';}
			else {$bChecked='';
		}
		$content.="<p><input type='checkbox' id='". $i . "' name='compare' ". $bChecked."/><label id='label_" . $item->item_text . "' for='". $i . "'><span></span>". $item->item_text  ."</label>";
		 $i++;
		 }
	 }
$numChecklistItems = $i;
$content.="<input id=activity_id type=hidden name=activity_id value=". $activity_id .">";
$content.="<input id=post_id type=hidden name=post_id value=". $postID .">";
$content.="<input id=num_checklist_items type=hidden name=num_checklist_items value=". $numChecklistItems .">";
$content.= "<div class=compare_submit>
         <p></p>
         <input type=button id='btn_submit_items' name='submit_items' value='Save'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='/wp-content/uploads/2014/06/printer.png' class='printchecklist' title='Print my checklist'>
         </div>";
$content.="</form></div>";
return $content;
}

function tcs_toggle_open($atts, $content=null){
$clickOn = $atts['click'];
$revealThis = $atts['reveal'];
$order=$atts['order'];
$imagePath=$atts['path'];
$width=$atts['width'];
$link_text=$atts['link_text'];
if ($width <> ""){
$clickOn ="<img src='" . $imagePath ."' align=left>";
$content.="<div class=backgroundGradient800rounded><div id='click". $order ."'><p><a href='#' class='clickToShowPicNoreplace' id='". $order ."' title='click to show text'>".$clickOn ."</a></div>
<div id='reveal". $order ."' class='toggleOpenContent'>".$revealThis ."</p></div>
</div><div style='clear:both'></div>";
}
else{
$clickOn ="<img src='" . $imagePath ."' align='middle'>";
//$content.="<div id='click". $order ."'><a href='#' class='clickToShowPicNoreplace' id='". $order ."' title='click to show text'>".$clickOn ."</a></div>"; 
//$content.="<div id='reveal". $order ."' class='toggleOpenContent'>".$revealThis ."</div>"; 
$content="<p><a id=". $order." class='clickToShowPic' href='#'><img src='". $imagePath."' class='toggle-image' /><strong>". $link_text."</strong></a></p>
<div id=reveal". $order. " class='revealClicked'><p>". $revealThis ."</p></div>";
}

return $content;
}



function tcs_click_pic_reveal($atts, $content=null){
$clickOn = $atts['click'];
$revealThis = $atts['reveal'];
$order=$atts['order'];
$position=$atts['position'];
$openonly=$atts['openonly'];
if ($openonly =='yes'){
$content.="<div id='click". $order ."'><a href='#' class='clickToShowPic' id='". $order ."' title='click to show text'>".$clickOn ."</a></div>"; 
$content.="<div id='reveal". $order ."' class='revealClickedBlack'><p>".$revealThis ."</p></div>"; 
}
else{
if ($position == 'center'){
	$content.="<div style='width: 700px; background-color:#d9e3ef; margin-left:80px;'>";
	}
	else{
	$content.="<div style='width: 100% background-color:#d9e3ef;'>";
	}


$content.='<div id="click'. $order .'"><a href="#" class="clickToShowPic" id="'. $order .'" title="click to show text">'.$clickOn .'</a></div>'; 
$content.="<div id='reveal". $order ."' class='revealClickedBlack'><a href='#' class=revealClickReturn title='click to show graphic' id='". $order ."' title='show graphic' >".$revealThis ."</a></div></div>"; 
}
return $content;
}


function tcs_yes_no($atts, $content=null){
$answer = $atts['answer'];
$order=$atts['order'];
$content.="<div id='yesno". $order ."'><input type=radio class=yesnocbo name=yesnordo".$order." id='yesrdo".$order."'>Yes</input><input type=radio class=yesnocbo name=yesnordo name=yesnordo".$order." id='nordo".$order."'>No</input></div>"; 
$content.="<div id='yesnoanswer". $order ."' class='revealYesNo'>". $answer ."</div>"; 
return $content;
}

function tcs_click_and_reveal($atts, $content=null){
$clickOn = $atts['click'];
$revealThis = $atts['reveal'];
$order=$atts['order'];
$style= $atts['style'];
$citation=$atts['citation'];
if ($citation <> ""){
$fa_citatation='<a title="'.$citation.'" href="#" rel="tooltip"><i class="fa fa-angle-double-up fa-tooltip fa-icon-blue"></i></a>';	
}
if ($style <> ""){
 if ($style=='red'){
	$content="<div class ='clickAndRevealRed'>";
 }
 if ($style=='blue'){
  $content="<div class ='clickAndRevealBlue'>";
 }
 if ($style =='clear'){
 $content="<div class ='clickAndRevealClear'>";
 }
}
else{
$content="<div class ='clickAndReveal'>";
}
$content.="<div id='click". $order ."'><i class='fa fa-mouse-pointer fa-1x fa-flip-horizontal fa-icon-orange'></i><a href='#' class='clickToShow' id='". $order ."'> ".$clickOn ."</a>".$fa_citatation."</div>"; 
$content.="<div id='reveal". $order ."' class='revealClicked'>".$revealThis ."</div>"; 
$content.="</div>";
return $content;
}

function tcs_click_text_reveal($atts, $content=null){
$clickOn = $atts['click'];
$revealThis = $atts['reveal'];
$order=$atts['order'];
$style= $atts['style'];
$content.="<div id='click". $order ."'><strong><a href='#' class='clickTextShow' id='". $order ."'>".$clickOn ."</a></strong></div>"; 
$content.="<div id='reveal". $order ."' class='revealClickedBlack'>".$revealThis ."</div>"; 

return $content;
}

function tcs_create_checkbox_matrix($atts, $content=null){
global $wpdb;
$matrix_name_class = $atts['name'];
$matrixrows = $wpdb->get_results("Select * from wp_course_matrix where matrix_name='".$matrix_name_class."' order by item_id", OBJECT);
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/checkboxCompareStyle.css'>";
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.checkboxcompare.js'></script>";
$content.="<div id='matrix_name' class='". $matrix_name_class."'></div>";
$content.= "<div id='messageArea'></div>
   <div class=compare_submit>
         Click to check your answers. <input type=button id='btn_submit_items' name='submit_items' value='Compare!'>
   </div>
   <form id=frmMakeChoices>
   ";
   $i=1;
  foreach ($matrixrows as $row){
  if ($i == 1){$content.="<table><tr><td class=checklistChoices>Choices</td><td class=checkboxExplanation>Explanation</td></tr>";}
  $explanation = htmlspecialchars_decode($row->item_explanation);
  if ($explanation == ""){$explanation="&nbsp;";}
  if ($row->item_explanation <> ""){
    $tdstyle="<td class='tdExplanation'>";

  }
  else{
     $tdstyle="<td class=tdChoices>";
   }
  $content.="<tr style='background-color:#ffffff;'><td style='width:40%;'><p style='float:left'><input type='checkbox' id='". $row->item_id . "' name='compare' /><label id='label_" . $row->item_id . "' for='". $row->item_id . "'><span></span>". $row->item_text ."</label></td>"
  . $tdstyle."<p style='float:right; text-align:left;'>". $explanation."</p></td></tr>";
  $i++;
  }
  $content.="</form></table>";
return $content;
}
function tcs_create_matching_quiz($atts, $content=null){
global $wpdb;
$matrix_name_class = $atts['name'];
$matrixRows = $wpdb->get_results("Select * from wp_course_matrix where matrix_name='".$matrix_name_class."'  ORDER BY column_number", OBJECT);
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.onetoonematching.js'></script>";
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/matchingQuiz.css'>";
$content.="<div id='matrix_name' class='". $matrix_name_class."'></div>";
foreach ($matrixRows as $row){
$content.="<div class='droppableQuiz' data-question-id='".$row->column_number."'>". $row->heading ."</div>";
}
$content.="<div style='clear: both;'></div>";
$content.="<div class=draggableWrapper>";
$matrixRows = $wpdb->get_results("Select * from wp_course_matrix where matrix_name='".$matrix_name_class."'  ORDER BY RAND()", OBJECT);
foreach ($matrixRows as $row){
$content.="<div class='draggableQuiz quiz". $row->column_number."' data-question-id='". $row->column_number."'><p class=quiz_item_text>".$row->item_text."</p></div>";
}
$content.="</div>";
return $content;
}
function tcs_create_vertical_matrix($atts, $content=null){
global $wpdb;
$matrix_name_class = $atts['name'];
$matrixrows = $wpdb->get_results("Select * from wp_course_matrix where matrix_name='".$matrix_name_class."' order by item_id", OBJECT);
$columnheading1= $wpdb->get_var("Select heading from wp_course_matrix where matrix_name='".$matrix_name_class."' and column_number = 1 LIMIT 0,1");
$columnheading2= $wpdb->get_var("Select heading from wp_course_matrix where matrix_name='".$matrix_name_class."' and column_number = 2 LIMIT 0,1");
$content.="<link rel='stylesheet' href='http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css'>";
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/verticalMatchingStyle.css'>";
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.verticalmatching.js'></script>";
$content.="<div id='matrix_name' class='". $matrix_name_class."'></div>";
$content.= "<div class=draggable_message></div>
   <div class=draggable_submit>
  Click Submit! to check your answers. <input type=button id='btn_submit_items' name='submit_items' value='Submit!'>
   </div>
    <div id ='list1_selected'></div>
    <div id ='list2_selected'></div>
      <table width=700 cellpadding=2'><tr>
	  <td width=290 ><p class=draggable_heading> Statements</p></td>
	  <td width=260 ><p class=draggable_heading>".$columnheading1."</p></td>
	  <td width=200 ><p class=draggable_heading>".$columnheading2."</p></td></tr></table>
    <div class='draggable_container'>";
   //get the content from the db for the matrix items
   $i=1;
   foreach ($matrixrows as $item){
         $content.="<div id='draggable-". $i."' class='ui-widget-content'>" . $item->item_text ."</div>";
   $i++;
   }
   //add an invisible one that will keep the width when the jquery snaps to grid on the last item moved from the list
    $content.="<div id='draggable-empty class='ui-widget-content-hidden'></div>";
  $content.="</div>
     <div id='droppable-1' class='ui-widget-header'></div>
     <div id='droppable-2' class='ui-widget-header'></div>";

return $content;
}

function tcs_create_horizontal_matrix($atts, $content=null){
global $wpdb;
$matrix_name_class = $atts['name'];
$matrixrows = $wpdb->get_results("Select * from wp_course_matrix where matrix_name='".$matrix_name_class."' order by item_id", OBJECT);
$columnheading1= $wpdb->get_var("Select heading from wp_course_matrix where matrix_name='".$matrix_name_class."' and column_number = 1 LIMIT 0,1");
$columnheading2= $wpdb->get_var("Select heading from wp_course_matrix where matrix_name='".$matrix_name_class."' and column_number = 2 LIMIT 0,1");
$content.="<link rel='stylesheet' href='http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css'>";
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/horizontalMatchingStyle.css'>";
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.horizontalmatching.js'></script>";
$content.="<div id='matrix_name' class='". $matrix_name_class."'></div>";
$content.= "<div class=draggable_message></div>
   
    <div id ='list1_selected'></div>
    <div id ='list2_selected'></div>
    <div class='draggable_container'>";
   //get the content from the db for the matrix items
   $i=1;
   foreach ($matrixrows as $item){
         $content.="<div id='draggable-". $i."' class='ui-widget-content'>" . $item->item_text ."</div>";
   $i++;
   }
   //add an invisible one that will keep the width when the jquery snaps to grid on the last item moved from the list
    $content.="<div id='draggable-empty class='ui-widget-content-hidden'></div>";
    $content.="</div>
	<div id=horizontal_matrix_headings><div class='draggable_heading_1'>".$columnheading1 ."</div><div class='draggable_heading_2'>".$columnheading2 ."</div></div>
     <div id='droppable-1'></div>
	 
     <div id='droppable-2'></div>
	 <div style='clear:both;'></div>
   <div class=draggable_submit><br><input type=button id='btn_submit_items' name='submit_items' value='Check your answers!'></div>";
return $content;
}

function tcs_create_matching_matrix($atts, $content=null){
//get the name of the matrix and add it to the hidden div
$matrix_name_class = $atts['matrix_name'];
//add the css and the js right here before creating the matrix adding here so that document.ready only applies to using this shortcode
$content.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/matchingStyle.css'>";
$content.="<script src='//code.jquery.com/jquery-1.10.2.js'></script>";
$content.="<script src='//code.jquery.com/ui/1.11.1/jquery-ui.js'></script>";
$content.="<script src='". get_site_url(). "/wp-content/plugins/tcshortcodes/js/jquery.matching.js'></script>";
//add the divs
$content.="<div class='postsecmatch'>
	<div id='game_container'>
	        <div id='matrix_name' class='". $matrix_name_class."'></div>
		<div id='message'>
			<div id='text'></div>
			<input type='button' value='OK' id='ok_button' />
		</div>
		
		<div id='draggable_container'></div>
		
		<div id='droppable_container'></div>
		
		<div id='score_container'>
			<div id='score_text'></div>
		</div>
		
		<div id='button_container'>
			<input type='button' value='Check Answers' id='check_button' />
			<input type='button' value='Reset' id='reset_button' />
		</div>
	</div>
</div>";
return $content;
}
function tcs_get_qi_role_list($atts, $content = null){
$current_userID = get_current_user_id();
if ($current_userID > 0){
$aQIroles = array('Special Education Teacher','Transition Coordinator','Work Experience / Vocational Coordinator','Related Services','Adult Agency Staff','Administrator','Parent','Other');
$userQiRole = get_user_meta( $current_userID, 'qi_survey_role', true);
if (!in_array($userQiRole, $aQIroles)){
$userQiRole='';
}
$content ='<div style="font-weight: bold; padding-top: 5px; font-size: 18px; background-color: #9ed3f2;">Demographic Information</div>
<div class="wpProQuiz_question" style="margin: 10px 0px 0px 0px;">
<ul class="wpProQuiz_questionList">Please complete the following demographic information.</ul>
</div>';
$content.="Role: <select name='qi_role_select' id='qi-role-select'>";
$content.="<option value=''>Select</option>";
for ($i=0; $i< count($aQIroles); $i++){
$content.="<option value='". $aQIroles[$i] ."'";
if ($aQIroles[$i] == $userQiRole){

$content .= " selected ";
}
$content .= ">".$aQIroles[$i]."</option>"; 
}
$content .= "</select>
<BR>
<div class ='tc_inline_label'>Other: </div><input id='otherQiRole' class='otherQiRole' type='text' value='".$userOtherRole."'>";
}
return $content;
}

// get districts for the top of the qi survey
function tcs_get_qi_district_list($atts, $content = null){
global $wpdb;
$current_userID = get_current_user_id();
if ($current_userID > 0){
//get the user's meta data
$user_meta = array_map( function( $a ){ return $a[0]; }, get_user_meta( $current_userID ) );
$userstate =$user_meta['state']; 
if ($userstate =='KS'){
$selected = $user_meta['ks_school_district'];
}
else if ($userstate =='MO'){
$selected = $user_meta['mo_school_district'];
}
else if ($userstate =='GA'){
$selected = $user_meta['ga_school_district'];
}
//states,MO district, KS district,GA district
$q="select post_title, id, meta_key,meta_value 
        from wp_postmeta m,
		wp_posts p
		where
		p.id=m.post_id 
		and
		meta_key='pick_custom'
		and id in (67,222,893)";
$lists = $wpdb->get_results($q, OBJECT);
foreach ($lists as $list){
if ($list->id == 67){
$options = explode("|",$list->meta_value);
$mo_district_options="<option value=''>Select a District</option>";
	for ($i =0; $i< count($options); $i+=2){
	$mo_district_options.="<option value='".$options[$i]."' ";
	if (trim($options[$i]) == trim($selected)){
    $mo_district_options.= " selected >".$options[$i]."</option>";
	}
	else{
	$mo_district_options.=">".trim($options[$i])."</option>";
	}
   }
}
else if ($list->id == 222){
$list->meta_value;
$options = explode("|",$list->meta_value);
$ks_district_options="<option value=''>Select a District</option>";
	for ($i =0; $i< count($options); $i+=2){
		$ks_district_options.="<option value='".$options[$i]."' ";
		if (trim($options[$i]) == trim($selected)){
		$ks_district_options.= " selected >".$options[$i]."</option>";
		}
		else{
		$ks_district_options.=">".$options[$i]."</option>";
		}
	}
}
else if ($list->id == 893){
$options = explode("|",$list->meta_value);
$ga_district_options="<option value=''>Select a District</option>";
	for ($i =0; $i< count($options); $i+=2){
		$ga_district_options.="<option value='".$options[$i]."' ";
		if (trim($options[$i]) == trim($selected)){
		$ga_district_options.= " selected >".$options[$i]."</option>";
		}
		else{
		$ga_district_options.=">".$options[$i]."</option>";
		}
	}
}
}
if ($userstate == 'KS' || $userstate == 'MO' || $userstate == 'GA' ){
$content ="Select your school district: ";
if ($userstate == 'KS') {$content .= "<select name='tc_district_ks' id='tc_district_ks'>". $ks_district_options ."</select>";}
else if ($userstate == 'MO') {$content .= "<select name='tc_district_mo' id='tc_district_mo'>". $mo_district_options."</select>";}
else if ($userstate == 'GA') {$content .= "<select name='tc_district_ga' id='tc_district_ga'>". $ga_district_options."</select>";}
}
else{
$content="";
}
}
return $content;
}
function tcs_process_error($atts, $content = null){
$errorType = $_GET['errortype'];
$errorText = $_GET['errortext'];
if ($errorType=='activatefail'){
$content="<h4>" . $errorText ."<h4>";
}
elseif ($errorType == 'siteactivated'){
  $content="<h4>" . $errorText ."<h4>";
$content.="<p>Log in with the form on the left to gain access to your new site. </p>";  
}
elseif ($errorType=='alreadyactivated'){
$content="<h4>" . $errorText ."<h4>";
$content.="<p>You can log in with the login form to the left. You can log in with either your username or your email address. </p>";
}
return $content;
}

function tcs_private_comment_section($atts, $content = null){
$commentType = $atts['typeOfComment'];
return "<a href='#' class= private_comment_link name=". $contentType .">Add a comment</a><BR>
<div id ='private_comment'>waiting...</div>";
}
//return enclosed content if the user's group matches the one sent in by the shortcode
function tcs_get_users_group( $atts, $content = null ){
global $wpdb;
$current_userID = get_current_user_id();
$groupName = $atts['groupname'];

if (current_user_can('activate_plugins')){
return $content;
}

if ($groupName =='All'){
//if this user is from the state of KS or MO return "";
$user_state = get_user_meta( $current_userID, 'state', true); 
if ($user_state == 'KS' || $user_state =='MO'){
return "";
}
}

else{
$groupTermObj = get_term_by('name', $groupName, 'user-group');
$termID = $groupTermObj->term_id;
//get the term taxonomy id and the userid from relationships and term taxomomy
$sql = "SELECT object_id FROM wp_term_taxonomy t, 
wp_term_relationships s where t.term_taxonomy_id=s.term_taxonomy_id and t.term_id =" . $termID;
$grouprows= $wpdb->get_results($sql);
//if the current user id matches the object id, show the content
foreach ($grouprows as $item){
$userid = $item->object_id;
    if ($userid == $current_userID){
    return $content;  
    }
}
}
return "";
}
//return a span text that will enclose text on a page or post to be able to be toggled hide/show
function tcs_toggle_read_more_content( $atts, $content = null ){
$returnString = "<span class=read-more-content>";
return $returnString;
}


//return pod text content as a div styled fancy box to the post
function tcs_create_custom_popup( $atts, $content = null ){
global $wpdb;
$pageOrder = $atts['order'];
$linkText = $atts['link_text'];
$postID = get_the_ID();
$metakey = "pop_up_text_content_". $pageOrder;
$sql = "SELECT meta_value FROM wp_postmeta WHERE meta_key = '". $metakey."'  AND post_id = ". $postID;
$popuprows= $wpdb->get_results($sql);
$i = 1;
$returnString = "";
foreach ( $popuprows as $row ) {
$content =  $row ->meta_value;
}
$returnString .="<div class=fancybox-hidden><div id=fancypopup style=\"width: 800px; height: 400px;\">" . $content   ."</div></div>";
$returnString .="<div class=backgroundGradient300><img class=alignleft alt=idea src=\"/wp-content/uploads/site icons/idea-150x150.png\" width=90 height=90 /><span style='color: #b76e00; align:left;'><strong>Bright IDEA</strong></span><BR><BR>
<a class=fancybox href=\"#fancypopup\">". $linkText ."</a></div>";
return $returnString;
}


//return pod text content as a div styled fancy box to the post
function tcs_create_link_popup( $atts, $content = null ){

global $wpdb;
$linkText = $atts['link_text'];
$setheight = $atts['height'];
$order = $atts['order'];
$style=$atts['style'];
$setwidth = $atts['width'];
if ($setheight == ''){
$setheight = 900;
}
if ($setwidth == ''){
$setwidth = 800;
}
$postID = get_the_ID();
$metakey ="pop_up_text_content_". $order;
$sql = "SELECT meta_value FROM wp_postmeta WHERE meta_key = '". $metakey."'  AND post_id = ". $postID;
$popuprows= $wpdb->get_results($sql);
$i = 1;
$returnString = "";
foreach ( $popuprows as $row ) {
$linkcontent =  $row->meta_value;
}
$stylecss=" style='font-size: 14px;'";
if ($style == 'brown'){
$stylecss="style='font-size: 14px; color: #c17400; font-weight:bold;'";
}
elseif  ($style == 'green'){
$stylecss="style='font-size: 14px; color: #808000; font-weight:bold;'";
}
$returnString .="<div class=fancybox-hidden><div id=fancypopup". $order." style=\" margin-right: 20px; width: ".$setwidth."px; height: ". $setheight ."px;\">" . $linkcontent  ."</div></div>";
$returnString .="<a data-order=". $order ." class=fancyboxorder " . $stylecss ." href=\"#fancypopup". $order."\" >". $linkText ."</a>";
return $returnString;  
}

//return a toggled form with  a text area and a submit button
function tcs_create_text_form( $atts, $content = null ) {
global $wpdb;
$userID = get_current_user_id();
$pageOrder = $atts['order'];
$textwidth = $atts['width'];
if ($textwidth == ""){$textwidth="narrow";}//default
$description =$atts['description'];
$revealText = $atts['reveal'];
$shortinput=$atts['shortinput'];
$postID = get_the_ID();
$textForm1="";
$textForm2="";
$style = $atts['style'];
//if they want the red style include a different stylesheet to circumvent the original one for the text areas which is blue
if ($style == 'red'){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/redTextAreaStyle.css'>";
}
elseif  ($style == 'purple'){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/purpleTextAreaStyle.css'>";
}
elseif ($style =="green"){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/greenTextAreaStyle.css'>";
}
elseif ($style=='dreamsheet'){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/dreamsheetTextAreaStyle.css'>";
}
elseif ($style=='attendancepyramid'){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/attendancePyramidStyle.css'>";
}
elseif ($style =='plain'){
$returnString.="<link rel='stylesheet' type='text/css' href='". get_site_url(). "/wp-content/plugins/tcshortcodes/css/plainTextAreaStyle.css'>";
}
//get the content from the module_activities table if there is one
$activityRow = $wpdb->get_row("SELECT * FROM wp_course_activities  WHERE post_id =" . $postID . " and user_id = ". $userID. " and page_order=" . $pageOrder);
//if there are rows then use a css class that shows the form + saved
if ($activityRow->activity_id > 0){
$activityID  = $activityRow->activity_id;
$pageOrder = $activityRow->page_order;
$textAreaValue = stripslashes($activityRow->activity_value);
$description=  stripslashes($activityRow->description);
}
else{
$activityID  = 0;
$pageOrder = $atts['order'];	
}
$viewBtnID ='btnViewTextActivity_'. $pageOrder;
$editBtnID ='btnEditTextActivity_'. $pageOrder;
$viewBtnclass ='btnViewTextActivity_'. $pageOrder;
$editBtnclass ='btnEditTextActivity_'. $pageOrder;
$viewActivityFormID = 'frmViewTextActivity_' . $pageOrder;
$editActivityFormID = 'frmEditTextActivity_' . $pageOrder;
//add the jquery handler for the text area function
$textCleaned =stripslashes_deep($textAreaValue);
$textForm1 .="<div id = viewactivitycontent><img class = activitytext_image src='/wp-content/uploads/site icons/saved.png'><div class=textcontent". $pageOrder.">" . nl2br($textCleaned)."</div></div>";
$textForm1 .='<form  id="'.$viewActivityFormID . '">
    <fieldset>
    <input type=hidden id="description'. $pageOrder .'" name="description" value="'. $description .'">
    <input type=button class='.$viewBtnclass.' id='. $viewBtnID.' value="Change my answer"/>
  </fieldset>
</form>';
if ($revealText <> ""){
$textForm1.="<div id=reveal" . $pageOrder." class=activityReveal ><p>" . $revealText ."</p></div>";
}
if ($shortinput=='yes'){
$textForm2 .="<form  id=".$editActivityFormID.">
    <fieldset>
    <input ";
    if ($textwidth == 'medium'){
	 $textForm2.=" size=60 ";
	 }
	 elseif ($textwidth =="narrow"){
	$textForm2.=" size=40 "; 
	 }
    else{
	$textForm2.=" size=100 ";
	 }
$textForm2.='name=activitytext value="'. stripslashes($activityRow->activity_value).'" class=activitytext></input>
    <input type=hidden  id="userid'. $pageOrder.'" name=userid value='.$userID .'>
    <input type=hidden  id="postid'.$pageOrder.'" name=postid value='. $postID .'>
    <input type=hidden id="activityid'.$pageOrder.'" name=activityid value='. $activityID .'>
    <input type=hidden id="formorder'.$pageOrder.'" name=formorder value='. $pageOrder .'><BR>
    <input type=hidden id="description'. $pageOrder.'" name="description" value="' . $description .'">
	<input type=hidden id="action'. $pageOrder.'" name="action" value="saveActivityText">
    <input type=button class="'. $editBtnclass .'" id='. $editBtnID.' value="Save my answer"/>
  </fieldset>
</form>';	
}
else{
$textForm2 .="<form  id=".$editActivityFormID.">
    <fieldset>
    <textarea ";
    if ($textwidth == 'medium'){
	 $textForm2.=" cols=58 rows=7 ";
	 }
	 elseif ($textwidth=="dreamsheetnarrow"){
	 $textForm2.=" cols=15 rows=6 ";
	 }
	 elseif ($textwidth=="dreamsheetwide"){
	  $textForm2.=" cols=60 rows=1   ";
	 }
	 elseif ($textwidth=="pyramidwide"){
	  $textForm2.=" cols=50 rows=1   ";
	 }
	 elseif ($textwidth=="pyramidnarrow"){
	  $textForm2.=" cols=17 rows=2   ";
	 }
	 elseif ($textwidth=="pyramidmedium"){
	  $textForm2.=" cols=40 rows=2   ";
	 }
	 
	 elseif ($textwidth=="wide"){
	   $textForm2.=" cols=88 rows=7 ";
	   }
     else{
	  $textForm2.=" cols=23 rows=7 ";
	 }	
$textForm2.='name=activitytext value="'. $activityRow->activity_value.'" class=activitytext>'.stripslashes($textAreaValue).'</textarea>
    <input type=hidden  id="userid'. $pageOrder.'" name=userid value='.$userID .'>
    <input type=hidden  id="postid'.$pageOrder.'" name=postid value='. $postID .'>
    <input type=hidden id="activityid'.$pageOrder.'" name=activityid value='. $activityID .'>
    <input type=hidden id="formorder'.$pageOrder.'" name=formorder value='. $pageOrder .'><BR>
    <input type=hidden id="description'. $pageOrder.'" name="description" value="'. $description .'">
    <input type=button class="'. $editBtnclass .'" id='. $editBtnID.' value="Save my answer"/>
  </fieldset>
</form>';
}
//if there is a return from db make form 2 display:none
//if there is a return from db make form 2 display:none
if ($activityID  > 0){
	   if ($textwidth == "medium"){
        $returnString .= '<div class=toggleon'.$pageOrder.'><div id=viewactivitytextmedium>'. $textForm1 .'</div></div>';
		$returnString .='<div class=toggleoff'.$pageOrder.'><div id=editactivitytextmedium>'. $textForm2 .'</div></div>';	
		}
        elseif ($textwidth == "wide"){
			$returnString .=  '<div class=toggleon'.$pageOrder.'><div id=viewactivitytextwider>'. $textForm1 .'</div></div>';
			$returnString .='<div class=toggleoff'.$pageOrder.'><div id=editactivitytextwider>'. $textForm2 .'</div></div>';
		}
		else{
		$returnString .=  '<div class=toggleon'.$pageOrder.'><div id=viewactivitytext>'. $textForm1 .'</div></div>';
		$returnString .='<div class=toggleoff'.$pageOrder.'><div id=editactivitytext>'. $textForm2 .'</div></div>';	
		}
		
}
else{
		if ($textwidth == "medium"){
		$returnString .= '<div class=toggleoff'.$pageOrder.'><div id=viewactivitytextmedium>'. $textForm1 .'</div></div>';
		$returnString .='<div class=toggleon'.$pageOrder.'><div id=editactivitytextmedium>'. $textForm2 .'</div></div>';	
		}
		elseif ($textwidth == "wide"){
		$returnString .= '<div class=toggleoff'.$pageOrder.'><div id=viewactivitytextwider>'. $textForm1 .'</div></div>';
		$returnString .='<div class=toggleon'.$pageOrder.'><div id=editactivitytextwider>'. $textForm2 .'</div></div>';	
		}
		else{
		$returnString .= '<div class=toggleoff'.$pageOrder.'><div id=viewactivitytext>'. $textForm1 .'</div></div>';
		$returnString .='<div class=toggleon'.$pageOrder.'><div id=editactivitytext>'. $textForm2 .'</div></div>';	
		}
}
return $returnString;
}//end text area shortcode

//******************************************************************************************************************
//WIDGETS
// Creating the widget 
class tcs_public_forum_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'tcs_public_forum_widget', 

// Widget name will appear in UI
__('(bbPress) Public Forum List', 'tcs_public_forum_widget_domain'), 

// Widget description
array( 'description' => __( 'This widget displays a list of public forums', 'tcs_public_forum_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

//Get the forums in a list and echo them out.
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM wp_posts  WHERE post_status='publish' and post_type='forum'", OBJECT );
foreach ($results as $row){
$content .="<a href='" . site_url()."/?p=".$row->ID."'>".$row->post_title."</a><br>";
}
echo $content;
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'tcs_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class tcs_widget ends here

// Register and load the widget
function tcs_load_widget() {
	register_widget( 'tcs_public_forum_widget' );
}
add_action( 'widgets_init', 'tcs_load_widget' );
?>