<?php
	require_once('./rss-helper.php');
	//header("Content-Type: 'text/xml'; charset='utf-8';"); 

	$RSSFeed = new RSSFeed("瞎扯 - 如何正确的吐槽", "https://daily.zhihu.com/", "知乎日报", "随便扯扯，也能很有深度");
	
	$json = @file_get_contents('https://news-at.zhihu.com/api/3/section/2');
	$feedItemMaxCnt = 2;
	
	$feedjson = json_decode($json, true);
	
	$feedItemCnt = 1;
	foreach($feedjson["stories"] as $row) {
		if ($feedItemCnt > $feedItemMaxCnt) break;
		$json = @file_get_contents('https://news-at.zhihu.com/api/4/news/' . $row["id"]);
		$item_json = json_decode($json, true);
		$RSSFeed->addArticle($item_json["title"], $item_json["share_url"], htmlspecialchars($item_json["body"]));
		$feedItemCnt++;
	}
	
	$xml = $RSSFeed->generateFeed();
	echo $xml;
?>