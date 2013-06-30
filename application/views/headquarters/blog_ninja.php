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
					<a href="#" class="btn btn-black refresh_button" onclick="refresh_blog();return false;"><i class="icon-repeat"></i> Refresh Blog Posts</a>
					<script type="text/javascript">
					function refresh_blog()
					{
						$(".refresh_button").html('<i class="icon-refresh icon-spin"> </i> Synchronizing');
						Growl.info({
							title: "This might take time!",
							text: "Finding blogs all over the internet might take some time. Meanwhile you might wanna check out some other ninjas!"
						});
						$.ajax({
							url: '<?php echo site_url('campaign/refresh_twitter')."/blog"."/".$this->uri->segment(4); ?>',
							success: function(msg)
							{
								if(msg == "refreshed")
								{
									Growl.success({
										title: "New tweets found!",
										text: "Please refresh the page to load new tweets."
									});
									$(".refresh_button").html('<i class="icon-repeat"> </i> Refresh Blog Post');
								}
								else
								{
									Growl.error({
										title: "Oops!",
										text: "There was an error in refreshing the tweets"
									});
									$(".refresh_button").html('<i class="icon-repeat"> </i> Refresh Blog Post');
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
							<li><a href="<?php echo base_url('campaign/buzz/twitter')."/".$this->uri->segment(4); ?>">Twitter Ninja</a></li>
							<li><a href="#facebook">Facebook Ninja</a></li>
							<li class="active"><a href="<?php echo base_url('campaign/buzz/blog')."/".$this->uri->segment(4); ?>">Blog Ninja</a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<?php foreach($blog_posts as $b) {?>
						<div class="box">
							<div class="box-header">
								<div class="title"><a href="<?php echo $b->link; ?>"><?php echo $b->title; ?></a></div>
								<div class="pull-right" style="margin-top:7px; margin-right:10px;">
									<span class="label label-green">Alexa : <?php echo $b->alexa_rank;?></span>
									<span class="label label-blue">Google PR : <?php echo $b->google_pr;?></span>
								</div>
								
							</div>

							<div class="box-content padded">
								<?php echo $b->text; ?>
								<div class="clearfix"></div>
								<div class="pull-right">
									<a class="btn btn-green" target="_blank" href="<?php echo $b->link; ?>">Go to website</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>