<?php
declare(strict_types=1);

namespace Marcel\Application;

use Marcel\Domain\Blog;

interface BlogRepositoryInterface
{
    public function fetchAllBlogs(): array;

    public function fetchArticle(int $articleId): Blog;
}
