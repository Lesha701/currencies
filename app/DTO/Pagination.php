<?php

namespace App\DTO;

class Pagination
{
    public const PAGE_PARAM = 'page';
    public const LIMIT_PARAM = 'per_page';

    public const DEFAULT_PAGE = 1;
    public const DEFAULT_LIMIT = 20;

    /**
     * @var int
     */
    private $page = self::DEFAULT_PAGE;

    /**
     * @var int
     */
    private $limit = self::DEFAULT_LIMIT;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page): self
    {
        if ($page > 0) {
            $this->page = $page;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return self
     */
    public function setLimit(int $limit): self
    {
        if ($limit > 0) {
            $this->limit = $limit;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getOffsetByPage(): int
    {
        return $this->limit * ($this->page - 1);
    }
}
