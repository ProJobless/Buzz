<div class="primary-sidebar">
	<ul class="nav nav-collapse collapse nav-collapse-primary">
		<li class="<?php if($sidebar_active == 'dashboard') {echo "active";} ?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('admincp/dashboard'); ?>">
				<span>Dashboard</span>
			</a>
		</li>
		
		<li class="dark-nav <?php if($sidebar_active == 'users') {echo "active";}?>">

			<span class="glow"></span>

			<a href="#users" data-toggle="collapse" class="accordion-toggle <?php if($sidebar_active != 'premium') {echo "collapsed";}?> "><span>Users<i class="icon-caret-down"></i></span></a>

			<ul class="collapse <?php if($sidebar_active == 'users') {echo "in";}?> " id="users">
				<li class="<?php if($side_sub == "list"){echo "active"; } ?>">
					<?php echo anchor('admincp/users/lists', 'List'); ?>
				</li>
			</ul>
		</li>
		
		<li class="<?php if($sidebar_active == 'support') {echo "active";}?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('admincp/support'); ?>">
				<span>Support</span>
			</a>
		</li>
		
		<li class="<?php if($sidebar_active == 'packs') {echo "active";}?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('admincp/packs/lists'); ?>">
				<span>Packs</span>
			</a>
		</li>
		
		<li class="<?php if($sidebar_active == 'analytics') {echo "active";}?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('admincp/analytics'); ?>">
				<span>Analytics</span>
			</a>
		</li>
		<li class="">
			<span class="glow"></span>
			<a href="<?php echo site_url('admincp/'); ?>">
				<span>Settings</span>
			</a>
		</li>
	</ul>

    <hr style="margin-top: 60px" class="divider">

	<div class="sparkline-box side">

		<div class="sparkline-row">
			<h4 class="gray"><span>Orders</span> 847</h4>
		</div>
		<hr class="divider">
	</div>
</div>