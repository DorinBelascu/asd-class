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
			Aici ai link-ul de activare: {{ HTML::link(URL::route('activate-account', array('id' => $id, 'code' => $activation_code)), 'Cick pentru a activa') }}
		</div>
	</body>
</html>