<main>
    <div class="conteiner">
        <form method="POST" <? if ($_GET['act'] === "sign_in" ) { ?> action="index.php?act=sign_in&c=sign"
        <? } elseif ($_GET['act'] === "sign_up") { ?> action="index.php?act=sign_uph&c=sign"
        <? } ?> class="auth_box">
            <p>Логин</p>
            <? if ($message){?>
                <p><?=$message?></p>
            <? } ?>
            <input type="text" name="login">
            <p>Пароль</p>
            <input type="password" name="password">
            <? if ($_GET['act'] === "sign_up") { ?>
                <p>Повторите пароль</p>
                <input type="password" name="password2">
                <button>Зарегестрироватся</button>
            <? } elseif ($_GET['act'] === "sign_in") { ?>
                <button>Войти</button>
            <? } ?>
        </form>
    </div>
</main>
