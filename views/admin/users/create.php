<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New admin</title>
</head>
<body>
    <form action="<?= \Router\Router::route('/admin/users/store') ?>" method="POST">
        <label for="#">Nom</label>
        <input type="text" name="name">
        <label for="#">Email</label>
        <input type="email" name="email" id="#">
        <label for="#">Mot de passe</label>
        <input type="password" name="password" id="#">
        <label for="#">Role</label>
        <select name="role" id="#">
            <?php foreach($roles ?? [] as $role):?>
                <option value="<?=  $role?->id ?>"><?=  $role?->name ?></option>
            <?php endforeach;?>
        </select>
         <button type="submit">Creer</button>
    </form>
</body>
</html>