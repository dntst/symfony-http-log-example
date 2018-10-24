<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HttpLog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
     * @Route("/admin/http-log/", name="http-log")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $httpLogs = $entityManager->getRepository(HttpLog::class)->findBy([], ['id' => 'desc']);

        return $this->render('app/http-log.html.twig', [
            'httpLogs' => $httpLogs,
        ]);
    }
}
