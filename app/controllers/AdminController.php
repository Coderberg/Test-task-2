<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\FlashMessages;
use app\lib\Paginator;
use app\models\Task;

final class AdminController extends Controller
{
    private $task;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->task = new Task();
    }

    public function loginAction()
    {
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/tasks');
        }
        if (!empty($_POST)) {
            if (!$this->model->validateLogin($_POST)) {
                FlashMessages::set('error', $this->model->error);
            } else {
                $_SESSION['admin'] = true;
                $this->view->redirect('admin/tasks');
            }
        }
        $this->view->render('Log in');
    }

    public function updateAction()
    {
        if (!$this->model->isTaskExists($this->route['id'])) {
            $this->view->message('error', 'Task does not exists');
        }
        if (!empty($_POST['status'])) {
            $status = ($_POST['status'] === 'created') ? 'created' : 'completed';

            $this->model->updateStatus($status, $this->route['id']);

            $this->view->message('success', 'Status successfully updated.');
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    public function tasksAction()
    {
        if (!empty($_POST)) {
            if (!$this->task->validateTask($_POST, 'edit')) {
                FlashMessages::set('error', $this->task->error);
            } else {
                try {
                    $this->model->updateTask($_POST);
                    FlashMessages::set('success', 'Task successfully updated!');
                } catch (\Exception $e) {
                    FlashMessages::set('error', 'Sorry, something went wrong...');
                }
            }
        }

        $pagination = new Paginator($this->route, $this->task->countAll());

        $this->view->render('Task list', [
            'pagination' => $pagination->get(),
            'tasks' => $this->task->findAll($this->route, ($this->route['get']['order_by'] ?? '')),
        ]);
    }
}
