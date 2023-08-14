-- create database test;
use music_2;

CREATE TABLE artists ( 
	artist_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	stage_name VARCHAR(50) NULL , 
	birth_name VARCHAR(50) NOT NULL , 
	date_of_birth DATE NOT NULL , 
	hometown VARCHAR(50) NULL , 
	date_of_death DATE NULL , 
	fun_fact TEXT NOT NULL 
) ;

CREATE TABLE genres ( 
	genre_id INT NOT NULL PRIMARY KEY  AUTO_INCREMENT , 
	genre VARCHAR(50) NOT NULL
) ;

CREATE TABLE albums ( 
	album_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	album_name VARCHAR(50) NOT NULL , 
	artist_id INT NOT NULL , 
	record_label VARCHAR(50) NOT NULL , 
	genre_id INT NOT NULL , 
	release_date DATE NOT NULL , 
	notable_fact TEXT NULL,
  FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
	FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
 );

CREATE TABLE songs ( 
	song_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	song_name VARCHAR(50) NOT NULL , 
	artist_id INT NOT NULL , 
	album_id INT NOT NULL  , 
	length_in_seconds INT NOT NULL , 
	comments TEXT NULL , 
	highest_billboard_ranking INT NULL , 
	date_of_billboard_ranking INT NULL , 
	writer_name VARCHAR(500) NOT NULL , 
  FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
  FOREIGN KEY (album_id) REFERENCES albums(album_id)
);








INSERT INTO artists 
	(stage_name, birth_name, date_of_birth, hometown, date_of_death, fun_fact) 
VALUES 
-- 1
	('Rihanna', 'Robyn Rihanna Fenty', '1988-02-20', 'Saint Michael, Barbados', NULL, 'Rihanna was an army cadet in a sub-military program in her native Barbados.'),
-- 2
	('Taylor Swift', 'Taylor Alison Swift', '1989-12-13', 'West Reading, Pennsylvania', NULL, "The songwriter has written songs like ‘Better Man’ for Little Big Town and the iconic track ‘You’ll Always Find Your Way Back Home’ from the generation-defining show, Hannah Montana."),
-- 3
	('Ariana Grande', 'Ariana Grande-Butera', '1993-06-26', 'Boca Raton, Florida', NULL, 'The musical icon is a big fan of all things Harry Potter, sharing that she is a Slytherin at heart. Ariana even has a tattoo including the word “Lumos,” inspired by the franchise. '),
-- 4
	('Tim McGraw', 'Samuel Timothy McGraw', '1967-05-01', 'Delhi, Louisiana', NULL, "McGraw holds a pilot's license and has an airplane.  'When I quit drinking, it was a good diversion, a good way to focus on something,' the country star says of flying."),
-- 5
	('Kanye West (Ye)', 'Kanye Omari West', '1977-06-08', 'Atlanta, Georgia', NULL, "Ye's shoe brand Yeezy is one of the most influential brands in the market."),
-- 6
	('Eminem', 'Marshall Bruce Mathers III', '1972-10-17', 'Saint Joseph, Missouri', NULL, "Contrary to the belief that he was named after the famous chocolate candy, Eminem came up with his stage name by combining the first initial of his first and last name. Sometimes, he also refers to Eminem as his “alter-ego” when he gets mad."),
-- 7
	('Lady Gaga', 'Stefani Joanne Angelina Germanotta', '1986-03-28', 'Yonkers, New York', NULL, 'Her Stage Name Was Inspired by Queen. Apparently, it was inspired by the Queen song, Radio Ga Ga.'),
-- 8
	('Billie Eilish', "Billie Eilish Pirate Baird O'Connell", '2001-12-18', 'Los Angeles, California', NULL, "Billie is the youngest person to win all four top awards at the Grammys in one year."),
-- 9
	('P!nk', 'Alecia Beth Moore', '1979-09-08', 'Doylestown, Pennsylvannia', NULL, "By the time she was 14, she'd already begun writing her own songs and had a regular singing gig every Friday night at a club in Philadelphia."),
