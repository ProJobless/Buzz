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
							<li class="active"><a data-toggle="tab" href="#general"><span>General</span></a></li>
							<li class=""><a data-toggle="tab" href="#twitter"><span>Twitter</span></a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<?php echo form_open('campaign/manager/save', array('class' => 'fill-up form-horizontal')); ?>
							<div class="tab-content">
								<div id="general" class="tab-pane active">
									<div class="padded">
										<div class="control-group">
											<label class="control-label">Campaign Name</label>
											<div class="controls">
												<input type="text" name="name" placeholder="Campaign Name" value="<?php echo $campaign_settings[0]->name;?>"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Keywords</label>
											<div class="controls">
												<input type="text" name="keywords" placeholder="Keywords (Comma separated)" value="<?php echo $campaign_settings[0]->keywords;?>"/>
												<span class="help-block note">Please input comma separated keywords.</span>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-blue">Save Changes</button>			            
									</div>
								</div>
								<div id="twitter" class="tab-pane">
									<div class="padded">
										<div class="control-group">
											<label class="control-label">Twitter Accounts</label>
												<div class="controls"> 
													<select name="twitter[]" multiple>
														<?php foreach($twitter_accounts as $t){ ?>
															<option value="<?php echo $t->id; ?>" <?php if(in_array($t->id, json_decode($campaign_settings[0]->twitter_id))){ echo 'selected="selected"'; } ?>><?php echo $t->twitter_screen_name; ?></option>
														<?php }?>	
													</select>
												</div>					
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-blue">Save Changes</button>			            
									</div>
								</div>
							</div>
						<?php echo form_hidden('id', $this->uri->segment(4)); echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	