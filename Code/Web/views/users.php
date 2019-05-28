<?php
require_once "model/usersManager.php";
$users = getUsers();
?>

<div>
    <h1>Test</h1>
    <p>Ceci est un test</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Admin</th>
                <th>École</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['idUsers']; ?></td>
                    <td><?= $user['FirstName']; ?></td>
                    <td><?= $user['LastName']; ?></td>
                    <td><?= $user['Email']; ?></td>
                    <td><?= $user['Admin']; ?></td>
                    <td><?= $user['Name']; ?></td>
                    <td><a href="?action=deleteUser&idUsers=<?=$user['idUsers']?>"><img src="img/delete.png"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
