<li class="nav-item">
	<a href="dashboard.php" class="nav-link">
		<i class="fa fa-tasks nav-icon"></i>
		<p>Dashboard</p>
	</a>
</li>

<?php if ($user->user_type_id == USERS_TYPE_NURSE) { ?>

	<li class="nav-item">
		<a href="triage.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Triage</p>
		</a>
	</li>
	<li class="nav-item">
		<a href="item.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Item List</p>
		</a>
	</li>
<?php } ?>

<?php if ($user->user_type_id == USERS_TYPE_CUSTOMER) { ?>


	<li class="nav-item">
		<a href="mother.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Maternal List(doc)</p>
		</a>
	</li>



	<li class="nav-item">
		<a href="appointment.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Appointment List</p>
		</a>
	</li>

<?php } ?>

<?php if ($user->user_type_id == USERS_TYPE_ADMIN) { ?>



	<li class="nav-item">
		<a href="item.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Items List</p>
		</a>
	</li>

	<li class="nav-item">
		<a href="customer.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Customer List</p>
		</a>
	</li>
	<li class="nav-item">
		<a href="user.list.php" class="nav-link">
			<i class="fa fa-tasks nav-icon"></i>
			<p>Users List</p>
		</a>
	</li>
<?php } ?>