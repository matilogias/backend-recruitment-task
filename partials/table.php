
<table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($model as $user): ?>
                <tr>
                    <td><?= $user->name ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->address->street . ', ' . $user->address->zipcode . ' ' . $user->address->city ?></td>
                    <td><?= $user->phone ?></td>
                    <td><?= $user->company->name ?></td>
                    <td>
                        <a href="index.php?controller=user&action=delete&id=<?= $user->id ?>" class="btn btn-danger confirm" data-confirm-text="Are you sure you want to delete this user? (<?= $user->name ?>)">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>