
<?php
    $icon = icon( ($model->order == 'asc' ? 'arrow-up' : 'arrow-down') ) 
?>
<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=name&order=<?= $model->getLinkValuesForOrder('&', 'name', $model->order) ?>">Name</a>
                    <?php if ($model->orderBy == 'name') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=username&order=<?= $model->getLinkValuesForOrder('&', 'username', $model->order) ?>">Username</a>
                    <?php if ($model->orderBy == 'username') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=email&order=<?= $model->getLinkValuesForOrder('&', 'email', $model->order) ?>">Email</a>
                    <?php if ($model->orderBy == 'email') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=address&order=<?= $model->getLinkValuesForOrder('&', 'city', $model->order) ?>">Address</a>
                    <?php if ($model->orderBy == 'city') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=phone&order=<?= $model->getLinkValuesForOrder('&', 'phone', $model->order) ?>">Phone</a>
                    <?php if ($model->orderBy == 'phone') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>
                    <a href="index.php?controller=site&action=display-table-paginated&orderby=company&order=<?= $model->getLinkValuesForOrder('&', 'companyName', $model->order) ?>">Company</a>
                    <?php if ($model->orderBy == 'companyName') : ?>
                        <?= $icon ?>
                    <?php endif; ?>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $user) : ?>
                <tr>
                    <td><?= $user->name ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->address->street . ', ' . $user->address->zipcode . ' ' . $user->address->city ?></td>
                    <td><?= $user->phone ?></td>
                    <td><?= $user->company->name ?></td>
                    <td>
                        <a href="index.php?controller=site&action=delete&id=<?= $user->id ?>" class="btn btn-danger confirm" data-confirm-text="Are you sure you want to delete this user? (<?= $user->name ?>)">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="pagination">
    <?php if ($model->page > 1) : ?>
        <a href="index.php?controller=site&action=display-table-paginated&page=<?= $model->page - 1 ?><?= $model->getOrderLinkValues('&') ?>" class="btn btn-primary">Previous</a>
    <?php endif; ?>
    <?php if ($model->page < $model->totalPages) : ?>
        <a href="index.php?controller=site&action=display-table-paginated&page=<?= $model->page + 1 ?><?= $model->getOrderLinkValues('&') ?>" class="btn btn-primary">Next</a>
    <?php endif; ?>
</div>
<p>Page: <?= $model->page ?> of <?= $model->totalPages ?></p>
<p>Records: <?= $model->totalRecords ?></p>

<p>Order by: <?= $model->orderBy ?></p>
<p>Order: <?= $model->order ?></p>