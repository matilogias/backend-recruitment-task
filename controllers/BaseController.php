<?php

class BaseController {
    public $template = 'main';
    public function actionIndex()
    {
        return 'index';
    }

    public function actionError()
    {
        return 'error';
    }

    protected function render(string $view, array $params = []): string
    {
        $view = 'views/' . $view . '.php';
        if (!file_exists($view)) {
            throw new Exception("View $view does not exist");
        }
        $template = 'templates/' . $this->template . '.php';
        if (!file_exists($template)) {
            throw new Exception("Template $template does not exist");
        }
        extract($params);
        ob_start();
        include($template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    protected function renderAjax(string $view, array $params = []) : string
    {
        $view = 'views/' . $view . '.php';
        if (!file_exists($view)) {
            throw new Exception("View $view does not exist");
        }
        extract($params);
        ob_start();
        include($view);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function renderPartial(string $partial, array $params = []) : string
    {
        $partial = 'partials/' . $partial . '.php';
        if (!file_exists($partial)) {
            throw new Exception("Partial $partial does not exist");
        }
        extract($params);
        ob_start();
        include($partial);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function redirect(string $url)
    {
        header("Location: $url");
    }
}