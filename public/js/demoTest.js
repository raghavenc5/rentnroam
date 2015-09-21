angular.module('rnr', ['ui.bootstrap'])
.controller('frmCreateYourPropertyCtrl', function ($scope, $http){
	
	$scope.selectedProperty = {};
	$scope.PropertyTypeVisibility = false;
	$scope.PropertyTypeDescVisibility = true;

	$scope.RoomTypeVisibility = false;
	$scope.RoomTypeDescVisibility = true;

	$scope.cities = [];

	$http.get('http://localhost/rent_n_roam/trunk/rentnroam/host/extractPropertyType').
	success(function(data, status, headers, config) {
		$scope.PropertyData = data;
		$scope.buttonsArray = [];
		$scope.optionsArray = [];
		for(var i in $scope.PropertyData){
			if($scope.PropertyData[i].element_type === "button"){
				$scope.buttonsArray.push($scope.PropertyData[i]);
			}else if($scope.PropertyData[i].element_type === "option"){
				$scope.optionsArray.push($scope.PropertyData[i]);
			}
		}
	}).error(function(data, status, headers, config) {
		console.log("Error");
	});

	$scope.togglePropertyType = function(obj) {
		$scope.selectedProperty = obj.property_type;
		$scope.finalPropertyType = obj.property_type;
		$scope.selectedPropertyIcon = obj.image_path;
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
    };
    $scope.togglePropertyTypeOption = function() {
		$scope.selectedProperty = $scope.selectedOption;
		$scope.selectedPropertyIcon = "http://localhost/rent_n_roam/trunk/rentnroam/public/images/home.png";
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
    };
    $scope.togglePropertyTypeDesc = function() {
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
    };

	$http.get('http://localhost/rent_n_roam/trunk/rentnroam/host/extractRoomType').
	success(function(data, status, headers, config) {
		$scope.roomData = data;
	}).error(function(data, status, headers, config) {
		console.log("Error");
	});

	$scope.toggleRoomType = function(obj) {
		$scope.selectedRoom = obj.roomtype;
		$scope.finalRoomType = obj.roomtype;
		$scope.selectedRoomIcon = obj.image_path;
        $scope.RoomTypeVisibility = !$scope.RoomTypeVisibility;
        $scope.RoomTypeDescVisibility = !$scope.RoomTypeDescVisibility;
    };
    $scope.toggleRoomTypeDesc = function() {
        $scope.RoomTypeVisibility = !$scope.RoomTypeVisibility;
        $scope.RoomTypeDescVisibility = !$scope.RoomTypeDescVisibility;
    };

	$http.get('http://localhost/rent_n_roam/trunk/rentnroam/host/extractCity').
	success(function(data, status, headers, config) {
		$scope.cityData = data;
		for(var i in $scope.cityData){
			$scope.cities.push($scope.cityData[i].city);
		}
	}).error(function(data, status, headers, config) {
		console.log("Error");
	});
/*
	$scope.frmProcessor = function(){
		$scope.frmData = {};
		$scope.frmData.finalPropertyType = $scope.selectedProperty;
		$scope.frmData.finalRoomType = $scope.selectedRoom;
		$scope.frmData.finalCityName = $scope.asyncSelected;
		$scope.frmData.guestsSelected = $scope.guestsSelected;
		
		console.log($scope.frmData);

		$http.post('http://localhost/rent_n_roam/trunk/rentnroam/host/createProperty', {propertyDetails: $scope.frmData}).success(function(data, status, headers, config) {
			
		})
	}
*/
});