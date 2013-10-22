<?php

namespace OpenTonic\Controllers;

use OpenTonic\Services;

class Users
{
    private $twig;
    private $worklogs_repository;

    public function __construct($twig, Services\WorklogsRepository $worklogs_repository)
    {
        $this->twig = $twig;
        $this->worklogs_repository = $worklogs_repository;
    }

    public function worklogsAction($id)
    {
        return $this->twig->render('user_worklogs.twig', array(
            'worklogs' => $this->worklogs_repository->getByIdUser($id)
        ));
    }
}
