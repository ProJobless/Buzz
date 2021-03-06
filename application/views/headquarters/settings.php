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
											<label class="control-label">Profile Pic</label>
											<div class="controls">
												<img width="100px" style="margin-right:20px" src="<?php echo base_url()."images/p/".$s[0]->profile_pic; ?>">
												<button class="btn btn-green" href="#modal-form" data-toggle="modal">Upload</button>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Plan</label>
											<div class="controls">
												<label class="control-label"><?php echo $s[0]->plan_id; ?></label>
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
			<div class="modal hide fade" id="modal-form" style="display: none;" aria-hidden="true">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					<h6 id="modal-formLabel">Upload Profile Picture</h6>
				</div>
				<div class="modal-body">
					<?php echo form_open_multipart('headquarters/settings/upload_pic', array('class' => 'form-horizontal fill-up separate-sections')); ?>
					<div>
						<div class="row-fluid">
							<div class="span12">
								<div class="span3">
									<label>Profile Picture</label>
								</div>
								<div class="span9">
									<input type="file" name="profile_pic">
								</div>
							</div>
						</div>
					</div>
					<div class="divider"><span></span></div>
					<div class="modal-footer">
						<button data-dismiss="modal" class="btn btn-default">Close</button>
						<button class="btn btn-blue" type="submit">Upload Picture</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>	