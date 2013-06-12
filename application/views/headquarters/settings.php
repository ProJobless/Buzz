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
							<li class="active"><a href="<?php echo site_url('headquarters/settings/'); ?>">General Settings</a></li>
							<li><a href="<?php echo site_url('headquarters/settings/twitter_accounts'); ?>"><span>Twitter</span></a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<?php echo form_open('settings/save', array('class' => 'fill-up form-horizontal')); ?>
							<div class="tab-content">
								<div id="general" class="tab-pane active">
									<div class="padded">
										<div class="control-group">
											<label class="control-label">Email Address</label>
											<div class="controls">
												<input type="text" name="email" placeholder="Admin Email Adress" value="<?php echo $s[0]->email; ?>"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Plan</label>
											<div class="controls">
												<label class="control-label"><?php echo $s[0]->plan; ?></label>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-blue">Save Changes</button>			            
									</div>

								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	