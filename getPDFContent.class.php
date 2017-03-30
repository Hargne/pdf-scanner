<?php
    include 'vendor/autoload.php';

    class getPDFContent {
        protected $file;

        public function __construct($inputFile) {
            $this->file = $inputFile;
        }

        public function getTickets() {
            // Make sure that the file exists
            if(!file_exists($this->file)) { return; }

            $parser = new \Smalot\PdfParser\Parser();
            $pdf    = $parser->parseFile($this->file);
            $pages  = $pdf->getPages();
            $result	= array();

            foreach ($pages as $i=>$page) {
                $content = $page->getText();

                // Extract date
                preg_match("/\d{4}\-\d{2}\-\d{2}/", $content, $date);
                // Extract time
                preg_match("/\d{2}\:\d{2}/", $content, $time);
                // Extract Seat
                preg_match("/P:[0-9]+/", $content, $s);
                $seat = preg_replace('/[^0-9]+/', '', $s[0]);
                // Extract Row
                preg_match("/R:[0-9]+/", $content, $r);
                $row = preg_replace('/[^0-9]+/', '', $r[0]);

                array_push($result, array(
                    "date" => $date[0],
                    "time" => $time[0],
                    "row" => $row,
                    "seat" => $seat
                ));
            }
            return $result;
        }
    }
?>