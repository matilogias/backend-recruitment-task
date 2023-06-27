<?php
class UserController extends BaseController
{
    public function actionDelete()
    {
        $id = get('id');
        if (!$id) {
            $this->redirect('index.php?controller=site&action=display-table&error=No+user+id+specified');
        }
        $model = new Users();
        $result = $model->deleteUser($id);
        if (!$result) {
            $this->redirect('index.php?controller=site&action=display-table&error=No+user+found+with+id+' . $id);
        }
        $this->redirect('index.php?controller=site&action=display-table');
    }

    public function actionAdd()
    {

    }
}