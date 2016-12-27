<?php
/*********all types must contain array，based on the format of day dress types********/

function retriveCategory($description){

/****************************dress******/
$dressKw=array('dress','dresses');

$dressDayTwoWords=array('mini','mini-', 'day', 'all-day', 'daytime','day-', 'short', 'small', 'summer', 'spring', 'resort', 'cami', 'beach', 'crochet', 'basic', 'slit', 'skater', 'sun', 'swing', 'wrap', 'gauze', 'jersey', 'slip', 'easy', 'smock', 'above-', 'above knee', 'above-the-knee','above the knee', 'tank', 'surplice', 'loose', 'pinafore', 'peasant', 't-shirt', 'tee','boho','micro','denim','jean','jeans');
$dressDayTypes=array('Women > Clothing > Dresses > Day',true,$dressKw,$dressDayTwoWords, 'shirt dress','sundress','shirtdress');
$dressCocktailTwoWords=array('cocktail', 'evening', 'midi', 'midi-', 'mid', 'mid-', 'medium', 'pencil', 'body','body-', 'bodycon', 'sheath', 'fitted', 'little', 'party', 'flare', 'flared', 'fit-and-flare', 'prom', 'shift', 'night', 'tea', 'blouson', 'sleeveless', 'strapless', 'tier','tiers', 'tiered', 'below', 'below-knee', 'below the knee','below-the-knee', 'ruffle', 'ruffles', 'ruffled', 'knee-length','cold-shoulder', 'shoulder', 'one-shoulder', 'one shoulder', 'off-shoulder', 'off shoulder', 'off-the-shoulder','ballerina','party','parties','lace');
$dressCocktailTypes=array('Women > Clothing > Dresses > Cocktail',true,$dressKw,$dressCocktailTwoWords);
$dressMaxiTwoWords=array('maxi','maxis','long','floor','floor-','ankle-length');
$dressGowns=array('Women > Clothing > Dresses > Gowns','Gown','gowns','ballgown','bedgown', 'nightgown');
$dressMaxiTypes=array('Women > Clothing > Dresses > Maxi',true,$dressKw,$dressMaxiTwoWords);
$dressTypes=array('Women > Clothing > Dresses',$dressDayTypes,$dressCocktailTypes,$dressGowns,$dressMaxiTypes,'dress','dresses');


/******************************tops****/
$topKw=array('tops','top','t-shirt','tee','t');
$topsTshirtsTwoWords=array('short sleeve','short sleeves','long sleeve','long sleeves');
$topsTshirtsAlias=array('Women > Clothing > Tops > T-shirts',true,$topKw,$topsTshirtsTwoWords,'tee', 'tees', 't-shirt', 't-shirts', "t's", 'ts','tshirt','tshirts');
/**tanktops**/
$topTanktopsKw=array('top', 'tops', 'shirt', 'shirts', 't-shirt', 'tee', 't');
$topTanktopsTwoWords=array('sleeveless','spaghetti','cold shoulder','cold-shoulder');
$topsTanktopsAlias=array('Women > Clothing > Tops > Tank tops',true,$topTanktopsKw,$topTanktopsTwoWords,'tank', 'tanks','wife-beater', 'cami', 'undershirt','Neck Shell');
/**topsblouse***/
$topsblouseKw=array('top', 'tops', 'shirt', 'shirts');
$topsblouseTwoWords=array('embroidered', 'embroidery', 'ruffle', 'ruffled', 'ruffles', 'lace', 'laces','smock','smocked');
$topsblouseAlias=array('Women > Clothing > Tops > Blouses',true,$topsblouseKw,$topsblouseTwoWords,'blouses','blouse','dress shirt','dress-shirt','button-up','button-down','button up','button down');
$topblouseExtraKw=array('blouse','blouses','shirt','shirts');
$topblouseExtraTwoWords=array('poet','pocket');
$topsblouseAliasExtra=array('Women > Clothing > Tops > Blouses',true,$topblouseExtraKw,$topblouseExtraTwoWords);
/********shirt******/
$topsShirtsKw=array('shirt','shirts');
$topsShirtTwoWords=array('button up','button down','short sleeve','short sleeves','long sleeve','long sleeves');
$topsShirtsAlias=array('Women > Clothing > Tops > Shirts',true,$topsShirtsKw,$topsShirtTwoWords,'Shirt','Shirts','button-down','button-up');
$topsTunicsAlias=array('Women > Clothing > Tops > Tunics','tunics','tunic','kurta');
$topsCardigansAlias=array('Women > Clothing > Tops > Cardigans','cardigans','cardigan');
$topSweatersAlias=array('Women > Clothing > Tops > Sweaters','sweaters','sweater','pullover', 'pullovers', 'jumpers','jumper');
/**sweater***/
$topSweatersKw=array('sweater','sweaters','sweat');
$topSweatersTwoWords=array('hooded','hood');
$topSweatershirtsAlias=array('Women > Clothing > Tops > Sweatshirts & Hoodies',true,$topSweatersKw,$topSweatersTwoWords,'sweatshirts','sweatshirt','hoodies','hoodie','hoody','sweat shirt');

$topTypes=array('Women > Clothing > Tops',$topsTshirtsAlias,$topsTanktopsAlias,$topsblouseAlias,$topsblouseAliasExtra,$topsShirtsAlias,$topsTunicsAlias,$topsCardigansAlias,$topSweatersAlias,$topSweatershirtsAlias,'top','tops');


/*****************************outerwear********/

$outerwearCoatsAlias=array('Women > Clothing > Outerwear > Coats','coats','coat','parka', 'parkas', 'trench', 'trenches', 'trenchcoat', 'trenchcoats','Anorak', 'Anoraks');
$outerwearJacketsAlias=array('Women > Clothing > Outerwear > Jackets','jacket', 'jackets', 'kimono', 'kimonos', 'blazer', 'blazers','Topper','Bomber');
$outerwearVestsKw=array('jacket','jackets','coat','coats','blazer','blazers','parka', 'parkas', 'trench', 'trenches', 'trenchcoat', 'trenchcoats', 'anorak', 'anoraks');
$outerwearVestsTwoWords=array('sleeveless');
$outerwearVestsAlias=array('Women > Clothing > Outerwear > Vests',true,$outerwearVestsKw,$outerwearVestsTwoWords,'vests','vest','waistcoat','waistcoats', 'waist Coat');
$outerwearCapesAlias=array('Women > Clothing > Outerwear > Capes','Cape', 'Capes', 'Poncho', 'Ponchos', 'Cloak', 'Cloaks');
$outerwearTypes=array('Women > Clothing > Outerwear',$outerwearCoatsAlias,$outerwearJacketsAlias,$outerwearVestsAlias,$outerwearCapesAlias);


/*****************************skirts*********/
$skirtsKw=array('skirts','skirt');

/*****mini*********/
$skirtsMiniTwoWords=array('mini', 'mini-length', 'short');
$skirtsMiniAlias=array('Women > Clothing > Skirts > Mini',true,$skirtsKw,$skirtsMiniTwoWords,'miniskirts','miniskirt','mini-skirt','mini-skirts');

/*****Knee-Length*********/

$skirtsKneeLengthTwoWords=array('midi', 'mid', 'medium', 'knee', 'knees', 'knee-', 'mid-', 'pencil', 'a-line', 'asymmetric', 'asymmetrical', 'waterfall', 'a line','21"','22"','23"','24"','25"','26"','27"','28"','29"','30"','21in','22in','23in','24in','25in','26in','27in','28in','29in','30in','21 inches','22 inches','23 inches','24 inches','25 inches','26 inches','27 inches','28 inches','29 inches','30 inches','21"L','22"L','23"L','24"L','25"L','26"L','27"L','28"L','29"L','30"L');
$skirtsKneeLengthAlias=array('Women > Clothing > Skirts > Knee-length',true,$skirtsKw,$skirtsKneeLengthTwoWords,'Midiskirt', 'Midiskirts', 'Midi-Skirt', 'Midi-Skirts');

/*****Long*********/
$skirtsLongTwoWords=array('long', 'maxi', 'ball','calf' ,'calf-, calf length', 'full-', 'full','31"','32"','33"','34"','35"','36"','37"','38"','39"','40"','41"','42"','43"','44"','45"','46"','47"','48"','49"','50"','51"','52"','53"','54"','55"','56"','57"','58"','59"','60"','31in','32in','33in','34in','35in','36in','37in','38in','39in','40in','41in','42in','43in','44in','45in','46in','47in','48in','49in','50in','51in','52in','53in','54in','55in','56in','57in','58in','59in','60in','31 inches','32 inches','33 inches','34 inches','35 inches','36 inches','37 inches','38 inches','39 inches','40 inches','41 inches','42 inches','43 inches','44 inches','45 inches','46 inches','47 inches','48 inches','49 inches','50 inches','51 inches','52 inches','53 inches','54 inches','55 inches','56 inches','57 inches','58 inches','59 inches','60 inches','31"L','32"L','33"L','34"L','35"L','36"L','37"L','38"L','39"L','40"L','41"L','42"L','43"L','44"L','45"L','46"L','47"L','48"L','49"L','50"L','51"L','52"L','53"L','54"L','55"L','56"L','57"L','58"L','59"L','60"L');
$skirtsLongAlias=array('Women > Clothing > Skirts > Long',true,$skirtsKw,$skirtsLongTwoWords,'maxiskirt','maxi-skirt','maxi-skirts');
$skirtsTypes=array('Women > Clothing > Skirts',$skirtsMiniAlias,$skirtsKneeLengthAlias,$skirtsLongAlias,'skirt','skirts');


/************************Shorts*********/
$shortsTypes=array('Women > Clothing > Shorts','shorts','short');


/*************************Skorts*********/
$skortsTypes=array('Women > Clothing > Skorts','skorts','skort');


/*****************************jeans*****/
$jeansKw=array('jeans', 'jean', 'denim');

/****bootcut***/
$jeansBootcutTwoWords=array('bootcut', 'boot-', 'boot');
$jeansBootcutAlias=array('Women > Clothing > Jeans > Bootcut',true,$jeansKw,$jeansBootcutTwoWords);

/*****boyfriend******/
$jeansBoyfriendTwoWords=array('boyfriend', 'boyfriend-', 'mom', 'slouchy');
$jeansBoyfriendAlias=array('Women > Clothing > Jeans > Boyfriend',true,$jeansKw,$jeansBoyfriendTwoWords);

/******flared********/
$jeansFlaredTwoWords=array('flare', 'flared', 'flare-', 'flareleg', 'bellbottom', 'bell-bottom', 'bell');
$jeansFlaredAlias=array('Women > Clothing > Jeans > Flared',true,$jeansKw,$jeansFlaredTwoWords);

/******cropped******/
$jeansCroppedTwoWords=array('cropped', 'crop', 'cut-off', 'capri');
$jeansCroppedAlias=array('Women > Clothing > Jeans > Cropped',true,$jeansKw,$jeansCroppedTwoWords);

/******skinny*****/
$jeansSkinnyTwoWords=array('skinny', 'skinnies', 'skin-tight', 'skinny-', 'slim', 'slim-','slimming', 'legging', 'leggings');
$jeansSkinnyAlias=array('Women > Clothing > Jeans > Skinny',true,$jeansKw,$jeansSkinnyTwoWords,'jegging','jeggings');

/*****straightLeg******/
$jeansStraightLegTwoWords=array('straight', 'straight-', 'straightleg', 'regular', 'regular-', 'regular fit');
$jeansStraightLegAlias=array('Women > Clothing > Jeans > Straight Leg',true,$jeansKw,$jeansStraightLegTwoWords);

/*******wideLeg*******/
$jeansWideLegTwoWords=array('wide', 'wide-', 'wideleg');
$jeansWideLegAlias=array('Women > Clothing > Jeans > Wide Leg',true,$jeansKw,$jeansWideLegTwoWords);

$jeansTypes=array('Women > Clothing > Jeans',$jeansBootcutAlias,$jeansBoyfriendAlias,$jeansFlaredAlias,$jeansCroppedAlias,$jeansSkinnyAlias,$jeansStraightLegAlias,$jeansWideLegAlias,'Jeans', 'Jean', 'Denim');


/*********pants*******************************/
$pantsKw=array('Pant', 'Pants', 'Trousers', 'Trouser', 'Slack', 'Slacks', 'Chino', 'Chinos');

/*****capri*********/

$pantsCapriKw=array('pant', 'pants', 'trousers', 'trouser', 'slack', 'slacks', 'chino', 'chinos', 'legging', 'leggings');
$pantsCapriTwoWords=array('capri', 'capris', 'capri-cut', 'crop', 'cropped', 'crop-cut', 'tapered', 'tailored','pintuck', 'ankle', 'stirrup','cuffed');
$pantsCapriAlias=array('Women > Clothing > Pants > Capri & Cropped',true,$pantsCapriKw,$pantsCapriTwoWords);

/******legging******/
$pantsLeggingsTwoWords=array('yoga');
$pantsLeggingsKw=array('pant', 'pants', 'trouser', 'trousers', 'legging', 'leggings', 'jegging', 'jeggings');
$pantsLeggingsAlias=array('Women > Clothing > Pants > Leggings',true,$pantsLeggingsKw,$pantsLeggingsTwoWords,'Legging', 'Leggings', 'Jegging', 'Jeggings', 'Tregging', 'Treggings');

/*******straight leg*****/
$pantsStraightLegTwoWords=array('straight', 'straight-', 'straightleg', 'regular-', 'regular fit','classic');
$pantsStraightLegAlias=array('Women > Clothing > Pants > Straight Leg',true,$pantsKw,$pantsStraightLegTwoWords);

/*******wideLeg*******/
$pantsWideLegTwoWords=array('wide', 'wide-', 'wideleg', 'loose', 'relaxed', 'palazzo','gauze');
$pantsWideLegAlias=array('Women > Clothing > Pants > Wide Leg',true,$pantsKw,$pantsWideLegTwoWords);

/*******skinny******/
$pantsSkinnyTwoWords=array('skinny', 'skinnies', 'skin-tight', 'skinny-', 'slim', 'slim-', 'slimming');
$pantsSkinnyAlias=array('Women > Clothing > Pants > Skinny',true,$pantsKw,$pantsSkinnyTwoWords);

/*******Flared*****/
$pantsFlaredTwoWords=array('flare', 'flared', 'flare-cut', 'flareleg', 'flare-leg', 'bellbottom', 'bell-bottom', 'bell');
$pantsFlaredAlias=array('Women > Clothing > Pants > Flared',true,$pantsKw,$pantsFlaredTwoWords);

/****bootcut*******/
$pantsBootCutTwoWords=array('bootcut', 'boot-','boot');
$pantsBootCutAlias=array('Women > Clothing > Pants > Boot Cut',true,$pantsKw,$pantsBootCutTwoWords);

/*****Culotte*******/
$pantsCulottesTwoWords=array('Gaucho');
$pantsCulottesKw=array('pant', 'pants', 'trouser', 'trousers', 'chino', 'chinos');
$pantsCulottesAlias=array('Women > Clothing > Pants > Culottes',true,$pantsCulottesKw,$pantsCulottesTwoWords,'Culotte', 'Culottes','Gaucho');

/*******sweats******/
$pantsSweatsTwoWords=array('sweat','fleece','-fleece','lounge','Jogger');
$pantsSweatsKw=array('pant','pants');
$pantsSweatsAlias=array('Women > Clothing > Pants > Sweats',true,$pantsSweatsKw,$pantsSweatsTwoWords,'Sweatpant', 'Sweatpants', 'Sweat-pant', 'Sweats', 'Trackpant', 'Trackpants');

$pantsTypes=array('Women > Clothing > Pants',$pantsCapriAlias,$pantsLeggingsAlias,$pantsStraightLegAlias,$pantsWideLegAlias,$pantsSkinnyAlias,$pantsFlaredAlias,$pantsBootCutAlias,$pantsCulottesAlias,$pantsSweatsAlias,'Pant', 'Pants', 'Trousers', 'Trouser', 'Slack', 'Slacks', 'Chino', 'Chinos');


/************rompers/jumpsuits********************/
$rompersTypes=array('Women > Clothing > Rompers & Jumpsuits','Romper', 'Rompers', 'Jumpsuit', 'Jumpsuits', 'Playsuit', 'Playsuits','Bodysuits', 'Bodysuit', 'Body-suit', 'Body-suits', 'body suit', 'body suits','jump suit','jump suits','play suit','play suits','jump-suit','jump-suits','play-suit','play-suits');


/*******overalls*********************************/
$overallsKw=array('jumpsuit', 'jumpsuits', 'playsuit', 'playsuits');
$overallsTwoWords=array('denim', 'jean', 'jeans');
$overallsAlias=array('Women > Clothing > Overalls',true,$overallsKw,$overallsTwoWords);
$overallsTypes=array('Women > Clothing > Overalls',$overallsAlias,'Overall', 'Overalls', 'Over-all', 'Over-alls','Dungarees', 'Dungaree','shortall','shortalls','short-all','short-alls');


/*******Intimates****/
$intimatesBrasAlias=array('Women > Clothing > Intimates > Bras','Bra', 'Bras', 'Sportsbra', 'Bralette', 'Bralettes');
$intimatesCamisolesAlias=array('Women > Clothing > Intimates > Camisoles','Cami', 'Camisole', 'Undershirt');
$intimatesChemisesAlias=array('Women > Clothing > Intimates > Chemises','Chemise','Chemises');
$intimatesHoiseryAlias=array('Women > Clothing > Intimates > Hosiery','Hosiery', 'Sock', 'Socks', 'Stocking', 'Stockings', 'Tights', 'Leg Warmers', 'Leg Warmer', 'Leg-Warmers', 'Leg-Warmer', 'Pantyhose');
$intimatesSleepwearAlias=array('Women > Clothing > Intimates > Sleepwear','Sleepwear', 'Sleep', 'Pajama', 'Pajamas', 'PJ', 'Sleepshirt', 'Lounge Set', 'Nightgown', 'Nightshirt', 'Nightdress', 'Nightie','night slip','pyjama','pyjamas');
$intimatesPantiesAlias=array('Women > Clothing > Intimates > Panties & Thongs','Panties', 'Pantie', 'Panty', 'Thong', 'Thongs', 'Underwear', 'Hipsters', 'Boyshort', 'Boyshorts','Boy Short', 'Boy Shorts', 'Boy-Short', 'Boy-Shorts', 'Boypant', 'Boypants', 'Brief', 'Briefs', 'Boxer', 'Boxers', 'Tanga', 'Cheeky', 'Cheekster', 'Knicker', 'Knickers', 'G-String', 'Underwear');
$intimatesRobesAlias=array('Women > Clothing > Intimates > Robes','Robe', 'Robes', 'Kimono','Kimonos');
$intimatesTypes=array('Women > Clothing > Intimates',$intimatesBrasAlias,$intimatesCamisolesAlias,$intimatesChemisesAlias,$intimatesHoiseryAlias,$intimatesSleepwearAlias,$intimatesPantiesAlias,$intimatesRobesAlias);

/***********************************Swimwear*****/

$swimwearDic='Bikinis/Bottoms/One-Piece/Cover Up';
/***************bikinis tops******/
$swimwearBikinisTopsKw=array('top', 'tops', 'bra', 'bralette');
$swimwearBikinisTopsTwoWords=array('bikini', 'bikinis', 'tankini', 'swim', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-', 'swimsuit', 'swim-');
$swimwearBikinisTopsAlias=array('Women > Clothing > Swimwear > Bikinis > Tops',true,$swimwearBikinisTopsKw,$swimwearBikinisTopsTwoWords);
$swimwearBikinisTopsEx=array('Women > Clothing > Swimwear > Bikinis',true,$swimwearBikinisTopsKw,$swimwearBikinisTopsTwoWords);

/***************bikinis bottoms******/
$swimwearBikinisBottomKw=array('bottom', 'bottoms', 'brief', 'briefs', 'thong', 'thongs', 'pant', 'pants', 'shorts', 'short','panty','panties');
$swimwearBikinisBottomTwoWords=array('bikini', 'bikinis', 'swim', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-', 'swimsuit', 'swim-');
$swimwearBikinisBottomAlias=array('Women > Clothing > Swimwear > Bikinis > Bottoms',true,$swimwearBikinisBottomKw,$swimwearBikinisBottomTwoWords);
$swimwearBikinisBottomEx=array('Women > Clothing > Swimwear > Bikinis',true,$swimwearBikinisBottomKw,$swimwearBikinisBottomTwoWords,);

/***************bikinisEx******/
$swimwearBikinisExKw=array('swim', 'swimsuit', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-', 'swim-');
$swimwearBikinisExTwoWords=array('two-piece', 'two piece', '2 piece', '2-piece');
$swimwearBikinisEx=array('Women > Clothing > Swimwear > Bikinis',true,$swimwearBikinisExKw,$swimwearBikinisExTwoWords,'Bikini', 'Bikinis', 'Tankini');

/***************bikinisSum******/
$swimwearBikinisAlias=array('Women > Clothing > Swimwear > Bikinis',$swimwearBikinisTopsAlias,$swimwearBikinisBottomAlias,'Bikini', 'Bikinis', 'Tankini');


/***************one piece******/
$swimwearOnePieceKw=array('one-piece', 'onepiece', 'one piece');
$swimwearOnePieceTwoWords=array('swim', 'swimsuit', 'swim-', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-');
$swimwearOnePieceAlias=array('Women > Clothing > Swimwear > One-Piece',true,$swimwearOnePieceKw,$swimwearOnePieceTwoWords,'Swimdress', 'Swimsuit', 'Monokini', 'Maillot','suit','suits','Rash Guard', 'Wetsuit', 'Wetsuits');

$swimwearCoverUpAlias=array('Women > Clothing > Swimwear > Cover Up','Kaftan', 'Kaftans', 'Cover-Up', 'Cover Up', 'Coverup', 'Caftan', 'Caftans', 'Sarong', 'Sarongs');
$swimwearTypes=array('Women > Clothing > Swimwear',$swimwearBikinisTopsEx,$swimwearBikinisBottomEx,$swimwearOnePieceAlias,$swimwearCoverUpAlias,$swimwearBikinisEx,'Swim', 'Swimwear', 'Bathing Suit', 'Bathingsuit', 'Bathing-', 'swimsuit', 'swim-');

/*******Activewear***************************************/
$activewearTypes=array('Women > Clothing > Activewear','Activewear', 'Active', 'Athletic', 'Athlete', 'Hiking', 'Camping', 'Sports', 'Sporty', 'Basketball', 'Football', 'Soccer', 'Outdoors', 'Run', 'Running', 'Runner', 'Runners', 'Jog', 'Jogging', 'Jogger', 'Joggers', 'Walking', 'Walkers', 'Cycling', 'Cyclist', 'Snow', 'Ski', 'Snow-', 'Ski-', 'Surf', 'Surfing', 'Swimming', 'Snowboard', 'Snowboarding', 'Skiing', 'Sailing', 'Train', 'Training', 'Hiking', 'Hike', 'Windbreaker', 'Leggings', 'Legging', 'Sweatpant', 'Sweatpants', 'Workout', 'Workouts', 'Work-out', 'Yoga', 'Tennis', 'Golf', 'Golfing', 'Golfer', 'Boxing', 'Boxer', 'Racerback', 'Pro', 'Techfit', 'Under Armour', 'Track', 'Ballet', 'Reflective','Athleisure');

/*********Bridal*******************************************/
$bridalTypes=array('Women > Clothing > Bridal','Bridal', 'Bride', 'Brides', 'Bridesmaid', 'Bridesmaids', 'Wedding', 'Engagement');

/*********costumes***************************************/
$costumesTypes=array('Women > Clothing > Costumes','Costume', 'Costumes', 'Halloween', 'Cos-play', 'Cos Play', 'Mask', 'Masquerade', 'Anime', 'Hat', 'Hats', 'Wig', 'Wigs', 'Cowgirl', 'Costume-');

/*********petite***************************************/
$petitesTypes=array('Women > Clothing > Petite','Petite', 'Petites', 'Petite-size');

/*********Plus****************************************/
$plusTypes=array('Women > Clothing > Plus','Plus', 'Plus-', 'Pluses');

/*********suits****************************************/
$suitsTypes=array('Women > Clothing > Suits','Suit', 'Suits', 'Suiting', 'Tracksuit', 'Tracksuits');

/*********shoes***************************************/

/*******athletic**********/
$shoesAthleticKw=array('shoe','shoes','sneaker','sneakers');

$shoesAthleticTwoWords=array('Activewear', 'Active', 'Athletic', 'Athlete', 'Hiking', 'Camping', 'Sport', 'Sports', 'Sporty', 'Basketball', 'Football', 'Soccer', 'Outdoors', 'Run', 'Running', 'Runner', 'Runners', 'Jog', 'Jogging', 'Jogger', 'Joggers', 'Walking', 'Walkers', 'Cycling', 'Cyclist', 'Snow', 'Ski', 'Snow-', 'Ski-', '-Ski', 'Surf', 'Surfing', 'Swimming', 'Snowboard', 'Snowboarding', 'Skiing', 'Sailing', 'Train', 'Training', 'Hike', 'Workout', 'Workouts', 'Work-out', 'Performance', 'Yoga', 'Tennis', 'Golf', 'Golfing', 'Golfer', 'Boxing', 'Boxer', 'Under Armour', 'Track', 'Cleated', 'Reflective');
$shoesAthleticAlias=array('Women > Shoes > Athletic',true,$shoesAthleticKw,$shoesAthleticTwoWords,'cleats');

$shoesBootsAlias=array('Women > Shoes > Boots','Boot', 'Boots', 'Bootie', 'Booties', 'Rainboot', 'Rainboots', 'Wellie', 'Wellies');
$shoesMulesAlias=array('Women > Shoes > Mules & Clogs','Mule', 'Mules', 'Clog', 'Clogs', 'Jelly', 'Jellies');

/****flats**************/
$shoesFlatsKw=array('sandal','sandals');
$shoesFlatsTwoWords=array('flat', 'beach');
$shoesFlatsAlias=array('Women > Shoes > Flats',true,$shoesFlatsKw,$shoesFlatsTwoWords,'Flat', 'Flats', 'Flatform', 'Flatforms', 'Espadrille', 'Espadrilles', 'Slip on', 'Slip Ons', 'Ballerinas','slip-on','slip-ons','slipper','slippers','Flip Flop', 'Flip Flops', 'Flip-Flop', 'Flip-Flops','creeper','creepers','Skimmers', 'Skimmer');
$shoesFlatsKwEx=array('Shoe', 'Shoes', 'Flat', 'Flats');
$shoesFlatsTwoWordsEx=array('ballerina', 'boating', 'boat');
$shoesFlatsExAlias=array('Women > Shoes > Flats',true,$shoesFlatsKwEx,$shoesFlatsTwoWordsEx);

/******Loafer**********/
$shoesLoafersKw=array('shoe','shoes');
$shoesLoafersTwoWords=array('boating', 'boat');
$shoesLoafersAlias=array('Women > Shoes > Loafers & Moccasins',true,$shoesLoafersKw,$shoesLoafersTwoWords,'Loafers', 'Loafer', 'Mocassins', 'Mocassin','Slip on', 'Slip Ons', 'Slip-on', 'Slip-ons','slipper','slippers');

/*******oxfords********/
$shoesOxfordsKw=array('shoe','shoes','Oxford', 'Oxfords','Brogue', 'Brogues');
$shoesOxfordsTwoWords=array('wing tip', 'wing-tip', 'wingtip','Derby', 'Derbys', 'Derbies');
$shoesOxfordsAlias=array('Women > Shoes > Oxfords',true,$shoesOxfordsKw,$shoesOxfordsTwoWords,'Oxford', 'Oxfords', 'Dress-shoe', 'Dress-shoes', 'Dress Shoe', 'Dress Shoes', 'Brogue', 'Brogues');

/*******heel**********/
$shoesPumpsKw=array('shoe', 'shoes', 'heel', 'heels', 'pump', 'pumps', 'high-heel', 'high-heels', 'heeled');
$shoesPumpTwoWords=array('court');
$shoesPumpsAlias=array('Women > Shoes > Heels',true,$shoesPumpsKw,$shoesPumpTwoWords,'Pump', 'Pumps', 'Heel', 'Heels', 'High-heel', 'High-heels', 'Courts','heeled','Stiletto','Stilettos');

$shoesSandalsAlias=array('Women > Shoes > Sandals','Sandal', 'Sandals', 'Gladiator', 'Gladiators', 'Flip Flop', 'Flip Flops','flip-flop','flip-flops','slide','slides','slider');
$shoesWedgesAlian=array('Women > Shoes > Wedges','wedges','wedge');
$shoesPlatformsAlian=array('Women > Shoes > Platforms','platform','platforms','creeper','creepers');
/*****sneakers*********/
$shoesSneakersTwoWords=array('Casual', 'Tennis');
$shoesSneakersAlias=array('Women > Shoes > Sneakers',true,$shoesLoafersKw,$shoesSneakersTwoWords,'Sneaker', 'Sneakers','trainers','trainer');
$shoesTypes=array('Women > Shoes',$shoesAthleticAlias,$shoesBootsAlias,$shoesMulesAlias,$shoesFlatsAlias,$shoesFlatsExAlias,$shoesLoafersAlias,$shoesOxfordsAlias,$shoesPumpsAlias,$shoesSandalsAlias,$shoesWedgesAlian,$shoesPlatformsAlian,$shoesSneakersAlias,'shoes','shoe');

/*********accessories*******************************/

$astBeltsAlias=array('Women > Accessories > Belts','belt','waistbelt','belts','harness','fanny pack', 'fanny packs');

/*******eyewear*************/
$astEyewearSunglassAlias=array('Women > Accessories > Eyewear > Sunglasses','Sunnies', 'Sunglass', 'Sunglasses', 'Aviator', 'Aviators', 'Cat Eye');
$astEyewearEyeglassAlias=array('Women > Accessories > Eyewear > Eyeglasses','Eye-wear', 'Eye-glass','Eye-glasses','Eyeglasses', 'Eyeglass', 'Readers', 'Glasses');
$astEyewearAlias=array('Women > Accessories > Eyewear',$astEyewearSunglassAlias,$astEyewearEyeglassAlias,'eyewear');
$astEyewearAliasEx=array('Women > Accessories > Eyewear','Eyewear','Sunnies', 'Sunglass', 'Sunglasses', 'Aviator', 'Aviators', 'Cat Eye','Eye-wear', 'Eye-glass','Eye-glasses','Eyeglasses', 'Eyeglass', 'Readers', 'Glasses');

/****cap*******************/
$astHatsKw=array('hat', 'hats', 'millinery', 'beret', 'baseballcap', 'beanie', 'beanies', 'fedora', 'fedoras', 'snapback', 'visor', 'turban', 'baseball');
$astHatsTwoWords=array('Cap', 'Caps', '-cap');
$astHatsAlias=array('Women > Accessories > Hats',true,$astHatsKw,$astHatsTwoWords,'Hat', 'Hats', 'Millinery','Beret', 'Baseballcap', 'Beanie', 'Beanies', 'Fedora', 'Fedoras', 'Snapback', 'Visor', 'Turban','Fascinator');

$astGlovesAlias=array('Women > Accessories > Gloves','Glove', 'Gloves', 'Mittens', 'Mitten');

/********Hair*************/
$astHairKw=array('Hairbow', 'Hairbows', 'Hair-bow', 'Hairband', 'Hairbands', 'Headband', 'Headbands', 'Head Band', 'Head Bands', 'Head-Band', 'Head-Bands', 'Tiara', 'Tiaras', 'Crown', 'Crowns', 'Ponytail', 'Comb', 'Combs', 'Barrette', 'Headwrap', 'Head-Wrap', 'Head Wrap', 'Headpiece','Hairstyle', 'Turban', 'Bobby Pins', 'Bobby Pin');
$astHairTwoWords=array('hair');
$astHairAlias=array('Women > Accessories > Hair',true,$astHairKw,$astHairTwoWords, 'Hairbow', 'Hairbows', 'Hair-bow', 'Hairband', 'Hairbands', 'Headband', 'Headbands', 'Head Band', 'Head Bands', 'Head-Band', 'Head-Bands', 'Tiara', 'Tiaras', 'Crown', 'Crowns', 'Ponytail', 'Comb', 'Combs', 'Barrette', 'Headwrap', 'Head-Wrap', 'Head Wrap', 'Headpiece','Head piece', 'Hairstyle', 'Turban', 'Bobby Pins', 'Bobby Pin');

$astScarvesAlias=array('Women > Accessories > Scarves','Scarf', 'Scarves', 'Stole', 'Snood', 'Bandana', 'Bandanas', 'Shawl','shawls','Neckerchief', 'Neckerchiefs');
$astTechAlias=array('Women > Accessories > Tech','headphones', 'headphone', 'phone', 'phones', '-phone', 'cellphone', 'headset', 'bluetooth', 'laptop', 'computer', 'iwatch', 'iphone', 'iphone4', 'iphone5', 'iphone6', 'galaxy', 'samsung', 'apple', 'ios', 'android', 'iPhone®', 'earbuds', 'earbud', 'hi-tech', 'earphones', 'earphone', 'tablet', 'Ipad', 'camera','smartphone');
$astUmbrellaAlias=array('Women > Accessories > Umbrellas','umbrella','umbrellas');

/**********bags****************/
$astBagsBackpacksAlias=array('Women > Accessories > Bags > Backpacks','Backpack', 'Backpacks', 'Back-pack', 'knapsack', 'back pack','rucksack');
$astBagsWalletsAlias=array('Women > Accessories > Bags > Wallets','wallet', 'wallet-', 'organizer', 'coinpurse', 'coin-purse', 'coin purse', 'wallet-on-chain', 'wallet-on-a-chain', 'wallet-on-a-strap', 'wallet-on-strap', 'Checkbook', 'Cardholder', 'Travel Pouch', 'Passport','card holder');

/****luggage********/
$astBagsLuggageKw=array('bag', 'bags', 'handbag', 'handbags', 'backpack', 'backpacks', 'tote', 'totes','pouch','purse','case','cases');
$astBagsLuggageTwoWords=array('rolling','travel');
$astBagsLuggageAlias=array('Women > Accessories > Bags > Luggage',true,$astBagsLuggageKw,$astBagsLuggageTwoWords,'Luggage', 'Luggages', 'Carry-on', 'Carry on', 'duffle', 'Suitcase', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Weekender', 'Weekenders', 'Carryall', 'holdall', 'Packing Case', 'Trunk', 'Trunks', 'Spinner', 'Spinners', 'Overnighter', 'Rollaboard');

/*******Clutch*******/
$astBagsHandbagsClutchKw=array('bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses', 'clutch', 'clutches','leather');
$astBagsHandbagsClutchTwoWords=array('envelope','pouch');
$astBagsHandbagsClutchAlias=array('Women > Accessories > Bags > Handbags > Clutches',true,$astBagsHandbagsClutchKw,$astBagsHandbagsClutchTwoWords,'Clutch', 'Clutches', 'Miniaudiere', 'Pochette', 'Wristlet', 'Baguette');

/****shoulder bag********/
$astBagsHandbagsShoulderAliasKw=array('bag', 'bags', 'handbag', 'handbags');
$astBagsHandbagsShoulderAliasTwoWords=array('shoulder', 'saddle','bucket');
$astBagsHandbagsShoulderAlias=array('Women > Accessories > Bags > Handbags > Shoulder Bags',true,$astBagsHandbagsShoulderAliasKw,$astBagsHandbagsShoulderAliasTwoWords,'Messenger', 'Messengers', 'Shoulder Strap', 'Shoulderbag', 'Shoulderbags','Bauletto','Bauletti');

/****duffles******/
$astBagsHandbagsDufflesAliasKw=array('bag', 'bags', 'handbag', 'handbags');
$astBagsHandbagsDufflesAliasTwoWords=array('Beach', 'Gym');
$astBagsHandbagsDufflesAlias=array('Women > Accessories > Bags > Handbags > Duffles & Totes',true,$astBagsHandbagsDufflesAliasKw,$astBagsHandbagsDufflesAliasTwoWords,'Tote', 'Totes', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Carryall', 'Holdall', 'Shopper', 'Shoppers');

$astBagsHandbagsSatchelAlias=array('Women > Accessories > Bags > Handbags > Satchels','Satchel', 'Satchels');
$astBagsHandbagsCrossAlias=array("Women > Accessories > Bags > Handbags > Cross Body's",'Crossbody', 'Crossbodies', 'Cross-body', 'Cross body', 'Across Body', 'Crossbag', 'Across-body','-crossbody');
$astBagsHandbagsHobosAlias=array('Women > Accessories > Bags > Handbags > Hobos','Hobo', 'Hobos');
$astBagsHandbagsTypes=array('Women > Accessories > Bags > Handbags',$astBagsHandbagsClutchAlias,$astBagsHandbagsShoulderAlias,$astBagsHandbagsDufflesAlias,$astBagsHandbagsSatchelAlias,$astBagsHandbagsCrossAlias,$astBagsHandbagsHobosAlias,'handbag', 'handbags','hand-bag', 'hand bag', 'hand bags', 'purse', 'purses','bag','bags');



$astBagsHandbagsExTypes1=array('Women > Accessories > Bags > Handbags','handbag', 'handbags','bag','bags', 'hand-bag', 'hand bag', 'hand bags', 'purse','purses','Clutch', 'Clutches', 'Miniaudiere', 'Pochette', 'Wristlet', 'Baguette','Messenger', 'Messengers','Shoulder Strap', 'Shoulderbag', 'Shoulderbags','Bauletto','Bauletti','Tote','purse','Totes', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Carryall', 'Holdall', 'Shopper', 'Shoppers','Satchel', 'Satchels','Crossbody','-crossbody', 'Crossbodies', 'Cross-body', 'Cross body', 'Across Body', 'Crossbag', 'Across-body','Hobo', 'Hobos');

$astBagsHandbagsExTypes2Kw=array('bag', 'bags', 'handbag', 'handbags');
$astBagsHandbagsExTypes2TwoWords=array('shoulder', 'saddle','bucket','Beach', 'Gym');
$astBagsHandbagsExTypes2=array('Women > Accessories > Bags > Handbags',true,$astBagsHandbagsExTypes2Kw,$astBagsHandbagsExTypes2TwoWords);

$astBagsHandbagsExTypes3Kw=array('bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses', 'clutch', 'clutches','leather');
$astBagsHandbagsExTypes3TwoWords=array('Envelope', 'Pouch');
$astBagsHandbagsExTypes3=array('Women > Accessories > Bags > Handbags',true,$astBagsHandbagsExTypes3Kw,$astBagsHandbagsExTypes3TwoWords);
$astBagsTypes=array('Women > Accessories > Bags',$astBagsBackpacksAlias,$astBagsWalletsAlias,$astBagsLuggageAlias,$astBagsHandbagsExTypes1,$astBagsHandbagsExTypes2,$astBagsHandbagsExTypes3);


$astBagsTypesEx1=array('Women > Accessories > Bags','Bag', 'Bags','Backpack', 'Backpacks','rucksack', 'Back-pack', 'knapsack', 'back pack','wallet','wallet-', 'organizer', 'coinpurse', 'coin-purse', 'coin purse', 'wallet-on-chain', 'wallet-on-a-chain', 'wallet-on-a-strap','wallet-on-strap', 'Card holder', 'Checkbook', 'Cardholder', 'Travel Pouch', 'Passport','Luggage', 'Luggages', 'Carry-on', 'Carry on', 'duffle', 'Suitcase', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Weekender', 'Weekenders', 'Carryall', 'holdall', 'Packing Case', 'Trunk', 'Trunks', 'Spinner', 'Spinners', 'Overnighter', 'Rollaboard','handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses','Clutch', 'Clutches', 'Miniaudiere', 'Pochette', 'Wristlet', 'Baguette','Messenger', 'Messengers','Shoulder Strap', 'Shoulderbag', 'Shoulderbags','Bauletto','Bauletti','Tote','purse', 'Totes', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Carryall', 'Holdall', 'Shopper','Shoppers','Satchel', 'Satchels','Crossbody','-crossbody', 'Crossbodies', 'Cross-body', 'Cross body', 'Across Body', 'Crossbag', 'Across-body','Hobo', 'Hobos');
$astBagsTypesEx2Kw=array('bag', 'bags', 'handbag', 'handbags');

$astBagsTypesEx2TwoWords=array('shoulder', 'saddle','bucket','Beach', 'Gym');
$astBagsTypesEx2=array('Women > Accessories > Bags',true,$astBagsTypesEx2Kw,$astBagsTypesEx2TwoWords);
$astBagsTypesEx4Kw=array('bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses', 'clutch', 'clutches','leather');
$astBagsTypesEx4TwoWords=array('Envelope', 'Pouch');
$astBagsTypesEx4=array('Women > Accessories > Bags',true,$astBagsTypesEx4Kw,$astBagsTypesEx4TwoWords);
$astBagsTypesEx3Kw=array('bag', 'bags', 'handbag', 'handbags', 'backpack', 'backpacks', 'tote', 'totes','case','cases','pouch', 'purse');
$astBagsTypesEx3TwoWords=array('rolling','travel');
$astBagsTypesEx3=array('Women > Accessories > Bags',true,$astBagsTypesEx3Kw,$astBagsTypesEx3TwoWords);

/*********Jewelry***************************/
$jewelryNecklacesKw=array('jewelry');
$jewelryNecklacesTwoWords=array('Collar');
$jewelryNecklacesAlias=array('Women > Accessories > Jewelry > Necklaces',true,$jewelryNecklacesKw,$jewelryNecklacesTwoWords,'Necklace', 'Necklaces', 'Choker', 'Chokers', 'Locket');

$jewelryEarringsAlias=array('Women > Accessories > Jewelry > Earrings','Earrings', 'Earring', 'Ear');

/**********bracelets*****/
$jewelryBraceletsKw=array('jewelry','bracelet','bracelets','bangles','bangle','brass','silver','gold','coil');
$jewelryBraceletsTwoWords=array('cuff','cuffs');
$jewelryBraceletsAlias=array('Women > Accessories > Jewelry > Bracelets & Bangles',true,$jewelryBraceletsKw,$jewelryBraceletsTwoWords,'Bracelet', 'Bracelets', 'Bangle', 'Bangles','wrist strap','wrist-strap','wriststrap','Armband', 'Arm Band', 'Armbands', 'Arm Bands', 'Arm-band', 'Arm-bands');

$jewelryBroochesAlias=array('Women > Accessories > Jewelry > Brooches','Brooches', 'Brooch');

/*********charm*********/
$jewelryCharmsKw=array('bag','bags','handbags','handbag','hand-','brass','silver','gold');
$jewelryCharmsTwoWords=array('charm','charms');
$jewelryCharmsAlias=array('Women > Accessories > Jewelry > Charms & Pendants',true,$jewelryCharmsKw,$jewelryCharmsTwoWords,'Pin', 'Pins', 'Pendant', 'Pendants', 'Badge', 'Badges', '-pin', '-pins', 'pin-','Keychain', 'Keychains', 'Key-Chain', 'Key-Chains', 'Key Chain', 'Key Chains');

$jewelryRingsAlias=array('Women > Accessories > Jewelry > Rings','Ring', 'Rings');


$jewelryWatchesAlias=array('Women > Accessories > Jewelry > Watches','Watch', 'Watches', 'Timepiece', 'Wristwatch', '-watch', 'Time Teller', 'Watch-');
$jewelryTypes=array('Women > Accessories > Jewelry',$jewelryNecklacesAlias,$jewelryEarringsAlias,$jewelryBraceletsAlias,$jewelryBroochesAlias,$jewelryCharmsAlias,$jewelryRingsAlias,$jewelryWatchesAlias,'Jewelry', 'Jewels');

$jewelryTypesEx=array('Women > Accessories > Jewelry','Jewelry', 'Jewels','Necklace', 'Necklaces', 'Choker', 'Chokers', 'Locket','Earrings', 'Earring', 'Ear','Bracelet', 'Bracelets', 'Bangle', 'Bangles','wrist strap','wrist-strap','wriststrap','Armband', 'Arm Band', 'Armbands', 'Arm Bands', 'Arm-band', 'Arm-bands','Brooches', 'Brooch', 'Pin', 'Pins', 'Pendant', 'Pendants','Keychain', 'Keychains', 'Key-Chain', 'Key-Chains', 'Key Chain', 'Key Chains' ,'Badge', 'Badges', '-pin', '-pins', 'pin-','Ring', 'Rings','Watch', 'Watches', 'Timepiece', 'Wristwatch', '-watch', 'Time Teller', 'Watch-');
$jewelryTypesEx2Kw=array('bag','bags','handbag','hand-','handbags','brass','silver','gold');
$jewelryTypesEx2TwoWords=array('charm','charms');
$jewelryTypesEx2=array('Women > Accessories > Jewelry',true,$jewelryTypesEx2Kw,$jewelryTypesEx2TwoWords);

$jewelryTypesEx3Kw=array('jewelry', 'Bracelet', 'Bracelets', 'Bangle', 'Bangles', 'brass', 'gold', 'silver', 'coil');
$jewelryTypesEx3TwoWords=array('Cuff', 'Cuffs');
$jewelryTypesEx3=array('Women > Accessories > Jewelry',true,$jewelryTypesEx3Kw,$jewelryTypesEx3TwoWords);
$accessoriesTypes=array('Women > Accessories',$astBeltsAlias,$astEyewearAliasEx,$astHatsAlias,$astGlovesAlias,$astHairAlias,$astScarvesAlias,$astTechAlias,$astUmbrellaAlias,$astBagsTypesEx1,$astBagsTypesEx2,$astBagsTypesEx3,$astBagsTypesEx4,$jewelryTypesEx,$jewelryTypesEx2,$jewelryTypesEx3);

/********beauty***************************/
$beautyMakeupKw=array('stick', 'sticks', 'balm', 'balms', 'balmer', 'color', 'colour', 'gloss', 'creme', 'stain','Lacquer','Laque');
$beautyMakeupTwoWords=array('Lip', 'Lips');
$beautyMakeupAlias=array('Women > Beauty > Makeup',true,$beautyMakeupKw,$beautyMakeupTwoWords,'Makeup', 'Make-up', 'Make up', 'Mascara', 'Mascaras', 'Lipstick', 'Lipsticks', 'Lip-','Lipgloss', 'Lipglass', 'Lipshine', 'Lipbalm', 'Lipbalmer', 'Powder', 'Concealer', 'Concealers', 'Brush', 'Brushes', 'Eye Color', 'Eye Colour', 'Eye Shadow', 'Eye Shadows', 'Eye Brow', 'Eye Brows', 'Eyebrow', 'Eyebrows', 'Eye-Brow', 'Eye-Brows', 'Eye-shadow', 'Eyeshadow', 'Eyepencil', 'Eye-pencil', 'Eye-pencils', 'Eye Pencil', 'Eyeliner', 'Eyeliners', 'Eye-liner', 'Eye-liners', 'Eye Liner', 'Eye Liners', 'Palette', 'Multi-palette', 'Powder', 'Lash', 'Lashes', 'Eyelashes', 'Eyelash', 'Eye-lashes', 'Eye-lash', 'Blush', 'Blushes', 'Blusher', 'Bronzer', 'Bronzers', 'Bronzing', 'Foundation', 'Primer', 'Highlight', 'Highlighter', 'Balm');

/****skincare***********/
$beautySkincareKw=array('cream', 'creams', 'oil', 'oils', 'care', 'pad', 'pads');
$beautySkincareTwoWords=array('skin', 'face');
$beautySkincareAlias=array('Women > Beauty > Skincare',true,$beautySkincareKw,$beautySkincareTwoWords,'Skin-', 'Moisturizer', 'Moisturising', 'Moisturizing', 'Moisturises', 'Moisturizes', 'SPF', 'Sunscreen', 'Skin Care', 'Cleansing', 'Wipes', 'Facial', 'Masque', 'Serum', 'Remover', 'Mud Mask', 'Exfoliating', 'Exfoliator', 'Hydration', 'Hydrating','skincare','Soap', 'Soaps','Eye Cream', 'Microderm', 'Lotion');

$beautyFragAlias=array('Women > Beauty > Fragrances','fragrance', 'fragrances', 'perfume', 'perfum',"Fragrance's", 'Perfumes', 'Parfum', 'Parfums', 'Parfume', 'Parfumes', 'Toilette', 'Perfumery');

/*******beauty bath**********/
$beautyBathKw=array('cream', 'creams', 'oil', 'oils', 'mist', 'lotion', 'lotions', 'scrub', 'scrubs', 'gel', 'gels', 'cap', 'polish');
$beautyBathTwoWords=array('Body', 'Shower', 'Shave', 'Foot');
$beautyBathAlias=array('Women > Beauty > Bath & Body',true,$beautyBathKw,$beautyBathTwoWords,'Bath', 'Bathtub', 'Bath-', 'Shampoo', 'Shampoos', 'Conditioner', 'Soap', 'Soaps Wipe', 'Wipes', 'Deodorant', 'Antiperspirant', 'Shower Cap', 'Sanitizer', 'Body Wash', 'Foot Wash');

/*******beauty Hair***********/
$beautyHairKw=array('Weave', 'Hairbrush', 'Hairbrushes', 'Haircare', 'Haircomb', 'Haircombs', 'Hairspray', 'Hairsprays', 'Hairstyler', 'Hairstylers', 'Hair-', 'Extensions', 'Shampoo', 'Shampoos', 'Conditioner', 'Curl', 'Curling', 'Curly', 'Curler', 'Wig', 'Wigs', 'Comb', 'Combs', 'Flat Iron', 'Styling Iron', 'Ponytail', 'Pomade', 'Mousse');
$beautyHairTwoWords=array('Hair','ponytail');
$beautyHairAlias=array('Women > Beauty > Hair',true,$beautyHairKw,$beautyHairTwoWords, 'Hairbrush', 'Hairbrushes', 'Haircare', 'Haircomb', 'Haircombs', 'Hairspray', 'Hairsprays', 'Hairstyler', 'Hairstylers', 'Hair-', 'Extensions', 'Shampoo', 'Shampoos', 'Conditioner', 'Curling', 'Curly', 'Curler', 'Wig', 'Wigs', 'Comb', 'Combs', 'Flat Iron', 'Styling Iron', 'Ponytail', 'Pomade', 'Mousse');

/*********beaduty nail********/
$beautyNailsKw=array('Nails', 'Nail', 'Nail-', 'Nails-', '-Nail', '-Nails');
$beautyNailsTwoWords=array('Lacquer', 'Laque');
$beautyNailsAlias=array('Women > Beauty > Nails',true,$beautyNailsKw,$beautyNailsTwoWords,'Nails', 'Nail', 'Nail-', 'Nails-', '-Nail', '-Nails', 'Manicure');

/*******beauty sets********/
$beautySetsKw=array('set', 'sets', 'kit', 'kits');
$beautySetsTwoWords=array('Beauty', 'Skin', 'Skincare', 'Makeup', 'Body', 'Bath', 'Lip', 'Lips', 'Shampoo', 'Shampoos', 'Nail', 'Nails', 'Fragrance', 'Fragrances', 'Perfume', 'Perfumes', 'Parfum', 'Parfume', 'Complexion', 'Cleanser', 'Cleansing', 'Soap', 'Mascara', 'Grooming', 'Toilette','eye');
$beautySetsAlias=array('Women > Beauty > Sets & Kits',true,$beautySetsKw,$beautySetsTwoWords,'Gift Set', 'Gift Sets', 'Gift Box', 'Gift Kits', 'Gift Kit', 'Starter Kit', 'Spa Basket', 'Travel Kit');

/*******beauty bags********/
$beautyBagsKw=array('bag', 'bags', 'pouch', 'purse', 'case', 'cases', 'trunk', 'handbag', 'handbags', 'wristlet');
$beautyBagsTwoWords=array('Cosmetic', 'Cosmetics', 'Cosmetique', 'beauty', 'toiletry', 'Makeup', 'make-up', 'Make Up', 'wash', 'beach', 'travel', 'vanity', 'train', 'pencil', 'brush','powder');
$beautyBagsAlias=array('Women > Beauty > Bags & Cases',true,$beautyBagsKw,$beautyBagsTwoWords,'Circle Pouch', 'Traincase', 'Washbag');
$beautyTypes=array('Women > Beauty',$beautyMakeupAlias,$beautySkincareAlias,$beautyFragAlias,$beautyBathAlias,$beautyHairAlias,$beautyNailsAlias,$beautySetsAlias,$beautyBagsAlias,'Beaute', 'Cosmetic','Cosmetics');



/*****main func******/

    
	$womenCat=array();
    $description=trim(strtolower($description));//preg_split('/\s+/', $description)
    
	
	$typeItems=array();
	$description=trimDescription($description);  
	$kws=explode(' ',$description); 
    foreach($kws as $kw){ 
		//$kw=str_replace($charList,'',$kw); echo $kw.'<br/>';
		$firstCats=confirmFirstCat($kw,$description); 
		foreach($firstCats as $firstCat){ 
			if($firstCat===0&&!in_array($dressTypes,$typeItems)){ 
				$typeItems[]=$dressTypes;
			}
			else if($firstCat===1&&!in_array($topTypes,$typeItems)){
				$typeItems[]=$topTypes;
			}
			else if($firstCat==2&&!in_array($outerwearTypes,$typeItems)){
				$typeItems[]=$outerwearTypes;
			}
			else if($firstCat==3&&!in_array($skirtsTypes,$typeItems)){
				$typeItems[]=$skirtsTypes;
			}
			else if($firstCat==4&&!in_array($shortsTypes,$typeItems)){
				$typeItems[]=$shortsTypes;
			}
			else if($firstCat==5&&!in_array($skortsTypes,$typeItems)){
				$typeItems[]=$skortsTypes;
			}
			else if($firstCat==6&&!in_array($jeansTypes,$typeItems)){
				$typeItems[]=$jeansTypes; 
			}
			else if($firstCat==7&&!in_array($pantsTypes,$typeItems)){
				$typeItems[]=$pantsTypes;
			}
			else if($firstCat==8&&!in_array($rompersTypes,$typeItems)){
				$typeItems[]=$rompersTypes;
			}
			else if($firstCat==9&&!in_array($overallsTypes,$typeItems)){
				$typeItems[]=$overallsTypes;
			}
			else if($firstCat==10&&!in_array($intimatesTypes,$typeItems)){
				$typeItems[]=$intimatesTypes;
			}
			else if($firstCat==11&&!in_array($swimwearTypes,$typeItems)){
				$typeItems[]=$swimwearTypes;
			}
			else if($firstCat==12&&!in_array($activewearTypes,$typeItems)){
				$typeItems[]=$activewearTypes;
			}
			else if($firstCat==13&&!in_array($bridalTypes,$typeItems)){
				$typeItems[]=$bridalTypes;
			}
			else if($firstCat==14&&!in_array($costumesTypes,$typeItems)){
				$typeItems[]=$costumesTypes;
			}
			else if($firstCat==15&&!in_array($petitesTypes,$typeItems)){
				$typeItems[]=$petitesTypes;
			}
			else if($firstCat==16&&!in_array($plusTypes,$typeItems)){
				$typeItems[]=$plusTypes;
			}
			else if($firstCat==17&&!in_array($suitsTypes,$typeItems)){
				$typeItems[]=$suitsTypes;
			}
			else if($firstCat==18&&!in_array($shoesTypes,$typeItems)){
				$typeItems[]=$shoesTypes;
			}
			else if($firstCat==19&&!in_array($accessoriesTypes,$typeItems)){
				$typeItems[]=$accessoriesTypes;
			}
			else if($firstCat==20&&!in_array($beautyTypes,$typeItems)){
				$typeItems[]=$beautyTypes;
			}
			
		}
		
	}
		$complicateCatArr=array('Women > Clothing > Swimwear > Bikinis'=>$swimwearBikinisAlias,'Women > Accessories > Eyewear'=>$astEyewearAlias,'Women > Accessories > Bags'=>$astBagsTypes,'Women > Accessories > Bags > Handbags'=>$astBagsHandbagsTypes,'Women > Accessories > Jewelry'=>$jewelryTypes);
		$womenCatRst=array();
		    foreach($typeItems as $exactItem){
				$womenCat=getCategoryHelperSimple($exactItem,$womenCat,$description); 
				// CAUTION: the following 'arrayCopy' may cause duplicates in $womenCatRst
				$womenCatRst=arrayCopy($womenCat,$womenCatRst);
			}
			$complicateCatFinal=array();
			foreach($complicateCatArr as $complicateCat=>$complicateCatList){
				if(in_array($complicateCat,$womenCat)){
					$complicateCatFinal[$complicateCat]=$complicateCatList;
				}
			}
			
			foreach($complicateCatFinal as $complicateCat=>$complicateCatList){ 
				
					$womenCat=getCategory($complicateCat,$complicateCatList,$womenCat,$description);
					$womenCatRst=arrayCopy($womenCat,$womenCatRst);
					if(in_array('Women > Accessories > Bags > Handbags',$womenCat)){ 
						$complicateCat='Women > Accessories > Bags > Handbags';
						$complicateCatList=$astBagsHandbagsTypes;
						$womenCat=getCategory($complicateCat,$complicateCatList,$womenCat,$description,true);
						$womenCatRst=arrayCopy($womenCat,$womenCatRst);
					}
					
				
				
			}
		//printArray($womenCatRst);die;
		$womenCatRst=rstReplace_new($womenCatRst);
    //print_r($womenCatRst);die;
	
	return (modifyDuplicate($womenCatRst,$description)); 
}
function rstReplace($rst){
	
	for($k=0;$k<count($rst);$k++){
		$tmpRst=str_replace('+',' > ',$rst[$k]); 
		for($m=0;$m<count($rst);$m++){ 
			$tmpRstEx=str_replace('+',' > ',$rst[$m]);
			if($m!==$k&&strpos($tmpRst,$tmpRstEx)!==false){
				array_splice($rst,$m,1);
			}
		}
	}
	return $rst;
}
function rstReplace_new($rst){
	foreach($rst as $m=>$r){
		$tmpRst=str_replace('+',' > ',$r); 
		foreach($rst as $k=>$s){
			$tmpRstEx=str_replace('+',' > ',$s);
			if($m!==$k&&strpos($tmpRst,$tmpRstEx)!==false&&strlen($r)!==strlen($s)){ 
				unset($rst[$k]);
			}
		}
	}
	return $rst;
	
}
function arrayCopy($src,$dst){
	foreach($src as $s){
		$dst[]=$s;
	}
	return $dst;
}
function trimDescription($description){ 
	//preg_split('/\s+/', $description)
	$charList=array(",","/",")","(",".","!",":",";","?");
	$description=str_replace($charList,' ',$description);
	$sleeveList=array('long sleeve','long sleeves','short sleeve','short sleeves');
	if(checkBarrier($description,'long')&&checkBarrier($description,'sleeve')||checkBarrier($description,'long')&&checkBarrier($description,'sleeves')||checkBarrier($description,'short')&&checkBarrier($description,'sleeves')||checkBarrier($description,'short')&&checkBarrier($description,'sleeve')){
		$description=str_replace($sleeveList,'',$description);
	}
	if(strpos($description,'heel height')!==false||strpos($description,'platform height')!==false||strpos($description,'skirt')!==false&&strpos($description,'dress')!==false){
		$description=str_replace('heel height','',$description);
		$description=str_replace('platform height','',$description);
		$description=str_replace('skirt','',$description); 
	}
	
	$kws=explode(' ',$description);
	$res='';
	foreach($kws as $kw){
		if(strlen($kw)!==0){
			$res=$res.' '.$kw;
		}
	}
	return $res;
}

function getCategory($complicateCat,$complicateCatList,$womenCat,$description,$handbagFlag=false){
	//echo 1;print_r($womenCat);
	$catSubCategoryList=array('Women > Clothing > Swimwear > Bikinis'=>array('Women > Clothing > Swimwear > Bikinis > Bottoms','Women > Clothing > Swimwear > Bikinis > Tops'),'Women > Accessories > Eyewear'=>array('Women > Accessories > Eyewear > Sunglasses','Women > Accessories > Eyewear > Eyeglasses'),'Women > Accessories > Bags'=>array('Women > Accessories > Bags > Backpacks','Women > Accessories > Bags > Wallets','Women > Accessories > Bags > Luggage','Women > Accessories > Bags > Handbags'),'Women > Accessories > Bags > Handbags'=>array('Women > Accessories > Bags > Handbags > Clutches','Women > Accessories > Bags > Handbags > Shoulder Bags','Women > Accessories > Bags > Handbags > Duffles & Totes','Women > Accessories > Bags > Handbags > Satchels',"Women > Accessories > Bags > Handbags > Cross Body's",'Women > Accessories > Bags > Handbags > Hobos'),'Women > Accessories > Jewelry'=>array('Women > Accessories > Jewelry > Necklaces','Women > Accessories > Jewelry > Earrings','Women > Accessories > Jewelry > Bracelets & Bangles','Women > Accessories > Jewelry > Brooches','Women > Accessories > Jewelry > Charms & Pendants','Women > Accessories > Jewelry > Rings','Women > Accessories > Jewelry > Watches'));
	
	
	$masterCategory=$complicateCat;
	$womenCatTmp=array();
	$womenCatTmp=getCategoryHelperSimple($complicateCatList,$womenCat,$description); //echo 2;print_r($womenCatTmp);
	$subCategoryList=$catSubCategoryList[$complicateCat];
	$womenCat=arrayReplace($womenCatTmp,$womenCat,$subCategoryList,$masterCategory);
	
	return $womenCat;
	
}

function arrayReplace($womenCatTmp,$womenCat,$subCategoryList,$masterCategory){
	$categoryFinal=array();
	$flag=false;
	foreach($subCategoryList as $category){
		if(in_array($category,$womenCatTmp)){
			$flag=true;
			$womenCat[]=$category;
		}
	}
	
	
	if($flag) {
		foreach($womenCat as $cat){
			if($cat!==$masterCategory){
				$categoryFinal[]=$cat;
			}
		}
	}
	else {
		$categoryFinal=$womenCat;
	}
	return $categoryFinal;
	
	
}
function arraySetElement($arr){
	$arrTmp=array();
	foreach($arr as $a){
		$arrTmp[]=$a;
	}
	return $arrTmp;
}
function findExactPos($str,$char){
    $j = 0;
    $arr = array();
    $count = substr_count($str, $char);
    for($i = 0; $i < $count; $i++){
        $j = strpos($str, $char, $j);
        $arr[] = $j;
        $j = $j+1;

    }
    return $arr;

}

	

function checkBarrier($description,$tmpSecondItem){
	//$adjWordsIndex=strpos($description,$tmpSecondItem);
	$arr=findExactPos($description,$tmpSecondItem); 
	$k=strlen($tmpSecondItem);
	$correctFlag=false;
	for($i=0;$i<count($arr);$i++){ 
		$adjWordsIndex=$arr[$i];
		$preSingle=substr($description,$adjWordsIndex-1,1);
		$nxtSingle=substr($description,$adjWordsIndex+$k,1); 
		if($adjWordsIndex!==0&&($adjWordsIndex+$k)!==strlen($description)){
			
			if(strpos($tmpSecondItem,'-')!==false){
				if($preSingle!=' '&&$nxtSingle!=' '){ 
					continue;
				}
				
			}else{
				if($preSingle!=' '||$nxtSingle!=' '){
					if($preSingle=='-'||$nxtSingle=='-'){
						
					}else {
						continue;
					}
				}
			}
		}
		if($adjWordsIndex==0){ 
			if($nxtSingle!==' '){
				if($nxtSingle==false&&($adjWordsIndex+$k)==strlen($description)||strpos($tmpSecondItem,'-')!==false){
					
				}
				else {continue;}
					
			}
		}
		if(($adjWordsIndex+$k)==strlen($description)){  
			if(strpos($tmpSecondItem,'-')===false){
				if($preSingle!==' '&&$preSingle!=='-'){ 
					if($adjWordsIndex!==0)
						continue;
				}
			}
		}
		$correctFlag=true;
		break;
	}
	if($correctFlag){
		return true;
	}
	else {
		return false;
	}
}

function getCategoryHelperSimple($exactItem,$womenCat,$description){ 
	$jewelryCharmsKw=array('bag','bags','handbags','handbag','hand-');
	$jewelryCharmsTwoWords=array('charm','charms');
	$jewelryCharmsAlias=array('Women > Accessories > Jewelry > Charms & Pendants',true,$jewelryCharmsKw,$jewelryCharmsTwoWords,'Pin', 'Pins', 'Pendant', 'Pendants', 'Badge', 'Badges', '-pin', '-pins', 'pin-');
	$findCat=false;
	$oneKeyFlag=false;
	foreach($exactItem as $secondItems){
	    
		if(is_array($secondItems)){
			if($secondItems===$jewelryCharmsAlias){ 
				$prePos=strpos($description,'hand-');
				$nxtPos=strpos($description,'charm');
				if($prePos!==false&&$nxtPos!==false&&($nxtPos-$prePos)==1){
					$womenCat[]=$secondItems[0]; 
				}
				
			}
			for($i=1;$i<count($secondItems);$i++){ //Traversal of dressdaytypes	
				//$findCat=false;
				if($secondItems[1]===true&&is_array($secondItems[3])&&$i<=3){
					
					foreach($secondItems[3] as $adjWords){ //Traversal of adj.list	
						
						$adjWordsIndex=strpos($description,strtolower($adjWords));
						foreach($secondItems[2] as $suffix){ //Traversal of key word list
                                                        // if ($adjWords == 'Body')
                                                            // echo $adjWords . ' ' . $suffix . '<br>';
							$kwIndex=strpos($description,strtolower($suffix));
							if(!checkBarrier($description,strtolower($adjWords))||!checkBarrier($description,strtolower($suffix))){ 

								continue;
							}
							if($kwIndex!==false&&$adjWordsIndex!==FALSE){
								
								$findCat=true;//echo '<br/>'.$adjWords;die;	
								$womenCat[]=$secondItems[0]; 
						        
								break;	
							}
							
						}
                                                //if ($adjWords == 'Body')
                                                // echo $adjWords . '<br>'		;
						
					}
					if(!$findCat){
						$i+=2;
										//echo $i;
					}
				}else { //if(is_array($secondItems[$i])){print_r($secondItems[3]);echo $i.PHP_EOL;}
					
					$tmpSecondItem=strtolower($secondItems[$i]);
					$adjWordsIndex=strpos($description,$tmpSecondItem);
					if(!checkBarrier($description,$tmpSecondItem)){
						
						continue; 
					}	
					if($adjWordsIndex!==false){
										
						$womenCat[]=$secondItems[0];
					    $findCat=true;
						break;
					}
									
				} 
			}
		}else {
			$tmpSecondItem=strtolower($secondItems); 
			$adjWordsIndex=strpos($description,$tmpSecondItem);
			if(!checkBarrier($description,$tmpSecondItem)){
				
				continue;
			}		
			if($adjWordsIndex!==false&&!$findCat){ 
				$womenCat[]=$exactItem[0];
				$findCat=true;
				break;
			}
		}	
	}

	return $womenCat;
}

function matchMasterCategory($dressKw,$description,$catArr,$index,$keyword){
		$dressKw=strtolower($dressKw);
		if(strpos($dressKw,' ')!==false){ 
			if(strpos($description,$dressKw)!==false&&!in_array($index,$catArr)){ 
				array_push($catArr,$index);
			}
		}
		else {
			if($keyword==$dressKw&&!in_array($index,$catArr)){ 
				array_push($catArr,$index);
			}	
		}
		return $catArr;
	
} 
function confirmFirstCat($keyword,$description){
	$keyword=strtolower($keyword);
	$dashWords=array('swim','bathing','snow','ski','costume','plus','eye','cap','phone','wallet','pin','pins','watch','skin','bath','hair','nail','nails','hand','lip','crossbody');
    if(strpos($keyword,'-')!==false){
		$keywords=explode('-',$keyword);
		foreach($keywords as $key){
			foreach($dashWords as $word){
				if($key==$word){
					$keyword=$word;
				}
			}
		}
	} 
	$catArr=array();
	$dressDic=array('mini-dress','mini-dresses','dress','dresses','Gown', 'Gowns', 'Ballgown', 'Bedgown', 'Nightgown','above-dresses','midi-dresses','midi-dress','mid-dress','mid-dresses','floor-dress','sundress','shirtdress');
	$topDic=array('top','tops','shirt', 'shirts', 't-shirt','t-shirts', 'tee','tees',"t's",'ts','tshirt','tshirts','wife-beater','cami','undershirt','tank','tanks','blouse','blouses','button-up','button-down','tunic','tunics','Kurta','cardigan','cardigans','sweater','sweaters','pullover','pullovers','sweatshirts','jumpers','jumper','sweatshirt','hoodies','hoodie','hoody','sweat','dress-shirt','button','neck shell');
	$outwearDic=array('Coat', 'Coats', 'Parka', 'Parkas', 'Trench', 'Trenches', 'Trenchcoat', 'Trenchcoats','Anorak','Anoraks','Jacket', 'Jackets', 'Kimono', 'Kimonos', 'Blazer', 'Blazers','Topper','Bomber','Vest', 'Vests', 'Waistcoat', 'Waistcoats','Cape', 'Capes', 'Poncho', 'Ponchos', 'Cloak', 'Cloaks','waist coat');
	$skirtsDic=array('skirts','skirt','miniskirt','miniskirts','mini-skirt','mini-skirts','Midiskirt', 'Midiskirts', 'Midi-Skirt', 'Midi-Skirts','maxiskirt','knee-skirt','knee-skirts','mid-skirt','mid-skirts','calf-skirts','calf-skirt','full-skirt','full-skirts','maxi-skirt','maxi-skirts','mini-skirt','mini-skirts');
	$shortsDic=array('shorts','short');
	$skortsDic=array('skort','skorts');
	$jeansDic=array('jeans','jean','denim','jegging','jeggings');
	$pantsDic=array('Pant', 'Pants', 'Trousers', 'Trouser', 'Slack', 'Slacks', 'Chino', 'Chinos','legging','leggings','Jegging', 'Jeggings', 'Tregging', 'Treggings','Culotte', 'Culottes', 'Gaucho','Sweatpant', 'Sweatpants', 'Sweat-pant', 'Sweats', 'Trackpant', 'Trackpants');
	$rompersDic=array('rompers','jumpsuits','Romper', 'Jumpsuit', 'Playsuit', 'Playsuits','Bodysuits', 'Bodysuit', 'Body-suit', 'Body-suits', 'body suit', 'body suits','jump-suit','jump-suits','play-suit','play-suits','jump suit','jump suits','play suit','play suits');
	$overallsDic=array('overalls','Overall', 'Over-all', 'Over-alls','jumpsuit', 'jumpsuits', 'playsuit', 'playsuits','Dungarees', 'Dungaree','shortall','shortalls','short-all','short-alls');
	$intimatesDic=array('Bra', 'Bras', 'Sportsbra', 'Bralette', 'Bralettes','Cami', 'Camisole', 'Undershirt','Chemise', 'Chemises','Hosiery', 'Sock', 'Socks', 'Stocking', 'Stockings', 'Tights','Leg Warmers', 'Leg Warmer', 'Leg-Warmers', 'Leg-Warmer', 'Pantyhose','Sleepwear', 'Sleep', 'Pajama', 'Pajamas', 'PJ', 'Sleepshirt', 'Lounge Set', 'Nightgown', 'Nightshirt', 'Nightdress', 'Nightie','Panties', 'Pantie', 'Panty', 'Thong', 'Thongs','Hipsters', 'Boyshort', 'Boyshorts','Boy Short', 'Boy Shorts', 'Boy-Short', 'Boy-Shorts',  'Boypant', 'Boypants', 'Brief', 'Briefs', 'Boxer', 'Boxers', 'Tanga', 'Cheeky', 'Cheekster', 'Knicker', 'Knickers', 'G-String', 'Underwear','Robe', 'Robes', 'Kimono','Kimonos','night slip','pyjama','pyjamas');
	$swimwearDic=array('Swim', 'Swimwear', 'bathing suit','Bathing', 'Bathingsuit','swimsuit','Bikini', 'Bikinis', 'Tankini', 'top', 'tops', 'bra', 'bralette','bottom', 'bottoms', 'brief', 'briefs', 'thong', 'thongs', 'pant', 'pants', 'shorts', 'short','Swimdress','Monokini', 'Maillot','suit','suits','Kaftan', 'Kaftans', 'Cover-Up', 'Cover up', 'Coverup', 'Caftan', 'Caftans', 'Sarong', 'Sarongs','Rash Guard', 'Wetsuit', 'Wetsuits');
	$activewearDic=array('Activewear', 'Active', 'Athletic', 'Athlete', 'Hiking', 'Camping', 'Sports', 'Sporty', 'Basketball', 'Football', 'Soccer', 'Outdoors', 'Run', 'Running', 'Runner', 'Runners', 'Jog', 'Jogging', 'Jogger', 'Joggers', 'Walking', 'Walkers', 'Cycling', 'Cyclist', 'Snow', 'Ski', 'Surf', 'Surfing', 'Swimming', 'Snowboard', 'Snowboarding', 'Skiing', 'Sailing', 'Train', 'Training', 'Hiking', 'Hike', 'Windbreaker', 'Leggings', 'Legging', 'Sweatpant', 'Sweatpants', 'Workout', 'Workouts', 'Work-out', 'Yoga', 'Tennis', 'Golf', 'Golfing', 'Golfer', 'Boxing', 'Boxer', 'Racerback', 'Pro', 'Techfit', 'Under Armour', 'Track', 'Ballet', 'Reflective','Athleisure');
	$bridalDic=array('Bridal', 'Bride', 'Brides', 'Bridesmaid', 'Bridesmaids', 'Wedding', 'Engagement');
	$costumesDic=array('Costume', 'Costumes', 'Halloween', 'Cos-play', 'Cos Play', 'Mask', 'Masquerade', 'Anime', 'Hat', 'Hats', 'Wig', 'Wigs', 'Cowgirl');
	$petitesDic=array('Petite', 'Petites', 'Petite-size');
	$plusDic=array('Plus', 'Pluses');
	$suitsDic=array('Suit', 'Suits', 'Suiting', 'Tracksuit', 'Tracksuits');
	$shoesDic=array('shoe','shoes','sneaker','sneakers','trainer','trainers','cleats','Boot', 'Boots', 'Bootie', 'Booties', 'Rainboot', 'Rainboots', 'Wellie', 'Wellies','Mule', 'Mules', 'Clog', 'Clogs', 'Jelly', 'Jellies','Flat', 'Flats', 'Flatform', 'Flatforms', 'Espadrille', 'Espadrilles','Slip on','slip ons', 'slip-on','slip-ons','Ballerinas','sandal', 'sandals','Flat', 'Flats','Loafers', 'Loafer', 'Mocassins', 'Mocassin','Oxford', 'Oxfords', 'Dress-shoe', 'Dress-shoes', 'Brogue', 'Brogues','Pump', 'Pumps', 'Heel', 'Heels', 'High-heel', 'High-heels', 'Courts','heeled','Stiletto', 'Stilettos', 'Sandal', 'Sandals', 'Gladiator', 'Gladiators', 'slipper','slippers','Flip flop','flip flops','flip-flop','flip-flops','slide','slides','slider','creeper','creepers','Skimmers', 'Skimmer','Wedges', 'Wedge','Platforms', 'Platform');
	$accessoriesDic=array('turban', 'baseball','rucksack','Eye-wear', 'Eye-glass', 'Eye-glasses','Belt', 'waistbelt', 'belts','harness','fanny pack', 'fanny packs','Eyewear','Sunnies', 'Sunglass', 'Sunglasses', 'Aviator', 'Aviators', 'Cat Eye', 'Eyeglasses', 'Eyeglass', 'Readers', 'Glasses','Hat', 'Hats', 'Millinery', 'Beret', 'Baseballcap', 'Beanie', 'Beanies', 'Fedora', 'Fedoras', 'Snapback', 'Visor','Fascinator', 'Glove', 'Gloves','Mittens', 'Mitten','Hairbow', 'Hairbows', 'Hair-bow', 'Hairband', 'Hairbands', 'Headband', 'Headbands', 'Head band','Head bands','Head-Band', 'Head-Bands', 'Tiara', 'Tiaras', 'Crown', 'Crowns', 'Ponytail', 'Comb', 'Combs', 'Barrette', 'Headwrap', 'head wrap','Head-Wrap','Headpiece','Head piece', 'Hairstyle','Bobby pin','Bobby pins','Scarf','Scarves', 'Stole', 'Snood', 'Bandana', 'Bandanas', 'Shawl','shawls','Neckerchief', 'Neckerchiefs','headphones', 'headphone', 'phone','phones', 'cellphone', 'headset', 'bluetooth', 'laptop', 'computer', 'iwatch', 'iphone', 'iphone4', 'iphone5', 'iphone6', 'galaxy', 'samsung', 'apple', 'ios', 'android', 'iPhone®', 'earbuds', 'earbud','hi-tech', 'earphones', 'earphone', 'tablet', 'Ipad', 'camera','smartphone','Umbrella','Umbrellas','Bag', 'Bags','Backpack','Backpacks', 'Back-pack', 'knapsack', 'back pack','wallet', 'organizer', 'coinpurse', 'coin-purse', 'coin purse', 'wallet-on-chain', 'wallet-on-a-chain', 'wallet-on-a-strap', 'wallet-on-strap', 'Card holder', 'Checkbook', 'Cardholder', 'travel Pouch', 'Passport','Luggage', 'Luggages', 'Carry-on', 'Carry on', 'Suitcase', 'Duffels', 'Duffel', 'Weekender', 'Weekenders', 'Carryall', 'holdall', 'packing Case', 'Trunk', 'Trunks','Spinner', 'Spinners', 'Overnighter', 'Rollaboard','handbag', 'handbags', 'hand-bag', 'hand bag', 'purse', 'purses','Clutch', 'Clutches','leather', 'Miniaudiere', 'Pochette', 'Wristlet',  'Baguette','Messenger', 'Messengers', 'shoulder strap','Shoulderbag', 'Shoulderbags','Bauletto','Bauletti','Tote', 'Totes','case','cases','pouch','Duffle', 'Duffles', 'Shopper', 'Shoppers','Satchel', 'Satchels','Crossbody', 'Crossbodies', 'Cross-body', 'cross body', 'Across body','Crossbag', 'Across-body','Hobo', 'Hobos','Jewelry', 'Jewels','Necklace', 'Necklaces', 'Choker', 'Chokers', 'Locket','Earrings', 'Earring', 'Ear','Bracelet', 'Bracelets', 'Bangle', 'Bangles','wrist strap','wrist-strap','wriststrap','Armband', 'Arm Band', 'Armbands', 'Arm Bands', 'Arm-band', 'Arm-bands','Brooches', 'Brooch', 'Pin', 'Pins', 'Pendant', 'Pendants','Keychain', 'Keychains', 'Key-Chain', 'Key-Chains', 'Key Chain', 'brass','silver','gold','coil','Key Chains', 'Badge', 'Badges','Ring', 'Rings','Watch', 'Watches', 'Timepiece', 'Wristwatch', 'Time Teller','hand');
	$beautyDics=array('Beaute', 'Cosmetic', 'Cosmetics','Makeup', 'Make-up', 'Make up', 'Mascara', 'Mascaras', 'Lipstick', 'Lipsticks', 'Lip', 'stick','sticks','Balm', 'Balms', 'Balmer', 'Color','colour', 'Gloss', 'Creme', 'Stain', 'Lipgloss', 'Lipglass', 'Lipshine', 'Lipbalm', 'Lipbalmer', 'Powder', 'Concealer', 'Concealers', 'Brush', 'Brushes', 'Eye Color', 'Eye Colour', 'Eye Shadow', 'Eye Shadows', 'Eye Brow', 'Eye Brows', 'Eyebrow', 'Eyebrows', 'Eye-Brow', 'Eye-Brows', 'Eye-shadow', 'Eyeshadow', 'Eyepencil', 'Eye-pencil', 'Eye-pencils', 'Eye Pencil', 'Eyeliner', 'Eyeliners', 'Eye-liner', 'Eye-liners', 'Eye Liner', 'Eye Liners', 'Palette', 'Multi-palette', 'Powder', 'Lash', 'Lashes', 'Eyelashes', 'Eyelash', 'Eye-lashes', 'Eye-lash', 'Blush', 'Blushes', 'Blusher', 'Bronzer', 'Bronzers', 'Bronzing', 'Foundation', 'Primer', 'Highlight', 'Highlighter', 'Balm', 'Skincare', 'Skin', 'Moisturizer', 'Moisturising', 'Moisturizing', 'Moisturises', 'Moisturizes', 'SPF', 'Sunscreen', 'Skin Care', 'Cleansing', 'Facial', 'Masque','Serum', 'Remover', 'Mud Mask', 'Exfoliating', 'Exfoliator', 'Hydration', 'Hydrating', 'Eye Cream', 'Microderm','Fragrance', 'Fragrances', "Fragrance's", 'Perfume', 'Perfumes', 'Perfum', 'Parfum', 'Parfums', 'Parfume', 'Parfumes', 'Toilette', 'Perfumery','Bath', 'Bathtub', 'Soap', 'Soaps','Wipe', 'Wipes', 'Deodorant', 'Antiperspirant', 'Shower Cap', 'Sanitizer',  'Hairbrush', 'Hairbrushes', 'Haircare', 'Haircomb', 'Haircombs', 'Hairspray', 'Hairsprays', 'Hairstyler', 'Hairstylers','Extensions', 'Shampoo', 'Shampoos', 'Conditioner', 'Curl', 'Curling', 'Curly', 'Curler', 'Wig', 'Wigs', 'Comb', 'Combs', 'Flat Iron', 'Styling Iron', 'Ponytail', 'Pomade', 'Mousse','Nails', 'Nail','Manicure','Gift Set', 'Gift Sets', 'Gift Box', 'Gift Kits', 'Gift Kit','Starter Kit', 'Spa Basket', 'Travel Kit','Circle Pouch', 'Traincase', 'Washbag','cream', 'creams', 'oil', 'oils', 'care', 'pad', 'pads', 'mist','wash', 'cream', 'creams', 'oil', 'oils', 'mist', 'lotion', 'lotions', 'scrub', 'scrubs', 'gel', 'gels', 'cap', 'polish','set', 'sets', 'kit', 'kits','bag', 'bags', 'pouch', 'purse', 'case', 'cases', 'trunk', 'handbag', 'handbags', 'wristlet','Lacquer','Laque');
	foreach($dressDic as $dressKw){
		$catArr=matchMasterCategory($dressKw,$description,$catArr,0,$keyword);
	}
	foreach($topDic as $topKw){ 
		$catArr=matchMasterCategory($topKw,$description,$catArr,1,$keyword);
	}
	foreach($outwearDic as $outwearKw){
		$catArr=matchMasterCategory($outwearKw,$description,$catArr,2,$keyword);
	}
	foreach($skirtsDic as $skirtsKw){
		$catArr=matchMasterCategory($skirtsKw,$description,$catArr,3,$keyword);
	}
	foreach($shortsDic as $shortsKw){
		$catArr=matchMasterCategory($shortsKw,$description,$catArr,4,$keyword);
	}
	foreach($skortsDic as $skortsKw){ 
		$catArr=matchMasterCategory($skortsKw,$description,$catArr,5,$keyword);
	}
	foreach($jeansDic as $jeansKw){
		$catArr=matchMasterCategory($jeansKw,$description,$catArr,6,$keyword);
	}
	foreach($pantsDic as $pantsKw){
		$catArr=matchMasterCategory($pantsKw,$description,$catArr,7,$keyword);
	}
	foreach($rompersDic as $rompersKw){
		$catArr=matchMasterCategory($rompersKw,$description,$catArr,8,$keyword);
	}
	foreach($overallsDic as $overallsKw){
		$catArr=matchMasterCategory($overallsKw,$description,$catArr,9,$keyword);
	}
	foreach($intimatesDic as $intimatesKw){
		$catArr=matchMasterCategory($intimatesKw,$description,$catArr,10,$keyword);
	}
	foreach($swimwearDic as $swimwearKw){
		$catArr=matchMasterCategory($swimwearKw,$description,$catArr,11,$keyword);
	}
	foreach($activewearDic as $activewearKw){
		$catArr=matchMasterCategory($activewearKw,$description,$catArr,12,$keyword);
	}
	foreach($bridalDic as $bridalKw){
		$catArr=matchMasterCategory($bridalKw,$description,$catArr,13,$keyword);
	}
	foreach($costumesDic as $costumesKw){
		$catArr=matchMasterCategory($costumesKw,$description,$catArr,14,$keyword);
	}
	foreach($petitesDic as $petitesKw){
		$catArr=matchMasterCategory($petitesKw,$description,$catArr,15,$keyword);
	}
	foreach($plusDic as $plusKw){
		$catArr=matchMasterCategory($plusKw,$description,$catArr,16,$keyword);
	}
	foreach($suitsDic as $suitsKw){
		$catArr=matchMasterCategory($suitsKw,$description,$catArr,17,$keyword);
	}
	foreach($shoesDic as $shoesKw){
		$catArr=matchMasterCategory($shoesKw,$description,$catArr,18,$keyword);
	}
	foreach($accessoriesDic as $accessoriesKw){ 
		$catArr=matchMasterCategory($accessoriesKw,$description,$catArr,19,$keyword);
	}
	foreach($beautyDics as $beautyKw){ 
		$catArr=matchMasterCategory($beautyKw,$description,$catArr,20,$keyword);
	}
	
	return $catArr;
}
function printArray($arr){
	foreach($arr as $a){
		echo '<br/>'.$a.'<br/>';
	}
}
function delConflictCat($coatArrExt,$arr,$cat,$description){
		$des=explode(' ',$description);
		$extFlag=false;
		foreach($coatArrExt as $coat){
			foreach($des as $d){
				if(strpos($coat,' ')!==false||strpos($coat,'-')!==false){
					if(strpos($description,strtolower($coat))!==false){
						$extFlag=true;
					}
				}else {
					if($d==strtolower($coat)){
						$extFlag=true; 
					}
				}
			}
		}
		if($extFlag){
			foreach($arr as $i=>$a){
				if(strpos($a,$cat)!==false){
					unset($arr[$i]);
				}
			}
		}
		return $arr;
	
	
}
function modifyDuplicate($arr,$description){
	
	$arrPrev=array(); 
	if(strpos($description,'dress shoes')!==false||strpos($description,'dress shoe')!==false||strpos($description,'dress shirt')!==false){
		foreach($arr as $i=>$a){
			if(strpos($a,'Women > Clothing > Dresses')!==false){ 
				unset($arr[$i]);
			}
			
		}
	}
	if(strpos($description,'sweat shirt')!==false||strpos($description,'shirt dress')!==false){ 
		foreach($arr as $i=>$a){
			if(strpos($description,'sweat shirt')!==false){
				if($a=='Women > Clothing > Tops > Shirts'){ 
					unset($arr[$i]);
				}
			}
			if(strpos($description,'shirt dress')!==false){
				if(strpos($a,'Women > Clothing > Tops')!==false){ 
					unset($arr[$i]);
				}
			}
			
			
		}
	}if(strpos($description,'sleeveless')!==false){ 
		$coatArrExt=array('blazer', 'blazers', 'jacket', 'jackets', 'coat', 'coats', 'parka', 'parkas', 'trench', 'trenches', 'trenchcoat', 'trenchcoats', 'anorak', 'anoraks');
		$extFlag=false;
		foreach($coatArrExt as $coat){
			if(strpos($description,$coat)!==false){
				$extFlag=true;
			}
		}
		if($extFlag){
			foreach($arr as $i=>$a){
				if($a=='Women > Clothing > Outerwear > Coats'||$a=='Women > Clothing > Outerwear > Jackets'){
					unset($arr[$i]);
				}
			}
		}	
	}if(strpos($description,'rolling brief')!==false){ 
		foreach($arr as $i=>$a){
			if($a=='Women > Clothing > Swimwear'||$a=='Women > Clothing > Intimates > Panties & Thongs'){
				$arr[$i]='Women > Accessories > Bags > Luggage';
				
			}
			
		}
	}if(strpos($description,'thong')!==false){
		$thongExptArr=array('sandal', 'sandals', 'Gladiator', 'Gladiators', 'Flip Flop', 'Flip Flops', 'Flip-Flop', 'Flip-Flops','slide','slides','slider');
		$thongExptFlag=false;
		$thongFlatFlag=false;
		foreach($thongExptArr as $thong){
			
			if(strpos($description,strtolower($thong))!==false){
				$thongExptFlag=true;
				if($thong=='sandal'||$thong=='sandals'){
					$thongFlatFlag=true;
				}
			}
			
		}
        if($thongExptFlag){		
			foreach($arr as $i=>$a){

				if($a=='Women > Clothing > Intimates > Panties & Thongs'&&$thongFlatFlag){
					$arr[$i]='Women >Shoes > Flats';
					
				}
				else if($a!=='Women > Shoes > Sandals'){
					unset($arr[$i]);
				}
				
			}
		}
	}
	if(strpos($description, 'button-up')!==false||strpos($description, 'button-down')!==false||strpos($description, 'button up')!==false||strpos($description, 'button down')!==false){
		$buttonExpt=array('dress','dresses','skirt','skirts','short','shorts','jean','jeans','denim');
		$buttonFlag=false;
		foreach($buttonExpt as $button){
			if(strpos($description,$button)!==false){
				$buttonFlag=true;
			}
			
		}
		if($buttonFlag){
			foreach($arr as $i=>$a){
				if($a=='Women > Clothing > Tops > Blouses'||$a=='Women > Clothing > Tops > Shirts'){
					unset($arr[$i]);
					
				}
			
			}
		}
	}
	if(strpos($description,'top gloss')!==false){ 
		foreach($arr as $i=>$a){
			if($a=='Women > Clothing > Tops'){
				$arr[$i]='Women > Beauty > Nails';
				
			}
			
		}
	}if(strpos($description,'top coat')!==false){ 
		foreach($arr as $i=>$a){
			if($a=='Women > Clothing > Tops'||$a=='Women > Clothing > Outerwear > Coats'){
				$arr[$i]='Women > Beauty > Nails';
				
			}
			
		}
	}if(strpos($description,'body suit')!==false||strpos($description,'body suits')!==false||strpos($description,'jump suits')!==false||strpos($description,'jump suit')!==false||strpos($description,'play suit')!==false){ 
		foreach($arr as $i=>$a){
			if($a=='Women > Clothing > Suits'){
				unset($arr[$i]);
			}
			
		}
	}
        if(strpos($description, 'mud mask')!==false|| strpos($description, 'face mask')) {
            foreach($arr as $i => $a) {
                if($a=='Women > Clothing > Costumes'){
                    unset($arr[$i]);
                }
            }
        }
        if(strpos($description,'tank')!==false&&strpos($description,'dress')!==false||strpos($description,'short')!==false&&strpos($description,'dress')!==false||strpos($description,'denim')!==false&&strpos($description,'dress')!==false||strpos($description,'jean')!==false&&strpos($description,'dress')!==false||strpos($description,'jeans')!==false&&strpos($description,'dress')!==false){ 
		if(checkBarrier($description,'tank')&&checkBarrier($description,'dress')||checkBarrier($description,'short')&&checkBarrier($description,'dress')||checkBarrier($description,'denim')&&checkBarrier($description,'dress')){ 
			foreach($arr as $i=>$a){
				if($a=='Women > Clothing > Tops > Tank tops'||$a=='Women > Clothing > Shorts'||$a=='Women > Clothing > Jeans'){
					unset($arr[$i]);
				}
			}
		}else {
			foreach($arr as $i=>$a){
				if($a=='Women > Clothing > Jeans'){
					unset($arr[$i]);
				}
			}
		}
	}if(strpos($description,'suit')!==false||strpos($description,'suits')!==false){
		$suitExpt=array('one piece','one-piece');
		$arr=delConflictCat($suitExpt,$arr,'Women > Clothing > Suits',$description);
		
		
	}if(strpos($description,'boot')!==false){ 
		if(checkBarrier($description,'boot')){ 
			$deleteBootCat=false;
			$arrTmp=array('pant', 'pants', 'trouser', 'trousers', 'slack', 'slacks', 'chino', 'chinos',' jean', 'jeans', 'denim');
			foreach($arrTmp as $a){
				$a=strtolower($a);
				if(strpos($description,$a)!==false){ 
					$deleteBootCat=true;
				}
			}
			
				foreach($arr as $i=>$a){
					if($a=='Women > Shoes > Boots'&&$deleteBootCat){
						unset($arr[$i]);
					}
				}
		
		}	
	}
	if(strpos($description,'flat')!==false||strpos($description,'flat-')!==false){
		$flatExt=array('clutch','clutches','handbag','handbags','pant', 'pants', 'trousers', 'trouser', 'slack', 'slacks', 'chino', 'chinos','bag', 'bags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses');
		$arr=delConflictCat($flatExt,$arr,'Women > Shoes > Flats',$description);
		
	}if(strpos($description,'pullover')!==false&&strpos($description,'dress')!==false){
		foreach($arr as $i=>$a){
			if($a=='Women > Clothing > Tops > Sweaters'){ 
				unset($arr[$i]);
			}
		}
	}
        if(strpos($description,'dress')!==false) {
            $dressExpt=array('pant', 'pants', 'trousers', 'trouser', 'slack', 'slacks', 'chino', 'chinos');
            $arr= delConflictCat($dressExpt, $arr, 'Women > Clothing > Dresses', $description);
        }
	if(strpos($description,'shawls')!==false||strpos($description,'shawl')!==false){
		if(strpos($description,'jacket')!==false||strpos($description,'jackets')!==false||strpos($description,'kimono')!==false||strpos($description,'kimonos')!==false||strpos($description,'blazer')!==false||strpos($description,'blazers')!==false||strpos($description,'vest')!==false||strpos($description,'vests')!==false||strpos($description,'waistcoat')!==false|| strpos($description,'waistcoats')!==false||strpos($description,'waist coat')!==false){
		
			foreach($arr as $i=>$a){
				if($a=='Women > Accessories > Scraves'){ 
					unset($arr[$i]);
				}
			}
		}
	
	}
	if(strpos($description,'jean')!==false||strpos($description,'jeans')!==false||strpos($description,'denim')!==false){
		$jeanExceptArr=array('Coat', 'Coats', 'Parka', 'Parkas', 'Trench', 'Trenches', 'Trenchcoat', 'Trenchcoats','Jacket', 'Jackets', 'Kimono', 'Kimonos', 'Blazer', 'Blazers','Vest', 'Vests', 'Waistcoat', 'Waistcoats', 'Waist Coat','Cape', 'Capes', 'Poncho', 'Ponchos', 'Cloak', 'Cloaks','skirt','skirts','miniskirt','miniskirts','midiskirt', 'midiskirts', 'midi-skirt', 'midi-skirts','maxiskirt', 'maxi-skirt', 'maxi-skirts','short','shorts','skort','skorts','sneaker','sneakers','trainer','trainers','platform','platforms','wedge','wedges','Sandal', 'Sandals', 'Gladiator', 'Gladiators', 'Flip Flop', 'Flip Flops', 'Flip-Flop', 'Flip-Flops','Pump', 'Pumps', 'Heel', 'Heels', 'High-heel', 'High-heels', 'Courts','Loafers', 'Loafer', 'Mocassins', 'Mocassin','Flat', 'Flats', 'Flatform', 'Flatforms', 'Espadrille', 'Espadrilles', 'Slip on', 'Slip Ons', 'Slip-on', 'Slip-ons', 'Ballerinas','shoe','shoes','Boot', 'Boots', 'Bootie', 'Booties','Mules', 'Mule', 'Clog', 'Creeper', 'Creepers', 'Skimmers', 'Skimmer','slide','slides','slider','Bikini', 'Bikinis', 'Tankini');
		$flagExcept=false;
		foreach($jeanExceptArr as $a){
			if(strpos($description,strtolower($a))!==false){
				$flagExcept=true;
			}
		}
		if($flagExcept){
			foreach($arr as $i=>$a){
				if($a=='Women > Clothing > Jeans'){ 
					unset($arr[$i]);
				}
			}
		}
		$jeanAllClearArr=array('jumper', 'jumpers', 'jumpsuit', 'jumpsuits', 'Romper', 'Rompers', 'Jumpsuit', 'Jumpsuits', 'Jump-suit', 'Jump-suits', 'Playsuit', 'Playsuits',  'Play-Suit', 'Play-Suits', 'Bodysuits', 'Bodysuit', 'Body-suit', 'Body-suits', 'Jump Suit', 'Jump Suits', 'Play Suit', 'Play Suits', 'body suit', 'body suits', 'Overall', 'Overalls','Over-all', 'Over-alls', 'Dungarees', 'Dungaree', 'Shortall', 'Shortalls', 'Short-all', 'Short-alls');
		foreach($jeanAllClearArr as $allClear){
			if(strpos($description,strtolower($allClear))!==false){
				$arr=array('Women > Clothing > Overalls');
				break;
			}
		}

	}
	if(strpos($description,'skirt')!==false||strpos($description,'skirts')!==false){
		if(strpos($description,'dress')!==false||strpos($description,'dresses')!==false){
			foreach($arr as $i=>$a){
					if($a=='Women > Clothing > Skirts'){ 
						unset($arr[$i]);
					}
			}
		}
		
	}
	
	if(strpos($description,'skirt')!==false||strpos($description,'skirts')!==false){
	    if(strpos($description,'gown')!==false||strpos($description,'gowns')!==false){
	        foreach($arr as $i=>$a){
	            if($a=='Women > Clothing > Skirts'){
	                unset($arr[$i]);
	            }
	        }
	    }
	
	}
	
	if(strpos($description,'belt')!==false||strpos($description,'belts')!==false||strpos($description,'belt-')!==false||strpos($description,'-belt')!==false){
		
		$beltExp=array('jean','jeans','denim','pant','pants','dress','dresses','top','tops','skirt','skirts','trousers', 'trouser', 'slack', 'slacks', 'chino', 'chinos', 'bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses','pouch');
		$arr=delConflictCat($beltExp,$arr,'Women > Accessories > Belts',$description);
			
	}
	
	if(strpos($description,'charm')!==false||strpos($description,'charms')!==false){ 
		if(strpos($description,'bag')!==false||strpos($description,'bags')!==false||strpos($description,'handbags')!==false||strpos($description,'hand-')!==false){
			foreach($arr as $i=>$a){
					if($a=='Women > Accessories > Bags > Handbags'||$a=='Women > Accessories > Bags'){ 
						unset($arr[$i]);
					}
			}
			
		}
		
	}
	if(strpos($description,'chino')!==false||strpos($description,'chinos')!==false){
		$chinoExpt=array('short','shorts');
		$arr=delConflictCat($chinoExpt,$arr,'Women > Clothing > Pants',$description);
		
	}
	if(strpos($description,'bracelets')!==false||strpos($description,'bracelet')!==false||strpos($description,'wrist-strap')!==false||strpos($description,'wrist strap')!==false||strpos($description,'wriststrap')!==false){
		$braceletsExpt=array('Watch', 'Watches', 'Timepiece', 'Wristwatch', '-watch', 'Time Teller', 'Watch-');
		$braceletsFlag=false;
		$arr=delConflictCat($braceletsExpt,$arr,'Women > Accessories > Jewelry > Bracelets & Bangles',$description);
	
	}
	if(strpos($description,'-top')!==false||strpos($description,'top-')!==false||strpos($description,'-tops')!==false){ 
		$topExpt=array('bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses','pouch','Sneaker', 'Sneakers', 'trainers', 'Trainer','shoe','shoes');
		
		$arr=delConflictCat($topExpt,$arr,'Women > Clothing > Tops',$description);
	}if(strpos($description,'top')!==false||strpos($description,'tops')!==false){
		$topExpt=array('bikini', 'bikinis', 'tankini', 'swim', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-', 'swimsuit', 'swim-','bra','Sneaker', 'Sneakers', 'trainers', 'Trainer','shoe','shoes','bag', 'bags', 'handbag', 'handbags', 'hand-bag', 'hand bag', 'hand bags', 'purse', 'purses','Crossbody', 'Crossbodies', 'Cross-body', 'Cross body', 'Across Body', 'Crossbag', 'Across-body', '-Crossbody','Satchel', 'Satchels','Tote', 'Totes', 'Duffle', 'Duffles', 'Duffels', 'Duffel', 'Carryall', 'Holdall', 'Shopper', 'Shoppers','pouch','dress','dresses');
		$arr=delConflictCat($topExpt,$arr,'Women > Clothing > Tops',$description);
		
	}
	if(strpos($description,'bra')!==false||strpos($description,'bralette')!==false||strpos($description,'bras')!==false){
		$bikiniTopExt=array('bikini', 'bikinis', 'tankini', 'swim', 'swimwear', 'bathing suit', 'bathingsuit', 'bathing-', 'swimsuit', 'swim-','gown','gowns','dress','dresses');
		
		$arr=delConflictCat($bikiniTopExt,$arr,'Women > Clothing > Intimates > Bras',$description);
	}
	if(strpos($description,'short')!==false){
		$shortExt=array('Coat', 'Coats', 'Parka', 'Parkas', 'Trench', 'Trenches', 'Trenchcoat', 'Trenchcoats','Jacket', 'Jackets', 'Kimono', 'Kimonos', 'Blazer', 'Blazers','Vest', 'Vests', 'Waistcoat', 'Waistcoats', 'Waist Coat','Cape', 'Capes', 'Poncho', 'Ponchos', 'Cloak', 'Cloaks','miniskirt', 'miniskirts','skirt','skirts','top','tops','t-shirt','tee','t');
		$arr=delConflictCat($shortExt,$arr,'Women > Clothing > Shorts',$description);
		
	}
        if(strpos($description,'duffle')!==false||strpos($description,'duffles')!==false){
            $duffleExt=array('Coat', 'Coats', 'Parka', 'Parkas', 'Trench', 'Trenches', 'Trenchcoat', 'Trenchcoats');
            $arr= delConflictCat($duffleExt, $arr, 'Women > Accessories > Bags', $description);
        }
	if(strpos($description,'oxford')!==false){
		$oxfordExt=array('pant', 'pants', 'trousers', 'trouser', 'slack', 'slacks', 'chino', 'chinos','shirt','shirts');
		$arr=delConflictCat($oxfordExt,$arr,'Women > Shoes > Oxfords',$description);
	}
	if(strpos($description,'plus')!==false){
		$plusExpt=array('iphone','iphone6');
		$arr=delConflictCat($plusExpt,$arr,'Women > Clothing > Plus',$description);
	}
	if(strpos($description,'baguette')!==false){
		$baguetteExpt=array('ring','rings');
		$arr=delConflictCat($baguetteExpt,$arr,'Women > Accessories > Bags > Handbags > Clutches',$description);
	}
        /*
	if(in_array('Women > Beauty > Bath & Body',$arr)&&count($arr)!==1){
		foreach($arr as $i=>$a){
			if($a=='Women > Beauty > Bath & Body'){
				unset($arr[$i]);
			}
		}
	}
        */
	$arrTmp=array();
	foreach($arr as $a){
		if(!in_array($a,$arrTmp)){
			$arrTmp[]=$a;
		}
	}
	return $arrTmp;
}



?>
