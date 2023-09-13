CREATE SCHEMA [aud]
GO

CREATE TABLE [dbo].[ZIGMIE](
	[ZIGMIECOD] [int] IDENTITY(1,1) NOT NULL,
	[ZIGMIEEST] [int] NOT NULL,
	[ZIGMIENOM] [varchar](250) NOT NULL,
    [ZIGMIEAPE] [varchar](250) NOT NULL,
    [ZIGMIEDOC] [char](20) NOT NULL,
    [ZIGMIEFNA] [date] NOT NULL,
    [ZIGMIECOR] [varchar](100) NOT NULL,
    [ZIGMIECON] [varchar](MAX) NOT NULL,
    [ZIGMIECEL] [char](10) NOT NULL,
	[ZIGMIEAUS] [char](20) NOT NULL,
	[ZIGMIEAFH] [datetime] NOT NULL,
	[ZIGMIEAIP] [char](20) NOT NULL,
 CONSTRAINT [PK_ZIGMIECOD] PRIMARY KEY CLUSTERED ([ZIGMIECOD] ASC) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]) ON [PRIMARY]
GO

CREATE TABLE [aud].[ZIGMIE](
	[ZIGMIEIDD] [int] IDENTITY(1,1) NOT NULL,
	[ZIGMIEAME] [char](20) NOT NULL,
	[ZIGMIEAUS] [char](20) NOT NULL,
	[ZIGMIEAFH] [datetime] NOT NULL,
	[ZIGMIEAIP] [char](20) NOT NULL,
    [ZIGMIECOD] [int],
	[ZIGMIEEST] [int],
	[ZIGMIENOM] [varchar](250),
    [ZIGMIEAPE] [varchar](250),
    [ZIGMIEDOC] [char](20),
    [ZIGMIEFNA] [date],
    [ZIGMIECOR] [varchar](100),
    [ZIGMIECON] [varchar](MAX),
    [ZIGMIECEL] [char](10),
 CONSTRAINT [PK_ZIGMIEIDD] PRIMARY KEY CLUSTERED ([ZIGMIEIDD] ASC) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]) ON [PRIMARY]
GO

CREATE TRIGGER [dbo].[ZIGMIE_INSERT] 
	ON [dbo].[ZIGMIE]
	AFTER INSERT
	AS
	BEGIN
		SET NOCOUNT ON;
		INSERT INTO [aud].[ZIGMIE] (ZIGMIEAME, ZIGMIEAUS, ZIGMIEAFH, ZIGMIEAIP, ZIGMIECOD, ZIGMIEEST, ZIGMIENOM, ZIGMIEAPE, ZIGMIEDOC, ZIGMIEFNA, ZIGMIECOR, ZIGMIECON, ZIGMIECEL)
		SELECT 'INSERT AFTER', i.ZIGMIEAUS, GETDATE(), i.ZIGMIEAIP, i.ZIGMIECOD, i.ZIGMIEEST, i.ZIGMIENOM, i.ZIGMIEAPE, i.ZIGMIEDOC, i.ZIGMIEFNA, i.ZIGMIECOR, i.ZIGMIECON, i.ZIGMIECEL FROM INSERTED i;
	END
GO

CREATE TRIGGER [dbo].[ZIGMIE_UPDATE] 
	ON [dbo].[ZIGMIE]
	AFTER UPDATE
	AS
	BEGIN
		SET NOCOUNT ON;
		INSERT INTO [aud].[ZIGMIE] (ZIGMIEAME, ZIGMIEAUS, ZIGMIEAFH, ZIGMIEAIP, ZIGMIECOD, ZIGMIEEST, ZIGMIENOM, ZIGMIEAPE, ZIGMIEDOC, ZIGMIEFNA, ZIGMIECOR, ZIGMIECON, ZIGMIECEL)
		SELECT 'UPDATE BEFORE', d.ZIGMIEAUS, GETDATE(), d.ZIGMIEAIP, d.ZIGMIECOD, d.ZIGMIEEST, d.ZIGMIENOM, d.ZIGMIEAPE, d.ZIGMIEDOC, d.ZIGMIEFNA, d.ZIGMIECOR, d.ZIGMIECON, d.ZIGMIECEL FROM DELETED d;

		INSERT INTO [aud].[ZIGMIE] (ZIGMIEAME, ZIGMIEAUS, ZIGMIEAFH, ZIGMIEAIP, ZIGMIECOD, ZIGMIEEST, ZIGMIENOM, ZIGMIEAPE, ZIGMIEDOC, ZIGMIEFNA, ZIGMIECOR, ZIGMIECON, ZIGMIECEL)
		SELECT 'UPDATE AFTER', i.ZIGMIEAUS, GETDATE(), i.ZIGMIEAIP, i.ZIGMIECOD, i.ZIGMIEEST, i.ZIGMIENOM, i.ZIGMIEAPE, i.ZIGMIEDOC, i.ZIGMIEFNA, i.ZIGMIECOR, i.ZIGMIECON, i.ZIGMIECEL FROM INSERTED i;
	END
GO

CREATE TRIGGER [dbo].[ZIGMIE_DELETE] 
	ON [dbo].[ZIGMIE]
	AFTER DELETE
	AS
	BEGIN
		SET NOCOUNT ON;
		INSERT INTO [aud].[ZIGMIE] (ZIGMIEAME, ZIGMIEAUS, ZIGMIEAFH, ZIGMIEAIP, ZIGMIECOD, ZIGMIEEST, ZIGMIENOM, ZIGMIEAPE, ZIGMIEDOC, ZIGMIEFNA, ZIGMIECOR, ZIGMIECON, ZIGMIECEL)
		SELECT 'DELETE BEFORE', d.ZIGMIEAUS, GETDATE(), d.ZIGMIEAIP, d.ZIGMIECOD, d.ZIGMIEEST, d.ZIGMIENOM, d.ZIGMIEAPE, d.ZIGMIEDOC, d.ZIGMIEFNA, d.ZIGMIECOR, d.ZIGMIECON, d.ZIGMIECEL FROM DELETED d;
	END
GO