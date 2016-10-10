<?php
	require_once('./rss-helper.php');
	//header("Content-Type: 'text/xml'; charset='utf-8';"); 

	$RSSFeed = new RSSFeed("打鸡血", "https://moment.douban.com/", "豆瓣一刻", "每日段子，提神醒脑");
	
	$json = @file_get_contents('https://moment.douban.com/api/column/26/posts');
	$feedItemMaxCnt = 2;
	
	$feedjson = json_decode($json, true);
	
	$feedItemCnt = 1;
	foreach($feedjson["posts"] as $row) {
		if ($feedItemCnt > $feedItemMaxCnt) break;
		$hey_title = $row["title"];
		$json = @file_get_contents('https://moment.douban.com/api/post/' . $row["id"]);
		$item_json = json_decode($json, true);
		$RSSFeed->addArticle($hey_title, $item_json["short_url"], htmlspecialchars($item_json["content"]));
		$feedItemCnt++;
	}
	
	$xml = $RSSFeed->generateFeed();
	echo $xml;
?>