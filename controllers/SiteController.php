<?php

class SiteController extends BaseController {
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDisplayTable()
    {
        $model = new Users();
        return $this->render('display-table', ['model' => $model]);
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
        error('here 1');
        error(print_r($_POST, true));
        if (isset($_POST['submit'])) {
            error('here submit');
            $userArray = Users::loadPostData();
            
            $user = new User($userArray);

            if (!$user->validate()) {
                
                echo '<pre>';
                print_r($user->getErrors());
                echo '</pre>';
                $this->redirect('index.php?controller=site&action=add&error=' . $user->getFirstError());
            }
            else 
                $model->addUser($user);

            //$this->redirect('index.php?controller=site&action=display-table');
        }
        return $this->render('add-user', ['model' => $model]);
    }
}