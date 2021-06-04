<?php

namespace Drupal\form_submit_logger\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TextForm.
 */
class TextForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'default_form';
    }

      /**
       * {@inheritdoc}
       */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['text'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Did you eat today?'),
          '#weight' => '0',
        ];
        $form['actions']['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) :void
    {
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) :void
    {
    }
}
