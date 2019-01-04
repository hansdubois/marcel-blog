<?php
declare(strict_types=1);

namespace Marcel\Application;

use Marcel\Database\DatabaseConnection;
use Marcel\Domain\Blog;
use PDO;
use PDOException;

class RetrieveBlogData
{
    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function fetchAllBlogs(): array
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->query('
              SELECT 
                * 
              FROM 
                article
            ');

            $rows = $statement->fetch();

            $blogArticles = [];

            foreach ($rows as $row) {
                $blogArticles[] = new Blog(
                    (int)$row['id'],
                    (string)$row['title'],
                    (string)$row['introduction'],
                    (string)$row['content']);

                if (isset($row['image'])) {
                    $blogArticles['image'];
                }
            }
        } catch (PDOException $error) {
            $error->getMessage();
        }

        return $blogArticles;
    }

    /**
     * @param int $articleId
     * @return Blog
     * @throws \InvalidArgumentException
     */
    public function fetchArticle(int $articleId)
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              SELECT 
                * 
              FROM 
                article 
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

            if (isset($row['image'])) {
                $blogArticle['image'];
            }
        } catch (PDOException $error) {
            $error->getMessage();
        }

        return $blogArticle;
    }

    /**
     * @param int    $articleId
     * @param string $title
     * @param string $introduction
     * @param string $content
     */
    public function addArticle(int $articleId, string $title, string $introduction, string $content)
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              INSERT INTO 
                article (id, title, introduction, content) 
              VALUES 
                (:article_id, :title, :introduction, :content)
            ');

            $statement->execute([
                'article_id' => $articleId,
                'title' => $title,
                'introduction' => $introduction,
                'content' => $content
            ]);
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }

    /**
     * @param string $newTitle
     * @param int    $articleId
     */
    public function updateArticleTitle(string $newTitle, int $articleId)
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              UPDATE 
                article 
              SET 
                title = :new_title 
              WHERE 
                id = :article_id
            ');

            $statement->execute([
                'new_title' => $newTitle,
                'article_id' => $articleId
            ]);
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }

    /**
     * @param string $newIntroduction
     * @param int    $articleId
     */
    public function updateArticleIntroduction(string $newIntroduction, int $articleId)
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              UPDATE 
                article 
              SET 
                introduction = :new_introduction 
              WHERE 
                id = :article_id
            ');

            $statement->execute([
                'new_introduction' => $newIntroduction,
                'article_id' => $articleId
            ]);
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }

    /**
     * @param string $newContent
     * @param int    $articleId
     */
    public function updateArticleContent(string $newContent, int $articleId)
    {
        try{
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              UPDATE
                article
              SET
                content = :new_content
              WHERE
                id = :article_id
            ');

            $statement->execute([
                'new_content' => $newContent,
                'article_id' => $articleId
            ]);
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }

    /**
     * @param int $articleId
     */
    public function deleteArticle(int $articleId)
    {
        try {
            $dataBaseConnection = $this->getDatabaseConnection();
            $statement = $dataBaseConnection->prepare('
              DELETE FROM 
                article 
              WHERE 
                id = :article_id
            ');

            $statement->bindParam('article_id', $articleId);
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }

    /**
     * @return DatabaseConnection
     */
    private function getDatabaseConnection()
    {
        return new DatabaseConnection(DB_DSN, DB_USER, DB_PASS);
    }
}
