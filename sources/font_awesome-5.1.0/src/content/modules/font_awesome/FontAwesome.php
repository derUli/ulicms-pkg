<?php

class FontAwesome extends Controller
{
    private $moduleName = "font_awesome";

    public function head()
    {
        echo Template::executeModuleTemplate($this->moduleName, "head.php");
    }

    public function admin_head()
    {
        $this->head();
    }
}
