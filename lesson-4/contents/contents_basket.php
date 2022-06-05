<?php
session_start();
print_r($_SESSION['cartId'][1]['id']);
?>
<main>
    <div class="res"></div>
    <div class="conteiner">
        <div class="basket_button_box">
            <div class="basket">
                <? if($_SESSION['basket']){
                foreach ($_SESSION['basket'] as $basket) {
                    $item = getCart($connect, $basket['id']); ?>

                    <div class="carts_box basket_conteiner-<?=$basket['id']?>">
                        <a href="product.php?id=<?=$basket['id']?>">
                            <img src="img/<?= $item["photo1"] ?>"alt="<?= $item["photo1"] ?>">
                        </a>
                            <p><?= $item["title"] ?></p>
                        <div class="basket_count_box">
                            <P>Количество:</P>
                            <input 
                                min="1" class="basket-count-<?=$basket['id']?>" 
                                type="number" value="<?=$basket['count']?>" 
                                id="<?=$basket['id']?>">
                        </div>
                        <p class="basket_price-<?=$basket['id']?>">
                            Цена: <?= $item["price"]*$basket['count'] ?> руб.
                        </p>
                        <button id="<?=$basket['id']?>" class="remove-basket-<?=$basket['id']?>">Удалить</button>
                    </div>
                    <script>
                    editCountBasket(<?=$basket['id']?>, <?=$item["price"]?>)
                    removeBasket(<?=$basket['id']?>)
                    </script>
                <? }}else{ ?>
                    <h1 class="basket_false">Корзина пуста</h1>
                    <?}?>
            </div>
            <?if($_SESSION['basket']){?> <button class="basket_bay">Оформить заказ</button><?}?>
        </div>
    </div>
</main>