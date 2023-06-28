<?php

class TestController extends BaseController
{
    public function actionIndex()
    {
        //return 'index';
        // Jeśli chcemy wyświetlić widok, to zamiast return możemy użyć:
        // return $this->render('index');
        // Jeśli dodatkowo chcemy przekazać zmienne do widoku,
        // to musimy je przekazać jako drugi parametr do metody render:
        // $test = 'test';
        return $this->render(
            'index',
            [
                'var1' => 'value1',
                'var2' => 'value2'
            ]
        );
        // W widoku możemy użyć zmiennych $var1 i $var2 ale nie $test
    }
}


