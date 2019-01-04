<?php
declare(strict_types=1);

namespace Marcel\Infrastructure;

use InvalidArgumentException;
use Marcel\Application\Blog\BlogNotFoundException;
use Marcel\Application\BlogRepositoryInterface;
use Marcel\Domain\Blog;

class CsvBlogRepository implements BlogRepositoryInterface
{
    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function fetchAllBlogs(): array
    {
        $blogs = [];

        if (($handle = fopen(__DIR__ . '/../../etc/blogs.csv','rb')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $blog = new Blog((int)$data[0], (string)$data[1], (string)$data[2], (string)$data[3]);

                if (isset($data[4])) {
                    $blog = $blog->withImage((string)$data[4]);
                }

                $blogs[] = $blog;
            }
            fclose($handle);
        }

        return $blogs;
    }

    /**
     * @param int $articleId
     * @return Blog
     * @throws InvalidArgumentException
     * @throws BlogNotFoundException
     */
    public function fetchArticle(int $articleId): Blog
    {
        $blog = null;

        if (($handle = fopen(__DIR__ . '/../../etc/blogs.csv','rb')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if ((int)$data[0] === $articleId) {
                    $blog = new Blog($articleId, (string)$data[1], (string)$data[2], (string)$data[3]);
                }
            }
            fclose($handle);
        }

        if ($blog === null) {
            throw new BlogNotFoundException('Could not find blog with Id:' . $articleId);
        }

        return $blog;
    }
}
