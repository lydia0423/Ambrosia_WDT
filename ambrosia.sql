-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2020 at 03:02 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambrosia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES
(1, 'Admin', 'Admin'),
(3, 'Admin123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `ArticleID` varchar(50) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Content` json NOT NULL,
  `Author` varchar(255) NOT NULL,
  `PublishDate` date NOT NULL,
  `Tags` varchar(11) NOT NULL,
  PRIMARY KEY (`ArticleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ArticleID`, `Title`, `Description`, `Content`, `Author`, `PublishDate`, `Tags`) VALUES
('A001', 'Is healthier food more expensive than junk food?', 'People often associate healthy food to costly expenditures. Here are some tips to help you have a healthy diet and wallet!', '[[\"Tip #1 - Canned and Frozen Fruits and Veggies \", \"Many people think that canned and frozen fruit and veggies arenu0027t as healthy as fresh, but, this isnu0027t the case! Canned and frozen foods can be equally as nutritious and are packaged when they are just ripe, meaning they lock in all the nutrients. Frozen and canned foods are often cheaper compared to their fresh varieties. Plus, these foods will last for ages in your freezer or pantry, making them a great option for when youu0027re short on time or havenu0027t been shopping. \", \"Remember to keep an eye out for the salt content in the canned foods and the added sugar in frozen fruits and veggies. Choose frozen fruit without added sugar and canned fruit in water (rather than sweetened juice or syrup). Also make sure to choose canned vegetables without added salt. \"], [\"Tip #2 - Plan for meatless meals each week \", \"Meat and fish are among the most expensive items on a shopping list while plant protein often costs less. Pulses (beans, peas and lentils) are nutritious, very cheap and work well in place of meat.\"], [\"Tip #3 - Check the specials! \", \"An easy way to save money is by checking whatu0027s on special and where. Before you go shopping, hop online and compare prices between major supermarkets. Signing up to rewards programs is another easy way to earn discounts.\"], [\"Tip #4 - Shop seasonally \", \"Foods that are in season are almost always cheaper! Not only will shopping seasonally save money, it also means added variety to your diet. If you arenu0027t fussed on whatu0027s in season at a particular time, frozen fruit and veg is another great option! Another great idea for finding cheap produce is your local farmers market!\"], [\"Tip #5 - Love your legumes \", \"Adding legumes to your meals is a cheap and easy way to spread them out and make them last longer for less. A can of lentils or chickpeas costs less than $1, and can be added to pasta sauces, stir fries, curries and salads - plus, legumes are considered a vegetable and a protein alternative, making them a real superfood!\"], [\"Tip #6 - Plan ahead \", \"The best way to eat healthy on a budget, is by PLANNING! Work out your grocery budget, what meals and snacks you are having, what ingredients you need, and check online for prices and specials. Then, make a list and stick to it! Planning ahead makes sticking to a budget and a plan way easier!\"]]', 'University of Newcastle, Australia', '2020-08-01', 'T005'),
('A002', 'Eat Healthy Be Happy', 'Not feeling so great? Here are some mood-boosters that can help you start your day.', '[[\"Tip #1 - Canned and Frozen Fruits and Veggies \", \"Many people think that canned and frozen fruit and veggies arenu0027t as healthy as fresh, but, this isnu0027t the case! Canned and frozen foods can be equally as nutritious and are packaged when they are just ripe, meaning they lock in all the nutrients. Frozen and canned foods are often cheaper compared to their fresh varieties. Plus, these foods will last for ages in your freezer or pantry, making them a great option for when youu0027re short on time or havenu0027t been shopping. \", \"Remember to keep an eye out for the salt content in the canned foods and the added sugar in frozen fruits and veggies. Choose frozen fruit without added sugar and canned fruit in water (rather than sweetened juice or syrup). Also make sure to choose canned vegetables without added salt. \"], [\"Tip #2 - Plan for meatless meals each week \", \"Meat and fish are among the most expensive items on a shopping list while plant protein often costs less. Pulses (beans, peas and lentils) are nutritious, very cheap and work well in place of meat.\"], [\"Tip #3 - Check the specials! \", \"An easy way to save money is by checking whatu0027s on special and where. Before you go shopping, hop online and compare prices between major supermarkets. Signing up to rewards programs is another easy way to earn discounts.\"], [\"Tip #4 - Shop seasonally \", \"Foods that are in season are almost always cheaper! Not only will shopping seasonally save money, it also means added variety to your diet. If you arenu0027t fussed on whatu0027s in season at a particular time, frozen fruit and veg is another great option! Another great idea for finding cheap produce is your local farmers market!\"], [\"Tip #5 - Love your legumes \", \"Adding legumes to your meals is a cheap and easy way to spread them out and make them last longer for less. A can of lentils or chickpeas costs less than $1, and can be added to pasta sauces, stir fries, curries and salads - plus, legumes are considered a vegetable and a protein alternative, making them a real superfood!\"], [\"Tip #6 - Plan ahead \", \"The best way to eat healthy on a budget, is by PLANNING! Work out your grocery budget, what meals and snacks you are having, what ingredients you need, and check online for prices and specials. Then, make a list and stick to it! Planning ahead makes sticking to a budget and a plan way easier!\"]]', 'Anon', '2020-08-05', 'T005'),
('A003', 'Should you go Vegan?', 'The pros and cons of a vegan diet', '[[\"Reason #1<br>\", \"Better for the world or so they claim\"], [\"Reason #2\", \"Me cow I happy\"]]', 'Cow', '2020-08-11', 'T005'),
('A004', '2020 Food Trends', 'Dalgona Coffee idk what that? Find out now!', '[[\"Dalgona Coffee<br>\", \"The joys of lockdown due to Covid-19 has lead to some truly innovative food creations. Disclaimer: the author has no idea what Dalgona Coffee is.\"], [\"Boba\", \"Bubble Tea! Or more affectionately known as Boba. A classic drink originating from Taiwan, this sweet delicacy has taken over the world. Covid-19 has taken its toll on this industry however and caused many shops to close.\"]]', 'UnderARock', '2020-08-13', 'T006'),
('A005', 'Beat the Heat!', 'Hot weather is the worst. Here are some tasty food that helps you stay cool and hydrated', '[[\"Watermelons\", \"nice and cooling\", \"very juicy\"], [\"Cucumbers\", \"Personally, I hate them but eh\"]]', 'Cucumber', '2020-08-14', 'T006'),
('A006', 'An Apple A Day...', 'Everyone knows an apple a day keeps the doctor away. But is this really the case?', '[[\"Why Apple<br>\", \"Nobody actually knows but an apple a day apparently keeps doctors away heh\"], [\"Buy Apple\", \"By this I donu0027t mean buy apples but rather buy Apple. Iphones are superior to any other phone thanks.\"]]', 'Steve Jobs', '2020-08-17', 'T005');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `Number` int(50) NOT NULL AUTO_INCREMENT,
  `RecipeID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ArticleID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `UserID` varchar(50) NOT NULL,
  PRIMARY KEY (`Number`),
  KEY `ArticleID` (`ArticleID`),
  KEY `RecipeID` (`RecipeID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`Number`, `RecipeID`, `ArticleID`, `UserID`) VALUES
