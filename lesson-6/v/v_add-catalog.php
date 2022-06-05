<? while ($data = $table->fetch()) :
    if($data["photo1"]){
        ?>
        <div class="list" id="<?= $data["id"] ?>">
            <div class="imgconteiner">
                <a href="index.php?act=product&id=<?= $data["id"] ?>" name="modal">
                    <div class="img-conteiner">
                        <img
                            class="listimg"
                            src="data/img/<?=$data["photo1"] ?>"
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
                        <div class="listbuttom" id="<?= $data['id'] ?>">
                            <img class="formaimg" src="data/img/basket.svg" alt="">
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
    } endwhile;
    ?>
