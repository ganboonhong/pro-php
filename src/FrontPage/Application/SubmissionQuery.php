<?php declare (strict_type = 1);
namespace SocialNews\FrontPage\Application;

/**
 * SubmissionQuery interface
 */
interface SubmissionQuery
{
    public function execute(): array;
}
