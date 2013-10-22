<?php

namespace OpenTonic\Controllers;

use OpenTonic\Services;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Worklogs
{
    private $twig;
    private $worklogs_repository;
    private $request;

    public function __construct($twig, Services\WorklogsRepository $worklogs_repository, Request $request)
    {
        $this->twig = $twig;
        $this->worklogs_repository = $worklogs_repository;
        $this->request = $request;
    }

    public function detailAction($id)
    {
        return $this->twig->render('worklog.twig', array(
            'worklog' => $this->worklogs_repository->getById($id)
        ));
    }

    public function saveAction()
    {
        $response = new JsonResponse(null, 204);
        $worklog = json_decode($this->request->getContent());

        if (!$this->worklogs_repository->save($worklog->worklog)) {
            $response = new JsonResponse(null, 503);
        }

        return $response;
    }
}
