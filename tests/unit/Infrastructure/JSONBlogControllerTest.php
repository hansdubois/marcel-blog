<?php
declare(strict_types=1);

use Marcel\Application\Blog\BlogNotFoundException;
use Marcel\Application\BlogRepositoryInterface;
use Marcel\Domain\Blog;
use Marcel\Infrastructure\JSONBlogController;
use PHPUnit\Framework\TestCase;

final class JSONBlogControllerTest extends TestCase
{
    public function testReturnJsonBlog()
    {
        $blogRepository = $this->prophesize(BlogRepositoryInterface::class);

        $blogRepository->fetchArticle(2)->willReturn(new Blog(2, 'marcel', 'intro', 'content'));

        $controller = new JSONBlogController($blogRepository->reveal());
        $result = $controller->parseRequest(['blogid' => 2]);

        $this->assertEquals('{"id":2,"title":"marcel","content":"content","introduction":"intro"}', $result);
    }

    public function testShouldReturnNotFoundString()
    {
        $blogRepository = $this->prophesize(BlogRepositoryInterface::class);

        $blogRepository->fetchArticle(7)->willThrow(new BlogNotFoundException('Blog NOT found'));

        $controller = new JSONBlogController($blogRepository->reveal());
        $result = $controller->parseRequest(['blogid' => 7]);

        $this->assertEquals('Blog NOT found', $result);
    }
}
