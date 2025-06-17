<template>
	<view class="main">
		<view class="card">
			<view class="title">
				个人简介
			</view>

			<view class="text">
				<u--textarea v-model="value1" placeholder="请输入内容"></u--textarea>
			</view>
		</view>
		
		<view class="btn">
			确认
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				value1: '',
			};
		}
	}
</script>

<style lang="scss" scoped>
	.main {
		min-height: 100vh;
		background-color: #F6F6F6;
		padding-top: 30rpx;

		.card {
			background-color: white;
			border-radius: 16rpx;
			padding: 30rpx;
			box-sizing: border-box;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.desc {
				font-weight: 400;
				font-size: 28rpx;
				color: #666666;
				margin-top: 30rpx;
			}
			.text{
				margin-top: 30rpx;
			}
		}
		
		.btn{
			position: fixed;
			bottom: 50rpx;
			left: 30rpx;
			width: 690rpx;
			height: 88rpx;
			background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
			border-radius: 44rpx;
			line-height: 88rpx;
			text-align: center;
			font-weight: bold;
			font-size: 28rpx; 
			color: #FFFFFF;
			margin-top: 100rpx;
		}
	}
</style>