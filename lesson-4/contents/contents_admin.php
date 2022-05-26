<main>
    <div class="conteiner">
        <div class="admin">
            <h1>Выберете что редактировать!</h1>
            <div>
                <button onclick="adminGoods()">Товары</button>
                <button onclick="adminUser()">Пользователей</button>
            </div>
        </div>
        <? 
        include 'components/admin-user.php';
        include 'components/admin-goods.php';
        ?>        
    </div>
    <?include "./components/add-admin-goods.php";?>
</main>