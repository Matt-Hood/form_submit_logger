<?php

namespace Drupal\form_submit_logger\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RadioForm.
 */
class RadioForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'radio_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['did_you_eat_today'] = [
        '#type' => 'radios',
        '#title' => $this->t('Did you eat today?'),
        '#description' => $this->t('Asks user if they ate today'),
        '#weight' => '0',
        '#options' => array(
        0 => $this->t('Yes'),
        1 =>  $this->t('No')),
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
