<?php

namespace controller;

use main\Application;
use model\User;

class LoginController
{
    public function indexAction()
    {
        $request = Application::request();

        $postData = $request->getPost('User');

        if ($postData) {
            if (User::validate($postData)) {
                $user = User::get($postData);

                if (!$user) {
                    $request->setFlash('warning', 'There is no such user');
                    $request->redirectBack();
                }

                $request->setUser($user);
                $request->setFlash('success', 'You have logged in as ' . $user->name);

            } else {
                foreach (User::getErrors() as $error) {
                    $request->setFlash('warning', $error);
                }
            }
        }

        $request->redirectHome();
    }
    
    public function logoutAction()
    {
        $request = request();
        
        $request->logout();

        $request->setFlash('success', 'You have logged out');

        $request->redirectHome();
    }
}
