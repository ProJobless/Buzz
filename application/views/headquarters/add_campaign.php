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
						<div class="title">Add Campaign</div>
						<?php $can_add = $this->process_model->can_add_campaign(); if($can_add == 1) {?>
	        			<ul class="nav nav-tabs nav-tabs-right">
							<li class="active"><a data-toggle="tab" href="#general"><span>General</span></a></li>
							<li class=""><a data-toggle="tab" href="#twitter"><span>Twitter</span></a></li>
						</ul>
						<?php } ?>
					</div>

					<div class="box-content padded">
						<?php if($can_add == 1) { echo form_open('campaign/manager/create_campaign', array('class' => 'fill-up form-horizontal')); ?>
							<div class="tab-content">
								<div id="general" class="tab-pane active">
									<div class="padded">
										<div class="control-group">
											<label class="control-label">Campaign Name</label>
											<div class="controls">
												<input type="text" name="name" placeholder="Campaign Name" value="" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Keywords</label>
											<div class="controls">
												<input type="text" name="keywords" placeholder="Keywords (Comma separated)" value=""/>
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
															<option value="<?php echo $t->id; ?>"><?php echo $t->twitter_screen_name; ?></option>
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
						<?php echo form_close(); } else {
							echo "Please upgrade your plan to add more campaigns!";
						}?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>