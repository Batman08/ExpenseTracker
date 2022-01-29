-- [spGetUserLoginDetails]
-- This will return a username and password 
-- ----------------------------------------

DROP procedure IF EXISTS `spGetUserLoginDetails`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserLoginDetails`(IN p_UsernameEntered Varchar(256))
BEGIN
	SELECT Username, Password
	FROM Users
	WHERE Username = p_UsernameEntered;
END$$
DELIMITER ;