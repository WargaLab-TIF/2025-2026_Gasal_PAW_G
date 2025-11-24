<?php

class FPDF
{
    protected $buffer = "";
    protected $pages = [];
    protected $currentPage = 0;
    protected $font = "Helvetica";
    protected $fontSize = 12;

    function __construct()
    {
        $this->AddPage();
    }

    function AddPage()
    {
        $this->currentPage++;
        $this->pages[$this->currentPage] = "";
    }

    function SetFont($family, $style="", $size=12)
    {
        $this->font = $family;
        $this->fontSize = $size;
    }

    function Cell($w, $h=0, $txt="", $border=0, $ln=0)
    {
        $this->pages[$this->currentPage] .= $txt . "\n";

        if ($ln > 0) {
            $this->pages[$this->currentPage] .= "\n";
        }
    }

    function Ln($h=null)
    {
        $this->pages[$this->currentPage] .= "\n";
    }

    function Output($dest="I", $name="document.pdf")
    {
        $content = "%PDF-1.1\n";
        $content .= "1 0 obj << /Type /Catalog /Pages 2 0 R >> endobj\n";
        $content .= "2 0 obj << /Type /Pages /Kids [3 0 R] /Count 1 >> endobj\n";

        // Convert text into PDF text stream
        $text = "";
        foreach ($this->pages as $p) {
            $lines = explode("\n", $p);
            foreach ($lines as $line) {
                $text .= "BT /F1 {$this->fontSize} Tf 50 750 Td (" . $this->escape($line) . ") Tj ET\n";
            }
        }

        $content .= "3 0 obj << /Type /Page /Parent 2 0 R /Contents 4 0 R >> endobj\n";
        $content .= "4 0 obj << /Length " . strlen($text) . " >> stream\n";
        $content .= $text . "endstream\nendobj\n";

        $content .= "5 0 obj << /Type /Font /Subtype /Type1 /Name /F1 /BaseFont /Helvetica >> endobj\n";

        $xrefPos = strlen($content);
        $content .= "xref\n0 6\n0000000000 65535 f \n";
        $offset = 9;
        foreach ([1,2,3,4,5] as $i) {
            $content .= sprintf("%010d 00000 n \n", $offset);
            $offset += 100;
        }

        $content .= "trailer << /Size 6 /Root 1 0 R >>\nstartxref\n".$xrefPos."\n%%EOF";

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"$name\"");

        echo $content;
        exit;
    }

    private function escape($s)
    {
        return str_replace(["\\", "(", ")"], ["\\\\", "\\(", "\\)"], $s);
    }
}
