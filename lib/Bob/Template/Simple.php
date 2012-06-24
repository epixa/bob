<?php
/**
 * Bob: a static file builder
 *
 * @copyright   2012 Court Ewing - http://epixa.com
 * @license     Simple BSD
 */

namespace Bob\Template;

/**
 * A simple template parser
 *
 * Simple templates are retrieved from the file system and data is injected
 * into the templates as simple key/value replacements.  Placeholders are
 * defined in the template file with the mustache/handlebar-esque form.
 *
 * An example replacement:
 *  template: 'Hello, {{ name }}'
 *  data:     ['name' => 'Sally']
 *  result:   'Hello, Sally'
 */
class Simple implements Interpolative
{
    /**
     * FileTemplate: allows us to retrieve template contents from a file
     */
    use FileTemplate;


    /**
     * Sets the template path
     *
     * @param string $path The path to the template file
     */
    public function __construct($path)
    {
        $this->setTemplatePath($path);
    }

    /**
     * Interpolates the array of data keys into template contents
     *
     * @param array $data An array of key/value pairs to parse into template
     * @return string The newly parsed template content
     */
    public function interpolate(array $data)
    {
        $content = $this->getTemplateContents();
        foreach ($data as $key => $value) {
            $content = $this->parse($content, $key, $value);
        }
        return $content;
    }

    /**
     * Replaces the template key with the value in the content
     *
     * This searches $content for all placeholders in the form {{ $key }} and
     * replaces them with $value.
     *
     * $key must be a string and can only contain letters, numbers,
     * underscores, or dashes.
     *
     * @param string $content
     * @param string $key
     * @param string $value
     * @return string
     * @throws \RuntimeException If the regular expression parsing fails
     * @throws \InvalidArgumentException If any of the given arguments are not valid
     */
    public function parse($content, $key, $value)
    {
        if (!preg_match('/^[a-z0-9_-]+$/i', $key)) {
            throw new \InvalidArgumentException("\$key must be a string of letters, numbers, underscores, or dashes: " . $key);
        }
        $result = preg_replace('/\{\{\s*' . $key . '\s*\}\}/i', $value, $content);
        if ($result === null) {
            throw new \RuntimeException("Failed to parse the value of '$key' into template");
        }
        return $result;
    }
}
