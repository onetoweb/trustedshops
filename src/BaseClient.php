<?php

namespace Onetoweb\Trustedshops;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

/**
 * Base Client.
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
class BaseClient
{
    // base uri
    const BASE_URI = 'https://api.trustedshops.com';
    
    // version
    const VERSION = '2';
    
    // methods
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    
    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $password;
    
    /**
     * @var int
     */
    private $version;
    
    /**
     * @var string
     */
    private $acceptLanguage;
    
    /**
     * @param string $email
     * @param string $password
     * @param int $version = self::VERSION
     */
    public function __construct(string $email, string $password, int $version = self::VERSION)
    {
        $this->email = $email;
        $this->password = $password;
        $this->version = $version;
    }
    
    /**
     * @param string $acceptLanguage
     */
    public function setAcceptLanguage(string $acceptLanguage)
    {
        $this->acceptLanguage = $acceptLanguage;
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     *
     * @return mixed null|array
     */
    public function get(string $endpoint, array $query = []): ?array
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param bool $json = false
     *
     * @return mixed null|array
     */
    public function post(string $endpoint, array $data = [], array $query = [], bool $json = false): ?array
    {
        return $this->request(self::METHOD_POST, $endpoint, $data, $query, $json);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param bool $json = false
     *
     * @return mixed null|array
     */
    public function put(string $endpoint, array $data = [], array $query = [], bool $json = false): ?array
    {
        return $this->request(self::METHOD_PUT, $endpoint, $data, $query, $json);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     *
     * @return mixed null|array
     */
    public function delete(string $endpoint, array $query = []): ?array
    {
        return $this->request(self::METHOD_DELETE, $endpoint, [], $query);
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param bool $json = false
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [], bool $json = false): ?array
    {
        // setup client
        $guzzleClient = new GuzzleClient([
            'base_uri' => self::BASE_URI,
            'http_errors' => false,
        ]);
        
        // build headers
        $headers = [
            'Accept' => 'application/json',
            'Cache-Control' => 'no-cache',
            'Connection' => 'close',
        ];
        
        // add accept language
        if ($this->acceptLanguage) {
            $headers['Accept-Language'] = $this->acceptLanguage;
        }
        
        // build request options
        $options = [
            RequestOptions::HEADERS => $headers,
            RequestOptions::QUERY => $query,
            RequestOptions::AUTH => [
                $this->email,
                $this->password
            ],
        ];
        
        // add data to request
        if (count($data) > 0) {
            
            if ($json) {
                $options[RequestOptions::JSON] = $data;
            } else {
                $options[RequestOptions::FORM_PARAMS] = $data;
            }
        }
        
        // make request
        $result = $guzzleClient->request($method, "/rest/restricted/v{$this->version}/$endpoint", $options);
        
        // json decode contents
        $contents = json_decode($result->getBody()->getContents(), true);
        
        if (isset($contents['response']['code']) and $contents['response']['code'] == 200) {
            
            // return data
            return $contents['response']['data'];
            
        } else {
            
            // return contents
            return $contents;
            
        }
    }
}