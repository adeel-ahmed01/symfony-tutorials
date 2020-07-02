<?php

namespace BlogBundle\Controller;

use BlogBundle\BlogBundle;
use BlogBundle\Entity\Enquiry;
use BlogBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('about.html.twig');
    }

    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm('BlogBundle\Form\EnquiryType', $enquiry, array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('BlogBundle_contact'),
            'method' => 'POST'
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirectToRoute('BlogBundle_contact');
            }else{
                // An error ocurred, handle
                var_dump("Errooooor :(");
            }
        }

        return $this->render('contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
