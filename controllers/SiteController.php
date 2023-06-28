<?php

class SiteController extends BaseController {
    public function actionIndex()
    {
        $this->redirect('index.php?controller=site&action=display-table-paginated');
    }
    
    public function actionDisplayTablePaginated()
    {
        $page = get('page', 1);
        $model = new UsersPagination($page);
        $orderBy = get('orderby', 'id');
        $order = get('order', 'asc');
        $model->order($orderBy, $order);
        $model->paginate();
        return $this->render('display-table-paginated', ['model' => $model]);
    }

    public function actionAdd()
    {
        $model = new Users();
        if (isset($_POST['submit'])) {
            $userArray = Users::loadPostData();
            
            $user = new User($userArray);

            if (!$user->validate()) {
                echo '<pre>';
                print_r($user->getErrors());
                echo '</pre>';
                $this->redirect('index.php?controller=site&action=add&error=' . $user->getFirstError());
            }

            $model->addUser($user);
            $this->redirect('index.php?controller=site&action=display-table-paginated&success=User+added');
        }
        if (isAjax()) {
            return $this->renderAjax('add-user', ['model' => $model]);
        }
        return $this->render('add-user', ['model' => $model]);
    }

    public function actionDelete()
    {
        $id = get('id');
        if (!$id) {
            $this->redirect('index.php?controller=site&action=display-table-paginated&error=No+user+id+specified');
        }
        $model = new Users();
        $result = $model->deleteUser($id);
        if (!$result) {
            $this->redirect('index.php?controller=site&action=display-table-paginated&error=No+user+found+with+id+' . $id);
        }
        $this->redirect('index.php?controller=site&action=display-table-paginated&success=User+deleted');
    }
}