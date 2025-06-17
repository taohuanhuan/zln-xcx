module.exports = (vm) => {
	uni.$u.http.setConfig((config) => {
		config.baseURL = 'https://yly.shmgcm.com/api/';
		return config
	})

	// 请求拦截
	uni.$u.http.interceptors.request.use((config) => { // 可使用async await 做异步操作

		let userinfo = uni.getStorageSync('userinfo')
		console.log(JSON.stringify(userinfo))
		if (userinfo) {
			config.header.token = userinfo.token
		}
		return config
	}, config => { // 可使用async await 做异步操作
		return Promise.reject(config)
	})

	// 响应拦截
	uni.$u.http.interceptors.response.use((response) => {

		const data = response.data
		if (data.code != 1) {
			uni.showToast({
				icon: "none",
				title: data.msg
			})
			return data
		}

		return data.data === undefined ? {} : data
		// return data
	}, (response) => {
		// 对响应错误做点什么 （statusCode !== 200）
		uni.showToast({
			icon: "none",
			title: "服务异常，请稍后重试！"
		})
		return Promise.reject(response)
	})
}