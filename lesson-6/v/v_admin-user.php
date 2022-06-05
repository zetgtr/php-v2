<div class="admin_user">
    <h1>Редактировать админку пользователя:</h1>
    <? while ($user = $users->fetch()) :
        if($user["login"]!=="admin"){?>
            <div class="admin_user_list">
                <h4><?=$user["login"]?></h4>
                <input
                    type="checkbox"
                    name="admin"
                    onclick="adminUserEdit(<?=$user['id_user']?>)"
                    <?if($user["admin"]==="true"){?>checked<?}?>>
            </div>
        <?} endwhile; ?>
</div>
