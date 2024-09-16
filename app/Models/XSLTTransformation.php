<?php
//Author: Chong Jian & Shi Lei
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use XSLTProcessor;

class XSLTTransformation extends Model
{
    use HasFactory;

    /**
     *
     * Transforms an XML file using an XSL file.
     *
     * @param string $xmlFilename Path to the XML file.
     * @param string $xslFilename Path to the XSL file.
     * @return string The transformed XML as a string.
     */
    public function transform($xmlFilename, $xslFilename)
    {
        $xml = new DOMDocument();
        $xml->load($xmlFilename);

        $xsl = new DOMDocument();
        $xsl->load($xslFilename);

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xsl);

        return $proc->transformToXml($xml);
    }
}
