<?php
global $user;
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
  global $theme_path;
  global $base_url; 
  $img_theme_path = $base_url."/".$theme_path."/images"; 

 
 
 
?>
<?php foreach ($fields as $id => $field): ?>
   <?php //print $field->content; ?><?php //print $id ; ?>
  <?php if($id == 'created' ): ?>
  
  <?php $created = $field->content; ?>
  <?php endif; ?> 
  <?php if($id == 'mail' ): ?>
  
  <?php $mail = $field->content; ?>
  <?php endif; ?> 
  <?php if($id == 'login' ): ?>
  
  <?php $login = $field->content; ?>
  <?php endif; ?> 
  <?php if($id == 'name' ): ?>
  
  <?php $name = $field->content; ?>
  <?php endif; ?> 
   <?php if($id == 'uid' ): ?>
  
  <?php $uid = $field->content; ?>
  <?php endif; ?>
  
  
<?php endforeach;







/*
print  $user->rpx_data['profile']['name']['givenName'].'<br/>';

 print .'<br/>';
print  $user->rpx_data['profile']['name']['displayName'].'<br/>';
 print  .'<br/>';
 print .'<br/>';
  print .'<br/>';
 print .'<br/>';
 print  $user->rpx_data['profile']['address']['locality'].'<br/>'; 
  print   .'<br/>';
    print  .'<br/>';
	 print  .'<br/>';*/
//print_r($user);
//print_r($user->roles);
?>
<table class="profile_dis" width="400" border="0" cellpadding="3" cellspacing="5">
 <!-- <tr>
    <td >Username :</td>
    <td><?php print $name; ?></td>
  </tr>-->
  <tr>
    <td>Account Created on : </td>
    <td><font style="color:#000000;font-weight:400;"><?php  $created; ?><?php $seconduser = user_load(arg(1));
	 $seconduser->created;
	print date ( 'l jS \of F Y h:i:s A' , $seconduser->created  );
	?></font></td>
	
  </tr>
  <!--<tr>
    <td>Last Login :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $login; ?></font></td>
  </tr>-->
  <?php  if(arg(1)!=$user->uid){
?> 
<!--<tr>
    <td >Username :</td>
    <td><?php print $name; ?></td>
  </tr>-->

<?php } ?>
 <?php  if(arg(1)==$user->uid){
?>  <tr>
    <td>Email Address :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $mail; ?></font></td>
  </tr>
  <?php if($user->rpx_data['profile']['name']['givenName']!=""){ ?>
  <tr>
    <td> Name :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['name']['givenName']." ".$user->rpx_data['profile']['name']['familyName']; ?></font></td>
  </tr>
  <?php }?>
  <?php if($user->rpx_data['profile']['gender']!=""){ ?>
  <tr>
    <td>Gender :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['gender']; ?></font></td>
  </tr>
   <?php }?>
   <?php if($user->rpx_data['profile']['birthday']!=""){ ?>
 <!-- <tr>
    <td>Date of Birth :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['birthday']; ?></font></td>
  </tr>-->
  <?php }?>
   <?php if($user->rpx_data['profile']['phoneNumber']!=""){ ?>
  <!--<tr>
    <td>Phone Number :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['phoneNumber']; ?></font></td>
  </tr>-->
  <?php }?>
   <?php if($user->rpx_data['profile']['address']['streetAddress']!=""){ ?>
<!--  <tr>
    <td>Address :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['address']['streetAddress'] ; ?></font></td>
  </tr>-->
  <?php }?>
   <?php if($user->rpx_data['profile']['address']['region']!=""){ ?>

 <!--   <tr>
  <td>&nbsp;</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['address']['region']; ?></font></td>
  </tr>-->
  <?php }?>
   <?php if($user->rpx_data['profile']['address']['postalCode']!=""){ ?>

 <!-- <tr>
    <td></td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['address']['postalCode']; ?></font></td>
  </tr>-->
   <?php }?>
   <?php if($user->rpx_data['profile']['address']['country']!=""){ ?>

 <!-- <tr>
    <td>Country :</td>
    <td><font style="color:#000000;font-weight:400;"><?php print $user->rpx_data['profile']['address']['country']; ?></font></td>
  </tr>-->
   <?php }}?>
</table>
<?php

$rr= implode(",", $user->roles).'.....';
$t= strpos($rr,"System Administrator");
if($t==""){
 ?>
<!--<ul class="menu_account"><li class="active" ><a href="<?php print $base_url;  ?>/users/<?php print $name;  ?>" >View</a></li>

<li ><a href="<?php print $base_url;  ?>/user/<?php print $uid; ?>/edit">Edit</a></li>
<li ><a class="popups" href="<?php print $base_url;  ?>/node/164535">Upgrade Your Role</a></li>
</ul>-->

<br />
<br />
<b style="color:#990000;"> Click <a style="color:#990000;text-decoration:none;" class="popups" href="<?php print $base_url;  ?>/node/163634">here to Upgrade Your Role</a></b>

<?php } ?>