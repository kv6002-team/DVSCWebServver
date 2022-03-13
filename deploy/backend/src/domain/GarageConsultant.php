<?php
namespace kf6012\domain;

use database\Bindable;
use kf6002\domain\User;

/**
 * A garage.
 * 
 * @author William Taylor (19009576)
 */
final class GarageConsultant extends User {
    /**
     * Create a new garage consultant.
     * 
     * @param string $emailAddress The email address for this consultant.
     * 
     * @param string $password The Garage Consultant's hashed password.
     * @param bool $passwordResetRequired Whether the Garage Consultant must
     *   reset their password before being allowed to make any further API
     *   requests.
     */
    public function __construct(
            $emailAddress,

            $password,
            $passwordResetRequired
    ) {
        parent::__construct($password, $passwordResetRequired);

        $this->emailAddress = $emailAddress;
    }

    /* Implement User
    -------------------- */
    
    public function username() {
        return $this->emailAddress;
    }
}
