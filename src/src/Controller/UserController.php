<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Tests\tmp\current_project\src\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $repository): Response
    {
//        $em = $this->getDoctrine()->getManager();
//        $userRepo = $em->getRepostory('App:User');
        $users=$repository->findAll();


        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
}
