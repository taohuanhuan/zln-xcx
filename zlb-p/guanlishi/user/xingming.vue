<template>
	<view class="main">
		<view class="card">
			<view class="title">
				姓名
			</view>
		<!-- 	<view class="desc">
				内容：
			</view> -->
			<view class="text">
				 <u-input
				    placeholder="请输入内容"
				    border="surround"
				    clearable
				  ></u-input>
				 <!--  <u--input
				     placeholder="请输入内容"
				     border="surround"
				     clearable
				   ></u--input> -->
			</view>
		</view>
		
		<view class="btn">
			提交
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