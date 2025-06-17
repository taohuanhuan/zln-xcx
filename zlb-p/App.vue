<script>
	export default {
		onLaunch: function() {
			let role = uni.getStorageSync('role')
			if(role==='information'){
				uni.navigateTo({
					url:'/guanlishi/index/index'
				})
			}
		},
		onShow: function() {
			uni.getLocation({
				type: 'wgs84',
				success: function (res) {
					console.log('当前位置的经度：' + res.longitude);
					console.log('当前位置的纬度：' + res.latitude);
				},
				fail(e) {
					console.log(e) 
				}
			});
		},
		onHide: function() {
			console.log('App Hide')
		}
	}
</script>

<style lang="scss">
	/* 注意要写在第一行，同时给style标签加入lang="scss"属性 */
	@import "@/uni_modules/uview-ui/index.scss";
	/*每个页面公共css */
	page {
	  background-color: #F6F6F6; /* 这里设置你想要的背景颜色 */
	  // padding: 0 30rpx;
	  box-sizing: border-box;
	}
	.btn-active {
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		color: white;
	}
	
	.qj-title {
		width: 128rpx;
		height: 44rpx;
		font-family: PingFang-SC, PingFang-SC;
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		line-height: 44rpx;
		text-align: left;
		font-style: normal;
	}
</style>
