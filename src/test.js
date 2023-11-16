const sourceContent = {
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



let
	sqlQuery = 'SELECT ',
	selectFields = '',
	hooks = '',
	leftJoin = '',
	orderBy = '';

for (let key in sourceContent.nameFields) {
	selectFields += ',' + sourceContent.nameTable + '.' + sourceContent.nameFields[key];
};

for (let key in sourceContent.childTables) {
	for (let ind in sourceContent.childTables[key].nameFields) {
		selectFields += ',' + sourceContent.childTables[key].nameTable + '.' + sourceContent.childTables[key].nameFields[ind];
		orderBy += ',' + sourceContent.childTables[key].nameTable + '.' + sourceContent.childTables[key].indexField;
	}

	hooks += '(';
	leftJoin += ' \nLEFT JOIN ' + sourceContent.childTables[key].nameTable + ' ON ' + sourceContent.nameTable + '.' + sourceContent.childTables[key].idField + '=' + sourceContent.childTables[key].nameTable + '.' + sourceContent.childTables[key].idField + ')';
};

selectFields = selectFields.substr(1);
orderBy = orderBy.substr(1);
sqlQuery += selectFields + ' \nFROM ' + hooks + ' ' + sourceContent.nameTable + leftJoin + ' \nORDER BY ' + orderBy + ';';

console.log(sqlQuery);
