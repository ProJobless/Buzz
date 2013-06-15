<div class="container">
	<div class="span4 offset4">
		<div class="padded">
			<div style="margin-top: 80px;" class="login box">
				<div class="box-header">
					<span class="title">Login</span>
				</div>
				<div class="box-content padded">
					<?php echo form_open('admincp/login/login_submit', array('class' => 'separate-sections')); ?>
						<div class="input-prepend">
							<input type="text" name="username" placeholder="username">
						</div>
						<div class="input-prepend">
							<input type="password" name="password" placeholder="password">
						</div>
						<div>
							<button type="submit" class="btn btn-blue btn-block">Login</button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>