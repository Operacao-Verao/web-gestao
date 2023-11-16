<?php
    include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../login_guest.php");
    }
    
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		
		<h2 id="txtStatus">Disconnected</h2>
		
		<fieldset id="conPanel">
			
			<label>Key:</label><br/>
			<input type="text" id="edtKey" value="71bff9bd7d44d5b48f201d6e0129035ebbb912127bc7d6361577c13f68147ad2"/><br/><br/>
			
			<label>Id:</label><br/>
			<input type="number" id="edtId" value="1"/><br/><br/>
			
			<label>Type:</label><br/>
			<select id="slDevice" value="0">
				<option value="0">Pluviômetro</option>
				<option value="1">Fluviômetro</option>
			</select><br/><br/>
			
			<button id="btnConnect">Connect</button>
			
		</fieldset>
		
		<fieldset id="sendPanel">
			
			<label>Token:</label><br/>
			<input type="text" id="edtToken" value="..."/><br/><br/>
			
			<label>Medida:</label><br/>
			<input type="number" id="edtMedida" value="1"/><br/><br/>
			
			<button id="btnSend">Send</button>
			
		</fieldset>
		
	</body>
	
	<script type="text/javascript">
		let connected = null;
		
		function setConnected(status){
			connected = status;
			if (status){
				txtStatus.textContent = "Connected";
				txtStatus.style.color = "green";
				conPanel.style.display = "none";
				sendPanel.style.display = "block";
			}
			else {
				txtStatus.textContent = "Disconnected";
				txtStatus.style.color = "red";
				conPanel.style.display = "block";
				sendPanel.style.display = "none";
			}
		}
		setConnected(false);
		
		btnConnect.onclick = function(){
			fetch("../fetch/arduino_access.php", {
				"method": "POST",
				"headers": { "Content-Type": "application/json" },
				"body": JSON.stringify({
					"key": edtKey.value,
					"id": edtId.value,
					"device": slDevice.value
				})
			}).then(function(r){
				r.text().then(function(txt){
					console.log(txt);
					if (txt=='0'){
						alert("Alguma informação de acesso está incorreto!");
						setConnected(false);
					}
					else {
						alert("Dispositivo conectado ao servidor!");
						setConnected(true);
						edtToken.value = txt;
					}
				});
			}, function(){
				alert("Falha ao conectar-se com o servidor!");
				setConnected(false);
			});
		}
		
		btnSend.onclick = function(){
			if (connected){
				fetch("../fetch/arduino_send.php", {
					"method": "POST",
					"headers": { "Content-Type": "application/json" },
					"body": JSON.stringify({
						"token": edtToken.value,
						"id": edtId.value,
						"device": slDevice.value,
						"medida": edtMedida.value
					})
				}).then(function(r){
					r.text().then(function(txt){
						if (txt=='0'){
							alert("Acesso proibido ao servidor! Desvinculando dispositivo");
							setConnected(false);
						}
						else {
							alert("Mensagem enviada com sucesso!");
						}
					});
				}, function(){
					alert("Falha ao conectar-se com o servidor!");
				});
			}
		}
		
	</script>
</html>