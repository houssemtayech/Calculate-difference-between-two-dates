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
        $jours_feries[] = array();
        $jours_feries= ['0','106','120','127','144','155','194','226','304','314','358'];
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $date1 = $form["firstDate"]->getData();
            $date2 = $form["secondDate"]->getData();
            if ($form->isValid()) {
                $nbre_des_jours = 0;
                $mercredi_sur_deux = false;
                $nbre_mercredi = 0;
                $nbre_des_jours_feries = 0;
                foreach (new \DatePeriod( $date1, new \DateInterval('P1D'), $date2) as $jour)
                {
                    $num_du_jour = $jour->format('N');
                    $num_du_jour2 = $jour->format('z');
                    if (($num_du_jour != '6') && ($num_du_jour != '7'))
                    {
                        ++$nbre_des_jours;
                        if(($num_du_jour == '3') && ($mercredi_sur_deux==false) )
                        {
                            ++$nbre_mercredi;
                            $mercredi_sur_deux=true;
                        }
                        elseif (($num_du_jour == '3') && ($mercredi_sur_deux==true))
                        {
                            $mercredi_sur_deux = false;

                        }
                        foreach ($jours_feries as $un_jour_ferie)
                        {
                            if (($un_jour_ferie == $num_du_jour2) )
                            {
                                ++$nbre_des_jours_feries;
                            }

                        }


                    }
                }
                $nbre_des_jours = $nbre_des_jours + 1 - $nbre_mercredi - $nbre_des_jours_feries;

                return $this->render('DateAppBundle:Default:resultat.html.twig', array('resultat' => $nbre_des_jours));
            }
        }

        return $this->render('DateAppBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
