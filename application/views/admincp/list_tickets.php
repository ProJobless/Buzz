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
						<span class="title">Active Tickets</span>
						<ul class="box-toolbar">
							<li><span class="label label-green"><?php echo $total; ?> Tickets</span></li>
						</ul>
					</div>
					<div class="box-content">
						<table class="table table-normal">
							<thead>
								<tr>
									<td>ID</td>
									<td>Subject</td>
									<td>Created</td>
									<td>Last Updated</td>
									<td style="width: 80px">User</td>
									<td style="width: 100px">Edit User</td>
								</tr>
							</thead>
							<tbody>
								<?php $this->load->model('admin_model', 'admin'); foreach($tickets as $t){ ?>
									<tr>
										<td class="icon"><?php echo $t->id; ?></td>
										<td><?php echo $t->subject; ?></td>
										<td><?php echo date('M j, Y, h:i A', strtotime($t->create_time)); ?></td>
										<td><?php echo date('M j, Y, h:i A', strtotime($t->last_update_time)); ?></td>
										<td><?php echo $this->admin->get_username_by_id($t->user_id); ?></td>
										<td><?php echo anchor('admincp/support/view_ticket/'.$t->id, 'View Ticket', 'class="btn btn-green"');?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
					