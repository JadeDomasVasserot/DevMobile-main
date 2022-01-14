<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class RevendeurController extends AbstractController
{
    /**
     * @Route("/revendeur", name="revendeur")
     */
    public function index()
    {
        $tabUsers = array();

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy([
                'level' => 1,
            ]);

        foreach($users as $user)
        {
            $user = array(
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'pwd' => $user->getPassword(),
                'name' => $user->getName(),
                'last name' => $user->getLastName(),
                'margin' => $user->getMargin(),
            );
    
            array_push($tabUsers, $user);
        }
        
        $response = new Response();
        $response->setContent(json_encode([$tabUsers]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
