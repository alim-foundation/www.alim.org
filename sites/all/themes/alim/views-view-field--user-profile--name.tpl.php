<?php
// Diplaying values in user profile page
global $base_url;
global $theme_path;

// taking user data using username.

$temp_user = user_load(array('name' => strip_tags($output)));
//print_r($temp_user);
$uid = $temp_user->uid; 
$created = $temp_user->created; 
$mail = $temp_user->rpx_data['profile']['email'];
//$gender =  $temp_user->rpx_data['profile']['gender'];
$gender =  $temp_user->gender;
$biography =  $temp_user->Biography;
$arr_role =  $temp_user->roles;
$picture = $temp_user->picture; 
?>

<table width="100%" border="0" cellpadding="2" cellspacing="2">
			  <tr>
				<td  valign="top" width="60">
				<?php
				//User picture and enlargement code.
				if($picture!="")
				{
			
					if($temp_user->rpx_data['profile']['name']['givenName']!="")
					{
					  $title = $temp_user->rpx_data['profile']['name']['givenName'].' '.$temp_user->rpx_data['profile']['name']['familyName'];
					}
					else
					{
					  $title = strip_tags($output);
					}
			?>
			<script language="javascript">
			
			var ddimgtooltip={

	tiparray:function(){
		var tooltips=[]
           tooltips[0]=["<?=$base_url?>/<?=$picture?>", "<?=$title?>", {background:"white", font:"bold 12px Arial"}]

		return tooltips 
	}(),

	tooltipoffsets: [20, -30], 

	tipprefix: 'imgtip',

	createtip:function($, tipid, tipinfo){
		if ($('#'+tipid).length==0){ 
			return $('<div id="' + tipid + '" class="ddimgtooltip" />').html(
				'<div style="text-align:center"><img src="' + tipinfo[0] + '" /></div>'
				+ ((tipinfo[1])? '<div style="text-align:left; margin-top:5px">'+tipinfo[1]+'</div>' : '')
				)
			.css(tipinfo[2] || {})
			.appendTo(document.body)
		}
		return null
	},

	positiontooltip:function($, $tooltip, e){
		var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
		var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
		x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(ddimgtooltip.tooltipoffsets[0]*2) : x
		y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
		$tooltip.css({left:x, top:y})
	},
	
	showbox:function($, $tooltip, e){
		$tooltip.show()
		this.positiontooltip($, $tooltip, e)
	},

	hidebox:function($, $tooltip){
		$tooltip.hide()
	},


	init:function(targetselector){
		jQuery(document).ready(function($){
			var tiparray=ddimgtooltip.tiparray
			var $targets=$(targetselector)
			if ($targets.length==0)
				return
			var tipids=[]
			$targets.each(function(){
				var $target=$(this)
				$target.attr('rel').match(/\[(\d+)\]/) 
				var tipsuffix=parseInt(RegExp.$1) 
				var tipid=this._tipid=ddimgtooltip.tipprefix+tipsuffix 
				var $tooltip=ddimgtooltip.createtip($, tipid, tiparray[tipsuffix])
				$target.mouseenter(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.showbox($, $tooltip, e)
				})
				$target.mouseleave(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.hidebox($, $tooltip)
				})
				$target.mousemove(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.positiontooltip($, $tooltip, e)
				})
				if ($tooltip){ 
					$tooltip.mouseenter(function(){
						ddimgtooltip.hidebox($, $(this))
					})
				}
			})

		}) 
	}
}

ddimgtooltip.init("*[rel^=imgtip]")

</script>
				  
<a href="javascript:void(0);" rel="imgtip[0]">
  <img  src="<?=$base_url?>/<?=$picture?>"  height="48" width="48" align="absmiddle" border="0" />
