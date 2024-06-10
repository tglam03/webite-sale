<?php

namespace Tunglam\BasicPhp2\Controllers\Client;

use Rakit\Validation\Validator;
use Tunglam\BasicPhp2\Models\User;
use Tunglam\BasicPhp2\Commons\Helper;
use Tunglam\BasicPhp2\Commons\Controller;
use Rakit\Validation\Rules\UniqueEmailRule;

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function login()
    {
        return  $this->renderViewClient('auth.' . __FUNCTION__);
    }

    public function handleLogin()
    {
        $validator = new Validator;


        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
        ]);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors()->firstOfAll();

            $_SESSION['errors'] = $errors;

            header('Location: ' . url('login'));

            exit;
        } else {
            $user = $this->user->findByEmail($_POST['email']);


            if ($user && password_verify($_POST['password'], $user['password'])) {

                $_SESSION['user'] = $user;

                unset($_SESSION['cart']);
                // Helper::debug($user);

                if ($user['type'] == 'admin') {
                    header('Location: ' . url(''));
                } else {
                    header('Location: ' . url(''));
                }
            } else {
                echo 'Invalid password.';
            }

            // Helper::debug($user);
        }
    }

    public function handleRegister()
    {
        $validator = new Validator;
        $validator->addValidator('isEmailExit', new UniqueEmailRule());


        $validator->setMessages([
            'isEmailExit' => 'Email trung cdmm'
        ]);

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required',
            'email'                 => 'required|email|isEmailExit',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
        ]);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors()->firstOfAll();

            $_SESSION['errorsRegister'] = $errors;

            header('Location: ' . url('login'));
            exit();
        } else {
            $data = [
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];

            $this->user->insert($data);
            header('Location:' . url('login'));
        }
    }

    public function sigOut()
    {
        unset($_SESSION['cart-' . $_SESSION['user']['id']]);

        unset($_SESSION['user']);

        header('Location: ' . url(''));

        exit;
    }
}
