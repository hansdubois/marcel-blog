<?php
declare(strict_types=1);

namespace Marcel\Infrastructure;

use PDO;

class PdoConnectionFactory
{
    /** @string */
    private $dsn;

    /** @string */
    private $username;

    /** @string */
    private $password;

    public function __construct(string $dsn, string $username, string $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    public function createDatabaseConnection()
    {
        return new PDO($this->dsn, $this->username, $this->password);
    }
}
