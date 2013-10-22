<?php

namespace OpenTonic\Controllers;

use OpenTonic\Services;

class Worklogs
{
    private $twig;
    private $worklogs_repository;

    public function __construct($twig, Services\WorklogsRepository $worklogs_repository)
    {
        $this->twig = $twig;
        $this->worklogs_repository = $worklogs_repository;
    }

    public function detailAction($id)
    {
        return $this->twig->render('worklog.twig', array(
            'worklog' => $this->worklogs_repository->getById($id)
        ));
    }
}
