<?php
    if(isset($_POST["method"])) {
        $method = $_POST["method"];
        if($method=="news") {
       //        $stmt = $dbh->prepare("SELECT * FROM news LIMIT (nachalo), (konec) VALUES (?, ?)");
//        $stmt->bindParam(':nachalo', $nachalo);
//        $stmt->bindParam(':konec', $konec);
            include ("connect_to_bd.php"); 
            $nachalo = $_POST["count"];
            $konec = 3;
            $stmt = $dbh->prepare("SELECT * FROM news  ORDER BY date DESC LIMIT $nachalo, $konec");
//        $stmt->bindParam(1, $nachalo);
//        $stmt->bindParam(2, $konec);
//            $nachalo = $nachalo + 3;
        
            $stmt->execute();
            if($stmt->rowcount()==0){
                echo ("Новостей нет");
            }
        
            while ($row = $stmt->fetch()) {
//                    echo ($row['article']);
                ?>
                    <div class="news">
                       <div>
                            <a href=""><h3><?php echo($row['article']); ?></h3></a>
                            <p style="text-align: center;"><?php echo($row['date']); ?></p>
                       </div>
                        <div>
                            <?php echo($row['text']);?>
                        </div>
                    </div>
                <?php
            }
    }
}
    
    function pokazat_news($nachalo){

    }
?>