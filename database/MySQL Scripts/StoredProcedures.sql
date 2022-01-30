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


-- [spSaveUserLoginDetails]
-- This will save user login details 
-- ---------------------------------

DROP procedure IF EXISTS `spSaveUserLoginDetails`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSaveUserLoginDetails`(IN p_Username VARCHAR(30), IN p_Password VARCHAR(50))
BEGIN
-- get user from username
    SELECT UserId INTO @UserId FROM Users WHERE Username = p_Username;

    IF @UserId IS NULL THEN
        -- user does not exist so we'll insert
        INSERT INTO Users(Username, Password)
		VALUES (p_Username, p_Password);
        SET @UserId := LAST_INSERT_ID();
    END IF;
END$$
DELIMITER ;