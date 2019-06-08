<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="chat/styles/main.css">
</head>
<body>
	<div class="chat">
		<div class="chat">
			<form action="chat/scripts/submit.php" method="post">
				<input type="text" name="call_function" value="chat" class="for_function">
				<input type="text" name="direction">
				<br>
				<input type="submit" value="Добавить в чат"><br>
			</form>
		</div>
		<div class="chat_persons">
			<?php
				include("chat/scripts/connect_to_bd.php");
				$maker = $_SESSION['login'];
				$chat = $dbh -> prepare("(SELECT maker FROM chat WHERE direction = '$maker') UNION (SELECT direction FROM chat WHERE maker = '$maker')");
				$chat -> execute();
				if($chat -> rowcount() == 0){
					echo "Ноль";
				}
				while($row = $chat -> fetch()){
					?>
                    <div id="names">
					    
						<a href="#" onclick="go_to_chat('noiselesskill')">
								<?php 
                                    echo ($row['maker']);
								$readed = $dbh -> prepare("SELECT COUNT(readed) as readed FROM chat WHERE direction = '$maker' AND readed = 0");
								$readed -> execute();
								while ($rowr = $readed -> fetch()) {
									if ($rowr['readed'] > 0){
										echo (' + '.$rowr['readed']);
									}
								}
							?>	
						</a>
						</div>
					<?php
				}
			?>
		</div>
	</div>
	<script>
        function go_to_chat($direction){
//                    alert('ЛОХ');
                    $.ajax({
                    type: "POST",
                    url: 'chat/scripts/chat.php',
                    data:{direction: $direction},
                    success:function(data) {
                           $('#box-1').html(data); 
                        }
                    });
        }
    </script>
</body>
</html>