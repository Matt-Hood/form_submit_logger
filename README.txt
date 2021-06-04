This module provides logging for all form field values submitted. This module was developed
as a general proof of concept, so only high level functionality was implemented to start off.

Requirements:

1. Create a custom submit form handler.
  - I created a custom form handler leveraging hook_form_alter() and a callback function that I attached to the submit action on all forms
  - I chose to go with a hook as I did not want to overcomplicate this proof of concept since Drupal does not provide a default event listener
  for all form submits. However I always see if I can solve a problem / accomplish a task by leveraging events before I use hooks.

2. This form handler should get the values from any form field ( for example , Did you eat today? Yes or no)
  - I developed the module such that it will retrieve the values from any form field submitted with the exception of "views_expsoed_forms" because
  it is called too often throughout navigation of the site and clicking menu links. By not logging views_expsoed_forms calls I was able to keep the log much cleaner
  leaving out insignificant submit logs

3. This value is then logged in the Drupal watchdog and a notification is shown to the user “thank you”
  - I wanted to keep my form_submit_logger.module module file as clean and minimal as possible, to do this I created a service to do all the heavy lifting for me.
  The service was made from my FormSubmitLoggerLogic Class located at src/FormSubmitLogic.php . This class utilizes DependencyInjection to retrieve the two key drupal services
  I needed to complete this task: "messenger" and "logger.factory". I utilzed these services to give the user a thank you notification as well as log the value in the drupal watchdog

Extra:
- To make testing a little easier I made two custom forms one a text form and the other a radio form with custom functionality to output the singular value submitted.
- textform url: form_submit_logger/form/text
- radioform url: /form_submit_logger/form/radio

- All other forms will be logged as the full array of values submitted to make sure all the information is captured


Thank you for the opportunity, developing this module was a lot of fun!
