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
						<div class="title">Ticket ID : #<?php echo $ticket_data['ticket']->id; ?></div>
					</div>
					<div class="box-content padded">
						<ul class="chat-box">
							<ul class="chat-box">
								<?php foreach($ticket_data['chat'] as $t) {
									if($t->admin_id == 0) {
								?>
								<li class="arrow-box-left">
									<div class="avatar"><img src="../../images/avatars/avatar1.jpg" class="avatar-small"></div>
									<div class="info">
										<span class="name"><strong><?php echo $ticket_data['user'][0]->username; ?></strong> <span class="badge badge-cyan">Hype Ninja Member</span></span>
										<span class="time">8 minutes ago</span>
									</div>
									<?php echo $t->body; ?>
								</li>
								<?php } else{ ?>
								<li class="divider"></li>

								<li class="arrow-box-right gray">
									<div class="avatar"><img src="<?php echo $ticket_data['admins'][$t->admin_id]->profile_pic; ?>" class="avatar-small"></div>
									<div class="info">
										<span class="name"><strong><?php echo $ticket_data['admins'][$t->admin_id]->name; ?></strong> <span class="badge badge-red"><?php echo $ticket_data['admins'][$t->admin_id]->rank; ?></span></span>
										<span class="time">3 minutes ago</span>
									</div>
								<?php echo $t->body; ?>
								</li>
								<?php } } ?>
							</ul>
						</ul>

						<div class="box">
							<div class="box-content padded">

								<div class="fields">
									<div class="avatar"><img src="<?php //User Profile image link ?>" class="avatar-small"></div>
								</div>

								<form action="<?php echo site_url('headquarters/support/add_reply')."/".$this->uri->segment(4); ?>" class="fill-up" method="POST">

									<div class="chat-message-box">
										<textarea name="support"></textarea>
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

<!-- Array ( 
[ticket] => stdClass Object ( [id] => 1 [subject] => Issue [body] => I am facing an issue that this app is so cool! [create_time] => 2013-06-19 11:39:11 [last_update_time] => 2013-06-28 00:00:00 [status] => 1 [user_id] => 1 ) 

[chat] => Array ( 

[0] => stdClass Object ( [id] => 1 [body] => This is awesome! [timestamp] => 2013-06-18 00:00:00 [ticket_id] => 1 [user_id] => 1 [admin_id] => 0 ) 

[1] => stdClass Object ( [id] => 2 [body] => Yeah it s cool! [timestamp] => 2013-06-20 00:00:00 [ticket_id] => 1 [user_id] => 0 [admin_id] => 1 ) ) 

[admins] => Array ( [0] => stdClass Object ( [id] => 1 [username] => admin [password] => 1a1dc91c907325c69271ddf0c944bc72 [last_login] => 2013-06-14 21:02:21 [ip] => ) ) )  -->