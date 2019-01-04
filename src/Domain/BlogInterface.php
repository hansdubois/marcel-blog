<?php
declare(strict_types=1);

namespace Marcel\Domain;

interface BlogInterface
{
    public function getId(): int;

    public function getTitle(): string;

    public function getIntroductionText(): string;

    public function getContent(): string;
}
