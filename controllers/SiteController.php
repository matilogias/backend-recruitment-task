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

    public function actionAdd()
    {
        $model = new Users();
        error('here 1');
        error(print_r($_POST, true));
        if (isset($_POST['submit'])) {
            error('here submit');
            $userArray = array(
                'id' => post('id'),
                'name' => post('name'),
                'username' => post('username'),
                'email' => post('email'),
                'address' => array(
                    'street' => post('street'),
                    'suite' => post('suite'),
                    'city' => post('city'),
                    'zipcode' => post('zipcode'),
                    'geo' => array(
                        'lat' => post('lat'),
                        'lng' => post('lng')
                    )
                ),
                'phone' => post('phone'),
                'website' => post('website'),
                'company' => array(
                    'name' => post('companyName'),
                    'catchPhrase' => post('catchPhrase'),
                    'bs' => post('bs')
                )
            );
            echo '<pre>';
            print_r($userArray);
            echo '</pre>';
            
            $user = new User($userArray);

            if (!$user->validate()) {
                echo '<pre>';
                print_r($user->getErrors());
                echo '</pre>';
            }
            else 
                $model->addUser($user);

            $this->redirect('index.php?controller=site&action=display-table');
        }
        return $this->render('form-add-user', ['model' => $model]);
    }
}