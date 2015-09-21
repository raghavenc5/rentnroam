angular.module('rnr', ['ui.bootstrap'])
.controller('frmCreateYourPropertyCtrl', function ($scope, $http){
	//var base_url = window.location.origin;

	$scope.selectedProperty = {};
	$scope.PropertyTypeVisibility = false;
	$scope.PropertyTypeDescVisibility = true;

	$scope.RoomTypeVisibility = false;
	$scope.RoomTypeDescVisibility = true;

	$scope.cities = [];
	//var base_url = window.location.origin;
	var url = base_url+"host/getPropertytype";

	$http.get(url).
	success(function(data, status, headers, config) {
		$scope.PropertyData = data;
		$scope.buttonsArray = [];
		$scope.optionsArray = [];
		for(var i in $scope.PropertyData){
			$scope.PropertyData[i].images = base_url + "public/images/" + $scope.PropertyData[i].images;
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
		console.log(obj);
		$scope.selectedProperty = obj.property_type;
		$scope.finalPropertyType = obj.property_type_id;
		$scope.selectedPropertyIcon = obj.images
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
        $("#property_type_error").html('');
    };
    $scope.togglePropertyTypeOption = function() {
		$scope.selectedProperty = $scope.selectedOption;
		//var base_url = window.location.origin;
		//var url = base_url+"host/getPropertytype";

		$scope.selectedPropertyIcon =  base_url+"public/images/home.png";
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
    };
    $scope.togglePropertyTypeDesc = function() {
        $scope.PropertyTypeVisibility = !$scope.PropertyTypeVisibility;
        $scope.PropertyTypeDescVisibility = !$scope.PropertyTypeDescVisibility;
    };

   
	$http.get(base_url+'host/getRoomtype').
	success(function(data, status, headers, config) {
		$scope.roomData = data;
		for(var i in $scope.roomData){
			$scope.roomData[i].images = base_url + "public/images/" + $scope.roomData[i].images;
		}
	}).error(function(data, status, headers, config) {
		console.log("Error");
	});

	$scope.toggleRoomType = function(obj) {
		console.log(obj);
		$scope.selectedRoom = obj.roomtype;
		$scope.finalRoomType = obj.room_type_id;
		$scope.selectedRoomIcon = obj.images;
        $scope.RoomTypeVisibility = !$scope.RoomTypeVisibility;
        $scope.RoomTypeDescVisibility = !$scope.RoomTypeDescVisibility;
        $("#room_type_error").html('');
        
        if (2 != $scope.finalRoomType) {
            $("#no_of_rooms_container").css("display", "block");
            $("#no_of_rooms").prop("disabled", false);
        } else {
            $("#no_of_rooms_container").css("display", "none");
            $("#no_of_rooms").prop("disabled", true);
        }
            
    };
    $scope.toggleRoomTypeDesc = function() {
        $scope.RoomTypeVisibility = !$scope.RoomTypeVisibility;
        $scope.RoomTypeDescVisibility = !$scope.RoomTypeDescVisibility;
    };

	
	$http.get(base_url+'host/getCity').
	success(function(data, status, headers, config) {
		$scope.cityData = data;
		for(var i in $scope.cityData){
			$scope.cities.push($scope.cityData[i].city_state_combo_name);
		}
	}).error(function(data, status, headers, config) {
		console.log("Error");
	});
});
