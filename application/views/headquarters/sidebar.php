<div class="primary-sidebar">
	<ul class="nav nav-collapse collapse nav-collapse-primary">
		<li class="<?php if($sidebar == 'dashboard'){ echo 'active'; } ?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('headquarters/dashboard'); ?>">
				<span>Dashboard</span>
			</a>
		</li>
		
		<li class="<?php if($sidebar == 'campaign'){ echo 'active'; } ?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('campaign/manager'); ?>">
				<span>Campaigns</span>
			</a>
		</li>
		
		<li class="<?php if($sidebar == 'support'){ echo 'active'; } ?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('headquarters/support'); ?>">
				<span>Support</span>
			</a>
		</li>
		
		<li class="<?php if($sidebar == 'settings'){ echo 'active'; } ?>">
			<span class="glow"></span>
			<a href="<?php echo site_url('headquarters/settings'); ?>">
				<span>Settings</span>
			</a>
		</li>
				
	</ul>

    <hr style="margin-top: 60px" class="divider">

	<div class="sparkline-box side">

		<div class="sparkline-row">
			<h4 class="gray"><span>Tweets via Hype Ninja</span><?php echo $tweets_count; ?></h4>
		</div>
		
		<hr class="divider">
	</div>
</div>