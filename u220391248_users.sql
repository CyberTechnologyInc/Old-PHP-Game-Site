--
-- Table structure for table `gmes`
--

DROP TABLE IF EXISTS `gmes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gmes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gme_name` longtext COLLATE latin1_general_ci NOT NULL,
  `filename` longtext COLLATE latin1_general_ci NOT NULL,
  `views` bigint(20) NOT NULL,
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=361 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gmes`
--

/*!40000 ALTER TABLE `gmes` DISABLE KEYS */;
INSERT INTO `gmes` VALUES (1,'2039 Rider','2039-rider',52,'flash'),(2,'54 Dead Miles','54-dead-miles',83,'shockwave'),(3,'Achilles','achilles',29,'flash'),(4,'Achilles II - Origin Of A Legend','achilles-2-legend',63,'flash'),(5,'Age Of War','aow',174,'flash'),(6,'Age Of War 2','aow2',186,'flash'),(7,'Ageless War','ageless-war',15,'flash'),(8,'Air Battle 2','airbttle2',20,'flash'),(9,'Airport Tycoon','airprt-tycon',23,'flash'),(10,'Alien Anarchy','alien-anarchy',7,'flash'),(11,'Alien Attack Team','alien-attack-team',7,'flash'),(12,'Alxemy','alxemy',15,'flash'),(13,'Anti-TD','Anti-TD',8,'flash'),(14,'Apple Shooter','apple-shooter',154,'flash'),(15,'Arcane','arcne',28,'flash'),(16,'Arcane Weapon','arcane-weapon',9,'flash'),(17,'Arcanorum','arcnorm',7,'flash'),(18,'Armor Mayhem','armor-mayhem',14,'flash'),(19,'Army Of Ages (AOW 3)','aryofags',5,'flash'),(20,'Artillery Rush 2','artillery-rush-2',9,'flash'),(21,'Ashes 2 Ashes: Zombies','ashes-2-ashes-zombies',43,'flash'),(22,'Assembots','assembots',8,'flash'),(23,'Astrodigger','astrodigger',5,'flash'),(24,'Atomic Creep Spawner','atmic-crep-spwner',11,'flash'),(25,'ATV Champions','atv-champions',16,'flash'),(26,'Awesome Planes','awsumplnes',11,'flash'),(27,'Awesome Tanks 2','awsumtnks2',0,'flash'),(28,'Awesome Zombie Exterminators','awesome-zombie-exterminators',7,'flash'),(29,'Back To Zombieland','back-to-zomblnd',20,'flash'),(30,'Backyard Buzzing','backyard-buzzing',4,'flash'),(31,'Bad Eggs Online','bdeggs',7,'flash'),(32,'Balls Of Life','blls-of-lfe',26,'flash'),(33,'Bank Robbers Mayhem','bank-robbers-mayhem',12,'flash'),(34,'Basketballs','basketballs',33,'flash'),(35,'Battle Cry','battle-cry',11,'flash'),(36,'Battle Gear','bttlgar',5,'flash'),(37,'Battle Gear 2','bttlgar-2',12,'flash'),(38,'Battle Panic','bttlepanic',2,'flash'),(39,'Billiard Blitz 3','Billiard-Bltz-3',10,'flash'),(40,'Billy Makin Kid','billy-makn-kid',5,'flash'),(41,'BioDomination','biodomintion',1,'flash'),(42,'Bit Battles','bit-battles',2,'flash'),(43,'Bloons Super Monkey','bloons-supr-monky',15,'flash'),(44,'Bloons Tower Defence 4','btd4',23,'flash'),(45,'Bloons Tower Defence 5','btd5',24,'flash'),(46,'Bloxorz','blxorz',24,'flash'),(47,'Boom Town','boom-twn',4,'flash'),(48,'Bots Strike','bots-strike',3,'flash'),(49,'Bounzy 2','bonzy-2',6,'flash'),(50,'Boxhead','bxhd',13,'flash'),(51,'Boxhead 2Play','bxhd2ply',27,'flash'),(52,'Bubble Tanks 2','bbltnks2',5,'flash'),(53,'Build Up','bild-up',11,'flash'),(54,'Burger Tycoon (McDonalds Tycoon)','brger-tycon',14,'flash'),(55,'Burrito Bison','brtbson',9,'flash'),(56,'Burrito Bison Revenge','brtbson-revenge',43,'flash'),(57,'Can Your Pet','can-your-pt',9,'flash'),(58,'Candy Crush','candy-crush',49,'flash'),(59,'Candy Fun','cndy-fun',2,'flash'),(60,'Canoniac Launcher','canoniac-launcher',2,'flash'),(61,'Canoniac Launcher 2','canoniac-launcher-2',8,'flash'),(62,'Caribbean Admiral','caribean-admirl',6,'flash'),(63,'Chaos Faction','chsfctn',1,'flash'),(64,'Chaos Faction 2','chsfctn2',5,'flash'),(65,'Clan Wars 2 - Red Reign','clan-wrs-2-red-reign',2,'flash'),(66,'Club Nitro','club-nitro',6,'flash'),(67,'Coaster Racer 3','coaster-racer-3',49,'flash'),(68,'Colony','colny',2,'flash'),(69,'Control Craft','control-craft',2,'flash'),(70,'ControlCraft 2','controlcraft-2',2,'flash'),(71,'Corporation Inc','corpratininc',2,'flash'),(72,'Cortex Fortress','cortx-fortrss',5,'flash'),(73,'Creative Kill Chamber','creatvekillchambr',10,'flash'),(74,'Creative Kill Chamber 2','creatvekillchambr2',12,'flash'),(75,'Creeper World Training Simulator','creepr-world-training-simultr',18,'flash'),(76,'Crimson Warfare','crimson_warfare',3,'flash'),(77,'Crush The Castle','crush-the-castle',4,'flash'),(78,'Crush The Castle 2','crush-the-castle-2',31,'flash'),(79,'Cursed Treasure 2','cursed-treasure-2',3,'flash'),(80,'Cyclomaniacs','cyclmniacs',13,'flash'),(81,'Cyclomaniacs 2','cyclmniacs2',23,'flash'),(82,'Da Vinci Cannon 2','da-vinci-canon-2',7,'flash'),(83,'Dead Paradise 2','dead-paradise-2',11,'flash'),(84,'Dead Zed','dead-zed',19,'flash'),(85,'Deadly Neighbors 2','deadlyneihbrs2',6,'flash'),(86,'Death Penalty','death-penalty',9,'flash'),(87,'Decision','decision',3,'flash'),(88,'Decision 2','decision2-newcity',12,'flash'),(89,'Defend Your Nuts 2','defnd-your-nts-2',3,'flash'),(90,'Desert Rumble','desrt-rumble',2,'flash'),(91,'Diggy','diggy',29,'flash'),(92,'Dirk Valentine','drk-valntine',6,'flash'),(93,'Disaster Will Strike','disasterwillstrike',2,'flash'),(94,'Disaster Will Strike 2','disasterwillstrike2',12,'flash'),(95,'Dogfight 2','dgfight-2',31,'flash'),(96,'Doodle God','doodle-god',16,'flash'),(97,'Doodle God 2','doodle-god-2',16,'flash'),(98,'Dr Lee','dr-le',8,'flash'),(99,'Dr Lee UAssault','dr-le-Uassault',4,'flash'),(100,'Droid Assault','drodasslt',2,'flash'),(101,'Duck Life 4','ducklfe4',13,'flash'),(102,'Earn To Die','erntodi',17,'flash'),(103,'Earn To Die 2012','erntodi2012',36,'flash'),(104,'Earn To Die 2012 - Part 2','erntodi2012-part-2',36,'flash'),(105,'Effing Worms 2','efinwrms2',24,'flash'),(106,'Electric Man 2','elctrcmn2',3,'flash'),(107,'Endless War 3','endlsswr3',6,'flash'),(108,'Endless Zombie Rampage','endlszombrmpge',8,'flash'),(109,'Endless Zombie Rampage 2','endlszombrmpge2',9,'flash'),(110,'Enigmata Stellar War','enigmta-stellr-wr',0,'flash'),(111,'Epic Coaster','epic-coastr',25,'flash'),(112,'Eridani','eridni',2,'flash'),(113,'Everybody Edits','everybdy-edits',4,'flash'),(114,'Factory Rush','factry-rush',6,'flash'),(115,'Fancy Pants Adventure World 1','fncypnts',9,'flash'),(116,'Fancy Pants Adventure World 2','fncypnts2',6,'flash'),(117,'Fancy Pants Adventure World 3','fncypnts3',4,'flash'),(118,'FFX Runner','ffx-runnr',93,'shockwave'),(119,'Final Ninja Zero','fnal-ninj-zro',10,'flash'),(120,'Flakboy 2','flkboy2',1,'flash'),(121,'Flight','flght',14,'flash'),(122,'Formula Driver 3D','formla-drivr-3d',108,'flash'),(123,'Fragger','fragger',1,'flash'),(124,'Free Rider 3','fre-rdr-3',45,'flash'),(125,'Freedom Tower: The Invasion','freedm-tower-the-invasion',4,'flash'),(126,'Freeway Fury 2','frwyfry2',23,'flash'),(127,'Full Auto Mayhem','full-auto-mayhem',3,'flash'),(128,'Galaxy Siege','galxy-sige',1,'flash'),(129,'Game Corp','gmcorp',6,'flash'),(130,'Gang Blast 2','gngblst2',3,'flash'),(131,'Gear Of Defence','gear-of-defnce',0,'flash'),(132,'Ghost Guidance','ghstgidnce',6,'flash'),(133,'Ghost Hacker 2','ghst-hcker-2',3,'flash'),(134,'Goal South Africa','goalsothafric',11,'flash'),(135,'Gods Playing Field','gdsplyngfild',4,'flash'),(136,'Gravitee Wars','gravite-wrs',3,'flash'),(137,'Grow Cube','grow-cube',27,'flash'),(138,'Grow Island','grow-island',18,'flash'),(139,'Grow Tower','grow-tower',12,'flash'),(140,'Grow Valley','grow-valley',14,'flash'),(141,'Gun Mayhem 2','gun-mayhm-2',48,'flash'),(142,'GunBlood Western Shootout','gnblodwestrnshotout',30,'flash'),(143,'GunBot','gnbot',4,'flash'),(144,'Gunbrick','gnbrick',6,'flash'),(145,'Hacker vs. Hacker','hackr-vs-hackr',13,'flash'),(146,'Handless Millionaire 2','handless-millionaire-2',10,'flash'),(147,'Hanger','hanger',6,'flash'),(148,'Hanger 2','Hanger-2',31,'flash'),(149,'Hapland','haplnd',5,'flash'),(150,'Happy Wheels','happy-whels-demo',115,'flash'),(151,'Heli Attack 3','hliattck3',2,'flash'),(152,'Hell Diggers','hell-diggers',7,'flash'),(153,'Heru','heru',8,'flash'),(154,'Horror Plant','horror-plant',5,'flash'),(155,'Horror Plant 2','horror-plant-2',9,'flash'),(156,'House Of Wolves','house-of-wlves',4,'flash'),(157,'I Am An Insane Rogue AI','insne-roge-ai',5,'flash'),(158,'I Saw Her Standing There','i-sw-her-stnding-there',20,'flash'),(159,'I Saw Her Standing There - I Saw Her Too, With Lasers','I-saw-her-too,-with-lasers',9,'flash'),(160,'Impale 2','imple-2',9,'flash'),(161,'Incredibots','incredibots',3,'flash'),(162,'Incredibots 2','incredibots-2',3,'flash'),(163,'Infectonator 2','inftntr2',4,'flash'),(164,'Interactive Buddy','intractvbddy',6,'flash'),(165,'Interactive Buddy 2','intractvbddy2',20,'flash'),(166,'Into Space 2','intospc2',12,'flash'),(167,'Intruder Combat Training','intdrcmbattrnng',3,'flash'),(168,'Jail Break','Jail-Break',34,'flash'),(169,'Jonny Backflip','jnnybkflp',16,'flash'),(170,'Laser Cannon','lser-canon',5,'flash'),(171,'Laser Cannon 2','lser-canon-2',7,'flash'),(172,'LAX Shuttle Bus','lax-shuttle-bus',15,'flash'),(173,'Lazerman','lzerman',9,'flash'),(174,'Learn To Fly','lrn2fly',13,'flash'),(175,'Learn To Fly 2','lrn2fly2',33,'flash'),(176,'Lucky Tower','lucky-tower',1,'flash'),(177,'Lucky Tower 2','lucky-tower-2',0,'flash'),(178,'Mars Colonies','mars-colnies',3,'flash'),(179,'Massive Mayhem 3','massive-mayhem-3',11,'flash'),(180,'Massive War','massve-war',5,'flash'),(181,'Mastermind World Conqueror','mastermind-world-conqueror',10,'flash'),(182,'Max Dirt Bike','max-dirt-bike',58,'flash'),(183,'Mechanical Commando 2','mechanical-commando-2',4,'flash'),(184,'Mega Miner','mgamnr',6,'flash'),(185,'Metal Tank','metal-tank',2,'flash'),(186,'Mine Blocks','mine-blcks',1,'flash'),(187,'Mine Blocks 2','mine-blcks-2',6,'flash'),(188,'Minecraft','mincrft',2,'flash'),(189,'Mini Dash','mini-dash',25,'shockwave'),(190,'Mini Putt 3','mini-putt-3',37,'flash'),(191,'Mining Truck','mining-trck',21,'flash'),(192,'Momentum Missile Mayhem 4','momentum-missile-mayhem-4',2,'flash'),(193,'Monster Evolution','monster-evolution',4,'flash'),(194,'Moto Trial Fest','moto-trial-fest',29,'flash'),(195,'Nanopath','nanopath',9,'flash'),(196,'Neon Race','neon-race',17,'flash'),(197,'Neon Race 2','neon-race-2',14,'flash'),(198,'Nex','nxgme',6,'flash'),(199,'Notebook Wars 3 Unleashed','ntebokwrs3unleashd',1,'flash'),(200,'Nuclear Gun','nclrgn',32,'flash'),(201,'Obliterate Everything','obltratevrythng',8,'flash'),(202,'Obliterate Everything 2','obltratevrythng2',5,'flash'),(203,'Oiligarchy','oiligrchy',5,'flash'),(204,'Orbital Onslaught','orbtlonslught',4,'flash'),(205,'Pacman','pcman',20,'flash'),(206,'Pandemic 2','pndmc2',5,'flash'),(207,'Path Barrel','pth-barrel',0,'flash'),(208,'Penguin Massacre','penguin-massacre',5,'flash'),(209,'Phage Wars','phgwrs',1,'flash'),(210,'Pigs Will Fly','pgs-wll-fly',8,'flash'),(211,'Pipe Riders','pperidr',25,'flash'),(212,'Pirates Of The Stupid Seas','pirts-of-th-stupd-ses',3,'flash'),(213,'Plane Loopy','plane-loopy',5,'flash'),(214,'Planet Juicer','plntjucer',2,'flash'),(215,'Planet Wars','planet-wars',3,'flash'),(216,'Plazma Burst','plazma-burst',5,'flash'),(217,'Plazma Burst 2','plazma-burst-2',6,'flash'),(218,'Portal: The Flash Version','prtl-flsh-version',5,'flash'),(219,'Potion Panic 2','potonpnc2',1,'flash'),(220,'Pour The Fish: Level Pack','pour-the-fish-level-pack',6,'flash'),(221,'Primal Sands','primal-sands',4,'flash'),(222,'Quantum Patrol','quantum-patrol',14,'flash'),(223,'Raft Wars','raft-wars',44,'flash'),(224,'Raft Wars 2','raft-wars-2',25,'flash'),(225,'Ragdoll Achievement','ragdollachievement',6,'flash'),(226,'Ragdoll Achievement 2','ragdollachievement2',9,'flash'),(227,'Rail Of Death 3','rail-of-death-3',16,'flash'),(228,'Red Exctinction','red-exctinction',2,'flash'),(229,'Reign Of Centipede','reign-of-centipede',2,'flash'),(230,'Renegade Racing','rngade-rcing',9,'flash'),(231,'Resort Empire','resort-empre',2,'flash'),(232,'Retro Resources 2','retr-resourcs-2',2,'flash'),(233,'Road Of The Dead','rod-of-th-ded',3,'flash'),(234,'Robokill','rbokll',3,'flash'),(235,'Robokill 2','rbokll-2',17,'flash'),(236,'Robot Clashes','robt-clashes',1,'flash'),(237,'Robotic Emergence 2','robotc-emrgence-2',1,'flash'),(238,'Robots vs Zombies','robtsvszombs',7,'flash'),(239,'Rubble Trouble New York','rubbl-trouble-new-yrk',0,'flash'),(240,'Rubble Trouble Tokyo','rubbl-trouble-tokyo',3,'flash'),(241,'Runescape 07','runescpe07',0,'flash'),(242,'Sandcastle','sand-castle',4,'flash'),(243,'Sandcastle Ancient Invasion','sand-castle-ancient-invasion',1,'flash'),(244,'Sands Of The Coliseum','sands-of-the-coliseum',7,'flash'),(245,'SAS3','ss3',4,'flash'),(246,'Sea Of Fire','sea-of-fire',4,'flash'),(247,'Sea Of Fire 2','sea-of-fire-2',15,'flash'),(248,'Shadez 2','shdz2',2,'flash'),(249,'Shadez 3: The Moon Miners','shdz3',5,'flash'),(250,'Shadez: The Black Operations','shdz',5,'flash'),(251,'Shift','shift',1,'flash'),(252,'Shift 2','shift-2',1,'flash'),(253,'Shotgun Vs Zombies','Shotgun-Vs-Zombies',29,'flash'),(254,'Siege Tank Defence','siege-tank-defence',2,'flash'),(255,'Sim Taxi','sim-taxi',18,'flash'),(256,'Sky Run','sk-run',20,'flash'),(257,'Skyfighters','skyfighters',4,'flash'),(258,'Smash Palace','smsh-palce',2,'flash'),(259,'Sniper Team','snipr-team',11,'flash'),(260,'Sonny','snny',4,'flash'),(261,'Sonny 2','snny-2',2,'flash'),(262,'Spellstorm','spllstrm',0,'flash'),(263,'Splitman 2','splitman-2',3,'flash'),(264,'Splitter','splitter',12,'flash'),(265,'Sports Heads: Basketball','sports-head-basketball',90,'flash'),(266,'Sports Heads: Football Championship','mini-footbll',293,'flash'),(267,'Sports Heads: Ice Hockey','sports-heads-ice-hockey',112,'flash'),(268,'Sports Heads: Tennis','sports-heads-tennis',80,'flash'),(269,'Sports Heads: Volleyball','sports-heads-volleyball',39,'flash'),(270,'Spurt','spurt',5,'flash'),(271,'Star Dominion','star-dominion',1,'flash'),(272,'Starcraft FA3','sc-fa3',7,'flash'),(273,'Starcraft FA5','sc-fa5',0,'flash'),(274,'Steampunk Tower Defence','stmpnktwrdefnce',3,'flash'),(275,'Stick Blender','stck-blendr',3,'flash'),(276,'Stick Rpg','stck-rpg',7,'flash'),(277,'Stick Rpg 2','stck-rpg-2',9,'flash'),(278,'Stick War','stick-wr',7,'flash'),(279,'Stick War 2','stick-wr-2',8,'flash'),(280,'Stickman Dirtbike','stickman-dirtbike',7,'flash'),(281,'Stormwinds The Lost Campaigns','strmwindthelstcampagn',1,'flash'),(282,'Street Sesh','street-sesh',30,'shockwave'),(283,'Strike Force Heroes','strkforchroes',5,'flash'),(284,'Strike Force Heroes 2','strkforchroes-2',9,'flash'),(285,'Super Rally Challenge','super-rally-challenge',11,'flash'),(286,'Super Smash Flash 2','super-smash-flash-2',7,'flash'),(287,'Swarm Defenders','swarm-defenders',3,'flash'),(288,'Swords And Sandals 2 - Emperors Reign','swrdsANDsandls2-emprorsregn',17,'flash'),(289,'Tennis','tennis',15,'flash'),(290,'Territory War 2','territory-war-2',6,'flash'),(291,'Tesla Defence','tsla-defnce',3,'flash'),(292,'The Battle','the-battle',3,'flash'),(293,'The Great War Of Prefectures','the-great-wr-of-prefctures',0,'flash'),(294,'The Gun Game 2','thegngme2',18,'flash'),(295,'The Heist','the-heist',24,'flash'),(296,'The Heist 2','the-heist-2',60,'flash'),(297,'The Impossible Quiz','theimpossiblequiz',44,'flash'),(298,'The Impossible Quiz 2','theimpossiblequiz2',12,'flash'),(299,'The Last Shelter','the-last-shelter',9,'flash'),(300,'The Last Stand 2','thelststnd2',44,'flash'),(301,'The Last Stand: Union City','the-last-stand-union-city',10,'flash'),(302,'The Maze','mazegme',31,'flash'),(303,'The Peacekeeper','the-peacekeeper',40,'flash'),(304,'The Torture Game 2','the-torture-game-2',61,'flash'),(305,'The Unfair Platformer','the-unfar-pltformer',10,'flash'),(306,'Thing Thing Arena 3','thng-thng-arena-3',2,'flash'),(307,'Thing Thing Arena Pro','thing-thing-arena-pro',3,'flash'),(308,'Toss The Turtle','tssthetrtle',8,'flash'),(309,'Totem Awakening 2','totem-awakening-2',0,'flash'),(310,'Transmorpher','trnsmorphr',2,'flash'),(311,'Troll Cannon','trll-canon',5,'flash'),(312,'Troll Cannon 2','trll-canon-2',28,'flash'),(313,'Trollface Quest','trollface-quest',16,'flash'),(314,'Trollface Quest 2','trollface-quest-2',7,'flash'),(315,'Trollface Quest 3','trollface-quest-3',12,'flash'),(316,'Truck Loader 4','trck-loader-4',20,'flash'),(317,'Truck Wars','trckwrs',17,'flash'),(318,'TU-46','tu46',292,'flash'),(319,'TU-95','tu95',43,'flash'),(320,'Ultimate Tank War','UltimateTankWar',5,'flash'),(321,'Unit Commander','unit-commander',2,'flash'),(322,'Unreal Flash 3','unrl-flsh-3',8,'flash'),(323,'Upgrade Complete 2','upgrdcmplte2',2,'flash'),(324,'Versus Umbra','vrsumbr',5,'flash'),(325,'Vex','vex-gme',16,'flash'),(326,'Via Sol','via-sol',0,'flash'),(327,'Via Sol 2','via-sol-2',5,'flash'),(328,'Warzone','warzone',7,'flash'),(329,'Warzone 2060','warzone-2060',17,'flash'),(330,'Weapons On Wheels 2','weapons-on-wheels-2',19,'flash'),(331,'Wonder Rocket','wondr-rocket',7,'flash'),(332,'Wonderputt','wndrptt',14,'flash'),(333,'Worlds Hardest Game','wrldshrdstgme',96,'flash'),(334,'Worlds Hardest Game 2','wrldshrdstgme2',26,'flash'),(335,'Xonix 3D','xonix-3d',26,'flash'),(336,'Zombie Shooter','zomb-shoter',28,'flash'),(337,'Zombie Trailer Park (Hillbillys vs Zombies)','zomb-tlor-prk',62,'flash'),(338,'Zombies Inc','zombs-inc',20,'flash'),(339,'Zombogrinder','zombgrnder',13,'flash'),(340,'Zombogrinder 2','zombgrnder-2',9,'flash'),(341,'Zombotron','zmbotrn',4,'flash'),(342,'Zombotron 2','zmbotrn2',10,'flash'),(343,'Road Of Fury','road-of-fury',7,'flash'),(344,'QWOP','qwop',45,'flash'),(345,'Road Of The Dead 2','road-of-the-dead-2',5,'flash'),(346,'Get On Top','get-on-top',42,'flash'),(347,'Tek Tactical','tek-tactical',3,'flash'),(348,'Super Invaders','super-invaders',1,'flash'),(349,'Battalion Commander 2','battalion-commander-2',1,'flash'),(350,'Zombies On Wheels: The Arrival','zombies-on-wheels-the-arrival',7,'flash'),(351,'Kick Out Miley','kick-out-miley',9,'flash'),(352,'Santa Carnage','santa-carnage',6,'flash'),(353,'Frantic Sky','frantic-sky',9,'flash'),(354,'Green Liquid','green-liquid',1,'flash'),(355,'Truck Monster','truck-monster',7,'flash'),(356,'Ironcalypse','ironcalypse',3,'flash'),(357,'Jacksmith','jacksmith',1,'flash'),(358,'Deadly Road Trip','deadlyroadtrip',8,'flash'),(359,'Dead Paradise 3','dead-paradise-3',6,'flash'),(360,'Gulf Defence','gulf-defence',27,'flash');
/*!40000 ALTER TABLE `gmes` ENABLE KEYS */;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `game_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `game_url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reset_pass`
--

DROP TABLE IF EXISTS `reset_pass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_pass` (
  `code` longtext COLLATE latin1_general_ci NOT NULL,
  `username` longtext COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` longtext COLLATE latin1_general_ci NOT NULL,
  `password` longtext COLLATE latin1_general_ci NOT NULL,
  `account_position` longtext COLLATE latin1_general_ci NOT NULL,
  `ban_message` longtext COLLATE latin1_general_ci NOT NULL,
  `bannedBy` longtext COLLATE latin1_general_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `favourite_games` longtext COLLATE latin1_general_ci NOT NULL,
  `loginID` longtext COLLATE latin1_general_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `websiteSettings`
--

DROP TABLE IF EXISTS `websiteSettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `websiteSettings` (
  `registrationDisabled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websiteSettings`
--

/*!40000 ALTER TABLE `websiteSettings` DISABLE KEYS */;
INSERT INTO `websiteSettings` VALUES (0);
/*!40000 ALTER TABLE `websiteSettings` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-01  2:02:55
