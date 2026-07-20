<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('role')) {
            return redirect()->to('/login');
        }

        $userRole = $session->get('role');
        if ($arguments && !in_array($userRole, $arguments)) {
            return redirect()->to('/login')->with('error', 'Accès refusé.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
