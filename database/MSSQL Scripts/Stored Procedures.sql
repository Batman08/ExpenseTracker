USE [ExpenseTracker]
GO

-- [spSaveUser]
-- This will save the user account details
------------------------------------------

CREATE PROC [dbo].spSaveUser
	@username NVARCHAR(30), @password NVARCHAR(30)
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO Users(Username, Password)
	VALUES(@username, @password)
END;
GO


-- [spSaveUserExpense]
-- This will save the users inputed expense item
------------------------------------------------

CREATE PROC [dbo].spSaveUserExpense
	@UserId INT, 
	@Name NVARCHAR(256), 
	@PaymentType NVARCHAR(25),
	@Date DATE,
	@Amount FLOAT
AS
BEGIN
    SET NOCOUNT ON;

    insert into UserExpenses(UserId, Name, PaymentType, Date, Amount)
	values(@UserId, @Name, @PaymentType, @Date, @Amount)
END;
GO