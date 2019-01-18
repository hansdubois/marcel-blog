<?php
declare(strict_types=1);

namespace Marcel\Application;

use InvalidArgumentException;
use Marcel\Domain\Blog;
use Marcel\Infrastructure\PdoConnectionFactory;
use PDO;
use PDOException;

class RetrieveBlogData implements BlogRepositoryInterface
{
    /** @var PdoConnectionFactory */
    private $connectionFactory;

    public function __construct(PdoConnectionFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function fetchAllBlogs(): array
    {
        try {
            $blogArticles = [];

            $dataBaseConnection = $this->connectionFactory->createDatabaseConnection();
            $statement = $dataBaseConnection->query('
              SELECT 
                * 
              FROM 
                blogs
            ');

            while ($row = $statement->fetch()) {
                $blogArticles[] = new Blog(
                    (int)$row['id'],
                    (string)$row['title'],
                    (string)$row['introduction'],
                    (string)$row['content']);
            }

        } catch (PDOException $error) {
            $error->getMessage();
        }

        return $blogArticles;
    }

    /**
     * @param int $articleId
     * @return Blog
     * @throws InvalidArgumentException
     */
    public function fetchArticle(int $articleId): Blog
    {
        try {
            $blogArticle = null;

            $dataBaseConnection = $this->connectionFactory->createDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              SELECT 
                * 
              FROM 
                blogs 
              WHERE 
                id = :articleId
            ');

            $statement->bindParam(':articleId', $articleId);
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $blogArticle = new Blog(
                (int)$row['id'],
                (string)$row['title'],
                (string)$row['introduction'],
                (string)$row['content']);
        } catch (PDOException $error) {
            $error->getMessage();
        }

        return $blogArticle;
    }
}
