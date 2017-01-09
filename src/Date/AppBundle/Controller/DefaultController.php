<?php

namespace Date\AppBundle\Controller;

use Date\AppBundle\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm(new SearchFormType());
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $firstDate = $form["firstDate"]->getData();
            $secondDate = $form["secondDate"]->getData();
            if ($form->isValid()) {
                $nbre_des_jours = 0;
                foreach (new \DatePeriod( $firstDate, new \DateInterval('P1D'), $secondDate) as $jour)
                {
                    $numCurrentDay = $jour->format('N');
                    if (($numCurrentDay != '6') && ($numCurrentDay != '7'))
                    {
                        ++$nbre_des_jours;
                    }
                }
                return $this->render('DateAppBundle:Default:resultat.html.twig', array('resultat' => $nbre_des_jours));
            }
        }

        return $this->render('DateAppBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
