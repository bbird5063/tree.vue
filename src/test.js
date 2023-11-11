let arr1 = [
	'{ "id": 1, "title": "Node 1", "isFolder": 1}',
	'{ "id": 2, "title": "Node 2", "isFolder": 0}',
	'{ "id": 3, "title": "Node 3", "isFolder": 1}',
];
//console.log(arr1);
let arr0 = [1, 2, 3]
//let str1 = "{ 'id': 3, 'title': 'Node 3', 'isFolder': 0}";
//let str1 = '{ "id": 3, "title": "Node 3", "isFolder": 0}';

//let str2 = JSON.parse(str1);
//let str2 = JSON.stringify(str1);
let arr2 = arr1.map(x => JSON.parse(x));

console.log(arr2);