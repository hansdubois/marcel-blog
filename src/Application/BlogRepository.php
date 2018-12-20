<?php
declare(strict_types=1);

namespace Marcel\Application;

use Marcel\Domain\Blog;

class BlogRepository
{
    /**
     * @return Blog[]
     */
    public function fetchAllBlogs():array
    {
        $blogs = [];

        if (($handle = fopen(__DIR__ . '/../../etc/blogs.csv','rb')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
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
}
