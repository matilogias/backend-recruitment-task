<div class="container">
    <div class="h-buttons">
        <div>
            <h1>Table of Users</h1>
        </div>
        <div>
            <!-- <a class="dropdown-item ajax-button-action" href="/frontend/web/display/my-files" data-submodal="true" data-href="/frontend/web/share/display-codes?id=__id__" data-ajax-title="Udostępnij">Udostępnij zdjęcie</a> -->
            <a href="#" class="btn btn-primary ajax-button-action" data-href="index.php?controller=site&action=add" data-ajax-title="Add User">
                Add User
            </a>
        </div>
    </div>

    <?= $this->renderPartial('table-paginated', ['model' => $model]) ?>

</div>