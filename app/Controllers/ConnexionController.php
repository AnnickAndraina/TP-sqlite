<?php

namespace App\Controllers;

class ConnexionController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Commenté temporairement - base de données non disponible
        // $this->userModel = new UserModel();
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

        // Données de test - utilisateur TEST
        $testUsers = [
            ['id' => 1, 'email' => 'user@test.com', 'name' => 'Test User', 'password' => 'password123'],
            ['id' => 2, 'email' => 'demo@example.com', 'name' => 'Demo User', 'password' => 'demo123']
        ];

        $user = null;
        foreach ($testUsers as $testUser) {
            if ($testUser['email'] === $email && $testUser['password'] === $password) {
                $user = $testUser;
                break;
            }
        }

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

        // Données de test - utilisateurs connus
        $knownUsers = [
            'user@test.com',
            'demo@example.com'
        ];

        if (in_array($email, $knownUsers)) {
            return redirect()->back()->with('error', 'Cet email est déjà utilisé');
        }

        // Simuler l'inscription en créant une session
        $session = session();
        $session->set([
            'user_id' => rand(100, 999),
            'email' => $email,
            'name' => $name,
            'logged_in' => true
        ]);

        return redirect()->to('/')->with('success', 'Inscription réussie!');
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
