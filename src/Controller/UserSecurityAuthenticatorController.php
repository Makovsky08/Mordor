<?php
declare(strict_types=1);

namespace App\Controller;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserSecurityAuthenticatorController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Check if the user is already logged in
        $user = $this->getUser();
        if ($user) {
            $roles = $user->getRoles();

            if (empty($roles)) {
                // If no roles, redirect to default page
                return $this->redirectToRoute('app_post_index');
            } elseif (count($roles) > 1) {
                // If multiple roles, redirect to default page
                return $this->redirectToRoute('app_post_index');
            }

            // Define redirections based on roles
            if (in_array('ROLE_ADMIN', $roles)) {
                return $this->redirectToRoute('app_admin');
            } elseif (in_array('ROLE_AUTOR', $roles)) {
                return $this->redirectToRoute('app_autor');
            } elseif (in_array('ROLE_REVIEWER', $roles)) {
                return $this->redirectToRoute('app_review');
            } elseif (in_array('ROLE_REDAKTOR', $roles)) {
                return $this->redirectToRoute('app_redaktor');
            } elseif (in_array('ROLE_SEFREDAKTOR', $roles)) {
                return $this->redirectToRoute('app_sef_redaktor');
            }
            // Add more role checks if needed

            return $this->redirectToRoute('app_post_index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
