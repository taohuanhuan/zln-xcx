<template>
	<view style="background-color: #FFFFFF;min-height: 100vh;">
		<view class="header">
			<image class="h-img" src="../../static/img/loginbg.png"></image>
			<view class="h-title">
				心理咨询应用平台
			</view>
			<view class="h-logo">

			</view>
			<view class="h-client">
				咨询师端
			</view>

		</view>
		<view class="main">
			<view class="phone">
				<image class="p-img" src="/static/img/l-phone.png"></image>
				<view>
					<input class="p-input" placeholder="请输入手机号码"/>
				</view>
				<view class="varify">获取验证码</view>
			</view>
			<view class="phone">
				<image class="p-img" src="/static/img/l-varify.png"></image>
				<view >
					<input class="p-input" placeholder="请输入短信验证码"/>
				</view>
				<view class="varify"></view>
			</view>
			
			<view class="btn btn-active" @click="navPage">登录</view>
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
			navPage(){
				uni.reLaunch({
					url:"/guanlishi/index/index"
				})
			}
		}
	}
</script>

<style lang="scss">
	page {
	  background-color: #F6F6F6; /* 这里设置你想要的背景颜色 */
	  padding: 0 0rpx;
	}
	.main{
		margin-left: 60rpx;
		margin-right: 60rpx;
		margin-top: 68rpx;
		
		.phone{
			height: 100rpx;
			border-bottom: 1rpx solid #F5F5F5;
			display: flex;
			align-items: center;
			.p-img{
				width: 56rpx;
				height: 56rpx;
			}
			.p-input{
				padding-left: 10rpx;
			}
			.varify{
				position: absolute;
				right:60rpx;
				color: #7C7C7C;
			}
		}
		
		.btn{
			width: 630rpx;
			height: 80rpx;
			border-radius: 40rpx;
			margin-top: 100rpx;
			font-size: 30rpx;
			font-weight: bold;
			text-align: center;
			line-height: 80rpx;
		}
	}
	.header {
		position: relative;

		.h-img {
			width: 750rpx;
			height: 516rpx;
		}

		.h-title {
			position: absolute;
			top: 108rpx;
			left: 240rpx;
			font-weight: 600;
			font-size: 34rpx;
			color: #242424;
			line-height: 51rpx;
			text-align: center;
		}

		.h-logo {

			width: 160rpx;
			height: 160rpx;
			position: absolute;
			top: 276rpx;
			left: 288rpx;
			border-radius: 20rpx;
			background-color: #242424;
		}
		.h-client{
			position: absolute;
			width: 136rpx;
			height: 48rpx;
			font-family: PingFang-SC, PingFang-SC;
			font-weight: bold;
			font-size: 34rpx;
			color: #221715;
			line-height: 48rpx;
			text-align: left;
			font-style: normal;
			top: 456rpx;
			left: 306rpx;
		}
	}
</style>