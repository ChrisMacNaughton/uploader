<?php

/* upload.html.twig */
class __TwigTemplate_dc567a00056de8895fed5d052e5acd73 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        // line 3
        echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"POST\">
  <input type=\"hidden\" name=\"action\" value=\"upload\" />
  <div class=\"container-fluid\">
    <div class=\"row-fluid\">
      <div class=\"control-group span6 offset3";
        // line 7
        if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "password")) {
            echo " error";
        }
        echo "\">
        <label class=\"control-label\" for=\"password\">Password</label>
        <div class=\"controls\">
          <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\">";
        // line 10
        if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "password")) {
            echo "<span class=\"help-block\">Password is required</span>";
        } else {
            echo "<span class=\"help-block\">The password that will be used to encrypt your file.</span>";
        }
        // line 11
        echo "
        </div>
      </div>
    </div>
  </div>
  <div class=\"container-fluid\">
    <div class=\"row-fluid\">
      <div class=\"control-group span6 offset3\">
        <label class=\"control-label\" for=\"path\">Requested Path</label>
        <div class=\"controls\">
          <input type=\"text\" id=\"path\" name=\"path\" placeholder=\"Path\">
          <span class=\"help-block\">http://";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "path"), "html", null, true);
        echo "/[path]</span>
        </div>
      </div>
    </div>
  </div>
  <div class=\"container-fluid\">
    <div class=\"row-fluid\">
      <div class=\"control-group span6 offset3";
        // line 29
        if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "file")) {
            echo " error";
        }
        echo "\">
        <label class=\"control-label\" for=\"file\">File</label>
        <div class=\"controls\">
          <input type=\"file\" id=\"file\" name=\"file\">
          ";
        // line 33
        if ($this->getAttribute((isset($context["errors"]) ? $context["errors"] : null), "file")) {
            echo "<span class=\"help-block\">File is required</span>";
        } else {
            echo "<span class=\"help-inline\">Limit: 5GB</span>";
        }
        // line 34
        echo "        </div>
      </div>
    </div>
  </div>
  <div class=\"form-actions\">
    <button type=\"submit\" class=\"btn btn-primary\">Share</button>
  </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "upload.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 34,  83 => 33,  74 => 29,  64 => 22,  51 => 11,  45 => 10,  37 => 7,  31 => 3,  28 => 2,);
    }
}