-- 10
	('Miley Cyrus', 'Destiny Hope Cyrus', '1992-11-23', 'Franklin, Tennessee', NULL, "In her 2009 autobiography, Miley revealed she was born with tachycardia, a non-life-threatening condition that makes her heart beat much faster than the normal rate."),
-- 11
	('Alicia Keys', 'Alicia Augello Cook', '1981-01-25', "Hell's Kitchen, Manhattan", NULL, "At the age of 16, Alicia wanted the name Wilde to be her stage surname. However, her mom intervened, saying, “It sounds like you’re a stripper.” It was her manager who suggested “ Keys.” She turned out to like it as it resonated with her more as a performer and a person."),
-- 12
	('Selena Gomez', 'Selena Marie Gomez', '1992-07-22', 'Grand Prairie, Texas', NULL, "Gomez’s diverse heritage includes Mexican, Italian, and English roots. Growing up, she was exposed to different languages, and she can fluently speak English and Spanish.")
;

INSERT INTO genres 
	(genre) 
VALUES 
	('Pop'),
	('Hip Hop'),
 	('Country'),
  	('Rap'),
	('R&B')
;


INSERT INTO albums 
	(album_name, artist_id, record_label, genre_id, release_date, notable_fact) 
VALUES 
-- 1
	('Good Girl Gone Bad', 1, 'Def Jam Recordings', 1, '2007-03-29', "Rihanna revealed that she called the album Good Girl Gone Bad because it represents her bolder and more independent image"),
-- 2
	('Anti', 1, 'Westbury Road Roc Nation', 2, '2016-01-28', "Anti became the first album by a black female artist to spend 300 weeks on the Billboard 200."),
-- 3	
	('Fearless', 2, 'Big Machine', 3, '2008-11-11', "Fearless was the first album in history to win the American Music Award, Academy of Country Music Award, Country Music Association Award, and Grammy Award for Album of The Year in the same year, making it the most awarded album in the history of country music."),
-- 4	
	('Thank U, Next', 3, 'Republic', 1, '2019-02-08', "The album was inspired by the heartbreak and sadness Ariana was experiencing at the time from her ex's - Mac Miller's -- death , and the project almost didn't happen."),
-- 5
	('Greatest Hits', 4, 'Curb Records', 4, '2000-11-21', " This album topped the country albums charts for nine weeks and sold nearly 6 million copies, making this one of the biggest-selling albums in the modern country market."),
-- 6
	('Late Registration', 5, 'Roc‐A‐Fella Records', 2, '2005-08-30', "This album put Kanye $600,000 in debt."),
-- 7	
	('The Marshall Mathers LP', 6, ' Aftermath Entertainment and Interscope Records', 5, '2000-05-23', "Recorded over a two-month period in several studios around Detroit, the album features more introspective lyricism, including Eminem's thoughts on his rise from rags to riches, the criticism of his music, and his estrangement from his family and wife."),
-- 8
	('Born This Way', 7, 'Streamline, Kon Live, Interscope', 1, '2011-05-23', 'The song Born this Way from the album has become the LGBTQ+ theme song.'),	
-- 9
	('When We All Fall Asleep, Where Do We All Go?', 8, 'Interscope Records', 1, '2019-03-29', 'This album made Eilish the youngest female solo act to chart at number one.'),
-- 10
	('Greatest Hits... So Far!!!', 9, 'Jive', 1, '2010-11-12', 'Greatest Hits... So Far!!! is the first greatest hits album by American singer-songwriter Pink'),
-- 11
	('Bangerz', 10, 'RCA Records', 1, '2000-05-16,', "Miley earned a total of 54 nominations for 'Bangerz', its songs and music videos."),
-- 12
	('Songs in a Minor', 11, 'J Records', 2, '2001-06-05', 'Keys began writing the songs that would constitute Songs in A Minor at age 14.'),
-- 13
	('Revival', 12, ' Interscope Records', 1, '2015-10-09', "Selena's song “Good For You” was not intended to be the lead single from Revival. Nobody thought it would be a successful single, but Selena insisted.")
;


INSERT INTO songs 
	(song_name, artist_id, album_id, length_in_seconds, comments, highest_billboard_ranking, date_of_billboard_ranking, writer_name) 
