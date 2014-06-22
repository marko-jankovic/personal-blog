<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{


    /**
     * @Template()
     */
    public function indexAction()
    {
        return array('actionName' => 'category');
    }
}
