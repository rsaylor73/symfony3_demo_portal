<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityControllerController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        //$form = $this->createForm(LoginType::class);

        $form = $this->createForm(LoginType::class,null, [
            'action' => $this->generateUrl('login')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('homepage');
        }
        
        //return $this->render('security/login.html.twig');
        return $this->render('security/login.html.twig', [
            'login_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout")
     * @throws \RuntimeException
     */
    public function logoutAction()
    {
        throw new \RuntimeException('This should never be called directly');
    }

}
