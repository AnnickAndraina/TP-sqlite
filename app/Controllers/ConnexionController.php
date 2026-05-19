<?php

namespace App\Controllers;

use App\Models\UserModel;

class ConnexionController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Affiche la page de connexion
     */
    public function login(): string
    {
        return view('login.php');
    }

    /**
     * Traite la connexion
     */
    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->authenticate($email, $password);

        if ($user) {
            $session = session();
            $session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'logged_in' => true
            ]);

            return redirect()->to('/');
        }

        return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
    }

    /**
     * Affiche la page d'inscription
     */
    public function register(): string
    {
        return view('inscription.php');
    }

    /**
     * Traite l'inscription
     */
    public function doRegister()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $name = $this->request->getPost('name');

        // Vérifier que l'email n'existe pas déjà
        if ($this->userModel->getUserByEmail($email)) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé');
        }

        $this->userModel->registerUser([
            'email' => $email,
            'password' => $password,
            'name' => $name
        ]);

        return redirect()->to('/connexion/login')->with('success', 'Inscription réussie, veuillez vous connecter');
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
