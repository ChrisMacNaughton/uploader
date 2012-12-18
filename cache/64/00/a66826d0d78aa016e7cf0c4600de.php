<?php

/* base.html.twig */
class __TwigTemplate_6400a66826d0d78aa016e7cf0c4600de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
  <head>
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/css/style.css'>
  </head>
  <body>
    <div class=\"jumbotron\">
      <div class=\"container\">
        <h1>";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "name"), "html", null, true);
        echo "</h1>
        <p>Encrypting your files with your password so you can share files privately!</p>
        <ul class=\"jumbotron-list\">
          <li>
            <a href=\"./\">Upload a File</a>
          </li>
          <li>
            Version ";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "version"), "html", null, true);
        echo "
          </li>
        </ul>
      </div>
    </div>
    <div class=\"container-fluid\">
      <div class=\"row-fluid\">
        ";
        // line 23
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 24
            echo "          <div class=\"alert alert-error\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            ";
            // line 26
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
            echo "
          </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 29
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["flash"]) ? $context["flash"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 30
            echo "          <div class=\"alert alert-success\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
            ";
            // line 32
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
            echo "
          </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 35
        echo "        <div class=\"span10\">
        ";
        // line 36
        $this->displayBlock('body', $context, $blocks);
        // line 39
        echo "        </div>
        <div class=\"span2\">
          <script type=\"text/javascript\"><!--
google_ad_client = \"ca-pub-5634458577543085\";
/* Small on Uploader. */
google_ad_slot = \"2332342944\";
google_ad_width = 160;
google_ad_height = 90;
//-->
</script>
<script type=\"text/javascript\"
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">
</script>
        </div>
      </div>
    </div>
    <footer class=\"row-fluid\">
      <p>&copy 2012 <a href=\"http://chrismacnaughton.com\">Chris Macnaughton</a></p>
    </footer>
    <script type=\"text/javascript\">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-35809231-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\"></script>
    <script type=\"text/javascript\">
    if (typeof jQuery == 'undefined') {
        document.write(unescape(\"%3Cscript src='assets/js/jquery-1.8.3.min.js' type='text/javascript'%3E%3C/script%3E\"));
    }
    </script>
    <script type=\"text/javascript\" src=\"assets/js/bootstrap.js\"></script>
    <script type=\"text/javascript\" src=\"assets/js/application.js\"></script>
  </body>
</html>";
    }

    // line 36
    public function block_body($context, array $blocks = array())
    {
        // line 37
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 37,  135 => 36,  90 => 39,  88 => 36,  85 => 35,  76 => 32,  72 => 30,  67 => 29,  58 => 26,  54 => 24,  50 => 23,  40 => 16,  30 => 9,  20 => 1,  89 => 34,  83 => 33,  74 => 29,  64 => 22,  51 => 11,  45 => 10,  37 => 7,  31 => 3,  28 => 2,);
    }
}
