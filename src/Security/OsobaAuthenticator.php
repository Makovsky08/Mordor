<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class OsobaAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    private $router;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator, RouterInterface $router)
    {
        $this->router = $router;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        $user = $token->getUser();
        $roles = $user->getRoles();

        if (empty($roles)) {
            // If no roles, redirect to default page
            return new RedirectResponse($this->router->generate('app_prispevek_index'));
        } elseif (count($roles) > 1) {
            // If multiple roles, redirect to default page
            return new RedirectResponse($this->router->generate('app_prispevek_index'));
        }

        // Define redirections based on roles
        if (in_array('ROLE_ADMIN', $roles)) 
        {
            return new RedirectResponse($this->router->generate('admin_dashboard'));
        } elseif (in_array('ROLE_AUTOR', $roles)) 
        {
            return new RedirectResponse($this->router->generate('app_autor'));
        } elseif (in_array('ROLE_RECENZENT', $roles)) 
        {
            return new RedirectResponse($this->router->generate('app_recenzent'));
        } elseif (in_array('ROLE_REDAKTOR', $roles)) 
        {
            return new RedirectResponse($this->router->generate('app_redaktor'));
        } elseif (in_array('ROLE_SEFREDAKTOR', $roles)) 
        {
            return new RedirectResponse($this->router->generate('app_sef_redaktor'));
        }

        // Default redirect if no roles match
        return new RedirectResponse($this->router->generate('app_prispevek_index'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
