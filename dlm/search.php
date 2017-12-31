<?php
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

class SynoDLMSearchThePirateBay
{
    const PIRATEBAY_URL = 'https://pirateproxy.ist';
    private $qurl = SynoDLMSearchThePirateBay::PIRATEBAY_URL.'/search/%s/0/7/0'; // Sort by descending SE

    public function __construct()
    {
        date_default_timezone_set('UTC');
    }

    public function prepare($curl, $query)
    {
        curl_setopt_array($curl, array(
            CURLOPT_COOKIE => 'language=en_EN',
            CURLOPT_URL => sprintf($this->qurl, urlencode($query))
        ));
    }

    public function parse($plugin, $response)
    {
        $dom = new Dom;
        $dom->loadStr($response, []);
        $results = $dom->find('#searchResult tr');
        foreach ($results as $result)
        {
            $dom->loadStr($result->outerHtml, []);
            $links = $dom->find('a');

            $title = trim($links[4]->text);
            if ($title!='')
            {
                $fonts = $dom->find('font');
                $lines = $dom->find('td');

                $download = $links[2]->getAttribute('href');
                $size = 0.0;
                $datetime = '1970-01-01 00:00:00';
                if (preg_match_all('/Uploaded (.*), Size (.*)&nbsp;(.*),/siU', $fonts[0]->text, $matches, PREG_SET_ORDER))
                {
                    $date = $matches[0][1];
                    $now = time();
                    switch (substr($date, 0, 5))
                    {
                        case 'Today':
                            $date = str_replace('Today', date('m/d'), $date);
                            break;
                        case 'Y-day':
                            $now = $now - 60 * 60 * 24;
                            $date = str_replace('Y-day', date('m/d', $now), $date);
                            break;
                        default:
                            $date = str_replace('-', '/', $date);
                            break;
                    }
                    $date = str_replace('&nbsp;', '/'.date("Y", $now), $date);
                    $datetime = date('Y-m-d H:i:s', strtotime($date));

                    $size = floatval(str_replace(',', '.', $matches[0][2]));
                    switch ($matches[0][3])
                    {
                        case 'KiB':
                            $size = $size * 1024;
                            break;
                        case 'MiB':
                            $size = $size * 1024 * 1024;
                            break;
                        case 'GiB':
                            $size = $size * 1024 * 1024 * 1024;
                            break;
                    }
                    $size = floor($size);
                }
                $page = SynoDLMSearchThePirateBay::PIRATEBAY_URL.$links[4]->getAttribute('href');
                $hash = '';
                $seeds = intval($lines[2]->text);
                $leechs = intval($lines[3]->text);
                $category = trim($links[0]->text);

                $plugin->addResult($title, $download, $size, $datetime, $page, $hash, $seeds, $leechs, $category);
            }
        }
    }
}
?>