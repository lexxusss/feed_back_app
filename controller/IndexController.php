<?php

namespace controller;

use components\AppController;
use main\Application;
use model\Feedback;
use model\File;

Application::includeAll();

class IndexController extends AppController
{
    public function indexAction()
    {
        $request = Application::request();

        $postData = $request->getPost('Feedback', $request->getPost('Edit_Feedback'));
        $errors = array();

        if ($postData) {
            $this->storeFeedBack($postData, $errors);
        }

        if ($request->getPost('status')) {
            Feedback::setStatus($request->getPost());
        }
        
        if ($request->getPost('remove')) {
            Feedback::remove($request->getPost('id'));
        }

        $sortData = $request->getQuery('sort', 'date-newest');
        $sort = $this->parseSorting($sortData);
        $feedBacks = Feedback::getAll($sort) ?: array();

        $this->render(
            'index',
            [
                'feedBacks' => $feedBacks,
                'errors' => $errors,
                'postData' => $postData,
                'request' => $request
            ]
        );
    }
    
    private function storeFeedBack($postData, &$errors)
    {
        $request = Application::request();

        if (Feedback::validate($postData)) {
            $file = $request->getFile('Feedback');

            if (@$file['tmp_name']['image']) {
                if (File::upload($file)) {
                    $postData['image'] = File::getFilePath();
                } else {
                    $errors = File::getErrors();

                    foreach ($errors as $error) {
                        $request->setFlash('warning', $error);
                    }

                    $request->redirect();
                }
            }

            if (!empty($postData['id'])) {
                $postData['modified'] = true;
                Feedback::update($postData);

                $request->setFlash('success', 'Feedback was updated successfully');
            } else {
                $feedBack = new Feedback();
                $feedBack->insert($postData);
                $feedBack->store();

                $request->setFlash('success', 'Feedback was created successfully');
            }

            $request->redirect();
        } else {
            $errors = Feedback::getErrors();
        }
    }

    private function parseSorting($sortData)
    {
        switch ($sortData) {
            case 'date-newest':
                $sort = array('column' => 'updated', 'direction' => 'desc');
                break;
            case 'date-oldest':
                $sort = array('column' => 'updated', 'direction' => 'asc');
                break;
            case 'name-abc':
                $sort = array('column' => 'name', 'direction' => 'asc');
                break;
            case 'name-zxy':
                $sort = array('column' => 'name', 'direction' => 'desc');
                break;
            case 'email-abc':
                $sort = array('column' => 'email', 'direction' => 'asc');
                break;
            case 'email-zxy':
                $sort = array('column' => 'email', 'direction' => 'desc');
                break;
            default:
                $sort = array('column' => 'updated', 'direction' => 'desc');
        }

        return $sort;
    }
}
