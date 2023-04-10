<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Auth</title>
	<?php wp_head(); ?>
	<style>
        .message {
            width: 600px;
            margin: 0 auto;
            text-align: center;
            border: 1px #181a1b solid;
            border-radius: 5px;
            min-height: 600px;
            padding: 30px;
        }
	</style>
</head>
<body>
<script>
	document.addEventListener('DOMContentLoaded', (event) => {
		const query_string = window.location.href;
		const nonce = "<?php echo wp_create_nonce('wp_rest'); ?>"
		const endpoint = "<?php echo home_url('wp-json/devart-press/v1/store-token') ?>"

		// storeToken()

		// we need to send the query string to the backend
		async function storeToken() {
			const url      = endpoint + '?nonce=' + nonce
			const response = await fetch(url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': nonce // <- here, send the nonce via the header
				},
				body: JSON.stringify({
					'url': query_string
				})
			})
			const data = await response.json()

			console.log(data)
		}
	});
</script>
<main>
	<div class="message">
		<h2>App Authorization</h2>
	</div>
</main>

</body>
</html>
<?php
