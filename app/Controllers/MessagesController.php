<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Helpers\View;
use App\Models\Message;

class MessagesController {
    private Message $messageModel;
    private Validator $validator;

    public function __construct() {
        $this->messageModel = new Message();
        $this->validator = new Validator();
    }

    public function index() {
        $message = $this->messageModel->getLastMessage();
        return View::render('messages/index.html.php', ['message' => $message]);
    }


    public function store() {
        $data = [
            'email' => $_POST['email'],
            'message' => $_POST['message'],
        ];

        (bool) $isValidEmail = $this->validator->isValidEmail($data['email']);

         if ($isValidEmail) {

            if ($this->messageModel->createMessage($data)) {
                header('Location: /');
                exit();
            } else {
                $errors = ['Failed to create message.'];
                return View::render('messages/index.html.php', ['errors' => $errors, 'data' => $data]);
            }
        } else {
            return View::render('messages/index.html.php', ['errors' => $this->validator->getErrors(), 'data' => $data]);
        }
    }
}