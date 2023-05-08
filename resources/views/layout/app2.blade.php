
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>How To Install Vue 3 in Laravel 9 with Vite</title>
	@vite(['resources/sass/app.scss'])
</head>
<body>
	<div id="app"></div>

	@vite(['resources/js/app.js'])
	<router-link to="/">Home</router-link>
	<router-link to="/profile">Profile</router-link>
	<router-link></router-link>
</body>
</html>