VALUES 
-- Rihanna
	('Umbrella', 1, 1, 275, NULL, 1, '2007', 'Christopher Stewart'),
	("Don't Stop the Music", 1, 1, 267, NULL, 3, '2008', 'Tawanna Dabne'),
	("Shut up and Drive", 1, 1, 213, NULL, 15, '2007', 'Rivers Rutherford, Annie Tate, and Sam Tate'),
	('Cry', 1, 1, 235, NULL, NULL, NULL, 'Frankie Storm, Tor Erik Hermansen, Mikkel Storleer Eriksen'),
	('Needed Me', 1, 2, 185, NULL, 7, '2016', 'Rihanna, Brittany Hazard, Charles Hinshaw, Derrus Rachel, DJ Mustard, Twice as Nice, Frank Dukes'),
	('Love on the Brain', 1, 2, 224, NULL, 5, '2016', 'Joseph Angel'),
	('Never Ending', 1, 2, 203, NULL, NULL, NULL, 'Rihanna, Chad Sabo'),
	('Yeah, I said it', 1, 2, 133, NULL, NULL, NULL, 'Timbaland, Evon Barnes, Bibi Bourelly, Rihanna, Daniel Jones, Chris Godbey, Jean-Paul Bourelly'),
	('Hate that I Love You', 1, 1, 219, NULL, 7, '2007', 'Ne-Yo, Mikkel S. Eriksen, Tor Erik Hermansen'),
	('Lemme Get That', 1, 1, 221, NULL, NULL, NULL, 'Nash, Mosley and Carter'),
	('Rehab', 1, 1, 295, NULL, 18, '2008', "Justin Timberlake, Timbaland"),
	("Question Existing", 1, 1, 247, NULL, NULL, NULL, 'Robert Shea Taylor, Shaffer Smith, Shawn Carter'),
-- Taylor Swift 
	("Breathe", 2, 3, 264, NULL, NULL, NULL, 'Taylor Swift, Colbie Caillat'),
	('Forever & Always', 2, 3, 225, NULL, 34, '2008', 'Taylor Swift'),
	('Fifteen', 2, 3, 294, NULL, 23, '2008', 'Taylor Swift'),
	('Change', 2, 3, 280, NULL, 10, '2008', 'Taylor Swift'),
	('Fearless', 2, 3, 242, NULL, 78, '2008', 'Taylor Swift, Liz Rose, Hillary Lindsey'),
	('You Belong With Me', 2, 3, 231, NULL, 2, '2009', 'Taylor Swift, Liz Rose'),
	("You're not Sorry", 2, 3, 262, NULL, 11, '2008', 'Taylor Swift'),
	('The Best Day', 2, 3, 245, NULL, 56, '2009', 'Taylor Swift'),
	('White Horse', 2, 3, 234, NULL, 13, '2008', 'Taylor Swift'),
	('Love Story', 2, 3, 235, NULL, 4, '2009', 'Taylor Swift'),
-- Ariana Grande 
	('Thank u, Next', 3, 4, 207, NULL, 1, '2018', ' Ariana Grande, Tayla Parx, Victoria Monét'),
	('In My Head', 3, 4, 223, NULL, 38, '2019', 'Ariana Grande, Lindel Deon Nelson Jr., Jameel Roberts'),
	('NASA', 3, 4, 183, NULL, 17, '2019', 'Ariana Grande, Victoria Monét, Tayla Parx'),
	("Break up with your Girlfriend, I'm Bored", 3, 4, 191, NULL, 2, '2019', 'Ariana Grande, Savan Kotecha, Kandi Burruss, Kevin Briggs'),
	('Fake Smile', 4, 4, 209, NULL, 26, '2019', 'Andrew Wansel, Nathan Perez, Priscilla Renea, Kennedi Lykken, Justin Tranter, Ariana Grande, Joseph W. Frierson, Mary Lou Frierson'),
	('Imagine', 3, 4, 212, NULL, 24, '2018', 'Ariana Grande, Jameel Roberts and Priscilla Renea'),
	('Ghostin', 3, 4, 272, NULL, 25, '2019', 'Ariana Grande, Victoria Monét, Tayla Parx, Savan Kotecha'),
	('Bad Idea', 3, 4, 267, NULL, 27, '2019', 'Ariana Grande, Peter Svensson, Savan Kotecha,'),
	('7 Rings', 3, 4, 179, NULL, 1, '2019', 'Ariana Grande, Victoria Monét, Tayla Parx, Njomza, and Kaydence'),
