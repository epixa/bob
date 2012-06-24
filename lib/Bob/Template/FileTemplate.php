<?php
/**
 * Bob: a static file builder
 *
 * @copyright   2012 Court Ewing - http://epixa.com
 * @license     Simple BSD
 */

namespace Bob\Template;

/**
 * Defines behavior for loading template contents from a file
 */
trait FileTemplate
{
    /**
     * @var string
     */
    protected $path;


    /**
     * Sets the path to the template file
     *
     * @param string $path
     * @throws \InvalidArgumentException If the template path is not readable
     */
    public function setTemplatePath($path)
    {
        if (!is_readable($path)) {
            throw new \InvalidArgumentException('Template path is not readable: ' . $path);
        }
        $this->path = $path;
    }

    /**
     * Gets the contents of the template file
     *
     * The template file is located at $this->path.
     *
     * @return string
     * @throws \RuntimeException If the template file fails to load
     */
    public function getTemplateContents()
    {
        $contents = file_get_contents($this->path);
        if ($contents === false) {
            throw new \RuntimeException('Failed to load template contents from ' . $this->path);
        }
        return $contents;
    }
}
