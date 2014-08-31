<?php

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\Category;
use Blog\ModelBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CategoryController extends Controller
{


    /**
     * @Template("")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()
                      ->getRepository('ModelBundle:Category')
                      ->findAll();

        return array(
            'actionName' => 'category',
            'categories' => $categories
        );
    }

    /**
     * @Template("AdminBundle:Category:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $errors = array();

        $form = $this->createForm(new CategoryType());

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();
                $category = new Category();

                $category->setName($data['name']);
                $category->setDescription($data['description']);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($category);
                $manager->flush();

                return $this->redirect($this->generateUrl('admin_category'));

            } else {
                $errors = $this->get('form_errors')->getArray($form);
            }
        }

        return array(
            'actionName' => 'create-category',
            'errors'     => $errors,
            'form'       => $form->createView()
        );
    }

    /**
     * @Template("AdminBundle:Category:edit.html.twig")
     */
    public function editAction(Request $request, $id)
    {
        $errors = array();
        $categoryManager = $this->get('categoryManager');

        $category = $categoryManager->findOneBy(array('id' => $id));

        $form = $this->createForm(new CategoryType(), $category);

        if ($request->isMethod('POST')) {

            $form->bind($request);
            $manager = $this->getDoctrine()->getManager();

            if ($form->isValid()) {

                $data = $form->getData();

                $category->setName($data->getName());
                $category->setDescription($data->getDescription());


                $manager->persist($category);
                $manager->flush();

                $request->getSession()
                        ->getFlashBag()
                        ->add('success', 'Category has been updated');

                return $this->redirect($this->generateUrl('admin_category'));
            } else {
                $errors = $this->get('form_errors')->getArray($form);
            }
        }

        return array(
            'actionName' => 'edit-category',
            'errors'     => $errors,
            'category'   => $category,
            'form'       => $form->createView()
        );
    }

    public function deleteAction($id)
    {
        $manager  = $this->getDoctrine()->getManager();
        $category = $this->get('categoryManager')
                     ->findOneBy(array('id' => $id));


        $manager->remove($category);
        $manager->flush();

        return $this->redirect($this->generateUrl('admin_category'));
    }
}
