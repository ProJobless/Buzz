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
						<div class="title">Add Email Template</div>
					</div>

					<div class="box-content padded">
						<?php echo form_open('admincp/email/create_template', array('class' => 'fill-up form-horizontal')); ?>
						<div class="padded">
							<div class="control-group">
								<label class="control-label">Email Name</label>
								<div class="controls">
									<input type="text" name="name" placeholder="General name to identify the email" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Subject</label>
								<div class="controls">
									<input type="text" name="subject" placeholder="Subject of the Email" value=""/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email Body</label>
								<div class="controls">
									<textarea name="body" placeholder="Content of the email. (HTML tags allowed)" rows="10"></textarea>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-blue">Create Template</button>			  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				