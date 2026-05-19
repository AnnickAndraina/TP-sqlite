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
            ['id' => 1, 'email' => 'user@test.com', 'name' => 'Test User', 'password' => 'password123', 'role' => 'user'],
            ['id' => 2, 'email' => 'demo@example.com', 'name' => 'Demo User', 'password' => 'demo123', 'role' => 'user'],
            ['id' => 99, 'email' => 'admin@foodswipe.com', 'name' => 'Admin FoodSwipe', 'password' => 'admin123', 'role' => 'admin'],
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
                'role' => $user['role'],
                'logged_in' => true
            ]);

            // Rediriger l'admin vers le dashboard
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin');
            }

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

    /**
     * Affiche le profil utilisateur
     */
    public function profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = [
            'id' => $userId,
            'name' => $session->get('name'),
            'email' => $session->get('email'),
            'created_at' => '2026-05-01'
        ];

        return view('profile', ['user' => $user]);
    }

    /**
     * Met à jour le profil utilisateur
     */
    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');

        // Validation
        $errors = [];

        if (empty($name)) {
            $errors[] = 'Le nom est requis';
        }

        if (!empty($password)) {
            if ($password !== $password_confirm) {
                $errors[] = 'Les mots de passe ne correspondent pas';
            }
            if (strlen($password) < 6) {
                $errors[] = 'Le mot de passe doit contenir au moins 6 caractères';
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors);
        }

        // Mettre à jour la session
        $session->set([
            'name' => $name
        ]);

        return redirect()->to('/connexion/profile')->with('success', 'Profil mis à jour avec succès!');
    }
}

