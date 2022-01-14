<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuthenticationController extends AbstractController
{
    /**
     * @Route("/authentification/{prenom}/{password}", name="authentication", methods="POST")
     */
    public function authentification(Request $request, string $prenom, string $password, SessionInterface $session)
    {
        try{
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'name' => $prenom,
                ]);
                if($user != null && password_verify($password, $user->getPassword()))
                {   
                    $name = $user->getName();
                    $lastname = $user->getLastName();
                    $id = $user->getId();
                    $level = $user->getLevel();
                    $email = $user->getEmail();
                    $roles = $user->getRoles();
                    $margin = $user->getMargin();
        
                    $session->set('id', $id);
                    $session->set('name', $name); 
                    $session->set('lastName', $lastname); 
                    $session->set('email', $email); 
                    $session->set('roles', $roles); 
                    $session->set('margin', $margin); 
                    $session->set('level', $level);
                    
        
                    $response = new Response();

                    $response->setContent(json_encode(['Id'=> $id,
                                                        'Name' => $name,
                                                        'LastName' => $lastname,
                                                        'Level' => $level,
                                                        'roles' => $session->get('roles'),
                                                        'margin' => $session->get('margin'),
                                                        'email' => $session->get('email'),
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
        catch (\Exception $err)
        {
            $response = new Response();
            return $response->setStatusCode(500);
        }
            
       
    }

    /**
     * @Route("/currentauthentification/{prenom}", name="currentauthentication", methods="GET")
     */
    public function CurrentAuthentification(Request $request, string $prenom, SessionInterface $session)
    {
        try{
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'name' => $prenom,
                ]);
                
            $name = $user->getName();
            $lastname = $user->getLastName();
            $id = $user->getId();
            $level = $user->getLevel();
            $email = $user->getEmail();
            $roles = $user->getRoles();
            $margin = $user->getMargin();
                    
        
            $response = new Response();

            $response->setContent(json_encode(['Id'=> $id,
                                                'Name' => $name,
                                                'LastName' => $lastname,
                                                'Level' => $level,
                                                'roles' => $session->get('roles'),
                                                'margin' => $session->get('margin'),
                                                'email' => $session->get('email'),
                                                ]));
        
        
            $response->headers->set('Content-Type', 'application/json');
        
            return $response;
                
        }
        catch (\Exception $err)
        {
            $response = new Response();
            return $response->setStatusCode(500);
        }
    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(SessionInterface $session){

        if($session->get('id' != null))
        {
            $session->clear();
        }
    }

    
    /**
     * @Route("/registration", name="registration", methods="POST")
     */
    
    /*
    public function registration(): Response
    {
        $form = $this->createForm(RegistrationType::class, $u, SessionInterface $session);
        $form->handleRequest(($request));

        if($form->isSubmitted() && $form->isValid())
        {
            $user = new User();
            $user->setEmail($request->request->get("email"));
            $user->setPassword(password_hash($request->request->get("password"), PASSWORD_DEFAULT));
            $user->setName($request->request->get("name"));
            $user->setLastname($request->request->get("lastName"));
            $user->setLevel($request->request->get("level"));
            $user->setMargin($request->request->get("margin"));

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();
            
            $session->set('id', $user.getId());

            $response = new Response();
            $response->setStatusCode(200);
        }
        else
        {
            $response = new Response();
            $response->setStatusCode(500);
        }
    }
    */
}
