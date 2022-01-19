<?php

class View
{
    function generate($content_view, $template_view, $data = null, $data1 = null)
    {
        include 'application/views/'.$template_view;
    }
}