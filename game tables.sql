-- Game Table

SET SQL MODE  = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS 'games' (
	'game_id' int(10) NOT NULL AUTO_INCREMENT,
	'user_id' int(11) NOT NULL,
	'title' varchar(50) NOT NULL,
	'genre' varchar(50) NOT NULL,
	'platform' varchar(50) NOT NULL,
	'price' double(5,2) NOT NULL,
	'review_id' int(10) NOT NULL,
	'rating' varchar(50),
	'description' varchar(500),
	'review' varchar(500),
	PRIMARY KEY ('game_id')
)	ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1

INSERT INTO 'games' ('game_id', 'user_id', 'title', 'genre', 'platform,'
'price', 'review_id', 'rating', 'description', 'review') VALUES
(101, '', '')