<div class="main-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="area-top clearfix">
				<div class="pull-left header">
					<h3 class="title"><?php echo $heading; ?></h3>
					<h5>Keywords : <?php echo $campaign_data[0]->keywords; ?></h5>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span12">
				<div class="pull-right padded" style="padding-top:0;">
					<a href="#" class="btn btn-black refresh_button" onclick="refresh_twitter();return false;"><i class="icon-repeat"></i> Refresh Tweets</a>
					<script type="text/javascript">
					function refresh_twitter()
					{
						$(".refresh_button").html('<i class="icon-refresh icon-spin"> </i> Synchronizing');
						$.ajax({
							url: '<?php echo site_url('campaign/refresh_twitter'); ?>',
							success: function(msg)
							{
								if(msg == "refreshed")
								{
									console.log('Refreshed');
									Growl.success({
										title: "New tweets found!",
										text: "Please refresh the page to load new tweets."
									});
									$(".refresh_button").html('<i class="icon-repeat"> </i> Refresh Tweets');
								}
								else
								{
									console.log('Failed');
									Growl.error({
										title: "Oops!",
										text: "There was an error in refreshing the tweets"
									});
								}
							}
						});
					}
					</script>
				</div>
				<div class="clearfix"></div>
				<div class="box">
					<div class="box-header">
						<div class="title"><?php echo $campaign_data[0]->name; ?></div>
						<ul class="nav nav-tabs nav-tabs-right">
							<li class="active"><a data-toggle="tab" href="#twitter">Twitter</a></li>
							<li><a data-toggle="tab" href="#facebook">Facebook</a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<div class="tab-content">
							<div id="twitter" class="tab-pane active">
								<?php $this->load->model('buzz_model', 'buzz'); 
								foreach($tweets as $t) { ?>
								<ul class="chat-box timeline">
									<li class="arrow-box-left gray">
										<div class="avatar"><img src="<?php echo $t->profile_image; ?>" class="avatar-small"></div>
										<div class="info">
											<span class="name">
												<span class="label label-green">Twitter</span> <span class="label label-blue"><?php echo $t->keyword; ?></span><strong class="indent"><?php echo $t->tweeter_name; ?></strong>
											</span>
											<span class="time"><i class="icon-time"></i> <?php echo $this->buzz->fix_time($t->timestamp); ?></span>
										</div>
										<div class="content">
											<blockquote><?php echo $this->buzz->parse_keywords($t->tweet, $t->keyword); ?></blockquote>
											<div class="pull-right">
												<a class="btn btn-red" href="<?php echo $t->tweet_url; ?>" target="_blank">View on Twitter</a>
												<button type="button" class="btn btn-green" data-toggle="modal" data-target="#tweet_<?php echo $t->id; ?>">Comment</button>
											</div>
										</div>
										<div id="tweet_<?php echo $t->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h3 id="myModal">Reply</h3>
											</div>
											<div class="modal-body">
												<p><?php echo $t->tweet; ?></p>
												<form class="form-horizontal fill-up separate-sections" name="form_<?php echo $t->id; ?>" onsubmit="post_tweet(<?php echo $t->tweet_id; ?>,<?php echo $t->id; ?>);return false;">
													<div>
														<select id="twitter_<?php echo $t->id; ?>">
															<?php foreach($twitter_accounts as $p) { ?>
															<option value="<?php echo $p->id; ?>"><?php echo $p->twitter_screen_name; ?></option>
															<?php } ?>
														</select>
													</div>
													<div>
														<textarea placeholder="Reply to the tweet" class="reply_tweet_<?php echo $t->id; ?>" rows="4">@<?php echo $t->tweeter_screen_name; ?> </textarea>
														<input type="hidden" class="tns_<?php echo $t->id; ?>" value="<?php echo $t->tweeter_screen_name; ?>">
													</div>
													
													<div class="modal-footer">
														<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
														<button class="btn btn-blue">Reply</button>
													</div>
												</form>
											</div>
										</div>
									</li>
								</ul>
								<?php } ?>
								<script>
								function post_tweet(t_id, id)
								{
									var t_n_s = $(".tns_"+id).val();
									var tweet = $(".reply_tweet_"+id).val();
									var t_u_i = $("#twitter_"+id).val();
									
									$.ajax({
										type: "POST",
										url: '<?php echo site_url('headquarters/process/twitter/reply')."/"; ?>'+t_id,
										data: 't_n_s='+t_n_s+'&reply_tweet='+tweet+'&t_u_i='+t_u_i,
										success: function(msg)
										{
											console.log(msg);
											if(msg == "success")
											{
												Growl.success({
													title: "Success!",
													text: "You tweet has been successfully posted."
												});
												
											}
											else
											{
												Growl.error({
													title: "Oops!",
													text: "There was an error in posting your tweet. Please contact support."
												});
											}
										}
									});
								}
								</script>
							</div>
							<div id="facebook" class="tab-pane">Will be up soon!</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>