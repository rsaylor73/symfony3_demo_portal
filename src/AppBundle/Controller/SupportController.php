<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SupportController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ContactFormType::class,null, [
                'action' => $this->generateUrl('handle_form_submission'),
            ]);

        return $this->render('support/index.html.twig', [
            'our_form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Route("/form-submission", name="handle_form_submission")
     * @Method("POST")
     */
    public function handleFormSubmissionAction(Request $request)
    {

        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->redirectToRoute('homepage');
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('Contact Form Submission')
            ->setFrom($form->getData()['from'])
            ->setTo('robert@customphpdesign.com')
            ->setBody(
                $form->getData()['message'],
                'text/plain'
            )
        ;

        $this->get('mailer')->send($message);

        // gives the user a success msg
        $this->addFlash('success','Your message was sent!');

        // return to the homepage after submitting the form
        return $this->redirectToRoute('homepage');
    }
}
