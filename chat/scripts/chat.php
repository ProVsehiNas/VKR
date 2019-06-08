<link rel="stylesheet" href="../styles/main.css">

<a href="#" onclick="back()">НАЗАД</a>
<div class="bloc-chat">
<?php
	session_start();
	include('connect_to_bd.php');
    echo($_POST['direction']);
//	$direction = $_GET['login'];
    $direction = $_POST['direction'];
	$maker = $_SESSION['login'];
	$chat = $dbh -> prepare("SELECT * FROM chat WHERE (direction = '$direction' and maker = '$maker') OR (direction = '$maker' AND maker = '$direction') ORDER BY date_make ASC LIMIT 0, 9999");
	$chat -> execute();
	while ($row = $chat -> fetch()) {
		$idr = $row['id'];
		$visited = $dbh -> prepare("UPDATE chat SET readed = 1 WHERE id = $idr AND maker <> '$maker'");
		$visited -> execute();
		?>
			<div class="massenges">
				<div><?php echo $row['date_make'];?></div>
				<div>ОТ: <?php echo $row['maker']; ?></div>
				<div>КОМУ: <?php echo $row['direction']; ?></div>
				<div>ТЕКСТ: <?php echo $row['text']; ?></div>
			</div>
		<?php
	}
?>
</div>
<link rel="stylesheet" href="chat/styles/main.css">
<form action="chat/scripts/submit.php" method="post" id="forms">
	<input type="text" name="call_function" value="send_sms" class="for_function">
	<input type="text" name="direction" value="<?php echo($_POST['direction']); ?>" class="for_function">
	<input type="text" name="text">
	<input type="submit" value="Отправить" id="btns">
</form>
<script>
        function back(){
                $.ajax({
                    type: "POST",
                    url: "chat/module_chat.php",
                    success: function(data){
                        $('#box-1').html(data);
                    }
                });
        } 
</script>