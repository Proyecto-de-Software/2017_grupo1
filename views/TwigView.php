<?php
abstract class TwigView
{
  private static $twig;

  protected abstract function getTemplateFile();

  protected function render()
  {
    echo self::getTwig()->render($this->getTemplateFile());
  }

  public static function getTwig()
  {
    if (!isset(self::$twig)) {
      Twig_Autoloader::register();
      $loader = new Twig_Loader_Filesystem('./templates');
      self::$twig = new Twig_Environment($loader);
    }
    return self::$twig;
  }
}
