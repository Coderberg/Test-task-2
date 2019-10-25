<?php

namespace app\lib;

use PDO;

final class Db
{
    private $db;

    public function __construct()
    {
        $config = require 'config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';port='.$config['port'].';charset='.$config['charset'], $config['user'], $config['password']);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (\is_int($val)) {
                    $type = PDO::PARAM_INT;
                } elseif (\is_bool($val)) {
                    $type = PDO::PARAM_BOOL;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }

        //try {
        $stmt->execute();
        //} catch (\PDOException $e) {
        //    print_r($e->getMessage());
        //    $stmt->debugDumpParams();
        //}

        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);

        return $result->fetchColumn();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
