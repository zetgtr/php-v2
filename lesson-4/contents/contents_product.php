<?php
session_start();
$auth = auth($connect, session_id());
?>


<main>
    <div class="conteiner main_img_box">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img 
                    src="img/<?= $product["photo1"] ?>" 
                    class="d-block w-100" 
                    alt="<?= $product["photo1"]?>">
                </div>
                <?if($product["photo2"]){?>
                <div class="carousel-item">
                    <img 
                    src="img/<?= $product["photo2"]?>" 
                    class="d-block w-100" alt="<?= $product["photo2"]?>">
                </div>
                <?}if($product["photo3"]){?>
                <div class="carousel-item">
                    <img 
                    src="img/<?= $product["photo3"] ?>" 
                    class="d-block w-100" alt="<?= $product["photo3"] ?>">
                </div>
                <?}?>
            </div>
            <button 
            class="carousel-control-prev prev" 
            type="button" 
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
                <span class="carousel-control-prev-icon control-icone" aria-hidden="true">
                </span>
                <span class="visually-hidden">Назад</span>
            </button>
            <button 
            class="carousel-control-next next" 
            type="button" 
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
                <span class="carousel-control-next-icon control-icone" aria-hidden="true"></span>
                <span class="visually-hidden">Дальше</span>
            </button>
            <div class="count_box">
                <div class="count_box-flex">
                    <p><?=$product["text"]?></p>
                </div>
                <? if (count($auth) > 0) { ?>
                    <form action="controlers/basket.php?id=<?= $product['id'] ?>" method="POST">
                        <button>Добавить в корзину</button>
                        <p>Количество просмотров <?= ++$product["count"] ?></p>
                </form>
                <? } else { ?>
                <p>Что бы купить необходимо зарегестрироватся!</p>
                <? } ?>
            </div>
</main>