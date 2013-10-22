<?php

namespace OpenTonic\Controllers;

use OpenTonic\Services;

class Home
{
    private $twig;
    private $worklogs_repository;

    public function __construct($twig, Services\WorklogsRepository $worklogs_repository)
    {
        $this->twig = $twig;
        $this->worklogs_repository = $worklogs_repository;
    }

    public function homeAction()
    {
        return $this->twig->render('index.twig', array(
            'worklogs' => $this->worklogs_repository->getList()
        ));
    }
}
