<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\FlashMessages;
use app\lib\Paginator;

final class TaskController extends Controller
{
    public function indexAction()
    {
        if (!empty($_POST)) {

            if (!$this->model->validateTask($_POST, 'add')) {
                FlashMessages::set('error', $this->model->error);
            } else {
                if (!$this->model->addTask($_POST)) {
                    FlashMessages::set('error', 'Sorry, something went wrong...');
                } else {
                    FlashMessages::set('success', 'Task successfully added!');
                }
            }
        }

        $pagination = new Paginator($this->route, $this->model->countAll());

        $this->view->render('Task list', [
            'pagination' => $pagination->get(),
            'tasks' => $this->model->findAll($this->route, ($this->route['get']['order_by'] ?? '')),
        ]);
    }
}
