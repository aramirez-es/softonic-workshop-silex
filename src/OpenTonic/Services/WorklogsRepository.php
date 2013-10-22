<?php

namespace OpenTonic\Services;

use Doctrine\DBAL\Connection;

class WorklogsRepository
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getList()
    {
        return $this->db->fetchAll("SELECT w.worklog_id, w.text, u.name FROM `worklog` w INNER JOIN `user` u USING(`user_id`);");
    }

    public function getById($worklog_id)
    {
        $statement = $this->db->prepare("SELECT w.worklog_id, w.text, u.name FROM `worklog` w INNER JOIN `user` u USING(`user_id`) WHERE w.worklog_id = :worklog_id;");
        $statement->bindParam(':worklog_id', $worklog_id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByIdUser($user_id)
    {
        $statement = $this->db->prepare("SELECT w.worklog_id, w.text, u.name FROM `worklog` w INNER JOIN `user` u USING(`user_id`) WHERE u.user_id = :user_id;");
        $statement->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
