//Check if cookie exists, rework accordingly
/*if(document.cookie.indexOf('pid=') > -1) {
	console.log("I'm finding this stupid cookie")
	window.location.href = '/panel.html';

}*/

var myserviceportal = angular.module('myserviceportal', ['ngMaterial']);

myserviceportal.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('\\\\\\');
    $interpolateProvider.endSymbol('\\\\\\');
  });

myserviceportal.config(function($mdThemingProvider) {
	$mdThemingProvider.alwaysWatchTheme(true);
	$mdThemingProvider.theme('default').primaryPalette('indigo', { 'default': '700' });
	$mdThemingProvider.theme('default').accentPalette('indigo', { 'default': '200' });
	$mdThemingProvider.theme('default').warnPalette('red', {'default' : '200'});
});




myserviceportal.controller('uctrl', function uctrl($scope, $interval, $http, $location, $mdDialog, $filter, $mdSidenav) {
	$scope.done_loading = false;
	$scope.options = [{
		"name": "Groups",
		"icon": "fa-group"
	},
	{
		"name": "Events",
		"icon": "fa-calendar"
	},
	{
		"name": "Upload",
		"icon": "fa-upload"
	},
	{
		"name": "Support",
		"icon": "fa-question"
	}];


	//Setup search functionality
	$scope.header_search = "";
	$scope.selected_asset = "upload";
	$scope.selected_report = "players";
	$scope.upload_in_progress = false;

	//Reports:
	$scope.players_online = 0;
	$scope.active_subscriptions = 0;
	$scope.offenses_pending = 0;
	$scope.current_group = {
		"data": {
				"TITLE":"",
				"SYS_ID":"",
				"DESCRIPTION":"",
				"TARGET_AUDIENCE":"",
				"MEET_DAY":"",
				"MEET_TIME_START":"",
				"MEET_TIME_END":"",
				"DURATION":"",
				"LEADER":"",
				"PHONE_NUMBER":"",
				"EMAIL":"",
				"CAMPUS":"",
				"COST":"",
				"WHY":"",
				"GUID":"",
				"SYS_CREATED_ON":"",
				"SYS_ID":"",
				"CARE_PROVIDED":"",
				"ACTIVE":""
			},
		"table":"Groups"
		};


	$scope.current_event = {
		"data": {
			'SYS_EVENT_DATE': new Date()
			},
		"table":"Events"
		};

	$scope.current_ticket = {
		"data": {
			"GUID":"",
			"SYS_ID":"",
			"SYS_CREATED_ON":"",
			"OPENED_BY":"",
			"CONTACT_EMAIL":"",
			"DESCRIPTION": "",
			"MODULE":"",
			"PRIORITY":"",
			"IMPACT":"",
			"STATUS":"",
			"SYS_CREATED_BY":"",
			"ACTIVE":"",
		},
		"table":"Incident"
	};


	$scope.new_asset_data = {
		"title":"",
		"asset_type":"",
		"url":""
	};

	$scope.search_header = function() {
		//take in header_search and deliver a page with results.
		window.open(baseUrl + "?search=" + encodeURIComponent($scope.header_search.trim()), "_self");
	}


	//PROFILE FUNCITONALITY GOES HERE!
	$scope.get_profile = function() {
		//We want to parse out profile data to create functions for:
		//get_display_name();
		//get_user_id();
		//get_session_id();
		//get_initials();
		$http.get("../assets/php/get_user_info.php")
		.then(function (response) {
		$scope.user = response.data;
		console.log($scope.user);
		});
	}

	$scope.get_profile();

	$scope.get_integrations = function() {

	}

	$scope.get_groups = function() {
		//Test if there is a sys_id
		if($scope.urlparms.Sys_id != null) {
			$scope.get_record($scope.urlparms.Table, $scope.urlparms.Sys_id);
			$scope.groups_sub_selected = 'edit';
			//$scope.record.Table = "Posts"
		}

		if($scope.urlparms.Option != null) {
			$scope.groups_sub_selected = $scope.urlparms.Option;
		}

		$http.get("../assets/php/small_groups.php")
		.then(function (response) {
			$scope.posts = response.data;
			console.log($scope.posts);
			for(var b in $scope.posts) {
				$scope.posts[b]['DATE_SUBMITTED'] = new Date($scope.posts[b]['DATE_SUBMITTED']).toDateString();
			}
		});
	}

		$scope.get_events = function() {
		//Test if there is a sys_id
		if($scope.urlparms.Sys_id != null) {
			$scope.get_record($scope.urlparms.Table, $scope.urlparms.Sys_id);
			$scope.events_sub_selected = 'edit';
			//$scope.record.Table = "Posts"
		}

		if($scope.urlparms.Option != null) {
			$scope.events_sub_selected = $scope.urlparms.Option;
		}

		$http.get("../assets/php/get_events.php")
		.then(function (response) {
			$scope.events = response.data;
			console.log($scope.events);
			for(var b in $scope.events) {
				$scope.events[b]['SYS_CREATED_ON'] = new Date($scope.events[b]['SYS_CREATED_ON']).toDateString();
				$scope.events[b]['SYS_EVENT_DATE'] = new Date($scope.events[b]['SYS_EVENT_DATE']);
				//var dateParts = isoFormatDateString.split("-");
				//var jsDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0,2));
			}
		});
	}

	$scope.get_incidents = function() {
		/*
		//Test if there is a sys_id
		if($scope.urlparms.Sys_id != null) {
			$scope.get_record($scope.urlparms.Table, $scope.urlparms.Sys_id);
			$scope.groups_sub_selected = 'edit';
			//$scope.record.Table = "Posts"
		}

		if($scope.urlparms.Option != null) {
			$scope.groups_sub_selected = $scope.urlparms.Option;
		}

		$http.get("../assets/php/get_tickets.php")
		.then(function (response) {
			$scope.posts = response.data;
			console.log($scope.posts);
			for(var b in $scope.posts) {
				$scope.posts[b]['SYS_CREATED_ON'] = new Date($scope.posts[b]['SYS_CREATED_ON']).toDateString();
			}
		});
		*/
	}

	//Add new fab option
	$scope.is_fab_open = false;

	$scope.select_assets = function(page) {
		$scope.selected_asset = page;
	}

	$scope.select_reports = function(page) {
		$scope.selected_report = page;
	}

	//$scope.select_

	$scope.getFile = function (fileReader) {
		console.log(fileReader);
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
                      .then(function(result) {
                          $scope.imageSrc = result;
                      });
    };
 
    $scope.$on("fileProgress", function(e, progress) {
        $scope.progress = progress.loaded / progress.total;
    });

	//Add new 



	$scope.add_new = function(table) {
	data = {
			"table":table
		};
	$http.post("../assets/php/get_structure.php", data)
		.then(function(response) {

			$scope.record = {
				'table': data.table, 
				'data': response.data
			};

			for(var key in $scope.record.data){
			    if($scope.record.data.hasOwnProperty(key)){
			    	if(key != 'SYS_ID') {
			        	$scope.record.data[key] = null;
			    	}
			    }
			}
			console.log($scope.record);
		});

	}

	$scope.get_jobs = function() {
		$http.get("../assets/php/get_jobs.php")
		.then(function (response) {
		$scope.jobs = response.data.records;
		console.log($scope.jobs);
		});
	}

	$scope.get_clients = function() {
		$http.get("../assets/php/get_clients.php")
		.then(function (response) {
		$scope.clients = response.data.records;
		console.log($scope.clients);
		});
	}

	$scope.get_record = function(table, sys_id) {
		data = {
			"table":table, 
			"sys_id": sys_id
		};

		if(data.table == "groups") {
				data.table = "SMALL_GROUPS";
			}

		if(data.table == "events") {
			data.table = "EVENTS";

		}

		$http.post("../assets/php/get_record.php", data)
		.then(function(response) {

			$scope.record = {
				'table': data.table, 
				'data': response.data
			};

			if (table == "groups") {
			$scope.current_group = $scope.record;
			$scope.current_group.table = "small_groups";
			console.log($scope.current_group)
			}

			if(table == "events") {
				$scope.current_event = $scope.record;
				$scope.current_event.table = "events";
				console.log(moment($scope.current_event.SYS_EVENT_DATE));
				$scope.current_event.data.SYS_EVENT_DATE = moment($scope.current_event.data.SYS_EVENT_DATE).toDate();
				console.log($scope.current_event);
			}
		});
	}

	$scope.get_records = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/get_records.php", data)
		.then(function(response) {

			$scope.records = {
				'table': data.table, 
				'data': response.data
			};
		});
	}

	$scope.get_accounts = function() {
		$scope.get_records('accounts');
	}

	$scope.get_notifications = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/get_notifications.php", data)
		.then(function(response) {

			$scope.notifications = {
				'table': data.table, 
				'data': response.data[0]
			};
			console.log($scope.notifications);
		});
	}

	$scope.load_settings = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/load_settings.php", data)
		.then(function(response) {

			$scope.loaded_settings = {
				'table': data.table, 
				'data': response.data
			};

					for (var i = 0; i < $scope.loaded_settings.data.length; i++) {
			var jobj = $scope.loaded_settings.data[i];
			$scope.loaded_settings[jobj.NAME] = jobj;
		}

		});
	}

	$scope.load_user_settings = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/load_user_settings.php", data)
		.then(function(response) {

			$scope.loaded_user_settings = {
				'table': data.table, 
				'data': response.data
			};

					for (var i = 0; i < $scope.loaded_user_settings.data.length; i++) {
			var jobj = $scope.loaded_user_settings.data[i];
			$scope.loaded_user_settings[jobj.NAME] = jobj;
			$scope.loaded_user_settings.table = "SYS_USER_PROPERTIES";
		}

		//console.log($scope.loaded_user_settings);

		});
	}

	$scope.get_settings = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/load_settings.php", data)
		.then(function(response) {

			$scope.loaded_settings = {
				'table': data.table, 
				'data': response.data
			};
			//console.log($scope.loaded_settings);
			$scope.loaded_settings.table = "SYS_PROPERTIES";
		});
	}
	
    $scope.load_user_settings('user_settings');


	// - - - - - FINANCIAL FUNCTIONS - - - - -


	$scope.get_assets = function(table) {
		data = {
			"table":table
		};
		$http.post("../assets/php/get_assets.php", data)
		.then(function(response) {

			$scope.assets = {
				'table': data.table, 
				'data': response.data
			};
			//console.log($scope.assets);

			if(isParam($scope.urlparms, 'Category')) {
				$scope.selcted_asset = $scope.urlparms.Category;
			}
			if (isParam($scope.urlparms, 'Sys_id')) {
				$scope.load_record(response.data);
			}
			$scope.query_sys_id();

		});
	}

	$scope.get_accounts_receivable = function() {
		//This will run some query  like:
		//select * from sales where invoice_status = 2 (whatever the code is for pending payment);
	}

	$scope.get_prepaid_expenses = function() {
		//This prepaid expenses will be when we have paid for something yet recieved. We own the asset in the future, not today, but have paid for it. (awaiting deliveries, assets)
	}

	$scope.get_fixed_assets = function() {
		//This wil show assets like land, buildings, furniture & equipment, computer equipment, vehicles, and less:depreciation
		$scope.fixed_assets = {
			"current_period": {
				"land":0.00,
				"buildings":0.00,
				"equipment":0.00,
				"computer":0.00,
				"vehicles":0.00,
				"depreciation":0.00
			},
			"previous_period": {
				"land":0.00,
				"buildings":0.00,
				"equipment":0.00,
				"computer":0.00,
				"vehicles":0.00,
				"depreciation":0.00
			}
		}
	}



	$scope.get_other_assets = function() {
		//This will query for other assets such as trademarks, patents, security deposits, and others.
		$scope.other_assets = {
			"current_period": {
				"trademarks":0.00,
				"patents":0.00,
				"security_deposits":0.00,
				"other_assets":0.00
			},
			"previous_period": {
				"trademarks":0.00,
				"patents":0.00,
				"security_deposits":0.00,
				"other_assets":0.00
			}
		}
	}

	$scope.get_liabilities = function() {
		$scope.liabilities = {
			"current_period": {
				"accounts_payable": 0.00,
				"business_credit_cards": 0.00,
				"sales_tax_payable":0.00,
				"payroll_liabilities":0.00,
				"other_liabilities":0.00,
				"current_portion_long_term_debt":0.00
			},
			"previous_period": {
				"accounts_payable": 0.00,
				"business_credit_cards": 0.00,
				"sales_tax_payable":0.00,
				"payroll_liabilities":0.00,
				"other_liabilities":0.00,
				"current_portion_long_term_debt":0.00
			}
		}
	}

	$scope.get_equity = function() {
		$scope.equity = {
			"current_period": {
				"capital_stock":0.00,
				"opening_retained_earnings":0.00,
				"dividends_paid":0.00,
				"net_income":0.00
			},
			"previous_period": {
				"capital_stock":0.00,
				"opening_retained_earnings":0.00,
				"dividends_paid":0.00,
				"net_income":0.00
			}
		}
	}



	$scope.get_balance_sheet = function() {
		$scope.get_assets();
		$scope.get_fixed_assets();
		$scope.get_other_assets();
		$scope.get_liabilities();
		$scope.get_equity();
		$scope.get_financials_update();
	}

	$scope.get_financials_update = function() {
		$http.get("../assets/php/get_financials.php?code=" + $scope.code)
		.then(function (response) {
		$scope.financials = JSON.parse(response.data);
				//Define the dataset
		$scope.financial_dataset = [];
		$scope.total_revenue_by_year = 0;

		if ($scope.financials != undefined) {
			for (var i = 0; i < $scope.financials.response.result.invoices.length; i++) {
				if($scope.financials.response.result.invoices[i].status == 4 || 
				   $scope.financials.response.result.invoices[i].status == 5) {
					var pair = {};
					//var datedata = $scope.financials.response.result.invoices[i].date_paid.split('-');
					//pair.date_paid = new Date(datedata[2],datedata[0]-1,datedata[1]);
					pair.date_paid = new Date($scope.financials.response.result.invoices[i].date_paid);
					pair.amount = $scope.financials.response.result.invoices[i].amount.amount;
					$scope.total_revenue_by_year += parseFloat(pair.amount);
					$scope.financial_dataset.push(pair);
				}
			}
		}
		
		$scope.revenue = total_by_month($scope.financial_dataset, $scope.current_year);
		//$scope.revenue;
		//console.log($scope.revenue);
		var ctx = document.getElementById("revenue_chart").getContext('2d');
			var revenue_chart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		        datasets: [{
		            label: 'Revenue in $USD',
		            data: $scope.revenue,
		            backgroundColor: 
		                'rgba(13, 131, 221, 0.2)'
		            ,
		            borderColor: 
		                'rgba(4, 78, 135,1)'
		            ,
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            xAxes: [{
		                time: {
		                    unit: 'month'
		                }
		            }]
		        }
		    }
		});
				});
	}


	$scope.get_financials = function() {

		$scope.get_balance_sheet();

	}

	$scope.get_sum_equity_current = function() {
		var total = 0;
		for (var k in $scope.equity.current_period) {
			total += $scope.equity.current_period[k];
		}
		return total;
	}

	$scope.get_sum_equity_previous = function() {
		var total = 0;
		for (var k in $scope.equity.previous_period) {
			total += $scope.equity.previous_period[k];
		}
		return total;
	}

	$scope.get_sum_current = function() {
		//gets sum of current period
		var total = 0;
		for (var k in $scope.assets.current_period) {
			total += $scope.assets.current_period[k];
		}
		return total;
	}

	$scope.get_sum_previous = function() {
		//gets sum of previous period
				var total = 0;
		for (var k in $scope.assets.previous_period) {
			total += $scope.assets.previous_period[k];
		}
		return total;
	}

	$scope.get_sum_current_fixed = function() {
		//gets sum of current period
		var total = 0;
		for (var k in $scope.fixed_assets.current_period) {
			total += $scope.fixed_assets.current_period[k];
		}
		return total;
	}

	$scope.get_sum_previous_fixed = function() {
		//gets sum of previous period
				var total = 0;
		for (var k in $scope.fixed_assets.previous_period) {
			total += $scope.fixed_assets.previous_period[k];
		}
		return total;
	}

		$scope.get_sum_current_other = function() {
		//gets sum of current period
		var total = 0;
		for (var k in $scope.other_assets.current_period) {
			total += $scope.other_assets.current_period[k];
		}
		return total;
	}

	$scope.get_sum_previous_other = function() {
		//gets sum of previous period
				var total = 0;
		for (var k in $scope.other_assets.previous_period) {
			total += $scope.other_assets.previous_period[k];
		}
		return total;
	}

	$scope.get_sum_current_liabilities_current = function() {
		//gets sum of current period
		var total = 0;
		for (var k in $scope.liabilities.current_period) {
			total += $scope.liabilities.current_period[k];
		}
		return total;
	}

	$scope.get_sum_current_liabilities_previous = function() {
		//gets sum of previous period
				var total = 0;
		for (var k in $scope.liabilities.previous_period) {
			total += $scope.liabilities.previous_period[k];
		}
		return total;
	}

	// - - - - -UTILITY FUNCTIONS - - - - 

	$scope.load_record = function(data) {
		window.open(baseUrl + "?table=" + $scope.selected.toUpperCase() + "&sys_id="+data.SYS_ID, "_self");
	}

	// * * * Save function that sends an update to the database * * * 
	$scope.save = function(datat, shouldArchive) {
		//Data format should be as follows:
		// { 'table' : 'clients',
		//   'data': {'account_guid': '234dff4daad5e5f5eaff5e2afafafffa',
		//			  'street_address' : '202 7th St. W'}
		// }
		//$scope.sampledata = {'table':'accounts', 'data':{'sys_id':'b9c4d508376439e6c2dd0ca899f09e1b'}};
		if(datat === undefined) {
			datat = $scope.record;
		}

		if(shouldArchive === undefined) {
			shouldArchive = "1";
		}

		else {
			shouldArchive = shouldArchive.toString();
		}

		if(datat.table == "Groups"){
			datat.table = "SMALL_GROUPS";
		}

		if(datat.table == "support"){
			datat.table = "INCIDENT";
		}

		if(datat.table == "Events" || datat.table == "events") {
			datat.table = "EVENTS";
			datat.data.SYS_EVENT_DATE = moment(datat.data.SYS_EVENT_DATE).format('YYYY-MM-DD hh:mm:ss');

		}
		
		datat.data.ACTIVE = shouldArchive;


		console.log(datat);

		$http.post("../assets/php/push_to_db.php", datat)
		.then(function (response) {
			//console.log(response);
			$scope.success = response.data.records;
			console.log($scope.success);

			if ($scope.events_sub_selected == 'new') {
				// location.replace('')
			}
			location.reload();
		});
	}

  	//check editting
  	$scope.urlparms = getAllUrlParams();
  	$scope.selected = 'dashboard';
  	$scope.sub_selected = 'Balance Sheet';
  	$scope.groups_sub_selected = 'view';
  	$scope.events_sub_selected = 'view';

  	for (var i = 0; i < $scope.options.length; i++) {
  		if (isParam($scope.urlparms, $scope.options[i].name)) {
  			$scope.selected = $scope.options[i].name;
			//run proper get function
			var funcname = "get_" + $scope.selected.toLowerCase().replace(/ /g,"_");
			console.log(funcname);
			if(angular.isFunction($scope[funcname])) {
				$scope[funcname]();
			}
  			
  		}
  	}

  	//HIDE THIS
  	console.log($scope.urlparms);
  	
  	if (isParam($scope.urlparms, 'Code')) {
  		$scope.selected = "Financials";
  		$scope.code = $scope.urlparms.Code;
  	}




	$scope.change_selected = function(new_option, norefresh) {
		//run proper get function
		if (norefresh === undefined) {
			window.open(baseUrl + "?table=" + new_option, "_self");
		}
		
		var funcname = "get_" + new_option.toLowerCase().replace(/ /g,"_");
		console.log(funcname);
		if(angular.isFunction($scope[funcname])) {
			$scope[funcname]();
		}
	}

	$scope.change_sub_selection = function(new_option) {
		//Run a function based on sub selectiong
		$scope.sub_selected = new_option;
		var funcname = "get_" + new_option.toLowerCase().replace(/ /g,"_");
		console.log(funcname);
		if(angular.isFunction($scope[funcname])) {
			$scope[funcname]();
		}
	}

	//Query specific record in the database

	$scope.query_sys_id = function() {
		if (isParam($scope.urlparms, 'Sys_id') && isParam($scope.urlparms, 'Table')) {
			//If sys_id exists as a parameter, push that value into the query php to get back the right data
			$scope.get_record($scope.urlparms.Table, $scope.urlparms["Sys_id"]);
		}
	}



	// * * * * * * * * * HERE WE QUERY IF THE SOFTWARE NEEDS TO SWITCH TO A SPECIFIC MODULE (SIDEBAR MENU FUNCTION) * * * * * * * * * *

	if(isParam($scope.urlparms, 'Table')) {
  		$scope.change_selected($scope.urlparms.Table.capitalize(), true);
  	}

  	if(isParam($scope.urlparms, 'Search')) {
  		//We've hit the search page, digest the contents of search and return something
  		$scope.change_selected('Search');
  		//We can essentially build the answered search object out here.
  	}
  	if ($scope.urlparms.Table != undefined) {
		$scope.selected = $scope.urlparms.Table.toString().capitalize();
  	}
  	else {
  		$scope.selected = 'dashboard'; 
  	}
  	$scope.query_sys_id();
	/*

	New POST section

	*/

	$scope.newgroup = {
		"data": {
				"TITLE":"",
				"SYS_ID":"",
				"DESCRIPTION":"",
				"TARGET_AUDIENCE":"",
				"MEET_DAY":"",
				"MEET_TIME_START":"",
				"MEET_TIME_END":"",
				"DURATION":"",
				"LEADER":"BLOG",
				"PHONE_NUMBER":"",
				"EMAIL":"",
				"CAMPUS":"",
				"COST":"",
				"WHY":"",
				"GUID":"",
				"SYS_CREATED_ON":"",
				"SYS_ID":""
			},
		"table":"Groups"
		};

	$scope.split_updates = function(colback) {
		//for some reason though "callback" a column was clever
		//Splits the $scope.updates
		var reobj = {
			"cback0":[],
			"cback1":[]
		};

		for (var s = 0; s < $scope.updates.length; s++) {

			if (s % 2 == 0) {
				reobj["cback0"].push($scope.updates[s]);
			}

			else {
				//The return was 1
				reobj["cback1"].push($scope.updates[s]);
			}
		}

		if (colback == 0) {
			return reobj["cback0"];
		}

		else if (colback == 1) {
			return reobj["cback1"];
		}

		else {
			return $scope.updates;
		}
	}


	/*

	End of Updates section

	*/
	/*$scope.get_jobs = function() {
		$http.get("../assets/php/get_jobs.php")
		.then(function (response) {
		$scope.jobs = response.data.records;
		console.log($scope.jobs);
		});
	}


	$scope.get_financials = function() {
		$http.get("../assets/php/get_financials.php")
		.then(function (response) {
		$scope.financials = response.data.records;
		console.log($scope.financials);
		});
	}
	*/


	$scope.logout = function() {
		$http.get("../assets/php/logout.php")
		.then(function (response) {
			location.reload();
		});
	}


  $scope.sortingOrder = sortingOrder;
  $scope.pageSizes = [5,10,25,50];
  $scope.reverse = false;
  $scope.filteredItems = [];
  $scope.groupedItems = [];
  $scope.itemsPerPage = 10;
  $scope.pagedItems = [];
  $scope.currentPage = 0;
  $scope.items = [{}];

  $scope.goto_page = function(page) {
  	window.location.href = page;
  }
  
  // init the filtered items
  $scope.search = function () {
    $scope.filteredItems = $filter('filter')($scope.items, function (item) {
      for(var attr in item) {
        if (searchMatch(item[attr], $scope.query))
          return true;
      }
      return false;
    });
    // take care of the sorting order
    if ($scope.sortingOrder !== '') {
      $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
    }
    $scope.currentPage = 0;
    // now group by pages
    $scope.groupToPages();
  };
  
  // show items per page
  $scope.perPage = function () {
    $scope.groupToPages();
  };
  
  // calculate page in place
  $scope.groupToPages = function () {
    $scope.pagedItems = [];
    
    for (var i = 0; i < $scope.filteredItems.length; i++) {
      if (i % $scope.itemsPerPage === 0) {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
      } else {
        $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
      }
    }
  };
  
   $scope.deleteItem = function (idx) {
        var itemToDelete = $scope.pagedItems[$scope.currentPage][idx];
        var idxInItems = $scope.items.indexOf(itemToDelete);
        $scope.items.splice(idxInItems,1);
        $scope.search();
        
        return false;
    };

    $scope.copy_to_clipboard = function(text){
    	if(text === undefined) {
    		window.prompt("Copy to clipboard: (Ctrl-C):  ", window.location.href.toString());
    	}
    	else {
    		window.prompt("Copy to clipboard: (Ctrl-C):  ",text);
    	}
    }
  
  $scope.range = function (start, end) {
    var ret = [];
    if (!end) {
      end = start;
      start = 0;
    }
    for (var i = start; i < end; i++) {
      ret.push(i);
    }
    return ret;
  };
  
  $scope.prevPage = function () {
    if ($scope.currentPage > 0) {
      $scope.currentPage--;
    }
  };
  
  $scope.nextPage = function () {
    if ($scope.currentPage < $scope.pagedItems.length - 1) {
      $scope.currentPage++;
    }
  };
  
  $scope.setPage = function () {
    $scope.currentPage = this.n;
  };
  
  // functions have been describe process the data for display
  $scope.search();
 
  
  // change sorting order
  $scope.sort_by = function(newSortingOrder) {
    if ($scope.sortingOrder == newSortingOrder)
      $scope.reverse = !$scope.reverse;
    
    $scope.sortingOrder = newSortingOrder;
  };

    $scope.showDialog = function(element) {
    var parentEl = angular.element(document.body);
    return $mdDialog.show({
      template: element,
      locals: {data: $scope.fluff},
      scope: $scope,
      preserveScope: true,
      parent: parentEl,
      clickOutsideToClose: true,
      controller:function($scope, data) {
        $scope.fluff = "";
        $scope.data = data;
        $scope.cancel = function() {
          $mdDialog.cancel();
        }

        $scope.submit = function() {
          $mdDialog.hide($scope.fluff);
        }
       }
      }).then(function(response){
      $scope.data = response;
    }, function(response){
      $scope.data = "cancelled";
    });
    }

    //Below here is going to go the character create module
    //Character Creation: Setup your Player Character to add to the database

    $scope.createpage = 1;
    $scope.maxpages = 6;

    $scope.create_page_back = function() {
    	if($scope.createpage == 1) {
    		return;
    	}
    	if($scope.createpage > 1) {
    		console.log($scope.character);
    		$scope.createpage -= 1;
    	}
    }

    $scope.create_page_forward = function() {
    	if($scope.createpage >= $scope.maxpages) {
    		return;
    	} else {
    		$scope.createpage += 1;
    	}
    }

    //Last minute loading functions
    $scope.done_loading = true;

    //Utility funciton hook
    $scope.previous = function() {
    	previous();
    }


    //Footer variables
    $scope.current_year = new Date().getFullYear().toString();
    $scope.load_settings('settings');

    $scope.states =[
    {
        "name": "Alabama",
        "abbreviation": "AL"
    },
    {
        "name": "Alaska",
        "abbreviation": "AK"
    },
    {
        "name": "American Samoa",
        "abbreviation": "AS"
    },
    {
        "name": "Arizona",
        "abbreviation": "AZ"
    },
    {
        "name": "Arkansas",
        "abbreviation": "AR"
    },
    {
        "name": "California",
        "abbreviation": "CA"
    },
    {
        "name": "Colorado",
        "abbreviation": "CO"
    },
    {
        "name": "Connecticut",
        "abbreviation": "CT"
    },
    {
        "name": "Delaware",
        "abbreviation": "DE"
    },
    {
        "name": "District Of Columbia",
        "abbreviation": "DC"
    },
    {
        "name": "Federated States Of Micronesia",
        "abbreviation": "FM"
    },
    {
        "name": "Florida",
        "abbreviation": "FL"
    },
    {
        "name": "Georgia",
        "abbreviation": "GA"
    },
    {
        "name": "Guam",
        "abbreviation": "GU"
    },
    {
        "name": "Hawaii",
        "abbreviation": "HI"
    },
    {
        "name": "Idaho",
        "abbreviation": "ID"
    },
    {
        "name": "Illinois",
        "abbreviation": "IL"
    },
    {
        "name": "Indiana",
        "abbreviation": "IN"
    },
    {
        "name": "Iowa",
        "abbreviation": "IA"
    },
    {
        "name": "Kansas",
        "abbreviation": "KS"
    },
    {
        "name": "Kentucky",
        "abbreviation": "KY"
    },
    {
        "name": "Louisiana",
        "abbreviation": "LA"
    },
    {
        "name": "Maine",
        "abbreviation": "ME"
    },
    {
        "name": "Marshall Islands",
        "abbreviation": "MH"
    },
    {
        "name": "Maryland",
        "abbreviation": "MD"
    },
    {
        "name": "Massachusetts",
        "abbreviation": "MA"
    },
    {
        "name": "Michigan",
        "abbreviation": "MI"
    },
    {
        "name": "Minnesota",
        "abbreviation": "MN"
    },
    {
        "name": "Mississippi",
        "abbreviation": "MS"
    },
    {
        "name": "Missouri",
        "abbreviation": "MO"
    },
    {
        "name": "Montana",
        "abbreviation": "MT"
    },
    {
        "name": "Nebraska",
        "abbreviation": "NE"
    },
    {
        "name": "Nevada",
        "abbreviation": "NV"
    },
    {
        "name": "New Hampshire",
        "abbreviation": "NH"
    },
    {
        "name": "New Jersey",
        "abbreviation": "NJ"
    },
    {
        "name": "New Mexico",
        "abbreviation": "NM"
    },
    {
        "name": "New York",
        "abbreviation": "NY"
    },
    {
        "name": "North Carolina",
        "abbreviation": "NC"
    },
    {
        "name": "North Dakota",
        "abbreviation": "ND"
    },
    {
        "name": "Northern Mariana Islands",
        "abbreviation": "MP"
    },
    {
        "name": "Ohio",
        "abbreviation": "OH"
    },
    {
        "name": "Oklahoma",
        "abbreviation": "OK"
    },
    {
        "name": "Oregon",
        "abbreviation": "OR"
    },
    {
        "name": "Palau",
        "abbreviation": "PW"
    },
    {
        "name": "Pennsylvania",
        "abbreviation": "PA"
    },
    {
        "name": "Puerto Rico",
        "abbreviation": "PR"
    },
    {
        "name": "Rhode Island",
        "abbreviation": "RI"
    },
    {
        "name": "South Carolina",
        "abbreviation": "SC"
    },
    {
        "name": "South Dakota",
        "abbreviation": "SD"
    },
    {
        "name": "Tennessee",
        "abbreviation": "TN"
    },
    {
        "name": "Texas",
        "abbreviation": "TX"
    },
    {
        "name": "Utah",
        "abbreviation": "UT"
    },
    {
        "name": "Vermont",
        "abbreviation": "VT"
    },
    {
        "name": "Virgin Islands",
        "abbreviation": "VI"
    },
    {
        "name": "Virginia",
        "abbreviation": "VA"
    },
    {
        "name": "Washington",
        "abbreviation": "WA"
    },
    {
        "name": "West Virginia",
        "abbreviation": "WV"
    },
    {
        "name": "Wisconsin",
        "abbreviation": "WI"
    },
    {
        "name": "Wyoming",
        "abbreviation": "WY"
    }
];

