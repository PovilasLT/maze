<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
	</style>
	<script src="/socket.io/socket.io.js"></script>
	<script type="text/javascript">
		var socket = io('http://192.168.0.9:7001');
		socket.join({{ $channel->secret }});
	</script>
</head>
<body>

	<div class="container">
		<span class="username">User</span> paaukojo <span class="amount">0</span>
	</div>

</body>
</html>