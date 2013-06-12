<div class="main-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="area-top clearfix">
				<div class="pull-left header">
					<h3 class="title"><?php echo $heading; ?></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-header">
						<div class="title">Settings</div>
						
	        			<ul class="nav nav-tabs nav-tabs-right">
							<li><a href="<?php echo site_url('headquarters/settings/'); ?>">General Settings</a></li>
							<li class="active"><a href="<?php echo site_url('headquarters/settings/twitter_accounts'); ?>"><span>Twitter</span></a></li>
						</ul>
					</div>
					<table class="table table-normal">
						<thead>
							<tr>
								<td></td>
								<td>Twitter Account</td>
								<td style="width: 150px">Tweets Via Hype Ninja</td>
								<td style="width: 100px">Enable/Disable</td>
								<td style="width: 100px">Delete</td>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; foreach($t_accounts as $t) {?>
								<tr class="" id="tr_<?php echo $t->id; ?>">
									<td class="icon"><?php echo $i; ?></td>
									<td><a href="<?php echo "http://twitter.com/".$t->twitter_screen_name; ?>" target="_blank"><?php echo $t->twitter_screen_name; ?></a></td>
									<td>0</td>
									<td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Actions</button>
											<ul class="dropdown-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
												<li class="divider"></li>
												<li><a href="#">Separated link</a></li>
											</ul>
										</div>
									</td>
									<td><a onclick="delete_account(<?php echo $t->id; ?>);return false;" class="btn btn-red">Delete</a></td>
								</tr>
							<?php $i++; } ?>
							<script>
							function delete_account(t_id)
							{
								$.ajax({
									url: '<?php echo site_url('headquarters/settings/twitter_accounts/delete')."/"; ?>'+t_id,
									success: function(msg)
									{
										if(msg == "deleted")
										{
											Growl.success({
												title: "Success!",
												text: "Twitter account has been succesfully deleted."
											});
											$("#tr_"+t_id).fadeOut(500);
										}
										else
										{
											Growl.error({
												title: "Oops!",
												text: "There was an error in deleting the twitter account."
											});
										}
									}
								});
							}
							</script>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					<a class="btn btn-green" href="<?php echo site_url('headquarters/process/add_twitter');?>">Add Twitter Account</a>
				</div>
			</div>
		</div>
	</div>
</div>