$scope.sample_whitelist = [
	{
		"ip":"195.134.2.65",
		"location": "United Kingdom (GB)",
		"provider": "Itility Limited",
		"hostname": "no-dns.as5587.net"
	},
	{
		"ip":"104.136.23.2",
		"location": "United States (US)",
		"provider":"BRIGHT HOUSE NETWORKS, LLC",
		"hostname":"104-136-23-2.res.bhn.net"
	},
	{
		"ip":"104.136.23.2",
		"location": "United States (US)",
		"provider":"BRIGHT HOUSE NETWORKS, LLC",
		"hostname":"104-136-23-2.res.bhn.net"
	},
	{
		"ip":"104.136.23.2",
		"location": "United States (US)",
		"provider":"BRIGHT HOUSE NETWORKS, LLC",
		"hostname":"104-136-23-2.res.bhn.net"
	}];
		$scope.ban_repeals = $scope.sample_whitelist.length;

	$scope.days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
	$scope.yesorno = [
	{"label": "Yes", "value":1},
	{"label": "No", "value":0}
	];
	$scope.campuses = ['Woodbury', 'Eagan', 'Cottage Grove', 'Hastings'];
	$scope.sample_conversations = [
	{
		"name":"Henley Johnson",
		"message":"Listicle vice narwhal before they sold out literally crucifix pug godard etsy put a bird on it meggings kombucha.",
		"date":"January 9th, 2018"
	},
	{
		"name":"Charles Monty",
		"message":"La croix godard biodiesel, pork belly twee cliche ugh affogato squid tofu quinoa 3 wolf moon bespoke.",
		"date":"January 7th, 2018"
	},
	{
		"name":"Chase Newlands",
		"message":"Air plant DIY vice narwhal sartorial before they sold out.",
		"date":"January 6th, 2018"
	}]
});
