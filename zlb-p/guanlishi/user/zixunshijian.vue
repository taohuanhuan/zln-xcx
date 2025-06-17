<template>
	<view class="main">
		<view class="feiyong">
			<view class="title">我的咨询时间</view>
			<view class="text">周一、周二、周三、周四、周五、周六</view>
			<view class="text">上午：08:00-12:00</view>
			<view class="text">下午：08:00-12:00</view>
		</view>
		
		<view class="btn" >联系平台客服
			<button open-type="contact"  style="background-color: red;position: absolute;top: 0;z-index: 1;width: 100%;height: 100%;opacity: 0;"> </button>
		 </view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		}
	}
</script>

<style lang="scss" scoped>
	
	.main{
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
	}
	
	.title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
	}
	.feiyong {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;
	}
	.text{
		padding-top: 10rpx;
		padding-bottom: 10rpx;
		font-weight: 400;
		font-size: 28rpx;
		color: #242424;
	}
	
	.btn {
		position: fixed;
		bottom: 50rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		line-height: 88rpx;
		text-align: center;
	}
</style>
