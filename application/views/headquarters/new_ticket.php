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
						<div class="title">Submit a ticket</div>
					</div>
					<div class="box-content padded">
						<?php echo form_open('headquarters/support/submit_ticket', array('class' => 'fill-up form-horizontal')); ?>	
						<div class="padded">
							<div class="control-group">
								<label class="control-label">Subject</label>
								<div class="controls">
									<input type="text" name="subject" placeholder="Subject" value=""/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Message</label>
								<div class="controls">
									<textarea name="ticket_message" style="max-width:100%;min-width:100%;min-height:100px;"></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Priority</label>
								<div class="controls">
									<select name="priority">
										<option value="1">Low</option>
										<option value="2">Medium</option>
										<option value="3">High</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-blue">Save Changes</button>			            
						</div>
					<?php echo form_close(); ?>			
				</div>
			</div>
		</div>
	</div>
</div>