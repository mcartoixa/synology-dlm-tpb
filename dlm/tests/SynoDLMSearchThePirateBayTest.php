<?php
require 'FakePlugin.php';
use PHPUnit\Framework\TestCase;

final class SynoDLMSearchThePirateBayTest extends TestCase
{
    public function testCanParseValidResults()
    {
        $plugin = new FakePlugin;
        $search = new SynoDLMSearchThePirateBay;
        $search->parse($plugin, SynoDLMSearchThePirateBayTest::html);

        $this->assertEquals(3, count($plugin->results));

        $result = $plugin->results[0];
        $this->assertEquals('Football Manager 2016 [Test Game] - Update Version', $result->title);
        $this->assertEquals('magnet:?xt=urn:btih:4f22b019877ac74767dbb8e6c1ff3839fb44b28d&dn=Football+Manager+2016+%5BTest+Game%5D+-+Update+Version&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969', $result->download);
        $this->assertEquals(1717986918.0, $result->size);
        $this->assertEquals('2017-09-22 00:00:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchThePirateBay::PIRATEBAY_URL.'/torrent/18630646/Football_Manager_2016_[Test_Game]_-_Update_Version', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(813, $result->seeds);
        $this->assertEquals(545, $result->leechs);
        $this->assertEquals('Games', $result->category);

        $result = $plugin->results[1];
        $this->assertEquals('Self Scoring IQ Test measure your cognitive skills reasoning', $result->title);
        $this->assertEquals('magnet:?xt=urn:btih:73ace49e2ff7603fd5deb3a6234195bcfb1dd17b&dn=Self+Scoring+IQ+Test+measure+your+cognitive+skills+reasoning+&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969', $result->download);
        $this->assertEquals(2757754.0, $result->size);
        $this->assertEquals(date('Y').'-12-10 17:48:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchThePirateBay::PIRATEBAY_URL.'/torrent/19327965/Self_Scoring_IQ_Test_measure_your_cognitive_skills_reasoning_', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(98, $result->seeds);
        $this->assertEquals(3, $result->leechs);
        $this->assertEquals('Other', $result->category);

        $result = $plugin->results[2];
        $this->assertEquals('[BrazzersExxtra] Alix Lynx - Put Her To The Test (19.10.2017)', $result->title);
        $this->assertEquals('magnet:?xt=urn:btih:41e08cf8d28deb6d7a0dccfe10a04b9c974dc65e&dn=BrazzersExxtra+-+Alix+Lynx+-+Put+Her+To+The+Test&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969', $result->download);
        $this->assertEquals(294440140.0, $result->size);
        $this->assertEquals(date('Y-m-d').' 06:08:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchThePirateBay::PIRATEBAY_URL.'/torrent/18766834/[BrazzersExxtra]_Alix_Lynx_-_Put_Her_To_The_Test_(19.10.2017)', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(88, $result->seeds);
        $this->assertEquals(6, $result->leechs);
        $this->assertEquals('Porn', $result->category);
    }

    const html = '<!DOCTYPE html>
<html lang="en"><head></head><body>
<table id="searchResult">
    <tr>
        <td class="vertTh">
            <center>
                <a href="/browse/400" title="More from this category">Games</a><br />
                (<a href="/browse/401" title="More from this category">PC</a>)
            </center>
        </td>
        <td>
            <div class="detName">
                <a href="/torrent/18630646/Football_Manager_2016_[Test_Game]_-_Update_Version" class="detLink" title="Details for Football Manager 2016 [Test Game] - Update Version">Football Manager 2016 [Test Game] - Update Version</a>
            </div>
            <a href="magnet:?xt=urn:btih:4f22b019877ac74767dbb8e6c1ff3839fb44b28d&dn=Football+Manager+2016+%5BTest+Game%5D+-+Update+Version&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969" title="Download this torrent using magnet">
                <img src="//pirateproxy.ist/static/img/icon-magnet.gif" alt="Magnet link" />
            </a>
            <img src="//pirateproxy.ist/static/img/icon_comment.gif" alt="This torrent has 1 comments." title="This torrent has 1 comments." />
            <img src="//pirateproxy.ist/static/img/11x11p.png" />
            <font class="detDesc">Uploaded 09-22&nbsp;2017, Size 1.6&nbsp;GiB, ULed by <i>Anonymous</i></font>
        </td>
        <td align="right">813</td>
        <td align="right">545</td>
    </tr>
    <tr>
        <td class="vertTh">
            <center>
                <a href="/browse/600" title="Plus de cette catégorie">Other</a><br>
                (<a href="/browse/601" title="Plus de cette catégorie">E-books</a>)
            </center>
        </td>
        <td>
            <div class="detName">
                <a href="/torrent/19327965/Self_Scoring_IQ_Test_measure_your_cognitive_skills_reasoning_" class="detLink" title="Détails pour Self Scoring IQ Test measure your cognitive skills reasoning ">Self Scoring IQ Test measure your cognitive skills reasoning </a>
            </div>
            <a href="magnet:?xt=urn:btih:73ace49e2ff7603fd5deb3a6234195bcfb1dd17b&dn=Self+Scoring+IQ+Test+measure+your+cognitive+skills+reasoning+&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969" title="Download this torrent using magnet">
                <img src="//pirateproxy.ist/static/img/icon-magnet.gif" alt="Magnet link">
            </a>
            <a href="/user/sabiya">
                <img src="//pirateproxy.ist/static/img/trusted.png" alt="Trusted" title="Trusted" style="width:11px;" border="0">
            </a>
            <img src="//pirateproxy.ist/static/img/11x11p.png">
            <font class="detDesc">Uploaded 12-10&nbsp;17:48, Size 2.63&nbsp;MiB, Uploaded by <a class="detDesc" href="/user/sabiya/" title="Browse sabiya">sabiya</a></font>
        </td>
        <td align="right">98</td>
        <td align="right">3</td>
    </tr>
    <tr class="alt">
        <td class="vertTh">
            <center>
                <a href="/browse/500" title="Plus de cette catégorie">Porn</a><br>
                (<a href="/browse/506" title="Plus de cette catégorie">Vidéoclips</a>)
            </center>
        </td>
        <td>
            <div class="detName">
                <a href="/torrent/18766834/[BrazzersExxtra]_Alix_Lynx_-_Put_Her_To_The_Test_(19.10.2017)" class="detLink" title="Détails pour [BrazzersExxtra] Alix Lynx - Put Her To The Test (19.10.2017)">[BrazzersExxtra] Alix Lynx - Put Her To The Test (19.10.2017)</a>
            </div>
            <a href="magnet:?xt=urn:btih:41e08cf8d28deb6d7a0dccfe10a04b9c974dc65e&dn=BrazzersExxtra+-+Alix+Lynx+-+Put+Her+To+The+Test&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969" title="Download this torrent using magnet">
                <img src="//pirateproxy.ist/static/img/icon-magnet.gif" alt="Magnet link">
            </a>
            <a href="/user/KayWily">
                <img src="//pirateproxy.ist/static/img/vip.gif" alt="VIP" title="VIP" style="width:11px;" border="0">
            </a>
            <img src="//pirateproxy.ist/static/img/11x11p.png">
            <font class="detDesc">Uploaded Today&nbsp;06:08, Size 280.8&nbsp;MiB, Uploaded <a class="detDesc" href="/user/KayWily/" title="Browse KayWily">KayWily</a></font>
        </td>
        <td align="right">88</td>
        <td align="right">6</td>
    </tr>
</table>
</body></html>';
}
?>