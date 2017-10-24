<?php

namespace controller;

use components\AppController;
use main\Application;
use components\Helpers\Sort;
use model\Feedback;
use model\File;
use Strana\Paginator;


Application::includeAll(); // for remote server


class IndexController extends AppController
{
    public function indexAction()
    {
        $this->storeFeedBack();

        $request = request();
        $sorts = Sort::get()->keyBy('key');
        $sort = request()->get('sort', Sort::DATE_NEWEST['key']);
        $feedBacks = Feedback::getAll($sorts[$sort]['sql']) ?: [];
        $feedBacks = (new Paginator())->perPage(3)->make($feedBacks);

        $this->render(
            'index',
            compact('feedBacks', 'postData', 'request', 'sorts')
        );
    }
    
    private function storeFeedBack()
    {
        $request = request();

        $postData = $request->getPost('Feedback', $request->getPost('Edit_Feedback'));

        if ($postData) {
            if (Feedback::validate($postData)) {
                $file = $request->getFile('Feedback', $request->getFile('Edit_Feedback'));

                if (@$file['tmp_name']['image']) {
                    if (File::upload($file)) {
                        $postData['image'] = File::getFilePath();
                    } else {
                        $this->refreshWithErrors(File::getErrors());
                    }
                }

                if (!empty($postData['id'])) {
                    $postData['modified'] = true;
                    Feedback::update($postData);

                    $this->refreshWithSuccesses(['Feedback was updated successfully']);
                } else {
                    $feedBack = new Feedback();
                    $feedBack->insert($postData);
                    $feedBack->store();

                    $this->refreshWithSuccesses(['Feedback was created successfully']);
                }
            } else {
                $this->refreshWithErrors(Feedback::getErrors());
            }
        }

        if ($request->getPost('status')) {
            Feedback::setStatus($request->getPost('id'), $request->getPost('status'));
        }
        if ($request->getPost('remove')) {
            Feedback::remove($request->getPost('id'));
        }
    }
}
