CREATE DATABASE  IF NOT EXISTS `citypop_database` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `citypop_database`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: citypop_database
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_bin NOT NULL,
  `releaseYear` year(4) DEFAULT NULL,
  `imgURL` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `info` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`album_id`),
  KEY `FK_album_artist_idx` (`artist_id`),
  CONSTRAINT `FK_album_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,1,'Ride On Time',1980,'https://images-na.ssl-images-amazon.com/images/I/51iqtmHS7xL.jpg','Ride on Time is the fifth studio album by Japanese singer-songwriter Tatsuro Yamashita, released in September 1980.<p>Ride on Time is most known for its title track. It was used in the television commercial for Maxell audio cassette starring Yamashita, and released as a single in May 1980.<span style=\"background-color: transparent; color: var(--onSecondary);\">The song became his first charting single, peaking at number three on the Japanese Oricon chart with sales of 417,000 copies. In 2003, the song was featured on the television drama Good Luck!! starring Takuya Kimura, and entered the top 20 on the chart again.</span><p>The album was released after the title track became a hit, and gained commercial success subsequently. It topped the Japanese albums chart for a week in October 1980, selling more than 220,000 units while it was entering the chart.</p><p>After the album came out, the song \"My Sugar Babe\" (ode to the band he formerly fronted) was issued as a single. It was featured as a theme song for the television drama Keishi-K starring and directed by Shintaro Katsu and aired on NTV in Autumn 1980. Yamashita composed the entire background music used on the unsuccessful TV series.</p><p>At the time of reissue in 2002, an extract of them (instrumental version of \"My Sugar Babe\") was additionally included as one of the bonus tracks. </p></p>'),(2,2,'Variety',1984,'https://i.kym-cdn.com/photos/images/newsfeed/001/334/161/8b8.jpg','<p>Plastic Love</p><p>About</p><p>\"Plastic Love\" is a 1984 J-pop song performed by Japanese singer/songwriter Mariya Takeuchi (竹内 まりや). She and the song later became popular online when the song resurfaced on YouTube.</p><p>Origin</p><p>The song originated from her comeback album VARIETY (cover below, left), released April 25th, 1984.[1] It was one of her most successful albums in her career, reaching #1 on the 1984 Oricon music chart in Japan.[2] \"Plastic Love\" (cover below, right) was later released as a single on March 25th, 1985,[3] and was #85 on Oricon.[2]</p><p>Spread</p><p>The song was posted on YouTube by user Sona main, but the video was later taken down. User Plastic Lover reuploaded a seven minute version of the song on July 5th, 2017, featuring a picture of Takeuchi from her \"Sweetest Music / Morning Glory\" single cover.[4] The video has gained more than 5.33 million views as of January 2018.</p><p>The song has surged in popularity online. Before its initial removal, the video was posted on the /r/listentothis subreddit on June 21st, 2017 with 3937 upvotes (as of January 2018).[5] It\'s also a popular source for future funk, a subgenre of Vaporwave, remixes. On March 11th, 2016, music channel Artzie Music released a remix of the song by future funk artist Night Tempo, garnering over 2.4 million views. Another remix by TARA was uploaded by Funky Panda on September 8th, 2016, gaining 76,000 views.<br></p><p><a href=\"https://www.youtube.com/watch?v=PlPTXR7e6As\">YouTube - What is plastic love?</a><br></p>'),(3,1,'For You',1982,'https://img.discogs.com/khign8yW74msbBHt6WqxfPxnH6A=/fit-in/600x600/filters:strip_icc():format(jpeg):mode_rgb():quality(90)/discogs-images/R-10454329-1497773671-7539.jpeg.jpg','<p> Lorem ipsum dolor sit amet consectetur adipiscing elit dictumst ut, ad euismod nascetur eget tincidunt ornare phasellus orci dignissim nulla, parturient proin duis donec venenatis volutpat himenaeos commodo. Finibus dolor diam tempus curae bibendum sollicitudin laoreet posuere vehicula, efficitur et tortor metus donec dignissim ante. Pellentesque est conubia eget semper porta mollis senectus nascetur sapien sit, vitae lobortis praesent varius nunc fermentum elementum lacinia. Potenti sociosqu nostra platea fames interdum felis malesuada placerat pharetra dignissim, phasellus neque justo lobortis dis ex habitasse tristique bibendum fusce torquent, consectetur vulputate eget at amet porttitor nascetur sagittis facilisi. </p>'),(4,1,'Moonglow',1979,'https://1.bp.blogspot.com/-c1k6cELoEpQ/VbJoyIC0lsI/AAAAAAAACmw/Q5N17krjjMI/s640/E5B1B1E4B88BE98194E9838E_Moonglow.jpg','<p> Lorem ipsum dolor sit amet consectetur adipiscing elit nisl cubilia conubia, lectus nunc vel porta magna potenti pretium tristique gravida, ridiculus cursus erat est a fringilla arcu interdum integer. Facilisi adipiscing suspendisse interdum egestas platea inceptos fermentum fringilla, vulputate ad iaculis habitant auctor neque convallis. </p>'),(5,6,'Insatiable High',1977,NULL,NULL),(6,1,'Big Wave',1984,'https://vignette.wikia.nocookie.net/jpop/images/d/db/THE_THEME_FROM_BIG_WAVE_1.jpg/revision/latest?cb=20160707121116',NULL),(12,1,'Come Along 3',2017,'https://img.discogs.com/bpe9CaGdetlFVub-AH-Uz9E3lTg=/fit-in/600x597/filters:strip_icc():format(jpeg):mode_rgb():quality(90)/discogs-images/R-10683044-1502366141-6369.jpeg.jpg',NULL),(14,39,'Mangekyo',1975,'http://3.bp.blogspot.com/-ZybWdq-G8y8/TrhJUdTvxdI/AAAAAAAAA50/ofV8tg_4c3Q/s1600/portada.jpg',NULL),(15,38,'Breath',1987,'http://img15.shop-pro.jp/PA01239/479/product/105840395.jpg?cmsp_timestamp=20160808153451','<h3>Lorem ipsum</h3>Pellentesque mauris aenean enim tempus ac, nisi elit nisl taciti dignissim facilisis, donec iaculis duis quisque. Lacus placerat netus platea id quis mus habitant praesent cras et feugiat condimentum consequat donec, risus faucibus egestas penatibus mattis luctus vivamus natoque nam facilisi lobortis convallis aliquet pretium, dui tellus vestibulum class vulputate duis nisi mollis magna interdum inceptos nostra tempor.<br><br><h3>Lectus torquent tellus</h3>Semper sem neque nulla mus gravida praesent ut velit efficitur etiam, lacus nec ornare sagittis lacinia non interdum sociosqu. Egestas dictumst maecenas cubilia amet vitae facilisis tellus, auctor dis vulputate volutpat nostra hac blandit vestibulum, magna neque finibus donec faucibus pellentesque.<br><br><h3>Non massa imperdiet</h3>Malesuada ac hac turpis ornare efficitur aliquam felis proin lectus purus finibus curabitur conubia rutrum, hendrerit nunc semper tristique ligula tempus pharetra taciti non velit mauris varius.<br><br>');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-21 14:58:37
