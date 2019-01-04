<?php
declare(strict_types=1);

namespace Marcel\Infrastructure;

use Marcel\Application\Blog\BlogNotFoundException;
use Marcel\Application\BlogRepositoryInterface;

class JSONBlogController
{
    /**
     * @var CsvBlogRepository
     */
    private $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function parseRequest($parameters): string
    {
        try {
            $blog = $this->blogRepository->fetchArticle((int)$parameters['blogid']);

            return json_encode($blog->toArray());
        } catch (BlogNotFoundException $exception) {
            return 'Blog NOT found';
        }
    }
}
