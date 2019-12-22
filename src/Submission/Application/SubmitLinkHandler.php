<?php declare (strict_types = 1);
namespace SocialNews\Submission\Application;

use SocialNews\Submission\Domain\Submission;
use SocialNews\Submission\Domain\SubmissionRepository;

final class SubmitLinkHandler
{
    private $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function handle(SubmitLink $submitLink): void
    {
        $submission = Submission::submit(
            $submitLink->getUrl(),
            $submitLink->getTitle()
        );
        $this->submissionRepository->add($submission);
    }
}
