<?php

class Common
{
    public function h($s)
    {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }
}
