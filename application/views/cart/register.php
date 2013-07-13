<?php form_open(); ?>
<div class="ls_container">
	<div class="box">
		<div class="box-header">HypeNinja - Register</div>
		<div class="box-content">
			<div class="span9">
				<div class="breadcrumb">
					<ul>
						<li class="active"><a href="#">Register</a></li>
						<li><a href="#">Payment</a></li>
					</ul>
				</div>
				<h1>Register</h1>
				<?php echo $this->session->flashdata('key'); echo form_open('cart/r2/'.$this->uri->segment(3)); ?>
				<div class="control-box">
					<label>First Name</label>
					<input type="text" name="first_name" placeholder="First Name">
				</div>
				<div class="control-box">
					<label>Last Name</label>
					<input type="text" name="last_name" placeholder="Last Name">
				</div>
				<div class="control-box">
					<label>Company</label>
					<input type="text" name="company" placeholder="Company">
				</div>
				<div class="control-box">
					<label>Email</label>
					<input type="email" name="email" placeholder="Email">
				</div>
				<div class="control-box">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class="control-box">
					<label>Password Confirm</label>
					<input type="password" name="password_confirm" placeholder="Password Confirmation">
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-blue">Register</button>
				</div>
				<?php echo form_close();?>
			</div>	
			<div class="span3">
				<h1>Cart</h1>
				<div class="item-name"><?php echo $plan_data->name; ?></div>
				<div class="item-price">$<?php echo number_format($plan_data->price,2); ?></div>
			</div>
			<div class="clearfix"></div>
		</div
		
	</div>
</div>