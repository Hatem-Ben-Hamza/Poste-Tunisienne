<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EcommerceBundle\Entity\Commande;


class EcommerceController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('EcommerceBundle:Product')->findAll();
        $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();
        return $this->render('EcommerceBundle:Ecommerce:index.html.twig',array(
          'products' => $products,
          'categories' => $categories
        ));
    }

    public function aboutAction()
    {
        return $this->render('EcommerceBundle:Ecommerce:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('EcommerceBundle:Ecommerce:contact.html.twig');
    }

    public function productDetailsAction($id)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $product = $em->getRepository('EcommerceBundle:Product')->find($id);
      $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();
      return $this->render('EcommerceBundle:Ecommerce:product.html.twig',array(
        'product' => $product,
        'categories' => $categories,
      ));
    }

    public function categorieProductsAction($id)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $categorie = $em->getRepository('EcommerceBundle:Categorie')->find($id);
      $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();
      $products = $categorie->getProducts();
      return $this->render('EcommerceBundle:Ecommerce:categorie.html.twig',array(
        'products' => $products,
        'categorieAc' => $categorie,
        'categories' => $categories
      ));
    }

    public function cartAction(Request $request){

      $session = $request->getSession();
      if (!$session->has('panier')) $session->set('panier',array());
      $panier = $session->get('panier');

      $em = $this->getDoctrine()->getEntityManager();
      $products = $em->getRepository('EcommerceBundle:Product')->findBy(array('id' => array_keys($panier)));
      return $this->render('EcommerceBundle:Cart:cart.html.twig',array(
        'products' => $products,
        'panier' => $panier
      ));
    }

    public function addCartAction($id,Request $request){

        $session = $request->getSession();
        
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;
          }
            
        $session->set('panier',$panier);
        
        
        return $this->redirect($this->generateUrl('ecommerce_cart'));

    }


    public function deleteCartAction($id,Request $request){

        $session = $request->getSession();
        
        $panier = $session->get('panier');

        if(array_key_exists($id,$panier)){
          unset($panier[$id]);
          $session->set('panier',$panier);
        }
        return $this->redirect($this->generateUrl('ecommerce_cart'));
    }

    public function clearCartAction(Request $request){
        $session = $request->getSession();
        
        $session->clear();
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('ecommerce_cart'));
    }


    public function checkoutAction(Request $request)
    {
        
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $session = $request->getSession();
      if (!$session->has('panier')) $session->set('panier',array());
      $panier = $session->get('panier');

      $em = $this->getDoctrine()->getEntityManager();
      $products = $em->getRepository('EcommerceBundle:Product')->findBy(array('id' => array_keys($panier)));
      return $this->render('EcommerceBundle:Checkout:checkout.html.twig',array(
        'products' => $products,
        'panier' => $panier,
      ));
    }

    public function SendEmailAction(){
       $message = \Swift_Message::newInstance()
       ->setSubject('Formalab')
       ->setFrom('hatembenhamzacrk09@gmail.com')
       ->setTo('hatembenhamzacrk09@gmail.com')
       ->setBody('test from new session');

       $this->get('mailer')
           ->send($message);

       return $this->render('EcommerceBundle:Ecommerce:send.html.twig');
    }

    public function placerCommandeAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $Commande = new Commande();

        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $adresse = $request->request->get('addresse');
        $ville = $request->request->get('ville');
        $cp = $request->request->get('zip');
        $nom_carte = $request->request->get('nom_carte');
        $num_carte = $request->request->get('num_carte');
        $expmonth = $request->request->get('expmonth');
        $expyear = $request->request->get('expyear');
        $ccv = $request->request->get('expyear');
        $total = $request->request->get('total');

        $Commande->setDateCommande(new \DateTime('now'));
        $Commande->setNom($nom);
        $Commande->setPrenom($prenom);
        $Commande->setAdresse($adresse);
        $Commande->setVille($ville);
        $Commande->setCodePostal($cp);
        $Commande->setNumCarte($num_carte);
        $Commande->setNomCarte($nom_carte);
        $Commande->setMoisExp($expmonth);
        $Commande->setAnneeExp($expyear);
        $Commande->setCcv($ccv);
        $Commande->setUser($this->getUser());
        $Commande->setTotal($total);
        $Commande->setStatutPaiement('en cours');
        $Commande->setStatutLivraison('en cours');
        $em->persist($Commande);
        $em->flush();
        $session = $request->getSession();
        
        $session->clear();
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        $session->set('panier',$panier);
       
        $message = \Swift_Message::newInstance()
        ->setSubject('Order Confirmation')
        ->setFrom('votre adresse email ici')
        ->setTo($this->getUser()->getEmail())
        ->setBody('Votre commande à éte bien enregistrée !');
 
        $this->get('mailer')
            ->send($message);
        
        $this->get('session')->getFlashBag()->set('success', 'Votre commande à éte bien enregistrée !  veuillez vérifier votre Email');

            return $this->redirect($this->generateUrl('ecommerce_homepage'));

    }

}
