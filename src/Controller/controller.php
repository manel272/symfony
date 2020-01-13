<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Appareil;
use App\Entity\Fabricant;
use App\Entity\Systeme;
use  Symfony\Component\HttpFoundation\Request\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class controller extends AbstractController
{
    /**
     * @Route("/web", name="web")
     */
    public function index()
    {
        return $this -> render ( 'accueil.html.twig');
    }
    /**
     * @Route("/web1", name="web1")
     */
    public function affiche_appareil() 
    {
        $em = $this->getDoctrine()->getManager();
$repo = $em->getRepository(Appareil::class);
$lesAppareil = $repo->findAll();
return $this->render('index.html.twig', ['lesAppareil' => $lesAppareil]);
    }
    /**
     * @Route("/web2", name="web2")
     */
     public function affiche_Fab() 
     {
         $em = $this->getDoctrine()->getManager();
 $repo = $em->getRepository(Fabricant::class);
 $lesFab = $repo->findAll();
 return $this->render('index1.html.twig', ['lesFab' => $lesFab]);
     }
     /**
     * @Route("/web3", name="web3")
     */
     public function affiche_Sys() 
     {
         $em = $this->getDoctrine()->getManager();
 $repo = $em->getRepository(Systeme::class);
 $lesSys = $repo->findAll();
 return $this->render('index2.html.twig', ['lesSys' => $lesSys]);
     }
     
    /**
     * @Route("/web1/{id}", name="app_voir")
     */
     public function voir($id)
     {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Appareil::class);
        
        $lesAppareil = $repo-> find($id);
        if($lesAppareil == null)
    throw $this->createNotFoundException(" Appareil $id inéxistant !");
// On le passe à la vue pour l'afficher
        return $this->render('voir.html.twig', ['id'=>$id ,'lesAppareil' => $lesAppareil]);

     }
      /**
     * @Route("/web2/{id}", name="app_voir1")
     */
     public function voir1($id)
     {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Fabricant::class);
        
        $lesFab = $repo-> find($id);
        if($lesFab == null)
    throw $this->createNotFoundException("404- Fabricant $id inéxistant !");
// On le passe à la vue pour l'afficher
        return $this->render('voir1.html.twig', ['id'=>$id ,'lesFab' => $lesFab]);

     }
     /**
     * @Route("/web3/{id}", name="app_voir2")
     */
     public function voir2($id)
     {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Systeme::class);
        
        $lesSys = $repo-> find($id);
        if($lesSys == null)
    throw $this->createNotFoundException("404- Systeme n°$id inéxistant !");
// On le passe à la vue pour l'afficher
        return $this->render('voir2.html.twig', ['id'=>$id ,'lesSys' => $lesSys]);

     }
     /** 
     * @Route("/ajoute", name="inscri_ajouter")
     */
     public function ajouterApp1(Request $request): Response
     {$em = $this->getDoctrine()->getManager();
        $lesAppareil = new Appareil();
        $lesAppareil->setDesignation($request->get('Designation'));
        $lesAppareil->setType($request->get('type'));
        $lesAppareil->setPrixUnit($request->get('prix'));
        $lesAppareil->setQteVendue($request->get('Qte'));
        $lesAppareil->setDateSortie(\DateTime::createFromFormat('Y-m-d', $request->get('date')));

      
       

       
        $em->persist($lesAppareil);
        $em->flush();
        

        $repo = $em->getRepository(Appareil::class);
        $lesAppareil = $repo->findAll();
        return $this->render('index.html.twig', ['lesAppareil' => $lesAppareil]);
     }
     /** 
     * @Route("/ajoute1", name="inscri_ajouter1")
     */
     public function ajouterApp2(Request $request): Response
     {$em = $this->getDoctrine()->getManager();
        $lesFab = new Fabricant();
        $lesFab->setNom($request->get('nom'));
        $lesFab->setPaysOrigine($request->get('Pays'));
   
       
        $em->persist($lesFab);
        $em->flush();
        

        $repo = $em->getRepository(Fabricant::class);
        $lesFab = $repo->findAll();
        return $this->render('index1.html.twig', ['lesFab' => $lesFab]);
     }
     /** 
     * @Route("/ajoute2", name="inscri_ajouter2")
     */
     public function ajouterApp3(Request $request): Response
     {$em = $this->getDoctrine()->getManager();
        $lesSys = new Systeme();
        $lesSys->setFamille($request->get('Famille'));
        $lesSys->setEditeur($request->get('editeur'));   
       
        $em->persist($lesSys);
        $em->flush();
        

        $repo = $em->getRepository(Systeme::class);
        $lesSys = $repo->findAll();
        return $this->render('index2.html.twig', ['lesSys' => $lesSys]);
     }
     
     /**
* @Route("supp/{id}", name="inscri_supprimer")
*/
public function supprimer($id)
{
$em =  $this->getDoctrine()->getManager();

$item = $em->getRepository(Appareil::class)-> find($id);
$em->remove($item);
$em->flush();

return $this->redirectToRoute('web1');}


  /**
* @Route("supp1/{id}", name="inscri_supprimer1")
*/
public function supprimer1($id)
{
$em =  $this->getDoctrine()->getManager();
$item=$em->getRepository(Fabricant::class)-> find($id);
$em->remove($item);
$em->flush();

return $this->redirectToRoute('web2');}
 /**
* @Route("supp2/{id}", name="inscri_supprimer2")
*/
public function supprimer2($id)
{
$em =  $this->getDoctrine()->getManager();
$item=$em->getRepository(Systeme::class)-> find($id);
$em->remove($item);
$em->flush();

return $this->redirectToRoute('web3');}
/**
     * @Route("/update/{id}", name="direct")
     */
     public function direct1($id)
     {$session = new Session();
        
        $session->set('id',$id);
         return $this -> render ( 'update.html.twig');
     }