-- Tim McGraw
	('Indian Outlaw', 4, 5, 181, NULL, NULL, NULL, 'John D. Loudermilk, Jumpin Gene Simmons, Tommy Barnes'),
	("Don't Take the Girl", 4, 5, 249, NULL, 17, '1994', 'John D. Loudermilk, Jumpin Gene Simmons, Tommy Barnes'),
	('She Never Lets It Go to Her Heart', 4, 5, 182, NULL, 73, '1994', 'Chris Waters, Tom Shapiro'),
	('I Like It, I Love It', 4, 5, 204, NULL, 25, '1995', 'Markus Hall, Jeb Stuart Anderson, Steve Dukes'),
	('Just to See You Smile', 4, 5, 214, NULL, 1, '1997', 'Mark Nesler, Tony Martin'),
	("It's Your Love (duet with Faith Hill)", 4, 5, 225, NULL, 1, '1997', 'Stephony Smith'),
	('Where the Green Grass Grows', 4, 5, 202, NULL, 79, '1998', 'Jess Leary, Craig Wiseman'),
	('Please Remember Me', 4, 5, 295, NULL, 51, '1999', 'Rodney Crowell, Will Jennings'),
-- Kanye West 
	('Drive Slow', 5, 6, 273, NULL, NULL, NULL, 'Kanye West, Pall Wall, GLC, Tony Williams'),
	('Gone', 5, 6, 363, NULL, 18, '2013', "Kanye West, Chuck Willis, Consequence, Cam'ron"),
	('Touch the Sky', 5, 6, 237, NULL, 42, '2006', 'Kanye West, Just Blaze, Lupe Fiasco, Curtis Mayfield'),
	('Roses', 5, 6, 246, NULL, NULL, NULL, 'Kanye West'),
	('Crack Music', 5, 6, 271, NULL, NULL, NULL,'Kanye West, The Game, Willard Meeks'),
	('Gold Digger', 5, 6, 208, NULL, 1, '2005','Kanye West, Ray Charles, Renald Richard'),
	('Late', 5, 6, 230, NULL, NULL, NULL, 'Kanye West, Sylvia Robinson & George Kerr.'),
	('My Way Home', 5, 6, 104, NULL, NULL, NULL, 'Kanye West and Common'),
	('Bring Me Down', 5, 6, 199, NULL, NULL, NULL, 'Kanye West, Jon Brion & Shy FX'),
	('Hey Mama', 5, 6, 305, NULL, 9, '2007', 'Kanye West'),
-- Emimen
	('Stan (featuring Dido)', 6, 7, 264, NULL, 51, '2000', 'Marshall Mathers, Dido Armstrong, Paul Herman'),
	('The Way I Am', 6, 7, 290, NULL, 58, '2000', 'Marshall Mathers'),
	('The Real Slim Shady', 6, 7, 284, NULL, 4, '2000', 'Marshall Mathers, Andre Young, Melvin Bradford, Paul Rosenberg, Dean Geistlinger'),
	('Remember Me?', 6, 7, 218, NULL, NULL, NULL, 'Marshall Mathers, Andre Young, Eric Collins, Kirk Jones'),
	("I'm Back", 6, 7, 310, NULL, NULL, NULL, 'Marshall Mathers, Andre Young, Melvin Bradford'),
	('Marshall Mathers', 6, 7, 320, NULL, NULL, NULL, 'Marshall Mathers, Bass Brothers'),
	('Kim', 6, 7, 377, NULL, NULL, NULL, 'Marshall Mathers, Bass Brothers'),
