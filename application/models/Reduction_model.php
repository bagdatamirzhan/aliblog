<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reduction_model extends CI_Model
{
  protected $client;
  protected $client_id;
  protected $client_secret;

  public function __construct()
  {
    parent::__construct();

    $this->load->library('guzzle');

    $this->client = new GuzzleHttp\Client();

    $this->client_id = 'web-client';
    $this->client_secret = 'eo6y2dpfTZ1XIsnLiQMlHkzBqjruC7WP';
  }

  public function get_tokens()
  {
    $url        = 'https://oauth2.epn.bz/token';

    try {
      $response = $this->client->request(
        'POST',
        $url,
        [
          'data'
          => [
            'grant_type' => 'client_credential',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret
          ],
          'headers'
          => [
            'X-API-VERSION' => '2',
            'X-SSID' => ''
          ]
        ]
      );
      echo $response->getStatusCode(); // 200
      echo $response->getReasonPhrase(); // OK
      echo $response->getProtocolVersion(); // 1.1
      echo $response->getBody();
    } catch (GuzzleHttp\Exception\BadResponseException $e) {
      #guzzle repose for future use
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      print_r($responseBodyAsString);
    }
  }

  public function get_ssid()
  {
    $url        = 'https://oauth2.epn.bz/ssid?client_id=' . $this->client_id;

    try {
      $response = $this->client->request(
        'get',
        $url,
        [
          'headers'
          => [
            'X-API-VERSION' => '2'
          ]
        ]
      );
      // echo $response->getStatusCode(); // 200
      // echo $response->getReasonPhrase(); // OK
      // echo $response->getProtocolVersion(); // 1.1
      return json_decode($response->getBody());
    } catch (GuzzleHttp\Exception\BadResponseException $e) {
      #guzzle repose for future use
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      return json_decode($responseBodyAsString);
    }
  }
}
