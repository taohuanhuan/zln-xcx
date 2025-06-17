<template>
	<view>
		<view class="main">
			<view class="card">
				<view class="text">再大的愿景都是从小处着手，越大的图越要从小处搞，越小的东西越要从大处着眼</view>
				<view class="imgs">
					<image class="img" src="../../static/img/avatar.png"></image>
					<image class="img" src="../../static/img/avatar.png"></image>
					<image class="img" src="../../static/img/avatar.png"></image>
				</view>
				<view class="time">2024.05.05 09:34</view>
			</view>
		</view>
		<view class="btn-group">
			<view class="btn" @click="navPage('/guanlishi/user/xinzengdudao')">新增督导记录</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		methods:{
			navPage(url) {
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.main{
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
	}
	.card{
		width: 690rpx;
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		.text{
			font-weight: 400;
			font-size: 28rpx;
			color: #242424;
			line-height: 40rpx;
			text-align: left;
			font-style: normal;
		}
		.imgs{
			display: grid;
			grid-template-columns: repeat(3,1fr);
			margin-top: 30rpx;
			margin-bottom: 30rpx;
			.img{
				width: 196rpx;
				height: 196rpx;
				border-radius: 10rpx;
			}
		}
		.time{
			font-weight: 400;
			font-size: 24rpx;
			color: #999999;
		}
	}
	.btn-group{
		position: fixed;
		bottom: 0;
		left: 0;
		width: 750rpx;
		height: 166rpx;
		background: #FFFFFF;
		box-shadow: 0rpx -2rpx 12rpx 0rpx rgba(36,36,36,0.05);
		
		.btn{
			width: 690rpx;
			height: 88rpx;
			margin-left: 30rpx;
			margin-top: 20rpx;
			background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
			border-radius: 44rpx;
			font-weight: bold;
			font-size: 28rpx;
			color: #FFFFFF;
			text-align: center;
			line-height: 88rpx;
		}
	}
</style>
