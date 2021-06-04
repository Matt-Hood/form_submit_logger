<?php
namespace Drupal\form_submit_logger;

use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FormSubmitLoggerLogic
{
    private $loggerFactory;
    private $messenger;

  /**
   * FormSubmitLoggerLogic constructor.
   */
    public function __construct(MessengerInterface $messenger, LoggerChannelFactory $loggerFactory)
    {
        $this->loggerFactory = $loggerFactory;
        $this->messenger = $messenger;
    }


  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
    public function handleSubmit(array $form, FormStateInterface $form_state) :void
    {
        $result = $form_state->getValues();


        if (!in_array('views_exposed_form', $result)) {
            $this->messenger->addMessage('Thank You');

            if (array_key_first($result) === 'did_you_eat_today') {
                if (reset($result) === '0') {
                    $radioResult = "Yes";
                } else {
                    $radioResult = "No";
                }
                $this->loggerFactory->get('Form Submit Log')
                ->debug("Did you eat today - checkboxform value:" . " " . '<pre><code>' . $radioResult .
                  '</code></pre>');
            }

            if (array_key_first($result) === 'text') {
                $this->loggerFactory->get('Form Submit Log')
                ->debug("Did you eat today - textform value:" . " " . '<pre><code>' .
                 print_r(reset($result), true) . '</code></pre>');
            }

            if (!array_key_first($result) === 'did_you_eat_today' && !array_key_first($result) === 'text') {
                $this->loggerFactory->get('Form Submit Log')
                ->debug('<pre><code>' . print_r($result, true) . '</code></pre>');
            }
        }
    }



    public static function create(ContainerInterface $container)
    {
        $messenger = $container->get('messenger');
        $loggerFactory = $container->get('logger.factory');

        return new static($messenger, $loggerFactory);
    }
}
