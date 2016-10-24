<?php

namespace Application;


class View
{
    use TMagic;

    public $errors = [];

    public function render($template)
    {
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }
        $errors = $this->errors;
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

}