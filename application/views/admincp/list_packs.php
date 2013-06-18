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
						<span class="title">Packs</span>
					</div>
					<div class="box-content">
						<table class="table table-normal">
							<thead>
								<tr>
									<td>ID</td>
									<td>Pack Name</td>
									<td>Twitter Accounts</td>
									<td>Number of Users</td>
									<td style="width: 100px">Edit Details</td>
								</tr>
							</thead>
	
							<tbody>
								<?php foreach($packs as $p){ ?>
									<tr>
										<td class="icon"><?php echo $p->id; ?></td>
										<td><?php echo $p->name; ?></td>
										<td><?php echo $p->twitter_accounts; ?></td>
										<td><?php echo $p->num_users; ?></td>
										<td><?php echo anchor('admincp/packs/edit_pack/'.$p->id, 'Edit Pack', 'class="btn btn-green"');?></td>
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