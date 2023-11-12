//import { slice } from "core-js/core/array";

sourceTree = {
	nameTable: 'credit',
	idField: 'Credit',
	nameField: 'NameCredit',
	indexField: 'UserIndex',
	childTable: {
		nameTable: 'typepayment',
		idField: 'ID_TypePayment',
		nameField: 'NameTypePayment',
		indexField: 'UserIndex',
		childTable: {
			nameTable: 'subtypepayment',
			idField: 'ID_SubTypePayment',
			nameField: 'NameSubTypePayment',
			indexField: 'UserIndex',
		}
	}
}

//sourceTree.id = 11111;
//console.log(sourceTree);
//console.log('-----------------------');
//sourceTree = sourceTree.childTable;
//sourceTree.id = 22222;
//console.log(sourceTree);
//console.log('-----------------------');
//sourceTree = sourceTree.childTable;
//sourceTree.id = 33333;
//console.log(sourceTree);

let test = 'ID_TypePayment-12';
//let pos = test.indexOf('=');
//console.log(pos);
//let test2 = test.slice(0, pos);
let test2 = test.slice(0, test.indexOf('-'));
console.log(test2);