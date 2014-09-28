<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Contact Form</h2>

		<div>
			Someone just contacted us:
		</div>
		<div> Salut, {{ $first_name . ' ' . $last_name . '!'}}</div>
		<div> 
			Aici ai link-ul de resetare a parolei (ai uitat-o...hmmmm): {{ HTML::link(URL::route('show-set-password-form', array('id' => $id, 'code' => $reset_password_code)), 'Cick pentru a reseta') }}
		</div>
	</body>
</html>