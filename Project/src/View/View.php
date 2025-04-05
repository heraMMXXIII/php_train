<?php 

namespace src\View;

class View
{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = rtrim($templatesPath, '/\\');
        
        if (!is_dir($this->templatesPath)) {
            throw new \RuntimeException("Templates directory not found: {$this->templatesPath}");
        }
    }
    
    public function renderHtml(string $templateName, array $vars = [], int $code = 200)
    {
        http_response_code($code);
        extract($vars);
        
        // Нормализация пути
        $templateName = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $templateName);
        $templatePath = $this->templatesPath . DIRECTORY_SEPARATOR . $templateName . '.php';
        
        // Проверка существования файла
        if (!file_exists($templatePath)) {
            $checkedPath = realpath($templatePath) ?: $templatePath;
            throw new \RuntimeException(
                "Template not found. Tried:\n" . 
                "- {$checkedPath}\n" .
                "- Current templates dir: " . realpath($this->templatesPath) . "\n" .
                "- Files in dir: " . implode(', ', scandir($this->templatesPath))
            );
        }
        
        include $templatePath;
    }
}