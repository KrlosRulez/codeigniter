<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{

    public function loginForm($error = null)
    {
        helper('form');

        if ($error == null) {

            return view('templates/header', ['title' => 'Private Access'])
                . view('users/login', ['error' => ''])
                . view('templates/footer');

        } else {

            return view('templates/header', ['title' => 'Private Access'])
                . view('users/login', ['error' => 'Credenciales incorrectas'])
                . view('templates/footer');

        }
    }

    public function checkUser()
    {
        helper('form');
        // Checks whether the submitted data passed the validation rules.
        if (
            !$this->validate([
                'username' => 'required|max_length[255]|min_length[4]',
                'password' => 'required|max_length[5000]|min_length[4]',
            ])
        ) {
            // The validation fails, so returns the form.
            return $this->loginForm();
        }
        // Gets the validated data.
        $post = $this->validator->getValidated();
        $model = model(UserModel::class);
        if ($data['user'] = $model->checkUser($post['username'], $post['password'])) {
            
            $session = session();
            $session->set('user',$post['username']);
            
            return view('templates/header', ['title' => 'Admin'])
                . view('users/admin', $data)
                . view('templates/footer');
        } else {
            return $this->loginForm("Error");
        }
    }

    public function closeSession()
    {
    $session = session();
    //eliminar variable de sesion específica
    $session->remove('user');
    //eliminar toda la información de la sesion
    $session->destroy();
    return view('welcome_message');
    }

}