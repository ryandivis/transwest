(function(){

	var transwestApp = angular.module('transwestApp',['ui.bootstrap']);

	transwestApp.config(function($interpolateProvider){
		$interpolateProvider.startSymbol('<<');
        $interpolateProvider.endSymbol('>>');	
	});

	transwestApp.controller('MasterController',function($scope,$log,$http){
		$scope.logout = function() {
			$http.post('/logout').then(function(data){
				if(data.status == 'ok') {
					window.location = '/login';
				}
			});
		}
	});

	transwestApp.controller('RegistrationController', function($scope,$modal,$location,$log,$http) {
		$scope.submitRegistration = function() {
			$http.post('/register',$scope.user).then(function(data){
				$log.info(data);
			},function(data){
				$log.info(data);
			})
		}		
	});

	transwestApp.controller('LoginController', function($scope,$modal,$log,$location,$http) {
		$scope.submitLogin = function() {
			$http.post('/login',$scope.user).success(function(data){
				if(data.status == 'ok') {
					window.location = '/';
				}
			});
		}
	});

	transwestApp.controller('BusinessController',function($scope,$log,$http,$modal,$attrs,$q){
		$scope.getUsers = function() {
			$http.get('/api/business/'+$scope.business_id+'/users').success(function(data){
				$scope.users = data.users;
			});
		}

		$scope.getVehicles = function() {
			$http.get('/api/business/'+$scope.business_id+'/vehicles').success(function(data){
				$scope.vehicles = data.vehicles;
			});
		}

		$scope.newUser = function() {
			//get user roles
			$q.all([
				$http.get('/api/user-roles'),
				$http.get('/api/business/'+$scope.business_id),
				$http.get('/api/business/'+$scope.business_id+'/users/supervisor'),
				$http.get('/api/business/'+$scope.business_id+'/vehicles')
			]).then(function(results){
				$scope.user_roles = results[0].data.user_roles;
				$scope.business = results[1].data.business;
				$scope.supervisors = results[2].data.users;
				$scope.vehicles = results[3].data.vehicles;

				var modalInstance = $modal.open({
					templateUrl: '/js/templates/new-user.html',
					controller: NewBusinessUserModalController,
					resolve: {
						user_roles: function() {
							return $scope.user_roles
						},
						business: function() {
							return $scope.business
						},
						supervisors: function(){
							return $scope.supervisors;
						},
						vehicles: function() {
							return $scope.vehicles
						}
					}
				});

				modalInstance.result.then(function(data){
					$log.info(data);	
				},function(data){
					$log.info(data);
				});
			})
		}

		$scope.newVehicle = function() {
			$http.get('/api/business/'+$scope.business_id).success(function(data){
				$scope.business = data.business;
				var modalInstance = $modal.open({
					templateUrl: '/js/templates/new-vehicle.html',
					controller: NewBusinessVehicleModalController,
					resolve: {
						business: function() {
							return $scope.business;
						}
					}
				});

				modalInstance.result.then(function(data){
					$log.info(data);
				});
			});

		}

		$scope.viewVehicle = function(vehicle_id) {
			$http.get('/api/vehicles/'+vehicle_id).success(function(data){
				$scope.vehicle = data.vehicle;

				var modalInstance = $modal.open({
					templateUrl: '/js/templates/view-vehicle.html',
					controller: ViewVehicleModalController,
					resolve: {
						vehicle: function() {
							return $scope.vehicle;
						}
					}
				});

				modalInstance.result.then(function(data){
					$log.info(data);
				});
			});
		}

		$scope.userAction = function(action,user) {
			switch(action.name) {
				case 'Edit':
					//open user modal
					break;
				case 'Delete':
					//show confirmation box
					if(confirm('Are you sure?')) {
						$http.delete(action.url).success(function(data){
							$log.info(data);
						});
					}
					break;
			}
		}

		$scope.getUsers();
		$scope.getVehicles();

	});

	var ViewVehicleModalController = function($scope,$modalInstance,$http,$log,vehicle) {
		$scope.vehicle = vehicle;
		$scope.miles = {};
		$scope.miles.vehicle_id = $scope.vehicle.id;

		$scope.updateMileage = function() {
			$http.post('/mileage',{
				mileage: $scope.miles
			}).success(function(data){
				$log.info(data);
			})
		}

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}
	}

	var NewBusinessVehicleModalController = function($scope,$modalInstance,$log,$http,business) {
		$scope.business = business;

		$scope.vehicle = {};
		$scope.vehicle.business_id = $scope.business.id;

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}

		$scope.submit = function(valid) {
			if(valid) {
				$http.post('/vehicles',{  
					vehicle: $scope.vehicle,
					mileage: $scope.mileage
				}).success(function(data){
					if(data.status == 'ok') {
						$modalInstance.close($scope.user);
					} else {
						$log.info(data);
					}
				});	
			}
		}	

		$scope.lookupVin = function() {
			var vin = $scope.vehicle.vin;

			var res = new EDMUNDSAPI('x6mevjmf4xykthnyanq964gf');

			res.api('/api/vehicle/v2/vins/'+vin, {}, function(data) {
				$log.info(data);
				
				$scope.$apply(function(){
					$scope.vehicle.make = data.make.name;
					$scope.vehicle.model = data.model.name;
					$scope.vehicle.year = data.years[0].year;
					$scope.vehicle.engine = data.engine.size + 'L ' + data.engine.configuration + " " + data.engine.cylinder;
				});
			} , function(data){ $log.info(data) });
		}
	}

	var NewBusinessUserModalController = function($scope,$modalInstance,$log,$http,user_roles,business,supervisors,vehicles) {
		$scope.user_roles = user_roles;
		$scope.business = business;
		$scope.supervisors = supervisors;
		$scope.vehicles = vehicles;

		$scope.user = {};
		$scope.user.business_id = $scope.business.id;

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}

		$scope.submit = function(valid) {
			if(valid) {
				$scope.user.user_role_id = $scope.user.user_role.id;
				// delete $scope.user.user_role;

				$scope.user.vehicle_id = $scope.user.vehicle.id;
				// delete $scope.user.vehicle;

				$scope.user.supervisor_id = $scope.user.supervisor.id;
				// delete $scope.user.supervisor;

				$http.post('/users',{  
					user: $scope.user
				}).success(function(data){
					if(data.status == 'ok') {
						$modalInstance.close($scope.user);
					} else {
						$log.info(data);
					}
				});	
			}
		}	
	}

	transwestApp.controller('BusinessesController',function($scope,$log,$http,$modal,$window){
		$scope.getBusinesses = function() {
			$http.get('/api/businesses').success(function(data){
				$log.info(data);
				$scope.businesses = data.businesses;
			})
		}

		$scope.newBusiness = function() {
			var modalInstance = $modal.open({
				templateUrl: '/js/templates/new-business.html',
				controller: NewBusinessModalController
			});

			modalInstance.result.then(function(business){
				$http.post('/api/business',{  
					'name' : business.name,
					'phone' : business.phone
				}).success(function(data){
					$log.info(data);
				});		
			},function(data){
				$log.info(data);
			});
		}

		$scope.goToBusiness = function(id) {
			$window.location.href = '/business/'+id;
		}

		$scope.getBusinesses();
	});

	var NewBusinessModalController = function($scope,$modalInstance,$log) {
		$scope.business = {
			name: '',
			phone: ''
		};

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}

		$scope.submit = function(valid) {
			if(valid) {
				$modalInstance.close($scope.business);	
			}
		}
	}

	transwestApp.controller('DashboardController',function($scope,$modal,$log,$location,$http){
		$http.defaults.cache = true;		

		$scope.getTickets = function() {
			$http.get('/tickets').success(function(data){
				$scope.tickets = data.tickets;
			});
		};

		$scope.ticketAction = function(action,ticket) {
			$log.info(action);
			switch(action.name) {
				case 'View':
					$http.get(action.url).then(function(data) {
						$scope.ticket = data.data.ticket;

						var modalInstance = $modal.open({
							templateUrl: '/js/templates/view-ticket.html',
							controller: EditTicketModalController,
							resolve: {
								ticket: function() {
									return $scope.ticket;
								}
							}
						});

						modalInstance.result.then(function(data){
							$log.info(data);
						},function(data){
							$log.info(data);
					});

					})
					break;
				case 'Approve':
					$http.put(action.url).success(function(data){
						$scope.getTickets();
						$scope.apply();
					});
					break;
				case 'Close':
					$http.delete(action.url).success(function(data){
						$scope.getTickets();
						$scope.apply();
					});
					break;
				case 'Mark Resolved':
					$http.put(action.url).success(function(data){
						$scope.getTickets();
						$scope.apply();
					});
					break;
				case 'Reopen':
					$http.put(action.url).success(function(data){
						if(data.status !== 'ok') {
							$log.info(data.message);
						}
					});
					break;
			}
		}

		$scope.newTicket = function() {
			//get user info first
			$http.get('/users').then(function(data){
				$scope.users = data.data;
				var modalInstance = $modal.open({
					templateUrl: '/js/templates/new-ticket.html',
					controller: NewTicketModalController,
					resolve: {
						users: function() {
							return $scope.users;
						}
					}
				})

				modalInstance.result.then(function(ticket){
					$http.post('/tickets',{  
						'issue' : ticket.issue,
						'user_id' : ticket.user.id
					}).success(function(data){
						$log.info(data);
					});		
				},function(data){
					$log.info(data);
				});
			});

		}

		$scope.getTickets();
	});

	var NewTicketModalController = function($scope,$modalInstance,$log,users) {
		$scope.users = users;

		$scope.ticket = [];

		$scope.ticket.user = $scope.users[0];

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}

		$scope.submit = function(valid) {
			if(valid) {
				$modalInstance.close($scope.ticket);	
			}
		}

		$scope.log = function() {
			$log.info($scope.ticket);
		}
	};

	var EditTicketModalController = function($scope,$modalInstance,$log,$http,ticket) {
		$scope.ticket = ticket;
		$scope.comment = {};
		$scope.comment.ticket_id = $scope.ticket.id

		$scope.cancel = function() {
			$modalInstance.dismiss('cancelled');
		}

		$scope.submit = function(valid) {
			if(valid) {
				$http.post('/tickets/'+$scope.ticket.id+'/comment',{  
					'comment' : $scope.comment
				}).success(function(data){
					$scope.ticket.comments.push(data.comment);
					$scope.comment = {};					
				});	
				
			}
		}
	}

})();