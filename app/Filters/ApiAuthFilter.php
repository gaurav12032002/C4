<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeader('Authorization');
        $headerValue = $authHeader->getValue();

        if (!$headerValue || strpos($headerValue, 'Basic ') !== 0) {
            return $this->unauthorizedResponse();
        }
     

        $credentials = base64_decode(substr($headerValue, 6));
        list($username, $password) = explode(':', $credentials);

        // Validate credentials (replace with your logic)
        if ($username !== 'admin' || $password !== 'password') {
            return $this->unauthorizedResponse();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after the request, if needed
    }

    private function unauthorizedResponse()
    {
        return service('response')->setStatusCode(401, 'Unauthorized')->setBody('Unauthorized');
    }
}
