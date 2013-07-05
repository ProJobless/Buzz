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
						<span class="title">Users</span>
						<ul class="box-toolbar">
							<li><span class="label label-green"><?php echo $total; ?> Users</span></li>
						</ul>
					</div>
					<div class="box-content">
						<table class="table table-normal">
							<thead>
								<tr>
									<td>ID</td>
									<td>Username</td>
									<td>Email</td>
									<td style="width: 40px">Tweets</td>
									<td style="width: 100px">Edit User</td>
									<td style="width: 100px">Ban User</td>
								</tr>
							</thead>
	
							<tbody>
								<?php foreach($users as $u){ ?>
									<tr>
										<td class="icon"><?php echo $u->id; ?></td>
										<td><?php echo $u->username; ?></td>
										<td><?php echo $u->email; ?></td>
										<td><?php echo $u->tweet_count; ?></td>
										<td><?php echo anchor('admincp/users/edit_user/'.$u->id, 'Edit Details', 'class="btn btn-green"');?></td>
										<td><?php if($u->banned == 0){echo anchor('admincp/users/ban_user/'.$u->id, 'Ban User', 'class="btn btn-red"');} 
			  else{
				  echo anchor('admincp/users/unban_user/'.$u->id, 'Unban', 'class="btn btn-red"');
			  }?></td>
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
<?php echo $this->pagination->create_links(); ?>