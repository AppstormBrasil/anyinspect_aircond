//var current_path = 'https://tecnoair.appstorm.online/pro/api';
//var adm_path = 'https://tecnoair.appstorm.online/pro';

var current_path = 'http://localhost:8012/anyinspect_aircond/pro/api';
var adm_path = 'http://localhost:8012/anyinspect_aircond/pro';

const Utils = { 
	parseRequestURL : () => {
	
		let url = location.hash.slice(1).toLowerCase() || '/';
		let r = url.split("/")
		let request = {
			resource    : null,
			id          : null,
			verb        : null
		}
		request.resource    = r[1]
		request.id          = r[2]
		request.verb        = r[3]
	
		return request
	}
	, sleep: (ms) => {
		return new Promise(resolve => setTimeout(resolve, ms));
	} 
	
	, apiPath : () => {
		let urlPatrh = current_path;
		return  urlPatrh
	}
	
	, apiPathRoot : () => {
		let urlPatrh = current_path;
		return  urlPatrh
	}
	
	, PathRoot : () => {
		let urlPatrh = adm_path;
		return  urlPatrh
	}
	
	, userData : () => {
		let c_user = JSON.parse(window.localStorage.getItem('user_info_app_insp'));
		return c_user;
		
	}
	
	, userDataPush : () => {
		let c_user_push = JSON.parse(window.localStorage.getItem('user_info_push_insp'));
		return c_user_push;
	}
	
	}