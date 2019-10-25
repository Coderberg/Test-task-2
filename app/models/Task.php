<?php

namespace app\models;

use app\core\Model;
use app\lib\CSRF;

final class Task extends Model
{
    public $error;

    public function addTask(array $post)
    {
        $params = [
            'content' => $post['task'],
            'author_name' => $post['name'],
            'author_email' => $post['email'],
        ];

        $this->db->query('INSERT INTO task (content, author_name, author_email) 
                                        VALUES (:content, :author_name, :author_email)', $params);

        return $this->db->lastInsertId();
    }

    public function validateTask(array $post, string $type): bool
    {
        $taskLen = iconv_strlen($post['task']);

        if ($type !== 'edit') {
            $nameLen = iconv_strlen($post['name']);
            $emailLen = iconv_strlen($post['email']);

            if ($nameLen < 2) {
                $this->error = 'Please enter a valid name.';

                return false;
            } elseif ($emailLen < 5 || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Please enter a valid email.';

                return false;
            }
        } elseif (!is_numeric($post['id'])) {
            $this->error = 'Invalid task id.';

            return false;
        }

        if ($taskLen < 10) {
            $this->error = 'Please enter a valid task description.';

            return false;
        } elseif (!CSRF::isTokenValid()) {
            $this->error = 'Invalid csrf token';

            return false;
        }

        return true;
    }

    public function countAll(): int
    {
        return $this->db->column('SELECT COUNT(id) FROM task');
    }

    public function findAll(array $route, string $order = 'id DESC')
    {
        if ($order === 'name') {
            $order = 'author_name';
        } elseif ($order === 'name_desc') {
            $order = 'author_name DESC';
        } elseif ($order === 'email') {
            $order = 'author_email';
        } elseif ($order === 'email_desc') {
            $order = 'author_email DESC';
        } elseif ($order === 'status') {
            $order = 'status';
        } else {
            $order = 'id DESC';
        }

        $max = 3;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];

        return $this->db->row('SELECT * FROM task ORDER by '.$order.' LIMIT :start, :max', $params);
    }
}