-- Lady Gaga
	('Marry the Night', 7, 8, 265, NULL, 57, '2011', 'Lady Gaga, Fernando Garibay'),
	('Born This Way', 7, 8, 260, NULL, 22, '2011', 'Lady Gaga, Jeppe Laursen, Fernando Garibay, Paul Blair'),
	('Government Hooker', 7, 8, 254, NULL, NULL, NULL, 'Lady Gaga, Fernando Garibay, Paul Blair, William Grigahcine, Clinton Sparks'),
	('Judas', 7, 8, 249, NULL, NULL, NULL, 'Lady Gaga, RedOne'),
	('Americano', 7, 8, 247, NULL, NULL, NULL, 'Lady Gaga, Fernando Garibay, Paul Blair, Brian Lee'),
	('The Edge of Glory', 7, 8, 321, NULL, 7, '2011', 'Lady Gaga, Fernando Garibay, Paul Blair'),
	('You and I', 7, 8, 307, NULL, 15, '2011', 'Lady Gaga'),
	('Heavy Metal Lover', 7, 8, 253, NULL, NULL, NULL, 'Lady Gaga, Fernando Garibay'),
-- Billie Eilish
	('Bad Guy', 8, 9, 194, NULL, 1, '2019', "Billie Eilish, Finneas O'Connell"),
	("Xanny", 8, 9, 243, NULL, 35, '2019', "Billie Eilish, Finneas O'Connell"),
	('You Should See me in a Crown', 8, 9, 180, NULL, 41, '2019', "Billie Eilish, Finneas O'Connell"),
	("All the Good Girls Go to Hell", 8, 9, 168, NULL, 46, '2019', "Billie Eilish, Finneas O'Connell"),
	('Wish you were Gay', 8, 9, 221, NULL, 31, '2019', "Billie Eilish, Finneas O'Connell"),
	("When the Party's Over", 8, 9, 196, NULL, 29, '2019', "Billie Eilish, Finneas O'Connell"),
	("My Strange Addiction", 8, 9, 180, NULL, 43, '2019', "Finneas O'Connell"),
	("Bury A Friend", 8, 9, 2019, NULL, 14, '2019', "Billie Eilish, Finneas O'Connell"),
-- P!nk
	('Get the Party Started', 9, 10, 191, NULL, NULL, NULL, 'Linda Perry'),
	("Don't Let Me Get Me", 9, 10, 211, NULL, NULL, NULL, "P!nk, Kevin 'She'kspere' Briggs, Kandi Burruss"),
	('Just Like A Pill', 9, 10, 237, NULL, NULL, NULL, 'P!nk, Kandi Burruss'),
	("Family Portrait", 9, 10, 296, NULL, NULL, NULL, 'P!nk, Scott Storch'),
	('Trouble', 9, 10, 192, NULL, NULL, NULL, 'P!nk, Tim Armstrong'),
	('Who Knew', 9, 10, 208, NULL, 4, '2008', 'P!nk, Max Martin, Lukasz Gottwald'),
	('U + Ur Hand', 9, 10, 214, NULL, NULL, NULL, 'P!nk, Max Martin, Lukasz Gottwald, Rami Yacoub'),
	('So What', 9, 10, 215, NULL, 9, '2008', 'P!nk, Max Martin, Shellback'),
	("Please Don't Leave Me", 9, 10, 231, NULL, 5, '2009', 'P!nk, Max Martin'),
	("Raise Your Glass", 9, 10, 203, NULL, 9, '2011', 'P!nk, Max Martin, Shellback'),
	("Fuckin' Perfect", 9, 10, 210, NULL, 2, '2011', 'P!nk'),
