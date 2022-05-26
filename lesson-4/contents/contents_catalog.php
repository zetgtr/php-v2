<?php
$dirImg = "../img";
$auth = auth($pdo, session_id());
$table = $pdo->query("SELECT * FROM goods WHERE id>0 limit 9");
$idMin = $pdo->query("SELECT * FROM goods WHERE id>0 limit 1")->fetch();
?>
<main>
    <div class="conteiner cotalog_box">
        <div class="main_box">
            <div class="res"></div>
            <div class="main_img">
                <? while ($data = $table->fetch()) :
                if($data["photo1"]){
                ?>
                <div class="list">
                    <div class="imgconteiner">
                        <a href="product.php?id=<?= $data["id"] ?>" name="modal">
                            <div class="img-conteiner">
                                <img 
                                class="listimg" 
                                src="<?= "img/" . $data["photo1"] ?>"
                                alt="<?=$data[" photo1"] ?>">
                                <h2 class=" hlist">
                                   <?= $data["title"] ?>
                                </h2>
                                <p class="textlist">
                                  <?= $data["description"] ?>
                                </p>
                                <p class="slogan">
                                   <?= $data["price"] ?> руб.
                                </p>
                        </a>
                        <div class="list-buttom">
                            <?if($auth["admin"]==="true"){?>
                            <div class="listbuttom"
                            id="<?= $data['id'] ?>">
                                <img class="formaimg" src="img/basket.svg" alt=""> 
                                Добавить в корзину
                            </div>
                                <?}else{?>
                                    <a 
                                    href="auth.php?sign=in"
                                    class="goods_no_auth">Необходимо войти!</a>
                                <?}?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $idMax = $data['id'];
               } endwhile; ?>
        </div>
        <div class="loading_catalog">
            <?
            include 'components/loading.php'
            ?>
        </div>
        <button class="add_catalog" onclick="addCatalog(<?=$idMin["id"].",".$idMax ?>)">Еще</button>
    </div>
</main>