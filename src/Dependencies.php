<?php declare (strict_types = 1);

use Auryn\Injector;
use Doctrine\DBAL\Connection;
use SocialNews\Framework\Csrf\SymfonySessionTokenStorage;
use SocialNews\Framework\Csrf\TokenStorage;
use SocialNews\Framework\Dbal\ConnectionFactory;
use SocialNews\Framework\Dbal\DatabaseUrl;
use SocialNews\Framework\Rendering\TemplateDirectory;
use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory;
use SocialNews\FrontPage\Application\SubmissionQuery;
use SocialNews\FrontPage\Infrastructure\DbalSubmissionsQuery;
use SocialNews\Submission\Domain\SubmissionRepository;
use SocialNews\Submission\Infrastructure\DbalSubmissionRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

$injector = new Injector();

$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector): TemplateRenderer {
        $factory = $injector->make(TwigTemplateRendererFactory::class);
        return $factory->create();
    }
);

$injector->define(TemplateDirectory::class, [':rootDirectory' => ROOT_DIR]);

$injector->alias(SubmissionQuery::class, DbalSubmissionsQuery::class);
$injector->alias(TokenStorage::class, SymfonySessionTokenStorage::class);
$injector->alias(SessionInterface::class, Session::class);
$injector->alias(SubmissionRepository::class, DbalSubmissionRepository::class);

$injector->share(SubmissionQuery::class);

$injector->define(
    DatabaseUrl::class,
    [':url' => 'sqlite:///' . ROOT_DIR . '/storage/db.sqlite3']
);

$injector->delegate(
    Connection::class,
    function () use ($injector) {
        $factory = $injector->make(ConnectionFactory::class);
        return $factory->create();
    }
);

$injector->share(Connection::class);

return $injector;
