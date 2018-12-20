<?php
define("DB_DSN", "localhost");
define("DB_USER", "user");
define("DB_PASS", "password");

class Blog
{
    /**
     *
     * @return void
     */
    public function listAllArticles()
    {
        $db = $this->getDatabase();
        $stmt = $db->query('SELECT * FROM article');
        $rows = $stmt->fetch(\PDO::FETCH_ASSOC);

        $u = [];

        foreach ($rows as $r) {
            $u[] = new self($r['title'], $r['introduction'], $r['content']);
        }

        return $u;
    }

    /**
     *
     * @param string $articleId
     * @return void
     */
    public function fetchArticle($articleId)
    {
        $db = $this->getDatabase();
        $stmt = $db->query('SELECT * FROM article WHERE id = ' . $articleId);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->introduction = $row['introduction'];
        $this->article = $row['content'];

        return $this;
    }

    /**
     *
     * @param string $newTitle
     * @param string $newIntroduction
     * @param string $articleId
     * @return void
     */
    public function updateArticle($newTitle, $newIntroduction, $articleId)
    {
        $db = $this->getDatabase();
        $affectedRows = $db->exec(
            "UPDATE article
            SET title = '{$newTitle}'
                introduction = '{$newIntroduction}'
            WHERE id = " . $articleId);

        if ($affectedRows >= 1) {
            return true;
        }

        return false;
    }

    /**
     * @return PDO
     */
    private function getDatabase()
    {
        return new \PDO(DB_DSN, DB_USER, DB_PASS);
    }
}
