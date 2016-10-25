<?php

/**
 * Class responsible for generating and validating API key.
 * for the purposes of this minimal application,
 * the API key is not stored in a database or explicitly associated with a particular user.
 * Rather, just creating an md5 hash based on $_SERVER['HTTP_ORIGIN'] and a client key.
 * this is a sample implementation not intended for use in production
 */

class APIKey {
  protected $clientKey;

  protected $referrer;

  function __construct($clientKey, $referrer) {
    $this->clientKey = $clientKey;
    $this->referrer = $referrer;
  }

  public function generateAPIKey () {
    return hash_hmac('md5', $this->referrer, $this->clientKey);
  }

  public function validateAPIKey ($providedKey) {
    if ($providedKey == $this->generateAPIKey()) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
