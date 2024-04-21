select * from Users

IF EXISTS (SELECT * FROM Users WHERE Username='BilartCoin')
	BEGIN
		insert into Users(Username, Password)
		values('BilartCoinz', 'testpasdsword')
	END
ELSE
	BEGIN
		insert into Users(Username, Password)
		values('BilartCoin', 'testpassword')
	END

select * from Users
select * from UserExpenses


-- delete from UserExpenses
-- delete from Users

-- EXEC dbo.spSaveUser @username = 'BilartCoin', @password='password'
-- EXEC dbo.spSaveUserExpense @UserId=1, @Name ='Netflix Subscription', @PaymentType='Debit Card',@Date='2022-01-26',@Amount=9.99

-- DBCC CHECKIDENT ('Users', RESEED, 0);  
-- DBCC CHECKIDENT ('UserExpenses', RESEED, 0);  