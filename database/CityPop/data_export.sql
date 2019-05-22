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

--
-- Table structure for table `album_genre`
--

DROP TABLE IF EXISTS `album_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album_genre` (
  `album_id` int(11) NOT NULL,
  `genre` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`album_id`,`genre`),
  KEY `FK_genre_album_genre_idx` (`genre`),
  CONSTRAINT `FK_album_album_genre` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_genre_album_genre` FOREIGN KEY (`genre`) REFERENCES `genre` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_genre`
--

LOCK TABLES `album_genre` WRITE;
/*!40000 ALTER TABLE `album_genre` DISABLE KEYS */;
INSERT INTO `album_genre` VALUES (1,'city pop'),(3,'city pop'),(4,'city pop'),(6,'city pop'),(12,'city pop'),(14,'country'),(4,'disco'),(14,'folk'),(1,'funk'),(3,'funk'),(5,'funk'),(6,'funk'),(12,'funk'),(15,'funk'),(5,'fusion'),(15,'fusion'),(4,'jazz'),(5,'jazz'),(6,'jazz'),(12,'jazz'),(15,'pop'),(14,'rock'),(15,'rock'),(12,'soul'),(14,'world');
/*!40000 ALTER TABLE `album_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) COLLATE utf8_bin NOT NULL,
  `lastName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `birthYear` year(4) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `imgURL` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `bio` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`artist_id`),
  KEY `FK_artist_city_idx` (`city_id`),
  CONSTRAINT `FK_artist_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
INSERT INTO `artist` VALUES (1,'Tatsuro','Yamashita',1953,NULL,'https://aramajapan.com/wp-content/uploads/2017/07/aramajapan.com-tatsuroreborn-promo.jpg','<p><span style=\"background-color: transparent; color: var(--onSecondary); font-family: Nunito, Arial, sans-serif;\">Tatsuro Yamashita, known by many as the \"King of City Pop\", was a defining actor on the City Pop arena. In fact, it was the release of his 1980\'s album, Ride On Time, which propelled the City Pop genre into popularity in Japan. He was a pioneer when it came to defining the sound and rhythm of City Pop, and his legacy remains one of Japan\'s most famous.</span><br></p><p><span style=\"background-color: transparent; color: var(--onSecondary);\">Yamashita approaches his music with the conviction and repetition of skill similar to a craftsman or tradesman. The title of his 1991 album Artisan is testament to the fact that he himself also understands this. His creations are never groundbreaking in their approach; he stays within the boundaries of what is real and popular. His middle of the road comfort would – if attempted by anybody other than himself – likely be bland. But somehow, for him, this comfort is the source of the beauty of his music.</span></p><p><span style=\"background-color: transparent; color: var(--onSecondary);\">His foundations in funk, soul and disco, are fused with a relaxed yet incredibly strong and soaring voice, one whose melody creates a color and movement, affecting the listener in a powerful way. </span></p>'),(2,'Mariya','Takeuchi',1955,NULL,'https://cdn.japantimes.2xx.jp/wp-content/uploads/2018/11/p10-stmichel-takeuchi-e-20181118.jpg','The young Mariya Takeuchi was one of the era\'s first defining pop idols. Scoring a number-one album in 1980, she lowered her profile over the next few years, marrying the singer-songwriter Tatsuro Yamashita (a City Pop icon in his own right) and collaborating with him on an album called Variety, with which she re-emerged in 1984, retaking the top spots on the Japanese charts. <p> <a href=\'https://youtu.be/3bNITQR4Uso\'>\"Plastic Love\" </a> comes as its second track, laying down a \"shimmering hypnotic groove, striking you with its beat and never letting go.\" Not only \"a meditation on heartbreak, it really speaks to the hollow, plastic feeling of what people do to fill in the sorrows of their life and loneliness,\" acts such as \"buying commercial goods in the hopes that they will make us feel more and avoid dealing with our own personal anguish.\" </p>'),(4,'Meiko','Nakahara',1959,NULL,'http://img15.shop-pro.jp/PA01239/479/product/97732495_th.jpg?cmsp_timestamp=20160116145413','<p> Meiko Nakahara (中原めいこ Nakahara Meiko) (born May 8, 1959 in Chiba Prefecture) is a Japanese singer.[1] She debuted in 1982 with the single \'+String.fromCharCode(34)+\'Kon\'ya dake Dance Dance Dance\'+String.fromCharCode(34)+\' (今夜だけDANCE DANCE DANCE?) and the album Coconuts House (ココナッツ・ハウス?).[1] Her 1984 single Kimitachi Kiwi Papaya Mango dane was the 50th best-selling single of the year in Japan, with 237,000 copies sold.[2] She is famously known for providing the opening and ending themes to the Dirty Pair anime series, \'+String.fromCharCode(34)+\'Ro Ro Ro Russian Roulette\'+String.fromCharCode(34)+\' (ロ・ロ・ロ・ロシアンルーレット?) and \'+String.fromCharCode(34)+\'Space Fantasy\'+String.fromCharCode(34)+\', the former of which won the award for Best Song at the 8th Anime Grand Prix in 1986. </p>'),(5,'Haruomi','Hosono',1947,NULL,'https://cdn.static-economist.com/sites/default/files/20171209_BKP507.jpg',NULL),(6,'Masayoshi','Takanaka',1953,NULL,'https://i.ytimg.com/vi/ScYAPiwVYJ8/maxresdefault.jpg',NULL),(7,'Toshiki','Kadomatsu',1960,NULL,'https://static1.squarespace.com/static/53960985e4b0643446ae4add/t/59a04355197aea6c3316b6e6/1503675240075/16107146_10154860664328764_4321827362612198585_o.jpg',NULL),(8,'Hiromi','Iwasaki',1958,NULL,'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1c3b9c09-2269-423a-8d13-fc0832b01182/dbochea-ed76fd5c-4f7f-4746-85ce-0bc160a51288.jpg/v1/fill/w_1192,h_670,q_70,strp/hiromi_iwasaki_wallpaper_by_mactavishsas_dbochea-pre.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NzY4IiwicGF0aCI6IlwvZlwvMWMzYjljMDktMjI2OS00MjNhLThkMTMtZmMwODMyYjAxMTgyXC9kYm9jaGVhLWVkNzZmZDVjLTRmN2YtNDc0Ni04NWNlLTBiYzE2MGE1MTI4OC5qcGciLCJ3aWR0aCI6Ijw9MTM2NiJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.ZgDBlDC_3qhrqb98Q_Dc5CIbji_THG2N9SV510Pw2Hg','<h3>Lorem</h3>Mollis pulvinar quis quam magna sem ipsum, interdum ullamcorper nisl diam aliquam, ultricies dictum facilisis cursus potenti. Mollis sociosqu aenean lobortis nec proin quam vehicula himenaeos semper, pharetra eget accumsan rutrum turpis pulvinar cursus egestas ullamcorper libero, congue condimentum blandit mi aliquet dignissim volutpat felis.<br><br><h3>Malesuada neque turpis sed primis</h3>Commodo mus egestas hendrerit varius himenaeos facilisis aliquam, malesuada vulputate ante turpis curabitur mi sagittis, lacinia maximus eros in mattis venenatis. Vel torquent finibus consequat eros pellentesque fermentum ex molestie posuere egestas, orci justo varius platea mauris arcu diam per viverra, lorem porttitor sodales ullamcorper sociosqu lectus nec nibh adipiscing.<br><br><h3>Per</h3>Euismod montes inceptos praesent pretium, in ad mattis ut torquent, pellentesque metus et. Vehicula sapien justo donec senectus ex interdum, montes tempus maximus cubilia vulputate est diam, dis ut risus mauris ridiculus. Risus dui tempor augue et maecenas vehicula lacus ultricies, ut laoreet morbi dis posuere litora tortor, mollis arcu feugiat pellentesque ligula diam porttitor.<br><br>'),(9,'Yoshimi','Iwasaki',1961,NULL,'https://i.scdn.co/image/255fed778fd65d6885a5e5c5f111818b145b3367',NULL),(10,'ANRI','(杏里)',1961,NULL,'https://lastfm-img2.akamaized.net/i/u/8d741672d40a897be9619a668d6b63cd.png','<p> Anri (杏里), real name Eiko Kawashima (川嶋栄子 Kawashima Eiko) (born August 31, 1961), is a Japanese pop singer-songwriter, born in Yamato, Kanagawa Prefecture, Japan.</p><p>She has written much of her own music as well as singing songs written by others such as her debut release Oribia o Kikinagara, by Amii Ozaki. Her song \"Cat\'s Eye\" was used as the first opening theme for the eponymous 1983 anime series Cat\'s Eye[1] and debuted as #1 on Countdown Japan. It was one of the first J-pop songs used as an anime theme song, and it was included in a recent Dance Dance Revolution game. Her popularly increased following her appearance at the Red and White New Year\'s Music Special at the end of that same year. </p><p>With the renewed popularity of 80\'s J-Pop on the Internet, her songs have been sampled by many new Internet artists inside the Vaporwave scene (mainly artists belonging to the Future Funk subgenre), granting Anri a whole new popularity outside Japan.<br></p>'),(11,'Julian','Kragset',1950,NULL,'http://nedrebuskerud.no/wp/wp-content/uploads/2017/10/%C3%A6reskniv-653x367.jpg','<p> Født med speiderskjerf rundt halsen</p>'),(13,'Ryo','Fukui',1948,NULL,'https://gfx67.decks.de/decks/gfx/co_raw/front/end_k/ccb-zk.jpg','Ryo Fukui (福居良) was a Japanese jazz pianist based in Sapporo. He played regularly at the \"Slowboat\" jazz club in Sapporo of which he and his wife Yasuko were the owners. Fukui taught and performed internationally until his death in 2016. His work has seen a spike in popularity during recent years due to its availability for streaming on Youtube as well as the rise of the lo-fi music genre. \r\n\r\nFukui began his life in music by learning accordion at age 18. At the age of 22 he began to teach himself piano and soon moved to Tokyo. Fukui met occasionally with saxophonist Matsumoto Hidehiko who offered valuable encouragement and guidance to the aspiring pianist. Nonetheless, Fukui was often disheartened, feeling as though he was not making significant improvement in his playing.\r\n\r\nSix years after moving to Tokyo, in 1976, Fukui released his first album, Scenery, and his second album, Mellow Dream, the year after. He continued improving his skills over the following years in live performance, often appearing in a trio including Satoshi Denpo, Yoshinori Fukui (Ryo\'s brother), and himself. The trio would often play at the Shinjuku Pit Inn, Kichijōji \"Sometime\" jazz club and the \"Jazz Inn Lovely\" in Nagoya. Fukui also began to perform overseas in France and America as well as beginning to teach jazz piano to students internationally.\r\n'),(19,'Ola','Nordmann',NULL,NULL,'https://smp.vgc.no/v2/images/58a2d20e-e3f0-4b8e-8be1-a91198704d09?fit=crop&h=1383&w=1900&s=ca1a7a85735430072059877d2060c40a6385047e','<p> Født med ski på beina. </p>'),(24,'Senri','Oe',1960,NULL,'http://www.bluenote.co.jp/jp/reports/03_SOT_0196.JPG','Oe Senri is a Japanese singer-songwriter, composer, musician, and jazz pianist. He began learning classical piano at the age of 3, and found his love for pop at the age of 10, when he heard Gilbert O\'Sullivan\'s \"Alone Again\" on the radio, and promptly got himself a copy.'),(26,'Akina','Nakamori',1965,NULL,'https://i.pinimg.com/originals/e2/bd/94/e2bd94960f3f9661fd6621ac7419b196.jpg','<p> Akina Nakamori (中森明菜 Nakamori Akina, born July 13, 1965) is a Japanese singer and actress. She is one of the most popular and top selling artists in Japan.[1] Akina achieved national recognition when she won the 1981 season of the talent show Star Tanjō!.</p><p>Her debut single \'+String.fromCharCode(34)+\'Slow Motion\'+String.fromCharCode(34)+\' was released to moderate success, peaking at number thirty on the Oricon Weekly Singles Chart. Akina\'s popularity was pushed up by the follow-up single, \'+String.fromCharCode(34)+\'Shojo A\'+String.fromCharCode(34)+\', which peaked at number five on the Oricon chart and has sold over 390,000 copies. Her second album Variation became her first number-one on the Oricon Weekly Albums Chart, staying three weeks atop.</p><p>As an actress, she made her debut in 1985 with the appearance on the Japanese romance movie Ai, Tabidachi. After her extended hiatus from 2010 to 2014, Akina released two compilation album, All Time Best: Original and All Time Best: Utahime Cover, both of which were commercially successful. As of 2011, Akina has sold over 25.3 million records and was named as the third best-selling female Japanese idol singer of all-time.[2]</p><p><br></p><p>-<a href=\'+String.fromCharCode(34)+\'https://en.wikipedia.org/wiki/Akina_Nakamori\'+String.fromCharCode(34)+\'> WikiPedia </a> </p>'),(27,'Jahn','Teigen',1949,NULL,'http://gv-musikk.no/media/k2/items/cache/6ef598b10d1539793d4ace8d8b7b613f_XL.jpg','<p>Jahn Teigen satte sitt ettertrykkelige preg på norsk popmusikk i 1970- og 1980-årene. Etter hvert er hans karriere kommet til å bære preg av rollen som rikskjendis, bl.a. som gjenganger i deler av ukepressen og som programleder i fjernsyn, selv om han hele tiden har holdt artistvirksomheten i gang.</p><p><br></p><p>Teigen vokste opp i Tønsberg, begynte tidlig med popmusikk og var vokalist i den lokale gruppen The Enemies 1965–68. Han forlot imidlertid gruppen etter bare én albumutgivelse, til fordel for livet som frontfigur i det britiske bandet Red Squares. Dette ble aldri noen stor suksess, og under en turné i Israel hoppet Teigen av og deltok på noen innspillinger med gruppen Lions of Judea.</p><p><br></p><p>Vel hjemme i Norge igjen kom han i kontakt med musikere som hadde stiftet bandet Arman Sumpe D.E. (Dur Express), et møte som kom til å bli helt avgjørende for Teigens karriere. Vendepunktet kom da de 1972 skiftet navn til Popol Vuh. Deres debutalbum med samme navn ble en gigantsuksess og innbrakte dem Spellemannprisen, og de neste fire årene, etter hvert under navnet Popol Ace, var de trendsettere i norsk rock. Teigen var bandets definitive frontfigur, men ikke en gang hans mildt sagt utagerende sceneopptreden kunne overskygge bandets musikalske triumf. Inspirert av angloamerikansk progrock laget Popol Vuh/Popol Ace komplisert rock med masseappell. Eventyret tok slutt 1976 med albumet Stolen From Time.</p><p><br></p><p>Da hadde Teigen allerede luktet på den “snillere” siden av popbransjen. Han deltok i den norske Melodi Grand Prix-finalen både 1974 og 1975, og han satte alle andre i skyggen med sin opptreden i 1976-finalen. Han vant ikke, men Voodoo, skrevet av Terje Rypdal, er nummeret som huskes: Teigen i skjelettdrakt, i duett med Inger Lise Rypdal, satte dype spor i den norske folkesjelen.</p><p><br></p><p>Dette var starten på en lang Grand Prix-karriere som skulle føre ham til den norske finalen hele 13 ganger. Året etter Voodoo kom det virkelig store gjennombruddet for Teigen som Grand Prix-artist. Etter å ha sunget Kai Eides Mil etter mil til topps i den norske finalen satte han kurs for det internasjonale sirkuset i Paris – full av optimisme, som alltid. Men Norge fikk 0 poeng, og Teigen viste for alvor sin kommersielle teft og sitt artistiske talent. Med det engelskspråklige albumet This Year\'s Loser snudde han fiasko til suksess, innkasserte en Spellemannpris og var for alvor i gang med sin solokarriere.</p><p><br></p><p>1979 gav han ut albumet En dags pause, der Herodes Falsk opptrer som tekstforfatter. Albumet inneholder et av Teigens fineste øyeblikk som komponist og sanger: Min første kjærlighet – en av de virkelig klassiske norske popballadene. Samtidig startet han – sammen med Herodes Falsk og Tom Mathisen – Prima Vera, en gjøglergruppe som med banal humor og tilsynelatende minimal selvsensur skaffet seg et stort og entusiastisk publikum gjennom opptredener, plateutgivelser og den herostratisk berømte spillefilmen Prima Veras saga om Olav den Hellige (1983).</p><p><br></p><p>I denne tiden var Teigen også aktiv som musikalartist. Han medvirket i Rocky Horror Show på Centralteatret i Oslo 1977, og fulgte opp med Fantomets glade bryllup året etter og Fisle Narrepanne i Tyrol 1981; de to siste var han også med på å skrive. Senere medvirket han i rockversjonen av Puccinis La Bohème i Wien og Oslo (1986–87) og i musikalen Sofies verden på Fornebu (1999).</p><p><br></p><p>Et høydepunkt i sin popmusikalske karriere nådde han med albumet Cheek To Cheek, et samarbeid med Anita Skorgan. Sammen med Åge Aleksandersen regjerte paret på denne tiden pop-Norge, og Teigen ble tildelt Spellemannjuryens hederspris 1983.</p><p><br></p><p>Jahn Teigen har i større grad enn de fleste levd sitt liv i medias søkelys, og etter hvert har han blant mye annet stått frem som en mann som liker å snakke om de virkelig store spørsmål i livet. Ofte søker han imidlertid hjelp i utenomjordiske forklaringsmodeller som gjør hans svar like mystiske som hans spørsmål.</p><p><br></p>'),(38,'Misato','Watanabe',1966,NULL,'http://img15.shop-pro.jp/PA01239/479/product/105840395.jpg?cmsp_timestamp=20160808153451','<p>Watanabe Misato first got her break in show business in 1983 1984 when audition along Kudo Shizuka and Kokusho Sayuri, and Matsumoto Noriko for the 3rd and 4th Annual Miss Seventeen Contest and on the Best Song Award. She debuted as a singer a year later with the single \"I\'m free\". She also debuted as a variety talent on the show Youngtown Wednesday. She also served as the chorus at a Shirai Takako concert and would later lend her voice for the chorus for T.M. NETWORK\'s third album GORILLA.</p><p><br></p><p>In 1986, she released the Komuro Tetsuya penned single \"My Revolution\" and it became a hit, selling over million copies. Later that year, she kicked off her first concert, entitled \"MISATO SPECIAL \'86 KICK OFF\" as a female solo singer. She also attended various musical events for musicians including the Hiroshima Peace Memorial Museum Concert ALIVE HIROSHIMA 1987-1997 with various musicians including Ogiki Yutaka, BARBEE BOYS, and THE BLUE HEARTS.</p><p><br></p><p>In 1988, she released her fourth album, ribbon, and it went onto sell over a million copies and have it\'s own concert tour. A year later, she went on a short term studying abroad to London. But it didn\'t stop Wanatabe from releasing more albums, singles, and performing at sold-out tours. From 1990 to 2005, she would also do a live concert on train, nicknamed the MISATO TRAIN.</p><p><br></p><p>Watanabe celebrated her ten year anniversary in 1995 with the release of her first best album, She loves you. Then to celebrate her twenty years, she would go out to appear on Kohaku Uta Gassen at the end of that year to perform her hit song \"My Revolution\".</p><p><br></p><p>- <a href=\"https://www.generasia.com/wiki/Watanabe_Misato\"> generasia </a> </p>'),(39,'Yoshiko','Sai',1953,NULL,'https://pbs.twimg.com/media/Dn0aFcKXsAI2yP1.jpg','Despite most of her work being composed in the mid-to-late 1970s, Sai\'s music found resurgence on video hosting site YouTube, where her song Taiji no Yume reached nearly one million views, despite her music having not previously been as far-reaching. The video features the song Taiji no Yume, but the background image selected is perhaps her most striking - the cover for 1975 album Mangekyo. Due to her online popularity, her music has often been remixed and remastered, and her songs are often recommended by the site\'s video recommendation algorithm.[1]\r\n\r\n');
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `FK_city_country_idx` (`country_id`),
  CONSTRAINT `FK_city_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `continent` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `inception` year(4) DEFAULT NULL,
  `origin` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `originInfo` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES ('',NULL,NULL,NULL),('city pop',1980,'Japan',NULL),('country',NULL,NULL,NULL),('disco',1970,'United States',NULL),('fake',NULL,NULL,NULL),('fake genre 55',NULL,NULL,NULL),('folk',NULL,NULL,NULL),('funk',1960,'United States',NULL),('fusion',NULL,NULL,NULL),('jazz',1920,'New Orleans',NULL),('pop',NULL,NULL,NULL),('rock',NULL,NULL,NULL),('soul',1950,'United States',NULL),('test',NULL,NULL,NULL),('world',NULL,NULL,NULL);
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `song` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`song_id`),
  KEY `FK_song_album_idx` (`album_id`),
  CONSTRAINT `FK_song_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `song`
--

LOCK TABLES `song` WRITE;
/*!40000 ALTER TABLE `song` DISABLE KEYS */;
INSERT INTO `song` VALUES (1,1,'Ride On Time'),(2,2,'Plastic Love'),(3,1,'Daydream'),(4,12,'Cheer Up! The Summer'),(5,12,'Cool Cat\'s Girl'),(6,12,'Jody (she Was Crying)');
/*!40000 ALTER TABLE `song` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_bin NOT NULL,
  `password` varchar(16) COLLATE utf8_bin NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `FK_user_city_idx` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'aese','qweqwe',NULL),(2,'Julian','Skole123',NULL),(3,'TestUser94','JarlsVegia',NULL),(4,'test1','test1234',NULL),(5,'NewUser64','woheey123',NULL),(6,'testbruker1','testbruker1',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrating_album`
--

DROP TABLE IF EXISTS `userrating_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrating_album` (
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `rating` float(2,1) NOT NULL,
  PRIMARY KEY (`user_id`,`album_id`),
  KEY `FK_userRating_album_album_idx` (`album_id`),
  CONSTRAINT `FK_userRating_album_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_userRating_album_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrating_album`
--

LOCK TABLES `userrating_album` WRITE;
/*!40000 ALTER TABLE `userrating_album` DISABLE KEYS */;
INSERT INTO `userrating_album` VALUES (2,1,5.0),(2,2,5.0),(2,4,5.0),(2,6,5.0),(2,12,5.0),(2,15,4.0);
/*!40000 ALTER TABLE `userrating_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrating_artist`
--

DROP TABLE IF EXISTS `userrating_artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrating_artist` (
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `rating` float(2,1) NOT NULL,
  PRIMARY KEY (`user_id`,`artist_id`),
  KEY `FK_userRating_artist_artist_idx` (`artist_id`),
  CONSTRAINT `FK_userRating_artist_artist` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_userRating_artist_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrating_artist`
--

LOCK TABLES `userrating_artist` WRITE;
/*!40000 ALTER TABLE `userrating_artist` DISABLE KEYS */;
INSERT INTO `userrating_artist` VALUES (1,1,5.0),(1,2,4.0),(1,10,5.0),(1,38,4.0),(2,1,5.0),(2,2,5.0),(2,4,4.0),(2,5,4.0),(2,7,4.0),(2,8,4.0),(2,10,4.0),(2,11,5.0),(2,24,4.0),(2,26,4.0),(2,38,3.0),(2,39,4.0),(5,1,4.0);
/*!40000 ALTER TABLE `userrating_artist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-21 14:58:57
