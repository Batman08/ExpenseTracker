-- [spGetUserLoginDetails]
-- This will return a username and password 
-- ----------------------------------------

DROP procedure IF EXISTS `spGetUserLoginDetails`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserLoginDetails`(IN p_UsernameEntered Varchar(256))
BEGIN
	SELECT Username, Password
	FROM Users u
	WHERE u.Username = p_UsernameEntered;
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
    SELECT UserId INTO @UserId FROM Users u WHERE u.Username = p_Username;

    IF @UserId IS NULL THEN
        -- user does not exist so we'll insert
        INSERT INTO Users(Username, Password)
		VALUES (p_Username, p_Password);
        SET @UserId := LAST_INSERT_ID();
    END IF;
END$$
DELIMITER ;


-- [spSaveUserExpense]
-- This will save user expense
-- ---------------------------

DROP procedure IF EXISTS `spSaveUserExpense`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSaveUserExpense` (IN p_UserId INT, IN p_Name VARCHAR(256), IN p_PaymentType VARCHAR(256), IN p_Date DATE, IN p_Amount DOUBLE)
BEGIN
	INSERT INTO UserExpenses(UserId, Name, PaymentType, Date, Amount)
	VALUES(p_UserId, p_Name, p_PaymentType, p_Date, p_Amount);
END$$
DELIMITER ;


-- [spGetUserId]
-- This will get logged in user id
-- -------------------------------

DROP procedure IF EXISTS `spGetUserId`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserId` (IN p_Username VARCHAR(30))
BEGIN
	SELECT UserId FROM Users u WHERE u.Username = p_Username;
END$$
DELIMITER ;


-- [spGetAllUserExpenses]
-- This will get all user expenses
-- -------------------------------

DROP procedure IF EXISTS `spGetAllUserExpenses`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetAllUserExpenses` (IN p_UserId INT)
BEGIN
CREATE TEMPORARY TABLE Temp_AllExpenses
	SELECT Name, PaymentType, DATE_FORMAT(ex.Date, "%d %b %Y") AS Date, Amount
	FROM UserExpenses ex
	WHERE ex.UserId = p_UserId
	ORDER BY ex.UserExpensesId DESC;

	SET @row_number = 0;
	SELECT *, (@row_number:=@row_number + 1) AS RowNum
	FROM Temp_AllExpenses;
    
	DROP TEMPORARY TABLE Temp_AllExpenses;
END$$
DELIMITER ;


-- [spDeleteUserExpense]
-- This will delete a user expense
-- -------------------------------

DROP procedure IF EXISTS `spDeleteUserExpense`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDeleteUserExpense` (IN p_UserId INT, IN p_RowId INT)
BEGIN
CREATE TEMPORARY TABLE Temp_GetExpenseId
	SELECT UserExpensesId
	FROM UserExpenses ex
	WHERE ex.UserId = p_UserId
	ORDER BY ex.UserExpensesId DESC;

SET @row_number = 0;
CREATE TEMPORARY TABLE Temp_GetRowId    
	SELECT *, (@row_number:=@row_number + 1) AS RowNum
	FROM Temp_GetExpenseId;
    
SET @delete_id = 0;
    SELECT (@delete_id:=UserExpensesId)
    FROM Temp_GetRowId
    WHERE RowNum = p_RowId;
    
    DELETE FROM UserExpenses WHERE UserExpensesId = @delete_id;
    
    DROP TEMPORARY TABLE Temp_GetExpenseId;
	DROP TEMPORARY TABLE Temp_GetRowId;
END$$
DELIMITER ;


-- [spGetUserRowExpense]
-- This will get a specific row of user expense data
-- -------------------------------------------------

DROP procedure IF EXISTS `spGetUserRowExpense`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserRowExpense` (IN p_UserId INT, IN p_RowId INT)
BEGIN
CREATE TEMPORARY TABLE Temp_GetExpenseId
	SELECT *
	FROM UserExpenses ex
	WHERE ex.UserId = p_UserId
	ORDER BY ex.UserExpensesId DESC;

SET @row_number = 0;
CREATE TEMPORARY TABLE Temp_GetRowId    
	SELECT *, (@row_number:=@row_number + 1) AS RowNum
	FROM Temp_GetExpenseId;
    
    SELECT *
    FROM Temp_GetRowId
    WHERE RowNum = p_RowId;
    
    
    DROP TEMPORARY TABLE Temp_GetExpenseId;
	DROP TEMPORARY TABLE Temp_GetRowId;
END$$
DELIMITER ;


-- [spUpdateUserExpense]
-- This will update a specific user expense
-- ----------------------------------------

DROP procedure IF EXISTS `spUpdateUserExpense`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateUserExpense` (IN p_UserId INT, IN p_UpdateId INT, IN p_Name VARCHAR(256), IN p_PaymentType VARCHAR(256), IN p_Date DATE, IN p_Amount DOUBLE)
BEGIN
	CREATE TEMPORARY TABLE Temp_GetUpdateExpenseId
		SELECT *
		FROM UserExpenses ex
		WHERE ex.UserId = p_UserId
		ORDER BY ex.UserExpensesId DESC;
	
	SET @row_number = 0;
	CREATE TEMPORARY TABLE Temp_GetUpdateRowId    
		SELECT *, (@row_number:=@row_number + 1) AS RowNum
		FROM Temp_GetUpdateExpenseId;
		
		UPDATE UserExpenses ex
        INNER JOIN Temp_GetUpdateRowId tr on ex.UserExpensesId = tr.UserExpensesId
		SET ex.Name = p_Name, ex.PaymentType = p_PaymentType, ex.Date = p_Date, ex.Amount = p_Amount
		WHERE tr.RowNum = p_UpdateId;
		
		DROP TEMPORARY TABLE Temp_GetUpdateExpenseId;
		DROP TEMPORARY TABLE Temp_GetUpdateRowId;
END$$
DELIMITER ;


-- [spGetTotalUserExpenses]
-- This will get the total number of user expenses
-- -----------------------------------------------

DROP procedure IF EXISTS `spGetTotalUserExpenses`;
DELIMITER $$
CREATE PROCEDURE `spGetTotalUserExpenses` (IN p_UserId INT)
BEGIN
	SELECT COUNT(*) AS TotalUserExpenses
	FROM UserExpenses ex
	INNER JOIN Users u on ex.UserId = u.UserId
	WHERE u.UserId = p_UserId;
END$$
DELIMITER ;