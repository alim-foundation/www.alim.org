<?php
// Purpose : show / hide each translator in compare translation page.
//Set the the cookie value for each translator in compare translation page.

global $base_url;
global $theme_path;
global $user;

$chek_asd = 1;
$chek_mal = 1;
$chek_pic = 1;
$chek_yuf = 1;
$expire=time()+(60*60*24*365*5); // 5 year
/*if($user->uid)
{
  if(isset($_COOKIE['rem_uid']))
  {
	  if($_COOKIE['rem_uid']==$user->uid)
	  {
	    $expire = time()+200000;
	  }
  }
}*/

							if(arg(6)=='showasd')
							{
								setcookie("chek_asd", 1, $expire, "/");
								
							}
							if(arg(6)=='hideasd')
							{
								setcookie("chek_asd", 2, $expire, "/");
								
							}
							
							if(arg(6)=='showmal')
							{
								setcookie("chek_mal", 1, $expire, "/");
							
							}
							if(arg(6)=='hidemal')
							{
								setcookie("chek_mal", 2, $expire, "/");
								
							}
							
							if(arg(6)=='showpic')
							{
								setcookie("chek_pic", 1, $expire, "/");
								
							}
							if(arg(6)=='hidepic')
							{
								setcookie("chek_pic", 2, $expire, "/");
								
							}
							
							if(arg(6)=='showyuf')
							{
								setcookie("chek_yuf", 1, $expire, "/");
								
							}
							if(arg(6)=='hideyuf')
							{
								setcookie("chek_yuf",2, $expire, "/");
								
							}

  if($user->uid)
  {	
	// user prefernce value is taken for logined user
	
	$sel_asd = db_query("SELECT value as asd_sel,count(value) as asd_count FROM profile_values WHERE fid=7 AND uid=".$user->uid);
	$fetch_asd = db_fetch_object($sel_asd);
					
	$sel_mal = db_query("SELECT value as mal_sel,count(value) as mal_count FROM profile_values WHERE fid=8 AND uid=".$user->uid);
	$fetch_mal = db_fetch_object($sel_mal);
					
	$sel_pic = db_query("SELECT value as pic_sel,count(value) as pic_count FROM profile_values WHERE fid=9 AND uid=".$user->uid);
	$fetch_pic = db_fetch_object($sel_pic);
					
	$sel_yuf = db_query("SELECT value as yuf_sel,count(value) as yuf_count FROM profile_values WHERE fid=10 AND uid=".$user->uid);
	$fetch_yuf = db_fetch_object($sel_yuf);
	
	($fetch_asd->asd_sel) ? $chek_asd = $fetch_asd->asd_sel : $chek_asd = 2;
	($fetch_mal->mal_sel) ? $chek_mal = $fetch_mal->mal_sel : $chek_mal = 2;
	($fetch_pic->pic_sel) ? $chek_pic = $fetch_pic->pic_sel : $chek_pic = 2;
	($fetch_yuf->yuf_sel) ? $chek_yuf = $fetch_yuf->yuf_sel : $chek_yuf = 2;
	
	if($fetch_asd->asd_count==0)
	{
	 $chek_asd = 1;
	}
	
	if($fetch_mal->mal_count==0)
	{
	 $chek_mal = 1;
	}
	
	if($fetch_pic->pic_count==0)
	{
	 $chek_pic = 1;
	}
	
	if($fetch_yuf->yuf_count==0)
	{
	 $chek_yuf = 1;
	}
 }
	
	
    if(isset($_COOKIE['chek_asd']))
	 $chek_asd = $_COOKIE['chek_asd'];
	if(isset($_COOKIE['chek_mal']))
	 $chek_mal = $_COOKIE['chek_mal'];
	if(isset($_COOKIE['chek_pic']))
	 $chek_pic = $_COOKIE['chek_pic'];
	if(isset($_COOKIE['chek_yuf']))
	 $chek_yuf = $_COOKIE['chek_yuf'];
?>
<?php foreach ($fields as $id => $field): ?>
<?php //print $id;  ?>
  <?php if($id == "field_quran_bk_code_value" ) $field_quran_bk_code_value = $field->content; ?>
  <?php if($id == "field_surah_no_value" ) $field_surah_no_value = $field->content; ?>
  <?php if($id == "field_ayah_no_value" ) $field_ayah_no_value = $field->content; ?>
  <?php if($id == "name" ) $name = $field->content; ?>
    <?php if($id == "body" ) $body = $field->content; ?>
  
<?php endforeach; ?>

<?php
  $flag = 0;
  if($chek_asd==1 && $name == "Asad")
  	 $flag = 1;
  elseif($chek_mal==1 && $name == "Malik")
      $flag = 1;
  elseif($chek_pic==1 && $name == "Pickthall")
       $flag = 1;
  elseif($chek_yuf==1 && $name == "Yusuf Ali")
       $flag = 1;
  elseif($name == "Transliteration")
      $flag = 1;
	  
$class = $_SESSION['class']; 
if($flag==1)
{
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="<?=$class?>">
  <tr>
    <td width="100" valign="top"><a href="<?=$base_url?>/library/quran/surah/english/<?=$field_surah_no_value?>/<?=$field_quran_bk_code_value?>#<?=$field_ayah_no_value?>"><?=$name?></a></td>
	<td width="15" valign="top">:</td>
    <td valign="top"><?=$body?></td>
  </tr>
 </table>
 
 <?php
 if($class=='white')
 $_SESSION['class']='black';
 else
 $_SESSION['class']='white';
 }
 ?>
