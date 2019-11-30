<?php declare (strict_types = 1);

namespace SocialNews\FrontPage\Presentation;

use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\FrontPage\Application\SubmissionQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * class FrontPageController
 */
final class FrontPageController
{
    private $templateRenderer;
    private $submissionQuery;

    public function __construct(TemplateRenderer $templateRenderer, SubmissionQuery $submissionQuery)
    {
        $this->templateRenderer = $templateRenderer;
        $this->submissionQuery = $submissionQuery;
    }

    public function show(Request $request): Response
    {
        $submissions = [
            ['url' => 'http://google.com', 'title' => 'Google'],
            ['url' => 'http://bing.com', 'title' => 'Bing'],
        ];
        $content = $this->templateRenderer->render('FrontPage.html.twig', [
            'submissions' => $this->submissionQuery->execute(),
        ]);

        return new Response($content);
    }
}
