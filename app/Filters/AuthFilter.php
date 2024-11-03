<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is authenticated
        $is_logged = session()->get('is_logged');
        $user_type = session()->get('user_type');

        // Get the controller name from the request=
        $uri = $request->getUri();

        // Retrieve the first segment of the URI
        $firstSegment = $uri->getSegment(1);

        // Convert to lowercase if needed
        $controller = strtolower($firstSegment);

        if (!$controller) {
            return redirect()->to('/LoginController/UserTypePage');
        } else {
            if ($is_logged) {
                // check user type
                if ($user_type == 1) {
                    // check controller 
                    if ($controller !== 'admincontroller') {
                        session()->setFlashdata('access', 'Cannot Access Page!');
                        return redirect()->back();
                    }
                } elseif ($user_type == 2) {
                    // check controller 
                    if ($controller !== 'studentcontroller') {
                        session()->setFlashdata('access', 'Cannot Access Page!');
                        return redirect()->back();
                    }
                }
            } else {
                if ($controller != 'logincontroller' && $controller != 'visitorcontroller') {
                    session()->setFlashdata('access', 'Cannot Access Page!');
                    return redirect()->to('/LoginController/UserTypePage');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // do something here
    }
}
