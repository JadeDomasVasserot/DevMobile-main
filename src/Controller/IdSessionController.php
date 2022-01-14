<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;


class IdSessionController extends AbstractController
{
    /**
     * @Route("/id/session", name="id_session")
     */
    public function index(SessionInterface $session, Request $request): Response
    {
        $Id = $request->headers->get('Authorization');
        
        if($Id != null)
        {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $Id,
                ]);

            $response = new Response();

            $response->setContent(json_encode([ 'Id' => $Id, 
                                                'name' => $user->getName(),
                                                'lastName' => $user->getLastName(),
                                                'level' => $user->getLevel(),
                                                'margin' => $user->getMame(),
                                                'roles' => $user->getRoles(),
                                                'email' => $user->getEmail(),
                                            ]));

            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        else
        {
            $response = new Response();
            return $response->setStatusCode(500);
        }
    }

    /**
	 * @Route("keepAlive", name="keepAlive")
	 */
	public function keepAlive(Request $request) {
		$this->get('session')->migrate(); /// Migrate prolonge la session
		return JsonResponse::fromJsonString('{"result":"OK"}', 200);
	}
}
