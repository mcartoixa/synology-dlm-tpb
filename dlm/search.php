<?php
require "vendor/autoload.php";

define('TPB_USER_AGENT', 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko');

class SynoDLMSearchThePirateBay
{
    const PIRATEBAY_URL = 'https://opentpb.com';
    private $qurl = SynoDLMSearchThePirateBay::PIRATEBAY_URL.'/search/%s/0/7/0'; // Sort by descending SE

    public function __construct()
    {
        date_default_timezone_set('UTC');
    }

    public function prepare($curl, $query)
    {
        $url = sprintf($this->qurl, urlencode($query));
        curl_setopt_array($curl, array(
            CURLOPT_COOKIE => 'language=en_EN',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => TPB_USER_AGENT
        ));
    }

    public function parse($plugin, $response)
    {
        $ret = 0;

        $internalErrors = libxml_use_internal_errors(true);

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(mb_convert_encoding($response, 'HTML-ENTITIES', "UTF-8"));
        $xpath = new DOMXPath($dom);
        $resultNodes = $xpath->query('//table[@id="searchResult"]/tr');
        foreach ($resultNodes as $resultNode)
        {
            $titleNodes = $xpath->query('.//div[@class="detName"]/a', $resultNode);
            if (empty($titleNodes))
            {
                continue;
            }

            $title = trim($titleNodes[0]->nodeValue);
            if ($title!='')
            {
                $categoryNodes = $xpath->query('.//td[@class="vertTh"]//a', $resultNode);
                $downloadNodes = $xpath->query('.//td[div[@class="detName"]]/a', $resultNode);
                $fontNodes = $xpath->query('.//font', $resultNode);
                $lineNodes = $xpath->query('.//td', $resultNode);

                if (empty($downloadNodes))
                {
                    continue;
                }
                $download = $downloadNodes[0]->getAttribute('href');
                $size = 0.0;
                $datetime = '1970-01-01 00:00:00';
                if (preg_match_all('/Uploaded (.*), Size (.*)\xC2\xA0(.*),/siU', $fontNodes[0]->nodeValue, $matches, PREG_SET_ORDER))
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
                    if (!strpos(substr($date, -4), ':'))
                    {
                        $date = preg_replace('/\xC2\xA0/', '/', $date);
                    } else
                    {
                        $date = preg_replace('/\xC2\xA0/', '/'.date('Y', $now), $date);
                    }
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
                $page = htmlspecialchars_decode(SynoDLMSearchThePirateBay::PIRATEBAY_URL.$titleNodes[0]->getAttribute('href'));
                $hash = '';
                $seeds = intval($lineNodes[2]->nodeValue);
                $leechs = intval($lineNodes[3]->nodeValue);
                $category = trim($categoryNodes[0]->nodeValue);

                $plugin->addResult($title, $download, $size, $datetime, $page, $hash, $seeds, $leechs, $category);
                $ret++;
            }
        }

        libxml_use_internal_errors($internalErrors);

        return $ret;
    }
}
?>