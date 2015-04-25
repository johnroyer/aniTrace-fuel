<?php

abstract class apijson extends Controller_Rest
{
    // always use JSON as output format
    protected $format = 'json';

    // rewrite routing rule here
    public function router($resouce, $arguments)
    {
        parent::router($resouce, $arguments);
    }
}
