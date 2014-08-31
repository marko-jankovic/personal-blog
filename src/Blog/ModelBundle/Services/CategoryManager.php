<?php
namespace Blog\ModelBundle\Services;

use Blog\ModelBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryManager
 */
class CategoryManager
{
    public $em;
    private $formFactory;

    /**
     * @param EntityManager        $em
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $em, FormFactoryInterface $formFactory)
    {
        $this->em          = $em;
        $this->formFactory = $formFactory;
    }

    /**
     * Find all categories
     *
     * @return array
     */
    public function findAll()
    {
        $categories = $this->em->getRepository('ModelBundle:Category')->findAll();

        return $categories;
    }

    /**
     * Find Category
     *
     * @param string $array
     *
     * @throws NotFoundHttpException
     * @return Category
     */
    public function findOneBy($array)
    {
        $category = $this->em->getRepository('ModelBundle:Category')->findOneBy($array);

        if (null === $category) {
            throw new NotFoundHttpException('Category was not found');
        }

        return $category;
    }

    /**
     * Find Category by slug
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return Category
     */
    public function findBySlug($slug)
    {
        $category = $this->em->getRepository('ModelBundle:Category')->findOneBy(
            array(
             'slug' => $slug
            )
        );

        if (null === $category) {
            throw new NotFoundHttpException('Category was not found');
        }

        return $category;
    }
}