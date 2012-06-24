<?php
/**
 * Bob: a static file builder
 *
 * @copyright   2012 Court Ewing - http://epixa.com
 * @license     Simple BSD
 */

namespace Bob\Template;

/**
 * A contract for the implementation of interpolation functionality
 *
 * An implementing class will define a method for inserting some provided data
 * into a definition-specific source content.
 */
interface Interpolative
{
    /**
     * Interpolates the array of data keys into template contents
     *
     * @param array $data An array of key/value pairs to parse into template
     * @return string The newly parsed template content
     */
    public function interpolate(array $data);
}
