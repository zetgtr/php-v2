<main>
    <div class="res"></div>
    <div class="conteiner">
        <div class="basket_button_box">
            <div class="basket">
                <? if($items){
                foreach ($items as $item) {
                     ?>
                    <div class="carts_box basket_conteiner-<?=$item['id']?>">
                        <a href="index.php?act=product&id=<?=$item['id']?>">
                            <img src="data/img/<?= $item["photo1"] ?>"alt="<?= $item["photo1"] ?>">
                        </a>
                        <p><?= $item["title"] ?></p>
                        <div class="basket_count_box">
                            <P>Количество:</P>
                            <input
                                min="1" class="basket-count-<?=$item['id']?>"
                                type="number" value="<?=$item['count']?>"
                                id="<?=$item['id']?>">
                        </div>
                        <p class="basket_price-<?=$item['id']?>">
                            Цена: <?= $item["price"]*$item['count'] ?> руб.
                        </p>
                        <button id="<?=$item['id']?>" class="remove-basket-<?=$item['id']?>">Удалить</button>
                    </div>
                    <script>
                        editCountBasket(<?=$item['id']?>, <?=$item["price"]?>)
                        removeBasket(<?=$item['id']?>)
                    </script>
                <? }}else{ ?>
                    <h1 class="basket_false">Корзина пуста</h1>
                <?}?>
            </div>
            <?if($items){?> <button class="basket_bay">Оформить заказ</button><?}?>
        </div>
    </div>
</main>