(47, 'R002', NULL, 'U002'),
(48, 'R003', NULL, 'U002'),
(49, 'R004', NULL, 'U002'),
(50, 'R005', NULL, 'U002'),
(51, 'R006', NULL, 'U002'),
(67, 'R001', NULL, 'U002'),
(75, NULL, 'A001', 'U002'),
(76, NULL, 'A002', 'U002'),
(77, NULL, 'A004', 'U002'),
(80, NULL, 'A003', 'U002'),
(88, 'R009', NULL, 'U002'),
(89, 'R008', NULL, 'U002'),
(90, 'R001', NULL, 'U001'),
(91, 'R002', NULL, 'U001');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `ClassID` varchar(50) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Ingredients` json NOT NULL,
  `VideoLink` text NOT NULL,
  `Author` varchar(255) NOT NULL,
  `PublishDate` date NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Tags` varchar(255) NOT NULL,
  PRIMARY KEY (`ClassID`),
  KEY `Tags` (`Tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ClassID`, `Title`, `Description`, `Ingredients`, `VideoLink`, `Author`, `PublishDate`, `Type`, `Tags`) VALUES
('C001', 'Chocolate Banana Cake', 'This chocolate banana cake combines tender chocolate cream with fresh bananas to create an exquisitely smooth taste in every bite', '[[\"Cake\", \"Eggs - 2    \", \"Flour - 65g     \", \"White sugar - 50g     \", \"Cocoa powder - 17g     \", \"Water - 60ml     \", \"Vegetable oil - 30ml     \", \"Baking powder - 0.5tsp     \", \"Baking soda - 0.5tsp     \", \"Pinch of salt     \"], [\"Cream\", \"Dark Chocolate (50%-60%) - 80g     \", \"Vanilla extract - 1 tsp     \", \"Powdered sugar - 1 tbsp     \"], [\"Ganache\", \"Heavy cream (35%) - 50ml     \", \"Butter - 14g     \", \"Condensed milk - 1 tbsp (Optional)     \"]]', 'https://www.youtube-nocookie.com/embed/zSjQrq15EK8', 'ATB Sweets', '2020-08-08', 'Paid', 'T001'),
('C002', 'Classic Pan-Seared Ribeye Steak', 'This classic pan-seared ribeye steak recipe results in a juicy, tender steak with a super flavorful crust. Grab your cast iron skillet and create a mouthwatering steak that will have your taste buds tingling. Here\'s how!', '[[\"Steak\", \"Angus Beef ribeye steak (16-ounce) - 1  \", \"Peanut/Canola oil - 1 tsp  \", \"Coarse kosher salt - 0.5tsp  \", \"Freshly cracked black pepper - 0.25tsp  \", \"Thyme springs -4  \", \"Garlic cloves, partially crushed - 2  \", \"Butter - 2tbsp  \"], [\"Equipment\", \"Cast iron skillet  \"]]', 'https://www.youtube-nocookie.com/embed/n1HVWjIBBnw', 'Certified Angus Beef brand Kitchen', '2020-08-10', 'Paid', 'T002'),
('C003', 'Japanese Souffle Cheesecake', 'Super fluffy and jiggly Japanese Souffle Cheesecake!', '[[\" \", \"Creamcheese - 160g \", \"Unsalted butter - 20g \", \"Hot water \", \"Milk - 50ml \", \"Cake flour - 40g \", \"Eggs - 4 (Separate the whites and the yolks) \", \"Lemon juice - 0.25tsp \", \"Sugar - 80g \"]]', 'https://www.youtube-nocookie.com/embed/0qq2MACXNWk', 'Nino\'s Home', '2020-08-12', 'Paid', 'T001'),
('C004', 'Korean Potato Cheese Pancake', 'A delectable savory treat', '[[\" \", \"Potatoes - 300g \", \"Sugar - 2 tbsp \", \"Rice flour - 3 tbsp \", \"Mozzarella Cheese \", \"Cooking oil \"]]', 'https://www.youtube-nocookie.com/embed/10MDo9o_wrY', 'Nino\'s Home', '2020-08-13', 'Paid', 'T003'),
('C005', 'Choux Au Craquelin (Cream Puffs)', 'Cream puffs with a delightfully crunchy exterior', '[[\"Craquelin\", \"Unsalted butter - 60g    \", \"Sugar - 50g    \", \"All purpose flour - 60g    \"], [\"Choux Pastry\", \"Water - 130ml    \", \"Unsalted butter - 50g    \", \"Salt - 0.25tsp    \", \"All purpose flour - 70g    \", \"Eggs - 2    \"], [\"Vanilla Cream\", \"Egg yolks - 2    \", \"Sugar - 60g    \", \"Corn starch - 25g    \", \"Milk - 240ml    \", \"Whipping cream - 180g    \", \"Vanilla extract - 1 tsp    \"]]', 'https://www.youtube.com/embed/Bqvnf787PJA', 'Nino\'s Home', '2020-08-11', 'Paid', 'T001'),
('C006', 'Caramel Custard Pudding', 'The best recipe for caramel custard pudding. Guaranteed to delight your tastebuds!', '[[\"Caramel\", \"Sugar - 80g  \", \"Water - 15ml  \"], [\"Pudding\", \"Egg yolks - 3  \", \"Eggs - 3  \", \"Milk - 500ml  \", \"Sugar - 90g  \", \"Heavy cream - 200g  \", \"Vanilla extract - 1tsp  \", \"Hot water  \"]]', 'https://www.youtube.com/embed/1_q8txKyg4E', 'Nino\'s Home', '2020-08-12', 'Paid', 'T001'),
('C007', 'Shepherd\'s Pie', 'Shepherd\'s pie - the perfect comfort food for cold winter days.', '[[\"Puree\", \"Potatoes - 1500g        \", \"Butter - 1tbsp        \", \"Milk - 120ml        \", \"Cheddar Cheese - 25g        \", \"Salt - 0.5tsp        \", \"Black pepper - 0.5tsp        \", \"Egg yolk - 1        \"], [\"Filling\", \"Ground lamb - 1kg        \", \"Onion - 1        \", \"Garlic Cloves - 3        \", \"Olive oil - 3tbsp        \", \"Flour - 4tbsp        \", \"Salt - 0.5tsp        \", \"Black pepper - 0.5tsp        \", \"Rosemary - 1tsp        \", \"Tomato paste - 1tbsp        \", \"Beef broth - 2 cups        \", \"Carrots - 200g        \", \"Peas - 200g        \"]]', 'https://www.youtube-nocookie.com/embed/a3EYQARJkLk', 'The Cooking Foodie', '2020-08-14', 'Paid', 'T002'),
('C008', 'Tteokbokki & Rice Cake', 'Craving tteokbokki and rice cakes? Here\'s how you can make them at home!', '[[\" \", \"Rice flour - 110g  \", \"Hot water - 85ml  \", \"Onion - 50g  \", \"Grilled chopped fish - 40g  \", \"Green onion - 1  \", \"Water - 200ml  \", \"Brown sugar - 15g  \", \"Gochujang chili paste - 40g  \", \"Soy sauce - 5ml  \", \"Egg - 1  \", \"Sesame seeds  \"]]', 'https://www.youtube-nocookie.com/embed/UxpWM7ISoUM', 'Nino\'s Home', '2020-08-15', 'Paid', 'T003'),
('C009', 'Bubble Milk Tea Lava Cake', 'What\'s better than milk tea and lava cake? Milk Tea Lava Cake! Bringing you the best of both world\'s with this simple recipe', '[[\"Milk Tea\", \"Black tea  - 20g\", \"Milk - 250ml\"], [\"Black Tea Sponge Cake\", \"Eggs - 3pieces\", \"Milk Tea - 50ml\", \"Vegetable oil - 20g\", \"Cake flour - 70g\", \"Black Tea - 0.5tsp\", \"Lemon juice - 0.25tsp\", \"Sugar - 65g\"], [\"Milk Tea Cream\", \"Egg yolk - 1pieces\", \"Brown Sugar - 40g\", \"Milk tea - 120ml\", \"Corn Starch - 5g\", \"Whipping cream - 200g\"], [\"Tapioca pearls\", \"Tapioca pearls - 50g\", \"Brown Sugar - 20g\"]]', 'https://www.youtube-nocookie.com/embed/W0ivPXU89S4', 'Nino\'s Home', '2020-09-01', 'Upcoming', 'T001'),
('C010', 'Easy Family Lasagne', 'Simple and easy lasagne for the whole family to enjoy! ', '[[\"\", \"Rosemary - 2pieces\", \"Smoked streaky bacon - 100g\", \"Olive oil - 250ml\", \"Minced beef - 1000g\", \"Minced pork - 1000g\", \"Carrots - 4pieces\", \"Onions - 2pieces\", \"Celery - 4pieces\", \"Tomato puree - 2tbsp\", \"Plum tomatoes - 1600g\", \"Lasagne sheets - 350g\"], [\"White Sauce\", \"Mature Cheddar cheese - 150g\", \"Leeks (medium-sized) - 2pieces\", \"Bay leaves - 2pieces\", \"Plain flour  - 4tbsp\", \"Semi-skimmed milk - 1000ml\", \"Nutmeg - 1pieces\"]]', 'https://www.youtube-nocookie.com/embed/SalyS66njMY', 'Jamie Oliver', '2020-09-02', 'Upcoming', 'T002'),
('C011', 'Ultimate Crispy Fish & Chips', 'A foolproof guide to the perfect crispy battered fish and oven-baked chips', '[[\"\", \"Plain flour - 400g\", \"Baking powder - 3tsp\", \"Tumeric - 0.5tsp\", \"Cornflour - 1cups\", \"Cold beer - 320ml\", \"Cold soda water - 280ml\", \"Firm white fish (snapper/barramundi/cod) - 4pieces\", \"Sea salt - 20g\", \"Pepper - 20g\", \"Vegetable oil - 500ml\", \"Lime wedges - 4pieces\"], [\"Oven-Baked Chips\", \"Potaotes - 6pieces\", \"Vegetable oil - 3tbsp\", \"Garlic powder - 2tsp\", \"Sweet paprika - 0.5tsp\", \"Sea salt - 1tsp\"], [\"Spicy Coconut Siracha Mayo\", \"Mayonnaise - 0.5cups\", \"Coconut Sriracha - 0.25cups\"]]', 'https://www.youtube-nocookie.com/embed/DJlRRLHPfr8', 'Marion\'s Kitchen', '2020-09-04', 'Upcoming', 'T002');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `RecipeID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ingredients` json NOT NULL,
  `Steps` json NOT NULL,
  `PublishDate` date NOT NULL,
  `Author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Tags` varchar(5) NOT NULL,
  PRIMARY KEY (`RecipeID`),
  KEY `Tags` (`Tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`RecipeID`, `Title`, `Description`, `Ingredients`, `Steps`, `PublishDate`, `Author`, `Tags`) VALUES
('R001', 'Chocolate Banana Cake', 'A chocolate cake that is deliciously low in fat ??? It is moist enough to eat without the icing if you want to cut down on calories', '[[\"\", \"Self-raising flour - 225g\", \"Cocoa powder - 45ml\", \"Muscovado sugar - 115g\", \"Malt extract - 20ml\", \"Golden syrup - 30ml\", \"Eggs - 2pieces\", \"Skimmed milk - 60ml\", \"Sunflower oil - 60ml\", \"Ripe bananas - 2pieces\"], [\"Icing\", \"Icing sugar - 225g\", \"Cocoa powder - 35ml\", \"Warm water - 30ml\"]]', '[[\"\", \"Preheat the oven to 160u00b0C. Grease and line a deep round 8\\\"/20cm cake tin.\", \"Sift the flour into a mixing bowl with the cocoa. Stir in the sugar.\", \"Make a well in the centre and add the malt extract, golden syrup, eggs, milk and oil. Mash the bananas thoroughly and stir them into the mixture until well combined..\", \"Pour the cake mixture into the prepared tin and bake for 1 to 1 hour 15 minutes, or until the centre of the cake springs back when lightly pressed.\", \"Remove the cake form the tin and leave on a wire rack to cool.\", \"Reserve 50g of icing sugar and 5ml of cocoa powder. Make a dark icing beating the remaining sugar and cocoa powder with enough of the warm water to make a thick icing. Pour it over the cake and spread evenly.&nbsp;\", \"Make a light icing by mixing the remaining icing sugar and cocoa powder with a few drops of water. Drizzle this icing across the top of the cake.\"]]', '2020-07-31', 'Martha Day', 'T001'),
('R002', 'Mac N Cheese', 'yummy calories ', '[[\"\", \"Cheese \", \"Macaroni\"]]', '[[\"\", \"Boil macaroni \", \"Add cheese to top \", \"bake\"]]', '2020-08-19', 'Lydia', 'T002'),
('R003', 'Roast Chicken', 'Crispy skin, juicy meat. Truly the best', '[[\"\", \"Chicken \", \" Rosemary \", \"Thyme \", \"Salt\"]]', '[[\"\", \"Marinade the chicken with rosemary, thyme and salt. Leave it overnight \", \"Put in the oven \", \"Enjoy\"]]', '2020-08-05', 'Anon', 'T002'),
('R004', 'Chocolate Chip Cookies', 'Gooey, chewy cookies. Yum!', '[[\"\", \"Flour\", \"Sugar\", \"Chocolate Chips\", \"Milk\"]]', '[[\"\", \"Mix all together\", \"Roll out, cut into shape\", \"Bake\", \"eat\"]]', '2020-08-06', 'Anon', 'T001'),
('R005', 'Gimbap', 'Korean sushi rolls', '[[\"\", \"Seaweed\", \"Chicken\", \"Rice\", \"Salt\"]]', '[[\"\", \"Mix together\", \"Roll\", \"Eat\"]]', '2020-08-07', 'Anon', 'T003'),
('R006', 'Shrimp Alfredo', 'Shrimp alfredo is pretty good if you take out the shrimp', '[[\"\", \"Shrimp - 2pieces        \", \"Salt - 4g        \", \"Cream - 500ml\"]]', '[[\"\", \"Boil pasta          \", \"Cook shrimps         \", \" garlic and other condiments with heavy cream          \", \"Serve\"]]', '2020-08-17', 'Anon', 'T002'),
('R007', 'Honey Garlic Salmon', 'The honey and garlic sauce makes the perfect complement to the salmon for an extremely juicy, mouthwatering meal.', '[[\"\", \"Salmon - 750g   \", \"Honey - 50ml   \", \"Garlic - 5pieces\"]]', '[[\"\", \"Cook salmon and enjoy\"]]', '2020-08-18', 'Anon', 'T002'),
('R008', 'Cheesy Scones', 'Savory, buttery scones. Goes perfectly with a cup of tea.', '[[\"\", \"Butter - 500g\", \"Flour - 200g\", \"Bacon - 250g\", \"Onions - 100g\"]]', '[[\"\", \"Make the batter\", \"Use cupcake tin\"]]', '2020-08-19', 'Anon', 'T002'),
('R009', 'Egg Fried Rice', 'Don\'t use colanders to cook rice. 100% better than BBC', '[[\"\", \"a\", \"Rice - 12g\"]]', '[[\"\", \"Cook rice in rice cooker    \", \"Fry the egg   \", \" garlic    \", \"Add in the rice   \", \" and a dash of soy sauce and pepper for flavour    \", \"Serve\"]]', '2020-08-16', 'Uncle Roger', 'T004'),
('R010', 'Pumpkin Pie', 'Yum', '[[\"\", \"Pumpkin - 200g     \", \"Milk - 200ml   \\r\\n   \\r\\n                          \", \"Flour - 200g   \\r\\n   \\r\\n\"]]', '[[\"\", \"Be careful when cutting the pumpkin because it\'s hard!\", \"Bake your pastry first\", \"Steam the pumpkin I think\", \"Top with fresh cream                \"]]', '2020-08-17', 'Anon', 'T001');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  `ClassID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  PRIMARY KEY (`Number`),
  KEY `ClassID` (`ClassID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`Number`, `ClassID`, `UserID`) VALUES
(1, 'C001', 'U002'),
(3, 'C002', 'U002'),
(4, 'C006', 'U002'),
(5, 'C005', 'U002'),
(14, 'C007', 'U002');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `TagID` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagID`, `Name`) VALUES
('T001', 'Dessert'),
('T002', 'Western'),
('T003', 'Korean'),
('T004', 'Asian'),
('T005', 'Lifestyle'),
('T006', 'Ideas'),
('T007', 'Japanese');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE IF NOT EXISTS `user_account` (
  `UserID` varchar(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `Newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `CardNumber` varchar(20) NOT NULL,
  `SecurityQuestion` tinyint(1) NOT NULL DEFAULT '0',
  `SecurityAnswer` varchar(255) NOT NULL,
  `Theme` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Light',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`UserID`, `Username`, `Password`, `FullName`, `Email`, `PhoneNumber`, `Address`, `Newsletter`, `CardNumber`, `SecurityQuestion`, `SecurityAnswer`, `Theme`) VALUES
('U001', 'Leebecky', 'Ambrosia_06', 'Becky Lee', 'leebecky06@gmail.com', '012-3715205', 'Taman Sering Ukay, 68000 Ampang Selangor                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 1, '6892506824571274', 2, 'PJO', 'Light'),
('U002', 'test', 'pass', 'Tester Bot', 'fakeEmail@gmail.com', '-', 'Im homeless send help                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', 1, '12312312', 3, 'Pineapple Hill Convent', 'Dark');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`RecipeID`) REFERENCES `recipes` (`RecipeID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bookmarks_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user_account` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`Tags`) REFERENCES `tags` (`TagID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`Tags`) REFERENCES `tags` (`TagID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ClassID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user_account` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
