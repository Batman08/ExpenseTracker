USE `ExpenseTracker`;
 
-- [Users]
-- --------

CREATE TABLE Users(
	`UserId` int AUTO_INCREMENT NOT NULL,
	`Username` nvarchar(30) NOT NULL,
	`Password` nvarchar(50) NOT NULL,
 CONSTRAINT `PK_Users_1` PRIMARY KEY 
(
	`UserId` ASC
) ,
 CONSTRAINT `IX_Users` UNIQUE 
(
	`Username` ASC
) 
);


-- [UserExpenses]
-- ---------------

CREATE TABLE UserExpenses(
	`UserExpensesId` int AUTO_INCREMENT NOT NULL,
	`UserId` int NOT NULL,
	`Name` nvarchar(256) NOT NULL,
	`PaymentType` nvarchar(25) NOT NULL,
	`Date` date NOT NULL,
	`Amount` Double NOT NULL,
 CONSTRAINT `PK_UserExpenses` PRIMARY KEY 
(
	`UserExpensesId` ASC
) ,

CONSTRAINT `FK_UserExpenses_Users` FOREIGN KEY(`UserId`)REFERENCES Users (`UserId`)
 );