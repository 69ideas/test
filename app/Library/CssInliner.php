<?php
/**
 * Created by PhpStorm.
 * User: spyric
 * Date: 07.02.16
 * Time: 23:31
 */

namespace App\Library;


use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class CssInliner
{
    /**
     * Filename of the view to render
     * @var string
     */
    private $view;
    /**
     * Data - passed to view
     * @var array
     */
    private $data;

    /**
     * @param string $view Filename/path of view to render
     * @param array $data Data of email
     */
    public function __construct($view, array $data)
    {
        // Render the email view
        $emailView = view($view, $data)->render();
        $this->view = $emailView;
        $this->data = $data;
    }

    /**
     * Convert to inlined CSS
     *
     * @return string
     * @throws \TijsVerkoyen\CssToInlineStyles\Exception
     */
    public function convert()
    {
        $converter = new CssToInlineStyles();
        $converter->setUseInlineStylesBlock();
        $converter->setCleanup();
        $converter->setStripOriginalStyleTags();
        $converter->setHTML($this->view);
        $content =  $converter->convert();

        return $content;
    }

    public static function parse($view, array $data)
    {
        $inlineEmail = new static($view, $data);
        return ['content'=>$inlineEmail->convert()];
    }
}