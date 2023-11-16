SELECT tDiaryBookPayment.*, tDiaryBook.DateDiaryBook, tTypePayment.NameTypePayment, tSubTypePayment.NameSubTypePayment, tCash.IsCash, tCurrency.NameCurrency
FROM ((((
	tDiaryBookPayment 
	
	LEFT JOIN tDiaryBook ON tDiaryBookPayment.ID_DiaryBook = tDiaryBook.ID_DiaryBook) 
	LEFT JOIN tTypePayment ON tDiaryBookPayment.ID_TypePayment = tTypePayment.ID_TypePayment) 
	LEFT JOIN tSubTypePayment ON tDiaryBookPayment.ID_SubTypePayment = tSubTypePayment.ID_SubTypePayment) 
	LEFT JOIN tCash ON tDiaryBookPayment.ID_Cash = tCash.ID_Cash) 
	LEFT JOIN tCurrency ON tDiaryBookPayment.ID_Currency = tCurrency.ID_Currency
	
	
ORDER BY tDiaryBook.DateDiaryBook, tTypePayment.UserIndex, tSubTypePayment.UserIndex, tCash.ID_Cash, tCurrency.ID_Currency;
------------------------


SELECT tDiaryBookPayment.*,tDiaryBook.DateDiaryBook,tTypePayment.NameTypePayment,tSubTypePayment.NameSubTypePayment,tCash.IsCash,tCurrency.NameCurrency FROM ((((( tDiaryBookPayment 
	LEFT JOIN tDiaryBook ON tDiaryBookPayment.ID_DiaryBook) 
	LEFT JOIN tTypePayment ON tDiaryBookPayment.ID_TypePayment) 
	LEFT JOIN tSubTypePayment ON tDiaryBookPayment.ID_SubTypePayment) 
	LEFT JOIN tCash ON tDiaryBookPayment.ID_Cash) 
	LEFT JOIN tCurrency ON tDiaryBookPayment.ID_Currency)













let
	sqlQuery = '',
	selectFields = '',
	leftJoin = '',
	orderBy = '';



sourceContent: {
	nameTable: 'DiaryBookPayment',
	nameFields: [
		'*'
	],
	indexField: '',
	childTables: [
		{
			nameTable: 'DiaryBook',
			idField: 'ID_DiaryBook',
			nameFields: [
				'DateDiaryBook'
			],
			indexField: 'DateDiaryBook',
		},
		{
			nameTable: 'TypePayment',
			idField: 'ID_TypePayment',
			nameFields: [
				'NameTypePayment'
			],
			indexField: 'UserIndex',
		},
		{
			nameTable: 'SubTypePayment',
			idField: 'ID_SubTypePayment',
			nameFields: [
				'NameSubTypePayment'
			],
			indexField: 'UserIndex',
		},
		{
			nameTable: 'Cash',
			idField: 'ID_Cash',
			nameFields: [
				'IsCash'
			],
			indexField: 'ID_Cash',
		},
		{
			nameTable: 'Currency',
			idField: 'ID_Currency',
			nameFields: [
				'NameCurrency'
			],
			indexField: 'ID_Currency',
		},
	],
}















=======================
sourceContent: {
	nameTable: 'DiaryBookPayment',
	nameFields: [
		'*'
	],
	indexField: '',
	childTables: [
		{
			nameTable: 'DiaryBook',
			idField: 'ID_DiaryBook',
			nameFields: [
				'DateDiaryBook'
			],
			indexField: 'DateDiaryBook',
		},
		{
			nameTable: 'TypePayment',
			idField: 'ID_TypePayment',
			nameFields: [
				'NameTypePayment'
			],
			indexField: 'UserIndex',
		},
		{
			nameTable: 'SubTypePayment',
			idField: 'ID_SubTypePayment',
			nameFields: [
				'NameSubTypePayment'
			],
			indexField: 'UserIndex',
		},
		{
			nameTable: 'Cash',
			idField: 'ID_Cash',
			nameFields: [
				'IsCash'
			],
			indexField: 'ID_Cash',
		},
		{
			nameTable: 'Currency',
			idField: 'ID_Currency',
			nameFields: [
				'NameCurrency'
			],
			indexField: 'ID_Currency',
		},
	],
},

