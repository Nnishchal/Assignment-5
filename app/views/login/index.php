	<?php require_once 'app/views/templates/headerPublic.php'?>
	<main role="main" class="container  container-center" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh;">
			<div class="page-header" id="banner">
					<div class="row">
							<div class="col-lg-12">
									<h1 class="text text-decoration-none">Login ^_^</h1>
							</div>
					</div>
			</div>

	<div class="row">
			<div class="col-sm-auto">
			<form action="/login/verify" method="post" >
			<fieldset>
				<br>
				<div class="form-group">
					<label for="username">Username</label>
					<input required type="text" class="form-control" name="username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input required type="password" class="form-control" name="password">
				</div>
							<br>
					<div class="d-flex justify-content-center align-items-center gap-3">
						<button type="submit" class="btn btn-dark d-block">Login</button>
						<a href="/create">Click for Signup</a>
					</div>
			</fieldset>
			</form>
			<br>
		</div>
	</div>	
	<?php require_once 'app/views/templates/footer.php' ?>