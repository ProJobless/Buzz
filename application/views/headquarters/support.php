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
						<div class="title">Active Tickets</div>
					</div>
					<table class="table table-normal">
						<thead>
							<tr>
								<td>ID</td>
								<td>Ticket Subject</td>
								<td style="width: 100px">Created On</td>
								<td style="width: 100px">Last Updated</td>
								<td style="width: 100px">View</td>
								<td style="width: 80px">Close Ticket</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach($tickets as $t) { if($t->status == 1){?>
								<tr class="">
									<td class="icon">#<?php echo $t->id; ?></td>
									<td><?php echo $t->subject; ?></td>
									<td><?php echo date('M j, Y', strtotime($t->create_time)); ?></td>
									<td><?php echo date('M j, Y', strtotime($t->last_update_time)); ?></td>
									<td><a href="<?php echo site_url('headquarters/support/view')."/".$t->id;?>" class="btn btn-green">View Ticket</a></td>
									<td><a href="<?php echo site_url('headquarters/support/close')."/".$t->id;?>" class="btn btn-red">Close</a></td>
								</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					<?php echo anchor('headquarters/support/add_ticket' ,'Submit a Ticket', array('class'=>"btn btn-green")); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-header">
						<div class="title">Closed Tickets</div>
					</div>
					<table class="table table-normal">
						<thead>
							<tr>
								<td>ID</td>
								<td>Ticket Subject</td>
								<td style="width: 100px">View</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach($tickets as $t) { if($t->status == 0){ ?>
								<tr class="">
									<td class="icon">#<?php echo $t->id; ?></td>
									<td><?php echo $t->subject; ?></td>
									<td><a href="<?php echo site_url('headquarters/support/view')."/".$t->id;?>" class="btn btn-green">View Ticket</a></td>
								</tr>
							<?php }} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>