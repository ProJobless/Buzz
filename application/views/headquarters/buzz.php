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
							url: '<?php echo site_url('campaign/refresh_twitter')."/index"."/".$this->uri->segment(4); ?>',
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
									$(".refresh_button").html('<i class="icon-repeat"> </i> Refresh Tweets');
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
												<form class="form-horizontal fill-up separate-sections" name="form_<?php echo $t->id; ?>" onsubmit="post_tweet('<?php echo $t->tweet_id; ?>',<?php echo $t->id; ?>);return false;">
													<div>
														<label class="span3">Select Twitter Account</label>
														<select id="twitter_<?php echo $t->id; ?>" class="span8 pull-right">
															<?php foreach($twitter_accounts as $p) { ?>
															<option value="<?php echo $p->id; ?>"><?php echo $p->twitter_screen_name; ?></option>
															<?php } ?>
														</select>
													</div>
													<div class="clearfix"></div>
													<div>
														<label class="span3 pull-left">Schedule Tweet</label>
														<div id="schedule_<?php echo $t->id; ?>" class="span8 input-append pull-right">
															<input data-format="MM/dd/yyyy HH:mm PP" type="text" disabled placeholder="Click on calender icon to schedule the tweet!" id="s_<?php echo $t->id; ?>" />
															<span class="add-on">
																<i data-time-icon="icon-time" data-date-icon="icon-calendar">
																</i>
															</span>
														</div>
														<script type="text/javascript">
														$(function() {
															$('#schedule_<?php echo $t->id; ?>').datetimepicker({
																language: 'en',
																pick12HourFormat: true,
																pickSeconds: true,
															});
														});
														</script>
													</div>
													<div class="clearfix"></div>
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
									var s_t = $("#s_"+id).val();
									$('#tweet_'+id).modal('toggle');
									$.ajax({
										type: "POST",
										url: '<?php echo site_url('headquarters/process/twitter/reply')."/"; ?>'+t_id,
										data: 't_n_s='+t_n_s+'&reply_tweet='+tweet+'&t_u_i='+t_u_i+"&s_t="+s_t+"&c_id=<?php echo $this->uri->segment(4); ?>",
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
											else if(msg == "scheduled")
											{
												Growl.success({
													title: "Success!",
													text: "You tweet has been successfully scheduled to be posted on twitter!"
												});
											}
											else if(msg == "retweet")
											{
												Growl.success({
													title: "Success!",
													text: "You have successfully retweeted!"
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
								function retweet(t_id, t_u_i)
								{
									$.ajax({
										type: "POST",
										url: '<?php echo site_url('headquarters/process/twitter/retweet')."/"; ?>'+t_id,
										data: 't_u_i'+t_u_i,
										success: function(msg)
										{
											if(msg == "retweet")
											{
												Growl.success({
													title: "Success!",
													text: "You have successfully retweeted!"
												});
											}
											else
											{
												Growl.error({
													title: "Oops!",
													text: "There was an error in retweeting your tweet. Please contact support."
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