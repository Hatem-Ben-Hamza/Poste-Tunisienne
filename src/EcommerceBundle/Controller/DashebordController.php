<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EcommerceBundle\Entity\Categorie;
use EcommerceBundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;

class DashebordController extends Controller
{
    public function indexAction()
    {
        /*if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) { 
            throw $this->createNotFoundException('You are not allowed to access this page');  
        }*/

        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('EcommerceBundle:Product')->findAll();
        $categories = $em->getRepository('EcommerceBundle:Categorie')->findAll();
        $commandes = $em->getRepository('EcommerceBundle:Commande')->findAll();
        return $this->render('EcommerceBundle:Dashebord:index.html.twig',array(
            'products' => $products,
            'categories' => $categories,
            'commandes' => $commandes
          ));   
        
    }


    public function deleteProductAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('EcommerceBundle:Product')->find($id);

        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('ecommerce_dashebord_homepage'));

    }


    public function addProductAction(Request $request){
        
        $em = $this->getDoctrine()->getEntityManager();
        $product = new Product();
        $form = $this->createFormBuilder($product)             
        ->add('name',TextType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('price',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('stock',IntegerType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('image',FileType::class,array('data_class' => null))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if( $product->setName($form['name']->getData()) != null){
                $product->setName($form['name']->getData());
            }
            if($product->setDescription($form['description']->getData()) != null){
                $product->setDescription($form['description']->getData());
            }
            if($product->setPrice($form['price']->getData()) != null){
                $product->setPrice($form['price']->getData());
            }
            if($product->setStock($form['stock']->getData()) != null){
                $product->setStock($form['stock']->getData());
            }
            if($form['image']->getData() != null){
                $file = $form['image']->getData();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('products_images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                }
                $product->setImage('/assets/images/products/'.$fileName);
                }
            
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
            
            return $this->redirect($this->generateUrl('ecommerce_dashebord_homepage'));

        }

        return $this->render('EcommerceBundle:Dashebord:add-product.html.twig',array(
            'form' => $form->createView()
        ));

    }

    public function editProductAction(Request $request, $id){
        
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('EcommerceBundle:Product')->find($id);
        $form = $this->createFormBuilder($product)             
        ->add('name',TextType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('price',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('stock',IntegerType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('image',FileType::class,array('data_class' => null))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if( $product->setName($form['name']->getData()) != null){
                $product->setName($form['name']->getData());
            }
            if($product->setDescription($form['description']->getData()) != null){
                $product->setDescription($form['description']->getData());
            }
            if($product->setPrice($form['price']->getData()) != null){
                $product->setPrice($form['price']->getData());
            }
            if($product->setStock($form['stock']->getData()) != null){
                $product->setStock($form['stock']->getData());
            }
            if($form['image']->getData() != null){
                $file = $form['image']->getData();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('products_images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                }
                $product->setImage('/assets/images/products/'.$fileName);
                }
            
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
            
            return $this->redirect($this->generateUrl('ecommerce_dashebord_homepage'));

        }

        return $this->render('EcommerceBundle:Dashebord:edit-product.html.twig',array(
            'form' => $form->createView()
        ));

    }

    public function addCategorieAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categorie = new Categorie();
        $form = $this->createFormBuilder($categorie)
        ->add('name',TextType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $categorie->setName($form['name']->getData());
            $categorie->setDescription($form['description']->getData());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            
        return $this->redirect($this->generateUrl('ecommerce_homepage'));
    }

    return $this->render('EcommerceBundle:Dashebord:add-categorie.html.twig',array(
        'form' => $form->createView()
    ));
}

public function editCategorieAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categorie = $em->getRepository('EcommerceBundle:Categorie')->find($id);
        $form = $this->createFormBuilder($categorie)
        ->add('name',TextType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-control col-md-12','style'=>'margin-bottom:15px;')))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $categorie->setName($form['name']->getData());
            $categorie->setDescription($form['description']->getData());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            
        return $this->redirect($this->generateUrl('ecommerce_homepage'));
    }

    return $this->render('EcommerceBundle:Dashebord:add-categorie.html.twig',array(
        'form' => $form->createView()
    ));
}

public function deleteCategorieAction($id){
    $em = $this->getDoctrine()->getEntityManager();
    $categorie = $em->getRepository('EcommerceBundle:Categorie')->find($id);

    $em->remove($categorie);
    $em->flush();

    return $this->redirect($this->generateUrl('ecommerce_dashebord_homepage'));

}

}
