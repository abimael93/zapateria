// Code goes here

var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination']);

function MyController($scope) {

  $scope.currentPage = 1;
  $scope.pageSize = 10;
  $scope.meals = [];

  var dishes = [
    'noodles',
    'sausage',
    'beans on toast',
    'cheeseburger',
    'battered mars bar',
    'crisp butty',
    'yorkshire pudding',
    'wiener schnitzel',
    'sauerkraut mit ei',
    'salad',
    'onion soup',
    'bak choi',
    'avacado maki'
  ];
  var sides = [
    'with chips',
    'a la king',
    'drizzled with cheese sauce',
    'with a side salad',
    'on toast',
    'with ketchup',
    'on a bed of cabbage',
    'wrapped in streaky bacon',
    'on a stick with cheese',
    'in pitta bread'
  ];
  $scope.meals = [
    {
        rendering: 'Trident', browser: 'Internet Explorer 4.0', plataform: 'Win 95+', version: '4',
        grade: 'X'
    },
    {
        rendering: 'Trident', browser: 'Internet Explorer 5.0', plataform: 'Win 95+', version: '5',
        grade: 'C'
    },
    {
        rendering: 'Trident', browser: 'Internet Explorer 5.5', plataform: 'Win 95+', version: '5.5',
        grade: 'A'
    },
    {
        rendering: 'Trident', browser: 'Internet Explorer 6', plataform: 'Win 98+', version: '6',
        grade: 'A'
    },
    {
        rendering: 'Trident', browser: 'Internet Explorer 7', plataform: 'Win XP SP2+', version: '7',
        grade: 'A'
    },
    {
        rendering: 'Trident', browser: 'AOL browser (AOL desktop)', plataform: 'Win XP', version: '6',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Firefox 1.0', plataform: 'Win 98+ / O,SX.2+', version: '1.7',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Firefox 1.5', plataform: 'Win 98+ / O,SX.2+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Firefox 2.0', plataform: 'Win 98+ / O,SX.2+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Firefox 3.0', plataform: 'Win 2k+ / O,SX.3+', version: '1.9',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Camino 1.0', plataform: 'OSX.2+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Camino 1.5', plataform: 'OSX.3+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Netscape 7.2', plataform: 'Win 95+ / Ma,c OS 8.6-9.2', version: '1.7',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Netscape Browser 8', plataform: 'Win 98SE+', version: '1.7',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Netscape Navigator 9', plataform: 'Win 98+ / OSX.2+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.0', plataform: 'Win 95+ / O,SX.1+', version: '1',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.1', plataform: 'Win 95+ / O,SX.1+', version: '1.1',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.2', plataform: 'Win 95+ / O,SX.1+', version: '1.2',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.3', plataform: 'Win 95+ / O,SX.1+', version: '1.3',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.4', plataform: 'Win 95+ / O,SX.1+', version: '1.4',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.5', plataform: 'Win 95+ / O,SX.1+', version: '1.5',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.6', plataform: 'Win 95+ / O,SX.1+', version: '1.6',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.7', plataform: 'Win 98+ / O,SX.1+', version: '1.7',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Mozilla 1.8', plataform: 'Win 98+ / O,SX.1+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Seamonkey 1.1', plataform: 'Win 98+ / OSX,.2+', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Gecko', browser: 'Epiphany 2.20', plataform: 'Gnome', version: '1.8',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'Safari 1.2', plataform: 'OSX.3', version: '125.5',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'Safari 1.3', plataform: 'OSX.3', version: '312.8',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'Safari 2.0', plataform: 'OSX.4+', version: '419.3',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'Safari 3.0', plataform: 'OSX.4+', version: '522.1',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'OmniWeb 5.5', plataform: 'OSX.4+', version: '420',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'iPod Touch / iPhone', plataform: 'iPod', version: '420.1',
        grade: 'A'
    },
    {
        rendering: 'Webkit', browser: 'S60', plataform: 'S60,', version: '413',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 7.0', plataform: 'Win 95+ /, OSX.1+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 7.5', plataform: 'Win 95+ /, OSX.2+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 8.0', plataform: 'Win 95+ /, OSX.2+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 8.5', plataform: 'Win 95+ /, OSX.2+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 9.0', plataform: 'Win 95+ /, OSX.3+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 9.2', plataform: 'Win 88+ /, OSX.3+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera 9.5', plataform: 'Win 88+ /, OSX.3+', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Opera for Wii', plataform: 'Wii', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Nokia N800', plataform: 'N800', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Presto', browser: 'Nintendo DS browser', plataform: 'Nintendo DS', version: '8.5',
        grade: 'C/A<sup>1<'
        },
    {
        rendering: 'KHTML', browser: 'Konqureror 3.1', plataform: 'KDE 3.1', version: '3.1',
        grade: 'C'
    },
    {
        rendering: 'KHTML', browser: 'Konqureror 3.3', plataform: 'KDE 3.3', version: '3.3',
        grade: 'A'
    },
    {
        rendering: 'KHTML', browser: 'Konqureror 3.5', plataform: 'KDE 3.5', version: '3.5',
        grade: 'A'
    },
    {
        rendering: 'Tasman', browser: 'Internet Explorer 4.5', plataform: 'Mac OS 8-9', version: '-',
        grade: 'X'
    },
    {
        rendering: 'Tasman', browser: 'Internet Explorer 5.1', plataform: 'Mac OS 7.6-9', version: '1',
        grade: 'C'
    },
    {
        rendering: 'Tasman', browser: 'Internet Explorer 5.2', plataform: 'Mac OS 8-X', version: '1',
        grade: 'C'
    },
    {
        rendering: 'Misc', browser: 'NetFront 3.1', plataform: 'Embedded dev,ices', version: '-',
        grade: 'C'
    },
    {
        rendering: 'Misc', browser: 'NetFront 3.4', plataform: 'Embedded dev,ices', version: '-',
        grade: 'A'
    },
    {
        rendering: 'Misc', browser: 'Dillo 0.8', plataform: 'Embedded ,devices', version: '-',
        grade: 'X'
    },
    {
        rendering: 'Misc', browser: 'Links', plataform: 'Text ,only', version: '-',
        grade: 'X'
    },
    {
        rendering: 'Misc', browser: 'Lynx', plataform: 'Text, only', version: '-',
        grade: 'X'
    },
    {
        rendering: 'Misc', browser: 'IE Mobile', plataform: 'Windows M,obile 6', version: '-',
        grade: 'C'
    },
    {
        rendering: 'Misc', browser: 'PSP browser', plataform: 'PSP', version: '-',
        grade: 'C'
    },
    {
        rendering: 'Other browsers', browser: 'All others', plataform: '-', version: '-',
        grade: 'U'
    }
  ];
  /*
  for (var i = 1; i <= 100; i++) {
    var dish = dishes[Math.floor(Math.random() * dishes.length)];
    var side = sides[Math.floor(Math.random() * sides.length)];
    $scope.meals.push({meal: 'meal ', id: i, dishh : dish, sidee: side});
  }*/
  
  $scope.pageChangeHandler = function(num) {
      console.log('meals page changed to ' + num);
  };
}

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}

myApp.controller('MyController', MyController);
myApp.controller('OtherController', OtherController);