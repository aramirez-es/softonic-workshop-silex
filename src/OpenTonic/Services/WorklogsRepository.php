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
}
