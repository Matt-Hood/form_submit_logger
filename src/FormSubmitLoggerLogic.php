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

        /* make sure to only log the submit if it is relevant and not submits from clicking on links*/
        if (in_array('views_exposed_form', $result, true) === false) {
            $this->messenger->addMessage('Thank You');

            /* custom logic for logging of my custom radio form */
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

            /*custom logic for logging my custom text for */
            if (array_key_first($result) === 'text') {
                $this->loggerFactory->get('Form Submit Log')
                ->debug("Did you eat today - textform value:" . " " . '<pre><code>' .
                 print_r(reset($result), true) . '</code></pre>');
            }

            /* logic to log all other forms as arrays to ensure all submitted values are captured */
            if (array_key_first($result) !== 'did_you_eat_today' && array_key_first($result) !== 'text') {
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
