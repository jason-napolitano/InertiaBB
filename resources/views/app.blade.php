<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@routes
		@inertiaHead
		@vite
	</head>
	<body class="antialiased bg-gray-900">
		@inertia
	</body>
</html>
