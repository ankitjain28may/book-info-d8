<?php

/**
 * @file
 * Contains \Drupal\book\Form\BookForm.
 */

namespace Drupal\book\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Book Form
 */

class BookForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'book_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['book_name'] = [
            '#type' => 'textfield',
            '#title' => t('Book Name'),
            '#required' => true
        ];

        $form['book_description'] = [
            '#type' => 'textfield',
            '#title' => t('Book Description'),
            '#required' => true
        ];

        $form['book_author'] = [
            '#type' => 'textfield',
            '#title' => t('Book Author'),
            '#required' => true
        ];

        $form['book_date_of_publish'] = [
            '#type' => 'date',
            '#title' => t('Enter the publishing date of book'),
        ];

        $form['book_url'] = [
            '#type' => 'textfield',
            '#title' => t('Enter the url of online pdf of the book available'),
        ];

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Save'),
          '#button_type' => 'primary',
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if (!empty($form_state->getValue('book_url')) && !UrlHelper::isValid($form_state->getValue('book_url'), TRUE)) {
          $form_state->setErrorByName('book_url', $this->t('The book pdf url is invalid.'));
        }
      }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        foreach ($form_state->getValues() as $key => $value) {
            drupal_set_message($key . ': ' . $value);
        }
    }
}
