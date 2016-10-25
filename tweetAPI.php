<?php
/**
 * Created by PhpStorm.
 * User: hannahnewsome
 * Date: 10/15/16
 */

require_once 'API.class.php';
require_once 'APIKey.class.php';

class Products_API extends API
{
    protected $APIKey;

    protected $dataSource;

    public function __construct($request, $origin) {
        parent::__construct($request);

        if (!array_key_exists('clientKey', $this->request)) {
            throw new Exception('No client key provided');
        } else {
            $this->APIKey = new APIKey($this->request['clientKey'], $origin);
        }

        if ($this->endpoint != 'generateAPIKey') {
          if (!array_key_exists('apiKey', $this->request)) {
              throw new Exception('No API Key provided');
          } else if (!$this->APIKey->validateAPIKey($this->request['apiKey'])) {
              throw new Exception('Invalid API Key');
          }
      }
    }

    private function loadDataFromFile ($path) {
      $str = @file_get_contents($path);
      if ($str === FALSE) {
          throw new Exception("Cannot access '$path' to read contents.");
      } else {
          return $str;
        }
    }
    protected function searchProductsByDate(){
      if (!isset($this->request['startDate']) || !isset($this->request['endDate'])){
        return Array('error' => 'Missing parameters');
      }
      $productsArray = array();
      $json = json_decode($this->loadDataFromFile('products.json'));
      foreach($json as $item) {
        if ($this->request['startDate'] >= $item->next_available->window_start_date_time
            && $this->request['endDate'] <= $item->next_available->window_end_date_time){
              array_push($productsArray, $item);
            }
      if(!empty($productsArray)){
        return $productsArray;
      }  else {
        return Array('error' => 'No products found.');
      }
    }
  }

    protected function products() {
        if ($this->method == 'GET') {
          try {
            return $this->loadDataFromFile('products.json');
          } catch (Exception $e) {
              return json_encode(Array('error' => $e->getMessage()));
          }
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function generateAPIKey () {
        return $this->APIKey->generateAPIKey();
    }
}
