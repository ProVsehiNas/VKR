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
    echo($i);
    $_SESSION['save_news'] = $i;
//    }
    if($i > 3){
        $kolichestvo_stranic = $i / 3;
         echo(ceil($kolichestvo_stranic));
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
    function pokazat_news($nachalo){
//        $stmt = $dbh->prepare("SELECT * FROM news LIMIT (nachalo), (konec) VALUES (?, ?)");
//        $stmt->bindParam(':nachalo', $nachalo);
//        $stmt->bindParam(':konec', $konec);
        include ("db.php");
//        $nachalo = 0;
        $konec = 3;
        $stmt = $dbh->prepare("SELECT * FROM news LIMIT $nachalo, $konec");
//        $stmt->bindParam(1, $nachalo);
//        $stmt->bindParam(2, $konec);
        $nachalo = $nachalo + 3;
        
        $stmt->execute();
        
        while ($row = $stmt->fetch()) {
                echo ($row['article']);
        }
    }
    pokazat_news(0);
    pokazat_news(0);
?>
<script>

</script>