<?php
    include ("db.php");
    $i = 0;
    $stmt = $dbh->prepare("SELECT * FROM news");
//    if ($stmt->execute(array($_POST['login']))) {
    $stmt->execute();
        while ($row = $stmt->fetch()) {
//                echo ($row['article']);
                $i++;
            }
//    echo('Привет');
//    echo($i);
    $_SESSION['save_news'] = $i;
//    }
    if($i > 3){
        $kolichestvo_stranic = $i / 3;
//         echo(ceil($kolichestvo_stranic));
        ?>
          <div class="buttons">
               <div class="button ssilka" id="Nazad">
                   <a href="#">назад</a>
               </div>
                <div class="button ssilka" id="dallee">
                    <a href="#">далее</a>
                </div>
            </div>
        <?php
    }
?>
<script>

</script>