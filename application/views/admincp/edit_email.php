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
						<div class="title">Edit Email Template</div>
					</div>

					<div class="box-content padded">
						<?php echo form_open('admincp/email/save_edited_template', array('class' => 'fill-up form-horizontal')); ?>
						<div class="padded">
							<div class="control-group">
								<label class="control-label">Email Name</label>
								<div class="controls">
									<input type="text" name="name" placeholder="General name to identify the email" value="<?php echo $email_data->name; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Slug</label>
								<div class="controls">
									<input type="text" name="slug" placeholder="Short name of Email(Without Space)" value="<?php echo $email_data->slug; ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Subject</label>
								<div class="controls">
									<input type="text" name="subject" placeholder="Subject of the Email" value="<?php echo $email_data->subject; ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email Body</label>
								<div class="controls">
									<textarea name="body" placeholder="Content of the email. (HTML tags allowed)" rows="10"><?php echo $email_data->body; ?></textarea>
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $this->uri->segment(4); ?>">
						</div>
						<div class="row-fluid">
							<div class="box">
								<div class="box-header">
									<span class="title">Available Email Variables</span>
								</div>
								<div class="box-content padded">
									<p>{$username} 			= Username of the user</p>
									<p>{$email}				= Email of the user</p>
									<p>{$first_name}		= First name of user</p>
									<p>{$last_name}			= Last name of the user</p>
									<p>{$plan_id} 			= Plan ID</p>
									<p>{$company}			= Company of the user</p>
									<p>{$invoice_id}		= Invoice ID</p>
									<p>{$ticket_id} 		= Ticket ID</p>
									<p>{$ticket_body}		= Body of the opened ticket</p>
									<p>{$ticket_reply_id} 	= Reply ID</p>
									<p>{$ticket_reply}		= Reply to the ticket by Admin</p>
								</div>
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" class="btn btn-blue">Save Template</button>			  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>