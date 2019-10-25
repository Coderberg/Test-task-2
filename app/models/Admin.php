<?php

namespace app\models;

use app\core\Model;
use app\lib\CSRF;

final class Admin extends Model
{
    public $error;

    public function validateLogin(array $post): bool
    {
        $config = require 'config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = 'Invalid credentials.';

            return false;
        } elseif (!CSRF::isTokenValid()) {
            $this->error = 'Invalid csrf token';

            return false;
        }

        return true;
    }

    public function updateStatus(string $status, $id): void
    {
        $params = [
            'id' => (int) $id,
            'status' => $status,
        ];
        $this->db->query('UPDATE task SET status = :status WHERE id = :id', $params);
    }

    public function updateTask(array $post): void
    {
        $params = [
            'id' => (int) $post['id'],
            'content' => $post['task'],
        ];

        $this->db->query('UPDATE task SET content = :content, edited=1 WHERE id = :id', $params);
    }

    public function isTaskExists($id)
    {
        $params = [
            'id' => $id,
        ];

        return $this->db->column('SELECT id FROM task WHERE id = :id', $params);
    }
}
