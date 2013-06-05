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
				<div class="box">
					<div class="box-header">
						<div class="title">Right tabs</div>
						<ul class="nav nav-tabs nav-tabs-right">
							<li class="active"><a data-toggle="tab" href="#twitter">Twitter</a></li>
							<li><a data-toggle="tab" href="#facebook">Facebook</a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<div class="tab-content">
							<div id="twitter" class="tab-pane active">
								<ul class="chat-box timeline">
									<li class="arrow-box-left gray">
										<div class="avatar"><img src="../../images/avatars/avatar1.jpg" class="avatar-small"></div>
										<div class="info">
											<span class="name">
												<span class="label label-green">Twitter</span><strong class="indent">Janine</strong> posted a comment on this task: <strong>Core Admin</strong>
											</span>
											<span class="time"><i class="icon-time"></i> 3 minutes ago</span>
										</div>
										<div class="content">
											<blockquote>Hi.</blockquote>
										</div>
									</li>
								</ul>
							</div>
							<div id="facebook" class="tab-pane">Will be up soon!</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>