</a>
<?php  
				
				} 
				else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") 
				{
				
					if($temp_user->rpx_data['profile']['name']['givenName']!="")
					{
					  $title = $temp_user->rpx_data['profile']['name']['givenName'].' '.$temp_user->rpx_data['profile']['name']['familyName'];
					}
					else
					{
					  $title = strip_tags($output);
					}
?>
			<script language="javascript">
			
			var ddimgtooltip={

	tiparray:function(){
		var tooltips=[]

             tooltips[0]=["<?php print $temp_user->rpx_data['profile']['photo']; ?>", "<?=$title?>", {background:"white", font:"bold 12px Arial"}]

		return tooltips 
	}(),

	tooltipoffsets: [20, -30], 

	tipprefix: 'imgtip', 

	createtip:function($, tipid, tipinfo){
		if ($('#'+tipid).length==0){ 
			return $('<div id="' + tipid + '" class="ddimgtooltip" />').html(
				'<div style="text-align:center"><img src="' + tipinfo[0] + '" /></div>'
				+ ((tipinfo[1])? '<div style="text-align:left; margin-top:5px">'+tipinfo[1]+'</div>' : '')
				)
			.css(tipinfo[2] || {})
			.appendTo(document.body)
		}
		return null
	},

	positiontooltip:function($, $tooltip, e){
		var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
		var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
		x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(ddimgtooltip.tooltipoffsets[0]*2) : x
		y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
		$tooltip.css({left:x, top:y})
	},
	
	showbox:function($, $tooltip, e){
		$tooltip.show()
		this.positiontooltip($, $tooltip, e)
	},

	hidebox:function($, $tooltip){
		$tooltip.hide()
	},


	init:function(targetselector){
		jQuery(document).ready(function($){
			var tiparray=ddimgtooltip.tiparray
			var $targets=$(targetselector)
			if ($targets.length==0)
				return
			var tipids=[]
			$targets.each(function(){
				var $target=$(this)
				$target.attr('rel').match(/\[(\d+)\]/) 
				var tipsuffix=parseInt(RegExp.$1)
				var tipid=this._tipid=ddimgtooltip.tipprefix+tipsuffix 
				var $tooltip=ddimgtooltip.createtip($, tipid, tiparray[tipsuffix])
				$target.mouseenter(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.showbox($, $tooltip, e)
				})
				$target.mouseleave(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.hidebox($, $tooltip)
				})
				$target.mousemove(function(e){
					var $tooltip=$("#"+this._tipid)
					ddimgtooltip.positiontooltip($, $tooltip, e)
				})
				if ($tooltip){ 
					$tooltip.mouseenter(function(){
						ddimgtooltip.hidebox($, $(this))
					})
				}
			})

		})
	}
}

ddimgtooltip.init("*[rel^=imgtip]")
			</script>

	<a href="javascript:void(0);" rel="imgtip[0]" />
	<img  src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" align="absmiddle" height="48" width="48" />
		</a>

<div style="clear:both"></div>
<?php } ?>
<?php if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") {?><img src='<?=$base_url?>/<?=$theme_path?>/images/user48_b.png'  align="absmiddle" /><?php } ?></td>
				<td>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
					  <tr>
						<td colspan="2" valign="top"><h2>
						<?php
										if($temp_user->rpx_data['profile']['name']['givenName']!="")
										{
										  print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
										}
										else
										{
										  print strip_tags($output);
										}
							?>
</h2></td>
					  </tr>
					  <?php
					  if($biography!="")
						{
						?>
					  <tr>
					    <td colspan="2"><?php

print "<div style='background:#F6F6F6;padding:10px;'>$biography</div>";

?></td>
				      </tr>
					  <?php
					  }
					  ?>
					  <tr>
						<td width="43%"><strong><!--Email: </strong><?=$mail?>--><strong>Profile Created : </strong>
					    <?=date("d M Y",$created)?></td>
						<td width="57%"><?php if($gender) : ?>
                          <strong>Gender:</strong>
                          <?=$gender?>
                          <?php endif; ?></td>
					  </tr>
					  <tr>
					    <td><strong>Roles : </strong> <?=$role?>
						<?php
						// shows all user roles.
						$stop = count($arr_role);
						$i=0;
						foreach($arr_role as $val)
						{
						   $i++;
						   print $val;
						   if($i!=$stop)
						      print ", ";
						
						}
						?>						 </td>
				        <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td colspan="2"><?php
 /*?>if($is_admin) 
{
		
	if(arg(0)=='userprofile' && arg(1)=="")
	{
	?>
	<a href="node/163634" class="popups upgrade_role">Click here to Upgrade Your Role</a>
	<?php
	}
}
<?php */?></td>
				      </tr>
					</table>	
</td>
			  </tr>
			</table>



