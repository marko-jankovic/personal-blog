<?php
/**
 * User: markojankovic
 * Date: 7/13/14
 * Time: 5:02 PM
 */

namespace Blog\ModelBundle\Form\Helpers;

/**
 * Class FormError
 *
 * @link https://github.com/symfony/symfony/issues/7205
 */
class FormError
{
    public function getArray(\Symfony\Component\Form\Form $form)
    {
        return $this->getErrors($form);
    }

    private function getErrors($form)
    {
        $errors = array();

        if ($form instanceof \Symfony\Component\Form\Form) {

            foreach ($form->getErrors() as $error) {
                $errors = $error->getMessage();
            }

            foreach ($form->all() as $key => $child) {

                if ($err = $this->getErrors($child)) {
                    $errors[$key] = $this->getErrors($child);
                }
            }
        }

        return $errors;
    }
}