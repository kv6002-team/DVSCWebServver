<?php
/**
 * @author Scott Donaldson
 */

namespace email;

require_once "EmailConfig.php";

class EmailDispatcher {
  protected $emails_list;

  public function __construct($emails_list) {
    $this->emails_list = $emails_list;
  }

  public function add_email($email) {
    array_push($this->emails_list, $email);
  }

  public function send_emails() {
    foreach ($this->emails_list as $email) {
      $email->send();
    }
  }

  public static function send_reset_email($recipient_email, $recipient_name, $reset_link) {
    $subject = COMPANY_NAME_SHORT . " | Password Reset";

    $content = (
      "<h1>Password Reset</h1>"
      ."<p>If you did not request this password reset, please ignore it.</p>"
      ."Click here to change your password for DVSC: <a href='$reset_link'>$reset_link</a>"
    );

    $email = new Email(
      $recipient_email,
      $recipient_name,
      $content,
      $subject,
      false
    );
    $email->send();
  }

  public static function send_contactus_email($recipient_email = null, $contact_form) {
    $contact_form = $contact_form->as_array();

    if (is_null($recipient_email)) $recipient_email = CONTACT_US_CONFIG['fallback_recipient'];

    $email_subject = CONTACT_US_CONFIG['subject'] . " " . $contact_form['email_subject'];

    $email_content = (
      $contact_form['message_content']
      . "\n" . "Phone Number : " . $contact_form['phone_number']
      . "\n" . "Email Address : " . $contact_form['email_address']
    );

    $email = new Email(
      $recipient_email,
      EMAIL_SENDER_NAME,
      $email_content,
      $email_subject,
      false
    );

    $email->send();
  }

  public function send_unique_email($email){
    $email->send();
  }
}
