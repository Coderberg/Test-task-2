<?php

namespace app\lib;

final class Paginator
{
    private $amount;
    private $current_page;
    private $limit;
    private $max = 3;
    private $queryString;
    private $route;
    private $total;

    public function __construct($route, $total, $limit = 3)
    {
        $this->route = $route;
        $this->queryString = !empty($this->route['queryString']) ? '?'.$this->route['queryString'] : '';
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }

    public function get()
    {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; ++$page) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if ($links !== null) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, 'First').$links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Last');
            }
        }
        $html .= $links.' </ul></nav>';

        return $html;
    }

    private function generateHtml($page, $text = null): string
    {
        if (!$text) {
            $text = $page;
        }
        $url = '/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.$this->queryString;

        return '<li class="page-item"><a class="page-link" href="'.$url.'">'.$text.'</a></li>';
    }

    private function limits(): array
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return [$start, $end];
    }

    private function setCurrentPage(): void
    {
        if (isset($this->route['page'])) {
            $currentPage = $this->route['page'];
        } else {
            $currentPage = 1;
        }
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    private function amount(): int
    {
        return ceil($this->total / $this->limit);
    }
}