-- Miley Cyrus
	('My Darlin', 10, 11, 243,NULL, NULL, NULL, 'Ben E. King, Mike Stoller, Jerry Leiber, Mike WiLL Made-It, Jeremih, Future, P-Nasty, Miley Cyrus'),
	('Hands in the Air', 10, 11, 202,NULL, NULL, NULL, 'M. Williams, Pierre Ramon Slaughter, Samuel Jean, Asia Bryant, Miley Cyrus, Marshall Mathers'),
	("Maybe You're Right", 10, 11, 214,NULL, NULL, NULL, 'Miley Cyrus, Tyler Johnson, Mike Will Made-It, Cam, John Shanks'),
	('Adore You', 10, 11, 279,NULL, 21, '2013', 'Oren Yoel, Stacy Barthe'),
	('Drive', 10, 11, 255, NULL, NULL, NULL, 'Mike Will Made It, Miley Cyrus, Pierre Ramon Slaughter, and Samuel Jean'),
	('FU', 10, 11, 230, NULL, NULL, NULL, 'Miley Cyrus, Rami Samir Afuni, French Montana, and MoZella'),
	('SMS ', 10, 11, 170, NULL, NULL, NULL, 'Miley Cyrus, Mike Will Made It, Sean Garrett, Marz, Hurby Azor, Ray Davies, Jamie Starr, Morris Day, Jesse Johnson, James Brown'),
	("We Can't Stop", 10, 11, 231, NULL, 2, '2013', 'Mike Will Made It, P-Nasty, Rock City, Miley Cyrus, Doug E. Fresh, Slick Rick'),
	('Love Money Party', 10, 11, 220, NULL, NULL, NULL, 'Michael L. Williams ll, Marquel Middlebrooks, Sean Anderson, Sean Garrett, Miley Cyrus'),
	('Wrecking Ball', 10, 11, 221, NULL, 1, '2013', 'MoZella, Stephan Moccio, Sacha Skarbek, Dr. Luke, Cirkut'),
	('Do My Thang', 10, 11, 226, NULL, NULL, NULL, 'Miley Cyrus, William Adams, Michael McHenry, Ryan "DJ Replay" Buendia, Kyle Edwards, Jean-Baptiste'),
-- Alicia Keys 
	("Girlfriend", 11, 12, 214, NULL, 82, '2001', 'Alicia Keys, Jermaine Dupri, Joshua Thompson'),
	("How Come U Don’t Call Me Anymore", 11, 12, 230, NULL, 30, '2002', 'Prince'),
	("Fallin", 11, 12, 210, NULL, 1, '2002', "Alicia Keys"),
	('Troubles', 11, 12, 268, NULL, NULL, NULL, "Alica Keys, Kerry Brothers Jr"),
	("A Woman's Worth", 11, 12, 303, NULL, 3, '2001', 'Alica Keys, Erika Rose'),
	("Jane Doe", 11, 12, 228, NULL, NULL, NULL, 'Alica Keys, Kandi Burruss'),
	('Butterflyz', 11, 12, 394, NULL, NULL, NULL, 'Alicia Keys'),
	('Caged Bird', 11, 12, 182, NULL, NULL, NULL, 'Alicia Keys'),
	('Mr Man', 11, 11, 250, NULL, NULL, NULL, 'Jimmy Cozier, Alicia Keys'),
	('Why Do I Feel So Sad', 11, 11, 266, NULL, NULL, NULL, "Alicia Keys, Warryn Campbell"),
-- Selena Gomez
	('Good for You', 12, 13, 221, NULL, 4, '2015', 'Julia Michaels, Justin Tranter, Nick Monson, Nolan Lambroza, Rakim Mayers, Hector Delgado, Selena Gomez'),
	('Body Heat', 12, 13, 208, NULL, NULL, NULL, 'Hit-Boy, Justin Tranter, Julia Michaels, Antonina Armato, Tim James, Selena Gomez'),
	('Hands to Myself', 12, 13, 201, NULL, 7, '2016', 'Justin Tranter, Julia Michaels, Robin Fredriksson, Mattias Larsson, Max Martin, Selena Gomez.'),
	('Same Old Love', 12, 13, 229, NULL, 5, '2016', 'Charli XCX, Ross Golan'),
	('Sober', 12, 13, 195, NULL, 22, '2015', 'Selena Gomez, Chloe Angelides, Jacob Kasher Hindlin, Julia Michaels, Tor Hermansen, Mikkel Eriksen'),
	('Kill Em with Kindness', 12, 13, 217, NULL, 39, '2015', "Selena Gomez, Rock Mafia, Benny Blanco, Dave Audé"),
	("Revival", 12, 13, 246, NULL, 3, '2014', 'Selena Gomez, Nick Monson')
;