/**
 * @Route("update", name="upadate")
 */
 public function update(Session $session,Request $request): Response
 {$session->start();
     $id= $session->get('id');
     $entityManager = $this->getDoctrine()->getManager();
     $lesAppareil = $entityManager->getRepository(Appareil::class)->find($id);
 
     if (!$lesAppareil) {
         throw $this->createNotFoundException(
             'No App found for id '.$id
         );
     }
 
     $lesAppareil->setDesignation($request->get('Designation'));
     $lesAppareil->setType($request->get('type'));
     $lesAppareil->setPrixUnit($request->get('prix'));
     $lesAppareil->setQteVendue($request->get('Qte'));
     $lesAppareil->setDateSortie(\DateTime::createFromFormat('Y-m-d', $request->get('date')));

   
     $entityManager->flush();
 
     return $this->redirectToRoute('web1');
 }
 /**
     * @Route("/update1/{id}", name="direct1")
     */
     public function direct2($id)
     {$session = new Session();
        
        $session->set('id1',$id);
         return $this -> render ( 'update1.html.twig');
     }

/**
 * @Route("update1", name="update1")
 */
 public function update1(Session $session,Request $request): Response
 {$session->start();
     $id= $session->get('id1');
     $entityManager = $this->getDoctrine()->getManager();
     $lesFab = $entityManager->getRepository(Fabricant::class)->find($id);
 
     if (!$lesFab) {
         throw $this->createNotFoundException(
             'No App found for id '.$id
         );
     }
 
     $lesFab->setNom($request->get('nom'));
     $lesFab->setPaysOrigine($request->get('Pays'));


   
     $entityManager->flush();
 
     return $this->redirectToRoute('web2');
 }
 /**
     * @Route("/update2/{id}", name="direct2")
     */
     public function direct3($id)
     {$session = new Session();
        
        $session->set('id2',$id);
         return $this -> render ( 'update2.html.twig');
     }

/**
 * @Route("update2", name="update2")
 */
 public function update2(Session $session,Request $request): Response
 {$session->start();
     $id= $session->get('id2');
     $entityManager = $this->getDoctrine()->getManager();
     $lesSys = $entityManager->getRepository(Systeme::class)->find($id);
 
     if (!$lesSys) {
         throw $this->createNotFoundException(
             'No Systeme found for id '.$id
         );
     }
 
     $lesSys->setFamille($request->get('Famille'));
     $lesSys->setEditeur($request->get('editeur'));
   

   
     $entityManager->flush();
 
     return $this->redirectToRoute('web3');
 }
 
}
?> 