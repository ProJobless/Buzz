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
				<?php 
				if($this->session->flashdata('error'))
					{
				?>
				<div class="alert alert-error">
				  <button data-dismiss="alert" class="close" type="button">×</button>
				  <?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php }
				?>
				<div class="box">
					<div class="box-header">
						<div class="title">Ticket ID : #<?php echo $ticket_data['ticket']->id; ?></div>
					</div>
					<div class="box-content padded">
						<ul class="chat-box">
							<ul class="chat-box">
								<li class="arrow-box-right">
									<div class="avatar"><img src="<?php echo base_url()."/images/p/".$ticket_data['user'][0]->profile_pic; ?>" class="avatar-small"></div>
									<div class="info">
										<span class="name"><strong><?php echo $ticket_data['user'][0]->username; ?></strong> <span class="badge badge-cyan">Hype Ninja Member</span></span>
										<span class="time"><?php echo $this->process_model->fix_time(strtotime($ticket_data['ticket']->create_time)); ?></span>
									</div>
									<?php echo $ticket_data['ticket']->body; ?>
								</li>
								<li class="divider"></li>
								<?php foreach($ticket_data['chat'] as $t) {
									if($t->admin_id == 0) {
								?>
								<li class="arrow-box-right">
									<div class="avatar"><img src="<?php echo base_url()."/images/p/".$ticket_data['user'][0]->profile_pic; ?>" class="avatar-small"></div>
									<div class="info">
										<span class="name"><strong><?php echo $ticket_data['user'][0]->username; ?></strong> <span class="badge badge-cyan">Hype Ninja Member</span></span>
										<span class="time"><?php echo $this->process_model->fix_time(strtotime($t->timestamp)); ?></span>
									</div>
									<?php echo $t->body; ?>
								</li>
								<li class="divider"></li>
								
								<?php } else{ ?>
									
								<li class="arrow-box-left gray">
									<div class="avatar"><img src="<?php echo base_url()."/images/p/".$ticket_data['admins'][$t->admin_id]->profile_pic; ?>" class="avatar-small"></div>
									<div class="info">
										<span class="name"><strong><?php echo $ticket_data['admins'][$t->admin_id]->name; ?></strong> <span class="badge badge-red"><?php echo $ticket_data['admins'][$t->admin_id]->rank; ?></span></span>
										<span class="time"><?php echo $this->process_model->fix_time(strtotime($t->timestamp)); ?></span>
									</div>
								<?php echo $t->body; ?>
								</li>
								<li class="divider"></li>
								<?php } } ?>
							</ul>
						</ul>
						<div class="box">
							<div class="box-content padded">

								<div class="fields">
									<div class="avatar avatar-current"><img src="<?php echo base_url()."/images/p/".$ticket_data['admins'][$this->session->userdata('id')]->profile_pic; ?>" class="avatar-small"></div>
								</div>

								<form action="<?php echo site_url('admincp/support/add_reply')."/".$this->uri->segment(4); ?>" class="fill-up" method="POST">
									<div class="chat-message-box">
										<textarea name="ticket_reply"></textarea>
									</div>

									<div class="clearfix actions">
										<div class="pull-right faded-toolbar">
											<button type="submit" class="btn btn-blue btn-mini">Add Response</button>
										</div>
									</div>
								</form>

							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>