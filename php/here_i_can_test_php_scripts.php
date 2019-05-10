<?php
    if(isset($_POST["method"])) {
        $method = $_POST["method"];
        if($method=="news") {
       //        $stmt = $dbh->prepare("SELECT * FROM news LIMIT (nachalo), (konec) VALUES (?, ?)");
//        $stmt->bindParam(':nachalo', $nachalo);
//        $stmt->bindParam(':konec', $konec);
            include ("db.php"); 
            $nachalo = $_POST["count"];
            $konec = 3;
            $stmt = $dbh->prepare("SELECT * FROM news LIMIT $nachalo, $konec");
//        $stmt->bindParam(1, $nachalo);
//        $stmt->bindParam(2, $konec);
//            $nachalo = $nachalo + 3;
        
            $stmt->execute();
        
            while ($row = $stmt->fetch()) {
//                    echo ($row['article']);
                ?>
                    <div class="news">
                        <a href=""><h3><?php echo($row['article']) ?></h3></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, recusandae!</p>
                    </div>
                <?php
            }
    }
}
    
    function pokazat_news($nachalo){

    }
?>