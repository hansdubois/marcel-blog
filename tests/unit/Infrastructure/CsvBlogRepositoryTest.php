<?php
declare(strict_types=1);

use Marcel\Application\Blog\BlogNotFoundException;
use Marcel\Domain\Blog;
use Marcel\Infrastructure\CsvBlogRepository;
use PHPUnit\Framework\TestCase;

final class CsvBlogRepositoryTest extends TestCase
{
    public function testReturnBlog()
    {
        $repository = new CsvBlogRepository(__DIR__ . '/../../fixtures/blogs.csv');

        $blog = $repository->fetchArticle(1);

        $this->assertInstanceOf(Blog::class, $blog);
        $this->assertEquals('title test 1', $blog->getTitle());
    }

    public function testThrowExceptionWhenBlogIsNotFound()
    {
        $this->expectException(BlogNotFoundException::class);
        $repository = new CsvBlogRepository(__DIR__ . '/../../fixtures/blogs.csv');

        $repository->fetchArticle(10);
    }
}
